<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DL_file
{
    // *****
    public $rtn_files = "";
    public $idx, $m_id;

    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();

        $this->idx  = $this->CI->get_val('p_idx');
        $this->m_id  = $this->CI->get_val('m_id');
    }



    /*
     * ****************************************
     * S E T - U P L O A D - F I L E
     * ****************************************
     */
    function setUploadFile( $param_files, $upload_mode = "insert", $_dir="", $del_arr = array(), $_idx=0 )
    {
        // *****
        $i=0;
        $upload_file_arr = array();
        $upload_file_tmp = array();
        $rs_config = array();

        // ***** 설정값
        if($_dir!=""){
            $cfg_file_upload = $this->CI->dl_config->get_file_cfg('file_upload', 'gallery', 'register');
        }else{
            $cfg_file_upload = $this->CI->get_cfg_file_upload();
        }

        $cfg_file_resize = $this->CI->get_cfg_file_resize();
       
        //var_dump($cfg_file_upload);

        // ***** 초기화
        $this->CI->load->library( 'upload', $cfg_file_upload );
        $this->CI->load->library( 'image_lib' );

        // 'update'인 경우 저장값을 불러와야 함
        if( $upload_mode == "update" ) //&& count($del_arr)
        {
            $upload_file_str = "";
            //
            $_idx = $this->CI->input->post('idx', TRUE);

            $param_file = array(
                'tb_id' => 'ct_file',
                'trgt_id' => $this->CI->config->item("md")['tbl'],
                'trgt_idx' => $_idx
            );
            $upload_file_arr = $this->CI->DM_basic->getFileInfo($param_file);


            //var_dump($upload_file_arr);
            //show_404();
        }


        // ***** 파일 순회
        foreach( $param_files as $key=>$val )
        {
            // ***** 초기화
            unset($upload_file_tmp);

            // ***** 첨부된 새 파일이 있다
            if($val['size'])
            {
                if( !$_dir ){
                    $_dir = $this->CI->get_val('file_upload_dir');
                }

                // ***** 업로드 디렉토리 체크
                if (!is_dir($_SERVER['DOCUMENT_ROOT'].'/static/data/'.$_dir)) {
                    mkdir($_SERVER['DOCUMENT_ROOT'].'/static/data/'.$_dir, 0777, true);
                }


                if($upload_mode == "update" && (isset($upload_file_arr[$i]['full_path']) && $upload_file_arr[$i]['full_path']) )
                {
                    // ***** 기존 파일 삭제
                    $rtn_del = $this->CI->dl_delete->file_delete($upload_file_arr[$i]['full_path']);
                    log_message("info", "DL_file -> setUploadFile -> file_delete : rtn_del=".$rtn_del);
                }

                // ***** 새파일이 있으면
                // ***** upload file
                if( !$this->CI->upload->do_upload($key) )
                {
                    // ***** 업로드 실패
                    log_message("info", "DL_file -> setUploadFile -> file_delete : 파일 업로드 실패");
                    $data['error'] = $this->CI->upload->display_errors();
                    echo "file_upload_error".$data['error'];
                    $upload_error = true;
                    show_404();
                    break;
                }else{ // ***** 업로드 성공
                    log_message("info", "DL_file -> setUploadFile -> file_delete : 파일 업로드 성공");

                    $upload_file_tmp = $this->CI->upload->data();
                    if($upload_file_tmp)
                    {
                        // ***** 파일 리사이징 - 추후 확인 필요
                        $upload_file_resize = $this->resize_file( $upload_file_tmp, $cfg_file_resize );

                        // ***** update 모드이고, 기존 파일이 있다 (체크 여부 관계없이)
                        if($upload_mode == "update" && (isset($upload_file_arr[$i]['full_path']) && $upload_file_arr[$i]['full_path']) ) {
                            // ***** 기존 파일 삭제
                            $rtn_del = $this->CI->dl_delete->file_delete($upload_file_arr[$i]['full_path']);
                        }


                        if(! isset($upload_file_arr[$i])){
                            $this->CI->load->library('DL_schema');
                            $upload_file_arr[$i] =$this->CI->dl_schema->get_schema('file');
                        }

                        // 파일데이타 갱신
                        foreach($upload_file_resize as $k=>$v ){
                            $upload_file_arr[$i][$k] = $upload_file_resize[$k];
                        }
                    }

                }
            }else{ // ***** 첨부된 새 파일이 없다
                // ***** 새파일이 없고, update 모드이고, 기존 파일이 있고, 삭제체크가 되어 있다.
                if($upload_mode == "update" && (isset($upload_file_arr[$i]['idx']) && $upload_file_arr[$i]['idx']) && $del_arr[$i])
                {
                    // ***** 기존 파일 삭제
                    $rtn_del = $this->CI->dl_delete->file_delete($upload_file_arr[$i]['full_path']);
                    // ***** DB 데이타 삭제
                    $upload_file_arr[$i]['file_status'] = 'delete';
                    //$upload_file_arr[$i] = '';

                    log_message("info", "DL_file -> setUploadFile -> file_delete : rtn_del=".$rtn_del);
                }
                //show_404();
            }
            $i++;
        } // end foreach

        return $upload_file_arr;
        //return $this->file_to_string($upload_file_arr);
    }



    /*
     * ****************************************
     * U P L O A D - T O - S T R I N G
     * ****************************************
     */
    function file_to_string($upload_file_arr = array())
    {
        $rtn_str = "";
        if(count($upload_file_arr))
        {
            foreach($upload_file_arr as $value)
            {
                $tmp_str='';
                foreach($value as $val)
                {
                    if(reset($value) !== $val)
                    {
                        $tmp_str .= "|";
                    }
                    $tmp_str .= $val;
                }

                if(reset($upload_file_arr) !== $value)
                {
                    $rtn_str .= "^^~";
                }
                $rtn_str .= $tmp_str;
            }
        }
        if( $rtn_str == "^^~" ){
            $rtn_str = "";
        }
        return $rtn_str;
    }



    /*
     * ****************************************
     * F I L E  T O  A R R A Y
     * ****************************************
     */
    function file_to_array($upload_file_str = '')
    {
        $rtn_arr = array();
        if($upload_file_str)
        {
            $tmp_arr = explode( "^^~", $upload_file_str );
            if( count($tmp_arr) )
            {
                for($i=0; $i<count($tmp_arr); $i++)
                {
                    $tmp_files_arr = array();
                    if($tmp_arr[$i])
                    {
                        $tmp_files_arr = explode("|", $tmp_arr[$i]);
                    }
                    $rtn_arr[$i] = $tmp_files_arr;
                }
            }
        }
        return $rtn_arr;
    }



    /*
     * ****************************************
     * R E S I Z E _ F I L E
     * ----------------------------------------
     * $upload_file : 대상파일
     * $resize_config : 리사이즈 설정값
     * ****************************************
     */
    function resize_file( $upload_file, $resize_config )
    {
        // ***** resize config
        $rs_config['image_library'] = 'GD2';
        $rs_config['source_image'] = $upload_file['full_path'];
        $rs_config['quality'] = '90%';
        //$rs_config['new_image'] = 'none';
        //$rs_config['create_thumb'] = FALSE;
        $rs_config['maintain_ratio'] = TRUE;
        $rs_config['master_dim'] = 'width';
        $rs_config['width'] = $resize_config['resize_width'];
        $rs_config['height'] = $resize_config['resize_height'];
        //$rs_config['height'] = floor(($upload_file['image_height']*$resize_config['resize_width'])/$upload_file['image_width']);

        $this->CI->image_lib->initialize($rs_config);

        // 리사이징
        if( $resize_config['resize_width'] )
        { //resize_width값이 있다면 리사이징 처리 하라
            if($upload_file['image_width'] > $resize_config['resize_width'])
            {
                log_message("info", "DL_file -> setUploadFile -> resize_file : 리사이즈 1");

                log_message("info", "DL_file -> setUploadFile -> resize_file : 리사이즈 2");
                if( !$this->CI->image_lib->resize() )
                { // 리사이즈 실패
                    echo $this->CI->image_lib->display_errors('<p>', '</p>');
                    log_message("info", "DL_file -> resize ::::::::::: msg = error");
                }else{ // 리사이즈 성공 (리사이징된 이미지 정보가 DB에 저장될 수 있게 후조치)
                    log_message("info", "DL_file -> setUploadFile -> resize_file : 리사이즈 3");
                    log_message("info", "DL_file -> resize ::::::::::: msg = success");
                    $upload_file['image_width'] = $rs_config['width'];
                    $upload_file['image_height'] = $rs_config['height'];
                    $upload_file['image_size_str'] = 'width="'.$rs_config['width'].'" height="'.$rs_config['height'].'"';
                    log_message("info", "DL_file -> setUploadFile -> resize_file : 리사이즈 4");
                }
            }
        }
        return $upload_file;
    }



    /*
     * ****************************************
     * G E T - F I L E - N A M E
     * ****************************************
     */
    function get_file_name( $_files, $_files_num, $_idx, $_m_id )
    {
        $htmlin = "";
        if( $_files )
        {
            $htmlin .= '<tr><td>';
            for( $i=0; $i<$_files_num; $i++ )
            {
                if( isset($_files[$i]) && $_files[$i] )
                {
                    $htmlin .= '<span class="uk-margin-medium-right">';
                    if( !$_files[$i][9] ){
                        $htmlin .= '<a href="/static/data/'.$_m_id.'?idx='.$_idx.'&fl='.$i.'">';
                    }
                    $htmlin .= $_files[$i][5];
                    if( !$_files[$i][9] ){
                        $htmlin .= '</a>';
                    }
                    $htmlin .= '</span>';
                }
            }
            $htmlin .= '</td></tr>';
        }
        return $htmlin;
    }



    /*
     * ****************************************
     * G E T - F I L E - V I E W
     * ****************************************
     */
    function get_file_view( $_files, $_files_num, $_idx, $_m_id )
    {
        $htmlin = "";
        if( $_files )
        {
            for( $i=0; $i<$_files_num; $i++ )
            {
                if( isset($_files[$i][9]) && $_files[$i][9] )
                {
                    //$htmlin .= '<tr><td>';
                    if( $_files[$i][9] ){
                        $htmlin .= '<div class="v_cont_img"><img src="/static/data/'.$_m_id.'/'.$_files[$i][4].$_files[$i][7].'"></div>';
                    }
                    //$htmlin .= '</td></tr>';
                }
            }
        }
        return $htmlin;
    }



    /*
     * ****************************************
     * D N L O A D
     * ****************************************
     */
    public function dnload_cm($option)
    {
        if( $this->CI->chk_perm('dnload') )
        {

            $this->CI->load->model('DM_basic');

            $this->CI->load->helper('download');
            ini_set('memory_limit','-1');


            // *****
            $idx = $this->CI->get_val('p_idx');
            $fl = $this->CI->get_val('fl_idx');
            //echo $fl;
            // ***** DB값 요청
            $param_cm = array(
                'tb_id' => 'ct_file',
                'trgt_id' => $this->CI->config->item("md")['tbl'],
                'trgt_idx' => $idx
            );
            //print_r($param_cm);

            $filedata = $this->CI->DM_basic->getFileInfo($param_cm);
            if($fl){
                $fl = $fl-1;
            }
            //print_r($filedata);





            if(file_exists($_SERVER['DOCUMENT_ROOT']."/static/data/".$this->m_id."/".$filedata[$fl]['file_name'])){
                $data =file_get_contents($_SERVER['DOCUMENT_ROOT']."/static/data/".$this->m_id."/".$filedata[$fl]['file_name']); // Read the file's contents
                //$name = iconv('UTF-8', 'EUC-KR', $option[1][5]);
                $name = mb_convert_encoding($filedata[$fl]['orig_name'], 'euc-kr', 'utf-8');
                force_download($name, $data);
                //force_download(mb_convert_encoding($option[1][5], 'euc-kr', 'utf-8'), $data);
            }else{
                show_404('ERROR : 파일이 존재하지 않습니다.', TRUE);
            }

        }



        function isBlockBrowser() {
            $BrowserName = getBrowser();
            if($BrowserName === 'MSIE'||$BrowserName === 'Trident'){
                echo("<script>location.replace('./NotSupportBrowser.html');</script>");
            }
        }

    }



    /*
     * ****************************************
     * F I L E S  T O  A R R A Y
     * ****************************************
     */
    function files_to_arr($fileStr, $dlmtr="^^~")
    {
        if($fileStr)
        {
            $tmp_files_arr=[];

            $tmp_arr = explode($dlmtr, $fileStr);
            if( count($tmp_arr) )
            {
                for($i=0; $i<count($tmp_arr); $i++)
                {
                    if($tmp_arr[$i])
                    {
                        $tmp_files_arr[$i] = explode("|", $tmp_arr[$i]);
                    }
                }
            }
            return $tmp_files_arr;
        }else{
            show_404('ERROR : DL_file -> files_to_arr : fileStr is null', TRUE);
        }
    }
}