<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DL_schema
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }


    /*
     * --------------------------------------------------
     * G E T  S C H E M A
     * --------------------------------------------------
     * perm
     * basic
     * news
     * search
     * contact
     * dnload
     * usr
     * cfg
     * file
     * mail_queue
     * usr_excel
     * qna_excel
     *
     */
    public function get_schema($type='')
    {
        $rtn_schema = array();
        switch ($type) {
            case 'perm':
                $rtn_schema = array(
                     'post_li'      =>''    // post lists
                    ,'post_vi'      =>''    // post view
                    ,'post_mo'      =>''    // post modify
                    ,'post_re'      =>''    // post reply
                    ,'post_wr'      =>''    // post write
                    ,'cmt_li'       =>''    // commment lists
                    ,'cmt_wr'       =>''    // commment write
                    ,'cmt_mo'       =>''    // commment modify
                    ,'like_add'     =>''    // like add
                    ,'like_dec'     =>''    // like decrease
                    ,'insrt'        =>''    // insert
                    ,'updt'         =>''    // update
                    ,'dlt'          =>''    // delete
                    ,'dwnld'        =>''    // download
                );
                break;

            case 'basic':
                $rtn_schema = array(
                     'idx'              =>''
                    ,'ord'              =>''
                    ,'crt_dtms'         =>''
                    ,'crt_ip'           =>''
                    ,'updt_dtms'        =>''
                    ,'updt_ip'          =>''
                    ,'post_cfg'         =>''
                    ,'post_lng'         =>''
                    ,'post_hit'         =>''
                    ,'post_like'        =>''
                    ,'post_status'      =>''
                    ,'post_cat'         =>''
                    ,'post_typ'         =>''
                    ,'post_field'       =>''
                    ,'post_opt'         =>''
                    ,'post_subj'        =>''
                    ,'post_cont'        =>''
                    ,'post_link_addr'   =>''
                    ,'post_link_addr'   =>''
                    ,'post_file_cnt'    =>''
                    ,'post_cmt_cnt'     =>''
                    ,'post_summary'     =>''
                    ,'post_keyword'     =>''
                    ,'post_dtms'        =>''
                    ,'usr_id'           =>''
                    ,'usr_nm'           =>''
                );
                break;

            case 'news':
                $rtn_schema = array(
                     'idx'              =>''
                    ,'crt_dtms'         =>''
                    ,'crt_ip'           =>''
                    ,'updt_dtms'        =>''
                    ,'updt_ip'          =>''
                    ,'files'            =>''
                    ,'post_hit'         =>''
                    ,'pub_dtms'         =>''
                    ,'post_cfg'         =>''
                    ,'post_lng'         =>''
                    ,'post_status'      =>''
                    ,'post_cat'         =>''
                    ,'post_typ'         =>''
                    ,'post_field'       =>''
                    ,'post_opt'         =>''
                    ,'post_subj'        =>''
                    ,'post_cont'        =>''
                    ,'usr_id'           =>''
                    ,'usr_nm'           =>''
                );
                break;

            case 'search':
                $rtn_schema = array(
                     'idx'              =>''
                    ,'crt_ip'           =>''
                    ,'crt_dtms'         =>''
                    ,'updt_ip'          =>''
                    ,'updt_dtms'        =>''
                    ,'files'            =>''
                    ,'post_hit'         =>''
                    ,'post_cfg'         =>''
                    ,'post_lng'         =>''
                    ,'post_cat'         =>''
                    ,'post_typ'         =>''
                    ,'post_field'       =>''
                    ,'post_opt'         =>''
                    ,'post_subj'        =>''
                    ,'post_cont'        =>''
                    ,'usr_id'           =>''
                    ,'usr_nm'           =>''
                );
                break;

            case 'qna':
                $rtn_schema = array(
                     'idx'              =>''
                    ,'ord'              =>''
                    ,'crt_dtms'         =>''
                    ,'crt_ip'           =>''
                    ,'updt_dtms'        =>''
                    ,'updt_ip'          =>''
                    ,'trgt_idx'         =>''
                    ,'post_cfg'         =>''
                    ,'post_lng'         =>''
                    ,'post_hit'         =>''
                    ,'post_like'        =>''
                    ,'post_status'      =>''
                    ,'post_cat'         =>''
                    ,'post_typ'         =>''
                    ,'post_field'       =>''
                    ,'post_opt'         =>''
                    ,'post_subj'        =>''
                    ,'post_cont'        =>''
                    ,'post_link_addr'   =>''
                    ,'post_link_addr'   =>''
                    ,'post_reply_cnt'   =>''
                    ,'post_file_cnt'    =>''
                    ,'post_cmt_cnt'     =>''
                    ,'post_summary'     =>''
                    ,'post_keyword'     =>''
                    ,'post_dtms'        =>''
                    ,'usr_id'           =>''
                    ,'usr_nm'           =>''
                );
                break;

            case 'reply':
                $rtn_schema = array(
                     'idx'          =>''
                    ,'ord'          =>''
                    ,'crt_dtms'     =>''
                    ,'crt_ip'       =>''
                    ,'updt_dtms'    =>''
                    ,'updt_ip'      =>''
                    ,'trgt_id'      =>''
                    ,'trgt_idx'     =>''
                    ,'post_hit'     =>''
                    ,'post_status'  =>''
                    ,'post_opt'     =>''
                    ,'post_subj'    =>''
                    ,'post_cont'    =>''
                    ,'usr_id'       =>''
                    ,'usr_nm'       =>''
                );
                break;

            case 'dnload':
                $rtn_schema = array(
                     'idx'              =>''
                    ,'crt_ip'           =>''
                    ,'crt_dtms'         =>''
                    ,'updt_ip'          =>''
                    ,'updt_dtms'        =>''
                    ,'open_mode'        =>''
                    ,'open_dtms'        =>''
                    ,'close_mode'       =>''
                    ,'close_dtms'       =>''
                    ,'file_status'      =>''
                    ,'file_perm'        =>''
                    ,'files'            =>''
                    ,'post_hit'         =>''
                    ,'post_cfg'         =>''
                    ,'post_lng'         =>''
                    ,'post_cat'         =>''
                    ,'post_typ'         =>''
                    ,'post_field'       =>''
                    ,'post_opt'         =>''
                    ,'post_subj'        =>''
                    ,'post_cont'        =>''
                    ,'usr_idx'          =>''
                );
                break;

            case 'usr':
                $rtn_schema = array(
                     'idx'                  =>''
                    ,'crt_dtms'             =>''
                    ,'crt_ip'               =>''
                    ,'updt_dtms'            =>''
                    ,'updt_ip'              =>''
                    ,'dlt_dtms'             =>''
                    ,'dlt_ip'               =>''
                    ,'usr_id'               =>''
                    ,'usr_nm'               =>''
                    ,'usr_nm_hash'          =>''
                    ,'usr_email'            =>''
                    ,'usr_email_hash'       =>''
                    ,'usr_lv'               =>''
                    ,'usr_status'           =>''
                    ,'usr_agr_terms_dtms'   =>''
                    ,'usr_agr_pri_dtms'     =>''
                    ,'usr_agr_copy_dtms'    =>''
                    ,'usr_last_login_dtms'  =>''
                    ,'usr_last_login_ip'    =>''
                );
                break;

            case 'cfg': // ?????? ??????
                $rtn_schema = array(
                     'idx'      =>''
                    ,'c_cfg'    =>''
                    ,'c_subj'   =>''
                    ,'c_cont'   =>''
                    ,'c_wid'    =>''
                    ,'c_uid'    =>''
                    ,'c_wtime'  =>''
                    ,'c_utime'  =>''
                    ,'c_hit'    =>''
                    ,'c_files'  =>''
                    ,'c_cat'    =>''
                    ,'c_type'   =>''
                    ,'c_field'  =>''
                    ,'c_opt'    =>''
                    ,'c_lng'    =>''
                    ,'c_status' =>''
                    ,'c_ip'     =>''
                    ,'c_1'      =>''
                    ,'c_2'      =>''
                    ,'c_3'      =>''
                    ,'c_4'      =>''
                    ,'c_5'      =>''
                );
                break;

            case 'file': // ?????? ??????
                $rtn_schema = array(
                     'idx'              =>''
                    ,'trgt_id'          =>''
                    ,'trgt_idx'         =>''
                    ,'crt_dtms'         =>''
                    ,'crt_ip'           =>''
                    ,'updt_dtms'        =>''
                    ,'updt_ip'          =>''
                    ,'file_ord'         =>''
                    ,'file_status'      =>''
                    ,'file_name'        =>''
                    ,'file_type'        =>''
                    ,'file_path'        =>''
                    ,'full_path'        =>''
                    ,'raw_name'         =>''
                    ,'orig_name'        =>''
                    ,'client_name'      =>''
                    ,'file_ext'         =>''
                    ,'file_size'        =>''
                    ,'is_image'         =>''
                    ,'image_width'      =>''
                    ,'image_height'     =>''
                    ,'image_type'       =>''
                    ,'image_size_str'   =>''
                    ,'download_yn'      =>''
                );
                break;

            case 'mail_queue': // v1.1
                $rtn_schema = array(
                    'idx'          =>'',
                    'c_cfg'        =>'',
                    'c_subj'       =>'',
                    'c_from_id'    =>'',
                    'c_from_name'  =>'',
                    'c_from_email' =>'',
                    'c_to_id'      =>'',
                    'c_to_name'    =>'',
                    'c_to_email'   =>'',
                    'c_to_pin'     =>'',
                    'c_to_tel'     =>'',
                    'c_to_state'   =>'',
                    'c_cont_id'    =>'',
                    'c_cont_idx'   =>'',
                    'c_cont'       =>'',
                    //'c_wtime'    =>'',
                    'c_ip'         =>'',
                    'c_1'          =>'',
                    'c_2'          =>'',
                    'c_3'          =>'',
                    'c_4'          =>'',
                    'c_5'          =>''
                );
                break;

            case 'usr_excel':
                $rtn_schema = array(
                     'idx'              =>''    // ?????????
                    ,'crt_dtms'         =>''    // ????????????
                    ,'usr_id'           =>''    // ?????????
                    ,'usr_sdct_nm'      =>''    // ??????????????????
                    ,'usr_sdct_cd'      =>''    // ??????????????????
                    ,'usr_schl_nm'      =>''    // ????????????
                    ,'usr_schl_cd'      =>''    // ????????????
                    ,'usr_major'        =>''    // ??????
                    ,'usr_grade'        =>''    // ??????
                    ,'usr_nm'           =>''    // ??????
                    ,'usr_mbl_num'      =>''    // ?????????
                    ,'usr_lv'           =>''    // ????????????
                    ,'usr_status'       =>''    // ???????????????
                    ,'vote_idx'         =>''    // ???????????? ??????
                    ,'brd_schl_nm'      =>''    // ????????????????????? ????????? ??????
                    ,'brd_schl_cd'      =>''    // ????????????????????? ????????? ????????????
                    ,'post_opt'         =>''    // ??????????????? ????????? ????????? ??????
                    ,'post_subj'        =>''    // ???????????? ??????
                    ,'brd_sdct_nm'      =>''    // ???????????? ???????????????
                    ,'brd_sdct_cd'      =>''    // ???????????? ??????????????????
                    ,'final_idx'        =>''    // ???????????? ??????
                    ,'brd_schl_nm1'     =>''    // ????????????????????? ????????? ??????
                    ,'brd_schl_cd1'     =>''    // ????????????????????? ????????? ????????????
                    ,'post_opt1'        =>''    // ??????????????? ????????? ????????? ??????
                    ,'post_subj1'       =>''    // ???????????? ??????
                    ,'brd_sdct_nm1'     =>''    // ???????????? ???????????????
                    ,'brd_sdct_cd1'     =>''    // ???????????? ??????????????????

                );
                break;

            case 'qna_excel':
                $rtn_schema = array(
                     'idx'          =>'?????????'
                    ,'usr_id'       =>'??????????????????'
                    ,'crt_dtms'     =>'????????????'
                    ,'post_typ'     =>'????????????'
                    ,'post_subj'    =>'??????'
                    ,'post_cont'    =>'??????'
                );
                break;

            default:
                throw new \Exception('Unexpected value');

        }
        return $rtn_schema;
    }
}