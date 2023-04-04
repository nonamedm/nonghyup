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
    if($m_id=='intnlctrl'&&($usr_arr['usr_id']=='nacf5061'||$usr_arr['usr_id']=='wtadmin')) {
        $this->load->view("brd/intnlctrl_btn");
    } else if($m_id=='finnaccexp'&&$usr_arr['usr_id']=='nacf50611') {
        $this->load->view("brd/finnaccexp_btn");
    } else if(($m_id=='prevmnlaun'||$m_id=='prevmnlaun2')&& ($usr_arr['usr_id']=='17311795'||$usr_arr['usr_id']=='19312949'||$usr_arr['usr_id']=='08305788'||$usr_arr['usr_id']=='21613193')) {
        $this->load->view("brd/prevmnlaun_btn");
    } else {
        $this->load->view("brd/common_btn");
    }
    ?>

<!-- 게시글 목록 :: 시작-->