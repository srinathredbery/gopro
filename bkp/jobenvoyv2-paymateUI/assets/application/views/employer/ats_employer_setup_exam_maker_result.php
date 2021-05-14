<style>
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
        .col-lg-5.job-sec{
            -webkit-box-flex: 0;
            -ms-flex: 0 0 40%;
            flex: 0 0 40%;
            max-width: 40%;
        }

        .col-lg-5.job-sec {
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

                <div class="col-lg-5 column job-sec">
                    <div class="padding-left">
                        <div class="manage-jobs-sec">
                            <h3>Job Posts</h3>
                            <table class="datatable-init jobpost-table">
                                <thead>
                                    <tr>
                                        <td style="width: 280px;">Title</td>
                                        <td>No of Applicants</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($active_job_posts) && !empty($active_job_posts)) {
                                        foreach ($active_job_posts as $active_post) {
                                            if (!empty($active_post['job_post_job_type'])) {
                                                if ($active_post['job_post_job_type'] == 1) {
                                                    $job_type_class = 'tp';
                                                } elseif ($active_post['job_post_job_type'] == 2) {
                                                    $job_type_class = 'fl';
                                                } elseif ($active_post['job_post_job_type'] == 3) {
                                                    $job_type_class = 'ft';
                                                } elseif ($active_post['job_post_job_type'] == 4) {
                                                    $job_type_class = 'it';
                                                } elseif ($active_post['job_post_job_type'] == 5) {
                                                    $job_type_class = 'pt';
                                                }
                                            }
                                            ?>
                                            <tr onclick="setJobs(<?php echo $active_post['job_post_id']; ?> ,'<?php echo $active_post['job_post_title']; ?>') ">
                                                <td>
                                                    <div class="table-list-title">
                                                        <h3 style="font-weight:600; font-size: 14px;"><a href="<?php echo !empty($active_post['job_post_id']) ? base_url() . 'jobs/view_job_post?jp_token=' . base64_encode($active_post['job_post_id']) : '' ?>" target="_blank" title=""><?php echo !empty($active_post['job_post_title']) ?  substr($active_post['job_post_title'], 0, 30) : '' ?></a></h3>
                                                        <span><i class="la la-map-marker"></i> <?php if (!empty($active_post['job_post_city'])) {
                                                                                                    echo $active_post['job_post_city'];
                                                                                               }; ?></span>
                                                    </div>
                                                </td>

                                                <td>
                                                    <span class="status active application-count applied">
                                                        <a <?php echo !empty($active_post['no_of_applications']) && $active_post['no_of_applications'] > 0 ? 'href="' . base_url() . 'employer/applications_received?jp_id=' . $active_post['job_post_id'] . '" title="View Applications Received"' : 'title="No Applications Received "' ?>><?php echo !empty($active_post['no_of_applications']) ? $active_post['no_of_applications'] : 'No' ?> Applications</a>
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
                <div class="col-lg-5 column job-sec" id="divTable" style="display: none;">
                    <div class="padding-left">
                        <div class="manage-jobs-sec">
                            <h3 id="job_title">Job Posts</h3>
                            <input id="id_ViewJob" type="hidden" />
                            <table id="jobs_emp_table" class="datatable-init">
                                <thead>
                                    <tr>
                                        <td style="display: none;">#</td>
                                        <td style="display: none;">#</td>
                                        <td>#</td>
                                        <td>Name</td>
                                        <td>MCQ</td>
                                        <td>Short Answer</td>
                                        <td>Total</td>
                                        <td>Date</td>
                                        <td>Paper Correction</td>
                                    </tr>
                                </thead>
                                <tbody id="jobs_emp_table_body">

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="manage-jobs-sec row">


                        <div class="col-md-5 offset-7">
                            <button type="button" class="btn-success btn-sm" data-toggle="modal" onclick="OpenmyModal()" id="btnOpen">Schedule Interview</button>
                        </div>

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
                <h4 class="modal-title">Schedule Interview.</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 row">
                    <div class="col-md-3">
                        Start Time
                    </div>
                   <!--  <div class="col-md-4">
                        <input type="hidden" placeholder="Hrs" class="form-control" id="st_time" min="-1" max="24" />
                    </div> -->
                    <div class="col-md-8">
                        <input type="hidden" placeholder="Hrs" class="form-control" id="st_time" min="-1" max="24" />
                        <input type="hidden" placeholder="Min" class="form-control" id="st_time_end" min="-1" max="59" />



<input type="text" name="start_time" class="datetimepicker-input time-picker" id="interview_start_time" data-toggle="datetimepicker" data-target="#interview_start_time" autocomplete="off"  onchange="fillFunction()"/>

<script>
function fillFunction(){
    //interview_start_time
 var x = document.getElementById("interview_start_time").value;
 var res = x.split(":");
 $('#st_time').val(res[0]);
 $('#st_time_end').val(res[1]);
 

    }
    </script>



                        
                    </div>








                </div>
                <br>
                <div class="col-md-12 row">
                    <div class="col-md-3">
                        Duration
                    </div>
                    <div class="col-md-4">
                        <input type="number" placeholder="Hrs" class="form-control" min="-1" id="du_time" max="24" />
                    </div>
                    <div class="col-md-4">
                        <input type="number" placeholder="Min" class="form-control" min="-1" id="du_time_end" max="59" />
                    </div>
                </div>
                <br>
                <div class="col-md-12 row">
                    <div class="col-md-3">
                        Date
                    </div>
                    <div class="col-md-8">
                        <input type="date" class="form-control" id="date" />
                    </div>
                </div>
                <br>
                <div class="col-md-12 row">
                    <div class="col-md-3">
                        Location
                    </div>
                    <div class="col-md-8">
                        <select class="form-control" id="location">
                            <option disabled> -select- </option>
                            <?php $navigation_top_menu_main2 = get_interviewer_location();
                            foreach ($navigation_top_menu_main2 as $element) { ?>
                                <option value="<?php echo $element['idinterviewer_details']; ?>"><?php echo $element['location']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div>
                    <div class="col-md-12" style="padding-left: 150px;">
                    <labele id="address_l1"></labele><br>
                    <labele id="address_l2"></labele><br>
                    <labele id="city"></labele><br>
                    <labele id="room_no"></labele>
                    </div>
                </div>
                <br>
                <div class="col-md-12 row">
                    <div class="col-md-3">
                        Interviewer
                    </div>

                    <div class="col-md-8">
                        <select class="form-control" id="interviewer">
                            <option disabled> -select- </option>
                            <?php $navigation_top_menu_main = get_interviewer();
                            foreach ($navigation_top_menu_main as $element) { ?>
                                    <option value="<?php echo $element['idinterviewer_list']; ?>"><?php echo $element['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div>
                    <div class="col-md-12" style="padding-left: 150px;">
                        <labele id="contact_number"></labele><br>
                    </div>
                </div>
                <br>
                <div class="col-md-12 row" style="display: none;">
                    <div class="col-md-3">
                        Confirmation Link
                    </div>
                    <div class="col-md-8">
                        <input type="text" id="confirmation" />
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn-success btn-sm" data-dismiss="modal" onclick="save_shadule()">Send</button>
                <button type="button" class="btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<script src="<?php echo base_url() ?>assets/plugins/datatables/datatables.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $('.datatable-init').DataTable({
            "order": []
        });





    })

    // myModal
    function OpenModal() {
        $('#myModal').show();
    }


    function setJobs(id, Name) {
        $('#job_title').text(Name);
        $('#id_ViewJob').val(id);

        $('#jobs_emp_table_body').html("");
        $('#jobs_emp_table').DataTable().destroy();
        $('#divTable').show();


        var html = "";
        $.ajax({
            type: "GET",
            data: {
                id: id
            },
            dataType: 'json',
            url: base_url + 'employer/job_posts/ats_exam_assing_emp_view',
            cache: true,
            beforeSend: function() {
                HoldOn.open(loader_options);
            },
            success: function(data) {
                HoldOn.close();

                var examIDD = '';
                var emp_id = '';
                for (var i = 0; i < data['applications'].length; i++) {
                    var isExam = (examIDD == data['applications'][i]['exam_ids']);
                    var isEmp = (emp_id == data['applications'][i]['emp_id']);
                    //jobseeker.jobseeker_first_name as jobseeker_first_name,jobseeker.jobseeker_middle_name as jobseeker_middle_name,jobseeker.jobseeker_last_name as jobseeker_last_name
                    var Frist_name = data['applications'][i]['jobseeker_first_name'];
                    var Middle_name = data['applications'][i]['jobseeker_middle_name'];
                    var Last_name = data['applications'][i]['jobseeker_last_name'];
                    var Date = data['applications'][i]['Date'];
                    examIDD = data['applications'][i]['exam_ids'];
                    var jobseeker_id = data['applications'][i]['jobseeker_id'];
                    emp_id = data['applications'][i]['emp_id'];
                    var Name = Frist_name + ' ' + Middle_name + ' ' + Last_name;
                    var count_total = i;

                    get_mcq(emp_id, examIDD, i);
                    get_data_emp_short_answer(emp_id, examIDD, i);
                    get_tot_percentage(emp_id, examIDD, i)
                    html += '<tr class="emply-resume-list_1" data-apl_id="" role="row">';
                    html += '<td style="display: none;">' + emp_id + '</td>';
                    html += '<td style="display: none;">' + examIDD + '</td>';
                    html += '<td>';
                    html += '<br><div class="level-1-layer">';
                    html += '<div class="item-checkbox">';
                    html += '<input type="checkbox" class="filter-input route-parent rou-1" value="1" id="par-' + emp_id + examIDD + '" name="p' + i + '">';
                    html += '<label class="filter-label" for="par-' + emp_id + examIDD + '"></label>';
                    html += '</div>';
                    html += '</div>';
                    html += '</td>';
                    html += '<td>' + Frist_name + ' ' + Middle_name + ' ' + Last_name + '</td>';
                    html += '<td><label id="lbl001_' + i + '" ></label>%</td>';
                    html += '<td><label id="lbl002_' + i + '" ></label>%</td>';
                    html += '<td><label id="lbl003_' + i + '" ></label>%</td>';
                    html += '<td>' + Date.split(' ')[0] + '</td>';
                    html += '<td class="text-center"><a href="<?php echo base_url() ?>employer/job_posts/ats_setup_exam_maker_mark?id=' + examIDD + '&&emp_id=' + emp_id + '&&Name=' + Name + '"><span class="la la-file-text text-success fa-2x"></span></a></td>';

                    html += '</tr>';




                }


                $('#jobs_emp_table_body').html(html);

                $('#jobs_emp_table').DataTable({
                    "order": []
                });


            },
            error: function(jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
            }
        });


    }

    function get_mcq(emp_id, examIDD, i) {
        //get_data_emp_mcq
        var return_value = 0;
        $.ajax({
            type: "GET",
            data: {
                emp_id: emp_id,
                examIDD: examIDD
            },
            dataType: 'json',
            url: base_url + 'employer/job_posts/get_data_emp_mcq',
            cache: true,
            beforeSend: function() {

            },
            success: function(data) {

                return_value = data.id;
                $('#lbl001_' + i).html(parseFloat(return_value).toFixed(2));

            },
            error: function(jqXHR, textStatus, errorThrown) {
                // HoldOn.close();
                // heads_up_error();
            }
        });
        return return_value;
    }

    function get_data_emp_short_answer(emp_id, examIDD, i) {
        //get_data_emp_mcq
        var return_value = 0;
        $.ajax({
            type: "GET",
            data: {
                emp_id: emp_id,
                examIDD: examIDD
            },
            dataType: 'json',
            url: base_url + 'employer/job_posts/get_data_emp_short_answer',
            cache: true,
            beforeSend: function() {

            },
            success: function(data) {

                return_value = data.id;
                $('#lbl002_' + i).html(parseFloat(return_value).toFixed(2));

            },
            error: function(jqXHR, textStatus, errorThrown) {
                // HoldOn.close();
                // heads_up_error();
            }
        });
        return return_value;
    }

    function get_tot_percentage(emp_id, examIDD, i) {
        //get_data_emp_mcq
        var return_value = 0;
        $.ajax({
            type: "GET",
            data: {
                emp_id: emp_id,
                examIDD: examIDD
            },
            dataType: 'json',
            url: base_url + 'employer/job_posts/get_tot_percentage',
            cache: true,
            beforeSend: function() {

            },
            success: function(data) {

                return_value = data.id;

                $('#lbl003_' + i).html(parseFloat(return_value).toFixed(2));

            },
            error: function(jqXHR, textStatus, errorThrown) {
                // HoldOn.close();
                // heads_up_error();
            }
        });
        return return_value;
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

    function save_shadule() {

        var st_time = $('#st_time').val();
        var st_time_end = $('#st_time_end').val();
        var du_time = $('#du_time').val();
        var du_time_end = $('#du_time_end').val();
        var date = $('#date').val();
        var location = $('#location').val();
        var room_no = $('#room_no').val();
        var interviewer = $('#interviewer').val();
        var confirmation = $('#confirmation').val();
        var emp_id = 1;
        var post_job_id = $('#id_ViewJob').val();

        if(date!="") {
            Swal.fire({
                title: 'Do you want to send this interview?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, send!'
            }).then((result) => {
                if (result.value) {

                    $('#jobs_emp_table_body tr').each(function () {
                        var tr = $(this);
                        var id = tr.find('td:nth-child(1)').text();
                        var exam_id = tr.find('td:nth-child(2)').text();
                        var inputCheck = $('#par-' + id + exam_id + '').prop('checked');

                        if (inputCheck) {
                            emp_id = tr.find('td:nth-child(1)').text();

                            $.ajax({
                                type: "GET",
                                data: {
                                    st_time: st_time,
                                    st_time_end: st_time_end,
                                    du_time: du_time,
                                    du_time_end: du_time_end,
                                    date: date,
                                    location: location,
                                    room_no: room_no,
                                    interviewer: interviewer,
                                    confirmation: confirmation,
                                    emp_id: emp_id,
                                    job_post_id: post_job_id
                                },
                                dataType: 'json',
                                url: base_url + 'employer/job_posts/ats_emp_schedule_exam',
                                cache: true,
                                beforeSend: function () {
                                    HoldOn.open(loader_options);
                                },
                                success: function (data) {
                                    HoldOn.close();
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    HoldOn.close();
                                    heads_up_error();
                                }
                            });


                        }

                    });

                    Swal.fire(
                            'Saved!',
                            'Successfully sent Interview ',
                            'success'
                    )

                }
            })
        }else{

            Swal.fire(
                    'Check!!!',
                    'Check Date',
                    'warning'
            )
        }

    }

    $('#location').on('change',function (){
          var id=$(this).val();
//employer/job_posts/ats_exam_assing_emp_view
        $.ajax({
            type: "GET",
            data: {
                id: id
            },
            dataType: 'json',
            url: base_url + 'employer/job_posts/ats_get_location',
            cache: true,
            beforeSend: function() {
                HoldOn.open(loader_options);
            },
            success: function(data) {
                HoldOn.close();

                // for (var i = 0; i < data['applications'].length; i++) {
                    var room_no =data['applications'][0]['room_no'];
                    var address_l1 =data['applications'][0]['address_l1'];
                    var address_l2 =data['applications'][0]['address_l2'];
                    var city =data['applications'][0]['city'];
                    var address_l2 =data['applications'][0]['address_l2'];

                    $('#address_l1').text(address_l1);
                    $('#address_l2').text(address_l2);
                    $('#city').text(city);
                    $('#room_no').text('Room No: '+room_no);
                // }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
            }
        });
    })

    $('#interviewer').on('change',function (){
        var id=$(this).val();
        //employer/job_posts/ats_exam_assing_emp_view
        $.ajax({
            type: "GET",
            data: {
                id: id
            },
            dataType: 'json',
            url: base_url + 'employer/job_posts/ats_get_contact',
            cache: true,
            beforeSend: function() {
                HoldOn.open(loader_options);
            },
            success: function(data) {
                HoldOn.close();

                // for (var i = 0; i < data['applications'].length; i++) {
                var contact_number =data['applications'][0]['contact_number'];

                $('#contact_number').text(contact_number);

                // }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
            }
        });
    })


    $('#btnOpen').on('click',function () {
        $('#st_time').val("");
        $('#st_time_end').val("");
        $('#du_time').val("");
        $('#du_time_end').val("");
        $('#date').val("");
        $('#location').val("");
        $('#address_l1').text("");
        $('#address_l2').text("");
        $('#city').text("");
        $('#room_no').text("");
        $('#interviewer').val("");
    });

    function OpenmyModal(){

        var num=0;
        $('#jobs_emp_table_body tr').each(function() {
            var tr = $(this);
            var id = tr.find('td:nth-child(1)').text();
            var exam_id = tr.find('td:nth-child(2)').text();
            var inputCheck = $('#par-' + id + exam_id + '').prop('checked');

            if (inputCheck) {
                num=num+1;
            }
        });
        //
        if(num>0){
            $('#myModal').modal('toggle');
        }
    }

    $('#st_time').on('change',function (){
        var hrs=$('#st_time').val();
        if((hrs<0) || (hrs > 23)){
            $('#st_time').val("");
        }
    });

    $('#st_time_end').on('change',function (){
        var Min=$('#st_time_end').val();
        if((Min<0) || (Min >59)){
            $('#st_time_end').val("");
        }
    });

    $('#du_time').on('change',function (){
        var hrs=$('#du_time').val();
        if((hrs<0) || (hrs > 23)){
            $('#du_time').val("");
        }
    });

    $('#du_time_end').on('change',function (){
        var Min=$('#du_time_end').val();
        if((Min<0) || (Min >59)){
            $('#du_time_end').val("");
        }
    });


    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0 so need to add 1 to make it 1!
    var yyyy = today.getFullYear();
    if(dd<10){
        dd='0'+dd
    }
    if(mm<10){
        mm='0'+mm
    }
    today = yyyy+'-'+mm+'-'+dd;
    $('#date').attr("min", today);

</script>
