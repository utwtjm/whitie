<?php

// ==================================================================
//
// 權限用 service，一個 user 可以在多個 group 裡，然後依照 group 的權限來決定可以看哪些欄位
// 有沒有登入，則利用權限檢查來檢查，因為沒有登入，一定沒有權限，
// 每個權限應該放在相對應的 group 裡，不該為了方便直接放在不合理的 group
//
// ------------------------------------------------------------------

class User_permission_service extends Base_service {

	function __construct() {
		parent::__construct();

		// model
		$this->load->model(array('permission_model'));

		// lang
		$this->lang->load('user_permission');

		// config
		$this->config->load('user_permissions', true);
	}

	/**
	*
	* 取得所有設定權限的網址
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function get_config_urls($item = null) {
		$permissions = permission_config_get($item);
		if(!$permissions) {
			return array();
		}
		$permission_urls = array();
		foreach($permissions as $name => $permission_url) {
			$permission_urls = array_merge($permission_urls, $permission_url);
		}
		return $permission_urls;
	}

	/**
	*
	* 檢查 user 是不是有某個權限
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function check($uri = null, $user_id = null) {
		// 如果沒有填 uri 就以現在的網址為主
		if(is_null($uri)) {
			$uri_string = $this->uri->ruri_string();
		} else {
			$uri_string = $uri;
		}

        // 找出 user 所有的權限，檢查目前的 uri ，user 是否可以看
        $result = $this->user_permission_has_url($uri_string, $user_id);
    	if(is_my_error($result)) {
    		return $result;
    	}

		return true;
	}


	/**
	*
	* 現在傳入的 uri 是否有在 config 設定 url 裡
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function check_config_url($uri) {
		$config_urls = $this->get_config_urls();
		foreach($config_urls as $config_url) {
			if($this->match_url($config_url, $uri)) {
				return true;
			}
		}
		return false;
	}

	/**
	 *
	 * 取得這個 uri 是哪個權限
	 *
	 * @param type param
	 *
	 */
	public function get_permission_name_by_uri($uri) {
		$permissions = permission_config_get();
		foreach ($permissions as $name => $uris) {
			$config_urls = permission_config_get($name);
			foreach($config_urls as $config_url) {
				if($this->match_url($config_url, $uri)) {
					return $name;
				}
			}
		}
		return null;		
	}

	/**
	*
	* 檢查某個 user 他有的權限裡面是否有包含傳進來的 uri
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function user_permission_has_url($uri = null, $user_id = null) {
        // 取得所有設定的網址，如果目前的 uri 沒有 match config 設定的值就直接回傳 true
        $check_config_url = $this->check_config_url($uri);
        if(!$check_config_url) {
        	return true;
        }

		$my_error = new MY_Error();
		// 找出 user 所有的權限
        $permission_names = $this->get_permission_names($user_id);
        foreach($permission_names as $permission_name) {
        	// 取得現在的權限，可以看哪些網址
			$permission_urls = permission_config_get($permission_name);
			foreach($permission_urls as $permission_url) {
				// 如果現在的網址，我可以看就回傳 true
				$is_match = $this->match_url($permission_url, $uri);
				if($is_match) {
					return true;
				}
			}
        }
		// 找出這個 uri 是哪個權限
		$permission_name = $this->get_permission_name_by_uri($uri);
		$message = $this->get_permission_error_message($permission_name);
		$my_error->add($permission_name, $message);
		return $my_error;
	}

	/**
	 *
	 * 取得權限的錯誤訊息
	 *
	 * @param type param
	 *
	 */
	public function get_permission_error_message($permission_name) {
		switch($permission_name) {
			case Permission_model::NAME_BACKEND_VIEW;
				$message = lang_get('user_permission_backend_view_error');
			break;
			case Permission_model::NAME_FORWARD_VIEW;
				$message = lang_get('user_permission_forward_view_error');
			break;
			default:
				throw new Exception(lang_get('user_permission_not_set'));
			break;
		}
		return $message;
	}

	/**
	*
	* config 設定的 uri 有符合現在的 uri 
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function match_url($config_url, $uri) {
		$config_url = add_lslash($config_url);
		$uri = add_lslash($uri);
		$config_url = str_replace(':any', '.+', str_replace(':num', '[0-9]+', $config_url));
		if(preg_match('#^'.$config_url.'$#', $uri)) {
			return true;
		}
		return false;
	}

	/**
	*
	* 取得 user 擁有的權限名字
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function get_permission_names($user_id = null) {
		// 如果沒傳 user_id 就直接回傳現在登入的人的 group types
		if(is_null($user_id)) {
			$user_data = $this->user_account_service->get_login_user_data();
			if(empty($user_data)) {
				return array();
			}
			$permission_names = $user_data->get_var('permission_names');
			return empty($permission_names) ? array() : $permission_names ;
		}

		// 取得 user 的 permissions
        $permissions = $this->permission_model->get_by_user_id($user_id);
        $permission_names = array();
       	for($i=0; $i<count($permissions) ; $i++) { 
        	$permission_names[] = $permissions[$i]->get_var('name');		
        }
        return $permission_names;
	}

}

?>