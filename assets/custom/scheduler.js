$('.create-interview').click(function () {
	let rec_id = $(this).data("post-id");

	swal(swal_confirm_send).then((result) => {
		if (result.value) {
			get_white_rice().then(function (rice) {
				$.ajax({
					type: 'POST',
					dataType: 'JSON',
					url: base_url+'employer/interview/create_interview_calender',
					data: {post_id: rec_id, white_rice_token:rice},
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
					}
				});
			}).catch(function () {
				HoldOn.close();
				heads_up_warning('Failed to connect server. Please try again or contact support');
			});
		}
	});
});

$('#interview-schedule-form').bootstrapValidator({
	live: 'enabled',
	message: 'This value is not valid.',
	excluded: [':disabled'],
	fields: {
		interview_date: {
			validators: {
				notEmpty: {message: '* Required'}},
			date: {
				format: 'YYYY-MM-DD',
				message: 'The value is not a valid date'
			}
		},
		start_time: {
			validators: {
				notEmpty: {message: '* Required'}}
		},
		end_time: {
			validators: {
				notEmpty: {message: '* Required'}}
		},
	},
}).bootstrapValidator()
	.on('success.form.bv', function (e) {
		e.preventDefault();
		createSchedule();
	});

function createSchedule(){
	let fdata = new FormData($("#interview-schedule-form")[0]);

	swal(swal_confirm_send).then((result) => {
		if (result.value) {
			get_white_rice().then(function (rice) {
				fdata.append('white_rice_token', rice);
				$.ajax({
					type: 'POST',
					dataType: 'JSON',
					url: base_url+'employer/interview/schedule_an_interview',
					data: fdata,
					cache: false,
					contentType: false,
					processData: false,
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
					}
				});
			}).catch(function () {
				HoldOn.close();
				heads_up_warning('Failed to connect server. Please try again or contact support');
			});
		}
	});
}

$('.schedule-an-interview').click(function () {
	$("#candidate_name").text($(this).closest('.emply-resume-list').find('#js-name').text());
	$('#interview-schedule-form')[0].reset();
	$('#app_id').val($(this).data("post-id"));
	$('#interview_popup').fadeIn('fast');
});

$("#interview_start_time").on("change.datetimepicker", function (e) {
	$('#interview_end_time').datetimepicker('minDate', moment(e.date).add(30, 'minutes'));

});
$("#interview_end_time").on("change.datetimepicker", function (e) {
	$('#interview_start_time').datetimepicker('maxDate', moment(e.date).subtract(30, 'minutes'));
});
