<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- 게시글 보기 :: 시작-->    
<div class="cont">

    <?php if($view){ ?>
        <div class="brd_view">

            <input type="hidden" id="usr_id" value="<?php if(isset($usr['usr_id']) && $usr['usr_id']){ echo $usr['usr_id'];}?>">
            <input type="hidden" id="usr_nm" value="<?php if(isset($usr['usr_nm']) && $usr['usr_nm']){ echo $usr['usr_nm'];}?>">
            <input type="hidden" id="idx" value="<?php echo $view['idx'];?>">
            <input type="hidden" id="m_id" value="<?php echo $m_id;?>">

            <div class="tit_box">
                <div class="view_tit"><span class="uk-text-meta">키워드 :</span> <?php echo $view['post_subj'];?></div>

                <div class="info">
                    <span class="date uk-margin-right"><span class="tit">등록일 :</span> <?php echo substr($view['crt_dtms'], 2, 8);?></span>
                    <span class="date uk-margin-right"><span class="tit">작성자 :</span> <?php echo $view['usr_nm'];?>(<?php echo $view['usr_id'];?>)</span>
                </div>
            </div>

            <div class="cont_box">
                <div class="bd">
                    <?php echo $view['post_cont'];?>
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

    // ***** bbs comment & like
    //$this->load->view("brd/common_cmt");

    // ***** bbs comment & like
    //$this->load->view("brd/common_cmt_lists");
?>

</div>
<!-- 게시글 보기 :: 끝-->