<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="login_block">
    <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@m" uk-grid>
        <div>
            <div class="left_block">
                <div class="tit">로그인 안내</div>
                <div class="cont">
                    <span class="t1">규제대응지원포털</span> 웹서비스는<br>
                    카카오 인증 서비스를 이용합니다.<br>
                    <span class="t2">카카오로그인</span>버튼을 클릭하여<br>
                    로그인을 진행해 주세요.
                </div>
            </div>
        </div>
        <div>
            <div class="right_block">
                <div class="uk-placeholder">
                    <div class="btn_login">
                        <a href="javascript:loginWithKakao()" id="btn_login"><img src="/static/images/kakao_login.png"></a>
                        <p id="token-result"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--<script src="/js/jquery-1.8.1.min.js"></script>-->
    <script src="https://developers.kakao.com/sdk/js/kakao.js"></script>

    <script>
        Kakao.init('91ec0aac3f32ee5795cc51f9c7a9e493');
        //console.log(Kakao.isInitialized());
        // ath
        function loginWithKakao() {
            Kakao.Auth.authorize({
                redirectUri: 'https://law.nhbank.com/ko/auth/oauth'
            })
        }
    </script>

</div>
