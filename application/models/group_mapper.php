<?php

class Group_Mapper extends Base_Mapper {

	// related table
    var $has_many = array(
    		'user' => array(						
	            'class' => 'user_mapper',			
	            'other_field' => 'group',			
	            'join_self_as' => 'group',			
	            'join_other_as' => 'user',			
	            'join_table' => 'users_groups'
	        )		
    	);

	// table session_name()
	var $table = "groups";
	
	// const
	const TYPE_ADMIN = 'admin';		// 管理員
	const TYPE_USER = 'user';		// 註冊會員
	const TYPE_GUESS = 'guess';		// 訪客

	function __construct($id = NULL) {
        parent::__construct($id);
    }


}