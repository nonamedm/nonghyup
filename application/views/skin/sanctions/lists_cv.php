<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- 게시글 목록 :: 시작-->

    <?php
    // ***** bbs title
    //$this->load->view("inc/cont_tit");

    // ***** bbs search
    if ($svc_mod=='adm') {
        $this->load->view("brd/adm_search");
    } else {
        $this->load->view("brd/common_search");
    }


    // ***** bbs sort
    $this->load->view("brd/common_sort");

    // ***** bbs list
    ?>
    <div class="brd_bdy uk-overflow-auto">
        <?php if( count($lists) ){ ?>
            <table class="uk-table uk-table-small uk-table-divider">
                <thead class="wth">
                    <tr>
                        <th class="w40" style="width:5%;">번호</th>
                        <th id="brd_sch_dtl_th" class="w40" style="width:10%;">제재조치요구일</th>
                        <th class="w40" style="width:10%;">위반법률</th>
                        <th class="tit" style="width:50%;">제목</th>
                        <th class="w170" style="width:15%;">제재대상 기관</th>
                        <?php if($is_adm_mod){ ?>
                            <th class="no">좋아요</th>
                            <th class="no">댓글수</th>
                            <th class="no">조회수</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<count($lists); $i++, $li_idx--){ ?>
                        <tr class="mtr <?php
                        if ($lists[$i]['post_fix'] == 'Y') echo "fix";
                        ?>" >
                            <td class="">
                                <div class="tit">
                                    <?php if($lists[$i]['post_link_addr'] && !$is_adm_mod){ ?>
                                    <a href="<?php echo $lists[$i]['post_link_addr'];?>" target="<?php echo $lists[$i]['post_link_trgt'];?>" class="chk_perm_view">
                                    <?php }else{ ?>
                                    <a href="/<?php echo $seg;?>/<?php echo $m_id;?>/view?idx=<?php echo $lists[$i]['idx'];?>" class="chk_perm_view">
                                    <?php } ?>
                                        <?php echo $lists[$i]['post_subj'];?>
                                    </a><?php echo get_label_new($lists[$i]['crt_dtms']);?>
                                    <?php if($lists[$i]['post_link_addr']){ ?><span class="uk-label link">외부링크연결</span><?php } ?>
                                </div>
                                <div class="caption">
                                    <span class="cat"><?php echo $lists[$i]['post_status'];?> (<?php echo substr($lists[$i]['crt_dtms'], 2,8);?>)</span>
                                    <span class="cat"><?php echo $lists[$i]['post_field'];?></span>
                                    <span class="cat"><?php echo substr($lists[$i]['crt_dtms'], 2, 8);?></span>
                                </div>
                            </td>
                        </tr>
                        <tr class="wtr <?php if ($lists[$i]['post_fix'] == 'Y') echo "fix";?>"
                            <?php if ($lists[$i]['post_fix'] == 'Y') echo "style=background-color:#f4f4f4"; ?>>
                            <td class="w40"><?php if($lists[$i]['post_fix'] == 'Y') echo '-'; else echo $li_idx; ?></td>
                            <td class="w40"><?php echo $lists[$i]['crt_dtms'];?></td>
                            <td class="w170"><?php echo $lists[$i]['post_cat'];?></td>
                            <td class="tit" id="tit<?php echo $i;?>">
                                <?php if($lists[$i]['post_link_addr'] && !$is_adm_mod){ ?>
                                <a href="<?php echo $lists[$i]['post_link_addr'];?>" target="<?php echo $lists[$i]['post_link_trgt'];?>" class="chk_perm_view">
                                <?php }else{ ?>
                                <a href="/<?php echo $seg;?>/<?php echo $m_id;?>/view?idx=<?php echo $lists[$i]['idx'];?>" class="chk_perm_view">
                                <?php } ?>
                                    <?php echo $lists[$i]['post_subj'];?><span class="uk-label hidden" id="post_summary<?php echo $i;?>"><?php echo $lists[$i]['post_summary'];?></span>

                                </a><?php echo get_label_new($lists[$i]['crt_dtms']);?>
                                    <?php if($lists[$i]['post_link_addr']){ ?><span class="uk-label link">외부링크연결</span><?php } ?>
                            </td>
                            <td class="w170"><?php echo $lists[$i]['post_field'];?></td>
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
    <?php
    // ***** bbs pagination
    $this->load->view("brd/common_pagination");

    // ***** bbs nav
    $this->load->view("brd/common_btn");
    ?>

<!-- 게시글 목록 :: 시작-->