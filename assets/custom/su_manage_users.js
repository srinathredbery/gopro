$(document).ready(function () {
	$('#manage_jobseekers').DataTable( {
		processing: true,
		serverSide: true,
		columnDefs: [
			{ orderable: false, targets: [4] },
			],
		ajax: {
			url:  base_url+"superuser/get_data/all_job_seekers",
			type: 'GET'
		},
		order: [[ 3, "desc" ]]
	});

	$('#manage_employers').DataTable( {
		processing: true,
		serverSide: true,
		columnDefs: [
			{ orderable: false, targets: [0,1,6] },
		],
		ajax: {
			url:  base_url+"superuser/get_data/all_employers",
			type: 'GET'
		},
		order: [[ 5, "desc" ]]
	});
});

function delete_ads() {
	// alert("done");
}
