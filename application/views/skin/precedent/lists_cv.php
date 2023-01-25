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
                <th class="no">번호</th>
                <!--<th class="w80">구분</th>-->
                <th class="tit">제목</th>
                <!--<th class="w100">법원명</th>-->
                <!--<th class="w80">사건종류</th>-->
                <th class="w100">사건번호</th>
                <!--<th class="w160">법령명</th>-->
                <th class="reg_date">판결선고일 </th>
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
                            <span class="cat"><?php echo $lists[$i]['post_lng'];?></span>
                            <span class="cat"><?php echo $lists[$i]['post_dtms'];?></span>
                        </div>
                    </td>
                </tr>
                <tr class="wtr">
                    <td class="no"><?php echo $li_idx;?></td>
                    <!--<td class="w80"><?php /*echo $lists[$i]['post_cat'];*/?></td>-->
                    <td class="tit" id="tit<?php echo $i;?>">
                        <a href="/<?php echo $seg;?>/<?php echo $m_id;?>/view?idx=<?php echo $lists[$i]['idx'];?>" class="chk_perm_view">
                            <?php echo $lists[$i]['post_subj'];?>
                            <span class="uk-label hidden" id="post_summary<?php echo $i;?>"><?php echo $lists[$i]['post_summary'];?>
                        </a><?php echo get_label_new($lists[$i]['crt_dtms']);?>
                    </td>
                    <!--<td class="w100"><?php /*echo $lists[$i]['post_field'];*/?></td>-->
                    <!--<td class="w80"><?php /*echo $lists[$i]['post_typ'];*/?></td>-->
                    <td class=""><div class="w100 ellipsis"><?php echo $lists[$i]['post_lng'];?></div></td>
                    <!--<td class="w160"><?php /*echo $lists[$i]['post_opt'];*/?></td>-->
                    <td class="reg_date"><?php echo $lists[$i]['post_dtms'];?></td>
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