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

class User_permission_filter extends Base_filter {

	function __construct($config = array()) {
		parent::__construct($config);

		// library
		$this->load->library(array('user_permission_service'));
	}

	function before() {
		$result = $this->user_permission_service->check();
		if(is_my_error($result)) {
			redirect_home();
		}
	}

	function after() {}

}
?>