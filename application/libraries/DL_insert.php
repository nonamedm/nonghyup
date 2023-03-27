<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DL_insert
{
    // *****
    public $cfg_file_upload = array();

    // *****
    public $cfg_file_resize = array();

    // *****
    public $upload_error = false;

    // ***** for rtn_path
    public $typ = "";
    public $func = "";
    public $mode = "";



    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }


    /*
     * ****************************************
     * C M - I N S E R T
     * ****************************************
     */
    public function cm_insert()
    {
        if($this->CI->chk_perm('write'))
        {
            // *****
            $this->typ = $this->CI->config->item('md')['typ'];
            $this->func = $this->CI->config->item('md')['fnc'];
            $this->mode = $this->CI->config->item('md')['mod'];

            $m_id = $this->CI->get_val('m_id');

            $this->pg_idx = $this->CI->get_val('pg_idx');

            $upload_data_tmp = array();

            // file input이 있었다면 set upload file
            if(count($_FILES))
            {
                $upload_data_tmp = $this->CI->dl_file->setUploadFile($_FILES, "insert", "");
            }
            $trgt_idx = '';
            if($this->CI->input->post('trgt_idx', TRUE)){
                $trgt_idx = $this->CI->input->post('trgt_idx', TRUE);
            }

            // ***** fields
            $param_insert['fields'] = $this->CI->config->item('fields');
            // ***** table id
            $param_insert['tb_id'] = $this->CI->config->item('md')['tbl'];

            // ***** $param_insert['fields'] data set(post)
            foreach($this->CI->input->post(NULL, TRUE) as $key=>$val)
            {//echo $key.'='.$val.'<br>';
                if($val!='' && isset($param_insert['fields'][$key]))
                {
                    if( !($key=='post_subj' || $key=='post_cont' || $key=='post_link_addr'|| $key=='post_fix'|| $key=='post_fix_num')) {
                        $param_insert['fields'][$key] = $this->CI->dl_security->xss_cleaner($val);
                    }
                }
            }
            $param_insert['fields']['post_link_addr'] = $this->CI->dl_security->xss_cleaner1($this->CI->input->post('post_link_addr', FALSE));
            $param_insert['fields']['post_subj'] = $this->CI->dl_security->xss_cleaner1($this->CI->input->post('post_subj', FALSE));
            $param_insert['fields']['post_cont'] = $this->CI->dl_security->xss_cleaner1($this->CI->input->post('post_cont', FALSE));
            $param_insert['fields']['post_fix'] = $this->CI->dl_security->xss_cleaner1($this->CI->input->post('post_fix', FALSE));
            $param_insert['fields']['post_fix_num'] = $this->CI->dl_security->xss_cleaner1($this->CI->input->post('post_fix_num', FALSE));

            //print_r($param_insert['fields']);

            if($trgt_idx)
            {
                // get ord
                $param_ord=[
                    'tb_id'         => $this->CI->config->item('md')['tbl']
                    ,'trgt_idx'     => $trgt_idx
                    ,'trgt_id'      => 'ord'
                ];
                //print_r($param_ord);
                $ord_arr = $this->CI->DM_basic->getMaxCnt($param_ord);
                //print_r($ord_arr);
                if($ord_arr['ord']!=''){
                    $ord = $ord_arr['ord'];
                    $ord++;
                    $param_insert['fields']['ord']=$ord;
                }
            }

            // ***** ip
            $param_insert['fields']['crt_ip'] = $_SERVER['REMOTE_ADDR'];
//var_dump( $param_insert['fields'] );

            /*
             *----------------------------------------
             * USR
             *----------------------------------------
            */
            //echo $this->func;
            if($this->func == "auth")
            {
                //echo $param_insert['fields']['usr_pw'];
                // ***** only join
                if(isset($param_insert['fields']['usr_pw']) && $param_insert['fields']['usr_pw'])
                {
                    // ***** password encrypt
                    $this->CI->load->library('encryption');
                    $param_insert['fields']['usr_pw'] = $this->CI->encryption->encrypt($param_insert['fields']['usr_pw']);

                    // ***** user level
                    $param_insert['fields']['usr_lv'] = $this->CI->get_usr_lv_join();
                }
            }



            //var_dump( $param_insert );
            // ***** DB insert
            $reg_id = $this->CI->DM_basic->setInsert($param_insert);

            /*
             *------------------------------
             * S U C C E S S - I N S E R T
             *------------------------------
            */
            if($reg_id)
            {
                $file_upload = false;
                // ***** file정보 db 저장
                if($this->CI->config->item('md')['file'])
                {
                    //var_dump($upload_data_tmp);
                    for ($i=0; $i<count($_FILES); $i++) {
                        $upload_data_tmp[$i]['trgt_id']=$this->CI->config->item('md')['tbl'];
                        $upload_data_tmp[$i]['trgt_idx']=$reg_id;
                        $upload_data_tmp[$i]['file_ord']=$i;
                        $upload_data_tmp[$i]['file_status']='';
                        $upload_data_tmp[$i]['crt_ip']=$_SERVER['REMOTE_ADDR'];
                        $upload_data_tmp[$i]['download_yn']= $this->CI->dl_security->xss_cleaner1($this->CI->input->post('download_yn'.$i, FALSE));

                        if(isset($upload_data_tmp[$i]) && $upload_data_tmp[$i]){
                            $file_data['fields'] = $upload_data_tmp[$i];
                        }else{
                            $this->CI->load->library('DL_schema');
                            $file_data['fields'] =$this->CI->dl_schema->get_schema('file');
                        }

                        $file_data['tb_id']='ct_file';
                        $res = $this->CI->DM_basic->setInsert($file_data);
                        if($res){

                        }else{
                            log_message("ERROR", "DL_insert 게시물 등록시 파일업로드 후 파일정보저장에러 file ord=".$i);
                            alert('insert 파일정보 저장실패('.$i.')', '/index.php');
                        }
                    }

                    $param_cnt = [
                        'tb_id' => $this->CI->config->item('md')['tbl'],
                        'idx' => $reg_id,
                        'post_file_cnt' => count($_FILES)
                    ];
                    $file_cnt_res = $this->CI->DM_basic->updtCnt($param_cnt);
                    if($file_cnt_res){
                        $file_upload = true;
                    }else{
                        log_message("ERROR", "DL_insert 게시물 등록시 파일업로드 후 파일정보저장후 파일수저장오류 file cnt=".$param_cnt);
                        alert('insert 파일카운트 저장실패', '/index.php');
                    }
                }

                if($this->func == "usr") // 사용자 등록인 경우만
                {
                    // ***** session
                    $this->CI->session->set_userdata('is_login', TRUE);
                    $this->CI->session->set_userdata('usr_lv', $param_insert['fields']['usr_lv']);
                    $this->CI->session->set_userdata('usr_id', $param_insert['fields']['usr_id']);
                }

                // 답변 등록시 원글에 카운트 갱신
                if ($this->CI->config->item('md')['fld']=="qna"){
                    if ($trgt_idx) // 답변글
                    {
                        $param_update=array(
                            "tb_id"     => $this->CI->config->item('md')['tbl'],
                            "idx"       => $param_insert['fields']['trgt_idx'],
                            "trgt_id"   => "post_reply_cnt",
                            "trgt_val"  => $ord
                        );
                        $this->CI->DM_basic->updateCnt($param_update);
                    }
                    else // 문의글
                    {
                        // trgt_idx
                        $param_qna = [
                            "tb_id"     => $this->CI->config->item('md')['tbl'],
                            "idx"       => $reg_id,
                            "trgt_idx"  => $reg_id
                        ];
                        $this->CI->DM_basic->update_trgt_idx($param_qna);

                        // ***** mail
                        log_message("ERROR", "DL_insert  메일발송 시작");
                        $this->CI->load->library('DL_mail');
                        $param_mail = array(
                            //'mail_to'       => 'grafish@designclue.com',
                            //'mail_cc'       => 'grafish@designclue.co.kr, grafish@diion.com',
                            'mail_to'     => 'jeyun8835@nonghyup.com',
                            'mail_cc'     => 'hwonpark@nonghyup.com, eunho_noh@nonghyup.com',
                            'mail_from'     => 'mail@sendbox.kr',
                            'usr_id'        => $param_insert['fields']['usr_id'],
                            'usr_nm'        => $param_insert['fields']['usr_nm'],
                            'mail_cont'     => $param_insert['fields']['post_cont']
                        );
                        log_message("ERROR", "DL_insert  메일발송 3");
                        if($this->CI->config->item('md')['tbl']=="ct_improvement"){
                            log_message("ERROR", "DL_insert  메일발송 4");
                            $param_mail['mail_subj'] = '규제개선제안 등록안내';
                            $param_mail['mail_title'] = '규제개선제안 등록안내';
                        }else if($this->CI->config->item('md')['tbl']=="ct_qna"){
                            log_message("ERROR", "DL_insert  메일발송 5");
                            $param_mail['mail_subj'] = '규제대응Q&A 등록안내';
                            $param_mail['mail_title'] = '규제대응Q&A 등록안내';
                        }
                        $this->CI->dl_mail->send_mail_admin($param_mail);
                    }
                }


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
                    ,'m_id'     =>  $m_id
                    ,'mod'     =>  "lists"
                    ,'idx'      =>  $reg_id
                    ,'pg'       =>  $this->pg_idx
                );
                $rtn_path = $this->CI->dl_config->get_path_rtn($param_rtn);

                if($this->CI->get_val('m_id') == 'qna' || $this->CI->get_val('m_id') == 'improvement')
                {
                    alert('정상적으로 등록되었습니다.', '/'.$this->CI->seg.'/'.$this->CI->get_val('m_id'));
                }else{
                    alert('정상적으로 등록되었습니다.', $rtn_path);
                }



            }
            else // 등록 저장 에러
            {
                alert('저장중 오류가 발생했습니다.', '/index.php');
            }

        }
        else
        {
            alert('접근권한이 없습니다.', '/index.php');
        }
    }
}