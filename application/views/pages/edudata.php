<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php
$list = [
    0=>['no'=>10, 'part'=>'일자리위원회', 'date'=>'17/03/05', 'tit'=>'미국의 금융제재 방식 및 활용 검토']
    ,1=>['no'=>9, 'part'=>'기획재정부', 'date'=>'17/03/05', 'tit'=>'EU 탄소국경조정메커니즘(CBAM)의 WTO TBT 협정 합치성']
    ,2=>['no'=>8, 'part'=>'기획재정부', 'date'=>'17/03/05', 'tit'=>'Korea Chapter in the International Investigations Review, Eleventh Edition']
    ,3=>['no'=>7, 'part'=>'기획재정부', 'date'=>'16/03/05', 'tit'=>'해양경찰장비 도입 및 관리에 관한 법률 시행규칙 제정령안']
    ,4=>['no'=>6, 'part'=>'기획재정부', 'date'=>'16/03/05', 'tit'=>'상표법 시행규칙 일부개정령안']
    ,5=>['no'=>5, 'part'=>'기획재정부', 'date'=>'16/03/05', 'tit'=>'특허법 시행규칙 일부개정령안']
    ,6=>['no'=>4, 'part'=>'기획재정부', 'date'=>'15/03/05', 'tit'=>'경찰 수사에 관한 인권보호 규칙 제정령안']
    ,7=>['no'=>3, 'part'=>'기획재정부', 'date'=>'15/03/05', 'tit'=>'실용신안법 시행규칙 일부개정령안']
    ,8=>['no'=>2, 'part'=>'기획재정부', 'date'=>'15/03/05', 'tit'=>'산림기술 진흥 및 관리에 관한 법률 시행규칙 일부개정령안']
    ,9=>['no'=>1, 'part'=>'자치분권위원회', 'date'=>'14/03/05', 'tit'=>'임업·산림 공익기능 증진을 위한 직접지불제도 운영에 관한 법률 시행규칙 ...']
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
                <th class="part">발행기관 </th>
                <th class="date">등록일 </th>
            </tr>
            </thead>
            <tbody>
            <?php for ($i=0; $i<count($list); $i++) { ?>
                <tr>
                    <td class="no"><?php echo count($list)-$i;?></td>
                    <td class="tit"><a href="#"><?php echo $list[$i]['tit'];?></a><?php if($i<1) {?><img src="/static/svg/new.svg" class="new"><?php } ?></td>
                    <td class="part"><?php echo $list[$i]['part'];?></td>
                    <td class="date"><?php echo $list[$i]['date'];?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <?php $this->load->view("inc/brd_pgntn"); ?>

</div>
<!-- content end -->