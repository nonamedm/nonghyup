<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DL_admin
{
    // view 관련
    public $idx; // 포스트 idx

    // 페이지네이션 관련
    public $li_st = 0; // ***** -------------------- ??
    public $li_num = 15; // 목록 출력수
    public $pg_idx = 1; // 페이지 idx

    // ***** 정렬기준
    public $orderBy = " idx DESC, crt_dtms DESC ";

    // ***** 검색관련
    public $sch_wrd = "";

    // ***** 목록 유형
    public $lists_mode = "lists"; // lists, grid

    // ***** 공동응모 수 (공모전)
    public $usr_add_cnt = 0;



    // ***** 추가
    public $upload_files_num; // 첨부파일 수
    public $grid_col; // 그리드 수

    protected $CI;
    public function __construct()
    {
        $this->CI =& get_instance();
        log_message("info", "Load library -> DL_admin ");
    }


    /*
    ----------------------------------------
     I N D E X
    ----------------------------------------
    */
    public function index()
    {
        //$this->dashboard();
        //echo "Index";
        redirect('/adm/mamber');
    }


    /*
    ----------------------------------------
     D A S H B O A R D
    ----------------------------------------
     notice
    ----------------------------------------
    */
    public function dashboard($param)
    {
        $this->CI->load->database();

        /*
        ----------------------------------------
         화면출력을 위한 설정
        ----------------------------------------
        */
        // 페이지네이션 관련

        // 페이지 idx
        if($this->CI->get_val('pg_idx')){
            $this->pg_idx = $this->CI->get_val('pg_idx');
        }

        $this->vod_mode = $this->CI->get_val('vod_mode');

        $this->lng_cd = $this->CI->get_val('lng_cd');
        $this->seg = $this->CI->get_val('seg');

        $this->upload_files_num = $this->CI->get_val('upload_files_num'); // 첨부파일 수


// ***** grid_col
        $this->grid_col = 3;
        if($this->CI->get_val('grid_col')){
            $this->grid_col = $this->CI->get_val('grid_col');
        }

// ***** li_num
        $this->li_num = 15;
        if($this->CI->get_val('li_num')){
            $this->li_num=$this->CI->get_val('li_num');
        }

// *****  pg_idx (limit start)
        if( $this->pg_idx ){
            $this->li_st = ($this->pg_idx - 1) * $this->li_num;
        }

// ***** search
        $this->s_word = $this->CI->get_val('s_word');

// ***** Order


        $pg_idx = $this->CI->get_val('pg_idx');
        if(!$pg_idx){
            $pg_idx = $this->pg_idx;
        }


        // ***** DB값 요청
        $param_cm = array(
            'tb_id'     => $this->CI->config->item("md")['tbl'],
            'order'     => $this->orderBy,
            'lng_cd'    => $this->lng_cd,
            'li_st'     => $this->li_st,
            'li_num'    => $this->li_num
        );


        if($this->CI->get_val('is_admin'))
        {
            // 관리자라면
        }else{
            // 관리자가 아닌 경우만 언어구분 사용인 경우 추가
            if($this->CI->get_val('lng_mode_yn')){
                // 언어가 하나 이상인 경우
                //if( $this->CI->lng_cnt>1 ){
                $param_cm['post_lng'] = $this->lng_cd;
                //}
            }
        }

        $param_cv = array();
        /*
        $param_cm=array(
            'tb_id'         => 'ct_usr'
            ,'usr_status'    => 'Y'
            ,'usr_typ'       => 10
        );
        $usr_total = $this->CI->DM_basic->getList_count($param_cm);

        //$param_cm['usr_status']='1';
        $usr_lists = $this->CI->DM_basic->getList($param_cm);

        $param_cv['usr_total']=$usr_total;
        $param_cv['usr_lists']=$usr_lists;
        */



        //var_dump($usr_lists);




        $this->CI->load->view( $this->CI->dl_config->get_path_skin().$param[count($param)-1], $param_cv );
        //}
    }
}