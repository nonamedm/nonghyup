<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DL_config
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();


    }


    /*
     *----------------------------------------
     * G E T - P A T H - S K I N
     *----------------------------------------
    */
    public function get_path_skin()
    {
        $path = '/';
        if( $this->CI->config->item("md")['skin'] == '' || $this->CI->config->item("md")['skin'] == 'pages')
        {
            $path = '/pages/';
        }else{
            $path = '/skin/'.$this->CI->config->item("md")['skin'].'/';
        }
        return $path;
    }


    /*
     *----------------------------------------
     * G E T - F I L E - C F G
     *----------------------------------------
    */
    public function get_file_cfg($upld_typ='file_upload', $post_typ='basic', $_dir='')
    {
        // *****
        $rtn_cfg = array();

        switch ($post_typ) {
            case 'basic':
                $allowed_types = "*";
                // $allowed_types = "gif|jpg|jpeg|png|pdf|hwp|hwpx|ppt|pptx|doc|docx|xls|xlsx|txt|zip|dwg|mp4";
                break;

            case 'gallery':
                $allowed_types = "gif|jpg|jpeg|png|pdf";
                break;

            default :
                echo "error (CL_cfg : post_typ)";
                $rtn_cfg = false;
                show_404();
        }

        if($_dir==''){
            $_dir = $this->CI->get_val('file_upload_dir');
        }

        switch ($upld_typ) {
            case 'file_upload':
                $rtn_cfg = array(
                    'upload_path'       => $_SERVER['DOCUMENT_ROOT'].'/static/data/'.$_dir.'/',
                    'allowed_types'     => $allowed_types,
                    'encrypt_name'      => TRUE,
                    'overwrite'         => TRUE,
                    'file_ext_tolower'  => TRUE,
                    'remove_spaces'     => TRUE,
                    'max_size'          => 0,
                    'max_width'         => 0,
                    'max_height'        => 0
                );
                break;

            case 'file_resize':
                $rtn_cfg = array(
                    'resize_width'      =>'1024',
                    'resize_height'     =>'1024'
                );
                break;

            default :
                echo "error (CL_cfg : upld_typ)";
                $rtn_cfg = false;
                show_404();
        }
        return $rtn_cfg;
    }


    /*
     *----------------------------------------
     * G E T - P A T H - R T N
     * $param[]
     * seg :
     * m_id :
     * cd :
     * mode :
     * idx :
     * pg :
    */
    public function get_path_rtn($params)
    {
        log_message("INFO", "dl_config -> get_path_rtn : 시작 ");
        $rtn;
        $path="";
        // seg
        if( isset($params['seg']) && $params['seg'] ){
            $seg=$params['seg'];
        }else{
            $seg=$this->CI->seg;
        }

        // g_id


        // m_id
        if($params['m_id']){
            log_message("INFO", "dl_config -> get_path_rtn : 시작 : m_id = ".$params['m_id']);
            // 퍼미션 거절인 경우
            if(isset($params['cd']) && ($params['cd']=='deny')){
                log_message("INFO", "dl_config -> get_path_rtn : 시작 : m_id : deny ");
                // 로그인 이라면
                if($params['m_id'] == 'login'){

                }else{ // 그외는 무조건

                }


            }else{

            }
            /*
            if($params['m_id'] == 'login'){
                $path='/'.$seg.'/auth/login';
            }else if($params['m_id'] == 'mypage'){
                $path='/'.$seg.'/mypage';
            }else if($params['m_id'] == 'cert'){
                $path='/'.$seg.'/auth/login';
            }else if($params['m_id'] == '/'){
                $path='/';
            }else {
            */
            /*
            if($seg==$params['m_id']){
                $path = '/' . $seg;
            }else if($params['m_id']=="dnload") {
                $path='/'.$seg.'/mypage';
            }else{
                $path='/'.$seg.'/'.$params['m_id'];
            }
            */


            // mode
            if (isset($params['mod']) && $params['mod']) {
                $mode = $params['mod'];

                // idx
                if($params['mod']!='lists') {
                    if (isset($params['idx']) && $params['idx']) {
                        $idx = $params['idx'];
                    }
                }

                // pg
                if (isset($params['pg']) && $params['pg']) {
                    $pg = $params['pg'];
                }

                $path = '/' . $seg . '/' . $params['m_id'] . '/' . $mode;
                if (isset($idx) && $idx) {
                    if (strpos($path, '?') !== false) {
                        $path .= '&idx=' . $idx;
                    } else {
                        $path .= '?idx=' . $idx;
                    }
                }
                if (isset($pg) && $pg) {
                    if (strpos($path, '?') !== false) {
                        $path .= '&pg=' . $pg;
                    } else {
                        $path .= '?pg=' . $pg;
                    }
                }
            }
            //}

            log_message("INFO", "dl_config -> get_path_rtn : m_id로 = ".$path);
        }else if( $this->CI->session->userdata('hstry') ) { // hstry
            if($path == $this->CI->session->userdata('hstry')){
                $this->CI->session->set_userdata('hstry', "");
                $path = '/';
            }

            log_message("INFO", "dl_config -> get_path_rtn : 히스토리로 = ".$path);
        }

        return $path;
    }



}