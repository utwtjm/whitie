<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	/**
	*
	* 首頁
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	public function index() {
		echo 'b';
		$this->_display();
	}

	public function test() {
		$this->_display('empty');
	}

}
