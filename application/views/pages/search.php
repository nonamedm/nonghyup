<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

    <div class="frs">
        <input type="hidden" id="dtl_opt" value="0">
        <input type="text" id="frs_sch" class="frs_sch_field" value="<?php if($s_fsw){ echo $s_fsw;}?>">
        <input type="hidden" id="rs_wrd" value="<?php if($s_fsw){ echo $s_fsw;}?>">
        <button class="frs_sch_btn">검색</button>
        <button class="frs_sch_dtl_btn"><span class="uk-label law">기간검색</span></button>
        <div class="frs_sch_dtl">
            <span class="">
                <button class="uk-close-small uk-position-top-right xclose" type="button" uk-close></button>
                <input type="text" class="uk-input datepicker" id="frs_sds" placeholder="검색시작일" value="<?php if($s_sds){ echo $s_sds;}?>" placeholder="YYYY-MM-DD"> ~ <input type="text" class="uk-input datepicker" placeholder="검색종료일" id="frs_sde" value="<?php if($s_sde){ echo $s_sde;}?>" placeholder="YYYY-MM-DD">
            </span>
        </div>
        <span class="re_search_box"> <input type="checkbox" class="uk-checkbox re_sch"> 결과 내 재검색</span>

    </div>

    <div class="uk-placeholder">
        <span class="sch_res_tit">"<span><?php echo $s_fsw;?></span>"(으)로 검색한 결과는 총(<?php echo $s_tot;?>)건 입니다.</span>
    </div>




    <div class="brd_bdy uk-overflow-auto">
        <?php
        if ($s_tot) {
            $k=0;
            foreach ($result as $key => $lists ){

                if(count($lists)){
                echo '<table class="uk-table uk-table-small uk-table-divider">';
        ?>
        <?php 
            if($key==='prevmnlaun1'||$key==='prevmnlaun2'||$key==='prevmnlaun3'||$key==='prevmnlaun4'||$key==='prevmnlaun5') {
        ?>
                <div class="sch_tit"><div class="ancher" id="<?php echo $key;?>"></div>자금세탁방지</div>
        <?php
            } else {
        ?>
            <div class="sch_tit"><div class="ancher" id="<?php echo $key;?>"></div><?php echo trans_idToNm($key);?></div>
        <?php
            }
        ?>

            <?php for($i=0; $i<count($lists); $i++){ ?>
            <tr class="<?php if($i==0){echo 'dv';}?>">
                <td class="tit">
                    <?php if($lists[$i]['post_link_addr'] && !$is_adm_mod){ ?>
                    <a href="<?php echo $lists[$i]['post_link_addr'];?>" target="<?php echo $lists[$i]['post_link_trgt'];?>" class="chk_perm_view">
                    <?php }else{ ?>
                    <a href="/<?php echo $seg;?>/<?php echo $key;?>/view?idx=<?php echo $lists[$i]['idx'];?>" class="chk_perm_view">
                        <?php } ?>
                        <?php echo $lists[$i]['post_subj'];?>
                    </a><?php if($lists[$i]['post_link_addr']){ ?><span class="uk-label link"><img src="/static/svg/outlink.svg"></span><?php } ?>
                    <br>
                    <?php 
                        if($key==='prevmnlaun1'||$key==='prevmnlaun2'||$key==='prevmnlaun3'||$key==='prevmnlaun4'||$key==='prevmnlaun5') {
                    ?>
                            <span class="uk-comment-meta">자금세탁방지</span>
                    <?php
                        } else {
                    ?>
                        <span class="uk-comment-meta"><?php echo trans_idToNm($key);?></span>
                    <?php
                        }
                    ?>
                     <span class="uk-comment-meta uk-margin-large-left"><?php echo substr($lists[$i]['crt_dtms'], 0 ,10);?></span>
                </td>
            </tr>
            <?php }?>

        <?php
                }// end of if
                echo '</table>';
            $k++;
            } // end of for
        ?>



        <?php } else { ?>
        <?php $this->load->view("brd/common_lists_nosearch");?>
        <?php } ?>
    </div>

