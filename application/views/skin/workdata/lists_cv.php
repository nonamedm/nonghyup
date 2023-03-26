<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- 게시글 목록 :: 시작-->

    <?php
    // ***** bbs title
    //$this->load->view("inc/cont_tit");

    // ***** bbs search
    if ($svc_mod=='adm') {
        $this->load->view("brd/adm_search");
    } else {
        $this->load->view("brd/common_search");
    }


    // ***** bbs sort
    $this->load->view("brd/common_sort");

    // ***** bbs list
    $this->load->view("brd/news_lists");

    // ***** bbs pagination
    $this->load->view("brd/common_pagination");

    // ***** bbs nav
    $this->load->view("brd/common_btn");
    ?>

<!-- 게시글 목록 :: 시작-->