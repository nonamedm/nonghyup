<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- 게시글 보기 :: 시작-->
<?php

    // ***** bbs view
    $this->load->view("brd/news_view");

    // ***** bbs button
    if($m_id=='intnlctrl') {
        $this->load->view("brd/intnlctrl_btn");
    } else if($m_id=='finnaccexp') {
        $this->load->view("brd/finnaccexp_btn");
    } else if($m_id=='prevmnlaun'||$m_id=='prevmnlaun2') {
        $this->load->view("brd/prevmnlaun_btn");
    } else {
        $this->load->view("brd/common_btn");
    }

    // ***** bbs like
    $this->load->view("brd/common_cmt");

    // ***** bbs comment
    $this->load->view("brd/common_cmt_lists");

?>

<!-- 게시글 보기 :: 끝-->