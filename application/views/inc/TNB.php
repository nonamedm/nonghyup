<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php if($is_admin){ ?>
    <div class="adm uk-label"><a href="/adm/">Admin</a></div>
<?php } ?>
<ul>
    <?php if($is_login){ ?>
        <li><a href="/ko/mypage">마이페이지</a></li>
        <li><a href="/ko/auth/logout">로그아웃</a></li>
    <?php }else{ ?>
        <li><a href="/ko/auth/login">로그인</a></li>
        <li><a href="/ko/auth/join">회원가입</a></li>
    <?php } ?>
</ul>
