<?php

class Test_error_service extends CodeIgniterUnitTestCase {

    var $error;

	public function __construct() {
		parent::__construct();

        // library
		$this->load->library('error_service');

        // init
        $this->error = new MY_Error();
	}

    public function setUp() {
        // 新增幾筆錯誤
        $this->add_error('code1', 'message1', 'data1');
        $this->add_error('code2', 'message2', 'data2');
    }

    public function tearDown() {}

    /**
    *
    * 新增錯誤資料
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
	public function add_error($code, $message, $data) {
    	$this->error->add($code, $message, $data);
	}

    /**
    *
    * 取得所有錯誤 code
    *
    * @access	public
    * @param	param (type) : param description
    * @return 	return : return description
    *
    */
    public function test_get_error_codes() {
    	$codes = $this->error->get_error_codes();
    	$this->assertTrue(count($codes) == 2);
    }

    /**
    *
    * 取得所有錯誤，驗證 code
    *
    * @access	public
    * @param	param (type) : param description
    * @return 	return : return description
    *
    */
    public function test_get_error_codes_and_check_code() {
    	$codes = $this->error->get_error_codes();
    	$this->assertTrue($codes[0] == 'code1');
    }


    /**
    *
    * 取得第一個 error code 的代碼是否正確
    *
    * @access   public
    * @param    param (type) : param description
    * @return   return : return description
    *
    */
    public function test_get_error_code_and_check_first_code() {
        $code = $this->error->get_error_code();
        $this->assertTrue($code == 'code1');
    }


    /**
    *
    * 取得所有錯誤訊息
    *
    * @access	public
    * @param	param (type) : param description
    * @return 	return : return description
    *
    */
    public function test_get_error_messages() {
    	$messages = $this->error->get_error_messages();
    	$this->assertTrue(count($messages) == 2);
    }

    /**
    *
    * 取得第一個 error message 的訊息是否正確
    *
    * @access   public
    * @param    param (type) : param description
    * @return   return : return description
    *
    */
    public function test_get_error_message_and_check_first_code() {
        $message = $this->error->get_error_message();
        $this->assertTrue($message == 'message1');
    }

    /**
    *
    * 取得所有錯誤訊息，檢查第一個 error 的訊息是否正確
    *
    * @access	public
    * @param	param (type) : param description
    * @return 	return : return description
    *
    */
    public function test_get_error_messages_and_check_first_message() {
    	$messages = $this->error->get_error_messages();
    	$this->assertTrue($messages[0] == 'message1');
    }

     /**
    *
    * 取得所有錯誤，檢查 code message 是否正確，，但現在發生錯誤的 codes 裡並沒有這個 code
    *
    * @access   public
    * @param    param (type) : param description
    * @return   return : return description
    *
    */
    public function test_get_error_messages_and_not_exist_code() {
        $messages = $this->error->get_error_messages('code3');
        $this->assertTrue($messages == '');
    }


    /**
    *
    * 取得某一個錯誤 code 的 error data
    *
    * @access   public
    * @param    param (type) : param description
    * @return   return : return description
    *
    */
    public function test_get_error_data_and_check_data() {
        $error_data = $this->error->get_error_data('code1');
        $this->assertTrue($error_data == 'data1');
    }

    /**
    *
    * 取得某一個錯誤 code 的 error data，但現在發生錯誤的 codes 裡並沒有這個 code
    *
    * @access   public
    * @param    param (type) : param description
    * @return   return : return description
    *
    */
    public function test_get_error_data_and_not_exist_code() {
        $error_data = $this->error->get_error_data('code3');
        $this->assertTrue(is_null($error_data));
    }

}

?>