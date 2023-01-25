<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DL_modify
{
    // *****
    public $upload_url = "";

    // *****
    public $upload_files_num = null;

    // *****
    public $usr_arr = array();

    public $idx;
    public $pg;


    public $svc_mod;


    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();

        // *****
        $this->svc_mod = $this->CI->get_val('svc_mod');
        $this->upload_url = '/static/data/'.$this->CI->get_val('m_id').'/';
    }



    /*
     * ****************************************
     * C V - M O D I F Y
     * ****************************************
     */
    public function modify_cv($param)
    {
        if(count($param))
        {

            $this->CI->load->database();
            /*
             *----------------------------------------
             * CM : Controller -> Model
             *----------------------------------------
            */

            // *****
            $this->idx = $this->CI->get_val('p_idx');
            $this->pg = $this->CI->get_val('pg_idx');
            $this->upload_files_num = $this->CI->get_val('upload_files_num');

            $this->usr_arr = $this->CI->get_val('usr_arr');

            // ***** DB값 요청
            $param_cm = array(
                'tb_id' => $this->CI->config->item("md")['tbl'],
                'idx' => $this->idx
            );
            $res = $this->CI->DM_basic->getView($param_cm);
            //print_r($res);
            //echo $res['usr_nm'];

            // ***** usr_info
            //$this->usr_info = $this->CI->config->item('usr');
            //var_dump($this->usr_arr);


            // ***** file
            $fileInfo_res=[];
            if($res['post_file_cnt']>0){
                $param_file = [
                    'tb_id' => 'ct_file',
                    'trgt_id' => $this->CI->config->item("md")['tbl'],
                    'trgt_idx' => $this->idx
                ];
                // 파일정보 조회
                $fileInfo_res = $this->CI->DM_basic->getFileInfo($param_file);
                if(count($fileInfo_res) == $res['post_file_cnt']){
                    //var_dump($fileInfo_res);
                }else{
                    log_message("ERROR", "DL_view 파일정보의 파일수와 brd의 post_file_cnt 불일치오류 post_file_cnt=".$res['post_file_cnt']);
                    alert('파일수 불일치 오류', '/index.php');
                }
            }

            $res['post_cont'] = str_replace( 'data-align="none" style="width: 100%; height: 100%;" data-file-name=', 'data-align="none" style="width: 933px; height: 525px;" data-file-name=', $res['post_cont']);

            /*
             *----------------------------------------
             * CV : Controller -> View
             *----------------------------------------
            */
            $param_cv = array(
                'modify'            =>$res
                ,'file'             =>$fileInfo_res
                ,'idx'              =>$this->idx
                ,'pg'               =>$this->pg
                ,'tb_id'            =>$this->CI->config->item("md")['tbl']
                ,'upload_url'       =>$this->upload_url
                ,'upload_files_num' =>$this->upload_files_num
                ,'usr'              =>$this->usr_arr
                ,'lists_perm'       =>$this->CI->chk_perm('lists')
                ,'modify_perm'      =>$this->CI->chk_perm('modify')
                ,'delete_perm'      =>$this->CI->chk_perm('delete')
            );

            // ***** cv
            $this->CI->load->view($this->svc_mod.'/cont_block_start');
            $this->CI->load->view($this->CI->dl_config->get_path_skin().'modify_cv', $param_cv);
            $this->CI->load->view($this->svc_mod.'/cont_block_end');
        }
        else
        {
            $this->CI->session->set_flashdata('message', 'ERROR : 접근권한이 없습니다.', 'refresh');
            redirect('/');
        }
    }
}