<?php

// ==================================================================
//
// test group model
//
// ------------------------------------------------------------------


class Test_group_model extends CodeIgniterUnitTestCase {

	var $user_id;

	public function __construct() {
		parent::__construct();

		// model
		$this->load->model(array('group_model'));
	}

	public function setUp() {}

    public function tearDown() {}

    /**
    *
    * 測試取得 user 的 group
    *
    * @access	public
    * @param	param (type) : param description
    * @return 	return : return description
    *
    */
    function test_get_by_user_id() {
    	$groups = $this->group_model->get_by_user_id(1);
    	show_result($groups);
        $this->assertTrue($groups[0]->get_var('id') == 1);
    }

    /**
    *
    * 用 type 取得 group
    *
    * @access   public
    * @param    param (type) : param description
    * @return   return : return description
    *
    */
    function test_get_by_type() {
        $group = $this->group_model->get_by_type(group_model::TYPE_ADMIN);
        show_result($group);
        $this->assertTrue($group->get_var('id') == 1);
    }
}


?>