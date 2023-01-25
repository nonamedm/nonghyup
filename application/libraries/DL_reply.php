<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| DL_reply : 게시판 답글 쓰기 라이브러리
|--------------------------------------------------------------------------
|
|
|
*/

class DL_reply
{
    // *****
    public $idx;
    public $pg;
    public $fl;

    public $use_lng="";
    public $use_pw="";
    public $auth_pw="";

    // *****
    public $upload_url = "";

    // *****
    public $upload_files_num = null;

    // *****
    public $usr_arr = array();




    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        log_message("info", "Load library -> DL_reply ");

        $this->svc_mod = $this->CI->get_val('svc_mod');
        // *****
        $this->upload_url = '/static/data/'.$this->CI->get_val('m_id').'/';

    }


    /*
     *----------------------------------------
     * C V - R E P L Y
     *----------------------------------------
    */
    public function reply_cv($param)
    {
        if (count($param)) {

            /*
             *----------------------------------------
             * CM : Controller -> Model
             *----------------------------------------
            */

            // *****
            $this->idx      = $this->CI->get_val('p_idx');
            $this->pg       = $this->CI->get_val('pg_idx');
            $this->fl       = $this->CI->get_val('fl_idx');
            $m_id           = $this->CI->get_val('m_id');

            // lng, pw
            $this->use_lng  = $this->CI->get_val('use_lng');
            $this->use_pw   = $this->CI->get_val('use_pw');
            $this->auth_pw  = $this->CI->get_val('usr_pw');

            // ***** usr_arr
            $this->usr_arr  = $this->CI->get_val('usr_arr');

            // ***** file num
            $this->upload_files_num     = $this->CI->get_val('upload_files_num');


            /*
             *----------------------------------------
             * CV : Controller -> view
             *----------------------------------------
            */
            // ***** DB값 요청
            $param_cm = array(
                'tb_id' => $this->CI->config->item("md")['tbl'],
                'idx' => $this->idx
            );
            $res = $this->CI->DM_basic->getView($param_cm);
//print_r($res);
            //$fileStr = $res['files'];
            //var_dump($fileStr);
            //if($fileStr)
            //{
            //    $tmp_arr = explode( "^^~", $fileStr );
            //    if(count( $tmp_arr ))
            //    {
            //        for($i=0; $i<count($tmp_arr); $i++)
            //        {
            //            if($tmp_arr[$i]){
            //                $tmp_files_arr[$i] = explode("|", $tmp_arr[$i]);
            //            }
            //        }
            //    }
            //    $res['files'] = $tmp_files_arr;
            //
            //    // ***** chk dnld
            //}
            //print_r($res['files']);


            // ***** F I L E - N A M E
            //$file_name = $this->CI->dl_file->get_file_name( $res['files'], $this->upload_files_num, $this->idx, $m_id );

            // ***** F I L E - V I E W (image 인 경우만)
            //$file_view = $this->CI->dl_file->get_file_view( $res['files'], $this->upload_files_num, $this->idx, $m_id );



            /*
             *----------------------------------------
             * CV : Controller -> Reply
             *----------------------------------------
            */
            $param_cv = array(
                'view'              =>$res
                ,'lng_cd'           =>$this->CI->get_val('lng_cd')
                ,'bbs_mode'         =>'reply'
                ,'lng_cnt'          =>$this->CI->get_val('lng_cnt')
                ,'m_id'             =>$this->CI->get_val('m_id')
                ,'idx'              =>$this->idx
                ,'pg'               =>$this->pg
                ,'fl'               =>$this->fl
                    //,'file_name'        =>$file_name
                    //,'file_view'        =>$file_view
                ,'tb_id'            =>$this->CI->config->item("md")['tbl']
                ,'upload_url'       =>$this->upload_url
                ,'upload_files_num' =>$this->upload_files_num
                ,'use_pw'           =>$this->use_pw
                ,'auth_pw'          =>$this->auth_pw
                ,'use_lng'          =>$this->use_lng
                ,'usr'              =>$this->usr_arr

                ,'lists_perm'       =>$this->CI->chk_perm('lists')
                ,'view_perm'        =>$this->CI->chk_perm('view')
                ,'write_perm'       =>$this->CI->chk_perm('write')
                ,'modify_perm'      =>$this->CI->chk_perm('modify')
                ,'reply_perm'       =>$this->CI->chk_perm('reply')
                ,'delete_perm'      =>$this->CI->chk_perm('delete')
                ,'dnload_perm'      =>$this->CI->chk_perm('dnload')
            );


            // ***** cv
            $this->CI->load->view($this->svc_mod.'/cont_block_start');
            $this->CI->load->view($this->CI->dl_config->get_path_skin().'reply_cv', $param_cv);
            $this->CI->load->view($this->svc_mod.'/cont_block_end');
        }else{
            $this->CI->session->set_flashdata('message', 'ERROR : 접근권한이 없습니다.', 'refresh');
            redirect('/');
        }
    }
}
?>