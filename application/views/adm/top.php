<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
/*
------------------------------
 N A V B A R
------------------------------
*/

?>
<div class="section hot">
    <div class="container">
        <div class="logo">
            <span class=""><?php echo $usr_arr['usr_id'].' ('.$usr_arr['usr_nm'].')'; ?></span>
        </div>

        <div class="hot_menu">
            <?php if($is_login){ ?>
                <?php if( $is_admin ){ ?>
                    <?php if($is_adm_mod){ ?>
                        <a href="/<?php echo $lng_cd; ?>" class="btn_hot"><?php echo get_nav('web', $lng_idx); ?></a>
                    <?php }else{ ?>
                        <a href="/adm" class="btn_hot"><?php echo get_nav('adm', $lng_idx); ?></a>
                    <?php } ?>
                <?php } ?>
                <a href="<?php echo $base_url;?>/auth/logout" class="btn_hot"><?php echo get_nav('logout', $lng_idx); ?></a>
            <?php } ?>
        </div>
    </div>
</div>


<div class="section nav">
    <nav class="uk-navbar-container uk-navbar-transparent" uk-navbar>

        <!--<div class="uk-navbar-left logo"><a href="/"><img src="/static/svg/home_logo.svg"></a></div>-->

        <div class="uk-navbar-left logo"><a href="/adm/">ADMIN</a></div>


        <div class="uk-navbar-center mm menubar uk-visible@l">
            <ul class="gnb">
                <?php if($usr_arr['usr_id']=='nacf5061'||$usr_arr['usr_id']=='nacf50611'||$usr_arr['usr_id']=='wtadmin'||$usr_arr['usr_id']=='17311795'||$usr_arr['usr_id']=='19312949'||$usr_arr['usr_id']=='08305788'||$usr_arr['usr_id']=='21613193') {?>
                    <li class="menu">
                        <a href="/adm/" class="focus">
                        컨텐츠관리</a>
                    </li>
                <?php } else {?>
                <?php for($i=0; $i<count($nav_tree[0]['sub']); $i++) {
                    if ($nav_tree[0]['sub'][$i]['visible_yn'] != "N") {?>
                        <li class="menu">
                            <a href="/<?php echo $seg;?>/<?php echo $nav_tree[0]['sub'][$i]['id'];?>" class="<?php if($nav_tree[0]['sub'][$i]['id']==$g_id){ echo 'focus';}?>">
                                <?php echo $nav_tree[0]['sub'][$i]['tit'][$lng_idx];?>
                            </a>
                        </li>

                        <?php if ($i<(count($nav_tree[0]['sub'])-2)) { ?>
                            <li class="dv"></li>
                            <?php } ?>
                            
                            <?php } } ?>
                <?php }?>
            </ul>
        </div>

        <!-- TOGGLE_MENU -->
        <div class="uk-hidden@l" id="m_menu">
            <button id="mtoggle" class="uk-navbar-toggle uk-navbar-toggle-icon uk-icon uk-hidden@l" uk-scroll><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" ratio="1"><rect y="9" width="20" height="2"></rect><rect y="3" width="20" height="2"></rect><rect y="15" width="20" height="2"></rect></svg>
            </button>
        </div>

    </nav>
</div>