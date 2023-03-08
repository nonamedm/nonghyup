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

            case 'cfg': // 정리 필요
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

            case 'file': // 정리 필요
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
                     'idx'              =>''    // 인덱스
                    ,'crt_dtms'         =>''    // 등록일시
                    ,'usr_id'           =>''    // 아이디
                    ,'usr_sdct_nm'      =>''    // 선도센터이름
                    ,'usr_sdct_cd'      =>''    // 선도센터코드
                    ,'usr_schl_nm'      =>''    // 학교이름
                    ,'usr_schl_cd'      =>''    // 학교코드
                    ,'usr_major'        =>''    // 전공
                    ,'usr_grade'        =>''    // 학년
                    ,'usr_nm'           =>''    // 이름
                    ,'usr_mbl_num'      =>''    // 휴대폰
                    ,'usr_lv'           =>''    // 메일인증
                    ,'usr_status'       =>''    // 관리자승인
                    ,'vote_idx'         =>''    // 예선작품 번호
                    ,'brd_schl_nm'      =>''    // 예선작품제출한 학생의 학교
                    ,'brd_schl_cd'      =>''    // 예선작품제출한 학생의 학교코드
                    ,'post_opt'         =>''    // 예선작품을 제출한 학생의 팀명
                    ,'post_subj'        =>''    // 예선작품 제목
                    ,'brd_sdct_nm'      =>''    // 예선작품 선도센터명
                    ,'brd_sdct_cd'      =>''    // 예선작품 선도센터코드
                    ,'final_idx'        =>''    // 본선작품 번호
                    ,'brd_schl_nm1'     =>''    // 본선작품제출한 학생의 학교
                    ,'brd_schl_cd1'     =>''    // 본선작품제출한 학생의 학교코드
                    ,'post_opt1'        =>''    // 본선작품을 제출한 학생의 팀명
                    ,'post_subj1'       =>''    // 본선작품 제목
                    ,'brd_sdct_nm1'     =>''    // 본선작품 선도센터명
                    ,'brd_sdct_cd1'     =>''    // 본선작품 선도센터코드

                );
                break;

            case 'qna_excel':
                $rtn_schema = array(
                     'idx'          =>'인덱스'
                    ,'usr_id'       =>'참가자아이디'
                    ,'crt_dtms'     =>'등록일시'
                    ,'post_typ'     =>'대상지구'
                    ,'post_subj'    =>'제목'
                    ,'post_cont'    =>'내용'
                );
                break;

            default:
                throw new \Exception('Unexpected value');

        }
        return $rtn_schema;
    }
}