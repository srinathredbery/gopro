<style type="text/css">
	.dot_rad {
		height: 25px;
		width: 25px;
		background-color: red;
		border-radius: 50%;
		display: inline-block;
	}

	.dot_green {
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

	table {
		width: 100%;
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

	@media (min-width: 992px) {
		.col-lg-10.job-sec {
			-webkit-box-flex: 0;
			-ms-flex: 0 0 80%;
			flex: 0 0 80%;
			max-width: 80%;
		}

		.col-lg-10.job-sec {
			margin: 20px 10px;
			box-shadow: 0 4px 8px 0 rgb(0 0 0 / 5%), 0 6px 20px 0 rgb(0 0 0 / 7%);
		}
	}

	.btn-orange {
		padding: 5px 17px !important;
		border-color: #1EAAE7 !important;
		-webkit-border-radius: 6px;
		-moz-border-radius: 6px;
		-ms-border-radius: 6px;
		-o-border-radius: 6px;
		border-radius: 6px !important;
		margin: 15px 15px 0 0 !important;
	}

	.btn-orange:hover {
		background: #1eaae7 !important;
		color: #fff !important;
		padding: 6px 18px !important;
		border-color: #1eaae7 !important;
	}

	.manage-jobs-sec>h3 {
		margin-top: 10px !important;
	}

	.modal-body {
		padding-left: 35px !important;
	}
</style>
<section>
    <div class="block no-padding">
        <div class="container-fluid">
            <div class="row no-gape">

                <!--include side bar for employer-->
                <?php $this->load->view('include/side_bar_left_ats') ?>


                <div class="col-lg-10 column job-sec">
                    <div class="padding-right">
                        <button type="button" class="btn btn-orange btn-md" data-toggle="modal" data-target="#myModal"><span class="la la-plus"></span>&nbsp;Add New</button>
                    </div>
                    <div class="padding-left">
                        <div class="manage-jobs-sec">
                            <h3>Interview Details</h3>


                            <table class="datatable-init">
                                <thead>
                                <tr>
                                    <td style="display: none;">#</td>
                                    <td>#</td>
                                    <td>Location</td>
                                    <td>Location Address</td>
                                    <td>Room No</td>
                                    <td>Action</td>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (isset($active_job_posts) && !empty($active_job_posts)) {
                                    $i = 0;
                                    foreach ($active_job_posts as $active_post) {
                                        $i += 1;
                                        ?>
                                        <tr>
                                            <td style="display: none;"></td>
                                            <td>
                                                <?php echo $i; ?>
                                            </td>

                                            <td>
                                                    <span class="status">
                                                        <?php echo $active_post['location']; ?>
                                                    </span>
                                            </td>


                                            <td>
                                                    <span class="status">
                                                        <?php echo $active_post['address_l1']; ?>
                                                    </span>
                                                    <span class="status">
                                                        <?php echo ', '.$active_post['address_l2']; ?>
                                                    </span>
                                                <span class="status">
                                                        <?php echo ', '.$active_post['city']; ?>
                                                </span>
                                            </td>
                                            <td>
                                                    <span class="status">
                                                        <?php echo $active_post['room_no']; ?>
                                                    </span>
                                            </td>


                                            <td>
                                                    <span class="status">
                                                        <a class="la la-pencil text-info fa-2x" data-toggle="modal" data-target="#myModal" onclick="editInterviwer('<?php echo $active_post['idinterviewer_details'] ?>','<?php echo $active_post['location'] ?>','<?php echo $active_post['room_no'] ?>','<?php echo $active_post['address_l1'] ?>','<?php echo $active_post['address_l2']; ?>' , '<?php echo $active_post['city']; ?> ');"></a>&nbsp;
                                                        <a class="la la-trash text-danger fa-2x"
                                                           onclick="delete_interviwer_001('<?php
                                                            echo $active_post['idinterviewer_details']
                                                            ?>')"></a>
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
                <div class="col-lg-5 column">
                    <div class="padding-left" id="divTable" style="display: none;">
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
                                    <td>Status</td>
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
                <h4 class="modal-title">Interviewer Details</h4>
                <input type="hidden" id="id_interviewer" />
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form>
            <div class="modal-body">

                <div class="col-md-12 row">
                    <div class="col-md-3">
                        Location
                    </div>
                    <div class="col-md-9">
                        <input type="hidden" id="id_list" />
                        <input type="text" id="location" class="form-control" placeholder="Location" required/>
                    </div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-3">
                        Room No
                    </div>
                    <div class="col-md-9">

                        <input type="text" id="room_no" class="form-control" placeholder="Room No" />
                    </div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-3">
                        Location Address
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="address_l1" class="form-control" placeholder="Address Line 01" />
                    </div>
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-9">
                        <input type="text" id="address_l2" class="form-control" placeholder="Address Line 02" />
                    </div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-9">

                        <input type="text" id="city" class="form-control" placeholder="City" />
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn-success btn-sm" data-dismiss="modal" onclick="save_interviewer()">Save</button>
                <button type="button" class="btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>

    </div>
</div>


<script src="<?php echo base_url() ?>assets/plugins/datatables/datatables.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $('.datatable-init').DataTable({
            "order": [],
            language: {
                searchPlaceholder: "Search records"
            }
        });


    })

    // myModal
    function OpenModal() {
        $('#myModal').show();
    }



$('#myModal').on('hidden.bs.modal', function (e) {
  $(this)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
})






    function setJobs(id, Name) {
        $('#job_title').text(Name);
        $('#id_ViewJob').val(id);
        $('#jobs_emp_table_body').html("");

        $('#divTable').show();
        $('#jobs_emp_table').DataTable().destroy();

        var html = "";
        $.ajax({
            type: "GET",
            data: {
                id: id
            },
            dataType: 'json',
            url: base_url + 'employer/job_posts/ats_exam_schedule_emp_view',
            cache: true,
            beforeSend: function() {
                HoldOn.open(loader_options);
            },
            success: function(data) {
                HoldOn.close();


                for (var i = 0; i < data['applications'].length; i++) {
                    //jobseeker.jobseeker_first_name as jobseeker_first_name,jobseeker.jobseeker_middle_name as jobseeker_middle_name,jobseeker.jobseeker_last_name as jobseeker_last_name
                    var Frist_name = data['applications'][i]['jobseeker_first_name'];
                    var Middle_name = data['applications'][i]['jobseeker_middle_name'];
                    var Last_name = data['applications'][i]['jobseeker_last_name'];
                    var Date = data['applications'][i]['Date'];
                    var strat_time_hr = data['applications'][i]['strat_time_hr'];
                    var strat_time_min = data['applications'][i]['strat_time_min'];
                    var location = data['applications'][i]['location'];
                    var room_no = data['applications'][i]['room_no'];
                    var status_confirm = data['applications'][i]['status_confirm'];
                    //var jobseeker_first_name=data['applications'][i]['jobseeker_first_name'];
                    //var jobseeker_last_name=data['applications'][i]['jobseeker_last_name'];
                    //var applied_resume=data['applications'][i]['applied_resume'];
                    //
                    html += '<tr class="emply-resume-list_1" data-apl_id="" role="row">';
                    html += '<td>' + (i + 1) + '</td>';
                    html += '<td>' + Frist_name + ' ' + Middle_name + ' ' + Last_name + '</td>';
                    html += '<td>' + Date + '</td>';
                    html += '<td>' + strat_time_hr + ':' + strat_time_min + '</td>';
                    html += '<td>' + location + '</td>';
                    html += '<td>' + room_no + '</td>';
                    html += '<td><select ><option>Test 001</option><option>Test 002</option><option>Test 003</option></select></td>';
                    if (status_confirm == 0) {
                        html += '<td class="text-center"><a class="dot_rad" ></a></td>';
                    } else {
                        html += '<td class="text-center"><a class="dot_green" ></a></td>';
                    }
                    html += '<td class="text-center"><a href="<?php echo base_url() ?>employer/job_posts/ats_setup_exam_maker_mark?"><span class="la la-id-card"></span></a></td>';
                    html += '</tr>';
                }


                $('#jobs_emp_table_body').html(html);
                $('#jobs_emp_table').DataTable({
                    "order": [],
                    language: {
                        searchPlaceholder: "Search records"
                    }
                });

            },
            error: function(jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
            }
        });


    }



    $('.open-letter2').click(function(e) {
        let c_id = $(this).closest('.emply-resume-list_1').data("apl_id");
        let js_name = $('#job_title').text();

        $.ajax({
            type: "GET",
            data: {
                cl_uid: c_id
            },
            dataType: 'json',
            url: base_url + 'employer/applications_received/view_candidate/cover_letter',
            cache: true,
            beforeSend: function() {
                HoldOn.open(loader_options);
            },
            success: function(data) {
                HoldOn.close();

                $('.cover-letter h3').text(js_name);
                $('.cover-letter-content').empty().html(data.cover_letter_content);
                $('.coverletter-popup').fadeIn();
                $('html').addClass('no-scroll');

            },
            error: function(jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
            }
        });
    });

    function ViewCoverLatter(id) {
        let c_id = id;
        let js_name = $('#job_title').text();

        $.ajax({
            type: "GET",
            data: {
                cl_uid: c_id
            },
            dataType: 'json',
            url: base_url + 'employer/applications_received/view_candidate/cover_letter',
            cache: true,
            beforeSend: function() {
                HoldOn.open(loader_options);
            },
            success: function(data) {
                HoldOn.close();

                $('.cover-letter h3').text(js_name);
                $('.cover-letter-content').empty().html(data.cover_letter_content);
                $('.coverletter-popup').fadeIn();
                $('html').addClass('no-scroll');

            },
            error: function(jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
            }
        });
    }


    function save_interviewer() {

        var id_list = $('#id_list').val();
        var isSave = $('#id_interviewer').val();

        var location = $('#location').val();
        var room_no = $('#room_no').val();
        var address_l1 = $('#address_l1').val();
        var address_l2 = $('#address_l2').val();
        var city= $('#city').val();

        if(location==""){
            Swal.fire(
                    'Required!',
                    'Location field Required',
                    'warning'
            );
        }else if(room_no==""){
            Swal.fire(
                    'Required!',
                    'Room No field Required',
                    'warning'
            );
        }else if(address_l1==""){
            Swal.fire(
                    'Required!',
                    'Address Line  field Required',
                    'warning'
            );
        }else{

        if (isSave == '') {
            isSave = 1;
        }

        $.ajax({
            type: "GET",
            data: {
                isSave: isSave,
                location: location,
                room_no: room_no,
                address_l1: address_l1,
                address_l2: address_l2,
                city:city,
                id_list: id_list
            },
            dataType: 'json',
            url: base_url + 'employer/job_posts/ats_save_interviewer_details',
            cache: true,
            beforeSend: function() {
                HoldOn.open(loader_options);
            },
            success: function(data) {
                HoldOn.close();
                Swal.fire(
                        'Saved!',
                        'Successfully saved interviewe',
                        'success'
                );
                window.location.reload(true);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
            }
        });
        }


    }

    function editInterviwer(id, location, room_no, address_l1, address_l2, city) {

        $('#id_list').val(id);
        $('#location').val(location);
        $('#room_no').val(room_no);
        $('#address_l1').val(address_l1);
        $('#address_l2').val(address_l2);
        $('#city').val(city);

    }

    function delete_interviwer_001(id) {
        $.ajax({
            type: "GET",
            data: {
                id_list: id
            },
            dataType: 'json',
            url: base_url + 'employer/job_posts/ats_delete_interviewer_details',
            cache: true,
            beforeSend: function() {
                HoldOn.open(loader_options);
            },
            success: function(data) {
                HoldOn.close();
                Swal.fire(
                        'Delete!',
                        'Successfully deleted!',
                        'success'
                );

                location.reload();

            },
            error: function(jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
            }
        });


    }
</script>
