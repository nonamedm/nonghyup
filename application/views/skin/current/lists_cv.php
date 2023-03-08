<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- 게시글 목록 :: 시작-->

    <?php
    if($is_adm_mod) {
        $this->load->view("brd/common_cat");
    }
    ?>

    <?php
    // ***** bbs title
    //$this->load->view("inc/cont_tit");
    // ***** bbs cat
    //$this->load->view("brd/common_cat");

    // ***** bbs search
    if ($svc_mod=='adm') {
        $this->load->view("brd/adm_search");
    } else {
        $this->load->view("brd/common_search");
    }
    ?>
    <div class="uk-placeholder category">
        <a href="/ko/current?cat=common" class="uk-label cat <?php if($cat=='common'){echo "focus";}?>">공통관련법규</a>
        <a href="/ko/current?cat=bank" class="uk-label cat <?php if($cat=='bank'){echo "focus";}?>">은행관련법규</a>
        <a href="/ko/current?cat=investment" class="uk-label cat <?php if($cat=='investment'){echo "focus";}?>">금융투자관련법규</a>
        <a href="/ko/current?cat=microfinance" class="uk-label cat <?php if($cat=='microfinance'){echo "focus";}?>">비은행관련법규</a>
    </div>
    <?php
    // ***** bbs sort
    $this->load->view("brd/common_sort");
    ?>

    <?php
    // ***** bbs pagination
    $this->load->view("brd/current_pagination");
    ?>

    <div class="brd_bdy uk-overflow-auto">
    <?php // bbs list
    if( count($lists) ){ ?>
        <table class="uk-table uk-table-small uk-table-divider">
            <thead>
            <tr>
                <th class="no">번호 </th>
                <th class="tit">제목 </th>
                <?php if($is_adm_mod){ ?>
                    <!--<th class="no">좋아요</th>-->
                    <!--<th class="no">댓글수</th>-->
                    <th class="no">조회수</th>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php for($i=0; $i<count($lists); $i++, $li_idx--){ ?>
                <tr>
                    <td class="no"><?php echo $li_idx;?></td>
                    <td class="tit" id="tit<?php echo $i;?>">
                        <?php if($svc_mod=='adm'){ ?>
                        <a href="/<?php echo $seg;?>/<?php echo $m_id;?>/view?idx=<?php echo $lists[$i]['idx'];?>">
                        <?php }else{ ?>
                        <a href="<?php echo $lists[$i]['post_link_addr'];?>" target="<?php echo $lists[$i]['post_link_trgt'];?>">
                        <?php } ?>
                            <?php echo $lists[$i]['post_subj'];?>
                            <span class="uk-label hidden" id="post_summary<?php echo $i;?>"><?php echo $lists[$i]['post_summary'];?></span>
                            <?php if($lists[$i]['post_link_addr']){ ?><span class="uk-label link"><img src="/static/svg/outlink.svg"></span><?php } ?>
                        </a>
                    </td>
                    <?php if($is_adm_mod){ ?>
                        <!--<td class="no"><?php /*echo $lists[$i]['post_like'];*/?></td>
                        <td class="no"><?php /*echo $lists[$i]['post_cmt_cnt'];*/?></td>-->
                        <td class="no"><?php echo $lists[$i]['post_hit'];?></td>
                    <?php } ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php }else{ ?>
        <?php if( $lists_mode=="sch" ){ ?>
            <div class='uk-placeholder uk-height-medium uk-position-relative'><p class='uk-position-center'><?php if($lng_cd=='ko'){ echo "검색결과가 없습니다.";}else{echo "No Data.";}?></p></div>
        <?php }else{ ?>
            <?php $this->load->view("brd/common_lists_nopost");?>
        <?php } ?>
    <?php } ?>
    </div>

    
    <?php
    // ***** bbs nav
    $this->load->view("brd/common_btn");
    ?>

<!-- 게시글 목록 :: 시작-->