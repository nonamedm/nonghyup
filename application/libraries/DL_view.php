<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DL_view
{
    // *****
    public $idx, $m_id;
    public $fl;
    public $pg, $prev, $next, $cat;

    // *****
    public $file_name, $file_view, $upload_files_num, $is_adm_mod;

    public $svc_mod;


    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();

        $this->svc_mod = $this->CI->get_val('svc_mod');
    }



    /*
     * ****************************************
     * C V - V I E W
     * ****************************************
     */
    public function view_cv($param)
    {
        if(count($param)) {

            $this->CI->load->database();
            /*
             *----------------------------------------
             * CM : Controller -> Model
             *----------------------------------------
            */


            // *****
            $this->idx      = $this->CI->get_val('p_idx');
            $this->lng_cd   = $this->CI->get_val('lng_cd');
            $this->pg       = $this->CI->get_val('pg_idx');
            $this->fl       = $this->CI->get_val('fl_idx');
            $this->dir      = $this->CI->get_val('file_upload_dir');
            $this->cat      = $this->CI->get_val('p_cat');

            $this->upload_files_num = $this->CI->get_val('upload_files_num');
            $this->is_adm_mod       = $this->CI->get_val('is_adm_mod');
            $this->is_admin         = $this->CI->get_val('is_admin');

            $this->usr_arr =            $this->CI->get_val('usr_arr');

            // ***** DB값 요청

            if(! $this->idx){
                show_404('비정상접근', true);
            }


            $rep_arr=[];

            if($this->CI->config->item("md")['fld']=='qna')
            {
                if ($this->is_admin)
                {
                    $param_cm = array(
                        'tb_id' => $this->CI->config->item("md")['tbl']
                        ,'idx' => $this->idx
                    );
                    $res = $this->CI->DM_basic->getView($param_cm);
                }
                else
                {
                    $param_cm = array(
                        'tb_id' => $this->CI->config->item("md")['tbl']
                        ,'idx' => $this->idx
                        ,'usr_id' => $this->usr_arr['usr_id']
                    );
                    $res = $this->CI->DM_basic->getView_qna($param_cm);
                }

                if(! $res)
                {
                    alert('접근권한이 없습니다.', '/ko');
                }

                if ($res['post_reply_cnt']) { // 답글이 있다면
                    $param_rep = [
                        'tb_id' => $this->CI->config->item("md")['tbl']
                        ,'trgt_idx' => $res['idx']
                    ];
                    $rep_arr = $this->CI->DM_basic->getList($param_rep);
                    array_shift($rep_arr);
                }

            }else{
                $param_cm = array(
                    'tb_id' => $this->CI->config->item("md")['tbl']
                    ,'idx' => $this->idx
                );
                $res = $this->CI->DM_basic->getView($param_cm);
            }

            if($res){

                // 조회수 추가
                $param_cm['idx']=$this->idx; // reply 시 idx 없음
                $param_cm['post_hit'] = $res['post_hit']+1;
                $this->CI->DM_basic->setUpdateHit($param_cm);

                if($this->usr_arr) {
                    // chk_is_like
                    $param_like = [
                        'tb_id' => 'ct_like',
                        'trgt_id' => $this->CI->config->item("md")['tbl'],
                        'trgt_idx' => $res['idx'],
                        'usr_id' => $this->usr_arr['usr_id']
                    ];
                    $is_like = $this->CI->DM_basic->chk_is_like($param_like);
                }else{
                    $is_like = 0;
                }

                // 댓글목록 불러오기
                $param_cmt = [
                    'tb_id' => 'ct_comment',
                    'trgt_id' => $this->CI->config->item("md")['tbl'],
                    'trgt_idx' => $res['idx'],
                    'order' => ' crt_dtms ASC '
                ];
                $cmt_list = $this->CI->DM_basic->getList($param_cmt);


            }else{
                show_404("ERROR : idx is wrong", TRUE);
            }



            //var_dump($res);
            $fileInfo_res=[];
            $attach_file_cnt = 0;
            if($res['post_file_cnt']>0){
                $param_file = [
                    'tb_id' => 'ct_file',
                    'trgt_id' => $this->CI->config->item("md")['tbl'],
                    'trgt_idx' => $this->idx
                ];
                // 파일정보 조회
                $fileInfo_res = $this->CI->DM_basic->getFileInfo($param_file);
                //print_r($fileInfo_res);
                if(count($fileInfo_res) == $res['post_file_cnt']){
                    for ($i = 0; $i < count($fileInfo_res); $i++) {
                        if ($fileInfo_res[$i]['file_name']) {
                            $attach_file_cnt++;
                        }
                    }
                    //var_dump($fileInfo_res);
                }else{
                    log_message("ERROR", "DL_view 파일정보의 파일수와 brd의 post_file_cnt 불일치오류 post_file_cnt=".$res['post_file_cnt']);
                    alert('파일수 불일치 오류', '/index.php');
                }
            }


            /*
             *----------------------------------------
             * CV : Controller -> View
             *----------------------------------------
            */
            $param_cv = array(
                'view'              => $res
                ,'rep_arr'          => $rep_arr
                ,'file'             => $fileInfo_res
                ,'idx'              => $this->idx
                ,'cat'              => $this->cat
                ,'pg'               => $this->pg
                ,'fl'               => $this->fl
                ,'prev'             => $this->prev
                ,'next'             => $this->next
                ,'is_like'          => $is_like
                ,'usr'              => $this->usr_arr
                ,'cmt_list'         => $cmt_list
                ,'attach_file_cnt'  => $attach_file_cnt
                //,'file_name'        =>$this->file_name
                //,'file_view'        =>$this->file_view
                //,'upload_files_num' =>$this->upload_files_num
                ,'lists_perm'       => $this->CI->chk_perm('lists')
                ,'write_perm'       => $this->CI->chk_perm('write')
                ,'modify_perm'      => $this->CI->chk_perm('modify')
                ,'delete_perm'      => $this->CI->chk_perm('delete')
                ,'reply_perm'       => $this->CI->chk_perm('reply')
                ,'dnload_perm'      => $this->CI->chk_perm('dnload')
                ,'is_adm_mod'       => $this->is_adm_mod
            );

            // ***** cv
            $this->CI->load->view($this->svc_mod.'/cont_block_start');
            $this->CI->load->view($this->CI->dl_config->get_path_skin().'view_cv', $param_cv);
            $this->CI->load->view($this->svc_mod.'/cont_block_end');

        }
        else
        {
            alert('접근권한이 없습니다.', '/ko');
        }
    }
}