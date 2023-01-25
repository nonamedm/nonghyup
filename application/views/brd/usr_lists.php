<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="brd_bdy uk-overflow-auto">
    <?php if( count($lists) ){ ?>
        <table class="uk-table uk-table-small uk-table-divider">
            <thead>
            <tr>
                <th class="no">번호 </th>
                <th class="id">아이디</th>
                <th class="name">이름</th>
                <th class="email">이메일</th>
                <th class="w100">상태</th>
                <th class="w380">전환</th>
                <th class="reg_date">회원가입일</th>
                <th class="w140" colspan="2">비밀번호오류횟수</th>
            </tr>
            </thead>
            <tbody>
            <?php for($i=0; $i<count($lists); $i++, $li_idx--){ ?>
                <tr>
                    <td class="no"><?php echo $li_idx;?></td>
                    <td class="id uk-text-center"><?php echo $lists[$i]['usr_id'];?></td>
                    <td class="name uk-text-center"><?php echo $lists[$i]['usr_nm'];?></td>
                    <td class="email"><?php echo $lists[$i]['usr_email'];?></td>
                    <td class="w100 uk-text-center">
                            <?php
                            if ($lists[$i]['usr_typ']==10) { // 정상회원
                                echo '<span class="uk-label uk-label-primary">관리자</span>';
                            }else{
                                if ($lists[$i]['usr_status']==1) { // 정상회원
                                    echo '<span class="trans1">정상회원';
                                } else if ($lists[$i]['usr_status']==2) { // 휴면회원
                                    echo '<span class="trans2">휴면회원';
                                } else if ($lists[$i]['usr_status']==3) { // 접근제한
                                    echo '<span class="trans3">접근제한';
                                }
                            }
                            echo '</span>';
                            ?>
                    </span></td>
                    <td class="w380 uk-text-center">
                        <?php if ($lists[$i]['usr_typ']!=10) { ?>
                            <?php if($lists[$i]['usr_status']!=1){ ?>
                            <a href="#" class="usr" alt="<?php echo $lists[$i]['usr_id'];?>"><span class="uk-label uk-label-secondary">정상전환</span></a>
                            <?php } ?>
                            <?php if($lists[$i]['usr_status']!=2){
                                echo date('y년 m월 d일',strtotime($lists[$i]['usr_last_login_dtms']) + (365 * 60 * 60 * 24));
                                //echo $lists[$i]['usr_last_login_dtms'];//+365 - date("Y-m-d H:i:s");
                            ?>
                            <a href="#" class="dormantAccount" alt="<?php echo $lists[$i]['usr_id'];?>"><span class="uk-label uk-label-secondary">휴면전환</span></a>
                            <?php } ?>
                            <?php if($lists[$i]['usr_status']!=3){ ?>
                            <a href="#" class="accessDeny" alt="<?php echo $lists[$i]['usr_id'];?>"><span class="uk-label uk-label-secondary">접근제한</span></a>
                            <?php } ?>
                            <a href="#" class="delAccount" alt="<?php echo $lists[$i]['usr_id'];?>"><span class="uk-label uk-label-secondary">회원삭제</span></a>
                        <?php } ?>
                    </td>
                    <td class="reg_date uk-text-center"><?php echo substr($lists[$i]['crt_dtms'], 2, 8);?></td>
                    <td class="w60 uk-text-center"><?php echo $lists[$i]['wrong_apply'];?></td>
                    <td class="w80 uk-text-center">
                        <?php if($lists[$i]['usr_lv']>5){ ?>
                            <?php if($lists[$i]['wrong_apply']>0){ ?>
                                <a href="#" class="wrongApplyInit" alt="<?php echo $lists[$i]['usr_id'];?>"><span class="uk-label uk-label-danger">초기화</span></a>
                            <?php }else{ ?>
                                <span class="uk-label uk-label-primary">초기화</span>
                            <?php } ?>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <?php if( $lists_mode=="sch" ){ ?>
            <div class='uk-placeholder uk-height-medium uk-position-relative'><p class='uk-position-center'><?php if($lng_cd=='ko'){ echo "검색결과가 없습니다.";}else{echo "No Data.";}?></p></div>
        <?php }else{ ?>
            <?php $this->load->view("brd/common_lists_nopost");?>
        <?php } ?>
    <?php } ?>
</div>
