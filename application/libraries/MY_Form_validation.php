<?php 

// ==================================================================
//
// 覆寫 CI_form_validation，載入 form_vaildation 時要用 Form_vaildation 不然在 ubuntu 會出錯
//
// ------------------------------------------------------------------

class MY_Form_validation extends CI_Form_validation {

	public function __construct() {
        parent::__construct();
    }

    /**
    *
    * 取得所有錯誤
    *
    * @access	public
    * @param	param (type) : param description
    * @return 	return : return description
    *
    */
   	function get_errors() {
   		return $this->_error_array;
   	}

    public function __get($var) {
        return $this->CI->$var;
    }

    /**
     *
     * 取得設定的 field rule
     *
     * @param type param
     *
     */
    public function get_field_data() {
        return $this->_field_data;
    }

    /**
     *
     * 在表單裡如果沒有 rule 設定的欄位就將這個 rule 移除
     *
     * @param type param
     *
     */
    public function drop_field_data($post_data) {
        // 取得表單所有欄位
        $post_field = array_keys($post_data);
        $filed_data_keys = array_keys($this->_field_data);

        // 如果設定的 rule field name 沒有在表單裡就不測試這個 rule
        foreach($filed_data_keys as $field_data_key) {
            if(!in_array($field_data_key, $post_field)) {
                unset($this->_field_data[$field_data_key]);
            }
        }
        return $this->_field_data;
    }

    /**
     *
     * 覆寫 run，將不需要驗證的欄位去掉
     *
     * @param type param
     *
     */
    public function run() {
        $post_data = $_POST;
        $field_data = $this->drop_field_data($post_data);
        if(empty($field_data)) {
            return true;
        }
        return parent::run();
    }

}

