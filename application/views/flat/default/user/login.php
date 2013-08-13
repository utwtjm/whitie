<!-- Login Block -->
<div class="block-tabs block-themed themed-border-night">
    <ul id="login-tabs" class="nav nav-tabs themed-background-deepsea" data-toggle="tabs">
        <li class="active text-center">
            <a href="#login-form-tab">
                <i class="icon-user"></i> 登入
            </a>
        </li>
        <li class="text-center">
            <a href="#register-form-tab">
                <i class="icon-plus"></i> 註冊
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="login-form-tab">
            <!-- Login Buttons -->
            <div id="login-buttons">
                <button id="login-btn-facebook" class="btn btn-large btn-primary"><i class="icon-facebook"></i> Facebook</button>
                <button id="login-btn-twitter" class="btn btn-large btn-info"><i class="icon-twitter"></i> Twitter</button>
            </div>
            <!-- END Login Buttons -->

            <!-- Login Form -->
            <form action="<?php echo web_url('/user/auth')?>" method="post" id="login-form" class="form-inline">
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-user"></i></span>
                            <input type="text" id="login-user-name" name="user_name" placeholder="帳號">
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-asterisk"></i></span>
                            <input type="password" id="login-password" name="user_pass" placeholder="密碼">
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls clearfix">
                        <div class="pull-right">
                            <input type="hidden" name="redirect_to" value="<?php echo $redirect_to; ?>">
                            <button type="submit" class="btn btn-success remove-margin">登入</button>
                        </div>
                        <div class="pull-left login-extra-check">
                            <label for="login-remember-me">
                                <input type="checkbox" id="login-remember-me" name="remember_me" class="input-themed">
                                記住我
                            </label>
                        </div>
                    </div>
                </div>
            </form>
            <!-- END Login Form -->
        </div>
        <div class="tab-pane" id="register-form-tab">
            <div class="scrollable">
                <!-- Register Form -->
                <form action="<?php echo web_url('register/save_user')?>" method="post" id="register-form" class="form-inline">
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-user"></i></span>
                                <input type="text" id="register-username" name="user_name" placeholder="帳號">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-envelope-alt"></i></span>
                                <input type="text" id="register-email" name="user_email" placeholder="信箱">
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-asterisk"></i></span>
                                <input type="password" id="register-password" name="user_pass" placeholder="密碼">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-asterisk"></i></span>
                                <input type="password" id="register-repassword" name="confirm_user_pass" placeholder="確認密碼">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-asterisk"></i></span>
                                <input type="text" id="register-captcha-code" name="captcha_code" class="input-mini" placeholder="驗證碼">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <img id="captcha-image" width="346" style="padding-bottom:10px;" src="<?php echo web_url('captcha/show?sid='.md5(uniqid())); ?>" alt="驗證碼" align="left" />           
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls clearfix">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-success remove-margin">註冊</button>
                            </div>
                            <div class="pull-left">
                                <button type="submit" onclick="document.getElementById('captcha-image').src = '<?php echo web_url('captcha/show?sid=')?>' + Math.random(); this.blur(); return false" class="btn btn-info remove-margin">更新驗證碼</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END Register Form -->
        </div>
    </div>
</div>
<!-- END Login Block -->

<script>
    $(function() {

        // Initialize Slimscroll
        $('.scrollable').slimScroll({
            height: '234px',
            color: '#333',  
            size: '5px',
            alwaysVisible: false,
            railVisible: true,
            railColor: '#333',
            railOpacity: 0.1
        });

    });

</script>