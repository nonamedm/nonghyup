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
            <thead>
            <tr>
                <th class="no">번호</th>
                <th class="cat">약관종류</th>
                <th class="proc">약관버전</th>
                <th class="reg_date">시행일</th>
                <th class="">등록일시</th>
                <th class="name">작성자</th>
                <th class="reg_date">배포여부</th>
            </tr>
            </thead>
            <tbody>
            <?php for($i=0; $i<count($lists); $i++, $li_idx--){ ?>
                <tr>
                    <td class="no"><?php echo $li_idx;?></td>
                    <td class="cat"><?php echo get_agree_cat($lists[$i]['post_cat']);?></td>
                    <td class="proc"><a href="/<?php echo $seg;?>/<?php echo $m_id;?>/view?idx=<?php echo $lists[$i]['idx'];?>" class="chk_perm_view"><?php echo $lists[$i]['post_subj'];?></a></td>
                    <td class="reg_date"><?php echo $lists[$i]['post_dtms']?></td>
                    <td class=""><?php echo $lists[$i]['crt_dtms'];?></td>
                    <td class="name"><?php echo $lists[$i]['usr_nm']."(".$lists[$i]['usr_id'].")";?></td>
                    <td class="reg_date"><?php if($lists[$i]['post_status']==1) {echo '<span class="uk-label uk-label-success">배포중</span>';}else{echo '<span class="uk-label uk-label-warning">미배포</span>';}?></td>
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

    <?php
    // ***** bbs pagination
    $this->load->view("brd/common_pagination");

    // ***** bbs nav
    $this->load->view("brd/common_btn");
    ?>

<!-- 게시글 목록 :: 시작-->