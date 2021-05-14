$(document).ready(function () {
	let table_options = {
		processing: true,
		serverSide: true,
		scrollX: true,
		ajax: {
			url: base_url+'superuser/job_posting_plans/orders/get_data',
			data: function (d) {
				d.order_status_filter = $("#order_status_filter option:selected").val();
				d.pay_status_filter = $("#pay_status_filter option:selected").val();
			}
		},
		order: [[1, "desc"]],
		columnDefs: [
			{
				name: "order_no",
				orderable: false,
				targets: 0
			},
			{
				name: "order_timestamp",
				targets: 1
			},
			{
				name: "employer_name",
				targets: 2
			},
			{
				name: "amount_value",
				targets: 3
			},
			{
				name: "order_status",
				searchable: false,
				targets: 4
			},
			{
				name: "action",
				orderable: false,
				searchable: false,
				targets: 5
			},
		]
	};

	let orders_table = $("#orders").DataTable(table_options);

	$("#order_status_filter, #pay_status_filter").change(function (event) {
		orders_table.ajax.reload();
	});

	$("#orders_refresh").click(function () {
		orders_table.ajax.reload();
	});

	setInterval( function () {
		orders_table.ajax.reload( function () {
			table_options.processing = false;
		}, false ); // user paging is not reset on reload
	}, 60000 );

	$(".txn_approval").bootstrapValidator({
		live: 'enabled',
		message: 'This value is not valid.',
		excluded: [':disabled'],
		fields: {
			tnx_status: {
				validators: {
					notEmpty: {message: '<i class="fas fa-times-circle"></i> Required'}
				}
			},
		}
	}).bootstrapValidator()
		.on('success.form.bv', function (e) {
			e.preventDefault();
			processTxn(e);
		});

});

function processTxn(event) {
	var fdata = new FormData($("#"+event.currentTarget.id)[0]);
	const txn_status = fdata.get('tnx_status');
	let message_text = swal_confirm_send;

	if (txn_status === "refer_back" || txn_status === "reject" || txn_status === "rejected" || txn_status === "onhold" || txn_status === "other" )
		message_text = swal_confirm_with_response;
	else
		message_text = swal_confirm_send;

	let {value: text} = swal(message_text)
		.then((result) => {
			if (result.value) {
				let text = result.value;
				HoldOn.open(loader_options);
				get_white_rice().then(function (rice) {
					fdata.append('white_rice_token', rice);
					fdata.append('reason', text);
					$.ajax({
						type: 'POST',
						dataType: 'JSON',
						url: base_url + 'superuser/job_posting_plans/orders/process_txn',
						data: fdata,
						cache: false,
						contentType: false,
						processData:false,
						success: function (data) {
							if (data.code === 1) {
								const tnx_row = '#txn-row-' + data.tnx.txn_no;
								$(tnx_row +' .status').removeClass().addClass('badge status font-13 '+ data.tnx.txn_status_raw).html(data.tnx.txn_status);
								heads_up_done(data.tnx.message || "Transaction updated");
								data.order.message ? heads_up_success(data.order.message) : 0;
								if	(data.tnx.txn_status_raw == 'approved' || data.tnx.txn_status_raw == 'Approved') {
									$('#approval-row'+data.tnx.txn_no +' .approval-selector').remove();
								}
								if	(data.tnx.remarks) {

									let remark = '<span\n' +
										'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tclass="font-14 pb-2">Remarks: </span>\n' +
										'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div\n' +
										'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tclass="card">\n' +
										'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div\n' +
										'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tclass="card-body px-3 py-0">\n' +
										'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<p class="card-text font-12">'+data.tnx.remarks+'</p>' +
										'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
										'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>';

									$('#approval-row'+data.tnx.txn_no +' .remarks').empty().html(remark);
									$(tnx_row +' .remarks').html((data.tnx.remarks).substring(0,15));
								}
								if (data.order.order_status){
									$('#order-status-badge').removeClass().addClass('badge status bcg-'+ data.order.order_status_raw).html(data.order.order_status);
								}
								if (data.order.payment_status){
									$('#payment_status').removeClass().addClass(' font-13 px-0 badge status '+ data.order.payment_status_raw).html(data.order.payment_status);
								}
							} else {
								HoldOn.close();
								heads_up_error(data.message);
							}
							HoldOn.close();
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

function showOrder(that) {
	HoldOn.open(loader_options);
	const ono = $(that).data('ono');
		$.ajax({
			type: "GET",
			dataType: 'JSON',
			url: base_url + 'superuser/job_posting_plans/orders/get_order',
			data: {ono: ono},
			cache: false,
			beforeSend: function () {
				HoldOn.open(loader_options);
			},
			success: function (data) {
				if (data.code === 1) {

					$.each(data.order, function (key, order) {
						let value =  order;
						let element = $('#'+key+'');
						element.html(value);
						if (key =='billing_email'){
							element.attr("href", "mailto:"+value);
						}
						if (key =='payment_status'){
							element.addClass(data.order.payment_status_raw);
						}

						if (key === 'order_item'){
							$("#item_list").empty();
							let i = 1;
							$.each(value, function (key, order_item) {
								let item_row = '<tr>' +
									'<td>'+i+'</td>' +
									'<td>'+order_item.item_name+'</td>' +
									'<td>'+order_item.quantity+'</td>' +
									'<td class="float-right">'+order_item.value+'</td>' +
									'</tr>';
								$("#item_list").append(item_row);
								i++;
							});

						}
					});

					$('#order_no_title').text(data.order.order_no);
					$('#order-view-popup-box').fadeIn('fast');
					$('html').addClass('no-scroll');
					HoldOn.close();
				} else {
					HoldOn.close();
					let m;
					(m = data.message) ? heads_up_warning(m) : heads_up_warning();
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				HoldOn.close();
				let m;
				(m = jqXHR.responseJSON.message) ? heads_up_info(m) : heads_up_warning();
			}
		});


}
