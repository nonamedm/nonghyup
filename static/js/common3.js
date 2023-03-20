$(document).ready(function() {

    $(".gnb").bind('mouseenter', function () {
        //console.log('1');
        gnb_hover();
    });

    $("#header").bind('mouseleave', function () {
        gnb_leave();
    });

    $('.btnClose').on('click', function() {
        $('.noticeBannerW').css({'display': 'none'});
    });

    //gnb hover
    function gnb_hover(){
        $("#header .submenu").css({'display': 'block', 'border-bottom': '1px solid #eee'});
        $("#header .smenu").css({'display': 'block'});
    }

    //gnb leave
    function gnb_leave(){
        $("#header .submenu").css({display: "none"});
        $("#header .smenu").css({display: "none"});
    }


    // select 변경시
    $("select").change(function(evt){
        //console.log("form select .change");
        var idx = evt.target.value;
        $(this).children('option[value]').each(function(e){
            if($(this).val()==idx){
                $(this).attr("selected", "selected");
                return false;
            }else{
                $(this).attr('selected',false);
                return false;
            }
        });
        $(this).next("input").val( $(this).children( "option:selected" ).val() );
    });

    // select 수정 로드시
    $("select").each( function(){
        //console.log("select .each");
        var sel_val = $(this).next("input").val();
        if(sel_val){
            $(this).children("option").each( function(){
                if( $(this).val()==sel_val ){
                    $(this).attr("selected", true);
                }
            });
        }
    });



    /*
     * ----------------------------------------
     * login
     * ----------------------------------------
     */
    $("#btn_login").on('click', function(){
        loginWithKakao();
    });
    // auth
    function loginWithKakao() {
        Kakao.Auth.authorize({
            redirectUri: 'https://law.nhbank.com/ko/auth/oauth'
        })
    }

    //const token = getCookie('authorize-access-token');
    //Kakao.Auth.setAccessToken(token);
    //Kakao.Auth.getStatusInfo();
    // 아래는 데모를 위한 UI 코드입니다.
    /*
    displayToken();
    function displayToken() {
        const token = getCookie('authorize-access-token');
        if(token) {
            Kakao.Auth.setAccessToken(token)
            Kakao.Auth.getStatusInfo(( {status} ) => {
                if(status === 'connected') {
                    document.getElementById('token-result').innerText = 'login success. token: ' + Kakao.Auth.getAccessToken();
                } else {
                    Kakao.Auth.setAccessToken(null);
                }
            })
        }
    }

    function getCookie(name) {
        const value = "; " + document.cookie;
        const parts = value.split("; " + name + "=");
        if (parts.length === 2) return parts.pop().split(";").shift();
    }
    */


});