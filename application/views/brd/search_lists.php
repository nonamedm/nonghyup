<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<?php
// ***** bbs lists
if( count($lists) ){
    ?>

    <div class="uk-overflow-auto">
        <table class="uk-table uk-table-small cb_table">
            <thead>
            <tr>
                <th class="num uk-text-center">번호</th>
                <th class="path uk-text-center">경로-메뉴명</th>
                <th class="field uk-text-center">키워드</th>
            </tr>
            </thead>

            <tbody>
            <?php for($i=0; $i<count($lists); $i++, $li_idx--){ ?>
                <tr>
                    <td class="uk-text-center uk-heading-divider"><?php echo $li_idx;?></td>
                    <td class="uk-text-left uk-heading-divider"><?php echo $lists[$i]['post_subj'];?></td>
                    <td class="uk-text-left uk-heading-divider">
                        <a href="/<?php echo $seg;?>/<?php echo $m_id;?>/view?idx=<?php echo $lists[$i]['idx']?>"><?php echo $lists[$i]['post_field'];?></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php }else{ ?>
    <?php if( $lists_mode=="sch" ){ ?>
        <div class='uk-placeholder uk-height-medium uk-position-relative'><p class='uk-position-center'><?php if($lng_cd=='ko'){ echo "검색결과가 없습니다.";}else{echo "No Data.";}?></p></div>
    <?php }else{ ?>
        <div class=''><span class=''><?php echo get_text("no_post",$lng_idx);?></span></div>
    <?php } ?>
<?php } ?>

