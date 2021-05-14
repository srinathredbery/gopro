$(document).ready(function () {
	$("#new_industry_form").bootstrapValidator({
		live: 'enabled',
		message: 'This value is not valid.',
		excluded: [':disabled'],
		fields: {
			job_cms_name: {validators: {notEmpty: {message: '* Item name is required'}}}
		},
	}).bootstrapValidator()
		.on('success.form.bv', function (e) {
			save_industry();
		});

});

$('.edit_record').click(function () {
	let id = $(this.closest('tr')).data('rec-id');
	let value = $(this.closest('tr')).data('rec-value');

	$("#new_industry_form")[0].reset();

	$('#job_cms_id').val(id);
	$('#job_cms_name').val(value).text(value);

	$('#add-new-content-popup-box').fadeIn('fast');
	$('html').addClass('no-scroll');
});

$('.delete_record').click(function () {
	let id = $(this.closest('tr')).data('rec-id');
	let content_type = $(this.closest('tr')).data('rec-content');

	swal(swal_confirm_delete).then((result) => {
		if (result.value) {
			get_white_rice().then(function (rice) {
				$.ajax({
					type: 'POST',
					dataType: 'JSON',
					url: base_url + 'superuser/manage_content/job_industry/delete',
					data: {rec_id: id, content_type: content_type, white_rice_token: rice},
					cache: false,
					beforeSend: function () {
						HoldOn.open(loader_options);
					},
					success: function (data) {
						heads_up_done('Your change is saved!');
						HoldOn.close();
						setTimeout(function () {
							location.reload()
						}, 500);
					},
					error: function (jqXHR, textStatus, errorThrown) {
						heads_up_error();
						HoldOn.close();
						$('.submit-btn').attr('disabled', false);
					}
				});
			}).catch(function () {
				HoldOn.close();
				heads_up_warning('Failed to connect server. Please try again or contact support');
			});
		}
	})
});

function save_industry() {
	let industry_form = $('#new_industry_form').serialize();
	const content = $('#content_type').data('content');

	get_white_rice().then(function (rice) {
		$.ajax({
			type: 'POST',
			dataType: 'JSON',
			url: base_url+'superuser/manage_content/job_industry/add_or_edit',
			data: industry_form+'&content_type='+content+'&white_rice_token=' + rice,
			cache: false,
			beforeSend: function () {
				HoldOn.open(loader_options);
			},
			success: function (data) {
				heads_up_done('Your change is saved!');
				HoldOn.close();
				setTimeout(function () { location.reload() },500);
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
