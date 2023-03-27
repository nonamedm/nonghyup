<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script src="/static/js/jquery/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="/static/js/uikit.min.js"></script>
<script type="text/javascript" src="/static/js/slick_main.js"></script>



<?php if ($m_id!='home' && $svc_mod!='adm') {?>
<script src="/static/js/particles.min.js"></script>

<script>
    particlesJS("particles", {"particles":{"number":{"value":80,"density":{"enable":true,"value_area":800}},"color":{"value":"#ffffff"},"shape":{"type":"circle","stroke":{"width":10,"color":"#ffdea0"},"polygon":{"nb_sides":8},"image":{"src":"img/github.svg","width":200,"height":200}},"opacity":{"value":0,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":10,"random":true,"anim":{"enable":false,"speed":40,"size_min":1,"sync":false}},"line_linked":{"enable":true,"distance":205.17838682439088,"color":"#ffffff","opacity":0.03313181133058181,"width":7.6963778921545085},"move":{"enable":true,"speed":1.5,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":false,"mode":"repulse"},"onclick":{"enable":true,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":60,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true});
</script>
<?php } ?>





<?php
/*
*------------------------------
* A D M I N
*------------------------------
*/
if ($fnc_typ=='bbs' || $m_id == 'search') {?>
    <script type="text/javascript" src="/assets/lib/jqueryui/jquery-ui.min.js"></script>
    <script>
        //script구문 내부에 해당 메소드를 입력합니다.
        $(function() {
            $(".datepicker").datepicker({
                dateFormat: "yy-mm-dd",
                changeMonth: true, // 월을 바꿀수 있는 셀렉트 박스를 표시한다.
                changeYear: true, // 년을 바꿀 수 있는 셀렉트 박스를 표시한다.
                showMonthAfterYear: true , // 월, 년순의 셀렉트 박스를 년,월 순으로 바꿔준다. 
            });
        });
    </script>
<?php } ?>


<?php if( ($bbs_mod == 'write' || $bbs_mod == 'modify' || $bbs_mod == 'reply') && $edtr ){ ?>
    <!--<script src="/assets/lib/suneditor/dist_old/suneditor.min.js"></script>-->
    <!--<script src="/assets/lib/suneditor/lang/ko.js"></script>-->
    <!--<script src="/static/js/suneditor.js"></script>-->
    <script type="text/javascript" src="/assets/lib/ckeditor/ckeditor.js"></script>

    <script>
        var placeText = "";
        if(m_id=='qna'){
            placeText = "규제정보 관련 요청 및 문의 사항을 남겨주세요.";
        }
        CKEDITOR.replace( 'post_cont', {
            height: 300,
            extraPlugins : 'editorplaceholder',
            editorplaceholder : placeText
        } );
        //CKEDITOR.replaceClass = 'ckeditor';
    </script>

<?php }?>

<script type="text/javascript" src="/static/js/common3.js"></script>
<script type="text/javascript" src="/static/js/basic.js"></script>

</html>