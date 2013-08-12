<?php

class User_Mapper extends Base_Mapper {

	// related table
    var $has_many = array(
    		'group' => array(				
	            'class' => 'group_mapper',			
	            'other_field' => 'user',		// 在 group_mapper 裡面，要取用 user_mapper 時所要用的 key 值
	            'join_self_as' => 'user',		// 在 related table 裡，user_mapper 關連的欄位名稱是 user_id
	            'join_other_as' => 'group',		// 在 related table 裡，group_mapper 關連的欄位名稱是 group_id
	            'join_table' => 'users_groups'	// related table name
	        )
    	);

	// table name
	var $table = "users";

	function __construct($id = NULL) {
        parent::__construct($id);
    }


}