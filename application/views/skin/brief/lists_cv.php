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
    if($svc_mod=='adm'){
    ?>
        <div class="brd_bdy uk-overflow-auto">
            <?php if( count($lists) ){ ?>
                <table class="uk-table uk-table-small uk-table-divider">
                    <thead>
                    <tr>
                        <th class="no">번호</th>
                        <th class="tit">제목</th>
                        <th class="proc">작성자</th>
                        <th class="reg_date">등록일</th>
                        <?php if($is_adm_mod){ ?>
                            <th class="no">좋아요</th>
                            <th class="no">댓글수</th>
                            <th class="no">조회수</th>
                        <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for($i=0; $i<count($lists); $i++, $li_idx--){ ?>
                        <tr>
                            <td class="no"><?php echo $li_idx;?></td>
                            <td class="tit">
                                <a href="/<?php echo $seg;?>/<?php echo $m_id;?>/view?idx=<?php echo $lists[$i]['idx'];?>" class="chk_perm_view">
                                    <?php echo $lists[$i]['post_subj'];?>
                                </a><?php echo get_label_new($lists[$i]['crt_dtms']);?>
                            </td>
                            <td class="proc uk-text-center"><?php echo $lists[$i]['usr_nm'];?></td>
                            <td class="reg_date uk-text-center"><?php echo substr($lists[$i]['crt_dtms'], 2, 8);?></td>
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
                    <div class='uk-placeholder uk-height-medium uk-position-relative'><p class='uk-position-center'><?php if($lng_cd=='ko'){ echo "검색결과가 없습니다.";}else{echo "No Data.";}?></p></div>
                <?php }else{ ?>
                    <?php $this->load->view("brd/common_lists_nopost");?>
                <?php } ?>
            <?php } ?>
        </div>
    <?php }else{
        if( count($lists) ){?>
            <div class="brd_bdy brd_grd uk-child-width-1-2@m uk-grid-small uk-grid-match" uk-grid>
                <?php for ($i=0; $i<count($lists); $i++){?>
                    <div>
                        <div class="item uk-margin-bottom">
                            <a href="/<?php echo $seg;?>/<?php echo $m_id;?>/view?idx=<?php echo $lists[$i]['idx'];?>">
                                <div class="tit"><?php echo $lists[$i]['post_subj'];?><?php echo get_label_new($lists[$i]['crt_dtms']);?></div>
                            </a>
                            <p><?php echo $lists[$i]['post_summary'];?></p>
                            <div class="info"></div>
                            <div class="name"><?php echo $lists[$i]['usr_nm'];?></div>
                            <div class="date"><?php echo substr($lists[$i]['crt_dtms'], 2, 8);?></div>
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
    <?php
    }

    // ***** bbs pagination
    $this->load->view("brd/common_pagination");

    // ***** bbs nav
    $this->load->view("brd/common_btn");
    ?>


<!-- 게시글 목록 :: 시작-->