var ad_crop = null;
$(document).ready(function () {
	let ad_height = 50;
	let ad_width = 50;
	let cropper = $('#ad-image-cropper');

	$('#ad-size-selector').change(function (e) {
		if(ad_crop)
			ad_crop.croppie('destroy');
		cropper.fadeOut();

		let selected_option = $(this).find('option:selected');
		ad_height = selected_option.data("adv_height");
		ad_width = selected_option.data("adv_width");
		$('#ad-image').val('').trigger('change');

		if(!selected_option.val()) {
			$('#selected-size').fadeOut();
			$('#adv-file-upload').fadeOut();
		}
		else {
			$('#selected-size').html('Image size: ' + ad_width + ' x ' + ad_height).fadeIn();
			$('#adv-file-upload').fadeIn();
		}

		let cropper_options = {
			enableExif: true,
			viewport: {
				width: ad_width,
				height: ad_height,
				type: 'square'
			},
			enableResize: false,
			enforceBoundary: true,
			boundary: {
				width: ad_width + 50,
				height: ad_height + 50
			},
		};

		ad_crop = cropper.croppie(cropper_options);
		$('#new_adv_form').bootstrapValidator('enableFieldValidators', 'adv_poster', true)
	});

	$('#ad-image').on('input', function (e) {
		$('#'+e.target.id).on('change', function () {
			if (e.target.value){
				var reader = new FileReader();
				reader.onload = function (event) {
					ad_crop.croppie('bind', {
						url: event.target.result, zoom: 0
					}).then(function () {
						$('#ad-image-cropper').fadeIn();
						ad_crop.croppie('bind');
						console.log('jQuery bind complete');
					});
				}
				reader.readAsDataURL(this.files[0]);
				$('#'+e.target.id).val('');
			}
		});
	});


	var form_val = $("#new_adv_form").bootstrapValidator({
		live: 'enabled',
		message: 'This value is not valid.',
		excluded: [':disabled'],
		fields: {
			adv_name: {
				validators: {
					notEmpty: {message: '* Required'}}
			},
			adv_client: {
				validators: {
					notEmpty: {message: '* Required'}},
					greaterThan: {
						inclusive: false,
						value: 0,
						message: '* Please select the client from the list or Click (+) to add new client',
				},
			},
			adv_activate: {
				validators: {
					notEmpty: {message: '* Required'}}
			},
			adv_expiry: {
				validators: {
					notEmpty: {message: '* Required'}}
			},
			adv_banner_type: {
				validators: {
					notEmpty: {message: '* Required'}}
			},
			adv_banner_location: {
				validators: {
					notEmpty: {message: '* Required'}}
			},
			adv_url: {
				validators: {
					uri: {message: '*The website address is not valid'}
				}
			},
			adv_poster: {
				enabled: false,
				validators: {
					notEmpty: {message: '* Ad image is required'},
					extension: 'jpeg,jpg,png',
					type: 'image/jpeg,image/jpg,image/png',
					message: 'The selected file is not valid'
				}
			}
		}
	}).bootstrapValidator()
		.on('success.form.bv', function (e) {
			e.preventDefault();
			swal(swal_confirm_send).then((result) => {
				if(result.value){
					if (edit_check)
						save_adv_edit();
					else
						save_adv();
				}
				else {
					$('#save_post').attr('disabled', false);
					return false;
				}
			});
		});

	function save_adv() {
		var formObj = new FormData($("#new_adv_form")[0]);

		get_white_rice().then(function (rice) {
			// var rice = rice;
			formObj.append('white_rice_token', rice);

			ad_crop.croppie('result', {
				type: 'canvas',
				size: 'viewport'
			}).then(function (response) {
				formObj.append('adv_image', response);
				$.ajax({
					url: base_url+"superuser/ads/new/save",
					dataType: 'JSON',
					type: "POST",
					data: formObj,
					processData:false,
					cache: false,
					contentType: false,
					beforeSend: function () {
						HoldOn.open(loader_options);
					},
					success: function (data) {
						HoldOn.close();
						if (data.code === 1){
							HoldOn.close();
							heads_up_success(data.message);
							$("#new_adv_form")[0].reset();
						}
						else{
							HoldOn.close();
							heads_up_error(data.message);
							$('#save_post').attr('disabled', false);
						}
					},
					error: function (jqXHR, textStatus, errorThrown) {
						HoldOn.close();
						heads_up_error();
						$('#save_post').attr('disabled', false);
					}
				});
			})
		}).catch( function () {
			HoldOn.close();
			heads_up_error();
		})
	}

	function save_adv_edit() {
		var formObj = new FormData($("#new_adv_form")[0]);

		get_white_rice().then(function (rice) {
			// var rice = rice;
			formObj.append('white_rice_token', rice);

			ad_crop.croppie('result', {
				type: 'canvas',
				size: 'viewport'
			}).then(function (response) {
				formObj.append('adv_image', response);
				$.ajax({
					url: base_url + "superuser/ads/edit/save",
					dataType: 'JSON',
					type: "POST",
					data: formObj,
					processData: false,
					cache: false,
					contentType: false,
					beforeSend: function () {
						HoldOn.open(loader_options);
					},
					success: function (data) {
						HoldOn.close();
						if (data.code === 1) {
							HoldOn.close();
							heads_up_success(data.message);
							$("#new_adv_form")[0].reset();
						} else {
							HoldOn.close();
							heads_up_error();
							$('#save_post').attr('disabled', false);
						}
					},
					error: function (jqXHR, textStatus, errorThrown) {
						HoldOn.close();
						heads_up_error();
						$('#save_post').attr('disabled', false);
					}
				});
			})
		}).catch( function () {
			HoldOn.close();
			heads_up_error();
		})
	}

	$('select').trigger('change');

	get_image_to_edit();

	var options = {

		url: function(phrase) {

			if (phrase !== "" && phrase.length > 2) {
				return base_url+"api/companies_list?phrase="+phrase;
			}
		},

		getValue: 'company_name',

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
			},

			onChooseEvent: function() {
				let value = $("#search_client").getSelectedItemData().id;
				$("#adv_company_id").val(value);
				form_val.bootstrapValidator('revalidateField', 'adv_client');
			}
		},

		listLocation: "company_list",

		matchResponseProperty: "inputPhrase",

		// preparePostData: function(data) {
		//     data.phrase = $("#job_kw_search_home").val();
		//     return data;
		// },

		requestDelay: 400,
	};

	$("#search_client").easyAutocomplete(options);

	$('#add_new_company').click(function () {
		$('#new_company').fadeIn('fast');
		$("form#add_new_company")[0].reset();
		$('html').addClass('no-scroll');
	});

	$("#add_new_company_form").bootstrapValidator({
		live: 'enabled',
		message: 'This value is not valid.',
		excluded: [':disabled'],
		fields: {
			company_name: {
				validators: {
					notEmpty: {message: '* Required'}}
			},
			company_contact_person: {
				validators: {
					notEmpty: {message: '* Required'}}
			},
			company_contact_no: {
				validators: {
					notEmpty: {message: '* Required'}}
			},
			company_contact_email: {
				validators: {
					notEmpty: {message: '* Required'},
					emailAddress: {message: '*Email address is not valid'}
				}
			},
			company_city: {
				validators: {
					notEmpty: {message: '* Required'}}
			},
			company_country: {
				validators: {
					notEmpty: {message: '* Required'}}
			},
		},
	}).bootstrapValidator()
		.on('success.form.bv', function (e) {
			e.preventDefault();
			swal(swal_confirm_send).then((result) => {
				if(result.value){
					create_new_client()
				}
				else {
					return false;
				}
			});
		});

	function create_new_client() {
		var formObj = new FormData($("#add_new_company_form")[0]);

		get_white_rice().then(function (rice) {
			// var rice = rice;
			formObj.append('white_rice_token', rice);
			$.ajax({
				url: base_url+"superuser/ads/add_new_client",
				dataType: 'JSON',
				type: "POST",
				data: formObj,
				processData:false,
				cache: false,
				contentType: false,
				beforeSend: function () {
					HoldOn.open(loader_options);
				},
				success: function (data) {
					HoldOn.close();
					if (data.code === 1){
						HoldOn.close();
						heads_up_success(data.message);
						$("#add_new_company_form")[0].reset();
					}
					else{
						HoldOn.close();
						heads_up_error();
						$('#save_company').attr('disabled', false);
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					HoldOn.close();
					heads_up_error();
					$('#save_company').attr('disabled', false);
				}
			});
		}).catch( function () {
			HoldOn.close();
		})
	}


	function get_image_to_edit() {
		let file_url = $('#file_path').val();
		let cropper_options = {
			enableExif: true,
			viewport: {
				width: ad_width,
				height: ad_height,
				type: 'square'
			},
			enableResize: false,
			// enforceBoundary: true,
			boundary: {
				width: ad_width + 50,
				height: ad_height + 50
			},
		};

		if(ad_crop)
			ad_crop.croppie('destroy');

		if (file_url) {
			ad_crop = cropper.croppie(cropper_options);
			ad_crop.croppie('bind', {url: file_url, zoom: 0 });
			cropper.fadeIn();
		}
	}
});


