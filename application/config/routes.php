<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'front';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['article/(:any)'] = 'post/view_post/$1';
$route['announcement/(:any)'] = 'announcement/view_announcement/$1';

$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';
$route['konsultasi'] = 'front/konsultasi';

 

