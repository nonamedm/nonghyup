<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- 게시글 보기 :: 시작-->
<?php if($view){?>
<div class="brd_view ">
    <div class="view_line">
        <span class="v_tit uk-text-meta">약관종류 : </span><span class="v_cont uk-margin-small-left uk-margin-large-right"><?php echo get_agree_cat($view['post_cat']);?></span>
        <span class="v_tit uk-text-meta">약관버전 : </span><span class="v_cont uk-margin-small-left uk-margin-large-right"><?php echo $view['post_subj'];?></span>
        <span class="v_tit uk-text-meta">배포여부 : </span><span class="v_cont uk-margin-small-left uk-margin-large-right"><?php if($view['post_status']==1) {echo '<span class="uk-label uk-label-success">배포중</span>';}else{echo '<span class="uk-label uk-label-warning">미배포</span>';}?></span>
    </div>
    <div class="view_line">
        <span class="v_tit uk-text-meta">시행일 : </span><span class="v_cont uk-margin-small-left uk-margin-large-right"><?php echo $view['post_dtms'];?></span>
        <span class="v_tit uk-text-meta">등록일시 : </span><span class="v_cont uk-margin-small-left uk-margin-large-right"><?php echo $view['crt_dtms'];?></span>
        <span class="v_tit uk-text-meta">작성자 : </span><span class="v_cont uk-margin-small-left uk-margin-large-right"><?php echo $view['usr_nm'];?></span>
    </div>

    <div class="view_line">
        <span class="v_tit uk-text-meta">약관내용</span><br>
        <div class="cont_agree">
        <?php echo $view['post_cont']; ?>
        </div>
    </div>
</div>
<?php }else{ ?>
<div>
    <div class='uk-placeholder'><?php if($lng_cd=='ko'){ echo "게시글이 없습니다.";}else{echo "No Data";}?></div>
</div>
<?php } ?>

<?php
// ***** bbs nav
$this->load->view("brd/common_btn");
?>
<!-- 게시글 보기 :: 끝-->