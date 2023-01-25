<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?php if($m_id=='precedent') { // 판례검색 ?>

<div class="brd_sch">
    <!--<form>-->
    <select class="brd_sch_sel uk-select">
        <option>전체분야</option>
        <option>전자금융거래</option>
        <option>정보보호</option>
        <option>금융소비자</option>
        <option>자본시장법</option>
    </select>
    <input type="text" class="brd_sch_field">
    <button class="brd_sch_btn">검색</button>
    <button class="brd_sch_dtl_btn"><span class="uk-label law">상세검색</span></button>
    <!--</form>-->
</div>

<div class="brd_sch_dtl">
    <form class="uk-form-stacked">
    <button class="uk-close-large uk-position-top-right" type="button" uk-close></button>
    <div>
        <div class="uk-child-width-1-3@s uk-grid-medium uk-grid-match" uk-grid>
            <div>
                <div class="opt uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">제외어</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="" type="text" placeholder="">
                    </div>
                </div>
            </div>
            <div>
                <div class="opt uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">사건번호</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="" type="text" placeholder="">
                    </div>
                </div>
            </div>
            <div>
                <div class="opt uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">법령명</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="" type="text" placeholder="">
                    </div>
                </div>
            </div>
            <div>
                <div class="opt uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">선고일
                    <span class="uk-label law">최근1년</span>
                    <span class="uk-label law">최근3년</span>
                    <span class="uk-label law">최근5년</span>
                    </label>
                    <div class="uk-form-controls">
                        <input class="uk-input date" id="" type="text" placeholder=""> ~ <input class="uk-input date" id="" type="text" placeholder="">
                    </div>
                </div>
            </div>
            <div>
                <div class="opt uk-margin">
                    <label class="uk-form-label" for="form-stacked-select">법원명</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" id="form-stacked-select">
                            <option>선택</option>
                            <option>헌법재판소</option>
                            <option>대법원</option>
                            <option>행정법원</option>
                            <option>고등법원</option>
                            <option>지방법원</option>
                            <option>특허법원</option>
                        </select>
                    </div>
                </div>
            </div>
            <div>
                <div class="opt uk-margin">
                    <label class="uk-form-label" for="form-stacked-select">사건종류</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" id="form-stacked-select">
                            <option>선택</option>
                            <option>헌법</option>
                            <option>민사</option>
                            <option>형사</option>
                            <option>가사</option>
                            <option>행정</option>
                            <option>특허</option>
                            <option>조세</option>
                            <option>선거</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>

<?php } else { // 기타 ?>

<div class="brd_sch">
    <form>
        <input type="text" class="brd_sch_field">
        <button class="brd_sch_btn">검색</button>
    </form>
</div>

<?php } ?>
