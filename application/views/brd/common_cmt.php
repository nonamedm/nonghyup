<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php if($bbs_mod == 'view'){ ?>

<div class="uk-placeholder cmt">
    <a href="#" class="icon_box" id="like">
        <?php if($is_like){?>
        <img src="/static/svg/ico_loved.svg">
        <?php }else{?>
        <img src="/static/svg/ico_love.svg">
        <?php }?>
        <div class="icon_txt">좋아요 <span>(<span class="cnt"><?php echo $view['post_like'];?></span>)<span></div>
        <input type="hidden" id="is_like" value="<?php if($is_like){ echo $is_like; }else{ echo 0;}?>">
    </a>
    <?php if($is_adm_mod){ ?>
        <span class="icon_box">

        </span>
    <?php }else{ ?>
        <a href="#" class="icon_box" id="go_cmt">
            <img src="/static/svg/ico_comment.svg">
            <div class="icon_txt">댓글쓰기</div>
        </a>
    <?php }?>
</div>

<?php }?>
