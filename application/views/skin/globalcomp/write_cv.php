<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php 
$prevPage = $_SERVER['HTTP_REFERER'];
if($m_id=='globalcomp1'||$m_id=='globalcomp2'||$m_id=='globalcomp3'||$m_id=='globalcomp4') {
    if($usr_arr['usr_id']=='2910703673'||$usr_arr['usr_id']=='2259084387'||$usr_arr['usr_id']=='3282972707'||$usr_arr['usr_id']=='admin'||$usr_arr['usr_id']=='hwonpark'||$usr_arr['usr_id']=='ycneh'||$usr_arr['usr_id']=='nhbank8739') { 
        
    } else {
        alert("접근 권한이 없습니다.", $prevPage);
    }
}
?>

<!-- 게시글 쓰기 :: 시작-->
<?php if($m_id=='globalcomp4') {?>
    <div class="brd_write">
        <form id="brdFormDefault" method="POST" action="/<?php echo $seg;?>/<?php echo $m_id;?>/insert" enctype="multipart/form-data" class="uk-form-stacked"><!--  -->
            <input type="hidden" id="mode" value="write">
            <input type="hidden" id="m_id" value="<?php echo $m_id;?>">
            <input type="hidden" name="usr_id" value="<?php echo $usr['usr_id'];?>">
            <input type="hidden" name="usr_nm" id="usr_nm" value="<?php echo $usr['usr_nm'];?>">
            <!--<input type="hidden" name="usr_idx" value="<?php /*echo $usr_idx;*/?>">--><?php // ***** user email ?>
        
            <div class="uk-margin-small uk-width-1-5@m">
                <label class="uk-form-label">구분</label>
                <div class="uk-form-controls">
                    <select class="uk-select" name="post_cat" id="post_cat">                        
                        <option value="ct_globalcomp4" <?php if($this->config->item("md")['cat'] == 'ct_globalcomp4') echo "selected" ?> >Get involved</option>
                    </select>
                </div>
            </div>
            <div class="uk-margin uk-width-1-1">
                <label class="uk-form-label">제목</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="post_subj" id="post_subj" placeholder="">
                </div>
            </div>

            <div class="uk-margin uk-width-1-1">
                <label class="uk-form-label">내용</label>
                <div class="uk-form-controls">
                    <textarea class="uk-textarea ckeditor" name="post_cont" id="post_cont">
                    <?php if($m_id=='improvement'){?>
                        <!-- <h3 style="font-weight: 400">■ 규제기관 </h3>
                        <h3 style="font-weight: 400">■ 관련법령(규정) 또는 제도 </h3>
                        <h3 style="font-weight: 400">■ 현황</h3>
                        <h3 style="font-weight: 400">■ 문제점</h3>
                        <h3 style="font-weight: 400">■ 개선의견</h3>
                        <h3 style="font-weight: 400">■ 기대효과</h3> -->
                        <h3 style="font-weight: 400">■ 부서 / 이름 : </h3>
                        <h3 style="font-weight: 400">■ 요청 내용 </h3>
                    <?php }?>
                    </textarea>
                </div>
            </div>
            <?php if($upload_files_num){ ?>
                <?php $this->load->view("brd/common_file"); ?>
            <?php } ?>
            <?php $this->load->view("brd/common_btn"); ?>

        </form>
    </div>
<?php } else {?>
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
                            <option value="ct_globalcomp1" <?php if($this->config->item("md")['cat'] == 'ct_globalcomp1') echo "selected" ?> >News & Events</option>
                            <option value="ct_globalcomp2" <?php if($this->config->item("md")['cat'] == 'ct_globalcomp2') echo "selected" ?> >Laws & Regulations</option>
                            <option value="ct_globalcomp3" <?php if($this->config->item("md")['cat'] == 'ct_globalcomp3') echo "selected" ?> >Education Resources</option>
                        </select>
                    </div>
                </div>
                            
                <?php if($m_id=='globalcomp2') { ?>
                    <div class="uk-margin-small uk-width-1-3@m">
                        <label class="uk-form-label">국가</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" type="text" name="post_opt" id="post_opt" value="<?php echo $modify['post_opt'];?>">
                        </div>
                    </div>
                <?php } ?>

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
                    <label class="uk-form-label">발행기관</label>
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
<?php }?>

<!-- 게시글 쓰기 :: 끝-->