<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- 게시글 목록 :: 시작-->
<div class="cont">

    <?php
    // ***** bbs title
    //$this->load->view("inc/cont_tit");

    // ***** bbs search
    //$this->load->view("brd/common_search");

    // ***** bbs list
    $this->load->view("brd/common_lists");

    // ***** bbs pagination
    $this->load->view("brd/common_pagination");

    // ***** bbs nav
    $this->load->view("brd/common_btn");
    ?>

</div>
<!-- 게시글 목록 :: 시작-->