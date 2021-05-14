var tnx_no = null;

$(document).ready(function () {


	$(function () {
		const odr_url = new URL(window.location);
		const show_modal = odr_url.searchParams.get('submit');
		if(show_modal == 'yes'){
			$('#attach_submit_button').trigger('click');
		}
	});

	const payment_info = {
		cash: '<div class="card border-info mb-3">\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="card-body">\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<p class="font-weight-bold">Pay by Cash Instructions</p>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<p class="t">Some quick example text to build on the card title and make up the bulk of the card\'s content.</p>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>',
		cheque: '<div class="card border-info mb-3">\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="card-body">\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<p class="font-weight-bold">Pay by Cheque Instructions</p>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<p class="t">Some quick example text to build on the card title and make up the bulk of the card\'s content.</p>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>',
		bank: '<div class="card border-info mb-3">\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="card-body">\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<p class="font-weight-bold">Pay by Bank Transfer Instructions</p>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<p class="t">Some quick example text to build on the card title and make up the bulk of the card\'s content.</p>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>'

	};

	const pay_mode = {
		online: '<div id="pay-online" class="">\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<hr>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="row">\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="col-md-12">\n' +
			'<!--\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span>Pay by:</span>-->\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="alert alert-info" role="alert">\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<h6 class="alert-heading">Coming soon!</h6>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<p class="radio-label">\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tWe are working hard to make things convenient for you. Online payments are on the way!\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</p>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>',
		offline: '<div class="alert alert-warning radio-label mt-2" role="alert">\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<strong>Info:</strong> Offline payments are processed manually. ' +
			'Your package will be activated after your payments is verified by our agents.\n' +
			'<br><br>Upon completing your purchase, please make your payment and submit your payment proof in purchase history' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>' +
			'<hr>' +
			'<div id="pay-offline" class="">\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="row">\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="col-md-12">\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="mb-2"><span>Pay by :</span></div>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="pb-2 pl-4">\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type="radio" name="payment_type"\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t   value="cash"\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t   id="cash">\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label class="filter-label radio-label"\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t   for="cash">Cash</label>\n' +
			'\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type="radio" name="payment_type"\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t   value="cheque" id="cheque">\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label class="filter-label radio-label"\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t   for="cheque">Cheque</label>\n' +
			'\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type="radio" name="payment_type"\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t   value="bank"\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t   id="bank_transfer">\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label class="filter-label radio-label"\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t   for="bank_transfer">Bank Transfer</label><br>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>' +
			'<div class="mt-2" id="payment-info">\n' +
			'\n' +
			'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>'
	};

	$('input[type=radio][name=payment_mode]').change(function () {
		if (this.value === 'online'){
			const pay_form = $(pay_mode.online);
			$('.payment-window').empty().append(pay_form).hide().fadeIn();
			$('.pay-btn').prop('disabled', true);
		} else if (this.value === 'offline') {
			$('.pay-btn').prop('disabled', false);
			const pay_form = $(pay_mode.offline)
				.on('change',
					'input[type=radio][name=payment_type]',
					function (event) {
						const pay_by = event.target.value;
						if (pay_by === 'cash') {
							$('#payment-info').empty().append(payment_info.cash).hide().fadeIn();
						} else if (pay_by === 'cheque') {
							$('#payment-info').empty().append(payment_info.cheque).hide().fadeIn();
						} else if (pay_by === 'bank') {
							$('#payment-info').empty().append(payment_info.bank).hide().fadeIn();
						}
					});
			$('.payment-window').html('').append(pay_form).hide().fadeIn();
			//adding validator
			$('#billing-info').bootstrapValidator('addField', 'payment_type');
		}
		// (this.value === 'online') ? $('.pay-btn').prop('disabled', true) : $('.pay-btn').prop('disabled', false);
	});

	$('#billing-info').bootstrapValidator({
		live: 'enabled',
		message: '<i class="fas fa-times-circle"></i>This value is not valid.',
		excluded: [':disabled'],
		fields: {
			employer_name: {
				validators: {
					notEmpty: {message: '<i class="fas fa-times-circle"></i>Company Name is Required'}
				}
			},
			billing_email: {
				validators: {
					notEmpty: {message: '<i class="fas fa-times-circle"></i> Email is required'},
					emailAddress: {message: '<i class="fas fa-times-circle"></i> Please enter a valid email address'}
				},
			},
			billing_name: {
				validators: {
					notEmpty: {message: '<i class="fas fa-times-circle"></i> Correspondent\'s name is required'}
				},
			},
			contact_phone_number: {
				validators: {
					notEmpty: {message: '<i class="fas fa-times-circle"></i> Contact no is Required<br>'},
				},
			},
			payment_mode: {
				trigger: 'change',
				validators: {
					notEmpty: {message: '<i class="fas fa-times-circle"></i> Please select a payment mode'}
				},
			},
			payment_type: {
				validators: {
					notEmpty: {message: '<i class="fas fa-times-circle"></i> Please select a payment type'}
				},
			},
		},
	}).bootstrapValidator()
		.on('success.form.bv', function (e) {
			e.preventDefault();
			make_order();
		});

	//
	$('#pay-btn2').on('click',function () {
		$("#offline").attr('checked', 'checked');
		$("#cash").attr('checked', 'checked');

		make_order2();


	});


	function make_order2() {


		HoldOn.open(loader_options);
		get_white_rice().then(function (value) {
			$.ajax({
				type: "POST",
				dataType: 'JSON',
				url: base_url+'employer/subscription/plans/place_order2',
				data: $('#billing-info').serialize() + '&white_rice_token=' + value,
				cache: false,
				beforeSend: function () {
					HoldOn.open(loader_options);
				},
				success: function (data) {
					if (data.code === 1) {
						HoldOn.close();
						$('.modal-popup-area').fadeOut('fast');
						$('html').removeClass('no-scroll');
						heads_up_success(data.message || 'Order Success');
						if (data.go_to){
							window.location.replace(data.go_to);
						}
					}
					else {
						HoldOn.close();
						$('.modal-popup-area').fadeOut('fast');
						$('html').removeClass('no-scroll');
						let m;
						// (m = data.message) ? heads_up_warning(m) : heads_up_warning();
						$('#pay-btn').attr('disabled', false);
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {

					HoldOn.close();
					let m;
					(m = jqXHR.responseJSON.message) ? heads_up_info(m) : heads_up_warning();
					$('#pay-btn').attr('disabled', false);
				}
			});
		}).catch(function (err) {
			HoldOn.close();
			heads_up_error(token_error);
			$('#pay-btn').attr('disabled', false);
		})
	}

	function make_order() {


		HoldOn.open(loader_options);
		get_white_rice().then(function (value) {
			$.ajax({
				type: "POST",
				dataType: 'JSON',
				url: base_url+'employer/subscription/plans/place_order',
				data: $('#billing-info').serialize() + '&white_rice_token=' + value,
				cache: false,
				beforeSend: function () {
					HoldOn.open(loader_options);
				},
				success: function (data) {
					if (data.code === 1) {
						HoldOn.close();
						$('.modal-popup-area').fadeOut('fast');
						$('html').removeClass('no-scroll');
						heads_up_success(data.message || 'Order Success');
						if (data.go_to){
							window.location.replace(data.go_to);
						}
					}
					else {
						HoldOn.close();
						$('.modal-popup-area').fadeOut('fast');
						$('html').removeClass('no-scroll');
						let m;
						// (m = data.message) ? heads_up_warning(m) : heads_up_warning();
						$('#pay-btn').attr('disabled', false);
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					HoldOn.close();
					let m;
					// (m = jqXHR.responseJSON.message) ? heads_up_info(m) : heads_up_warning();
					$('#pay-btn').attr('disabled', false);
				}
			});
		}).catch(function (err) {
			HoldOn.close();
			heads_up_error(token_error);
			$('#pay-btn').attr('disabled', false);
		})
	}

	$('#pay_proof_form').bootstrapValidator({
		live: 'enabled',
		message: '<i class="fas fa-times-circle"></i>This value is not valid.',
		excluded: [':disabled', ':hidden', ':not(:visible)'],
		fields: {
			payment_type: {
				validators: {
					notEmpty: {message: '<i class="fas fa-times-circle"></i> Please select a payment type'}
				},
			},
			reference_id: {
				validators: {
					notEmpty: {message: '<i class="fas fa-times-circle"></i>This field is required'}
				}
			},
			cheque_no: {
				validators: {
					notEmpty: {message: '<i class="fas fa-times-circle"></i> Cheque number is required'},
				},
			},
			amount: {
				validators: {
					notEmpty: {message: '<i class="fas fa-times-circle"></i> Amount is required'},
					step: {
						step: 0.01,
						message: '<i class="fas fa-times-circle"></i> Up to two decimal points only allowed'},
					numeric: {message: '<i class="fas fa-times-circle"></i> Must be numeric value'},
					callback: {
						message: '<i class="fas fa-times-circle"></i> Value must be greater than zero <br>',
						callback: (value, validator, $field) => {
							return value > 0;
						},
					},
				},
			},
			proof_file: {
				validators: {
					notEmpty: {message: '<i class="fas fa-times-circle"></i> Proof attachment is required'},
					file: {
						extension: 'jpeg,png,jpg,pdf',
						type: 'image/jpeg,image/png,application/pdf',
						maxSize: 2048 * 1024,
						message: 'The selected file is not valid'
					}
				}
			}
		},
	}).bootstrapValidator()
		.on('success.form.bv', function (e) {
			e.preventDefault();
		 submitPaymentProof();
		});

	$('#submithFreebtn').on('click',function () {
		// submitPaymentProof();==same but OnClick Code 0.00
		HoldOn.open(loader_options);
		let fdata = new FormData($("#pay_proof_form")[0]);
		fdata.append('ono', $('#order_no').data("ono"));
		get_white_rice().then(function (value) {
			fdata.append('white_rice_token', value);
			$.ajax({
				type: "POST",
				dataType: 'JSON',
				url: base_url+'employer/transactions/process_payment/pay_offline2',
				data: fdata,
				cache: false,
				contentType: false,
				processData:false,
				beforeSend: function () {
					HoldOn.open(loader_options);
				},
				success: function (data) {
					if (data.code === 1 && data.tnx_no) {
						tnx_no = data.tnx_no;
						HoldOn.close();
						upload_files();
						// $('#submit_pay_proof').attr('disabled', false);
					}
					else {
						HoldOn.close();
						$('.modal-popup-area').fadeOut('fast');
						$('html').removeClass('no-scroll');
						let m;
						// (m = data.message) ? heads_up_warning(m) : heads_up_warning();
						$('#submit_pay_proof').attr('disabled', false);
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					HoldOn.close();
					let m;
					(m = jqXHR.responseJSON.message) ? heads_up_info(m) : heads_up_warning();
					$('#submit_pay_proof').attr('disabled', false);
				}
			});
		}).catch(function (err) {
			HoldOn.close();
			heads_up_error(token_error);
			$('#submit_pay_proof').attr('disabled', false);
		})
	});

	function submitPaymentProof() {
		HoldOn.open(loader_options);
		let fdata = new FormData($("#pay_proof_form")[0]);
		fdata.append('ono', $('#order_no').data("ono"));
		get_white_rice().then(function (value) {
			fdata.append('white_rice_token', value);
			$.ajax({
				type: "POST",
				dataType: 'JSON',
				url: base_url+'employer/transactions/process_payment/pay_offline',
				data: fdata,
				cache: false,
				contentType: false,
				processData:false,
				beforeSend: function () {
					HoldOn.open(loader_options);
				},
				success: function (data) {
					if (data.code === 1 && data.tnx_no) {
						tnx_no = data.tnx_no;
						HoldOn.close();
						upload_files();
						// $('#submit_pay_proof').attr('disabled', false);
					}
					else {
						HoldOn.close();
						$('.modal-popup-area').fadeOut('fast');
						$('html').removeClass('no-scroll');
						let m;
						// (m = data.message) ? heads_up_warning(m) : heads_up_warning();
						$('#submit_pay_proof').attr('disabled', false);
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					HoldOn.close();
					let m;
					// (m = jqXHR.responseJSON.message) ? heads_up_info(m) : heads_up_warning();
					$('#submit_pay_proof').attr('disabled', false);
				}
			});
		}).catch(function (err) {
			HoldOn.close();
			heads_up_error(token_error);
			$('#submit_pay_proof').attr('disabled', false);
		})
	}

	function upload_files(){
		// evt.preventDefault();
		$('#payment_proof_attachment').dmUploader('start');
		$('.file-progress').fadeIn('fast');
	}

	$('input[type=radio][name=payment_type]').change(
		function (e) {
			const pay_by = e.target.value;
			$('.pay_proof_form').fadeOut('fast').prop('disabled', true);
			$('.pay_proof_form input').prop('disabled', true);
			$('.'+pay_by+'-pay-proof').fadeIn('fast').attr('disabled', 'disabled');
			$('.'+pay_by+'-pay-proof input').fadeIn('fast').removeAttr('disabled');
		}
	);

	var uploader =
		$('#payment_proof_attachment').dmUploader({ //
			queue: true,
			url: base_url + 'employer/transactions/submit_proof',
			maxFileSize: 3000000, // 3 Megs max
			extFilter: ["pdf", "jpg", "jpeg", "png"],
			fieldName: 'tnx_proof_file',
			auto: false,
			multiple: true,

			extraData: function () {
				return {
					"white_rice_token": get_rice(),
					"tnx_id": tnx_no,
					"ono": $('#order_no').data("ono")
				};
			},
			onDragEnter: function () {
				// Happens when dragging something over the DnD area
				this.addClass('active');
			},
			onDragLeave: function () {
				// Happens when dragging something OUT of the DnD area
				this.removeClass('active');
			},
			onComplete: function () {
				// All files in the queue are processed (success or error)
				// ui_add_log('All pending tranfers finished');
				HoldOn.close();
				heads_up_success('Uploading completed');
				$('.file-remove').hide();
				location.reload();
			},
			onNewFile: function (id, file) {
				// When a new file is added using the file selector or the DnD area
				$('#files').fadeIn('fast');
				ui_multi_add_file_custom(id, file);
				$('#upload_file').fadeIn('fast');
			},
			onBeforeUpload: function (id) {
				HoldOn.open(loader_options);
				// about tho start uploading a file
				ui_multi_update_file_status(id, 'uploading', 'Uploading...');
				ui_multi_update_file_progress(id, 0, '', true);
			},
			onUploadProgress: function (id, percent) {
				// Updating file progress
				ui_multi_update_file_progress(id, percent);
			},
			onUploadSuccess: function (id, data) {
				// A file was successfully uploaded
				// console.log('Server Response for file #' + id + ': ' + JSON.stringify(data));
				ui_multi_update_file_status(id, 'success', 'Upload Complete');
				ui_multi_update_file_progress(id, 100, 'success', false);
			},
			onUploadError: function (id, xhr, status, message) {
				ui_multi_update_file_status(id, 'danger', message);
				ui_multi_update_file_progress(id, 0, 'danger', false);
			},
			onUploadComplete: function (id, data) {
			},
			onFallbackMode: function () {
				// When the browser doesn't support this plugin :(
				console.log('Plugin cant be used here, running Fallback callback', 'danger');
			},
			onFileSizeError: function (file) {
				heads_up_warning('File \'' + file.name + '\' cannot be added: size excess limit', 'danger');
			},
			onFileExtError: function (file) {
				heads_up_info("Only PDFs or Images are allowed");
			}
		});

});

function revoke_transaction(that) {
	swal(swal_confirm_send).then((result) => {
		if (result.value) {
			HoldOn.open(loader_options);
			get_white_rice().then(function (value) {
				$.ajax({
					type: "POST",
					dataType: 'JSON',
					url: base_url + 'employer/transactions/revoke',
					data: {id: $(that).data('t_id'), white_rice_token: value},
					cache: false,
					beforeSend: function () {
						HoldOn.open(loader_options);
					},
					success: function (data) {
						if (data.code === 1) {
							HoldOn.close();
							location.reload();
						} else {
							HoldOn.close();
							let m;
							(m = data.message) ? heads_up_warning(m) : heads_up_warning();
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
				heads_up_error(token_error);
			})
		}
	});
}

function show_payment_proof_form(that) {
	const pay_type = that.dataset.payType;
	$("form#pay_proof_form")[0].reset();
	$('#'+pay_type).prop("checked", true).trigger('change');
	$("#payment_proof_file_input").val(null).trigger('change');
	$('#upload_file').fadeOut('fast');
	$('li.media').fadeOut('fast');
	$('#files').fadeOut('fast');
	$('#payment_proof_modal').fadeIn('fast');
	$('html').addClass('no-scroll');
}

$(function(){
	/*
	  Global controls
	*/
	$('#btnApiCancel').on('click', function(evt){
		evt.preventDefault();
		$('#payment_proof_attachment').dmUploader('cancel');
	});
});


