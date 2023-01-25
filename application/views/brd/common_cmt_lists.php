<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php if($bbs_mod == 'view'){ ?>

    <?php if(count($cmt_list)){?>
    <div class="uk-text-meta uk-text-right uk-margin-small-bottom">전체댓글수(<?php echo $view['post_cmt_cnt'];?>)</div>
    <div class="cmt_lists uk-width-1-1">
        <table class="uk-table uk-table-small uk-table-divider cmt_table">
        <?php for($i=0; $i<count($cmt_list); $i++){?>
        <tr>
            <td>
                <div>
                    <span class="uk-text-meta uk-margin-right"><?php echo $cmt_list[$i]['usr_nm'];?></span>
                    <span class="uk-text-meta"><?php echo substr($cmt_list[$i]['crt_dtms'],2, 8);?></span>
                </div>
                <div class="cmt_row">
                    <span><?php echo $cmt_list[$i]['cmt_cont'];?></span>
                    <?php if($is_adm_mod){ ?>
                    <a href="#" id="cmt<?php echo $cmt_list[$i]['idx'];?>" class="cmt_del uk-label">삭제</a>
                    <?php } ?>
                </div>
            </td>
        </tr>
        <?php }?>
        </table>
    </div>
    <?php }?>
    <?php if(!$is_adm_mod){?>
    <div class="cmt_box">
        <textarea class="uk-textarea" id="cmt_cont" rows="2" placeholder="제공되는 서비스/콘텐츠에 대한 개선의견을 적어주세요."></textarea>
        <button class="uk-button uk-button-default uk-button-primary uk-button-small btn_cmt"><img src="/static/svg/ico_comment.svg"><span>전송</span></button>
    </div>
    <?php }?>
<?php }?>
