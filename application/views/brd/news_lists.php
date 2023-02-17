<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="brd_bdy uk-overflow-auto">
    <?php if( count($lists) ){ ?>
        <table class="uk-table uk-table-small uk-table-divider">
            <thead class="wth">
            <tr>
                <th class="no">번호 </th>
                <?php if($m_id=='intnlctrl'||$m_id=='finnaccexp') { ?>                
                    <th class="cat">분류</th>
                <?php } else {?>
                <?php } ?>
                <th class="tit">제목 </th>
                <th class="part">작성자 </th>
                <th class="reg_date">등록일 </th>
                <?php if($is_adm_mod){ ?>
                    <th class="no">좋아요</th>
                    <th class="no">댓글수</th>
                    <th class="no">조회수</th>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php for($i=0; $i<count($lists); $i++, $li_idx--){ ?>
                <tr class="mtr">
                    <td class="">
                        <div class="tit">
                            <a href="/<?php echo $seg;?>/<?php echo $m_id;?>/view?idx=<?php echo $lists[$i]['idx'];?>" class="chk_perm_view">
                                <?php echo $lists[$i]['post_subj'];?>
                            </a><?php echo get_label_new($lists[$i]['crt_dtms']);?>
                        </div>
                        <div class="caption">
                            <span class="cat"><?php echo $lists[$i]['usr_nm'];?></span>
                            <span class="cat"><?php echo substr($lists[$i]['crt_dtms'], 2, 8);?></span>
                        </div>
                    </td>
                </tr>
                <tr class="wtr">
                    <td class="no"><?php echo $li_idx;?></td>
                    <?php if($m_id=='intnlctrl'||$m_id=='finnaccexp') { ?>                
                        <td class="cat"><div class="w100 ellipsis"><?php echo $lists[$i]['post_opt'];?></div></td>
                    <?php } else {?>
                    <?php } ?>
                    <td class="tit" id="tit<?php echo $i;?>">
                        <a href="/<?php echo $seg;?>/<?php echo $m_id;?>/view?idx=<?php echo $lists[$i]['idx'];?>" class="chk_perm_view">
                            <?php echo $lists[$i]['post_subj'];?><span class="uk-label hidden" id="post_summary<?php echo $i;?>"><?php echo $lists[$i]['post_summary'];?></span>
                        </a><?php echo get_label_new($lists[$i]['crt_dtms']);?>
                    </td>
                    <td class="part"><?php echo $lists[$i]['usr_nm'];?></td>
                    <td class="reg_date"><?php echo substr($lists[$i]['crt_dtms'], 2, 8);?></td>
                    <?php if($is_adm_mod){ ?>
                        <td class="no"><?php echo $lists[$i]['post_like'];?></td>
                        <td class="no"><?php echo $lists[$i]['post_cmt_cnt'];?></td>
                        <td class="no"><?php echo $lists[$i]['post_hit'];?></td>
                    <?php } ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <?php if( $lists_mode=="sch" ){ ?>
            <?php $this->load->view("brd/common_lists_nosearch");?>
        <?php }else{ ?>
            <?php $this->load->view("brd/common_lists_nopost");?>
        <?php } ?>
    <?php } ?>
</div>

