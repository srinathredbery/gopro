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
        background-color: #1eaae7;
        border-radius: 30px;
        padding: 4px 12px;
    }
    .application-count.applied:hover {
        background-color: #3d5a80;
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


    .dropdown-style {
        border-radius: 5px;
        background: #e4e4e4;
        border: 1px solid #e4e4e4;
        text-align: left;
        font-size: 12px;
        font-weight: 400;
        padding: 10px 20px;
        color: #6c757d;
        width: 100%;
    }
    .dropdown-style::after {
        float: right;
    }
    .box {
        border: 1px solid #1eaae7;
        color: black;
        background-color: white;
        padding: 5px 18px;
        display: none;
        margin-top: 10px;
        font-size: 12px;
    }

    .dropdown-menu {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        border: none;
        font-size: 14px!important;
        margin: 0;
        width: 100%;
    }

    .dropdown-item.active, .dropdown-item:active {
        color: #fff;
        text-decoration: none;
        background-color: #1eaae7;
    }

    /*tab style*/
    .nav-item .nav-link, .nav-tabs .nav-link {
        -webkit-transition: all 300ms ease 0s;
        -moz-transition: all 300ms ease 0s;
        -o-transition: all 300ms ease 0s;
        -ms-transition: all 300ms ease 0s;
        transition: all 300ms ease 0s;
    }

    .card a {
        -webkit-transition: all 150ms ease 0s;
        -moz-transition: all 150ms ease 0s;
        -o-transition: all 150ms ease 0s;
        -ms-transition: all 150ms ease 0s;
        transition: all 150ms ease 0s;
    }

    .nav-tabs {
        border: 0;
        padding: 15px 0.7rem;
    }

    .card .nav-tabs {
        border-top-right-radius: 0.1875rem;
        border-top-left-radius: 0.1875rem;
    }

    .nav-tabs>.nav-item>.nav-link {
        margin: 0;
        margin-right: 5px;

        border: 1px solid transparent;
        font-size: 14px;
        padding: 11px 23px;
        line-height: 1.5;

        border-bottom: 2px solid #d9ebfb!important;
        border-radius: 0px !important;
        color: #a6d0f7;
    }

    .nav-tabs>.nav-item>.nav-link.active {
        background-color: transparent;
        color: #1eaae7;
        border-top: none!important;
        box-shadow: none;
        border-bottom: 2px solid #1eaae7!important;
        border-radius: 0px !important;
    }

    .nav-tabs.nav-tabs-neutral>.nav-item>.nav-link {
        color: #FFFFFF;
    }

    .nav-tabs.nav-tabs-neutral>.nav-item>.nav-link.active {
        background-color: rgba(255, 255, 255, 0.2);
        color: #FFFFFF;
    }

    .card {
        border: 0;
        display: inline-block;
        position: relative;
        width: 100%;
        margin-bottom: 30px;
        box-shadow: 0 2px 4px 0 rgb(0 0 0 / 0%), 0 2px 10px 0 rgb(0 0 0 / 8%);
    }

    .card .card-header {
        background-color: transparent;
        border-bottom: 0;
        padding: 0;
    }

    .nav.nav-tabs {
        border: none;
    }

    .nav.nav-tabs > li {
        margin-top: 4px;
    }

    .nav-tabs .nav-link.active{
        border-radius: 8px !important;
    }

    @media screen and (max-width: 768px) {
        .nav-tabs {
            display: inline-block;
            width: 100%;
            padding-left: 100px;
            padding-right: 100px;
            text-align: center;
        }

        .nav-tabs .nav-item>.nav-link {
            margin-bottom: 5px;
        }
    }

.dataTables_wrapper .dataTables_filter input {
    width: 121px  !important;
}




    /*end tab style*/
</style>


<section>
    <div class="block no-padding">
        <div class="container-fluid">
            <div class="row no-gape">

                <!--include side bar for employer-->
                <?php $this->load->view('include/side_bar_left_ats')?>

                <div class="col-lg-5 column job-sec">
                    <div class="padding-left">
                        <div class="manage-jobs-sec">
                            <h3>Job Posts</h3>
                            <table class="datatable-init jobpost-table">
                                <thead>
                                    <tr>
                                        <td style="width: 280px;">Title</td>
                                        <td>Examinee Count</td>
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
                                                        <h3 style="font-weight:600; font-size: 14px;"><a href="<?php echo !empty($active_post['job_post_id']) ? base_url() . 'jobs/view_job_post?jp_token=' . base64_encode($active_post['job_post_id']) : '' ?>" target="_blank" title=""><?php echo !empty($active_post['job_post_title']) ? substr($active_post['job_post_title'], 0, 30) : '' ?></a></h3>
                                                        <span><i class="la la-map-marker"></i> <?php if (!empty($active_post['job_post_city'])) {
                                                            echo $active_post['job_post_city'];
                                                                                               }
                                                                                               ;?></span>
                                                    </div>
                                                </td>

                                                <td>
                                                    <span class="status active application-count applied">
                                                        <a <?php echo !empty($active_post['no_of_applications']) && $active_post['no_of_applications'] > 0 ? 'href="' . base_url() . 'employer/applications_received?jp_id=' . $active_post['job_post_id'] . '" title="View Applications Received"' : 'title="No Applications Received "' ?>><?php echo !empty($active_post['no_of_applications']) ? $active_post['no_of_applications'] : 'No' ?> Examinee</a>
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

                            <!-- start tab design -->
                            <div class="container-fluid">
                                <ul class="nav nav-tabs mt-3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#Level1_tab">Level 1</a>
                                    </li>
                                    <li class="nav-item" id="level2">
                                        <a class="nav-link" data-toggle="tab" href="#Level2_tab">Level 2</a>
                                    </li>

                                     <li class="nav-item"  id="level3">
                                        <a class="nav-link" data-toggle="tab" href="#Level3_tab">Level 3</a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content card mt-3 ml-1 mr-1">
                                    <div id="Level1_tab" class="tab-pane active">
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
                                                <td style="display: none;">#</td>
                                                <td>Date</td>
                                                <td>Paper Correction</td>
                                            </tr>
                                            </thead>
                                            <tbody id="jobs_emp_table_body">

                                            </tbody>
                                        </table>

                                        <div class="manage-jobs-sec row">
                                            <div class="col-6">
                                                <a class="badge-success" data-toggle="modal" data-target="#" onclick="openModal()" id="send_exam">Send Exam</a>
                                            </div>
                                            <div class="col-6">
                                                <button type="button" class="btn-success btn-sm" data-toggle="modal" onclick="OpenmyModal()" id="btnOpen">Schedule Interview</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="Level2_tab" class="container tab-pane fade">
                                        <table id="jobs_emp_table2" class="datatable-init">
                                              <thead>
                                            <tr>
                                                <td style="display: none;">#</td>
                                               <td style="display: none;">#</td>
                                                <td>#</td>
                                                <td>Name</td>
                                                <td>MCQ</td>
                                                <td>Short Answer</td>
                                                <td>Total</td>
                                                <td style="display: none;">#</td>
                                                <td>Date</td>
                                                <td>Paper Correction</td>
                                            </tr>
                                            </thead>
                                            <tbody id="jobs_emp_table_body2">

                                            </tbody>
                                        </table>
                                         <div class="manage-jobs-sec row">
                                            <div class="col-6">
                                                <a class="badge-success" data-toggle="modal" data-target="#" onclick="openModal()">Send Exam</a>
                                            </div>
                                            <div class="col-6">
                                                <button type="button" class="btn-success btn-sm" data-toggle="modal" onclick="OpenmyModal()" id="btnOpen">Schedule Interview</button>
                                            </div>
                                        </div>
                                    </div>

                                        <div id="Level3_tab" class="container tab-pane fade">
                                        <table id="jobs_emp_table3" class="datatable-init">
                                              <thead>
                                            <tr>
                                                <td style="display: none;">#</td>
                                                <td style="display: none;">#</td>
                                                <td>#</td>
                                                <td>Name</td>
                                                <td>MCQ</td>
                                                <td>Short Answer</td>
                                                <td>Total</td>
                                                <td style="display: none;"></td>
                                                <td>Date</td>
                                                <td>Paper Correction</td>
                                            </tr>
                                            </thead>
                                            <tbody id="jobs_emp_table_body3">

                                            </tbody>
                                        </table>
                                         <div class="manage-jobs-sec row">
                                            <div class="col-6">
                                                <a class="badge-success" data-toggle="modal" data-target="#" onclick="openModal()">Send Exam</a>
                                            </div>
                                            <div class="col-6">
                                                <button type="button" class="btn-success btn-sm" data-toggle="modal" onclick="OpenmyModal()" id="btnOpen">Schedule Interview</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- End tab design -->
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
                <div class="row">
                    <div class="col-md-4">
                        <label class="col-form-label">Start Time</label>
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

                <div class="row">
                    <div class="col-md-4">
                        <label class="col-form-label">Duration</label>
                    </div>
                    <div class="col-md-4">
                        <input type="number" placeholder="Hrs" class="form-control" min="-1" id="du_time" max="24" />
                    </div>
                    <div class="col-md-4">
                        <input type="number" placeholder="Min" class="form-control" min="-1" id="du_time_end" max="59" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label class="col-form-label">Date</label>
                    </div>
                    <div class="col-md-8">
                        <input type="date" class="form-control" id="date" />
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-4">
                        <label class="col-form-label">Location</label>
                    </div>
                    <div class="col-md-8">
                        <select class="form-control" id="location">
                            <option disabled> -select- </option>
                            <?php $navigation_top_menu_main2 = get_interviewer_location();
                            foreach ($navigation_top_menu_main2 as $element) {?>
                                <option value="<?php echo $element['idinterviewer_details']; ?>"><?php echo $element['location']; ?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-8 form-group">
                        <labele id="address_l1" class="col-form-label mt-2"></labele><br>
                        <labele id="address_l2" class="col-form-label"></labele><br>
                        <labele id="city" class="col-form-label"></labele><br>
                        <labele id="room_no" class="col-form-label"></labele>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 form-group">
                        <label class="col-form-label">Interviewers</label>
                    </div>
                    <div class="col-md-8">
<!--                        <select class="form-control" id="interviewer" multiple>-->
<!--                            <option disabled> -select- </option>-->
<!--                            --><?php //$navigation_top_menu_main = get_interviewer();
//                            foreach ($navigation_top_menu_main as $element) {?>
<!--                                    <option value="--><?php //echo $element['idinterviewer_list']; ?><!--">--><?php //echo $element['name']; ?><!--</option>-->
<!--                            --><?php //}?>
<!--                        </select>-->

                        <div class="dropdown">
                            <button class="dropdown-toggle dropdown-style" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Select
                            </button>
                            <div class="dropdown-menu filter-dropdowns" aria-labelledby="dropdownMenuButton2">
                              <!--   <a class="dropdown-item" href="#"><input type="checkbox" name="colorCheckbox" style="position: initial;opacity: 1;" class="chkbx mr-2" value="Name1">Name1</a>
                                <a class="dropdown-item" href="#"><input type="checkbox" name="colorCheckbox" style="position: initial;opacity: 1;" class="chkbx mr-2" value="Name2">Name2</a>
                                <a class="dropdown-item" href="#"><input type="checkbox" name="colorCheckbox" style="position: initial;opacity: 1;" class="chkbx mr-2" value="Name3">Name3</a> -->

                                 <?php $navigation_top_menu_main = get_interviewer();
                                    foreach ($navigation_top_menu_main as $element) {?>
                            <a class="dropdown-item" href="#"><input type="checkbox" name="colorCheckbox" style="position: initial;opacity: 1;" class="chkbx mr-2" value="<?php echo $element['idinterviewer_list']; ?>"><?php echo $element['name']; ?></a>


                                            <?php //echo $element['idinterviewer_list']; ?><?php // echo $element['name']; ?>
                                    <?php }?>


                            </div>
                        </div>

                        <!--Divisions to be shown and hidden-->
                        <div class="row">
                            <div class="col-12">
                                 <?php $navigation_top_menu_main = get_interviewer();
                                    foreach ($navigation_top_menu_main as $element) {?>
                                <div class="<?php echo $element['idinterviewer_list']; ?> box"><?php echo $element['name']; ?></div>
                                    <?php }?>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="col-md-12" style="padding-left: 150px;">

                    </div>
                </div>

                <?php $employer_contact =get_contact_details();
                //echo var_dump($employer_contact);
                ?>

                <div class="row mt-2">
                    <div class="col-md-4">
                        <label class="col-form-label" id="email">Contact Person</label>
                    </div>
                    <div class="col-md-8">
                        <label class="col-form-label">
                            <?php echo $employer_contact[0]['employer_contact_person_name']; ?>
                        </label>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-4">
                        <labele id="c_number" class="col-form-label">Contact Number</labele>
                    </div>
                    <div class="col-md-8">
                        <label class="col-form-label">
                            <?php echo $employer_contact[0]['employer_contact_person_contact']; ?>
                        </label>
                    </div>
                </div>

                <div class="row" style="display: none;">
                    <div class="col-md-4">
                        <labele class="col-form-label">Confirmation Link</labele>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="confirmation"/>
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

<!-----------------------------ctg modal--------------------------->
<div class="modal fade" id="examModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Send Exam</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="ctg_list">

                <div class="col-md-12 row">
                    <div class="col-md-6">
                        From
                        <input type="date" class="form-control" id="from">
                    </div>
                    <div class="col-md-6">
                        To
                        <input type="date" class="form-control" id="to">
                    </div>
                </div>

                <br>
                <div class="col-md-12 row">
                    <div class="col-md-9">
                        <h6><b>Select Exam Paper</b></h6>

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
                    <div class="col-md-3">
                        <h6><b>Level</b></h6>
                        <br>
                        <div class="level-1-layer">
                            <div class="item-radio">
                                <input type="radio" id="Basic" name="acces_radio" value="Basic" class="">
                                <label class="filter-label" for="Basic">Basic</label>
                            </div>
                        </div>
                        <div class="level-1-layer">
                            <div class="item-radio">
                                <input type="radio" id="Intermediate" name="acces_radio" value="Intermediate" class="">
                                <label class="filter-label" for="Intermediate">Intermediate</label>
                            </div>
                        </div>
                        <div class="level-1-layer">
                            <div class="item-radio">
                                <input type="radio" id="adavance" name="acces_radio" value="Advanced" class="">
                                <label class="filter-label" for="adavance">Advance</label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-success btn-sm" onclick="save_assing_exam_emp()">Send</button>
                <button type="button" class="btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--------------------------------------------------------------------------->

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

    // exam modal
    function openModal(){
        var booolflase=0;
        // $('#jobs_emp_table_body tr').each(function() {
        //     var tr = $(this);
        //     var emp_id = tr.find('td:nth-child(1)').text();

        //     var inputCheck = $('#par-' + emp_id + '').prop('checked');
        //     if(inputCheck){
        //         booolflase=+1;
        //     }

        // });

// var count_exams=$('#send_exam').attr('no_of_exams');


$('input:checkbox').each(function() 
{    
    if($(this).is(':checked')){
     // alert($(this).val());
 var emp_id = $(this).attr('emp_id');
  booolflase=+1;

    }
});




        if(booolflase>0) {
            $('#examModal').modal('toggle');
        }else{
            Swal.fire(
                    'Warning!',
                    'Please select applicant first',
                    'warning'
            )
        }
    }









function changemarks(){ 
    console.log('work change');
    $('#jobs_emp_table').DataTable().draw();
     $('#jobs_emp_table2').DataTable().draw();
     $('#jobs_emp_table3').DataTable().draw();
 

}







    function setJobs(id, Name) {
        $('#job_title').text(Name);
        $('#id_ViewJob').val(id);

        $('#jobs_emp_table_body').html("");
        $('.markblock').html('');
        $('#jobs_emp_table').DataTable().destroy();
        $('#divTable').show();

        var html = "";
          var html2 = "";
           var html3 = "";
          

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
                var no_of_exam=data['applications'][0]['no_of_exam'];

                $('#level2').hide();
                $('#level3').hide();
                $('#send_exam').attr('no_of_exams',no_of_exam);

                if(no_of_exam==2){

 $('#level2').show();

                }

                          if(no_of_exam==3){

            $('#level2').show();
              $('#level3').show();

                }




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
                    var idunique=data['applications'][i]['idats_emp_wise_answer'];
                    var uid=data['applications'][i]['jobseeker_user_id'];

                    get_mcq(uid, examIDD, i);
                    get_data_emp_short_answer(uid, examIDD, i);
                    get_tot_percentage(uid, examIDD, i);
                    var level=data['applications'][i]['level'];
                    if(level== '' || level== '1' ){
                          html += '<tr class="emply-resume-list_1" data-apl_id="" role="row">';
                    html += '<td style="display: none;">' + emp_id + '</td>';
                    html += '<td style="display: none;">' + examIDD + '</td>';
                    html += '<td>';
                    html += '<br><div class="level-1-layer">';
                    html += '<div class="item-checkbox">';
                    html += '<input type="checkbox" class="filter-input route-parent rou-1" value="1" id="par-' + emp_id + idunique + i+'" name="p' + i + '" exam_id="'+examIDD+'" emp_id="'+uid+'" level="2">';
                    html += '<label class="filter-label" for="par-' + emp_id + idunique + i+'"></label>';
                    html += '</div>';
                    html += '</div>';
                    html += '</td>';
                    html += '<td>' + Frist_name + ' ' + Middle_name + ' ' + Last_name + '</td>';
                    html += '<td><label id="lbl001_' + i + '" ></label>%</td>';
                    html += '<td><label id="lbl002_' + i + '" ></label>%</td>';
                    html += '<td><label id="lbl003_' + i + '" ></label>%</td>';
                     html += '<td style="display: none;" id=total'+i+'></td>';

                      
                    html += '<td>' + Date.split(' ')[0] + '</td>';
                    html += '<td class="text-center"><a href="<?php echo base_url() ?>employer/job_posts/ats_setup_exam_maker_mark?id=' + examIDD + '&&emp_id=' + emp_id + '&&Name=' + Name + '"><span class="la la-file-text text-success fa-2x"></span></a></td>';

                    html += '</tr>';

                    }
                     if( level== '2' ){
               html2 += '<tr class="emply-resume-list_1" data-apl_id="" role="row">';
                    html2 += '<td style="display: none;">' + emp_id + '</td>';
                    html2 += '<td style="display: none;">' + examIDD + '</td>';
                    html2 += '<td>';
                    html2 += '<br><div class="level-1-layer">';
                    html2 += '<div class="item-checkbox">';
                    html2 += '<input type="checkbox" class="filter-input route-parent rou-1" value="1" id="par-' + emp_id + idunique +i+ '" name="p' + i + '" exam_id="'+examIDD+'" emp_id="'+uid+'" level="3" >';
                    html2 += '<label class="filter-label" for="par-' + emp_id + idunique +i+ '"></label>';
                    html2 += '</div>';
                    html2 += '</div>';
                    html2 += '</td>';
                    html2 += '<td>' + Frist_name + ' ' + Middle_name + ' ' + Last_name + '</td>';
                    html2 += '<td><label id="lbl001_' + i + '" ></label>%</td>';
                    html2 += '<td><label id="lbl002_' + i + '" ></label>%</td>';
                    html2 += '<td><label id="lbl003_' + i + '" ></label>%</td>';
                    html += '<td style="display: none;" id=total'+i+'></td>';
                    html2 += '<td>' + Date.split(' ')[0] + '</td>';
                    html2 += '<td class="text-center"><a href="<?php echo base_url() ?>employer/job_posts/ats_setup_exam_maker_mark?id=' + examIDD + '&&emp_id=' + emp_id + '&&Name=' + Name + '"><span class="la la-file-text text-success fa-2x"></span></a></td>';

                    html2 += '</tr>';
                     }


       if( level== '3' ){
               html3+= '<tr class="emply-resume-list_1" data-apl_id="" role="row">';
                    html3+= '<td style="display: none;">' + emp_id + '</td>';
                    html3+= '<td style="display: none;">' + examIDD + '</td>';
                    html3+= '<td>';
                    html3+= '<br><div class="level-1-layer">';
                    html3+= '<div class="item-checkbox">';
                    html3+= '<input type="checkbox" class="filter-input route-parent rou-1" value="1" id="par-' + emp_id + idunique +i+ '" name="p' + i + '" exam_id="'+examIDD+'" emp_id="'+uid+'" level="4">';
                    html3+= '<label class="filter-label" for="par-' + emp_id + idunique +i+ '"></label>';
                    html3+= '</div>';
                    html3+= '</div>';
                    html3+= '</td>';
                    html3+= '<td>' + Frist_name + ' ' + Middle_name + ' ' + Last_name + '</td>';
                    html3+= '<td><label id="lbl001_' + i + '" ></label>%</td>';
                    html3+= '<td><label id="lbl002_' + i + '" ></label>%</td>';
                    html3+= '<td><label id="lbl003_' + i + '" ></label>%</td>';
                    html += '<td style="display: none;" id=total'+i+'></td>';
                    html3+= '<td>' + Date.split(' ')[0] + '</td>';
                    html3+= '<td class="text-center"><a href="<?php echo base_url() ?>employer/job_posts/ats_setup_exam_maker_mark?id=' + examIDD + '&&emp_id=' + emp_id + '&&Name=' + Name + '"><span class="la la-file-text text-success fa-2x"></span></a></td>';

                    html3 += '</tr>';
                     }




                  
                }

                $('#jobs_emp_table_body').html(html);
                 $('#jobs_emp_table_body2').html(html2);
                   $('#jobs_emp_table_body3').html(html3);



                $('#jobs_emp_table').DataTable({
                    "order": []
                });

                 var select='<label class="markblock">   &nbsp; &nbsp;Marks <select name="marks" aria-controls="marks" class="marks" onchange="changemarks();"><option value="">All</option><option value="100">100</option><option value="80">80</option><option value="60">60</option><option value="40">40</option><option value="40"><40</option></select> </label>';

                   //$("#jobs_emp_table_filter").append(select);
                       

                   $(select).insertBefore("#jobs_emp_table_filter");
                   $(select).insertBefore("#jobs_emp_table2_filter");
                   $(select).insertBefore("#jobs_emp_table3_filter");


                    // $(".dataTables_filter").append(select);
                    //  $(".dataTables_filter").append(select);


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
                $('#total' + i).html(parseFloat(return_value).toFixed(2));




$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = parseInt( $('.marks').val(), 10 );
        var max = parseInt( $('.marks').val(), 10 )+20;
        var age = parseFloat(return_value).toFixed(2) || 0; // use data for the age column

        console.log('scloum'+data);
 
        if ( ( isNaN( min ) && isNaN( max ) ) ||
             ( isNaN( min ) && age <= max ) ||
             ( min <= age   && isNaN( max ) ) ||
             ( min <= age   && age <= max ) )
        {
            return true;
        }
        return false;
    }
);







                

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
         var interviewer=[];

       //var interviewer= $('input[name="colorCheckbox"]:checked').val();

      $('input[name="colorCheckbox"]:checked').each(function() {
   console.log(this.value);
   interviewer.push(this.value);
});

     
        //var interviewer = $('#interviewer').val();



        var confirmation = $('#confirmation').val();
        var emp_id = 1;
        var post_job_id = $('#id_ViewJob').val();

console.log(st_time);

if(st_time =='' || st_time_end=='' ||  du_time=='' ||   location==''){
    Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Please fill in all the required fields.'
});
}

else   if(date!="") {
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


var full_time=0;
if(du_time =='' || du_time ==0){
    var full_time=(parseInt(st_time) *60  + parseInt(st_time_end) ) + parseInt(du_time_end);

}
else if(du_time_end =='' || du_time_end ==0){
   var full_time=(parseInt(st_time) *60  + parseInt(st_time_end) )+ (parseInt(du_time)*60);
}
else if((du_time =='' || du_time ==0) && (du_time_end =='' || du_time_end ==0) ){
   var full_time=(parseInt(st_time) *60  + parseInt(st_time_end) );
}
else{
  var full_time=(parseInt(st_time) *60  + parseInt(st_time_end) )+ (parseInt(du_time)*60)+ parseInt(du_time_end);
}


var timen= full_time;
var  st_time_modified=$('#st_time').val();
var  st_time_end_modified=$('#st_time_end').val();

// console.log('---'+st_time_modified);
// console.log('****'+st_time_end_modified);

var i=0;

                   // $('#jobs_emp_table_body tr').each(function () {
$('.filter-input:checked').each(function () {

    console.log('working tee');

                       // var tr = $(this);
                      //  var id = tr.find('td:nth-child(1)').text();
                       // var exam_id = tr.find('td:nth-child(2)').text();
                      

                        var id=$(this).attr('emp_id');
                        var exam_id =$(this).attr('exam_id');
                      var inputCheck = $('input.filter-input:checked').length;



                        if (inputCheck) {
                            emp_id = $(this).attr('exam_id');

                            $.ajax({
                                type: "GET",
                                data: {
                                    st_time: st_time_modified,
                                    st_time_end: st_time_end_modified,
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

                        st_time_modified= Math.floor(full_time/60);
                        st_time_end_modified=Math.floor(full_time % 60);

                     timen= timen+ (st_time * 60) + st_time_end;

// console.log('#####'+i+'######');
// console.log('---@'+st_time_modified);
// console.log('****@'+st_time_end_modified);
// console.log('#####'+i+'######');
 i=i+1;

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

/*
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
*/

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



$('input:checkbox').each(function() 
{    
    if($(this).is(':checked')){

         var id = $(this).attr('emp_id');
            var exam_id = $(this).attr('exam_id');
            //var inputCheck = $('#par-' + id + exam_id + '').prop('checked');

            // if (inputCheck) {
                num=num+1;
           // }
    }
    //  alert($(this).val());
    //  
    //  
});






        // $('#jobs_emp_table_body tr').each(function() {
        //     var tr = $(this);
        //     var id = tr.find('td:nth-child(1)').text();
        //     var exam_id = tr.find('td:nth-child(2)').text();
        //     var inputCheck = $('#par-' + id + exam_id + '').prop('checked');

        //     if (inputCheck) {
        //         num=num+1;
        //     }
        // });
        // 
        // //
        // 
        // 
        // 
        if(num>0){
            $('#myModal').modal('toggle');
        }
        else{
            Swal.fire({
  
  title: 'Oops...',
  text: 'Please select candidates first'
 
})
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

<script>
    // jQuery functions to show and hide divisions of checkbox dropdowns
    $(document).ready(function () {
        $('input[type="checkbox"]').click(function () {
            var inputValue = $(this).attr("value");
            $("." + inputValue).toggle();
        });

        // uncheck all checkboxes when modal close
        $("#myModal").on('hide.bs.modal', function(){
            $('.chkbx').prop('checked', false);
            $(".box").hide();
        });


   $("input[name='acces_radio']").change(function() {
        var level = $(this).val();

        setExamSummary(level);

    });




    });






     function setExamSummary(level) {
        $('#example').DataTable().destroy();
        $('#jobs_emp_table_body_exam').html("");
        var id_ViewJob = $('#id_ViewJob').val();

        var html = "";
        $.ajax({
            type: "GET",
            data: {
                level: level,
                id_ViewJob: id_ViewJob
            },
            dataType: 'json',
            url: base_url + 'employer/job_posts/ats_exam_summary_level',
            cache: true,
            beforeSend: function() {
                HoldOn.open(loader_options);
            },
            success: function(data) {
                HoldOn.close();


                for (var i = 0; i < data['applications'].length; i++) {
                    var application_no = data['applications'][i]['Title'];
                    var Level = data['applications'][i]['Level'];
                    var status = data['applications'][i]['status'];
                    var create_date = data['applications'][i]['create_date'];
                    var id = data['applications'][i]['id_ats_exam_master'];

                    html += '<tr class="emply-resume-list_1" data-apl_id="' + application_no + '" role="row">';
                    html += '<td><div class="level-1-layer">\n' +
                        '<div class="item-radio">\n' +
                        '<input type="radio" id="' + id + '" name="acces_radio_exam" value="' + id + '" class="">\n' +
                        '<label class="filter-label" for="' + id + '">' + level + '</label>\n' +
                        '</div>\n' +
                        '</div></td>';
                    html += '<td>' + id + '</td>';
                    html += '<td>' + application_no + '</td>';
                    html += '</tr>';
                }


                $('#jobs_emp_table_body_exam').html(html);


                $('#example').DataTable({
                    "order": [],
                    language: {
                        searchPlaceholder: "Title"
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
 function save_assing_exam_emp() {

        var fromCal=$('#from').val();
        var toCal=$('#from').val();
        var paper= $('input[name="acces_radio_exam"]:checked').val();

        console.log(paper);

        if((typeof paper == 'undefined') || paper=='' ){
            swal.fire(
                    'Oops!',
                    'Please select a paper to send exam',
                    'warning'
            ) ;
            return;
        }

        if(fromCal!="" && toCal!=""){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to send exam to this candidate?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {


$('input:checkbox').each(function() 
{    
    if($(this).is(':checked')){
     // alert($(this).val());

                 var from = $('#from').val();
                    var to = $('#to').val();
                    var status = 1;
                     var checkedExam_id = $('#checkedExam_id').val();

                    var exam_id = $('#next_job_id').val();

 var emp_id = $(this).attr('emp_id');
 var job_id = $('#id_ViewJob').val();
  var level = $(this).attr('level');


   $.ajax({
                            type: "GET",
                            data: {
                                emp_id: emp_id,
                                job_id: job_id,
                                from: from,
                                to: to,
                                status: status,
                                checkedExam_id: checkedExam_id,
                                level:level
                            },
                            dataType: 'json',
                            url: base_url + 'employer/job_posts/ats_exam_assing_emp',
                            cache: true,
                            beforeSend: function() {
                                HoldOn.open(loader_options);
                            },
                            success: function(data) {
                                HoldOn.close();
                                $('#id_ViewJob').val(emp_id);
                                Swal.fire(
                                        'Send!',
                                        'Successfully sent exam',
                                        'success'
                                )

                                $('#myModal').hide();
                                location.reload();

                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                HoldOn.close();
                                heads_up_error();
                            }
                        });


    }
});







                $('#jobs_emp_table_body tr').each(function() {
                    var tr = $(this);
                    var Array = [];
                    var emp_id = tr.find('td:nth-child(1)').text();
                    var job_id = $('#id_ViewJob').val();
                    var checkBox = tr.find('td:nth-child(2) > inputCheck');

                    var inputCheck = $('#par-' + emp_id + '').prop('checked');

                    var Job = tr.find('td:nth-child(3)').text();
                    var Count = tr.find('td:nth-child(4)').text();
                    var from = $('#from').val();
                    var to = $('#to').val();
                    var status = 1;

                    var checkedExam_id = $('#checkedExam_id').val();

                    var exam_id = $('#next_job_id').val();


                    var html = '';
                    if (inputCheck) {
                        $.ajax({
                            type: "GET",
                            data: {
                                emp_id: emp_id,
                                job_id: job_id,
                                from: from,
                                to: to,
                                status: status,
                                checkedExam_id: checkedExam_id
                            },
                            dataType: 'json',
                            url: base_url + 'employer/job_posts/ats_exam_assing_emp',
                            cache: true,
                            beforeSend: function() {
                                HoldOn.open(loader_options);
                            },
                            success: function(data) {
                                HoldOn.close();
                                $('#id_ViewJob').val(emp_id);
                                Swal.fire(
                                        'Send!',
                                        'Successfully sent exam',
                                        'success'
                                )

                                $('#myModal').hide();
                                location.reload();

                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                HoldOn.close();
                                heads_up_error();
                            }
                        });
                    }
                });
            }
        })
        }else{
            swal.fire(
                    'Oops!',
                    'Please select a date and paper to send the exam',
                    'warning'
            )
        }
    }

</script>