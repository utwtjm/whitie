<div class="row">
	<div class="span4 offset4 well">
		<legend>註冊</legend>
		<form action="<?=web_url('/register/save_user')?>" method="post">
			<input type="text" class="span4" name="user_name" placeholder="帳號">
			<input type="text" class="span4" name="user_email" placeholder="電子信箱">
			<input type="password" class="span4" name="user_pass" placeholder="密碼">
			<input type="password" class="span4" name="confirm_user_pass" placeholder="確認密碼">
			<input type="text" class="span4" name="captcha_code" placeholder="驗證碼">
			<img id="siimage" width="298" style="padding-bottom:10px;" src="<?php echo web_url('captcha/show?sid='.md5(uniqid())); ?>" alt="驗證碼" align="left" />
			<button class="btn btn-warning btn-block" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = '<?php echo web_url('captcha/show?sid=')?>' + Math.random(); this.blur(); return false">重新取得驗證碼</a>
			<button type="submit" name="submit" class="btn btn-info btn-block">送出</button>
		</form>    
	</div>
</div>