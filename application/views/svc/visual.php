<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if ($m_id=='home') {?>

<?php } else {?>
<div class="section" id="visual">
    <div id="particles"></div>
    <div class="container">
        <div class="tit_block">
            <div class="pg_bullet"></div>
            <div class="pg_tit">
                <?php 
                    if($m_id=='prevmnlaun1') {
                        echo '국내제재사례';    
                    } else if($m_id=='prevmnlaun2') {
                        echo '국외제재사례';
                    } else if($m_id=='prevmnlaun3') {
                        echo '정부보도자료';
                    } else if($m_id=='prevmnlaun4') {
                        echo 'NEWS';
                    } else if($m_id=='prevmnlaun5') {
                        echo 'AML BRIEF';
                    } else {
                        echo $pg_tit;
                    }
                ?>
            </div>
            <div class="pg_loc"><?php echo $breadcrumb;?></div>
        </div>
        <?php //if ($g_id=='about' || $g_id=='brief' || $g_id=='trends') {?>
        <!-- <div class="bnr_block">
            <div class="bnr-item">
                <div><a href="/ko/improvement"><img src="/static/images/top_banner.PNG"></a></div>
                <div><a href="/ko/qna"><img src="/static/images/top_banner1.PNG"></a></div>
            </div>
        </div>  요청에 의한 숨김처리 -->
        <?php //}?>
    </div>
</div>
<?php }?>
