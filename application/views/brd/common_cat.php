<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="uk-placeholder brd_cat">
    <div class="cat">
        <select class="uk-select" id="cat1">
            <option value="common" <?php if($cat=='common'){echo 'selected';}?>>공통관련법규</option>
            <option value="bank" <?php if($cat=='bank'){echo 'selected';}?>>은행관련법규</option>
            <option value="investment" <?php if($cat=='investment'){echo 'selected';}?>>금융투자관련법규</option>
            <option value="microfinance" <?php if($cat=='microfinance'){echo 'selected';}?>>비은행관련법규</option>
        </select>
    </div>
</div>