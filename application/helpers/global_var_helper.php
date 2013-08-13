<?php

// ==================================================================
//
// 全域變數的 helper
//
// ------------------------------------------------------------------

/**
 *
 * 取得 $_SERVER 跟 $_ENV 的數值，這兩類都屬於環境變數
 *
 * @param type param
 *
 */
function get_env($key = null) {
	$ret = '';
    if (array_key_exists($key, $_SERVER) && isset($_SERVER[$key])) {
        $ret = $_SERVER[$key];
        return $ret;
    }
    if (array_key_exists($key, $_ENV) && isset($_ENV[$key])) {
        $ret = $_ENV[$key];
        return $ret;
    }
    return $ret;
}

