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

    .nav-tabs:not(.nav-tabs-neutral)>.nav-item>.nav-link.active {
        box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
    }

    .card .nav-tabs {
        border-top-right-radius: 0.1875rem;
        border-top-left-radius: 0.1875rem;
    }

    .nav-tabs>.nav-item>.nav-link {
        color: #1eaae7;
        margin: 0;
        margin-right: 5px;
        background-color: #f2f9ff;
        border: 1px solid transparent;
        font-size: 14px;
        padding: 11px 23px;
        line-height: 1.5;
    }

    .nav-tabs>.nav-item>.nav-link.active {
        background-color: #1eaae7;
        color: #FFFFFF;
        border-top: none!important;
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
    /*end tab style*/

    /*start inner_tab style*/
    .inner_tab .nav-tabs>.nav-item>.nav-link.active {
        background-color: transparent;
        color: #1eaae7;
        border-top: none!important;
        box-shadow: none;
        border-bottom: 2px solid #1eaae7!important;
        border-radius: 0px !important;
    }
    .inner_tab .nav-tabs>.nav-item>.nav-link {
        background-color: transparent;
        border-bottom: 2px solid #d9ebfb!important;
        border-radius: 0px !important;
        color: #a6d0f7;
    }
    /*end inner_tab style*/

    .counter {
        height: 22px;
        width: 22px;
        background-color: #00bcd4;
        border-radius: 50%;
        display: inline-block;
        margin-left: 10px;
    }
    .counter-text {
        color: #ffffff !important;
        font-size: 12px;
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
                                        <tr onclick="setJobs(<?php echo $active_post['job_post_id']; ?> ,'<?php echo $active_post['job_post_title']; ?>') ">
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

                <div class="col-lg-10 column job-sec">
                    <div class="padding-left" id="divTable" style="display: none;">
                        <a onclick="resetDiv()">
<!--                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 172 172" style=" fill:#000000;">-->
<!--                                <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none"  style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g><path d="M2.65391,86c0,-46.02344 37.32266,-83.34609 83.34609,-83.34609c46.02344,0 83.34609,37.32266 83.34609,83.34609c0,46.02344 -37.32266,83.34609 -83.34609,83.34609c-46.02344,0 -83.34609,-37.32266 -83.34609,-83.34609z" fill="#018e53"></path><path d="M77.73594,86.90703c10.31328,-10.31328 20.62656,-20.62656 30.93984,-30.93984c9.00312,-9.00313 -5.00547,-22.91094 -14.04219,-13.87422c-12.63125,12.63125 -25.2625,25.2625 -37.89375,37.89375c-3.82969,3.82969 -3.69531,10.17891 0.06719,13.94141c12.63125,12.63125 25.2625,25.2625 37.89375,37.89375c9.00313,9.00313 22.91094,-5.00547 13.87422,-14.04219c-10.27969,-10.31328 -20.55938,-20.59297 -30.83906,-30.87266z" fill="#ffffff"></path></g></g>-->
<!--                            </svg>-->
                            <button class="btn btn-back ml-3 mt-3 float-left"><i class="fas fa-arrow-left mr-2"></i>Back</button>
                        </a>

                        <div class="manage-jobs-sec">

                            <!-- start tab design -->
                            <div class="container-fluid">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#Pending_tab">Pending</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#Completed_tab">Completed</a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div id="Pending_tab" class="tab-pane active">
                                        <div class="card mt-3 ml-1 mr-1">
                                           <table id="jobs_emp_table_pending" class="datatable-init">
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
                                                                            <td>Interview</td>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody id="jobs_emp_table_body_pending">
                                                                        </tbody>
                                                                    </table>
                                        </div>
                                    </div>

                                    <div id="Completed_tab" class="container-fluid tab-pane fade">

                                        <!-- inner tab -->
                                        <div class="inner_tab">
                                            <div class="row">
                                                <div class="col-12">

                                                    <!-- inner Nav tabs -->
                                                    <div>
                                                        <div>
                                                            <ul class="nav nav-tabs justify-content-center" role="tablist">
                                                                <li class="nav-item ml-1">
                                                                    <a class="nav-link active" data-toggle="tab" href="#round1_tab" role="tab">
                                                                        <i class="now-ui-icons objects_umbrella-13"></i> Round 1
                                                                        <span class="counter"><span class="counter-text " id="r1">  </span></span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item" id="r22">
                                                                    <a class="nav-link" data-toggle="tab" href="#round2_tab" role="tab" >
                                                                        <i class="now-ui-icons shopping_cart-simple"></i> Round 2
                                                                        <span class="counter"><span class="counter-text" id="r2">  </span></span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item" id="r32">
                                                                    <a class="nav-link" data-toggle="tab" href="#round3_tab" role="tab">
                                                                        <i class="now-ui-icons shopping_shop"></i> Round 3
                                                                        <span class="counter"><span class="counter-text" id="r3"> </span></span>
                                                                    </a>
                                                                </li>


 <li class="nav-item" id="rother">
                                                                    <a class="nav-link" data-toggle="tab" href="#roundother_tab" role="tab">
                                                                        <i class="now-ui-icons shopping_shop"></i> Other Round 
                                                                        <span class="counter"><span class="counter-text" id="rothercount"> </span></span>
                                                                    </a>
                                                                </li>




                                                            </ul>
                                                        </div>

                                                        <div class="card mt-3 ml-1 mr-1">
                                                            <!-- inner Tab panes -->
                                                            <div class="tab-content text-center">
                                                                <div class="tab-pane active" id="round1_tab" role="tabpanel">
                                                                    <!-- interviewee list table -->
                                                                    <table id="jobs_emp_table" class="datatable-init"  style="width:100%">
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
                                                                            <td>Interview</td>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody id="jobs_emp_table_body">
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="tab-pane" id="round2_tab" role="tabpanel">
                                                                    <table id="jobs_emp_table_2" class="datatable-init"  style="width:100%">
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
                                                                            <td>Interview</td>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody id="jobs_emp_table_body2">
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="tab-pane" id="round3_tab" role="tabpanel">
                                                                    <table id="jobs_emp_table_3" class="datatable-init" style="width:100%">
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
                                                                            <td>Interview</td>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody id="jobs_emp_table_body3">
                                                                        </tbody>
                                                                    </table>
                                                                </div>





 <div class="tab-pane " id="roundother_tab" role="tabpanel">
                                                                    <!-- interviewee list table -->
                                                                    <table id="jobs_emp_tableother" class="datatable-init"  style="width:100%">
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
                                                                            <td>Interview</td>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody id="jobs_emp_table_body_other">
                                                                        </tbody>
                                                                    </table>
                                                                </div>







                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <!--end tab design-->
                        </div>
                    </div>

                    <div class="manage-jobs-sec row"></div>
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

<!--interview model  -->
<div id="myModal2" class="modal" role="dialog">
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
                            foreach ($navigation_top_menu_main2 as $element) {?>
                                <option value="<?php echo $element['idinterviewer_details']; ?>"><?php echo $element['location']; ?></option>
                            <?php }?>
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
                <button type="button" class="btn-danger btn-sm closebtn" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!--end  -->

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


    $('.close').click(function(){
        $('#myModal2').hide();
    });

    $('.closebtn').click(function(){
        $('#myModal2').hide();
    });

    function OpenModalinterview() {
        $('#myModal2').show();
    }

    function setJobs(id,Name){

        $('#job_title').text(Name);
        $('#id_ViewJob').val(id);
        $('#jobs_emp_table_body').html("");
        $('#jobs_emp_table_body1').html("");
        $('#jobs_emp_table_body2').html("");
        $('#jobs_emp_table_body_pending').html("");
        

        $('#divTable').show();
        $('#div_interviewee_list').hide();
        $('#jobs_emp_table').DataTable().destroy();
        $('#jobs_emp_table_1').DataTable().destroy();
        $('#jobs_emp_table_2').DataTable().destroy();
        $('#jobs_emp_table_3').DataTable().destroy();
         $('#jobs_emp_table_pending').DataTable().destroy();
       

        var html="";
        var html1="";
        var html2="";
        var html3="";
        var r1=0;
        var r2=0;
        var r3=0;


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

                    var levels_max=data;
                HoldOn.close();
                var drop_down='';
                for(var i=0;i<data['drop_data'].length;i++) {
                    var description=data['drop_data'][i]['description'];
                    var id_ats_interviewer_form=data['drop_data'][i]['id_ats_interviewer_form'];
                    drop_down += '<option value='+id_ats_interviewer_form+'>'+description+'</option>';

                }
                $('#jobs_emp_table_body').html("");



              
                var levels_max2= levels_max['exam_levels']['no_of_levels'];
                  console.log('no of levels '+levels_max['exam_levels']['no_of_levels']);

                   $('#r22').hide();
                    $('#r32').hide();
                     $('#rother').hide();

                  if(levels_max2=='' ){

                    $('#r22').hide();
                    $('#r32').hide();

                  }


                  if(levels_max2=='1' ){

                    $('#r22').hide();
                    $('#r32').hide();

                  }
                   if(levels_max2=='2' ){

                    $('#r22').show();
                    $('#r32').hide();

                  }
if(levels_max2=='3' ){

                    $('#r22').show();
                    $('#r32').show();

                  }

         if(levels_max2 >'3' ){

                    $('#r22').show();
                    $('#r32').show();
                     $('#rother').show();

                  }         





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
                    var level=data['applications'][i]['level'];

                    var id_shadule=data['applications'][i]['idats_schedule_interview'];

                      var  Middle_name_correted=Middle_name==null ? '':Middle_name;



                    //var jobseeker_first_name=data['applications'][i]['jobseeker_first_name'];
                    //var jobseeker_last_name=data['applications'][i]['jobseeker_last_name'];
                    //var applied_resume=data['applications'][i]['applied_resume'];
                    //
                   // console.log('null'+level);
                    if(level=='' || !level){
                      
                    html+='<tr class="emply-resume-list_1" data-apl_id="" role="row">';
                    html+='<td>'+(i+1)+'</td>';
                    html+='<td>'+Frist_name+' '+Middle_name_correted+' '+Last_name+'</td>';
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
                    html+='<td class="text-center"><a onclick="OpenModalinterview('+emp_id+','+id_shadule+')"><span class="la la-handshake text-info fa-2x"></span></a></td>';
                    html+='</tr>';
                    console.log('null');
                   }


 if(level=='1'){
     r1=r1+1;

                    html1+='<tr class="emply-resume-list_1" data-apl_id="" role="row">';
                    html1+='<td>'+(i+1)+'</td>';
                    html1+='<td>'+Frist_name+' '+Middle_name_correted+' '+Last_name+'</td>';
                    html1+='<td>'+Date+'</td>';
                    html1+='<td>'+strat_time_hr+':'+strat_time_min+'</td>';
                    html1+='<td>'+location+'</td>';
                    html1+='<td>'+room_no+'</td>';
                    html1 += '<td><select class="drop" ><option>select</option>';
                    html1 += drop_down;
                    html1 += '</select></td>';
                    if(status_confirm==0){
                        html1+='<td class="text-center"><a class="dot_rad" data-toggle="tooltip" title="Inactive" ></a></td>';
                    }else{
                        html1+='<td class="text-center"><lable style="display: none;">A</lable><a class="dot_green" data-toggle="tooltip" title="Active"></a></td>';
                    }
                    html1+='<td class="text-center"><a onclick="open_doc('+emp_id+','+id_shadule+')"><span class="la la-file-contract text-info fa-2x"></span></a></td>';
                    html1+='<td class="text-center"><a onclick="OpenModalinterview('+emp_id+','+id_shadule+')"><span class="la la-handshake text-info fa-2x"></span></a></td>';
                    html1+='</tr>';
                   }


if(level=='2'){
     r2=r2+1;

                    html2+='<tr class="emply-resume-list_1" data-apl_id="" role="row">';
                    html2+='<td>'+(i+1)+'</td>';
                    html2+='<td>'+Frist_name+' '+Middle_name_correted+' '+Last_name+'</td>';
                    html2+='<td>'+Date+'</td>';
                    html2+='<td>'+strat_time_hr+':'+strat_time_min+'</td>';
                    html2+='<td>'+location+'</td>';
                    html2+='<td>'+room_no+'</td>';
                    html2 += '<td><select class="drop" ><option>select</option>';
                    html2 += drop_down;
                    html2 += '</select></td>';
                    if(status_confirm==0){
                        html2+='<td class="text-center"><a class="dot_rad" data-toggle="tooltip" title="Inactive" ></a></td>';
                    }else{
                        html2+='<td class="text-center"><lable style="display: none;">A</lable><a class="dot_green" data-toggle="tooltip" title="Active"></a></td>';
                    }
                    html2+='<td class="text-center"><a onclick="open_doc('+emp_id+','+id_shadule+')"><span class="la la-file-contract text-info fa-2x"></span></a></td>';
                    html2+='<td class="text-center"><a onclick="OpenModalinterview('+emp_id+','+id_shadule+')"><span class="la la-handshake text-info fa-2x"></span></a></td>';
                    html2+='</tr>';
                   }


if(level=='3'){
     r3=r3+1;

                    html3+='<tr class="emply-resume-list_1" data-apl_id="" role="row">';
                    html3+='<td>'+(i+1)+'</td>';
                    html3+='<td>'+Frist_name+' '+Middle_name_correted+' '+Last_name+'</td>';
                    html3+='<td>'+Date+'</td>';
                    html3+='<td>'+strat_time_hr+':'+strat_time_min+'</td>';
                    html3+='<td>'+location+'</td>';
                    html3+='<td>'+room_no+'</td>';
                    html3 += '<td><select class="drop" ><option>select</option>';
                    html3 += drop_down;
                    html3 += '</select></td>';
                    if(status_confirm==0){
                        html3+='<td class="text-center"><a class="dot_rad" data-toggle="tooltip" title="Inactive" ></a></td>';
                    }else{
                        html3+='<td class="text-center"><lable style="display: none;">A</lable><a class="dot_green" data-toggle="tooltip" title="Active"></a></td>';
                    }
                    html3+='<td class="text-center"><a onclick="open_doc('+emp_id+','+id_shadule+')"><span class="la la-file-contract text-info fa-2x"></span></a></td>';
                    html3+='<td class="text-center"><a onclick="OpenModalinterview('+emp_id+','+id_shadule+')"><span class="la la-handshake text-info fa-2x"></span></a></td>';
                    html3+='</tr>';
                   }








                }
                $('#jobs_emp_table_body').html(html1);

                $('#jobs_emp_table_body_pending').html(html);
                $('#jobs_emp_table_body2').html(html2);
                $('#jobs_emp_table_body3').html(html3);
                $('#r1').html(r1);
                 $('#r2').html(r2);
                 $('#r3').html(r3);



                $('#jobs_emp_table').DataTable({
                    "order": [],
                    "aoColumnDefs": [
                        { "bSortable": false, "aTargets": [ 0, 6 , 8] },
                    ],
                    language: {
                        searchPlaceholder: "Search records"
                    }
                });




//jobs_emp_table_pending

 $('#jobs_emp_table_pending').DataTable({
                    "order": [],
                    "aoColumnDefs": [
                        { "bSortable": false, "aTargets": [ 0, 6 , 8] },
                    ],
                    language: {
                        searchPlaceholder: "Search records"
                    }
                });



  $('#jobs_emp_table_2').DataTable({
                    "order": [],
                    "aoColumnDefs": [
                        { "bSortable": false, "aTargets": [ 0, 6 , 8] },
                    ],
                    language: {
                        searchPlaceholder: "Search records"
                    }
                });


   $('#jobs_emp_table_3').DataTable({
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









    
</script>
