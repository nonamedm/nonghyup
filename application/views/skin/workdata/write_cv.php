<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<!-- 게시글 쓰기 :: 시작-->

<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="brd_write">
    <form id="brdFormDefault" method="POST" action="/<?php echo $seg;?>/<?php echo $m_id;?>/" enctype="multipart/form-data" class="uk-form-stacked"><!--  -->
        <div class="uk-child-width-1-4@m uk-grid-small" uk-grid>
            <input type="hidden" id="mode" value="write">
            <input type="hidden" id="m_id" value="<?php echo $m_id;?>">
            <input type="hidden" name="usr_id" value="<?php echo $usr['usr_id'];?>">
            <!--<input type="hidden" name="usr_idx" value="<?php /*echo $usr_idx;*/?>">--><?php // ***** user email ?>


            <div class="uk-margin-small uk-width-1-1">
                <label class="uk-form-label">제목</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="post_subj" id="post_subj" placeholder="">
                </div>
            </div>

            <div class="uk-margin-small uk-width-1-1">
                <label class="uk-form-label">요약</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="post_summary" id="post_summary" placeholder="">
                </div>
            </div>

            <div class="uk-margin-small uk-width-1-1">
                <label class="uk-form-label">내용</label>
                <div class="uk-form-controls">
                    <textarea class="uk-textarea ckeditor" name="post_cont" id="post_cont" rows='10'></textarea>
                    <!--<textarea class="uk-textarea" name="post_cont" id="post_cont_editor" rows='10'></textarea>
                    <input type="hidden" name="post_cont" id="post_cont" value=''>-->
                </div>
            </div>

            <div class="uk-margin-small uk-width-1-3@m">
                <label class="uk-form-label">법령명</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="post_opt" id="post_opt" value="">
                </div>
            </div>

            <div class="uk-margin-small uk-width-1-3@m">
                <label class="uk-form-label">발행기관</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="post_field" id="post_field" value="">
                </div>
            </div>

            <div class="uk-margin-small uk-width-1-3@m">
                <label class="uk-form-label">회신일</label>
                <div class="uk-form-controls">
                    <input class="uk-input datepicker" type="text" name="post_dtms" id="post_dtms" value="" readonly>
                </div>
            </div>

            <div class="uk-margin-small uk-width-1-1">
                <label class="uk-form-label">키워드</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="post_keyword" id="post_keyword" placeholder="">
                </div>
            </div>

            <!--<input type="hidden" name="crt_dtms" id="crt_dtms" value="">-->
            <input type="hidden" name="usr_nm" id="usr_nm" value="<?php echo $usr['usr_nm'];?>">

            <div class="uk-margin-small uk-width-3-4@m">
                <label class="uk-form-label">외부링크</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="post_link_addr" id="post_link_addr" placeholder="주소입력시 보기화면에서 원문링크탭이 나타납니다.">
                </div>
            </div>

            <div class="uk-margin-small uk-width-1-4@m">
                <label class="uk-form-label">링크옵션</label>
                <div class="uk-form-controls">
                    <input class="uk-checkbox" type="checkbox" name="post_link_trgt" value="_blank" checked> 체크시 새창으로
                </div>
            </div>


        </div>

        <?php if($upload_files_num){ ?>
            <?php $this->load->view("brd/common_file"); ?>
        <?php } ?>

        <?php $this->load->view("brd/common_btn"); ?>

    </form>
</div>


<!-- 게시글 쓰기 :: 끝-->




    
    

    


    