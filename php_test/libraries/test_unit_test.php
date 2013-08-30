<?php

class Test_unit_test extends CodeIgniterUnitTestCase {

	public function __construct() {
		parent::__construct();

		$this->load->library('unit_test');
	}

	public function setUp() {}

	/**
	 *
	 * 沒有執行過任何測試
	 *
	 * @param type param
	 *
	 */
	public function test_count_result_and_not_excute_any_test() {
		$this->assertTrue($this->unit->get_pass_count() == 0 && $this->unit->get_pass_count() == 0);
	}

	/**
	 *
	 * 一個錯誤一個成功
	 *
	 * @param type param
	 *
	 */
	public function test_count_result_and_one_pass_and_one_error() {
		$this->unit->run(true, true);
		$this->unit->run(true, true);
		$this->unit->run(true, false);
		$this->unit->run(true, false);
		show_result($this->unit->get_pass_count());
		$this->assertTrue($this->unit->get_pass_count() == 2 && $this->unit->get_fail_count() == 2);
	}

}

?>