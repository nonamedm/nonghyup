<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="left_MB">
    <div class="left_hd"><div class="sub_tit"><?php echo $grp_tit;?></div></div>
    <div class="left_bd">
        <?php
        if($m_id == 'search'){?>
            <div class='left_sub_menu'><a href='#'>전체 <span>(<?php echo $s_tot;?>)</span></a></div>
            <hr class='left_sub_dv'>
            <?php
            foreach($s_res as $key=>$val){
                echo "<div class='left_sub_menu'><a href='#".$key."' >".trans_idToNm($key)." <span>(".count($val).")</span></a></div>";
                if($key!='precedent'){
                    echo "<hr class='left_sub_dv'>";
                }
            }
        }else{
            for($i=0; $i<count($gd_arr); $i++){
                $cls = '';
                if ($gd_arr[$i]['id'] == 'withdrawal') {
                    $cls = "withdrawal";
                }
                if(($gd_arr[$i]['id']=='prevmnlaun'&&$m_id!='prevmnlaun')){
                    echo "<div class='left_sub_menu'><div class=''></div>";
                    echo "<a href='/ko/" . $gd_arr[$i]['id'] . "' class='" . $cls . "'>";
                    echo $gd_arr[$i]['tit'][0];
                    echo "</a>";
                    echo "<ul><li><a href='/ko/" . $gd_arr[$i]['id'] . "' class='" . $cls . "' style='font-size:15px;'>-국내동향 & 주요이슈</a></li>";
                    echo "<li><a href='/ko/" . $gd_arr[$i]['id'] . "2' class='" . $cls . "' style='font-size:15px;'>-해외동향 & Sanctions</a></li></ul></div>";
                    $i = $i+1;
                } else {
                    if($gd_arr[$i]['id']==$m_id){
                        if(($gd_arr[$i]['id']=='prevmnlaun'&&$m_id=='prevmnlaun')){
                            echo "<div class='left_sub_menu'><div class='focus_bullet'></div>";
                            echo "<a href='/ko/" . $gd_arr[$i]['id'] . "' class='focus" . $cls . "'>";
                            echo $gd_arr[$i]['tit'][0];
                            echo "</a>";
                            echo "<ul><li><a href='/ko/" . $gd_arr[$i]['id'] . "' class='" . $cls . "' style='font-size:15px;'>-국내동향 & 주요이슈</a></li>";
                            echo "<li><a href='/ko/" . $gd_arr[$i]['id'] . "2' class='" . $cls . "' style='font-size:15px;'>-해외동향 & Sanctions</a></li></ul></div>";
                            $i = $i+1;
                        } else {
                            echo "<div class='left_sub_menu'><div class='focus_bullet'></div>";
                            echo "<a href='/ko/" . $gd_arr[$i]['id'] . "' class='focus " . $cls . "'>";
                            echo $gd_arr[$i]['tit'][0];
                            echo "</a></div>";
                        }
                    } else {
                        if($gd_arr[$i]['id']=='sanctions') {
                            /*금융제재사례수정*/
                            /*echo "<div class='left_sub_menu'><a href='https://www.fss.or.kr/fss/job/openInfo/list.do?menuNo=200476' target='_blank'>" . $gd_arr[$i]['tit'][0] . "</a></div>";*/
                            echo "<div class='left_sub_menu'><a href='/ko/" . $gd_arr[$i]['id'] . "' class='" . $cls . "'>" . $gd_arr[$i]['tit'][0] . "</a></div>";
                        }else if($is_admin && ($gd_arr[$i]['id']=='myimprovement' || $gd_arr[$i]['id']=='myqna' || $gd_arr[$i]['id']=='withdrawal')) {
    
                        }else if($gd_arr[$i]['id']=='current'){
                            /*현행법령 수정*/
                            echo "<div class='left_sub_menu'><a href='/ko/" . $gd_arr[$i]['id'] . "/lists?initial=ㄱ" . "' class='focus " . $cls . "'>" . $gd_arr[$i]['tit'][0] . "</a></div>";
                        }else {
                            echo "<div class='left_sub_menu'><a href='/ko/" . $gd_arr[$i]['id'] . "' class='" . $cls . "'>" . $gd_arr[$i]['tit'][0] . "</a></div>";
                        }
                    }
                }

                // if($gd_arr[$i]['cat']){
                //     if ($m_id=='current' && !$cat) {$cat='common';}
                //     echo "<ul class='left_cat'>";
                //     for($j=0; $j<count($gd_arr[$i]['cat']); $j++){
                //         if($cat==$gd_arr[$i]['cat'][$j]['id']){
                //             echo "<li>- <a href='/ko/".$gd_arr[$i]['id']."?cat=".$gd_arr[$i]['cat'][$j]['id']."' class='active'>".$gd_arr[$i]['cat'][$j]['tit']."</a></li>";
                //         }else{
                //             echo "<li>- <a href='/ko/".$gd_arr[$i]['id']."?cat=".$gd_arr[$i]['cat'][$j]['id']."'>".$gd_arr[$i]['cat'][$j]['tit']."</a></li>";
                //         }
                //     }
                //     echo "</ul>";
                // }

                if($i<count($gd_arr)-1){
                    echo "<hr class='left_sub_dv'>";
                }

            }
        }
        ?>
    </div>
</div>