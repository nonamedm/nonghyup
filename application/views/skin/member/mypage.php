<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>



<div class="uk-card uk-card-default uk-card-body">

    <div class="uk-navbar-left uk-margin-small">
        <?php

        if( $usr_arr['usr_lv']>5 ){ ?>
            <?php if($usr_arr['usr_typ']==10){ ?>
            <span><a href="/<?php echo $seg;?>/auth/resetPw" class="uk-button uk-button-default uk-background-muted uk-button-small uk-margin-small-right">비밀번호변경</a></span>
            <?php } ?>
        <?php } ?>

    </div>

    <div class="uk-child-width-expand@s c_grid uk-margin-medium-top" uk-grid>
        <div class="sec_tit">
            <h3 class="uk-heading-divider">회원정보</h3>
            <?php if($usr_arr){ ?>
            <table class="uk-table uk-table-small uk-table-divider">
                <tr><td>이름</td><td><?php echo $usr_arr['usr_nm']; ?></td></tr>
                <tr><td>이메일</td><td><?php echo $usr_arr['usr_email']; ?></td></tr>
                <tr><td>회원가입일</td><td><?php echo $usr_arr['crt_dtms']; ?></td></tr>
                <tr><td>이용약관 동의일시</td><td><?php echo $usr_arr['usr_agr_terms_dtms']; ?></td></tr>
                <tr><td>개인정보처리방침 동의일시</td><td><?php echo $usr_arr['usr_agr_pri_dtms']; ?></td></tr>
                <tr><td>회원상태</td><td>
                        <?php if( $usr_arr['usr_lv']>=5 ) { ?>
                            관리자회원
                        <?php }else if( $usr_arr['usr_lv']==2 ){?>
                            일반회원
                        <?php }else if( $usr_arr['usr_lv']==1 ){?>
                            휴면회원
                        <?php }?>
                    </td></tr>
            </table>
            <?php }else{ ?>
            <div class="uk-placeholder uk-text-center">
                내용이 없습니다.
            </div>
            <?php } ?>

        </div>

    </div>

</div>

