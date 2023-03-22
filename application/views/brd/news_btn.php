<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="uk-margin uk-width-1-1 uk-text-right">
    <!-- button start -->

    <?php
    /*
     * ------------------------------
     * L I S T
     * ------------------------------
    */
    if($bbs_mod == 'lists'){ ?>

        <?php if( $write_perm['cd']=='pass' && ($svc_mod=='adm' || $m_id=='qna') ){ ?>
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
        <div class="pagination">
            <a href="#" class="uk-position-left"><img src="/static/svg/arrow_prev.svg" style="margin-right: 5px;">이전</a>

            <a class="btn_list" href="<?php echo getLink($seg,$m_id, "lists",$idx,$pg); ?>" ><?php if($lng_cd=='ko'){ echo "목록";}else{echo "List";}?></a>

            <a href="#" class="uk-position-right">다음<img src="/static/svg/arrow_next.svg" style="margin-left: 5px;"></a>
        </div>
        <?php } ?>

        <?php //if( $modify_perm['cd'] == 'pass' && ( $svc_mod=='adm' || $is_mine ) ){ ?>
        <!--<a class="uk-button uk-button-default mod" href="<?php /*echo getLink($seg,$m_id,"modify",$idx,$pg); */?>"><?php /*if($lng_cd=='ko'){ echo "수정";}else{echo "Modify";}*/?></a>-->
        <?php //} ?>

        <?php //if( $delete_perm['cd'] == 'pass' && ( $svc_mod=='adm' || $is_mine ) ){ ?>
        <!--<a class="uk-button uk-button-default del" href="<?php /*echo getLink($seg,$m_id, "delete",$idx,$pg); */?>"><?php /*if($lng_cd=='ko'){ echo "삭제";}else{echo "Delete";}*/?></a>-->
        <?php //} ?>


        <?php
        /*
         * ------------------------------
         * W R I T E
         * ------------------------------
        */
    }else if($bbs_mod == 'write'){ ?>

        <?php if( $lists_perm['cd']=='pass' ){ ?>
            <a class="uk-button uk-button-default uk-align-left" href="<?php echo getLink($seg,$m_id,"lists",$idx,$pg); ?>"><?php if($lng_cd=='ko'){ echo "목록";}else{echo "List";}?></a>
        <?php } ?>

        <?php if( $write_perm['cd']=='pass' && ($svc_mod=='adm' || $m_id=='qna') ){ ?>
            <?php if($m_id=='qna' ){ ?>
                <input type="submit" class="uk-button uk-button-default uk-button-primary" value="<?php if($lng_cd=='ko'){ echo "완료";}else{echo "Write";}?>">
            <?php }else{ ?>
                <input type="submit" class="uk-button uk-button-default uk-button-primary" value="<?php if($lng_cd=='ko'){ echo "작성";}else{echo "Write";}?>">
            <?php } ?>
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
            <input type="submit" class="uk-button uk-button-default uk-button-primary mod" value="<?php if($lng_cd=='ko'){ echo "수정";}else{echo "Modify";}?>">
        <?php } ?>

        <?php if( $delete_perm['cd']=='pass' && ( $svc_mod=='adm' || $is_mine ) ){ ?>
            <a class="uk-button uk-button-default del" href="<?php echo getLink($seg,$m_id,"delete",$idx,$pg); ?>"
                onclick="return confirm('삭제하시겠습니까?');"><?php if($lng_cd=='ko'){ echo "삭제";}else{echo "Delete";}?></a>
        <?php } ?>

    <?php } ?>

    <!-- button end -->
</div>