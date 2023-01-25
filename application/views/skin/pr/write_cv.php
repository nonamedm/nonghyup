<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<!-- 게시글 쓰기 :: 시작-->
<div class="cont">

    <div class="brd_write">
        <form id="brdFormDefault" method="POST" action="/<?php echo $seg;?>/<?php echo $m_id;?>/insert" enctype="multipart/form-data" class="uk-form-stacked"><!--  -->
            <div class="uk-child-width-1-4@m uk-grid-small" uk-grid>
                <input type="hidden" id="mode" value="write">
                <input type="hidden" id="m_id" value="<?php echo $m_id;?>">
                <input type="hidden" name="usr_id" value="<?php echo $usr['usr_id'];?>">
                <input type="hidden" name="usr_nm" id="usr_nm" value="<?php echo $usr['usr_nm'];?>">
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
                    </div>
                </div>

                <div class="uk-margin-small uk-width-3-5@m">
                    <label class="uk-form-label">키워드</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="post_keyword" id="post_keyword" placeholder="">
                    </div>
                </div>

                <div class="uk-margin-small uk-width-1-5@m">
                    <label class="uk-form-label">발행기관</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="post_field" id="post_field" value="">
                    </div>
                </div>

                <div class="uk-margin-small uk-width-1-5@m">
                    <label class="uk-form-label">등록일</label>
                    <div class="uk-form-controls">
                        <input class="uk-input datepicker" type="text" name="crt_dtms" id="crt_dtms" value="" readonly>
                    </div>
                </div>

                <?php if ($m_id=='lawmaking') {?>
                    <div class="uk-margin-small uk-width-3-4@m">
                        <label class="uk-form-label">외부링크</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" type="text" name="post_link_addr" id="post_link_addr" placeholder="주소입력시 목록에서 링크연결됩니다.">
                        </div>
                    </div>

                    <div class="uk-margin-small uk-width-1-4@m">
                        <label class="uk-form-label">링크옵션</label>
                        <div class="uk-form-controls">
                            <input class="uk-checkbox" type="checkbox" name="post_link_trgt" value="_blank" checked> 체크시 새창으로
                        </div>
                    </div>
                <?php }?>


            </div>

            <?php if($upload_files_num){ ?>
                <?php $this->load->view("brd/common_file"); ?>
            <?php } ?>

            <?php $this->load->view("brd/common_btn"); ?>

        </form>
    </div>


</div>
<!-- 게시글 쓰기 :: 끝-->




    
    

    


    