<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ==================================================================
//
// user 
//
// ------------------------------------------------------------------

class User extends MY_Controller {

	function __construct() {
		parent::__construct();

		// lang
		$this->lang->load('user');

		// library
		$this->load->library(array('user_account_service', 'user_upload_service'));
	}


	/**
	*
	* 登入畫面
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function logout() {
		$this->user_account_service->logout();
		redirect_home();
	}


	/**
	*
	* 登入畫面
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function login() {
		$redirect_to = $this->_get_post('redirect_to');
		$this->_set_view_data('redirect_to', esc_attr($redirect_to));
		// 麵包屑
		$this->_add_breadcrumb(lang_get('user_login_page_title'), web_url('/user/login'));
		$this->_display('login');
	}

	/**
	*
	* 檢查登入的資訊是否合格
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function auth() {
		$redirect_to = $this->_get_post('redirect_to');
		// 檢查帳號密碼是否輸入正確
		$user_name = $this->_get_post('user_name');
		$user_pass = $this->_get_post('user_pass');
		$result = $this->user_account_service->auth($user_name, $user_pass);
		if(is_my_error($result)) {
			$this->_set_error_message($result->get_error_message());
			redirect_login();
		}

		// 設定 session 
		$user_id = $this->user_account_service->login_by_user_name($user_name);

		// 如果有勾 remember me 就要設定 cookie
		$remember_me = $this->_get_post('remember_me');
		if($remember_me) {
			$this->user_account_service->set_remember_me($user_id, $user_pass);
		}	

		$this->_set_error_message(lang_get('user_login_success'));
		if(empty($redirect_to)) {
			redirect_user_home();
		} else {
			redirect_url($redirect_to);
		}
	}

	/**
	*
	* user 個人首頁
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function index() {
		$this->_display();
	}

	/**
	 *
	 * 編輯使用者資料
	 *
	 * @param type param
	 *
	 */
	public function edit() {
		$user_id = $this->user_account_service->get_login_id();
		$user = $this->user_model->get_by_id($user_id);
		$this->_set_view_data('user', $user);

		$this->_display();
	}

	/**
	 *
	 * 更新　user 資料
	 *
	 * @param type param
	 *
	 */
	public function update() {
		$user_id = $this->user_account_service->get_login_id();
		$user = $this->user_model->get_by_id($user_id);
		
		// 如果有上傳大頭照
		$result = $this->user_upload_service->do_avatar_upload($user_id, array('avatar_file'));
		if($this->user_upload_service->has_select_file(array('avatar_file'))
			&& $result->has_error()) {
			$this->_set_error_message($result->get_error_message());
			redirect_url('/user/edit');
		}

		// 如果有選擇檔案，且上傳沒錯誤，更新 db
		if($this->user_upload_service->has_select_file(array('avatar_file'))
			&& !$result->has_error()) {
			$file_names = $this->user_upload_service->datas('file_name');
			$avatar_file = $this->user_upload_service->get_upload_avatar($file_names[0], $user_id);
			$user->set_var('avatar', $avatar_file);
		}
		
		$result = $this->user_register_service->validate();
		if(is_my_error($result)) {
			$this->_set_error_message($result->get_error_message());
			redirect_home();
		}

		$user_pass = $this->_get_post('user_pass');
		$user->set_var('pass', $this->user_register_service->encode_pass($user_pass));
		$this->user_account_service->update($user);
	}

}

