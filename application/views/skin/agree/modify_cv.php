<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!-- 게시글 수정 :: 시작-->
<div class="brd_modify">
    <form id="brdFormDefault" method="POST" action="" enctype="multipart/form-data" class="uk-form-stacked"><!-- /<?php //echo $seg;?>/<?php //echo $m_id;?>/update?idx=<?php //echo $idx;?> -->
        <div class="uk-child-width-1-4@m" uk-grid>
            <input type="hidden" id="mode" value="modify">
            <input type="hidden" id="m_id" value="<?php echo $m_id;?>">
            <!--<input type="hidden" id="upload_files_num" value="<?php /*echo $upload_files_num;*/?>">-->
            <input type="hidden" id="idx" name="idx" value="<?php echo $idx;?>">
            <input type="hidden" name="usr_id" value="<?php echo $usr['usr_id'];?>">
            <input type="hidden" name="usr_nm" value="<?php echo $usr['usr_nm'];?>">

            <div class="uk-margin-small uk-width-1-1">
                <label class="uk-form-label">상단 고정</label>
                <div class="uk-form-controls">
                    <input class="uk-checkbox fix_chk" id="post_fix" type="checkbox" name="post_fix" onchange="check(this)" value="<?php if($modify['post_fix']=="Y"){echo "Y";}else{echo "N";}?>" <?php if($modify['post_fix']=="Y") echo " checked";?>>
                </div>
            </div>

            <div class="uk-margin uk-width-1-1 fix-num-select" style="display: <?php
            if ($modify['post_fix'] == "Y") {
                echo "block";
            } else {
                echo "none";
            } ?>;"">
                <label class="uk-form-label">상단 번호</label>
                <div class="uk-form-controls">
                    <select id="post_fix_num" name="post_fix_num" onchange="fixcheck(this.value)">
                        <option value="0" <?if($modify['post_fix_num']==0) echo "selected"?>>0</option>
                        <option value="1" <?if($modify['post_fix_num']==1) echo "selected"?>>1</option>
                        <option value="2" <?if($modify['post_fix_num']==2) echo "selected"?>>2</option>
                        <option value="3" <?if($modify['post_fix_num']==3) echo "selected"?>>3</option>
                        <option value="4" <?if($modify['post_fix_num']==4) echo "selected"?>>4</option>
                        <option value="5" <?if($modify['post_fix_num']==5) echo "selected"?>>5</option>
                        <option value="6" <?if($modify['post_fix_num']==6) echo "selected"?>>6</option>
                        <option value="7" <?if($modify['post_fix_num']==7) echo "selected"?>>7</option>
                        <option value="8" <?if($modify['post_fix_num']==8) echo "selected"?>>8</option>
                        <option value="9" <?if($modify['post_fix_num']==9) echo "selected"?>>9</option>
                        <option value="10" <?if($modify['post_fix_num']==10) echo "selected"?>>10</option>
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
                    <input class="uk-input" type="hidden" id="post_cat" name="post_cat" value="<?php echo $modify['post_cat'];?>">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label">약관버전</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="post_subj" id="post_subj" placeholder="" value="<?php echo $modify['post_subj'];?>">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label">시행일</label>
                <div class="uk-form-controls">
                    <input class="uk-input datepicker" type="text" name="post_dtms" id="post_dtms" value="<?php echo $modify['post_dtms'];?>" placeholder="YYYY-MM-DD">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label">배포여부</label>
                <div class="uk-form-controls">
                    <input type="checkbox" class="uk-checkbox" name="post_status" id="post_status" value="1" <?php if($modify['post_status']==1){ echo 'checked';}?>> 배포 (체크시 외부공개)
                </div>
            </div>


            <?php // ***** content ?>
            <div class="uk-margin uk-width-1-1">
                <label class="uk-form-label">약관내용</label>
                <div class="uk-form-controls">
                    <textarea class="uk-textarea" name="post_cont" id="post_cont" rows='10'><?php echo $modify['post_cont'];?></textarea>
                </div>
            </div>



        </div>

        <?php $this->load->view("brd/common_btn"); ?>

    </form>
</div>
<!-- 게시글 수정 :: 끝-->