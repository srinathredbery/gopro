var searchParams = new URLSearchParams(window.location.search);
searchParams.has('cv_id');
var resume_id = searchParams.get('cv_id');
let operation = 1;
let rec_id = null;


$(document).ready(function () {
   validate_jobseeker_profile();
   //validators
    // validating resume name
    $("#new_resume_form").bootstrapValidator({
        live: 'enabled',
        message: 'This value is not valid.',
        excluded: [':disabled'],
        fields: {
            resume_name: {validators: {notEmpty: {message: '*** Resume name is required'}}}
        },
    }).on('success.form.bv', function (e) {
        e.preventDefault();
        save_resume_name();
    });
});

//validating jobseeker profile data
function validate_jobseeker_profile($target_url) {
    $("#js_profile").bootstrapValidator({
        live: 'enabled',
        message: 'This value is not valid.',
        excluded: [':disabled'],
        fields: {
            jobseeker_first_name: {validators: {notEmpty: {message: '<i class="fas fa-info-circle"></i> Required'}}},
            jobseeker_last_name: {validators: {notEmpty: {message: '<i class="fas fa-info-circle"></i> Required'}}},
            jobseeker_dob: {validators: {notEmpty: {message: '<i class="fas fa-info-circle"></i> Required'}}},
            jobseeker_gender: {validators: {notEmpty: {message: '<i class="fas fa-info-circle"></i> Required'}}},
            jobseeker_phone_no: {validators: {notEmpty: {message: '<i class="fas fa-info-circle"></i> Required'}}},
            jobseeker_cv_searchable: {validators: {notEmpty: {message: '<i class="fas fa-info-circle"></i> Required'}}},
        },
    }).on('success.form.bv', function (e) {
        e.preventDefault();
        show_confirm_alert($target_url);
    });
    return false;
}


function show_confirm_alert($target_url) {

    swal({
        // title: 'Are you sure?',
        text: "Are you sure?",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a453',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            save_form_data($target_url);
        }
    })
}

function save_form_data($target_url) {

    var form_data = $('#js_profile').serialize();
    // Create an FormData object
    // var data = new FormData(form_data);
    HoldOn.open(loader_options);
    get_white_rice().then(function (white_rice) {
        $.ajax({
            type: "POST",
            url: base_url+$target_url,
            data: form_data+'&white_rice_token='+white_rice,
            cache: false,
            timeout: 600000,
            beforeSend: function () {
                // $("#login-loader").show();
            },
            success: function (data) {
                swal(
                    'Success!',
                    'Your data has been saved',
                    'success'
                );
                HoldOn.close()
            },
            error: function (jqXHR, textStatus, errorThrown) {

                swal(
                    'Error!',
                    'Something went wrong',
                    'error'
                );
                HoldOn.close()
            }
        });

    }).catch(function () {
        HoldOn.close();
    })
}

function save_resume_name($target_url) {

    $target_url = 'job_seeker/resume/save_new';

    get_white_rice().then(function (value) {
        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: base_url+$target_url,
            data: $("#new_resume_form").serialize()+'&white_rice_token='+value,
            cache: false,
            beforeSend: function () {
                // $("#login-loader").show();
            },
            success: function (data) {
                heads_up_success('Resume created successfully.<br>Please add the your details in the next view!<br><strong><i>Duly filled resumes gives you more opportunities.<i></strong>');
                $('#new_resume_form')[0].reset();
                $(this).attr('disabled', false);
                setTimeout(function(){ window.location.href=base_url+"job_seeker/resume/new?"+data},2000);

            },
            error: function (jqXHR, textStatus, errorThrown) {
                heads_up_error();
                $(this).attr('disabled', false);
            }
        });
    }).catch(function (err){
        HoldOn.close();
    })
}

//Delete Resume
$('.del-res').on("click", function (e) {
    var id = $(e.target).data("r-id");

    swal({
        title: 'Confirm Delete',
        text: "Are you sure you want to permanently delete this resume?",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a453',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            get_white_rice().then(function (rice) {
                $.ajax({
                    type: "POST",
                    dataType: 'JSON',
                    url: base_url+'job_seeker/resume/delete',
                    data: {r_id: id, white_rice_token: rice},
                    cache: false,
                    beforeSend: function () {
                        // $("#login-loader").show();
                    },
                    success: function (data) {
                        heads_up_info('Your record deleted succesfully');
                        location.reload();
                        // $('#'+section+'-'+rec_id).remove();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        heads_up_error();
                        // $(this).attr('disabled', false);
                    }
                });

            }).catch(function () {
                HoldOn.close();
                heads_up_warning('Failed to connect server. Please try again or contact support');
            })
        }
    });

});


function resume_status_switch(that) {
    var is_active_check = $(that).is(":checked") ? 1 : 0;

    get_white_rice().then(function (rice) {
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: base_url+'job_seeker/job_seeker_resume/job_seeker_set_resume_status',
            data: {is_active: is_active_check, resume_id: $(that).attr('id'), white_rice_token:rice},
            cache: false,
            beforeSend: function () {
                HoldOn.open(loader_options);
            },
            success: function (data) {
                HoldOn.close();
                heads_up_done('Your change is saved!');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
                $(that).prop( "checked", !is_active_check );

            }
        });
    }).catch(function () {
        HoldOn.close();
        heads_up_warning('Failed to connect server. Please try again or contact support');
    });
}

function job_post_status_switch(that) {
    var is_active_check = $(that).is(":checked") ? 1 : 0;

    get_white_rice().then(function (rice) {
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: base_url+'employer/job_posts/set_status',
            data: {is_active: is_active_check, post_id: $(that).attr('id'), white_rice_token:rice},
            cache: false,
            beforeSend: function () {
                HoldOn.open(loader_options);
            },
            success: function (data) {
                HoldOn.close();
                heads_up_done('Your change is saved!');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
                $(that).prop( "checked", !is_active_check );

            }
        });
    }).catch(function () {
        HoldOn.close();
        heads_up_warning('Failed to connect server. Please try again or contact support');
    });
}

$('.border-title a').click(function () {
    operation = 1;
});

function add_resume_item(that) {
    var form_id = $(that).closest('.form-resume-add-item').attr('id');
    var formData = $("#"+form_id).serialize();


    $('#'+form_id + ' input[type=checkbox]').each(function() {
        if (!this.checked) {
            formData += '&'+this.name+'=no';
        }
    });

    get_white_rice().then(function (rice) {
        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: base_url+'job_seeker/resume/add_info',
            data: formData + '&resume_id='+resume_id + '&form_id='+form_id +'&rec_id='+rec_id+'&operation='+ operation +'&white_rice_token='+rice,
            cache: false,
            beforeSend: function () {
                HoldOn.open(loader_options);
            },
            success: function (data) {
                HoldOn.close();
                heads_up_success('Added Successfully!');
                $(this).attr('disabled', false);
                $('.modal-popup-area').fadeOut('fast');
                $("#"+form_id)[0].reset();
                $('#exp-to-date').prop("disabled", false);
                $('html').removeClass('no-scroll');
                $("."+form_id).remove();
                $("#"+form_id+"-sec").prepend(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
                $(this).attr('disabled', false);
            }
        });
    }).catch(function () {
        HoldOn.close();
        heads_up_warning('Failed to connect server. Please try again or contact support');
    });
}
function save_resume_about(that) {

    var form_id = $(that).closest('.form-resume-add-item').attr('id');
    var formData = $("#"+form_id).serialize();

    get_white_rice().then(function (rice) {
        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: base_url+'job_seeker/resume/add_about',
            data: formData + '&resume_id='+resume_id + '&form_id='+form_id +'&white_rice_token='+rice,
            cache: false,
            beforeSend: function () {
                HoldOn.open(loader_options);
            },
            success: function (data) {
                HoldOn.close();
                heads_up_success('Added Successfully!');
                $(this).attr('disabled', false);
                $('.modal-popup-area').fadeOut('fast');
                $('#about-des p').text($("#abt_des").val());
                $('html').removeClass('no-scroll');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                HoldOn.close()
                heads_up_error();
                $(this).attr('disabled', false);
            }
        });
    }).catch(function () {
        HoldOn.close();
        heads_up_warning('Failed to connect server. Please try again or contact support');
    });
}

function edit_resume_item(that) {
    operation = 2;
    rec_id = $(that).data("id");
    var section = $(that).data("section");
    $("form#"+section)[0].reset();

    get_white_rice().then(function (rice) {
        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: base_url+'job_seeker/resume/edit_resume_item',
            data: {rec_id: rec_id, section: section, white_rice_token: rice},
            cache: false,
            beforeSend: function () {
                HoldOn.open(loader_options);
            },
            success: function (data) {
                HoldOn.close();
                show_edit_modal(that);
                $.each(data, function (index, value) {
                    $('input[type="text"][name="'+index+'"]').val(value);
                    $('input[type="hidden"][name="'+index+'"]').val(value);
                    $('input[type="date"][name="'+index+'"]').val(value);
                    $('input[type="number"][name="'+index+'"]').val(value);
                    $('input[type="range"][name="'+index+'"]').val(value);
                    $('textarea[name="'+index+'"]').text(value);
                    $('select[name="'+index+'"]').val(value).trigger("change");
                    $('input:radio[name="'+index+'"][value="'+value+'"]').prop("checked",true).trigger("change");
                    $('input:checkbox[name="'+index+'"][value="'+value+'"]').prop("checked", true).trigger("change");
                    $('.'+index).trigger("click");
                })
            },
            error: function (jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
                $(this).attr('disabled', false);
            }
        });
    }).catch(function () {
        HoldOn.close();
        heads_up_warning('Failed to connect server. Please try again or contact support');
    })

}

function delete_resume_item(that) {

    var rec_id = $(that).data("id");
    var section = $(that).data("section");

    swal({
        // title: 'Are you sure?',
        text: "Are you sure?",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a453',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            get_white_rice().then(function (rice) {
                $.ajax({
                    type: "POST",
                    dataType: 'JSON',
                    url: base_url+'job_seeker/resume/del_res_section_item',
                    data: {rec_id: rec_id, section: section, white_rice_token: rice},
                    cache: false,
                    beforeSend: function () {
                        // $("#login-loader").show();
                    },
                    success: function (data) {
                        heads_up_info('Your record deleted succesfully');
                        $('#'+section+'-'+rec_id).remove();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        heads_up_error();
                        $(this).attr('disabled', false);
                    }
                });
            }).catch(function () {
                HoldOn.close();
                heads_up_warning('Failed to connect server. Please try again or contact support');
            })
        }
    });
}

$('.del-res-file').click(function (e) {

    let id = $('#btn-del-res-file').data('r-id');

    swal(swal_confirm_send).then((result) => {
        if(result.value){
            delete_resume_file(id);
        }
    });
});

function delete_resume_file(e) {
    get_white_rice().then(function (rice) {
        let id = e;
        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: base_url+'job_seeker/resume/delete_resume_file',
            data: {r_id: id, white_rice_token: rice},
            cache: false,
            beforeSend: function () {
                HoldOn.open(loader_options);
            },
            success: function (data) {
                if (data.code === 1){
                    HoldOn.close();
                    heads_up_success(data.message);
                    setTimeout(function(){ location.reload()},1000);
                }
                else if(data){
                    HoldOn.close();
                    heads_up_error(data.message);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
            }
        });
    }).catch(function () {
        HoldOn.close();
        heads_up_warning('Failed to connect server. Please try again or contact support');
    })
}

/*Cover Letters*/


//Save cover letter
$('#add-new-cover-letter').click(function () {
    operation = 1;
});

$('.btn-save-cl').on('click', function (e) {
    // var cl_text = $('#js-cover-letter-editor').trumbowyg('html').toString();
    // formData = $('#add-cover-letter').serialize();

    var fdata = new FormData($("#add-cover-letter")[0]);

    get_white_rice().then(function (rice) {
        var rice = rice;

        if (operation===2)
            fdata.append('cl_id', $(e.target).data("cl-id"));
        fdata.append('operation', operation);
        fdata.append('white_rice_token', rice);


        $.ajax({
            type: "POST",
            dataType: 'HTML',
            url: base_url+'job_seeker/job_seeker_cover_letter/add_cover_letter',
            data: fdata,
            cache: false,
            contentType: false,
            processData:false,
            beforeSend: function () {
                HoldOn.open(loader_options)
            },
            success: function (data) {
                HoldOn.close();
                heads_up_success('Resume created successfully.<br>Please add the your details in the next view!<br><strong><i>Duly filled resumes gives you more opportunities.<i></strong>');
                location.reload();

            },
            error: function (jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
            }
        });
    }).catch(function () {
        HoldOn.close();
        heads_up_warning('Failed to connect server. Please try again or contact support');
    })

});


//Edit cover letter


$('.cl-edit').on('click', function (e) {
    operation = 2;

	$('#cl_file_name').text("");
	$('.cl_link').attr("href", "");
	$('.cl-file').attr("id", "");

    $('#add-new-cover-letter-popup-box form')[0].reset();
    var rec_id = $(e.target).data("cl-id");

    get_white_rice().then(function (rice) {
        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: base_url+'job_seeker/cover_letter/edit',
            data: {cl_id: rec_id, white_rice_token:rice},
            cache: false,
            beforeSend: function () {
                HoldOn.open(loader_options);
            },
            success: function (data) {
                HoldOn.close();
                $('.btn-save-cl').data('cl-id', data['cover_letter_id']);
                $('#add-new-cover-letter-popup-box').fadeIn('fast');
                $('html').addClass('no-scroll');

				$.each(data, function (index, value) {
					$('input[type="text"][name="' + index + '"]').val(value);
					$('select[name="' + index + '"]').val(value).trigger("chosen:updated");
					var letter_content = data['cover_letter_content'].toString();
					$('#cover_letter_content').trumbowyg('html', letter_content);
				});
                if(data['attachment_url'] !== null){
                    $('#cl_file_name').text(data['attachment_url']);
                    $('.cl_link').attr("href", data['dir']+data['attachment_url']);
                    $('.cl-file').attr("id", data['cover_letter_id']).show();
					$('#attch').show();

                }
                else{
                	$('#attch').hide();
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                HoldOn.close()
                heads_up_error();
                $(this).attr('disabled', false);
            }
        });
    }).catch(function () {
        HoldOn.close();
        heads_up_warning('Failed to connect server. Please try again or contact support');
    })
});

//Delete Cover Leteer
$('.del-cl').on("click", function (e) {
    var id = $(e.target).data("cl-id");

    swal({
        title: 'Confirm Delete',
        text: "Are you sure you want to permanently delete this cover letter?",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a453',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            get_white_rice().then(function (rice) {
                $.ajax({
                    type: "POST",
                    dataType: 'JSON',
                    url: base_url+'job_seeker/cover_letter/delete',
                    data: {cl_id: id, white_rice_token: rice},
                    cache: false,
                    beforeSend: function () {
                        // $("#login-loader").show();
                    },
                    success: function (data) {
                        heads_up_info('Your record deleted succesfully');
                        location.reload();
                        // $('#'+section+'-'+rec_id).remove();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        heads_up_error();
                        // $(this).attr('disabled', false);
                    }
                });
            }).catch(function () {
                HoldOn.close();
                heads_up_warning('Failed to connect server. Please try again or contact support');
            })
        }
    });

});



$('.del-cl-file').click(function (e) {

    let id = $(e.target).closest("div").attr("id");
    swal(swal_confirm_send).then((result) => {
        if(result.value){
            delete_cover_file(id);
        }
    });
});

function delete_cover_file(e) {
    get_white_rice().then(function (rice) {
        let id = e;
        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: base_url+'job_seeker/cover_letter/delete_cover_file',
            data: {cl_id: id, white_rice_token: rice},
            cache: false,
            beforeSend: function () {
                HoldOn.open(loader_options);
            },
            success: function (data) {
                if (data.code === 1){
                    HoldOn.close();
                    heads_up_success(data.message);
                    setTimeout(function(){ location.reload()},1000);
                }
                else if(data){
                    HoldOn.close();
                    heads_up_error(data.message);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
            }
        });
    }).catch(function () {
        HoldOn.close();
        heads_up_warning('Failed to connect server. Please try again or contact support');
    })
}


/*  Employer  */

//Employer Profile

$('.emp-profile-save').on("click", function (e) {
    get_white_rice().then(function (rice) {
        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: base_url+'employer/account/profile/update',
            data: $('#employer-profile').serialize()+'&white_rice_token='+rice,
            cache: false,
            beforeSend: function () {
                // $("#login-loader").show();
            },
            success: function (data) {
                heads_up_success('Added Successfully!');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                heads_up_error();
            }
        });
    }).catch(function () {
        HoldOn.close();
        heads_up_warning('Failed to connect server. Please try again or contact support');
    });
});


//Add new user


$("#new_user").bootstrapValidator({
    live: 'enabled',
    message: 'This value is not valid.',
    excluded: [':disabled'],
	fields: {
		emp_first_name: {
			validators: {
				notEmpty: {message: '<i class="fas fa-times-circle"></i> First name is required'}
			},
		},
		emp_last_name: {
			validators: {
				notEmpty: {message: '<i class="fas fa-times-circle"></i> Last name is required'}
			},
		},
		email: {
			validators: {
				notEmpty: {message: '<i class="fas fa-times-circle"></i> Email is required'},
				emailAddress: {message: '<i class="fas fa-times-circle"></i> Please enter a valid email address'}
			},
		},
		confirm_email: {
			validators: {
				notEmpty: {
					message: '<i class="fas fa-times-circle"></i> Please retype email'
				},
				identical: {
					field: 'su_email',
					message: '<i class="fas fa-times-circle"></i> Your emails doesn\'t match',
				},
			},
		},
		password: {
			validators: {
				notEmpty: {
					message: '<i class="fas fa-exclamation-circle"></i> Please enter a strong password <br>'
				},
				stringLength: {
					min: 8,
					message: '<i class="fas fa-exclamation-circle"></i>The password must have at least 8 characters <br>'
				}
			},
		},
		confirm_password: {
			validators: {
				notEmpty: {
					message: '<i class="fas fa-exclamation-circle"></i> Please retype your password here'
				},
				identical: {
					field: 'password',
					message: '<i class="fas fa-times-circle"></i> Your passwords doesn\'t match'
				},
			},
		},
	},
}).bootstrapValidator()
    .on('success.form.bv', function (e) {
        e.preventDefault();
        add_user();
    });

function add_user() {
    HoldOn.open(loader_options);
    get_white_rice().then(function (value) {
        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: base_url+'employer/account/manage_users/add_new',
            data: $('#new_user').serialize()+'&white_rice_token='+value,
            cache: false,
            beforeSend: function () {
                // $("#login-loader").show();
            },
            success: function (data) {
                HoldOn.close();
                heads_up_success('Added Successfully!');
                $('#add-new-user-popup-box').fadeOut('fast');
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error(jqXHR.responseJSON.message);
            }
        });
    }).catch(function (err) {
        HoldOn.close();
        heads_up_warning()
    })
}

// $('.add-new-user').on("click", function (e) {
//     get_white_rice().then(function (rice) {
//         $.ajax({
//             type: "POST",
//             dataType: 'JSON',
//             url: base_url+'employer/account/manage_users/add_new',
//             data: $('#new_user').serialize()+'&white_rice_token='+rice,
//             cache: false,
//             beforeSend: function () {
//                 // $("#login-loader").show();
//             },
//             success: function (data) {
//                 heads_up_success('Added Successfully!');
//                 location.reload();
//             },
//             error: function (jqXHR, textStatus, errorThrown) {
//                 heads_up_error(jqXHR.responseJSON.message);
//             }
//         });
//
//     }).catch(function () {
//         HoldOn.close();
//         heads_up_warning('Failed to connect server. Please try again or contact support');
//     })
//
// });


function emp_user_status_switch(that) {
    var is_active_check = $(that).is(":checked") ? 1 : 0;

    get_white_rice().then(function (rice) {
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: base_url+'employer/account/manage_users/change_user_access',
            data: {is_active: is_active_check, user_id: $(that).attr('id'), white_rice_token:rice},
            cache: false,
            beforeSend: function () {

            },
            success: function (data) {
				let uname = $(that).closest('tr').find('.table-list-title h3 a').html();
				if (is_active_check){
					heads_up_info('  ong>'+uname +'</strong>\'s account is <strong>Activated</strong>');
				}else{
					heads_up_info('<strong>'+uname +'</strong>\'s account is <strong>Deactivated</strong>');
				}

            },
            error: function (jqXHR, textStatus, errorThrown) {
                heads_up_error();
                $(that).prop( "checked", !is_active_check );
            }
        });
    }).catch(function () {
        HoldOn.close();
        heads_up_warning('Failed to connect server. Please try again or contact support');
    })
}


//job application
$("#job_apply_form").bootstrapValidator({
    live: 'enabled',
    message: 'This value is not valid.',
    excluded: [':disabled'],
    fields: {
        applied_resume: {validators: {notEmpty: {message: '<i class="fas fa-exclamation-circle"></i> Please select a resume'}}},
    },
}).bootstrapValidator()
    .on('success.form.bv', function (e) {
        e.preventDefault();
        swal(swal_confirm_send).then((result) => {
            if (result.value) {
                apply_job()
            }
        })
    });
function apply_job(){
    get_white_rice().then(function (rice) {
        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: base_url+'job_seeker/application/send_application',
            data: $("#job_apply_form").serialize() + '&white_rice_token=' + rice,
            cache: false,
            beforeSend: function () {
                HoldOn.open(loader_options);
            },
            success: function (data) {
                HoldOn.close();
                heads_up_success('Congratulations! Your application has been send successfully');
                $('.modal-popup-area').fadeOut('fast');
                $('html').removeClass('no-scroll');

                // $('#'+section+'-'+rec_id).remove();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_warning(jqXHR.responseJSON.message);
            }
        });
    }).catch(function (error) {
        heads_up_warning('Failed to connect server. Please try again or contact support')

    })
}

//withdraw_application
$('.withdraw-application').click(function (e) {
    withdraw_application(e)
});

function withdraw_application(e){
    swal(swal_confirm_send).then((result) => {
        if (result.value){
            get_white_rice().then(function (value) {
                var apl_id  = e.target.dataset.apl_id;

                $.ajax({
                    type: "POST",
                    dataType: 'JSON',
                    url: base_url+'job_seeker/application/withdraw_application',
                    data: {apl_id: apl_id, white_rice_token: value},
                    cache: false,
                    beforeSend: function () {
                        HoldOn.open(loader_options);
                    },
                    success: function (data) {
                        HoldOn.close();
                        heads_up_success('Application withdrawn successfully');

                        var lbl_wd = '<span class="application-status withdrawn" id="apl-id-' + apl_id + '"> Withdrawn </span>';
                        $('#ap-id-'+apl_id+' .application-status-tag').empty().append(lbl_wd);

                        var action_btn = '<li><span>Re-Apply</span><a class="reapply-application" data-apl_id="' + apl_id + '" title=""><i class="fas fa-share-square" data-apl_id="' + apl_id + '"></i></a></li>';
                        $('#apl-id-act-'+apl_id+'').empty().append(action_btn).click(function (e) {
                            reapply(e);
                        });

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        HoldOn.close();
                        heads_up_warning(jqXHR.responseJSON.message);
                    },
                });
            }).catch(function (err) {
                HoldOn.close();
                heads_up_warning();
            })
        }
    })
}

//reapply_application

$('.reapply-application').click(function (e) {
    reapply(e);
});

function reapply(e){
    swal(swal_confirm_send).then((result) => {
        if (result.value){
            get_white_rice().then(function (value) {
                var apl_id  = e.target.dataset.apl_id;

                $.ajax({
                    type: "POST",
                    dataType: 'JSON',
                    url: base_url+'job_seeker/application/re_apply',
                    data: {apl_id: apl_id, white_rice_token: value},
                    cache: false,
                    beforeSend: function () {
                        HoldOn.open(loader_options);
                    },
                    success: function (data) {
                        HoldOn.close();
                        heads_up_success('Application withdrawn successfully');
                        var lbl_wd = '<span class="application-status reapplied" id="apl-id-' + apl_id + '"> Re-Applied </span>';
                        $('#ap-id-'+apl_id+' .application-status-tag').empty().append(lbl_wd);

                        var action_btn = '<li><span>Withdraw Application</span><a class="reapply-application" data-apl_id="' + apl_id + '" title=""><i class="fas fa-undo" data-apl_id="' + apl_id + '"></i></a></li>';
                        $('#apl-id-act-'+apl_id+'').empty().append(action_btn).click(function (e) {
                            withdraw_application(e);
                        });
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        HoldOn.close();
                        heads_up_warning(jqXHR.responseJSON.message);
                    }
                });
            }).catch(function (err) {
                HoldOn.close();
                heads_up_warning()
            })
        }
    })
}

// $('#subscribe-job-alert-btn').click(function () {
//     subscribe_job_alert();
// })

$('#job_alert_subs_form').bootstrapValidator({
    live: 'enabled',
    message: 'This value is not valid.',
    excluded: [':disabled'],
    fields: {
        'tags[]': {
            validators: {
                notEmpty: {message: 'Please least a keyword'}}
        },
        subs_frequency: {
            validators: {
                notEmpty: {message: 'Please select frequency'}}
        },
        // email: {
        //     validators: {
        //         notEmpty: {message: '*** Email is required'}},
        //     emailAddress: {message: 'Please enter a valid email address'}
        // },
        subs_name: {
            validators: {
                notEmpty: {message: 'Name is required'}}
        },
    },
}).bootstrapValidator()
    .on('success.form.bv', function (e) {
        e.preventDefault();
        subscribe_job_alert();
    });


function subscribe_job_alert() {
    get_white_rice().then(function (value) {
        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: base_url+'job_seeker/job_alerts/subscribe',
            data: $('#job_alert_subs_form').serialize() + '&white_rice_token=' + value,
            cache: false,
            beforeSend: function () {
                HoldOn.open(loader_options);
            },
            success: function (data) {

                if (data.code === 1){
                    HoldOn.close();
                    $('.modal-popup-area').fadeOut('fast');
                    $('html').removeClass('no-scroll');
                    heads_up_success('Subscribed successfully');
                    let a = window.location.pathname;
                    debugger
                    if(a.includes('/job_seeker/job_alerts'))
                    	location.reload();
                }
                else{
                    HoldOn.close();
                    $('.modal-popup-area').fadeOut('fast');
                    $('html').removeClass('no-scroll');
                    heads_up_warning(data.message);
                    $('#subscribe-job-alert-btn').attr('disabled', false);
                }


            },
            error: function (jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_warning();
                $('#subscribe-job-alert-btn').attr('disabled', false);
            }
        });

    }).catch(function (err) {
        HoldOn.close();
        heads_up_error();
        $('#subscribe-job-alert-btn').attr('disabled', false);
    })
}

$('.del-job-post').click(function (e) {

    swal(swal_confirm_send).then((result) => {
        if (result.value) {
            delete_draft_post(e);
        }
    });
});

function delete_draft_post(e){

    let id = $(e.target).closest('tr')[0].id;

    get_white_rice().then(function (value) {
        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: base_url+'employer/job_posts/drafts/delete',
            data: {jp_id: id, white_rice_token: value},
            cache: false,
            beforeSend: function () {
                HoldOn.open(loader_options);
            },
            success: function (data) {

                if (data.code === 1){
                    HoldOn.close();
                    heads_up_success(''+ data.message);
                    $(e.target).closest('tr').remove();
                }
                else{
                    HoldOn.close();
                    heads_up_warning(data.message);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
            }
        });

    }).catch(function (err) {
        HoldOn.close();
        heads_up_error();
    })
}


$('.del-post-file').click(function (e) {

    let id = $('#btn-del-post-file').data('post-id');
    swal(swal_confirm_send).then((result) => {
        if(result.value){
            delete_post_file(id);
        }
    });
});

function delete_post_file(e) {
    get_white_rice().then(function (rice) {
        let id = e;
        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: base_url+'employer/job_posts/edit/delete_image',
            data: {p_id: id, white_rice_token: rice},
            cache: false,
            beforeSend: function () {
                HoldOn.open(loader_options);
            },
            success: function (data) {
                if (data.code === 1){
                    HoldOn.close();
                    heads_up_success(data.message);
                    setTimeout(function(){ location.reload()},1000);
                }
                else if(data){
                    HoldOn.close();
                    heads_up_error(data.message);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
            }
        });
    }).catch(function () {
        HoldOn.close();
        heads_up_warning('Failed to connect server. Please try again or contact support');
    })
}

$('#update-job-alert-btn').click(function () {
    get_job_alert_subscription()
})

function get_job_alert_subscription() {

    // console.log($('#edit_subscription_frequency option:selected').val());

    var formIn = $('#job_alert_subs_edit_form').serialize();

    get_white_rice().then(function (rice) {
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: base_url+'job_seeker/job_alerts/subscribe/edit',
            data: formIn+'&white_rice_token=' + rice,
            cache: false,
            beforeSend: function () {
                HoldOn.open(loader_options);
            },
            success: function (data) {
                heads_up_done('Your change is saved!');
                HoldOn.close();
                setTimeout(function () { location.reload() },1000);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                heads_up_error();
                HoldOn.close();

            }
        });
    }).catch(function () {
        HoldOn.close();
        heads_up_warning('Failed to connect server. Please try again or contact support');
    });
}

$('.un_sub_job_alert').click(function () {

    swal(swal_confirm_send).then((result) => {
        if (result.value) {
            let id = $(this.closest('ul')).data('alert-id');
            get_white_rice().then(function (rice) {
                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    url: base_url+'job_seeker/job_alerts/un_subscribe',
                    data: {ja_i:id, white_rice_token: rice},
                    cache: false,
                    beforeSend: function () {
                        HoldOn.open(loader_options);
                    },
                    success: function (data) {
                        heads_up_done('Your change is saved!');
                        HoldOn.close();
                        setTimeout(function () { location.reload() },1000);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        heads_up_error();
                        HoldOn.close();

                    }
                });
            }).catch(function () {
                HoldOn.close();
                heads_up_warning('Failed to connect server. Please try again or contact support');
            });
        }
    });
})

//Save favorite Job
$(".save-fav-job").click(function(event){
	event.preventDefault();
	let fav_job = $(event.target).closest('div').data("jp-token");
	let chosen_post = this;
	get_white_rice().then(function (value) {
		$.ajax({
			type: "POST",
			dataType: 'JSON',
			url: base_url+'job_seeker/find_jobs/save_this_job',
			data: {jp_token: fav_job, white_rice_token: value},
			cache: false,
			success: function (data) {
				if (data.res) {
					// heads_up_success('Added Successfully!');
					$(chosen_post).toggleClass('active');
					$(chosen_post).children().toggleClass('far').toggleClass('fas');
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				heads_up_error(jqXHR.responseJSON.message);
			}
		});
	}).catch(function (err) {
		HoldOn.close();
		heads_up_warning()
	});
});

$(".saved-job").click(function(event){
	event.preventDefault();
	let fav_job = $(event.target).closest('div').data("jp-token");
	let chosen_post = this;
	debugger;

	get_white_rice().then(function (value) {
		$.ajax({
			type: "POST",
			dataType: 'JSON',
			url: base_url+'job_seeker/find_jobs/save_this_job',
			data: {jp_token: fav_job, white_rice_token: value},
			cache: false,
			success: function (data) {
				location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown) {
				heads_up_error(jqXHR.responseJSON.message);
			}
		});
	}).catch(function (err) {
		HoldOn.close();
		heads_up_warning()
	});
});


$("#set-dflt-res").click(function () {
	let sel_res = $('#pro_res_select').val();
	swal(swal_confirm_default).then((result) => {
		if (result.value) {
			HoldOn.open(loader_options);
			get_white_rice().then(function (value) {
				$.ajax({
					type: "POST",
					dataType: 'JSON',
					url: base_url+'job_seeker/resume/set_default',
					data: {res_id: sel_res, white_rice_token: value},
					cache: false,
					beforeSend: () => {
						HoldOn.open(loader_options);
					},
					success: function (data) {
						HoldOn.close();
						location.reload();
					},
					error: function (jqXHR, textStatus, errorThrown) {
						HoldOn.close();
						heads_up_error(jqXHR.responseJSON.message);
					}
				});
			}).catch(function (err) {
				HoldOn.close();
				heads_up_warning()
			});
		}
	});
});
