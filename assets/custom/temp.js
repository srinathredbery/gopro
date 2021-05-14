var u_status = false;
var u_who = null;
var res_deadline = '31st October 2019';


var loader_options = {
    theme:"custom",
    // If theme == "custom" , the content option will be available to customize the logo
    content:'<div class="triple-spinner">',
    message:'<span>Loading...</span>',
    backgroundColor:"#141414",
    textColor:"white"
};

var swal_confirm_send = {
    // title: 'Are you sure?',
    text: "Are you sure?",
    type: 'question',
    showCancelButton: true,
    confirmButtonColor: '#1EAAE7',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes'
};

var swal_confirm_default = {
    title: 'Attention!',
    text: 'After '+res_deadline+" you will not be able to to change default resume. the default will be retained and rest will be removed. ",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#1886f7',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Set Default'
};

var swal_confirm_delete = {
    // title: 'Are you sure?',
    text: "Are you sure to delete?",
    type: 'question',
    showCancelButton: true,
    confirmButtonColor: '#28a453',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes'
};

var swal_confirm_delete_with_message = {
	text: "Are you sure to delete?",
	type: 'question',
	confirmButtonColor: '#d33',
	// cancelButtonColor: '#d33',
	confirmButtonText: 'Delete',
	input: 'textarea',
	inputPlaceholder: 'What is the reason to delete?',
	inputAttributes: {
		'aria-label': 'Type reason here',
		'id': 'del-reason'
	},
	inputValidator: (value) => {
		if (!value) {
			return 'You need to type the reason to proceed!'
		}
	},
	showCancelButton: true
};

var swal_confirm_with_message = {
	text: "Are you sure to change?",
	type: 'question',
	confirmButtonColor: '#007bff',
	cancelButtonColor: '#d33',
	confirmButtonText: 'Proceed',
	input: 'textarea',
	inputPlaceholder: 'What is the reason to change?',
	inputAttributes: {
		'aria-label': 'Type reason here',
		'id': 'del-reason'
	},
	inputValidator: (value) => {
		if (!value) {
			return 'You need to type the reason to proceed!'
		}
	},
	showCancelButton: true
};

var swal_confirm_with_response = {
	text: "Reason?",
	type: 'question',
	confirmButtonColor: '#007bff',
	cancelButtonColor: '#d33',
	confirmButtonText: 'Proceed',
	input: 'textarea',
	inputPlaceholder: 'What is the reason?',
	inputAttributes: {
		'aria-label': 'Type reason here',
		'id': 'del-reason'
	},
	inputValidator: (value) => {
		if (!value) {
			return 'You need to type the reason to proceed!'
		}
	},
	showCancelButton: true
};

var token_error = 'Failed to connect server. Please try again or contact support';

$.get("https://api.ipdata.co?api-key=751c5f31025f4d6cc5a351c34a7a9b42d4794226f244d412eeb32d63", function (response) {
    u_who = response;
    $("#search_by_country").val(u_who.country_code).trigger("change");
    $("#currency_list").val(u_who.currency.code).trigger("chosen:updated").trigger("change");
    check_min_max_salary_filter();
}, "jsonp");
