<?php

// ==================================================================
//
// 上傳的服務
//
// ------------------------------------------------------------------

class User_upload_service extends Base_service {

	public function __construct($config = array()) {
		parent::__construct();

		if (count($config) > 0)
		{
			$this->initialize($config);
		}

		// library
		$this->load->library(array('image_service', 'error_service', 'upload', 'user_account_service'));

		// config
		$this->config->load('upload', true);

		// model
		$this->load->model(array('user_model'));

		// lang
		$this->lang->load('imglib');
		$this->lang->load('image');
	}

	public function initialize($config = array()) {
		foreach ($config as $key => $val)
		{
			if (isset($this->$key))
			{
				$this->$key = $val;
			}
		}
	}


	/**
	*
	* 上傳到圖片、檔案、大頭照目錄
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function do_upload($config = array()) {
		// 如果有設定 config，則呼叫 init 覆寫 config
		if(!empty($config)) {
			$this->upload->initialize($config);
		}

		// 取得 file_name ，沒設定就以預設為主
		if(isset($config['file_names'])) {
			$file_names = $config['file_names'];
		} else {
			$file_names = upload_config_get('file_names');
		}

		// 上傳
		$this->upload->do_multi_upload($file_names);

		// 讀取錯誤訊息，組成 my_error
		$my_error = new MY_Error();
		$upload_error_messages = $this->upload->error_msg;
		foreach($upload_error_messages as $upload_error_message) {
			$my_error->add('upload_error', $upload_error_message);
		}

		return $my_error;
	}

	/**
	*
	* 上傳的結果
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function datas($key_name = null) {
		if(is_null($key_name)) {
			return $this->upload->datas;
		}

		$result = array();
		foreach($this->upload->datas as $data) {
			$result[] = $data[$key_name];
		}

		return $result;
	}

	/**
	*
	* 上傳照片到 user 的照片目錄
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function do_image_upload($user_id, $file_names, $date = null, $config = array()) {
		// 建立 user image folder
		$result = $this->create_image_folder($user_id, $date);
		if(is_my_error($result)) {
			return $result;
		}

		// 上傳
		$default_config = config_get(null, 'upload');
		$default_config = array_merge($default_config, $config);
		$default_config['upload_path'] = $this->get_image_folder($user_id, null, null, true);
		$default_config['allowed_types'] = $default_config['allowed_image_types'];
		$default_config['file_names'] = $file_names;
		return $this->do_upload($default_config);
	}

	/**
	*
	* 上傳照片到 user 的檔案目錄
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function do_file_upload($user_id, $file_names, $date = null, $config = array()) {
		// 建立 user file folder
		$result = $this->create_file_folder($user_id, $date);
		if(is_my_error($result)) {
			return $result;
		}

		// 上傳
		$default_config = config_get(null, 'upload');
		$default_config = array_merge($default_config, $config);
		$default_config['upload_path'] = $this->get_file_folder($user_id, null, true);
		$default_config['allowed_types'] = $default_config['allowed_file_types'];
		$default_config['file_names'] = $file_names;
		return $this->do_upload($default_config);
	}

	/**
	 *
	 * 刪除 user upload 的資料
	 *
	 * @param type file_name 完整的路徑與檔名
	 *
	 */
	public function delete($file_name) {
		if (strpos($file_name, "/") !== 0) {
			$file_name = upload_real_file($file_name);
		}
		@unlink($file_name);
	}

	/**
	*
	* 上傳照片到 user 的大頭照目錄
	*
	* @access	public
	* @param	file_names (array) : 上傳的 input name
	* @return 	return : return description
	*
	*/
	function do_avatar_upload($user_id, $file_names, $date = null, $config = array()) {
		// 建立 user avatar folder
		$result = $this->create_avatar_folder($user_id, $date);
		if(is_my_error($result)) {
			return $result;
		}

		// 上傳
		$default_config = config_get(null, 'upload');
		$default_config = array_merge($default_config, $config);
		$default_config['upload_path'] = $this->get_avatar_folder($user_id, null, true);
		$default_config['allowed_types'] = $default_config['allowed_image_types'];
		$default_config['file_names'] = $file_names;
		return $this->do_upload($default_config);
	}

	/**
	*
	* 建立 user 上傳的目錄
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function create_folder($primary_folder) {
		$error = new MY_Error();
		// 檢查使用者的 images or files 目錄有沒有建立，如果沒有就在建立
		if(!file_exists($primary_folder)) {
			if (!mkdir($primary_folder, 0777, true)) {
			    $error->add('folder_user_folder_create_fail', lang_get('folder_user_folder_create_fail'));
			    return $error;
			}
		}
		return true;
	}

	/**
	*
	* 建立使用者的大頭照目錄
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function create_avatar_folder($user_id, $date = null) {
		// 檢查使用者的大頭照目錄有沒有建立，如果沒有就在建立
		$user_upload_avatar_folder = $this->get_avatar_folder($user_id, $date, true);
		return $this->create_folder($user_upload_avatar_folder);
	}

	/**
	*
	* 建立使用者的大頭照目錄
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function create_image_folder($user_id, $date = null) {
		$user_upload_image_folder = $this->get_image_folder($user_id, null, $date, true);
		return $this->create_folder($user_upload_image_folder);
	}

	/**
	*
	* 建立使用者的檔案目錄
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function create_file_folder($user_id, $date = null) {
		$user_upload_file_folder = $this->get_file_folder($user_id, $date, true);
		return $this->create_folder($user_upload_file_folder);
	}

	/**
	*
	* 取得 user 上傳檔案
	*
	* @access	public
	* @param	primary_folder (type) : images or files
	* @return 	return : return description
	*
	*/
	function get_file($file_name, $primary_folder, $user_id, $date = null) {
		$user_upload_folder = $this->get_upload_folder($primary_folder, $user_id, $date);
		return $user_upload_folder . '/' . $file_name;
	}

	/**
	*
	* 取得 user 上傳目錄
	*
	* @access	public
	* @param	primary_folder (type) : images or files
	* @return 	return : return description
	*
	*/
	function get_upload_folder($primary_folder, $user_id, $date = null, $real_path = false) {
		// 取得 user folder
		$user = $this->user_model->get_by_id($user_id);
		$user_folder_name = $user->name;
		$user_folder = $user_folder_name;

		// 取得 date folder
		if(!$date) {
			$date = now_date();
		}
		$date_folder = $this->get_date_folder($date);

		// 組合日期與 user folder 合出最後的路徑
		$folder = $primary_folder .'/' . $user_folder . '/' . $date_folder;
		if($real_path) {
			$folder = real_folder(UPLOAD_FOLDER . '/' . $folder);
		}
		return $folder;
	}                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              

	/**
	*
	* 取得 user 的上傳大頭照目錄
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function get_avatar_folder($user_id = null, $date = null, $real_path = false) {
        return $this->get_upload_folder(AVATAR_FOLDER, $user_id, $date, $real_path);
	}

	/**
	*
	* 取得 user 的上傳照片目錄
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function get_image_folder($user_id = null, $date = null, $real_path = false) {
        return $this->get_upload_folder(IMAGE_FOLDER, $user_id, $date, $real_path);
	}

	/**
	*
	* 取得 user 的上傳檔案目錄
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function get_file_folder($user_id = null, $date = null, $real_path = false) {
        return $this->get_upload_folder(FILE_FOLDER, $user_id, $date, $real_path);
	}

	/**
	*
	* 取得在 file or image 之下的日期目錄路徑
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function get_date_folder($date) {
		$explode_date = explode('-', $date);
		$dates = array();
		$dates[] = $explode_date[0];
		$dates[] = $explode_date[1];
		$date_folder = implode('/', $dates);
		return $date_folder;
	}

	/**
	 *
	 * 有選擇檔案
	 *
	 * @param type file_names 必選的 input name
	 *
	 */
	public function has_select_file($file_names) {
		foreach($file_names as $file_name) {
			if(empty($_FILES[$file_name]['name'])) {
				return false;
			}
		}
		return true;
	}

	/**
	 *
	 * 取得 avatar 的縮圖尺寸
	 *
	 * @param type param
	 *
	 */
	public function get_avatar_sizes() {
		$sizes = array();
		$sizes[] = new Size(THUMB_WIDTH, THUMB_HEIGHT);
		return $sizes;
	}

	/**
	 *
	 * 取得縮圖多添加的字
	 *
	 * @param type param
	 *
	 */
	public function get_thumb_extra_name($width, $height) {
		return '-' . $width . 'x' . $height;
	}

	/**
	 *
	 * 更新大頭照的檔案
	 *
	 * @param type param
	 *
	 */
	public function update_avatar_file($old_user_avatar_file, $new_user_avatar_file) {
		$real_old_user_avatar_file = upload_real_file($old_user_avatar_file);
		$real_new_user_avatar_file = upload_real_file($new_user_avatar_file);
		$sizes = $this->get_avatar_sizes();

		// 刪除舊的檔案
		@unlink($real_old_user_avatar_file);

		// 刪除舊的縮圖
		$this->delete_thumb_file($real_old_user_avatar_file, $sizes);

		// 取得要產生的縮圖尺寸
		$this->create_thumb_file($real_new_user_avatar_file, $sizes);
	}

	/**
	 *
	 * 刪除舊的縮圖
	 *
	 * @param type param
	 *
	 */
	public function delete_thumb_file($orig_img, $sizes) {
		$delete_fail_thumb_files = array();
		foreach($sizes as $size) {
			$extra_info = $this->get_thumb_extra_name($size->get_var('width'), $size->get_var('height'));
			$thumb_img = add_extra_file_name($orig_img, $extra_info);
			if(!@unlink($thumb_img)) {
				$delete_fail_thumb_files[] = $thumb_img;
			}
		}	
		return $delete_fail_thumb_files;
	}

	/**
	 *
	 * 建立上傳後的縮圖檔案
	 *
	 * @param string orig_img 原始圖片的實體路徑
	 *
	 */
	public function create_thumb_file($orig_img, $sizes) {
		if(!file_exists($orig_img)) {
			throw new Exception("縮圖時原始圖檔不存在");
		}

		$thumb_files = array();
		foreach($sizes as $size) {
			$extra_info = $this->get_thumb_extra_name($size->get_var('width'), $size->get_var('height'));
			$thumb_img = add_extra_file_name($orig_img, $extra_info);
			$result = $this->image_service->resize($orig_img, $thumb_img, $size->get_var('width'), $size->get_var('height'));
			if(!$result->has_error()) {
				$thumb_files[] = $thumb_img;
			} 
		}
		return $thumb_files;
	}

	/**
	*
	* 取得 user 的上傳大頭照檔案
	*
	* @access	public
	* @param	file_name (string) : 檔名
	* @return 	return : return description
	*
	*/
	function get_upload_avatar($file_name, $user_id = null, $date = null) {
        return $this->user_upload_service->get_file($file_name, AVATAR_FOLDER, $user_id, $date);
	}

	/**
	*
	* 取得 user 的上傳照片檔案
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function get_upload_image($file_name, $user_id = null, $date = null) {
        return $this->user_upload_service->get_file($file_name, IMAGE_FOLDER, $user_id, $date);
	}

	/**
	*
	* 取得 user 的上傳檔案檔案
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function get_upload_file($file_name, $user_id = null, $date = null) {
        return $this->user_upload_service->get_file($file_name, FILE_FOLDER, $user_id, $date);
	}

}


