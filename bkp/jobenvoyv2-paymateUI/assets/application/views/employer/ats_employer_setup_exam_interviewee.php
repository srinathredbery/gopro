<style type="text/css">
	.dot_rad {
		height: 25px;
		width: 25px;
		background-color: red;
		border-radius: 50%;
		display: inline-block;
	}
	.dot_green{
		height: 25px;
		width: 25px;
		background-color: green;
		border-radius: 50%;
		display: inline-block;
	}

	table thead tr td,
	table thead tr th {
		font-size: 12px !important;
	}

	table tbody tr td {
		font-size: 14px !important;
	}

	.dataTables_wrapper .dataTables_info,
	.dataTables_wrapper .dataTables_paginate {
		padding-top: 1.755em !important;
	}

	.dataTables_wrapper .dataTables_paginate .paginate_button {
		padding: 3px 9px !important;
	}
	.DataTables_Table_0_wrapper lable select {
		text-transform: none;
		border: 1px solid #0000002b !important;
		border-radius: 4px !important;
	}


	.application-count.applied {
		color: #fff;
		background-color: #2dc565;
		border-radius: 30px;
		padding: 4px 6px;
	}
	.application-count.applied:hover {
		background-color: #018a51;
	}
	table.jobpost-table tbody tr:hover {
		background-color: #f7661833;
		cursor: pointer;
	}
	table.jobpost-table tbody tr.active {
		background-color: #efefef;
	}


	table.jobpost-table tbody tr {
		height: 60px;
	}

	table.jobpost-table tbody td {
		padding: 8px 16px !important;
	}

	table.jobpost-table tbody td:hover {
		border-bottom: none;
	}

	@media (min-width: 992px) {
		.col-lg-5.job-sec,{
			-webkit-box-flex: 0;
			-ms-flex: 0 0 40%;
			flex: 0 0 40%;
			max-width: 40%;
		}
		.col-lg-10.job-sec{
			-webkit-box-flex: 0;
			-ms-flex: 0 0 80%;
			flex: 0 0 80%;
			max-width: 80%;
		}

		.col-lg-5.job-sec, .col-lg-10.job-sec {
			margin: 20px 10px;
			box-shadow: 0 4px 8px 0 rgb(0 0 0 / 5%), 0 6px 20px 0 rgb(0 0 0 / 7%);
		}

		.col-md-12 {
			margin: auto !important;
		}
	}

	input[type="text"],
	input[type="number"] {
		padding: 9px 20px !important;
	}
</style>
<section>
	<div class="block no-padding">
		<div class="container-fluid">
			<div class="row no-gape">

				<!--include side bar for employer-->
				<?php $this->load->view('include/side_bar_left_ats') ?>

				<div class="col-lg-5 column job-sec" id="div_interviewee_list">
					<div class="padding-left">
						<div class="manage-jobs-sec">
							<h3>Interviewee</h3>
							<table class="datatable-init jobpost-table">
								<thead>
								<tr>
									<td>Title</td>
									<td>No of Applicants</td>
								</tr>
								</thead>
								<tbody>
								<?php
								if(isset($active_job_posts) && !empty($active_job_posts)){
									foreach ($active_job_posts as $active_post){
										if( !empty($active_post['job_post_job_type'])){
											if($active_post['job_post_job_type']==1)
												$job_type_class = 'tp';
											elseif($active_post['job_post_job_type']==2)
												$job_type_class = 'fl';
											elseif($active_post['job_post_job_type']==3)
												$job_type_class = 'ft';
											elseif($active_post['job_post_job_type']==4)
												$job_type_class = 'it';
											elseif($active_post['job_post_job_type']==5)
												$job_type_class = 'pt';
										}
										?>
										<tr onclick="setJobs(<?php echo $active_post['job_post_id']; ?> ,'<?php echo $active_post['job_post_title']; ?>') ">
											<td>
												<div class="table-list-title">
													<h3 style="font-weight:600; font-size: 14px;"><a href="<?php echo !empty($active_post['job_post_id']) ? base_url().'jobs/view_job_post?jp_token='. base64_encode($active_post['job_post_id']): '' ?>" target="_blank" title=""><?php echo !empty($active_post['job_post_title']) ?  substr($active_post['job_post_title'], 0, 30) :''?></a></h3>
													<span><i class="la la-map-marker"></i><?php  if(!empty($active_post['job_post_city'])){ echo $active_post['job_post_city']; }; ?></span>
												</div>
											</td>

											<td>
                                                <span class="status active application-count applied">
                                                    <a <?php echo !empty($active_post['no_of_applications']) && $active_post['no_of_applications'] > 0 ? 'href="'.base_url().'employer/applications_received?jp_id='.$active_post['job_post_id'].'" title="View Applications Received"' : 'title="No Applications Received "' ?> ><?php echo !empty($active_post['no_of_applications']) ? $active_post['no_of_applications'] : 'No' ?> Applications</a>
                                                </span>
											</td>


										</tr>
										<?php
									}
								}
								?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-lg-10 column job-sec">
					<div class="padding-left" id="divTable" style="display: none;">
						<a onclick="resetDiv()"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
													 width="24" height="24"
													 viewBox="0 0 172 172"
													 style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none"  style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g><path d="M2.65391,86c0,-46.02344 37.32266,-83.34609 83.34609,-83.34609c46.02344,0 83.34609,37.32266 83.34609,83.34609c0,46.02344 -37.32266,83.34609 -83.34609,83.34609c-46.02344,0 -83.34609,-37.32266 -83.34609,-83.34609z" fill="#018e53"></path><path d="M77.73594,86.90703c10.31328,-10.31328 20.62656,-20.62656 30.93984,-30.93984c9.00312,-9.00313 -5.00547,-22.91094 -14.04219,-13.87422c-12.63125,12.63125 -25.2625,25.2625 -37.89375,37.89375c-3.82969,3.82969 -3.69531,10.17891 0.06719,13.94141c12.63125,12.63125 25.2625,25.2625 37.89375,37.89375c9.00313,9.00313 22.91094,-5.00547 13.87422,-14.04219c-10.27969,-10.31328 -20.55938,-20.59297 -30.83906,-30.87266z" fill="#ffffff"></path></g></g></svg></a>


						<div class="manage-jobs-sec">
							<h3>Job Posts</h3>
					<table id="jobs_emp_table" class="datatable-init">
						<thead>
						<tr>
							<td>#</td>
							<td>Name</td>
							<td>Date</td>
							<td>Time</td>
							<td>Location</td>
							<td>Room No</td>
							<td>Form</td>
							<td >Status</td>
							<td>Asse.</td>
						</tr>
						</thead>
						<tbody id="jobs_emp_table_body">
						</tbody>
					</table>
						</div>
					</div>

					<div class="manage-jobs-sec row">



					</div>
				</div>

			</div>
		</div>
</section>
<div class="coverletter-popup">
	<div class="cover-letter">
		<i class="la la-close close-letter"></i>
		<h3>Ali TUFAN - UX / UI Designer</h3>
		<p class="cover-letter-content">
			Content goes here
		</p>
	</div>
</div>

<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"> Schedule Interview</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="col-md-12 row">
					<div class="col-md-3">
						Start Time
					</div>
					<div class="col-md-4">
						<input type="number" class="form-control" min="-1" max="24"/>
					</div>
					<div class="col-md-4">
						<input type="number" class="form-control" min="-1" max="59"/>
					</div>
				</div>
				<br>
				<div class="col-md-12 row">
					<div class="col-md-3">
						Duration
					</div>
					<div class="col-md-4">
						<input type="number" class="form-control" min="-1" max="24"/>
					</div>
					<div class="col-md-4">
						<input type="number" class="form-control" min="-1" max="59"/>
					</div>
				</div>
				<br>
				<div class="col-md-12 row">
					<div class="col-md-3">
						Duration
					</div>
					<div class="col-md-8">
						<input type="date" class="form-control" />
					</div>
				</div>
				<br>
				<div class="col-md-12 row">
					<div class="col-md-3">
						Location
					</div>
					<div class="col-md-8">
						<select class="form-control">
							<option disabled> -select- </option>
							<option>Colombo</option>
						</select>
					</div>
				</div>
				<br>
				<div class="col-md-12 row">
					<div class="col-md-3">
						Room NO
					</div>
					<div class="col-md-8">
						<select class="form-control">
							<option disabled> -select- </option>
							<option>No 01</option>
							<option>No 02</option>
							<option>No 03</option>
							<option>No 04</option>
						</select>
					</div>
				</div>
				<br>
				<div class="col-md-12 row">
					<div class="col-md-3">
						Room NO
					</div>
					<div class="col-md-8">
						<select class="form-control">
							<option disabled> -select- </option>
							<option>CEO</option>
							<option>Accountant </option>
							<option>HR Manager</option>
						</select>
					</div>
				</div>
				<br>
				<div class="col-md-12 row">
					<div class="col-md-3">
						Confirmation Link
					</div>
					<div class="col-md-8">
						<input type="text" />
					</div>
				</div>


			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" data-dismiss="modal" onclick="save_question()">Save</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="hidden" id="drop_down_value"/>
			</div>
		</div>

	</div>
</div>


<script src="<?php echo base_url()?>assets/plugins/datatables/datatables.js" type="text/javascript"></script>
<script>
	$(document).ready(function () {
		$('.datatable-init').DataTable({
			"order": [],
			language: {
				searchPlaceholder: "Search records"
			}
		});


	})

	// myModal
	function OpenModal(){
		$('#myModal').show();
	}


	function setJobs(id,Name){

		$('#job_title').text(Name);
		$('#id_ViewJob').val(id);
		$('#jobs_emp_table_body').html("");

		$('#divTable').show();
		$('#div_interviewee_list').hide();
		$('#jobs_emp_table').DataTable().destroy();

		var html="";
		$.ajax({
			type: "GET",
			data:{id: id},
			dataType: 'json',
			url: base_url+'employer/job_posts/ats_exam_schedule_emp_view',
			cache: true,
			beforeSend: function(){
				HoldOn.open(loader_options);
			},
			success: function (data) {
				HoldOn.close();
				var drop_down='';
				for(var i=0;i<data['drop_data'].length;i++) {
						var description=data['drop_data'][i]['description'];
						var id_ats_interviewer_form=data['drop_data'][i]['id_ats_interviewer_form'];
						drop_down += '<option value='+id_ats_interviewer_form+'>'+description+'</option>';

				}
				$('#jobs_emp_table_body').html("");
				for(var i=0;i<data['applications'].length;i++){
					//jobseeker.jobseeker_first_name as jobseeker_first_name,jobseeker.jobseeker_middle_name as jobseeker_middle_name,jobseeker.jobseeker_last_name as jobseeker_last_name
					var Frist_name=data['applications'][i]['jobseeker_first_name'];
					var Middle_name=data['applications'][i]['jobseeker_middle_name'];
					var Last_name=data['applications'][i]['jobseeker_last_name'];
					var Date=data['applications'][i]['Date'];
					var strat_time_hr=data['applications'][i]['strat_time_hr'];
					var strat_time_min=data['applications'][i]['strat_time_min'];
					var location=data['applications'][i]['locat'];
					var room_no=data['applications'][i]['room'];
					var status_confirm=data['applications'][i]['status_confirm'];
					var emp_id=data['applications'][i]['emp_id'];

					 var id_shadule=data['applications'][i]['idats_schedule_interview'];



					//var jobseeker_first_name=data['applications'][i]['jobseeker_first_name'];
					//var jobseeker_last_name=data['applications'][i]['jobseeker_last_name'];
					//var applied_resume=data['applications'][i]['applied_resume'];
					//
					html+='<tr class="emply-resume-list_1" data-apl_id="" role="row">';
					html+='<td>'+(i+1)+'</td>';
					html+='<td>'+Frist_name+' '+Middle_name+' '+Last_name+'</td>';
					html+='<td>'+Date+'</td>';
					html+='<td>'+strat_time_hr+':'+strat_time_min+'</td>';
					html+='<td>'+location+'</td>';
					html+='<td>'+room_no+'</td>';
					html += '<td><select class="drop" ><option>select</option>';
					html += drop_down;
					html += '</select></td>';
				    if(status_confirm==0){
					html+='<td class="text-center"><a class="dot_rad" data-toggle="tooltip" title="Inactive" ></a></td>';
					}else{
					html+='<td class="text-center"><lable style="display: none;">A</lable><a class="dot_green" data-toggle="tooltip" title="Active"></a></td>';
					}
					html+='<td class="text-center"><a onclick="open_doc('+emp_id+','+id_shadule+')"><span class="la la-file-contract text-info fa-2x"></span></a></td>';
					html+='</tr>';


				}
				$('#jobs_emp_table_body').html(html);



				$('#jobs_emp_table').DataTable({
					"order": [],
					"aoColumnDefs": [
						{ "bSortable": false, "aTargets": [ 0, 6 , 8] },
					],
					language: {
						searchPlaceholder: "Search records"
					}
				});

				$(".drop").change(function () {

					var value = this.value;
					$('#drop_down_value').val("");
					$('#drop_down_value').val(value);
				});


			},
			error: function (jqXHR, textStatus, errorThrown) {
				HoldOn.close();
				heads_up_error();
			}
		});


	}



	$('.open-letter2').click(function (e) {
		let c_id = $(this).closest('.emply-resume-list_1').data("apl_id");
		let js_name =$('#job_title').text();

		$.ajax({
			type: "GET",
			data:{cl_uid: c_id},
			dataType: 'json',
			url: base_url+'employer/applications_received/view_candidate/cover_letter',
			cache: true,
			beforeSend: function(){
				HoldOn.open(loader_options);
			},
			success: function (data) {
				HoldOn.close();

				$('.cover-letter h3').text(js_name);
				$('.cover-letter-content').empty().html(data.cover_letter_content);
				$('.coverletter-popup').fadeIn();
				$('html').addClass('no-scroll');

			},
			error: function (jqXHR, textStatus, errorThrown) {
				HoldOn.close();
				heads_up_error();
			}
		});
	});

	function ViewCoverLatter(id){
		let c_id = id;
		let js_name =$('#job_title').text();

		$.ajax({
			type: "GET",
			data:{cl_uid: c_id},
			dataType: 'json',
			url: base_url+'employer/applications_received/view_candidate/cover_letter',
			cache: true,
			beforeSend: function(){
				HoldOn.open(loader_options);
			},
			success: function (data) {
				HoldOn.close();

				$('.cover-letter h3').text(js_name);
				$('.cover-letter-content').empty().html(data.cover_letter_content);
				$('.coverletter-popup').fadeIn();
				$('html').addClass('no-scroll');

			},
			error: function (jqXHR, textStatus, errorThrown) {
				HoldOn.close();
				heads_up_error();
			}
		});
	}

	function resetDiv(){
		$('#divTable').hide();
		$('#div_interviewee_list').show();
	}

	function open_doc(emp_id,id_shadule){

		var drop_down_value=$('#drop_down_value').val();
		if(drop_down_value!="") {
			location.replace('<?php echo base_url()?>employer/job_posts/ats_interviewee_form_maker_view?id='+drop_down_value+'&emp_id='+emp_id+'&id_shadule='+id_shadule+'');
		}else{
			Swal.fire(
					'--!',
					'Please Select Form Drop Down!.',
					'warning'
			);
		}
	}


</script>
