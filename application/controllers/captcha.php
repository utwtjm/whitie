<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Captcha extends MY_Controller {

	function __construct() {
		parent::__construct();

		// library
		$this->load->library('captcha_service');
	}

	/**
	*
	* 顯示驗證碼
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	public function show() {
		$this->captcha_service->show();
	}
}
