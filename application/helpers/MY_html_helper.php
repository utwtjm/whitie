<?php

// ==================================================================
//
// 跟 html tag 相關的都放在這
//
// ------------------------------------------------------------------

/**
*
* 新增一個 script tag
*
* @access    public
* @param    param (type) : param description
* @return     return : return description
*
*/
function add_script($name, $return = false) {
    $name = add_js_ext($name);
    $src = public_js_url($name);
    $attrs = array('src'=> $src, 'type' => "text/javascript");
    return add_meta('script', $attrs, $return);
}

/**
*
* 新增一個 css tag
*
* @access    public
* @param    param (type) : param description
* @return     return : return description
*
*/
function add_css($name, $return = false) {
    $name = add_css_ext($name);
    $src = public_css_url($name);
    $attrs = array('href'=> $src, 'type' => "text/css", 'media' => 'all');
    return add_meta('css', $attrs, $return);
}

/**
*
* 新增 meta tag
*
* @access    public
* @param    param (type) : param description
* @return     return : return description
*
*/
function add_meta($type = '', $attrs = array(), $return = false) {
	$str = '';
    switch ($type) {
        case 'script':
            $str .= "<script" . render_attributes($attrs) . ">";
            if (isset($attr['_']) && @$attrs['_']) {
                $str .= "\n//<![CDATA[\n" . $attrs['_'] . "\n//]]>";
            }
            $str .= "</script>\n";
            break;
        case 'link':
            $rel = $attrs['rel'];
            unset($attrs['rel']);
            $str .= '<link rel="' . $rel . '"' . render_attributes($attrs) . " />\n";
            break;
        case 'css':
            if (isset($attr['_']) && @$attrs['_']) {
                $str .= '<style' . render_attributes($attrs) . ">\n/* <![CDATA[ */\n" . $attrs['_'] . "\n/* //]]> */\n</style>";
            } else {
                $str .= '<link rel="stylesheet" ' . render_attributes($attrs) . " />\n";
            }
            break;
        case 'http-equiv':
            foreach ($attrs as $name => $content) {
                $str .= '<meta http-equiv="' . htmlspecialchars($name, ENT_QUOTES) . '" content="' . htmlspecialchars($content, ENT_QUOTES) . "\" />\n";
            }
            break;
        case 'name':
            foreach ($attrs as $name => $content) {
                $str .= '<meta name="' . htmlspecialchars($name, ENT_QUOTES) . '" content="' . htmlspecialchars($content, ENT_QUOTES) . "\" />\n";
            }
            break;
        case 'charset':
            foreach ($attrs as $name) {
                $str .= '<meta charset="' . htmlspecialchars($name, ENT_QUOTES) . "\" />\n";
            }
            break;
        default:
            die('no support in '.__FUNCTION__);
            break;
    }
    
    if ($return) {
        return $str;
    }
    echo $str;
    return true;
}



/**
*
* 新增一個 name tag
*
* @access    public
* @param    param (type) : param description
* @return     return : return description
*
*/
function add_name($attrs = array(), $return = false) {
    return add_meta('name', $attrs, $return);
}

/**
*
* 新增一個 charset tag
*
* @access    public
* @param    param (type) : param description
* @return     return : return description
*
*/
function add_charset($attrs = array(), $return = false) {
    return add_meta('charset', $attrs, $return);
}

/**
*
* 新增一個 http equiv tag
*
* @access    public
* @param    param (type) : param description
* @return     return : return description
*
*/
function add_http_equiv($attrs = array(), $return = false) {
    return add_meta('http-equiv', $attrs, $return);
}


/**
*
* 新增一個 link tag
*
* @access    public
* @param    param (type) : param description
* @return     return : return description
*
*/
function add_link($attrs = array(), $return = false) {
    return add_meta('link', $attrs, $return);
}

/**
*
* 新增一個 icon tag
*
* @access    public
* @param    param (type) : param description
* @return     return : return description
*
*/
function add_icon($attrs = array(), $return = false) {
    $attrs['href'] = public_image_url($attrs['href']);
    return add_meta('link', $attrs, $return);
}


/**
*
* 建立 html tag
*
* @access    public
* @param    param (type) : param description
* @return     return : return description
*
*/
function render_attributes($coll) {
    $str = '';
    foreach ($coll as $name => $val) {
        if ($name != '_') {
            $str .= ' ' . $name . '="' . htmlspecialchars($val, ENT_QUOTES) . '"';
        }
    }
    return $str;
}

/**
 *
 * 新增 tinymce
 *
 * @param type param
 *
 */
function add_tinymce($return = false) {
    return add_script('tinymce/js/tinymce/tinymce.min', $return);
}

