<?php //defined('BASEPATH') OR exit('No direct script access allowed'); ?>

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
                        <th class="w40">번호</th>
                        <th class="w170">웹사이트명</th>
                        <th class="tit">설명</th>
                        <th class="w120">URL</th>

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
                            if ($lists[$i]['post_fix'] == 'Y') echo "fix";?>" >
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
                                    <span class="cat"><?php echo $lists[$i]['post_status'];?> (<?php echo substr($lists[$i]['post_dtms'], 2,8);?>)</span>
                                    <span class="cat"><?php echo $lists[$i]['post_field'];?></span>
                                    <span class="cat"><?php echo substr($lists[$i]['crt_dtms'], 2, 8);?></span>
                                </div>
                            </td>
                        </tr>
                        <tr class="wtr <?php
                            if ($lists[$i]['post_fix'] == 'Y') echo "fix";?>">
                            <td class="w40"><?php echo $li_idx;?></td>
                            <td class="w170"><?php echo $lists[$i]['post_subj'];?></td>
                            <td class="tit" id="tit<?php echo $i;?>">
                                <?php if($is_adm_mod){ ?>
                                    <a href="/<?php echo $seg;?>/<?php echo $m_id;?>/view?idx=<?php echo $lists[$i]['idx'];?>" class="chk_perm_view">
                                        <?php echo $lists[$i]['post_summary'];?>
                                    </a>
                                <?php }else{?>
                                    <?php echo $lists[$i]['post_summary'];?>
                                <?php } ?>
                            </td>
                            <td class="w120">
                                <a href="<?php echo $lists[$i]['post_link_addr'];?>"> <?php echo $lists[$i]['post_link_addr'];?></a>
                            </td>
                            <?php if($is_adm_mod){ ?>
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

<script type="text/javascript">
    (function() {

        setTimeout(() => tr_fix(), 200);

        function tr_fix(){
            var tr = $('.uk-table-divider > tbody > tr');
            var tr_len = $('.uk-table-divider > tbody > tr ').length;
            // for(var b=tr_len; b>=0; b--){
            //
            //     if(tr.eq(b).hasClass('fix')){
            //         var a = tr.eq(b);
            //         console.log(a);
            //         // a = tr.eq(0).next().after(tr.eq(b));
            //         tr.eq(b).css('backgroundColor','#f4f4f4');
            //     }else{
            //         console.log("fix 안됨"+b);
            //     }
            // }
            for(var i = tr_len; i>=0; i--){
                var a = tr.eq(i);
                if(tr.eq(i).hasClass('fix')){
                    if(i == 0){
                        a = tr.eq(0).next().after(tr.eq(1));
                    }else{
                        a = tr.eq(0).next().after(tr.eq(i));
                    }
                    tr.eq(i).css('backgroundColor','#f4f4f4');
                    a.children().eq(0).html('-');
                }else{
                    a = tr.eq(i).prev().before(tr.eq(i));
                }
            }
        }
    })();
</script>
<!-- 게시글 목록 :: 시작-->