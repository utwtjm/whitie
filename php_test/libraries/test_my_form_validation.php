<?php

class test_my_form_validation extends CodeIgniterUnitTestCase {

	public function __construct() {
		parent::__construct();

		// library
		$this->load->library(array('form_validation'));
	}

	public function setUp() {}

    public function tearDown() {}

    /**
     *
     * 移除掉不需要驗證的 rule
     *
     * @param type param
     *
     */
    public function test_drop_field_data_and_has_no_need_rule() {
    	$post_data = array('new_pass'=>'');
    	$this->form_validation->set_rules('captcha_code', '驗證碼', 'required|vaild_captcha');
		$this->form_validation->set_message('required', lang_get('register_required_captcha'));
		$this->form_validation->drop_field_data($post_data);
		$field_data = $this->form_validation->get_field_data($post_data);
		$this->assertTrue(is_array($field_data) && empty($field_data));
    }

    /**
     *
     * 移除掉不需要驗證的 rule
     *
     * @param type param
     *
     */
    public function test_drop_field_data_and_has_need_rule() {
    	$post_data = array('captcha_code'=>'');
    	$this->form_validation->set_rules('captcha_code', '驗證碼', 'required|vaild_captcha');
		$this->form_validation->set_message('required', lang_get('register_required_captcha'));
		$this->form_validation->drop_field_data($post_data);
		$field_data = $this->form_validation->get_field_data($post_data);
		$this->assertTrue(is_array($field_data) && isset($field_data['captcha_code']));
    }
}

?>