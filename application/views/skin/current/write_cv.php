<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<!-- 게시글 쓰기 :: 시작-->
<div class="cont">

    <div class="brd_write">
        <form id="brdFormDefault" method="POST" action="/<?php echo $seg;?>/<?php echo $m_id;?>/insert" enctype="multipart/form-data" class="uk-form-stacked"><!--  -->
            <div class="uk-child-width-1-4@m uk-grid-small" uk-grid>
                <input type="hidden" id="mode" value="write">
                <input type="hidden" id="m_id" value="<?php echo $m_id;?>">
                <input type="hidden" id="usr_id" name="usr_id" value="<?php echo $usr['usr_id'];?>">
                <input type="hidden" id="usr_nm" name="usr_nm" value="<?php echo $usr['usr_nm'];?>">

                <div class="uk-margin-small uk-width-1-1">
                    <label class="uk-form-label" >상단체크</label>
                    <div class="uk-form-controls">
                        <input class="uk-checkbox fix_chk" id="post_fix" type="checkbox" name="post_fix" onchange="check(this)" value="">
                    </div>
                </div>
                
                <div class="uk-margin-small uk-width-1-1 fix-num-select">
                    <label class="uk-form-label">상단 번호</label>
                    <div class="uk-form-controls">
                        <select id="post_fix_num" name="post_fix_num" onchange="fixcheck(this.value)">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                </div>

                <div class="uk-margin-small uk-width-1-5@m">
                    <label class="uk-form-label">구분</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" id="cat1">
                            <option value="common" <?php if($cat=='common'){echo 'selected';}?>>공통관련법규</option>
                            <option value="bank" <?php if($cat=='bank'){echo 'selected';}?>>은행관련법규</option>
                            <option value="investment" <?php if($cat=='investment'){echo 'selected';}?>>금융투자관련법규</option>
                            <option value="microfinance" <?php if($cat=='microfinance'){echo 'selected';}?>>비은행관련법규</option>
                        </select>
                        <input type="hidden" name="post_cat" id="post_cat" value="common">
                    </div>
                </div>

                <div class="uk-margin-small uk-width-4-5@m">
                    <label class="uk-form-label">제목</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="post_subj" id="post_subj" placeholder="">
                    </div>
                </div>

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

                <div class="uk-margin-small uk-width-1-1">
                    <label class="uk-form-label">요약</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="post_summary" id="post_summary" placeholder="">
                    </div>
                </div>

                <!--<div class="uk-margin-small uk-width-1-1">
                    <label class="uk-form-label">내용</label>
                    <div class="uk-form-controls">
                        <textarea class="uk-textarea ckeditor" name="post_cont" id="post_cont" rows='10'></textarea>
                    </div>
                </div>-->

                <div class="uk-margin-small uk-width-1-1@m">
                    <label class="uk-form-label">키워드</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="post_keyword" id="post_keyword" placeholder="">
                    </div>
                </div>

            </div>

            <?php if($upload_files_num){ ?>
                <?php $this->load->view("brd/common_file"); ?>
            <?php } ?>

            <?php $this->load->view("brd/common_btn"); ?>

        </form>
    </div>


</div>
<!-- 게시글 쓰기 :: 끝-->




    
    

    


    