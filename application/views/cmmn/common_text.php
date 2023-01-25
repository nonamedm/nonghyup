<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
function get_text( $str, $lng_idx, $mode="" )
{
    $rtn="";
    $text_arr = [
        "idx" => ['번호','No']
        ,"lng_nm" => ['언어','Language']
        ,"post_subj" => ['제목','Subject']
        ,"brd_nm" => ['작성자','Writer']
        ,"crt_dtms" => ['등록일','Date']
        ,"post_cont" => ['내용','Content']
        ,"brd_memo" => ['관리자 메모 (외부에 노출되지 않습니다)','Content']
        ,"brd_ymd" => ['연월일','yyyy-mm-dd']
        ,"brd_hms" => ['시분초','hh-mm-ss']
        ,"post_cat" => ['분류','Category']
        ,"brd_open" => ['배포시작예약','Open']
        ,"brd_close" => ['배포종료예약','Close']
        ,"brd_manual" => ['예약사용안함','Close']
        ,"post_status" => ['상태','Status']
        ,"brd_file_nm" => ['배포파일명','File Name']
        ,"files" => ['첨부파일 찾기','Select File']
        ,"brd_dst" => ['대상지구','Site']
        ,"query_tit" => ['질의제목','Inquiries title']
        ,"query" => ['질의','Inquiries']
        ,"answers" => ['답변','Answers']

        ,"sel_dist" => ['참가대상 지구','Site']
        ,"usr_id" => ['아이디(이메일)','ID(Email)']
        ,"usr_pin" => ['고유번호','PIN']
        ,"usr_status" => ['등록상태','Registration Statue']
        ,"usr_representation" => ['대표사','Representative']
        ,"usr_org_nm" => ['회사명','Organization']
        ,"usr_nat" => ['국가명','Country']
        ,"usr_nm" => ['대표자 성명','Name']
        ,"usr_license" => ['자격 및 면허','License Number']
        ,"usr_file" => ['사업자 등록증 첨부','Attach the business registration certificate of the representative']
        ,"usr_tel_num" => ['전화번호','telephone Number']
        ,"usr_mbl_num" => ['이동전화번호','Mobile Phone Number']
        ,"usr_zip" => ['우편번호','Zip code']
        ,"usr_addr" => ['주소','Address']
        ,"usr_address" => ['상세주소','Address Detail']
        ,"usr_qna_tit" => ['나의 질의내역','My Inquiries']
        ,"usr_dnload_tit" => ['다운로드','My Download']
        ,"usr_add_member" => ['공동응모업체','Joint Applicant']
        ,"writer_nm" => ['작성자','Writer']
        ,"keyword" => ['키워드','Keyword']
        ,"no_post" => ['게시물이 없습니다.','There are no posts']
        ,"logged_in" => ['현재 로그인상태 입니다', 'You are currently logged in']
        ,"certified" => ['이미 인증처리가 되었습니다.', 'already Authentication.']
        ,"certify_fail" => ['인증에 실패하였습니다.', 'Authentication failed.']
        ,"password_format" => ['영문/숫자/특수문자 포함:6~15자', 'English/Number/Special characters included: 6-15 characters']

        ,"file_only" => ['(jpg/gif/png/pdf)만 가능', '(jpg/gif/png/pdf) only']
        ,"file_attach" => ['※ 파일 미첨부시 관리자 승인을 받지 못합니다.','※ If the file is not attached, the administrator‘s approval is not possible.']

        ,"info_input" => ['정보입력','Information input']
        ,"mail_auth" => ['메일인증','Email authentication']
        ,"adm_app" => ['관리자승인','Admin Approval']
        ,"reg_cmpl" => ['등록완료','Registration Completed']

        ,"rules" => ['일반지침 다운로드','Download General rules']
        ,"plan_rules" => ['공모지침','General rules']
        ,"design_guidelines" => ['계획지침','Design Guidelines']
        ,"site_A" => ['고양 창릉지구','Changneung, Goyang']
        ,"site_B" => ['부천 대장지구','Daejang, Bucheon']
        ,"dnld" => ['다운로드','Download']
        ,"comm" => ['공통','']
        ,"qna" => ['질의회신','Inquiry reply']

        ,"계획지침_고양창릉" => ['계획지침_고양창릉','design guidelines_Changneung, Goyang']
        ,"계획지침_부천대장" => ['계획지침_부천대장','design guidelines_Daejang, Bucheon']
        ,"1. 경계설정사유도 등" => ['1. 경계설정사유도 등', '1. Map of district designation etc']
        ,"2. 사업지구 현황도" => ['2. 사업지구 현황도', '2. Existing map of the project site']
        ,"3. 현황사진" => ['3. 현황사진', '3. Site photos']
        ,"4. 동영상" => ['4. 동영상', '4. Video']
        ,"5. 광역교통계획(안)" => ['5. 광역교통계획(안)', '5. Plan for metropolitan transportation (Draft)']
        ,"6. UCP 주요내용" => ['6. UCP 주요내용', '6. Key summary of UCP']
        ,"7. 전략환경영향평가 자료" => ['7. 전략환경영향평가 자료', '7. Materials for strategic environmental & environmental impact assessment']
        ,"8. 재해영향성검토 자료" => ['8. 재해영향성검토 자료', '8. Materials for disaster impact assessment']
        ,"9. 중앙도시계획원회 의견" => ['9. 중앙도시계획원회 의견', '9. Opinions from the Central Urban Planning Committee']
        ,"10. 지구지정(안)" => ['10. 지구지정(안)', '10. Site designation (Draft)']
        ,"11. 지형도면고시도" => ['11. 지형도면고시도', '11. Notification of topographic map']
        ,"12. 첫마을 시범단지 구역" => ['12. 첫마을 시범단지 구역', '12. Area of first village pilot project']
        ,"13. 용역 과업내용서" => ['13. 용역 과업내용서', '13. Work Scope for Design Project']
        ,"14. 주력 평면도" => ['14. 주력 평면도', '14. Main plans']
        ,"15. 신혼희망타운 계획시 고려사항_수정본" => ['15. 신혼희망타운 계획시 고려사항_수정본', '15. Considerations for Newlywed Hope Town planning_rev']

        ,"지구지정 보도자료 및 관보 고시자료" => ['지구지정 보도자료 및 관보 고시자료', 'Press release regarding site designation & Notice materials of official gazette']

        ,"regist_end"  => ['참가등록 기간 종료', 'End of registration period']
        ,"period_modify_reg" => ['등록정보 수정기간이 종료되었습니다.', 'The registration information modification period has ended.']



    ];
    
    foreach($text_arr as  $key=>$value )
    {
        if($key==$str)
        {
            $rtn = $text_arr[$key][$lng_idx];
            break;
        }
    }
    return $rtn;
}



function get_nav($str, $lng_idx, $mode="")
{
    $rtn="";
    $text_arr = [
        "reg"       => ['등록','Register']
        ,"login"    => ['로그인','Login']
        ,"logout"   => ['로그아웃','Logout']
        ,"mypage"   => ['마이페이지','Mypage']
        ,"adm"      => ['관리자','Admin']
        ,"mng"      => ['운영자','Management']
        ,"web"      => ['웹사이트','Website']

    ];

    foreach($text_arr as  $key=>$value )
    {
        if($key==$str)
        {
            $rtn = $text_arr[$key][$lng_idx];
            break;
        }
    }
    return $rtn;
}