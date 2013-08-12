<?php

/**
*
* 基本的 filter
*
* @access	public
* @param	param (type) : param description
* @return 	return : return description
*
*/

class Base_filter extends Filter {

	var $_ci;

	function __construct($config = array()) {
		parent::__construct($config);

		// init
		$this->_ci =& get_instance();
	}
	
	public function __get($var) {
		return $this->_ci->$var;
	}

	function before() {}

	function after() {}
}
?>