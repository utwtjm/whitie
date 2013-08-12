<?php

// ==================================================================
//
// 圖片調整
//
// ------------------------------------------------------------------

class Image_service extends Base_service {

	public function __construct($config = array()) {
		parent::__construct();

		// library
		$this->load->library('image_lib');

		// config
		$this->config->load('image', true);

		// lang
		$this->lang->load('image');
	}

	/**
	 *
	 * 依現在的尺寸，取得可以轉換的尺寸
	 *
	 * @param type param
	 *
	 */
	public function get_transform_dim($current_width, $current_height, $max_width = 0, $max_height = 0) {
		// 如果沒傳要轉換的尺寸就直接回傳原尺寸
		if (!$max_width && !$max_height) {
			return array($current_width, $current_height);
		}

		// 找出可以轉換的最大比例，當現在的尺寸比要放大的尺寸還小的時候，最大比例就為 1，表示不能放大
		$width_ratio = 1.0;
		$height_ratio = 1.0;
		$did_width = false;
		$did_height = false;
		if ($max_width > 0 && $current_width > 0 && $current_width > $max_width ) {
			$width_ratio = $max_width / $current_width;
			$did_width = true;
		}
		if ($max_height > 0 && $current_height > 0 && $current_height > $max_height ) {
			$height_ratio = $max_height / $current_height;
			$did_height = true;
		}
		
		if (intval($current_width * $width_ratio) > $max_width || intval($current_height * $width_ratio) > $max_height) {
			$ratio = $height_ratio;
		} else {
			$ratio = $width_ratio;
		}

		// 算出寬高，無條件捨去
		$w = intval($current_width  * $ratio);
		$h = intval($current_height * $ratio);

		// 因為在 465x700 轉成 177x177 的情況下會有除不盡的情況，會得到 117x176，與我要的結果差 1，所以在這裡做補救
		if ($did_width && $w == $max_width - 1) {
			$w = $max_width;
		}
		if ($did_height && $h == $max_height - 1) {
			$h = $max_height;
		}

		return array($w, $h);
	}

	/**
	 *
	 * 取得調整圖片大小需要的 imagecopyresampled 的參數
	 * ex : 400 x 300 -> 200 x 100 => 200 x 100
	 * ex : 200 x 100 -> 400 x 300 => 200 x 100
	 * ex : 400 x 300 -> 200 x 400 => 200 x 300
	 *
	 * @param type param
	 *
	 */
	function get_resize_dim($orig_w, $orig_h, $dest_w, $dest_h, $crop = false) {
		// 防呆，如果原本的寬高都小於 0 就 return false
		if($orig_w <= 0 || $orig_h <= 0) {
			return false;
		}

		// 防呆，如果目標的寬高都小於 0 就 return false
		if($dest_w <= 0 && $dest_h <= 0) {
			return false;
		}

		// 如果要切圖
		if($crop) {

			// 取得要切的大小，四捨五入
			$aspect_ratio = $orig_w / $orig_h;
			$new_w = min($dest_w, $orig_w);
			$new_h = min($dest_h, $orig_h);

			// 依要切的大小先將原圖縮放
			$size_ratio = max($new_w / $orig_w, $new_h / $orig_h);
			$crop_w = round($new_w / $size_ratio);
			$crop_h = round($new_h / $size_ratio);

			// 依來源的寬高，取得切圖的 x y (置中)
			$s_x = floor(($orig_w - $crop_w) / 2);
			$s_y = floor(($orig_h - $crop_h) / 2);

		} else {

			$crop_w = $orig_w;
			$crop_h = $orig_h;
			$s_x = 0;
			$s_y = 0;
			list($new_w, $new_h) = $this->get_transform_dim($orig_w, $orig_h, $dest_w, $dest_h);

		}

		// 如果原圖沒有比要調整的大小還大，就不調整了
		if ($new_w >= $orig_w && $new_h >= $orig_h) {
			return false;
		}

		// 回傳 imagecopyresampled 的參數
		return array(0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h);
	}

	/**
	 *
	 * 調整圖片大小
	 *
	 * @param type param
	 *
	 */
	function resize($orig_img, $dest_img, $width, $height, $crop = false, $config = array()) {
		// 需清掉 error，不然連續呼叫兩次，第一次 error，第二次也會 error
		$this->image_lib->clear_error();

		$my_error = new MY_Error();

		// 取得原來的大小
		$image_properties = $this->image_lib->get_image_properties($orig_img, true);
		$orig_width = $image_properties['width'];
		$orig_height = $image_properties['height'];

		// 取得能縮放的寬高，如果不能縮放，直接覆制原本的到目的地
		$resize_dim = $this->get_resize_dim($orig_width, $orig_height, $width, $height, $crop);
		list($resize_dim_dst_x, $resize_dim_dst_y, $resize_dim_src_x, $resize_dim_src_y, $resize_dim_dst_w, $resize_dim_dst_h, $resize_dim_src_w, $resize_dim_src_h) = $resize_dim;
		if(!$resize_dim) {
			if(!@copy($orig_img, $dest_img)) {
			    $my_error->add('resize_copy_error', lang_get('image_resize_copy_error'));
			}
			return $my_error;
		} 

		// 設定 image_lib 參數，進行縮放
		$default_config = config_get(null, 'image');
		$default_config = array_merge($default_config, $config);
		$default_config['source_image'] = $orig_img;
		$default_config['new_image'] = $dest_img;
		$default_config['width'] = $resize_dim_dst_w;
		$default_config['height'] = $resize_dim_dst_h;
		$default_config['src_width'] = $resize_dim_src_w;
		$default_config['src_height'] = $resize_dim_src_h;
		$default_config['x_axis'] = $resize_dim_src_x;
		$default_config['y_axis'] = $resize_dim_src_y;
		$this->image_lib->initialize($default_config);

		if($crop) {
			$this->image_lib->crop();
		} else {
			$this->image_lib->resize();
		}

		// 讀取錯誤訊息，組成 my_error
		$resize_error_messages = $this->image_lib->error_msg;
		foreach($resize_error_messages as $resize_error_message) {
			$my_error->add('resize_error', $resize_error_message);
		}
		return $my_error;
	}

}

?>
