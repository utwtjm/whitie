<?php

// ==================================================================
//
// 測試 html helper
//
// ------------------------------------------------------------------

class Test_html_helper extends CodeIgniterUnitTestCase {

    function __construct() {
    	parent::__construct('Test_html_helper');
    }

    /**
     *
     * 取得 script tag
     *
     * @param type param
     *
     */
    public function test_add_script() {
        $script = add_script('theme', true);
        show_result($script);
    }

}

?>