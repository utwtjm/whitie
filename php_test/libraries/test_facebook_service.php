<?php

class Test_facebook_service extends CodeIgniterUnitTestCase {

	public function __construct() {
		parent::__construct();

		// library
		$this->load->library('facebook_service');
	}

	public function setUp() {}

    public function tearDown() {}

	public function test_get_login_url() {
		$login_url = $this->facebook_service->get_login_url();
		show_result($login_url);
	}

	public function test_get_fb_id() {
		$user = $this->facebook_service->get_fb_id();
		show_result($user);
		$this->assertTrue($user > 0);
	}

	public function test_get_logout_url() {
		$logout_url = $this->facebook_service->get_logout_url();
		show_result($logout_url);
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
		show_result($login_url);
	}

}

?>