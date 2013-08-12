<?php

// ==================================================================
//
// test user model
//
// ------------------------------------------------------------------


class Test_user_model extends CodeIgniterUnitTestCase {

	var $user_id;

	public function __construct() {
		parent::__construct();

		// model
		$this->load->model(array('user_model'));
	}

	public function setUp() {}

    public function tearDown() {}

    /**
     *
     * 更新 user 的　avatar
     *
     * @param type param
     *
     */
    public function test_update_and_avatar() {
    	$this->db->trans_start();
        $user = new User_Mapper();
        $user->set_var('id', 1);
        $user->set_var('avatar', 'avatar5');
    	$this->user_model->update($user);
    	$user = $this->user_model->get_by_id(1);
    	$this->assertTrue($user->get_var('avatar') == 'avatar5');
		$this->db->trans_rollback();
    }

    /**
     *
     * 依 id 取得 user
     *
     * @param type param
     *
     */
    public function test_get_by_id() {
        $user = $this->user_model->get_by_id(1);
        $this->assertTrue($user->get_var('id') == 1);
    }

    /**
     *
     * 取得所有 user
     *
     * @param type param
     *
     */
    public function test_get_all() {
        $users = $this->user_model->get_all();
        $this->assertTrue($users[0]->get_var('id') == 1);
    }

}


?>