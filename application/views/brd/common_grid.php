<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
// ***** bbs lists
if( count($lists) ){
    ?>

    <div class="brd_grd uk-child-width-1-2@m uk-grid-small uk-grid-match" uk-grid>
        <?php for ($i=0; $i<count($lists); $i++){?>
        <div>
            <div class="item uk-margin-bottom">
                <a href="/<?php echo $seg;?>/<?php echo $m_id;?>/view?idx=<?php echo $lists[$i]['idx'];?>">
                    <div class="tit"><?php echo $lists[$i]['post_subj'];?><!--<img src="/static/svg/new.svg" class="new">--></div>
                </a>
                <p><?php echo $lists[$i]['post_summary'];?></p>
                <div class="info"></div>
                <div class="name"><?php echo $lists[$i]['usr_nm'];?></div>
                <div class="date"><?php echo $lists[$i]['post_dtms'];?></div>
            </div>
        </div>
        <?php } ?>
    </div>
<?php }else{ ?>
    <?php if( $lists_mode=="sch" ){ ?>
        <div class='uk-placeholder uk-height-medium uk-position-relative'><p class='uk-position-center'><?php if($lng_cd=='ko'){ echo "검색결과가 없습니다.";}else{echo "No Data.";}?></p></div>
    <?php }else{ ?>
        <div class=''><span class=''><?php echo get_text("no_post",$lng_idx);?></span></div>
    <?php } ?>
<?php } ?>

