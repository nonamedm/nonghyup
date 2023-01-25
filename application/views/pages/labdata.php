<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php
$list = [
    0=>['no'=>10, 'part'=>'기획재정부', 'date'=>'17/03/05', 'tit'=>'인공지능채팅 서비스의 개인정보보호법 위반으로 인한 제재처분 사례 분석']
    ,1=>['no'=>9, 'part'=>'기획재정부', 'date'=>'17/03/05', 'tit'=>'FI(재무적 투자자)와 SI(전략적 투자자)의 스타트업 투자 비교']
    ,2=>['no'=>8, 'part'=>'기획재정부', 'date'=>'17/03/05', 'tit'=>'지주회사의 CVC 제한적 보유를 허용하는 개정 공정거래법 시행 예정']
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
                    <td class="tit"><a href="#"><?php echo $list[$i]['tit'];?></a><?php if($i<2) {?><img src="/static/svg/new.svg" class="new"><?php } ?></td>
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