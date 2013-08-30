<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ==================================================================
//
// 測試 facebook
//
// ------------------------------------------------------------------

class Test_facebook_service extends Test_Controller {

	function __construct() {
		parent::__construct();

		// library
		$this->load->library(array('facebook_service'));
	}

	/**
	 *
	 * 取得 login url
	 *
	 * @param type param
	 *
	 */
	public function test_get_login_url() {
		$login_url = $this->facebook_service->get_login_url();
		$this->_assert_equal($login_url, $login_url, 'test_get_login_url', anchor($login_url));   
	}

	/**
	 *
	 * 取得 login url，有傳 state
	 *
	 * @param type param
	 *
	 */
	public function test_get_login_url_and_has_state() {
		$login_url = $this->facebook_service->get_login_url(null, array('state'=>md5('123456')));
		$this->_assert_equal($login_url, $login_url, 'test_get_login_url_and_has_state', anchor($login_url));   
	}

	/**
	 *
	 * 取得 fb uid
	 *
	 * @param type param
	 *
	 */
	public function test_get_fb_id() {
		$fb_id = $this->facebook_service->get_fb_id();
		$this->_assert_true($fb_id > 0, 'test_get_fb_id', $fb_id);   
	}

	/**
	 *
	 * 取得 logout url
	 *
	 * @param type param
	 *
	 */
	public function test_get_logout_url() {
		$logout_url = $this->facebook_service->get_logout_url();
		$this->_assert_equal($logout_url, $logout_url, 'test_get_logout_url', anchor($logout_url));   
	}

	/**
	 *
	 * 設定 redirect_uri
	 *
	 * @param type param
	 *
	 */
	public function test_get_redirect_login_url() {
		$login_url = $this->facebook_service->get_redirect_login_url(web_url());
		$this->_assert_equal($login_url, $login_url, 'test_get_redirect_login_url', $login_url);   
	}

	/**
	 *
	 * 取得 token 
	 *
	 * @param type param
	 *
	 */
	public function test_get_token() {
		$token = $this->facebook_service->get_token();
		$this->_assert_equal($token, $token, 'test_get_token', $token);   
	}

	/**
	 *
	 * 取得一個不在 token data 裡的 field_name
	 *
	 * @param type param
	 *
	 */
	public function test_get_token_data_and_not_set_field_name() {
		$result = $this->facebook_service->get_token_data(null, 'abc');
		$this->_assert_true($result == null, 'test_get_token_data_and_not_set_field_name', $result);   
	}

	/**
	 *
	 * 取得 token data
	 *
	 * @param type param
	 *
	 */
	public function test_get_token_data() {
		$result = $this->facebook_service->get_token_data();
		$this->_assert_equal($result, $result, 'test_get_token_data', $result);   
	}

	/**
	 *
	 * 取得 token 過期時間
	 *
	 * @param type param
	 *
	 */
	public function test_get_token_expires_at() {
		$expires_at = $this->facebook_service->get_token_expires_at();
		$expires_at = format_time(DATETIME_FORMAT, $expires_at);
		$this->_assert_equal($expires_at, $expires_at, 'test_get_token_expires_at', $expires_at);   
	}
}



