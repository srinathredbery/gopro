$('.apply').on('click',function () {
	 var post_id=	$(this).val();

	get_white_rice().then(function (rice) {
		$.ajax({
			type: 'POST',
			dataType: 'JSON',
			url: base_url+'superuser/addFeatured',
			data: {post_id: post_id, white_rice_token:rice},
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
				var isRemoveOne=jqXHR.responseText;
				if(isRemoveOne=="Remove one"){
					heads_up_error('You can choose only 3 Featured Jobs at a time!');
				}else{
					heads_up_done('Your change is saved!');
					setTimeout(location.reload(),200);

				}


			},

		});


	}).catch(function () {

		HoldOn.close();
		heads_up_warning('Failed to connect server. Please try again or contact support');
	});


});

$('.remove').on('click',function () {
	var post_id=	$(this).val();

	get_white_rice().then(function (rice) {
		$.ajax({
			type: 'POST',
			dataType: 'JSON',
			url: base_url+'superuser/removeFeatured',
			data: {post_id: post_id, white_rice_token:rice},
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
				heads_up_done('Your change is saved!');
				// heads_up_error();
				setTimeout(location.reload(),200);

			}
		});
	}).catch(function () {

		HoldOn.close();
		heads_up_warning('Failed to connect server. Please try again or contact support');
	});
})








