<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php 
if($m_id=='intnlctrl'||$m_id=='finnaccexp'||$m_id=='prevmnlaun'||$m_id=='prevmnlaun2') {
    if($usr_arr['usr_id']=='관리자 아이디 입력') { 
        alert("접근 권한이 없습니다.?", "/index.php");
    }
}
?>
<!-- 게시글 수정 :: 시작-->
<div class="cont">

    <?php
    // ***** bbs write / file/ btn
    $this->load->view("brd/common_modify");
    ?>

</div>
<!-- 게시글 수정 :: 끝-->