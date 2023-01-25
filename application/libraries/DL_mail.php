<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DL_mail {

    protected $CI;

    public function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->CI =& get_instance();


    }


    function send_mail($option){

        // ====================
        //
        //  $option['cb_id']
        //  $option['cb_idx']
        //
        // --------------------

        if($option)
        {
            $this->load->library('email');
            // queue 테이블에 해당건이 있는지 조회 cb_id, cb_idx
            //$queue_arr = $this->CI->cb_model->mail_queue_gets($option)

            // ====================
            //
            //  수신자정보 : $queue_arr['cb_cont'][{'cb_id', 'cb_email', 'cb_name'}] : 수신자정보
            //  발신자이메일 : $queue_arr['cb_sender']
            //
            // --------------------

            //if($queue_arr)
            //{ // 결과가 있다면
            $context = json_decode($queue_arr->cb_cont);


            // ====================
            //
            // 등록메일 발송
            //
            // --------------------


            $this->email->initialize(array('mailtype'=>'html'));
            $this->email->from('grafish@designclue.com');
            $this->email->to($user->mb_email);

            $mailcode = "<html>";
            $mailcode .= "<head>";
            $mailcode .= "<meta http-equiv='content-type' content='text/html; charset=<utf-8'>";
            $mailcode .= "<title></title>";
            $mailcode .= "</head>";
            $mailcode .= "<style>";
            $mailcode .= "body, th, td, p, form, input, select, text, textarea, caption { font-size: 13px; font-family:Verdana; color:#333333;}";
            $mailcode .= "</style>";
            $mailcode .= "<body leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>";
            $mailcode .= "<table cellpadding='0' cellspacing='0' border='0' bgcolor='#ffffff' width='600' bgcolor='#ffffff'>";
            $mailcode .= "<tr><td> HEADER </td></tr>";
            $mailcode .= "<tr bgcolor='#ffffff'>";
            $mailcode .= "<td width='600' height='350'  align='center'>";
            $mailcode .= "<table cellpadding='0' cellspacing='0' border='0' >";
            $mailcode .= "<tr>";
            $mailcode .= "<td align='center' width='400' height='200' valign='middle' style='color:#333333;'>";
            $mailcode .= "<br>";
            $mailcode .= "<p>";
            $mailcode .= "Email(id) : ".$user->cb_email."<br>";
            //$mailcode .= "PIN : ".$user->cb_pin."<br>";
            $mailcode .= "Name : ".$user->cb_name."<br>";
            //$mailcode .= "Contact Number : ".$user->reg_phone."<br>";
            $mailcode .= "</p>";
            $mailcode .= "<br />";
            $mailcode .= "<br />";
            $mailcode .= "<br />";
            $mailcode .= "This mail is sent only.<br />";
            $mailcode .= "Please do not reply to this e-mail message.<br />";
            $mailcode .= "</td>";
            $mailcode .= "</tr>";
            $mailcode .= "</table>";
            $mailcode .= "</td>";
            $mailcode .= "</tr>";
            $mailcode .= "<tr><td> FOOTER </td></tr>";
            $mailcode .= "</table>";
            $mailcode .= "</body>";
            $mailcode .= "</html>";

            // 메일제목
            $this->email->subject();

            // message에 적용
            $this->email->message($mailcode);

            // 메일발송
            $this->email->send();


            // 해당 queue 삭제
            $this->batch_model->delete(array('id'=>$job->id));
            //break;
            //}

        }
    }


    function send_mail_ses($option){

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://email-smtp.us-east-1.amazonaws.com',
            'smtp_port' => 465,
            'smtp_user' => 'AKIAUYCUGQPLRTURF2O2',
            'smtp_pass' => 'BOiS7sT7ZpaJdEuJoU6fKaV6gDCe6WUtbrGqHPyVNa+h',
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );
        $this->CI->load->library('email', $config);
        $this->CI->email->set_newline("\r\n");

        $this->CI->email->from($option['mail_from']); //보내는쪽
        $this->CI->email->to($option['mail_to']); //받는쪽
        $this->CI->email->bcc($option['mail_bcc']); // 참조

        $this->CI->email->subject($option['mail_subj']);

        if($option['mail_lng_cd']=='ko'){
            $_id = 'ID(이메일)';
            $_mbl = '대표연락처';
            $_pin = '고유번호';
            $_com = '회사명';
            $_nm = '대표자 성명';
            $_nat = '대표자 국적';
            $_msg = '본 메일은 발신전용 메일입니다.';
            $_status = '공대생 심사위원단 등록신청은 접수되었습니다.';
            $_status1 = '메일인증 후 관리자승인이 완료되면, 공대생 심사위원단으로 활동하실 수 있습니다.';
            $_status2 = '진행상황은 로그인 후 마이페이지에서 확인하실 수 있습니다.';

        }






        $mailcode = "";
        $mailcode .= "<html>";
        $mailcode .= "<head>";
        $mailcode .= "<meta http-equiv='content-type' content='text/html; charset=<utf-8'>";
        $mailcode .= "<title>".$option['mail_subj']."</title>";
        $mailcode .= "</head>";
        $mailcode .= "<style>";
        $mailcode .= "body, th, td, p, form, input, select, text, textarea, caption { font-size: 13px; font-family:Verdana; color:#333333;}";
        $mailcode .= "</style>";
        $mailcode .= "<body leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>";
        $mailcode .= "<table cellpadding='0' cellspacing='0' border='0' bgcolor='#ffffff' width='600'>";
        $mailcode .= "<tr><td style='width: 100%; height: 50px; background: #222222; color: #fff; text-align:center; font-size: 18px; padding: 15px 8px;' valign='middle'>".$option['mail_title']."</td></tr>";
        $mailcode .= "<tr><td><hr></td></tr>";
        $mailcode .= "<tr bgcolor='#ffffff'>";
        $mailcode .= "<td width='600' height='80' align='center'><h2>".$option['mail_subj']."</h2></td></tr>";
        $mailcode .= "<tr bgcolor='#ffffff'>";
        $mailcode .= "<td width='600' height='150' align='center'>";
        $mailcode .= "<table cellpadding='0' cellspacing='0' border='0'>";
        $mailcode .= "<tr>";
        $mailcode .= "<td align='center' width='500' height='200' valign='middle' style='color:#333333;'>";
        $mailcode .= "<br>";
        $mailcode .= "<p>";
        $mailcode .= "아이디(이메일) : <span style='text-decoration:none;'>".$option['mail_to']."</span><br>";
        $mailcode .= "이름 : ".$option['mail_nm']."<br>";
        $mailcode .= "공학(기술)교육혁신선도센터 : ".$option['mail_sdct_nm']."<br>";
        $mailcode .= "학교 : ".$option['mail_schl_nm']."<br>";
        $mailcode .= "전공 : ".$option['mail_major']."<br>";
        $mailcode .= "학년 : ".$option['mail_grade']." 학년<br>";
        $mailcode .= "휴대폰 : ".$option['mail_mbl_num']."<br>";

        $mailcode .= "</p>";
        $mailcode .= "<hr>";
        $mailcode .= "<p>";
        $mailcode .= $_status."<br>";
        $mailcode .= $_status1."<br>";
        $mailcode .= $_status2."<br>";
        $mailcode .= "</p>";
        $mailcode .= "<br><br>";
        $mailcode .= "<div style='text-align: center; width: 100%;'>";
        $mailcode .= "<a href='".$option['mail_auth_addr']."' style='width: 200px; height: 60px; background:#222222; text-align:center; margin:0 auto; color: #fff; font-size: 16px; padding: 10px;' valign='middle'>";
        $mailcode .= $option['mail_auth'];
        $mailcode .= "</a></div>";
        $mailcode .= "<br><br>";
        $mailcode .= "<br><br><br>";
        $mailcode .= $_msg."<br>";
        $mailcode .= "</td>";
        $mailcode .= "</tr>";
        $mailcode .= "</table>";
        $mailcode .= "</td>";
        $mailcode .= "</tr>";
        $mailcode .= "<br><br>";
        $mailcode .= "<tr><td><hr></td></tr>";
        $mailcode .= "</table>";
        $mailcode .= "</body>";
        $mailcode .= "</html>";


        $this->CI->email->message($mailcode); //메세지
        $status = $this->CI->email->send();

        //print_r($status);
        //if($status) echo "이메일이 정상적으로 전송 되었습니다! form origon!";
        $this->CI->email->print_debugger();

    }


    function send_mail_approval($option){

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://email-smtp.us-east-1.amazonaws.com',
            'smtp_port' => 465,
            'smtp_user' => 'AKIAUYCUGQPLRTURF2O2',
            'smtp_pass' => 'BOiS7sT7ZpaJdEuJoU6fKaV6gDCe6WUtbrGqHPyVNa+h',
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );
        $this->CI->load->library('email', $config);
        $this->CI->email->set_newline("\r\n");

        $this->CI->email->from($option['mail_from']); //보내는쪽
        $this->CI->email->to($option['mail_to']); //받는쪽
        $this->CI->email->bcc($option['mail_bcc']); // 참조

        $this->CI->email->subject($option['mail_subj']);

        if($option['mail_lng_cd']=='ko'){
            $_id = 'ID(이메일)';
            $_com = '회사명';
            $_nm = '대표자 성명';
            $_msg = '본 메일은 발신전용 메일입니다.';
            $_status = '관리자 승인이 완료되었습니다. ';
            $_status1 = '로그인 후 우측 상단에 생성되는 ‘My Page’에서 계획지침 및 제공자료를 다운로드 받을 수 있습니다.';
        }else{
            $_id = 'ID(Email Address)';
            $_com = 'Organization';
            $_nm = 'Name';
            $_msg = 'This e mail is for sending use only. unrepliable.';
            $_status = 'Administrator approval is complete.';
            $_status1 = 'The participant be able to get access to the design guidelines and the provided materials from the “My Page” created at the top right after login.';
        }






        $mailcode = "";
        $mailcode .= "<html>";
        $mailcode .= "<head>";
        $mailcode .= "<meta http-equiv='content-type' content='text/html; charset=<utf-8'>";
        $mailcode .= "<title>".$option['mail_subj']."</title>";
        $mailcode .= "</head>";
        $mailcode .= "<style>";
        $mailcode .= "body, th, td, p, form, input, select, text, textarea, caption { font-size: 13px; font-family:Verdana; color:#333333;}";
        $mailcode .= "</style>";
        $mailcode .= "<body leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>";
        $mailcode .= "<table cellpadding='0' cellspacing='0' border='0' bgcolor='#ffffff' width='600'>";
        $mailcode .= "<tr><td style='width: 100%; height: 50px; background: #333; color: #fff; text-align:center; font-size: 18px; padding: 15px 8px;' valign='middle'>".$option['mail_title']."</td></tr>";
        $mailcode .= "<tr><td><hr></td></tr>";
        $mailcode .= "<tr bgcolor='#ffffff'>";
        $mailcode .= "<td width='600' height='80' align='center'><h2>".$option['mail_subj']."</h2></td></tr>";
        $mailcode .= "<tr bgcolor='#ffffff'>";
        $mailcode .= "<td width='600' height='150' align='center'>";
        $mailcode .= "<table cellpadding='0' cellspacing='0' border='0'>";
        $mailcode .= "<tr>";
        $mailcode .= "<td align='center' width='400' height='200' valign='middle' style='color:#333333;'>";
        $mailcode .= "<br>";
        $mailcode .= "<p>";
        $mailcode .= $_id." : <span style='text-decoration:none;'>".$option['mail_to']."</span><br>";
        //$mailcode .= $_mbl." : ".$option['mail_phone']."<br>";
        //$mailcode .= $_pin." : ".$option['mail_pin']."<br>";
        $mailcode .= $_com." : ".$option['mail_org_nm']."<br>";
        $mailcode .= $_nm." : ".$option['mail_nm']."<br>";
        //$mailcode .= $_nat." : ".$option['mail_nat']."<br>";
        $mailcode .= "</p>";
        $mailcode .= "<hr>";
        $mailcode .= "<p>";
        $mailcode .= $_status."<br>";
        $mailcode .= $_status1."<br>";
        $mailcode .= "</p>";
        $mailcode .= "<br><br>";
        $mailcode .= "<div style='text-align: center; width: 100%;'>";
        $mailcode .= "<a href='".$option['mail_link_addr']."' style='width: 400px; height: 60px; background:#A08ED9; text-align:center; margin:0 auto; color: #fff; font-size: 16px; padding: 10px;' valign='middle'>";
        $mailcode .= $option['mail_link'];
        $mailcode .= "</a></div>";
        $mailcode .= "<br><br>";
        $mailcode .= "<br><br><br>";
        $mailcode .= $_msg."<br>";
        $mailcode .= "</td>";
        $mailcode .= "</tr>";
        $mailcode .= "</table>";
        $mailcode .= "</td>";
        $mailcode .= "</tr>";
        $mailcode .= "<br><br>";
        $mailcode .= "<tr><td><hr></td></tr>";
        $mailcode .= "</table>";
        $mailcode .= "</body>";
        $mailcode .= "</html>";


        $this->CI->email->message($mailcode); //메세지
        $status = $this->CI->email->send();

        //print_r($status);
        //if($status) echo "이메일이 정상적으로 전송 되었습니다! form origon!";
        $this->CI->email->print_debugger();

    }



    function send_mail_admin($option){
        log_message("ERROR", "DL_insert  메일발송 5");
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://email-smtp.us-east-1.amazonaws.com',
            'smtp_port' => 465,
            'smtp_user' => 'AKIAUYCUGQPLQ6ZFRSHH',
            'smtp_pass' => 'BAe46f0BfoelWPKHcwqEMjntWKPfFWiiWct9ixPrXNqt',
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );
        $this->CI->load->library('email', $config);
        $this->CI->email->set_newline("\r\n");

        $this->CI->email->from($option['mail_from']); //보내는쪽
        $this->CI->email->to($option['mail_to']); //받는쪽
        $this->CI->email->bcc($option['mail_cc']); // 참조

        $this->CI->email->subject($option['mail_subj']);

        $_msg = '본 메일은 발신전용 메일입니다.';

        log_message("ERROR", "DL_insert  메일발송 6");




        $mailcode = "";
        $mailcode .= "<html>";
        $mailcode .= "<head>";
        $mailcode .= "<meta http-equiv='content-type' content='text/html; charset=<utf-8'>";
        $mailcode .= "<title>".$option['mail_subj']."</title>";
        $mailcode .= "</head>";
        $mailcode .= "<style>";
        $mailcode .= "body, th, td, p, form, input, select, text, textarea, caption { font-size: 13px; font-family:Verdana; color:#333333;}";
        $mailcode .= "</style>";
        $mailcode .= "<body leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>";
        $mailcode .= "<table cellpadding='0' cellspacing='0' border='0' bgcolor='#ffffff' width='600'>";
        $mailcode .= "<tr><td style='width: 100%; height: 50px; background: #333; color: #fff; text-align:center; font-size: 18px; padding: 15px 8px;' valign='middle'>".$option['mail_title']."</td></tr>";
        $mailcode .= "<tr><td><hr></td></tr>";
        $mailcode .= "<tr bgcolor='#ffffff'>";
        $mailcode .= "<td width='600' height='80' align='center'><h2>".$option['mail_subj']."</h2></td></tr>";
        $mailcode .= "<tr bgcolor='#ffffff'>";
        $mailcode .= "<td width='600' height='150' align='center'>";
        $mailcode .= "<table cellpadding='0' cellspacing='0' border='0'>";
        $mailcode .= "<tr>";
        $mailcode .= "<td align='left' width='400' height='200' valign='middle' style='color:#333333;'>";
        $mailcode .= "<br>";
        $mailcode .= "아이디 : ".$option['usr_id']."<br>";
        $mailcode .= "이름 : ".$option['usr_nm']."<br>";
        $mailcode .= "<p>";
        $mailcode .= "<span style='text-decoration:none;'>".$option['mail_cont']."</span><br>";
        $mailcode .= "</p>";
        $mailcode .= "<hr>";
        $mailcode .= "<p>";
        $mailcode .= "</p>";
        $mailcode .= "<br><br>";
        $mailcode .= "<div style='text-align: center; width: 100%;'>";
        $mailcode .= "<br><br>";
        $mailcode .= "<br><br><br>";
        $mailcode .= $_msg."<br>";
        $mailcode .= "</td>";
        $mailcode .= "</tr>";
        $mailcode .= "</table>";
        $mailcode .= "</td>";
        $mailcode .= "</tr>";
        $mailcode .= "<br><br>";
        $mailcode .= "<tr><td><hr></td></tr>";
        $mailcode .= "</table>";
        $mailcode .= "</body>";
        $mailcode .= "</html>";

        log_message("ERROR", "DL_insert  메일발송 7");
        $this->CI->email->message($mailcode); //메세지
        $status = $this->CI->email->send();
        log_message("ERROR", "DL_insert  메일발송 8");
        //print_r($status);
        //if($status) echo "이메일이 정상적으로 전송 되었습니다! form origon!";
        $this->CI->email->print_debugger();

    }

}