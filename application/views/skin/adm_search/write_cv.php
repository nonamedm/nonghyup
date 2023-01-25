<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<!-- 게시글 쓰기 :: 시작-->
<div class="cont">

    <?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <div class="uk-card uk-card-default uk-card-body">

        <form id="brdFormDefault" method="POST" action="/<?php echo $seg;?>/<?php echo $m_id;?>/insert" enctype="multipart/form-data" class="uk-form-stacked"><!--  -->
            <input type="hidden" id="mode" value="write">
            <input type="hidden" id="m_id" value="<?php echo $m_id;?>">
            <!--<input type="hidden" name="usr_idx" value="<?php /*echo $usr_idx;*/?>">--><?php // ***** user email ?>

            <div class="uk-grid-small uk-child-width-expand@s" uk-grid>
                <input type="hidden" name="post_cat" value="search">

                <?php // ***** subject ?>
                <div class="uk-margin uk-width-1-3@m">
                    <label class="uk-form-label">경로-메뉴명(국문)</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="post_subj" id="post_subj" placeholder="" value="">
                    </div>
                </div>

                <div class="uk-margin uk-width-1-2@m">
                    <label class="uk-form-label">경로-메뉴명(영문)</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="post_opt" id="post_opt" placeholder="" value="">
                    </div>
                </div>

                <div class="uk-margin uk-width-1-6@m">
                    <label class="uk-form-label">페이지 코드</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="post_cont" id="post_cont" placeholder="링크용 아이디값" value="">
                    </div>
                </div>


                <?php // ***** content ?>
                <div class="uk-margin uk-width-1-1">
                    <label class="uk-form-label">키워드</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="post_field" id="post_field" placeholder="">
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




    
    

    


    