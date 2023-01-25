<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<div class="uk-section">
    <div class="uk-container">

        <div class="uk-card uk-card-default uk-card-body uk-width-1-3@m uk-width-1-2@s uk-align-center">
            <form id="pwForm" action="" method="POST">
                <input class="uk-input" type="hidden" name="usr_id"  id="usr_id" value="<?php echo $usr_id;?>">

                <fieldset class="uk-fieldset">

                    <div class="uk-margin">
                        <div class="uk-inline uk-width-1-1@m">
                            <span class="uk-form-icon" uk-icon="icon: lock"></span>
                            <input class="uk-input chk" type="password" name="usr_pw"  id="usr_pw" placeholder="Password">
                        </div>
                    </div>

                    <div class="uk-margin">
                        <div class="uk-inline uk-width-1-1@m">
                            <span class="uk-form-icon" uk-icon="icon: lock"></span>
                            <input class="uk-input chk" type="password" id="usr_pw_confirm" placeholder="Re-password">
                        </div>
                    </div>
                    <div class="uk-placeholder uk-background-muted">영문/숫자/특수문자 포함:8~20자<br>
                        ( <span class="uk-text-meta uk-padding-small uk-display-inline-block">!  @  #  $  %  ^  &  +  =  </span> )</div>
                    <div class="uk-margin uk-child-width-expand@m uk-grid-small" uk-grid>
                        <div>
                            <button class="uk-button uk-button-large uk-background-primary uk-light cb_round uk-width-1-1" type="submit">OK</button>
                        </div>
                        <div>
                            <a href="/<?php echo $seg;?>/mypage" class="uk-button uk-button-large uk-background-muted cb_round uk-width-1-1" type="button">Cancel</a>
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>

    </div>
</div>