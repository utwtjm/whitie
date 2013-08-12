<?php

// ==================================================================
//
// test permission model
//
// ------------------------------------------------------------------


class Test_permission_model extends CodeIgniterUnitTestCase {

	var $user_id;

	public function __construct() {
		parent::__construct();

		// library
		$this->load->library(array('user_permission_service'));

		// model
		$this->load->model(array('permission_model'));
	}

	public function setUp() {}

    public function tearDown() {}

    /**
	*
	* 取得 user 的權限
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function test_get_by_user_id() {
		$permissions = $this->permission_model->get_by_user_id(1);
		$this->assertTrue($permissions[0]->get_var('id') == 1);
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
	function test_get_by_name() {
		$permission = $this->permission_model->get_by_name(permission_model::NAME_BACKEND_VIEW);
		$this->assertTrue($permission->get_var('id') == 1);
	}

}


?>