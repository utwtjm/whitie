<?php 

// ==================================================================
//
// 覆寫原本的 ci_controller
//
// ------------------------------------------------------------------

class Test_Controller extends CI_Controller {

	function __construct() {
		parent::__construct();

		// library
		$this->load->library(array('unit_test'));
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
	 * 驗證結果
	 *
	 * @param type param
	 *
	 */
	public function _run($test, $expected = TRUE, $test_name = 'undefined', $notes = '') {
		$this->unit->run($test, $expected, $test_name, $notes);
	}
}

?>
