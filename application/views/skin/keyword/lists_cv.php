<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- 게시글 목록 :: 시작-->

    <?php
    // ***** bbs title
    //$this->load->view("inc/cont_tit");

    // ***** bbs search
    if ($svc_mod=='adm') {
        //$this->load->view("brd/adm_search");
    } else {
        //$this->load->view("brd/common_search");
    }


    // ***** bbs sort
    //$this->load->view("brd/common_sort");
    ?>

    <div class="brd_bdy uk-overflow-auto">
        <?php if( count($lists) ){ ?>
            <table class="uk-table uk-table-small uk-table-divider">
                <thead>
                <tr>
                    <th class="no">번호 </th>
                    <th class="tit">키워드 </th>
                    <th class="w80">작성자</th>
                    <th class="w120">등록일 </th>
                    <th class="reg_date">배포여부</th>
                    <?php if($is_adm_mod){ ?>
                        <!--<th class="no">조회수</th>-->
                    <?php } ?>
                </tr>
                </thead>
                <tbody>
                <?php for($i=0; $i<count($lists); $i++, $li_idx--){ ?>
                    <tr>
                        <td class="no"><?php echo $li_idx;?></td>
                        <td class="tit" id="tit<?php echo $i;?>">
                            <?php //if($lists[$i]['post_link_addr'] && !$is_adm_mod){ ?>
                            <!--<a href="<?php /*echo $lists[$i]['post_link_addr'];*/?>" target="<?php /*echo $lists[$i]['post_link_trgt'];*/?>" class="chk_perm_view">-->
                            <?php //}else{ ?>
                            <a href="/<?php echo $seg;?>/<?php echo $m_id;?>/view?idx=<?php echo $lists[$i]['idx'];?>" class="chk_perm_view">
                                <?php //} ?>
                                <?php echo $lists[$i]['post_subj'];?>
                            </a><?php //echo get_label_new($lists[$i]['crt_dtms']);?>
                            <?php /*if($lists[$i]['post_link_addr']){ */?><!--<span class="uk-label link">외부링크연결</span>--><?php /*} */?>
                        </td>
                        <td class="w80"><?php echo $lists[$i]['usr_nm'];?></td>
                        <td class="w120"><?php echo substr($lists[$i]['crt_dtms'], 2, 8);?></td>
                        <td class="reg_date"><?php if($lists[$i]['post_status']==1) {echo '<span class="uk-label uk-label-success">배포중</span>';}else{echo '<span class="uk-label uk-label-warning">미배포</span>';}?></td>
                        <?php if($is_adm_mod){ ?>
                            <!--<td class="no"><?php /*echo $lists[$i]['post_hit'];*/?></td>-->
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