<?php defined('BASEPATH') OR exit('No direct script access allowed');
?><div id="content">

<?php if($m_id=='about'){ // 포털소개 ?>





<?php } else { // 기타 ?>
        <?php if($m_id=='home' || $g_id=='auth'){ // 메인 ?>


        <?php } else { // 서브 ?>
        <!-- content start -->
        <div class="cont_body">

            <div class="left_menu">
                <?php $this->load->view("inc/SNB");?>
            </div>

            <!-- cont start -->
            <div class="right_cont">

        <?php } ?>

<?php }  ?>


