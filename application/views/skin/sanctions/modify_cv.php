<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!-- 게시글 수정 :: 시작-->
<div class="cont">

    <!-- 게시글 수정 :: 시작-->
    <div class="brd_modify">
        <form id="brdFormDefault" method="POST" action="" enctype="multipart/form-data" class="uk-form-stacked"><!-- /<?php //echo $seg;?>/<?php //echo $m_id;?>/update?idx=<?php //echo $idx;?> -->
            <div class="uk-child-width-1-4@m uk-grid-small" uk-grid>
                <input type="hidden" id="mode" value="modify">
                <input type="hidden" id="m_id" value="<?php echo $m_id;?>">
                <input type="hidden" id="upload_files_num" value="<?php echo $upload_files_num;?>">
                <input type="hidden" id="idx" name="idx" value="<?php echo $idx;?>">
                <input type="hidden" name="usr_id" value="<?php echo $usr['usr_id'];?>">
                <input type="hidden" name="usr_nm" id="usr_nm" value="<?php echo $usr['usr_nm'];?>">

                <div class="uk-margin-small uk-width-1-1">
                    <label class="uk-form-label">상단고정</label>
                    <div class="uk-form-controls">
                        <input class="uk-checkbox fix_chk" id="post_fix" type="checkbox" name="post_fix" onchange="check(this)" value="<?php if($modify['post_fix']=="Y"){echo "Y";}else{echo "N";}?>" <?php if($modify['post_fix']=="Y") echo " checked";?> >
                    </div>
                </div>

                <div class="uk-margin uk-width-1-1 post_fix_num fix-num-select" style="display: <?php if ($modify['post_fix'] == "Y") {echo "block";} else {echo "none";} ?>;">
                    <label class="uk-form-label">상단 번호</label>
                    <div class="uk-form-controls">
                        <select id="post_fix_num" name="post_fix_num" onchange="fixcheck(this.value)" value="">
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

                <div class="uk-margin uk-width-1-1">
                    <label class="uk-form-label">제목</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="post_subj" id="post_subj" value="<?php echo $modify['post_subj'];?>">
                    </div>
                </div>

                <div class="uk-margin-small uk-width-1-1">
                    <label class="uk-form-label">대상기관</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="post_status" id="post_status" value="<?php echo $modify['post_status'];?>">
                    </div>
                </div>

                <div class="uk-margin uk-width-1-1">
                    <label class="uk-form-label">내용</label>
                    <div class="uk-form-controls">
                        <textarea class="uk-textarea ckeditor" name="post_cont" id="post_cont" rows='10'><?php echo $modify['post_cont'];?></textarea>
                    </div>
                </div>

                <div class="uk-margin-small uk-width-1-4@m">
                    <label class="uk-form-label">제재조치요구일</label>
                    <div class="uk-form-controls">
                        <input class="uk-input datepicker" type="text" name="post_dtms" id="post_dtms" value="<?php echo $modify['post_dtms'];?>" placeholder="YYYY-MM-DD">
                    </div>
                </div>

                <div class="uk-margin-small uk-width-1-4@m">
                    <label class="uk-form-label">등록일</label>
                    <div class="uk-form-controls">
                        <input class="uk-input datepicker" type="text" name="crt_dtms" id="crt_dtms" value="<?php echo $modify['crt_dtms'];?>" placeholder="YYYY-MM-DD">
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
<!-- 게시글 수정 :: 끝-->