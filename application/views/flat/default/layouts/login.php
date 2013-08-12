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
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <? add_icon(array('rel' => 'shortcut icon', 'type' => 'image/ico', 'href' => 'favicon.ico') );  ?>
    <? add_icon(array('rel' => 'apple-touch-icon', 'href' => 'apple-touch-icon.png') );  ?>
    <? add_icon(array('rel' => 'apple-touch-icon', 'sizes' => "57x57", 'href' => 'apple-touch-icon-57x57-precomposed.png') );  ?>
    <? add_icon(array('rel' => 'apple-touch-icon', 'sizes' => "72x72", 'href' => 'apple-touch-icon-72x72-precomposed.png') );  ?>
    <? add_icon(array('rel' => 'apple-touch-icon', 'sizes' => "114x114", 'href' => 'apple-touch-icon-114x114-precomposed.png') );  ?>
    <? add_icon(array('rel' => 'apple-touch-icon-precomposed', 'href' => 'apple-touch-icon-precomposed.png') );  ?>
    <? add_icon(array('rel' => 'shortcut icon', 'type' => 'image/ico', 'href' => 'favicon.ico') );  ?>
    
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- The roboto font is included from Google Web Fonts -->
    <?/*
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic">
    */?>

    <!-- Bootstrap is included in its original form, unaltered -->
    <? add_css('bootstrap'); ?>

    <!-- Related styles of various icon packs and javascript plugins -->
    <? add_css('plugins'); ?>

    <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
    <? add_css('main'); ?>

    <!-- Load a specific file here from /public/themes/flat_admin/css/themes/ folder to alter the default theme of all the template -->

    <!-- The themes stylesheet of this template (for using specific theme color in individual elements (must included last) -->
    <? add_css('themes'); ?>
    <!-- END Stylesheets -->

    <!-- Modernizr (Browser feature detection library) & Respond.js (Enable responsive CSS code on browsers that don't support it) -->
    <? add_script('vendor/modernizr-2.6.2-respond-1.1.0.min'); ?>

    <!-- Get Jquery library from Google ... -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <!-- ... but if something goes wrong get Jquery from local file -->
    <script>!window.jQuery && document.write(unescape('%3Cscript src="<?php echo public_js_url('/vendor/jquery-1.9.1.min.js')?>"%3E%3C/script%3E'));</script>

</head>

<!-- Body -->
<!-- In the PHP version you can set the following options from the config file -->
<!-- Add the class .hide-side-content to <body> to hide side content by default -->
<body class="login">

    <!-- Login Container -->
    <div id="login-container">

        <?php echo $this->template->message(); ?>

        <?php echo $this->template->yield(); ?>
       
    </div>
    <!-- END Login Container -->

    
    <!--
    Include Google Maps API for global use.
    If you don't want to use  Google Maps API globally, just remove this line and the gmaps.js plugin from /public/themes/flat_admin/js/plugins.js (you can put it in a seperate file)
    Then iclude them both in the pages you would like to use the google maps functionality
    -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>

    <!-- Bootstrap.js -->
    <? add_script('vendor/bootstrap.min'); ?>

    <!-- Jquery plugins and custom javascript code -->
    <? add_script('plugins'); ?>
    <? add_script('main'); ?>
    <!-- Javascript code only for this page -->

</body>
</html>