<?php

class Test_demo_service extends CodeIgniterUnitTestCase {

	public function __construct() {
		parent::__construct();

		$this->load->library('demo_service');
	}

	public function setUp() {}

    public function tearDown() {}

	public function test_hello() {
		$this->demo_service->hello();
		$this->assertTrue('123');
	}

}

?>