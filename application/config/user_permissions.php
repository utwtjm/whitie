<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ==================================================================
//
// 沒有設定在這裡的 url ，代表不用權限
//
// ------------------------------------------------------------------

// 後台遊覽權限可以看的頁面
$config['backend_view'] = array('admin_home/index');

// 前台遊覽的權限
$config['forward_view'] = array('user/edit');


