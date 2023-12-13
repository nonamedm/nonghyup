<?php defined('BASEPATH') OR exit('No direct script access allowed');

class DC_ajax extends CI_Controller {

    protected $is_admin;
    protected $is_login;
    private $adm_lv_allowed=6;

    function __construct()
    {
        parent::__construct();
        $this->load->model('DM_basic');

        $this->load->library('DL_security');
        $this->load->library('session');
        $this->is_admin = $this->chk_adm_per($this->session->userdata('usr_lv'));
        $this->is_login = $this->chk_is_login($this->session->userdata('is_login'));
    }

    /*
     *------------------------------
     * I N D E X
     *------------------------------
    */
    function index(){
        $this->alert("비정상적인 접근입니다.", "/ko");
    }

    // 관리자
    function delCmt(){
        if($this->is_admin){
            echo "is_admin";
            $rtn = 0;
            $cmt_idx = $this->input->post("cmt_idx", true);
            $cmt_idx = $this->dl_security->xss_cleaner($cmt_idx);
            $trgt_id = $this->input->post("trgt_id", true);
            $trgt_id = $this->dl_security->xss_cleaner($trgt_id);
            $trgt_idx = $this->input->post("trgt_idx", true);
            $trgt_idx = $this->dl_security->xss_cleaner($trgt_idx);

            if ($cmt_idx && $trgt_id && $trgt_idx) {
                $this->load->database();
                $trgt_id = 'ct_'.$trgt_id;
                $this->db->delete('ct_comment', array('idx'=>$cmt_idx)); // 댓글삭제

                $param = [
                    'tb_id'     => 'ct_comment',
                    'trgt_id'   => $trgt_id,
                    'trgt_idx'  => $trgt_idx
                ];
                $post_cmt_cnt = $this->DM_basic->get_cmtCnt($param);
                //echo json_encode($post_cmt_cnt);

                if($post_cmt_cnt){
                    $param_cnt = [
                        'tb_id'         => $trgt_id,
                        'idx'           => $trgt_idx,
                        'post_cmt_cnt'  => $post_cmt_cnt
                    ];
                    $res = $this->DM_basic->set_cmtCnt($param_cnt);
                    if($res){
                        $rtn = $res;
                    }
                }
                echo json_encode($rtn);
            }
            else
            {
                $this->alert("비정상적인 접근입니다.", "/ko");
                //echo json_encode([]);
            }
        }else{
            $this->alert("접근권한이 없습니다.", "/ko");
        }

    }

    // 관리자
    function trans_usr(){
        if($this->is_admin) {
            $rtn = 0;
            $usr_id = $this->input->post("usr_id", true);
            $usr_id = $this->dl_security->xss_cleaner($usr_id);
            $usr_status = $this->input->post("usr_status", true);
            $usr_status = $this->dl_security->xss_cleaner($usr_status);

            if ($usr_id && $usr_status) {
                $this->load->database();
                if ($usr_status == 'del') {
                    $this->db->delete('ct_usr', array('usr_id' => $usr_id)); // like 삭제
                    $rtn = true;
                } else {
                    $param = array(
                        'tb_id' => 'ct_usr',
                        'usr_id' => $usr_id,
                        'usr_status' => $usr_status
                    );
                    $rtn = $this->DM_basic->trans_usr($param); // 회원 상태 전환
                }
                echo json_encode($rtn);
            } else {
                $this->alert("비정상적인 접근입니다.", "/ko");
                //echo json_encode([]);
            }
        }else{
            $this->alert("접근권한이 없습니다.", "/ko");
        }
    }

    // 관리자
    function wrongApplyInit(){
        if($this->is_admin) {
            $rtn = 0;
            $usr_id = $this->input->post("usr_id", true);
            $usr_id = $this->dl_security->xss_cleaner($usr_id);

            if ($usr_id) {
                $this->load->database();

                $param = array(
                    'tb_id' => 'ct_usr',
                    'usr_id' => $usr_id,
                    'wrong_apply' => 0,
                );
                $rtn = $this->DM_basic->updateWrongPwd($param); // 회원 상태 전환
                echo json_encode($rtn);
            } else {
                $this->alert("비정상적인 접근입니다.", "/ko");
                //echo json_encode([]);
            }
        }else{
            $this->alert("접근권한이 없습니다.", "/ko");
        }
    }

    // 회원
    function setLike_ajax()
    {
        if($this->is_login){
            $rtn = 0;
            // receive
            $val = $this->input->post("val", true);
            $val = $this->dl_security->xss_cleaner($val);
            $trgt_id = $this->input->post("trgt_id", true);
            $trgt_id = $this->dl_security->xss_cleaner($trgt_id);
            $trgt_idx = $this->input->post("trgt_idx", true);
            $trgt_idx = $this->dl_security->xss_cleaner($trgt_idx);
            $usr_id = $this->input->post("usr_id", true);
            $usr_id = $this->dl_security->xss_cleaner($usr_id);

            if($val==1){
                $val=0;
            }else{
                $val=1;
            }

            $trgt_id = 'ct_'.$trgt_id;

            if ($trgt_id && $trgt_idx && $usr_id)
            {
                $result = false;
                $param = array(
                    'tb_id' => 'ct_like',
                    'trgt_id' => $trgt_id,
                    'trgt_idx' => $trgt_idx,
                    'usr_id' => $usr_id
                );
                $this->load->database();

                $res_idx = $this->DM_basic->get_likedIdx($param); // 좋아요 값의 유무 확인

                if($res_idx){ //있다면 좋아요 취소
                    $this->db->delete('ct_like', array('idx'=>$res_idx)); // like 삭제
                    $idx = (int)$res_idx;
                }else{ //없다면 좋아요 추가
                    $param_in['tb_id'] = $param['tb_id'];
                    $param_in['fields'] = [
                        'trgt_id'   => $trgt_id,
                        'trgt_idx'  => $trgt_idx,
                        'usr_id'    => $usr_id,
                        'like_val'  => $val
                    ];
                    $idx = $this->DM_basic->add_like($param_in); // index
                }
                //
                unset($param['usr_id']);
                $like_cnt = $this->DM_basic->get_likeCnt($param); // like 갯수 조회
                //
                $param_set = [
                    'tb_id'     => $param['trgt_id'],
                    'idx'       => $param['trgt_idx'],
                    'post_like' => $like_cnt
                ];
                $res_set = $this->DM_basic->set_likeCnt($param_set);

                if($res_set){
                    $result = true;
                }

                $rtn = [
                    'mode'      => $val,
                    'result'    => $result,
                    'index'     => (int)$idx,
                    'like_cnt'  => $like_cnt
                ];
                echo json_encode($rtn);
            }
            else
            {
                $this->alert("비정상적인 접근입니다.", "/ko");
                //echo json_encode([]);
            }
        }else{
            $this->alert("접근권한이 없습니다.", "/ko");
        }
    }

    // 회원
    public function setCmt_ajax()
    {
        if($this->is_login){
            $rtn = 0;
            $trgt_id = $this->input->post("trgt_id", true);
            $trgt_id = $this->dl_security->xss_cleaner($trgt_id);
            $trgt_idx = $this->input->post("trgt_idx", true);
            $trgt_idx = $this->dl_security->xss_cleaner($trgt_idx);
            $usr_id = $this->input->post("usr_id", true);
            $usr_id = $this->dl_security->xss_cleaner($usr_id);
            $usr_nm = $this->input->post("usr_nm", true);
            $usr_nm = $this->dl_security->xss_cleaner($usr_nm);
            $cmt_cont = $this->input->post("cmt_cont", true);
            $cmt_cont = $this->dl_security->xss_cleaner($cmt_cont);

            if ($trgt_id && $trgt_idx && $usr_id && $usr_nm && $cmt_cont)
            {
                $result = false;
                $trgt_id = 'ct_'.$trgt_id;
                $this->load->database();
                $param = [
                    'tb_id'     => 'ct_comment',
                    'trgt_id'   => $trgt_id,
                    'trgt_idx'  => $trgt_idx,
                    'usr_id'    => $usr_id
                ];
                $cmt_ord = $this->DM_basic->get_cmtCnt($param);
                $cmt_ord++;
                $param_m['fields'] = [
                    'trgt_id'   => $trgt_id,
                    'trgt_idx'  => $trgt_idx,
                    'cmt_ord'   => $cmt_ord,
                    'usr_id'    => $usr_id,
                    'usr_nm'    => $usr_nm,
                    'cmt_cont'  => $cmt_cont
                ];
                $param_m['tb_id'] = 'ct_comment';
                $rtn = $this->DM_basic->insert_cmt($param_m);
                if($rtn){ // 성공시 댓글수 갱신
                    // 총 댓글수 조회
                    unset($param['usr_id']);
                    $cmt_ord_tot = $this->DM_basic->get_cmtCnt($param);
                    // 갱신
                    $param_cnt = [
                        'tb_id'         => $trgt_id,
                        'idx'           => $trgt_idx,
                        'post_cmt_cnt'  => $cmt_ord_tot
                    ];
                    $res = $this->DM_basic->set_cmtCnt($param_cnt);
                    if($res){
                        $result = true;
                    }
                    //echo json_encode(0);
                    echo json_encode($result);
                }
            }else{
                show_404('DC_ajax > setCmt_ajax - 비정상적인 접근', TRUE);
            }
        }else{
            $this->alert("접근권한이 없습니다.", "/ko");
        }
    }

    // 누구나
    function get_agree_data()
    {
        $rtn = 0;
        $id = $this->input->post("id", true);
        if ( !($id=="pri" || $id=="terms" || $id=="copy") ){
            show_404("ERROR : ord is wrong", TRUE);
        }
        if($id){
            // WHERE 배포중
            // WHERE 약관종류
            // ORDER 시행일
            $param = array(
                'tb_id' => "ct_agree"
                ,'post_status' => "1"
                ,'post_cat' => $id
                ,'order' => " post_dtms DESC "
            );
            //DB에 조회
            $this->load->database();
            $rtn = $this->DM_basic->getList($param);
            echo json_encode($rtn);
        }else{
            $this->alert("비정상적인 접근입니다.", "/ko");
        }
    }

    // 누구나
    function set_id_num()
    {
        $rtn = 0;
        $id_num = $this->input->post("id_num", true);
        if (preg_match("/[^0-9]/", $id_num)) {
            show_404("ERROR : idx is wrong", TRUE);
        }
        if(strlen($id_num)!=8){
            show_404("ERROR : idx is wrong", TRUE);
        }
        if($id_num){
            // session에 추가
            $this->load->library('session');
            $this->session->set_userdata('id_num', $id_num);
            $rtn = 1;
            echo json_encode($rtn);
        }else{
            $this->alert("비정상적인 접근입니다.", "/ko");
        }
    }

    private function chk_adm_per($_idx)
    {
        //var_dump($_idx);
        $rtn = false;
        if ($this->adm_lv_allowed <= $_idx) {
            $rtn = true;
        }
        return $rtn;
    }

    private function chk_is_login($_idx){
        $rtn = false;
        if ($_idx) {
            $rtn = true;
        }
        return $rtn;
    }

    private function alert_close($msg = '')
    {
        if (empty($msg)) {
            $msg = '잘못된 접근입니다';
        }
        echo '<meta http-equiv="content-type" content="text/html; charset=UTF-8">';
        echo '<script type="text/javascript"> alert("' . $msg . '"); window.close(); </script>';
        exit;
    }

    private function alert($msg = '', $url = '')
    {
        if (empty($msg)) {
            $msg = '잘못된 접근입니다';
        }
        echo '<meta http-equiv="content-type" content="text/html; charset=UTF-8">';
        echo '<script type="text/javascript">alert("' . $msg . '");';
        if (empty($url)) {
            echo 'history.go(-1);';
        }
        if ($url) {
            echo 'document.location.href="' . $url . '"';
        }
        echo '</script>';
        exit;
    }

    function get_filter_list() {
        $post_cat_filter = $this->input->get("post_cat_filter", true);
        $post_field_filter = $this->input->get("post_field_filter", true);
        // 전체검색은 별도기능으로 한다. 필터검색이랑 기능이 겹쳐서 제대로 된 검색이 안됨
        // $s_word = $this->input->get("s_word", true);
        $s_subj = $this->input->get("s_subj", true);
        $s_cont = $this->input->get("s_cont", true);

        $this->db->select('*');
        $this->db->from('ct_sanctions');
        $this->db->where_in('post_cat', $post_cat_filter);
        $this->db->where_in('post_field', $post_field_filter);
        // if($s_word!='' && $s_word != null) {
        //     $this->db->like('post_subj', $s_word);
        //     // $this->db->or_like('post_cont', $s_word);
        // }
        if($s_subj!='' && $s_subj != null) $this->db->like('post_subj', $s_subj);
        if($s_cont!='' && $s_cont != null) $this->db->like('post_cont', $s_cont);
        $this->db->order_by('crt_dtms', 'desc'); 
        $query = $this->db->get();
        $result = $query->result();
        $res = json_decode(json_encode($result), true);
        $count = count($res);

        echo json_encode($res);
        //echo json_encode($param);
    }
}