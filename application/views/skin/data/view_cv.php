<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- 게시글 보기 :: 시작-->    
<div class="cont">

<?php

    // ***** bbs view
    $this->load->view("brd/common_view");

    // ***** bbs button
    $this->load->view("brd/common_btn");

    // ***** bbs like
    $this->load->view("brd/common_cmt");

    // ***** bbs comment
    $this->load->view("brd/common_cmt_lists");

?>

</div>
<!-- 게시글 보기 :: 끝-->