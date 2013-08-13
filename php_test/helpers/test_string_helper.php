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

     /**
     *
     * 對空的字串編碼
     *
     * @param type param
     *
     */
    public function test_esc_attr_and_empty_string() {
        $text = esc_attr(" ", ENT_QUOTES);
        show_result($text);
        $this->assertTrue($text == ' ');
    }

    /**
     *
     * 將放入 html attr 的 value 編碼
     *
     * @param type param
     *
     */
    public function test_esc_attr_and_ent_quotes() {
        $text = esc_attr("<a href='test'>Test</a>", ENT_QUOTES);
        show_result($text);
        $this->assertTrue($text == '&lt;a href=&#039;test&#039;&gt;Test&lt;/a&gt;');
    }

    /**
     *
     * 將空的 url 編碼
     *
     * @param type param
     *
     */
    public function test_esc_url_and_empty_string() {
        $url = esc_url(' ');
        $this->assertTrue($url == '');
    }

    /**
     *
     * 將 http 開頭的 url 編碼
     *
     * @param type param
     *
     */
    public function test_esc_url_and_http_url() {
        $url = esc_url('http://www.kimo.com.tw');
        show_result($url);
        $this->assertTrue($url == 'http%3A%2F%2Fwww.kimo.com.tw');
    }

     /**
     *
     * 將內含空白的 url 編碼
     *
     * @param type param
     *
     */
    public function test_esc_url_and_has_empty_url() {
        $url = esc_url('http://www.kimo.com.tw?a= 1');
        show_result($url);
        $this->assertTrue($url == 'http%3A%2F%2Fwww.kimo.com.tw%3Fa%3D+1');
    }

}

?>