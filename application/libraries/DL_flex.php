<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
-------------------------------------------------------------------------
 DL_flex : 사용자 서비스영역 공통함수
-------------------------------------------------------------------------
 index -> home
 preopen
 home
 mypage
-------------------------------------------------------------------------
 프로젝트별 페이지구성
-------------------------------------------------------------------------
*/

class DL_flex
{
    // *****
    public $li_st = 0;

    // *****
    public $li_num = 5;

    // ***** 정렬기준
    public $orderBy = " crt_dtms DESC ";

    public $res_lists = array();

    public $home_visual = "";

    public $cat;


    public $svc_mod;


    protected $CI;
    public function __construct()
    {
        $this->CI =& get_instance();

        $this->svc_mod = $this->CI->get_val('svc_mod');
    }


    /*
    ----------------------------------------
     I N D E X
     index -> home
    ----------------------------------------
    */
    public function index( $param=array() )
    {
        $this->home( $param );
    }



    /*
    ----------------------------------------
     P R E - O P E N
    ----------------------------------------
     사전오픈 페이지
    ----------------------------------------
    */
    public function preopen( $param=array() )
    {
        //echo "preopen";
        if( count($param) )
        {
            // *****
            $param_cv['lng_cd']=$this->CI->lng_cd;
            $param_cv['mod']=$param[0];
            //print_r($param_cv);
            //$this->CI->load->view($this->CI->dl_cfg->get_path_skin().$param[count($param)-1], $param_cv);
            $this->CI->load->view( $this->CI->dl_cfg->get_path_skin()."preopen_".$this->CI->lng_cd, $param_cv );
        }
    }



    /*
    ----------------------------------------
     H O M E
    ----------------------------------------
     notice
    ----------------------------------------
    */
    public function home( $param=array() )
    {
        if( count($param) )
        {
            // *****
            //echo "home";
            $this->lng_cd =             $this->CI->get_val('lng_cd');
            $this->seg =                $this->CI->get_val('seg');
            $this->m_id =               $this->CI->get_val('m_id');

            $this->is_admin =           $this->CI->get_val('is_admin');
            $this->is_manager =         $this->CI->get_val('is_manager');
            $this->is_login =           $this->CI->get_val('is_login');

            $this->usr_arr =            $this->CI->get_val('usr_arr');

            $this->pg_idx =             $this->CI->get_val('pg_idx');
            $this->p_cat =              $this->CI->get_val('p_cat');
            $this->usr_idx =            $this->CI->get_val('usr_idx');


            // *****
            $brief_cm = array(
                'tb_id'     => 'ct_brief',
                'order'     => $this->orderBy,
                'li_st'     => $this->li_st,
                'li_num'    => 4
            );
            $this->lists_brief = $this->CI->DM_basic->getList($brief_cm);
            $param_cv['lists_brief']=$this->lists_brief;

            // *****
            $lawmaking_cm = array(
                'tb_id'     => 'ct_lawmaking',
                'order'     => $this->orderBy,
                'li_st'     => $this->li_st,
                'li_num'    => 4
            );
            $this->lists_lawmaking = $this->CI->DM_basic->getList($lawmaking_cm);
            $param_cv['lists_lawmaking']=$this->lists_lawmaking;

            // *****
            $pr_cm = array(
                'tb_id'     => 'ct_pr',
                'order'     => $this->orderBy,
                'li_st'     => $this->li_st,
                'li_num'    => 4
            );
            $this->lists_pr = $this->CI->DM_basic->getList($pr_cm);
            $param_cv['lists_pr']=$this->lists_pr;

            // *****
            $labdata_cm = array(
                'tb_id'     => 'ct_labdata',
                'order'     => $this->orderBy,
                'li_st'     => $this->li_st,
                'li_num'    => 4
            );
            $this->lists_labdata = $this->CI->DM_basic->getList($labdata_cm);
            $param_cv['lists_labdata']=$this->lists_labdata;



            $this->CI->load->view($this->CI->dl_config->get_path_skin().$param[count($param)-1], $param_cv);
        }
    }


    /*
    ----------------------------------------
     M Y P A G E
    ----------------------------------------
    */
    public function mypage($param = array())
    {
        $this->info( $param );
    }


    /*
    ----------------------------------------
     M Y P A G E
    ----------------------------------------
    */
    public function info($param = array())
    {
        if($this->CI->session->userdata('is_login'))
        {
            log_message("INFO", "oooo DL_auth -> mypage : 1");
            /** DB값 요청 */


            if(!$this->CI->get_usr('usr_id'))
            {
                log_message("INFO", "oooo DL_auth -> mypage : 2");
                $this->CI->session->set_flashdata('message', 'The wrong approach. Please log in again.');
                //$this->CI->session->sess_destroy();
                redirect($this->CI->dl_cfg->get_path_rtn( array('m_id'=>'login') ));
            }

            // 회원 정보
            $param_cm = array(
                'tb_id' => 'ct_usr',
                'usr_id' => $this->CI->get_usr('usr_id')
            );
            $this->usr_arr=$this->CI->DM_basic->getByUid($param_cm);

            if($this->usr_arr['usr_typ']!=10){
                $this->CI->load->library('encryption');
                $enc_key = $this->CI->DM_basic->get_enc_key(array('key_id'=> 'enc_key'));
                $this->CI->encryption->initialize(
                    array(
                        'key' => $enc_key['key_val']
                    )
                );

                $this->usr_arr['usr_nm'] = $this->CI->encryption->decrypt($this->usr_arr['usr_nm']);
                $this->usr_arr['usr_email'] = $this->CI->encryption->decrypt($this->usr_arr['usr_email']);
            }


            //$this->usr_arr=$this->CI->get_arr("usr_arr");

            // *****
            $improvement_cm = array(
                'tb_id'     => 'ct_improvement'
                ,'usr_id'     => $this->usr_arr['usr_id'],
                'li_st'     => $this->li_st,
                'li_num'    => 10
            );
            $lists_improvement = $this->CI->DM_basic->getList($improvement_cm);


            $qna_cm = array(
                'tb_id'     => 'ct_qna'
                ,'usr_id'     => $this->usr_arr['usr_id'],
                'li_st'     => $this->li_st,
                'li_num'    => 10
            );
            $lists_qna = $this->CI->DM_basic->getList($qna_cm);




            $param_cv = array(
                'usr_arr'          => $this->usr_arr
                ,'lists_improvement'     => $lists_improvement
                ,'lists_qna'    => $lists_qna
                //,'form_arr'         =>$form_arr
                //,'view'             =>$this->usr_arr
                //,'file_name'        =>$file_name
                //,'file_view'        =>$file_view
                //,'bbs_mode'         =>'view'
                //,'usr_query'        =>$this->usr_query
                //,'usr_dnload_gl'    =>$usr_dnload_gl
                //,'usr_dnload_mt'    =>$usr_dnload_mt
                //,'usr_dnload_qa'    =>$usr_dnload_qa
                //,'usr_dnload_form'  =>$usr_dnload_form
                //,'usr_dnload_etc'   =>$usr_dnload_etc
            );

            //$this->CI->load->view($this->svc_mod.'/cont_block_start');
            $this->CI->load->view($this->CI->dl_config->get_path_skin().'mypage', $param_cv);
            //$this->CI->load->view($this->svc_mod.'/cont_block_end');

        }else{
            log_message("INFO", "oooo DL_auth -> mypage : 5");
            alert('세션이 종료되었습니다. 다시 로그인 해주세요.', '/ko/auth/login');
            //$this->CI->session->set_flashdata('message', 'Please Login.');
            //redirect($this->CI->dl_config->get_path_rtn( array('m_id'=>'login') ));
        }

    }


    /*
    ----------------------------------------
     withdrawal
    ----------------------------------------
    */
    public function withdrawal($param = array())
    {
        if($this->CI->session->userdata('is_login')) {
            $param_cv = array(
                //'usr_arr'          => $this->usr_arr
            );
            $this->CI->load->view($this->CI->dl_config->get_path_skin().'withdrawal', $param_cv);
        } else {
            alert('인증되지 않은 접근입니다. 로그인 해주세요.', '/ko/aoth/login');
        }
    }




    /*
    ----------------------------------------
     S E A R C H
    ----------------------------------------
    */
    public function search($param = array()){
        if( count($param) )
        {
            $this->lng_cd =             $this->CI->get_val('lng_cd');
            $this->seg =                $this->CI->get_val('seg');
            $this->m_id =               $this->CI->get_val('m_id');

            $this->is_admin =           $this->CI->get_val('is_admin');
            $this->is_manager =         $this->CI->get_val('is_manager');
            $this->is_login =           $this->CI->get_val('is_login');

            $this->usr_arr =            $this->CI->get_val('usr_arr');

            $this->pg_idx =             $this->CI->get_val('pg_idx');
            $this->p_cat =              $this->CI->get_val('p_cat');
            $this->usr_idx =            $this->CI->get_val('usr_idx');
            $this->s_fsw =              $this->CI->get_val('s_fsw');
            $this->s_rfsw =             $this->CI->get_val('s_rfsw');
            $this->s_sds =              $this->CI->get_val('s_sds');
            $this->s_sde =              $this->CI->get_val('s_sde');
            //$this->s_word =             '111';
            // *****


            //print_r($result);
            //if($this->s_word){
            //    $param_cm['s_word'] = $this->s_word;
            //}
            //
            $param_cv['result'] = $param[1];
            //$param_cv['lists']=$this->res_lists;
            //$param_cv['lng_cd']=$this->lng_cd;

            //$param_cv['s_word'] = $this->s_word;
            //print_r($param_cv);

            //$this->CI->load->view($this->svc_mod.'/cont_block_start');
            $this->CI->load->view($this->CI->dl_config->get_path_skin().'search', $param_cv);
            //$this->CI->load->view($this->svc_mod.'/cont_block_end');
        }
    }

}
?>