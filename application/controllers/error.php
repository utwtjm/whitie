<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ==================================================================
//
// 自訂的 error controller，不存在的網址都會來這
//
// ------------------------------------------------------------------

class Error extends MY_Controller {
	
	function error_404() {
		$this->output->set_status_header('404');
		$this->_display('error');
	}

}
