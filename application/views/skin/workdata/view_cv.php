<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php 
if($m_id=='intnlctrl'||$m_id=='finnaccexp'||$m_id=='prevmnlaun'||$m_id=='prevmnlaun2') {
    if($usr_arr['usr_id']=='관리자 아이디 입력') { 
        alert("접근 권한이 없습니다.?", "/index.php");
    }
}
?>
<!-- 게시글 보기 :: 시작-->

<?php

    // ***** bbs view
    $this->load->view("brd/news_view");

    // ***** bbs button
    $this->load->view("brd/common_btn");

    // ***** bbs like
    $this->load->view("brd/common_cmt");

    // ***** bbs comment
    $this->load->view("brd/common_cmt_lists");

?>

<!-- 게시글 보기 :: 끝-->