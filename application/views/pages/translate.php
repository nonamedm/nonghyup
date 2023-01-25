<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php
$list = [
    0=>['no'=>10, 'cat'=>'외부감사법', 'part'=>'금융위원회', 'date'=>'22/02/24', 'tit'=>'행정규제기본법에 따른 일몰규제 정비를...']
    ,1=>['no'=>9, 'cat'=>'전자금융거래법', 'part'=>'금융위원회', 'date'=>'22/01/13', 'tit'=>'액화석유가스의 안전관리 및 사업법 시행령']
    ,2=>['no'=>8, 'cat'=>'전자금융거래법', 'part'=>'금융위원회', 'date'=>'21/11/25', 'tit'=>'가축분뇨의 관리 및 이용에 관한 법률 시행규칙...']
    ,3=>['no'=>7, 'cat'=>'금산법', 'part'=>'금융위원회', 'date'=>'21/11/25', 'tit'=>'해양경찰장비 도입 및 관리에 관한 법률 시행규칙...']
    ,4=>['no'=>6, 'cat'=>'대부업법', 'part'=>'금융위원회', 'date'=>'21/11/25', 'tit'=>'상표법 시행규칙 일부개정령안']
    ,5=>['no'=>5, 'cat'=>'자본시장법', 'part'=>'금융위원회', 'date'=>'21/11/25', 'tit'=>'특허법 시행규칙 일부개정령안']
    ,6=>['no'=>4, 'cat'=>'자본시장법', 'part'=>'금융위원회', 'date'=>'21/11/25', 'tit'=>'경찰 수사에 관한 인권보호 규칙 제정령안']
    ,7=>['no'=>3, 'cat'=>'자본시장법', 'part'=>'금융위원회', 'date'=>'21/11/25', 'tit'=>'실용신안법 시행규칙 일부개정령안']
    ,8=>['no'=>2, 'cat'=>'전자금융거래법', 'part'=>'금융위원회', 'date'=>'21/11/25', 'tit'=>'산림기술 진흥 및 관리에 관한 법률 시행규칙...']
    ,9=>['no'=>1, 'cat'=>'자본시장법', 'part'=>'금융위원회', 'date'=>'21/11/25', 'tit'=>'임업·산림 공익기능 증진을 위한 직접지불제도...']
];
?>
<!-- content start -->
<div class="cont_body">

    <div class="left_menu">
        <img src="/static/svg/left_menu.svg">
    </div>

    <div class="right_cont">
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
                        <td class="tit"><a href="#"><?php echo $list[$i]['tit'];?></a><?php if($i<3) {?><img src="/static/svg/new.svg" class="new"><?php } ?></td>
                        <td class="part"><?php echo $list[$i]['part'];?></td>
                        <td class="date"><?php echo $list[$i]['date'];?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

        <?php $this->load->view("inc/brd_pgntn"); ?>
    </div>

</div>
<!-- content end -->