<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="uk-card uk-card-default uk-card-body">

    <form id="brdFormDefault" method="POST" action="/<?php echo $seg;?>/<?php echo $m_id;?>/insert" enctype="multipart/form-data" class="uk-form-stacked"><!--  -->
        <input type="hidden" id="mode" value="write">
        <input type="hidden" id="m_id" value="<?php echo $m_id;?>">
        <input class="uk-input" type="hidden" id="post_cat" name="post_cat" value="search">
        <!--<input type="hidden" name="usr_idx" value="<?php /*echo $usr_idx;*/?>">--><?php // ***** user email ?>

        <div class="uk-grid-small uk-child-width-expand@s" uk-grid>

            <?php // ***** 페이지제목 ?>
            <div class="uk-margin uk-width-1-1">
                <label class="uk-form-label">Page Subject</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="post_subj" id="post_subj" placeholder="페이지 제목">
                </div>
            </div>

            <?php // ***** 페이지링크 ?>
            <div class="uk-margin uk-width-1-1">
                <label class="uk-form-label">Page ID(link)</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="post_cont" id="post_cont" placeholder="페이지 코드">
                </div>
            </div>


            <?php // ***** content ?>
            <div class="uk-margin uk-width-1-1">
                <label class="uk-form-label">Keyword</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="post_field" id="post_field" placeholder="">
                </div>
            </div>

        </div>

        <?php if($upload_files_num){ ?>
            <?php $this->load->view("brd/common_file"); ?>
        <?php } ?>

        <?php $this->load->view("brd/common_btn"); ?>

    </form>

</div>
