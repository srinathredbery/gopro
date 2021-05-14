$(document).ready(function () {
	$("#search_box").keypress(function(e) {
		if(e.which == 13) {
			do_candi_search();
		}
	});
});

var cadidate_search_table = null;

$('#candidate-search').click(function () {
	do_candi_search()
});



function do_candi_search() {
	let search_key = $('#search_box').val();
	let country = $('#candidate_country').find(':selected').val();
	let industry = $('#candidate_industry').find(':selected').val();
	let category = $('#candidate_category').find(':selected').val();
	let qualification = $('#qualification_filter').find(':selected').val();
	let language = $('#language_filter').find(':selected').val();
	let gender = $('#candidate_gender').find(':selected').val();

	if (cadidate_search_table)
		cadidate_search_table.destroy();

	$.fn.dataTable.ext.errMode = 'throw';

	cadidate_search_table = $('#candidate_search_results').DataTable( {
		processing: false,
		serverSide: false,
		searching: false,
		ordering: false,
		pageLength: 25,
		columns:[
			{ width:"70%", targets: 0 },
			{ width:"10%", targets: 0 },
			{ width:"20%", targets: 0 },
		],
		language: {
			emptyTable: "No candidates found"
		},
		ajax: {
			url:  base_url+"superuser/candidate_search/do_search",
			type: 'GET',
			data: {
				search_q: search_key,
				country: country,
				industry: industry,
				category: category,
				qualification: qualification,
				gender: gender,
				language: language
			},
			beforeSend: function () {
				show_loader('search-results')
			},
			complete: function (data) {
				hide_loader('search-results')
			},
			error: function (jqXHR, textStatus, errorThrown) {
				hide_loader('search-results');
				console.warn("Error", jqXHR);
				if (jqXHR.responseJSON)
					heads_up_info(jqXHR.responseJSON.message);
				else if(jqXHR.status === 500)
					heads_up_error(jqXHR.statusText);
				else
					heads_up_error();
			}
		}
	});
}

function show_access_menu() {
	$('#su-js-backend-access-menu').fadeIn('fast');
	$('html').addClass('no-scroll');
}
