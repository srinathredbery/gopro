<style type="text/css" xmlns="http://www.w3.org/1999/html">
	.inner-header {
		background-image: url('/jobenvoy/assets/styles/images/resource/mslider3.jpg');
		background-repeat: no-repeat;
		background-size: cover;
		padding-top: 108px;

	}
	.tag_name {
		color: #ddd !important;
	}
	.tag-other {
		color: #ddd !important;
	}

	.remember-label input[type="checkbox"] {
		position: absolute;
		opacity: 1;
		z-index: 1;
		margin: 7px;
		margin-left: 0;
		width: 16px !important;
		height: 16px !important;
	}

	.remember-label .filter-label::before {
		display: none;
	}
</style>


<section>
    <div class="inner-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner2">
                        <div class="inner-title2">
                            <h3 class="tag_name">Login</h3>
                        </div>
                        <div class="page-breacrumbs">
                            <ul class="breadcrumbs">
                                <li><a class="tag-other" href="<?php echo base_url()?>" title="">Home</a></li>
                                <li><a class="tag-other" href="#" title="">Login</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block remove-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="account-popup-area signin-popup-box static">
                        <div class="account-popup">
                            <span style="color: #F76618;">Please Login to continue...</span>
<!--                            --><?php //echo form_open('','id="login_form"')?>
                            <form id="login_form">
                                <div class="cfield">
                                    <input type="text" placeholder="Username" name="username"/>
                                    <i class="la la-user"></i>
                                </div>
                                <div class="cfield">
                                    <input type="password" placeholder="********" name="password"/>
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
<!--                            --><?php //echo form_close()?>
                            </form>

                            <div class="extra-login">
<!--                                <span>Or</span>-->
<!--                                <div class="login-social">-->
<!--                                    <a class="fb-login" href="#" title=""><i class="fab fa-facebook-f"></i></a>-->
<!--                                    <a class="tw-login" href="#" title=""><i class="fab fa-twitter"></i></a>-->
<!--                                </div>-->
                            </div>
                        </div>
                    </div><!-- LOGIN POPUP -->
                </div>
            </div>
        </div>
    </div>
</section>

<!--Login pop up-->
<?php //$this->load->view('general/login_popup') ?>

<!--Sign up pop up-->
<?php $this->load->view('general/signup_popup') ?>
