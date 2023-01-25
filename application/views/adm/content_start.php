<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="content">
    <?php if($m_id=='dashboard'){ ?>

    <?php } else { ?>
    <div class="cont_left">
        <?php
        if (isset($gd_arr) && count($gd_arr)) {
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
        ?>
    </div>
    <div class="cont_body">

    <?php } ?>
