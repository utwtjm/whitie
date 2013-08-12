<?php

// ==================================================================
//
// fake group model 用來代替 group model
//
// ------------------------------------------------------------------

class Fake_group_model extends Group_model{

	var $groups;
	var $user_id;

	function __construct() {

		parent::__construct();

		// init
		$this->user_id = 1;
		$this->groups[1] = array($this->get_group(group_model::TYPE_ADMIN));
		$this->groups[2] = array();

	}

	/**
	*
	* 取得一個 group
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function get_group($type = '') {

		$group = new stdClass();
		$group->type = $type;

		return $group;

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
		
		return $this->groups[$user_id];

	} 


}


?>