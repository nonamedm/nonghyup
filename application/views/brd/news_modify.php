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

            <?php if($m_id=='intnlctrl') { ?>                
                <div class="uk-margin-small uk-width-1-5@m">
                    <label class="uk-form-label">구분</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" name="post_opt" id="post_opt">
                            <option value="보도자료" <?php if($modify['post_opt']=='보도자료'){echo 'selected';}?>>보도자료</option>
                            <option value="연구자료" <?php if($modify['post_opt']=='연구자료'){echo 'selected';}?>>연구자료</option>
                            <option value="제·개정" <?php if($modify['post_opt']=='제·개정'){echo 'selected';}?>>제·개정</option>
                            <option value="기타" <?php if($modify['post_opt']=='기타'){echo 'selected';}?>>기타</option>
                        </select>
                    </div>
                </div>
            <?php } else if($m_id=='finnaccexp'){?>
                <div class="uk-margin-small uk-width-1-5@m">
                    <label class="uk-form-label">구분</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="post_opt" id="post_opt" value="<?php echo $modify['post_opt']; ?>">
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
                    <input class="uk-input datepicker" type="text" name="crt_dtms" id="crt_dtms" value="<?php echo $modify['crt_dtms'];?>" placeholder="YYYY-MM-DD">
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