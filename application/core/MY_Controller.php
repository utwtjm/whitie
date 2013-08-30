<?php 

// ==================================================================
//
// 覆寫原本的 ci_controller
//
// ------------------------------------------------------------------


class MY_Controller extends CI_Controller {

	private $breadcrumbs = array();

	function __construct() {
		parent::__construct();
	}

	/**
	*
	* 顯示 view
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function _display($layout = '') {
		// 設定麵包屑
		$this->_set_view_data('breadcrumbs', $this->breadcrumbs);

		// 取得預設要讀取的頁面
		if($layout === '') {
			$layout = $this->config->item('OCU_default_layout');
		}
		$this->template->render($layout);
	}

	/**
	*
	* 測試顯示的 view
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function _test_display($layout = '') {
		// 取得預設要讀取的頁面
		if($layout === '') {
			$layout = $this->config->item('OCU_test_layout');
		}
		$this->_display($layout);
	}


	/**
	*
	* 設定 view 的名字
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function _set_view_name($name) {
		$this->template->current_view = $name;
	}

	/**
	*
	* 設定 view 的資料
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function _set_view_data($name, $value) {
		$this->template->set($name, $value);
	}

	/**
	*
	* 設定 page title
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function _set_page_title($value, $include_web_title = true) {
		$this->template->set('page_title', $value);
	}


	/**
	*
	* 設定提示訊息
	*
	* @access	public
	* @param	type (type) : error、sucess、info
	* @return 	return : return description
	*
	*/
	private function _set_message($message, $type) {
		$this->template->set_message($message, $type);
	}

	/**
	*
	* 設定錯誤訊息
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function _set_error_message($message) {
		$this->_set_message($message, 'error');
	}

	/**
	*
	* 設定 info 訊息
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function _set_info_message($message) {
		$this->_set_message($message, 'error');
	}

	/**
	*
	* 設定成功訊息
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function _set_success_message($message) {
		$this->_set_message($message, 'success');
	}

	/**
	*
	* 設定麵包屑
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function _add_breadcrumb($title, $url) {
		$this->breadcrumbs[] = array('title'=>$title, 'url'=>$url);
	}

	/**
	*
	* 取得 get or post value
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function _get_post($index = '', $xss_clean = false, $strip_slashes = true) {
		$value = $this->input->get_post($index, $xss_clean);

		// 如果 magic_quotes_gpc on 就去掉反斜線
		if($strip_slashes) {
			$value = strip_slashes_gpc($value);
		}
		return $value;
	}

	/**
	*
	* 設定 body 的 class
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function _set_body_class($class) {
		$this->_set_view_data('body_class', $class);
	}

	/**
	*
	* 設定登入的 body class
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function _set_login_body() {
		$this->_set_body_class('login');
	}

}


class Admin_Controller extends MY_Controller {

	function __construct() {
		parent::__construct();
	}

	/**
	*
	* 後台顯示的 view
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function _display($layout = '') {
		// 取得預設要讀取的頁面
		if($layout === '') {
			$layout = $this->config->item('OCU_admin_layout');
		}
		parent::_display($layout);
	}

}

class Test_Controller extends CI_Controller {

	function __construct() {
		parent::__construct();

		// library
		$this->load->library(array('unit_test'));

		// init
		$template = $this->template->layout_block('unit_test');
		$this->unit->set_template($template); 
	}

	/**
	 *
	 * 顯示測試的結果
	 *
	 * @param type param
	 *
	 */
	public function _display() {
		echo $this->unit->report();
	}

	/**
	 *
	 * 預測是 true
	 *
	 * @param type param
	 *
	 */
	public function _assert_true($value, $notes = '') {
		return $this->_run($value, true, $notes);
	}

	/**
	 *
	 * 預測是失敗
	 *
	 * @param type param
	 *
	 */
	public function _assert_false($value, $notes = '') {
		return $this->_run($value, false, $notes);
	}

	/**
	 *
	 * 預測是相同
	 *
	 * @param type param
	 *
	 */
	public function _assert_equal($value, $expected, $notes = '') {
		return $this->_run($value, $expected, $notes);
	}

	
    /**
     *
     * 驗證結果，原本想要把 clear_result 放在這裡呼叫，但會變的跟原本不一樣，變的讓人呼叫是需要考慮，所以還是放在外面
     *
     * @param mixed $test 測試的結果
     * @param mixed $expected 預期的結果
     * @param mixed $clear_results 是否要記錄每一個結果
     *
     */
    public function run($test, $expected = true, $test_name = 'undefined', $notes = '') {
        if(!is_string($notes)) {
            $notes = json_encode($notes);
        }
        $result = parent::run($test, $expected, $test_name, $notes);
        return $result;
    }


	/**
	 *
	 * 測試
	 *
	 * @param type param
	 *
	 */
	public function _run($value, $expected, $notes = '') {
		$backtrace = debug_backtrace();
		$test_name = $backtrace[2]['function'];
		return $this->unit->run($value, $expected, $test_name, $notes);
	}

	/**
	 *
	 * 顯示全部的 test
	 *
	 * @param type param
	 *
	 */
	public function index() {
		$test_methods = $this->_get_test_methods();
		foreach($test_methods as $index => $test_method) {
			$this->$test_method();
		}
		$this->_show_result();
		$this->_display();
	}

	/**
	 *
	 * 顯示測試結果
	 *
	 * @param type param
	 *
	 */
	public function _show_result() {
		$pass_count = $this->unit->count_results();
		$pass_count = $this->unit->get_pass_count();
		$fail_count = $this->unit->get_fail_count();
		$result_str = "<span style='color:green'>{$pass_count} passes</span>";
		$result_str .= "  ";
		$result_str .= "<span style='color:red'>{$fail_count} fails</span>";
		echo $result_str;
	}

	/**
	 * 取得所有 test method
	 *
	 * @return array
	 */
	private function _get_test_methods() {
		$test_methods = array();
		$methods = get_class_methods($this);
		foreach ($methods as $method) {
			if (substr(strtolower($method), 0, 5) == 'test_') {
				$test_methods[] = $method;
			}
		}
		return $test_methods;
	}
}

?>
