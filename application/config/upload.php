<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ==================================================================
//
// 上傳的設定, upload_path 不設定交給 service 動態設定
//
// ------------------------------------------------------------------

// $config['upload_path'] = '';
$config['allowed_image_types'] = 'gif|jpg|png';
$config['allowed_file_types'] = 'docx|doc';
$config['overwrite'] = false;
$config['max_size'] = '1000000';
$config['max_width'] = '1024';
$config['max_height'] = '768';
$config['max_filename'] = 0;
$config['encrypt_name'] = true;
$config['remove_spaces'] = true;


