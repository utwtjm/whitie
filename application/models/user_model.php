<?php

// ==================================================================
//
// user 用的 model
//
// ------------------------------------------------------------------


class User_model extends MY_Model{

	var $user;

	function __construct() {
		parent::__construct();

		// init
		$this->user = new User_Mapper();
	}

	/**
	*
	* 依 name 取得 user 
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function get_by_email($email) {
		$user = $this->user->where('email', $email)->get();
		return $this->_get_row($user);
	}

	/**
	*
	* 依 name 取得 user 
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function get_by_name($name) {
		$user = $this->user->get_by_name($name);
		return $this->_get_row($user);
	}

	/**
	*
	* 依 id 取得 user 
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function get_by_id($id) {
		$user = $this->user->get_by_id($id);
		return $this->_get_row($user);
	}

	/**
	*
	* 新增一個 user 
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function create($user) {
		return $this->_create($user);
	}

	/**
	*
	* 依 name pass 取得 user
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function get_by_name_and_pass($name, $pass) {
		$user = $this->user->get_where(array('name' => $name, 'pass' => $pass));
		return $this->_get_row($user);
	}

	/**
	*
	* 依 id pass 取得 user
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function get_by_id_and_pass($id, $pass) {
		$user = $this->user->get_where(array('id' => $id, 'pass' => $pass));
		return $this->_get_row($user);
	}

	/**
	*
	* 取得所有的 user
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function get_all() {
		$users = $this->user->get();
		return $this->_get_result($users);
	}

	/**
	 *
	 * 更新 user 
	 *
	 * @param type param
	 *
	 */
	public function update($user) {
		$user_field = $user->get_vars();
		$this->user->where('id = ', $user_field['id'])->update($user_field);
	}

}


?>