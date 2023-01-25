<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'DC_service';
$route['ajax_controller'] = 'DC_ajax';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// admin
$route['mng/excel_dnload/(:any)']       = $route['default_controller'].'/manager/excel_dnload/$1';
$route['mng/excel_dnload1/(:any)']      = $route['default_controller'].'/manager/excel_dnload1/$1';
$route['mng/dashboard']                 = $route['default_controller'].'/manager/dashboard';
$route['mng/(:any)']                    = $route['default_controller'].'/manager/$1';
$route['mng']                           = $route['default_controller'].'/manager/dashboard';

// admin
$route['adm/(:any)/dnload']             = $route['default_controller'].'/dnload/$1';
$route['adm/excel_dnload/(:any)']       = $route['default_controller'].'/admin/excel_dnload/$1';
$route['adm/excel_dnload1']             = $route['default_controller'].'/admin/excel_dnload1';
$route['adm/dashboard']                 = $route['default_controller'].'/admin/dashboard';
$route['adm/(:any)']                    = $route['default_controller'].'/admin/$1';
$route['adm']                           = $route['default_controller'].'/admin/dashboard';

// oauth
$route['ko/auth/oauth']                 = $route['default_controller'].'/auth/oauth';
//$route['oauth/(:any)']                 = $route['default_controller'].'/oauth/$1';

// auth
$route['(:any)/auth/login']             = $route['default_controller'].'/auth/login';
$route['(:any)/auth/join']              = $route['default_controller'].'/auth/join';
$route['(:any)/auth/joinForm']          = $route['default_controller'].'/auth/joinForm';
$route['(:any)/auth/signin']            = $route['default_controller'].'/auth/signin';
$route['(:any)/auth/adm_login']         = $route['default_controller'].'/auth/adm_login';
$route['(:any)/auth/logout']            = $route['default_controller'].'/auth/logout';
$route['(:any)/auth/signup']            = $route['default_controller'].'/auth/signup';
$route['(:any)/auth/withdrawal']        = $route['default_controller'].'/auth/withdrawal';
$route['(:any)/auth/resetPw']           = $route['default_controller'].'/auth/resetPw';
$route['(:any)/auth/updatePw']          = $route['default_controller'].'/auth/updatePw';

// ajax
$route['(:any)/ajax/(:any)']            = $route['ajax_controller'].'/$2';

// hub bbs CV
$route['(:any)/(:any)/lists']           = $route['default_controller'].'/lists/$2';
$route['(:any)/(:any)/view']            = $route['default_controller'].'/view/$2';
$route['(:any)/(:any)/write']           = $route['default_controller'].'/write/$2';
$route['(:any)/(:any)/modify']          = $route['default_controller'].'/modify/$2';
$route['(:any)/(:any)/reply']           = $route['default_controller'].'/reply/$2';
// hub bbs CM
$route['(:any)/(:any)/insert']          = $route['default_controller'].'/insert/$2';
$route['(:any)/(:any)/update']          = $route['default_controller'].'/update/$2';
$route['(:any)/(:any)/delete']          = $route['default_controller'].'/delete/$2';
$route['(:any)/(:any)/dnload']          = $route['default_controller'].'/dnload/$2';


// ***** bbs,pg -> DC_common -> pg
$route['^(ko|en)/(:any)']               = $route['default_controller'].'/pg/$2';
//$route['^(/?).*']                       = $route['default_controller'].'/pg/cso';

// ***** lng
//$route['(:any)']                      = $route['default_controller'].'/pg/news';
$route['^(ko|en)$']                     = $route['default_controller'].'/pg/home';
//$route['index.php']                   = $route['default_controller'].'/pg/home';

// ***** /
$route['\/']                            = $route['default_controller'].'/pg/home';
