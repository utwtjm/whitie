<?php

// ==================================================================
//
// tinymce 用的 service
//
// ------------------------------------------------------------------


class Editor_service extends Base_service {

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

	/**
	 *
	 * 顯示 editor
	 *
	 * @param type param
	 *
	 */
	public function show() {
	}

}

?>