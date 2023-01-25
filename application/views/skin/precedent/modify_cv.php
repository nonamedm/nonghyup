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
            <input type="hidden" name="usr_nm" value="<?php echo $usr['usr_nm'];?>">


            <div class="uk-margin-small uk-width-1-1">
                <label class="uk-form-label">제목</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="post_subj" id="post_subj" placeholder="" value="<?php echo $modify['post_subj'];?>">
                </div>
            </div>

            <div class="uk-margin-small uk-width-1-1">
                <label class="uk-form-label">요약</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="post_summary" id="post_summary" placeholder="" value="<?php echo $modify['post_summary'];?>">
                </div>
            </div>

            <div class="uk-margin-small uk-width-1-1@l">
                <label class="uk-form-label">구분</label>
                <div class="uk-form-controls">
                    <?php $post_cat_arr = explode("|", $modify['post_cat']);?>
                    <input type="checkbox" id="post_cat0" class="uk-checkbox uk-margin-small-left" value="전자금융거래" <?php if($post_cat_arr[0]) {echo 'checked';}?>> 전자금융거래
                    <input type="checkbox" id="post_cat1" class="uk-checkbox uk-margin-small-left" value="정보보호" <?php if($post_cat_arr[1]) {echo 'checked';}?>> 정보보호
                    <input type="checkbox" id="post_cat2" class="uk-checkbox uk-margin-small-left" value="금융소비자" <?php if($post_cat_arr[2]) {echo 'checked';}?>> 금융소비자
                    <input type="checkbox" id="post_cat3" class="uk-checkbox uk-margin-small-left" value="자본시장법" <?php if($post_cat_arr[3]) {echo 'checked';}?>> 자본시장법
                    <input class="uk-input" type="hidden" id="post_cat" name="post_cat" value="<?php echo $modify['post_cat'];?>">
                </div>
            </div>

            <div class="uk-margin-small uk-width-1-4@l uk-width-1-3@m">
                <label class="uk-form-label">판결선고일</label>
                <div class="uk-form-controls">
                    <input class="uk-input datepicker" type="text" name="post_dtms" id="post_dtms" value="<?php echo $modify['post_dtms'];?>" readonly>
                </div>
            </div>

            <div class="uk-margin-small uk-width-1-4@l uk-width-1-3@m">
                <label class="uk-form-label">사건번호</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="post_lng" id="post_lng" value="<?php echo $modify['post_lng'];?>">
                </div>
            </div>



            <div class="uk-margin-small uk-width-1-4@l uk-width-1-3@m">
                <label class="uk-form-label">법원명</label>
                <div class="uk-form-controls">
                    <select class="uk-select">
                        <option>선택</option>
                        <option value="헌법재판소">헌법재판소</option>
                        <option value="대법원">대법원</option>
                        <option value="행정법원">행정법원</option>
                        <option value="고등법원">고등법원</option>
                        <option value="지방법원">지방법원</option>
                        <option value="특허법원">특허법원</option>
                    </select>
                    <input class="uk-input" type="hidden" id="post_field" name="post_field" value="<?php echo $modify['post_field'];?>">
                </div>
            </div>

            <div class="uk-margin-small uk-width-1-4@l uk-width-1-3@m">
                <label class="uk-form-label">사건종류</label>
                <div class="uk-form-controls">
                    <select class="uk-select">
                        <option>선택</option>
                        <option value="헌법">헌법</option>
                        <option value="민사">민사</option>
                        <option value="형사">형사</option>
                        <option value="가사">가사</option>
                        <option value="행정">행정</option>
                        <option value="특허">특허</option>
                        <option value="조세">조세</option>
                        <option value="선거">선거</option>
                    </select>
                    <input class="uk-input" type="hidden" name="post_typ" id="post_typ" value="<?php echo $modify['post_typ'];?>">
                </div>
            </div>

            <div class="uk-margin-small uk-width-1-1">
                <label class="uk-form-label">내용</label>
                <div class="uk-form-controls">
                    <textarea class="uk-textarea ckeditor" name="post_cont" id="post_cont" rows='10'><?php echo $modify['post_cont'];?></textarea>
                    <!--<textarea class="uk-textarea" id="post_cont_editor" rows='10'></textarea>
                        <input type="hidden" name="post_cont" id="post_cont" value='<?php /*echo $modify['post_cont'];*/?>'>-->
                </div>
            </div>

            <div class="uk-margin-small uk-width-3-4@m">
                <label class="uk-form-label">키워드</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="post_keyword" id="post_keyword" placeholder=",로 구분해서 입력해 주세요" value="<?php echo $modify['post_keyword'];?>">
                </div>
            </div>

            <div class="uk-margin-small uk-width-1-4@m">
                <label class="uk-form-label">작성자</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="usr_nm" id="usr_nm" value="<?php echo $modify['usr_nm'];?>">
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
<!-- 게시글 수정 :: 끝-->