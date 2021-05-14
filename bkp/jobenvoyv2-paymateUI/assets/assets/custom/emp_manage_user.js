$(document).ready(function () {
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
				url: base_url+'employer/account/manage_user_groups/create_new_group',
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
						let m;
						(m = data.message) ? heads_up_warning(m) : heads_up_warning();
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
				url: base_url+'employer/account/manage_users/assign_user',
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
			url: base_url+'employer/account/manage_user_groups/get_permissions',
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
				// let m;
				// (m = jqXHR.responseJSON.message) ? heads_up_info(m) : heads_up_warning();
				// $('#change-access-perm').attr('disabled', false);
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
				url: base_url+'employer/account/manage_user_groups/set_permissions',
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
