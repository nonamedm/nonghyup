<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| DL_auth : 사용자 서비스영역 공통함수
|--------------------------------------------------------------------------
| login -> signin
| logout
| -------------------------------------------------------------------------
| join
| |_ join1 -> signup1
| |_ join2 -> signup2
| withdrawal
| -------------------------------------------------------------------------
| findId
| findPw
|
*/

class DL_auth
{
    // *****
    private $auth_arr = array(
        'tb_id' => 'ct_usr'
    );

    private $code;
    private $usr_arr;
    private $usr_query;


    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();

        //$this->code = $this->CI->get_val('code');
        //echo "----------";
        //echo $this->code;
        //echo "----------";
    }


    /*
     *----------------------------------------
     * I N D E X
     * index -> login
     *----------------------------------------
    */
    public function index($param=[])
    {
        if($this->CI->session->userdata('is_login'))
        {
            // ***** 현재 로그인상태 입니다
            $this->CI->session->set_flashdata('message', get_text("logged_in", $this->CI->lng_idx));
            redirect('/');
        }else{
            // *****
            $this->login();
        }
    }


    /*
     *----------------------------------------
     * L O G I N
     *----------------------------------------
    */
    public function login()
    {
        log_message("INFO", "oooo DL_auth -> login");
        if($this->CI->session->userdata('is_login'))
        {
            // ***** 현재 로그인상태 입니다
            alert('현재 로그인상태 입니다.', '/index.php');
            redirect('/');
        }else{
            $this->CI->load->view($this->CI->dl_config->get_path_skin().'login');
        }
    }


    /*
     *----------------------------------------
     * A D M - L O G I N
     *----------------------------------------
    */
    public function adm_login()
    {
        if($this->CI->session->userdata('is_login'))
        {
            alert('현재 로그인상태 입니다.', '/index.php');
        }else{
            $this->CI->chk_ip();
            $this->CI->load->view($this->CI->dl_config->get_path_skin().'adm_login');
        }
    }


    /*
     *----------------------------------------
     * O A U T H
     *----------------------------------------
     * Callback Url
     * code : 인가코드를 받아오거나 => kakao_login()
     * error : 에러메시지를 받아온다 => 카카오싱크 동의절차로
     * state : 보낸값 그대로 되돌려받는 (옵션)
     *
     *
    */
    public function oauth($param='')
    {
        log_message("debug", "=================== DL_auth-> oauth::CALLBACK - 시작");
        //log_message('debug', '------------------- DL_auth -> REQUEST_URI='.$_SERVER['REQUEST_URI']);
        $this->error = $this->CI->input->get('error', TRUE);
        $this->state = $this->CI->input->get('state', TRUE);
        $this->code = $this->CI->input->get('code', TRUE);
        log_message("debug", "=================== DL_auth-> oauth::CALLBACK - kakao param=".$param.':: error='.$this->error);
        log_message("debug", "=================== DL_auth-> oauth::CALLBACK - kakao param=".$param.':: state='.$this->state);
        log_message("debug", "=================== DL_auth-> oauth::CALLBACK - kakao param=".$param.':: code='.$this->code);


        if($this->error) // 로그인 안된상태이므로 카카오 동의로
        {
            log_message("ERROR", "=================== DL_auth::CALLBACK -> 에러코드받았음 :");
            


        }
        else // 로그인 상태
        {
            log_message("debug", "=================== DL_auth -> kakao oauth :2: code=".$this->code);

            if($this->code){
                $this->kakao_login($this->state);
            } else {
                alert('잘못된 접근입니다.', '/index.php');
            }
        }
        log_message("debug", "=================== DL_auth -> oauth :: 끝");
    }


    /*
     *----------------------------------------
     * J O I N F O R M
     *----------------------------------------
    */
    public function joinForm($param='')
    {
        log_message("debug", "=================== DL_auth -> joinForm :: 시작");
        //log_message("INFO", "oooo DL_auth -> kakao param=".$param);
        if($this->CI->session->userdata('usr_id'))
        {
            $param = [];
            $param['usr_id'] = $this->CI->session->userdata('usr_id');
            $param['usr_nm'] = $this->CI->session->userdata('usr_nm');
            //$param['usr_nm'] = '';
            $param['usr_email'] = $this->CI->session->userdata('usr_email');
            //$param['usr_email'] = '';

            $this->CI->load->database();
            $cu = $this->CI->DM_basic->getByUid( array( 'tb_id'=>$this->get_auth('tb_id'), 'usr_id'=>$param['usr_id'] ) );

            if (isset($cu['usr_status']) && $cu['usr_status']==3){
                log_message('error', 'Dl_auth::kakao_login 접근불가 아이디('.$param['usr_id'].')');
                alert('접근제한 아이디 입니다. 관리자에게 문의해 주세요.', '/index.php');
                redirect('/');
            }

            if (isset($cu['usr_status']) && $cu['usr_status']==2){
                log_message('error', 'Dl_auth::kakao_login 휴면계정 아이디('.$param['usr_id'].')');
                alert('휴면계정 아이디 입니다. 관리자에게 문의해 주세요.', '/index.php');
                redirect('/');
            }

            $param_cm = array(
                'tb_id' => 'ct_agree'
                ,'post_status' => 1
                ,'post_cat' => 'terms'
                ,'order' => " post_dtms DESC "
            );
            //DB에 조회
            $param['terms'] = $this->CI->DM_basic->getLast_agree($param_cm);

            $param_cm1 = array(
                'tb_id' => 'ct_agree'
                ,'post_status' => 1
                ,'post_cat' => 'pri'
                ,'order' => " post_dtms DESC "
            );
            $param['privacy'] = $this->CI->DM_basic->getLast_agree($param_cm1);

            $this->CI->load->view($this->CI->dl_config->get_path_skin().'joinForm', $param);
        } else {
            $this->CI->session->set_flashdata('message', '비정상적인 접근입니다.');
            redirect('/index.php');
        }
        log_message("debug", "=================== DL_auth -> joinForm :: 끝");
    }


    /*
     * --------------------------------------------------
     * kakao_login
     * --------------------------------------------------
     * 카카오 소셜로그인 - 토큰 요청
     */
    function kakao_login($state='/ko')
    {
        log_message('debug', '====================Dl_auth -> kakao_login :: 시작');

        // 세션에 토큰정보가 존재 한다면
        if (isset($_SESSION['kakao_access_token']) && $_SESSION['kakao_access_token']) {
            //log_message('debug', '====================Dl_auth::kakao_login - 1.-세션에 토큰 존재');

            $url = 'https://kapi.kakao.com/v2/user/me';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSLVERSION, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['kakao_access_token']));
            curl_setopt($ch, CURLOPT_POST, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            curl_close($ch);

            $json = json_decode($result, true);

            //log_message('debug', '====================Dl_auth::kakao_login - 1.1- 세션에 토큰 존재 -> 사용자정보 요청');
            if (isset($json['id']) && $json['id']) { // 사용자정보 요청 결과값에 id가 있다면
                //log_message('debug', '====================Dl_auth::kakao_login - 1.2.1- 세션에 토큰 존재 -> 사용자정보 요청 성공');

                foreach($json as $k=>$v){
                    if(is_array($v)){
                        foreach($v as $ke=>$va) {
                            if(is_array($va)){
                                foreach($va as $key=>$val) {
                                    //log_message('debug', '====================Dl_auth::kakao_login - 1.2.1.1- 세션에 토큰 존재 -> 사용자정보 요청 성공 key=' . $key . ' :: val=' . $val);
                                }
                            }else{
                                //log_message('debug', '====================Dl_auth::kakao_login - 1.2.1.1- 세션에 토큰 존재 -> 사용자정보 요청 성공 key=' . $ke . ' :: val=' . $va);
                            }
                        }
                    }else{
                        //log_message('debug', '====================Dl_auth::kakao_login - 1.2.1- 세션에 토큰 존재 -> 사용자정보 요청 성공 k='.$k.' :: v='.$v);
                    }
                }

                $this->CI->load->database();
                $cu = $this->CI->DM_basic->getByUid( array( 'tb_id'=>$this->get_auth('tb_id'), 'usr_id'=>$json['id'] ) );

                //log_message('debug', '====================Dl_auth::kakao_login - 1.2.2- 세션에 토큰 존재 -> 사이트 회원정보 가져오기');

                // 접근불가 아이디 필터링
                if (isset($cu['usr_status']) && $cu['usr_status']==3){
                    //log_message('error', 'Dl_auth::kakao_login 접근불가 아이디('.$json['id'].')');
                    alert('접근제한 아이디 입니다. 관리자에게 문의해 주세요.', '/index.php');
                    redirect('/ko');
                }

                if (isset($cu['usr_status']) && $cu['usr_status']==2){
                    //log_message('error', 'Dl_auth::kakao_login 휴면계정 아이디('.$json['id'].')');
                    alert('휴면계정 아이디 입니다. 관리자에게 문의해 주세요.', '/index.php');
                    redirect('/ko');
                }

                unset($update_param);
                $update_param['tb_id'] = $this->CI->config->item('md')['tbl'];

                // 로그인 처리 (session)
                if (!$cu) { // 회원가입
                    //log_message('debug', '====================Dl_auth::kakao_login - 1.3.1- 사이트 회원정보 없음(회원가입)');
                    //print_r($json);
                    // 세션에 아이디 저장후
                    $this->CI->session->set_userdata('usr_id', $json['id']);

                    if (isset($json['kakao_account']['name']) && $json['kakao_account']['name']) {
                        $this->CI->session->set_userdata('usr_nm', $json['kakao_account']['name']);
                    //}else if (isset($json['kakao_account']['profile']['nickname']) && $json['kakao_account']['profile']['nickname']) {
                    //    $this->CI->session->set_userdata('usr_nm', $json['kakao_account']['profile']['nickname']);
                    }

                    if(isset($json['kakao_account']['email']) && $json['kakao_account']['email']){
                        $this->CI->session->set_userdata('usr_email', $json['kakao_account']['email']);
                    }

                    if($this->CI->session->userdata('id_num')){ // 사번인증 후
                        //log_message('debug', '====================Dl_auth::kakao_login - 1.4.1- 사번인증 이후 -> 회원가입폼');
                        // 회원가입 동의화면으로 이동
                        redirect('/ko/auth/joinForm');
                    } else {
                        //log_message('debug', '====================Dl_auth::kakao_login - 1.4.2- 사번인증 이전 -> 사번입력폼');
                        alert('가입된 회원정보가 없습니다. \n회원가입(사번입력)화면으로 이동합니다.', '/ko/auth/join');
                    }
                } else { // 로그인
                    //log_message('debug', '====================Dl_auth::kakao_login - 1.3.2- 사이트 회원정보 있음(로그인)');
                    //$this->CI->session->sess_destroy();
                    $this->CI->session->sess_regenerate(TRUE);

                    // 로그인
                    $this->CI->session->set_userdata('usr_id', $json['id']);
                    $this->CI->session->set_userdata('is_login', TRUE);
                    // 회원등급 <- DB
                    $this->CI->session->set_userdata('usr_lv', $cu['usr_lv']);
                    //log_message('debug', '====================Dl_auth::kakao_login - 1.3.3- 사이트 회원정보로 세션 업데이트');

                    // usr_data
                    $update_param['fields']['usr_id'] = $json['id'];
                    $update_param['fields']['updt_ip'] = $_SERVER['REMOTE_ADDR'];
                    $update_param['fields']['usr_last_login_ip'] = $_SERVER['REMOTE_ADDR'];

                    //$this->CI->load->database();
                    $reg_id = $this->CI->DM_basic->update_user($update_param);
                    //log_message('debug', '====================Dl_auth::kakao_login - 1.3.4- 사이트 회원정보 업데이트(마지막 로그인)');

                    if($reg_id)
                    {
                        log_message('debug', '====================Dl_auth::kakao_login - 1.3.5- 사이트 회원정보 업데이트 성공(카카오 인증 완료) state='.$state);
                        if($state){
                            redirect($state);
                        }else{
                            alert('카카오인증을 통해 로그인 되었습니다.', '/ko');
                        }
                    }else{
                        //log_message('debug', '====================Dl_auth::kakao_login - 1.3.6- 사이트 회원정보 업데이트 실패(카카오 인증 오류)');
                        alert('카카오인증을 통한 로그인중 오류가 발생하였습니다. 다시 시도해주세요.', '/ko/auth/login');
                    }
                }
            } else {
                log_message('debug', '====================Dl_auth::kakao_login - 2.1.1- 세션에 토큰 존재 -> 사용자정보 요청 실패');
                // 세션에 토큰이 있는데 이를 통한 사용자정보 요청에 실패한 경우
                if($_GET['code']){ // 코드를 가지고 있다면
                    //log_message('debug', '====================Dl_auth::kakao_login - 2.2.1- 코드 존재 -> 토큰 재요청(1)');
                    $this->get_token($_GET['code'], 1);
                } else { // 코드가 없다면 로그인 화면에서 다시 시작
                    //log_message('debug', '====================Dl_auth::kakao_login - 2.2.2- 코드 없음 -> 로그인 다시 시작(1)');
                    alert('비정상적인 접근입니다.', '/ko/auth/login');
                }
            }
        }
        else //
        {
            //log_message('debug', '====================Dl_auth::kakao_login - 2.-세션에 토큰 없음');
            if($_GET['code']){
                //log_message('debug', '====================Dl_auth::kakao_login - 2.1-code로 토큰 요청(2)');
                $this->get_token($_GET['code'], 2);
            } else {
                // 오류
                //log_message('error', '====================Dl_auth::kakao_login - 2.1-code없음 오류');
                alert('비정상적인 접근입니다.', $this->login_url);
            }
        }
        log_message('debug', '====================Dl_auth -> kakao_login :: 끝');
    }


    function get_token($_code, $_n){
        log_message('debug', '--------------------Dl_auth::kakao_login - 1.토큰요청 시작');
        log_message('debug', 'Dl_auth::kakao_login - get_token 시작 n='.$_n);
        // 토큰 요청
        $client_id = "6fa21acd94f0a9eb127c07bf13a1967b";
        $callBackUrl = "https://law.nhbank.com/ko/auth/oauth";

        $token_url = 'https://kauth.kakao.com/oauth/token';

        // 카카오싱크 적용
        // 에이전트 확인 (KAKAOTALK 인앱 체크)
        // client_id = $client_id
        // grant_type = authorization_code
        // redirect_uri = urlencode($callBackUrl)
        // code = $_code
        // prompt = "none"

        //if(strpos($_SERVER['HTTP_USER_AGENT'], 'KAKAOTALK', 0))  // KAKAOTALK 인앱
        //{
        //    log_message('debug', '--------------------Dl_auth::kakao_login - 1.1.토큰요청 시작 -> 인앱브라우저');
        //    //$token_url .= sprintf("?client_id=%s&response_type=code&redirect_uri=%s&code=%s&prompt=none",
        //    //    $client_id, urlencode($callBackUrl), $_code);
        //    $token_url .= sprintf("?client_id=%s&grant_type=authorization_code&redirect_uri=%s&code=%s",
        //        $client_id, urlencode($callBackUrl), $_code);
        //}
        //else // 기타 브라우저
        //{
            log_message('debug', '--------------------Dl_auth::kakao_login - 1.2.토큰요청 시작 -> 기타브라우저');
            $token_url .= sprintf("?client_id=%s&grant_type=authorization_code&redirect_uri=%s&code=%s",
                $client_id, urlencode($callBackUrl), $_code);
        //}


        log_message('debug', '--------------------Dl_auth::kakao_login - 1.3.토큰요청');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $token_url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSLVERSION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);

        $json = json_decode($result, true);

        if (isset($json['access_token']) && $json['access_token']) { // 엑세스토큰 얻기 설공
            log_message('debug', '--------------------Dl_auth::kakao_login - 1.4.토큰요청 -> 성공');

            $_SESSION['kakao_access_token'] = $json['access_token'];
            //return $json;
            echo '<script type="text/javascript">location.reload()</script>';
            exit;
        } else { // 엑세스토큰 얻기 실패
            log_message('debug', '--------------------Dl_auth::kakao_login - 1.5.토큰요청 -> 실패');
            alert('로그인에 실패하였습니다', $this->login_url);
        }
        log_message('debug', '--------------------Dl_auth::kakao_login - 1.5.토큰요청 -> 끝');
    }



    /*
     *----------------------------------------
     * S I G N I N
     *----------------------------------------
    */
    public function signin()
    {
        log_message("INFO", "oooo DL_auth -> signin");
        if($this->CI->session->userdata('is_login'))
        {
            alert('현재 로그인상태 입니다.', '/index.php');
        }else{
            // ***** get post data
            $usr_id = $this->CI->input->post('usr_id', TRUE);
            $usr_pw = $this->CI->input->post('usr_pw', TRUE);


            if(!$usr_id || !$usr_pw)
            {
                alert('오류가 발생했습니다. 다시 시도해 주세요.', '/ko/auth/login');
            }else{
                // *****
                $this->CI->load->database();
                $cu = $this->CI->DM_basic->getByUid( array( 'tb_id'=>$this->get_auth('tb_id'), 'usr_id'=>$usr_id ) );

                if(!$cu)
                { // 조회된 정보가 없다면
                    log_message("INFO", "oooo DL_auth -> signin - 조회정보 없음");
                    alert('등록된 사용자정보가 없습니다.', '/ko/auth/login');
                }else{ // 인증
                    log_message("INFO", "oooo DL_auth -> signin - 인증");
                    if($cu['wrong_apply']>=5){
                        alert('잘못된시도 횟수(5/5)회로 차단되었습니다. \n관리자에게 문의해 주세요.', '/ko');
                    }

                    $usr_pwd = hash('sha512', md5($usr_pw));
                    //***** 주의
                    // echo "password=".$this->CI->encryption->encrypt($usr_pw); // 간이 확인법

                    if( ($usr_id == $cu['usr_id']) && ($usr_pwd == $cu['usr_pw']) )
                    { // 인증성공(세션저장)
                        log_message("INFO", "oooo DL_auth -> signin - 인증성공 - 세션저장");
                        $this->CI->session->sess_regenerate(TRUE);

                        $this->CI->session->set_userdata('is_login', TRUE);
                        $this->CI->session->set_userdata('usr_lv', $cu['usr_lv']);
                        $this->CI->session->set_userdata('usr_id', $usr_id);
                        //$this->CI->session->set_userdata('hstry', "");

                        $this->CI->set_usr_ss();


                        //DB 업데이트
                        $update_param=[
                            'tb_id'             =>'ct_usr',
                            'usr_id'            => $usr_id,
                            'usr_last_login_ip' => $_SERVER['REMOTE_ADDR']
                        ];
                        $reg_id = $this->CI->DM_basic->updateLogin($update_param);

                        //echo $this->CI->dl_cnfig->get_path_rtn();
                        //$this->CI->session->set_flashdata('message', '로그인 성공.');
                        //log_message("INFO", "oooo DL_auth -> signin - 인증 - rtn = ".$this->CI->dl_config->get_path_rtn( array('m_id'=>'')) );
                        //echo $this->CI->dl_config->get_path_rtn( array('m_id'=>'') );
                        //redirect("/adm/");
                        if($reg_id){
                            alert('로그인 되었습니다.', '/adm/');
                        }

                    }
                    else
                    { // 인증실패 - 잘못된 비밀번호
                        $cu['wrong_apply']++;
                        $rtn = $this->CI->DM_basic->updateWrongPwd(array('usr_id' => $usr_id, 'wrong_apply' => $cu['wrong_apply'] ));

                        if($cu['wrong_apply']==5){
                            alert('로그인 실패. 잘못된시도 횟수('.$cu['wrong_apply'].'/5)회로 접속이 차단됩니다. \n관리자에게 문의해 주세요.', '/ko');
                        }else{
                            alert('로그인 실패. 잘못된시도 횟수('.$cu['wrong_apply'].'/5)회', '/ko/auth/adm_login');
                        }

                    }
                }
            }
        }
    }


    /*
     *----------------------------------------
     * L O G O U T
     *----------------------------------------
    */
    public function logout($param='')
    {
        if($this->CI->session->userdata('is_login'))
        {
            $this->CI->session->unset_userdata('kakao_access_token');
            $this->CI->session->unset_userdata('is_login');
            $this->CI->session->unset_userdata('usr_id');
            $this->CI->session->unset_userdata('usr_nm');
            $this->CI->session->unset_userdata('id_num');
            $this->CI->session->unset_userdata('usr_lv');
            $this->CI->session->unset_userdata('usr_email');
            $this->CI->session->unset_userdata('hstry');
            $this->CI->session->sess_destroy();

            alert('로그아웃 되었습니다.', '/index.php');
        }else{
            alert('비정상적인 접근', '/index.php');
        }
    }


    /*
     *----------------------------------------
     * J O I N
     *----------------------------------------
    */
    public function join($param = array())
    {
        if($this->CI->session->userdata('is_login')) // 로그인이라면
        {
            alert('현재 로그인 상태입니다.', '/index.php');
        } else { // 로그인이라면
            $param = [];
            if($this->CI->session->userdata('usr_id')){
                $param['chk_auth'] = true;
            }
            $this->CI->load->view($this->CI->dl_config->get_path_skin().'join', $param);
        }
    }


    /*
     *----------------------------------------
     * S I G N U P - ( join / reg )
     *----------------------------------------
    */
    public function signup($param = array())
    {
        log_message('debug', '====================Dl_auth -> signup :: 시작');
        unset($update_param);
        $update_param['tb_id'] = $this->CI->config->item('md')['tbl'];


        // 회원가입
        $this->CI->load->library('DL_schema');
        $update_param['fields'] = $this->CI->dl_schema->get_schema('usr');

        // post
        $post_arr = $this->post_parse();
        
        $update_param['fields'] = $post_arr;

        $enc_key = $this->CI->DM_basic->get_enc_key(array('key_id'=> 'enc_key'));

        $this->CI->load->database();
        $this->CI->load->library('encryption');
        $this->CI->encryption->initialize(
            array(
                'key' => $enc_key['key_val']
            )
        );

        $update_param['fields']['usr_nm_hash'] = hash('sha512', md5($update_param['fields']['usr_nm']));
        $update_param['fields']['usr_email_hash'] = hash('sha512', md5($update_param['fields']['usr_email']));
        $update_param['fields']['usr_nm'] = $this->CI->encryption->encrypt($update_param['fields']['usr_nm']);
        $update_param['fields']['usr_email'] = $this->CI->encryption->encrypt($update_param['fields']['usr_email']);


        // fields
        // $post_arr = $this->schema_parse($update_param['fields'], $post_arr);

        // agree filter
        if( !$update_param['fields']['usr_agr_terms_dtms'] || !$update_param['fields']['usr_agr_pri_dtms'] ){
            $this->CI->session->unset_userdata('is_login');
            alert('동의사항 정보에 오류가 있습니다. 다시 시도해 주세요.', '/ko/auth/join');
        }


        $update_param['fields']['usr_status'] = 1;

        // usr_lv('default')
        $update_param['fields']['usr_lv'] = $this->CI->get_usr_lv_join();

        // usr_ip
        $update_param['fields']['crt_ip'] = $_SERVER['REMOTE_ADDR'];
        $update_param['fields']['usr_last_login_ip'] = $_SERVER['REMOTE_ADDR'];

        $this->CI->load->database();
        $reg_id = $this->CI->DM_basic->insert_user($update_param);

        if($reg_id)
        {
            $this->CI->session->set_userdata('is_login', true);
            $this->CI->session->set_userdata('usr_lv', $update_param['fields']['usr_lv']);
            alert('카카오인증을 통한 회원가입이 완료되었습니다.', '/index.php');
        }else{
            alert('카카오인증을 통한 회원가입중 오류가 발생하였습니다. 다시 시도해주세요.', '/ko/auth/join');
        }
        log_message('debug', '====================Dl_auth -> signup :: 끝');
    }
    


    


    /*
     *----------------------------------------
     * P R I N T - R E G
     *----------------------------------------
    */
    public function printReg(){
        if($this->CI->session->userdata('is_login'))
        { // 로그인여부 체크
            $usr_id = $this->CI->get_val("usr_id");
            if( !$usr_id ){
                $this->CI->session->set_flashdata('message', 'error user data null');
                redirect($this->CI->dl_config->get_path_rtn( array('m_id'=>'') ));
            }
            $this->CI->load->database();
            $result = $this->CI->DM_basic->getByUid( array( 'tb_id'=>'ct_usr', 'usr_id'=>$usr_id ) );

            $result['usr_add_cnt']=0;
            //print_r($this->usr_arr);
            // 참가등록이라면 ['usr_add_cnt']

            for( $j=1; $j<6; $j++ ){
                if( $result['usr_join_yn'.$j]=="Y" ){
                    $result['usr_add_cnt']++;
                }
            }


            if($result){
                $param['usr'] = $result;
                // *****
                $this->CI->load->view( $this->CI->dl_config->get_path_skin().'printReg', $param );
            }
        }else{
            $this->CI->session->set_flashdata('message', 'The wrong approach.');
            redirect($this->CI->dl_config->get_path_rtn( array('m_id'=>'/') ));
        }
    }



    /*
     *----------------------------------------
     * W I T H D R A W A L
     *----------------------------------------
    */
    public function withdrawal(){
        if($this->CI->session->userdata('is_login'))
        { // 로그인여부 체크
            //print_r($idx);
            $usr_id = $this->CI->get_val("usr_id");
            if( !$usr_id ){
                $this->CI->session->set_flashdata('message', 'error user data null');
                redirect($this->CI->dl_config->get_path_rtn( array('m_id'=>'') ));
            }

            $result = $this->CI->db->delete( 'ct_usr', array( 'usr_id'=>$usr_id ));
            //print_r($result);
            //echo "---";
            if($result){
                $this->CI->session->sess_destroy();
                alert('회원탈퇴가 정상처리되었습니다.', '/index.php');
            }
        }else{
            $this->CI->session->set_flashdata('message', 'The wrong approach.');
            redirect($this->CI->dl_config->get_path_rtn( array('m_id'=>'/') ));
        }
    }



    /*
     *----------------------------------------
     * del_my_vote
     *----------------------------------------
    */
    public function del_my_vote(){
        if($this->CI->session->userdata('is_login'))
        { // 로그인여부 체크
            //print_r($idx);
            $usr_idx = $this->CI->get_val("usr_idx");
            $idx = $this->CI->get_val("p_idx");
            //echo $usr_idx;
            if( !$usr_idx ){
                $this->CI->session->set_flashdata('message', 'error user data null');
                redirect($this->CI->dl_config->get_path_rtn( array('m_id'=>'') ));
            }

            $result = $this->CI->db->delete( 'ct_capstone_vote', array( 'usr_idx'=>$usr_idx, 'vote_idx'=>$idx ));
            //print_r($result);
            //echo "---";

            if($result){
                // flashdata not action
                redirect('/'.$this->CI->seg.'/mypage');
            }else{
                $this->CI->session->set_flashdata('message', '오류가 발생하였습니다. 다시 시도해 주세요.');
                redirect('/'.$this->CI->seg.'/mypage');
            }
        }else{
            $this->CI->session->set_flashdata('message', 'The wrong approach.');
            redirect($this->CI->dl_config->get_path_rtn( array('m_id'=>'/') ));
        }
    }


    /*
     *----------------------------------------
     * del_my_final
     *----------------------------------------
    */
    public function del_my_final(){

        if($this->CI->session->userdata('is_login'))
        { // 로그인여부 체크
            //print_r($idx);
            $usr_idx = $this->CI->get_val("usr_idx");
            $idx = $this->CI->get_val("p_idx");


            //echo $usr_idx;
            if( !$usr_idx ){
                $this->CI->session->set_flashdata('message', 'error user data null');
                redirect($this->CI->dl_config->get_path_rtn( array('m_id'=>'') ));
            }

            $result = $this->CI->db->delete( 'ct_capstone_final', array( 'usr_idx'=>$usr_idx, 'final_idx'=>$idx ));
            //print_r($result);
            //echo "---";

            if($result){
                // flashdata not action
                redirect('/'.$this->CI->seg.'/mypage');
            }else{
                $this->CI->session->set_flashdata('message', '오류가 발생하였습니다. 다시 시도해 주세요.');
                redirect('/'.$this->CI->seg.'/mypage');
            }

        }else{
            $this->CI->session->set_flashdata('message', 'The wrong approach.');
            redirect($this->CI->dl_config->get_path_rtn( array('m_id'=>'/') ));
        }
    }



    /*
     *----------------------------------------
     * F I N D - I D
     *----------------------------------------
    */
    public function findId($param = array())
    {
        log_message("INFO", "oooo DL_auth -> findId");
    }



    /*
     *----------------------------------------
     * F I N D - P W
     *----------------------------------------
    */
    public function findPw($param = array())
    {
        log_message("INFO", "oooo DL_auth -> findPw");
    }



    /*
     *----------------------------------------
     * R E S E T - P W
     *----------------------------------------
    */
    public function resetPw($param = array())
    {
        if($this->CI->session->userdata('is_login'))
        {
            /** DB값 요청 */
            if(!isset($this->CI->get_usr()['usr_id']))
            {
                $this->CI->session->set_flashdata('message', 'The wrong approach. Please log in again.');
                $this->CI->session->sess_destroy();
                redirect($this->CI->dl_config->get_path_rtn( array('m_id'=>'login') ));
            }

            $this->CI->load->view( $this->CI->dl_config->get_path_skin().'resetPw', array(
                'usr_id' => $this->CI->get_usr()['usr_id']
            ) );
        }else{
            $this->CI->session->set_flashdata('message', 'please login.');
            redirect($this->CI->dl_config->get_path_rtn( array('m_id'=>'login') ));
        }
    }



    /*
     * ----------------------------------------
     * U P D A T E - P W
     * ----------------------------------------
     * 1. 로그인 중이거나
     * 2. 메일인증 후
     * ----------------------------------------
    */
    public function updatePw($param = array())
    {
        if( $this->CI->session->userdata('is_login') ) // 추후 메일인증 체크옵션 추가 필요
        {
            unset($update_param);
            $update_param['tb_id'] = $this->CI->config->item('md')['tbl'];
            $update_param['fields'] = $this->CI->config->item('fields');
            // fields
            $post_arr = $this->post_parse();
            //var_dump($post_arr);
            // password encrypt ::::::::::::::::::::

            if($post_arr['usr_pw'])
            {
                $post_arr['usr_pw'] = hash('sha512', md5($post_arr['usr_pw']));

                $update_param['fields'] = $post_arr;

                //add fields ::::::::::::::::::::
                // usr_state


                // usr_pw_updt_ip
                //$update_param['fields']['usr_pw_updt_ip'] = $_SERVER['REMOTE_ADDR'];

                //var_dump($update_param);
                $this->CI->load->database();
                $update_id = $this->CI->DM_basic->updatePw($update_param);
                if( $this->CI->lng_cd=="ko" ){
                    $msg="비밀번호가 정상적으로 변경되었습니다!";
                }else{
                    $msg="Password Changed Successfully!";
                }
                $this->CI->session->set_flashdata('message', $msg );
                redirect('/'.$this->CI->seg.'/mypage');
            }else{
                $this->CI->session->set_flashdata('message', 'update password error : password(null) ');
                redirect('/');
            }
        }
    }



    /*
     *----------------------------------------
     * C O M P L E T E
     *----------------------------------------
    */
    public function complete($param = array())
    {
        if($this->CI->session->userdata('is_login'))
        {
            /** DB값 요청 */

            if(!isset($this->CI->config->item("usr")['usr_id']))
            {
                $this->CI->session->set_flashdata('message', 'The wrong approach. Please log in again.');
                $this->CI->session->sess_destroy();
                redirect($this->CI->dl_config->get_path_rtn( array('m_id'=>'login') ));
            }

            $this->CI->load->view( $this->CI->dl_config->get_path_skin().'complete', array(
                'usr_id' => $this->CI->config->item("usr")['usr_id'],
                'opt' => $this->CI->get_opt()
            ) );
        }else{
            $this->CI->session->set_flashdata('message', 'please login.');
            redirect($this->CI->dl_config->get_path_rtn( array('m_id'=>'login') ));
        }
    }



    /*
     *----------------------------------------
     * certification Mail
     * 메일인증
     *----------------------------------------
     */
    public function certMail()
    {
        log_message("INFO", "oooo DL_auth -> certification");

        // *****
        $usr_join_key = $this->CI->input->get('key', TRUE);
        $usr_id = $this->CI->input->get('id', TRUE);

        log_message("INFO", "oooo DL_auth -> certification usr_join_key=".$usr_join_key );

        log_message("INFO", "oooo DL_auth -> certification usr_id=".$usr_id );

        //log_message("INFO", "oooo DL_auth -> certification tb_id=".$this->get_auth('tb_id') );



        // db
        $this->CI->load->database();
        $usr_id = str_replace("..",".",$usr_id);

        $rtn = $this->CI->DM_basic->getByUid( array( 'tb_id'=>'ct_usr', 'usr_id'=>$usr_id ) );
        //
        //log_message("INFO", "oooo DL_auth -> certification rtn=".$rtn );
        // 암호화
        //$this->CI->load->library('encryption');;
        //$cert_key = $this->CI->encryption->encrypt( $usr_id.$rtn['usr_join_key_dtms'] );
        //echo count($rtn);
        //$cert_key = $rtn['usr_join_key'];

        // 인증키 유효시간 비교
        //var_dump( urldecode($usr_join_key) );
        //echo '///';
        //var_dump( $rtn['usr_join_key'] );
        //echo '///';
        //var_dump( $cert_key );
        //echo '///';
        // 키값 비교
        if($rtn['usr_lv']) {
            if ($rtn['usr_lv'] > 2) {
                // 이미 인증처리가 되었습니다
                $this->CI->session->set_flashdata('message', get_text("certified", $this->CI->lng_idx));
                redirect($this->CI->dl_config->get_path_rtn(array('m_id' => '/')));
            } else if ($rtn['usr_lv'] == 2) {
                $usr_join_key = str_replace(" ", "+", $usr_join_key);
                log_message("INFO", "oooo DL_auth -> 비교");
                log_message("INFO", "oooo DL_auth -> 비교 usr_join_key = " . $usr_join_key);
                log_message("INFO", "oooo DL_auth -> 비교 rtn[usr_join_key] = " . $rtn['usr_join_key']);
                if ($usr_join_key == $rtn['usr_join_key']) { // 성공
                    log_message("INFO", "oooo DL_auth -> 비교 - 성공");
                    //crt_dtms 등록
                    //var_dump( '성공' );
                    // 성공값 DB저장
                    $this->CI->load->database();
                    $this->CI->DM_basic->setCert(array('tb_id' => $this->get_auth('tb_id'), 'usr_id' => $usr_id));


                    //var_dump($rtn);
                    //if($rtn)
                    //{
                    //$this->CI->session->sess_destroy();
                    $this->CI->session->set_userdata('is_login', '');
                    $this->CI->session->set_userdata('usr_lv', '');
                    $this->CI->session->set_userdata('usr_id', '');
                    /*
                    if($this->CI->session->userdata('is_login'))
                    {
                        // 세션값 업데이트
                        $this->CI->session->set_userdata('is_login', TRUE);
                        $this->CI->session->set_userdata('usr_lv', $rtn['usr_lv']);
                        $this->CI->session->set_userdata('usr_id', $usr_id);

                        $this->CI->set_usr_ss();

                        //$this->CI->session->unset_userdata('is_login');
                        if($this->CI->lng_cd == 'ko') {
                            $this->CI->session->set_flashdata('message', '인증에 성공하였습니다.\n마이페이지로 이동합니다.');
                        }else{
                            $this->CI->session->set_flashdata('message', 'Successful authentication.\nGo to my page.');
                        }
                        redirect($this->CI->dl_config->get_path_rtn( array('m_id'=>'mypage') ) );
                    }else{
                    */
                    $this->CI->session->unset_userdata('data');
                    if ($this->CI->lng_cd == 'ko') {
                        $this->CI->session->set_flashdata('message', '메일인증에 성공하였습니다.\n로그인화면으로 이동합니다.');
                    } else {
                        $this->CI->session->set_flashdata('message', 'Email authentication succeeded.\nAn approval request was sent to the manager.\nThe administrator reviews the attached business registration certificate of the representative when register and will approve within 24 hours.');
                    }

                    // 관리자 메일 발송
                    //$site_tit = $this->CI->config->item("site_tit")[$this->CI->lng_idx];
                    //$this->send_mail_admin( array( 'tb_id'=>$this->get_auth('tb_id'), 'usr_id'=>$usr_id, 'site_tit'=>$site_tit ) );

                    redirect('/'.$this->CI->seg.'/auth/login');
                    //}


                    //}
                } else {
                    // 실패
                    log_message("INFO", "oooo DL_auth -> 실패 usr_join_key=" . $usr_join_key);
                    log_message("INFO", "oooo DL_auth -> 실패 rtn['usr_join_key']" . $rtn['usr_join_key']);
                    log_message("INFO", "oooo DL_auth -> 실패");
                    // 인증에 실패하였습니다.
                    $this->CI->session->set_flashdata('message', "메일인증에 실패하였습니다.");
                    redirect($this->CI->dl_config->get_path_rtn(array('m_id' => '/')));
                }
            }else{

            }
        }else{
            log_message("INFO", "oooo DL_auth -> 실패 : 아이디값 없음");
            // 인증에 실패하였습니다.
            $this->CI->session->set_flashdata('message', "메일인증에 실패하였습니다.");
            redirect($this->CI->dl_config->get_path_rtn(array('m_id' => '/')));
        }
    }



    /*
     *----------------------------------------
     * S E N D - M A I L
     *----------------------------------------
    */
    public function send_mail( $post_arr = array() )
    {

        log_message("INFO", "oooo DL_auth -> send_mail 1 :");
        //$rtn = $post_arr['usr_id'];
        //var_dump( $post_arr );
        log_message("INFO", "oooo DL_auth -> send_mail 2 :".$post_arr['usr_id']);

        if( $post_arr['usr_id'] ) {
            //$this->CI->load->library('session');

            // $param 가져오기
            $param_cm = array(
                'tb_id' => 'ct_usr',
                'usr_id' => $post_arr['usr_id']
            );

            //var_dump( $this->DM_basic->getByUid($param_cm) );
            $this->CI->load->database();
            $update_param['fields'] = $this->CI->DM_basic->getByUidSdct($param_cm);

            //$update_param['fields'] = $this->CI->get_usr();
            //var_dump( $this->config->item('usr') );

            $this->CI->load->library('encryption');;

            // 인증키 생성
            // ***** cert encrypt
            $update_param['fields']['usr_join_key_dtms'] = date("Y-m-d H:i:s");
            $update_param['fields']['usr_join_key'] = $this->CI->encryption->encrypt($post_arr['usr_id'] . $update_param['fields']['usr_join_key_dtms']);


            // key업데이트
            $this->CI->DM_basic->update_key(array(
                'usr_id' => $post_arr['usr_id'],
                'usr_join_key' => $update_param['fields']['usr_join_key'],
                'usr_join_key_dtms' => $update_param['fields']['usr_join_key_dtms']
            ));

            //var_dump($update_param);
            //
            $this->CI->load->library('DL_mail');

            $mail_subj = '공대생 심사위원단 등록';
            if ($post_arr['seg'] == "ko") {
                $mail_subj = '이메일 인증';
            }

            //echo 'site_tit1 = '.$this->CI->config->item('site_tit');

            if( isset($post_arr['site_tit']) && $post_arr['site_tit'] ){
                $mail_title = $post_arr['site_tit'];
                log_message("INFO", "oooo DL_auth -> send_mail 2.1 : site tit = ".$mail_title);
            }else if( isset($this->CI->site_tit) && $this->CI->site_tit ) {
                $mail_title = $this->CI->site_tit;
                log_message("INFO", "oooo DL_auth -> send_mail 2.2 : site tit = ".$mail_title);
            }else{
                $mail_title = "2020 공학페스티벌";
                //log_message("ERROR", "oooo DL_auth -> send_mail 2.3 : no title");
                //show_404();
            }


            if( $post_arr['seg'] ){
                $lng_cd = $post_arr['seg'];
            }else if( isset($this->CI->lng_cd) && $this->CI->lng_cd ){
                $lng_cd = $this->CI->lng_cd;
            }else{
                log_message("ERROR", "oooo DL_auth -> send_mail 3 : no title");
                show_404();
            }


            $mail_auth = 'Click (Mail Authentication)';
            if( $post_arr['seg'] == "ko" ){
                $mail_auth = '클릭 (이메일 인증)';
            }

            //
            //$base_URL='http://'.$_SERVER['HTTP_HOST'];
            $base_URL="http://e2festa.kr";

            //($_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
            //$base_URL .= ($_SERVER['SERVER_PORT'] != '80') ? $_SERVER['HTTP_HOST'].':'.$_SERVER['SERVER_PORT'] : $_SERVER['HTTP_HOST'];

            log_message("INFO", "oooo DL_auth -> send_mail 3 :".$base_URL);

            // $mail_auth_addr=$base_URL."/".urlencode($post_arr['seg'])."/auth/certMail?id=".urlencode($post_arr['usr_id'])."&key=".urlencode($update_param['fields']['usr_join_key']);
            $mail_auth_addr=$base_URL."/".$post_arr['seg']."/auth/certMail?id=".$post_arr['usr_id']."&key=".urlencode($update_param['fields']['usr_join_key']);

            log_message("INFO", "oooo DL_auth -> send_mail 4 :".$mail_auth_addr);

            // ***** mail
            $param_mail = array(
                'mail_title'=>$mail_title,
                'mail_lng_cd'=>$lng_cd,
                'mail_to'=>$post_arr['usr_id'],
                'mail_bcc'=>"grafish@designclue.co.kr",
                'mail_from'=>'mail@sendbox.kr',
                'mail_subj'=>$mail_subj,
                'mail_nm'=>$update_param['fields']['usr_nm'],
                'mail_sdct_nm'=>$update_param['fields']['usr_sdct_nm'],
                'mail_schl_nm'=>$update_param['fields']['usr_schl_nm'],
                'mail_major'=>$update_param['fields']['usr_major'],
                'mail_grade'=>$update_param['fields']['usr_grade'],
                'mail_mbl_num'=>$update_param['fields']['usr_mbl_num'],
                'mail_auth_addr'=>$mail_auth_addr,
                'mail_auth'=>$mail_auth
            );
            $this->CI->dl_mail->send_mail_ses($param_mail);
            $rtn = true;
        }

        return $rtn;
    }




    /*
     *----------------------------------------
     * S E N D - M A I L - A P P R O V A L
     *----------------------------------------
    */
    public function send_mail_approval( $post_arr = array() )
    {

        log_message("INFO", "oooo DL_auth -> send_mail_approval 1 :");
        //$rtn = $post_arr['usr_id'];
        //var_dump( $post_arr );
        log_message("INFO", "oooo DL_auth -> send_mail_approval 2 :".$post_arr['usr_id']);

        if( $post_arr['usr_id'] ) {
            //$this->CI->load->library('session');

            // $param 가져오기
            $param_cm = array(
                'tb_id' => 'ct_usr',
                'usr_id' => $post_arr['usr_id']
            );

            //var_dump( $this->DM_basic->getByUid($param_cm) );
            $this->CI->load->database();
            $update_param['fields'] = $this->CI->DM_basic->getByUid($param_cm);

            //$update_param['fields'] = $this->CI->get_usr();
            //var_dump( $this->config->item('usr') );

            //var_dump($update_param);
            //
            $this->CI->load->library('DL_mail');

            $mail_subj = 'Notification of approval completion';
            if ($post_arr['seg'] == "ko") {
                $mail_subj = '승인완료 안내메일';
            }

            //echo 'site_tit1 = '.$this->CI->config->item('site_tit');

            if( isset($post_arr['site_tit']) && $post_arr['site_tit'] ){
                $mail_title = $post_arr['site_tit'];
                log_message("INFO", "oooo DL_auth -> send_mail_approval 2.1 : site tit = ".$mail_title);
            }else if( isset($this->CI->site_tit) && $this->CI->site_tit ) {
                $mail_title = $this->CI->site_tit;
                log_message("INFO", "oooo DL_auth -> send_mail_approval 2.2 : site tit = ".$mail_title);
            }else{
                log_message("ERROR", "oooo DL_auth -> send_mail_approval 2.3 : no title");
                show_404();
            }


            if( $post_arr['seg'] ){
                $lng_cd = $post_arr['seg'];
            }else if( isset($this->CI->lng_cd) && $this->CI->lng_cd ){
                $lng_cd = $this->CI->lng_cd;
            }else{
                log_message("ERROR", "oooo DL_auth -> send_mail_approval 3 : no title");
                show_404();
            }

            $mail_link = 'Go to Competition Site';
            if( $post_arr['seg'] == "ko" ){
                $mail_link = '공모사이트 바로가기';
            }


            $base_URL = 'https://'.$_SERVER['HTTP_HOST'];

            $mail_link_addr = $base_URL.'/';

            // ***** mail
            $param_mail = array(
                'mail_title'=> $mail_title,
                'mail_lng_cd'=> $lng_cd,
                'mail_to'=>$post_arr['usr_id'],
                'mail_bcc'=>"grafish@designclue.co.kr",
                'mail_from'=>'admin@compe.org',
                'mail_subj'=>$mail_subj,
                'mail_pin'=>$update_param['fields']['usr_pin'],
                'mail_org_nm'=>$update_param['fields']['usr_org_nm0'],
                'mail_nm'=>$update_param['fields']['usr_nm0'],
                'mail_nat'=>$update_param['fields']['usr_nat0'],
                'mail_phone'=>$update_param['fields']['usr_mbl_num0'],
                'mail_link'=>$mail_link,
                'mail_link_addr'=>$mail_link_addr
            );
            $this->CI->dl_mail->send_mail_approval($param_mail);
            $rtn = true;
        }

        return $rtn;
    }



    /*
     *----------------------------------------
     * S E N D - M A I L - A D M I N
     *----------------------------------------
    */
    public function send_mail_admin( $post_arr = array() )
    {

        log_message("INFO", "oooo DL_auth -> send_mail_admin 1 :");
        //$rtn = $post_arr['usr_id'];
        //var_dump( $post_arr );
        log_message("INFO", "oooo DL_auth -> send_mail_admin 2 :".$post_arr['usr_id']);

        if( $post_arr['usr_id'] ) {

            $param_cm = array(
                'tb_id' => 'ct_usr',
                'usr_id' => $post_arr['usr_id']
            );

            //var_dump( $this->DM_basic->getByUid($param_cm) );
            $update_param['fields'] = $this->CI->DM_basic->getByUid($param_cm);

            $this->CI->load->library('DL_mail');

            $mail_subj = '승인요청 안내메일';

            //echo 'site_tit1 = '.$this->CI->config->item('site_tit');

            if( isset($post_arr['site_tit']) && $post_arr['site_tit'] ){
                $mail_title = $post_arr['site_tit'];
            }else if( isset($this->CI->site_tit) && $this->CI->site_tit ) {
                $mail_title = $this->CI->site_tit;
            }else{
                log_message("ERROR", "oooo DL_auth -> send_mail_admin 2.3 : no title");
                show_404();
            }

            $mail_link = '공모사이트 바로가기';

            $base_URL = 'https://'.$_SERVER['HTTP_HOST'];

            $mail_link_addr = $base_URL.'/';

            // ***** mail
            $param_mail = array(
                'mail_title'=> $mail_title,
                'mail_to'=>'lh@lhurbandesign.org',
                //'mail_to'=>'grafish9@gmail.com',
                'mail_bcc'=>"grafish@designclue.com",
                'mail_from'=>'admin@compe.org',
                'mail_subj'=>$mail_subj,
                'mail_cont'=>$update_param['fields']['usr_id'],
                'mail_org_nm'=>$update_param['fields']['usr_org_nm0'],
                'mail_nm'=>$update_param['fields']['usr_nm0'],
                'mail_link'=>$mail_link,
                'mail_link_addr'=>$mail_link_addr
            );
            $this->CI->dl_mail->send_mail_admin($param_mail);
            $rtn = true;
        }
        return $rtn;
    }





    /*
     *----------------------------------------
     * P O S T - P A R S E
     * get post data(xss) -> return array
     *----------------------------------------
    */
    private function post_parse()
    {
        log_message("INFO", "oooo DL_auth -> post_parse");
        $options = array();
        foreach($_POST as $key => $val)
        {
            // 필수정보에 대한 필터링 필요

            log_message("INFO", "oooo DL_auth -> post_parse : key =".$key." ::: val = ".$val);
            $options[$key] = $this->CI->input->post($key, TRUE);
        }
        return $options;
    }


    /*
     *----------------------------------------
     * S C H E M A - P A R S E
     * get schema -> return array
     *----------------------------------------
    */
    private function schema_parse($_schema_arr, $_post_arr)
    {
        log_message("INFO", "oooo DL_auth -> schema_parse");
        $options = array();
        foreach($_post_arr as $key => $val)
        {
            //echo '1';
            //echo $_schema_arr[$key];
            log_message("INFO", "oooo DL_auth -> schema_parse : key =".$key." ::: val = ".$val);
            if(  array_key_exists($key, $_schema_arr) ) {
                $options[$key] = $_post_arr[$key];
            }
        }
        return $options;
    }



    /*
     *----------------------------------------
     * G E T
     *----------------------------------------
    */
    private function get_auth($_str)
    {
        log_message("INFO", "oooo DL_auth -> get_auth _st = ".$_str);
        log_message("INFO", "oooo DL_auth -> get_auth rtn = ".$this->auth_arr[$_str]);
        return $this->auth_arr[$_str];
    }



    //
    public function set_pin(){
        $letter = chr(rand(65,90));
        $res = $this->get_random($letter);
        return $res;
    }



    // 고유번호 발생 및 중복검사
    public function get_random($param){
        $rtn='';
        $str='';
        $s_id = strtoupper($param);
        if($param){
            for($i=0; $i<2000; $i++){
                $str='';
                $pin='';
                //if($i == 0){
                //    $n = 904; // 테스트용
                //}else{
                $n = rand(0, 999);
                //}

                if($n>10 && $n<100){
                    $str = '0'.(string)$n;
                }else if($n<10){
                    $str = '00'.(string)$n;
                }else{
                    $str = (string)$n;
                }

                $pin = $s_id.'-'.$str;
                $option = array(
                    'tb_id'=>'ct_usr',
                    't_id'=>'usr_pin',
                    't_val'=>$pin
                );
                $res = $this->CI->DM_basic->chk_exist($option);
                if(!$res){
                    $rtn = $pin;
                    break;
                }
            }
        }
        return $rtn;
    }


    // check period
    public function chk_period($_subj)
    {
        $rtn=false;
        if( $_subj == 'regist' ) // 등록기간
        {
            $regist_end = '2020-10-30 15:00:00';
            $curr_time = date("Y-m-d H:i:s");
            if( (strtotime($regist_end)-strtotime($curr_time)) > 0 )
            {
                $rtn=true;
            }
        }else if( $_subj == 'period_modify_reg' ){ // 수정기간
            $period_modify_reg_end = '2020-10-30 15:00:00';
            $curr_time = date("Y-m-d H:i:s");
            if(strtotime($period_modify_reg_end)-strtotime($curr_time)>0)
            {
                $rtn=true;
            }
        }
        return $rtn;
    }



}
?>