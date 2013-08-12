<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=lang('global_langcode')?>" lang="<?=lang('global_langcode')?>">
<head>

    <!-- Title and meta -->

    <? add_http_equiv(array('content-language' => lang_get('global_langcode'))); ?>
    <? add_http_equiv(array('content-type' => 'text/html;charset='.lang_get('global_charset'))); ?>

    <title>
    	<?php
    		// 以單一頁的 title 為主，如果沒設定則以整個網站 title 為主
       		if(isset($page_title)) {
    			$page_title = lang_get('global_sitename') . ' - ' . $page_title;
    		} else {
    			$page_title = lang_get('global_sitename');
    		}
    	?>
    	<?=$page_title?>
    </title>

    <!-- meta -->
    <? add_name(array('robots' => lang_get('global_robots')) );  ?>
    <? add_name(array('keywords' => lang_get('global_keywords')) );  ?>
    <? add_name(array('description' => lang_get('global_description')) );  ?>
    <? add_name(array('rating' => lang_get('global_rating')) );  ?>
    <? add_name(array('author' => lang_get('global_author')) );  ?>
    <? add_name(array('copyright' => lang_get('global_copyright')) );  ?>
    <? add_name(array('generator' => lang_get('global_generator')) );  ?>

    <!-- favicon -->
    <? add_icon(array('rel' => 'shortcut icon', 'type' => 'image/ico', 'href' => 'icons/favicon.ico') );  ?>
    <? add_icon(array('rel' => 'icon', 'type' => 'image/png', 'href' => 'icons/favicon.png') );  ?>

    <!-- js -->
    <? add_script('theme'); ?>
    <? add_script('jquery/jquery'); ?>
    <? add_script('bootstrap/bootstrap.min'); ?>

    <!-- css -->
    <? add_css('theme'); ?>
    <? add_css('bootstrap/bootstrap.min'); ?>
    <? add_css('bootstrap/bootstrap-response.min'); ?>
    <? add_css('theme_bootstrap'); ?>

</head>

<body>


    <div class="container">

            <?php echo $this->template->header(); ?>

            <?php echo $this->template->breadcrumb(); ?>

        	<?php echo $this->template->message(); ?>

            <?php echo $this->template->yield(); ?>

            <?php //echo $this->template->footer(); ?>

    </div>

</body>
</html>
