<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!-- 게시글 수정 :: 시작-->
<div class="cont">

    <?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <form id="brdFormDefault" method="POST" action="/<?php echo $seg;?>/<?php echo $m_id;?>/update?idx=<?php echo $idx;?>" enctype="multipart/form-data" class="uk-form-stacked"><!--  -->
        <input type="hidden" id="mode" value="modify">
        <input type="hidden" id="m_id" value="<?php echo $m_id;?>">
        <input type="hidden" id="upload_files_num" value="<?php echo $upload_files_num;?>">
        <input type="hidden" id="idx" name="idx" value="<?php echo $idx;?>">
        <input type="hidden" name="usr_id" value="<?php echo $usr['usr_id'];?>"><?php // ***** user email ?>

        <div class="uk-grid-small uk-child-width-expand@s" uk-grid>
            <input type="hidden" name="post_cat" value="search">

            <?php // ***** subject ?>
            <div class="uk-margin uk-width-1-3@m">
                <label class="uk-form-label">경로-메뉴명(국문)</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="post_subj" id="post_subj" placeholder="" value="<?php echo $modify['post_subj']; ?>">
                </div>
            </div>

            <div class="uk-margin uk-width-1-2@m">
                <label class="uk-form-label">경로-메뉴명(영문)</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="post_opt" id="post_opt" placeholder="" value="<?php echo $modify['post_opt']; ?>">
                </div>
            </div>

            <div class="uk-margin uk-width-1-6@m">
                <label class="uk-form-label">페이지 코드</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="post_cont" id="post_cont" placeholder="링크용 아이디값" value="<?php echo $modify['post_cont']; ?>">
                </div>
            </div>


            <?php // ***** content ?>
            <div class="uk-margin uk-width-1-1">
                <label class="uk-form-label">키워드</label>
                <div class="uk-form-controls">
                    <textarea class="uk-textarea ckeditor" name="post_field" id="post_field" rows='5'><?php echo $modify['post_field']; ?></textarea>
                </div>
            </div>

        </div>

        <?php if($upload_files_num){ ?>
            <?php $this->load->view("brd/common_file"); ?>
        <?php } ?>

        <?php $this->load->view("brd/common_btn"); ?>

    </form>


</div>
<!-- 게시글 수정 :: 끝-->