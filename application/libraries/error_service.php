<?php

// ==================================================================
//
// 錯誤處理
//
// ------------------------------------------------------------------

class Error_service extends Base_service {

	public function __construct($config = array()) {
		parent::__construct();

		if (count($config) > 0) {
			$this->initialize($config);
		}
	}

	public function initialize($config = array()) {
		foreach ($config as $key => $val) {
			if (isset($this->$key)) {
				$this->$key = $val;
			}
		}
	}
	
}


class MY_Error {

	var $errors = array();		// assoicate array key: error code，value:error message
	var $error_data = array();	// assoicate array key: error code，value:error data
	
	function __construct($code = null, $message = null, $data = null) {
		if (empty($code)) {
			return;
		}

		$this->errors[$code][] = $message;

		if (!empty($data)) {
			$this->error_data[$code] = $data;
		}
	}

	/**
	*
	* 清掉所有錯誤
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function clear_error() {
		$this->errors = array();
		$this->error_data = array();
	}

	/**
	*
	* 有錯誤發生
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function has_error() {
		return count($this->errors) > 0;
	}

	/**
	*
	* 取得第一個的 error code
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	public function get_error_code() {
		$error_codes = $this->get_error_codes();
		return isset($error_codes[0]) ? $error_codes[0] : '';
	}

	/**
	*
	* 取得第一個的 error message
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	public function get_error_message() {
		$error_messages = $this->get_error_messages();
		return isset($error_messages[0]) ? $error_messages[0] : '';
	}

	/**
	*
	* 取得所有的 error code
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	public function get_error_codes() {
		if(empty($this->errors)) {
			return array();
		}
		return array_keys($this->errors);
	}

	/**
	*
	* 取得所有的 error message
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	public function get_error_messages($code = null) {
		// 如果沒有設定 code 就回傳全部的 error message
		if (empty($code)) {
			$all_messages = array();
			foreach($this->errors as $code => $message) {
				$messages = array($message);
				$all_messages = array_merge($all_messages, $messages);
			}				
			return $all_messages;
		}

		// 判斷目前設定的 code 是否有存在，如果有就回傳 code 所代表的訊息
		if ( isset($this->errors[$code]) ) {
			return $this->errors[$code];
		// 如果沒有就回傳 code 所代表的訊息
		} else {
			return '';
		}	
	}

	/**
	*
	* 取得錯誤的 data
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	public function get_error_data($code) {
		if(isset($this->error_data[$code])) {
			return $this->error_data[$code];
		}
		return null;
	}

	/**
	*
	* 新增一筆錯誤
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	public function add($code, $message, $data = null) {
		$this->errors[$code] = $message;
		if (!empty($data)) {
			$this->error_data[$code] = $data;
		}
	}

	/**
	*
	* 新增錯誤資料
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	public function add_data($data, $code = null) {
		if(empty($code)) {
			$code = $this->get_error_code();
		}
		$this->error_data[$code] = $data;
	}

}



/**
*
* 判斷某個 object 是不是 MY_Error class
*
* @access	public
* @param	param (type) : param description
* @return 	return : return description
*
*/
function is_my_error($thing) {
	if(is_object($thing) && is_a($thing, 'MY_Error')) {
		return true;
	}
	return false;
}


