<?php

// ==================================================================
//
// 測試 user_register_service
//
// ------------------------------------------------------------------

class test_user_register_service extends CodeIgniterUnitTestCase {

    var $error;

	public function __construct() {
		parent::__construct();

		// library
		$this->load->library('user_register_service');

        // init
        $this->error = new MY_Error();
	}

	public function setUp() {
		$this->error->clear_error();
    }

    public function tearDown() {}

    /**
    *
    * user name 有 html tag
    *
    * @access	public
    * @param	param (type) : param description
    * @return 	return : return description
    *
    */
    public function test_sanitize_user_name_and_have_html_tag() {
    	$sanitized_user_name = $this->user_register_service->sanitize_user_name('<img>111</img>');
    	$this->assertTrue($sanitized_user_name == '111');
    }


    /**
    *
    * user name 有前後都有空白的字串
    *
    * @access	public
    * @param	param (type) : param description
    * @return 	return : return description
    *
    */
    public function test_sanitize_user_name_and_have_tail_head_have_empty_string() {
    	$sanitized_user_name = $this->user_register_service->sanitize_user_name(' 111 ');
    	$this->assertTrue($sanitized_user_name == '111');
    }

     /**
    *
    * user name 有一連串的空白字串
    *
    * @access	public
    * @param	param (type) : param description
    * @return 	return : return description
    *
    */
    public function test_sanitize_user_name_and_have_tail_much_empty_string() {
    	$sanitized_user_name = $this->user_register_service->sanitize_user_name('11    1');
    	$this->assertTrue($sanitized_user_name == '11 1');
    }

    /**
    *
    * 測試 exist_user_name ，有相同的 user_name
    *
    * @access	public
    * @param	param (type) : param description
    * @return 	return : return description
    *
    */
    public function test_exist_user_name_and_same_user_name() {
    	$exist_user_name = $this->user_register_service->exist_user_name('a11');
    	$this->assertTrue($exist_user_name);
    }

    /**
    *
    * 測試 exist_user_name ，沒有相同的 user_name
    *
    * @access	public
    * @param	param (type) : param description
    * @return 	return : return description
    *
    */
    public function test_exist_user_name_and_not_same_user_name() {
    	$exist_user_name = $this->user_register_service->exist_user_name('a12');
    	$this->assertFalse($exist_user_name);
    }

    /**
    *
    * 測試 exist_user_email ，有相同的 user_email
    *
    * @access   public
    * @param    param (type) : param description
    * @return   return : return description
    *
    */
    public function test_exist_user_email_and_same_user_email() {
        $exist_user_email = $this->user_register_service->exist_user_email('utwtjm@gmail.com');
        $this->assertTrue($exist_user_email);
    }

    /**
    *
    * 測試 exist_user_email ，沒有相同的 user_email
    *
    * @access   public
    * @param    param (type) : param description
    * @return   return : return description
    *
    */
    public function test_exist_user_email_and_not_same_user_email() {
        $exist_user_email = $this->user_register_service->exist_user_email('utwtjma@gmail.com');
        $this->assertFalse($exist_user_email);
    }

    /**
     *
     * 取得啟動碼
     *
     * @param type param
     *
     */
    public function test_get_act_key() {
        $act_key = $this->user_register_service->get_act_key();
        show_result($act_key);
    }

    /**
     *
     * 啟動碼不正確
     *
     * @param type param
     *
     */
    public function test_correct_act_key_and_not_correct() {
        $result = $this->user_register_service->correct_act_key(1, '430ee76c1');
        $this->assertFalse($result);
    }

     /**
     *
     * 啟動碼正確
     *
     * @param type param
     *
     */
    public function test_correct_act_key_and_correct() {
        $result = $this->user_register_service->correct_act_key(1, '430ee76c');
        $this->assertTrue($result);
    }

    /**
     *
     * 建立一個新的密碼
     *
     * @param type param
     *
     */
    public function test_make_pass() {
        $new_pass = $this->user_register_service->make_pass();
        show_result($new_pass);
    }

    /**
     *
     * 將密碼編碼
     *
     * @param type param
     *
     */
    public function test_encode_pass() {
        $encode_pass = $this->user_register_service->encode_pass('123456');
        show_result($encode_pass);
    }

}

?>