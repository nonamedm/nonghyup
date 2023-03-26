<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?php if($m_id=='precedent') { // 판례검색 ?>
    <button class="uk-button uk-button-primary uk-width-1-1 m_brd_search">검색</button>
    <div class="brd_sch">
        <button class="uk-close-large uk-position-top-right m_brd_search_close" type="button" uk-close></button>
        <!--<form>-->
        <select class="brd_sch_sel uk-select">
            <option value="">전체분야</option>
            <option value="전자금융거래">전자금융거래</option>
            <option value="정보보호">정보보호</option>
            <option value="금융소비자">금융소비자</option>
            <option value="자본시장법">자본시장법</option>
        </select>
        <input type="hidden" id="post_cat" name="post_cat" value="<?php if($s_cat){echo $s_cat;}?>">
        <input type="text" id="brd_sch" class="brd_sch_field" value="<?php if($s_word){echo $s_word;}?>">
        <button class="brd_sch_btn_precedent">검색</button>
        <button class="brd_sch_dtl_btn"><span class="uk-label law">상세검색</span></button>
        <input type="hidden" id="dtl_opt" value="0">
        <!--</form>-->
    </div>

    <div class="brd_sch_dtl">
        <form class="uk-form-stacked">
            <button class="uk-close-large uk-position-top-right xclose" type="button" uk-close></button>
            <div class="uk-grid-match uk-grid-small" uk-grid>
                <div class="uk-width-1-2@m">
                    <div class="opt uk-margin">
                        <label class="uk-form-label" for="form-stacked-text">선고일
                            <span class="uk-label period" id="py1">최근1년</span>
                            <span class="uk-label period" id="py3">최근3년</span>
                            <span class="uk-label period" id="py5">최근5년</span>
                        </label>
                        <div class="uk-form-controls">
                            <input class="uk-input datepicker" id="sch_date_start" type="text" placeholder="" value="<?php if($s_sds){echo $s_sds;}?>" placeholder="YYYY-MM-DD"> ~
                            <input class="uk-input datepicker" id="sch_date_end" type="text" placeholder="" value="<?php if($s_sde){echo $s_sde;}?>" placeholder="YYYY-MM-DD">
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-6@m">
                    <div class="opt uk-margin">
                        <label class="uk-form-label" for="form-stacked-text">사건번호</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" id="post_lng" type="text" placeholder="" value="<?php if($s_lng){echo $s_lng;}?>">
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-6@m">
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
                            <input id="post_field" type="hidden" value="<?php if($s_fld){echo $s_fld;}?>">
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-6@m">
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
                            <input id="post_typ" type="hidden" value="<?php if($s_typ){echo $s_typ;}?>">
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <span class="re_search_box"> <input type="checkbox" class="uk-checkbox re_sch"> 결과 내 재검색</span>

<?php } else { // 기타 ?>
    <button class="uk-button uk-button-primary uk-width-1-1 m_brd_search">검색</button>
    <div class="brd_sch">
        <button class="uk-close-large uk-position-top-right m_brd_search_close" type="button" uk-close></button>
        <select class="brd_sch_sel uk-select">
            <option value="">전체</option>
            <option value="제목">제목</option>
            <option value="내용">내용</option>
            <?php if($m_id!='current'){ ?>
            <option value="발행기관">발행기관</option>
            <?php }?>
        </select>
        <input type="hidden" id="sub_sch" name="sub_sch" value="<?php if($sub_sch){echo $sub_sch;}?>">
        <input type="hidden" id="dtl_opt" value="0">
        <input type="text" id="brd_sch" class="uk-input brd_sch_field" name="s_word" placeholder="검색어 입력" value="<?php if($s_word){echo $s_word;}?>">
        <input type="hidden" id="rs_wrd" value="<?php if($s_word){ echo $s_word;}?>">
        <button type="button" id="brd_sch_btn" class="brd_sch_btn">검색</button>
        <?php if($m_id=='current'||$m_id=='sanctions'){?>
        <?php }else { ?>
            <button class="brd_sch_dtl_btn"><span class="uk-label law">기간검색</span></button>
        <?php } ?>
    </div>
    <div class="brd_sch_dtl opt">
        <button class="uk-close-small uk-position-top-right xclose" type="button" uk-close></button>
        <div class="uk-form-controls inputs">
            <input class="uk-input datepicker" id="sch_date_start" type="text" placeholder="검색시작일" value="<?php if($s_sds){echo $s_sds;}?>" placeholder="YYYY-MM-DD"> ~ <input class="uk-input datepicker" id="sch_date_end" type="text" placeholder="검색종료일" value="<?php if($s_sde){echo $s_sde;}?>" placeholder="YYYY-MM-DD">
        </div>
    </div>
    <span class="re_search_box"> <input type="checkbox" class="uk-checkbox re_sch"> 결과 내 재검색</span>

<?php } ?>
