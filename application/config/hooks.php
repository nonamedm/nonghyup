<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/


/*
 *----------------------------------------
 * SVC_CLS
 *----------------------------------------
*/
$hook['pre_controller'] = array(
    'class'    => 'DC_seg',
    'function' => 'get_lng_cd',
    'filename' => 'DC_seg.php',
    'filepath' => 'hooks'
);
