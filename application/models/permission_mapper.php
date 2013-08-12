<?php

class Permission_Mapper extends Base_Mapper {

	// related table
    var $has_many = array(
    		'group' => array(				
	            'class' => 'group_mapper',			
	            'other_field' => 'permission',			// 在 group 裡面，要取用 permission_mapper 時所要用的 key 值
	            'join_self_as' => 'permission',			// 在 related table 裡，permission_mapper 關連的欄位名稱是 user_id
	            'join_other_as' => 'group',				// 在 related table 裡，group 關連的欄位名稱是 group_id
	            'join_table' => 'groups_permissions'	// related table name
	        )
    	);

	// table name
	var $table = "permissions";

	function __construct($id = NULL) {
        parent::__construct($id);
    }


}