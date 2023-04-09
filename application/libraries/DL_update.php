<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DL_update
{

    // *****
    public $cfg_file_upload = array();

    // *****
    public $cfg_file_resize = array();

    // *****
    public $upload_error = false;

    // ***** for rtn_path
    public $typ = "";
    public $fnc = "";
    public $mod = "";
    public $idx = "";


    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }



    /*
     * ****************************************
     * C M - U P D A T E
     * ****************************************
     */
    public function cm_update($param)
    {
        log_message("info", "DL_update -> cm_update ");
        //if($this->CI->chk_perm())
        //{
            // *****
            $this->typ = $this->CI->config->item('md')['typ'];
            $this->fnc = $this->CI->config->item('md')['fnc'];
            $this->mod = $this->CI->config->item('md')['mod'];
            $this->idx = $this->CI->get_val("p_idx");

            $this->pg_idx = $this->CI->get_val('pg_idx');

            $upload_data_tmp = array();

            $del_file_arr = array();


            // ***** file
            if(count($_FILES))
            { // file input이 있었다면

                // ***** is_checked
                for($i=0; $i<count($_FILES); $i++ )
                {
                    $del_file_arr[$i] = $this->CI->input->post('del'.$i, TRUE);
                }

                // ***** set upload data
                $upload_data_tmp = $this->CI->dl_file->setUploadFile($_FILES, "update", "", $del_file_arr);
                //echo "upload_data_tmp<br>";
                //print_r($upload_data_tmp);
                //echo count($upload_data_tmp);
                //show_404();
            }


            // ***** table id
            $param_update['tb_id'] = $this->CI->config->item('md')['tbl'];


            // ***** $param_update['fields'] set(init)
            $param_update['fields'] = $this->CI->config->item('fields');


            // ***** $param_update['fields'] data set(post)
            foreach($this->CI->input->post(NULL, TRUE) as $key=>$val)
            {
                //echo $key.'='.$val.'<br>';
                if( $val!='' && isset($param_update['fields'][$key]) )
                {
                    if( !($key=='post_subj' || $key=='post_cont' || $key=='post_link_addr'||$key=='post_fix'||$key=='post_fix_num'||$key=='post_link_trgt')) {
                        $param_update['fields'][$key] = $this->CI->dl_security->xss_cleaner($val);
                    }
                    //$param_update['fields'][$key] = $this->CI->input->post($key);
                }
            }
            $param_update['fields']['post_link_addr'] = $this->CI->dl_security->xss_cleaner1($this->CI->input->post('post_link_addr', FALSE));
            $param_update['fields']['post_subj'] = $this->CI->dl_security->xss_cleaner1($this->CI->input->post('post_subj', FALSE));
            $param_update['fields']['post_cont'] = $this->CI->dl_security->xss_cleaner1($this->CI->input->post('post_cont', FALSE));
            $param_update['fields']['post_summary'] = $this->CI->dl_security->xss_cleaner1($this->CI->input->post('post_summary', FALSE));
            $param_update['fields']['post_fix'] = $this->CI->dl_security->xss_cleaner1($this->CI->input->post('post_fix', FALSE));
            $param_update['fields']['post_fix_num'] = $this->CI->dl_security->xss_cleaner1($this->CI->input->post('post_fix_num', FALSE));
            $param_update['fields']['post_link_trgt'] = $this->CI->dl_security->xss_cleaner1($this->CI->input->post('post_link_trgt', FALSE));

            //print_r($param_update['fields']);

            // 업데이트 제외
            if(! $this->CI->input->post('crt_ip', TRUE)){
                unset($param_update['fields']['crt_ip']);
            }
            if(! $this->CI->input->post('crt_dtms', TRUE)){
                unset($param_update['fields']['crt_dtms']);
            }

            unset($param_update['fields']['post_like']);
            unset($param_update['fields']['post_hit']);

            unset($param_update['fields']['post_cmt_cnt']);

            // ***** ip
            $param_update['fields']['updt_ip'] = $_SERVER['REMOTE_ADDR'];


            /*
             *----------------------------------------
             * USR
             *----------------------------------------
            */
            if($this->CI->config->item('md')['tbl'] == "ct_usr")
            {
                // ***** only join
                if(isset($param_update['fields']['usr_pw']) && $param_update['fields']['usr_pw'])
                {
                    // ***** password encrypt
                    $this->CI->load->library('encryption');;
                    $param_update['fields']['usr_pw'] = $this->CI->encryption->encrypt($param_update['fields']['usr_pw']);

                    // ***** user level
                    $param_update['fields']['usr_lv'] = $this->CI->get_usr_lv_join();
                }
            }




            // ***** DB update
            $res_cnt = $this->CI->DM_basic->setUpdate($param_update);

            /*
             *------------------------------
             * S U C C E S S - U P D A T E
             *------------------------------
            */
            if($res_cnt)
            {
                //echo 'res_cnt='.$res_cnt.'<br>';
                if($this->CI->config->item('md')['file'])
                {

                    //echo 'upload_data_tmp=<br>';
                    //print_r($upload_data_tmp);

                    for ($i=0; $i<count($upload_data_tmp); $i++) {
                        if($upload_data_tmp[$i]['file_status'] == 'delete'){
                            //$this->CI->db->delete( 'ct_file', array('idx' => $upload_data_tmp[$i]['idx']));
                            //unset($upload_data_tmp[$i]);
                        }
                        $upload_data_tmp[$i]['updt_ip']=$_SERVER['REMOTE_ADDR'];
                        if($upload_data_tmp[$i]['file_status'] == 'delete'){
                            $this->CI->load->library('DL_schema');
                            $file_data['fields'] = $this->CI->dl_schema->get_schema('file');
                            $file_data['fields']['idx'] = $upload_data_tmp[$i]['idx'];
                            $file_data['fields']['trgt_id'] = $upload_data_tmp[$i]['trgt_id'];
                            $file_data['fields']['trgt_idx'] = $upload_data_tmp[$i]['trgt_idx'];
                            $file_data['fields']['crt_dtms'] = $upload_data_tmp[$i]['crt_dtms'];
                            $file_data['fields']['crt_ip'] = $upload_data_tmp[$i]['crt_ip'];
                            $file_data['fields']['updt_dtms'] = $upload_data_tmp[$i]['updt_dtms'];
                            $file_data['fields']['updt_ip'] = $upload_data_tmp[$i]['updt_ip'];
                            $file_data['fields']['file_ord'] = $upload_data_tmp[$i]['file_ord'];
                            log_message("ERROR", "DL_update 파일삭제처리=".$i);
                        }else{
                            $upload_data_tmp[$i]['download_yn']= $this->CI->dl_security->xss_cleaner1($this->CI->input->post('download_yn'.$i, FALSE));
                            $file_data['fields'] = $upload_data_tmp[$i];
                            log_message("INFO", "DL_update 파일삭제처리=".$i);
                        }

                        $file_data['tb_id']='ct_file';
                        //print_r($file_data);
                        //show_404();
                        $res = $this->CI->DM_basic->setUpdate($file_data);

                        if($res){
                            $param_cnt = [
                                'tb_id' => $this->CI->config->item('md')['tbl'],
                                'idx' => $this->idx,
                                'post_file_cnt' => count($upload_data_tmp)
                            ];
                            $file_cnt_res = $this->CI->DM_basic->updtCnt($param_cnt);
                        }else{
                            unset($param_update['fields']['post_file_cnt']);
                            //log_message("ERROR", "DL_insert 게시물 등록시 파일업로드 후 파일정보저장에러 file ord=".$i);
                            //alert('update 파일정보 저장실패('.$i.')', '/index.php');
                        }

                    }
                    //echo '----------<br>';
                    //print_r($upload_data_tmp);
                    //foreach ($upload_data_tmp as $key=>$val) {
                    //    if($upload_data_tmp[$key]['file_status'] == 'delete'){
                    //        unset($upload_data_tmp[$key]);
                    //    }
                    //}
                    //echo '====== upload_data_tmp ====<br>';
                    //print_r($upload_data_tmp);
                    //echo 'count(upload_data_tmp)='.count($upload_data_tmp).'<br>';
                    //echo 'file_res='.$file_res.'<br>';
                    //show_404();
                    //if(count($upload_data_tmp)==$file_res){




                    if($file_cnt_res>=0){
                        $file_upload = true;
                    }else{
                        log_message("ERROR", "DL_insert 게시물 등록시 파일업로드 후 파일정보저장후 파일수저장오류 file cnt=".$param_cnt);
                        alert('update 파일카운트 저장실패', '/index.php');
                    }
                    //}else{
                    //    log_message("ERROR", "DL_insert 게시물 등록시 파일업로드 후 업로드파일수와 파일정보저장건수 불일치오류");
                    //    alert('update 파일카운트 불일치', '/index.php');
                    //}
                }
                //echo $this->fnc;

                // ***** mail
                /*
                $param_mail = array(
                    'mail_to'=>$param_update['fields']['usr_id'],
                    'mail_from'=>'webmaster@seoul-eduhub.com',
                    'mail_subj'=>'참가등록안내',
                    'mail_pin'=>$param_update['fields']['usr_pin'],
                    'mail_name_first'=>$param_update['fields']['usr_name_first'],
                    'mail_name_last'=>$param_update['fields']['usr_name_last'],
                    'mail_phone'=>$param_update['fields']['usr_phone']
                );
                $this->CI->dl_mail->send_mail_ses($param_mail);
                */
                //show_404();
                // DB 등록
                $this->CI->session->set_flashdata('message', '정상적으로 수정되었습니다.', 'refresh');

                /*
                 *------------------------------
                 * redirect url
                 *------------------------------
                */
                // ***** reg -> pay
                //if($param == "reg" ){
                //redirect($this->CI->dl_config->get_path_rtn('regPay'));
                //}else{


                $param_rtn = array(
                    'seg'       =>  $this->CI->get_val('seg')
                    ,'m_id'     =>  $this->CI->get_val('m_id')
                    ,'mod'     =>  "lists"
                    ,'idx'      =>  $this->idx
                    ,'pg'       =>  $this->pg_idx
                );
                $rtn_path = $this->CI->dl_config->get_path_rtn($param_rtn);
                //echo $rtn_path;
                redirect($rtn_path);

            }
            else // 등록 저장 에러
            {
                $this->CI->session->set_flashdata('message', 'error (DB update error)', 'refresh');
                redirect('/');
            }


        //}else{
        //    $this->CI->session->set_flashdata('message', 'ERROR : 접근권한이 없습니다.', 'refresh');
        //    redirect('/');
        //}

    }

}