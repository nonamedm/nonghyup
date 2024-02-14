<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Alert 띄우기
 */
if ( ! function_exists('alert')) {
    function alert($msg = '', $url = '')
    {
        if (empty($msg)) {
            $msg = '잘못된 접근입니다';
        }
        echo '<meta http-equiv="content-type" content="text/html; charset=UTF-8">';
        echo '<script type="text/javascript">alert("' . $msg . '");';
        if (empty($url)) {
            echo 'history.go(-1);';
        }
        if ($url) {
            echo 'document.location.href="' . $url . '"';
        }
        echo '</script>';
        exit;
    }
}


/*
 * ----------------------------------------
 * Alert 후 창 닫음
 * ----------------------------------------
 */
if ( ! function_exists('alert_close')) {
    function alert_close($msg = '')
    {
        if (empty($msg)) {
            $msg = '잘못된 접근입니다';
        }
        echo '<meta http-equiv="content-type" content="text/html; charset=UTF-8">';
        echo '<script type="text/javascript"> alert("' . $msg . '"); window.close(); </script>';
        exit;
    }
}





function getLink($seg, $m_id, $mode, $idx="", $pg=""){
    $link = "/";

    // ***** 1.seg
    if( $seg )
    {
        $link .= $seg;
    }

    // ***** 2.m_id
    if( $m_id )
    {
        $link .= "/".$m_id;
    }

    // ***** 3.mode
    if( $mode )
    {
        $link .= "/".$mode;
    }



    // ***** 4.idx
    if( $idx )
    {
        $link .= getDelimiter($link)."idx=".$idx;
    }

    // ***** 5.pg
    if( $pg )
    {
        $link .= getDelimiter($link)."pg=".$pg;
    }

    return $link;
}


function getDelimiter($link){
    if(strpos($link, '?') !== false)
    {
        $rtn = '&';
    }else{
        $rtn = '?';
    }
    return $rtn;
}


function trans_idToNm($_id){
    $rtn;
    if($_id){
        if ($_id == 'brief') {
            $rtn = "Legal Brief";
        } else if ($_id == 'lawmaking') {
            $rtn = "입법동향";
        } else if ($_id == 'pr') {
            $rtn = "보도자료";
        } else if ($_id == 'current') {
            $rtn = "현행법령";
        } else if ($_id == 'news') {
            $rtn = "NEWS";
        } else if ($_id == 'labdata') {
            $rtn = "연구자료";
        } else if ($_id == 'edudata') {
            $rtn = "세미나자료";
        } else if ($_id == 'translate') {
            $rtn = "법령해석";
        } else if ($_id == 'noaction') {
            $rtn = "비조치의견서";
        } else if ($_id == 'precedent') {
            $rtn = "금융판례";
        } else if ($_id == 'personnelTrends') {
            $rtn = "입법동향";
        } else if ($_id == 'intnlctrl') {
            $rtn = "내부통제";
        } else if ($_id == 'governance') {
            $rtn = "지배구조법";
        } else if ($_id == 'finnaccexp') {
            $rtn = "금융사고사례";
        } else if ($_id == 'prevmnlaun1') {
            $rtn = "국내제재사례";
        } else if ($_id == 'prevmnlaun2') {
            $rtn = "국외제재사례";
        } else if ($_id == 'prevmnlaun3') {
            $rtn = "정부보도자료";
        } else if ($_id == 'prevmnlaun4') {
            $rtn = "NEWS";
        } else if ($_id == 'prevmnlaun5') {
            $rtn = "AML BRIEF";
        } else if ($_id == 'sanctions') {
            $rtn = "금융제재사례";
        } else if ($_id == 'relateSite') {
            $rtn = "유용한사이트";
        }else {
            $rtn = "";
        }
    }else{
        log_message("ERROR", "basic_helper -> trans_idToNm : _id 값이 전달되지 않았습니다.");
    }
    return $rtn;
}

function trans_nmToId($_id){
    $rtn;
    if($_id){
        if ($_id == '현대중공업그룹') {
            $rtn = "HHIG";
        } else if ($_id == '현대중공업') {
            $rtn = "HHI";
        } else if ($_id == '한국조선해양') {
            $rtn = "KSOE";
        } else if ($_id == '현대미포조선') {
            $rtn = "HMD";
        } else if ($_id == '현대삼호중공업') {
            $rtn = "HSHI";
        } else {
            $rtn = "";
        }
    }else{
        log_message("ERROR", "basic_helper -> trans_idToNm : _id 값이 전달되지 않았습니다.");
    }
    return $rtn;
}

function get_cat2_arr($cat1='common') {
    $cat_arr=[];
    if($cat1=='common') {
        $cat_arr = [
            ['c000','공적자금관리특별법 및 관련규정'],
            ['c001','금융규제 운영규정'],
            ['c002','공적자금상환기금법 및 관련규정'],
            ['c003','금융위원회의설치등에관한법률 및 관련규정'],
            ['c004','금융기관부실자산등의효율적처리및한국자산관리공사의설립에관한법률 및 관련규정'],
            ['c005','금융산업의구조개선에관한법률 및 관련규정'],
            ['c006','금융실명거래및비밀보장에관한법률 및 관련규정'],
            ['c007','금융지주회사법 및 관련규정'],
            ['c008','금융회사의 지배구조에 관한 법률 및 관련규정'],
            ['c009','기업구조조정촉진법 및 관련규정'],
            ['c010','기업구조조정투자회사법 및 관련규정'],
            ['c011','산업발전법 및 관련규정'],
            ['c012','신용정보의 이용 및 보호에 관한 법률 및 관련규정'],
            ['c013','예금자보호법 및 관련규정'],
            ['c014','외국환거래법 및 관련규정'],
            ['c015','특정금융거래정보의보고및이용등에관한법률 및 관련규정'],
            ['c016','기타감독규정'],
            ['c017','공공기관의정보공개에관한법률 및 관련규정'],
            ['c018','개인정보보호법'],
            ['c019','근로자퇴직급여보장법 및 관련규정'],
            ['c020','전자금융거래법'],
            ['c021','공중 등 협박목적을 위한 자금조달행위의 금지에 관한 법률 및 관련 규정'],
            ['c022','채권의 공정한 추심에 관한 법률 및 관련 규정'],
            ['c023','보증인 보호를 위한 특별법 및 관련 규정'],
            ['c024','채무자 회생 및 파산에 관한 법률 및 관련 규정'],
            ['c025','금융중심지의 조성과 발전에 관한 법률 및 관련 규정'],
            ['c026','금융감독원 특별사법경찰관리 집무규칙'],
            ['c027','금융혁신지원특별법'],
            ['c028','금융거래지표의 관리에 관한 법률'],
            ['c029','금융소비자 보호에 관한 법률'],
            ['c030','금융복합기업집단의 감독에 관한 법률']
        ];
    }else if($cat1=='bank'){
        $cat_arr = [
            ['c100','은행법 및 관련규정'],
            ['c101','농업협동조합법 및 관련규정'],
            ['c102','담보부사채신탁법 및 관련규정'],
            ['c103','수산업협동조합법 및 관련규정'],
            ['c104','기술보증기금법 및 관련규정'],
            ['c105','신용보증기금법 및 관련규정'],
            ['c106','중소기업은행법 및 관련규정'],
            ['c107','한국산업은행법 및 관련규정'],
            ['c108','한국수출입은행법 및 관련규정'],
            ['c109','한국은행법 및 관련규정'],
            ['c110','한국주택금융공사법 및 관련규정'],
            ['c111','인터넷전문은행 설립 및 운영에 관한 특례법 및 관련규정']
        ];
    }else if($cat1=='investment'){
        $cat_arr = [
            ['c200','자본시장과금융투자업에관한법률 및 관련규정'],
            ['c201','공인회계사법 및 관련규정'],
            ['c202','자산유동화에관한법률 및 관련규정'],
            ['c203','주식회사 등의 외부감사에 관한 법률 및 관련규정']
        ];
    }else if($cat1=='microfinance'){
        $cat_arr = [
            ['c300','산림조합법 및 관련규정'],
            ['c301','상호저축은행법 및 관련규정'],
            ['c302','신용협동조합법 및 관련규정'],
            ['c303','여신전문금융업법 및 관련규정'],
            ['c304','유사수신행위의규제에관한법률 및 관련규정'],
            ['c305','대부업등의등록및금융이용자보호에관한법률 및 관련규정'],
            ['c306','전기통신금융사기 피해방지 및 피해금 환급에 관한 특별법 및 관련규정'],
            ['c307','서민의금융생활지원에관한법률 및 관련규정'],
            ['c308','온라인투자연계금융업 및 이용자 보호에 관한 법률']
        ];
    }
    return $cat_arr;
}



function get_agree_cat($_id){
    $rtn;
    if($_id){
        if($_id=='terms'){
            $rtn = "이용약관";
        }else if($_id=='pri'){
            $rtn = "개인정보보호정책";
        }else if($_id=='copy'){
            $rtn = "저작권정책";
        }
    }
    return $rtn;
}

function get_label_new($_dtms){
    $rtn='';
    if (time() - strtotime($_dtms) <= 60 * 60 * 24 * 14) {
        $rtn = '<img src="/static/svg/new.svg" class="new">';
    }
    return $rtn;
}


?>