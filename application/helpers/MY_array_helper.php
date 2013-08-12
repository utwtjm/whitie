<?php

// ==================================================================
//
// array helper override
//
// ------------------------------------------------------------------

/**
*
* 取得 objects 裡的 key value
*
* @access	public
* @param	user_enrollments (array) : user_enrollment objects
*
*/
function objects_key_values($objects, $key) {
	if(!$objects) {
		return array();
	}

	$values = array();
	foreach ($objects as $object_index => $object) {
		if(isset($object->$key)) {
			$values[] = $object->$key;
		}
	}
	return $values;
}

?>
