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

    .dataTables_wrapper{
        width:100% !important;
    }
    table.dataTable {
    width: 100% !important
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
                            <h3 >Job Posts</h3>

                            <table class="datatable-init jobpost-table">
                                <thead>
                                <tr>
                                    <td>Title</td>
                                    <td>No of Applicants</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (isset($active_job_posts) && !empty($active_job_posts)) {
                                    foreach ($active_job_posts as $active_post) {
                                        if (!empty($active_post['job_post_job_type'])) {
                                            if ($active_post['job_post_job_type']==1) {
                                                $job_type_class = 'tp';
                                            } elseif ($active_post['job_post_job_type']==2) {
                                                $job_type_class = 'fl';
                                            } elseif ($active_post['job_post_job_type']==3) {
                                                $job_type_class = 'ft';
                                            } elseif ($active_post['job_post_job_type']==4) {
                                                $job_type_class = 'it';
                                            } elseif ($active_post['job_post_job_type']==5) {
                                                $job_type_class = 'pt';
                                            }
                                        }
                                        ?>
                                        <tr onclick="setJobs(<?php echo $active_post['job_post_id']; ?> ,'<?php echo $active_post['job_post_title']; ?>','*') ">
                                            <td>
                                                <div class="table-list-title">
                                                    <h3 style="font-weight:600; font-size: 14px;"><a href="<?php echo !empty($active_post['job_post_id']) ? base_url().'jobs/view_job_post?jp_token='. base64_encode($active_post['job_post_id']): '' ?>" target="_blank" title=""><?php echo !empty($active_post['job_post_title']) ?  substr($active_post['job_post_title'], 0, 30) :''?></a></h3>
                                                    <span><i class="la la-map-marker"></i><?php  if (!empty($active_post['job_post_city'])) {
                                                        echo $active_post['job_post_city'];
                                                                                          }; ?></span>
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
                <div class="col-lg-5 column job-sec" id="divTable" style="display: none;">
                    <div class="padding-left" >
                        <div class="manage-jobs-sec">
                            <h3 id="job_title">Job Posts</h3>
                            <select id="status">
                                <option value="*">All</option>
                                <option>Finalized</option>
                                <option>Pending</option>
                                <option>Failed</option>
                            </select>
                    <input id="id_ViewJob" type="hidden"/>
                    <table id="jobs_emp_table" class="datatable-init">
                        <thead>
                        <tr>
                            <td style="display: none;">#</td>
                            <td>#</td>
                            <td>Name</td>
                            <td>Exam</td>
                            <td>Overall</td>
                            <td>Status</td>
                            <td>Date</td>
                        </tr>
                        </thead>
                        <tbody id="jobs_emp_table_body">

                        </tbody>
                    </table>
                        </div>
                    </div>

                    <button class="btn-primary" id="send_offer_btn" onclick="sendOffer(1)"><span class="la la-send"></span>&nbsp;send offer</button>
                    <div class="manage-jobs-sec row">
                    </div>
                </div>

            </div>
        </div>
</section>


<!-----------------------------ctg modal--------------------------->
<div class="modal fade" id="myModal_offer_atter" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Send Offer</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="ctg_list">

                <div class="col-md-12 row">
                <h6><b>Company Offer Letters </b></h6>

                        <input type="hidden" id="checkedExam_id">
                        <table id="example" class="datatable-init col-md-12">
                            <thead>
                            <tr>
                                <td>#</td>
                                <td>ID</td>
                                <td style="width: 150px;">Description</td>
                            </tr>
                            </thead>
                            <tbody id="jobs_emp_table_body_exam" style="width: 100%;">

                            </tbody>
                        </table>

                        <br>

                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-success btn-sm" onclick="Send_mail()">Send</button>
                <button type="button" class="btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--------------------------------------------------------------------------->
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
                        <input type="number" class="form-control" id="st_time" min="-1" max="24"/>
                    </div>
                    <div class="col-md-4">
                        <input type="number" class="form-control" id="st_time_end" min="-1" max="59"/>
                    </div>
                </div>
                <br>
                <div class="col-md-12 row">
                    <div class="col-md-3">
                        Duration
                    </div>
                    <div class="col-md-4">
                        <input type="number" class="form-control" min="-1" id="du_time" max="24"/>
                    </div>
                    <div class="col-md-4">
                        <input type="number" class="form-control" min="-1" id="du_time_end" max="59"/>
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
                        <select class="form-control" id="room_no">
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
                        Interviewer
                    </div>
                    <div class="col-md-8">
                        <select class="form-control" id="interviewer">
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
                        <input type="text" id="confirmation" />
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn-success" data-dismiss="modal" onclick="save_shadule()">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<script src="<?php echo base_url()?>assets/plugins/datatables/datatables.js" type="text/javascript"></script>
<script>
    function setExamSummary() {

        var html = "";
        $.ajax({
            type: "GET",
            data: {
            },
            dataType: 'json',
            url: base_url + 'employer/job_posts/ats_offer_latter_comapny',
            cache: true,
            beforeSend: function() {
                HoldOn.open(loader_options);
            },
            success: function(data) {
                HoldOn.close();
                $('#example').DataTable().destroy();
                for (var i = 0; i < data['applications'].length; i++) {
                    var application_no = data['applications'][i]['description'];
                    // var Level = data['applications'][i]['Level'];
                    var status = data['applications'][i]['status'];
                    // var create_date = data['applications'][i]['create_date'];
                    var id = data['applications'][i]['id_offer_latter'];

                    html += '<tr class="emply-resume-list_1" data-apl_id="' + application_no + '" role="row">';
                    html += '<td><div class="level-1-layer">\n' +
                            '<div class="item-radio">\n' +
                            '<input type="radio" id="' + id + '" name="acces_radio_exam" value="' + id + '" class="">\n' +
                            '<label class="filter-label" for="' + id + '"></label>\n' +
                            '</div>\n' +
                            '</div></td>';
                    html += '<td>' + (i + 1) + '</td>';
                    html += '<td>' + application_no + '</td>';
                    html += '</tr>';
                }


                $('#jobs_emp_table_body_exam').html(html);


                $('#example').DataTable({
                    "order": [],
                    language: {
                        searchPlaceholder: "Search records"
                    }
                });

                $("input[name='acces_radio_exam']").change(function() {
                    var id = $(this).val();
                    $('#checkedExam_id').val(id);
                });


            },
            error: function(jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
            }
        });




    }
    $(document).ready(function () {





        $('#send_offer_btn').hide();
        $('.datatable-init').DataTable({
            "order": [],
            language: {
                searchPlaceholder: "Search records"
            }
        });
        $('#status').on('change',function (){
            var ctg=$(this).val();
            var id=$('#id_ViewJob').val();
            var Name=$('#job_title').text();
            setJobs(id,Name,ctg);

            if(ctg=='Finalized'){
                $('#send_offer_btn').show();
            }else{
                $('#send_offer_btn').hide();
            }
        });

    })

    // myModal
    function OpenModal(){
        $('#myModal').show();
    }





    function setJobs(id,Name,ctg){
        $('#job_title').text(Name);
        $('#id_ViewJob').val(id);
        $('#jobs_emp_table_body').html("");

        $('#jobs_emp_table').DataTable().destroy();
        $('#divTable').show();

        var html="";
        $.ajax({
            type: "GET",
            data:{id: id,ctg:ctg},
            dataType: 'json',
            url: base_url+'employer/job_posts/ats_overall_data',
            cache: true,
            beforeSend: function(){
                HoldOn.open(loader_options);
            },
            success: function (data) {
                HoldOn.close();


                for(var i=0;i<data['applications'].length;i++){
                    //jobseeker.jobseeker_first_name as jobseeker_first_name,jobseeker.jobseeker_middle_name as jobseeker_middle_name,jobseeker.jobseeker_last_name as jobseeker_last_name
                    var Frist_name=data['applications'][i]['jobseeker_first_name'];
                    var Middle_name=data['applications'][i]['jobseeker_middle_name'];
                    var Last_name=data['applications'][i]['jobseeker_last_name'];
                    var Date=data['applications'][i]['Date'];

                    var examIDD=data['applications'][i]['exam_ids'];

                    var jobseeker_id=data['applications'][i]['jobseeker_id'];
                    var emp_id=data['applications'][i]['emp_id'];
                    var finalize_status=data['applications'][i]['finalize_status'];


                    var Name=Frist_name+' '+Middle_name+' '+Last_name;
                    var mcq_percentage='45';
                    get_tot_percentage(emp_id,examIDD,i);
                    html+='<tr class="emply-resume-list_1" data-apl_id="" role="row">';
                    html+='<td style="display: none;">'+emp_id+'</td>';
                    html+='<td>';
                    html+=' <br><div class="level-1-layer">';
                    html+=' <div class="item-checkbox">';
                    html+=' <input type="checkbox" name="access_func[]" class="filter-input route-parent rou-1" value="1" id="par-'+emp_id+'-'+examIDD+'">';
                    html+='<label class="filter-label" for="par-'+emp_id+'-'+examIDD+'"></label>';
                    html+=' </div>';
                    html+=' </div>';
                    html+='</td>';
                    html+='<td>'+Frist_name+' '+Middle_name+' '+Last_name+'</td>';
                    html+='<td>'+75+'%</td>';
                    html+='<td><label id="lbl003_'+i+'"></label>%</td>';
                    html+='<td>'+finalize_status+'</td>';
                    html+='<td>'+Date.split(' ')[0]+'</td>';
                    html+='</tr>';
                }


                $('#jobs_emp_table_body').html(html);
                $('#jobs_emp_table').DataTable({
                    "order": [],
                    language: {
                        searchPlaceholder: "Search records"
                    }
                });


            },
            error: function (jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
            }
        });


    }

    function get_tot_percentage(emp_id,examIDD,i){
        //get_data_emp_mcq
        var return_value=0;
        $.ajax({
            type: "GET",
            data:{emp_id: emp_id,examIDD:examIDD},
            dataType: 'json',
            url: base_url+'employer/job_posts/get_tot_percentage',
            cache: true,
            beforeSend: function(){

            },
            success: function (data) {

                return_value=data.id;
                $('#lbl003_'+i).html(parseFloat(return_value).toFixed(2));

            },
            error: function (jqXHR, textStatus, errorThrown) {
                // HoldOn.close();
                // heads_up_error();
            }
        });
        return return_value;
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

    function save_shadule(){

     var st_time=$('#st_time').val();
     var st_time_end=$('#st_time_end').val();
     var du_time=$('#du_time').val();
     var du_time_end=$('#du_time_end').val();
     var date=$('#date').val();
     var location=$('#location').val();
     var room_no=$('#room_no').val();
     var interviewer=$('#interviewer').val();
     var confirmation=$('#confirmation').val();
     var emp_id=1;
     var post_job_id=$('#id_ViewJob').val();

     $('#jobs_emp_table_body tr').each(function () {
            var tr = $(this);
            var id = tr.find('td:nth-child(1)').text();
            var inputCheck=$('#par-'+id+'').prop('checked');


         if (inputCheck) {
                emp_id= tr.find('td:nth-child(1)').text();

        $.ajax({
            type: "GET",
            data:{
                st_time: st_time,st_time_end:st_time_end,du_time:du_time,du_time_end:du_time_end,
                date:date,location:location,room_no:room_no,interviewer:interviewer,
                confirmation:confirmation,emp_id:emp_id,job_post_id:post_job_id
            },
            dataType: 'json',
            url: base_url+'employer/job_posts/ats_emp_schedule_exam',
            cache: true,
            beforeSend: function(){
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

    }

    function Send_mail(){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to send the offer letter?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, send it!'
        }).then((result) => {
            //set ajax function mail...
//
            //end..
            if (result.value) {
                Swal.fire(
                        'Send Offer!',
                        'Your file has been sended.',
                        'success'
                )
            }
        })
    }
    function sendOffer(id){
        $('#myModal_offer_atter').modal('show');
        setExamSummary();


    }




</script>
