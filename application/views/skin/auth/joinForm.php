<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="joinForm_block">
    <form id="joinForm" method="POST" class="uk-form-stacked">
    <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@m" uk-grid>
        <input type="hidden">
        <div>
            <div class="left_block">
                <div class="tit">회원가입 안내</div>
                <div class="cont">
                    <span>카카오인증</span> 을 통해
                    제공받은 정보로 회원가입이 진행됩니다.<br>
                    이용약관, 개인정보처리방침 동의 후<br>
                    회원가입이 완료됩니다.
                </div>
            </div>
        </div>
        <div>
            <div class="right_block">
                <div class="uk-placeholder">
                    <input type="hidden" name="usr_id" value="<?php echo $usr_id;?>">

                    <div class="uk-margin">
                        <label class="uk-form-label">이름(필수입력)</label>
                        <div class="uk-form-controls">
                            <?php if ($usr_nm) { ?>
                            <input type="text" name="usr_nm" id="usr_nm" class="uk-input usr_nm" readonly value="<?php echo $usr_nm;?>">
                            <?php } else { ?>
                            <input type="text" name="usr_nm" id="usr_nm" class="uk-input usr_nm" value="" placeholder="이름을 입력해 주세요.">
                            <?php } ?>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label">이메일 주소(필수입력)</label>
                        <div class="uk-form-controls">
                            <?php if ($usr_email) { ?>
                            <input type="text" name="usr_email" id="usr_email" class="uk-input usr_email" readonly value="<?php echo $usr_email;?>">
                            <?php } else { ?>
                            <input type="text" name="usr_email" id="usr_email" class="uk-input usr_email" value="" placeholder="이메일을 입력해 주세요.">
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="btm uk-card uk-card-default">
        <h4>이용약관</h4>
        <div class="agree agree1">
            <?php
            if(isset($terms['post_cont']) && $terms['post_cont']){
                echo $terms['post_cont'];
            }else{
                echo '내용 준비중';
            }
            ?>
        </div>
        <span class="agr_chk"><input type="checkbox" class="uk-checkbox" id="usr_agr_pri_dtms" name="usr_agr_pri_dtms" value=""> 이용약관에 동의합니다.</span>

        <h4>개인정보처리방침</h4>
        <div class="agree agree2">
            <?php
            if(isset($privacy['post_cont']) && $privacy['post_cont']){
                echo $privacy['post_cont'];
            }else{
                echo '내용 준비중';
            }
            ?>
        </div>
        <span class="agr_chk"><input type="checkbox" class="uk-checkbox" id="usr_agr_terms_dtms" name="usr_agr_terms_dtms" value=""> 개인정보처리방침에 동의합니다.</span>
        <!--
        <h4>저작권정책</h4>
        <div class="agree agree3">
            내용 준비중
        </div>
        <span class="agr_chk"><input type="checkbox" class="uk-checkbox" id="usr_agr_copy_dtms" name="usr_agr_copy_dtms" value=""> 저작권정책에 동의합니다.</span>
        -->
        <div class="btn_block"><button type="submit" class="uk-button uk-button-primary">확인</button></div>
    </div>
    </form>
</div>