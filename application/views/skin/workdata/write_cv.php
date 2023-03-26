<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php 
if($m_id=='intnlctrl'||$m_id=='finnaccexp'||$m_id=='prevmnlaun'||$m_id=='prevmnlaun2') {
    if($usr_arr['usr_id']=='관리자 아이디 입력') { 
        alert("접근 권한이 없습니다.?", "/index.php");
    }
}
?>

<!-- 게시글 쓰기 :: 시작-->

    <?php

    // ***** bbs write / file/ btn
    $this->load->view("brd/news_write");
    ?>

<!-- 게시글 쓰기 :: 끝-->




    
    

    


    