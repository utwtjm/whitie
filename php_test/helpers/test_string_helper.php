<?php

// ==================================================================
//
// 測試 string helper
//
// ------------------------------------------------------------------

class Test_string_helper extends CodeIgniterUnitTestCase {

    function __construct() {
    	parent::__construct('Test_string_helper');
    }

     /**
     *
     * 測試新增額外的名字到完整的 folder 路徑裡 
     *
     * @param type param
     *
     */
    public function test_add_extra_file_name_and_folder_path() {
        $file = add_extra_file_name(MAIN_PATH . 'php_test/files', '-60x60');
        $this->assertTrue($file == MAIN_PATH . 'php_test/files');
    }

    /**
     *
     * 測試新增額外的名字到完整的絕對 file 路徑裡 
     *
     * @param type param
     *
     */
    public function test_add_extra_file_name_and_abs_path() {
        $file = add_extra_file_name(MAIN_PATH . 'php_test/files/vaild.png', '-60x60');
        $this->assertTrue($file == MAIN_PATH . 'php_test/files/vaild-60x60.png');
    }

     /**
     *
     * 測試新增額外的名字到完整的相對 file 路徑裡 
     *
     * @param type param
     *
     */
    public function test_add_extra_file_name_and_rel_path() {
        $extra_file = add_extra_file_name('php_test/files/vaild.png', '-60x60');
        $this->assertTrue($extra_file == 'php_test/files/vaild-60x60.png');
    }

    /**
    *
    * email 的字串只有兩個字
    *
    * @access	public
    * @param	param (type) : param description
    * @return 	return : return description
    *
    */
    function test_is_email_and_two_char() {
    	$is_email = is_email('ab');
    	$this->assertFalse($is_email);
    }

    /**
    *
    * email 的字串沒有 @
    *
    * @access	public
    * @param	param (type) : param description
    * @return 	return : return description
    *
    */
    function test_is_email_and_no_mouse_symbol() {
    	$is_email = is_email('utwtjmgmail.com');
    	$this->assertTrue(!$is_email);
    }

    /**
    *
    * email 的字串以 . 分割後少於兩個 part
    *
    * @access	public
    * @param	param (type) : param description
    * @return 	return : return description
    *
    */
    function test_is_email_and_smaller_two_part() {
    	$is_email = is_email('a@com');
    	$this->assertFalse($is_email);
    }

     /**
    *
    * email 的字串 domain 不合法
    *
    * @access	public
    * @param	param (type) : param description
    * @return 	return : return description
    *
    */
    function test_is_email_and_domain_not_vaild() {
    	$is_email = is_email('utwtjm@_gmail.com');
    	$this->assertFalse($is_email);
    }

}

?>