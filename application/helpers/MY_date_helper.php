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
function now_datetime() {
	$now = now();
	return date("Y-m-d H:i:s", $now); 	
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
function now_date() {
	$now = now();
	return date("Y-m-d", $now); 	
}

?>
