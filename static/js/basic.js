var agree_data;
const extractTextPattern = /(<([^>]+)>)/gi;
const regexp_pw = /^.*(?=^.{8,20}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/;
const regexp_email = /^([0-9a-zA-Z_\.-]+)@([0-9a-zA-Z_-]+)(\.[0-9a-zA-Z_-]+){1,2}$/;

var br = '';
var agent = navigator.userAgent.toLowerCase();
if( (navigator.appName == 'Netscape' && navigator.userAgent.search('Trident') != -1 ) || (agent.indexOf("msie") != -1 ) ){
    br = 'ie';
}


$(document).ready(function() {

    $(".cmt_del").on("click", function(){
        let id = $(this).attr("id");
        let cmt_idx = id.substring(3);
        let trgt_id = $("#m_id").val();
        let trgt_idx = $("#idx").val();
        if(cmt_idx && trgt_id && trgt_idx){
            var result = confirm("댓글이 영구삭제됩니다. \n정말 삭제하시겠습니까?");
            if(result){
                delCmt(cmt_idx, trgt_id, trgt_idx);

                //location.href='/ko/auth/withdrawal?usr_id='+usr_id;
            }
        }
        return false;
    });

    $(".sch").on("click", function(){
        if ($("#mblmenu").css('display')=='block') {
            $("#mblmenu").css('display', 'none');
            return false;
        }
        if($(".m_search").css('display')=='none'){
            $(".m_search").css('display', 'block');
            $("#mtop_search").focus();
        } else {
            $(".m_search").css('display', 'none');
        }
        return false;
    });


    $("a.withdrawal").on("click", function(){
        var result = confirm("회원정보가 삭제됩니다. \n정말 회원탈퇴하시겠습니까?");
        if(result){
            location.href='/ko/auth/withdrawal?usr_id='+usr_id;
        }
        return false;
    });

    $(".ready").on("click", function(){
        alert('작업중입니다.');
        return false;
    });

    $("#top_search_btn, #mtop_search_btn").on("click", function(){
        sch_top();
    });



    if(bbs_mod == 'lists'){
        $(".brd_sch_btn").on("click", function(){
            sch_simple();
        });

        $(".brd_sch_btn_precedent").on("click", function(){
            sch_precedent();
        });

        if(s_sds && s_sde){
            $(".brd_sch_dtl").css("display", "inline-block");
            $(".brd_sch_dtl_btn").css("display", "none");
            $("#dtl_opt").val(1);
        }
    }

    // 판례 상세검색 기간설정
    $(".period").on("click", function(){
        let id = $(this).attr("id");
        const now = new Date();
        const start = new Date();
        var st = id.substring(2,3);
        start.setFullYear(start.getFullYear()-Number(st));
        let sde = now.toISOString().split('T')[0];
        let sds = start.toISOString().split('T')[0];
        $("#sch_date_start").val(sds);
        $("#sch_date_end").val(sde);
        return false;
    });

    // 통합검색 키워드
    $(".tkw").on("click", function(){
        let kw = $(this).attr("alt");
        sch_top(kw);
        return false;
    });

    // 결과내 재검색
    $(".frs_sch_btn").on("click", function(){
        frs_sch();
        return false;
    });

    $("a.usr").on("click", function(){
        var result = confirm("정상회원으로 전환하시겠습니까?");
        if(result){
            var _usr_id = $(this).attr("alt");
            transUsr(_usr_id, 1);
        }
        return false;
    });

    $("a.dormantAccount").on("click", function(){
        var result = confirm("휴면계정으로 전환하시겠습니까?");
        if(result){
            var _usr_id = $(this).attr("alt");
            transUsr(_usr_id, 2);
        }
        return false;
    });

    $("a.accessDeny").on("click", function(){
        var result = confirm("접근제한계정으로 전환하시겠습니까?");
        if(result){
            var _usr_id = $(this).attr("alt");
            transUsr(_usr_id, 3);
        }
        return false;
    });

    $("a.delAccount").on("click", function(){
        var result = confirm("회원계정이 삭제됩니다. 삭제하시겠습니까?");
        if(result){
            var _usr_id = $(this).attr("alt");
            transUsr(_usr_id, 'del');
        }
        return false;
    });

    $("a.wrongApplyInit").on("click", function(){

        var result = confirm("잘못된접속시도 횟수를 초기화하시겠습니까?");
        if(result){
            var _usr_id = $(this).attr("alt");
            wrongApplyInit(_usr_id);
        }
        return false;
    });



    //
    $("body.lists a.chk_perm_view").on("click", function() {
        var rtn = false;
        console.log("회원등급="+usr_lv);
        console.log("열람권한="+bbs_perm['view']);
        if(usr_lv >= bbs_perm['view']){
            rtn = true;
        } else {
            rtn = false;
            alert("회원만 열람이 가능합니다. \n로그인 해주세요.");
            location.href="/ko/auth/login";
            return false;
        }
        return rtn;
    });

    $("#ver").on("change", function(){
        var value_str = document.getElementById('ver')
        var idx = value_str.options[value_str.selectedIndex].value;
        //console.log( value_str.options[value_str.selectedIndex].value );
        //console.log( idx );
        $("#modal-overflow .uk-modal-body").html( agree_data[agree_data.length-idx]['post_cont'] );
        //location.href='/'+seg+'/current?cat='+$(this).val();
    });


    // 현행법령
    if(m_id=='current'){
        $("#cat1").on("change", function(){
            if(bbs_mod=='lists'){
                location.href='/'+seg+'/current/'+bbs_mod+'?cat='+$(this).val();
            }
        });


    }else if(m_id=='myimprovement' || m_id=='myqna' || m_id=='improvement' || m_id=='qna' ) {
        $(".post_subj").on("click", function () {
            var idx = String($(this).attr('id')).substring(4);
            var st = $('#cont' + idx).css("display");
            $('.post_cont').css("display", "none");
            if (st == 'none') {
                $('#cont' + idx).css("display", "block");
            } else {
                $('#cont' + idx).css("display", "none");
            }
            return false;
        });
    }else if(m_id=='resetPw'){
        // 비밀번호 재설정
        $("#pwForm").submit(function(){
            // 값의 유무 체크
            if(!$("#usr_pw").val()){
                alert('비밀번호를 입력해 주세요');
                $("#usr_pw").focus();
                return false;
            }
            // 값의 형식 체크
            if(!regexp_pw.test($("#usr_pw").val()) ){
                alert('비밀번호 형식에 맞게 입력해 주세요(영문/숫자/특수문자 포함:8~20자).');
                $("#usr_pw").focus();
                return false;
            }
            // 값의 일치 체크
            if( $("#usr_pw").val() != $("#usr_pw_confirm").val()){
                alert('비밀번호확인 값이 일치하지 않습니다.');
                $("#usr_pw_confirm").focus();
                return false;
            }
            //alert(seg);
            $(this).attr('action', "/"+seg+"/auth/updatePw");
            $(this).submit();
            return false;
        });
    }else if(m_id=='search'){

        if($("#frs_sds").val() && $("#frs_sde").val()){
            $("#dtl_opt").val(1);
            $(".frs_sch_dtl").css("display", "inline-block");
        }
    }




    if (bbs_mod == 'lists'){
        var id;
        $(".tit").on("mouseover", function() {
            id = String($(this).attr('id')).substring(3);
            var sm = $("#post_summary"+id).text().trim();
            if(sm.length>0){
                $("#post_summary"+id).css('display', 'block');
                console.log($("#post_summary"+id).css('display'));
            }
            return false;
        });
        $(".tit").on("mouseout", function() {
            $("#post_summary"+id).css('display', 'none');
            return false;
        });
    }

    if (m_id == 'home'){

        var id;
        $("#tab_0 td.tit").on("mouseover", function() {
            id = String($(this).attr('id')).substring(3);
            var sm = $("#post_summary"+id).text().trim();
            if(sm.length>0){
                $("#post_summary"+id).css('display', 'block');
            }
        });
        $("#tab_0 td.tit").on("mouseout", function() {
            $("#post_summary"+id).css('display', 'none');
        });

    }

    if ((bbs_mod == 'write' || bbs_mod == 'modify' || bbs_mod == 'reply')) {
        let mod = $("#mod").val();
        let f = $("#brdFormDefault");

        //
        $(".btn_reply").on("click", function () {
            let rtn = true;

            if (rtn && !$("#post_subj").val()) {
                alert('답변제목을 입력해 주세요');
                $("#post_subj").focus();
                rtn = false;
            }

            if (rtn && $('textarea.post_cont').val()) {
                alert('답변내용을 입력해 주세요');
                $("#post_cont").focus();
                rtn = false;
            }

            if (rtn) {
                console.log(m_id);
                let idx = $("#idx").val();
                if (bbs_mod == "modify" && idx) {
                    $(f).attr('action', "/" + seg + "/" + m_id + "/update?idx=" + idx);
                } else {
                    $(f).attr('action', "/" + seg + "/" + m_id + "/insert");
                }
                rtn = false;
                $(f).submit();
            }
            return false;
        });

        $(".btn_write").on("click", function () {
            let rtn = true;

            if (m_id=='agree') { // 약관

                if (rtn && !$("#post_subj").val()) {
                    alert('약관버전을 입력해 주세요');
                    $("#post_subj").focus();
                    rtn = false;
                }

                if (rtn && !$("#post_dtms").val()) {
                    alert('시행일시를 입력해 주세요');
                    $("#post_dtms").focus();
                    rtn = false;
                }

            } else { // 공통

                if (rtn && !$("#post_subj").val()) {
                    alert('제목을 입력해 주세요');
                    $("#post_subj").focus();
                    rtn = false;
                }

                if(rtn && $('textarea.post_cont').val()){
                //if(rtn && !editor.getContents().replace(extractTextPattern, '')){
                    alert('내용을 입력해 주세요');
                    //console.log(editor);
                    //editor.focus();
                    $("#post_cont").focus();
                    rtn = false;
                }

                if (rtn && !$("#usr_nm").val()) {
                    alert('작성자를 입력해 주세요');
                    $("#usr_nm").focus();
                    rtn = false;
                }
            }

            // 등록전 내용 처리 (판례)
            if (m_id=='precedent') {
                var post_cat0 = post_cat1 = post_cat2 = post_cat3 = '';
                if($("#post_cat0").attr("checked")){
                    post_cat0 = $("#post_cat0").val();
                }
                if($("#post_cat1").attr("checked")){
                    post_cat1 = $("#post_cat1").val();
                }
                if($("#post_cat2").attr("checked")){
                    post_cat2 = $("#post_cat2").val();
                }
                if($("#post_cat3").attr("checked")){
                    post_cat3 = $("#post_cat3").val();
                }
                var post_cat = post_cat0+'|'+post_cat1+'|'+post_cat2+'|'+post_cat3;
                //console.log("post_cat="+post_cat);
                $("#post_cat").val(post_cat);
            }

            if (rtn) {
                let idx = $("#idx").val();
                if (bbs_mod == "modify" && idx) {
                    alert('수정하시겠습니까?');
                    $(f).attr('action', "/" + seg + "/" + m_id + "/update?idx=" + idx);
                } else {
                    alert('등록하시겠습니까?');
                    $(f).attr('action', "/" + seg + "/" + m_id + "/insert");
                }
                rtn = false;
                $(f).submit();
            }
            return false;
        });
    }


    // 게시판공통 sort
    $(".ord").on("click", function(){
        var ordir='';
        var addr1 = '?';
        if($(this).hasClass('new')){
            ordir = "DESC";
        }else{
            ordir = "ASC";
        }
        var addr_arr = window.location.href.split('?');
        if(addr_arr.length>1){
            var param_arr = addr_arr[1].split("&");
            var ord=1;
            for(var i=0; i<param_arr.length; i++){
                var tmp_arr = param_arr[i].split("=");
                if(tmp_arr[0]=='ord'){
                    ord=0;
                    tmp_arr[1]=ordir;
                    param_arr[i] = tmp_arr[0]+'='+tmp_arr[1];
                    break;
                }
            }
            if(ord){
                param_arr.push("ord="+ordir);
            }
            for(var i=0; i<param_arr.length; i++){
                if(i>0){
                    addr1 += '&';
                }
                addr1 += param_arr[i];
            }
        }else{
            addr1 += "ord="+ordir;
        }
        location.href=addr_arr[0]+addr1;
        return false;
    });

    $(".usr_ord").on("click", function(){
        var ordir='';
        var addr1 = '?';
        if($(this).hasClass('new')){
            ordir = "DESC";
        }else{
            ordir = "ASC";
        }
        var addr_arr = window.location.href.split('?');
        if(addr_arr.length>1){
            var param_arr = addr_arr[1].split("&");
            var ord=1;
            for(var i=0; i<param_arr.length; i++){
                var tmp_arr = param_arr[i].split("=");
                if(tmp_arr[0]=='ord'){
                    ord=0;
                    tmp_arr[1]=ordir;
                    param_arr[i] = tmp_arr[0]+'='+tmp_arr[1];
                    break;
                }
            }
            if(ord){
                param_arr.push("ord="+ordir);
            }
            for(var i=0; i<param_arr.length; i++){
                if(i>0){
                    addr1 += '&';
                }
                addr1 += param_arr[i];
            }
        }else{
            addr1 += "ord="+ordir;
        }
        location.href=addr_arr[0]+addr1;
        return false;
    });


    // 회원가입 - 사번확인
    $("#btn_chk_num").on("click", function(){
        var num = $(".id_num").val().trim();

        if(!num){
            alert("입력값이 없습니다. 사번을 입력해 주세요.");
            $(".id_num").focus();
            return false;
        }else{
            if(!$.isNumeric(num)){
                alert("올바른 형식의 사번을 입력해 주세요(1).");
                $(".id_num").focus();
                return false;
            }
            if(num.length!=8){
                alert("올바른 형식의 사번을 입력해 주세요(2).");
                $(".id_num").focus();
                return false;
            }
            //if(!(String(num).substr(0,1)==1 || num.substr(0,1)==2)){
            //    alert("올바른 형식의 사번을 입력해 주세요3.");
            //    $(".id_num").focus();
            //    return false;
            //}
        }
        alert("사번이 확인되었습니다. \n카카오인증을 통한 회원가입이 진행됩니다.");
        // 사번 세션에 저장
        set_id_num($("#id_num").val());
        return false;
    });
    
    
    // 회원가입 - 완료
    $("#joinForm").submit(function() {

        if (!$("#usr_nm").val()){
            alert("이름을 입력해 주세요.");
            $("#usr_nm").focus();
            return false;
        }

        if (!$("#usr_email").val()){
            alert("이메일을 입력해 주세요.");
            $("#usr_email").focus();
            return false;
        }

        if(!regexp_email.test($("#usr_email").val()) ){
            alert('이메일 형식에 맞게 입력해 주세요.');
            $("#usr_email").focus();
            return false;
        }

        if (!$("#usr_agr_pri_dtms").attr("checked")){
             alert("이용약관 동의에 체크해 주세요.");
            $("#usr_agr_pri_dtms").focus();
            return false;
        }

        if (!$("#usr_agr_terms_dtms").attr("checked")){
            alert("개인정보처리방침 동의에 체크해 주세요.");
            $("#usr_agr_terms_dtms").focus();
            return false;
        }

        //if (!$("#usr_agr_copy_dtms").attr("checked")){
        //    alert("저작권정책 동의에 체크해 주세요.");
        //    $("#usr_agr_copy_dtms").focus();
        //    return false;
        //}

        $("#usr_agr_pri_dtms").val(1);
        $("#usr_agr_terms_dtms").val(1);
        //$("#usr_agr_copy_dtms").val(1);

        $("form#joinForm").attr("action", "/ko/auth/signup");
        $("form#joinForm").submit();
        return false;
    });


    // modal 약관동의
    $(".modal_agree").on("click", function(){
        if($(this).attr('id')){
            // 약관정보 가져오기
            get_agree_ajax($(this).attr('id'));
        }else{
            alert('네트워크오류가 발생하였습니다. 다시 시도해 주세요.');
        }
    });


    $("#family_site .family_wrap>a").toggle(function(){
        $("#family_site .family_wrap ul").show();
        $("#family_site .family_wrap>a>img").attr("src","/static/svg/family_link_bullet1.svg");
    },function(){
        $("#family_site .family_wrap ul").hide();
        $("#family_site .family_wrap>a>img").attr("src","/static/svg/family_link_bullet.svg");
    });
    
    
    
    $('.single-item').slick({
        dots: true,
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        autoplay: true,
        autoplaySpeed: 4000
    });

    if (m_id!='home') {
        $('.bnr-item').slick({
            dots: false,
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            autoplay: true,
            autoplaySpeed: 4000,
            arrows: false,
        });
    }

    $('.multi-item').slick({
        dots: false,
        infinite: true,
        speed: 500,
        slidesToShow: 5,
        autoplay: true,
        adaptiveHeight: true,
        autoplaySpeed: 2000
    });

    function body_show() {
        //$('.single-item').animate({'opacity': 1}, 2000, function(){
        //    alert(111);
        //});
        $('.single-item').animate({'opacity': 1});
        $('.bnr-item').animate({'opacity': 1});
        $('.multi-item').animate({'opacity': 1});
    }
    setTimeout(body_show, 300);


    $(".brd_sch_dtl_btn").on("click", function(){
       $(".brd_sch_dtl").css("display", "block");
       $(".brd_sch_dtl_btn").css("display", "none");
       $("#dtl_opt").val(1);
       return false;
    });

    $(".frs_sch_dtl_btn").on("click", function(){
        $(".frs_sch_dtl").css("display", "block");
        $(".frs_sch_dtl_btn").css("display", "none");
        $("#dtl_opt").val(1);
        return false;
    });

    $(".m_brd_search").on("click", function(){
        if ($("#is_mbl").css('display')=="none"){ // mbl & show
            $(".m_brd_search").css("display", "none");
            $(".brd_sch").css("display", "block");
            $(".brd_sch_dtl_btn").css("display", "block");
            $(".brd_sch_dtl").css("display", "none");
            $(".m_brd_search_close").css("display", "block");
        }
        return false;
    });


    $(".m_brd_search_close").on("click", function(){
        $(".m_brd_search").css("display", "block");
        $(".brd_sch").css("display", "none");
        $(".brd_sch_dtl_btn").css("display", "none");
        $(".m_brd_search_close").css("display", "none");
        $("#brd_sch").val("");
        return false;
    });


    $(".frs_sch_dtl .xclose").on("click", function(){
        $(".frs_sch_dtl").css("display", "none");
        $(".frs_sch_dtl_btn").css("display", "inline-block");
        $("#frs_sds").val('');
        $("#frs_sde").val('')
        $("#dtl_opt").val(0);
        return false;
    });

    $(".brd_sch_dtl .xclose").on("click", function(){
        $(".brd_sch_dtl").css("display", "none");
        $(".brd_sch_dtl_btn").css("display", "inline-block");
        $("#dtl_opt").val(0);
        return false;
    });

    $(".tab.vw").on("click", function(){
        // tab
        if ($("#file_list").css('display')=='none') {
            $("#file_list").css({'display': 'block'});
        } else {
            $("#file_list").css({'display': 'none'});
        }
        return false;
    });

    $(".mtab").on("click", function(){
        // tab
        var idx = $(this).index();
        $(this).siblings().css({'background': '#5e5e5e', 'cursor': 'pointer'}).removeClass('.active');
        $(".mtab").eq($(this).index()).css({'background': '#960000', 'cursor': 'unset'}).addClass('.active');
        // content
        if(idx==1){
            $("#tab_0").css({'display': 'none'});
            $("#tab_1").css({'display': 'block'});
            // more
            $(".latest .tab_box>a").attr("href", "/ko/lawmaking");
        }else{
            $("#tab_0").css({'display': 'block'});
            $("#tab_1").css({'display': 'none'});
            // more
            $(".latest .tab_box>a").attr("href", "/ko/pr");
        }
        return false;
    });

    $('#like').on("click", function()
    {
        if(usr_id){
            let _usr_id = $("#usr_id").val();
            let _trgt_idx = $("#idx").val();
            let _trgt_id = $("#m_id").val();
            let _trgt_val = $("#is_like").val();
            setLike_ajax(_trgt_idx, _trgt_id, _trgt_val, _usr_id);
        }else{
            alert("회원용 서비스입니다. \n로그인 해주세요.");
        }
        return false;
    });

    $("#go_cmt").on("click", function(){
        if(usr_id){
            $("#cmt_cont").focus();
        }else{
            alert("회원용 서비스입니다. \n로그인 해주세요.");
        }
        return false;
    });

    $('.btn_cmt').on("click", function(){
        if(!$("#cmt_cont").val()){
            alert('댓글내용을 작성해 주세요.');
            $("#cmt_cont").focus();
            return false;
        }

        if(usr_id){
            let _usr_id = $("#usr_id").val();
            let _usr_nm = $("#usr_nm").val();
            let _trgt_idx = $("#idx").val();
            let _trgt_id = $("#m_id").val();
            let _cmt_cont = $("#cmt_cont").val();
            setCmt_ajax(_trgt_idx, _trgt_id, _usr_nm, _usr_id, _cmt_cont);
        }else{
            alert("회원용 서비스입니다. \n로그인 해주세요.");
        }
        return false;
    });

    $(".btn_mbl").on('click', function() {
        if($(".m_search").css('display')=='block'){
            $(".m_search").css('display', 'none');
        }
        if ($("#mblmenu").css('display')=='none') { // show
            $("#mblmenu").css({'position': 'relative', 'display': 'block','width': '100%' ,'overflow': 'auto'});
        } else { // hide
            $("#mblmenu").css({'display': 'none','height': 'auto' ,'overflow': 'hidden'});
        }
    });

    if($("#brd_sch").val() && $("#is_mbl").css('display')=="none"){
        $(".m_brd_search").css("display", "none");
        $(".brd_sch").css("display", "block");
        $(".brd_sch_dtl_btn").css("display", "inline-block");
        $(".brd_sch_dtl").css("display", "none");
        $(".m_brd_search_close").css("display", "block");
        return false;
    }else if($("#brd_sch").val() && $("#is_mbl").css('display')=="block"){
        $(".m_brd_search").css("display", "none");
        $(".brd_sch").css("display", "block");
        $(".brd_sch_dtl_btn").css("display", "inline-block");
        $(".brd_sch_dtl").css("display", "none");
        $(".m_brd_search_close").css("display", "none");
        return false;
    }

});



function delCmt(_cmt_idx ,_trgt_id, _trgt_idx){

    if(_cmt_idx && _trgt_id && _trgt_idx){
        $.ajax({
            url: '/ko/ajax/delCmt',
            type: 'post',
            data : {'cmt_idx' : _cmt_idx, 'trgt_id' : _trgt_id, 'trgt_idx' : _trgt_idx},//
            dataType: 'json',
            async: false,
            success: function(data) {
                console.log(data);
                if (data) { // 성공
                    //console.log('111');
                    alert('정상적으로 삭제되었습니다.');
                    location.href = window.location.href;
                } else { // 삭제 성공
                    //console.log('222');
                    alert("오류가 발생하였습니다. \n다시 시도해 주세요.");
                }
                return false;
            },
            error: function(data, status, err) {
                alert('there was an error while fetching events!');
                console.log(err);
            },
        });
    } else {
        alert("오류발생");
    }
}


function transUsr(_usr_id ,_status){
    if(_usr_id){
        $.ajax({
            url: '/ko/ajax/trans_usr',
            type: 'post',
            data : {'usr_id' : _usr_id, 'usr_status' : _status},//
            dataType: 'json',
            async: false,
            success: function(data) {
                console.log(data);
                if (data) { // 성공
                    //console.log(window.location.href);
                    location.href = window.location.href;
                } else { // 삭제 성공
                    //console.log('222');
                    alert("오류가 발생하였습니다. \n다시 시도해 주세요.");
                }
                return false;
            },
            error: function(data, status, err) {
                alert('there was an error while fetching events!');
                console.log(err);
            },
        });
    } else {
        alert("오류발생");
    }
}

function wrongApplyInit(_usr_id){
    if(_usr_id){
        $.ajax({
            url: '/ko/ajax/wrongApplyInit',
            type: 'post',
            data : {'usr_id' : _usr_id},//
            dataType: 'json',
            async: false,
            success: function(data) {
                console.log(data);
                if (data) { // 성공
                    //console.log(window.location.href);
                    alert('정상적으로 초기화되었습니다.');
                    location.href = window.location.href;
                } else { // 삭제 성공
                    //console.log('222');
                    alert("오류가 발생하였습니다. \n다시 시도해 주세요.");
                }
                return false;
            },
            error: function(data, status, err) {
                alert('there was an error while fetching events!');
                console.log(err);
            },
        });
    } else {
        alert("오류발생");
    }
}



function setCmt_ajax (_trgt_idx, _trgt_id, _usr_nm, _usr_id, _cmt_cont){
    //console.log('_trgt_idx='+_trgt_idx);
    //console.log('_trgt_id='+_trgt_id);
    //console.log('_usr_nm='+_usr_nm);
    //console.log('_usr_id='+_usr_id);
    //console.log('_cmt_cont='+_cmt_cont);
    if(_trgt_idx && _trgt_id && _usr_nm && _usr_id && _cmt_cont){
        $.ajax({
            url: '/ko/ajax/setCmt_ajax',
            type: 'post',
            data : { 'cmt_cont' : _cmt_cont, 'trgt_id': _trgt_id, 'trgt_idx': _trgt_idx, 'usr_id': _usr_id, 'usr_nm': _usr_nm},//
            dataType: 'json',
            async: false,
            success: function(data) {
                console.log(data);

                if (data) { // 성공
                    //console.log('111');
                    location.href = window.location.href;
                } else { // 삭제 성공
                    //console.log('222');
                    alert("등록중 오류가 발생하였습니다. \n다시 시도해 주세요.");
                }
            },
            error: function(data, status, err) {
                alert('there was an error while fetching events!');
                console.log(err);
            },
        });
    }else{
        console.log("ERROR - setCmt_ajax error");
    }
    return false;
}


function setLike_ajax(_trgt_idx, _trgt_id, _trgt_val, _usr_id){
    //console.log('_trgt_val='+_trgt_val);
    if(_trgt_idx && _trgt_val!='' && _trgt_val && _usr_id){
        $.ajax({
            url: '/ko/ajax/setLike_ajax',
            type: 'post',
            data : { 'val' : _trgt_val, 'trgt_id': _trgt_id, 'trgt_idx': _trgt_idx, 'usr_id': _usr_id},//
            dataType: 'json',
            async: false,
            success: function(data) {
                //console.log(data);
                if (data['mode']==1 && data['result']) { // 추가 성공
                    //console.log('111');
                    $("#like>img").attr("src", "/static/svg/ico_loved.svg");
                    $("#is_like").val(1);
                    $("#like>div .cnt").text(data['like_cnt']);
                } else if (data['mode']==0 && data['result']) { // 삭제 성공
                    //console.log('222');
                    $("#like>img").attr("src", "/static/svg/ico_love.svg");
                    $("#is_like").val(0);
                    $("#like>div .cnt").text(data['like_cnt']);
                }
            },
            error: function(data, status, err) {
                alert('there was an error while fetching events!');
                console.log(err);
            },
        });
    }else{
        console.log("ERROR - setLike_ajax error");
    }
    return false;
}


$(window).scroll(function() {
    let npos = $(window).scrollTop();
    //console.log(npos);
    if (npos < 150) {
        $(".left_menu").stop();
        $(".left_menu").animate( { "top" : 0 });
    }else if( npos > 150 ) {
        $(".left_menu").stop();
        $(".left_menu").animate({"top": npos-150});
    }
});


document.querySelector('body').addEventListener('keypress', function (e) {
    //console.log("key");
    //console.log($(':focus').attr('id'));
    //console.log(document.activeElement.id);
    //console.log(document.activeElement.name);
    if (e.key === 'Enter') {
        if (m_id == 'search') {
            if ($(':focus').attr('id') == 'top_search' || $(':focus').attr('id') == 'mtop_search') {
                sch_top();
            }else{
                frs_sch();
            }
        } else if ($(':focus').attr('id') == 'top_search' || $(':focus').attr('id') == 'mtop_search') {
            sch_top();
        } else if ($('#dtl_opt').val() == 0 && m_id == 'precedent') { // 판례 검색
            sch_precedent();
        } else if ($('#dtl_opt').val() == 1 && m_id == 'precedent') { // 판례 상세검색
            sch_precedent();
        } else if ($(':focus').attr('id') == 'brd_sch') { // 게시판 검색
            sch_simple();
        } else if (bbs_mod == 'lists'){
            //sch_simple();
        }
    }
    return false;
});

function sch_simple(){
    let rtn = true;

    if (rtn && !$("#brd_sch").val()) {
        alert('검색어를 입력해 주세요');
        $("#brd_sch").focus();
        rtn = false;
    }
    if(rtn && $("#dtl_opt").val()==1){
        if (rtn && !$("#sch_date_start").val()) {
            alert('검색기간시작을 선택해 주세요');
            $("#sch_date_start").focus();
            rtn = false;
        }
        if (rtn && !$("#sch_date_end").val()) {
            alert('검색기간끝을 선택해 주세요');
            $("#sch_date_end").focus();
            rtn = false;
        }
    }


    var s_word = $("#brd_sch").val();

    if (rtn){
        rtn = false;
        if($("#dtl_opt").val()==1){
            let s_sds = $("#sch_date_start").val();
            let s_sde = $("#sch_date_end").val();
            location.href="/" + seg + "/" + m_id + "/lists?s_word=" + s_word+"&s_sds="+s_sds+"&s_sde="+s_sde;
        }else{
            location.href="/" + seg + "/" + m_id + "/lists?s_word=" + s_word;
        }

    }
    return false;
}


function frs_sch(){
    let rtn = true;
    let s_fsw = $("#frs_sch").val();
    let s_rfsw = '';
    let s_sds = '';
    let s_sde = '';
    if(rtn && !s_fsw){
        alert('검색어를 입력해 주세요');
        $("#frs_sch").focus();
        rtn = false;
    }

    if(rtn && $("#dtl_opt").val()==1)
    {
        s_sds = $("#frs_sds").val();
        s_sde = $("#frs_sde").val();

        if(!s_sds && !s_sde){
            alert('검색기간을 설정해 주세요1');
            $("#frs_sds").focus();
            rtn = false;
        }

        if(!s_sds && s_sde){
            alert('검색기간을 설정해 주세요2');
            $("#frs_sds").focus();
            rtn = false;
        }
        if(s_sds && !s_sde){
            alert('검색기간을 설정해 주세요3');
            $("#frs_sde").focus();
            rtn = false;
        }
    }

    if(rtn){
        if($(".re_sch").attr("checked")){
            console.log("결과 내 재검색");
            s_rfsw = $("#rs_wrd").val();
        } else {
            s_rfsw = '';
            console.log("재검색");
        }
    }


    if (rtn){
        rtn = false;
        //var add = window.location.href.split('?');
        //console.log(add.length);
        let param = '';
        if(s_rfsw){
            param += '&s_rfsw='+s_rfsw;
        }
        if(s_sds){
            param += '&s_sds='+s_sds;
        }
        if(s_sde){
            param += '&s_sde='+s_sde;
        }
        //console.log(param);
        location.href='/ko/search' + "?s_fsw=" + s_fsw + param;
    }
    return false;
}

function sch_top(s_fkw=''){
    console.log('sch_top');
    let rtn = true;
    var s_fsw ='';
    if (s_fkw) {
        s_fsw = s_fkw;
    } else {
        if($("#is_mbl").css('display')=='none'){// mbl
            s_fsw = $("#mtop_search").val();
        }else{
            s_fsw = $("#top_search").val();
        }
    }


    if (rtn && !s_fsw) {
        alert('검색어를 입력해 주세요');
        if($("#is_mbl").css('display')=='none'){// mbl
            $("#mtop_search").focus();
        }else{
            $("#top_search").focus();
        }
        rtn = false;
    }

    if (rtn){
        rtn = false;
        if(s_fkw){
            location.href='/ko/search' + "?s_fsw=" + s_fkw;
        }else{
            var add = window.location.href.split('?');
            console.log(add.length);
            if(add.length>1){
                if(add[1].includes('s_fsw')){
                    var par = add[1].split('&');
                    for(var i=0; i<par.length; i++) {
                        var val = par[i].split('=');
                        if (val[0] == 's_fsw') {
                            val[1] = s_fsw;
                            par[i] = val[0]+'='+val[1];
                            break;
                        }
                    }
                    var str = '';
                    for (var j = 0; j < par.length; j++) {
                        if(j>0){
                            str += '&';
                        }
                        str += par[j];
                    }
                    add[1] = str;
                    location.href='/ko/search'+"?"+add[1];
                    //console.log(add[0]+"?"+add[1]);
                }else{
                    location.href='/ko/search'+"?"+add[1]+"&s_fsw=" + s_fsw;
                    console.log(add[0]+"?"+add[1]+"&s_fsw=" + s_fsw);
                }
            }else{
                location.href='/ko/search' + "?s_fsw=" + s_fsw;
            }
        }
    }
    return false;
}


function sch_precedent(){
    let rtn = true;
    let sch_str, s_word, s_cat, s_sds, s_sde, s_lng, s_fld, s_typ;
    s_cat = $("#post_cat").val();

    if (rtn && ! (s_cat || $("#brd_sch").val()) ) {
        alert('검색어를 입력해 주세요');
        $("#brd_sch").focus();
        rtn = false;
    }
    s_word = $("#brd_sch").val();


    if(rtn && $("#dtl_opt").val()==1) { // 상세검색
        // 선고일
        s_sds = $("#sch_date_start").val();
        s_sde = $("#sch_date_end").val();
        // 선고일 둘중 하나입력한 경우
        if(!s_sds && s_sde){
            alert('선고일 검색시작일을 입력해 주세요');
            $("#sch_date_start").focus();
            rtn = false;
        }
        if(s_sds && !s_sde){
            alert('선고일 검색종료일을 입력해 주세요');
            $("#sch_date_end").focus();
            rtn = false;
        }
        // 사건번호
        s_lng = $("#post_lng").val();
        // 법원명
        s_fld = $("#post_field").val();
        // 사건종류
        s_typ = $("#post_typ").val();
        if(rtn && !(s_sds && s_sde) && !s_lng && !s_fld && !s_typ ){
            alert('상세검색조건이 없습니다.');
            rtn = false;
        }
    }

    if(rtn){
        sch_str = "/" + seg + "/" + m_id + "/lists?s_word="+s_word;
        if(s_cat) {
            sch_str += "&s_cat=" + s_cat;
        }
        if(s_sds && s_sde) {
            sch_str += "&s_sds=" + s_sds +"&s_sde=" + s_sde;
        }
        if(s_lng) {
            sch_str += "&s_lng=" + s_lng;
        }
        if(s_fld) {
            sch_str += "&s_fld=" + s_fld;
        }
        if(s_typ) {
            sch_str += "&s_typ=" + s_typ;
        }
        location.href=sch_str;
    }
    return false;
}


function sch_precedent_dtl(){

    $("#brd_sch").focus();
    return false;
}


function set_id_num(_id_num){
    if(_id_num){
        $.ajax({
            url: '/ko/ajax/set_id_num',
            type: 'post',
            data : { 'id_num' : _id_num},//
            dataType: 'json',
            async: false,
            success: function(data) {
                console.log(data);
                if(data)
                { // 사번등록 성공
                    //console.log('사번등록 성공');
                    initKakao();
                    loginWithKakao();
                }
                else
                { // 사번등록 실패
                    //console.log('사번등록 실패');
                }
            },
            error: function(data, status, err) {
                alert('there was an error while fetching events!');
                console.log(err);
            },
        });
    }
}

// agree ajax
function get_agree_ajax(_id){
    if(_id){
        $.ajax({
            url: '/ko/ajax/get_agree_data',
            type: 'post',
            data : { 'id' : _id},//
            dataType: 'json',
            async: false,
            success: function(data) {
                //console.log(data);
                if(data)
                { // 성공
                    //console.log('약관정보 가져오기 성공');
                    agree_data = data;
                    show_agree(_id, agree_data);
                }
                else
                { // 실패
                    //console.log('약관정보 가져오기 실패');
                }
            },
            error: function(data, status, err) {
                alert('there was an error while fetching events!');
                console.log(err);
            },
        });
    }
}

// show_agree
function show_agree(_id, _data){
    $("#modal-overflow .uk-modal-title").text("");
    $("#modal-overflow .uk-modal-body").html("");
    if(_data.length){
        $("#ver").css('display', 'block');
        var inhtml="";
        for($i=0; $i<_data.length; $i++) {
            inhtml += "<option value='"+_data[$i]['idx']+"'>"+_data[$i]['post_subj']+"</option>";
        }
        $("#ver").html(inhtml);
        $("#modal-overflow .uk-modal-body").html(_data[0]['post_cont']);
    } else {
        $("#ver").css('display', 'none');
    }
    if (_id=='terms') {
        $("#modal-overflow .uk-modal-title").text("이용약관");
    }else if (_id=='pri') {
        $("#modal-overflow .uk-modal-title").text("개인정보처리방침");
    }else if (_id=='copy') {
        $("#modal-overflow .uk-modal-title").text("저작권 정책");
    }
}


$(".brd_sch_dtl .xclose").on("click", function(){
    //console.log(1);
    $(".brd_sch_dtl").css("display", "none");
    $(".brd_sch_dtl_btn").css("display", "inline-block");
    $("#dtl_opt").val(0);
    $("#sch_date_start").val('');
    $("#sch_date_end").val('');
    return false;
});


function initKakao() {
    Kakao.init('91ec0aac3f32ee5795cc51f9c7a9e493');
}


function loginWithKakao() {
    Kakao.Auth.authorize({
        redirectUri: 'https://law.nhbank.com/ko/auth/oauth'
    })
}
//상단고정
function check(box){
    var post_fix_chk = $('#post_fix').is(':checked');
    if(post_fix_chk == true){
        $('#post_fix').val('Y');
        $('.fix-num-select').show();
        $('input:checkbox[name="post_fix"]').prop('checked',true);
    }else{
        $('#post_fix').val('N');
        $('.fix-num-select').hide();
        $("#post_fix_num").val(Number(0));
        $('input:checkbox[name="post_fix"]').prop('checked',false);
    }
}
function fixcheck(value){
    $("#post_fix_num").val(Number(value));
}