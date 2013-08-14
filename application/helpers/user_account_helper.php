<?php

/**
*
* 使用者是否有登入
*
* @access	public
* @param	param (type) : param description
* @return 	return : return description
*
*/
function is_logged() {
	$ci =& get_instance();
	$ci->load->library('user_account_service');
	$user_data = $ci->user_account_service->get_login_user_data();
	if(empty($user_data)) {
		return false;
	}
	$user_id = $user_data->get_var('user_id');
	return !empty($user_id);
}

/**
*
* 取得現在登入的人，他的 user_id
*
* @access	public
* @param	param (type) : param description
* @return 	return : return description
*
*/
function get_login_id() {
	$ci =& get_instance();
	$ci->load->library('user_account_service');
	$user_data = $ci->user_account_services->get_login_user_data();
	if(empty($user_data)) {
		return 0;
	}
	$user_id = $user_data->get_var('user_id');
	return $user_id ? $user_id : 0;
}
