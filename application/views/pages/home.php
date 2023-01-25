<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


    <div class="section sec1">
        <div class="container">
            <div class="latest">
                <a href="/ko/brief" class="subj_box">
                    <div class="subj">LEGAL <span>BRIEF</span></div><img src="/static/svg/more.svg" class="more">
                </a>
                <hr>
                <div class="mtr">
                    <?php for ($i=0; $i<count($lists_brief); $i++) { ?>
                        <div class="tit">
                        <a class="ellipsis" href="/ko/brief/view?idx=<?php echo $lists_brief[$i]['idx'];?>">
                            <?php echo $lists_brief[$i]['post_subj'];?>
                        </a><?php echo get_label_new($lists_brief[$i]['crt_dtms']);?>
                        </div>
                        <div class="caption">
                            <span class="cat">[<?php echo $lists_brief[$i]['usr_nm'];?>]</span>
                        </div>
                    <?php } ?>
                </div>
                <div class="wtr">
                    <table class="uk-table uk-table-small uk-table-divider brd_brief">
                        <?php for ($i=0; $i<count($lists_brief); $i++) { ?>
                            <tr class="" <?php if($i==0){ echo "style='border-top: 0'";}?>>
                                <td class="cat">[<?php echo $lists_brief[$i]['usr_nm'];?>]</td>
                                <td class="tit">
                                    <a href="/ko/brief/view?idx=<?php echo $lists_brief[$i]['idx'];?>">
                                        <?php echo $lists_brief[$i]['post_subj'];?>
                                    </a><?php echo get_label_new($lists_brief[$i]['crt_dtms']);?>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>

            <div class="banner">
                <div class="single-item">
                    <div><a href="http://pf.kakao.com/_VRUxnb" target="_blank"><img src="/static/images/banner0.png"></a></div>
                    <div><a href="/ko/news"><img src="/static/images/banner1.png"></a></div>
                </div>
            </div>
        </div>
    </div>

    <div class="section sec2">
        <div class="container">
            <div class="latest">
                <div class="subj"><span>최신</span>금융규제동향</div>
                <div class="tab_box">
                    <div class="tabs">
                        <div class="mtab focus">입법동향</div><div class="mtab">보도자료</div>
                    </div>
                    <a href="/ko/lawmaking"><img src="/static/svg/more.svg" class="more"></a>
                </div>
                <hr>
                <div class="tab_content" id="tab_0">
                    <div class="mtr">
                        <?php for ($i=0; $i<count($lists_lawmaking); $i++) { ?>
                            <div class="tit">
                                <a class="ellipsis" href="/ko/lawmaking/view?idx=<?php echo $lists_lawmaking[$i]['idx'];?>">
                                    <?php echo $lists_lawmaking[$i]['post_subj'];?>
                                </a><?php echo get_label_new($lists_lawmaking[$i]['crt_dtms']);?>
                            </div>
                            <div class="caption">
                                <span><?php echo $lists_lawmaking[$i]['post_status'];?> (<span><?php echo substr($lists_lawmaking[$i]['post_dtms'], 2,8);?>)</span></span>
                                <span><?php echo $lists_lawmaking[$i]['post_field'];?></span>
                            </div>

                        <?php } ?>
                    </div>
                    <div class="wtr">
                        <table class="brd_lawmaking uk-table uk-table-small uk-table-divider">
                            <?php for ($i=0; $i<count($lists_lawmaking); $i++) { ?>
                                <tr class="" <?php if($i==0){ echo "style='border-top: 0'";}?>>
                                    <td class="cat"><?php echo $lists_lawmaking[$i]['post_status'];?> (<span><?php echo substr($lists_lawmaking[$i]['post_dtms'], 2,8);?>)</span></td>
                                    <td class="tit" id="tit<?php echo $i;?>">
                                        <a href="/ko/lawmaking/view?idx=<?php echo $lists_lawmaking[$i]['idx'];?>">
                                            <?php echo $lists_lawmaking[$i]['post_subj'];?><span class="uk-label hidden" id="post_summary<?php echo $i;?>"><?php echo $lists_lawmaking[$i]['post_summary'];?></span>
                                        </a><?php echo get_label_new($lists_lawmaking[$i]['crt_dtms']);?>
                                    </td>
                                    <!--<td class="typ"><?php /*echo $lists_lawmaking[$i]['typ'];*/?></td>-->
                                    <td class="part"><?php echo $lists_lawmaking[$i]['post_field'];?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <div class="tab_content" id="tab_1">
                    <div class="mtr">
                        <?php for ($i=0; $i<count($lists_pr); $i++) { ?>
                            <div class="tit">
                                <a class="ellipsis" href="/ko/pr/view?idx=<?php echo $lists_pr[$i]['idx'];?>">
                                    <?php echo $lists_pr[$i]['post_subj'];?>
                                </a><?php echo get_label_new($lists_pr[$i]['crt_dtms']);?>
                            </div>
                            <div class="caption">
                                <span><?php echo $lists_pr[$i]['post_field'];?></span>
                                <span><?php echo substr($lists_pr[$i]['crt_dtms'], 2,8);?></span>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="wtr">
                        <table class="brd_pr uk-table uk-table-small uk-table-divider">
                            <?php for ($i=0; $i<count($lists_pr); $i++) { ?>
                                <tr class="" <?php if($i==0){ echo "style='border-top: 0'";}?>>
                                    <td class="part"><?php echo $lists_pr[$i]['post_field'];?></td>
                                    <td class="tit" id="cit<?php echo $i;?>">
                                        <a href="/ko/pr/view?idx=<?php echo $lists_pr[$i]['idx'];?>">
                                            <?php echo $lists_pr[$i]['post_subj'];?>
                                        </a><?php echo get_label_new($lists_pr[$i]['crt_dtms']);?>
                                    </td>
                                    <td class="date"><?php echo substr($lists_pr[$i]['crt_dtms'], 2,8);?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section sec3">
        <div class="container cont_pop">
            <img src="/static/svg/corner_left.svg" class="corner_left">
            <img src="/static/svg/corner_right.svg" class="corner_right">

            <div class="latest">
                <a href="/ko/labdata" class="subj_box">
                <div class="subj">기관연구자료</div><img src="/static/svg/more.svg" class="more">
                </a>
                <hr>
                <div class="mtr">
                    <?php for ($i=0; $i<count($lists_labdata); $i++) { ?>
                        <div class="tit">
                            <?php if($lists_labdata[$i]['post_link_addr']){ ?>
                            <a class="ellipsis" href="<?php echo $lists_labdata[$i]['post_link_addr'];?>" target="<?php echo $lists_labdata[$i]['post_link_trgt'];?>" class="chk_perm_view">
                            <?php }else{ ?>
                            <a class="ellipsis" href="/ko/pr/view?idx=<?php echo $lists_labdata[$i]['idx'];?>">
                            <?php } ?>
                                <?php echo $lists_labdata[$i]['post_subj'];?>
                            </a><?php if($lists_labdata[$i]['post_link_addr']){ ?><span class="uk-label link"><img src="/static/svg/outlink.svg"></span><?php }?>
                            <?php echo get_label_new($lists_labdata[$i]['crt_dtms']);?>
                        </div>
                        <div class="caption">
                            <span><?php echo $lists_labdata[$i]['post_field'];?></span>
                            <span><?php echo substr($lists_labdata[$i]['crt_dtms'], 2,8);?></span>
                        </div>
                    <?php } ?>
                </div>
                <div class="wtr">
                    <table class="brd_pr uk-table uk-table-small uk-table-divider">
                        <?php for ($i=0; $i<count($lists_labdata); $i++) { ?>
                            <tr class="" <?php if($i==0){ echo "style='border-top: 0'";}?>>
                                <td class="part"><?php echo $lists_labdata[$i]['post_field'];?></td>
                                <td class="tit" id="dit<?php echo $i;?>">
                                    <?php if($lists_labdata[$i]['post_link_addr']){ ?>
                                    <a href="<?php echo $lists_labdata[$i]['post_link_addr'];?>" target="<?php echo $lists_labdata[$i]['post_link_trgt'];?>" class="chk_perm_view">
                                        <?php }else{ ?>
                                        <a href="/ko/labdata/view?idx=<?php echo $lists_labdata[$i]['idx'];?>">
                                            <?php } ?>
                                            <?php echo $lists_labdata[$i]['post_subj'];?>
                                            <?php if($lists_labdata[$i]['post_link_addr']){ ?><span class="uk-label link"><img src="/static/svg/outlink.svg"></span><?php } ?>
                                            <?php echo get_label_new($lists_labdata[$i]['crt_dtms']);?>
                                        </a>
                                </td>
                                <td class="date"><?php echo substr($lists_labdata[$i]['crt_dtms'], 2,8);?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

