 <!-- Header -->
<!-- In the PHP version you can set the following options from the config file -->
<!-- Add the class .navbar-fixed-top or .navbar-fixed-bottom for a fixed header on top or bottom respectively -->
<!-- If you add the class .navbar-fixed-top remember to add the class .header-fixed-top to <body> element! -->
<!-- If you add the class .navbar-fixed-bottom remember to add the class .header-fixed-bottom to <body> element! -->
<!-- <header class="navbar navbar-inverse navbar-fixed-top"> -->
<!-- <header class="navbar navbar-inverse navbar-fixed-bottom"> -->
<header class="navbar navbar-inverse navbar-fixed-top">
    <!-- Navbar Inner -->
    <div class="navbar-inner">
        <!-- div#row-fluid -->
        <div class="row-fluid">

            <!-- Sidebar Toggle Buttons (Desktop & Tablet) -->
            <div class="span4 hidden-phone">
                <ul class="nav pull-left">
                    <!-- Desktop Button (Visible only on desktop resolutions) -->
                    <li class="visible-desktop">
                        <a href="javascript:void(0)" id="toggle-side-content">
                            <i class="icon-reorder"></i>
                        </a>
                    </li>
                    <!-- END Desktop Button -->

                    <!-- Tablet Button -->
                    <li class="visible-tablet">
                        <!-- It is set to open and close the left sidebar on tablets. The class .nav-collapse was added to aside#page-sidebar -->
                        <a href="javascript:void(0)" data-toggle="collapse" data-target=".nav-collapse">
                            <i class="icon-reorder"></i>
                        </a>
                    </li>
                    <!-- END Tablet Button -->

                    <!-- Divider -->
                    <li class="divider-vertical remove-margin"></li>
                </ul>
            </div>
            <!-- END Sidebar Toggle Buttons -->

            <div class="span4 text-center">
            </div>

            <!-- Header Nav Section -->
            <div id="header-nav-section" class="span4 clearfix">
                <!-- Header Nav -->
                <ul class="nav pull-right">
                    <!-- Theme Options, functionality initialized at main.js - templateOptions() -->
                    <li class="dropdown dropdown-theme-options">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Theme Options</a>
                        <ul class="dropdown-menu">
                            <!-- Page Options -->
                            <li class="theme-extra visible-desktop">
                                <label for="theme-page-full">
                                    <input type="checkbox" id="theme-page-full" name="theme-page-full" class="input-themed">
                                    Full width page
                                </label>
                            </li>
                            <!-- END Page Options -->

                            <!-- Divider -->
                            <li class="divider visible-desktop"></li>

                            <!-- Header Options -->
                            <li class="theme-extra visible-desktop">
                                <label for="theme-header-top">
                                    <input type="checkbox" id="theme-header-top" name="theme-header-top" class="input-themed">
                                    Top fixed header
                                </label>
                                <label for="theme-header-bottom">
                                    <input type="checkbox" id="theme-header-bottom" name="theme-header-bottom" class="input-themed">
                                    Bottom fixed header
                                </label>
                            </li>
                            <!-- END Header Options -->

                            <!-- Divider -->
                            <li class="divider visible-desktop"></li>

                            <!-- Color Themes -->
                            <li>
                                <ul class="theme-colors clearfix">
                                    <li class="active">
                                        <a href="javascript:void(0)" class="img-circle themed-background-default themed-border-default" data-theme="default" data-toggle="tooltip" title="Default"></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="img-circle themed-background-amethyst themed-border-amethyst" data-theme="/public/themes/flat_admin/css/themes/amethyst.css" data-toggle="tooltip" title="Amethyst"></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="img-circle themed-background-army themed-border-army" data-theme="/public/themes/flat_admin/css/themes/army.css" data-toggle="tooltip" title="Army"></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="img-circle themed-background-asphalt themed-border-asphalt" data-theme="/public/themes/flat_admin/css/themes/asphalt.css" data-toggle="tooltip" title="Asphalt"></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="img-circle themed-background-autumn themed-border-autumn" data-theme="/public/themes/flat_admin/css/themes/autumn.css" data-toggle="tooltip" title="Autumn"></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="img-circle themed-background-cherry themed-border-cherry" data-theme="/public/themes/flat_admin/css/themes/cherry.css" data-toggle="tooltip" title="Cherry"></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="img-circle themed-background-city themed-border-city" data-theme="/public/themes/flat_admin/css/themes/city.css" data-toggle="tooltip" title="City"></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="img-circle themed-background-dawn themed-border-dawn" data-theme="/public/themes/flat_admin/css/themes/dawn.css" data-toggle="tooltip" title="Dawn"></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="img-circle themed-background-deepsea themed-border-deepsea" data-theme="/public/themes/flat_admin/css/themes/deepsea.css" data-toggle="tooltip" title="Deepsea"></a>
                                    </li>
                                    <li><a href="javascript:void(0)" class="img-circle themed-background-diamond themed-border-diamond" data-theme="/public/themes/flat_admin/css/themes/diamond.css" data-toggle="tooltip" title="Diamond"></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="img-circle themed-background-fire themed-border-fire" data-theme="/public/themes/flat_admin/css/themes/fire.css" data-toggle="tooltip" title="Fire"></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="img-circle themed-background-grass themed-border-grass" data-theme="/public/themes/flat_admin/css/themes/grass.css" data-toggle="tooltip" title="Grass"></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="img-circle themed-background-leaf themed-border-leaf" data-theme="/public/themes/flat_admin/css/themes/leaf.css" data-toggle="tooltip" title="Leaf"></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="img-circle themed-background-night themed-border-night" data-theme="/public/themes/flat_admin/css/themes/night.css" data-toggle="tooltip" title="Night"></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="img-circle themed-background-ocean themed-border-ocean" data-theme="/public/themes/flat_admin/css/themes/ocean.css" data-toggle="tooltip" title="Ocean"></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="img-circle themed-background-oil themed-border-oil" data-theme="/public/themes/flat_admin/css/themes/oil.css" data-toggle="tooltip" title="Oil"></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="img-circle themed-background-stone themed-border-stone" data-theme="/public/themes/flat_admin/css/themes/stone.css" data-toggle="tooltip" title="Stone"></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="img-circle themed-background-sun themed-border-sun" data-theme="/public/themes/flat_admin/css/themes/sun.css" data-toggle="tooltip" title="Sun"></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="img-circle themed-background-tulip themed-border-tulip" data-theme="/public/themes/flat_admin/css/themes/tulip.css" data-toggle="tooltip" title="Tulip"></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="img-circle themed-background-wood themed-border-wood" data-theme="/public/themes/flat_admin/css/themes/wood.css" data-toggle="tooltip" title="Wood"></a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END Color Themes -->
                        </ul>
                    </li>
                    <!-- END Theme Options -->

                    <!-- Divider -->
                    <li class="divider-vertical remove-margin"></li>

                    <!-- Notifications -->
                    <li class="dropdown dropdown-notifications">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-warning-sign"></i>
                            <span class="badge badge-neutral">4</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="alert">
                                    <i class="icon-bell"></i> <strong>App</strong> Please pay attention!
                                </div>
                                <div class="alert alert-error">
                                    <i class="icon-bell-alt"></i> <strong>App</strong> There was an error!
                                </div>
                                <div class="alert alert-info">
                                    <i class="icon-bolt"></i> <strong>App</strong> Info message!
                                </div>
                                <div class="alert alert-success">
                                    <i class="icon-bullhorn"></i> <strong>App</strong> Service restarted!
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="javascript:void(0)"><i class="icon-warning-sign pull-right"></i>Notification Center</a>
                            </li>
                        </ul>
                    </li>
                    <!-- END Notifications -->

                    <!-- Messages -->
                    <li class="dropdown dropdown-messages">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-envelope-alt"></i>
                            <span class="badge badge-neutral display-none"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="media">
                                    <a class="pull-left" href="javascript:void(0)" data-toggle="tooltip" title="Newbie">
                                        <img src="<?php echo public_image_url('/placeholders/image_64x64_dark.png')?>" alt="fakeimg" class="img-circle">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="media-heading clearfix"><span class="label label-success">1 min ago</span><a href="javascript:void(0)">Username</a></h5>
                                        <div class="media">Lorem ipsum dolor sit amet, consectetur..</div>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="media">
                                    <a class="pull-left" href="javascript:void(0)" data-toggle="tooltip" title="Pro">
                                        <img src="<?php echo public_image_url('/placeholders/image_64x64_dark.png')?>" alt="fakeimg" class="img-circle">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="media-heading clearfix"><span class="label label-success">2 hours ago</span><a href="javascript:void(0)">Username</a></h5>
                                        <div class="media">Lorem ipsum dolor sit amet, consectetur..</div>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="media">
                                    <a class="pull-left" href="javascript:void(0)" data-toggle="tooltip" title="VIP">
                                        <img src="<?php echo public_image_url('/placeholders/image_64x64_dark.png')?>" alt="fakeimg" class="img-circle">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="media-heading clearfix"><a href="javascript:void(0)">Username</a><span class="label label-success">3 days ago</span></h5>
                                        <div class="media">Lorem ipsum dolor sit amet, consectetur..</div>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="javascript:void(0)"><i class="icon-envelope-alt pull-right"></i>Message Center</a>
                            </li>
                        </ul>
                    </li>
                    <!-- END Messages -->
                </ul>
                <!-- END Header Nav -->

                <!-- Mobile Navigation, Shows up on mobile -->
                <ul class="nav pull-left visible-phone">
                    <li>
                        <!-- It is set to open and close the main navigation on mobiles. The class .nav-collapse was added to aside#page-sidebar -->
                        <a href="javascript:void(0)" data-toggle="collapse" data-target=".nav-collapse">
                            <i class="icon-reorder"></i>
                        </a>
                    </li>
                    <li class="divider-vertical remove-margin"></li>
                </ul>
                <!-- END Mobile Navigation, Shows up on mobile -->
            </div>
            <!-- END Header Nav Section -->
        </div>
        <!-- END div#row-fluid -->
    </div>
    <!-- END Navbar Inner -->
</header>
<!-- END Header -->