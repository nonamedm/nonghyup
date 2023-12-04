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
        <label class="uk-form-label">팝업이미지 첨부</label>
        <div class="uk-form-controls" uk-form-custom="target: true">
            <input type="file" id="file<?php echo $i;?>" name="file<?php echo $i;?>"  accept=".jpg, .jpeg, .png, .gif .bmp" onchange="onChangeFile()">
            <input class="uk-input uk-margin-small-bottom file_input" id="file_nm<?php echo $i;?>" type="text" placeholder="<?php echo $files_nm;?>" disabled>
        </div>
    </div>
    <script>
        function onChangeFile () {
            var file_type = $("#file0")[0].files[0].type.indexOf("image");
         
            //console.log($("#file0")[0].files[0].type.indexOf("image"));
            // 허용되지 않은 확장자일 경우
            if (file_type<0) {
                alert("이미지 파일만 업로드 가능합니다.");
                $("#file0").val("");
            }
        }
    </script>
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
        <label class="uk-form-label">팝업이미지 첨부</label>
        <div class="uk-form-controls" uk-form-custom="target: true">
            <input type="file" id="file<?php echo $i;?>" name="file<?php echo $i;?>" class="file_input" accept=".jpg, .jpeg, .png, .gif .bmp" onchange="onChangeFile()">
            <input class="uk-input uk-margin-small-bottom file_input" id="file_nm<?php echo $i;?>" type="text" placeholder="<?php echo $files_nm;?>" disabled>
        </div>        
    </div>
    <script>
        function onChangeFile () {
            var file_type = $("#file0")[0].files[0].type.indexOf("image");
         
            //console.log($("#file0")[0].files[0].type.indexOf("image"));
            // 허용되지 않은 확장자일 경우
            if (file_type<0) {
                alert("이미지 파일만 업로드 가능합니다.");
                $("#file0").val("");
            }
        }
    </script>
<?php
}
?>
</div>
<?php }?>