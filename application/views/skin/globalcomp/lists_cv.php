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
    ?>

    <!-- ***** bbs list -->
    <div class="brd_bdy uk-overflow-auto">
        <?php if( count($lists) ){ ?>
            <table class="uk-table uk-table-small uk-table-divider">
                <thead class="wth">
                <tr>
                    <th class="no">번호 </th>
                    <?php if($m_id=='globalcomp2') { ?>
                        <th class="tit">국가 </th>
                    <?php }?>
                    <th class="tit">제목 </th>
                    <th class="part">발행기관 </th>
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
                    <tr class="mtr <?php
                        if ($lists[$i]['post_fix'] == 'Y') echo "fix";
                    ?>" >
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
                    <tr class="wtr <?php if ($lists[$i]['post_fix'] == 'Y') echo "fix";?>"
                                <?php if ($lists[$i]['post_fix'] == 'Y') echo "style=background-color:#f4f4f4"; ?>>
                        <td class="no"><?php if($lists[$i]['post_fix'] == 'Y') echo '-'; else echo $li_idx; ?></td>
                        <?php if($m_id=='globalcomp2') { ?>
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


    <?php
    // ***** bbs pagination
    $this->load->view("brd/common_pagination");

    // ***** bbs nav
    if(($m_id=='globalcomp1'||$m_id=='globalcomp2'||$m_id=='globalcomp3'||$m_id=='globalcomp4')&& ($usr_arr['usr_id']=='2910703673'||$usr_arr['usr_id']=='2259084387'||$usr_arr['usr_id']=='3282972707'||$usr_arr['usr_id']=='admin')) {
        $this->load->view("brd/globalcomp_btn");
    } else {
        $this->load->view("brd/common_btn");
    }
    ?>

<!-- 게시글 목록 :: 시작-->