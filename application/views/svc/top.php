<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="header_space"></div>
<div id="header">
    <div class="GH">
        <!-- hd_left -->
        <div class="hd_left">
            <a href="/index.php" title="메인으로" class="logo_set">
                <img src="/static/svg/nh_logo.svg" class="logo nh_logo">
                <img src="/static/svg/site_logo.svg" class="logo site_logo">
            </a>
        </div>

        <div class="hd_center">
            <div class="top_search">
                <input type="text" id="top_search" class="top_search_field" value="<?php if($s_fsw && $m_id!="search"){ echo $s_fsw;}?>">
                <button id="top_search_btn" class="top_search_btn"><img src="/static/svg/search.svg"></button>
                <div class="top_mbl_btn"><a href="#" class="btn_mbl"></a></div>
            </div>
            <div class="top_keyword">
                <?php
                for($i=0; $i<count($kw_lists); $i++){
                    echo "<button class='tkw tkw".$i."' alt='".$kw_lists[$i]['post_subj']."'>".$kw_lists[$i]['post_subj']."</button>";
                }
                ?>
            </div>
        </div>

        <!-- hd_right -->
        <div class="hd_right">
            <div class="top_menu">
                <?php $this->load->view("inc/TNB"); ?>
            </div>
            <a href="#" class="sch"><img src="/static/svg/search1.svg"></a>
            <a href="#" class="btn_mbl"><img src="/static/svg/btn_mbl.svg"></a>
        </div>
    </div>
    <div class="m_search">
        <input type="text" id="mtop_search" class="top_search_field" value="<?php if($s_fsw && $m_id!="search"){ echo $s_fsw;}?>">
        <button id="mtop_search_btn" class="top_search_btn">검색</button>
        <div class="top_keyword">
            <?php
            for($i=0; $i<count($kw_lists); $i++){
                echo "<button class='tkw tkw".$i."' alt='".$kw_lists[$i]['post_subj']."'>".$kw_lists[$i]['post_subj']."</button>";
            }
            ?>
        </div>
    </div>
    <div class="GNB">
        <?php $this->load->view("inc/GNB"); ?>
    </div>


    <div class="mblmenu" id="mblmenu">
        <ul class="dp1">
        <?php for($i=0; $i<count($nav_tree[0]['sub']); $i++){
            if($nav_tree[0]['sub'][$i]['visible_yn']!='N') { ?>
            <li class="mm">
                <a class="" href="/<?php echo $lng_cd;?>/<?php echo $nav_tree[0]['sub'][$i]['id'];?>">
                    <?php echo $nav_tree[0]['sub'][$i]['tit'][$lng_idx];?>
                </a>
                <?php if ($nav_tree[0]['sub'][$i]['sub']){ ?>
                <div class="mm_sub">
                    <ul class="dp2">
                    <?php for ($j=0; $j<count($nav_tree[0]['sub'][$i]['sub']); $j++) {
                        if($nav_tree[0]['sub'][$i]['sub'][$j]['visible_yn']!='N') { ?>
                        <li class="sm">
                            <!--금융제재사례수정-->
                            <?php if($nav_tree[0]['sub'][$i]['sub'][$j]['id']=='sanctions'){ ?>
                            <a href="/<?php echo $lng_cd;?>/<?php echo $nav_tree[0]['sub'][$i]['sub'][$j]['id'];?>">
                            <!--<a href="https://www.fss.or.kr/fss/job/openInfo/list.do?menuNo=200476" target="_blank">-->
                            <?php }else{ ?>
                            <a href="/<?php echo $lng_cd;?>/<?php echo $nav_tree[0]['sub'][$i]['sub'][$j]['id'];?>">
                            <?php } ?>
                                <?php echo strip_tags($nav_tree[0]['sub'][$i]['sub'][$j]['tit'][$lng_idx]);?>
                            </a>
                        </li>
                        <?php } ?>
                    <?php } ?>
                    </ul>
                </div>
                <?php } ?>
            </li>
            <?php } ?>
        <?php } ?>
            <li class="mm">
                <a href="#">마이페이지</a>
                <div class="mm_sub">
                    <ul class="dp2">
                        <li class="sm"><a href="/ko/mypage">회원정보</a></li>
                        <?php if(! $is_admin){ ?>
                        <li class="sm"><a href="/ko/myimprovement">나의 규제개선제안</a></li>
                        <li class="sm"><a href="/ko/myqna">나의 규제대응Q&A</a></li>
                        <li class="sm"><a href="/ko/withdrawal" class="withdrawal">회원탈퇴</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </li>
            <li class="mm">
                <?php if($is_login){ ?>
                    <a href="/ko/auth/logout" class="uk-display-inline">로그아웃</a>
                <?php }else{ ?>
                    <a href="/ko/auth/login" class="uk-display-inline">로그인</a>
                    <a href="/ko/auth/join" class="uk-display-inline">회원가입</a>
                <?php } ?>
            </li>
        </ul>
    </div>
    
    <div class="noticeBannerW">
        <a href="/ko/improvement" class="noticeBanner">
            <p class="txtBlue txtBold" style="color:#2B347B">Quick Service </p> 
            <br>
            <p style="margin-top: -18px"> 필요한 규제 정보를 요청하세요</p>
        </a>
        <button type="button" class="btnClose"></button>
    </div>

</div>