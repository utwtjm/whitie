<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ==================================================================
//
// 測試 tinymce 用的 service
//
// ------------------------------------------------------------------

class Test_editor_service extends MY_Controller {

	function __construct() {
		parent::__construct();

		// library
		$this->load->library(array('editor_service'));
	}

	/**
	*
	* 顯示 editor
	*
	*/
	function render() {
		$config = array(
			"mode" 	=> "exact",
		   	"elements" => "content1",
		   	"width" => "100%",
		   	"theme" => "advanced",
		   	"skin" => "default",
		   	"language" => "zh",
		   	"theme_advanced_toolbar_location" => "top",
		   	"theme_advanced_toolbar_align" => "left",
		   	"theme_advanced_statusbar_location" => "bottom",
		   	"theme_advanced_resizing" => true,
		   	"theme_advanced_resize_horizontal" => false,
		   	"dialog_type" => "modal",
		   	"formats" => "{
		        alignleft : [
					{selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles : {textAlign : 'left'}},
					{selector : 'img,table', classes : 'alignleft'}
				],
				aligncenter : [
					{selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles : {textAlign : 'center'}},
					{selector : 'img,table', classes : 'aligncenter'}
				],
				alignright : [
					{selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles : {textAlign : 'right'}},
					{selector : 'img,table', classes : 'alignright'}
				]
			}",
			"relative_urls" => false,
			"remove_script_host" => false,
			"convert_urls" => false,
			"remove_linebreaks" => true,
			"fix_list_elements" => true,
			"keep_styles" => false,
			"entities" => "38,amp,60,lt,62,gt",
			"accessibility_focus" => true,
			"plugins" => "inlinepopups,tabfocus,paste,media,fullscreen,advlink",
			"media_strict" => false,
			"paste_remove_styles" => true,
			"paste_remove_spans" => true,
			"paste_strip_class_attributes" => "all",
			"paste_text_use_dialog" => true,
			"webkit_fake_resize" => false,
			"schema" => "html5",
			"apply_source_formatting" => false,
			"theme_advanced_buttons1" => "bold,italic,strikethrough,bullist,numlist,blockquote,justifyleft,justifycenter,justifyright,spellchecker,fullscreen",
			"theme_advanced_buttons2" => "formatselect,underline,justifyfull,forecolor,pastetext,pasteword,removeformat,charmap,outdent,indent,undo,redo",
			"theme_advanced_buttons3" => "image,link,unlink,code",
			"theme_advanced_buttons4" => "",
			"tabfocus_elements" => ':prev,:next',
			"body_class" => "content1",
			"theme_advanced_resizing_use_cookie" => true
		);
		$editor = $this->editor_service->render();
		$this->_set_view_data('editor', $editor);
		$this->_display();
	}

	/**
	 *
	 * 顯示結果
	 *
	 * @param type param
	 *
	 */
	public function result() {
		echo $this->_get_post('content1');
	}
	
}



