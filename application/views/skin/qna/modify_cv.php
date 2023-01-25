<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!-- 게시글 수정 :: 시작-->
<div class="cont">

    <div class="brd_modify">
        <form id="brdFormDefault" method="POST" action="" enctype="multipart/form-data" class="uk-form-stacked"><!-- /<?php //echo $seg;?>/<?php //echo $m_id;?>/update?idx=<?php //echo $idx;?> -->
            <div class="uk-child-width-1-4@m uk-grid-small" uk-grid>
                <input type="hidden" id="mode" value="modify">
                <input type="hidden" id="m_id" value="<?php echo $m_id;?>">
                <input type="hidden" id="upload_files_num" value="<?php echo $upload_files_num;?>">
                <input type="hidden" id="idx" name="idx" value="<?php echo $idx;?>">
                <input type="hidden" name="usr_id" value="<?php echo $usr['usr_id'];?>">
                <input type="hidden" name="post_status" value="reply">
                <input type="hidden" name="trgt_uid" value="<?php echo $modify['usr_id'];?>">
                <input type="hidden" name="trgt_idx" value="<?php echo $modify['trgt_idx'];?>">
                <input type="hidden" name="ord" value="1">



                <div class="uk-margin uk-width-1-1">
                    <label class="uk-form-label">제목</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="post_subj" id="post_subj" value="<?php echo $modify['post_subj'];?>">
                    </div>
                </div>

                <div class="uk-margin uk-width-1-1">
                    <label class="uk-form-label">내용</label>
                    <div class="uk-form-controls">
                        <textarea class="uk-textarea ckeditor" name="post_cont" id="post_cont" rows='10'><?php echo $modify['post_cont'];?></textarea>
                    </div>
                </div>

                <div class="uk-margin-small uk-width-1-6@m">
                    <label class="uk-form-label">작성자</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="usr_nm" id="usr_nm" value="<?php echo $modify['usr_nm'];?>">
                    </div>
                </div>

            </div>

            <?php $this->load->view("brd/common_btn"); ?>

        </form>
    </div>

</div>
<!-- 게시글 수정 :: 끝-->