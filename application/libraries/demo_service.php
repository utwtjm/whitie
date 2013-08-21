<?php

// ==================================================================
//
// 示範用的 servicea
//
// ------------------------------------------------------------------


class Demo_service extends Base_service {

	public function __construct($config = array()) {
		parent::__construct();

		if (count($config) > 0) {
			$this->initialize($config);
		}
	}

	public function initialize($config = array()) {
		foreach ($config as $key => $val) {
			if (isset($this->$key)) {
				$this->$key = $val;
			}
		}
	}

	public function hello() {
		$this->load->model('demo_model');
		$this->demo_model->get_by_id();
	}

}

?>