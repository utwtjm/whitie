<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ==================================================================
//
// 測試上傳
//
// ------------------------------------------------------------------

class Test_user_upload_service extends MY_Controller {

	function __construct() {
		parent::__construct();

		// library
		$this->load->library(array('user_upload_service'));
	}

	/**
	*
	* 上傳首頁
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function index() {
		$this->_test_display();
	}

	/**
	*
	* 上傳
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function do_image_upload() {
		$error = $this->user_upload_service->do_image_upload(1);
	}


}



