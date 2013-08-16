<?php

// ==================================================================
//
// 讀取 config 的 functions
//
// ------------------------------------------------------------------

/**
*
* config layout folder
*
* @access	public
* @param	param (type) : param description
* @return 	return : return description
*
*/
function layout_folder() {
    return config_get('OCU_layout_folder');
}

/**
*
* 取得 config 設定值
*
* @access	public
* @param	param (type) : param description
* @return 	return : return description
*
*/
function config_get($item = null, $index = null) {
    $ci =& get_instance();

    if(empty($item) && empty($index)) {
    	return $ci->config->config;
    }

    if(empty($item) && !empty($index)) {
    	return $ci->config->config[$index];
    }

    $val = $ci->config->item($item, $index);
    if(is_array($val) && count($val) >= 0) {
    	return $val;
    }

    return $val ? $val : false;
}

/**
*
* 取得權限的 config
*
* @access	public
* @param	param (type) : param description
* @return 	return : return description
*
*/
function permission_config_get($item = null) {
	$user_permissions = config_get($item, 'user_permissions');
	return $user_permissions;
}

/**
*
* 取得 upload 的 config
*
* @access   public
* @param    param (type) : param description
* @return   return : return description
*
*/
function upload_config_get($item = '') {
    $upload = config_get($item, 'upload');
    return $upload;
}


/**
*
* 取得 public folder
*
* @access   public
* @param    param (type) : param description
* @return   return : return description
*
*/
function get_public_folder($type) {
    $type = strtoupper($type);
    $constant_name = sprintf('PUBLIC_%s_FOLDER', $type);
    $theme_folder = constant($constant_name);
    return $theme_folder;
}


/**
*
* 取得 public js template folder
*
* @access   public
* @param    param (type) : param description
* @return   return : return description
*
*/
function get_js_folder() {
    return get_public_folder('js');
}

/**
*
* 取得 public css template folder
*
* @access   public
* @param    param (type) : param description
* @return   return : return description
*
*/
function get_css_folder() {
    return get_public_folder('css');
}


/**
*
* 取得 public image template folder
*
* @access   public
* @param    param (type) : param description
* @return   return : return description
*
*/
function get_image_folder() {
    return get_public_folder('imgs');
}



