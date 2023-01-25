<?php defined('BASEPATH') OR exit('No direct script access allowed');



function get_form_arr()
{
    // ***** 리턴 배열
    $form_arr = array(
        'post_subj' => array(
            'label'         => array('제목', 'Subject')
        ,'placeholder'  => array('제목을 입력하세요', 'Subject')
        )
    ,'post_cont' => array(
            'label' => array('내용','Content')
        ,'placeholder' => array('내용을 입력하세요', 'Content')
        )
    ,'usr_representation' => array(
            'label' => array('대표사', 'Representative')
        ,'placeholder' => array('', '')
        )
    ,'usr_id' => array(
            'label' => array('ID(이메일)', 'ID(Email Address)')
        ,'placeholder' => array('이메일주소 형식', 'email address format')
        )
    ,'usr_pin' => array(
            'label' => array('고유번호', 'Identification number')
        ,'placeholder' => array('A-Z', '0-9')
        )
    ,'usr_chk_dupl' => array(
            'label' => array('중복검사', 'Check Duplication')
        ,'placeholder' => array('', '')
        )
    ,'usr_status' => array(
            'label' => array('등록상태', 'Registration Statue')
        ,'placeholder' => array('', '')
        )
    ,'usr_pw' => array(
            'label' => array('비밀번호', 'Password')
        ,'placeholder' => array('영문/숫자/특수문자 포함:6~15자', 'English/Numbers/special characters: 6 ~ 15 characters')
        )
    ,'usr_pw_confirm' => array(
            'label' => array('비밀번호 확인', 'Password Confirm')
        ,'placeholder' => array('영문/숫자/특수문자 포함:6~15자', 'English/Numbers/special characters: 6 ~ 15 characters')
        )
    ,'usr_nm' => array(
            'label' => array('대표자 성명', 'Name')
        ,'placeholder' => array('', 'Name of company representative')
        )
    ,'usr_nm_lst' => array(
            'label' => array('성', 'Last Name')
        ,'placeholder' => array('', '')
        )
    ,'usr_nm_frst' => array(
            'label' => array('이름', 'First Name')
        ,'placeholder' => array('', '')
        )
    ,'usr_tel_num' => array(
            'label' => array('전화번호', 'Phone number')
        ,'placeholder' => array('', '')
        )
    ,'usr_mbl_num' => array(
            'label' => array('대표연락처', 'Primary contact number')
        ,'placeholder' => array('', '')
        )
    ,'usr_org_nm' => array(
            'label' => array('회사명', 'Company')
        ,'placeholder' => array('', 'Company name')
        )
    ,'usr_license' => array(
            'label' => array('자격 및 면허', 'License/permit')
        ,'placeholder' => array('ex)건축사사무소(서울종로 제0000호)', 'e.g. Architectural firm (#0000 in Jongno, Seoul)')
        )
    ,'usr_file' => array(
            'label' => array('사업자 등록증', 'Business Registration')
        ,'placeholder' => array('파일선택', 'Select file')
        )
    ,'usr_zip_find' => array(
            'label' => array(' ', ' ')
        ,'placeholder' => array('', '')
        )
    ,'usr_zip' => array(
            'label' => array('(주소)우편번호', '(Address) Zip code')
        ,'placeholder' => array('', '')
        )
    ,'usr_addr' => array(
            'label' => array('주소', 'Address')
        ,'placeholder' => array('', '')
        )
    ,'usr_address' => array(
            'label' => array('(주소)상세', '(Address) Detail')
        ,'placeholder' => array('', '')
        )
    ,'usr_nat' => array(
            'label' => array('(주소)국가', '(Address) Country')
        ,'placeholder' => array('KOREA, REPUBLIC OF', 'KOREA, REPUBLIC OF')
        )
    ,'usr_agr1_dtms' => array(
            'label' => array('본 참가사(팀)는 한국토지주택공사에서 주최하는 「3기 신도시 기본구상 및 입체적 도시공간계획 국제공모(첫마을 시범단지 포함)」의 공모지침을 준수하여 참가할 것을 신청합니다.', 'The applicant (team) agrees to abide by the guidelines for “THE INTERNATIONAL COMPETITION FOR URBAN DESIGN CONCEPT AND MULTI-DIMENSIONAL URBAN AND ARCHITECTURAL SPACE PLAN FOR THE 3RD GENERATION NEW TOWNS (INCLUDING A  DEMONSTRATION PROJECT FOR THE FIRST VILLAGE)”by Korea Land & Housing Corporation.')
        ,'placeholder' => array('', '')
        )
    ,'usr_agr2_dtms' => array(
            'label' => array('본 참가사(팀)는 위의 사항이 틀림없음을 확인하며, 추후 작품제출 시 제출하는 구비서류의 허위기재, 불공정 행위 등으로 인하여 발생하는 불이익 처분에 어떠한 이의도 제기하지 않을 것을 서약합니다.', 'The applicant (team) certifies that the information submitted in this application is true and correct. The applicant (team) understands that any false statement or unjust activity in the submission process may result in disadvantage.')
        ,'placeholder' => array('', '')
        )
    ,'usr_agr3_dtms' => array(
            'label' => array('본 참가사(팀)는 제출작품의 복사, 출판, 홍보, 전시 등의 목적으로 주최자가 사용함에 동의합니다.', 'The applicant (team) agrees that submitted documents/materials can be copied, published, displayed, or used for marketing purposes by Korea Land & Housing Corporation. ')
        ,'placeholder' => array('', '')
        )
    ,'usr_agr4_dtms' => array(
            'label' => array('본 참가사(팀)는 주최 측에서 제공받은 공모 관련 자료를 외부로 유출하지 않을 것을 서약합니다.', 'The applicant (team) certifies that it will not disclose any material received from Korea Land & Housing Corporation that is relevant with project application.')
        ,'placeholder' => array('', '')
        )
    ,'usr_add_member' => array(
            'label' => array('공동응모업체', 'Team Members')
        ,'placeholder' => array('', '')
        )
    ,'files' => array(
            'label' => array('첨부파일', 'File')
        ,'placeholder' => array('첨부파일 찾기', 'Select File')
        )
    ,'usr_qna_tit' => array(
            'label' => array('나의 질의내역', 'My Query')
        ,'placeholder' => array('', '')
        )
    ,'usr_dnload_tit' => array(
            'label' => array('다운로드', 'My Download')
        ,'placeholder' => array('', '')
        )
    ,'dst_tit' => array(
            'label' => array('참가대상 지구', 'Site')
        ,'placeholder' => array('', '')
        )
    ,'team_info' => array(
            'label' => array('응모팀 정보', 'Team Information')
        ,'placeholder' => array('', '')
        )
    ,'sel_dist' => array(
            'label' => array('지구 선택', 'Choose your site')
        ,'placeholder' => array('', '')
        )
    ,'sel_pin' => array(
            'label' => array('고유번호 선택', 'Choose your identification number')
        ,'placeholder' => array('', '')
        )
    ,'is_pin' => array(
            'label' => array('고유번호란', 'What is an identification number')
        ,'placeholder' => array('', '')
        )
    ,'search' => array(
            'label' => array('검색', 'Search')
        ,'placeholder' => array('', '')
        )
    ,'max_member' => array(
            'label' => array('※ 공동응모(컨소시엄) 시 참여업체 수는 최대 6개 이내', '* Please note that the number of team members cannot exceed six.')
        ,'placeholder' => array('', '')
        )
    ,'id_guide' => array(
            'label' => array('* 등록시 사용하는 이메일은 공모기간 중 주요사항을 전달할 수 있으므로, 자주 확인가능한 메일을 사용하여 주십시오.', '* Please enter an email address that you know you can access often since this email address will be used to receive important information during application period.')
        ,'placeholder' => array('', '')
        )
    ,'phone_guide' => array(
            'label' => array('* 주요 알림을 받을 수 있는 주담당자의 핸드폰 번호를 작성하여 주십시오.', '* Please enter mobile number that belongs to person in charge who can receive important information.')
        ,'placeholder' => array('', '')
        )
    ,'rep_guide' => array(
            'label' => array('* 대표사자격으로는 중복참가가 불가하며, 공동참여사로는 중복참가 가능', '* You cannot apply multiple times as a representative, but you can apply multiple times as a team member.')
        ,'placeholder' => array('', '')
        )
    ,'sel' => array(
            'label' => array('선택', 'Select')
        ,'placeholder' => array('', '')
        )
    ,'site_A' => array(
            'label' => array('고양 창릉', 'Changleung, Goyang')
        ,'placeholder' => array('', '')
        )
    ,'site_B' => array(
            'label' => array('부천 대장', 'Daejang, Bucheon')
        ,'placeholder' => array('', '')
        )
    ,'rep_warn' => array(
            'label' => array('※ 대표사는 등록 이후 수정 불가', '※ Once application has been submitted, consortium organizer information cannot be changed.')
        ,'placeholder' => array('', '')
        )
    ,'logged_in' => array(
            'label' => array('현재 로그인상태 입니다', 'You are currently logged in')
        ,'placeholder' => array('', '')
        )



    );
    return $form_arr;
}

/*
 * ------------------------------
 * F O R M - brd_unit
 * ------------------------------
 * 'lng_cd'     : 언어 cd
 * 'lng_idx'    : 언어 inx
 * 'form_mode'  : 작성모드
 * 'form_typ'   : bbs, auth
 *
 * 'input_id'   : input id
 * 'input_val'  : input value
 * 'input_typ'  : text, hidden, password, checkbox, radio
 * 'form_tag'   : input, textarea, select
 * 'form_txt'   : array(label, placeholder)
 * ------------------------------
*/
function get_form( $form_common, $form_custom )
{
    $rtn = "";
    $_lng_idx = $form_common['lng_idx'];

    // ***** 변수
    $cls_input = " uk-input ";
    $cls_textarea = " uk-textarea ";
    $cls_select = " uk-select uk-margin-remove-left uk-margin-remove-right";
    $cls_form_label = " uk-form-label label ";
    $cls_form_controls = " uk-form-controls ";
    $cls_form_controls_1_1 = " uk-form-controls uk-width-1-1 ";

    // write모드시 value=''
    if( $form_common['form_mode']=='write' )
    {
        $form_custom['input_val']="";
    }

    $label = ' ';
    if( isset($form_custom['form_txt']['label'][$_lng_idx]) && $form_custom['form_txt']['label'][$_lng_idx] )
    {
        $label = $form_custom['form_txt']['label'][$_lng_idx];
    }

    $placeholder = '';
    if( isset($form_custom['form_txt']['placeholder'][$_lng_idx]) && $form_custom['form_txt']['placeholder'][$_lng_idx] )
    {
        $placeholder = $form_custom['form_txt']['placeholder'][$_lng_idx];
    }


    /*
     * ----------------------------------------
     * I F - A U T H
     * ----------------------------------------
    */
    if( $form_common['form_typ']=='auth' )
    {
        // ***** 공통
        $rtn .= '<label class="'.$cls_form_label.'">'.$label.'</label>';
        $rtn .= '<div class="'.$cls_form_controls.'">';


        switch ( $form_custom['form_tag'] )
        {
            case 'input':
                $rtn .= '<input ';
                $rtn .= ' class="'.$cls_input.'" ';
                $rtn .= ' type="'.$form_custom['input_typ'].'" ';
                if( $form_custom['input_id']!='usr_pw_confirm' ){ // 비밀번호 확인은 name값 제외
                    $rtn .= ' name="'.$form_custom['input_id'].'" ';
                }
                $rtn .= ' id="'.$form_custom['input_id'].'" ';
                $rtn .= ' placeholder="'.$placeholder.'" ';
                $rtn .= ' value="'.$form_custom['input_val'].'" ';
                $rtn .= '>';
                break;

            case 'textarea':
                $rtn .= '<textarea ';
                $rtn .= ' class="'.$cls_textarea.'" ';
                $rtn .= ' name="'.$form_custom['input_name'].'" ';
                $rtn .= ' id="'.$form_custom['input_id'].'" ';
                $rtn .= ' rows="10" ';
                $rtn .= '>';
                $rtn .= $form_custom['input_val'];
                $rtn .= '</textarea>';
                break;

            case 'select':

                $rtn .= '<select ';
                $rtn .= ' class="'.$cls_select.'" ';
                $rtn .= '>';
                $rtn .= '<option>'.$placeholder.'</option>';
                $rtn .= get_code( $form_custom['input_typ'] );
                $rtn .= '</select>';
                $rtn .= '<input type="hidden" id="'.$form_custom['input_id'].'"';
                if( $form_custom['input_name'] ){
                    $rtn .= 'name="'.$form_custom['input_name'].'"';
                }
                $rtn .= 'value="'.$form_custom['input_val'].'">';
                break;

            default:

        }

        // 공통
        $rtn .= '</div>';

        /*
         * ----------------------------------------
         * E L S E - B B S
         * ----------------------------------------
        */
    }
    else if( $form_common['form_typ']=='bbs' )
    {
        // 공통
        $rtn .= '<label class="'.$cls_form_label.'">'.$label.'</label>';
        $rtn .= '<div class="'.$cls_form_controls.'">';


        // 아이디
        switch ( $form_custom['form_tag'] )
        {
            case 'input':
                $rtn .= '<input ';
                $rtn .= ' class="'.$cls_input.'" ';
                $rtn .= ' type="'.$form_custom['input_typ'].'" ';
                $rtn .= ' name="'.$form_custom['input_id'].'" ';
                $rtn .= ' id="'.$form_custom['input_id'].'" ';
                $rtn .= ' placeholder="'.$placeholder.'" ';
                $rtn .= ' value="'.$form_custom['input_val'].'" ';
                $rtn .= '>';
                break;

            case 'textarea':
                $rtn .= '<textarea ';
                $rtn .= ' class="'.$cls_textarea.'" ';
                $rtn .= ' name="'.$form_custom['input_id'].'" ';
                $rtn .= ' id="'.$form_custom['input_id'].'" ';
                $rtn .= ' rows="10" ';
                $rtn .= '>';
                $rtn .= $form_custom['input_val'];
                $rtn .= '</textarea>';
                break;

            default:
        }

        // 공통
        $rtn .= '</div>';
    }
    return $rtn;
}




// 라벨값을 리턴
function get_label( $params=array() )
{
    $form_arr = get_form_arr();
    $rtn = "";
    for( $i=0; $i<count($form_arr); $i++ )
    {
        if( $form_arr[ $params['cd'] ] )
        {
            $rtn = $form_arr[ $params['cd'] ]['label'][ $params['lng_idx'] ];
            break;
        }
    }
    return $rtn;
}


// 라벨값을 리턴
function get_placeholder( $params=array() )
{
    $form_arr = get_form_arr();
    $rtn = "";
    for( $i=0; $i<count($form_arr); $i++ )
    {
        if( $form_arr[ $params['cd'] ] )
        {
            $rtn = $form_arr[ $params['cd'] ]['placeholder'][ $params['lng_idx'] ];
            break;
        }
    }
    return $rtn;
}


function get_input( $params=array() )
{
    $form_arr = get_form_arr();
    $rtn = "";
    for( $i=0; $i<count($form_arr); $i++ )
    {
        if($form_arr[ $params['cd'] ])
        {
            // input start
            $rtn = '<input ';

            // class
            $rtn .= ' class="uk-input ';
            if( $form_arr[ $params['cd'] ]['class'] ){
                $rtn .= $form_arr[ $params['cd'] ]['class'];
            }
            $rtn .= '"';

            // type
            if( $form_arr[ $params['cd'] ]['type'] ){
                $rtn .= ' type="'.$form_arr[ $params['cd'] ]['type'].'" ';
            }else{
                $rtn .= ' type="text" ';
            }

            // name
            if( $form_arr[ $params['cd'] ]['name'] ){
                $rtn .= ' name="'.$form_arr[ $params['cd'] ]['name'].'" ';
            }else{
                $rtn .= ' name=""';
            }

            // id
            if( $form_arr[ $params['cd'] ]['id'] ){
                $rtn .= ' id="'.$form_arr[ $params['cd'] ]['id'].'" ';
            }else{
                $rtn .= ' id=""';
            }

            // placeholder
            if( $form_arr[ $params['cd'] ]['placeholder'] ){
                $rtn .= ' placeholder="'.$form_arr[ $params['cd'] ]['placeholder'][ $params['lng_idx'] ].'" ';
            }else{
                $rtn .= ' placeholder=""';
            }

            // value
            if( $form_arr[ $params['cd'] ]['value'] ){
                $rtn .= ' value="'.$form_arr[ $params['cd'] ]['value'].'" ';
            }else{
                $rtn .= ' value=""';
            }

            // input end
            $rtn .= '>';
            break;
        }
    }
    return $rtn;

}





function get_code($typ){
    $rtn = '';
    if( $typ=='alphabet' )
    {
        $rtn .= '<option value="A">A</option>';
        $rtn .= '<option value="B">B</option>';
        $rtn .= '<option value="C">C</option>';
        $rtn .= '<option value="D">D</option>';
        $rtn .= '<option value="E">E</option>';
        $rtn .= '<option value="F">F</option>';
        $rtn .= '<option value="G">G</option>';
        $rtn .= '<option value="H">H</option>';
        $rtn .= '<option value="I">I</option>';
        $rtn .= '<option value="J">J</option>';
        $rtn .= '<option value="K">K</option>';
        $rtn .= '<option value="L">L</option>';
        $rtn .= '<option value="M">M</option>';
        $rtn .= '<option value="N">N</option>';
        $rtn .= '<option value="O">O</option>';
        $rtn .= '<option value="P">P</option>';
        $rtn .= '<option value="Q">Q</option>';
        $rtn .= '<option value="R">R</option>';
        $rtn .= '<option value="S">S</option>';
        $rtn .= '<option value="T">T</option>';
        $rtn .= '<option value="U">U</option>';
        $rtn .= '<option value="V">V</option>';
        $rtn .= '<option value="W">W</option>';
        $rtn .= '<option value="X">X</option>';
        $rtn .= '<option value="Y">Y</option>';
        $rtn .= '<option value="Z">Z</option>';
    }
    else if( $typ=='number' )
    {
        $rtn .= '<option value="0">0</option>';
        $rtn .= '<option value="1">1</option>';
        $rtn .= '<option value="2">2</option>';
        $rtn .= '<option value="3">3</option>';
        $rtn .= '<option value="4">4</option>';
        $rtn .= '<option value="5">5</option>';
        $rtn .= '<option value="6">6</option>';
        $rtn .= '<option value="7">7</option>';
        $rtn .= '<option value="8">8</option>';
        $rtn .= '<option value="9">9</option>';
    }
    else if( $typ=='usr_nat' )
    {
        $rtn .= '<option value="GHANA">GHANA</option>';
        $rtn .= '<option value="GABON">GABON</option>';
        $rtn .= '<option value="GUYANA">GUYANA</option>';
        $rtn .= '<option value="GAMBIA">GAMBIA</option>';
        $rtn .= '<option value="GUERNSEY">GUERNSEY</option>';
        $rtn .= '<option value="GUADELOUPE">GUADELOUPE</option>';
        $rtn .= '<option value="GUATEMALA">GUATEMALA</option>';
        $rtn .= '<option value="GUAM">GUAM</option>';
        $rtn .= '<option value="GRENADA">GRENADA</option>';
        $rtn .= '<option value="GREECE">GREECE</option>';
        $rtn .= '<option value="GREENLAND">GREENLAND</option>';
        $rtn .= '<option value="GUINEA">GUINEA</option>';
        $rtn .= '<option value="GUINEA-BISSAU">GUINEA-BISSAU</option>';
        $rtn .= '<option value="NAMIBIA">NAMIBIA</option>';
        $rtn .= '<option value="NAURU">NAURU</option>';
        $rtn .= '<option value="NIGERIA">NIGERIA</option>';
        $rtn .= '<option value="ANTARCTICA">ANTARCTICA</option>';
        $rtn .= '<option value="REPUBLIC OF SOUTH SUDAN">REPUBLIC OF SOUTH SUDAN</option>';
        $rtn .= '<option value="SOUTH AFRICA">SOUTH AFRICA</option>';
        $rtn .= '<option value="NETHERLANDS">NETHERLANDS</option>';
        $rtn .= '<option value="NETHERLANDS ANTILLES">NETHERLANDS ANTILLES</option>';
        $rtn .= '<option value="NEPAL">NEPAL</option>';
        $rtn .= '<option value="NORWAY">NORWAY</option>';
        $rtn .= '<option value="NORFOLK ISLAND">NORFOLK ISLAND</option>';
        $rtn .= '<option value="NEW CALEDONIA">NEW CALEDONIA</option>';
        $rtn .= '<option value="NEW ZEALAND">NEW ZEALAND</option>';
        $rtn .= '<option value="NIUE">NIUE</option>';
        $rtn .= '<option value="NIGER">NIGER</option>';
        $rtn .= '<option value="NICARAGUA">NICARAGUA</option>';
        $rtn .= '<option value="KOREA, REPUBLIC OF">KOREA, REPUBLIC OF</option>';
        $rtn .= '<option value="DENMARK">DENMARK</option>';
        $rtn .= '<option value="DOMINICAN REPUBLIC">DOMINICAN REPUBLIC</option>';
        $rtn .= '<option value="DOMINICA">DOMINICA</option>';
        $rtn .= '<option value="GERMANY">GERMANY</option>';
        $rtn .= '<option value="EAST TIMOR">EAST TIMOR</option>';
        $rtn .= '<option value="LAO PEOPLE′S DEMOCRATIC REPUBLIC">LAO PEOPLE′S DEMOCRATIC REPUBLIC</option>';
        $rtn .= '<option value="LIBERIA">LIBERIA</option>';
        $rtn .= '<option value="LATVIA">LATVIA</option>';
        $rtn .= '<option value="RUSSIAN FEDERATION">RUSSIAN FEDERATION</option>';
        $rtn .= '<option value="LEBANON">LEBANON</option>';
        $rtn .= '<option value="LESOTHO">LESOTHO</option>';
        $rtn .= '<option value="REUNION">REUNION</option>';
        $rtn .= '<option value="ROMANIA">ROMANIA</option>';
        $rtn .= '<option value="LUXEMBOURG">LUXEMBOURG</option>';
        $rtn .= '<option value="RWANDA">RWANDA</option>';
        $rtn .= '<option value="LIBYAN ARAB JAMAHIRIYA">LIBYAN ARAB JAMAHIRIYA</option>';
        $rtn .= '<option value="LITHUANIA">LITHUANIA</option>';
        $rtn .= '<option value="LIECHTENSTEIN">LIECHTENSTEIN</option>';
        $rtn .= '<option value="MADAGASCAR">MADAGASCAR</option>';
        $rtn .= '<option value="MARTINIQUE">MARTINIQUE</option>';
        $rtn .= '<option value="MARSHALL ISLANDS">MARSHALL ISLANDS</option>';
        $rtn .= '<option value="MAYOTTE">MAYOTTE</option>';
        $rtn .= '<option value="MACAU">MACAU</option>';
        $rtn .= '<option value="REPUBLIC OF MACEDONIA">REPUBLIC OF MACEDONIA</option>';
        $rtn .= '<option value="MALAWI">MALAWI</option>';
        $rtn .= '<option value="MALAYSIA">MALAYSIA</option>';
        $rtn .= '<option value="MALI">MALI</option>';
        $rtn .= '<option value="ISLE OF MAN">ISLE OF MAN</option>';
        $rtn .= '<option value="MEXICO">MEXICO</option>';
        $rtn .= '<option value="MONACO">MONACO</option>';
        $rtn .= '<option value="MOROCCO">MOROCCO</option>';
        $rtn .= '<option value="MAURITIUS">MAURITIUS</option>';
        $rtn .= '<option value="MAURITANIA">MAURITANIA</option>';
        $rtn .= '<option value="MOZAMBIQUE">MOZAMBIQUE</option>';
        $rtn .= '<option value="MONTENEGRO">MONTENEGRO</option>';
        $rtn .= '<option value="MONTSERRAT">MONTSERRAT</option>';
        $rtn .= '<option value="MOLDOVA, REPUBLIC OF">MOLDOVA, REPUBLIC OF</option>';
        $rtn .= '<option value="MALDIVES">MALDIVES</option>';
        $rtn .= '<option value="MALTA">MALTA</option>';
        $rtn .= '<option value="MONGOLIA">MONGOLIA</option>';
        $rtn .= '<option value="UNITED STATES">UNITED STATES</option>';
        $rtn .= '<option value="UNITED STATES MINOR OUTLYING ISLANDS">UNITED STATES MINOR OUTLYING ISLANDS</option>';
        $rtn .= '<option value="VIRGIN ISLANDS, U.S.">VIRGIN ISLANDS, U.S.</option>';
        $rtn .= '<option value="MYANMAR">MYANMAR</option>';
        $rtn .= '<option value="MICRONESIA">MICRONESIA</option>';
        $rtn .= '<option value="VANUATU">VANUATU</option>';
        $rtn .= '<option value="BAHRAIN">BAHRAIN</option>';
        $rtn .= '<option value="BARBADOS">BARBADOS</option>';
        $rtn .= '<option value="VATICAN CITY STATE">VATICAN CITY STATE</option>';
        $rtn .= '<option value="BAHAMAS">BAHAMAS</option>';
        $rtn .= '<option value="BANGLADESH">BANGLADESH</option>';
        $rtn .= '<option value="BERMUDA">BERMUDA</option>';
        $rtn .= '<option value="BENIN">BENIN</option>';
        $rtn .= '<option value="VENEZUELA">VENEZUELA</option>';
        $rtn .= '<option value="VIET NAM">VIET NAM</option>';
        $rtn .= '<option value="BELGIUM">BELGIUM</option>';
        $rtn .= '<option value="BELARUS">BELARUS</option>';
        $rtn .= '<option value="BELIZE">BELIZE</option>';
        $rtn .= '<option value="BOSNIA HERCEGOVINA">BOSNIA HERCEGOVINA</option>';
        $rtn .= '<option value="BOTSWANA">BOTSWANA</option>';
        $rtn .= '<option value="BOLIVIA">BOLIVIA</option>';
        $rtn .= '<option value="BURUNDI">BURUNDI</option>';
        $rtn .= '<option value="BURKINA FASO">BURKINA FASO</option>';
        $rtn .= '<option value="BOUVET ISLAND">BOUVET ISLAND</option>';
        $rtn .= '<option value="BHUTAN">BHUTAN</option>';
        $rtn .= '<option value="NORTHERN MARIANA ISLANDS">NORTHERN MARIANA ISLANDS</option>';
        $rtn .= '<option value="BULGARIA">BULGARIA</option>';
        $rtn .= '<option value="BRAZIL">BRAZIL</option>';
        $rtn .= '<option value="BRUNEI DARUSSALAM">BRUNEI DARUSSALAM</option>';
        $rtn .= '<option value="SAMOA">SAMOA</option>';
        $rtn .= '<option value="SAUDI ARABIA">SAUDI ARABIA</option>';
        $rtn .= '<option value="SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS">SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS</option>';
        $rtn .= '<option value="SAN MARINO">SAN MARINO</option>';
        $rtn .= '<option value="SAO TOME AND PRINCIPE">SAO TOME AND PRINCIPE</option>';
        $rtn .= '<option value="ST. PIERRE AND MIQUELON">ST. PIERRE AND MIQUELON</option>';
        $rtn .= '<option value="WESTERN SAHARA">WESTERN SAHARA</option>';
        $rtn .= '<option value="SENEGAL">SENEGAL</option>';
        $rtn .= '<option value="SERBIA">SERBIA</option>';
        $rtn .= '<option value="SEYCHELLES">SEYCHELLES</option>';
        $rtn .= '<option value="SAINT LUCIA">SAINT LUCIA</option>';
        $rtn .= '<option value="SAINT VINCENT AND THE GRENADINES">SAINT VINCENT AND THE GRENADINES</option>';
        $rtn .= '<option value="SAINT KITTS AND NEVIS">SAINT KITTS AND NEVIS</option>';
        $rtn .= '<option value="ST. HELENA">ST. HELENA</option>';
        $rtn .= '<option value="SOMALIA">SOMALIA</option>';
        $rtn .= '<option value="SOLOMON ISLANDS">SOLOMON ISLANDS</option>';
        $rtn .= '<option value="SUDAN">SUDAN</option>';
        $rtn .= '<option value="SURINAME">SURINAME</option>';
        $rtn .= '<option value="SRI LANKA">SRI LANKA</option>';
        $rtn .= '<option value="SVALBARD AND JAN MAYEN ISLANDS">SVALBARD AND JAN MAYEN ISLANDS</option>';
        $rtn .= '<option value="SWAZILAND">SWAZILAND</option>';
        $rtn .= '<option value="SWEDEN">SWEDEN</option>';
        $rtn .= '<option value="SWITZERLAND">SWITZERLAND</option>';
        $rtn .= '<option value="SPAIN">SPAIN</option>';
        $rtn .= '<option value="SLOVAKIA">SLOVAKIA</option>';
        $rtn .= '<option value="SLOVENIA">SLOVENIA</option>';
        $rtn .= '<option value="SYRIAN ARAB REPUBLIC">SYRIAN ARAB REPUBLIC</option>';
        $rtn .= '<option value="SIERRA LEONE">SIERRA LEONE</option>';
        $rtn .= '<option value="SINGAPORE">SINGAPORE</option>';
        $rtn .= '<option value="UNITED ARAB EMIRATES">UNITED ARAB EMIRATES</option>';
        $rtn .= '<option value="ARUBA">ARUBA</option>';
        $rtn .= '<option value="ARMENIA">ARMENIA</option>';
        $rtn .= '<option value="ARGENTINA">ARGENTINA</option>';
        $rtn .= '<option value="AMERICAN SAMOA">AMERICAN SAMOA</option>';
        $rtn .= '<option value="ICELAND">ICELAND</option>';
        $rtn .= '<option value="HAITI">HAITI</option>';
        $rtn .= '<option value="IRELAND">IRELAND</option>';
        $rtn .= '<option value="AZERBAIJAN">AZERBAIJAN</option>';
        $rtn .= '<option value="AFGHANISTAN">AFGHANISTAN</option>';
        $rtn .= '<option value="ANDORRA">ANDORRA</option>';
        $rtn .= '<option value="ALBANIA">ALBANIA</option>';
        $rtn .= '<option value="ALGERIA">ALGERIA</option>';
        $rtn .= '<option value="ANGOLA">ANGOLA</option>';
        $rtn .= '<option value="ANTIGUA AND BARBUDA">ANTIGUA AND BARBUDA</option>';
        $rtn .= '<option value="ANGUILLA">ANGUILLA</option>';
        $rtn .= '<option value="ERITREA">ERITREA</option>';
        $rtn .= '<option value="ESTONIA">ESTONIA</option>';
        $rtn .= '<option value="ECUADOR">ECUADOR</option>';
        $rtn .= '<option value="ETHIOPIA">ETHIOPIA</option>';
        $rtn .= '<option value="EL SALVADOR">EL SALVADOR</option>';
        $rtn .= '<option value="UNITED KINGDOM">UNITED KINGDOM</option>';
        $rtn .= '<option value="VIRGIN ISLANDS, BRITISH">VIRGIN ISLANDS, BRITISH</option>';
        $rtn .= '<option value="BRITISH INDIAN OCEAN TERRITORY">BRITISH INDIAN OCEAN TERRITORY</option>';
        $rtn .= '<option value="YEMEN, REPUBLIC OF">YEMEN, REPUBLIC OF</option>';
        $rtn .= '<option value="OMAN">OMAN</option>';
        $rtn .= '<option value="AUSTRALIA">AUSTRALIA</option>';
        $rtn .= '<option value="AUSTRIA">AUSTRIA</option>';
        $rtn .= '<option value="HONDURAS">HONDURAS</option>';
        $rtn .= '<option value="ALAND ISLANDS">ALAND ISLANDS</option>';
        $rtn .= '<option value="WALLIS AND FUTUNA ISLANDS">WALLIS AND FUTUNA ISLANDS</option>';
        $rtn .= '<option value="JORDAN">JORDAN</option>';
        $rtn .= '<option value="UGANDA">UGANDA</option>';
        $rtn .= '<option value="URUGUAY">URUGUAY</option>';
        $rtn .= '<option value="UZBEKISTAN">UZBEKISTAN</option>';
        $rtn .= '<option value="UKRAINE">UKRAINE</option>';
        $rtn .= '<option value="IRAQ">IRAQ</option>';
        $rtn .= '<option value="IRAN">IRAN</option>';
        $rtn .= '<option value="ISRAEL">ISRAEL</option>';
        $rtn .= '<option value="EGYPT">EGYPT</option>';
        $rtn .= '<option value="ITALY">ITALY</option>';
        $rtn .= '<option value="INDIA">INDIA</option>';
        $rtn .= '<option value="INDONESIA">INDONESIA</option>';
        $rtn .= '<option value="JAPAN">JAPAN</option>';
        $rtn .= '<option value="JAMAICA">JAMAICA</option>';
        $rtn .= '<option value="ZAMBIA">ZAMBIA</option>';
        $rtn .= '<option value="JERSEY">JERSEY</option>';
        $rtn .= '<option value="EQUATORIAL GUINEA">EQUATORIAL GUINEA</option>';
        $rtn .= '<option value="KOREA, DEMOCRATIC PEOPLE′S REPUBLIC OF">KOREA, DEMOCRATIC PEOPLE′S REPUBLIC OF</option>';
        $rtn .= '<option value="GEORGIA">GEORGIA</option>';
        $rtn .= '<option value="CENTRAL AFRICAN REPUBLIC">CENTRAL AFRICAN REPUBLIC</option>';
        $rtn .= '<option value="TAIWAN, PROVINCE OF CHINA">TAIWAN, PROVINCE OF CHINA</option>';
        $rtn .= '<option value="CHINA">CHINA</option>';
        $rtn .= '<option value="DJIBOUTI">DJIBOUTI</option>';
        $rtn .= '<option value="GIBRALTAR">GIBRALTAR</option>';
        $rtn .= '<option value="ZIMBABWE">ZIMBABWE</option>';
        $rtn .= '<option value="CHAD">CHAD</option>';
        $rtn .= '<option value="CZECH REPUBLIC">CZECH REPUBLIC</option>';
        $rtn .= '<option value="CHILE">CHILE</option>';
        $rtn .= '<option value="CAMEROON">CAMEROON</option>';
        $rtn .= '<option value="CAPE VERDE">CAPE VERDE</option>';
        $rtn .= '<option value="KAZAKHSTAN">KAZAKHSTAN</option>';
        $rtn .= '<option value="QATAR">QATAR</option>';
        $rtn .= '<option value="CAMBODIA">CAMBODIA</option>';
        $rtn .= '<option value="CANADA">CANADA</option>';
        $rtn .= '<option value="KENYA">KENYA</option>';
        $rtn .= '<option value="CAYMAN ISLANDS">CAYMAN ISLANDS</option>';
        $rtn .= '<option value="COMOROS">COMOROS</option>';
        $rtn .= '<option value="COSTA RICA">COSTA RICA</option>';
        $rtn .= '<option value="COCOS ISLANDS">COCOS ISLANDS</option>';
        $rtn .= '<option value="COTE D′IVOIRE">COTE D′IVOIRE</option>';
        $rtn .= '<option value="COLOMBIA">COLOMBIA</option>';
        $rtn .= '<option value="CONGO">CONGO</option>';
        $rtn .= '<option value="DEMOCRATIC REPUBLIC OF THE CONGO">DEMOCRATIC REPUBLIC OF THE CONGO</option>';
        $rtn .= '<option value="CUBA">CUBA</option>';
        $rtn .= '<option value="KUWAIT">KUWAIT</option>';
        $rtn .= '<option value="COOK ISLANDS">COOK ISLANDS</option>';
        $rtn .= '<option value="CROATIA">CROATIA</option>';
        $rtn .= '<option value="CHRISTMAS ISLAND">CHRISTMAS ISLAND</option>';
        $rtn .= '<option value="KYRGYZSTAN">KYRGYZSTAN</option>';
        $rtn .= '<option value="KIRIBATI">KIRIBATI</option>';
        $rtn .= '<option value="CYPRUS">CYPRUS</option>';
        $rtn .= '<option value="THAILAND">THAILAND</option>';
        $rtn .= '<option value="TAJIKISTAN">TAJIKISTAN</option>';
        $rtn .= '<option value="TANZANIA, UNITED REPUBLIC OF">TANZANIA, UNITED REPUBLIC OF</option>';
        $rtn .= '<option value="TURKS AND CAICOS ISLANDS">TURKS AND CAICOS ISLANDS</option>';
        $rtn .= '<option value="TURKEY">TURKEY</option>';
        $rtn .= '<option value="TOGO">TOGO</option>';
        $rtn .= '<option value="TOKELAU">TOKELAU</option>';
        $rtn .= '<option value="TONGA">TONGA</option>';
        $rtn .= '<option value="TURKMENISTAN">TURKMENISTAN</option>';
        $rtn .= '<option value="TUVALU">TUVALU</option>';
        $rtn .= '<option value="TUNISIA">TUNISIA</option>';
        $rtn .= '<option value="TRINIDAD AND TOBAGO">TRINIDAD AND TOBAGO</option>';
        $rtn .= '<option value="PANAMA">PANAMA</option>';
        $rtn .= '<option value="PARAGUAY">PARAGUAY</option>';
        $rtn .= '<option value="PAKISTAN">PAKISTAN</option>';
        $rtn .= '<option value="PAPUA NEW GUINEA">PAPUA NEW GUINEA</option>';
        $rtn .= '<option value="PALAU">PALAU</option>';
        $rtn .= '<option value="PALESTINE">PALESTINE</option>';
        $rtn .= '<option value="FAROE ISLANDS">FAROE ISLANDS</option>';
        $rtn .= '<option value="PERU">PERU</option>';
        $rtn .= '<option value="PORTUGAL">PORTUGAL</option>';
        $rtn .= '<option value="FALKLAND ISLANDS">FALKLAND ISLANDS</option>';
        $rtn .= '<option value="POLAND">POLAND</option>';
        $rtn .= '<option value="PUERTO RICO">PUERTO RICO</option>';
        $rtn .= '<option value="FRANCE">FRANCE</option>';
        $rtn .= '<option value="FRENCH GUIANA">FRENCH GUIANA</option>';
        $rtn .= '<option value="FRENCH SOUTHERN TERRITORIES">FRENCH SOUTHERN TERRITORIES</option>';
        $rtn .= '<option value="FRENCH POLYNESIA">FRENCH POLYNESIA</option>';
        $rtn .= '<option value="FIJI">FIJI</option>';
        $rtn .= '<option value="FINLAND">FINLAND</option>';
        $rtn .= '<option value="PHILIPPINES">PHILIPPINES</option>';
        $rtn .= '<option value="PITCAIRN">PITCAIRN</option>';
        $rtn .= '<option value="HEARD AND MC DONALD ISLANDS">HEARD AND MC DONALD ISLANDS</option>';
        $rtn .= '<option value="HUNGARY">HUNGARY</option>';
        $rtn .= '<option value="HONG KONG">HONG KONG</option>';
    }
    return $rtn;
}


?>