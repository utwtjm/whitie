<?php

class Test_editor_service extends CodeIgniterUnitTestCase {

	public function __construct() {
		parent::__construct();

        // library
		$this->load->library('editor_service');
	}

    public function setUp() {}

    public function tearDown() {}

    /**
     *
     * 取得 tiny_mce 的 js config string
     *
     * @param type param
     *
     */
    public function test_get_js_config_and_empty_config() {
        $tiny_mce = new Tiny_mce();
        $js_config = $tiny_mce->get_js_config();
        $this->assertTrue(empty($js_config));
    }

     /**
     *
     * 設定 bool config
     *
     * @param type param
     *
     */
    public function test_get_js_config_and_bool_config() {
        $tiny_mce = new Tiny_mce(array('relative_urls'=>false));
        $js_config_string = $tiny_mce->get_js_config();
        show_result($js_config_string);
        $this->assertTrue($js_config_string == "{relative_urls:false}");
    }

    /**
     *
     * 設定兩個以上的 config
     *
     * @param type param
     *
     */
    public function test_get_js_config_and_many_config() {
        $tiny_mce = new Tiny_mce(array('relative_urls'=>false
            , 'entities'=>"38,amp,60,lt,62,gt"));
        $js_config_string = $tiny_mce->get_js_config();
        show_result($js_config_string);
        $this->assertTrue($js_config_string == "{relative_urls:false,\nentities:'38,amp,60,lt,62,gt'}");
    }
}

?>