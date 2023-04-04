<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<!-- 게시글 쓰기 :: 시작-->

    <div class="brd_write">
        <form id="brdFormDefault" method="POST" action="/<?php echo $seg;?>/<?php echo $m_id;?>/insert" enctype="multipart/form-data" class="uk-form-stacked"><!--  -->
            <div class="uk-child-width-1-4@m uk-grid-small" uk-grid>
                <input type="hidden" id="mode" value="write">
                <input type="hidden" id="m_id" value="<?php echo $m_id;?>">
                <input type="hidden" name="usr_id" value="<?php echo $usr['usr_id'];?>">
                <input type="hidden" name="usr_nm" id="usr_nm" value="<?php echo $usr['usr_nm'];?>">

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

                <div class="uk-margin-small uk-width-4-5@m">
                    <label class="uk-form-label">키워드</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="post_subj" id="post_subj" placeholder="통합검색창 하단에 노출될 키워드 입력">
                    </div>
                </div>

                <div class="uk-margin uk-width-1-5@m">
                    <label class="uk-form-label">배포여부</label>
                    <div class="uk-form-controls">
                        <input type="checkbox" class="uk-checkbox" name="post_status" id="post_status" value="1"> 배포 (체크시 공개)
                    </div>
                </div>

                <div class="uk-margin-small uk-width-1-1">
                    <label class="uk-form-label">메모(관리용)</label>
                    <div class="uk-form-controls">
                        <textarea class="uk-textarea ckeditor" name="post_cont" id="post_cont" rows='10'></textarea>
                    </div>
                </div>

            </div>

            <?php $this->load->view("brd/common_btn"); ?>

        </form>
    </div>

<!-- 게시글 쓰기 :: 끝-->




    
    

    


    