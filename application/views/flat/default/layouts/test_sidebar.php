
<!-- Left Sidebar -->
<aside id="page-sidebar" class="nav-collapse collapse">
    <!-- Mini Profile -->
    <div class="mini-profile">
        <div class="mini-profile-options">
            
            <!-- Modal div is at the bottom of the page before including javascript code, we use .enable-tooltip class for the tooltip because data-toggle is used for modal -->
            <a href="#modal-user-account" class="badge badge-success enable-tooltip" role="button" data-toggle="modal" data-placement="right" title="設定">
                <i class="glyphicon-cogwheel"></i>
            </a>
        </div>
        <a href="page_ready_user_profile.html">
            <img src="<?php echo public_image_url('/flat/template/avatar.jpg')?>" alt="Avatar" class="img-circle">
        </a>
    </div>
    <!-- END Mini Profile -->

    <!-- Primary Navigation -->
    <nav id="primary-nav">
        <ul>
            <li>
                <a href="<?php echo web_url(); ?>" class="active"><i class="glyphicon-display"></i>個人首頁</a>
            </li>
        </ul>
    </nav>
    <!-- END Primary Navigation -->
</aside>
<!-- END Left Sidebar -->