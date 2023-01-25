<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- 게시글 보기 :: 시작-->    
<div class="cont">

    <?php if($view){ ?>
        <div class="view_line">
       <span class="v_tit uk-text-meta">
           경로-메뉴명(국문) :
        </span><span>
            <?php echo $view['post_subj'];?>
        </span>
        </div>
        <div class="view_line">
       <span class="v_tit uk-text-meta">
           경로-메뉴명(영문) :
        </span><span>
            <?php echo $view['post_opt'];?>
        </span>
        </div>
        <div class="view_line">
            <span class="v_tit uk-text-meta">
            수정일 :
        </span><span class="v_cont uk-margin-right">
            <?php echo substr($view['updt_dtms'], 2, 8);?>
        </span>

            <span class="v_tit v_tit_mid uk-text-meta">
            작성자 :
        </span><span class="v_cont uk-margin-right">
            <?php echo $view['usr_nm'];?>
        </span>

        <span class="v_tit v_tit_mid uk-text-meta">
            페이지코드 :
        </span><span class="v_cont uk-margin-right">
            <?php echo $view['post_cont'];?>
        </span>
        </div>

        <div class="view_line">
            <span class="v_tit uk-text-meta">검색 키워드</span><br>
            <?php echo $view['post_field']; ?>
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

</div>
<!-- 게시글 보기 :: 끝-->