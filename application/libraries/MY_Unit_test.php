<?php

// ==================================================================
//
// 覆寫 CI_session_validation
//
// ------------------------------------------------------------------

class MY_Unit_test extends CI_Unit_test {

    var $pass_count = 0;
    var $fail_count = 0;
    var $reposts = array();

	public function __construct() {
        parent::__construct();
    }

    /**
     *
     * 取得 pass_count
     *
     * @param type param
     *
     */
    public function get_pass_count() {
        return $this->pass_count;
    }

    /**
     *
     * 取得 fail_count
     *
     * @param type param
     *
     */
    public function get_fail_count() {
        return $this->fail_count;
    }

    /**
     *
     * 清掉 run 完後的結果
     *
     * @param type param
     *
     */
    public function clear_results() {
    	$this->results = array();
    }

    /**
     *
     * 驗證結果，原本想要把這個在 test_controller 裡，但如果別人要用的話就沒辦法用了，所以還是放在吧
     *
     * @param mixed $test 測試的結果
     * @param mixed $expected 預期的結果
     * @param mixed $clear_results 是否要記錄每一個結果
     *
     */
    public function run($test, $expected = true, $test_name = 'undefined', $notes = '') {
        if(!is_string($notes)) {
            $notes = json_encode($notes);
        }
        $result = parent::run($test, $expected, $test_name, $notes);
        return $result;
    }

    /**
     *
     * 記錄成功與失敗的數量
     *
     * @param type param
     *
     */
    public function count_results() {
        $CI =& get_instance();
        $CI->load->language('unit_test');
        $result = $this->result();
        foreach ($result as $res) {
            foreach($res as $key => $val) {
                if($key == $CI->lang->line('ut_result')) {
                    if($val == $CI->lang->line('ut_passed')) {
                        $this->pass_count++;
                    } else {
                        $this->fail_count++;
                    }
                }
            }
        }
    }

}