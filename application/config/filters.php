<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Filters configuration
| -------------------------------------------------------------------
|
| Note: The filters will be applied in the order that they are defined
|
| Example configuration:
|
| $filter['auth'] = array('exclude', array('login/*', 'about/*'));
| $filter['cache'] = array('include', array('login/index', 'about/*', 'register/form,rules,privacy'));
|
*/

// 基本的 filter ，每個 filter 都要 extends
$filter['base'] = array('exclude', array());

// remember me 自動登入
$filter['user_auto_login'] = array('exclude', array());

// 有權限才能看的頁面
$filter['user_auth'] = array('include', array('admin_home/index', 'user/edit'));

// 有權限才能看的頁面
$filter['user_permission'] = array('exclude', array());

// user 登入後無法看到的畫面
$filter['user_login'] = array('include', 
		array(
			'user/login',
			'register/*'
		));


?>