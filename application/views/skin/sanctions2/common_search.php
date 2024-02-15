<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

    <button class="uk-button uk-button-primary uk-width-1-1 m_brd_search">검색</button>
    <div class="brd_sch">
        <button class="uk-close-large uk-position-top-right m_brd_search_close" type="button" uk-close></button>
        <select class="brd_sch_sel uk-select">
            <option value="">전체</option>
            <option value="제목">제목</option>
            <option value="내용">내용</option>
        </select>
        <input type="hidden" id="sub_sch" name="sub_sch" value="<?php if($sub_sch){echo $sub_sch;}?>">
        <input type="hidden" id="dtl_opt" value="0">
        <input type="text" id="brd_sch" class="uk-input brd_sch_field" name="s_word" placeholder="검색어 입력" value="<?php if($s_word){echo $s_word;}?>">
        <input type="hidden" id="rs_wrd" value="<?php if($s_word){echo $s_word;} else if($s_subj) {echo $s_subj;} else if($s_cont) {echo $s_cont;} else if($post_cat) {echo $post_cat;}?>">
        <input type="hidden" id="sanc" value="<?php if($sanc){echo $sanc;} ?>">
        <input type="hidden" id="post_sanc" value="<?php if($post_sanc){echo $post_sanc;} ?>">
        <button type="button" id="brd_sch_btn" class="brd_sch_btn">검색</button>
        <button class="brd_sch_dtl_btn"><span class="uk-label law">기간검색</span></button>
        <p class="sch_txt" style="text-align:left;">
            ※ 아래에서 <b style="color:blue">위반법률</b> 또는 <b style="color:blue">제재대상 기관</b>을 선택하여 보다 더 효율적으로 검색할 수 있습니다.
        </p>
    </div>
    <div class="brd_sch_dtl opt">
        <button class="uk-close-small uk-position-top-right xclose" type="button" uk-close></button>
        <div class="uk-form-controls inputs">
            <input class="uk-input datepicker" id="sch_date_start" type="text" placeholder="검색시작일" value="<?php if($s_sds){echo $s_sds;}?>" placeholder="YYYY-MM-DD"> ~ <input class="uk-input datepicker" id="sch_date_end" type="text" placeholder="검색종료일" value="<?php if($s_sde){echo $s_sde;}?>" placeholder="YYYY-MM-DD">
        </div>
    </div>
    <span class="re_search_box"> <input type="checkbox" class="uk-checkbox re_sch"> 결과 내 재검색</span>
