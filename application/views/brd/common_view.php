<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


    <?php if($view){ ?>
        <div class="brd_view">

            <input type="hidden" id="usr_id" value="<?php if(isset($usr['usr_id']) && $usr['usr_id']){ echo $usr['usr_id'];}?>">
            <input type="hidden" id="usr_nm" value="<?php if(isset($usr['usr_nm']) && $usr['usr_nm']){ echo $usr['usr_nm'];}?>">
            <input type="hidden" id="idx" value="<?php echo $view['idx'];?>">
            <input type="hidden" id="m_id" value="<?php echo $m_id;?>">

            <div class="tit_box">
                <div class="view_tit"><?php echo $view['post_subj'];?></div>

                <div class="info">
                    <span class="date uk-margin-right"><span class="tit">등록일 :</span> <?php echo substr($view['crt_dtms'], 2, 8);?></span>
                </div>
                <div class="tabs">
                <?php if(isset($file[0]['file_name']) && $file[0]['file_name']){?>
                    <a href="#" class="tab vw"> 첨부파일 (<?php echo $attach_file_cnt;?>) <img src="/static/svg/list_expend.svg" class="tab_icon"></a>
                <?php }?>
                <?php if($view['post_link_addr']){ ?>
                    <a href="<?php echo $view['post_link_addr'];?>" target="<?php echo $view['post_link_trgt'];?>" class="tab lnk"><span>원문</span> 링크 <img src="/static/svg/link.svg" class="tab_icon"></a>
                <?php } ?>
                </div>
            </div>

            <div class="cont_box">
                <?php
                if(isset($file[0]['file_name']) && $file[0]['file_name']){
                    echo '<div id="file_list">';
                    for($i=0; $i<count($file); $i++){
                        if($file[$i]['file_name']){
                ?>
                        <div>
                            <span class="txt"><?php echo $file[$i]['orig_name'];?></span>
                            <?php
                                $dload = $file[$i]['download_yn'];
                                $ext = explode('/', $file[$i]['file_type'])[1];
                                if($dload=='Y') {?>
                                    <a href="/ko/<?php echo $m_id;?>/dnload?idx=<?php echo $file[$i]['trgt_idx'];?>&fl=<?php echo $i+1;?>" class="unit" title="다운로드"><span class="uk-label down_label">다운로드</span></a>
                            <?php } ?>
                            <?php
                                $ext = explode('/', $file[$i]['file_type'])[1];
                                if ($ext=='pdf' || $ext=='png' || $ext=='jpg'|| $ext=='jpeg'|| $ext=='gif'|| $ext=='bmp'){ ?>
                                    <a href="/static/data/<?php echo $m_id;?>/<?php echo $file[$i]['file_name'];?>" target="_blank" class="unit" title="바로보기"><span class="uk-label view_label">바로보기</span></a>
                            <?php } ?>
                        </div>
                <?php
                        }
                    }
                    echo '</div>';
                }else{
                    //echo '<hr>';
                }
                ?>
                <div class="data uk-placeholder">
                    <?php if($m_id=='pr' || $m_id=='labdata' || $m_id=='edudata'){?>
                        <?php if($view['post_field']){ ?>
                        <div class="unit"><span class="tit">발행기관 : </span><span class="txt"><?php echo $view['post_field'];?></span></div>
                        <?php } ?>
                    <?php }?>
                </div>

                <div class="bd">
                <?php echo $view['post_cont'];?>
                </div>
                <?php
                //if($view['post_keyword']){
                //    echo "<div class='uk-placeholder keyword'>".$view['post_keyword']."</div>";
                //}
                ?>
            </div>
        </div>
    <?php }else{ ?>
        <div>
            <div class='uk-placeholder'><?php if($lng_cd=='ko'){ echo "게시글이 없습니다.";}else{echo "No Data";}?></div>
        </div>
    <?php } ?>

