
<!--/**-->
<!-- * Created by PhpStorm.-->
<!-- * User: mjy-->
<!-- * Date: 1/7/2019-->
<!-- * Time: 3:59 PM-->
<!-- */-->

<section>
    <div class="block no-padding  gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner2">
                        <div class="inner-title2">
                            <h3>Account Recovery</h3>
                        </div>
                        <div class="page-breacrumbs">
                            <ul class="breadcrumbs">
                                <li><a href="<?php echo base_url()?>" title="">Home</a></li>
                                <li><a title="">Account Recovery</a></li>
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
                            <span style="color: #F76618;">Enter your new password</span>
                            <form id="new_password_form" >

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="cfield">
                                            <input type="password" name="password" placeholder="******">
                                            <i class="la la-key"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="cfield">
                                            <input type="password" name="password_recheck" placeholder="******">
                                            <i class="la la-key"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="submit-buttom">Change password</button>
                                    </div>
                                </div>


                            </form>
                            <img class="center-block loader-gif login" id="login-loader" src="<?php echo base_url() ?>assets/styles/images/login-loader.gif" alt=""/>

                            <!--            Success message-->
                            <div class="credentials-label sign-up-success mt-3" id="reset_success_message">
                                <i class="fas fa-check-circle d-no"></i>
                                <div class=""><p>Success.</p></div>
                            </div>

                            <!--            Error Message -->
                            <div class="credentials-label  mt-3" id="reset_error_message">
                                <i class="fas fa-exclamation-circle"></i>
                                <div class=""><p>Error</p></div>
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
