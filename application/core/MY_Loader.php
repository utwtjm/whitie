<?php 

class MY_Loader extends CI_Loader {

	function __construct() {
		parent::__construct();
	}

	/**
	*
	* 設定 model
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function set_model($old_model, $new_model) {
		$ci =& get_instance();
		$fake_model = $new_model;
		foreach($this->_ci_models as $index => $_ci_model) {
			if($_ci_model == $old_model) {
				// 載入 fake model
				if(strpos($new_model, 'fake') !== false) {
					$fake_model_file_path = TESTS_DIR . 'models/' . $fake_model.'.php';
					require_once($fake_model_file_path);
				}

				// 將原本的 model 跟換成 fake model
				unset($ci->$old_model);
				$fake_model = ucfirst($fake_model);
				$ci->$old_model = new $fake_model();
				break;
			}
		}
	}


	/**
	*
	* 將 model 設定為原本的 model
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function set_normal_model($model) {
		$this->set_model($model, $model);
	}

	/**
	*
	* 將 model 設定為測試用的 model
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function set_test_model($model) {
		$this->set_model($model, 'fake_'.$model);
	}

}

?>