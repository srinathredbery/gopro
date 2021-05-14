var user_type;

$(document).ready(function () {
    // switch_user_type();

    $("#login_form").submit(function (e) {
        authenticate_login();
        // return false;
    }).keyup(function (e) {
        if (e.keyCode == 13) {
            //add more buttons here
            authenticate_login();
            return false;
        }
    })
});

// function switch_user_type() {
    $("#job_seeker").click(function () {
        $(".job_seeker, .sign_up-common, .social-login").removeClass( "d-none" );
        $(".employer").addClass( "d-none" );

        $(".employer input").prop('disabled', true);
        $(".job_seeker input").prop('disabled', false);
        user_type = 3;
    })

    $("#employer").click(function () {
        $(".employer, .sign_up-common").removeClass( "d-none" );
        $(".job_seeker, .social-login").addClass( "d-none" );

        $(".job_seeker input").prop('disabled', true);
        $(".employer input").prop('disabled', false);
        user_type = 2;
    })
// }

function authenticate_login() {
	$("#login-loader").show();
    var url = new URL(window.location.href);
    var redir = url.searchParams.get("redir");
    redir = (redir) ? redir: (url.pathname === base_url) ? 'dashboard': url ;

    var fdata = new FormData($("#login_form")[0]);

    get_white_rice().then(function (rice) {
        var rice = rice;
        fdata.append('white_rice_token', rice);
        fdata.append('redir', redir);

        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: base_url+"authentication/authenticate_login",
            data: fdata,
            cache: false,
            contentType: false,
            processData:false,
            beforeSend: function () {
                $("#login-loader").show();
            },
            success: function (data) {
                $("#login-loader").fadeOut();
				$('.account-popup-area').fadeOut('fast');
				$('html').removeClass('no-scroll');
                if(data['url']===""){
                    $("#login_form")[0].reset();
                    window.location.replace(base_url);

                }else{
                    $("#login_form")[0].reset();
                    u_status = true;
                    var url = data['url'];
                    window.location.replace(url);
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {

                $("#login-loader").hide();
                if(jqXHR['status']===401){
                    $("#system-error").hide();
                    $("#login-error div p").text(jqXHR.responseJSON.message);
                    $("#login-error").hide().show(100).effect("shake",{times:1},200);
                    // $("input[name='white_rice_token']").val(get_rice());
                }
                else {

                    $("#login-error").hide();
                    $("#system-error span").html(errorThrown+ '.  Please Try again!');
                    $("#system-error").hide().show(100);
                    // $("input[name='white_rice_token']").val(get_rice());
                }

            }
        });

    }).catch(function () {
        heads_up_warning('Failed to connect server. Please try again or contact support');
        // $('.submit-buttom').attr("disabled", false);
    })
}



// $("#sign_up_form").bootstrapValidator({
//     live: 'enabled',
//     message: 'This value is not valid.',
//     excluded: [':disabled'],
//     fields: {
//         first_name: {validators: {notEmpty: {message: '<i class="fas fa-exclamation-circle"></i> Required'}}},
//         last_name: {validators: {notEmpty: {message: '<i class="fas fa-exclamation-circle"></i> Required'}}},
//         email: {validators: {notEmpty: {message: '<i class="fas fa-exclamation-circle"></i> Required'}}},
//         password: {validators: {notEmpty: {message: '<i class="fas fa-exclamation-circle"></i> Required'}}},
//     },
// }).bootstrapValidator()
//     .on('success.form.bv', function (e) {
//         e.preventDefault();
//
//     });

function sign_up_user() {
    var fdata = new FormData($("#sign_up_form")[0]);

    get_white_rice().then(function (rice) {

    	var rice = rice;

        fdata.append('white_rice_token', rice);
		fdata.append('user_type', user_type);

        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: base_url+"authentication/validate_sign_up",
            data: fdata,
            cache: false,
            contentType: false,
            processData:false,
            beforeSend: function () {
                $("#sign-up-loader").show();
            },
            success: function (data) {
                $("#sign-up-loader").hide();
                $("#sign-up-validation-error").hide();
                $("#sign-up-system-error").hide();
                $("#sign-up-system-success div p").text('Successfully registered. Redirecting to dashboard, please wait....');
                $("#sign-up-system-success").hide().show(100);
                setTimeout(function () {
                    var url = base_url+data['url'];
                    window.location.href=url;
                },2000);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $("#sign-up-loader").hide();

                if(jqXHR['status']===449) {
                    $("#sign-up-system-error").hide();
                    $("#sign-up-system-success").hide();
                    $("#sign-up-validation-error div").html(jqXHR['responseJSON']["message"][0]);
                    $("#sign-up-validation-error").hide().show(100).effect("shake", {times: 1}, 200);
                    // $("input[name='white_rice_token']").val(get_rice());
                }
                else {
                    $("#sign-up-validation-error").hide();
                    $("#sign-up-system-error div p").text(errorThrown+ '. Please Try again or contact support');
                    $("#sign-up-system-error").hide().show(100);
                    // $("input[name='white_rice_token']").val(get_rice());
                }

            }
        });

    }).catch(function () {
        heads_up_warning('Failed to connect server. Please try again or contact support');
        $('.submit-buttom').attr("disabled", false);
    })

}

$('#password_reset_form').bootstrapValidator({
    live: 'enabled',
    message: 'This value is not valid.',
    excluded: [':disabled'],
    fields: {
		password_reset_form: {
            validators: {
				full_name: {
                    message: '<i class="fas fa-exclamation-circle"></i> Email is required'},
                emailAddress: {
                    message: '<i class="fas fa-times-circle"></i> Please provide a valid email address'},
            },
        },
    },
}).bootstrapValidator()
    .on('success.form.bv', function (e) {
        e.preventDefault();
        reset_password();
    });

function reset_password() {

    get_white_rice().then(function (rice) {

    	 $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: base_url+'request_password_reset',
            data: $("#password_reset_form").serialize() + '&white_rice_token=' + rice,
            cache: false,
            beforeSend: function () {
                HoldOn.open(loader_options);
            },
            success: function (data) {
                HoldOn.close();
                $('.submit-buttom').attr("disabled", false);
                if(data.status_code === 0){
                    $('#reset_error_message div p').html(data.status_msg);
                    $("#reset_success_message").hide();
                    $("#reset_error_message").hide().show();
                }
                if(data.status_code === 1){
                    $('#reset_success_message div p').html(data.status_msg);
                    $("#reset_error_message").hide();
                    $("#reset_success_message").hide().show();
                }

                // $('#'+section+'-'+rec_id).remove();
            },
            error: function (jqXHR, textStatus, errorThrown) {

            	// alert(jqXHR.responseText);
				HoldOn.close();
                // heads_up_warning(jqXHR.responseJSON.message);
                $('.submit-buttom').attr("disabled", false);
            }
        });
    }).catch(function () {
    	heads_up_warning('Failed to connect server. Please try again or contact support');
        $('.submit-buttom').attr("disabled", false);
    })
}

$('#btnSubmit').on('click',function () {

 var full_name=	$('#full_name').val();
 var email=$('#email').val();
 var subject=$('#subject').val();
 var message=$('#message').val();

 if(full_name==""){
	 heads_up_warning("Required Full Name", "error");
 }else if(email==""){
	 heads_up_warning("Required Email", "error");
 }else if(subject==""){
	 heads_up_warning("Required Subject", "error");
 }else if(message==""){
	 heads_up_warning("Required Message", "error");
 }else {
	 var rcres = grecaptcha.getResponse();
	 if (rcres.length) {
		 grecaptcha.reset();
		 send_contact_details_mail();
	 } else {
		 heads_up_warning("Please verify reCAPTCHA", "error");
	 }
 }

});


function send_contact_details_mail(){

	get_white_rice().then(function (rice) {
		$.ajax({
			type: "POST",
			dataType: 'JSON',
			url: base_url+'send_cont_details',
			data: $("#contact_details_form").serialize() + '&white_rice_token=' + rice,
			cache: false,
			beforeSend: function () {
				HoldOn.open(loader_options);
			},
			success: function (data) {
				HoldOn.close();
				if(data.status_code===0){
					$('#reset_error_message div p').html(data.status_msg);
					$("#reset_success_message").hide();
					$("#reset_error_message").show();
				}
				if(data.status_code===1){
					$('#reset_success_message div p').html(data.status_msg);
					$("#reset_error_message").hide();
					$("#reset_success_message").show();
				}
				$('.submit-buttom').attr("disabled", false);
				// $('#'+section+'-'+rec_id).remove();
			},
			error: function (jqXHR, textStatus, errorThrown) {
				// alert(jqXHR.responseText);

				HoldOn.close();
				// heads_up_warning(jqXHR.responseJSON.message);
				$('.submit-buttom').attr("disabled", false);
			}
		});
	}).catch(function () {
		heads_up_warning('Failed to connect server. Please try again or contact support');
		$('.submit-buttom').attr("disabled", false);
	})
}




$('#new_password_form').bootstrapValidator({
    live: 'enabled',
    message: 'This value is not valid.',
    excluded: [':disabled'],

    fields: {
        password: {
            validators: {
                notEmpty: {
                    message: '<i class="fas fa-exclamation-circle"></i> Please enter a strong password <br>'},
                stringLength: {
                    min: 8,
                    message: '<i class="fas fa-exclamation-circle"></i>The password must have at least 8 characters <br>'
                }
            },
        },
        password_recheck:{
            validators: {
                notEmpty: {
                    message: '<i class="fas fa-exclamation-circle"></i> Please retype your password here'},
                identical: {
                    field: 'password',
                    message: '<i class="fas fa-times-circle"></i> Your passwords doesn\'t match'},
            },
        },
    }
}).on('keyup', '[name="password"]', function() {
    $('#new_password_form')
        .bootstrapValidator('updateStatus', 'password', 'NOT_VALIDATED').bootstrapValidator('validateField', 'password')
        .bootstrapValidator('updateStatus', 'password_recheck', 'NOT_VALIDATED').bootstrapValidator('validateField', 'password_recheck');
}).on('success.form.bv', function (e) {
        e.preventDefault();
        new_password();
}).on('error.form.bv', function (e) {

});



function new_password() {
    get_white_rice().then(function (rice) {
        const urlParams = new URLSearchParams(window.location.search);
        const check = urlParams.get('fpc');
        const user = urlParams.get('u');

        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: base_url+'set_new_password',
            data: $("#new_password_form").serialize()+'&check='+check+'&user='+user + '&white_rice_token=' + rice,
            cache: false,
            beforeSend: function () {
                HoldOn.open(loader_options);
            },
            success: function (data) {
                HoldOn.close();
                // $('.submit-buttom').attr("disabled", false);
                if(data.status_code === 0){
                    if(data.r_url){
                        window.location.href = data.r_url;
                    }
                    else{
                        $('#reset_error_message div p').html(data.status_msg);
                        $("#reset_success_message").hide();
                        $("#reset_error_message").hide().show();
                    }
                }
                if(data.status_code === 1){
                    $('#reset_success_message div p').html(data.status_msg);
                    $("#reset_error_message").hide();
                    $("#reset_success_message").hide().show();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                // heads_up_warning(jqXHR.responseJSON.message);
                $('.submit-buttom').attr("disabled", false);
            }
        });
    }).catch(function () {
        heads_up_warning('Failed to connect server. Please try again or contact support')

    })
}


function check_current_login_status() {
    return $.ajax({
        // async: false,
        type: "GET",
        dataType: 'JSON',
        url: base_url+'login_status',
        cache: true,
        success: function (data) {
            HoldOn.close();
            return (data==="true");
        },
        error: function (jqXHR, textStatus, errorThrown) {
            HoldOn.close();
            heads_up_error();
            return textStatus;
        }
    });
}

$('#change_password_form').bootstrapValidator({
    live: 'enabled',
    message: 'This value is not valid.',
    excluded: [':disabled'],

    fields: {
        password: {
            validators: {
                notEmpty: {
                    message: '<i class="fas fa-exclamation-circle"></i> Please enter a strong password <br>'},
                stringLength: {
                    min: 8,
                    message: '<i class="fas fa-exclamation-circle"></i>The password must have at least 8 characters <br>'
                }
            },
        },
        password_confirm:{
            validators: {
                notEmpty: {
                    message: '<i class="fas fa-exclamation-circle"></i> Please retype your password here'},
                identical: {
                    field: 'password',
                    message: '<i class="fas fa-times-circle"></i> Your passwords doesn\'t match'},
            },
        },
    }
}).on('keyup', '[name="password"]', function() {
    $('#new_password_form')
        .bootstrapValidator('updateStatus', 'password', 'NOT_VALIDATED').bootstrapValidator('validateField', 'password')
        .bootstrapValidator('updateStatus', 'password_confirm', 'NOT_VALIDATED').bootstrapValidator('validateField', 'password_confirm');
}).on('success.form.bv', function (e) {
    e.preventDefault();
    change_password();
}).on('error.form.bv', function (e) {

});

function change_password() {
    get_white_rice().then(function (rice) {
        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: base_url+'change_new_password',
            data: $("#change_password_form").serialize()+ '&white_rice_token=' + rice,
            cache: false,
            beforeSend: function () {
                HoldOn.open(loader_options);
            },
            success: function (data) {
                HoldOn.close();
                if(data.status_code === 0){
                    $('#reset_error_message div p').html(data.status_msg);
                    $("#reset_success_message").hide();
                    $("#reset_error_message").hide().show();
                    $("#change_password_form")[0].reset();
                }
                if(data.status_code === 1){
                    $('#reset_success_message div p').html(data.status_msg);
                    $("#reset_error_message").hide();
                    $("#reset_success_message").hide().show();
                    $("#change_password_form")[0].reset();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                // heads_up_warning(jqXHR.responseJSON.message);
                $('.submit-buttom').attr("disabled", false);
            }
        });
    }).catch(function () {
        heads_up_warning('Failed to establish secure connection to the server. Please try again or contact support')

    })
}
