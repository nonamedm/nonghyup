<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- 게시글 보기 :: 시작-->

    <?php if($view){ ?>
        <div class="brd_view">

            <input type="hidden" id="usr_id" value="<?php echo $usr['usr_id'];?>">
            <input type="hidden" id="usr_nm" value="<?php echo $usr['usr_nm'];?>">
            <input type="hidden" id="idx" value="<?php echo $view['idx'];?>">
            <input type="hidden" id="m_id" value="<?php echo $m_id;?>">

            <div class="tit_box">
                <div class="view_tit"><?php echo $view['post_subj'];?></div>

                <div class="info">
                    <span class="name uk-margin-right uk-visible@m"><span class="tit">작성자 :</span> <?php echo $view['usr_nm'];?></span>
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
                                if($dload=='Y' && $ext=='pdf') {?>
                                    <a href="/ko/<?php echo $m_id;?>/dnload?idx=<?php echo $file[$i]['trgt_idx'];?>&fl=<?php echo $i+1;?>" class="unit" title="다운로드"><span class="uk-label down_label">다운로드</span></a>
                            <?php } ?>
                            <?php
                                $ext = explode('/', $file[$i]['file_type'])[1];
                                if ($ext=='pdf' || $ext=='png' || $ext=='jpeg'){ ?>
                                    <a href="/static/data/<?php echo $m_id;?>/<?php echo $file[$i]['file_name'];?>" target="_blank" class="unit" title="바로보기"><span class="uk-label view_label">바로보기</span></a>
                            <?php } ?>
                        </div>
                <?php
                        }
                    }
                    echo '</div>';
                }
                ?>
                
                <?php echo $view['post_cont'];?>
            </div>
        </div>
    <?php }else{ ?>
        <div>
            <div class='uk-placeholder'><?php if($lng_cd=='ko'){ echo "게시글이 없습니다.";}else{echo "No Data";}?></div>
        </div>
    <?php } ?>

    <?php
    // ***** bbs button
    $this->load->view("brd/common_btn");

    // ***** bbs like
    $this->load->view("brd/common_cmt");

    // ***** bbs comment
    $this->load->view("brd/common_cmt_lists");
    ?>

<!-- 게시글 보기 :: 끝-->