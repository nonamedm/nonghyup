<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="<?php echo $lng_cd; ?>">
<head>

    <?php if($this->session->flashdata('message')){
    /*
     *------------------------------
     * F L A S H D A T A (MESSAGE)
     *------------------------------
    */
    ?>
    <script>
        alert("<?php echo $this->session->flashdata('message')?>");
    </script>
    <?php $this->session->set_userdata('message',''); } ?>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/static/css/uikit.min.css">

    <link rel="stylesheet" type="text/css" href="/static/css/slick.css"/>
    <link rel="stylesheet" type="text/css" href="/static/css/slick-theme.css"/>

    <?php if( $fnc_typ=='bbs' || $m_id == 'search' ){?>
        <link rel="stylesheet" type="text/css" href="/assets/lib/jqueryui/jquery-ui.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css" rel="stylesheet">
    <?php } ?>
    <link rel="stylesheet" href="/static/css/common1.css">
    <link rel="stylesheet" href="/static/css/default3.css">
    <link rel="favicon" href="/favicon.ico">
    <link rel="shortcut icon" href="/favicon.png">
    <link rel="apple-touch-icon" href="/favicon.png">


    <title><?php echo $pg_tit;?>:: NH농협은행 규제대응지원포털</title>

    <meta name="Robots" content="ALL">
    <meta name="subject" content="">
    <meta name="description" content="">
    <meta name="author" content="grafish">
    <meta name="keywords" content="">

    <meta property="og:type" content="website">
    <meta property="og:title" content="NH농협은행 규제대응지원포털">
    <meta property="og:description" content="">
    <meta property="og:image" content="/law_nhbank.jpg">
    <meta property="og:url" content="http://law.nhbank.com/">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="NH농협은행 규제대응지원포털">
    <meta name="twitter:description" content="">
    <meta name="twitter:image" content="/law_nhbank.jpg">
    <meta name="twitter:domain" content="http://law.nhbank.com/">

    <!--<link rel="manifest" href="/manifest.json">-->
    <meta name="theme-color" content="#ffffff">

    <script>
        const m_id          = '<?php echo $m_id;?>';
        const g_id          = '<?php echo $g_id; ?>';
        const idx           = '<?php echo $idx; ?>';
        const cat           = '<?php echo $cat; ?>';
        const seg           = '<?php echo $seg; ?>';
        const s_word        = '<?php echo $s_word; ?>';
        const s_cat         = '<?php echo $s_cat; ?>';
        const s_sds         = '<?php echo $s_sds; ?>';
        const s_sde         = '<?php echo $s_sde; ?>';
        const s_fsw         = '<?php echo $s_fsw; ?>';

        const s_lng         = '<?php echo $s_lng; ?>';
        const s_fld         = '<?php echo $s_fld; ?>';
        const s_typ         = '<?php echo $s_typ; ?>';

        const lng_cd        = '<?php echo $lng_cd; ?>';
        const svc_mod       = '<?php echo $svc_mod; ?>';
        const usr_lv        = '<?php echo $usr_lv; ?>';
        <?php if(isset($usr_arr['usr_id']) && $usr_arr['usr_id']){ ?>
            const usr_id = '<?php echo $usr_arr['usr_id']; ?>';
        <?php }else{?>
            const usr_id = '';
        <?php }?>



        //console.log("s_word="+s_word);
        //console.log("s_cat="+s_cat);

        //console.log("s_sds="+s_sds);
        //console.log("s_sde="+s_sde);
        //console.log("s_lng="+s_lng);
        //console.log("s_fld="+s_fld);
        //console.log("s_typ="+s_typ);

        const bbs_mod = '<?php echo $bbs_mod; ?>';
        const bbs_perm = JSON.parse('<?php echo json_encode($bbs_perm); ?>');

        //console.log("usr_lv="+usr_lv);
        //console.log("bbs_mod="+bbs_mod);
        //console.log("bbs_perm="+bbs_perm[bbs_mod]);
    </script>