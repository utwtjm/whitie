<?php

// ==================================================================
//
// fake permission model 用來代替 group model
//
// ------------------------------------------------------------------

class Fake_permission_model extends Permission_model{

	var $permissions = array();

	function __construct() {

		parent::__construct();

		// library
		$this->load->library(array('user_permission_service'));

		// init
		$this->permissions[1] = array($this->get_permission(permission_model::NAME_BACKEND_VIEW), $this->get_permission(permission_model::NAME_FORWARD_VIEW));
		$this->permissions[2] = array($this->get_permission(permission_model::NAME_FORWARD_VIEW));

	}

	function get_permission($name = '') {
		$permission = new Permission_Mapper();
		$permission->set_var('name', $name);
		return $permission;
	}

	/**
	*
	* 取得 user 的權限
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function get_by_user_id($user_id) {

		return $this->permissions[$user_id];

	}

}


?>