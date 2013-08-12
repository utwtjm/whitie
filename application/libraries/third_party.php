<?php

// ==================================================================
//
// 示範用的 service
//
// ------------------------------------------------------------------

class Third_party {

	function __construct($class = NULL)
	{

		ini_set('include_path',
		ini_get('include_path') . PATH_SEPARATOR . APPPATH . 'third_party');

		if ($class)
		{
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
		else
		{
			log_message('debug', "Class Initialized");
		}
	}

	function load($class)
	{
		require_once (string) $class . EXT;
		log_message('debug', "Class $class Loaded");
	}

}

?>