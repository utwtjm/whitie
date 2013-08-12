<?php

// ==================================================================
//
// 測試 user_upload_service
//
// ------------------------------------------------------------------

class Test_user_upload_service extends CodeIgniterUnitTestCase {

    var $user_id;
    var $vaild_image_file;
    var $file_name;

	public function __construct() {
		parent::__construct();

		// library
		$this->load->library(array('user_upload_service'));
	}

    /**
    *
    * 刪除檔案
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function delete_upload_file() {
        $datas = $this->user_upload_service->datas();
        foreach($datas as $data) {
            // 在這裡會用 @ 是因為我連續測試二次，在第一次測試完畢的時候，已經刪除把檔案了，
            // 但 data 還是記著，所以在第二次測試時，會重覆刪除第一次測試的檔案，所以如果不用 @ 會錯誤
            @unlink($data['full_path']);
        }
    }

    /**
    *
    * 設定 $_FILE
    *
    * @access    public
    * @param    file (type) : file path
    * @return     return : return description
    *
    */
    function set_file($files) {
        // 讀取他的大小、寬度、類型，塞回 $file
        $fake_files = array();
        foreach($files as $index => $file) {
            
            // 取得檔案資訊
            $pathinfo = pathinfo($file);
            $name = $pathinfo['basename'];
            $tmp_name = $file;
            $fhandle = finfo_open(FILEINFO_MIME, config_get('magic_file'));
            $type = finfo_file($fhandle, $file);
            $error = 0;
            $size = filesize($file);

            // 儲存
            $file_multi_name = array('userfile1', 'userfile2');
            $file_key_name = $file_multi_name[$index];
            $fake_files[$file_key_name]['name'] = $name;
            $fake_files[$file_key_name]['tmp_name'] = $tmp_name;
            $fake_files[$file_key_name]['type'] = $type;
            $fake_files[$file_key_name]['error'] = $error;
            $fake_files[$file_key_name]['size'] = $size;

        }

      $_FILES = $fake_files;
    }

	public function setUp() {}

    public function tearDown() {
        // 刪除
        $this->delete_upload_file();
        $_FILES = array();
    }

    /**
    *
    * 測試建立使用者大頭照目錄
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_create_avatar_folder_and_folder_not_exist() {
        $success = $this->user_upload_service->create_avatar_folder(1);
        $this->assertTrue($success);
    }

    /**
    *
    * 測試建立使用者大頭照目錄
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_create_image_folder_and_folder_not_exist() {
        $success = $this->user_upload_service->create_image_folder(1);
        $this->assertTrue($success);
    }

    /**
    *
    * 測試建立使用者檔案目錄
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_create_file_folder_and_folder_not_exist() {
        $success = $this->user_upload_service->create_file_folder(1);
        $this->assertTrue($success);
    }

    /**
    *
    * 取得 user 的上傳目錄 folder
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_get_avatar_folder() {
        $user_upload_avatar_folder = $this->user_upload_service->get_avatar_folder($this->user_id, '2013-07-11');
        show_result($user_upload_avatar_folder);
        $this->assertTrue($user_upload_avatar_folder == 'avatars/a11/2013/07');
    }

    /**
    *
    * 取得 user 的上傳照片目錄
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_get_image_folder() {
        $user_upload_image_folder = $this->user_upload_service->get_image_folder($this->user_id, '2013-01-01');
        show_result($user_upload_image_folder);
        $this->assertTrue($user_upload_image_folder == 'images/a11/2013/01');
    }

     /**
    *
    * 取得 user 的上傳檔案目錄
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_get_file_folder() {
        $user_upload_file_folder = $this->user_upload_service->get_file_folder($this->user_id, '2013-01-01');
        $this->assertTrue($user_upload_file_folder == 'files/a11/2013/01');
    }

    /**
     *
     * 測試取得 user 上傳檔案的路徑，真實路徑
     *
     * @param type param
     *
     */
    public function test_get_avatar_folder_and_real_avatar_path() {
        $user_avatar_file = $this->user_upload_service->get_avatar_folder($this->user_id, '2013-07-11', true);
        show_result($user_avatar_file);
        $this->assertTrue($user_avatar_file == REAL_APPPATH . '/' . UPLOAD_FOLDER . '/' . 'avatars/a11/2013/07');
    }

    /**
    *
    * 測試取得在 file or image 之下的日期目錄路徑
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_get_date_folder() {
        $date_folder = $this->user_upload_service->get_date_folder('2013-01-02');
        $this->assertTrue($date_folder == '2013/01');
    }

    /**
    *
    * 測試上傳
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_do_image_upload_and_not_select() {
        // 測試
        show_result($_FILES);
        $file_names = array('userfile1', 'userfile2');
        $result = $this->user_upload_service->do_image_upload($this->user_id, $file_names);
        show_result($result);
        $this->assertTrue($result->has_error());
    }


    /**
    *
    * 測試上傳，圖片太大
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_do_image_upload_and_size_too_big() {
        // 測試
        $files = array(MAIN_PATH . 'php_test/files/vaild.png');
        $file_names = array('userfile1');
        $this->set_file($files);
        $result = $this->user_upload_service->do_image_upload($this->user_id, $file_names, null, array('max_size'=>1));
        show_result($result);
        $this->assertTrue($result->has_error());
    }


    /**
    *
    * 測試上傳，圖片寬度太大
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_do_image_upload_and_width_too_big() {
        // 測試
        $files = array(MAIN_PATH . 'php_test/files/vaild.png');
        $file_names = array('userfile1');
        $this->set_file($files);
        $result = $this->user_upload_service->do_image_upload($this->user_id, $file_names, null, array('max_width'=>100));
        show_result($result);
        $this->assertTrue($result->has_error());
    }

    /**
    *
    * 測試上傳，圖片高度太大
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_do_image_upload_and_height_too_big() {
        // 測試
        $files = array(MAIN_PATH . 'php_test/files/vaild.png');
        $file_names = array('userfile1');
        $this->set_file($files);
        $result = $this->user_upload_service->do_image_upload($this->user_id, $file_names, null, array('max_height'=>100));
        show_result($result);
        $this->assertTrue($result->has_error());
    }

    /**
    *
    * 上傳一個單一檔案
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_do_image_upload_and_single_file() {
        // 測試
        $files = array(MAIN_PATH . 'php_test/files/vaild.png');
        $file_names = array('userfile1');
        $this->set_file($files);
        show_result($_FILES);
        $result = $this->user_upload_service->do_image_upload($this->user_id, $file_names);
        show_result($result);
        $this->assertTrue(!$result->has_error());
    }

    /**
    *
    * 測試上傳，多個檔案
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_do_image_upload_and_many_file() {
        $vaild_png = MAIN_PATH . 'php_test/files/vaild.png';
        $files = array($vaild_png, $vaild_png);
        $file_names = array('userfile1', 'userfile2');
        $this->set_file($files);
        $result = $this->user_upload_service->do_image_upload($this->user_id, $file_names);
        show_result($result);
        $this->assertTrue(!$result->has_error());
    }

    /**
    *
    * 上傳一個 word
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_do_file_upload_and_word_file() {
        // 測試
        $files = array(MAIN_PATH . 'php_test/files/hello.docx');
        $file_names = array('userfile1');
        $this->set_file($files);
        $result = $this->user_upload_service->do_file_upload($this->user_id, $file_names);
        show_result($result);
        $this->assertTrue(!$result->has_error());
    }

    /**
    *
    * 測試上傳大頭照
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    function test_do_avatar_upload() {
        // 測試
        $files = array(MAIN_PATH . 'php_test/files/vaild.png');
        $file_names = array('userfile1');
        $this->set_file($files);
        $result = $this->user_upload_service->do_avatar_upload($this->user_id, $file_names);
        show_result($result);
        $this->assertTrue(!$result->has_error());
    }

    /**
     *
     * 測試刪除 user 上傳的東西
     *
     * @param type param
     *
     */
    public function test_delete() {
        $vaild_image_file = MAIN_PATH . 'php_test/files/vaild.png';
        $vaild_delete_image_file = MAIN_PATH . 'php_test/files/delete.png';
        copy($vaild_image_file, $vaild_delete_image_file);
        $result = $this->user_upload_service->delete($vaild_delete_image_file);
        $file_exists = file_exists($vaild_delete_image_file);
        $this->assertTrue(!$file_exists);
    }

     /**
     *
     * 測試選了一個檔案
     *
     * @param type param
     *
     */
    public function test_has_select_file_and_not_select_file() {
        $has_select = $this->user_upload_service->has_select_file(array('userfile1'));
        $this->assertFalse($has_select);
    }

    /**
     *
     * 測試選了一個檔案
     *
     * @param type param
     *
     */
    public function test_has_select_file_and_one_file() {
        $files = array(MAIN_PATH . 'php_test/files/vaild.png');
        $this->set_file($files);
        $has_select = $this->user_upload_service->has_select_file(array('userfile1'));
        $this->assertTrue($has_select);
    }

     /**
     *
     * 測試選了多個檔案
     *
     * @param type param
     *
     */
    public function test_has_select_file_and_multi_file() {
        $vaild_image_file = MAIN_PATH . 'php_test/files/vaild.png';
        $files = array($vaild_image_file, $vaild_image_file);
        $this->set_file($files);
        $has_select = $this->user_upload_service->has_select_file(array('userfile1', 'userfile2'));
        $this->assertTrue($has_select);
    }


     /**
     *
     * 可以多個上傳，但只選擇了一個檔案上傳
     *
     * @param type param
     *
     */
    public function test_has_select_file_and_multi_file_and_one_file_select() {
        $files = array(MAIN_PATH . 'php_test/files/vaild.png');
        $this->set_file($files);
        $has_select = $this->user_upload_service->has_select_file(array('userfile1', 'userfile2'));
        $this->assertFalse($has_select);
    }

     /**
     *
     * 建立大頭照的縮圖，但原始檔案不存在
     *
     * @param type param
     *
     */
    public function test_create_thumb_file_and_not_exist_orig_img() {
        try {
            $sizes = array(new Size(70, 70));
            $test_fail_avatar_file = 'php_test/files/test-60x60.jpg';
            $avatar_thumb_files = $this->user_upload_service->create_thumb_file($test_fail_avatar_file, $sizes);
            show_result($avatar_thumb_files);
        } catch (Exception $e) {
            $this->assertEqual("縮圖時原始圖檔不存在", $e->getMessage());
        }
    }

    /**
     *
     * 建立大頭照的縮圖
     *
     * @param type param
     *
     */
    public function test_create_thumb_file() {
        // 測試
        $sizes = array(new Size(70, 70));
        $test_avatar_file = MAIN_PATH . 'php_test/files/test.jpg';
        $avatar_thumb_files = $this->user_upload_service->create_thumb_file($test_avatar_file, $sizes);
        show_result($avatar_thumb_files);
        $this->assertTrue(count($avatar_thumb_files));

        // 刪除
        foreach($avatar_thumb_files as $avatar_thumb_file) {
            @unlink($avatar_thumb_file);
        }
    }

    /**
     *
     * 刪除舊的縮圖
     *
     * @param type param
     *
     */
    public function test_delete_thumb_file() {
        // 建立一張縮圖
        $test_avatar_file = MAIN_PATH . 'php_test/files/test.jpg';
        $test_avatar_thumb_file = MAIN_PATH . 'php_test/files/test-60x60.jpg';
        copy($test_avatar_file, $test_avatar_thumb_file);

        // 驗證
        $sizes = array(new Size(60, 60));
        $delete_thumb_files = $this->user_upload_service->delete_thumb_file($test_avatar_file, $sizes);
        $this->assertTrue(count($delete_thumb_files) == 0);
    }


    /**
     *
     * 測試取得 user 上傳檔案
     *
     * @param type param
     *
     */
    public function test_get_upload_avatar() {
        $user_avatar_file = $this->user_upload_service->get_upload_avatar('hello.jpg', 1, '2013-07-11');
        show_result($user_avatar_file);
        $this->assertTrue($user_avatar_file == 'avatars/a11/2013/07/hello.jpg');
    }

      /**
     *
     * 測試取得 user 上傳檔案
     *
     * @param type param
     *
     */
    public function test_get_upload_image() {
        $user_avatar_file = $this->user_upload_service->get_upload_image('hello.jpg', 1, '2013-07-11');
        show_result($user_avatar_file);
        $this->assertTrue($user_avatar_file == 'images/a11/2013/07/hello.jpg');
    }

    /**
     *
     * 測試取得 user 上傳檔案
     *
     * @param type param
     *
     */
    public function test_get_upload_file() {
        $user_avatar_file = $this->user_upload_service->get_upload_file('hello.jpg', 1, '2013-07-11');
        show_result($user_avatar_file);
        $this->assertTrue($user_avatar_file == 'files/a11/2013/07/hello.jpg');
    }

}

?>



