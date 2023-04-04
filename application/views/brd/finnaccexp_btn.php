<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="uk-margin uk-width-1-1 uk-text-right brd_btn">
<!-- button start -->

<?php
/*
 * ------------------------------
 * L I S T
 * ------------------------------
*/
if($bbs_mod == 'lists'){ ?>
    <?php if( $usr_arr['usr_id']=='nacf50611'||$usr_arr['usr_id']=='wtadmin' ){ ?>
    <a class="uk-button uk-button-default uk-button-primary" href="<?php echo getLink($seg,$m_id,"write",$idx,$pg); ?>"><?php if($lng_cd=='ko'){ echo "작성";}else{echo "Write";}?></a>
    <?php } ?>


<?php 
/*
 * ------------------------------
 * V I E W
 * ------------------------------
*/
}else if($bbs_mod == 'view'){ ?>
    <?php if( $lists_perm['cd'] == 'pass' ){ ?>
    <a class="uk-button uk-button-default uk-align-left" href="<?php echo getLink($seg, $m_id, "lists", $idx, $pg); ?>" >목록</a>
    <?php } ?>
    
    <?php if (($usr_arr['usr_id']=='nacf50611'||$usr_arr['usr_id']=='wtadmin')) {?>
        <?php if (isset($rep['post_status']) && $rep['ord']) {?>
        <a class="uk-button uk-button-default mod" href="<?php echo getLink($seg, $m_id, "modify", $rep['idx'], $pg); ?>">답글 수정</a>
        <?php }?>
    <?php } ?>

    <?php if (($view['ord']>0 && $modify_perm['cd'] == 'pass' && $svc_mod=='adm') || ($usr_arr['usr_id']=='nacf50611'||$usr_arr['usr_id']=='wtadmin')) {?>
        <a class="uk-button uk-button-default mod" href="<?php echo getLink($seg, $m_id, "modify", $idx, $pg); ?>">수정</a>
    <?php } ?>




    <?php if( $reply_perm['cd']=='pass' && $svc_mod=='adm' && ($view['ord']==0 && $view['post_reply_cnt']==0) ){ ?>
        <a class="uk-button uk-button-default rep" href="<?php echo getLink($seg, $m_id, "reply", $idx, $pg); ?>">답변</a>
    <?php } ?>
    
    <?php if(  ($usr_arr['usr_id']=='nacf50611'||$usr_arr['usr_id']=='wtadmin')){ ?>
    <?php if(isset($rep['post_status']) && $rep['post_status']=='reply'){ ?>
        <a class="uk-button uk-button-default del" href="<?php echo getLink($seg, $m_id, "delete", $rep['idx'], $pg); ?>"
            onclick="return confirm('삭제하시겠습니까?');">답글 삭제</a>
    <?php }else{ ?>
        <a class="uk-button uk-button-default del" href="<?php echo getLink($seg, $m_id, "delete", $idx, $pg); ?>" 
            onclick="return confirm('삭제하시겠습니까?');">삭제</a>
    <?php } ?>
    <?php } ?>


<?php
/*
 * ------------------------------
 * W R I T E
 * ------------------------------
*/
}else if($bbs_mod == 'write'){ ?>

    <?php if( $lists_perm['cd']=='pass' ){?>
        <a class="uk-button uk-button-default uk-align-left" href="<?php echo getLink($seg,$m_id,"lists",$idx,$pg); ?>">목록</a>
    <?php } ?>
    
    <?php if( $write_perm['cd']=='pass' ){ ?>
        <input type="button" class="uk-button uk-button-default uk-button-primary btn_write" value="등록">
    <?php } ?>
    
    
<?php 
/*
 * ------------------------------
 * M O D I F Y
 * ------------------------------
*/
}else if($bbs_mod == 'modify'){ ?>

    <?php if( $lists_perm['cd']=='pass' ){ ?>
    <a class="uk-button uk-button-default uk-align-left" href="<?php echo getLink($seg,$m_id,"lists",$idx,$pg); ?>"><?php if($lng_cd=='ko'){ echo "목록";}else{echo "List";}?></a>
    <?php } ?>
    
    <?php if( $modify_perm['cd']=='pass' && ( $svc_mod=='adm' || $is_mine ) ){ ?>
    <input type="button" class="uk-button uk-button-default uk-button-primary mod btn_write" value="<?php if($lng_cd=='ko'){ echo "변경내용 저장";}else{echo "Save";}?>">
    <?php } ?>
    
    <?php if( $delete_perm['cd']=='pass' && ( $svc_mod=='adm' || $is_mine ) ){ ?>
    <a class="uk-button uk-button-default del" href="<?php echo getLink($seg,$m_id,"delete",$idx,$pg); ?>"
        onclick="return confirm('삭제하시겠습니까?');"><?php if($lng_cd=='ko'){ echo "삭제";}else{echo "Delete";}?></a>
    <?php } ?>


<?php
/*
 * ------------------------------
 * R E P L Y
 * ------------------------------
*/
}else if($bbs_mod == 'reply'){ ?>
    <?php if( $lists_perm['cd']=='pass' ){ ?>
        <a class="uk-button uk-button-default uk-align-left" href="<?php echo getLink($seg,$m_id,"lists",$idx,$pg); ?>"><?php if($lng_cd=='ko'){ echo "목록";}else{echo "List";}?></a>
    <?php } ?>

    <?php if( $reply_perm['cd']=='pass' ){ ?>
        <input type="button" class="uk-button uk-button-default uk-button-primary btn_reply" value="답변등록">
    <?php } ?>

<?php } ?>

<!-- button end -->
</div>