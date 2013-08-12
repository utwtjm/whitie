<?php

// ==================================================================
//
// 圖片調整
//
// ------------------------------------------------------------------

class Test_image_service extends CodeIgniterUnitTestCase {

	var $test_jpg;

	public function __construct($config = array()) {
		parent::__construct();

		// library
		$this->load->library('image_service');

		// init
		$this->test_jpg = '/Users/littleWhite/Documents/workspace/whitie/php_test/files/test.jpg';
		$this->test_png = '/Users/littleWhite/Documents/workspace/whitie/php_test/files/test.png';
		$this->test_gif = '/Users/littleWhite/Documents/workspace/whitie/php_test/files/test.gif';
	}

	public function setUp() {}

    public function tearDown() {}

	/**
	 *
	 * 測試依現在的尺寸，取得想要轉換的尺寸，相同的尺寸
	 *
	 * @param type param
	 *
	 */
	function test_get_transform_dim_and_100x100_to_100x100() {
		$transform_dim = $this->image_service->get_transform_dim(100, 100, 100, 100);
		$this->assertTrue($transform_dim[0] == 100 && $transform_dim[1] == 100);
	}

	/**
	 *
	 * 測試依現在的尺寸，取得想要轉換的尺寸，想要轉換的尺寸比較大
	 *
	 * @param type param
	 *
	 */
	function test_get_transform_dim_and_100x100_to_200x200() {
		$transform_dim = $this->image_service->get_transform_dim(100, 100, 200, 200);
		$this->assertTrue($transform_dim[0] == 100 && $transform_dim[1] == 100);
	}

	/**
	 *
	 * 測試依現在的尺寸，取得想要轉換的尺寸，想要轉換的尺寸寬度比較大，高度一樣
	 *
	 * @param type param
	 *
	 */
	function test_get_transform_dim_and_100x100_to_200x100() {
		$transform_dim = $this->image_service->get_transform_dim(100, 100, 200, 100);
		$this->assertTrue($transform_dim[0] == 100 && $transform_dim[1] == 100);
	}

	/**
	 *
	 * 測試依現在的尺寸，取得想要轉換的尺寸，想要轉換的尺寸寬度比較大，高度比較小
	 *
	 * @param type param
	 *
	 */
	function test_get_transform_dim_and_100x100_to_200x90() {
		$transform_dim = $this->image_service->get_transform_dim(100, 100, 200, 90);
		show_result($transform_dim);
		$this->assertTrue($transform_dim[0] == 90 && $transform_dim[1] == 90);
	}

	/**
	 *
	 * 測試依現在的尺寸，取得想要轉換的尺寸，想要轉換的尺寸寬度相同，高度比較大
	 *
	 * @param type param
	 *
	 */
	function test_get_transform_dim_and_100x100_to_100x200() {
		$transform_dim = $this->image_service->get_transform_dim(100, 100, 100, 200);
		show_result($transform_dim);
		$this->assertTrue($transform_dim[0] == 100 && $transform_dim[1] == 100);
	}


	/**
	 *
	 * 測試依現在的尺寸，取得想要轉換的尺寸，想要轉換的尺寸寬度比較小，高度比較大
	 *
	 * @param type param
	 *
	 */
	function test_get_transform_dim_and_100x100_to_90x200() {
		$transform_dim = $this->image_service->get_transform_dim(100, 100, 90, 200);
		show_result($transform_dim);
		$this->assertTrue($transform_dim[0] == 90 && $transform_dim[1] == 90);
	}

	/**
	 *
	 * 測試依現在的尺寸，取得想要轉換的尺寸，想要現在的尺寸比較大
	 *
	 * @param type param
	 *
	 */
	function test_get_transform_dim_and_200x200_to_100x100() {
		$transform_dim = $this->image_service->get_transform_dim(200, 200, 100, 100);
		$this->assertTrue($transform_dim[0] == 100 && $transform_dim[1] == 100);
	}

	/**
	 *
	 * 測試依現在的尺寸，取得想要轉換的尺寸，想要現在的尺寸寬度比較大，高度一樣
	 *
	 * @param type param
	 *
	 */
	function test_get_transform_dim_and_200x100_to_100x100() {
		$transform_dim = $this->image_service->get_transform_dim(200, 100, 100, 100);
		$this->assertTrue($transform_dim[0] == 100 && $transform_dim[1] == 50);
	}

	/**
	 *
	 * 測試依現在的尺寸，取得想要轉換的尺寸，現在的尺寸寬度比較大，高度比較小
	 *
	 * @param type param
	 *
	 */
	function test_get_transform_dim_and_200x90_to_100x100() {
		$transform_dim = $this->image_service->get_transform_dim(200, 90, 100, 100);
		show_result($transform_dim);
		$this->assertTrue($transform_dim[0] == 100 && $transform_dim[1] == 45);
	}

	/**
	 *
	 * 測試依現在的尺寸，取得想要轉換的尺寸，現在的尺寸寬度相同，高度比較大
	 *
	 * @param type param
	 */
	function test_get_transform_dim_and_100x200_to_100x100() {
		$transform_dim = $this->image_service->get_transform_dim(100, 200, 100, 100);
		show_result($transform_dim);
		$this->assertTrue($transform_dim[0] == 50 && $transform_dim[1] == 100);
	}


	/**
	 *
	 * 測試依現在的尺寸，取得想要轉換的尺寸，現在的尺寸寬度比較小，高度比較大
	 *
	 * @param type param
	 *
	 */
	function test_get_transform_dim_and_90x200_to_100x100() {
		$transform_dim = $this->image_service->get_transform_dim(90, 200, 100, 100);
		show_result($transform_dim);
		$this->assertTrue($transform_dim[0] == 45 && $transform_dim[1] == 100);
	}

	/**
	 *
	 * 測試特別的尺寸
	 *
	 * @param type param
	 *
	 */
	function test_get_transform_dim_and_465x700_to_177x177() {
		$transform_dim = $this->image_service->get_transform_dim(465, 700, 177, 177);
		show_result($transform_dim);
		$this->assertTrue($transform_dim[0] == 117 && $transform_dim[1] == 177);
	}

	/**
	 *
	 * 取得調整圖片大小需要的 imagecopyresampled 的參數，特別的大小
	 *
	 * @param type param
	 *
	 */
	function test_get_resize_dim_and_400x300_to_200x100() {
		$resize_dim = $this->image_service->get_resize_dim(400, 300, 200, 100, true);
		show_result($resize_dim);
		$this->assertTrue($resize_dim[4] == 200 && $resize_dim[5] == 100 && $resize_dim[6] == 400 && $resize_dim[7] == 200);
	}

	/**
	 *
	 * 取得調整圖片大小需要的 imagecopyresampled 的參數，特別的大小
	 *
	 * @param type param
	 *
	 */
	function test_get_resize_dim_and_400x300_to_100x200() {
		$resize_dim = $this->image_service->get_resize_dim(400, 300, 100, 200, true);
		show_result($resize_dim);
		$this->assertTrue($resize_dim[4] == 100 && $resize_dim[5] == 200 && $resize_dim[6] == 150 && $resize_dim[7] == 300);
	}

	/**
	 *
	 * 取得調整圖片大小需要的 imagecopyresampled 的參數，特別的大小
	 *
	 * @param type param
	 *
	 */
	function test_get_resize_dim_and_400x300_to_100x100() {
		$resize_dim = $this->image_service->get_resize_dim(400, 300, 200, 400, true);
		show_result($resize_dim);
		$this->assertTrue($resize_dim[4] == 200 && $resize_dim[5] == 300 && $resize_dim[6] == 200 && $resize_dim[7] == 300);
	}

	/**
	 *
	 * 取得調整圖片大小需要的 imagecopyresampled 的參數，特別的大小
	 *
	 * @param type param
	 *
	 */
	function test_get_resize_dim_and_400x400_to_400x400() {
		$resize_dim = $this->image_service->get_resize_dim(400, 400, 400, 400, true);
		show_result($resize_dim);
		$this->assertTrue(!$resize_dim);
	}

	/**
	 *
	 * 取得調整圖片大小需要的 imagecopyresampled 的參數，特別的大小
	 *
	 * @param type param
	 *
	 */
	function test_get_resize_dim_and_100x200_to_400x300() {
		$resize_dim = $this->image_service->get_resize_dim(100, 200, 400, 300, true);
		show_result($resize_dim);
		$this->assertTrue(!$resize_dim);
	}

	/**
	 *
	 * 取得調整圖片大小需要的 imagecopyresampled 的參數，特別的大小
	 *
	 * @param type param
	 *
	 */
	function test_get_resize_dim_and_100x200_to_300x400() {
		$resize_dim = $this->image_service->get_resize_dim(100, 200, 300, 400, true);
		show_result($resize_dim);
		$this->assertTrue(!$resize_dim);
	}

	/**
	 *
	 * 取得調整圖片大小需要的 imagecopyresampled 的參數，特別的大小
	 *
	 * @param type param
	 *
	 */
	function test_get_resize_dim_and_465x700_to_177x177() {
		$resize_dim = $this->image_service->get_resize_dim(465, 700, 177, 177, true);
		show_result($resize_dim);
		$this->assertTrue($resize_dim[4] == 177 && $resize_dim[5] == 177 && $resize_dim[6] == 465 && $resize_dim[7] == 465);
	}

	/**
	 *
	 * 測試調整圖片大小 jpg
	 *
	 * @param type param
	 *
	 */
	function test_resize_and_jpg() {
		$test_thumb = '/Users/littleWhite/Documents/workspace/whitie/php_test/files/test_thumb.jpg';
		@unlink($test_thumb);
		$result = $this->image_service->resize($this->test_jpg, $test_thumb, 100, 100);
		show_image('<img src="php_test/files/test.jpg"><img src="php_test/files/test_thumb.jpg">');
		$thumb_exist = file_exists($test_thumb);
		$this->assertTrue($thumb_exist);
	}


	/**
	 *
	 * 測試調整圖片大小 jpg
	 *
	 * @param type param
	 *
	 */
	function test_resize_and_png() {
		$test_thumb = '/Users/littleWhite/Documents/workspace/whitie/php_test/files/test_thumb.png';
		@unlink($test_thumb);
		$result = $this->image_service->resize($this->test_png, $test_thumb, 100, 100);
		show_image('<img src="php_test/files/test.png"><img src="php_test/files/test_thumb.png">');
		$thumb_exist = file_exists($test_thumb);
		$this->assertTrue($thumb_exist);
	}

	/**
	 *
	 * 測試調整圖片大小 jpg
	 *
	 * @param type param
	 *
	 */
	function test_resize_and_gif() {
		$test_thumb = '/Users/littleWhite/Documents/workspace/whitie/php_test/files/test_thumb.gif';
		@unlink($test_thumb);
		$result = $this->image_service->resize($this->test_gif, $test_thumb, 100, 100);
		show_image('<img src="php_test/files/test.gif"><img src="php_test/files/test_thumb.gif">');
		$thumb_exist = file_exists($test_thumb);
		$this->assertTrue($thumb_exist);
	}

	/**
	 *
	 * 測試調整圖片大小 jpg
	 *
	 * @param type param
	 *
	 */
	function test_resize_and_jpg_copy_fail() {
		$test_thumb_fail = '/Users/littleWhite/Documents/workspace/whitie/php_test/files/test_thumb_fail.jpg';
		@unlink($test_thumb_fail);
		$result = $this->image_service->resize($this->test_jpg, $test_thumb_fail, 2000, 2000);
		show_result($result);
		$thumb_exist = file_exists($test_thumb_fail);
		$this->assertTrue($thumb_exist);
	}

	/**
	 *
	 * 測試調整圖片大小 jpg
	 *
	 * @param type param
	 *
	 */
	function test_crop_and_jpg() {
		$test_thumb_crop = '/Users/littleWhite/Documents/workspace/whitie/php_test/files/test_thumb_crop.jpg';
		@unlink($test_thumb_crop);
		$result = $this->image_service->resize($this->test_jpg, $test_thumb_crop, 100, 100, true);
		show_image('<img src="php_test/files/test.jpg"><img src="php_test/files/test_thumb_crop.jpg">');
		$thumb_exist = file_exists($test_thumb_crop);
		$this->assertTrue($thumb_exist);
	}

	/**
	 *
	 * 測試調整圖片大小 png
	 *
	 * @param type param
	 *
	 */
	function test_crop_and_png() {
		$test_thumb_crop = '/Users/littleWhite/Documents/workspace/whitie/php_test/files/test_thumb_crop.png';
		@unlink($test_thumb_crop);
		$result = $this->image_service->resize($this->test_png, $test_thumb_crop, 100, 100, true);
		show_image('<img src="php_test/files/test.png"><img src="php_test/files/test_thumb_crop.png">');
		$thumb_exist = file_exists($test_thumb_crop);
		$this->assertTrue($thumb_exist);
	}

	/**
	 *
	 * 測試調整圖片大小 png
	 *
	 * @param type param
	 *
	 */
	function test_crop_and_gif() {
		$test_thumb_crop = '/Users/littleWhite/Documents/workspace/whitie/php_test/files/test_thumb_crop.gif';
		@unlink($test_thumb_crop);
		$result = $this->image_service->resize($this->test_gif, $test_thumb_crop, 100, 100, true);
		show_image('<img src="php_test/files/test.gif"><img src="php_test/files/test_thumb_crop.gif">');
		$thumb_exist = file_exists($test_thumb_crop);
		$this->assertTrue($thumb_exist);
	}

}

?>
