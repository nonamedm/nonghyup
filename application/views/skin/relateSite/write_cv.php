<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<!-- 게시글 쓰기 :: 시작-->
<div class="cont">

    <div class="brd_write">
        <form id="brdFormDefault" method="POST" action="/<?php echo $seg;?>/<?php echo $m_id;?>/insert" enctype="multipart/form-data" class="uk-form-stacked"><!--  -->
            <div class="uk-child-width-1-4@m uk-grid-small" uk-grid>
                <input type="hidden" id="mode" value="write">
                <input type="hidden" id="m_id" value="<?php echo $m_id;?>">
                <input type="hidden" name="usr_id" value="<?php echo $usr['usr_id'];?>">
                <input type="hidden" name="usr_nm" id="usr_nm" value="<?php echo $usr['usr_nm'];?>">
                <!--<input type="hidden" name="usr_idx" value="<?php /*echo $usr_idx;*/?>">--><?php // ***** user email ?>

                <div class="uk-margin-small uk-width-1-1">
                    <label class="uk-form-label" >상단고정</label>
                    <div class="uk-form-controls">
                        <input class="uk-checkbox" type="checkbox" name="post_fix" onClick="check(this)" value="Y"> 체크시 고정
                    </div>
                </div>
                
                <div class="uk-margin-small uk-width-1-1">
                    <label class="uk-form-label">웹사이트명</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="post_subj" id="post_subj" placeholder="">
                    </div>
                </div>



                <div class="uk-margin-small uk-width-1-1">
                    <label class="uk-form-label">설명</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="post_summary" id="post_summary" placeholder="">
                    </div>
                </div>

<!--                <div class="uk-margin-small uk-width-1-4@m">-->
<!--                    <label class="uk-form-label">등록일</label>-->
<!--                    <div class="uk-form-controls">-->
<!--                        <input class="uk-input datepicker" type="text" name="crt_dtms" id="crt_dtms" value="" readonly>-->
<!--                    </div>-->
<!--                </div>-->

                <div class="uk-margin-small uk-width-1-4@m">
                    <label class="uk-form-label">링크옵션</label>
                    <div class="uk-form-controls">
                        <input class="uk-checkbox" type="checkbox" name="post_link_trgt" value="_blank" checked> 체크시 새창으로
                    </div>
                </div>

                <div class="uk-margin-small uk-width-3-4@m">
                    <label class="uk-form-label">외부링크</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="post_link_addr" id="post_link_addr" placeholder="주소입력시 보기화면에서 원문링크탭이 나타납니다.">
                    </div>
                </div>


            </div>

      <!--      <?php /*if($upload_files_num){ */?>
                <?php /*$this->load->view("brd/common_file"); */?>
            --><?php /*} */?>

            <?php $this->load->view("brd/common_btn"); ?>

        </form>
    </div>

</div>
<!-- 게시글 쓰기 :: 끝-->
<script type="text/javascript">

        function check(box){
            if(box.checked == true){
                box.value = "Y";
                box.checked == true;
            }else{
                box.value = "N";
                box.checked == false;
            }

        }

</script>




    
    

    


    