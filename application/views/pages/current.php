<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php
$list = [
    0=>['no'=>10, 'tit'=>'은행법']
    ,1=>['no'=>9, 'tit'=>'은행법시행령']
    ,2=>['no'=>8, 'tit'=>'은행업감독규정']
    ,3=>['no'=>7, 'tit'=>'은행업감독업무시행세칙']
    ,4=>['no'=>6, 'tit'=>'기술보증기금법 및 관련규정']
    ,5=>['no'=>5, 'tit'=>'신용보증기금법 및 관련규정']
    ,6=>['no'=>4, 'tit'=>'중소기업은행법 및 관련규정']
    ,7=>['no'=>3, 'tit'=>'한국산업은행법 및 관련규정']
    ,8=>['no'=>2, 'tit'=>'한국수출입은행법 및 관련규정']
    ,9=>['no'=>1, 'tit'=>'한국은행법 및 관련규정']
];
?>
<!-- content start -->
<div class="cont_body">

    <?php $this->load->view("inc/brd_srch"); ?>

    <div class="brd_bdy uk-overflow-auto">
        <div class="sort"><span class="uk-label new">최신순</span><span class="uk-label old">오래된순</span></div>
        <table class="uk-table uk-table-small uk-table-divider">
            <thead>
            <tr>
                <th class="no">번호 </th>
                <th class="tit">제목 </th>
            </tr>
            </thead>
            <tbody>
            <?php for ($i=0; $i<count($list); $i++) { ?>
                <tr>
                    <td class="no"><?php echo count($list)-$i;?></td>
                    <td class="tit"><a href="#"><?php echo $list[$i]['tit'];?></a><?php if($i==0) {?><img src="/static/svg/new.svg" class="new"><?php } ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <?php $this->load->view("inc/brd_pgntn"); ?>

</div>
<!-- content end -->