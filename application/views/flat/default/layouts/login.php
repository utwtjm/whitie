<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" > <!--<![endif]-->
<head>
    
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

    <? add_charset(array('utf-8'));  ?>
    <? add_name(array('description' => lang_get('global_description')) );  ?>
    <? add_name(array('author' => lang_get('global_author')) );  ?>
    <? add_name(array('robots' => lang_get('global_robots')) );  ?>
    <? add_name(array('viewport' => lang_get('global_viewport')) );  ?>
   
    <!-- Icons -->
    <? add_icon(array('rel' => 'shortcut icon', 'type' => 'image/ico', 'href' => 'favicon.ico') );  ?>
    <? add_icon(array('rel' => 'apple-touch-icon', 'href' => 'apple-touch-icon.png') );  ?>
    <? add_icon(array('rel' => 'apple-touch-icon', 'sizes' => "57x57", 'href' => 'apple-touch-icon-57x57-precomposed.png') );  ?>
    <? add_icon(array('rel' => 'apple-touch-icon', 'sizes' => "72x72", 'href' => 'apple-touch-icon-72x72-precomposed.png') );  ?>
    <? add_icon(array('rel' => 'apple-touch-icon', 'sizes' => "114x114", 'href' => 'apple-touch-icon-114x114-precomposed.png') );  ?>
    <? add_icon(array('rel' => 'apple-touch-icon-precomposed', 'href' => 'apple-touch-icon-precomposed.png') );  ?>
    <? add_icon(array('rel' => 'shortcut icon', 'type' => 'image/ico', 'href' => 'favicon.ico') );  ?>
   
    <!-- css -->
    <? add_css('flat/bootstrap'); ?>
    <? add_css('flat/plugins'); ?>
    <? add_css('flat/main'); ?>
    <? add_css('flat/themes/city.css'); ?>
    <? add_css('flat/themes'); ?>
    
    <!-- js -->
    <? add_script('flat/modernizr-2.6.2-respond-1.1.0.min'); ?>
</head>

<body class="login">

    <!-- Login Container -->
    <div id="login-container">

        <?php echo $this->template->message(); ?>

        <?php echo $this->template->yield(); ?>
       
    </div>
    
    <!-- Get Jquery library from Google ... -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>!window.jQuery && document.write(unescape('%3Cscript src="<?php echo public_js_url('/flat/jquery-1.9.1.min.js')?>"%3E%3C/script%3E'));</script>

    <!-- js -->
    <? add_script('flat/bootstrap.min'); ?>
    <? add_script('flat/plugins'); ?>
    <? add_script('flat/main'); ?>

</body>
</html>