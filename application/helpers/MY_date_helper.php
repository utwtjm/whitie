<?php

// ==================================================================
//
// 回傳時間的都放這裡
//
// ------------------------------------------------------------------

/**
*
* 取得現在的日期時間
*
* @access	public
* @param	param (type) : param description
* @return 	return : return description
*
*/
function now_datetime($format = DATETIME_FORMAT) {
	$now = now();
	return format_time($format, $now); 		
}

/**
*
* 取得現在的日期
*
* @access	public
* @param	param (type) : param description
* @return 	return : return description
*
*/
function now_date($format = DATE_FORMAT) {
	$now = now();
	return format_time($format, $now); 	
}

/**
 *
 * 取得格式化的時間
 *
 * @param type param
 *
 */
function format_time($format, $time) {
	return date($format, $time);
}

?>
