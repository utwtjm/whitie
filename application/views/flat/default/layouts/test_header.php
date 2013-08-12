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

            <!-- Brand and Search Section -->
            <div class="span4 text-center hidden-phone">
                <!-- Loading Indicator, Used for demostrating how loading of notifications could happen, check main.js - uiDemo() -->
                <div id="loading" class="hide"><i class="icon-spinner icon-spin"></i></div>
            </div>
            <!-- END Brand and Search Section -->

            <!-- Header Nav Section -->
            <div id="header-nav-section" class="span4 clearfix">
              
                 <!-- Header Nav -->
                <ul class="nav pull-right">
                   
                    <!-- Divider -->
                    <li class="divider-vertical remove-margin"></li>

                    <!-- Messages -->
                    <li class="dropdown dropdown-messages">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon-parents"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                        <?php if(is_logged()): ?>
                            <li><a tabindex="-1" href="<?php echo web_url('/user/logout'); ?>">登出</a></li>
                        <?php else: ?>
                            <li><a tabindex="-1" href="<?php echo web_url('/user/login'); ?>">登入</a></li>
                            <li><a tabindex="-1" href="<?php echo web_url('/register/new_user'); ?>">註冊</a></li>
                        <?php endif; ?>
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