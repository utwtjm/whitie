<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ==================================================================
//
// 註冊
//
// ------------------------------------------------------------------

class Register extends MY_Controller {

	function __construct() {
		parent::__construct();

		// model
		$this->load->model(array('user_model'));

		// lang
		$this->lang->load('register');

		// library
		$this->load->library(array('user_register_service'));
	}

	/**
	*
	* 註冊新使用者
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	public function new_user() {
		// page title
		$this->_set_page_title(lang_get('register_new_user'));

		// 麵包屑
		$this->_add_breadcrumb(lang_get('register_new_user'), web_url('/register/new_user'));

		$this->_set_view_name('user/login');
		$this->_display('login');
	}

	/**
	*
	* 建立 user
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	public function save_user() {
		$user_name = $this->_get_post('user_name');
		$user_email = $this->_get_post('user_email');
		$user_pass = $this->_get_post('user_pass');
		$confirm_user_pass = $this->_get_post('confirm_user_pass');
		$captcha_code = $this->_get_post('captcha_code');

		// 檢查註冊資料
		$validate = $this->user_register_service->validate();
		if(is_my_error($validate)) {
			$this->_set_message($validate->get_error_message());
			redirect_url('/register/new_user');
		}

		// 註冊資料合法，就建立一個 user
		$user = new User_Mapper();
		$user->set_var('name', $user_name);
		$user->set_var('email', $user_email);
		$user->set_var('pass', $user_pass);
		$this->user_account_service->update($user);
		$this->_display();
	}

	/**
	*
	* 註冊完成
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	public function finish() {}

	/**
	 *
	 * 啟動帳號
	 *
	 * @param type param
	 *
	 */
	public function activate() {
		$user_id = $this->_get_post('user_id');
		$act_key = $this->_get_post('act_key');

		// 驗證
		$correct = $this->user_register_service->correct_act_key($user_id, $act_key);
		if(!$correct) {
			$this->_set_error_message(lang_get('register_act_key_not_correct');
			redirect_home();
		}

		// 啟動
		$user = $this->user_model->get_by_id($user_id);
		$user->set_var('status', user_register_service::STATUS_ACTIVE);
		$this->user_account_service->update($user);
		$this->_set_success_message(lang_get('register_finish'));
		redirect_home();
	}

}
