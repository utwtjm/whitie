<div class="row">
	<div class="span4 offset4 well">
		<legend>登入</legend>
		<form action="<?=web_url('/user/auth')?>" method="post">
			<input type="text" class="span4" name="user_name" placeholder="帳號">
			<input type="password" class="span4" name="user_pass" placeholder="密碼">
			<button type="submit" name="submit" class="btn btn-info btn-block">送出</button>
		</form>    
	</div>
</div>