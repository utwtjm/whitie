<?php

// ==================================================================
//
// tinymce 用的 service，tinymce 直接在 service  實例化，這樣整個系統只有一個實例
// ，因為他是列印出 editor 所以應該只需要一個
// ，如果 tinymce 有什麼問題，可以參考 tinymce.txt 看看 wordpress 怎麼設定的
//
// ------------------------------------------------------------------

class Editor_service extends Base_service {

	var $editor;

	public function __construct($config = array()) {
		parent::__construct();

		// init
		$this->editor = null;

		// config
		$this->config->load('tiny_mce', true);
	}

	/**
	 *
	 * 要 render 哪種模式，有 exact or textareas 或其他..
	 *
	 * @param type param
	 *, 
	 */
	public function render($selector, $config = array()) {	
		$default_config = tiny_mce_config_get();
		$default_config = array_merge($default_config, $config);
		$mode = $default_config['mode'];
		if($mode == 'exact') {
			$default_config['elements'] = $selector;
		} else {
			$default_config['editor_selector'] = $selector;
		}
		if(is_null($this->editor)) {
			$this->editor = new Tiny_mce($default_config);
		} else {
			$this->editor->set_config($default_config);
		}
		return $this->editor->render();
	}

	/**
	 *
	 * 多個　editor
	 *
	 * @param type param
	 *
	 */
	public function multi_render($name, $config=array()) {
		$config['mode'] = "textareas";
		return $this->render($name, $config);
	}

}

Class Tiny_mce extends Base_service{

	var $config;

	function __construct($config = array()) {
		parent::__construct();

		// init
		$this->initialize($config);
    }

    public function initialize($config = array()) {
		foreach ($config as $key => $val) {
			$this->config[$key] = $val;
		}
	}

	/**
	 *
	 * 設定 config
	 *
	 * @param type param
	 *
	 */
	public function set_config($config) {
		$this->config = $config;
	}

	/**
	 *
	 * 顯示 editor
	 *
	 * @param type param
	 *
	 */
	public function render() {
		$js_config = $this->get_js_config();
		$js_data = array('js_config'=>$js_config);
		$content = $this->template->block('tiny_mce_init', 'tiny_mce/init', $js_data);
		$textarea_data = array('name'=>$this->config['editor_selector'], 'id'=>$this->config['editor_selector'], 'class'=>$this->config['editor_selector']);
		$content .= $this->template->block('tiny_mce_textarea', 'tiny_mce/textarea', $textarea_data);
		return $content;
	}

	/**
	 *
	 * 取得 js config 的 string
	 *
	 * @param type param
	 *
	 */
	public function get_js_config() {
		$ret = '';
		if(empty($this->config)) {
			return $ret;
		}

		$ret = '{';
		$index = 0;
        foreach ($this->config as $key => $val) {
            $ret .= $key . ":";
            if($val === true) {
                $ret .= "true";
            } else if($val === false) {
                $ret .= "false";
            } else if($key == 'formats') {
                $ret .= "$val";
            } else {
                $ret .= "'{$val}'";
            }
            $is_last = count($this->config) - 1 == $index;
            if(!$is_last) {
            	$ret .= ",";
	            $ret .= "\n";
            }
            $index++;
        }
		$ret .= '}';
		return $ret;
	}

}


?>