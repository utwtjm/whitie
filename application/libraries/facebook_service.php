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
	public function get_redirect_login_url($redirect_uri, $params = array()) {
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

	/**
	 *
	 * 登出 facebook
	 *
	 * @param type param
	 *
	 */
	public function logout() {
		$this->facebook->destroySession();
	}

	/**
	 *
	 * 取得 token
	 *
	 * @param type param
	 *
	 */
	public function get_token() {
		return$this->facebook->getAccessToken();
	}

	/**
	 *
	 * 取得 token 過期時間
	 *
	 * @param type param
	 *
	 */
	public function get_token_expires_at($input_token = null) {
		return $this->get_token_data($input_token, 'expires_at');
	}

	/**
	 *
	 * 取得 token 過期時間
	 *
	 * @param type param
	 *
	 */
	public function get_token_data($input_token = null, $field_name = null) {
		if(is_null($input_token)) {
			$input_token = $this->get_token();
		}
		$token_data = $this->facebook->api('/debug_token', array('input_token'=>$input_token));
		if(is_null($field_name)) {
			return $token_data;
		}
		if(!isset($token_data['data'][$field_name])) {
			return null;
		}
		return $token_data['data'][$field_name];
	}

}

// 如果有要 override 才放在這，但如果有 library 是無法傳 config 進去的，則可以 extends 之後，在 __construct 設定 config，ex :  phpmailer
class MY_Facebook extends Facebook {

	public function __construct($config) {
		parent::__construct($config);
	}

}

?>