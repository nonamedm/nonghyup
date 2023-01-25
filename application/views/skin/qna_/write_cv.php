<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<!-- 게시글 쓰기 :: 시작-->

    <div class="brd_write">
        <form id="brdFormDefault" method="POST" action="/<?php echo $seg;?>/<?php echo $m_id;?>/insert" enctype="multipart/form-data" class="uk-form-stacked"><!--  -->
            <input type="hidden" id="mode" value="write">
            <input type="hidden" id="m_id" value="<?php echo $m_id;?>">
            <input type="hidden" name="usr_id" value="<?php echo $usr['usr_id'];?>">
            <input type="hidden" name="usr_nm" id="usr_nm" value="<?php echo $usr['usr_nm'];?>">
            <!--<input type="hidden" name="usr_idx" value="<?php /*echo $usr_idx;*/?>">--><?php // ***** user email ?>

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
                        <h3 style="font-weight: 400">■ 규제기관 </h3>
                        <h3 style="font-weight: 400">■ 관련법령(규정) 또는 제도 </h3>
                        <h3 style="font-weight: 400">■ 현황</h3>
                        <h3 style="font-weight: 400">■ 문제점</h3>
                        <h3 style="font-weight: 400">■ 개선의견</h3>
                        <h3 style="font-weight: 400">■ 기대효과</h3>
                    <?php }?>
                    </textarea>
                    <!--<textarea class="uk-textarea" name="post_cont" id="post_cont_editor" rows='10'></textarea>
                    <input type="hidden" name="post_cont" id="post_cont" value=''>-->
                </div>
            </div>


        <?php //if($upload_files_num){ ?>
        <?php //$this->load->view("brd/common_file"); ?>
        <?php //} ?>

        <?php $this->load->view("brd/common_btn"); ?>

        </form>
    </div>

<!-- 게시글 쓰기 :: 끝-->




    
    

    


    