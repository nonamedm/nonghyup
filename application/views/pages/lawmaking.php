<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php
$list = [
    0=>['no'=>10, 'proc'=>'입법예고', 'date'=>'(22.05.01)', 'reg_date'=>'22/05/01', 'part'=>'질병관리청', 'tit'=>'행정규제기본법에 따른 일몰규제 정비를 위한 5개 법령의 일부개정에 관한 ...']
    ,1=>['no'=>9, 'proc'=>'입법예고', 'date'=>'(22.05.01)', 'reg_date'=>'22/05/01', 'part'=>'식품의약품안전처', 'tit'=>'액화석유가스의 안전관리 및 사업법 시행령 일부개정령안']
    ,2=>['no'=>8, 'proc'=>'입법예고', 'date'=>'(22.05.01)', 'reg_date'=>'22/05/01', 'part'=>'기획재정부', 'tit'=>'가축분뇨의 관리 및 이용에 관한 법률 시행규칙 일부개정령안']
    ,3=>['no'=>7, 'proc'=>'입법예고', 'date'=>'(22.05.01)', 'reg_date'=>'22/05/01', 'part'=>'중소벤처기업부', 'tit'=>'해양경찰장비 도입 및 관리에 관한 법률 시행규칙 제정령안']
    ,4=>['no'=>6, 'proc'=>'입법예고', 'date'=>'(22.05.01)', 'reg_date'=>'22/05/01', 'part'=>'소방청', 'tit'=>'상표법 시행규칙 일부개정령안']
    ,5=>['no'=>5, 'proc'=>'시행예정', 'date'=>'(22.05.01)', 'reg_date'=>'22/05/01', 'part'=>'질병관리청', 'tit'=>'특허법 시행규칙 일부개정령안']
    ,6=>['no'=>4, 'proc'=>'시행예정', 'date'=>'(22.05.01)', 'reg_date'=>'22/05/01', 'part'=>'식품의약품안전처', 'tit'=>'경찰 수사에 관한 인권보호 규칙 제정령안']
    ,7=>['no'=>3, 'proc'=>'시행예정', 'date'=>'(22.05.01)', 'reg_date'=>'22/05/01', 'part'=>'기획재정부', 'tit'=>'실용신안법 시행규칙 일부개정령안']
    ,8=>['no'=>2, 'proc'=>'시행예정', 'date'=>'(22.05.01)', 'reg_date'=>'22/05/01', 'part'=>'중소벤처기업부', 'tit'=>'산림기술 진흥 및 관리에 관한 법률 시행규칙 일부개정령안']
    ,9=>['no'=>1, 'proc'=>'시행예정', 'date'=>'(22.05.01)', 'reg_date'=>'22/05/01', 'part'=>'소방청', 'tit'=>'임업·산림 공익기능 증진을 위한 직접지불제도 운영에 관한 법률 시행규칙 ...']
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
                <th class="proc">추진현황 </th>
                <th class="tit">제목 </th>
                <th class="part">소관부처 </th>
                <th class="reg_date">등록일 </th>
            </tr>
            </thead>
            <tbody>
            <?php for ($i=0; $i<count($list); $i++) { ?>
            <tr>
                <td class="no"><?php echo count($list)-$i;?></td>
                <td class="proc"><?php echo $list[$i]['proc'].' <span>'.$list[$i]['date'].'</span>';?></td>
                <td class="tit"><a href="/ko/lawmaking_view"><?php echo $list[$i]['tit'];?></a><?php if($i<3) {?><img src="/static/svg/new.svg" class="new"><?php } ?></td>
                <td class="part"><?php echo $list[$i]['part'];?></td>
                <td class="reg_date"><?php echo $list[$i]['reg_date'];?></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <?php $this->load->view("inc/brd_pgntn"); ?>

</div>
<!-- content end -->