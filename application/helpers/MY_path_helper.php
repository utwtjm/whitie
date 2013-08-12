<?php

// ==================================================================
//
// 會回傳 file path 的都放這
//
// ------------------------------------------------------------------

/**
 *
 * 一個檔案的真實路徑
 *
 * @param type param
 *
 */
function real_file($file) {
	return REAL_APPPATH . '/' . $file;
}

/**
 *
 * 一個檔案的真實目錄
 *
 * @param type param
 *
 */
function real_folder($folder) {
	return REAL_APPPATH . '/' . $folder;
}

/**
*
* 取得上傳到 upload folder 後檔案的路徑
*
* @access	public
* @param	param (type) : type 預設為 web，則會回傳 domain 開頭的 url
* @return 	return : return description
*
*/
function upload_file($file = null, $size = array()) {
	if(empty($size)) {
		$extra_info = null;
	} else {
		$extra_info = '-' . implode('x', $size);
	}
	return add_extra_file_name(UPLOAD_FOLDER . '/' . $file, $extra_info);
}


/**
 *
 * 取得上傳到 upload folder 後檔案的 web 路徑
 *
 * @param type param
 *
 */
function upload_web_file($file = null, $size = array()) {
	$upload_file = upload_file($file, $size);
	return web_url($upload_file);
}

/**
 *
 * 取得上傳到 upload folder 後檔案的 real 路徑
 *
 * @param type param
 *
 */
function upload_real_file($file = null, $size = array()) {
	$upload_file = upload_file($file, $size);
	return real_file($upload_file);
}

?>