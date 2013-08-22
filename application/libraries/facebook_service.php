<?php

// ==================================================================
//
// facebook service，原本是想要用 lazy load ，但基本上每個呼叫 facebook_service 都會用到 facebook，所以 lazy load 好像沒意義，而且每個 function 都要用 static 有點麻煩
//
// ------------------------------------------------------------------

third_party_load('facebook/src/facebook');

class Facebook_service extends Base_service {

	var $facebook;

	public function __construct() {
		parent::__construct();

		// config
		$this->config->load('facebook', true);

		// init
		$this->facebook = new MY_Facebook(array(
		  'appId'  => $this->get_config('app_id'),
		  'secret' => $this->get_config('app_secret')
		));
	}

	/**
	 *
	 * 取得 facebook config
	 *
	 * @param type param
	 *
	 */
	public function get_config($item = null) {
		return parent::get_config($item, 'facebook');
	}

	/**
	 *
	 * 取得會回現在網址的 login url
	 *
	 * @param type param
	 *
	 */
	public function get_login_url($redirect_uri = null, $params = array()) {
		return $this->facebook->getLoginUrl($params);
	}


	/**
	 *
	 * 取得會回設定的網址的 login url
	 *
	 * @param type param
	 *
	 */
	public function get_redirect_login_url($redirect_uri) {
		$params['redirect_uri'] = $redirect_uri;
		return $this->facebook->getLoginUrl($params);
	}

	/**
	 *
	 * 取得 facebook user id
	 *
	 * @param type param
	 *
	 */
	public function get_fb_id() {
		return $this->facebook->getUser();
	}

	/**
	 *
	 * 取得 logout url
	 *
	 * @param type param
	 *
	 */
	public function get_logout_url() {
		return $this->facebook->getLogoutUrl();
	}
}

class MY_Facebook extends Facebook {

	public function __construct($config) {
		parent::__construct($config);
	}

}

?>