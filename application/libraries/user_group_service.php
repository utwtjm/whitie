<?php

// ==================================================================
//
// group 用 service
//
// ------------------------------------------------------------------


class User_group_service extends Base_service {

	function __construct() {
		parent::__construct();
	}

	/**
	*
	* 檢查 user 是不是在某個 group
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function check($group, $user_id = null) {
        $group_types = $this->user_account_service->get_group_types($user_id);
        if(in_array($group, $group_types)) {
        	return true;
        }
	}

	/**
	*
	* user 是不是在 admin group
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function is_admin($user_id = null) {
		return $this->check(group_model::TYPE_ADMIN);
	}
	
}

?>