function show_confirm() {

    swal({
        // title: 'Are you sure?',
        text: "Are you sure?",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a453',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            swal(
                'Success!',
                'Your file has been deleted.',
                'success'
            )
        }
    })
}

function heads_up_success($message = 'Operation Successful') {
    $.ntf ({
        color: 'green',
        duration: 5,
        permanent: false,
        position: 'top',
        responsive: true,
        text: '<span><i class="fas fa-check-circle"></i> Success!</span> <br/>'+$message,
        width: 600
    });

}

function heads_up_done($message = '') {
    $.ntf ({
        color: 'blue',
        duration: 5,
        permanent: false,
        position: 'top',
        responsive: true,
        text: '<span><i class="fas fa-check-circle"></i> Done!</span> <br/>'+$message,
        width: 600
    });
}

function heads_up_info($message = '') {
    $.ntf ({
        color: 'blue',
        duration: 5,
        permanent: false,
        position: 'top',
        responsive: true,
        text: '<span><i class="fas fa-info-circle"></i> Attention!</span> <br/>'+$message,
        width: 600
    });

}

function heads_up_error($message = 'Something went wrong, Please try again.') {
    $.ntf ({
        color: 'red',
        duration: 5,
        permanent: false,
        position: 'top',
        responsive: true,
        text: '<span><i class="fas fa-times-circle"></i> Error!</span> <br/>'+$message,
        width: 600
    });

}

function heads_up_warning($message = 'Something unusual happened, Please contact support if anything.') {
    $.ntf ({
        color: 'yellow',
        duration: 5,
        permanent: false,
        position: 'top',
        responsive: true,
        text: '<span><i class="fas fa-exclamation-triangle"></i></i> Warning!</span> <br/>'+$message,
        width: 600
    });

}

function toggle_section_loader(target_div_class) {
    $('.'+target_div_class).toggleClass('loader loader-bouncing is-active');
}

function show_loader(target_div_class) {
	$('.'+target_div_class).wrap("<div class='loader loader-bouncing is-active'></div>");
	$('.loader').prepend('<div class="loader-overlay"></div>');

}
function hide_loader(target_div_class) {
	$('.loader-overlay').remove();
	$('.'+target_div_class).unwrap();

}
