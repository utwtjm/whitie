<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ==================================================================
//
// 測試上傳
//
// ------------------------------------------------------------------

class Test_user_account_service extends Test_Controller {

	function __construct() {
		parent::__construct();

		// library
		$this->load->library(array('user_account_service'));
	}

	function set_remember_me() {
		$user_id = 1;
		$user_pass = '12345';
		$this->user_account_service->set_remember_me($user_id, $user_pass);
		$remember_me_cookie = get_cookie(user_account_service::REMEMBER_ME_COOKIE_NAME);
        $this->_run($remember_me_cookie, $remember_me_cookie, 'set_remember_me', $remember_me_cookie);   
        $this->_display();
	}

	function unset_remember_me() {
		$this->user_account_service->unset_remember_me();
		$remember_me_cookie = get_cookie(user_account_service::REMEMBER_ME_COOKIE_NAME);
        $this->_run($remember_me_cookie, $remember_me_cookie, 'set_remember_me', $remember_me_cookie);   
        $this->_display();
	}

}



