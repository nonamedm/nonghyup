<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php
$list = [
    0=>['no'=>10, 'cat'=>'은행업감독규정', 'date'=>'22/05/01', 'tit'=>'행정규제기본법에 따른 일몰규제 정비를 위한 5개 법령의 일부개정에 관한 ...', 'part'=>'금융감독원']
    ,1=>['no'=>9, 'cat'=>'신용협동조합법', 'date'=>'22/05/01', 'tit'=>'액화석유가스의 안전관리 및 사업법 시행령 일부개정령안', 'part'=>'금융감독원']
    ,2=>['no'=>8, 'cat'=>'전자금융감독규정', 'date'=>'22/05/01', 'tit'=>'가축분뇨의 관리 및 이용에 관한 법률 시행규칙 일부개정령안', 'part'=>'금융감독원']
    ,3=>['no'=>7, 'cat'=>'민간투자법', 'date'=>'22/05/01', 'tit'=>'해양경찰장비 도입 및 관리에 관한 법률 시행규칙 제정령안', 'part'=>'금융감독원']
    ,4=>['no'=>6, 'cat'=>'은행업감독규정', 'date'=>'22/05/01', 'tit'=>'상표법 시행규칙 일부개정령안', 'part'=>'금융감독원']
    ,5=>['no'=>5, 'cat'=>'신용협동조합법', 'date'=>'22/05/01', 'tit'=>'특허법 시행규칙 일부개정령안', 'part'=>'금융감독원']
    ,6=>['no'=>4, 'cat'=>'은행업감독규정', 'date'=>'22/05/01', 'tit'=>'경찰 수사에 관한 인권보호 규칙 제정령안', 'part'=>'금융감독원']
    ,7=>['no'=>3, 'cat'=>'은행업감독규정', 'date'=>'22/05/01', 'tit'=>'실용신안법 시행규칙 일부개정령안', 'part'=>'금융감독원']
    ,8=>['no'=>2, 'cat'=>'신용협동조합법', 'date'=>'22/05/01', 'tit'=>'산림기술 진흥 및 관리에 관한 법률 시행규칙 일부개정령안', 'part'=>'금융감독원']
    ,9=>['no'=>1, 'cat'=>'전자금융감독규정', 'date'=>'22/05/01', 'tit'=>'임업·산림 공익기능 증진을 위한 직접지불제도 운영에 관한 법률 시행규칙 ...', 'part'=>'금융감독원']
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
                <th class="cat">법령명 </th>
                <th class="tit">제목 </th>
                <th class="part">발행기관 </th>
                <th class="date">회신일 </th>
            </tr>
            </thead>
            <tbody>
            <?php for ($i=0; $i<count($list); $i++) { ?>
                <tr>
                    <td class="no"><?php echo count($list)-$i;?></td>
                    <td class="cat"><?php echo $list[$i]['cat'];?></td>
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