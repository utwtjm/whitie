<?php

// ==================================================================
//
// 測試 url helper
//
// ------------------------------------------------------------------

class Test_url_helper extends CodeIgniterUnitTestCase {

    function __construct() {
    	parent::__construct('Test_url_helper');
    }

    /**
     *
     * 傳入絕對路徑，取得 web url
     *
     * @param type param
     *
     */
    public function test_web_url_and_abs_url() {
        $web_url = web_url('/hello.png');
        $this->assertTrue($web_url == 'http://hello.whitie.com/hello.png');
    }

     /**
     *
     * 傳入相對路徑，取得 web url
     *
     * @param type param
     *
     */
    public function test_web_url_and_rel_url() {
        $web_url = web_url('hello.png');
        $this->assertTrue($web_url == 'http://hello.whitie.com/hello.png');
    }

}

?>