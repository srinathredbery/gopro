<!--sign up pop up-->

<div class="account-popup-area signup-popup-box">
    <div class="account-popup">
        <span class="close-popup"><i class="la la-close"></i></span>
        <h3>Sign Up</h3>as
        <div class="select-user">
            <span id="job_seeker">Job Seeker</span>
            <span id="employer">Employer</span>
        </div>


<!--        --><?php //echo form_open('', 'id="sign_up_form"');?>

        <form id="sign_up_form" enctype="multipart/form-data">
            <div class="cfield form-group d-none job_seeker">
                <input type="text" id="fname" name="jobseeker_first_name" id="jobseeker_first_name" placeholder="First Name" required/>
                <i class="la la-user"></i>
            </div>
            <div class="cfield form-group d-none job_seeker">
                <input type="text" name="jobseeker_last_name"  id="jobseeker_last_name" placeholder="Last Name" required />
                <i class="la la-user"></i>
            </div>
            <div class="cfield d-none employer">
                <input type="text" name="employer_name" placeholder="Organization Name"  required/>
                <i class="la la-building-o"></i>
            </div>
            <div class="cfield form-group d-none sign_up-common">
                <input type="email" onkeyup="isEmail()" name="email" id="email" placeholder="Email" required/>
            	<i class="la la-envelope-o"></i>
            </div>
            <div class="cfield d-none sign_up-common">
                <input type="password" id="password" name="password" placeholder="Password" required/>
                <i class="la la-key"></i>
            </div>
            <div class="cfield d-none sign_up-common">
                <input type="password"id="password2"name="password_confirm" placeholder="Re-enter password" required/>
                <i class="la la-key"></i>
            </div>
            <div class=" d-none sign_up-common">
                <select name="country_code_idd" class="chosen" id="county-code-idd-selector">
                    <option value="" selected>Select your country code</option>
                    <?php
					$country_list = get_country_list();

                    if (isset($country_list)) {
                        if (!empty($country_list)) {
                            foreach ($country_list as $country) {
                                if(!empty($country['idd_code'])) {
                                    ?>
                                    <option value="<?php echo $country['idd_code'] ?>">
                                        <?php echo '(+' . $country['idd_code'] . ') ' . $country['country_name'] ?>
                                    </option>
                                    <?php
                                }
                            }
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="cfield d-none sign_up-common">
                <input type="text" name="phone_no" id="phone_no" placeholder="Phone Number" required/>
                <i class="la la-phone"></i>
            </div>
			<div class="cfield d-none employer set-multiple-select-field">
				<div class="row">
					<div class="col-md-3">
						<select name="contact_person_title" class="select2-custom" id="title_of_contact" data-placeholder="Tittle">
							<option value=""></option>
							<option value="1">Mr.</option>
							<option value="2">Mrs.</option>
							<option value="3">Miss.</option>
						</select>
					</div>
					<div class="col-md-9">
						<input type="text" name="contact_person" placeholder="Name of contact person"  required/>
					</div>
				</div>
				<i class="far fa-address-card"></i>
			</div>
			<div class="cfield d-none employer">
				<input type="text" name="contact_person_job_title"
					   placeholder="Job title of contact" required/>
				<i class="la la-black-tie"></i>
			</div>
            <div class="cfield d-none job_seeker">
                <div class="row">
                    <span class="upload-file-label">Upload your CV</span>
                    <i class="la la-file-text-o"></i>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <input type="file" name="user_resume" id="upload-resume" placeholder="Choose your CV"/>
                        <label for="upload-resume">Choose File</label>
                        <label class="selected-file" data-toggle="tooltip" data-placement="bottom" title="Click to remove">No files chosen</label>
                    </div>
                </div>
            </div>


            <img class="center-block loader-gif sign-up" id="sign-up-loader" src="<?php echo base_url() ?>assets/styles/images/login-loader.gif" alt=""/>


            <!--            validation error error-->
            <div class="credentials-label" id="sign-up-validation-error">
                <i class="fas fa-exclamation-circle"></i>
                <div class=""><p>Error</p></div>
            </div>

            <!--            Error Message-->
            <div class="credentials-label" id="sign-up-system-error">
                <i class="fas fa-exclamation-circle"></i>
                <div  class=""><p> Something went wrong, Please contact our support</p></div>
            </div>

            <!--            Success message-->
            <div class="credentials-label sign-up-success" id="sign-up-system-success">
                <i class="fas fa-check-circle"></i>
                <div  class=""><p>Successfully registered. Please login with your credentials to use the system.</p></div>
            </div>


            <button class="d-none sign_up-common" type="submit" onclick="sign_up_user()">Sign Up</button>
<!--        --><?php //echo form_close()?>
        </form>
        <div class="extra-login d-none social-login">
<!--            <span>Or</span>-->
            <div class="login-social">
<!--                <div class="g-signin2" data-width="300" data-height="200" data-longtitle="true"></div>-->
<!--                <a class="fb-login" href="#" title=""><i class="fab fa-facebook-f"></i></a>-->
<!--                <a class="tw-login" href="#" title=""><i class="fab fa-twitter"></i></a>-->
            </div>
        </div>
        <div class="extra-login-cus d-none sign_up-common">
            <p class="terms-conditions-notice mt-6">By Signing up, you confirm that you have read and agree with Jobenvoy.com's
                <a href="<?php echo base_url() . 'terms' ?>"
                   class="modify-resume-cover-button ">
                    Terms & Conditions
                </a>
            </p>
        </div>
    </div>
</div>

<script type="text/javascript">
	$('.selected-file').on('click',function(){ $('.selected-file').text('')});

	// $('#phone_no').on('click',function (){
	//
	// });
	// $("#phone_no").keypress(function (e){
	// 	if($(this).val().length<10) {
	//
	// 		if($(this).val().length==9) {
	// 			$("#phone_no").css('background-color', '#FFFFFF');
	// 		}else{
	// 			$("#phone_no").css('background-color', '#ffff00');
	// 		}
	// 		var charCode = (e.which) ? e.which : e.keyCode;
	// 		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
	// 			return false;
	// 		}
	//
	// 	}else{
	// 		return false;
	// 	}
	// });

	$('#fname').keypress(function (e) {

		var regex = new RegExp("^[a-zA-Z0-9-]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if (regex.test(str)) {

			    if(47<e.charCode && e.charCode<58){
					return false;

				}else {
					return true;
				}


		}
		e.preventDefault();


		return false;



	});

	$('#jobseeker_last_name').keypress(function (e) {

		var regex = new RegExp("^[a-zA-Z0-9-]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if (regex.test(str)) {
			if(47<e.charCode && e.charCode<58){
				return false;

			}else {
				return true;
			}
		}
		e.preventDefault();
		return false;


	});


	// function isEmail() {
	// 	alert($('#email').val());
	// 	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	// 	// alert(regex.test($('#email').val()));
	// 	var valid=regex.test($('#email').val());
	// }




</script>
