<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <ul class="nav">
        <?php if(is_logged()): ?>
	        <li><a href="<?echo web_url('/user/logout'); ?>">登出</a></li>
	    <?php else: ?>
	    	 <li><a href="<?echo web_url('/user/login'); ?>">登入</a></li>
	        <li class="divider-vertical"></li>
	        <li><a href="<?echo web_url('/register/new_user'); ?>">註冊</a></li>
	        <li class="divider-vertical"></li>
    	<?php endif;?>
        </ul>
    </div>
</div>

<div class="spacer">
    &nbsp;
</div>

