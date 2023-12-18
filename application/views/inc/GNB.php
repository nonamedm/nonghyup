<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="submenu">

</div>
<ul class="gnb">
    <?php 
        $this->load->view("inc/popup_view", $data);
    ?>
    <?php for($i=0; $i<count($nav_tree[0]['sub']); $i++) {
        if ($nav_tree[0]['sub'][$i]['visible_yn'] != "N") {?>
    <li class="menu">
        <a href="/<?php echo $lng_cd;?>/<?php echo $nav_tree[0]['sub'][$i]['id'];?>" class="<?php if($nav_tree[0]['sub'][$i]['id']==$g_id){ echo 'focus';}?>">
            <?php echo $nav_tree[0]['sub'][$i]['tit'][$lng_idx];?>
        </a>
        <div class="smenu">
        <?php if ($nav_tree[0]['sub'][$i]['sub'] != '') {?>
            <ul class="uk-nav">
            <?php for ($j = 0; $j < count($nav_tree[0]['sub'][$i]['sub']); $j++) {?>
                <li class="">
                    <?php if($nav_tree[0]['sub'][$i]['sub'][$j]['id']=='sanctions'){ ?>
                    <!--<a href="https://www.fss.or.kr/fss/job/openInfo/list.do?menuNo=200476" target="_blank">-->
                    <a href="/<?php echo $lng_cd;?>/<?php echo $nav_tree[0]['sub'][$i]['sub'][$j]['id']; ?>" class="<?php if($nav_tree[0]['sub'][$i]['sub'][$j]['id']==$m_id){ echo 'focus';}?>">
                    <?php }else if($nav_tree[0]['sub'][$i]['sub'][$j]['id']=='current'){ ?>
                    <a href="/<?php echo $lng_cd;?>/<?php echo $nav_tree[0]['sub'][$i]['sub'][$j]['id'] ?>/lists?initial=ㄱ" class="<?php if($nav_tree[0]['sub'][$i]['sub'][$j]['id']==$m_id){ echo 'focus';}?>">
                    <?php }else if($nav_tree[0]['sub'][$i]['sub'][$j]['id']=='prevmnlaun2'||$nav_tree[0]['sub'][$i]['sub'][$j]['id']=='prevmnlaun3'||$nav_tree[0]['sub'][$i]['sub'][$j]['id']=='prevmnlaun4'||$nav_tree[0]['sub'][$i]['sub'][$j]['id']=='prevmnlaun5'){ ?>
                        <a>
                    <?php }else{ ?>
                    <a href="/<?php echo $lng_cd;?>/<?php echo $nav_tree[0]['sub'][$i]['sub'][$j]['id']; ?>" class="<?php if($nav_tree[0]['sub'][$i]['sub'][$j]['id']==$m_id){ echo 'focus';}?>">
                    <?php } ?>
                    <?php if($nav_tree[0]['sub'][$i]['sub'][$j]['id']=='prevmnlaun2'||$nav_tree[0]['sub'][$i]['sub'][$j]['id']=='prevmnlaun3'||$nav_tree[0]['sub'][$i]['sub'][$j]['id']=='prevmnlaun4'||$nav_tree[0]['sub'][$i]['sub'][$j]['id']=='prevmnlaun5') {
                            echo '';
                          } else {
                            echo $nav_tree[0]['sub'][$i]['sub'][$j]['tit'][$lng_idx];
                          }
                    ?>
                    </a>
                </li>
            <?php } ?>
            </ul>
        <?php } ?>
        </div>
    </li>

    <?php if ($i<(count($nav_tree[0]['sub'])-2)) { ?>
        <li class="dv"></li>
    <?php } ?>

    <?php } } ?>

</ul>

