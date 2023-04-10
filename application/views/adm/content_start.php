<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="content">
    <?php if($m_id=='dashboard'){ ?>

    <?php } else { ?>
    <div class="cont_left">
        <?php
        if (isset($gd_arr) && count($gd_arr)) {
            if($usr_arr['usr_id']=='nacf5061') {
                echo '<div class="left_sub_menu"><a href="/adm/intnlctrl">내부통제</a></div>';
                echo "<hr class='left_sub_dv'>";
            } else if($usr_arr['usr_id']=='nacf50611') {
                echo '<div class="left_sub_menu"><a href="/adm/finnaccexp">금융사고사례</a></div>';
                echo "<hr class='left_sub_dv'>";
            } else if($usr_arr['usr_id']=='17311795'||$usr_arr['usr_id']=='19312949'||$usr_arr['usr_id']=='08305788'||$usr_arr['usr_id']=='21613193'||$usr_arr['usr_id']=='wtadmin') { 
                echo '<div class="left_sub_menu"><a href="/adm/prevmnlaun1">국내동향 & 주요이슈</a></div>';
                echo "<hr class='left_sub_dv'>";
                echo '<div class="left_sub_menu"><a href="/adm/prevmnlaun2">해외동향 &amp; Sanctions</a></div>';
                echo "<hr class='left_sub_dv'>";
            } else {
                for ($i = 0; $i < count($gd_arr); $i++) {
                    if ($gd_arr[$i]['id'] == $m_id) {
                        echo "<div class='left_sub_menu'><div class='focus_bullet'></div><a href='/" . $seg . "/" . $gd_arr[$i]['id'] . "' class='focus'>" . $gd_arr[$i]['tit'][0] . "</a></div>";
                    } else {
                        echo "<div class='left_sub_menu'><a href='/" . $seg . "/" . $gd_arr[$i]['id'] . "'>" . $gd_arr[$i]['tit'][0] . "</a></div>";
                    }
    
                    if ($i < count($gd_arr) - 1) {
                        echo "<hr class='left_sub_dv'>";
                    }
                }
            }
        }
        ?>
    </div>
    <div class="cont_body">

    <?php } ?>
