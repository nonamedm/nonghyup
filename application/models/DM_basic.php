<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DM_basic extends CI_MODEL
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
    }


    function getByUid($option)
    {
        $sql = " SELECT * FROM `" . $this->db->escape_str($option['tb_id']) . "` WHERE `usr_id` = '" . $this->db->escape_str($option['usr_id']) . "'";
        $query = $this->db->query($sql);
        $result = $query->result();
        $res = json_decode(json_encode($result), true);
        if ($res) {
            return $res[0];
        } else {
            return false;
        }
    }

    /*
     * --------------------------------------------------------------------------
     * I N S E R T - U S E R
     * --------------------------------------------------------------------------
    */
    function insert_user($option = '')
    {
        if ($option) {
            // common
            $this->load->helper('date');
            $data = $option['fields'];

            $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
            $data['usr_agr_terms_dtms'] = mdate($datestring, $time);
            $data['usr_agr_pri_dtms'] = mdate($datestring, $time);
            //$data['usr_agr_copy_dtms'] = mdate($datestring, $time);

            $data['usr_last_login_dtms'] = mdate($datestring, $time);
            $data['crt_dtms'] = mdate($datestring, $time);

            // insert
            $this->db->insert($option['tb_id'], $data);
            return $this->db->insert_id(); // index 리턴
        } else {
            show_404('error - model common user insert', TRUE);
        }
    }


    /*
     * --------------------------------------------------------------------------
     * U P D A T E - U S E R
     * --------------------------------------------------------------------------
    */
    function update_user($option = '')
    {
        if ($option) {
            // common
            $this->load->helper('date');
            $data = $option['fields'];

            $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
            $data['usr_last_login_dtms'] = mdate($datestring, $time);
            $data['updt_dtms'] = mdate($datestring, $time);

            // update
            $this->db->update($option['tb_id'], $data, array('usr_id' => $data['usr_id']));
            return $this->db->affected_rows();
        } else {
            show_404('error - model common reg update', TRUE);
        }
    }


    /*
     * --------------------------------------------------------------------------
     * G E T - L I S T - A L L :: BBS
     * --------------------------------------------------------------------------
     * tb_id 값으로 해당 table의 모든행을 가져온다
     * --------------------------------------------------------------------------
    */
    function getList($option = null)
    {
//        print_r($option);
        if ($option) {
            $rtn = false;
            $sql = " SELECT * FROM `" . $this->db->escape_str($option['tb_id']) . "` WHERE 1=1 ";

            if ($option['tb_id'] == "ct_usr") {

                if (isset($option['usr_status']) && $option['usr_status'] != '') {
                    $sql .= ' AND usr_status = "' . $this->db->escape_str($option['usr_status']) . '"';
                }

                if (isset($option['s_word_hash']) && $option['s_word_hash']) { // 참관자 및 관리자 제외
                    $sql .= ' AND ( usr_nm_hash = "' .$option['s_word_hash']. '" OR usr_email_hash = "' .$option['s_word_hash'].'" OR usr_id LIKE "%' .$option['s_word']. '%") ';
                }
            } else {
                if (isset($option['usr_id']) && $option['usr_id']) {
                    $sql .= ' AND usr_id = "' . $this->db->escape_str($option['usr_id']) . '"';
                }

                if (isset($option['post_status']) && $option['post_status']) {
                    $sql .= ' AND post_status = "' . $this->db->escape_str($option['post_status']) . '"';
                }

                if (isset($option['post_lng']) && $option['post_lng']) {
                    $sql .= ' AND post_lng = "' . $this->db->escape_str($option['post_lng']) . '"';
                }

                if (isset($option['post_cat']) && $option['post_cat']) { // current cat
                    $sql .= ' AND post_cat = "' . $this->db->escape_str($option['post_cat']) . '" ';
                }

                if (isset($option['post_opt']) && $option['post_opt']) { // current opt
                    $sql .= ' AND  post_opt = "' . $this->db->escape_str($option['post_opt']) . '" ';
                }

                if (isset($option['trgt_id']) && $option['trgt_id']) { // comment : 대상 테이블
                    $sql .= ' AND trgt_id = "' . $this->db->escape_str($option['trgt_id']) . '"';
                }

                if (isset($option['trgt_idx']) && $option['trgt_idx']) { // comment : 대상 글 idx
                    $sql .= ' AND trgt_idx = "' . $this->db->escape_str($option['trgt_idx']) . '"';
                }

                if (isset($option['s_word']) && $option['s_word']) { // 참관자 및 관리자 제외
                    $sql .= ' AND (';
                    $sql .= ' post_field LIKE "%' . $this->db->escape_str($option['s_word']) . '%" ';
                    $sql .= ' OR post_subj LIKE "%' . $this->db->escape_str($option['s_word']) . '%" ';
                    $sql .= ' OR post_keyword LIKE "%' . $this->db->escape_str($option['s_word']) . '%" ';
                    //if ($option['tb_id']=="ct_precedent") {
                    //    $sql .= ' OR post_cat LIKE "%'.$option['s_word'].'%" ';
                    //}
                    $sql .= ') ';
                }

                //current 초성 조회
                if (isset($option['initial']) && $option['initial']) { // 참관자 및 관리자 제외
                    $sql .= ' AND (';

                    if($option['initial'] == 'ㄱ') {
                        $sql .=  " post_subj RLIKE '^(ㄱ|ㄲ)' OR (post_subj >='가' AND post_subj <'나')";
                    } else if($option['initial'] == 'ㄴ'){
                        $sql .= " post_subj RLIKE '^ㄴ' OR (post_subj >='나' AND post_subj <'다')";
                    } else if($option['initial'] == 'ㄷ'){
                        $sql .= " post_subj RLIKE '^(ㄷ|ㄸ)' OR (post_subj >='다' AND post_subj <'라')";
                    } else if($option['initial'] == 'ㄹ'){
                        $sql .= " post_subj RLIKE '^ㄹ' OR (post_subj >='라' AND post_subj <'마')";
                    } else if($option['initial'] == 'ㅁ'){
                        $sql .= " post_subj RLIKE '^ㅁ' OR (post_subj >='마' AND post_subj <'바')";
                    } else if($option['initial'] == 'ㅂ'){
                        $sql .= " post_subj RLIKE '^ㅂ' OR (post_subj >='바' AND post_subj <'사')";
                    } else if($option['initial'] == 'ㅅ'){
                        $sql .= " post_subj RLIKE '^(ㅅ|ㅆ)' OR (post_subj >='사' AND post_subj <'아')";
                    } else if($option['initial'] == 'ㅇ'){
                        $sql .= " post_subj RLIKE '^ㅇ' OR (post_subj >='아' AND post_subj <'자')";
                    } else if($option['initial'] == 'ㅈ'){
                        $sql .= " post_subj RLIKE '^(ㅈ|ㅉ)' OR (post_subj >='자' AND post_subj <'차')";
                    } else if($option['initial'] == 'ㅊ'){
                        $sql .= " post_subj RLIKE '^ㅊ' OR (post_subj >='차' AND post_subj <'카')";
                    } else if($option['initial'] == 'ㅋ'){
                        $sql .= " post_subj RLIKE '^ㅋ' OR (post_subj >='카' AND post_subj <'타')";
                    } else if($option['initial'] == 'ㅌ'){
                        $sql .= " post_subj RLIKE '^ㅌ' OR (post_subj >='타' AND post_subj <'파')";
                    } else if($option['initial'] == 'ㅍ'){
                        $sql .= " post_subj RLIKE '^ㅍ' OR (post_subj >='파' AND post_subj <'하')";
                    } else if($option['initial'] == 'ㅎ'){
                        $sql .= " post_subj RLIKE '^ㅎ' OR (post_subj >='하')";
                    }
                    $sql .= ') ';
                }

                // 왜 like검색을 하지? 입력시 중복선택 때문..그렇다면 해당 게시핀에 한해서
                if (isset($option['s_cat']) && $option['s_cat']) { // current opt
                    $sql .= ' AND  post_cat LIKE "%' . $this->db->escape_str($option['s_cat']) . '%" ';
                }

                if ((isset($option['s_sds']) && $option['s_sds']) && (isset($option['s_sde']) && $option['s_sde'])) { // 참관자 및 관리자 제외
                    $sql .= ' AND post_dtms >= "' . $this->db->escape_str($option['s_sds']) . '" ';
                    $sql .= ' AND post_dtms <= "' . $this->db->escape_str($option['s_sde']) . '" ';
                }

                if (isset($option['s_lng']) && $option['s_lng']) { // current opt
                    $sql .= ' AND  post_lng = "' . $this->db->escape_str($option['s_lng']) . '" ';
                }

                if (isset($option['s_fld']) && $option['s_fld']) { // current opt
                    $sql .= ' AND  post_field = "' . $this->db->escape_str($option['s_fld']) . '" ';
                }

                if (isset($option['s_typ']) && $option['s_typ']) { // current opt
                    $sql .= ' AND  post_typ = "' . $this->db->escape_str($option['s_typ']) . '" ';
                }

                if (isset($option['group']) && $option['group']) {
                    $sql .= ' GROUP BY ' . $this->db->escape_str($option['group']) . ' ';
                }
            }

//            if (isset($option['order']) && $option['order']) {
//                $sql .= ' ORDER BY ' . $this->db->escape_str($option['order']);
//            }

            
            // if (isset($option['li_st']) && isset($option['li_num']) && $option['li_num']) {
            //     $sql .= ' LIMIT ' . $this->db->escape_str($option['li_st']) . ', ' . $this->db->escape_str($option['li_num']);
            //  && $option['initial_sound'] }

            if (isset($option['li_st']) && isset($option['li_num']) && $option['li_num'] && $option['tb_id'] != 'ct_current') {
                if(isset($option['order']) && $option['order']){
                    $sql .= ' ORDER BY post_fix DESC,post_fix_num *1 ASC,'. $this->db->escape_str($option['order']);
                }
                $sql .= ' LIMIT ' . $this->db->escape_str($option['li_st']) . ', ' . $this->db->escape_str($option['li_num']);
            } 

//            echo $sql;
            $query = $this->db->query($sql);
            $result = $query->result();

            if ($result) {
                $rtn = json_decode(json_encode($result), true);
            } else {
                $rtn = $result;
            }
            return $rtn;
        }else{
            show_404('error - DM_basic > updateWrongPwd', TRUE);
        }

    }


    /*
     * --------------------------------------------------------------------------
     * G E T - L I S T - C O U N T :: BBS
     * --------------------------------------------------------------------------
     * tb_id 값으로 해당 table의 게시물 갯수를 가져온다
     * --------------------------------------------------------------------------
    */
    function getList_count($option = null)
    {
        //print_r($option);
        if ($option) {
            if ($option['tb_id'] == "ct_usr") {
                if (isset($option['usr_lv']) && $option['usr_lv']) {
                    $this->db->where('usr_lv', $option['usr_lv']);
                }

                if (isset($option['usr_status']) && $option['usr_status']) {
                    $this->db->where('usr_status', $option['usr_status']);
                }

                if (isset($option['trgt_id']) && $option['trgt_id']) { // comment : 대상 테이블
                    $this->db->where('trgt_id', $option['trgt_id']);
                }

                if (isset($option['trgt_idx']) && $option['trgt_idx']) { // comment : 대상 글 idx
                    $this->db->where('trgt_idx', $option['trgt_idx']);
                }

                if (isset($option['s_word_hash']) && $option['s_word_hash']) { // 참관자 및 관리자 제외
                    $this->db->like('usr_nm_hash', $option['s_word_hash']);
                    $this->db->or_like('usr_email_hash', $option['s_word_hash']);
                    $this->db->or_like('usr_id', $option['s_word']);
                }

            } else if ($option['tb_id'] == "ct_qna" || $option['tb_id'] == "ct_improvement") {
                if (isset($option['usr_id']) && $option['usr_id']) {
                    $this->db->where('usr_id', $option['usr_id']);
                }

                if (isset($option['trgt_idx']) && $option['trgt_idx']) { // comment : 대상 글 idx
                    $this->db->where('trgt_idx', $option['trgt_idx']);
                }

                if (isset($option['s_word']) && $option['s_word']) { // 참관자 및 관리자 제외
                    $this->db->like('usr_nm', $option['s_word']);
                    $this->db->or_like('usr_id', $option['s_word']);
                    $this->db->or_like('usr_email', $option['s_word']);
                }
            } else {
                if (isset($option['usr_id']) && $option['usr_id']) { // current cat
                    $this->db->where('usr_id', $option['usr_id']);
                }

                if (isset($option['post_cat']) && $option['post_cat']) { // current cat
                    $this->db->where('post_cat', $option['post_cat']);
                }

                if (isset($option['post_opt']) && $option['post_opt']) { // current opt
                    $this->db->where('post_opt', $option['post_opt']);
                }

                if (isset($option['post_status']) && $option['post_status']) {
                    $this->db->where('post_status', $option['post_status']);
                }

                if (isset($option['post_lng']) && $option['post_lng']) {
                    $this->db->where('post_lng', $option['post_lng']);
                }

                if (isset($option['trgt_id']) && $option['trgt_id']) { // comment : 대상 테이블
                    $this->db->where('trgt_id', $option['trgt_id']);
                }

                if (isset($option['trgt_idx']) && $option['trgt_idx']) { // comment : 대상 글 idx
                    $this->db->where('trgt_idx', $option['trgt_idx']);
                }

                if (isset($option['s_word']) && $option['s_word']) { // 참관자 및 관리자 제외
                    $this->db->like('post_field', $option['s_word']);
                    $this->db->or_like('post_subj', $option['s_word']);
                    $this->db->or_like('post_keyword', $option['s_word']);
                    //if($option['tb_id']=='ct_precedent'){
                    //    $this->db->or_like('post_cat', $option['s_cat']);
                    //}
                }

                //initial 초성 검색
                if (isset($option['initial']) && $option['initial']) { // 참관자 및 관리자 제외
                
                    $count_sql = ' (';

                    if($option['initial'] == 'ㄱ') {
                        $count_sql .= "post_subj RLIKE '^(ㄱ|ㄲ)' OR (post_subj >='가' AND post_subj <'나')";
                    } else if($option['initial'] == 'ㄴ'){
                        $count_sql .= "post_subj RLIKE '^ㄴ' OR (post_subj >='나' AND post_subj <'다')";
                    } else if($option['initial'] == 'ㄷ'){
                        $count_sql .= "post_subj RLIKE '^(ㄷ|ㄸ)' OR (post_subj >='다' AND post_subj <'라')";
                    } else if($option['initial'] == 'ㄹ'){
                        $count_sql .= "post_subj RLIKE '^ㄹ' OR (post_subj >='라' AND post_subj <'마')";
                    } else if($option['initial'] == 'ㅁ'){
                        $count_sql .= "post_subj RLIKE '^ㅁ' OR (post_subj >='마' AND post_subj <'바')";
                    } else if($option['initial'] == 'ㅂ'){
                        $count_sql .= "post_subj RLIKE '^ㅂ' OR (post_subj >='바' AND post_subj <'사')";
                    } else if($option['initial'] == 'ㅅ'){
                        $count_sql .= "post_subj RLIKE '^(ㅅ|ㅆ)' OR (post_subj >='사' AND post_subj <'아')";
                    } else if($option['initial'] == 'ㅇ'){
                        $count_sql .= "post_subj RLIKE '^ㅇ' OR (post_subj >='아' AND post_subj <'자')";
                    } else if($option['initial'] == 'ㅈ'){
                        $count_sql .= "post_subj RLIKE '^(ㅈ|ㅉ)' OR (post_subj >='자' AND post_subj <'차')";
                    } else if($option['initial'] == 'ㅊ'){
                        $count_sql .= "post_subj RLIKE '^ㅊ' OR (post_subj >='차' AND post_subj <'카')";
                    } else if($option['initial'] == 'ㅋ'){
                        $count_sql .= "post_subj RLIKE '^ㅋ' OR (post_subj >='카' AND post_subj <'타')";
                    } else if($option['initial'] == 'ㅌ'){
                        $count_sql .= "post_subj RLIKE '^ㅌ' OR (post_subj >='타' AND post_subj <'파')";
                    } else if($option['initial'] == 'ㅍ'){
                        $count_sql .= "post_subj RLIKE '^ㅍ' OR (post_subj >='파' AND post_subj <'하')";
                    } else if($option['initial'] == 'ㅎ'){
                        $count_sql .= "post_subj RLIKE '^ㅎ' OR (post_subj >='하')";
                    }
                    $count_sql .= ') ';

                    $this->db->where($count_sql, NULL, FALSE);
                    //$this->db->like('post_subj', $option['initial']);
                }


                if (isset($option['s_cat']) && $option['s_cat']) { // comment : 대상 글 idx
                    $this->db->like('post_cat', $option['s_cat']);
                }
                if ((isset($option['s_sds']) && $option['s_sds']) && (isset($option['s_sde']) && $option['s_sde'])) {
                    $this->db->where('post_dtms >', $option['s_sds']);
                    $this->db->where('post_dtms <', $option['s_sde']);
                }
                if (isset($option['s_lng']) && $option['s_lng']) {
                    $this->db->where('post_lng', $option['s_lng']);
                }
                if (isset($option['s_fld']) && $option['s_fld']) {
                    $this->db->where('post_field', $option['s_fld']);
                }
                if (isset($option['s_typ']) && $option['s_typ']) {
                    $this->db->where('post_typ', $option['s_typ']);
                }
            }
            $this->db->from($option['tb_id']);
            return $this->db->count_all_results();
        } else {
            show_404('error - DM_basic > updateWrongPwd', TRUE);
        }
    }

    //
    function getList_qna($option = null)
    {
        if ($option) {
            $rtn = false;
            $sql = " SELECT * FROM `" . $option['tb_id'] . "` WHERE trgt_idx IN( SELECT trgt_idx FROM `" . $option['tb_id'] . "` WHERE 1=1 ";

            if (isset($option['usr_id']) && $option['usr_id']) {
                $sql .= ' AND usr_id = "' . $this->db->escape_str($option['usr_id']) . '"';
            }

            $sql .= ' GROUP BY  usr_id )';

            if (isset($option['order']) && $option['order']) {
                $sql .= ' ORDER BY ' . $this->db->escape_str($option['order']);
            }

            if (isset($option['li_st']) && isset($option['li_num']) && $option['li_num']) {
                $sql .= ' LIMIT ' . $this->db->escape_str($option['li_st']) . ', ' . $this->db->escape_str($option['li_num']);
            }
            //echo $sql;
            $query = $this->db->query($sql);
            $result = $query->result();

            if ($result) {
                $rtn = json_decode(json_encode($result), true);
            } else {
                $rtn = $result;
            }
            return $rtn;
        }else{
            show_404('error - DM_basic > updateWrongPwd', TRUE);
        }

    }


    /**
     *
     * getList_sch
     *
     */
    function getResult_sch($option)
    {
        if ($option) {
            $rtn = '';
            $sql = " SELECT * FROM `" . $this->db->escape_str($option['tb_id']) . "` WHERE 1=1 ";
            $sql .= ' AND (post_subj LIKE "%' . $this->db->escape_str($option['s_val']) . '%" OR post_cont LIKE "%' . $this->db->escape_str($option['s_val']) . '%" OR post_keyword LIKE "%' . $this->db->escape_str($option['s_val']) . '%") ';
            if (isset($option['s_rfsw']) && $option['s_rfsw']) {
                $sql .= ' AND (post_subj LIKE "%' . $this->db->escape_str($option['s_rfsw']) . '%" OR post_cont LIKE "%' . $this->db->escape_str($option['s_rfsw']) . '%" OR post_keyword LIKE "%' . $this->db->escape_str($option['s_rfsw']) . '%") ';
            }
            if (isset($option['s_sds']) && $option['s_sds']) {
                $sql .= ' AND crt_dtms >= "' . $this->db->escape_str($option['s_sds']) . '" ';
            }
            if (isset($option['s_sde']) && $option['s_sde']) {
                $sql .= ' AND crt_dtms <= "' . $this->db->escape_str($option['s_sde']) . '" ';
            }

            $sql .= ' ORDER BY post_dtms DESC, crt_dtms DESC ';

            //$rtn = $sql;
            $query = $this->db->query($sql);
            $result = $query->result();

            if ($result) {
                $rtn = json_decode(json_encode($result), true);
            } else {
                $rtn = $result;
            }
            return $rtn;
        }else{
            show_404('error - DM_basic > updateWrongPwd', TRUE);
        }
    }


    /*
     * --------------------------------------------------------------------------
     * S E T - I N S E R T :: BBS
     * --------------------------------------------------------------------------
     * tb_id 해당 table에 게시물을 추가
     * --------------------------------------------------------------------------
    */
    function setInsert($option = '')
    {
        if ($option) {
            // *****
            $data = $option['fields'];

            if (isset($data['crt_dtms']) && $data['crt_dtms'] == '') {
                // ***** crt_dtms
                $this->load->helper('date');
                $datestring = '%Y-%m-%d %h:%i:%s';
                $time = time();
                $data['crt_dtms'] = mdate($datestring, $time);
            }
            //print_r($data);
            // *****
            $this->db->insert($option['tb_id'], $data);
            return $this->db->insert_id();
        } else {
            show_404('error - model insert error', TRUE);
        }
    }


    function updateCnt($option = '')
    {
        if ($option) {
            $data[$this->db->escape_str($option['trgt_id'])] = $this->db->escape_str($option['trgt_val']);

            // ***** usr_pw_updt_dtms
            $this->load->helper('date');
            $datestring = '%Y:%m:%d-%h:%i:%s';
            $time = time();
            $data['updt_dtms'] = mdate($datestring, $time);

//print_r($data);
            // *****
            $this->db->update($option['tb_id'], $data, array('idx' => $option['idx']));
            //return $this->db->affected_rows();
        } else {
            show_404('error - model common pidxUpdate');
        }
    }


    function updateLogin($option = '')
    {
        if ($option) {
            $data['usr_last_login_ip'] = $option['usr_last_login_ip'];

            // ***** usr_pw_updt_dtms
            $this->load->helper('date');
            $datestring = '%Y:%m:%d-%h:%i:%s';
            $time = time();
            $data['usr_last_login_dtms'] = mdate($datestring, $time);

//print_r($data);
            // *****
            $this->db->update($option['tb_id'], $data, array('usr_id' => $option['usr_id']));
            return $this->db->affected_rows();
        } else {
            show_404('error - model common pidxUpdate');
        }


    }

    /*
    --------------------------------------------------------------------------
     G E T - V I E W :: BBS
    --------------------------------------------------------------------------
     tb_id, idx 값으로 해당 table의 게시물 갯수를 가져온다
    --------------------------------------------------------------------------
    */
    function getView($option=null)
    {
        //var_dump( $option );
        if($option)
        {
            $rtn='';

            if( $option['tb_id']=='ct_usr' || $option['tb_id']=='ct_contact'){
                $sql = " SELECT * FROM `". $this->db->escape_str($option['tb_id']) ."` WHERE idx=". $this->db->escape_str($option['idx']) ." ";
            }else{
                $sql = " SELECT brd.* FROM `". $this->db->escape_str($option['tb_id']) ."` brd, `ct_usr` usr WHERE brd.idx=". $this->db->escape_str($option['idx']);
            }

            if( isset($option['usr_typ']) && $option['usr_typ'] )
            {
                $this->db->where('usr_typ', $option['usr_typ']);
            }
            //echo $sql;
            $query = $this->db->query($sql);
            $result = $query->result();
            if($result){
                $rtn = json_decode(json_encode($result), true);
                //print_r($rtn);
                return $rtn[0];
            }
        }else{
            show_404('error - DM_basic > updateWrongPwd', TRUE);
        }
    }


    function getView_qna($option=null)
    {
        if($option)
        {
            $rtn='';
            $sql = " SELECT * FROM `". $option['tb_id']."` WHERE idx=". $this->db->escape_str($option['idx']) ." AND usr_id='" .$this->db->escape_str($option['usr_id']). "'";
            //echo $sql;
            $query = $this->db->query($sql);
            $result = $query->result();
            if($result){
                $rtn = json_decode(json_encode($result), true);
                //print_r($rtn);
                $rtn= $rtn[0];
            }
            return $rtn;
        }else{
            show_404('error - DM_basic > updateWrongPwd', TRUE);
        }
    }


    function getData($option=null)
    {
        //var_dump( $option );
        if($option)
        {
            $rtn='';
            $sql = " SELECT * FROM `".$option['tb_id']."` WHERE post_cat<>'search' AND idx=". $this->db->escape_str($option['idx'])." ";

            //echo $sql;

            $query = $this->db->query($sql);
            $result = $query->result();
            if($result){
                $rtn = json_decode(json_encode($result), true);
                //print_r($rtn);
                return $rtn[0];
            }
        }else{
            show_404('error - DM_basic > updateWrongPwd', TRUE);
        }
    }


    function getMaxCnt($option=null) // getLast_ord
    {
        if($option)
        {
            $this->db->select_max($option['trgt_id']);

            if( isset($option['trgt_idx']) && $option['trgt_idx'] ){
                $this->db->where('trgt_idx', $option['trgt_idx']);
            }

            if( isset($option['usr_id']) && $option['usr_id'] ){
                $this->db->where('usr_id', $option['usr_id']);
            }

            $query = $this->db->get($option['tb_id']);
            $result = $query->result();
            if($result){
                $rtn = json_decode(json_encode($result), true)[0];
            }else{
                $rtn = $result;
            }
            return $rtn;

        }
        else
        {
            show_404('error - DM_basic > updateWrongPwd', TRUE);
        }
    }


    function update_trgt_idx($option=null)
    {
        if ($option)
        {
            $data['trgt_idx']= $this->db->escape_str($option['trgt_idx']);

//print_r($data);
            // *****
            $this->db->update( $option['tb_id'], $data, array('idx' => $option['idx']));
            return $this->db->affected_rows();
        }else{
            show_404('error - model common pidxUpdate');
        }
    }

    /*
    --------------------------------------------------------------------------
     G E T - P R E C - N E X T :: BBS
    --------------------------------------------------------------------------
     tb_id, idx 값으로 해당 table의 게시물 갯수를 가져온다
    --------------------------------------------------------------------------
    */
    function getPrev($option=null)
    {
        if($option)
        {
            $rtn=array();
            $sql = " SELECT 'prev' AS type, MAX(idx) AS idx FROM `".$option['tb_id']."` WHERE idx < ". $this->db->escape_str($option['idx'])." ";
            if(isset($option['post_lng']) && $option['post_lng']) {
                $sql .= " AND post_lng='" . $this->db->escape_str($option['post_lng']) . "' ";
            }
            if(isset($option['cat']) && $option['cat']){
                $sql .= " AND post_cat='". $this->db->escape_str($option['cat'])."' ";
            }else{
                $sql .= " AND post_cat<>'search' ";
            }
            $query = $this->db->query($sql);
            $result = $query->result();
            if($result){
                $rtn = json_decode(json_encode($result), true);
                //print_r($rtn);
                return $rtn[0];
            }
        }else{
            show_404('error - DM_basic > updateWrongPwd', TRUE);
        }
    }

    function getNext($option=null)
    {
        if($option)
        {
            $rtn=array();
            $sql = " SELECT 'next' AS type, MIN(idx) AS idx FROM `".$option['tb_id']."` WHERE idx > ". $this->db->escape_str($option['idx'])." ";
            if(isset($option['post_lng']) && $option['post_lng']) {
                $sql .= " AND post_lng='" . $this->db->escape_str($option['post_lng']) . "' ";
            }
            if(isset($option['cat']) && $option['cat']){
                $sql .= " AND post_cat='". $this->db->escape_str($option['cat']) ."' ";
            }else{
                $sql .= " AND post_cat<>'search' ";
            }
            $query = $this->db->query($sql);
            $result = $query->result();
            if($result){
                $rtn = json_decode(json_encode($result), true);
                //print_r($rtn);
                return $rtn[0];
            }
        }else{
            show_404('error - DM_basic > updateWrongPwd', TRUE);
        }
    }



    /*
     * --------------------------------------------------------------------------
     * S E T - U P D A T E :: BBS
     * --------------------------------------------------------------------------
     * tb_id, idx 값으로 해당 table의 게시물을 수정
     * --------------------------------------------------------------------------
    */
    function setUpdate($option='')
    {
        if($option)
        {
            // *****
            $data = $option['fields'];

            // ***** updt_dtms
            $this->load->helper('date');
            $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
            $data['updt_dtms'] = mdate($datestring, $time);


            //print_r($data);
            // *****
            $this->db->update($option['tb_id'], $data, array('idx' => $data['idx']));
            return $this->db->affected_rows();
        }
        else
        {
            show_404('error - model insert error', TRUE);
        }
    }



    /*
     * --------------------------------------------------------------------------
     * G E T - F I L E S :: BBS
     * --------------------------------------------------------------------------
     * tb_id, idx 값으로 해당 table의 files값을 가져옴
     * --------------------------------------------------------------------------
    */
    function getFiles($option='')
    {
        if($option)
        {
            $rtn='';
            $sql = " SELECT * FROM `".$option['tb_id']."` WHERE trgt_id='". $this->db->escape_str($option['trgt_id']) ."' AND trgt_idx=". $this->db->escape_str($option['trgt_idx'])." ";
            $query = $this->db->query($sql);
            $result = $query->result();
            if($result){
                $rtn = json_decode(json_encode($result), true);
                return $rtn;
            }
        }
        else
        {
            show_404('error - model insert error', TRUE);
        }
    }

    function getCnt($option='')
    {
        if($option)
        {
            $rtn='';
            $this->db->where('trgt_id', $option['trgt_id']);
            $this->db->where('trgt_idx', $option['trgt_idx']);
            $this->db->from($option['tb_id']);
            $result =$this->db->count_all_results();
            if($result){
                $rtn = json_decode(json_encode($result), true);
                return $rtn;
            }
        }
        else
        {
            show_404('error - model insert error', TRUE);
        }
    }

    function updtCnt($option='')
    {
        if($option)
        {
            $data['post_file_cnt'] = $this->db->escape_str($option['post_file_cnt']);
            $this->db->update( $option['tb_id'], $data, array('idx' => $option['idx']));
            return $this->db->affected_rows();
        }
        else
        {
            show_404('error - model common reg update', TRUE);
        }
    }

    function getFileInfo($option='')
    {

        if($option)
        {
            $rtn = false;
            $sql = " SELECT * FROM `".$option['tb_id']."` WHERE trgt_id='". $this->db->escape_str($option['trgt_id'])."' AND trgt_idx=". $this->db->escape_str($option['trgt_idx']);
            //echo $sql;
            $query = $this->db->query($sql);
            $result = $query->result();
            if($result){
                $rtn = json_decode(json_encode($result), true);
            }else{
                $rtn = $result;
            }
            return $rtn;
        }else{
            show_404('error - DM_basic > updateWrongPwd', TRUE);
        }

    }

    function getList_search($option=null)
    {
        $rtn = false;
        if($option)
        {
            $sql = " SELECT * FROM `".$option['tb_id']."` WHERE 1=1 ";

            if (isset($option['post_status']) && $option['post_status']) {
                $sql .= ' AND post_status = "'. $this->db->escape_str($option['post_status']).'"';
            }

            if (isset($option['s_cat']) && $option['s_cat']) {
                $sql .= ' AND post_cat = "'. $this->db->escape_str($option['s_cat']) .'"';
            }

            if (isset($option['s_lng']) && $option['s_lng']) {
                $sql .= ' AND post_lng = "'. $this->db->escape_str($option['s_lng']) .'"';
            }

            if (isset($option['s_field']) && $option['s_field']) {
                $sql .= ' AND post_field = "'. $this->db->escape_str($option['s_field']) .'"';
            }

            if (isset($option['s_typ']) && $option['s_typ']) {
                $sql .= ' AND post_typ = "'. $this->db->escape_str($option['s_typ']) .'"';
            }

            if($option['tb_id']=='ct_precedent' || $option['tb_id']=='ct_translate' || $option['tb_id']=='ct_noaction'){
                if ((isset($option['s_sds']) && $option['s_sds']) && (isset($option['s_sde']) && $option['s_sde'])) {
                    $sql .= ' AND post_dtms >= "'. $this->db->escape_str($option['s_sds']) .'" AND post_dtms <= "'. $this->db->escape_str($option['s_sde']) .'" ';
                }
            }else{
                if ((isset($option['s_sds']) && $option['s_sds']) && (isset($option['s_sde']) && $option['s_sde'])) {
                    $sql .= ' AND crt_dtms >= "'. $this->db->escape_str($option['s_sds']) .'" AND crt_dtms <= "'. $this->db->escape_str($option['s_sde']) .'" ';
                }
            }



            if (isset($option['s_word']) && $option['s_word']) { // 참관자 및 관리자 제외
                $sql .= ' AND (post_subj LIKE "%'. $this->db->escape_str($option['s_word']).'%" OR post_cont LIKE "%'.$this->db->escape_str($option['s_word']).'%" OR post_keyword LIKE "%'.$this->db->escape_str($option['s_word']).'%" ) ';
                //$sql .= ' OR brd_subj LIKE "%'.$option['s_word'].'%" ';
                //$sql .= ' OR brd_cont LIKE "%'.$option['s_word'].'%" ';
            }

            if (isset($option['order']) && $option['order']) {
                $sql .= ' ORDER BY '.$this->db->escape_str($option['order']);
            }

            if (isset($option['li_st']) && isset($option['li_num']) && $option['li_num']) {
                $sql .= ' LIMIT '.$this->db->escape_str($option['li_st']).', '.$this->db->escape_str($option['li_num']);
            }
            //echo $sql;
            $query = $this->db->query($sql);
            $result = $query->result();

            if($result){
                $rtn = json_decode(json_encode($result), true);
            }else{
                $rtn = $result;
            }
            return $rtn;
            //print_r($rtn);
        }else{
            show_404('error - DM_basic > updateWrongPwd', TRUE);
        }
    }

    function getLast_row($option=null)
    {
        if($option)
        {
            $this->db->select_max('like_ord', 'like');

            if( isset($option['trgt_id']) && $option['trgt_id'] ){
                $this->db->where('trgt_id', $option['trgt_id']);
            }

            if( isset($option['trgt_idx']) && $option['trgt_idx'] ){
                $this->db->where('trgt_idx', $option['trgt_idx']);
            }

            if( isset($option['usr_id']) && $option['usr_id'] ){
                $this->db->where('usr_id', $option['usr_id']);
            }

            //$this->db->order_by('like_ord', 'DESC');

            $query = $this->db->get($option['tb_id']);
            $result = $query->result();
            if($result){
                $rtn = json_decode(json_encode($result), true)[0];
            }else{
                $rtn = $result;
            }
            return $rtn;

        }
        else
        {
            show_404('error - DM_basic > updateWrongPwd', TRUE);
        }
    }

    function getList_news_count($option=null)
    {
        if($option)
        {
            //$where = ' 1 = 1 ';
            //$this->db->where($where);

            if( isset($option['post_status']) && $option['post_status'] ){
                $this->db->where('post_status', $option['post_status']);
            }

            if( isset($option['s_sds']) && $option['s_sds'] ){
                $this->db->where('crt_dtms >=', $option['s_sds']);
            }

            if( isset($option['s_sde']) && $option['s_sde'] ){
                $this->db->where('crt_dtms <=', $option['s_sde']);
            }

            //if ((isset($option['s_sds']) && $option['s_sds']) && (isset($option['s_sde']) && $option['s_sde'])) {
            //    $where = ' crt_dtms >= "'.$option['s_sds'].'" AND crt_dtms <= "'.$option['s_sde'].'" ';
            //    $this->db->where($where);
            //}

            if( isset($option['s_word']) && $option['s_word'] ) // 참관자 및 관리자 제외
            {
                $this->db->like('post_subj', $option['s_word']);
                $this->db->or_like('post_cont', $option['s_word']);
                $this->db->or_like('post_keyword', $option['s_word']);
            }

            $this->db->from($option['tb_id']);
            return $this->db->count_all_results();
        }
        else
        {
            show_404('error - DM_basic > updateWrongPwd', TRUE);
        }
    }






    function updatePw($option='')
    {
        if($option)
        {
            $data = $option['fields'];

            // ***** usr_pw_updt_dtms
            $this->load->helper('date');
            $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
            $data['updt_dtms'] = mdate( $datestring, $time );

            //print_r($data);
            // *****
            $this->db->update( $option['tb_id'], $data, array('usr_id' => $data['usr_id']));
            return $this->db->affected_rows();
        }
        else
        {
            show_404('error - model common pwd update', TRUE);
        }
    }

    function setUpdateHit($option='')
    {
        if($option)
        {
            $data['post_hit'] = $this->db->escape_str($option['post_hit']);

            //print_r($data);
            // *****
            $this->db->update( $option['tb_id'], $data, array('idx' => $option['idx']));
            return $this->db->affected_rows();
        }
        else
        {
            show_404('error - model common pwd update', TRUE);
        }
    }

    /*
     * --------------------------------------------------------------------------
     * 좋아요 값의 유무를 체크
     * --------------------------------------------------------------------------
     * trgt_id, trgt_idx, usr_id를 조건으로 값의 유무 체크
     * --------------------------------------------------------------------------
    */
    function get_likedIdx($option){
        if($option){
            $sql = "SELECT idx FROM ".$option['tb_id']." WHERE 1=1 ";
            $sql .= ' AND trgt_idx = "'. $this->db->escape_str($option['trgt_idx']).'"';
            $sql .= ' AND trgt_id = "'.$this->db->escape_str($option['trgt_id']).'"';
            $sql .= ' AND usr_id = "'.$this->db->escape_str($option['usr_id']).'"';
            $query = $this->db->query($sql);
            $result = $query->result();
            $res = json_decode(json_encode($result), true);
            if($res)
            {
                return $res[0]['idx'];
            }
            else
            {
                return false;
            }
        }else{
            show_404('error - DM_basic > updateWrongPwd', TRUE);
        }
    }

    function add_like($option){
        if($option)
        {
            // *****
            $data = $option['fields'];

            if( isset($data['crt_dtms']) && $data['crt_dtms']=='' ){
                // ***** crt_dtms
                $this->load->helper('date');
                $datestring = '%Y-%m-%d %h:%i:%s';
                $time = time();
                $data['crt_dtms'] = mdate($datestring, $time);
            }

            // *****
            $this->db->insert($option['tb_id'], $data);
            return $this->db->insert_id();
        }
        else
        {
            show_404('error - model insert error', TRUE);
        }
    }

    function get_likeCnt($option){
        if($option)
        {
            $this->db->where('trgt_id', $option['trgt_id']);
            $this->db->where('trgt_idx', $option['trgt_idx']);
            $this->db->from($option['tb_id']);
            return $this->db->count_all_results();
        }
        else
        {
            show_404('error - model insert error', TRUE);
        }
    }

    function set_likeCnt($option){
        if($option)
        {
            $data['post_like'] = $option['post_like'];

            // *****
            $this->db->update( $option['tb_id'], $data, array('idx' => $option['idx']));
            return $this->db->affected_rows();
        }
        else
        {
            show_404('error - model common pwd update', TRUE);
        }
    }

    function chk_is_like($option){
        if($option)
        {
            $this->db->where('trgt_id', $option['trgt_id']);
            $this->db->where('trgt_idx', $option['trgt_idx']);
            $this->db->where('usr_id', $option['usr_id']);
            $this->db->from($option['tb_id']);
            return $this->db->count_all_results();
        }
        else
        {
            show_404('error - model insert error', TRUE);
        }
    }

    /**
     *
     * insert_cmt (ajax용)
     *
     */
    function insert_cmt($option='')
    {
        if($option)
        {
            $data = $option['fields'];

            // ***** crt_dtms
            $this->load->helper('date');
            $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
            $data['crt_dtms'] = mdate($datestring, $time);

            $this->db->insert($option['tb_id'], $data);
            return $this->db->insert_id();// index 리턴
        }
        else
        {
            show_404('error - model basic common insert', TRUE);
        }
    }

    function get_cmtCnt($option){
        if($option)
        {
            $this->db->where('trgt_id', $option['trgt_id']);
            $this->db->where('trgt_idx', $option['trgt_idx']);
            if (isset($option['usr_id']) && $option['usr_id']) {
                $this->db->where('usr_id', $option['usr_id']);
            }
            $this->db->from($option['tb_id']);
            return $this->db->count_all_results();
        }
        else
        {
            show_404('error - model insert error', TRUE);
        }
    }

    function set_cmtCnt($option){
        if($option)
        {
            $data['post_cmt_cnt'] = $option['post_cmt_cnt'];

            // *****
            $this->db->update( $option['tb_id'], $data, array('idx' => $option['idx']));
            return $this->db->affected_rows();
        }
        else
        {
            show_404('error - model common pwd update', TRUE);
        }
    }

    function trans_usr($option){
        if($option)
        {
            $data['usr_status'] = $option['usr_status'];

            // *****
            $this->db->update( $option['tb_id'], $data, array('usr_id' => $option['usr_id']));
            return $this->db->affected_rows();
        }
        else
        {
            show_404('error - model common pwd update', TRUE);
        }
    }

    function getLast_agree($option=null)
    {
        if($option)
        {
            if( isset($option['post_cat']) && $option['post_cat'] ){
                $this->db->where('post_cat', $option['post_cat']);
            }

            if( isset($option['post_status']) && $option['post_status'] ){
                $this->db->where('post_status', $option['post_status']);
            }

            $this->db->order_by('post_dtms', 'DESC');
            $query = $this->db->get($option['tb_id']);
            $result = $query->result();

            if($result){
                $rtn = json_decode(json_encode($result), true)[0];
            }else{
                $rtn = $result;
            }
            return $rtn;
        }
        else
        {
            show_404('error - DM_basic > updateWrongPwd', TRUE);
        }
    }


    function updateWrongPwd($option=null)
    {
        if($option)
        {
            $data['wrong_apply'] = $this->db->escape_str($option['wrong_apply']);

            //print_r($data);
            // *****
            $this->db->update( 'ct_usr', $data, array('usr_id' => $option['usr_id']));
            return $this->db->affected_rows();
        }
        else
        {
            show_404('error - DM_basic > updateWrongPwd', TRUE);
        }
    }

    function get_enc_key($option=null){
        if($option)
        {
            $sql = " SELECT key_val FROM `ct_cfg` WHERE `key_id` = '" . $this->db->escape_str($option['key_id']) . "'";
            //echo $sql;
            $query = $this->db->query($sql);
            $result = $query->result();
            $res = json_decode(json_encode($result), true);
            if ($res) {
                return $res[0];
            } else {
                return false;
            }
        }else{
            show_404('error - DM_basic > updateWrongPwd', TRUE);
        }
    }

}