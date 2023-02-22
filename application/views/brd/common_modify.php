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

                <?php if ($m_id=='translate' || $m_id=='noaction') {?>
                    <div class="uk-margin-small uk-width-1-3@m">
                        <label class="uk-form-label">법령명</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" type="text" name="post_opt" id="post_opt" value="<?php echo $modify['post_opt'];?>">
                        </div>
                    </div>

                    <div class="uk-margin-small uk-width-1-3@m">
                        <label class="uk-form-label">발행기관</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" type="text" name="post_field" id="post_field" value="<?php echo $modify['post_field'];?>">
                        </div>
                    </div>

                    <div class="uk-margin-small uk-width-1-3@m">
                        <label class="uk-form-label">회신일</label>
                        <div class="uk-form-controls">
                            <input class="uk-input datepicker" type="text" name="post_dtms" id="post_dtms" value="<?php echo $modify['post_dtms'];?>" placeholder="YYYY-MM-DD">
                        </div>
                    </div>
                <?php }?>

                <div class="uk-margin uk-width-1-1">
                    <label class="uk-form-label">내용</label>
                    <div class="uk-form-controls">
                        <textarea class="uk-textarea ckeditor" name="post_cont" id="post_cont" rows='10'><?php echo $modify['post_cont'];?></textarea>
                        <!--<textarea class="uk-textarea" id="post_cont_editor" rows='10'></textarea>
                        <input type="hidden" name="post_cont" id="post_cont" value='<?php /*echo $modify['post_cont'];*/?>'>-->
                    </div>
                </div>

                <div class="uk-margin-small <?php if(!($m_id=='current' || $m_id=='translate' || $m_id=='noaction')){ echo "uk-width-2-3@m";}else{ echo "uk-width-5-6@m";} ?>">
                    <label class="uk-form-label">키워드</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="post_keyword" id="post_keyword" value="<?php echo $modify['post_keyword'];?>">
                    </div>
                </div>

                <?php if(!($m_id=='current' || $m_id=='translate' || $m_id=='noaction')){ ?>
                <div class="uk-margin-small uk-width-1-6@m">
                    <label class="uk-form-label">등록일</label>
                    <div class="uk-form-controls">
                        <input class="uk-input datepicker" type="text" name="crt_dtms" id="crt_dtms" value="<?php echo $modify['crt_dtms'];?>" placeholder="YYYY-MM-DD">
                    </div>
                </div>
                <?php } ?>

                <?php if($m_id=='edudata' || $m_id=='labdata'){ ?>
                    <div class="uk-margin-small uk-width-1-6@m">
                        <label class="uk-form-label">발행기관</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" type="text" name="post_field" id="post_field" value="<?php echo $modify['post_field'];?>">
                        </div>
                    </div>
                    <input type="hidden" name="usr_nm" id="usr_nm" value="<?php echo $usr['usr_nm'];?>">
                <?php }else{ ?>
                    <div class="uk-margin-small uk-width-1-6@m">
                        <label class="uk-form-label">작성자</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" type="text" name="usr_nm" id="usr_nm" value="<?php if($modify['usr_nm']){echo $modify['usr_nm'];}else{echo $usr['usr_nm'];}?>">
                        </div>
                    </div>
                <?php } ?>

                <?php if ($m_id=='lawmaking' || $m_id=='pr' || $m_id=='current' || $m_id=='news') {?>
                    <div class="uk-margin-small uk-width-3-4@m">
                        <label class="uk-form-label">외부링크</label>
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
                <?php }?>

            </div>

            <?php if($upload_files_num){ ?>
                <?php $this->load->view("brd/common_file"); ?>
            <?php } ?>

            <?php $this->load->view("brd/common_btn"); ?>

        </form>
    </div>
<!-- 게시글 수정 :: 끝-->