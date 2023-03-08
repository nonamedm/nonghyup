<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

/*
 * ------------------------------
 * F I L E - L I S T
 * ------------------------------
*/
if($bbs_mod == 'list')
{
    if($list[$i]['files']) 
    {        
        if($list[$i]['files'][0][9])
        { 
?>
        <div class="uk-margin-small-top product_box">
            <img src="/static/data/<?php echo $file_upload_dir;?>/<?php echo $list[$i]['files'][0][4];?><?php echo $list[$i]['files'][0][7];?>">
        </div>
        <?php 
        }
    }
    else
    {
        echo '<div class="uk-margin-small-top product_box uk-inline">';
            echo '<img src="https://dummyimage.com/250x250/eee/eee">';
            echo '<span class="uk-position-center">No Image</span>';
        echo '</div>';
    }
}



/*
 * ------------------------------
 * F I L E - V I E W
 * ------------------------------
*/
else if($bbs_mod == 'view')
{
    if($view['files']) 
    { 
        for($i=0; $i<count($view['files']); $i++)
        {
?>
    <div class="view_line mrgT50">

            <!--<span class="v_tit uk-text-meta"><?php /*echo $form_arr['files']['label'][$lng_idx].($i+1); */?> : </span><span>
                <?php /*if( !$view['files'][$i][9] ){ */?><a href="/<?php /*echo $seg;*/?>/<?php /*echo $file_upload_dir;*/?>/dnload?idx=<?php /*echo $view['idx']; */?>&fl=<?php /*echo $i; */?>"><?php /*} */?>
                <?php /*echo $view['files'][$i][5];*/?>
                <?php /*if( !$view['files'][$i][9] ){ */?></a><?php /*} */?>
            </span>-->
            <?php if($view['files'][$i][9]){ ?>
            <div class="uk-margin-small-top"><img src="/static/data/<?php echo $file_upload_dir;?>/<?php echo $view['files'][$i][4];?><?php echo $view['files'][$i][7];?>"></div>
            <?php } ?>

    </div>
<?php
        }
    }
}    
/*
 * ------------------------------
 * F I L E - W R I T E
 * ------------------------------
*/
else if($bbs_mod == 'write')
{
    for($i=0; $i<$upload_files_num; $i++ )
    { 
        $files_nm = $form_arr['files']['placeholder'][$lng_idx];
?>
    <div class="uk-display-block uk-margin-small file_box uk-grid">
        <label class="uk-form-label">첨부파일 <?php echo $i+1;?></label>
        <div class="uk-form-controls" uk-form-custom="target: true">
            <input type="file" id="file<?php echo $i;?>" name="file<?php echo $i;?>">
            <input class="uk-input uk-margin-small-bottom file_input" id="file_nm<?php echo $i;?>" type="text" placeholder="<?php echo $files_nm;?>" disabled>
        </div>
        <div class="uk-margin-small uk-width-1-4@m">
            <label class="uk-form-label">다운로드 가부</label>
            <div class="uk-form-controls">
                <input class="uk-checkbox" type="checkbox" name="download_yn" value="Y" checked> 체크시 다운로드 가능
            </div>
        </div>
    </div>
    

    <!--<div class="uk-display-block" uk-form-custom="target: true">
        <input type="file" id="file<?php /*echo $i;*/?>" name="file<?php /*echo $i;*/?>">
        <input class="uk-input uk-form-width-medium uk-margin-small-bottom" type="text" placeholder="<?php /*echo $files_nm;*/?>" disabled>
    </div>-->
<?php 
    } 
}
/*
 * ------------------------------
 * F I L E - M O D I F Y
 * ------------------------------
*/
else if($bbs_mod == 'modify') {
?>
<div class="uk-display-block">
<?php
for ($i=0; $i<$upload_files_num; $i++) {
    $files_nm = '파일선택';
    if (isset($file[$i]) && $file[$i]) {
        $files_nm = $file[$i]['orig_name'];
        $files_download_yn = $file[$i]['download_yn'];
    }
?>
    <div class="uk-display-block uk-margin-small file_box">
        <label class="uk-form-label">첨부파일 <?php echo $i+1;?></label>
        <div class="uk-form-controls" uk-form-custom="target: true">
            <input type="file" id="file<?php echo $i;?>" name="file<?php echo $i;?>" class="file_input">
            <input class="uk-input uk-margin-small-bottom file_input" id="file_nm<?php echo $i;?>" type="text" placeholder="<?php echo $files_nm;?>" disabled>
            <?php if (isset($file[$i]) && $file[$i]) { ?>
            <input type="checkbox" class="uk-checkbox uk-margin-left" style="z-index: 10;" name="del<?php echo $i;?>" value="1" > 삭제
            <?php } ?>
        </div>
        <div class="uk-margin-small uk-width-1-4@m">
            <label class="uk-form-label">다운로드 가부</label>
            <div class="uk-form-controls">
                <input class="uk-checkbox" type="checkbox" name="download_yn" 
                    value="Y" <?php if($files_download_yn=='Y'){ echo 'checked';}?>> 체크시 다운로드 가능
            </div>
        </div>
    </div>
<?php
}
?>
</div>
<?php }?>