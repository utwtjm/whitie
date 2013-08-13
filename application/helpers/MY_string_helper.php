<?php

// ==================================================================
//
// 擴充的 string helper
//
// ------------------------------------------------------------------

/**
 *
 * 將 url 編碼
 *
 * @param type param
 *
 */
function esc_url($url) {
	return urlencode(trim($url));
}

/**
 *
 * 將放入 html attr 的 value 編碼
 *
 * @param type param
 *
 */
function esc_attr($text, $flag = ENT_QUOTES) {
	return htmlspecialchars($text, $flag);
}

/**
 *
 * 傳入檔案路徑，新增額外的名字到完整的 file 路徑裡
 *
 * @param string file 完整的 file 路徑
 *
 */
function add_extra_file_name($file, $extra_info = null) {
	$file_basename = basename($file);
	$file_pathinfo = pathinfo($file_basename);
	if(!isset($file_pathinfo['extension'])) {
		return $file;
	}

	$file_name = $file_pathinfo['filename'];
	$file_ext = $file_pathinfo['extension'];
	$file_extra_info_name = $file_name . $extra_info . '.' . $file_ext;
	return str_replace($file_basename, $file_extra_info_name, $file);
}

/**
*
* 右邊加上 .css
*
* @access	public
* @param	path (string) : file path
* @return 	string : 加上 / 的 file path
*
*/
function add_css_ext($name){
	return str_replace('.css', '', $name) . '.css';
}


/**
*
* 右邊加上 .js
*
* @access	public
* @param	path (string) : file path
* @return 	string : 加上 / 的 file path
*
*/
function add_js_ext($name){
	return str_replace('.js', '', $name) . '.js';
}

/**
*
* 左邊加上 / 線
*
* @access	public
* @param	path (string) : file path
* @return 	string : 加上 / 的 file path
*
*/
function add_lslash($path){
	if(empty($path)) {
		return '';
	}
	return '/' . ltrim($path, '/');
}


/**
*
* 右邊加上 / 線
*
* @access	public
* @param	path (string) : file path
* @return 	string : 加上 / 的 file path
*
*/
function add_rslash($path){
	return rtrim($path, '/') . '/';
}

/**
*
* 如果 magic_quotes_gpc on 就去掉反斜線
*
* @access	public
* @param	param (type) : param description
* @return 	return : return description
*
*/
function strip_slashes_gpc($text) {
	if (get_magic_quotes_gpc()) {
        $text = stripslashes($text);
    }
    return $text;
}

/**
*
* 移除所有 tag
*
* @access	public
* @param	param (type) : param description
* @return 	return : return description
*
*/
function strip_all_tags($string, $remove_breaks = false) {
	$string = preg_replace('@<(script|style)[^>]*?>.*?</\\1>@si', '', $string);
	$string = strip_tags($string);
	if($remove_breaks) {
		$string = preg_replace('/[\r\n\t ]+/', ' ', $string);
	}
	return trim( $string );
}

/**
*
* 測試字串是不是 email
*
* @access	public
* @param	param (type) : param description
* @return 	return : return description
*
*/
function is_email($email) {
	// Test for the minimum length the email can be
	if(strlen($email) < 3) {
		return false;
	}

	// Test for an @ character after the first position
	if (strpos($email, '@', 1) === false) {
		return false;
	}

	// Split out the local and domain parts
	list($local, $domain) = explode('@', $email, 2);

	// LOCAL PART
	// Test for invalid characters
	if(!preg_match('/^[a-zA-Z0-9!#$%&\'*+\/=?^_`{|}~\.-]+$/', $local)) {
		return false;
	}

	// DOMAIN PART
	// Test for sequences of periods
	if(preg_match('/\.{2,}/', $domain)) {
		return false;
	}

	// Test for leading and trailing periods and whitespace
	if(trim($domain, " \t\n\r\0\x0B.") !== $domain) {
		return false;
	}

	// Split the domain into subs
	$subs = explode('.', $domain);

	// Assume the domain will have at least two subs
	if (count($subs) < 2) {
		return false;
	}

	// Loop through each sub
	foreach($subs as $sub) {

		// Test for leading and trailing hyphens and whitespace
		if(trim($sub, " \t\n\r\0\x0B-") !== $sub) {
			return false;
		}

		// 如果 domain 開頭是 0-9 a-z - 以外的字就回傳 false
		if(!preg_match('/^[a-z0-9-]+$/i', $sub)) {
			return false;
		}
	}

	// Congratulations your email made it!
	return true;
}




