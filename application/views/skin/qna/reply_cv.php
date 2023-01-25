<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="uk-placeholder original">
    <div class="brd_reply">

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
            <div class="bd">
                <?php echo $view['post_cont'];?>
            </div>

        </div>
    </div>

</div>
<div class="uk-placeholder">
    <div class="brd_write">
        <form id="brdFormDefault" method="POST" action="" enctype="multipart/form-data" class="uk-form-stacked">
            <input type="hidden" id="mode" value="reply">
            <input type="hidden" id="m_id" value="<?php echo $m_id;?>">
            <input type="hidden" name="usr_id" value="<?php echo $usr['usr_id'];?>">
            <input type="hidden" name="trgt_idx" value="<?php echo $view['idx'];?>">

            <div class="uk-grid-small uk-child-width-expand@s" uk-grid>


                <div class="uk-margin-small uk-width-1-1">
                    <label class="uk-form-label">답변 제목</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="post_subj" id="post_subj" placeholder="">
                    </div>
                </div>

                <div class="uk-margin-small uk-width-1-1">
                    <label class="uk-form-label">답변 내용</label>
                    <div class="uk-form-controls">
                        <textarea class="uk-textarea ckeditor" name="post_cont" id="post_cont" rows='10'></textarea>
                    </div>
                </div>

                <div class="uk-margin-small uk-width-1-6@m">
                    <label class="uk-form-label">작성자</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="usr_nm" id="usr_nm" value="<?php echo $usr['usr_nm'];?>">
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
<?php $this->load->view("brd/common_btn"); ?>
