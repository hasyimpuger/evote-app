<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;


$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';
$route['live-count'] = 'vote/live_count';

$route['vote'] = 'vote/index';
$route['vote/ajax_count'] = 'vote/ajax_count';
$route['vote/table_count'] = 'vote/table_count';
$route['vote/comment_live'] = 'vote/comment_live';
$route['vote/finish'] = 'vote/finish';
$route['vote/(:any)'] = 'vote/selected/$1';

$route['backdoor'] = 'auth/admin_login';