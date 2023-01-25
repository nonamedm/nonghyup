<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php
$list = [
    0=>['no'=>10, 'date'=>'22/05/01', 'part'=>'금융위원회', 'tit'=>'판교에 IT 투자 자문 몰려…"플랫폼 규제"가 이슈될 것']
    ,1=>['no'=>9, 'date'=>'22/05/01', 'part'=>'금융위원회', 'tit'=>'대한상의 "韓기업, 러시아 제재로 채무불이행 위험↑… 면책조항 추가해야"']
    ,2=>['no'=>8, 'date'=>'22/05/01', 'part'=>'금융위원회', 'tit'=>'미국만? 유럽·일본·호주發 "경제제재"도 韓기업 피해 우려']
    ,3=>['no'=>7, 'date'=>'22/05/01', 'part'=>'금융위원회', 'tit'=>'해양경찰장비 도입 및 관리에 관한 법률 시행규칙 제정령안']
    ,4=>['no'=>6, 'date'=>'22/05/01', 'part'=>'금융위원회', 'tit'=>'상표법 시행규칙 일부개정령안']
    ,5=>['no'=>5, 'date'=>'22/05/01', 'part'=>'금융감독원', 'tit'=>'특허법 시행규칙 일부개정령안']
    ,6=>['no'=>4, 'date'=>'22/05/01', 'part'=>'금융감독원', 'tit'=>'경찰 수사에 관한 인권보호 규칙 제정령안']
    ,7=>['no'=>3, 'date'=>'22/05/01', 'part'=>'금융감독원', 'tit'=>'실용신안법 시행규칙 일부개정령안']
    ,8=>['no'=>2, 'date'=>'22/05/01', 'part'=>'금융감독원', 'tit'=>'산림기술 진흥 및 관리에 관한 법률 시행규칙 일부개정령안']
    ,9=>['no'=>1, 'date'=>'22/05/01', 'part'=>'금융감독원', 'tit'=>'임업·산림 공익기능 증진을 위한 직접지불제도 운영에 관한 법률 시행규칙 ...']
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
                    <td class="tit"><a href="#"><?php echo $list[$i]['tit'];?></a><?php if($i<4) {?><img src="/static/svg/new.svg" class="new"><?php } ?></td>
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