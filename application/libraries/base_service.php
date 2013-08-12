<?php

// ==================================================================
//
// 所有的 service 都要 extend 這個 base service
//
// ------------------------------------------------------------------

class Base_service {

	var $_ci;

	public function __construct($config = array()) {
		$this->_ci =& get_instance();
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
	
	public function __get($var) {
		return $this->_ci->$var;
	}

}

?>