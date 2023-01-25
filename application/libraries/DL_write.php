<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DL_write
{
    // *****
    public $upload_url = "";

    // *****
    public $upload_files_num;

    // *****
    public $usr_arr = array();

    public $pg_idx;
    public $idx;

    public $lng_cd, $lng_idx, $seg, $lng_arr, $lng_mode_yn;



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
     * C V - W R I T E
     * ****************************************
     */
    public function write_cv($param)
    {
        $t_pass = false;
        if(count($param))
        {
            if($this->CI->get_val('p_cat'))
            { // p_cat 존재
                if(preg_match('/^[0-9]{1,2}$/', $this->CI->get_val('p_cat')))
                { // p_cat 유효 : 1~2자리의 숫자만
                    $t_day = $this->CI->get_val('p_cat');
                    $t_pass = true;
                    //echo 't_day='.$t_day;
                }else{ // 값이 유효하지 않는다면 현재값 적용
                    $t_day = date("d");
                }

            }else{ // 값이 존재하지 않는다면 현재값 적용
                $t_day = date("d");
            }


            $this->lng_cd =             $this->CI->get_val('lng_cd');
            $this->lng_idx =            $this->CI->get_val('lng_idx');
            $this->seg =                $this->CI->get_val('seg');
            $this->lng_arr =            $this->CI->get_val('lng_arr');
            $this->lng_mode_yn =        $this->CI->get_val('lng_mode_yn');
            $this->upload_files_num =   $this->CI->get_val('upload_files_num');

            //echo $t_day;
            //$this->CI->load->database();
            $this->usr_arr = $this->CI->get_val('usr_arr');

            // ***** usr_info
            //$this->usr_arr = $this->CI->get_val('usr_arr');
            //var_dump($this->CI->config->item('usr')['usr_nm_frst']);

            // ***** file num
            //$this->upload_files_num = $this->CI->get_upload_files_num();

            /*
             *----------------------------------------
             * CM : Controller -> Model
             *----------------------------------------
            */



            /*
             *----------------------------------------
             * CV : Controller -> View
             *----------------------------------------
            */
            $param_cv = array(
                'lng_cd'            =>$this->lng_cd
                ,'lng_idx'          =>$this->lng_idx
                ,'lng_arr'          =>$this->lng_arr
                ,'seg'              =>$this->seg
                ,'lng_mode_yn'      =>$this->lng_mode_yn
                ,'tb_id'            =>$this->CI->config->item("md")['tbl']
                ,'upload_url'       =>$this->upload_url
                ,'upload_files_num' =>$this->upload_files_num
                ,'usr'              =>$this->usr_arr
                ,'t_day'            => $t_day
                ,'t_pass'           => $t_pass
                ,'write_perm'       =>$this->CI->chk_perm('write')
                ,'lists_perm'       =>$this->CI->chk_perm('lists')
                ,'idx'              =>$this->idx
                ,'pg'               =>$this->pg_idx
            );

            // ***** cv
            $this->CI->load->view($this->svc_mod.'/cont_block_start');
            $this->CI->load->view($this->CI->dl_config->get_path_skin().'write_cv', $param_cv);
            $this->CI->load->view($this->svc_mod.'/cont_block_end');
        }
        else
        {
            $this->CI->session->set_flashdata('message', 'ERROR : 접근권한이 없습니다.', 'refresh');
            redirect('/');
        }
    }
}