<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- 게시글 보기 :: 시작-->
<?php if($view){ ?>
    <div class="uk-placeholder original">
        <div class="brd_view">
            <input type="hidden" id="usr_id" value="<?php if(isset($usr['usr_id']) && $usr['usr_id']){ echo $usr['usr_id'];}?>">
            <input type="hidden" id="usr_nm" value="<?php if(isset($usr['usr_nm']) && $usr['usr_nm']){ echo $usr['usr_nm'];}?>">
            <input type="hidden" id="idx" value="<?php echo $view['idx'];?>">
            <input type="hidden" id="m_id" value="<?php echo $m_id;?>">

            <div class="tit_box">
                <div class="view_tit"><?php echo $view['post_subj'];?></div>

                <div class="info">
                    <span class="date uk-margin-right"><span class="tit">등록일 :</span> <?php echo substr($view['crt_dtms'], 2, 8);?></span>
                    <span class="date uk-margin-right"><span class="tit">작성자 :</span> <?php echo $view['usr_nm'];?> ( <?php echo $view['usr_id'];?> )</span>
                </div>
            </div>
            <div class="cont_box">
                <?php echo $view['post_cont'];?>
            </div>
        </div>
    </div>
<?php } ?>

<?php if (isset($rep_arr) && count($rep_arr)) {?>
    <?php for ($i=0; $i<count($rep_arr); $i++) {?>
    <div class="uk-placeholder">
        <span class="uk-label uk-position-top-left">답글</span>
        <div class="brd_reply">
            <div class="tit_box">
                <div class="view_tit"><?php echo $rep_arr[$i]['post_subj'];?></div>

                <div class="info">
                    <span class="date uk-margin-right"><span class="tit">등록일 :</span> <?php echo substr($rep_arr[$i]['crt_dtms'], 2, 8);?></span>
                    <span class="date uk-margin-right"><span class="tit">작성자 :</span> <?php echo $rep_arr[$i]['usr_nm'];?> ( <?php echo $rep_arr[$i]['usr_id'];?> )</span>
                </div>
            </div>
            <div class="cont_box">
                <?php echo $rep_arr[$i]['post_cont'];?>
            </div>
        </div>
    </div>
    <?php } ?>
<?php } ?>

<?php
    // ***** bbs nav
    $this->load->view("brd/common_btn");

    // ***** bbs comment & like
    //$this->load->view("brd/common_cmt");

    // ***** bbs comment & like
    //$this->load->view("brd/common_cmt_lists");
?>
<!-- 게시글 보기 :: 끝-->
