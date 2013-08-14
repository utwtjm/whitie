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

class User_auto_login_filter extends Base_filter {

	function __construct($config = array()) {
		parent::__construct($config);

		// library
		$this->load->library('user_account_service');
	}

	function before() {
		// 如果沒登入就導到登入頁
		$is_logged = is_logged();
		$encode_remember_me_cookie_name = get_cookie(user_account_service::REMEMBER_ME_COOKIE_NAME);
		if(!$is_logged) {
			try {
				$this->user_account_service->login_by_cookie($encode_remember_me_cookie_name);
			} catch (Exception $e) {
				// redirect_home();				
			}
		}
	}

	function after() {}
}
?>