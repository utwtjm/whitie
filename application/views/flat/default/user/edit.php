<form action="<?php echo web_url('/user/update'); ?>" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="avatar_file" id="avatar_file"><br>
<input id="pass1" type="password" size="16" name="edit_user_pass"><br>
<input id="pass2" type="password" size="16" name="edit_confirm_user_pass"><br>
<input type="submit" name="submit" value="Submit">
</form>
<img src="<?php echo upload_web_file($user->avatar); ?>">
