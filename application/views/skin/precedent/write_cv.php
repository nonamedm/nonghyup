<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<!-- 게시글 쓰기 :: 시작-->

<div class="brd_write">
    <form id="brdFormDefault" method="POST" action="/<?php echo $seg;?>/<?php echo $m_id;?>/insert" enctype="multipart/form-data" class="uk-form-stacked"><!--  -->
        <div class="uk-child-width-1-4@m uk-grid-small" uk-grid>
            <input type="hidden" id="mode" value="write">
            <input type="hidden" id="m_id" value="<?php echo $m_id;?>">
            <input type="hidden" name="usr_id" value="<?php echo $usr['usr_id'];?>">
            <!--<input type="hidden" name="usr_idx" value="<?php /*echo $usr_idx;*/?>">--><?php // ***** user email ?>
            <input type="hidden" name="usr_nm" id="usr_nm" value="<?php echo $usr['usr_nm'];?>">

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

            <div class="uk-margin-small uk-width-1-1@l uk-width-1-1@m">
                <label class="uk-form-label">구분</label>
                <div class="uk-form-controls">
                    <input type="checkbox" id="post_cat0" class="uk-checkbox uk-margin-small-left" value="전자금융거래"> 전자금융거래
                    <input type="checkbox" id="post_cat1" class="uk-checkbox uk-margin-small-left" value="정보보호"> 정보보호
                    <input type="checkbox" id="post_cat2" class="uk-checkbox uk-margin-small-left" value="금융소비자"> 금융소비자
                    <input type="checkbox" id="post_cat3" class="uk-checkbox uk-margin-small-left" value="자본시장법"> 자본시장법
                    <input class="uk-input" type="hidden" id="post_cat" name="post_cat" value="">
                </div>
            </div>

            <div class="uk-margin-small uk-width-1-4@l uk-width-1-3@m">
                <label class="uk-form-label">판결선고일</label>
                <div class="uk-form-controls">
                    <input class="uk-input datepicker" type="text" name="post_dtms" id="post_dtms" value="" placeholder="YYYY-MM-DD">
                </div>
            </div>

            <div class="uk-margin-small uk-width-1-4@l uk-width-1-3@m">
                <label class="uk-form-label">사건번호</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="post_lng" id="post_lng" value="">
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
                    <input class="uk-input" type="hidden" id="post_field" name="post_field" value="">
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
                    <input class="uk-input" type="hidden" name="post_typ" id="post_typ" value="">
                </div>
            </div>

            <div class="uk-margin-small uk-width-1-1">
                <label class="uk-form-label">내용</label>
                <div class="uk-form-controls">
                    <textarea class="uk-textarea ckeditor" name="post_cont" id="post_cont" rows='10'></textarea>
                </div>
            </div>

            <div class="uk-margin-small uk-width-3-4@m">
                <label class="uk-form-label">키워드</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="post_keyword" id="post_keyword" placeholder=",로 구분해서 입력해 주세요">
                </div>
            </div>

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




    
    

    


    