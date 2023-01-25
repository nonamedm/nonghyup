<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- 게시글 보기 :: 시작-->
<?php if($view){?>
    <div class="brd_view">
        <div class="view_line">
            <span class="v_tit uk-text-meta">제목 : </span><span class="v_cont uk-margin-small-left uk-margin-large-right"><?php echo $view['post_subj'];?></span>
        </div>
        <div class="view_line">
            <span class="v_tit uk-text-meta">작성자이름 : </span><span class="v_cont uk-margin-small-left uk-margin-large-right"><?php echo $view['usr_nm'];?></span>
            <span class="v_tit uk-text-meta">작성자아이디 : </span><span class="v_cont uk-margin-small-left uk-margin-large-right"><?php echo $view['usr_id'];?></span>
            <span class="v_tit uk-text-meta">등록일시 : </span><span class="v_cont uk-margin-small-left uk-margin-large-right"><?php echo $view['crt_dtms'];?></span>
        </div>

        <div class="view_line">
            <span class="v_tit uk-text-meta">내용</span><br>
            <?php echo $view['post_cont']; ?>
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