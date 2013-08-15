<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ==================================================================
//
// 測試 tinymce 用的 service
//
// ------------------------------------------------------------------

class Test_editor_service extends MY_Controller {

	function __construct() {
		parent::__construct();

		// library
		$this->load->library(array('editor_service'));
	}

	function show() {
		$this->_display();
	}

}



