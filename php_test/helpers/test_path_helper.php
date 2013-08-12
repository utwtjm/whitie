<?php

// ==================================================================
//
// 測試 path helper
//
// ------------------------------------------------------------------

class Test_path_helper extends CodeIgniterUnitTestCase {

    function __construct() {
    	parent::__construct('Test_path_helper');
    }

    /**
     *
     * 取得某一個有尺寸的檔案路徑
     *
     * @param type param
     *
     */
    public function test_upload_file_and_has_size() {
        $avatar_small_url = upload_file('avatars/a11/2013/07/0dbdfe723017a0a484be33f187e8b943.jpg', array(60, 60));
        show_result($avatar_small_url);
        $this->assertTrue($avatar_small_url == 'uploads/avatars/a11/2013/07/0dbdfe723017a0a484be33f187e8b943-60x60.jpg');
    }

    /**
     *
     * 取得某一個有尺寸的檔案 web 路徑
     *
     * @param type param
     *
     */
    public function test_upload_web_file_and_has_size_and_is_web_url() {
        $avatar_small_url = upload_web_file('avatars/a11/2013/07/0dbdfe723017a0a484be33f187e8b943.jpg', array(60, 60));
        show_result($avatar_small_url);
        $this->assertTrue($avatar_small_url == 'http://hello.whitie.com/uploads/avatars/a11/2013/07/0dbdfe723017a0a484be33f187e8b943-60x60.jpg');
    }

     /**
     *
     * 取得某一個有尺寸的檔案 real 路徑
     *
     * @param type param
     *
     */
    public function test_upload_real_file_and_has_size_and_is_real_url() {
        $avatar_small_url = upload_real_file('avatars/a11/2013/07/0dbdfe723017a0a484be33f187e8b943.jpg', array(60, 60));
        show_result($avatar_small_url);
    }

    /**
     *
     * 取得上傳檔案的實體路徑
     *
     * @param type param
     *
     */
    public function test_upload_real_file() {
        $file_real_path = upload_real_file('avatars/a11/hello.jpg');
        show_result($file_real_path);
    }

    /**
     *
     * 取得上傳檔案的實體路徑加上尺寸
     *
     * @param type param
     *
     */
    public function test_upload_real_file_and_has_size() {
        $file_real_path = upload_real_file('avatars/a11/hello.jpg', array(60, 60));
        show_result($file_real_path);
    }

}

?>