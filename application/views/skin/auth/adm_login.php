<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="uk-card uk-card-default uk-card-body uk-width-1-3@m uk-align-center uk-margin-large-top uk-margin-large-bottom">
    <form id="form_login" action="/ko/auth/signin"  method="POST">
        <fieldset class="uk-fieldset">

            <div class="uk-margin">
                <div class="uk-inline uk-width-1-1@m">
                    <input class="uk-input" type="text" name="usr_id"  id="usr_id" placeholder="id">
                </div>
            </div>

            <div class="uk-margin">
                <div class="uk-inline uk-width-1-1@m">
                    <input class="uk-input" type="password" name="usr_pw"  id="usr_pw" placeholder="Password">
                </div>
            </div>

            <div class="uk-margin uk-child-width-expand@m uk-grid-small" uk-grid>
                <div>
                    <button class="uk-button uk-button-large uk-background-primary uk-light cb_round uk-width-1-1" type="submit">Login</button>
                </div>
                <div>
                    <button class="uk-button uk-button-large uk-background-muted cb_round uk-width-1-1" type="reset">Cancel</button>
                </div>
            </div>

        </fieldset>
    </form>
</div>
