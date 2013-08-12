<?php

// ==================================================================
//
// 測試 user_permission_service
//
// ------------------------------------------------------------------

class test_user_permission_service extends CodeIgniterUnitTestCase {

    var $admin_url;
    var $user_url;

	public function __construct() {
		parent::__construct();

		// library
		$this->load->library('user_permission_service');
	}

    /**
     *
     * 取得沒有設定過的權限
     *
     * @param type param
     *
     */
    public function test_get_config_urls_and_no_config() {
        $config_urls = $this->user_permission_service->get_config_urls('foo');
        $this->assertFalse($config_urls);
    }

     /**
     *
     * 取得所有設定過的權限
     *
     * @param type param
     *
     */
    public function test_get_config_urls_and_has_config() {
        $config_urls = $this->user_permission_service->get_config_urls();
        $this->assertTrue(is_array($config_urls));
    }

    /**
    *
    * 登入的人是後台管理者
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_check_and_is_admin_user() {
        $user = $this->user_model->get_by_id(1);
        $this->user_account_service->login($user);

        $have_permission = $this->user_permission_service->check('admin_home/index');
        $this->assertTrue($have_permission);

        $have_permission = $this->user_permission_service->check('user/edit');
        $this->assertTrue($have_permission);
    }

    /**
    *
    * 登入的人是一般使用者
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_check_and_is_register_user() {
        $user = $this->user_model->get_by_id(9);
        $this->user_account_service->login($user);

        $have_permission = $this->user_permission_service->check('admin_home/index');
        show_result($have_permission);
        $this->assertTrue(is_my_error($have_permission));

        $have_permission = $this->user_permission_service->check('user/edit');
        $this->assertTrue($have_permission);
    }

    /**
    *
    * 登入的人是一般使用者，去看了一個沒有設定權限的頁面
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_check_and_is_register_user_and_not_set_url() {
        $user = $this->user_model->get_by_id(9);
        $this->user_account_service->login($user);

        $have_permission = $this->user_permission_service->check('home222/index');
        $this->assertTrue($have_permission);
    }

    /**
    *
    * 在 config user_permission 下沒有設定 url
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_user_permission_has_url_and_has_not_set_url() {
        $check = $this->user_permission_service->user_permission_has_url('home222/index', 9);
        $this->assertTrue($check);
    }

     /**
    *
    * user 不能看某個 url
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_user_permission_has_url_and_has_not_url() {
        $check = $this->user_permission_service->user_permission_has_url('admin_home/index', 9);
        $this->assertTrue(is_my_error($check));
    }

    /**
    *
    * user 可以看某個 url
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_user_permission_has_url_and_has_url() {
        $check = $this->user_permission_service->user_permission_has_url('admin_home/index', 1);
        $this->assertTrue($check);
    }

    /**
     *
     * 取得 permission_name 
     *
     * @param type param
     *
     */
    public function test_get_permission_name_by_uri_and_has_permission() {
        $permission_name = $this->user_permission_service->get_permission_name_by_uri('user/edit');
        show_result($permission_name);
        $this->assertTrue($permission_name == 'forward_view');
    }

}

?>