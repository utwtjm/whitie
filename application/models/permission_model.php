<?php

// ==================================================================
//
// 權限用的 model
//
// ------------------------------------------------------------------


class Permission_model extends MY_Model{

	// const
	const NAME_BACKEND_VIEW = 'backend_view'; 	// 後台遊覽權限
	const NAME_FORWARD_VIEW = 'forward_view'; 	// 前台遊覽的權限

	var $permission;

	function __construct() {
		parent::__construct();

		$this->permission = new Permission_Mapper();
	}

	/**
	*
	* 取得權限
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function get_by_name($name) {
		$permission = $this->permission->get_by_name($name);
		return $this->_get_row($permission);
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
		$permissions = $this->permission->where_related('group/user', 'id', $user_id)->get();
		return $this->_get_result($permissions);
	}

}


?>