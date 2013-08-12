<?php

/**
*
* 需要登入的頁面
*
* @access	public
* @param	param (type) : param description
* @return 	return : return description
*
*/

class User_auth_filter extends Base_filter {

	function __construct($config = array()) {
		parent::__construct($config);

		// library
		$this->load->library(array('user_account_service'));
	}

	function before() {
		// 檢查登入與權限
		$is_logged = $this->user_account_service->is_logged();
		if(!$is_logged) {
			redirect_login();
		}
	}

	function after() {}

}
?>