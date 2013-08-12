<?php

// ==================================================================
//
// 群組用的 model
//
// ------------------------------------------------------------------


class Group_model extends MY_Model{

	// const
	const TYPE_ADMIN = 'admin';		// 管理員
	const TYPE_USER = 'user';		// 註冊會員
	const TYPE_GUESS = 'guess';		// 訪客

	var $group;

	function __construct() {
		parent::__construct();

		// init
		$this->group = new Group_Mapper();
	}


	/**
	*
	* 取得某個 user 的 group
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function get_by_user_id($user_id) {
		$groups = $this->group->where_related_user('id', $user_id)->get();
		return $this->_get_result($groups);
	}

	/**
	*
	* 取得某個 group
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function get_by_type($type) {
		$group = $this->group->get_by_type('type')->get();
		return $this->_get_row($group);
	}

}


?>