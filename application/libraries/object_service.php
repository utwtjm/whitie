<?php

// ==================================================================
//
// 所有資料物件基本上都要 extend my_object
//
// ------------------------------------------------------------------

class Object_service extends Base_service {

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

/**
 *
 * 所有物件的基底 class，好處是沒有人可以直接用 xxx->屬性 讀取數值
 *
 * @param type param
 *
 */
class Object {
	
    // 變數
	var $vars = array();

	function __construct() {}

     /**
     *
     * 設定 db 的欄位的數值
     *
     * @param type param
     *
     */
    public function set_var($key, $value) {
    	$this->vars[$key] = $value;
    }

     /**
     *
     * 取得 db 的所有欄位的數值
     *
     * @param type param
     *
     */
    public function get_vars() {
    	return $this->vars;
    }

    /**
     *
     * 取得 db 的單一欄位的數值
     *
     * @param type param
     *
     */
    public function get_var($key) {
    	return isset($this->vars[$key]) ? $this->vars[$key] : null;
    }

}

/**
 *
 * 圖片的尺寸
 *
 * @param type param
 *
 */
class Size extends Object{

	public function __construct($width, $height) {
		$this->set_var('width', $width);
		$this->set_var('height', $height);
	}

}

/**
 *
 * 儲存在 session 的 user data
 *
 * @param type param
 *
 */
class User_data extends Object{

    public function __construct($user_id, $group_types, $permission_names) {
        $this->set_var('user_id', $user_id);
        $this->set_var('group_types', $group_types);
        $this->set_var('permission_names', $permission_names);
    }

}

?>