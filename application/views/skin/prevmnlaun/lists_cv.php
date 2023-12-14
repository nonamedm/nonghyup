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


    <?php
    // ***** bbs pagination
    $this->load->view("brd/common_pagination");

    // ***** bbs nav
    if($m_id=='intnlctrl'&&($usr_arr['usr_id']=='nacf5061'||$usr_arr['usr_id']=='wtadmin')) {
        $this->load->view("brd/intnlctrl_btn");
    } else if($m_id=='finnaccexp'&&$usr_arr['usr_id']=='nacf50611') {
        $this->load->view("brd/finnaccexp_btn");
    } else if(($m_id=='prevmnlaun1'||$m_id=='prevmnlaun2')&& ($usr_arr['usr_id']=='17311795'||$usr_arr['usr_id']=='19312949'||$usr_arr['usr_id']=='08305788'||$usr_arr['usr_id']=='21613193')) {
        $this->load->view("brd/prevmnlaun_btn");
    } else {
        $this->load->view("brd/common_btn");
    }
    ?>

<!-- 게시글 목록 :: 시작-->