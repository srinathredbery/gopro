<!--// login pop up-->

<div class="account-popup-area signin-popup-box">
    <div class="account-popup">
        <span class="close-popup"><i class="la la-close"></i></span>
        <h3>User Login</h3>
        <form id="login_form">
            <div class="cfield">
                <input type="text" placeholder="Email" name="username" required/>
                <i class="la la-user"></i>
            </div>
            <div class="cfield">
                <input type="password" placeholder="********" name="password" required/>
                <i class="la la-key"></i>
            </div>
            <p class="remember-label">
                <input type="checkbox" name="cb" id="cb1"><label for="cb1" class="filter-label">Remember me</label>
			</p>
                <img class="center-block loader-gif login" id="login-loader" src="<?php echo base_url() ?>assets/styles/images/login-loader.gif" alt=""/>
            <a href="<?php echo base_url().'forgot_password'?>" title="">Forgot Password?</a>

<!--            credentials error-->
            <div class="credentials-label" id="login-error">
                <i class="fas fa-exclamation-circle"></i>
                <div class=""><p>Invalid username or password! Please try again</p></div>
            </div>

<!--            System error-->
            <div class="credentials-label" id="system-error">
                <i class="fas fa-exclamation-circle"></i>
                <div  class=""><p>Something went wrong, Please contact our support</p></div>
            </div>
            <button type="submit">Login</button>

<!--            <div class="cfield">-->
<!--                <a type="">Sign Up</a>-->
<!--            </div>-->
        </form>

        <div class="extra-login">
<!--            <span>Or</span>-->
<!--            <div class="login-social">-->
<!--                <a class="fb-login" href="#" title=""><i class="fab fa-facebook-f"></i></a>-->
<!--                <a class="tw-login" href="#" title=""><i class="fab fa-twitter"></i></a>-->
<!--            </div>-->

        </div>
    </div>
</div>
