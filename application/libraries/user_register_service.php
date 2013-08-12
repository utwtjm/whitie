<?php

// ==================================================================
//
// 註冊帳號用的 service，註冊 step 1~x 會用到的 function 都放這
//
// ------------------------------------------------------------------


class User_register_service extends Base_service {

	const STATUS_INIT = '0';	// 帳號一開始的狀態
	const STATUS_ACTIVE = '1';	// 帳號啟動後的狀態
	const STATUS_WAIT_ACTIVE_EMAIL = '2';	// 等待 email 認證

	function __construct() {
		parent::__construct();

		// library
		$this->load->library(array('error_service', 'captcha_service', 'user_register_validation'));

		// model
		$this->load->model(array('user_model'));

		// lang
		$this->lang->load('register');
	}

	/**
	*
	* 對註冊的帳號進行消毒，去掉 html tag 等等..
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	public function sanitize_user_name($user_name) {
		// 移除 html tag
		$user_name = strip_all_tags($user_name);

		// 移除空白
		$user_name = trim($user_name);

		// Consolidate contiguous whitespace
		$user_name = preg_replace('|\s+|', ' ', $user_name);
		return $user_name;
	}

	/**
	*
	* 這個 user_name 是否已經註冊過
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	public function exist_user_name($user_name) {
		$user = $this->user_model->get_by_name($user_name);
		if($user) {
			return true;
		}
		return false;
	}
	
	/**
	*
	* 這個 user_email 是否已經註冊過
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	public function exist_user_email($user_email) {
		$user = $this->user_model->get_by_email($user_email);
		if($user) {
			return true;
		}
		return false;
	}

	/**
	*
	* 檢查註冊資料是否合法
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	public function validate() {
		$error = new MY_Error();

		// 帳號
		$this->user_register_validation->set_rules('user_name', '帳號', 'required|vaild_user_name|exist_user_name');
		$this->user_register_validation->set_message('required', lang_get('register_required_user_name'));
		$this->user_register_validation->set_message('vaild_user_name', lang_get('register_vaild_user_name'));
		$this->user_register_validation->set_message('exist_user_name', lang_get('register_exist_user_name'));

		// 電子信箱
		$this->user_register_validation->set_rules('user_email', '電子信箱', 'required|vaild_email|exist_user_email');
		$this->user_register_validation->set_message('required', lang_get('register_required_user_email'));
		$this->user_register_validation->set_message('vaild_email', lang_get('register_vaild_user_email'));
		$this->user_register_validation->set_message('exist_user_email', lang_get('register_exist_user_email'));

		// 驗證碼
		$this->user_register_validation->set_rules('captcha_code', '驗證碼', 'required|vaild_captcha');
		$this->user_register_validation->set_message('required', lang_get('register_required_captcha'));
		$this->user_register_validation->set_message('vaild_captcha', lang_get('register_vaild_captcha'));
		
		// 密碼
		$this->user_register_validation->set_rules('user_pass', '密碼', 'required|matches[confirm_user_pass]|min_length[2]');
		$this->user_register_validation->set_message('required', lang_get('register_required_pass'));
		$this->user_register_validation->set_message('matches', lang_get('register_match_pass'));
		$this->user_register_validation->set_message('min_length', lang_get('register_min_length_pass'));
		
		// 修改密碼
		$this->user_register_validation->set_rules('edit_user_pass', '密碼', 'matches[edit_confirm_user_pass]|min_length[2]');
		$this->user_register_validation->set_message('required', lang_get('register_required_pass'));
		$this->user_register_validation->set_message('matches', lang_get('register_match_pass'));
		$this->user_register_validation->set_message('min_length', lang_get('register_min_length_pass'));
		
		if ($this->user_register_validation->run() == FALSE)
		{
			$errors = $this->user_register_validation->get_errors();
			foreach($errors as $field_name => $message) {
				$error->add($field_name, $message);
			}
			return $error;
		}
		return true;
	}

	/**
	*
	* 取得啟動碼
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function get_act_key() {
		$actkey = substr(md5(uniqid(mt_rand(), 1)), 0, 8);
		return $actkey;
	}

	/**
	 *
	 * 啟動碼是否正確
	 *
	 * @param type param
	 *
	 */
	public function correct_act_key($user_id, $act_key) {
		// 取得要驗證啟動碼的帳號
		$user = $this->user_model->get_by_id($user_id);
		
		// 檢查驗證碼是否相同
		if($user->get_var('act_key') != $act_key) {
			return false;
		}
		return true;
	}

	/**
	 *
	 * 建立一個新的密碼 copy by xoops
	 *
	 * @param type param
	 *
	 */
	public function make_pass() {
	    $makepass = '';
	    $syllables = array('er', 'in', 'tia', 'wol', 'fe', 'pre', 'vet', 'jo', 'nes',
	                       'al', 'len', 'son', 'cha', 'ir', 'ler', 'bo', 'ok', 'tio',
	                       'nar', 'sim', 'ple', 'bla', 'ten', 'toe', 'cho', 'co', 'lat',
	                       'spe', 'ak', 'er', 'po', 'co', 'lor', 'pen','cil', 'li', 'ght',
	                       'wh', 'at', 'the', 'he', 'ck', 'is', 'mam', 'bo', 'no', 'fi',
	                       've', 'any', 'way', 'pol', 'iti', 'cs', 'ra', 'dio', 'sou',
	                       'rce', 'sea', 'rch', 'pa', 'per', 'com', 'bo', 'sp', 'eak',
	                       'st', 'fi', 'rst', 'gr', 'oup', 'boy', 'ea', 'gle', 'tr',
	                       'ail', 'bi', 'ble', 'brb', 'pri', 'dee', 'kay', 'en', 'be', 'se');
	    srand((double) microtime() * 1000000);
	    for($count = 1; $count <= 4; $count ++) {
	    	$rand = rand();
	        if ($rand % 10 == 1) {
	            $makepass .= sprintf('%0.0f', ($rand % 50) + 1);
	        } else {
	        	$makepass_index = $rand % 62;
	            $makepass .= sprintf('%s', $syllables[$makepass_index]);
	        }
	    }
	    return $makepass;
	}

	/**
	*
	* 將密碼編碼
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function encode_pass($pass) {
		return md5($pass);
	}

}

?>