<?php

// ==================================================================
//
// 使用者的處理
//	
// ------------------------------------------------------------------

class User_account_service extends Base_service {

	const SESSION_USER_KEY = 'user';				// session 裡存放 user 的 key
	const REMEMBER_ME_COOKIE_NAME = 'remember_me';	// cookie 裡存放 user pass 的 name
	
	public function __construct($config = array()) {
		parent::__construct();

		if (count($config) > 0) {
			$this->initialize($config);
		}

		// library
		$this->load->library(array('user_upload_service', 'user_register_service', 'user_permission_service'));

		// model
		$this->load->model(array('user_model', 'permission_model', 'group_model'));
	}

	public function initialize($config = array()) {
		foreach ($config as $key => $val) {
			if (isset($this->$key)) {
				$this->$key = $val;
			}
		}
	}

	/**
	*
	* 驗證登入的帳號密碼是否正確
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function auth($user_name, $user_pass) {
		$error = new MY_Error();

		// 處理資料
		$user_name = $this->user_register_service->sanitize_user_name($user_name);
		$user_pass = $this->user_register_service->encode_pass($user_pass);
		
		// 取得 user
		$user = $this->user_model->get_by_name_and_pass($user_name, $user_pass);
		if(!$user) { 
			$error->add('user_auth_error', lang_get('user_auth_error'));
			return $error;
		}
		return $user;
	}

	/**
	*
	* user logout
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function logout() {
		$this->unset_remember_me();
		// 刪除掉舊的 session
		$this->session->unset_userdata(self::SESSION_USER_KEY);
	}

	/**
	*
	* 取得 user group types
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function get_group_types($user_id = null) {
		// 取得 user
		if(is_null($user_id)) {
			$user_id = $this->user_account_service->get_login_id();
		} 
		$user = $this->user_model->get_by_id($user_id);
		if(!$user) {
			throw new Exception(lang_get('user_not_exist'));
		}

		// 取得 group types
        $groups = $this->group_model->get_by_user_id($user_id);
        $group_types = array();
        for($i=0; $i<count($groups); $i++) { 
        	$group_types[] = $groups[$i]->get_var('type');
        }
        return $group_types;
	}

	/**
	*
	* 設定 user login session 
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function login($user) {
		if(!$user) {
			throw new Exception(lang_get('user_not_exist'));
		}

		// 刪除掉舊的 session
		$this->session->unset_userdata(self::SESSION_USER_KEY);

		// 新增新的 session
		$group_types = $this->get_group_types($user->get_var('id'));
		$permission_names = $this->user_permission_service->get_permission_names($user->get_var('id'));
		$user_data = new User_data($user->id, $group_types, $permission_names);
		$user_session_data = array(
				self::SESSION_USER_KEY => $user_data
			);
		$this->session->set_userdata($user_session_data);
		return $user->id;
	}

	/**
	*
	* 設定 user login session 
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function login_by_user_id($user_id) {
		$user = $this->user_model->get_by_id($user_id);
		return $this->login($user);
	}

	/**
	*
	* 設定 user login session 
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function login_by_user_name($user_name) {
		$user = $this->user_model->get_by_name($user_name);
		return $this->login($user);
	}

	/**
	 *
	 * 由 cookie 取得 user
	 *
	 * @param type param
	 *
	 */
	public function login_by_cookie($encode_remember_me_value) {
		$result = $this->get_decode_remeber_me_value($encode_remember_me_value);
		$user_id = $result['user_id'];
		$user_pass = $result['user_pass'];
		$user = $this->user_model->get_by_id_and_pass($user_id, $user_pass);
		return $this->login($user);
	}

	/**
	*
	* 已經登入
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function is_logged() {
		$user_data = $this->get_login_user_data();
		if(empty($user_data)) {
			return false;
		}
		$user_id = $user_data->get_var('user_id');
		return !empty($user_id);
	}

	/**
	*
	* 取得現在登入的人，他的 user_id
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function get_login_id() {
		$user_data = $this->get_login_user_data();
		if(empty($user_data)) {
			return 0;
		}
		$user_id = $user_data->get_var('user_id');
		return $user_id ? $user_id : 0;
	}

	/**
	*
	* 取得現在登入的人他的 session data
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function get_login_user_data() {
		return $this->session->userdata(self::SESSION_USER_KEY);
	}

	/**
	 *
	 * 更新 user 資料
	 *
	 * @param type param
	 *
	 */
	public function update($new_user) {
		$new_user_id = $new_user->get_var('id');

		// 如果 new_user_id 是空的或是不存在在 db 就新增
		$create_user = empty($new_user_id);
		if($create_user) {
			$user_name = $new_user->get_var('name');
			$user_email = $new_user->get_var('email');
			$user_pass = $new_user->get_var('pass');
			$new_user->set_var('name', $this->user_register_service->sanitize_user_name($user_name));
			$new_user->set_var('email', $user_email);
			$new_user->set_var('pass', $this->user_register_service->encode_pass($user_pass));
			$new_user->set_var('act_key', $this->user_register_service->get_act_key());
			$new_user->set_var('reg_date', now_datetime());
			$new_user->set_var('status', user_register_service::STATUS_ACTIVE);
			$user_id = $this->user_model->create($new_user);
			return $user_id;
		// 更新　user 資料
		} else {
			// 取得原本的 user，如果 avatar 有改的話就刪除原本的 avatar
			$old_user = $this->user_model->get_by_id($new_user_id);
			$old_user_avatar = $old_user->get_var('avatar');
			$old_new_avatar = $new_user->get_var('avatar');
			if($old_user_avatar != $old_new_avatar) {
				$this->user_upload_service->update_avatar_file($old_user_avatar, $old_new_avatar);			
			}
			$this->user_model->update($new_user);
		}
	}

	/**
	 *
	 * 取得要記在 cookie 裡的 remeber_me value
	 *
	 * @param type param
	 *
	 */
	public function get_encode_remeber_me_value($user_id, $user_pass) {
		$encode_user_pass = $this->user_register_service->encode_pass($user_pass);
		$encode_remeber_me_value = $user_id . '-' . $encode_user_pass;
		return $encode_remeber_me_value;
	}

	/**
	 *
	 * 取得要記在 cookie 裡的 remeber_me value
	 *
	 * @param type param
	 *
	 */
	public function get_decode_remeber_me_value($remember_me_value) {
		$split_remember_me_value = explode('-', $remember_me_value);
		if(count($split_remember_me_value) < 2) {
		   throw new Exception(lang_get('user_remember_cookie_not_vaild'));
		}
		$decode_remember_me_value = array();
		$decode_remember_me_value['user_id'] = $split_remember_me_value[0];
		$decode_remember_me_value['user_pass'] = $split_remember_me_value[1];
		return $decode_remember_me_value;
	}

	/**
	 *
	 * 如果有勾選 remember_me 就設定 cookie
	 *
	 * @param type param
	 *
	 */
	public function set_remember_me($user_id, $user_pass) {
		$encode_user_pass = $this->user_register_service->encode_pass($user_pass);
		$expire = time() + 31536000;
		$domain = config_get('cookie_domain');
		$path = config_get('cookie_path');
		$prefix = config_get('cookie_prefix');
		$secure = config_get('cookie_secure');
		$encode_remeber_me_value = $this->get_encode_remeber_me_value($user_id, $user_pass);
		@set_cookie(self::REMEMBER_ME_COOKIE_NAME, $encode_remeber_me_value, $expire, $domain, $path, $prefix, $secure);
	}

	/**
	 *
	 * 取消 remember me 
	 *
	 * @param type param
	 *
	 */
	public function unset_remember_me() {
		$domain = config_get('cookie_domain');
		$path = config_get('cookie_path');
		$prefix = config_get('cookie_prefix');
		@delete_cookie(self::REMEMBER_ME_COOKIE_NAME, $domain, $path, $prefix);
	}

}


/**
*
* 使用者是否有登入
*
* @access	public
* @param	param (type) : param description
* @return 	return : return description
*
*/
function is_logged() {
	$ci =& get_instance();
	$ci->load->library('user_account_service');
	return $ci->user_account_service->is_logged();
}



?>