<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php 
$prevPage = $_SERVER['HTTP_REFERER'];
if($m_id=='intnlctrl') {
    if($usr_arr['usr_id']=='nacf5061'||$usr_arr['usr_id']=='wtadmin'||$usr_arr['usr_id']=='admin'||$usr_arr['usr_id']=='hwonpark'||$usr_arr['usr_id']=='ycneh'||$usr_arr['usr_id']=='nhbank8739') { 
        
    } else {
        alert("접근 권한이 없습니다.", $prevPage);
    }
}
if($m_id=='finnaccexp') {
    if($usr_arr['usr_id']=='nacf50611'||$usr_arr['usr_id']=='wtadmin'||$usr_arr['usr_id']=='admin'||$usr_arr['usr_id']=='hwonpark'||$usr_arr['usr_id']=='ycneh'||$usr_arr['usr_id']=='nhbank8739') { 
        
    } else {
        alert("접근 권한이 없습니다.", $prevPage);
    }
}
if($m_id=='prevmnlaun1'||$m_id=='prevmnlaun2'||$m_id=='prevmnlaun3'||$m_id=='prevmnlaun4'||$m_id=='prevmnlaun5') {
    if($usr_arr['usr_id']=='17311795'||$usr_arr['usr_id']=='19312949'||$usr_arr['usr_id']=='08305788'||$usr_arr['usr_id']=='21613193'||$usr_arr['usr_id']=='admin'||$usr_arr['usr_id']=='hwonpark'||$usr_arr['usr_id']=='ycneh'||$usr_arr['usr_id']=='nhbank8739') { 
        
    } else {
        alert("접근 권한이 없습니다.", $prevPage);
    }
}
?>

<!-- 게시글 쓰기 :: 시작-->
<div class="brd_write">
    <form id="brdFormDefault" method="POST" action="/<?php echo $seg;?>/<?php echo $m_id;?>/insert" enctype="multipart/form-data" class="uk-form-stacked"><!--  -->
        <div class="uk-child-width-1-4@m uk-grid-small" uk-grid>
            <input type="hidden" id="mode" value="write">
            <input type="hidden" id="m_id" value="<?php echo $m_id;?>">
            <input type="hidden" name="usr_id" value="<?php echo $usr['usr_id'];?>">
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

                         
            <div class="uk-margin-small uk-width-1-5@m">
                <label class="uk-form-label">구분</label>
                <div class="uk-form-controls">
                    <select class="uk-select" name="post_cat" id="post_cat">
                        <option value="ct_prevmnlaun3" <?php if($this->config->item("md")['cat'] == 'ct_prevmnlaun3') echo "selected" ?> >정부보도자료</option>
                        <option value="ct_prevmnlaun4" <?php if($this->config->item("md")['cat'] == 'ct_prevmnlaun4') echo "selected" ?> >NEWS</option>
                        <option value="ct_prevmnlaun1" <?php if($this->config->item("md")['cat'] == 'ct_prevmnlaun1') echo "selected" ?> >국내 제재사례</option>
                        <option value="ct_prevmnlaun2" <?php if($this->config->item("md")['cat'] == 'ct_prevmnlaun2') echo "selected" ?> >국외 제재사례</option>
                        <option value="ct_prevmnlaun5" <?php if($this->config->item("md")['cat'] == 'ct_prevmnlaun5') echo "selected" ?> >AML BRIEF</option>
                    </select>
                </div>
            </div>
            


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

            <div class="uk-margin-small uk-width-1-1">
                <label class="uk-form-label">내용</label>
                <div class="uk-form-controls">
                    <textarea class="uk-textarea ckeditor" name="post_cont" id="post_cont" rows='10'></textarea>
                </div>
            </div>

            <div class="uk-margin-small uk-width-2-3@m">
                <label class="uk-form-label">키워드</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="post_keyword" id="post_keyword" placeholder="">
                </div>
            </div>


            <div class="uk-margin-small uk-width-1-6@m">
                <label class="uk-form-label">등록일</label>
                <div class="uk-form-controls">
                    <input class="uk-input datepicker" type="text" name="crt_dtms" id="crt_dtms" value="" placeholder="YYYY-MM-DD">
                </div>
            </div>



            <div class="uk-margin-small uk-width-1-6@m">
                <?php if($m_id=='intnlctrl'||$m_id=='finnaccexp'||$m_id=='prevmnlaun1'||$m_id=='prevmnlaun2'||$m_id=='prevmnlaun3'||$m_id=='prevmnlaun4'||$m_id=='prevmnlaun5') { ?>
                    <label class="uk-form-label">발행기관</label>
                <?php } else { ?>
                    <label class="uk-form-label">작성자</label>
                <?php } ?>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="usr_nm" id="usr_nm" value="<?php echo $usr['usr_nm'];?>">
                </div>
            </div>



            <div class="uk-margin-small uk-width-3-4@m">
                <label class="uk-form-label">원문링크</label>
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




    
    

    


    