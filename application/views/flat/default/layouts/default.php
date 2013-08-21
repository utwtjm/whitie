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
    <? add_css('flat/themes/asphalt.css'); ?>
    <? add_css('flat/themes'); ?>
    
    <!-- js -->
    <? add_script('flat/modernizr-2.6.2-respond-1.1.0.min'); ?>
</head>

<body class="header-fixed-top">

    <div id="page-container">

        <?php echo $this->template->layout_block('default_header') ?>
        <?php echo $this->template->layout_block('default_sidebar') ?>
        <?php echo $this->template->layout_block('default_pre_content') ?>

        <div id="page-content">
            <?php echo $this->template->message(); ?>
            <?php echo $this->template->yield(); ?>
        </div>

        <?php echo $this->template->layout_block('default_footer') ?>
        
    </div>

    <!-- Scroll to top link, check main.js - scrollToTop() -->
    <a href="#" id="to-top"><i class="icon-chevron-up"></i></a>

    <!-- User Modal Account, appears when clicking on 'User Settings' link found on user dropdown menu (header, top right) -->
    <div id="modal-user-account" class="modal hide fade">
        <div class="modal-body remove-padding">
           <div class="block-tabs">
                <div class="block-options">
                    <a href="javascript:void(0)" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i></a>
                </div>
                <ul class="nav nav-tabs" data-toggle="tabs">
                    <li class="active"><a href="#modal-user-account-account"><i class="icon-cog"></i> Account</a></li>
                    <li><a href="#modal-user-account-profile"><i class="icon-user"></i> Profile</a></li>
                </ul>
                <div class="tab-content">
                    <!-- Account Tab Content -->
                    <div class="tab-pane active" id="modal-user-account-account">
                        <form action="index.html" method="post" class="form-horizontal" onsubmit="return false;">
                            <div class="control-group">
                                <label class="control-label" for="modal-account-username">Username</label>
                                <div class="controls">
                                    <input type="text" id="modal-account-username" name="modal-account-username" value="admin" class="disabled" disabled>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="modal-account-email">Email</label>
                                <div class="controls">
                                    <input type="text" id="modal-account-email" name="modal-account-email" value="admin@exampleapp.com">
                                </div>
                            </div>
                            <h4 class="sub-header">Change Password</h4>
                            <div class="control-group">
                                <label class="control-label" for="modal-account-pass">Current Password</label>
                                <div class="controls">
                                    <input type="password" id="modal-account-pass" name="modal-account-pass">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="modal-account-newpass">New Password</label>
                                <div class="controls">
                                    <input type="password" id="modal-account-newpass" name="modal-account-newpass">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="modal-account-newrepass">Retype New Password</label>
                                <div class="controls">
                                    <input type="password" id="modal-account-newrepass" name="modal-account-newrepass">
                                </div>
                            </div>
                        </form>
                    </div>
                  
                    <!-- Profile Tab Content -->
                    <div class="tab-pane" id="modal-user-account-profile">
                        <form action="index.html" method="post" class="form-horizontal" onsubmit="return false;">
                            <div class="control-group">
                                <label class="control-label" for="modal-profile-name">Name</label>
                                <div class="controls">
                                    <input type="text" id="modal-profile-name" name="modal-profile-name" value="John Doe">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="modal-profile-gender">Gender</label>
                                <div class="controls">
                                    <select id="modal-profile-gender" name="modal-profile-name">
                                        <option value="m">Male</option>
                                        <option value="f">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="modal-profile-birthdate">Birthdate</label>
                                <div class="controls">
                                    <div class="input-append">
                                        <input type="text" id="modal-profile-birthdate" name="modal-profile-birthdate" class="input-small input-datepicker">
                                        <span class="add-on"><i class="icon-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="modal-profile-skills">Skills</label>
                                <div class="controls">
                                    <select id="modal-profile-skills" name="modal-profile-skills" class="select-chosen" multiple>
                                        <option value="html" selected>html</option>
                                        <option value="css" selected>css</option>
                                        <option value="javascript">javascript</option>
                                        <option value="php">php</option>
                                        <option value="mysql">mysql</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="modal-profile-bio">Bio</label>
                                <div class="controls">
                                    <textarea id="modal-profile-bio" name="modal-profile-bio" class="textarea-elastic" rows="3">Bio Information..</textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button class="btn btn-success" data-dismiss="modal"><i class="icon-save"></i> Save</button>
        </div>
    </div>

    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>

    <!-- Get Jquery library from Google ... -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>!window.jQuery && document.write(unescape('%3Cscript src="<?php echo public_js_url('/flat/jquery-1.9.1.min.js')?>"%3E%3C/script%3E'));</script>

    <!-- js -->
    <? add_script('flat/bootstrap.min'); ?>
    <? add_script('flat/plugins'); ?>
    <? add_script('flat/main'); ?>

</body>
</html>