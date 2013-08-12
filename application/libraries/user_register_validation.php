<?php 

// ==================================================================
//
// 新增 validation custom functions
//
// ------------------------------------------------------------------

class User_register_validation extends MY_Form_validation {

    public function __construct() {
        parent::__construct();

        // library
        $this->load->library('user_register_service');
    }

    // ==================================================================
    //
    // form_validation functions
    //
    // ------------------------------------------------------------------
    
    /**
    *
    * 這個 user_name 是否合法
    *
    * @access   public
    * @param    param (type) : param description
    * @return   return : return description
    *
    */
    public function vaild_user_name($user_name) {
        $user_name = $this->user_register_service->sanitize_user_name($user_name);
        return !empty($user_name);
    }

    /**
    *
    * 這個 user_email 是否已經註冊過
    *
    * @access   public
    * @param    param (type) : param description
    * @return   return : return description
    *
    */
    public function exist_user_email($user_email) {
        $is_exist = $this->user_register_service->exist_user_email($user_email);
        return !$is_exist;
    }

    /**
    *
    * 這個 user_name 是否已經註冊過
    *
    * @access   public
    * @param    param (type) : param description
    * @return   return : return description
    *
    */
    public function exist_user_name($user_name) {
        $is_exist = $this->user_register_service->exist_user_name($user_name);
        return !$is_exist;
    }

     /**
    *
    * 這個 email 是否合法
    *
    * @access   public
    * @param    param (type) : param description
    * @return   return : return description
    *
    */
    public function vaild_email($user_email) {
        return is_email($user_email);
    }


    /**
    *
    * 驗證碼是否合法
    *
    * @access    public
    * @param    param (type) : param description
    * @return     return : return description
    *
    */
    public function vaild_captcha($captcha_code) {
        return $this->captcha_service->is_vaild($captcha_code);
    }

}