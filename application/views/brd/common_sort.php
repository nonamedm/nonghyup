<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?php if(count($lists)>0){ ?>
<div class="brd_sort">
    <?php if($m_id=='usr'){?>
    <div class="sort">
        <a href="#" class="uk-label usr_ord new">최근가입일순</a>
        <a href="#" class="uk-label usr_ord old">마지막로그인순</a>
    </div>
    <?php }else if($m_id!='current'){?>
    <div class="sort">
        <a href="#" class="uk-label ord new">최신순</a>
        <a href="#" class="uk-label ord old">오래된순</a>
    </div>
    <?php }?>
</div>
<?php } ?>