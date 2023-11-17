<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DC_common extends CI_Controller
{

    // 사용자
    private $usr_id, $usr_lv, $usr_status;

    // usr config
    private $usr_lv_join = 2;

    // 관리자
    private $adm_lv_allowed;

    // 상태
    private $svc_mod, $is_adm_mod, $is_mng_mod, $is_main, $is_login;
    protected $is_admin;

    // 언어
    private $lng_arr = array();
    private $lng_mode_yn;
    public $seg, $lng_cd, $lng_idx;

    // 메뉴구조
    private $nav_tree = array();
    private $auth_tree = array();
    private $cur_tree = array();
    private $g_id, $m_id, $grp_tit, $pg_tit;
    private $left_menu_arr = array();

    // 설정
    private $upload_files_num;
    private $file_upload_dir;
    private $cfg_file_upload = array();
    private $cfg_file_resize = array(
        'resize_width' => 1024
    , 'resize_height' => 1024
    );

    // 파라미터
    private $p_cat, $p_opt, $p_idx, $pg_idx, $fl_idx, $code, $p_ord, $initial, $law_ord, $orga_ord;

    // 파라미터(검색)
    private $s_word, $s_cat, $s_sds, $s_sde, $s_rfsw, $s_fsw, $s_res, $s_tot, $s_lng, $s_fld, $s_typ, $s_cont, $s_subj, $post_cat, $usr_nm, $sanc, $post_sanc;

    // 키워드
    private $kw_lists=[];

    private $base = '/index.php';

    private $bbs_mod, $fnc_typ, $edtr, $bbs_perm;

    private $param_header;

    private $base_url;

    private $exception_history_arr = array("login", "signin", "join", "signup", "logout", "insert", "update", "updatePw", "delete", "withdrawal", "dnload", "excel_dnload", "excel_dnload1", "certMail");


    public function __construct()
    {
        parent::__construct();
        /*
         * ****************************************
         * load library 1
         * ----------------------------------------
         * DL_structure
         * DL_config
         * DL_flex
         * DL_auth
         * DM_basic
         * ****************************************
         */
        $this->load->library('session');
        $this->load->library('DL_security');

        $this->load->library('DL_structure');
        $this->load->library('DL_config');
        $this->load->library('DL_flex');
        $this->load->library('DL_auth');
        $this->load->model('DM_basic');


        /*
         * **************************************** language
         * set lng_arr, lng_cd, lng_idx, lng_mode_yn
         * 1 - URI->segments
         * 2 - session
         * 3 - $config['language']
         * 4 - $config['lng_arr'][0]
         * 5 - HTTP_ACCEPT_LANGUAGE
         * 6 - default ko
         * ****************************************
         */
        // lng_arr
        $this->lng_arr = $this->config->item('lng_arr');

        // lng_mode_yn
        $this->lng_mode_yn = $this->config->item('lng_mode_yn');

        // /?Open 필터링 추가 2022.05.09
        $link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if (preg_match("/\/\?.*/", $link)) {
            show_404("ERROR : url is wrong", TRUE);
        }

        // lng_cd
        $this->lng_cd = $this->config->item('lng_cd');
        if (!$this->lng_cd) {
            if ($this->session->userdata('lng_cd')) {
                $this->lng_cd = $this->session->userdata('lng_cd');
                log_message("info", "DC_common :: case2 - lng_cd = " . $this->lng_cd);
            } else if ($this->get_cfg_lng_cd($this->config->item('language'))) {
                $this->lng_cd = $this->get_cfg_lng_cd($this->config->item('language'));
                log_message("info", "DC_common :: case3 - lng_cd = " . $this->lng_cd);
            } else if ($this->config->item('lng_arr')[0][0]) {
                $this->lng_cd = $this->config->item('lng_arr')[0][0];
                log_message("info", "DC_common :: case4 - lng_cd = " . $this->lng_cd);
            } else if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) && $this->chk_lng_cd(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2))) {
                $this->lng_cd = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
                log_message("info", "DC_common :: case5 - lng_cd = " . $this->lng_cd);
            } else { // 기본값 적용
                $this->lng_cd = 'ko';
                log_message("info", "DC_common :: case6 - lng_cd = " . $this->lng_cd);
            }
        } else {
            log_message("info", "DC_common :: case1 - lng_cd = " . $this->lng_cd);
        }

        // lng_idx
        $this->lng_idx = $this->get_lng_idx($this->lng_arr, $this->lng_cd);

        //
        $this->base_url = $this->config->item('base_url');


        /*
         * ----------------------------------------
         * 상태정보
         * ----------------------------------------
         * svc_mod
         * seg
         * is_adm_mod
         * is_mng_mod
         * ----------------------------------------
        */
        $this->svc_mod = $this->config->item('svc_mod');
        if ($this->svc_mod == "adm" || $this->svc_mod == "mng") {
            $this->seg = $this->svc_mod;
            $this->base_url .= '/' . $this->seg;
            if ($this->svc_mod == "adm") {
                $this->is_adm_mod = TRUE;
                //$this->base_url .= '/'.$this->svc_mod;
            } else if ($this->svc_mod == "mng") {
                $this->is_mng_mod = TRUE;
                //$this->base_url .= '/'.$this->svc_mod;
            }
            //
            //$this->load->model('DM_adm');
        } else {
            //
            $this->seg = $this->lng_cd;
        }


        /*
         * ****************************************
         * S E S S I O N - U P D A T E
         * ****************************************
         * lng_cd
         * svc_mod : svc, adm, mod
         *----------------------------------------
        */
        $this->session->set_userdata('lng_cd', $this->lng_cd);
        //$this->session->set_userdata('svc_mod', $this->svc_mod);


        /*
         *----------------------------------------
         * P A R A M
         *----------------------------------------
        */
        if ($this->input->get('cat', TRUE)) {
            $p_cat = '';
            //$p_cat = $this->input->get('cat');
            $p_cat = $this->input->get('cat', TRUE);
            $p_cat = $this->dl_security->xss_cleaner($p_cat);

            if($p_cat){
                if ( !($p_cat=="common" || $p_cat=="bank" || $p_cat=="investment" || $p_cat=="microfinance") ){
                    show_404("ERROR : cat is wrong", TRUE);
                }
            }
            $this->p_cat = $p_cat;
        }
        //if ($this->input->get('opt', TRUE)) {
        //    $this->p_opt = $this->input->get('opt', TRUE);
        //    $this->p_opt = $this->security->xss_clean($this->p_opt);
        //}

        if ($this->input->get('ord', TRUE)) {
            $p_ord = $this->input->get('ord', TRUE);
            $p_ord = $this->dl_security->xss_cleaner($p_ord);
            if($p_ord){
                if ( !($p_ord=="DESC" || $p_ord=="ASC") ){
                    show_404("ERROR : ord is wrong", TRUE);
                }
            }
            $this->p_ord = $p_ord;
        }
        
        if ($this->input->get('laword', TRUE)) {
            $law_ord = $this->input->get('laword', TRUE);
            $law_ord = $this->dl_security->xss_cleaner($law_ord);
            if($law_ord){
                if ( !($law_ord=="DESC" || $law_ord=="ASC") ){
                    show_404("ERROR : ord is wrong", TRUE);
                }
            }
            $this->law_ord = $law_ord;
        }

        if ($this->input->get('orgaord', TRUE)) {
            $orga_ord = $this->input->get('orgaord', TRUE);
            $orga_ord = $this->dl_security->xss_cleaner($orga_ord);
            if($orga_ord){
                if ( !($orga_ord=="DESC" || $orga_ord=="ASC") ){
                    show_404("ERROR : ord is wrong", TRUE);
                }
            }
            $this->orga_ord = $orga_ord;
        }

        if (preg_match("/[^0-9]/", $this->input->get('idx', TRUE))) {
            show_404("ERROR : idx is wrong", TRUE);
        } else {
            $p_idx = $this->input->get('idx', TRUE);
            $p_idx = $this->dl_security->xss_cleaner($p_idx);
            $this->p_idx = $p_idx;
        }

        if (preg_match("/[^0-9]/", $this->input->get('pg', TRUE))) {
            show_404("ERROR : pg is wrong", TRUE);
        } else {
            $pg_idx = $this->input->get('pg', TRUE);
            $pg_idx = $this->dl_security->xss_cleaner($pg_idx);
            $this->pg_idx = $pg_idx;
        }

        //initial 검색
        if ($this->input->get('initial', TRUE)) {
            $initial = $this->input->get('initial', TRUE);
            $initial = $this->dl_security->xss_cleaner($initial);
            $this->initial = $initial;
        }
        //제목 검색
        if ($this->input->get('s_subj', TRUE)) {
            $s_subj = $this->input->get('s_subj', TRUE);
            $s_subj = $this->dl_security->xss_cleaner($s_subj);
            $this->s_subj = $s_subj;
        }
        //내용 검색
        if ($this->input->get('s_cont', TRUE)) {
            $s_cont = $this->input->get('s_cont', TRUE);
            $s_cont = $this->dl_security->xss_cleaner($s_cont);
            $this->s_cont = $s_cont;
        }
        //발행기관 검색
        if ($this->input->get('post_cat', TRUE)) {
            $post_cat = $this->input->get('post_cat', TRUE);
            $post_cat = $this->dl_security->xss_cleaner($post_cat);
            $this->post_cat = $post_cat;
        }
        //위반법률 검색
        if ($this->input->get('sanc', TRUE)) {
            $sanc = $this->input->get('sanc', TRUE);
            $sanc = $this->dl_security->xss_cleaner($sanc);
            $this->sanc = $sanc;
        }
        //제재기관 검색
        if ($this->input->get('post_sanc', TRUE)) {
            $post_sanc = $this->input->get('post_sanc', TRUE);
            $post_sanc = $this->dl_security->xss_cleaner($post_sanc);
            $this->post_sanc = $post_sanc;
        }
        if ($this->input->get('usr_nm', TRUE)) {
            $usr_nm = $this->input->get('usr_nm', TRUE);
            $usr_nm = $this->dl_security->xss_cleaner($usr_nm);
            $this->usr_nm = $usr_nm;
        }

        if ($this->input->get('fl', TRUE)) {
            $this->fl_idx = $this->input->get('fl', TRUE);
            $this->fl_idx = $this->security->xss_clean($this->fl_idx);
        }
        //echo $this->fl_idx;
        // ***** 검색어 GET  $this->security->xss_clean()
        //var_dump($this->input->get('s_word'));

        if($this->input->get('s_word', TRUE)){
            $s_word = $this->input->get('s_word', TRUE);
            $s_word = $this->dl_security->xss_cleaner($s_word);
            $this->s_word = $s_word;
        }

        if($this->input->get('s_cat', TRUE)){
            $s_cat = $this->input->get('s_cat', TRUE);
            $s_cat = $this->dl_security->xss_cleaner($s_cat);
            if($s_cat){
                if ( !($s_cat=="전자금융거래" || $s_cat=="정보보호" || $s_cat=="금융소비자" || $s_cat=="자본시장법") ){
                    show_404("ERROR : cat is wrong", TRUE);
                }
            }
            $this->s_cat = $s_cat;
        }

        //if ( !($this->s_cat=="전자금융거래" || $this->s_cat=="정보보호" || $this->s_cat=="금융소비자" || $this->s_cat=="자본시장법") ){
        //    show_404("ERROR : cat is wrong", TRUE);
        //}

        if($this->input->get('s_sds', TRUE)){
            $s_sds = $this->input->get('s_sds', TRUE);
            $s_sds = $this->dl_security->xss_cleaner($s_sds);
            $this->s_sds = $s_sds;
        }

        if($this->input->get('s_sde', TRUE)){
            $s_sde = $this->input->get('s_sde', TRUE);
            $s_sde = $this->dl_security->xss_cleaner($s_sde);
            $this->s_sde = $s_sde;
        }

        if($this->input->get('s_fsw'))
        {
            //$s_fsw = $this->input->get('s_fsw');
            $s_fsw = $this->input->get('s_fsw', TRUE);
            $s_fsw = $this->dl_security->xss_cleaner($s_fsw);
            $this->s_fsw = $s_fsw;
        }

        if($this->input->get('s_lng'))
        {
            $s_lng = $this->input->get('s_lng', TRUE);
            $s_lng = $this->dl_security->xss_cleaner($s_lng);
            $this->s_lng = $s_lng;
        }

        if($this->input->get('s_fld'))
        {
            $s_fld = $this->input->get('s_fld', TRUE);
            $s_fld = $this->dl_security->xss_cleaner($s_fld);
            $this->s_fld = $s_fld;
        }

        if($this->input->get('s_typ'))
        {
            $s_typ = $this->input->get('s_typ', TRUE);
            $s_typ = $this->dl_security->xss_cleaner($s_typ);
            $this->s_typ = $s_typ;
        }

        if($this->input->get('s_rfsw'))
        {
            $s_rfsw = $this->input->get('s_rfsw', TRUE);
            $s_rfsw = $this->dl_security->xss_cleaner($s_rfsw);
            $this->s_rfsw = $s_rfsw;
        }

        // ***** 코드 GET
        //$this->code = $this->input->get('code', TRUE);
        //$this->code = $_GET['code'];


        /*
         * ----------------------------------------
         * 사용자 정보 초기화
         * ----------------------------------------
         * usr_id
         * usr_lv
         * usr_status
         * ----------------------------------------
        */
        $this->usr_id = '';
        $this->usr_lv = 1;
        $this->usr_status = 0;


        /*
         * ----------------------------------------
         * 관리자정보 초기화
         * ----------------------------------------
         * adm_lv_allowed
         * is_admin
         * ----------------------------------------
        */
        if ($this->svc_mod == "adm") {
            $this->load->library('DL_admin');
        }
        $this->adm_lv_allowed = $this->get_cfg('adm_lv_allowed');
        $this->is_admin = $this->chk_adm_per($this->session->userdata('usr_lv'));


        /*
         * ****************************************
         * load config/tree
         * ****************************************
         */
        $this->config->load('tree');


        /*
         * ****************************************
         * get tree : nav_tree, auth_tree
         * ****************************************
         */
        $this->nav_tree = $this->config->item($this->svc_mod . '_tree');

        $this->auth_tree = $this->config->item('auth_tree');

        $this->set_gm_id($this->uri->rsegments);
//var_dump($this->g_id);
//var_dump($this->m_id);

        $this->set_cur_tree($this->g_id);

//print_r($this->cur_tree);


        $tmp_item = $this->dl_structure->get_md($this->cur_tree, 0, $this->m_id);

        if(!$tmp_item){
            show_404("ERROR : md id is null", TRUE);
        }
//print_r( $tmp_item['path_arr'] );


        /*
         * ****************************************
         * m_id
         * ****************************************
         */
        if ($tmp_item['md']['id']) {
            $this->m_id = $tmp_item['md']['id'];

            $tb_id = $tmp_item['md']['tbl'];
            if ($tb_id) {
                if (substr($tb_id, 0, 3) == 'ct_') {
                    $this->file_upload_dir = str_replace('ct_', '', $tb_id);
                } else {
                    show_404("ERROR : 테이블 아이디 오류로 업로드 디렉토리 지정할 수 없음 -> tree 확인", TRUE);
                }
            }
        } else {
            show_404("ERROR : md id is null", TRUE);
        }


        $this->config->set_item("md", $tmp_item['md']);
        $this->config->set_item("path_arr", $tmp_item['path_arr']);
        $this->config->set_item("gd", $tmp_item['gd']);
        //echo 'gd='.$tmp_item['gd'].'<br>';
        //print_r($tmp_item['gd']);


        /*
         * ****************************************
         * g_id
         * ****************************************
         */
        $dpth_arr = $this->config->item('path_arr');
//print_r($dpth_arr[0]['sub']['idx']);
        if (count($dpth_arr) == 3) {
            $this->g_id = $dpth_arr[count($dpth_arr) - 2]['id'];
        } else if (count($dpth_arr) == 2) {
            $this->g_id = $dpth_arr[count($dpth_arr) - 1]['id'];
        } else {
            $this->g_id = $dpth_arr[0]['id'];
        }
        unset($dpth_arr);
//var_dump($this->g_id);


        /*
         * ****************************************
         * ! proc (label, cont)
         * ****************************************
         */
        if ($this->config->item('md')['typ'] != 'proc') {

            // ***** pg_tit
            $this->pg_tit = $this->config->item('md')['tit'][$this->lng_idx];
            // ***** grp_tit
            $this->grp_tit = $this->set_grp_tit($tmp_item, $this->m_id);

            // ***** grp_list
            //$this->gd_arr = $tmp_item['gd'];
            //echo $this->m_id;
            //echo count($this->config->item('path_arr'));

            //print_r($this->config->item('path_arr'));

            if (count($this->config->item('path_arr'))>1) {
                $this->gd_arr = $this->config->item('path_arr')[1]['sub'];


                //$this->gd_idx = $this->config->item('path_arr')[1]['idx'];
            }
            //print_r($this->config->item('path_arr')[1]['sub']);
            //print_r($tmp_item['gd']);
            //print_r($tmp_item['path_arr']);
//echo $this->gd_idx;
//print_r($this->gd_arr);

            // *****
            $this->set_breadcrumb($this->config->item("path_arr"));
            $this->breadcrumb = $this->get_breadcrumb();


            $this->fnc_typ = $this->config->item("md")['fnc'];


            // ***** bbs, flex
            if ($this->fnc_typ == 'bbs' || $this->fnc_typ == 'flex') {

                // ***** library - cm
                $this->load->library('DL_schema');

                $this->load->library('DL_insert');
                $this->load->library('DL_update');
                $this->load->library('DL_delete');

                $this->load->library('DL_excel');

                // ***** file num
                if ($this->config->item("md")['file']) {
                    $this->load->library('DL_file');

                    // ***** set config file
                    $this->set_cfg_file_upload($this->dl_config->get_file_cfg('file_upload'));
                    $this->set_cfg_file_resize($this->dl_config->get_file_cfg('file_resize'));

                    $this->upload_files_num = $this->config->item("md")['file'];
                } else {
                    $this->upload_files_num = 0;
                }

                $this->edtr = $this->config->item("md")['edtr'];


                if ($this->fnc_typ == 'bbs') {

                    $this->load->library('DL_lists');
                    $this->load->library('DL_view');
                    $this->load->library('DL_write');
                    $this->load->library('DL_modify');
                    $this->load->library('DL_reply');

                    // bbs_mod
                    if ($this->uri->segment(3)) {
                        $this->bbs_mod = $this->uri->segment(3);
                    } else if ($this->config->item("md")['mod']) {
                        $this->bbs_mod = $this->config->item("md")['mod'];
                    } else {
                        $this->bbs_mod = 'lists';
                    }

                    $this->bbs_perm = $this->config->item("md")['perm'];
                    /*
                     *----------------------------------------
                     * S C H E M A
                     *----------------------------------------
                    */
                    if ($this->config->item('md')['fld']) {
                        $this->config->set_item("fields", $this->dl_schema->get_schema($this->config->item('md')['fld']));
                    } else {
                        show_404(":::::::::: DC_common : bbs > fields is null", TRUE);
                    }
                }
            }
        }


        /*
         *----------------------------------------
         * U S E R
         * session
         *----------------------------------------
        */
        // *****
        if ($this->session->userdata('is_login')) // 세션 로그인유무 확인
        {
            if ($this->session->userdata('usr_id')) { // 세션 아이디가 있다면

                // ***** usr_id
                $this->usr_id = $this->session->userdata('usr_id');
                $this->usr_lv = $this->session->userdata('usr_lv');
                $this->is_login = $this->session->userdata('is_login');

                if (!$this->usr_id) {
                    show_404(":::::::::: DC_common | USER : ERROR - usr_id is null ", TRUE);
                } else {
                    // ***** param usr
                    $param_cm = array(
                        'tb_id' => 'ct_usr'
                        ,'usr_id' => $this->usr_id
                    );
                    $_tmp = $this->DM_basic->getByUid($param_cm);

                    unset($_tmp['usr_nm_hash']);
                    unset($_tmp['usr_email_hash']);
                    unset($_tmp['usr_pw']);

                    $this->load->library('encryption');
                    $enc_key = $this->DM_basic->get_enc_key(array('key_id'=> 'enc_key'));
                    $this->encryption->initialize(
                        array(
                            'key' => $enc_key['key_val']
                        )
                    );

                    if($_tmp['usr_typ']!=10){
                        $_tmp['usr_nm']=$this->encryption->decrypt($_tmp['usr_nm']);
                        $_tmp['usr_email']=$this->encryption->decrypt($_tmp['usr_email']);
                    }
                    $this->set_usr_arr($_tmp); // usr_arr 로 통일 ( config 에 저장안함 )


                    
                    
                }

            } else { // 로그인 상태인데 아이디가 없다면 오류처리
                show_404(":::::::::: DC_common | USER : ERROR - is_login but usr_id is null ", TRUE);
            }
        }

        // 키워드
        $param_kw = array(
            'tb_id'     => 'ct_keyword',
            'post_status' => 1,
            'order' => ' crt_dtms ASC '
        );
        $this->kw_lists = $this->DM_basic->getList($param_kw);
        //print_r($this->kw_lists);


        if ($this->m_id=='search' && $this->s_fsw){


            $param_cm = array(
                'tb_id'     => 'ct_brief'
                ,'s_val' => $this->s_fsw
            );
            if ($this->s_rfsw) {
                $param_cm['s_rfsw'] = $this->s_rfsw;
            }
            if ($this->s_sds) {
                $param_cm['s_sds'] = $this->s_sds;
            }
            if ($this->s_sde) {
                $param_cm['s_sde'] = $this->s_sde;
            }



            $total = 0;
            $result['brief'] = $this->DM_basic->getResult_sch($param_cm);
            $total += count($result['brief']);

            $param_cm['tb_id']='ct_lawmaking';
            $result['lawmaking'] = $this->DM_basic->getResult_sch($param_cm);
            $total += count($result['lawmaking']);

            $param_cm['tb_id']='ct_relateSite';
            $result['relateSite'] = $this->DM_basic->getResult_sch($param_cm);
            $total += count($result['relateSite']);

            $param_cm['tb_id']='ct_pr';
            $result['pr'] = $this->DM_basic->getResult_sch($param_cm);
            $total += count($result['pr']);

            $param_cm['tb_id']='ct_current';
            $result['current'] = $this->DM_basic->getResult_sch($param_cm);
            $total += count($result['current']);

            $param_cm['tb_id']='ct_news';
            $result['news'] = $this->DM_basic->getResult_sch($param_cm);
            $total += count($result['news']);

            $param_cm['tb_id']='ct_labdata';
            $result['labdata'] = $this->DM_basic->getResult_sch($param_cm);
            $total += count($result['labdata']);

            $param_cm['tb_id']='ct_edudata';
            $result['edudata'] = $this->DM_basic->getResult_sch($param_cm);
            $total += count($result['edudata']);

            $param_cm['tb_id']='ct_translate';
            $result['translate'] = $this->DM_basic->getResult_sch($param_cm);
            $total += count($result['translate']);

            $param_cm['tb_id']='ct_noaction';
            $result['noaction'] = $this->DM_basic->getResult_sch($param_cm);
            $total += count($result['noaction']);

            $param_cm['tb_id']='ct_precedent';
            $result['precedent'] = $this->DM_basic->getResult_sch($param_cm);
            $total += count($result['precedent']);

            $param_cm['tb_id']='ct_personnelTrends';
            $result['personnelTrends'] = $this->DM_basic->getResult_sch($param_cm);
            $total += count($result['personnelTrends']);

            $param_cm['tb_id']='ct_prevmnlaun1';
            $result['prevmnlaun1'] = $this->DM_basic->getResult_sch($param_cm);
            $total += count($result['prevmnlaun1']);

            $param_cm['tb_id']='ct_prevmnlaun2';
            $result['prevmnlaun2'] = $this->DM_basic->getResult_sch($param_cm);
            $total += count($result['prevmnlaun2']);

            $param_cm['tb_id']='ct_intnlctrl';
            $result['intnlctrl'] = $this->DM_basic->getResult_sch($param_cm);
            $total += count($result['intnlctrl']);

            $param_cm['tb_id']='ct_finnaccexp';
            $result['finnaccexp'] = $this->DM_basic->getResult_sch($param_cm);
            $total += count($result['finnaccexp']);

            $param_cm['tb_id']='ct_sanctions';
            $result['sanctions'] = $this->DM_basic->getResult_sch($param_cm);
            $total += count($result['sanctions']);
            $this->s_res = $result;
            $this->s_tot = $total;
            //echo $this->s_tot;
        }



    }//---------- end of __construct


    /*
     * ======================================================================
     *
     *                   P R I V A T E - F U N C T I O N
     *
     * ======================================================================
     */


    // lng_cd 유효성 검사
    private function chk_lng_cd($_seg)
    {
        $_rtn = FALSE;
        if ($_seg) {
            foreach ($this->lng_arr as $value) {
                if ($value[0] == $_seg) {
                    $_rtn = TRUE;
                    break;
                }
            }
        } else {
            show_404(":::::::::: DC_common -> chk_lng_cd : _seg is null ", TRUE);
        }
        return $_rtn;
    }

    // lng_arr 에서 lng_nm 값으로 lan_cd 추출
    private function get_cfg_lng_cd($_language)
    {
        $_rtn = null;
        foreach ($this->lng_arr as $value) {
            if ($value[1] == $_language) {
                $_rtn = $value[0];
                break;
            }
        }
        if ($_rtn == null) {
            log_message("DEBUG", "DC_common -> get_cfg_lng_cd :: 잘못된 설정값 입니다. _language=" . $_language);
        }
        return $_rtn;
    }

    // lng_idx 추출
    private function get_lng_idx($_arr, $_lng_cd = "")
    {
        $_rtn = null;
        if (count($_arr)) {
            foreach ($_arr as $key => $value) {
                if ($value[0] == $_lng_cd) {
                    $_rtn = $key;
                    break;
                }
            }
        } else {
            show_404(":::::::::: DC_common -> get_lng_idx : arr is null ", TRUE);
        }
        return $_rtn;
    }

    private function set_gm_id($_arr)
    {
        if ($_arr[2] == 'auth') {
            $this->g_id = "auth";
            if (count($_arr) > 2) {
                $this->m_id = $_arr[count($_arr)];
            } else {
                show_404("DC_common -> set_gm_id : _arr count is wrong ", TRUE);
            }
        } else if ($this->svc_mod == 'adm') {
            $this->g_id = "admin";
            if (count($_arr) == 3) {
                $this->m_id = $_arr[count($_arr)];
            } else if (count($_arr) > 3) {
                $this->m_id = $_arr[count($_arr) - 1];
            } else {
                $this->m_id = "dashboard";
            }

        } else if ($this->svc_mod == 'mng') {
            $this->g_id = "manager";
            if (count($_arr) == 3) {
                $this->m_id = $_arr[count($_arr)];
            } else if (count($_arr) > 3) {
                $this->m_id = $_arr[count($_arr) - 1];
            } else {
                $this->m_id = "dashboard";
            }
        } else {
            if ($_arr[count($_arr)] == 'index') {
                $this->g_id = "pg";
                $this->m_id = "home";
            } else {
                $this->g_id = $_arr[count($_arr) - 1];
                $this->m_id = $_arr[count($_arr)];
            }
        }
    }

    // ***** set_auth_tree
    private function set_cur_tree($_str = '')
    {
        //log_message("INFO", "ooo DC_common -> set_cur_tree");
        if ($_str == 'auth') {
            $this->cur_tree = $this->nav_tree;
            $this->cur_tree[0]['sub'] = $this->auth_tree;
        } else {
            $this->cur_tree = $this->nav_tree;
        }
    }

    // ***** set_grp_tit
    private function set_grp_tit($_tree_arr = array(), $_str = '')
    {
        $rtn = false;
        if (count($_tree_arr) && $_str) {
            $depth_cnt = count($_tree_arr['path_arr']);
            if ($depth_cnt > 1) {
                $rtn = $_tree_arr['path_arr'][1]['tit'][$this->lng_idx];
            } else {
                $rtn = $_tree_arr['path_arr'][0]['tit'][$this->lng_idx];
            }
        }
        return $rtn;
    }


    // *****
    private function set_usr($_key, $_val)
    {
        log_message("INFO", "ooo DC_common -> set_user");
        if (isset($this->usr_arr[$_key])) {
            $this->usr_arr[$_key] = $_val;
        }
    }

    // *****
    private function set_usr_arr($_usr_arr)
    {
        log_message("INFO", "ooo DC_common -> set_usr_arr");
        $this->usr_arr = $_usr_arr;
    }

    // *****
    private function chk_adm_per($_idx)
    {
        //var_dump($_idx);
        $rtn = false;
        if ($this->adm_lv_allowed <= $_idx) {
            $rtn = true;
        }
        return $rtn;
    }

    // *****
    private function get_cfg($_id)
    {
        if ($this->config->item($_id)) {
            $rtn = false;
            $rtn = $this->config->item($_id);
            return $rtn;
        } else {
            show_404('DC_common', '/application/config/config.php에 ' . $_id . '가 정의되지 않았습니다.');
        }
    }

    /*------------------------------
     * return_chk : deny시 return
     * cd : [pass, deny]
     * opt : [login, mypage, home]
     * msg : 메세지
     * hstry : 히스토리
     *-----
     * 메세지 처리 세션처리 후
     * 리다이렉트
     * $this->set_common_hstry();
     */
    protected function return_chk($_cd = "deny", $_opt = "", $_perm_lv, $_usr_lv)
    {
        log_message("INFO", "ooo DC_common -> return_chk : start : opt =" . $_opt);
        echo "----------return_chk";
        echo "_cd=" . $_cd . "<br>";
        echo "_opt=" . $_opt . "<br>";
        echo "_perm_lv=" . $_perm_lv . "<br>";
        echo "_usr_lv=" . $_usr_lv . "<br>";


        /*
        if($_cd=="deny") { // 거절의 경우
            if ($_opt == "") { // opt가 정해지지 않은 경우

                if() { // 권한이 2이상이고 사용자가 1이면 - 로그인으로 유도
                    $_opt = "login";
                }else if(){ // 권한이 3이고 사용자가 2라면
                    $_opt = "cert";
                }else if(){ // 권한이 2이고 사용자가 2라면
                    $_opt = "perm";
                }else if(){ // 권한이 adm 이고 사용자가 is_admin 이 아니라면
                    $_opt = "adm";
                }
            }
        }
        */

        /*
         *------------------------------
         * 메세지 처리 : _cd
         * login : 로그인
         * mypage : 마이페이지
         * home : 홈
         *
         */
        //$_msg = $this->get_msg($_opt);

        $_msg = "";
        if ($_opt == 'login') {                         // login
            $_msg = "로그인이 필요합니다. 로그인 화면으로 이동합니다.";
        } else if ($_opt == 'mypage') {                  // mypage
            $_msg = "마이페이지로 이동합니다.";
        } else if ($_opt == 'cert') {                    // cert
            $_msg = "메일인증이 완료되지 않았습니다. 메일인증을 완료 해주세요. \n마이페이지에서 인증메일 재발송을 할 수 있습니다.";
        } else if ($_opt == 'reg') {                     // reg
            $_msg = "참가등록 권한이 없습니다.";
        } else if ($_opt == 'reg_period') {              // reg_period
            $_msg = "참가등록 기간이 아닙니다.";
        } else if ($_opt == 'reg_period') {              // reg_end
            $_msg = "참가등록 기간이 종료되었습니다.";
        } else if ($_opt == 'withdrawl') {               // withdrawl
            $_msg = "참가등록 취소권한이 없습니다.";
        } else if ($_opt == 'withdrawl_period') {        // withdrawl_period
            $_msg = "참가등록 취소가능기간이 아닙니다.";
        } else if ($_opt == 'withdrawl_end') {           // withdrawl_end
            $_msg = "참가등록 취소기간이 종료되었습니다.";
        } else if ($_opt == 'perm') {                    // perm
            $_msg = "접근권한이 없습니다.";
        } else if ($_opt == 'adm') {                     // adm
            $_msg = "관리자 접근권한이 없습니다.";
        } else if ($_opt == 'lists') {                   // lists
            $_msg = "목록 접근권한이 없습니다.";
        } else if ($_opt == 'view') {                    // view
            $_msg = "내용 접근권한이 없습니다.";
        } else if ($_opt == 'write') {                   // write
            $_msg = "작성 권한이 없습니다.";
        } else if ($_opt == 'modify') {                  // modify
            $_msg = "수정 권한이 없습니다.";
        } else if ($_opt == 'delete') {                  // delete
            $_msg = "삭제 권한이 없습니다.";
        } else if ($_opt == 'dnload') {                  // dnload
            $_msg = "다운로드 권한이 없습니다.";
        } else if ($_opt == 'dnload_end') {              // dnload_end
            $_msg = "다운로드 기간이 종료되었습니다.";
        } else if ($_opt == 'dnload_period') {           // dnload_period
            $_msg = "다운로드 기간이 아닙니다.";

        } else if ($_opt == 'is_admin') {                // is_admin
            $_msg = "관리자만 접근가능합니다.";

        } else {
            $_msg = "접근권한이 없습니다. 홈으로 이동합니다.";
        }

        log_message("INFO", "ooo DC_common -> return_chk : msg =" . $_msg);
        // 메세지 세션 저장
        $this->session->set_flashdata('message', 'INFO : ' . $_msg, 'refresh');


        /*
         *------------------------------
         * 경로 처리 : hstry, cd, opt
         */
        if ($_opt) {
            $_path = $this->dl_config->get_path_rtn(array('m_id' => $this->m_id));
            log_message("INFO", "ooo DC_common -> return_chk : =====> path =" . $_path);
            log_message("INFO", "ooo DC_common -> return_chk : =====> hstry =" . $this->session->userdata('hstry'));
            if ($_path == $this->session->userdata('hstry')) {
                // 히스토리 제거
                $this->session->set_userdata('hstry', "");
                $_path = "/";
            }
        } else {
            $_path = "/";
        }


        //log_message("INFO", "ooo DC_common -> return_chk : path =".$_path);

        /*
         *----------------------------------------
         * H I S T O R Y
         *----------------------------------------
        */
        //$this->get_val('m_id') != "login" && $this->get_val('m_id') != "signin" && $this->get_val('m_id') != "join" && $this->get_val('m_id') != "signup" && $this->get_val('m_id') != "logout" && $this->get_val('m_id') != "delete" && $this->uri->segment(2) != "dnload" ){
        //var_dump($this->uri->segment(2));

        log_message("INFO", "ooo DC_common -> return_chk : redirect =" . $_path);
        redirect($_path);
    }




    /*
     * ======================================================================
     *
     *                   P U B L I C - R O U T I N G
     *
     * ======================================================================
     */

    // *****
    public function set_usr_ss()
    {
        // from session
        if ($this->session->userdata('is_login')) {
            $this->set_usr("usr_id", $this->session->userdata('usr_id'));
            $this->set_usr("usr_lv", $this->session->userdata('usr_lv'));
        }
    }

    // ***** history
    public function set_common_hstry()
    {
        if (!$this->chk_exception_history($this->m_id)) {
            $this->session->set_userdata('hstry', $_SERVER['REQUEST_URI']);
        } else {
            log_message("INFO", ":::::::::: DC_common -> set_common_hstry : 히스토리 업데이트 예외 hstry = " . $_SERVER['REQUEST_URI']);
        }
    }

    //
    public function chk_exception_history($_str)
    {
        log_message("INFO", "ooo DC_common -> chk_exception_history");
        $rtn = false;
        if ($_str) {
            for ($i = 0; $i < count($this->exception_history_arr); $i++) {
                if ($this->exception_history_arr[$i] == $_str) {
                    $rtn = true;
                    break;
                }
            }
        }
        return $rtn;
    }

    // tree
    public function get_tree($_str = '')
    {
        if ($_str == 'nav') {
            return $this->nav_tree;
        } else {
            return $this->cur_tree;
        }
    }

    public function get_usr_lv_join()
    {
        return $this->usr_lv_join;
    }

    // ***** usr (login)
    public function get_usr($_key = "")
    {
        $rtn = false;
        if($_key)
        {
            if(isset($this->usr_arr[$_key]))
            {
                $rtn = $this->usr_arr[$_key];
            }
        }else{
            $rtn = $this->usr_arr;
        }
        return $rtn;
    }
    public function chk_kakao_sync(){
        if(isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'KAKAOTALK', 0))  // KAKAOTALK 인앱
        {
            log_message('debug', '--------------------DC_common::chk_perm - 1.인가코드요청 시작 -> if 인앱브라우저');

            /*
            $client_id = "55803f467bcb30c0d19a1f836850e04b";
            $callBackUrl = "https://nhfrip.devv.kr/ko/auth/oauth";

            $token_url = 'https://kauth.kakao.com/oauth/authorize';
            //$state = $_SERVER['REQUEST_URI'];
            // &prompt=none&state=auto
            $token_url .= sprintf("?client_id=%s&response_type=code&redirect_uri=%s&prompt=none",
                $client_id, urlencode($callBackUrl));

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $token_url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSLVERSION, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_POST, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            log_message('debug', '--------------------DC_common::chk_perm - 2.인가코드요청 - curl 시작');
            $result = curl_exec($ch);
            log_message('debug', '--------------------DC_common::chk_perm - 2.인가코드요청 - curl 끝');
            curl_close($ch);
            exit;
            */
            if (! $this->session->userdata('is_login')) {
                $state = $_SERVER['REQUEST_URI'];

                echo '<meta http-equiv="content-type" content="text/html; charset=UTF-8">';
                echo '<script src="https://developers.kakao.com/sdk/js/kakao.js"></script>';
            	echo '<script type="text/javascript">Kakao.init("91ec0aac3f32ee5795cc51f9c7a9e493");</script>';
                //echo '<script type="text/javascript">Kakao.Auth.authorize({ redirectUri: "https://law.nhbank.com/ko/auth/oauth"});</script>';
                echo '<script type="text/javascript">Kakao.Auth.authorize({ redirectUri: "https://law.nhbank.com/ko/auth/oauth", state: "' . $state . '"});</script>';
                //echo '<script type="text/javascript">Kakao.Auth.authorize({ redirectUri: "https://nhfrip.devv.kr/ko/auth/oauth", state: "'.$state.'"});</script>';
                exit;
            }
        }
    }



    // ***** chk_perm
    public function chk_perm($bbs_mod = "", $usr_id = "")
    {
//$rtn=array(

        //log_message('debug', '--------------------DC_common::chk_perm - 1.인가코드요청 이후 -> if end 인앱브라우저');
        //    'cd'=>'pass'
        //);
        $rtn = null;                      // 결과값
        $bbs_lv = null;                   // 대상 등급

        if ($this->usr_lv) {
            $usr_lv = $this->usr_lv;               // 사용자 등급
        } else { // 비 로그인 사용자 등급 1
            $usr_lv = 1;
        }

        //log_message("INFO", "DC_common -> chk_perm : usr_district = ".$usr_district);
        // bbs_mod가 없다면 md 값 적용
        if (!$bbs_mod) {
            $bbs_mod = $this->bbs_mod;
        }

        // 관리자 모드라면
        if ($this->svc_mod == 'adm') {
            //echo '0<br>';
            if (!$this->is_admin) { // 관리자 아님
                $rtn = ["cd" => "deny", "opt" => "is_admin", "perm_lv" => $this->adm_lv_allowed, "usr_lv" => $usr_lv];
            } else if ($this->adm_lv_allowed > $this->usr_lv) { // 관리 권한 없음
                //echo '2<br>';
                $rtn = ["cd" => "deny", "opt" => "adm", "perm_lv" => $this->adm_lv_allowed, "usr_lv" => $usr_lv];
            } else if ($this->config->item("md")['fnc'] == "bbs") {
                //echo '3<br>';
                $perm_lv='';
                if (isset($this->config->item("md")['perm'][$bbs_mod]) && $this->config->item("md")['perm'][$bbs_mod]) {
                    //echo '3-1<br>';
                    $perm_lv = $this->config->item("md")['perm'][$bbs_mod];
                    if ($perm_lv > $usr_lv) { // 접근 권한 없음
                        //echo '3-1-1<br>';
                        $rtn = ["cd" => "deny", "opt" => $bbs_mod, "perm_lv" => $perm_lv, "usr_lv" => $usr_lv];
                    } else { // 접근 권한 있음
                        //echo '3-1-2<br>';
                        $rtn = ["cd" => "pass", "opt" => "", "perm_lv" => $perm_lv, "usr_lv" => $usr_lv];
                    }
                } else {
                    //echo '3-2<br>';
                    $rtn = ["cd" => "deny", "opt" => $bbs_mod, "perm_lv" => $perm_lv, "usr_lv" => $usr_lv];
                    //show_404("ERROR : DC_common -> chk_perm : adm : bbs_mod is undefined ", TRUE);
                }
            } else { // 게시판이 아닌 아닌경우
                //echo '4<br>';
                $rtn = ["cd" => "pass", "opt" => "", "perm_lv" => 1, "usr_lv" => $usr_lv];
            }

            // 운영자 모드라면
        } else if ($this->svc_mod == 'mng') {
            log_message("INFO", "DC_common -> chk_perm : mng");
            if (!$this->is_manager) { // 관리자 아님
                $rtn = ["cd" => "deny", "opt" => "is_manager", "perm_lv" => $this->allow_mng_level, "usr_lv" => $usr_lv];
                log_message("INFO", "DC_common -> chk_perm : mng : deny : is not manager ");
            } else if ($this->allow_mng_level > $usr_lv) { // 관리 권한 없음
                $rtn = ["cd" => "deny", "opt" => "mng", "perm_lv" => $this->allow_mng_level, "usr_lv" => $usr_lv];
                log_message("INFO", "DC_common -> chk_perm : mng : deny : no mng permission ");

            } else if ($this->config->item("md")['fnc'] == "bbs") {
                if (isset($this->config->item("md")['perm'][$bbs_mod]) && $this->config->item("md")['perm'][$bbs_mod]) {
                    $perm_lv = $this->config->item("md")['perm'][$bbs_mod];
                    if ($perm_lv > $usr_lv) { // 접근 권한 없음
                        $rtn = ["cd" => "deny", "opt" => $bbs_mod, "perm_lv" => $perm_lv, "usr_lv" => $usr_lv];
                        log_message("INFO", "DC_common -> chk_perm : mng : deny : no access permission ");
                    } else { // 접근 권한 있음
                        $rtn = ["cd" => "pass", "opt" => "", "perm_lv" => $perm_lv, "usr_lv" => $usr_lv];
                        log_message("INFO", "DC_common -> chk_perm : mng : pass : Authorized 1");
                    }
                } else {
                    show_404("ERROR : DC_common -> chk_perm : mng : bbs_mod is undefined ", TRUE);
                }
            } else { // 게시판이 아닌 아닌경우
                $rtn = ["cd" => "pass", "opt" => "", "perm_lv" => 1, "usr_lv" => $usr_lv];
                log_message("INFO", "DC_common -> chk_perm : mng : pass : Authorized 2");
            }

        } else { // 서비스 모드라면
            log_message("INFO", "DC_common -> chk_perm : svc ");
            if ($this->config->item("md")['fnc'] == "bbs") {// 게시판이라면

                // 대상모드에 대한 퍼미션 설정값이 있다면
                if (isset($this->config->item("md")['perm'][$bbs_mod]) && $this->config->item("md")['perm'][$bbs_mod]) {
                    $perm_lv = $this->config->item("md")['perm'][$bbs_mod];
                    if ($perm_lv > $usr_lv) {
                        $rtn = ["cd" => "deny", "opt" => "", "perm_lv" => $perm_lv, "usr_lv" => $usr_lv];
                        log_message("INFO", "DC_common -> chk_perm : svc : deny : bbs_lv = " . $bbs_mod . " > usr_lv = " . $usr_lv);
                    } else {
                        // 다운로드인 경우 파일정보 가져옴
                        if ($bbs_mod == "dnload" && $this->m_id == "download") {

                            $param_cm = array(
                                'tb_id' => 'ct_dnload'
                            , 'idx' => $this->p_idx
                            );
                            $dn_file = $this->DM_basic->getView($param_cm);
                            //print_r($dn_file);
                            log_message("INFO", "DC_common -> chk_perm : svc : 다운로드 ");
                            // 배포기간 체크
                            if (chk_distribute_period($dn_file) == 1) { // 배포중

                                log_message("INFO", "DC_common -> chk_perm : svc : 다운로드 : 파일권한은 = " . $dn_file['file_perm'] . "사용자권한은 = " . $usr_lv);
                                // 파일권한 누구나인 경우
                                if ($dn_file['file_perm'] == 1 || $dn_file['file_perm'] == "") {
                                    $rtn = ["cd" => "pass", "opt" => "", "perm_lv" => $perm_lv, "usr_lv" => $usr_lv];
                                    log_message("INFO", "DC_common -> chk_perm : svc : 다운로드 : 파일권한이 누구나 이므로 허용 ");
                                    // 파일권한 누구나 아닌경우
                                } else if ($dn_file['file_perm'] > 1) {
                                    // 사용자권한 체크
                                    if ($dn_file['file_perm'] <= $usr_lv) {
                                        //log_message("INFO", "DC_common -> chk_perm : svc : 다운로드 : usr_district = ".$usr_district.": post_typ = ".$dn_file['post_typ']);
                                        // 사용자정보 대상지구 체크
                                        if ((Null !== $usr_district) and ($usr_district == $dn_file['post_typ'])) {
                                            $rtn = ["cd" => "pass", "opt" => "", "perm_lv" => $perm_lv, "usr_lv" => $usr_lv];
                                            log_message("INFO", "DC_common -> chk_perm : svc : 다운로드 : 승인 ");
                                            // 사용자정보 대상지구 제한
                                        } else {
                                            $rtn = ["cd" => "deny", "opt" => "district", "perm_lv" => $perm_lv, "usr_lv" => $usr_lv];
                                            //log_message("INFO", "DC_common -> chk_perm : svc : 다운로드 : usr_district perm is invalid ");
                                        }
                                        // 사용자권한 제한
                                    } else {
                                        $rtn = ["cd" => "deny", "opt" => "dnload", "perm_lv" => $perm_lv, "usr_lv" => $usr_lv];
                                        log_message("INFO", "DC_common -> chk_perm : svc : 다운로드 : usr perm is invalid ");
                                    }
                                } else {
                                    //show_404("ERROR : DC_common -> chk_perm : svc : 다운로드 file_perm is invalid ", TRUE);
                                }
                                // 배포기간 제한
                            } else {
                                $rtn = ["cd" => "deny", "opt" => "dnload_period", "perm_lv" => $perm_lv, "usr_lv" => $usr_lv];
                                //log_message("INFO", "DC_common -> chk_perm : svc : 다운로드 : download period is invalid ");
                            }
                        } else {
                            $rtn = ["cd" => "pass", "opt" => "", "perm_lv" => $perm_lv, "usr_lv" => $usr_lv];
                        }
                    }
                } else { // 대상모드에 대한 퍼미션 설정값이 없다면
                    echo 'd';
                    //log_message("ERROR", " perm = " . count($this->config->item("md")['perm']));
                    $rtn = ["cd" => "deny", "opt" => $bbs_mod, "perm_lv" => "", "usr_lv" => $usr_lv];
                    //log_message("INFO", "DC_common -> chk_perm : svc : deny : " . $bbs_mod . " mode perm value is null ");
                }

            } else { // 게시판이 아니라면
                // 퍼미션 설정이 있다면
                if ($this->config->item("md")['perm'] != "" && !is_array($this->config->item("md")['perm'])) {
                    $perm_lv = $this->config->item("md")['perm'];
                    log_message("INFO", "DC_common -> chk_perm : svc : have perm : perm_lv = ");
                    if ($perm_lv > $usr_lv) {
                        $rtn = ["cd" => "deny", "opt" => "", "perm_lv" => $perm_lv, "usr_lv" => $usr_lv];
                        log_message("INFO", "DC_common -> chk_perm : svc : deny : bbs_lv = " . $bbs_mod . " > usr_lv = " . $usr_lv);
                    } else {
                        $rtn = ["cd" => "pass", "opt" => "", "perm_lv" => $perm_lv, "usr_lv" => $usr_lv];
                        log_message("INFO", "DC_common -> chk_perm : svc : pass : usr_lv = " . $usr_lv);
                    }
                } else { // 퍼미션 설정값이 없다면
                    if ($usr_lv > 0) {
                        $rtn = ["cd" => "pass", "opt" => "", "perm_lv" => 1, "usr_lv" => $usr_lv];
                        log_message("INFO", "DC_common -> chk_perm : svc : pass : usr_lv = " . $usr_lv);
                    } else {
                        $rtn = ["cd" => "deny", "opt" => "perm", "perm_lv" => 1, "usr_lv" => $usr_lv];
                        log_message("INFO", "DC_common -> chk_perm : svc : deny : usr_lv = " . $usr_lv);
                    }
                }
            }
        }
        if ($rtn['cd'] == "pass") {
            $this->set_common_hstry();
        }
        return $rtn;
    }


    /*
     * -------------------------------------------- index
     *
     * --------------------------------------------------
     */
    public function index()
    {
        $this->pg(array(0 => 'home'));
    }


    /*
     * ----------------------------------------
     * P G : routes에서
     * ----------------------------------------
     * bbs, pg(flex, pg) 분기
     * :config의 func 값으로 판단
     * ----------------------------------------
     */
    public function pg($param = array())
    {
        $this->method = __FUNCTION__;
        if ($param[0]) {
            if ($this->m_id != $param[0]) {
                $param[0] = $this->m_id;
            }


            $_func = $this->config->item('md')['fnc'];
            //echo $_func;
            if ($_func == "bbs") {
                $_mode = 'lists';
                // config에 설정된 mode값이 있다면 적용
                if ($this->config->item('md')['mod']) {
                    $_mode = $this->config->item('md')['mod'];
                }
                $this->{$_mode}($param);

            } else if ($_func == 'flex') { // flex $_func == 'pg'


                // 페이지 기본모드 : view
                $_mode = 'view';
                // config에 설정된 mode값이 있다면 적용
                if ($this->config->item('md')['mod']) {
                    $_mode = $this->config->item('md')['mod'];
                }
                //echo $param[0];
                // 검색
                if($param[0]=='search' && $this->s_fsw){

                    $param[1]= $this->s_res;
                }






                $this->dl_flex->{$param[0]}($param);


                // 권한 체크
                /*
                // 해당 _mode에 대한 접근권한 체크
                $_rtn_perm = $this->chk_perm($_mode);

                if ( $_rtn_perm['cd'] != 'deny' ) {
                    if ($_func == 'flex') { // flex
                        $this->dl_flex->{$param[0]}($param);
                    } else if($_func == 'pg') { // pg
                        if (file_exists($_SERVER['DOCUMENT_ROOT'].'/application/views'.$this->dl_config->get_path_skin().$param[0].".php")) {
                            $this->load->view($this->dl_config->get_path_skin().$param[0]);
                        } else {
                            show_404(":::::::::: DC_common -> pg --> pg - file is not exist ", TRUE);
                        }
                    }
                }else{
                    $this->return_chk( "deny", "", "해당페이지 접근권한이 없습니다.", $this->session->userdata('hstry') );
                }
                */


            } else if ($_func == 'pg') { // pg
                $param_cv = array();
                if ($this->lng_cd == 'en') {
                    $this->load->view($this->dl_config->get_path_skin() . $param[count($param) - 1] . "_" . $this->lng_cd, $param_cv);
                } else {
                    $this->load->view($this->dl_config->get_path_skin() . $param[0]);
                }

            } else {
                //show_404(":::::::::: DC_common -> pg : error - _func is null ", TRUE);
            }

        } else {
            show_404(":::::::::: DC_common -> pg : error - param is null ", TRUE);
        }
    }


    /*
     * ----------------------------------------
     * A D M I N
     * ----------------------------------------
     */
    protected function admin($param = array())
    {
        $this->chk_ip();
        $this->method = __FUNCTION__;
        $this->rtn_perm = $this->chk_perm();

       if ($this->rtn_perm['cd'] == 'pass') {
           if ($param[0]) {
                if($this->usr_id=='nacf5061'||$this->usr_id=='nacf50611'||$this->usr_id=='wtadmin'||$this->usr_id=='17311795'||$this->usr_id=='19312949'||$this->usr_id=='08305788'||$this->usr_id=='21613193') {
                    if($param[0]=='dashboard'){
                        if($this->usr_id=='nacf5061') {
                            redirect('/adm/intnlctrl');
                        } else if($this->usr_id=='nacf50611') {
                            redirect('/adm/finnaccexp');
                        } else if($this->usr_id=='17311795'||$this->usr_id=='19312949'||$this->usr_id=='08305788'||$this->usr_id=='21613193'||$this->usr_id=='wtadmin') {
                            redirect('/adm/prevmnlaun1');
                        }
                    }
                    if ($this->m_id) {
    
                        if ($this->bbs_mod) {
                            $this->{$this->bbs_mod}($param);
                        } else {
                            $this->dl_admin->{$this->m_id}($param);
                        }
                    } else {
                        $this->dl_admin->dashboard($param);
                    }
                }else {
                    if($param[0]=='dashboard'){
                        redirect('/adm/member');
                    }
                    if ($this->m_id) {
    
                        if ($this->bbs_mod) {
                            $this->{$this->bbs_mod}($param);
                        } else {
                            $this->dl_admin->{$this->m_id}($param);
                        }
                    } else {
                        $this->dl_admin->dashboard($param);
                    }

                }
           } else {
               $this->dl_admin->index();
           }
        } else {
           alert('접근권한이 없습니다.', '/index.php');
       }

    }


    /*
     *----------------------------------------
     * C E R T I F I C A T I O N function
     * auth
     *----------------------------------------
    */
    protected function auth($param = array())
    {
        $this->method=__FUNCTION__;
        $this->rtn_perm = $this->chk_perm();
        if($this->rtn_perm['cd'] == 'pass' )
        {
            if($param[0])
            {
                log_message("INFO", ":::::::::: DC_common -> auth : param[0]=".$param[0]);
                $this->dl_auth->{$param[0]}();
            }else{

                $this->dl_auth->index();
            }
        }else{
            alert('접근권한이 없습니다.', '/index.php');
        }
    }



    /*
     *----------------------------------------
     * C V - T Y P E function
     * lists
     *----------------------------------------
    */
    protected function lists($param = array())
    {
        $this->method=__FUNCTION__;
        $this->rtn_perm = $this->chk_perm(__FUNCTION__);
        // if( $this->rtn_perm['cd'] == 'pass' )
        // {
            if($param[0])
            {
                $this->dl_lists->lists_cv($param);
            }else{
                show_404("xox DC_common -> lists : non_param_error", TRUE);
            }
        // }else{
        //     alert('목록열람 권한이 없습니다. \n로그인 해 주세요.', '/index.php');
        // }
    }


    /*
     *----------------------------------------
     * C V - T Y P E function
     * view
     *----------------------------------------
    */
    protected function view($param = array())
    {
        $rtn = $this->chk_kakao_sync();

        $this->method=__FUNCTION__;
        $this->rtn_perm = $this->chk_perm(__FUNCTION__);
        if( $this->rtn_perm['cd'] == 'pass' )
        {
            if($param[0])
            {
                $this->dl_view->view_cv($param);
            }else{
                show_404("xox DC_common -> view : non_param_error", TRUE);
            }
            }else{
            alert('글보기 권한이 없습니다. \n로그인 해 주세요.', '/ko/auth/login');
        }
    }


    /*
     *----------------------------------------
     * C V - T Y P E function
     * write
     *----------------------------------------
    */
    protected function write($param = array())
    {
        $this->method=__FUNCTION__;
        $this->rtn_perm = $this->chk_perm(__FUNCTION__);
        if( $this->rtn_perm['cd'] == 'pass' )
        {
            if($param[0])
            {
                $this->dl_write->write_cv($param);
            }else{
                show_404("xox DC_common -> write : non_param_error", TRUE);
            }
        } else if($this->usr_id=='nacf5061'||$this->usr_id=='nacf50611'||$this->usr_id=='17311795'||$this->usr_id=='19312949'||$this->usr_id=='08305788'||$this->usr_id=='21613193'||$this->usr_id=='wtadmin') {
            if($param[0])
            {
                $this->dl_view->view_cv($param);
            }else{
                show_404("xox DC_common -> view : non_param_error", TRUE);
            }
 
        }else{
            alert('글작성 권한이 없습니다. \n로그인 해 주세요.', '/index.php');
        }
    }


    /*
     *----------------------------------------
     * C V - T Y P E function
     * modify
     *----------------------------------------
    */
    protected function modify($param=array())
    {
        $this->method=__FUNCTION__;
        $this->rtn_perm = $this->chk_perm(__FUNCTION__);
        if( $this->rtn_perm['cd'] == 'pass' )
        {
            if($param[0])
            {
                $this->dl_modify->modify_cv($param);
            }else{
                show_404("xox DC_common -> modify : non_param_error", TRUE);
            }
        }else{
            alert('글수정 권한이 없습니다. \n로그인 해 주세요.', '/index.php');
        }
    }


    /*
     *----------------------------------------
     * C V - T Y P E function
     * reply
     *----------------------------------------
    */
    protected function reply($param=array())
    {
        $this->method=__FUNCTION__;
        $this->rtn_perm = $this->chk_perm(__FUNCTION__);
        if( $this->rtn_perm['cd'] == 'pass' )
        {
            //if($param[0]) {
            $this->dl_reply->reply_cv($param);
            //}else{
            //    show_404("xox DC_common -> reply : non_param_error", TRUE);
            //}
        } else {
            alert('글답변 권한이 없습니다.', '/index.php');
        }
    }



    /*
     *----------------------------------------
     * C M - T Y P E function
     *
     * insert update delete
     *----------------------------------------
    */

    // ***** insert
    protected function insert()
    {
        $this->method=__FUNCTION__;
        $this->rtn_perm = $this->chk_perm("write");
        if( $this->rtn_perm['cd'] == 'pass' )
        {
            $this->dl_insert->cm_insert();
        }else{
            $this->return_chk( "deny", "write", "글등록(insert) 권한이 없습니다.", $this->session->userdata('hstry') );
        }
    }


    // ***** update
    protected function update($param=array())
    {
        $this->method=__FUNCTION__;
        $this->rtn_perm = $this->chk_perm("modify");
        if( $this->rtn_perm['cd'] == 'pass' )
        {
            $this->dl_update->cm_update($param);
        }else{
            $this->return_chk( "deny", "modify", "글수정(update) 권한이 없습니다.", $this->session->userdata('hstry') );
        }
    }


    // ***** delete
    protected function delete($param=array())
    {
        $this->method=__FUNCTION__;
        $this->rtn_perm = $this->chk_perm(__FUNCTION__);
        if( $this->rtn_perm['cd'] == 'pass' )
        {
            $this->dl_delete->delete_cm($param);
        }else{
            log_message("debug", "xox DC_common -> delete -> permission deny ");
            $this->return_chk("deny", __FUNCTION__, "글삭제 권한이 없습니다.", $this->session->userdata('hstry') );
        }
    }


    // ***** dnload
    protected function dnload($param=array())
    {
        $this->method=__FUNCTION__;
        $this->rtn_perm = $this->chk_perm(__FUNCTION__);
        if( $this->rtn_perm['cd'] == 'pass' )
        {
            $this->dl_file->dnload_cm($param);
        }else{
            log_message("debug", "xox DC_common -> dnload -> permission deny ");
            $this->return_chk( "deny", __FUNCTION__, "다운로드 권한이 없습니다.", $this->session->userdata('hstry') );
        }
    }


/*
 * ======================================================================
 *
 *                   P U B L I C - F U N C T I O N
 *
 * ======================================================================
 */

    /*
     * --------------------------------------------------
     * get_val
     * --------------------------------------------------
     */
    public function get_val($_str)
    {
        $rtn = false;
        if (isset($this->{$_str})) {
            $rtn=$this->{$_str};
        } else {
            //log_message("DEBUG", "DC_common -> get_val : 존재하지 않는 값 요청 : _str = ".$_str);
        }
        return $rtn;
    }

    // ***** get : svc_mod
    public function get_svc_mod()
    {
        return $this->svc_mod;
    }

    // *****
    public function get_cfg_file_upload()
    {
        return $this->cfg_file_upload;
    }

    //
    public function get_cfg_file_resize()
    {
        return $this->cfg_file_resize;
    }



    /*
     * --------------------------------------------------
     * get_param_header
     * --------------------------------------------------
     */
    public function get_param_header()
    {
        $this->param_header = array(
            'svc_mod'       => $this->get_val('svc_mod')
            ,'seg'          => $this->get_val('seg')
            ,'g_id'         => $this->get_val('g_id')
            ,'m_id'         => $this->get_val('m_id')
            ,'idx'          => $this->get_val('p_idx')
            ,'cat'          => $this->get_val('p_cat')
            ,'opt'          => $this->get_val('p_opt')
            ,'nav_tree'     => $this->get_val('nav_tree')
            ,'pg_tit'       => $this->get_val('pg_tit')
            ,'grp_tit'      => $this->get_val('grp_tit')
            ,'gd_arr'       => $this->get_val('gd_arr')
            ,'gd_idx'       => $this->get_val('gd_idx')
            ,'lng_cd'       => $this->get_val('lng_cd')
            ,'lng_idx'      => $this->get_val('lng_idx')
            ,'bbs_mod'      => $this->get_val('bbs_mod')
            ,'bbs_perm'     => $this->get_val('bbs_perm')
            ,'fnc_typ'      => $this->get_val('fnc_typ')
            ,'lng_arr'      => $this->get_val('lng_arr')
            ,'lng_mode_yn'  => $this->get_val('lng_mode_yn')
            ,'usr_arr'      => $this->get_val('usr_arr')
            ,'usr_lv'       => $this->get_val('usr_lv')
            ,'base_url'     => $this->get_val('base_url')
            ,'file_upload_dir'=> $this->file_upload_dir
            ,'form_arr'     => $this->get_val('form_arr')
            ,'is_login'     => $this->get_val('is_login')
            ,'is_admin'     => $this->get_val('is_admin')
            ,'is_adm_mod'   => $this->get_val('is_adm_mod')
            ,'is_mng_mod'   => $this->get_val('is_mng_mod')
            ,'edtr'         => $this->get_val('edtr')
            ,'breadcrumb'   => $this->get_val('breadcrumb')

            ,'initial'      => $this->get_val('initial')
            ,'s_cat'        => $this->get_val('s_cat')
            ,'s_sds'        => $this->get_val('s_sds')
            ,'s_sde'        => $this->get_val('s_sde')
            ,'s_fsw'        => $this->get_val('s_fsw')
            ,'s_lng'        => $this->get_val('s_lng')
            ,'s_fld'        => $this->get_val('s_fld')
            ,'s_typ'        => $this->get_val('s_typ')
            ,'s_subj'        => $this->get_val('s_subj')
            ,'s_cont'        => $this->get_val('s_cont')
            ,'post_cat'        => $this->get_val('post_cat')
            ,'usr_nm'        => $this->get_val('usr_nm')
            ,'sanc'        => $this->get_val('sanc')
            ,'post_sanc'        => $this->get_val('post_sanc')

            ,'code'         => $this->get_val('code')
            ,'s_res'        => $this->get_val('s_res')
            ,'s_tot'        => $this->get_val('s_tot')

            ,'kw_lists'     => $this->get_val('kw_lists')
        );
        return $this->param_header;
    }

    // *****
    public function set_cfg_file_upload($_arr)
    {
        $this->cfg_file_upload = $_arr;
    }

    // *****
    public function set_cfg_file_resize($_arr)
    {
        $this->cfg_file_resize = $_arr;
    }

    // *****
    public function get_breadcrumb()
    {
        return $this->cur_breadcrumb;
    }

    // ***** breadcrumb
    protected function set_breadcrumb($_arr)
    {
        $html_in = "";
        if(count($_arr)){
            $html_in .= '<span class="uk-text-right">';
            $html_in .= '<ul class="uk-breadcrumb uk-margin-remove-bottom">';
            //$html_in .= '<li><a href="/'.$this->lng_cd.'/">Home</a></li>';
            for($i=0; $i<count($_arr); $i++){
                $html_in .= '<li ';
                if($i == count($_arr)-1){ $html_in .= 'class="uk-disabled"'; }

                $html_in .= '><a href="/'.$this->seg;

                $html_in .= '/'.$_arr[$i]['id'];

                $html_in .= '">';
                if($_arr[$i]['id']=='prevmnlaun1') {
                    $html_in .= '국내동향&주요이슈';
                } else if($_arr[$i]['id']=='prevmnlaun2') {
                    $html_in .= '해외동향&Sanctions';
                } else {
                    $html_in .= $_arr[$i]['tit'][$this->lng_idx];
                }
                $html_in .= '</a></li>';
            }
            $html_in .= '</ul>';
            $html_in .= '</span>';
        }
        $this->cur_breadcrumb = $html_in;
    }

    public function chk_ip(){
        $rtn = false;
        if($_SERVER["REMOTE_ADDR"]=='1.255.77.102' ||$_SERVER["REMOTE_ADDR"]=='223.26.222.72' ||$_SERVER["REMOTE_ADDR"]=='121.170.124.236' ||$_SERVER["REMOTE_ADDR"]=='183.111.174.96'|| $_SERVER["REMOTE_ADDR"]=='192.168.219.104'||$_SERVER["REMOTE_ADDR"]=='210.91.190.155' || $_SERVER["REMOTE_ADDR"]=='223.38.81.134' || $_SERVER["REMOTE_ADDR"]=='221.162.119.225'|| $_SERVER["REMOTE_ADDR"]=='121.170.124.236' || $_SERVER["REMOTE_ADDR"]=='1.231.30.68'|| $_SERVER["REMOTE_ADDR"]=='1.230.201.166'||$_SERVER["REMOTE_ADDR"]=='1.230.201.157' || $_SERVER["REMOTE_ADDR"]=='1.230.201.152' || $_SERVER["REMOTE_ADDR"]=='1.230.201.96'|| $_SERVER["REMOTE_ADDR"]=='1.230.201.102'|| $_SERVER["REMOTE_ADDR"]=='211.36.145.240'){
            $rtn = true;
        }else{
           alert('허용되지 않은 접속입니다.', '/index.php');
        }
        return $rtn;
    }


}