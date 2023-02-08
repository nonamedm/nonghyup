<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DL_lists
{
    // *****
    public $li_st = 0;

    public $initial = "";

    // *****
    public $li_num = 15;

    // *****
    public $idx;
    public $pg_idx = 1;

    // ***** 정렬기준
    public $ord = "DESC";
    public $orderBy = " crt_dtms DESC ";

    // ***** 검색
    public $s_word = "";
    public $lists_mode = "";
    public $s_sds = '';
    public $s_sde = '';

    public $usr_add_cnt = 0;

    public $svc_mod;
    public $is_admin;
    public $is_manager;
    public $is_login;



    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();

        $this->svc_mod = $this->CI->get_val('svc_mod');
    }



    /*
     * ****************************************
     * C V - L I S T
     * ****************************************
     */
    public function lists_cv($param)
    {
        if(count($param)) {

            $this->CI->load->database();
            /*
             *----------------------------------------
             * CM : Controller -> Model
             *
             * LIMIT li_st, li_num
             *----------------------------------------
            */

            // *****
            $this->lng_cd =             $this->CI->get_val('lng_cd');
            $this->seg =                $this->CI->get_val('seg');
            $this->m_id =               $this->CI->get_val('m_id');

            $this->is_admin =           $this->CI->get_val('is_admin');
            $this->is_manager =         $this->CI->get_val('is_manager');
            $this->is_login =           $this->CI->get_val('is_login');

            $this->usr_arr =            $this->CI->get_val('usr_arr');
            $this->usr_status =         $this->CI->get_val('usr_status');

            $this->pg_idx =             $this->CI->get_val('pg_idx');
            $this->usr_idx =            $this->CI->get_val('usr_idx');
            $this->p_cat =              $this->CI->get_val('p_cat');
            $this->p_opt =              $this->CI->get_val('p_opt');
            $this->p_ord =              $this->CI->get_val('p_ord');


            // ***** file num
            $this->upload_files_num =   $this->CI->get_val('upload_files_num');

            // ***** search
            $this->s_cat =              $this->CI->get_val('s_cat');
            $this->initial =            $this->CI->get_val('initial');
            $this->s_word =             $this->CI->get_val('s_word');
            $this->s_sds =              $this->CI->get_val('s_sds');
            $this->s_sde =              $this->CI->get_val('s_sde');
            $this->s_lng =              $this->CI->get_val('s_lng');
            $this->s_fld =              $this->CI->get_val('s_fld');
            $this->s_typ =              $this->CI->get_val('s_typ');
            // ***** grid col num
            $grid_col = 3;

            // ***** limit num

            // ***** limit start
            if ($this->pg_idx) {
                $this->li_st = ($this->pg_idx - 1) * $this->li_num;
            }

            


            //echo $this->s_word;
            // ***** Order





            //echo $this->p_ord;
            if($this->p_ord){
                $this->orderBy = " crt_dtms ".$this->p_ord." ";
            }


            /*
             * ------------------------------
             *
             * ------------------------------
            */
            // ***** DB값 요청
            $param_cm = array(
                'tb_id'     => $this->CI->config->item("md")['tbl'],
                'order'     => $this->orderBy,
                //'post_lng'   => $this->lng_cd,
                'li_st'     => $this->li_st,
                'li_num'    => $this->li_num,
                'initial'    => $this->initial
            );

            //print_r($param_cm);

            /*
            ----------------------------------------
            검색모드
            ----------------------------------------
            */
            if ($this->s_word) {

                $param_cm['s_word'] = $this->s_word;

                //$this->lists_mode = 'sch';
                $param_cm['s_trgt_arr']=array('post_subj', 'post_cont', 'post_keyword');

                $param_cm['s_sds'] = $this->s_sds;
                $param_cm['s_sde'] = $this->s_sde;
            }


            if ($this->m_id=='current')
            {
                if(!$this->p_cat){
                    $this->p_cat='common';
                }

                if($this->s_word){
                    $param_cm['post_cat'] = '';
                }else{
                    $param_cm['post_cat'] = $this->p_cat;
                }




                //$param_cm['post_opt'] = $this->p_opt;
                $param_cm['order'] = " post_subj ASC ";

            } else if ($this->m_id=='precedent') {
                $param_cm['s_cat'] = $this->s_cat;
                $param_cm['s_sds'] = $this->s_sds;
                $param_cm['s_sde'] = $this->s_sde;
                $param_cm['s_lng'] = $this->s_lng;
                $param_cm['s_fld'] = $this->s_fld;
                $param_cm['s_typ'] = $this->s_typ;
            }

            if ($this->m_id=='translate' || $this->m_id=='noaction') {
                $param_cm['order'] = " post_dtms ".$this->p_ord.",  crt_dtms ".$this->p_ord." ";
            }else if($this->m_id=='precedent'){
                $param_cm['order'] = " post_dtms ".$this->p_ord." ";
            }


            $res_lists = array();


            //echo $this->svc_mod;
            if ($this->svc_mod=='adm') // adm
            {
                if ($this->CI->config->item("md")['fld']=="usr")
                { // 회원
                    $param_cm['order'] = " idx DESC, crt_dtms DESC ";
                    $param_cm['usr_typ'] = 10;
                    if ($this->m_id=='usr') {
                        $param_cm['usr_status'] = 1;
                    } else if($this->m_id=='dormant') {
                        $param_cm['usr_status'] = 2;
                    } else if($this->m_id=='accessDeny') {
                        $param_cm['usr_status'] = 3;
                    }

                    if (isset($param_cm['s_word']) && $param_cm['s_word']) {
                        $param_cm['s_word_hash'] = hash('sha512', md5($param_cm['s_word']));
                    }

                    if($this->p_ord){
                        if ($this->p_ord=="ASC"){
                            $param_cm['order'] = ' usr_last_login_dtms DESC ';
                        }else if($this->p_ord=="DESC"){
                            $param_cm['order'] = ' crt_dtms DESC ';
                        }
                    }else{
                        $param_cm['order'] = ' idx DESC, crt_dtms DESC ';
                    }

//print_r($param_cm);
                    $res_lists = $this->CI->DM_basic->getList($param_cm);

                    $this->CI->load->library('encryption');
                    $enc_key = $this->CI->DM_basic->get_enc_key(array('key_id'=> 'enc_key'));
                    $this->CI->encryption->initialize(
                        array(
                            'key' => $enc_key['key_val']
                        )
                    );

                    for($i=0; $i<count($res_lists); $i++){
                        if($res_lists[$i]['usr_typ']!=10){
                            $res_lists[$i]['usr_nm'] = $this->CI->encryption->decrypt($res_lists[$i]['usr_nm']);
                            $res_lists[$i]['usr_email'] = $this->CI->encryption->decrypt($res_lists[$i]['usr_email']);
                        }
                    }
                    $lists_total = $this->CI->DM_basic->getList_count($param_cm);
//print_r($res_lists);
//print_r($lists_total);
                }
                else if ($this->CI->config->item("md")['fld']=="qna") // qna
                {
                    $param_cm['order'] = ' `trgt_idx` DESC, `ord` ASC ';
                    $res_lists = $this->CI->DM_basic->getList($param_cm);
                    $lists_total = $this->CI->DM_basic->getList_count($param_cm);
                }
                else
                {
                    $res_lists = $this->CI->DM_basic->getList($param_cm);
                    $lists_total = $this->CI->DM_basic->getList_count($param_cm);
                }
//echo count($res_lists);
//echo $lists_total;
            }
            else // svc
            {
                if($this->CI->config->item("md")['fld']=="qna")
                {
                    $param_cm['usr_id'] = $this->usr_arr['usr_id'];
                    $param_cm['order'] = ' `trgt_idx` DESC,`ord` ASC ';
                    $res_lists = $this->CI->DM_basic->getList_qna($param_cm);
                    $lists_total = $this->CI->DM_basic->getList_count($param_cm);
//echo count($res_lists);
//echo $lists_total;
                }else{



                    $res_lists = $this->CI->DM_basic->getList($param_cm);
                    $lists_total = $this->CI->DM_basic->getList_count($param_cm);
                }
//print_r($param_cm);


            }
            //echo $lists_total;



            /*
             *----------------------------------------
             * CV : Controller -> View
             *----------------------------------------
            */

            // ***** pagination
            if(count($res_lists))
            {
                // *****
                $this->CI->load->library('Pagination');

                // ***** pg_config
                $pg_config['base_url'] = '/'.$this->seg.'/'.$this->m_id.'/lists';
                $pg_config['reuse_query_string'] = true;
                $pg_config['page_query_string'] = true;
                $pg_config['use_page_numbers'] = true;
                $pg_config['query_string_segment'] = 'pg';
                $pg_config['query_string_segment_initial'] = 'initial';
                $pg_config['total_rows'] = $lists_total;
                $pg_config['pg'] = $this->pg_idx;
                $pg_config['per_page'] = $this->li_num;
                $pg_config['num_links'] = 10;
                $pg_config['full_tag_open'] = '<ul class="uk-pagination uk-flex-center uk-padding" uk-margin>';
                $pg_config['full_tag_close'] = '</ul>';
                $pg_config['cur_tag_open'] = '<li class="pn uk-active">';
                $pg_config['cur_tag_close'] = '</li>';
                $pg_config['num_tag_open'] = '<li class="pn">';
                $pg_config['num_tag_close'] = '</li>';
                $pg_config['next_tag_open'] = '<span class="next_btn">';
                $pg_config['next_tag_close'] = '</span>';
                $pg_config['prev_tag_open'] = '<span class="prev_btn">';
                $pg_config['prev_tag_close'] = '</span>';

                $pg_config['next_link'] = '<img src="/static/svg/btn_next_active.svg" alt="다음">';
                $pg_config['prev_link'] = '<img src="/static/svg/btn_prev_active.svg" alt="이전">';

                $this->CI->pagination->initialize($pg_config);
            }


            $param_cv = array(
                'lists'         =>$res_lists
                ,'li_idx'       =>$lists_total-$this->li_st
                ,'grid_col'     =>$grid_col
                ,'write_perm'   =>$this->CI->chk_perm('write')
                ,'modify_perm'  =>$this->CI->chk_perm('modify')
                ,'lists_mode'   =>$this->lists_mode
                ,'s_word'       =>$this->s_word
                ,'s_cat'        =>$this->s_cat
                ,'s_sds'        =>$this->s_sds
                ,'s_sde'        =>$this->s_sde
                ,'s_lng'        =>$this->s_lng
                ,'s_fld'        =>$this->s_fld
                ,'s_typ'        =>$this->s_typ
                ,'idx'          =>''
                ,'pg'           =>$this->pg_idx
                ,'cat'          =>$this->p_cat
                ,'m_id'         =>$this->m_id
            );



            // ***** lists
            $this->CI->load->view($this->svc_mod.'/cont_block_start');
            $this->CI->load->view($this->CI->dl_config->get_path_skin().'lists_cv', $param_cv);
            $this->CI->load->view($this->svc_mod.'/cont_block_end');
        }
        else
        {
            $this->CI->session->set_flashdata('message', 'ERROR : 접근권한이 없습니다.', 'refresh');
            redirect('/');
        }
    }
}