<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!-- 게시글 수정 :: 시작-->
<div class="cont">

    <!-- 게시글 수정 :: 시작-->
    <div class="brd_modify">
        <form id="brdFormDefault" method="POST" action="" enctype="multipart/form-data" class="uk-form-stacked"><!-- /<?php //echo $seg;?>/<?php //echo $m_id;?>/update?idx=<?php //echo $idx;?> -->
            <div class="uk-child-width-1-4@m uk-grid-small" uk-grid>
                <input type="hidden" id="mode" value="modify">
                <input type="hidden" id="m_id" value="<?php echo $m_id;?>">
                <!--<input type="hidden" id="upload_files_num" value="<?php /*echo $upload_files_num;*/?>">-->
                <input type="hidden" id="idx" name="idx" value="<?php echo $idx;?>">
                <input type="hidden" name="usr_id" value="<?php echo $usr['usr_id'];?>">
                <input type="hidden" name="usr_nm" id="usr_nm" value="<?php echo $usr['usr_nm'];?>">

                <div class="uk-margin-small uk-width-1-1">
                    <label class="uk-form-label"></label>
                    <div class="uk-form-controls">
                        <input class="uk-checkbox fix_chk" id="post_fix" type="checkbox" name="post_fix" onchange="check(this)" value="<?php echo $modify['post_fix'];?>"> 체크시 고정

                    </div>
                </div>

                <div class="uk-margin uk-width-1-1">
                    <label class="uk-form-label">상단 번호</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="number" name="post_fix_num" value="<?php echo $modify['post_fix_num'];?>">
                    </div>
                </div>

                <div class="uk-margin uk-width-1-1">
                    <label class="uk-form-label">웹사이트명</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="post_subj" id="post_subj" value="<?php echo $modify['post_subj'];?>">
                    </div>
                </div>

                <div class="uk-margin-small uk-width-1-1">
                    <label class="uk-form-label">설명</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="post_summary" id="post_summary" value="<?php echo $modify['post_summary'];?>">
                    </div>
                </div>

                <div class="uk-margin-small uk-width-3-4@m">
                    <label class="uk-form-label">URL</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="post_link_addr" id="post_link_addr" placeholder="주소입력시 보기화면에서 원문링크탭이 나타납니다." value="<?php echo $modify['post_link_addr'];?>">
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
<script type="text/javascript">
    (function() {

        setTimeout(() => check(), 600);

        function check() {
            var post_fix_chk = $('#post_fix').is(':checked');
            var post_fix=$('#post_fix').val();
            if (post_fix == 'Y') {
                $('#post_fix').val('Y');
                $('input:checkbox[name="post_fix"]').prop('checked', true);
            } else {
                $('#post_fix').val('N');
                $('input:checkbox[name="post_fix"]').prop('checked', false);
            }

        }
    })();
</script>
<!-- 게시글 수정 :: 끝-->