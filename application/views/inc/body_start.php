<?php defined('BASEPATH') OR exit('No direct script access allowed');
?></head>
<body class="<?php
    if ($svc_mod) {
        echo $svc_mod;
    }
    if ($lng_cd) {
        echo " ".$lng_cd;
    }
    if ($m_id=='home') {
        echo " main";
    } else {
        if($g_id){
            echo " ".$g_id;
        }
        echo " sub ".$m_id;
    }
    if( $fnc_typ=='bbs' )
    {
        echo ' '.$bbs_mod;
    }
?>">
<div id="is_mbl"></div>
<div id="wrap">

    <!--<div id="skip_navi">
        <a href="#content_area">본문으로 바로가기</a>
        <a href="#gnb">주요메뉴 바로가기</a>
    </div>-->
