<?php

// ==================================================================
//
// 載入 library
//
// ------------------------------------------------------------------

/**
 *
 * 載入 application 下的某個 library
 *
 * @param type param
 *
 */
function application_load($folder, $class) {
	ini_set('include_path',
	ini_get('include_path') . PATH_SEPARATOR . APPPATH . $folder);
	if(is_array($class)) {
		foreach($class as $_class)
		{
			require_once (string) $_class . EXT;
			log_message('debug', "Class $_class Loaded");
		}
	} else {
		require_once (string) $class . EXT;
		log_message('debug', "Class $class Loaded");
	}
}

/**
 *
 * 載入 third_party 下的 library
 *
 * @param type param
 *
 */
function third_party_load($class) {
	application_load('third_party', $class);
}

?>
