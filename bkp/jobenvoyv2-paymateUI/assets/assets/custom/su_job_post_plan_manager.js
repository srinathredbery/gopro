$(document).ready(function () {

	$('#add-new-btn').click(() => {
		$('#frm_create_new_plan input, #frm_create_new_plan select, .save-plan').prop('disabled', false);
		$('#editable-alert').empty();
	});
	
	$("#validity_period").change(function (e) {
		// Validity period selector
		var selected = e.target.value;

		let count, i;
		var text_val;

		if (selected === 'w')
			count = 4;
		else if(selected === 'm')
			count = 12;
		else if(selected === 'a')
			count = 3;

		$("#validity_for").empty().append(new Option('','',true, true)).trigger('change');

		for ( i = 1; i <= count; i++ ){
			if (selected === 'w') {
				text_val = (i === 1) ? " Week" : " Weeks";
			}
			if (selected === 'm') {
				text_val = (i === 1) ? " Month" : " Months";
			}
			if (selected === 'a') {
				text_val = (i === 1) ? " Year" : " Years";
			}
			let newOption = new Option(i+text_val, i, false, false);
			$("#validity_for").append(newOption).trigger('change');
		}
	});

	$('#frm_create_new_plan').bootstrapValidator({
		live: 'enabled',
		message: 'This value is not valid.',
		excluded: [':disabled'],
		fields: {
			plan_name: {
				validators: {
					notEmpty: {message: '<i class="fas fa-times-circle"></i> Required'}
				}
			},
			validity_period: {
				validators: {
					notEmpty: {message: '<i class="fas fa-times-circle"></i> Required'}
				}
			},
			validity_duration: {
				validators: {
					notEmpty: {message: '<i class="fas fa-times-circle"></i> Required'}
				},
			},
			effective_date: {
				validators: {
					notEmpty: {message: '<i class="fas fa-times-circle"></i> Required'},
					date: {
						format: 'YYYY-MM-DD',
						message: '<i class="fas fa-times-circle"></i> Please enter a valid date'
					},
					callback: {
						message: '<i class="fas fa-times-circle"></i> Date should be future date from now <br>',
						callback: (value, validator, $field) => {
							return moment(value).format("YYYY-MM-DD") >= moment().format("YYYY-MM-DD", new Date());
						},
					},
				},
			},
			no_of_allowed_post: {
				validators: {
					notEmpty: {message: '<i class="fas fa-times-circle"></i> Required'},
					callback: {
						message: '<i class="fas fa-times-circle"></i> No of posts must be more than 0 <br>',
						callback: (value, validator, $field) => {
							if (!Number.isInteger(+value)){
								return {
									valid: false,
									message: '<i class="fas fa-times-circle"></i> Please enter a numeric value<br>',
								}
							}
							return value > 0;
						},
					},
				},
			},
			price_currency: {
				validators: {
					notEmpty: {message: '<i class="fas fa-times-circle"></i> Required'}
				},
			},
			price_value: {
				validators: {
					notEmpty: {message: '<i class="fas fa-times-circle"></i> Required'},
					step: {
						step: 0.01,
						message: '<i class="fas fa-times-circle"></i> Up to two decimal points only allowed'
					},
					numeric: {message: '<i class="fas fa-times-circle"></i> Must be numeric value'},
					callback: {
						message: '<i class="fas fa-times-circle"></i> Value must be greater than zero <br>',
						callback: (value, validator, $field) => {
							return value > -1;
						},
					},
				},
			},
		}
	}).bootstrapValidator()
		.on('success.form.bv', function (e) {
			e.preventDefault();
			create_edit_plan();
		});

	function create_edit_plan() {
		HoldOn.open(loader_options);

		get_white_rice().then(function (value) {
			$.ajax({
				type: "POST",

				dataType: 'JSON',
				url: base_url+'superuser/job_posting_plans/manage_plans/create_new',
				data: $('#frm_create_new_plan').serialize()+'&white_rice_token='+value,
				cache: false,
				beforeSend: function () {
					HoldOn.open(loader_options);
				},
				success: function (data) {
					let m;
					if (data.code === 1) {
						HoldOn.close();
						(m = data.message) ? heads_up_success(m) : heads_up_success();
						$('#add-new-user-popup-box').fadeOut('fast');
						location.reload();
					} else {
						HoldOn.close();
						(m = data.message) ? heads_up_warning(m) : heads_up_error();
						$(".save-plan").attr('disabled', false);
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					let m;
					HoldOn.close();
					$(".save-plan").attr('disabled', false);
					if(jqXHR['status']===449) {
						m = (jqXHR['responseJSON']["message"][0]);
						(m) ? heads_up_warning(m) : heads_up_error();
					}
					else {
						heads_up_error(errorThrown+ '. Please Try again or contact support');
					}
				}
			});
		}).catch(function (err) {
			HoldOn.close();
			heads_up_warning();
			$(".save-plan").attr('disabled', false);
		})
	}
});

function edit_plan(that) {
	let r_id = that.closest('tr').dataset.rId;
	$("#frm_create_new_plan")[0].reset();
	$("#form_title").html("Edit");
	// $('input[name="su_email"], input[name="confirm_email"], input[name="password"], input[name="confirm_password"]')
	// 	.prop('disabled', true);

	get_white_rice().then(function (rice) {
		$.ajax({
			type: 'POST',
			dataType: 'JSON',
			url: base_url + 'superuser/job_posting_plans/manage_plans/get_plan',
			data: {rec_id: r_id, white_rice_token: rice},
			cache: false,
			beforeSend: ()=>{
				HoldOn.open(loader_options);
			},
			success: function (data) {
				if (data.code === 1) {
					$.each(data.ret_data, function( index, value ) {
						$('input[name="'+index+'"]').val(value);
						$('select[name="'+index+'"]').val(value).trigger('change');

					});
					if (data.editable.allowed === 1){
						$('#frm_create_new_plan input, #frm_create_new_plan select, .save-plan').prop('disabled', false);
						$('#editable-alert').empty();
					} else {
						$('#frm_create_new_plan input, #frm_create_new_plan select, .save-plan').prop('disabled', true);
						$('#editable-alert').empty().append((data.editable.message) ? data.editable.message: '');
					}
					$('#add-new-popup-box').fadeIn('fast');
					HoldOn.close();
				} else {
					HoldOn.close();
					heads_up_error();
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				HoldOn.close();
				heads_up_error();
			}
		});
	}).catch(function () {
		HoldOn.close();
		heads_up_warning(token_error);
	});
	HoldOn.close();
}

function delete_plan(that) {
	let r_id = that.closest('tr').dataset.rId;
	let pkg_id = that.closest('tr').dataset.pkgId;
	const {value: text} = swal(swal_confirm_delete_with_message)
		.then((result) => {
		if (result.value) {
			let text = result.value;
			HoldOn.open(loader_options);
			get_white_rice().then(function (rice) {
				$.ajax({
					type: 'POST',
					dataType: 'JSON',
					url: base_url + 'superuser/job_posting_plans/manage_plans/delete',
					data: {rec_id: r_id, pkg_id: pkg_id, reason: text, white_rice_token: rice},
					cache: false,
					success: function (data) {
						if (data.code === 1) {
							let uname = $(that).closest('tr').find('.table-list-title h3 a').html();
							HoldOn.close();
							heads_up_info('<strong>' + uname + '</strong>' + data.message);
							location.reload();
						} else {
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
	})
}

function plan_status_switch(that) {
	var is_active_check = $(that).is(":checked") ? 1 : 0;

	let r_id = that.closest('tr').dataset.rId;
	let pkg_id = that.closest('tr').dataset.pkgId;
	const {value: text} = swal(swal_confirm_with_message)
		.then((result) => {
			if (result.value) {
				let text = result.value;
				HoldOn.open(loader_options);
				get_white_rice().then(function (rice) {
					$.ajax({
						type: 'POST',
						dataType: 'JSON',
						url: base_url + 'superuser/job_posting_plans/manage_plans/switch',
						data: {rec_id: r_id,  pkg_id: pkg_id, is_active: is_active_check, reason: text, white_rice_token: rice},
						cache: false,
						success: function (data) {
							if (data.code === 1) {
								let uname = $(that).closest('tr').find('.table-list-title h3 a').html();
								HoldOn.close();
								heads_up_info('<strong>' + uname + '</strong>' + data.message);
							} else {
								HoldOn.close();
								heads_up_error(data.message);
								$(that).prop( "checked", !is_active_check );
							}
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
					$(that).prop( "checked", !is_active_check );
				})
			} else {
				$(that).prop( "checked", !is_active_check );
			}
		})
}

