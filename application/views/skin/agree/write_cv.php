<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<!-- 게시글 쓰기 :: 시작-->
<div class="brd_write">
    <form id="brdFormDefault" method="POST" action="/<?php echo $seg;?>/<?php echo $m_id;?>/insert" enctype="multipart/form-data" class="uk-form-stacked"><!--  -->
        <div class="uk-child-width-1-4@m" uk-grid>
            <input type="hidden" id="mode" value="write">
            <input type="hidden" id="m_id" value="<?php echo $m_id;?>">
            <input type="hidden" name="usr_id" value="<?php echo $usr['usr_id'];?>">
            <input type="hidden" name="usr_nm" value="<?php echo $usr['usr_nm'];?>">
            <!--<input type="hidden" name="usr_idx" value="<?php /*echo $usr_idx;*/?>">--><?php // ***** user email ?>

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

            <div class="uk-margin">
                <label class="uk-form-label">약관종류</label>
                <div class="uk-form-controls">
                    <select class="uk-select">
                        <option value="terms">이용약관</option>
                        <option value="pri">개인정보처리방침</option>
                        <option value="copy">저작권정책</option>
                    </select>
                    <input class="uk-input" type="hidden" id="post_cat" name="post_cat" value="terms">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label">약관버전</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="post_subj" id="post_subj" placeholder="">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label">시행일</label>
                <div class="uk-form-controls">
                    <input class="uk-input datepicker" type="text" name="post_dtms" id="post_dtms" placeholder="YYYY-MM-DD">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label">배포여부</label>
                <div class="uk-form-controls">
                    <input type="checkbox" class="uk-checkbox" name="post_status" id="post_status" value="1"> 배포 (체크시 외부공개)
                </div>
            </div>

            <div class="uk-margin uk-width-1-1">
                <label class="uk-form-label">약관내용</label>
                <div class="uk-form-controls">
                    <textarea class="uk-textarea ckeditor" name="post_cont" id="post_cont" rows='10'></textarea>
                </div>
            </div>

        </div>

        <?php $this->load->view("brd/common_btn"); ?>

    </form>
</div>

<!-- 게시글 쓰기 :: 끝-->




    
    

    


    