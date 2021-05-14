$(document).ready(function () {

    $(".chosen-list").chosen({
        // disable_search: false,
        disable_search_threshold: 10,
        no_results_text: "Oops, nothing found!",
        width: "95%"
    });

    $(".select2-custom").select2({
		minimumResultsForSearch: 10,
		allowClear: true,
		placeholder: "Choose option"
	});

    $(".select2-data-attributes").select2({
		minimumResultsForSearch: 10,
	});

    $("form input").bind("keypress", function (e) {
        if (e.keyCode == 13) {
            //add more buttons here
            return false;
        }
    });


	$('.date-time-picker').datetimepicker({
		useCurrent: false,
		icons: {
			time: "far fa-clock",
			date: "far fa-calendar-alt",
			up: "fas fa-angle-up",
			down: "fas fa-angle-down",
			clear: 'fas fa-trash-alt',
		},
		// sideBySide: true,
		format:  "DD/MM/YYYY, h:mm:ss a",
		buttons: {showClear: true}
	});

	$('.date-picker').datetimepicker({
		useCurrent: false,
		icons: {
			time: "far fa-clock",
			date: "far fa-calendar-alt",
			up: "fas fa-angle-up",
			down: "fas fa-angle-down",
			clear: 'fas fa-trash-alt',
		},
		format: moment.HTML5_FMT.DATE,
		buttons: {
			showClear: true
		},
	});


	$('.date-picker-min-disabled').datetimepicker({
		useCurrent: false,
		minDate: moment().format("YYYY-MM-DD"),
		icons: {
			time: "far fa-clock",
			date: "far fa-calendar-alt",
			up: "fas fa-angle-up",
			down: "fas fa-angle-down",
			clear: 'fas fa-trash-alt',
		},
		format: "YYYY-MM-DD",
		buttons: {
			showClear: true
		}
	});

	$('.time-picker').datetimepicker({
		useCurrent: false,
		icons: {
			time: "far fa-clock",
			date: "far fa-calendar-alt",
			up: "fas fa-angle-up",
			down: "fas fa-angle-down",
			clear: 'fas fa-trash-alt',
		},
		// sideBySide: true,
		format: moment.HTML5_FMT.TIME,
		buttons: {showClear: true}
	});

    rangeSlider();

    $('#cover_letter_content').trumbowyg({
        resetCss: true,
        btns: [
            // ['viewHTML'],
            ['undo', 'redo'], // Only supported in Blink browsers
            ['formatting'],
            ['strong', 'em', 'underline','del',],
            // ['superscript', 'subscript'],
            // ['link'],
            // ['insertImage'],
            ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
            // ['unorderedList', 'orderedList'],
            // ['horizontalRule'],
            ['removeformat'],
            ['fullscreen']
        ],
        tagsToRemove: ['script', 'link']
    });

    $('#new_job_post_description').trumbowyg({
        resetCss: true,
        btns: [
            // ['viewHTML'],
            ['undo', 'redo'], // Only supported in Blink browsers
            ['formatting'],
            ['strong', 'em', 'underline','del',],
            // ['superscript', 'subscript'],
            ['link'],
            ['insertImage'],
            ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
            ['unorderedList', 'orderedList'],
            ['horizontalRule'],
            ['removeformat'],
            ['fullscreen']
        ],
        tagsToRemove: ['script', 'link'],
        tagsToKeep: ['i'],
        urlProtocol: true
    });


    $(document).keyup(function(e) {
        if (e.key === "Escape") {
            $('.cus-trigger').trigger("onchange");
            $($('.account-popup-area:visible, .coverletter-popup').get().reverse()[0]).fadeOut('fast');
            $('html').removeClass('no-scroll');
        }
    });

    $('input[type=file]').change(function (e) {
        if (e.target.files.length) {
            var fileName = e.target.files[0].name;
            $('.selected-file').text(fileName);
        }
        else
            $('.selected-file').text('No files chosen');
    });

    var tab = location.hash;
    if (tab === "#nav-basic-tab"){
		$("#nav-basic-tab").trigger("click");
	}
    if (tab === "#nav-pro-tab"){
		$("#nav-pro-tab").trigger("click");
	}

    // show_front_page_poup_one_time();
});

$(document).ajaxError(function (jqXHR, textStatus, errorThrown) {
	if (textStatus.status && textStatus.status == 401) {
		heads_up_error(textStatus.responseJSON.message);
		if (textStatus.responseJSON.re_url) {
			let url_log = base_url + textStatus.responseJSON.re_url;
			window.location.href = url_log;
		}
	}
});



$(".profile-tab").click(function (e) {
	let frag = window.location.hash;
	location.hash = $(this).data('tab');
});

$(document).ajaxSend(function (event, request, settings) {
	let req_url = settings.url.split("?")[0];
	gtag('event', req_url , {
		'event_category': 'XHR',
		'event_label': 'AJAX Calls',
		'value': 1
	});
});

$(".country-search").select2({
    width: '100%',
    placeholder: 'Country or region',
    allowClear: true
}).val(null).trigger("change");

//Cookies
$(".one-time-popup").click(function () {
    document.cookie = "popup_showed=1";
});

function show_front_page_poup_one_time() {

    let get_pop_up_status = check_cookie_name('popup_showed') ;

    if (!get_pop_up_status){
        $('#front-page-popup').fadeIn('fast');
        $('html').addClass('no-scroll');
    }
}

function create_ad_cookie(ad_name){
    var now = new Date();
    var time = now.getTime();
    var expireTime = time + 1000*36000;
    now.setTime(expireTime);
    document.cookie = ""+ad_name+"=1;expires="+now+";";
}

function check_cookie_name(name)
{
    var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    if (match) {
        return(match[2]);
    }
}

$('#change-dp').click(function () {
	$(".account-popup").removeClass("center-popup");
	$("#image_crop").removeClass("cover-crop-img mb-4 pb-5");
	$('.dp-image-upload').trigger('click');
	$('#cropper_title').html('Upload Profile Picture');
	$('.image-size-note').html('Minimum resolution: 500 x 500 and Suitable files are .jpg &amp; .png');
});

//Profile Cropper
var pro_image_cropper;
$('.dp-image-upload').on('input', function (e) {
	if (pro_image_cropper){
		pro_image_cropper.croppie('destroy');
	}
	pro_image_cropper = $('#image_crop').croppie({
		// enableExif: true,
		viewport: {
			width: 250,
			height: 250,
			type: 'square' //circle
		},
		customClass: 'custom-con',
		enableResize: false,
		enforceBoundary: false,
		boundary: {
			width: 300,
			height: 300
		},
	});

	$('#'+e.target.id).on('change', function () {
		var reader = new FileReader();
		reader.onload = function (event) {
			pro_image_cropper.croppie('bind', {
				url: event.target.result
			}).then(function () {
			});
		}
		reader.readAsDataURL(this.files[0]);
		$('#uploadimageModal').fadeIn('fast');
		$('html').addClass('no-scroll');
		$('#'+e.target.id).val('');
	});

	$('.crop_image').click(function (event) {
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
				save_dp(e.target.id);
			}
		})
	});
});

//Cropper Cover Photo

$('#change-cover').click(function () {
	$(".account-popup").addClass("center-popup");
	$("#image_crop").addClass("cover-crop-img mb-4 pb-5");
	$('.cover-image-upload').trigger('click');
	$('#cropper_title').html('Upload Cover Picture');
	$('.image-size-note').html('Minimum resolution: Width: 1600 x Height: 800 and Suitable files are .jpg &amp; .png');
});

$('.cover-image-upload').on('input', function (e) {
	if (pro_image_cropper){
		pro_image_cropper.croppie('destroy');
	}
	let cover_width = $('#image_crop').width();
	let cover_height = $('#image_crop').height();

    pro_image_cropper = $('#image_crop').croppie({
        // enableExif: true,
        viewport: {
            width: cover_width,
            height: cover_height,
            type: 'square' //circle
        },
        customClass: 'custom-con',
        enableResize: false,
        enforceBoundary: true,
        boundary: {
            width: cover_width + 50,
            height: cover_height + 50,
        },

    });

    $('#'+e.target.id).on('change', function () {
        var reader = new FileReader();
        reader.onload = function (event) {
            pro_image_cropper.croppie('bind', {
                url: event.target.result, zoom: 0
            }).then(function () {
            });
        }
        reader.readAsDataURL(this.files[0]);
        $('#uploadimageModal').fadeIn('fast');
        $('html').addClass('no-scroll');
        $('#'+e.target.id).val('');
    });

    $('.crop_image').click(function (event) {
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
                save_cover();
            }
        })
    });
});

function save_dp($id) {
    var url=null;
    if($id==='js_pro_pic'){
        url='job_seeker/profile/upload_dp';
    }
    else if($id==='emp_logo'){
        url='employer/account/profile/upload_logo';
    }

    HoldOn.open(loader_options);

    get_white_rice().then(function (rice) {
        pro_image_cropper.croppie('result', {
            type: 'canvas',
            size: {width: 500},
        }).then(function (response) {
            $.ajax({
                url: base_url+url,
                type: "POST",
                data: {"image": response, "white_rice_token":rice},
                success: function (data) {
                    $('#uploadimageModal').fadeOut('fast');
                    $('html').removeClass('no-scroll');
                    $('#uploaded_image_view').attr('src', data).delay(200).fadeIn();
                    HoldOn.close();
                    heads_up_success("Your picture has been uploaded successfully");
                },
                error: function (jqXHR, textStatus, errorThrown) {
					HoldOn.close();
                	heads_up_error();
                }
            });
        })
    }).catch( function () {
        HoldOn.close();
    })

}
function save_cover() {
    let url='employer/account/profile/upload_cover';

    HoldOn.open(loader_options);

    get_white_rice().then(function (rice) {
        pro_image_cropper.croppie('result', {
            type: 'canvas',
            size: {width: 1600, height: 800},
        }).then(function (response) {
            $.ajax({
                url: base_url+url,
                type: "POST",
                data: {"image": response, "white_rice_token":rice},
                success: function (data) {
                    $('#uploadimageModal').fadeOut('fast');
                    $('html').removeClass('no-scroll');
                    // $('#cover_image_view').attr('src', data);
                    $('#cover_image_view').css({'background':'linear-gradient(0deg,#1f1f1f,rgba(119, 119, 119, 0.36)), url(' + data + ')'}).delay(200).fadeIn();
                    HoldOn.close();
                    heads_up_success("Your picture has been uploaded successfully");
                },
                error: function (jqXHR, textStatus, errorThrown) {
					HoldOn.close();
                    heads_up_error();
                }
            });
        })
    }).catch( function () {
        HoldOn.close();
    })

}

$('.remove-image').click((e) => {
	let img_type = e.target.dataset.imgType;
	swal(swal_confirm_send).then((result) => {
		if (result.value) {
			get_white_rice().then(function (value) {
				$.ajax({
					type: "POST",
					dataType: 'JSON',
					url: base_url+'employer/account/profile/delete_image',
					data: { image_type: img_type, white_rice_token: value },
					cache: false,
					beforeSend: function () {
						HoldOn.open(loader_options);
					},
					success: function (data) {
						if (data.code === 1){
							HoldOn.close();
							if (img_type === "cover")
								$('#cover_image_view').css({'background':'linear-gradient(0deg,#1f1f1f,rgba(119, 119, 119, 0.36))'});
							else if(img_type === "logo")
								$('#uploaded_image_view').attr("src", "");
						}
						else{
							HoldOn.close();
							let m;
							(m = data.message) ? heads_up_info(m) : heads_up_warning();
						}
					},
					error: function (jqXHR, textStatus, errorThrown) {
						HoldOn.close();
						let m;
						(m = jqXHR.responseJSON.message) ? heads_up_info(m) : heads_up_warning();
					}
				});

			}).catch(function (err) {
				HoldOn.close();
				heads_up_error();
			})
		}
	});
});

function disable_to_date(that, id) {
    var is_active_check = $(that).is(":checked") ? 1 : 0;
    $('#'+id).prop("disabled", is_active_check);
    if (is_active_check) {
        $('.'+id).val('').fadeOut();
    }
    else {
        $('.'+id).fadeIn();
    }
}

function lang_level(that) {
    var id = $(that).attr("id");
    var is_active_check = $('#'+id).is(":checked") ? 1 : 0;
    $('.'+id).prop("disabled", !is_active_check);
    // $('.'+id+'-section').fadeToggle("fast");

    if (is_active_check) {
        $('.'+id+'-section').fadeIn("fast");
    }
    else {
        $('.'+id+'-section').fadeOut("fast");
    }
}

//range slider
var rangeSlider = function(){
    var slider = $('.range-slider'),
        range = $('.range-slider__range'),
        value = $('.range-slider__value');

    slider.each(function(){

        value.each(function(){
            var range_value = $(this).prev().attr('value');
            $(this).html(range_value);

            $('input[type="range"]').on('input',function () {
                var val = ($(this).val() - $(this).attr('min')) / ($(this).attr('max') - $(this).attr('min'));

                $(this).css('background-image',
                    '-webkit-gradient(linear, left top, right top, '
                    + 'color-stop(' + val + ', #f76618), '
                    + 'color-stop(' + val + ', #d7dcdf)'
                    + ')'
                );
            });
        });

        range.on('input', function(){
            $(this).next(value).html(this.value);
        });
    });
};




//Custom Modal

$('.add-new').on('click', function (e) {
    switch (e.target.id) {
        case "add-new-cover-letter":
            $('#add-new-cover-letter-popup-box').fadeIn('fast');
            $('html').addClass('no-scroll');
            $('#add-cover-letter')[0].reset();
            $('#cover_letter_content').trumbowyg('empty');
            break;
        case "add-new-resume":
            $('#add-new-resume-popup-box').fadeIn('fast');
            $('html').addClass('no-scroll');
            break;
        case "add-new-user":
            $('#add-new-user-popup-box form')[0].reset();
            $('#add-new-user-popup-box').fadeIn('fast');
            $('html').addClass('no-scroll');
            break;
        case "add-new-btn":
            $('#add-new-popup-box form')[0].reset();
            $('#add-new-popup-box').fadeIn('fast');
            $('html').addClass('no-scroll');
            break;
        case "add-new-job-alert":
            $('#job-alert-subs-box').fadeIn('fast');
            $('html').addClass('no-scroll');
            break;
        case "add-new-content":
            $('#add-new-content-popup-box').fadeIn('fast');
			$('html').addClass('no-scroll');
			$('#new_industry_form')[0].reset();
            $('html').addClass('no-scroll');
            break;
    }
});

$('form').on('reset', function() {
	$("input[type='hidden']", $(this)).each(function() {
		var $t = $(this);
		$t.val('');
	});

	$('select').val('').trigger('change');
});

function show_modal(that) {
    $('.cus-trigger').trigger("onchange");
    let modal_id = $(that).data("section");
    $('#' + modal_id+'-modal').fadeIn('fast');

    $("form#"+modal_id)[0].reset();
    $('html').addClass('no-scroll');

    if (modal_id === 'about'){
    	$("#abt_des").text(($('#about-des p').text()));
	}
    return false;
}

function show_edit_modal(that) {

    // var rec_id = $(that).data("id");
    var section = $(that).data("section");

    $('#' + section+'-modal').fadeIn('fast');
    $('html').addClass('no-scroll');
    return false;
}

$('.close-popup').on('click', function () {
    $('.cus-trigger').trigger("onchange");
    // $('.modal-popup-area').fadeOut('fast');
    $(this).parents('.modal-popup-area').fadeOut('fast');
    $('html').removeClass('no-scroll');
});

$('.close-popup-cus').on('click', function () {
    $('.cus-trigger').trigger("onchange");
    $('.modal-popup-area').fadeOut('fast');
    $('html').removeClass('no-scroll');
});



//White Rice TikTok

function get_white_rice() {
    return new Promise( function (resolve, reject) {
        return resolve(white_rice());
    });
}

function white_rice() {
    return $.ajax({
        async: true,
        type: "GET",
        dataType: 'JSON',
        url: base_url + 'rice_cookie',
        cache: false,
        success: function (data) {
            return data;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Failed to get token, integrity mismatch');
            return 'Action is not allowed, Please contact support';
        }
    });
}

function get_rice() {
    var white_rice_cookie=null;
    $.ajax({
        async: false,
        type: "GET",
        dataType: 'JSON',
        url: base_url+'rice_cookie',
        cache: false,
        success: function (data) {
            white_rice_cookie = data;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Failed to get white rice, integrity mismatch');
            return '';
        }
    });
    return white_rice_cookie;
}

//White Rice TikTok ends

//Apply job

var js_cl;
$('#apply-job-btn').click(function (e) {

	$('#cover_data').hide();
	$('#lang-skill-sec').hide();
    var check = new Promise(function (resolve, reject) {
        HoldOn.open(loader_options);
        $('#resume-date-info, #cover-letter-date-info, #cover-letter-application-editor').fadeOut();

        resolve(check_current_login_status());
        // reject(check_current_login_status());
    });
    check.then(function (value) {
        if(value==='true' || value===true){
            $.ajax({
                // async: false,
                type: "GET",
                dataType: 'JSON',
                url: base_url+'job_seeker/application/get_resumes',
                cache: true,
                beforeSend: function(){
                },
                success: function (data) {
                    HoldOn.close();
                    js_cl = data;
                    $('#cover_letter_to_apply, #resume_to_apply').empty().append('<option selected value="">Please select a resume...</option>');

                    $.each(data.current_js_resume, function (index, value) {
                        var js_option = '<option value="'+value.resume_id+'">'+value.resume_name+'</option>';
                        $('#resume_to_apply').append(js_option);
                    });

                    $.each(data.current_js_cover_letter, function (index, value) {
                        var js_option = '<option value="'+value.cover_letter_id+'">'+value.cover_letter_name+'</option>';
                        $('#cover_letter_to_apply').append(js_option);
                    });

                    $('#job_apply_form')[0].reset();
                    $('#cover_letter_to_apply, #resume_to_apply').trigger("chosen:updated");
                    $('.apply-job-modal').fadeIn('fast'); $('html').addClass('no-scroll');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    HoldOn.close();
                }
            });


        }
        else if (value==='false' || value===false) {
            heads_up_info("You must login to apply for this job. Please login");
            $('.signin-popup-box').fadeIn('fast'); $('html').addClass('no-scroll');
        }
        else{
            heads_up_error();
        }
    })
});

$('#apply-cover_letter_content').trumbowyg({
    resetCss: true,
    btns: [
        // ['viewHTML'],
        ['undo', 'redo'], // Only supported in Blink browsers
        ['formatting'],
        ['strong', 'em', 'underline','del',],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['removeformat'],
        ['fullscreen']
    ],
    tagsToRemove: ['script', 'link']
});

$('#resume_to_apply').change(function (e) {
    let r_id = e.target.value;
    if(r_id){
        let add_d = js_cl.current_js_resume.find(function(element) {return element.resume_id === r_id}).inserted_date;
        let upd_d = js_cl.current_js_resume.find(function(element) {return element.resume_id === r_id}).updated_date;
        $('#rs-add-date').text((add_d !== null) ? moment(add_d) .format("DD MMM YYYY @ HH:mm") : '');
        $('#rs-upd-date').text((upd_d !== null) ? moment(upd_d) .format("DD MMM YYYY @ HH:mm") : 'Not updated yet');
        $('#resume-date-info').fadeIn();
    }
    else{
        $('#resume-date-info').fadeOut();
    }

});

$('#cover_letter_to_apply').change(function (e) {

	$('#cover_data').empty().prepend("");
    let c_id = e.target.value;
    if (c_id){
        let add_d = js_cl.current_js_cover_letter.find(function(element) {return element.cover_letter_id === c_id}).inserted_date;
        let upd_d = js_cl.current_js_cover_letter.find(function(element) {return element.cover_letter_id === c_id}).updated_date;
        $('#cl-add-date').text((add_d !== null) ? moment(add_d) .format("DD MMM YYYY @ HH:mm") : '');
        $('#cl-upd-date').text((upd_d !== null) ? moment(upd_d) .format("DD MMM YYYY @ HH:mm") : 'Not updated yet');

        $.ajax({
            type: "GET",
            data:{cl_uid: c_id},
            dataType: 'JSON',
            url: base_url+'job_seeker/application/get_selected_cover_letter',
            cache: true,
            beforeSend: function(){
                HoldOn.open(loader_options);
            },
            success: function (data) {
            	HoldOn.close();
                $('#apply-cover_letter_content').trumbowyg('html', data[0].cover_letter_content);
                if(data[0].attachment_url!=null) {
					var html = '<p class="mb-0" style=" font-size: 12px;">File Name : <span id="cl_file_name">' + data[0].attachment_url + '</span></p>' +
						'<a class="btn btn-success float-left m-2 col-1 cl_link" href=' + data[1] + data[0].attachment_url + ' target="_blank">View</a>';
					$('#cover_data').empty().prepend(html);
				}


            },
            error: function (jqXHR, textStatus, errorThrown) {
            	 HoldOn.close();
                heads_up_error();
            }
        });

        $('#cover-letter-date-info').fadeIn();
    }
    else{
        $('#cover-letter-date-info').fadeOut();
    }


});


$('#preview-resume-button').click(function () {

    let ru_id = $('#resume_to_apply').val();
    $.ajax({
        type: "GET",
        data:{r_id: ru_id},
        dataType: 'json',
        url: base_url+'job_seeker/application/get_selected_resume',
        cache: true,
        beforeSend: function(){
            HoldOn.open(loader_options);
        },
        success: function (data) {
            HoldOn.close();

            if(data.about.length > 0){
                $('.about').show();
                $('#abount_content').html('').html(data.about);
            }
            else{
                $('.about').hide();
            }

            if(data.work_exp.length > 0){
                $('.work-exp').show();
                $('#work-exp-sec').empty().prepend(data.work_exp);
            }
            else{
                $('.work-exp').hide();
            }

            if(data.pro_skill.length > 0){
                $('.pro-skill').show();
                $('#pro-skill-sec').empty().prepend(data.pro_skill);
            }
            else{
                $('.pro-skill').hide();
            }

            if(data.edu.length > 0){
                $('.edu').show();
                $('#edu-sec').empty().prepend(data.edu);
            }
            else{
                $('.edu').hide();
            }

            if(data.award.length > 0){
                $('.award').show();
                $('#award-sec').empty().prepend(data.award);
            }
            else{
                $('.award').hide();
            }

            if(data.lang.length > 0){
                $('.lang').show();
                $('#lang-sec').empty().prepend(data.lang);
            }
            else{
                $('.lang').hide();

            }

            if(data.resume_data.length>0){
				$('.attc').show();
				$('#lang-skill-sec').empty().prepend(data.resume_data);
			}else{
				$('.attc').hide();
			}



            $('#resume-review-modal').fadeIn('fast'); $('html').addClass('no-scroll');

        },
        error: function (jqXHR, textStatus, errorThrown) {
        	alert(jqXHR.responseText);
            HoldOn.close();
            heads_up_error();
        }
    });
});

$('#preview-cover-letter-button').click(function () {
    $('#cover-letter-application-editor').fadeIn();
    $('#cover_data').show();
});


// Employer Application
$('.open-letter').click(function (e) {
    let c_id = $(this).closest('.emply-resume-list').data("apl_id");
    let js_name = $(this).closest('.emply-resume-list').find('.emply-resume-info h3 a').text()

    $.ajax({
        type: "GET",
        data:{cl_uid: c_id},
        dataType: 'json',
        url: base_url+'employer/applications_received/view_candidate/cover_letter',
        cache: true,
        beforeSend: function(){
            HoldOn.open(loader_options);
        },
        success: function (data) {
            HoldOn.close();

				$('.cover-letter h3').text(js_name);
				$('.cover-letter-content').empty().html(data.cover_letter_content);
				$('.coverletter-popup').fadeIn();
				$('html').addClass('no-scroll');

        },
        error: function (jqXHR, textStatus, errorThrown) {
            HoldOn.close();
            heads_up_error();
        }
    });
});


$('.js-sign-up').click(function () {
    $('#job_seeker').trigger('click');
});

$('.emp-tell-us').click(function () {
    $('#employer').trigger('click');
});


//Job alerts





$('#subs_job_alert').click(function () {
    $('#job-alert-subs-box').fadeIn('fast');
    $('html').addClass('no-scroll');
    // $("#job-alert-subs-box form")[0].reset();
	$('#job_title').val("");
     $(".filter-added-tag").remove();
     subscribe_job_alerts();
});

function subscribe_job_alerts() {
    var keys = window.location.search;

    if (keys){
        $("#job_title").text("").val("");

        var url = new URL(window.location);
        var q = url.searchParams.get("q");

        if(q)
            $('#job_title').val(q).text(q);

        var type_filter = url.searchParams.get("type");
        if(type_filter)
			$('#job_type').val(type_filter).trigger("change");

        type_filter = url.searchParams.get("cat");
        if(type_filter)
			$('#job_category').val(type_filter).trigger("change");

        type_filter = url.searchParams.get("cr_lvl");
        if(type_filter)
			$('#company_industry').val(type_filter).trigger("change");
    }
}

function parse_query_string(query) {

    var vars = query.substring(1).split("&");
    var query_string = {};
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        var key = decodeURIComponent(pair[0]);
        var value = decodeURIComponent(pair[1]);
        // If first entry with this name
        if (typeof query_string[key] === "undefined") {
            query_string[key] = decodeURIComponent(value);
            // If second entry with this name
        } else if (typeof query_string[key] === "string") {
            var arr = [query_string[key], decodeURIComponent(value)];
            query_string[key] = arr;
            // If third or later entry with this name
        } else {
            query_string[key].push(decodeURIComponent(value));
        }
    }
    return query_string;
}

$('#keyword-tag').keyup(function(event) {
    if (event.which === 13) {
        if (($(this).val() != '') && ($(".tags .addedTag:contains('" + $(this).val() + "') ").length == 0 ))  {
            $('<li class="addedTag">' + $(this).val() + '<span class="tagRemove" onclick="$(this).parent().remove();">x</span><input type="hidden" value="search_key,' + $(this).val() + '" name="tags[]"></li>').insertBefore('.tags .tagAdd');
            $(this).val('');
        } else {
            $(this).val('');

        }
        return false;
    }
    else{
        $(this).focusout(function () {
            if (($(this).val() != '') && ($(".tags .addedTag:contains('" + $(this).val() + "') ").length == 0 ))  {
                $('<li class="addedTag">' + $(this).val() + '<span class="tagRemove" onclick="$(this).parent().remove();">x</span><input type="hidden" value="search_key,' + $(this).val() + '" name="tags[]"></li>').insertBefore('.tags .tagAdd');
                $(this).val('');
                $(this).focus();
            } else {
                $(this).val('');
            }
            return false;
        })
    }
});


$('.subs_job_alert').click(function (e) {
    let id = $(this.closest('ul')).data('alert-id');
    let fre = $(this.closest('ul')).data('frequency');
    let search_key = $(this.closest('ul')).data('search-key');
    let type = $(this.closest('ul')).data('job-type');
    let industry = $(this.closest('ul')).data('job-industry');
    let category = $(this.closest('ul')).data('job-category');

    $('#edit_subscription_frequency').val(fre).trigger("change");
    $('#job_type').val(type).trigger("change");
    $('#job_category').val(category).trigger("change");
    $('#company_industry').val(industry).trigger("change");
    $('#job_alert_id').val(id);
    $('#job_title').text(search_key).val(search_key);

    $('#job-alert-subs-box').fadeIn('fast');
    $('html').addClass('no-scroll');
});


/*Schedular*/


    $('#job-view-image, .view-banner-img').click(function () {
        $('#job-post-banner').fadeIn('fast');
        $('html').addClass('no-scroll');
    })


    //
    // $('.cus-trigger').trigger("onchange");
    // var modal_id = $(that).data("section");
    // $('#' + modal_id+'-modal').fadeIn('fast');
    // $("form#"+modal_id)[0].reset();
    // $('html').addClass('no-scroll');

/*model job post banner*/


//autocomplete
var options = {

    url: function(phrase) {

        if (phrase !== "" && phrase.length > 2) {
            return base_url+"api/get_job_list?phrase="+phrase;
        }
    },

    getValue: function(element) {
        return element;
    },

    ajaxSettings: {
        dataType: "json",
        method: "GET",
        data: {
            dataType: "json"
        }
    },

    list: {
        match: {
            enabled: true
        },

        maxNumberOfElements: 3,
        showAnimation: {
            type: "slide", //normal|slide|fade
            time: 200,
            callback: function() {}
        },

        hideAnimation: {
            type: "slide", //normal|slide|fade
            time: 200,
            callback: function() {}
        }
    },

    listLocation: "job_post_title",

    matchResponseProperty: "inputPhrase",

    // preparePostData: function(data) {
    //     data.phrase = $("#job_kw_search_home").val();
    //     return data;
    // },

    requestDelay: 400
};

$("#job_kw_search_home").easyAutocomplete(options);

function ads_click_counter(that) {
    // let id = $(that).data("ad_id");
    // id = "ad_c_"+id;
	//
    // let already_clicked = check_cookie_name(id);
	//
    // if (!already_clicked) {
    //     console.log(that);
    //     create_ad_cookie(id);
    // }
}

//Select Resume

$('#pro_res_select').change(function () {
	let sel_res = $(this).val();
	let cur_url = new URL(window.location);
	let cv_id =  cur_url.searchParams.get("cv_id");
	if (cv_id){
		cur_url.searchParams.set("cv_id", sel_res);
		window.history.pushState("object or string", "Title", cur_url);
		location.reload();
	}
	else{
		sel_res = base_url+'job_seeker/profile/my_profile?cv_id='+sel_res;
		$(location).attr('href', sel_res);
		window.location.href;
		location.replace(sel_res);
	}
});

