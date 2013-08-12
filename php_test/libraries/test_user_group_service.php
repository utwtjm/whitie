<?php

// ==================================================================
//
// 測試 user_group_service
//
// ------------------------------------------------------------------


class test_user_group_service extends CodeIgniterUnitTestCase {

    var $user_name;
    var $user_pass;
    var $user_error_pass;
    var $has_group_user_id;
    var $has_not_group_user_id;

	public function __construct() {
		parent::__construct();

		// library
		$this->load->library(array('user_group_service'));
	}

	public function setUp() {}

    public function tearDown() {}

    /**
    *
    * 登入的人為 admin group
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_is_admin_and_admin_user() {
        $this->user_account_service->logout();
        $user = $this->user_model->get_by_id(1);
        $this->user_account_service->login($user);
        $is_admin_group = $this->user_group_service->is_admin();
        $this->assertTrue($is_admin_group);
    }

    /**
    *
    * 設定登入的人不是 admin group
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_is_admin_and_not_admin_user() {
        $this->user_account_service->logout();
        $user = $this->user_model->get_by_id(9);
        $this->user_account_service->login($user);
        $is_admin_group = $this->user_group_service->is_admin();
        $this->assertFalse($is_admin_group);
    }

}

?>