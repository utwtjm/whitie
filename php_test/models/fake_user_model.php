<?php

// ==================================================================
//
// fake user model 用來代替 user model
//
// ------------------------------------------------------------------

class Fake_user_model extends User_model{

	var $users = array();

	function __construct() {
		parent::__construct();

		$this->users[] = $this->get_user('a11', '123456', 'utwtjm@gmail.com', 1, '430ee76c');
	}

	/**
	*
	* 取得 user 
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function get_user($name, $pass, $email, $id = 0, $act_key) {
		$user = new User_Mapper();
		$user->set_var('name', $name);
		$user->set_var('pass', md5($pass));
		$user->set_var('email', $email);
		$user->set_var('id', $id);
		$user->set_var('act_key', $act_key);
		return $user;
	}

	/**
	*
	* 用某些欄位尋找 user
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function find_user_by_field($fields) {
		foreach($this->users as $user) {
			// 尋找 user，如果有一個欄位不符就代表不符
			$is_find = true;
			foreach($fields as $field => $value) {
				if($user->get_var($field) != $value) {
					$is_find = false;
				}
			}

			// 有找到就 return user
			if($is_find) {
				return $user;
			}
		}
		return false;
	}

	/**
	*
	* 用 name 取得 user 
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function get_by_name($name) {
		return $this->find_user_by_field(array('name'=>$name));
	}

	/**
	*
	* 用 id 取得 user 
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function get_by_id($id) {
		return $this->find_user_by_field(array('id'=>$id));
	}

	/**
	*
	* 用 email 取得 user 
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function get_by_email($email) {
		return $this->find_user_by_field(array('email'=>$email));
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
		return $this->find_user_by_field(array('name'=>$name, 'pass'=>$pass));
	}

}


?>