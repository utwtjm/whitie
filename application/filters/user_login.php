<?php

/**
*
* 登入後無法看到的畫面
*
* @access	public
* @param	param (type) : param description
* @return 	return : return description
*
*/

class User_login_filter extends Base_filter {

	function __construct($config = array()) {
		parent::__construct($config);

		// library
		$this->load->library('user_account_service');
	}

	function before() {
		// 如果沒登入就導到登入頁
		$is_logged = $this->user_account_service->is_logged();
		if($is_logged) {
			redirect_home();
		}
	}

	function after() {}
}
?>