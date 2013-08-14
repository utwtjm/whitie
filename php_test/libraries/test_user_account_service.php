<?php

// ==================================================================
//
// 測試 user_account_service
//
// ------------------------------------------------------------------

class test_user_account_service extends CodeIgniterUnitTestCase {

    var $user_id;

	public function __construct() {
		parent::__construct();

		// library
		$this->load->library(array('user_account_service', 'user_group_service'));
	}

	public function setUp() {}

    public function tearDown() {}

    /**
    *
    * 測試帳號登入正確
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_auth_and_error() {
        $auth = $this->user_account_service->auth('a11', '1234561');
        $this->assertTrue($auth->has_error());
    }

    /**
    *
    * 測試帳號登入正確
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_auth_and_success() {
        $result = $this->user_account_service->auth('a11', '123456');
        show_result($result);
        $this->assertTrue($result->get_var('id') == 1);
    }

    /**
     *
     * 取得 user group type 
     *
     * @param type param
     *
     */
    public function test_get_group_types_and_user_id_not_exist() {
        try {
            $group_types = $this->user_account_service->get_group_types(88);
        } catch (Exception $e) {
            $this->assertEqual(lang_get('user_not_exist'), $e->getMessage());            
        }
    }

     /**
     *
     * 取得 user group type 
     *
     * @param type param
     *
     */
    public function test_get_group_types_and_user_id_exist() {
        $group_types = $this->user_account_service->get_group_types(1);
        $this->assertTrue(count($group_types) == 2);
    }


    /**
     *
     * 登入一個不存在的使用者
     *
     * @param type param
     *
     */
    function test_login_and_user_not_exist() {
        try {
            $user = $this->user_model->get_by_id(88);
            $user_id = $this->user_account_service->login($user);
        } catch (Exception $e) {
            $this->assertEqual($e->getMessage(), lang_get('user_not_exist'));
        }
    }

     /**
     *
     * 登入一個存在的使用者
     *
     * @param type param
     *
     */
    function test_login_and_user_exist() {
        $user = $this->user_model->get_by_id(1);
        $user_id = $this->user_account_service->login($user);
        $this->assertTrue($user_id == 1);
    }

    /**
    *
    * 取得 login 的 user_id，有登入
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_get_login_id_and_has_login() {
        $user = $this->user_model->get_by_id(1);
        $this->user_account_service->login($user);
        $login_user_id = $this->user_account_service->get_login_id();
        $this->assertTrue($login_user_id == 1);
    }

     /**
    *
    * 取得 login 的 user_id，未登入
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_get_login_id_and_not_login() {
        $this->user_account_service->logout();
        $login_user_id = $this->user_account_service->get_login_id();
        $this->assertTrue($login_user_id === 0);
    }

    /**
    *
    * 測試如果一個人登入後，is_logged 是否正確
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_is_logged_and_has_login() {
        $user = $this->user_model->get_by_id(1);
        $this->user_account_service->login($user);
        $is_logged = is_logged();
        $this->assertTrue($is_logged);
    }


    /**
    *
    * 測試如果一個人登入後，is_logged 是否正確
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_is_logged_and_not_login() {
        $this->user_account_service->logout();
        $is_logged = is_logged();
        $this->assertTrue($is_logged === false);
    }

    /**
     *
     * 設定 user remember cookie，因為在單一頁設定 cookie，需要再 reload 一次才會得到上次的值，但在 unit test 裡卻不是這樣，原因待查
     *
     * @param type param
     *
     */
    public function test_set_remember_me() {
        $this->user_account_service->set_remember_me(1, '123456');
        $result = get_cookie('remember_me');
        show_result($result);
    }

     /**
     *
     * 取消 remember me
     *
     * @param type param
     *
     */
    public function test_unset_remember_me() {
        $this->user_account_service->unset_remember_me();
    }

    /**
     *
     * 取得要記在 cookie 裡的 remeber_me value
     *
     * @param type param
     *
     */
    public function test_get_encode_remeber_me_value_and_vaild_value() {
       $remember_me_value = $this->user_account_service->get_encode_remeber_me_value(1, '123456');
       $this->assertTrue($remember_me_value == '1' . '-' . $this->user_register_service->encode_pass('123456'));
    }

    /**
     *
     * 解析 cookie 裡的 remeber_me value
     *
     * @param type param
     *
     */
    public function test_get_decode_remeber_me_value_and_not_vaild_value() {
       try {
            $remember_me_value = '1123456';
            $decode_remember_me_value = $this->user_account_service->get_decode_remeber_me_value($remember_me_value);
       } catch (Exception $e) {
            $this->assertEqual($e->getMessage(), lang_get('user_remember_cookie_not_vaild'));
       }
    }

     /**
     *
     * 解析 cookie 裡的 remeber_me value，但數值不正確
     *
     * @param type param
     *
     */
    public function test_get_decode_remeber_me_value_and_vaild_value() {
       $remember_me_value = '1-123456';
       $result = $this->user_account_service->get_decode_remeber_me_value($remember_me_value);
       $this->assertTrue($result['user_id'] == 1);
    }

}

?>