$(document).ready(function () {

//New users
	$("#add-new-user").click(()=>{
		$("#form_title").html("Add New");
		$('input[name="su_email"], input[name="confirm_email"], input[name="password"], input[name="confirm_password"]').prop('disabled', false);
		$('input[name="user_id"]').val("");
	});

	$("#new_su_user").bootstrapValidator({
		live: 'enabled',
		message: 'This value is not valid.',
		excluded: [':disabled'],
		fields: {
			su_first_name: {
				validators: {
					notEmpty: {message: '<i class="fas fa-times-circle"></i> First name is required'}
				}
			},
			su_last_name: {
				validators: {
					notEmpty: {message: '<i class="fas fa-times-circle"></i> Last name is required'}
				}
			},
			su_email: {
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
			add_su_user();
		});

	function add_su_user() {
		HoldOn.open(loader_options);
		get_white_rice().then(function (value) {
			$.ajax({
				type: "POST",
				dataType: 'JSON',
				url: base_url+'superuser/account/manage_users/add_new',
				data: $('#new_su_user').serialize()+'&white_rice_token='+value,
				cache: false,
				beforeSend: function () {
					// $("#login-loader").show();
				},
				success: function (data) {
					if (data.code === 1) {
						HoldOn.close();
						let m;
						(m = data.message) ? heads_up_success(m) : heads_up_success();
						$('#add-new-user-popup-box').fadeOut('fast');
						location.reload();
					} else {
						HoldOn.close();
						let m;
						(m = data.message) ? heads_up_warning(m) : heads_up_error();
						$(".add-new-user").attr('disabled', false);
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					HoldOn.close();
					let m;
					(m = jqXHR['responseJSON']["message"][0]) ? heads_up_warning(m) : heads_up_error();
					$(".add-new-user").attr('disabled', false);
				}
			});
		}).catch(function (err) {
			HoldOn.close();
			heads_up_warning();
			$(".add-new-user").attr('disabled', false);
		})
	}


	//User Groups

	$('#new_user_group_form').bootstrapValidator({
		live: 'enabled',
		message: 'This value is not valid.',
		excluded: [':disabled'],
		fields: {
			user_group_name: {
				validators: {
					notEmpty: {message: 'Please enter a name'}
				}
			},
		},
	}).bootstrapValidator()
		.on('success.form.bv', function (e) {
			e.preventDefault();
			save_user_group();
		});

	function save_user_group() {
		get_white_rice().then(function (value) {
			$.ajax({
				type: "POST",
				dataType: 'JSON',
				url: base_url+'superuser/account/manage_user_groups/create_new_group',
				data: $('#new_user_group_form').serialize() + '&white_rice_token=' + value,
				cache: false,
				beforeSend: function () {
					HoldOn.open(loader_options);
				},
				success: function (data) {
					if (data.code === 1){
						HoldOn.close();
						$('.modal-popup-area').fadeOut('fast');
						$('html').removeClass('no-scroll');
						heads_up_success('Added successfully');
						location.reload();
					}
					else{
						HoldOn.close();
						$('.modal-popup-area').fadeOut('fast');
						$('html').removeClass('no-scroll');
						heads_up_warning(data.message);
						$('#btn-create-new-user-group').attr('disabled', false);
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					HoldOn.close();
					let m;
					(m = jqXHR.responseJSON.message) ? heads_up_info(m) : heads_up_warning();
					$('#btn-create-new-user-group').attr('disabled', false);
				}
			});

		}).catch(function (err) {
			HoldOn.close();
			heads_up_error();
			$('#btn-create-new-user-group').attr('disabled', false);
		})
	}

	$('.user_group_selector_in_form').change(function(e) {
		let group_id = e.target.value;
		let rec_id = $(this).closest('tr').data('r-id');

		get_white_rice().then(function (value) {
			$.ajax({
				type: "POST",
				dataType: 'JSON',
				url: base_url+'superuser/account/manage_users/assign_user',
				data: $('#new_user_group_form').serialize() + '&white_rice_token=' + value,
				data:{group_id: group_id, rec_id: rec_id, white_rice_token: value},
				cache: false,
				beforeSend: function () {
					// HoldOn.open(loader_options);
				},
				success: function (data) {
					if (data.code === 1){
						// HoldOn.close();
						let m;
						(m = data.message) ? heads_up_success(m) : heads_up_success();
					}
					else{
						// HoldOn.close();
						heads_up_warning(data.message);
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					// HoldOn.close();
					let m;
					(m = jqXHR.responseJSON.message) ? heads_up_info(m) : heads_up_warning();
				}
			});

		}).catch(function (err) {
			HoldOn.close();
			heads_up_error();
		})
	});

	$('.route-parent').change(function(){
		if(this.checked){ // if checked - check all parent checkboxes
			$('[data-parent-id='+this.value+']').prop('checked', true);
		}
		else{
			$('[data-parent-id='+this.value+']').prop('checked', false);
		}
	});

	$('.route-child').change(function(){
		let parent_route = $(this).data('parent-id');
		let check_siblings = $('[data-parent-id='+parent_route+']:checked').length;
		if(check_siblings){
			$('#par-'+parent_route).prop('checked', true);
		}
		else{
			$('#par-'+parent_route).prop('checked', false);
		}
	});

	$('.btn-edit-user-access').on('click', function (e) {
		$('#set_permissions_form')[0].reset();
		let user_gid = $(this).closest('tr').data('r-id');
		$('#user_group_id_input').val(user_gid);
		$('#edit_user_access').fadeIn('fast');

		$.ajax({
			type: "GET",
			dataType: 'JSON',
			url: base_url+'superuser/account/manage_user_groups/get_permissions',
			data: {user_gid: user_gid},
			cache: false,
			beforeSend: function () {
				HoldOn.open(loader_options);
			},
			success: function (data) {
				HoldOn.close();
				$.each(data, function( index, value ) {
					$('.rou-'+value.route_id)[0].checked = true;
				});

			},
			error: function (jqXHR, textStatus, errorThrown) {
				HoldOn.close();
				let m;
				(m = jqXHR.responseJSON.message) ? heads_up_info(m) : heads_up_warning();
				$('#change-access-perm').attr('disabled', false);
			}
		});
	});

	$('#change-access-perm').click(()=>{
		set_access_permission();
	});

	function set_access_permission() {
		get_white_rice().then(function (value) {
			$.ajax({
				type: "POST",
				dataType: 'JSON',
				url: base_url+'superuser/account/manage_user_groups/set_permissions',
				data: $('#set_permissions_form').serialize() + '&white_rice_token=' + value,
				cache: false,
				beforeSend: function () {
					HoldOn.open(loader_options);
				},
				success: function (data) {
					if (data.code === 1){
						HoldOn.close();
						$('.modal-popup-area').fadeOut('fast');
						$('html').removeClass('no-scroll');
						heads_up_success('Set successfully');
					}
					else{
						HoldOn.close();
						$('.modal-popup-area').fadeOut('fast');
						$('html').removeClass('no-scroll');
						heads_up_warning(data.message);
						$('#change-access-perm').attr('disabled', false);
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					HoldOn.close();
					let m;
					(m = jqXHR.responseJSON.message) ? heads_up_info(m) : heads_up_warning();
					$('#change-access-perm').attr('disabled', false);
				}
			});

		}).catch(function (err) {
			HoldOn.close();
			heads_up_error();
			$('#change-access-perm').attr('disabled', false);
		})
	}
});

function su_user_status_switch(that) {
	var is_active_check = $(that).is(":checked") ? 1 : 0;

	get_white_rice().then(function (rice) {
		$.ajax({
			type: 'POST',
			dataType: 'JSON',
			url: base_url+'superuser/account/manage_users/change_user_access',
			data: {is_active: is_active_check, user_id: $(that).attr('id'), white_rice_token:rice},
			cache: false,
			beforeSend: function () {

			},
			success: function (data) {
				let uname = $(that).closest('tr').find('.table-list-title h3 a').html();
				if (is_active_check){
					heads_up_info('<strong>'+uname +'</strong>\'s account is <strong>Activated</strong>');
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
		$(that).prop( "checked", !is_active_check );
		heads_up_warning('Failed to connect server. Please try again or contact support');
	})
}

function edit_user(that){
	let r_id = that.parentElement.dataset.rId;
	$("#new_su_user")[0].reset();
	$("#form_title").html("Edit");
	$('input[name="su_email"], input[name="confirm_email"], input[name="password"], input[name="confirm_password"]').prop('disabled', true);

	get_white_rice().then(function (rice) {
		$.ajax({
			type: 'POST',
			dataType: 'JSON',
			url: base_url + 'superuser/account/manage_users/edit_user',
			data: {user_id: r_id, white_rice_token: rice},
			cache: false,
			beforeSend: ()=>{
				HoldOn.open(loader_options);
			},
			success: function (data) {
				if (data.code === 1) {
					$.each(data.ret_data, function( index, value ) {
						$('input[name="'+index+'"]').val(value).trigger('change');
						$('select[name="'+index+'"]').val(value).trigger('change');
					});
					$('#add-new-user-popup-box').fadeIn('fast');
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
		heads_up_warning('Failed to connect server. Please try again or contact support');
	});
	HoldOn.close();
}

function delete_user(that) {
	let r_id = that.parentElement.dataset.rId;

	const {value: text} = swal(swal_confirm_delete_with_message)
		.then((result) => {
		if (result.value) {
			let text = result.value;
			HoldOn.open(loader_options);
			get_white_rice().then(function (rice) {
				$.ajax({
					type: 'POST',
					dataType: 'JSON',
					url: base_url + 'superuser/account/manage_users/delete_user',
					data: {user_id: r_id, reason: text, white_rice_token: rice},
					cache: false,
					success: function (data) {
						if (data.code === 1) {
							let uname = $(that).closest('tr').find('.table-list-title h3 a').html();
							HoldOn.close();
							heads_up_info('<strong>' + uname + '</strong>\'s ' + data.message);
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
				heads_up_warning(token_error);
			})
		}
	})
}

function delete_user_group(that) {
	let r_id = that.closest('tr').dataset.rId;
	swal(swal_confirm_delete)
		.then((result) => {
		if (result.value) {
			console.log(r_id);
			HoldOn.open(loader_options);
			get_white_rice().then(function (rice) {
				$.ajax({
					type: 'POST',
					dataType: 'JSON',
					url: base_url + 'superuser/account/manage_user_groups/delete',
					data: {rec_id: r_id, white_rice_token: rice},
					cache: false,
					success: function (data) {
						let uname = $(that).closest('tr').find('.table-list-title h3 a').html();
						if (data.code === 1) {
							HoldOn.close();
							heads_up_info('<strong>' + uname + '</strong> ' + data.message);
							location.reload();
						}else if (data.code === 2){
							HoldOn.close();
							heads_up_warning(data.message);
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
