<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- 게시글 수정 :: 시작-->
<div class="brd_modify">
    <form id="brdFormDefault" method="POST" action="" enctype="multipart/form-data" class="uk-form-stacked"><!-- /<?php //echo $seg;?>/<?php //echo $m_id;?>/update?idx=<?php //echo $idx;?> -->
        <div class="uk-child-width-1-4@m uk-grid-small" uk-grid>
            <input type="hidden" id="mode" value="modify">
            <input type="hidden" id="m_id" value="<?php echo $m_id;?>">
            <input type="hidden" id="upload_files_num" value="<?php echo $upload_files_num;?>">
            <input type="hidden" id="idx" name="idx" value="<?php echo $idx;?>">
            <input type="hidden" name="usr_id" value="<?php echo $usr['usr_id'];?>">

            <?php if($m_id=='intnlctrl') { ?>                
                <div class="uk-margin-small uk-width-1-5@m">
                    <label class="uk-form-label">구분</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" name="post_opt" id="post_opt">
                            <option value="보도자료" <?php if($post_opt=='보도자료'){echo 'selected';}?>>보도자료</option>
                            <option value="연구자료" <?php if($post_opt=='연구자료'){echo 'selected';}?>>연구자료</option>
                            <option value="제·개정" <?php if($post_opt=='제·개정'){echo 'selected';}?>>제·개정</option>
                            <option value="기타" <?php if($post_opt=='기타'){echo 'selected';}?>>기타</option>
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

            <div class="uk-margin uk-width-1-1">
                <label class="uk-form-label">제목</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="post_subj" id="post_subj" value="<?php echo $modify['post_subj'];?>">
                </div>
            </div>

            <div class="uk-margin-small uk-width-1-1">
                <label class="uk-form-label">요약</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="post_summary" id="post_summary" value="<?php echo $modify['post_summary'];?>">
                </div>
            </div>

            <div class="uk-margin uk-width-1-1">
                <label class="uk-form-label">내용</label>
                <div class="uk-form-controls">
                    <textarea class="uk-textarea ckeditor" name="post_cont" id="post_cont" rows='10'><?php echo $modify['post_cont'];?></textarea>
                </div>
            </div>

            <div class="uk-margin-small uk-width-2-3@m">
                <label class="uk-form-label">키워드</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="post_keyword" id="post_keyword" value="<?php echo $modify['post_keyword'];?>">
                </div>
            </div>


            <div class="uk-margin-small uk-width-1-6@m">
                <label class="uk-form-label">등록일</label>
                <div class="uk-form-controls">
                    <input class="uk-input datepicker" type="text" name="crt_dtms" id="crt_dtms" value="<?php echo $modify['crt_dtms'];?>" readonly>
                </div>
            </div>



            <div class="uk-margin-small uk-width-3-4@m">
                <label class="uk-form-label">외부링크</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="post_link_addr" id="post_link_addr" placeholder="주소입력시 보기화면에서 원문링크탭이 나타납니다." value="<?php echo $modify['post_link_addr'];?>">
                </div>
            </div>

            <div class="uk-margin-small uk-width-1-4@m">
                <label class="uk-form-label">링크옵션</label>
                <div class="uk-form-controls">
                    <input class="uk-checkbox" type="checkbox" name="post_link_trgt" value="<?php echo $modify['post_link_trgt'];?>" <?php if($modify['post_link_trgt']=='_blank'){ echo 'checked';}?>> 체크시 새창으로
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