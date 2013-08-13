<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ==================================================================
//
// 後台管理
//
// ------------------------------------------------------------------

class Admin_home extends Admin_Controller {

	function __construct() {
		parent::__construct();
	}

	/**
	*
	* 後台首頁
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function index() {
		$this->_display();
	}

}



