<?php

// ==================================================================
//
// 會回傳 url 的都放這
//
// ------------------------------------------------------------------

/**
*
* 跳轉到別的頁面，這裡主要是處理原生的　redirect 會網址會多個　? ex: /user/edit/ -> ?/user/edit
*
* @access	public
* @param	param (type) : param description
* @return 	return : return description
*
*/
function redirect_url($uri, $method = 'location', $http_response_code = 302) {
	if (!preg_match('#^https?://#i', $uri)){
		$uri = web_url($uri);
	}
	switch($method)
	{
		case 'refresh'	: header("Refresh:0;url=".$uri);
			break;
		default			: header("Location: ".$uri, TRUE, $http_response_code);
			break;
	}
	exit;
}

/**
*
* 回到首頁
*
* @access	public
* @param	param (type) : param description
* @return 	return : return description
*
*/
function redirect_home() {
	redirect_url('/');
}

/**
*
* 回到使用者首頁
*
* @access	public
* @param	param (type) : param description
* @return 	return : return description
*
*/
function redirect_user_home() {
	redirect_url('/user');
}

/**
*
* 回到登入頁
*
* @access	public
* @param	param (type) : param description
* @return 	return : return description
*
*/
function redirect_login($redirect_to = null) {
	$url = '/user/login';
	if(!is_null($redirect_to)) {
		$url .= '?redirect_to=' . esc_url($redirect_to);
	}
	redirect_url($url);
}

/**
 *
 * 取得現在的 uri
 *
 * @param type param
 *
 */
function current_uri() {
	return get_env('REQUEST_URI');
}

/**
*
* 回傳以網站 domain 為基礎的網址
*
* @access	public
* @param	param (type) : param description
* @return 	return : return description
*
*/
function web_url($uri = '') {
	return trim(base_url($uri), '/');
}

/**
*
* public image url
*
* @access	public
* @param	param (type) : param description
* @return 	return : return description
*
*/
function public_image_url($file_name) {
    $template_folder = get_image_folder();
	return web_url() . '/' . $template_folder . add_lslash($file_name);
}


/**
*
* public js url
*
* @access	public
* @param	param (type) : param description
* @return 	return : return description
*
*/
function public_js_url($file_name) {
    $template_folder = get_js_folder();
	return web_url() . '/' . $template_folder . add_lslash($file_name);
}

/**
*
* public css url
*
* @access	public
* @param	param (type) : param description
* @return 	return : return description
*
*/
function public_css_url($file_name) {
    $template_folder = get_css_folder();
	return web_url() . '/' . $template_folder . add_lslash($file_name);
}





