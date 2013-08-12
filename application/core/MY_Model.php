<?php 

class MY_Model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	/**
	 *
	 * 新增資料
	 *
	 * @param type param
	 *
	 */
	public function _create($object) {
		$vars = $object->get_vars();
		foreach($vars as $key => $value) {
			$object->$key = $value;
		}
		$object->save();
		return $object->id;
	}

	/**
	*
	* 依 orm 抓出的資料，取得全部的資料
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function _get_result($object) {
		if(!$object->exists()) {
			return array();
		}

		$row_objects = array();
		foreach ($object as $row_data) {
			foreach($row_data->fields as $field_name) {
				$object->set_var($field_name, $row_data->$field_name);
			}
			$row_objects[] = $object->get_clone();
		}
		return $row_objects;
	}

	/**
	*
	* 依 orm 抓出的資料，取得第一筆資料
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	function _get_row($object) {
		if(!$object->exists()) {
			return false;
		}

		foreach ($object as $data) {
			$row_data = $data;
			break;
		}
		foreach($row_data->fields as $field_name) {
			$object->set_var($field_name, $row_data->$field_name);
		}
		return $object->get_clone();
	}

}
?>
