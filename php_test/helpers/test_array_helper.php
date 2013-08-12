<?php

// ==================================================================
//
// 測試 array helper
//
// ------------------------------------------------------------------

class Test_array_helper extends CodeIgniterUnitTestCase {

    function __construct() {
    	parent::__construct('Test_array_helper');
    }

    /**
     *
     * 取得 array 裡面某個 key 的所有 value
     *
     * @param type param
     *
     */
    public function test_objects_key_values() {
        $objects = array();
        $objects[0] = new stdClass();
        $objects[0]->a = 1;
        $objects[1] = new stdClass();
        $objects[1]->a = 2;
        $values = objects_key_values($objects, 'a');
        $this->assertTrue($values[0] == 1 && $values[1] == 2);
    }

}

?>