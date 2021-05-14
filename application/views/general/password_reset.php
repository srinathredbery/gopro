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
                                <li><a class="tag-other" href="#" title="">For</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$err_msg = $this->input->get();
if (isset($err_msg['err']) && !empty($err_msg['err']))
{
    ?>
    <section>
        <div class="job-applied-message-banner" style="background: #008ce0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <span class="job-applied-message-icon"><i class="fas fa-exclamation-circle"></i></span>
                        <?php
                        if($err_msg['err'] == 'link_expired')
                            echo '<p>The reset link has been already used or expired! Please try again. If you need any assistance, please contact our support</p>';
                        elseif ($err_msg['err'] == 'int_error')
                            echo '<p>The reset link is not working, Pleae try again.</p>';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}
?>

<section>
    <div class="block remove-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="account-popup-area signin-popup-box static">
                        <div class="account-popup">
                            <span style="color: #F76618;">Please enter your email address you registered here</span>
                            <form id="password_reset_form" >

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="cfield">
                                            <input type="text" name="forgot_pass_email" placeholder="Ex: example@mail.com">
                                            <i class="la la-envelope-o"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="submit-buttom">Reset Password</button>
                                    </div>
                                </div>
                            </form>
                            <img class="center-block loader-gif login" id="login-loader" src="<?php echo base_url() ?>assets/styles/images/login-loader.gif" alt=""/>

                            <!--            Success message-->
                            <div class="credentials-label sign-up-success mt-3" id="reset_success_message">
                                <i class="fas fa-check-circle d-no"></i>
                                <div class=""><p>.</p></div>
                            </div>

                            <!--            Error Message -->
                            <div class="credentials-label  mt-3" id="reset_error_message">
                                <i class="fas fa-exclamation-circle"></i>
                                <div class=""><p> Something went wrong, Please contact our support</p></div>
                            </div>

                        </div>
                    </div><!-- LOGIN POPUP -->
                </div>
            </div>
        </div>
    </div>
</section>


<!--Login pop up-->
<?php $this->load->view('general/login_popup') ?>

<!--Sign up pop up-->
<?php $this->load->view('general/signup_popup') ?>
