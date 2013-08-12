<?php

// ==================================================================
//
// 這裡會自動載入，應該是 datamapper 載入的，datamapper 會去找 model 之下的 class 自動載入
//
// ------------------------------------------------------------------

class Base_Mapper extends DataMapper {

	function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}

