$(document).ready(function() {

    $('#pending_post_approval').DataTable({
		order: []
	});


    $('#post_rejection_form').bootstrapValidator({
        live: 'enabled',
        message: 'This value is not valid.',
        excluded: [':disabled'],
        fields: {
            rejection_comment: {
                validators: {
                    notEmpty: {
                        message: '<i class="fas fa-exclamation-circle"></i> Reason is required'},
                },
            },
        },
    }).bootstrapValidator()
        .on('success.form.bv', function (e) {
            e.preventDefault();
            submit_reject_post();
        });


} );

function approve_posts_table() {

    let tok='';
    $('#pending_post_approval').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": base_url+"superuser/manage_post/pending/get_user_growth_yearly",
            // "type": "GET",
            // "data": function (d) {
            //     get_white_rice().then(function (rice) {
            //         tok = rice;
            //     }).catch(function () {
            //
            //     });
            //     d.white_rice_token = tok;
            // }
        },
        "columns": [
            { "data": "post_name" },
            { "data": "job_type" },
        ]
    } );

}

function approve_post(that) {
    swal(swal_confirm_send).then((result) => {
        if(result.value){
            let p_id = $(that).closest("tr").data("p_id");

            get_white_rice().then(function (rice) {
                $.ajax({
                    type: "POST",
                    dataType: 'JSON',
                    url: base_url+'superuser/manage_post/action/approve',
                    data: {post: p_id, white_rice_token:rice },
                    cache: false,
                    beforeSend: function () {
                        HoldOn.open(loader_options);
                    },
                    success: function (data) {
						if (data.code === 1) {
							HoldOn.close();
							heads_up_success(data.message);
							location.reload();
						}
						if (data.code === 0) {
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
            });
        }
    });
}



function reject_post(that) {
    let p_id = $(that).closest("tr").data("p_id");
    $('#rejection-comment').fadeIn('fast');
    $("form")[0].reset();
    $('#post_id').val(p_id);
    $('html').addClass('no-scroll');
}

function submit_reject_post(){

    var fdata = new FormData($("#post_rejection_form")[0]);

    swal(swal_confirm_send).then((result) => {
        if(result.value){
            get_white_rice().then(function (rice) {
                var rice = rice;
                fdata.append('white_rice_token', rice);
                $.ajax({
                    type: "POST",
                    dataType: 'JSON',
                    url: base_url+'superuser/manage_post/action/reject',
                    data: fdata,
                    cache: false,
                    contentType: false,
                    processData:false,
                    beforeSend: function () {
                        HoldOn.open(loader_options);
                    },
                    success: function (data) {
                        HoldOn.close();
                        heads_up_success(data.message);
                        $('.modal-popup-area').fadeOut('fast');
                        $('html').removeClass('no-scroll');
						location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        HoldOn.close()
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

function switch_ads(that){
    let id = that.id;

    var is_active_check = $(that).is(":checked") ? 1 : 0;

    get_white_rice().then(function (rice) {
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: base_url+'superuser/ads/switch',
            data: {is_active: is_active_check, id: id, white_rice_token:rice},
            cache: false,
            beforeSend: function () {
                // HoldOn.open(loader_options);
            },
            success: function (data) {
                HoldOn.close();
                heads_up_done('Your change is saved!');
            },
            error: function (jqXHR, textStatus, errorThrown) {
            	debugger
				console.log(jqXHR.status);
                HoldOn.close();
                heads_up_error();
                $(that).prop( "checked", !is_active_check );
            }
        });
    }).catch(function () {
        HoldOn.close();
        heads_up_warning('Failed to connect server. Please try again or contact support');
    });
}

function delete_ads(that){
    let id = $(that).closest("tr").data("ad_id");

    swal(swal_confirm_delete).then((result) => {
        if (result.value) {
            get_white_rice().then(function (rice) {
                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    url: base_url + 'superuser/ads/delete',
                    data: {id: id, white_rice_token: rice},
                    cache: false,
                    beforeSend: function () {
                        HoldOn.open(loader_options);
                    },
                    success: function (data) {
                        HoldOn.close();
                        heads_up_done('Deleted successfully!');
                        location.reload();
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

function view_ad(that) {
    let ad_id = $(that).closest("tr").data("ad_id");
    $('#ad_preview').fadeIn('fast');
    $('html').addClass('no-scroll');

    $.ajax({
        type: 'GET',
        dataType: 'JSON',
        url: base_url+'superuser/ads/preview',
        data: {id: ad_id},
        cache: false,
        beforeSend: function () {
            HoldOn.open(loader_options);
        },
        success: function (data) {
            HoldOn.close();
            $('#ad_preview_img').attr('src',data.adv_image_url);
			$.each( data, function( key, value ) {
				$('#'+key).text(value);
			});
        },
        error: function (jqXHR, textStatus, errorThrown) {
            HoldOn.close();
            heads_up_error();
        }
    });
}
