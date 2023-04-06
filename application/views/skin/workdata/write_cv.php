<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php 
$prevPage = $_SERVER['HTTP_REFERER'];
if($m_id=='intnlctrl') {
    if($usr_arr['usr_id']=='nacf5061'||$usr_arr['usr_id']=='wtadmin'||$usr_arr['usr_id']=='admin'||$usr_arr['usr_id']=='hwonpark'||$usr_arr['usr_id']=='ycneh'||$usr_arr['usr_id']=='jeyun8835') { 
        
    } else {
        alert("접근 권한이 없습니다.", $prevPage);
    }
}
if($m_id=='finnaccexp') {
    if($usr_arr['usr_id']=='nacf50611'||$usr_arr['usr_id']=='wtadmin'||$usr_arr['usr_id']=='admin'||$usr_arr['usr_id']=='hwonpark'||$usr_arr['usr_id']=='ycneh'||$usr_arr['usr_id']=='jeyun8835') { 
        
    } else {
        alert("접근 권한이 없습니다.", $prevPage);
    }
}
if($m_id=='prevmnlaun'||$m_id=='prevmnlaun2') {
    if($usr_arr['usr_id']=='17311795'||$usr_arr['usr_id']=='19312949'||$usr_arr['usr_id']=='08305788'||$usr_arr['usr_id']=='21613193'||$usr_arr['usr_id']=='admin'||$usr_arr['usr_id']=='hwonpark'||$usr_arr['usr_id']=='ycneh'||$usr_arr['usr_id']=='jeyun8835') { 
        
    } else {
        alert("접근 권한이 없습니다.", $prevPage);
    }
}
?>

<!-- 게시글 쓰기 :: 시작-->

    <?php

    // ***** bbs write / file/ btn
    $this->load->view("brd/news_write");
    ?>

<!-- 게시글 쓰기 :: 끝-->




    
    

    


    