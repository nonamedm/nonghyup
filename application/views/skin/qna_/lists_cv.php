<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- 게시글 목록 :: 시작-->
<div class="uk-card uk-card-default uk-card-body">
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

    // ***** bbs list
    ?>
    <div class="brd_bdy uk-overflow-auto">
        <?php if( count($lists) ){ ?>
        <table class="uk-table uk-table-small uk-table-divider">
            <tbody>
            <?php for($i=0; $i<count($lists); $i++, $li_idx--){ ?>
                <tr>
                    <td class="">
                        <div class="post_subj">
                            <span class="no"><?php echo $li_idx;?></span>
                            <span class="date"><?php echo substr($lists[$i]['crt_dtms'], 2, 8);?></span>
                            <span class="subj">
                                <a href="#" id="post<?php echo $i;?>" class="post_subj chk_perm_view"><?php echo $lists[$i]['post_subj'];?></a>
                            </span>

                        </div>
                        <div class="uk-placeholder post_cont" id="cont<?php echo $i;?>"><?php echo $lists[$i]['post_cont'];?></div>
                    </td>
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
</div>
<!-- 게시글 목록 :: 시작-->