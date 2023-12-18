<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php 
$prevPage = $_SERVER['HTTP_REFERER'];
if($m_id=='intnlctrl') {
    if($usr_arr['usr_id']=='nacf5061'||$usr_arr['usr_id']=='wtadmin'||$usr_arr['usr_id']=='admin'||$usr_arr['usr_id']=='hwonpark'||$usr_arr['usr_id']=='ycneh'||$usr_arr['usr_id']=='jeyun8835') { 
        
    } else {
        alert("접근 권한이 없습니다.", $prevPage);
    }
}
if($m_id=='finnaccexp') {
    if($usr_arr['usr_id']=='nacf50611'||$usr_arr['usr_id']=='wtadmin'||$usr_arr['usr_id']=='admin'||$usr_arr['usr_id']=='hwonpark'||$usr_arr['usr_id']=='ycneh'||$usr_arr['usr_id']=='jeyun8835') { 
        
    } else {
        alert("접근 권한이 없습니다.", $prevPage);
    }
}
if($m_id=='prevmnlaun1'||$m_id=='prevmnlaun2'||$m_id=='prevmnlaun3'||$m_id=='prevmnlaun4'||$m_id=='prevmnlaun5') {
    if($usr_arr['usr_id']=='17311795'||$usr_arr['usr_id']=='19312949'||$usr_arr['usr_id']=='08305788'||$usr_arr['usr_id']=='21613193'||$usr_arr['usr_id']=='admin'||$usr_arr['usr_id']=='hwonpark'||$usr_arr['usr_id']=='ycneh'||$usr_arr['usr_id']=='jeyun8835') { 
        
    } else {
        alert("접근 권한이 없습니다.", $prevPage);
    }
}
?>
<!-- 게시글 수정 :: 시작-->
<div class="cont">
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
                } ?>;">
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
                
                <div class="uk-margin-small uk-width-1-5@m">
                    <label class="uk-form-label">구분</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" name="post_cat" id="post_cat">
                            <option value="ct_prevmnlaun3" <?php if($modify['post_cat']=='ct_prevmnlaun3'){echo 'selected';}?>>정부보도자료</option>
                            <option value="ct_prevmnlaun4" <?php if($modify['post_cat']=='ct_prevmnlaun4'){echo 'selected';}?>>NEWS</option>
                            <option value="ct_prevmnlaun1" <?php if($modify['post_cat']=='ct_prevmnlaun1'){echo 'selected';}?>>국내 제재사례</option>
                            <option value="ct_prevmnlaun2" <?php if($modify['post_cat']=='ct_prevmnlaun2'){echo 'selected';}?>>국외 제재사례</option>
                            <option value="ct_prevmnlaun5" <?php if($modify['post_cat']=='ct_prevmnlaun5'){echo 'selected';}?>>AML BRIEF</option>
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
                    <label class="uk-form-label">요약</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="post_summary" id="post_summary" value="<?php echo $modify['post_summary'];?>">
                    </div>
                </div>

                <div class="uk-margin uk-width-1-1">
                    <label class="uk-form-label">내용</label>
                    <div class="uk-form-controls">
                        <textarea class="uk-textarea ckeditor" name="post_cont" id="post_cont" rows='10'><?php echo $modify['post_cont'];?></textarea>
                        <!--<textarea class="uk-textarea" id="post_cont_editor" rows='10'></textarea>
                        <input type="hidden" name="post_cont" id="post_cont" value='<?php /*echo $modify['post_cont'];*/?>'>-->
                    </div>
                </div>

                <div class="uk-margin-small uk-width-5-6@m">
                    <label class="uk-form-label">키워드</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="post_keyword" id="post_keyword" value="<?php echo $modify['post_keyword'];?>">
                    </div>
                </div>

                <?php if($m_id=='edudata' || $m_id=='labdata'){ ?>
                    <div class="uk-margin-small uk-width-1-6@m">
                        <label class="uk-form-label">발행기관</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" type="text" name="post_field" id="post_field" value="<?php echo $modify['post_field'];?>">
                        </div>
                    </div>
                    <input type="hidden" name="usr_nm" id="usr_nm" value="<?php echo $usr['usr_nm'];?>">
                <?php }else if($m_id=='intnlctrl'||$m_id=='finnaccexp'||$m_id=='prevmnlaun1'||$m_id=='prevmnlaun2'||$m_id=='prevmnlaun3'||$m_id=='prevmnlaun4'||$m_id=='prevmnlaun5'){ ?>
                    <div class="uk-margin-small uk-width-1-6@m">
                        <label class="uk-form-label">발행기관</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" type="text" name="usr_nm" id="usr_nm" value="<?php if($modify['usr_nm']){echo $modify['usr_nm'];}else{echo $usr['usr_nm'];}?>">
                        </div>
                    </div>
                <?php } ?>

                
                <div class="uk-margin-small u`  k-width-3-4@m">
                    <label class="uk-form-label">원문링크</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="post_link_addr" id="post_link_addr" placeholder="주소입력시 목록에서 링크연결됩니다." value="<?php echo $modify['post_link_addr'];?>">
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

</div>
<!-- 게시글 수정 :: 끝-->