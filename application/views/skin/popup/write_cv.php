<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<!-- 게시글 쓰기 :: 시작-->
<div class="brd_write">
    <form id="brdFormDefault" method="POST" action="/<?php echo $seg;?>/<?php echo $m_id;?>/insert" enctype="multipart/form-data" class="uk-form-stacked"><!--  -->
        <div class="uk-child-width-1-4@m" uk-grid>
            <input type="hidden" id="mode" value="write">
            <input type="hidden" id="m_id" value="<?php echo $m_id;?>">
            <input type="hidden" name="usr_id" value="<?php echo $usr['usr_id'];?>">
            <input type="hidden" name="usr_nm" value="<?php echo $usr['usr_nm'];?>">
            <!--<input type="hidden" name="usr_idx" value="<?php /*echo $usr_idx;*/?>">--><?php // ***** user email ?>

            <div class="uk-margin">
                <label class="uk-form-label">게시일</label>
                <div class="uk-form-controls">
                    <input class="uk-input datepicker" type="text" name="post_dtms" id="post_dtms" placeholder="YYYY-MM-DD">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">만료일</label>
                <div class="uk-form-controls">
                    <input class="uk-input datepicker" type="text" name="post_keyword" id="post_keyword" placeholder="YYYY-MM-DD">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label">배포여부</label>
                <div class="uk-form-controls">
                    <input type="checkbox" class="uk-checkbox" name="post_status" id="post_status" value="1"> 배포 (체크시 외부공개)
                </div>
            </div>

            <div class="uk-margin uk-width-1-1">
                <label class="uk-form-label">팝업내용</label>
                <div class="uk-form-controls">
                    <textarea class="uk-textarea ckeditor" name="post_cont" id="post_cont" rows='10'></textarea>
                </div>
            </div>

        </div>

        <?php $this->load->view("brd/common_btn"); ?>

    </form>
</div>

<!-- 게시글 쓰기 :: 끝-->




    
    

    


    