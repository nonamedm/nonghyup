<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="brd_write">
    <form id="brdFormDefault" method="POST" action="/<?php echo $seg;?>/<?php echo $m_id;?>/insert" enctype="multipart/form-data" class="uk-form-stacked"><!--  -->
        <div class="uk-child-width-1-4@m uk-grid-small" uk-grid>
            <input type="hidden" id="mode" value="write">
            <input type="hidden" id="m_id" value="<?php echo $m_id;?>">
            <input type="hidden" name="usr_id" value="<?php echo $usr['usr_id'];?>">
            <!--<input type="hidden" name="usr_idx" value="<?php /*echo $usr_idx;*/?>">--><?php // ***** user email ?>

            <?php if($m_id=='intnlctrl') { ?>                
                <div class="uk-margin-small uk-width-1-5@m">
                    <label class="uk-form-label">구분</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" name="post_opt" id="post_opt">
                            <option value="보도자료" >보도자료</option>
                            <option value="연구자료">연구자료</option>
                            <option value="제·개정">제·개정</option>
                            <option value="기타">기타</option>
                        </select>
                    </div>
                </div>
            <?php } else if($m_id=='finnaccexp'){?>
                <div class="uk-margin-small uk-width-1-5@m">
                    <label class="uk-form-label">구분</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="post_opt" id="post_opt" value="">
                    </div>
                </div>
            <?php } else {}?>


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
                </div>
            </div>

            <div class="uk-margin-small uk-width-2-3@m">
                <label class="uk-form-label">키워드</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="post_keyword" id="post_keyword" placeholder="">
                </div>
            </div>


            <div class="uk-margin-small uk-width-1-6@m">
                <label class="uk-form-label">등록일</label>
                <div class="uk-form-controls">
                    <input class="uk-input datepicker" type="text" name="crt_dtms" id="crt_dtms" value="" placeholder="YYYY-MM-DD">
                </div>
            </div>



            <div class="uk-margin-small uk-width-1-6@m">
                <label class="uk-form-label">작성자</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="usr_nm" id="usr_nm" value="<?php echo $usr['usr_nm'];?>">
                </div>
            </div>



            <div class="uk-margin-small uk-width-3-4@m">
                <label class="uk-form-label">원문링크</label>
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
