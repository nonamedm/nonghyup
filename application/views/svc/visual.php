<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if ($m_id=='home') {?>

<?php } else {?>
<div class="section" id="visual">
    <div id="particles"></div>
    <div class="container">
        <div class="tit_block">
            <div class="pg_bullet"></div>
            <div class="pg_tit"><?php echo $pg_tit; ?></div>
            <div class="pg_loc"><?php echo $breadcrumb;?></div>
        </div>
        <?php //if ($g_id=='about' || $g_id=='brief' || $g_id=='trends') {?>
        <div class="bnr_block">
            <div class="bnr-item">
                <div><a href="/ko/improvement"><img src="/static/images/top_banner.PNG"></a></div>
                <div><a href="/ko/qna"><img src="/static/images/top_banner1.PNG"></a></div>
            </div>
        </div>
        <?php //}?>
    </div>
</div>
<?php }?>
