<? add_tinymce_js(); ?>
<script type="text/javascript">
tinymce.init({
   	mode : "exact",
   	elements : "content1",
   	width : "100%",
   	theme : "advanced",
   	skin : "o2k7",
   	language : "en",
   	theme_advanced_toolbar_location : "top",
   	theme_advanced_toolbar_align : "left",
   	theme_advanced_statusbar_location : "bottom",
   	theme_advanced_resizing : true,
   	theme_advanced_resize_horizontal : false,
   	dialog_type : "modal",
   	formats: {
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
	},
	relative_urls : false,
	remove_script_host : false,
	convert_urls : false,
	remove_linebreaks : true,
	fix_list_elements : true,
	keep_styles : false,
	entities : "38,amp,60,lt,62,gt",
	accessibility_focus : true,
	plugins : "inlinepopups,tabfocus,paste,media,fullscreen",
	media_strict : false,
	paste_remove_styles : true,
	paste_remove_spans : true,
	paste_strip_class_attributes : "all",
	paste_text_use_dialog : true,
	webkit_fake_resize : false,
	schema : "html5",
	apply_source_formatting : false,
	theme_advanced_buttons1 : "bold,italic,strikethrough,bullist,numlist,blockquote,justifyleft,justifycenter,justifyright,link,unlink,spellchecker,fullscreen",
	theme_advanced_buttons2 : "formatselect,underline,justifyfull,forecolor,pastetext,pasteword,removeformat,charmap,outdent,indent,undo,redo",
	theme_advanced_buttons3 : "",
	theme_advanced_buttons4 : "",
	tabfocus_elements : ':prev,:next',
	body_class : "content1",
	theme_advanced_resizing_use_cookie : true
 });
</script>

<!-- Place this in the body of the page content -->
<form method="post" action="<?php echo web_url('/test_editor_service/result'); ?>">
    <textarea id="content1" name="content1"></textarea>
    <input type="submit" value="送出">
</form>