
<style>
    #ex3 .fa-stack[data-count]:after{
        position:absolute;
        right:-1%;
        top:1%;
        content: attr(data-count);
        font-size:30%;
        padding:.8em;
        border-radius:50%;
        line-height:.5em;
        color: white;
        background:rgb(222 56 30);
        text-align:center;
        min-width: 1em;
        font-weight:bold;
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
        background-color: #1EAAE7;
        border-radius: 30px;
        padding: 4px 12px;
    }
    .application-count.applied:hover {
        background-color: #3d5a80 ;
    }
    table.jobpost-table tbody tr:hover {
        background-color: #f7661833;
        cursor: pointer;
    }
    table.jobpost-table tbody tr.active {
        background-color: #efefef;
    }

    table.jobpost-table tbody tr {
        /*height: 60px;*/
    }

    table.jobpost-table tbody td {
        padding: 8px 16px !important;
    }

    table.jobpost-table tbody td:hover {
        border-bottom: none;
    }

    @media (min-width: 992px) {
        .col-lg-5.job-sec {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 40%;
            flex: 0 0 40%;
            max-width: 40%;
        }

        .col-lg-5.job-sec {
            margin: 20px 10px;
            box-shadow: 0 4px 8px 0 rgb(0 0 0 / 5%), 0 6px 20px 0 rgb(0 0 0 / 7%);
        }
    }

    .primary-outline-btn {
        border: 2px solid #1EAAE7;
        background: transparent;
        color: gray;
    }
    .primary-outline-btn:hover {
        border: 2px solid #1EAAE7;
    }
    
    .filter-dropdowns {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        border: none;
        font-size: 14px!important;
    }

    .filter-dropdowns hr {
        margin-bottom: 10px;
    }

    .dropdown-item.active, .dropdown-item:active {
        color: #fff;
        background-color: #1EAAE7;
    }

    /*progress bar*/
    .multi-color-progress {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        height: 15px;
        overflow: hidden;
        font-size: 11px;
        background-color: #f5f3f4;
        border-radius: .25rem;
        color:#fff;
        margin: 8px 0;
    }
    .multi-progress-bar {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        color: #fff;
        text-align: center;
        background-color: #007bff;
        transition: width .6s ease;
    }

    /*progress bar tooltip*/
    .tooltip {
        position: relative;
        float: right;
    }

    .tooltip > .tooltip-inner {
        background-color: black;
        padding: 5px 15px;
        color: white;
        /*font-weight: bold;*/
        font-size: 13px;
    }

    .popOver + .tooltip > .tooltip-arrow {
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 5px solid black;
    }

    .fa-circle {
        color: #022146;
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
                                        <td>Title</td>
                                        <td>No of Applicants</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($active_job_posts) && !empty($active_job_posts)) {
                                        { { { { { { { { { { { { { { { { { { { { { { { { {
                                        { { { { { { { { { { { { { { { { { { { { { { { { {
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

                                            <tr class="in-active" onclick="setJobs(<?php echo $active_post['job_post_id']; ?> ,'<?php echo $active_post['job_post_title']; ?>') ">
                                                <td>
                                                    <div class="table-list-title mb-3">
                                                        <h3 style="font-weight:600; font-size: 14px;"><a href="<?php echo !empty($active_post['job_post_id']) ? base_url() . 'jobs/view_job_post?jp_token=' . base64_encode($active_post['job_post_id']) : '' ?>" target="_blank" title=""><?php echo !empty($active_post['job_post_title']) ?  substr($active_post['job_post_title'], 0, 30) : '' ?></a></h3>
                                                        <span><i class="la la-map-marker"></i><?php if (!empty($active_post['job_post_city'])) {
                                                            echo $active_post['job_post_city'];
                                                                                              }; ?></span>
                                                    </div>

                                                    <br>
                                                    <div class="container">
                                                        <div class="multi-color-progress">

                                                    <?php
      //                                               $sql ="SELECT count(*) as totalquz,user_id as users,

      //                                           SUM(CASE
      //            WHEN t.answer=1 THEN 1
      //            ELSE 0
      //          END) AS successrate
     
      // FROM jobseeker_questionnaire_answers  t
      //    where job_post_id='".$active_post['job_post_id']."'  group by user_id ,job_post_id  ";

                                                    $sql= "SELECT count(*) as totalquz,user_id as users,

                                            SUM(CASE 
             WHEN t.answer=1 THEN 1
             ELSE 0
           END) AS successrate,
                    (100/ count(*)) as first_count
                    

     
  FROM jobseeker_questionnaire_answers  t
     where job_post_id='".$active_post['job_post_id']."'  group by user_id ,job_post_id";



         // $sql2='select group_concat()  from job_applications_received  where job_post_id='".$active_post['job_post_id']."';




                                                    $query = $this->db->query($sql);

                                                    $f_100=0;
                                                    $f_80=0;
                                                    $f_60=0;
                                                    $f_40=0;
                                                    $f_20=0;
                                                    $u100=array();
                                                    $u80=array();
                                                    $u60=array();
                                                    $u40=array();
                                                    $u20=array();



                                                    $a1=array();
                                                    $a2=array();
                                                    $a3=array();
                                                    $a4=array();
                                                    $a5=array();


                                                    $f_total=$query->num_rows();
                                                    $allarray=array();



                                                    if ($query->num_rows() > 0) {
                                                        $i=0;
                                                        foreach ($query->result() as $row) {
                                                            $total= $row->totalquz;
                                                            $success= $row->successrate;
                                                            $users=$row->users;
                                                            $rate=(($success/$total) *100);
                                                           // $f_total=$f_total+1;
                                                           //
                                                            $ratemesure=(float)100/$total;
                                                            $first_count=(float)$row->first_count;

                                                            $arrayitems=(int)(100/ $first_count);
                                                    
                                                            //echo $ratemesure .'<'. $rate;
                                                           // echo '<br/>';

                                                     
                                                          

                                                        
                                                            if (0 == $rate && $rate  <  $ratemesure) {
                                                                array_push($a1, $users);
                                                            }
                                                            if ($ratemesure <= $rate  && $rate  <=  ($ratemesure*2)) {
                                                                array_push($a2, $users);
                                                            }
                                                            if (($ratemesure*2) < $rate && $rate  <=  ($ratemesure*3)) {
                                                                    array_push($a3, $users);
                                                            }
                                                            if (($ratemesure*3) < $rate && $rate  <=  ($ratemesure*4)) {
                                                                array_push($a4, $users);
                                                            }

                                                            if (($ratemesure*4) <  $rate && $rate <= ($ratemesure*5)) {
                                                                array_push($a5, $users);
                                                            }
                                                               
                                                          
                                                      








                                                                    $i= $i+1;
                                                        }

                                                        $a1users=implode('|', $a1);
                                                        $a2users=implode('|', $a2);
                                                        $a3users=implode('|', $a3);
                                                        $a4users=implode('|', $a4);
                                                        $a5users=implode('|', $a5);
                                                         $ratemesuretotal=0;

                                                        for ($x = 1; $x <= $arrayitems; $x++) {
                                                            if ($x==1) {
                                                                $count_cv=count($a1);
                                                                $af= $a1users;
                                                                $color='#3FC1C0 !important;';
                                                            }
                                                            if ($x==2) {
                                                                $count_cv=count($a2);
                                                                 $af= $a2users;
                                                                 $color="#20BAC5 !important;";
                                                            }
                                                            if ($x==3) {
                                                                $count_cv=count($a3);
                                                                $af= $a3users;
                                                                $color="#00B2CA !important;";
                                                            }
                                                            if ($x==4) {
                                                                $count_cv=count($a4);
                                                                $af= $a4users;
                                                                $color="#04A6C2 !important;";
                                                            }
                                                            if ($x==5) {
                                                                $count_cv=count($a5);
                                                                $af= $a5users;
                                                                $color="#0899BA !important;";
                                                            }





                                                            
                                                        
                                                                    $ratemesuretotal= $ratemesure+ $ratemesuretotal;


                                                            ?>
  <div class="multi-progress-bar" data-toggle="tooltip" data-placement="top" data-html="true" data-original-title="<b><u><?php  echo $ratemesuretotal;  ?>% Matched</u></b> <br> No of CV: <?php echo $count_cv; ?>" style="width:<?php echo  $ratemesure; ?>%;background-color:<?php echo $color ?>" filter="<?php  echo   $af; ?>"><?php echo $ratemesuretotal; ?>%</div> 
                                                            <?php
                                                        }
                                                    }


                                                     
                                                    // $pre_100= ($f_100==0)?0:($f_100/$f_total)*100;
                                                    // $pre_80=($f_80==0)?0:($f_80/$f_total)*100;
                                                    // $pre_60=($f_60==0)?0:($f_60/$f_total)*100;
                                                    // $pre_40=($f_40==0)?0:($f_40/$f_total)*100;
                                                    // $pre_20=($f_20==0)?0:($f_20/$f_total)*100;

                                                    


                                                    if ($f_total >0) {
                                                        ?>


                                                   
                                                           


                        

                                                       
                                                       

                                                        


                                                     

                                                        <?php
                                                    }





                                                    ?>






                                      


                                                        </div>
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
                                        }
                                        }
                                        }
                                        }
                                        }
                                        }
                                        }
                                        }
                                        }
                                        }
                                        }
                                        }
                                        }
                                        }
                                        }
                                        }
                                        }
                                        }
                                        }
                                        }
                                        }
                                        }
                                        }
                                        }
                                        }
                                                }
                                                }
                                                }
                                                }
                                                }
                                                }
                                                }
                                                }
                                                }
                                                }
                                                }
                                                }
                                                }
                                                }
                                                }
                                                }
                                                }
                                                }
                                                }
                                                }
                                                }
                                                }
                                                }
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 job-sec">
                    <div class="offset-10 col-md-2">
                        <div id="ex3" data-toggle="modal" data-target="#candidateModal">
                            <input type="hidden" id="cartcount">
                            <span class="p1 fa-stack fa-2x has-badge mt-4" data-count="-" >
                                <i class="p2 fas fa-circle fa-stack-2x" style="margin-left: -5px;"></i>
                                <i class="p3 fas fa-user-tag fa-stack-1x fa-inverse" data-count="5"></i>
                            </span>
                        </div>
                    </div>

                    <div class="row mt-3"  >
                        <div class="col-3"  style="display:none;" id="skills_div">
                            <!--Filter  dropdown checkboxes-->
                            <div class="dropdown d-inline float-left">
                                <button class="btn btn-primary btn-sm dropdown-toggle ml-4" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Skills
                                </button>
                                <div class="dropdown-menu filter-dropdowns" aria-labelledby="dropdownMenuButton1">
                                    <p class="text-secondary ml-3 mb-0">Show me only</p>
                                    <div  id="addskills"></div>
                                    
                                   <!--  <a class="dropdown-item" href="#"><input type="checkbox" name="rate" value="2" style="position: initial;opacity: 1;" class="mr-2">Dancing</a>
                                    <a class="dropdown-item" href="#"><input type="checkbox" name="rate" value="3" style="position: initial;opacity: 1;" class="mr-2">All</a> -->
                                    <hr>
                                    <button class="btn primary-outline-btn btn-sm float-right mr-2 mb-2">Show Results</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-9">
                            <!--Ratings dropdown checkboxes-->
                            <div class="dropdown d-inline float-left" style="display: none !important;"  id="ratings" >
                                <button class="btn btn-primary btn-sm dropdown-toggle mr-2" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Ratings
                                </button>
                                <div class="dropdown-menu filter-dropdowns" aria-labelledby="dropdownMenuButton2">
                                    <p class="text-secondary ml-3 mb-0">Show me only</p>
                                    <a class="dropdown-item" href="#"><input type="checkbox" name="rate" value="Good fit" style="position: initial;opacity: 1;" class="mr-2 ratebtn">Good fit</a>
                                    <a class="dropdown-item" href="#"><input type="checkbox" name="rate" value="Maybe" style="position: initial;opacity: 1;" class="mr-2 ratebtn ">Maybe</a>
                                    <a class="dropdown-item" href="#"><input type="checkbox" name="rate" value="Not a fit" style="position: initial;opacity: 1;" class="mr-2 ratebtn">Not a fit</a>
                                    <a class="dropdown-item" href="#"><input type="checkbox" name="rate" value="Unrated" style="position: initial;opacity: 1;" class="mr-2 ratebtn">Unrated</a>
                                    <hr>
                                    <button class="btn primary-outline-btn btn-sm float-right mr-2 mb-2">Show Results</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="multi-field-wrapper" >
                        <div class="multi-fields">
                            <div class="multi-field row mt-3 float-left">
                                <div class="col-12">

                                    <div name="filter[]" class="dropdown d-inline">
                                        <button class="btn btn-primary btn-sm dropdown-toggle mr-2" type="button" id="filterby" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display: none !important">
                                            Filter by
                                        </button>
                                        <div class="dropdown-menu filter-dropdowns" aria-labelledby="dropdownMenuButton1">
                                            <p class="text-secondary ml-3 mb-0">Show me only</p>
                                            <a class="dropdown-item" href="#"><input type="checkbox" name="rate" value="1" style="position: initial;opacity: 1;" class="mr-2">Yes</a>
                                            <a class="dropdown-item" href="#"><input type="checkbox" name="rate" value="2" style="position: initial;opacity: 1;" class="mr-2">No</a>
                                            <a class="dropdown-item" href="#"><input type="checkbox" name="rate" value="3" style="position: initial;opacity: 1;" class="mr-2">All</a>
                                            <hr>
                                            <button class="btn primary-outline-btn btn-sm float-right mr-2 mb-2">Show Results</button>
                                        </div>
                                    </div>

                                    <div name="Question[]" class="dropdown d-inline"  style="display: none !important;"  id="questions">
                                        <button class="btn primary-outline-btn btn-sm dropdown-toggle mr-2" type="button" id="dropdown1v" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                        </button>
                                        <div class="dropdown-menu filter-dropdowns" aria-labelledby="dropdown1" id="quz-items">
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-primary btn-sm add-field mr-2 ml-4" id="plus" style="display:none"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="padding-right" id="OtherTable" style="display: none;">
                        <div class="manage-jobs-sec">
                            <h3 id="job_title">job</h3>
                            <input type="hidden" id="id_ViewJob" />
                            <table id="jobs_emp_table" class="datatable-init">
                                <thead>
                                    <tr>
                                        <td style="display: none;">  #</td>
                                        <td style="width: 10px;"></td>
                                        <td style="text-align: left;">Name</td>
                                         <td style="display: none;"></td>
                                        <td style="text-align: left;">Resume</td>
                                        <td style="text-align: left;">Cover Letter</td>
                                        <td style="text-align: left;">Ratings</td>
                                   
                                    </tr>
                                </thead>
                                <tbody id="jobs_emp_table_body">
                                </tbody>
                            </table>
                        </div>

                        <div class="manage-jobs-sec row">
                            <div class="col-md-8">
                                <a class="badge-success btn-sm" data-toggle="modal" data-target="#" onclick="openModal()">Send Exam</a>
                            </div>
                            <div class="col-md-4">
                                <a class="badge-primary
                                 btn-sm" data-toggle="modal" data-target="#" onclick="openModal_bucket()">Add to Bucket</a>
<!--                                <a href="--><?php //echo base_url() ?><!--employer/job_posts/ats_employer_job_post_ats_filter" class="btn-warning btn-sm float-right">ATS Filter</a>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div>
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

<!-----------------------------ctg modal--------------------------->
<div class="modal fade" id="myModal" role="dialog">
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


<!-----------------------------candidate modal--------------------------->
<div class="modal fade" id="candidateModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Bucketed Candidates</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body" id="">
              

 <table id="jobs_emp_table2" class="datatable-init" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <td style="display: none;">  #</td>
                                  <!--       <td style="display: none;">  #</td> -->
                                        <td style="width: 10px;"></td>
                                        <td style="text-align: left;">Name</td>
                                          <!-- <td style="display: none;">  </td> -->
                                     <td style="text-align: left;">Resume</td>
                                        <td style="text-align: left;">Cover Letter</td>
                                        <td style="text-align: left;">Ratings</td>
                                   
                                    </tr>
                                </thead>
                                <tbody id="jobs_emp_table_body2">
                                </tbody>
                            </table>



            </div>

            <div class="modal-footer">
                <button type="button" class="btn-success btn-sm" onclick="send_bucket_exam()">Send Exam</button>
                <button type="button" class="btn-danger btn-sm" id="remove_bucket"  onclick="remove_bucket()" >Remove</button>
            </div>
        </div>
    </div>
</div>
<!--------------------------------------------------------------------------->
<script src="<?php echo base_url() ?>assets/plugins/datatables/datatables.js" type="text/javascript"></script>

<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

    function myFunction(id) {
      console.log(id);
      $( "#par-"+id ).prop( "checked", true );
      openModal()
    }

    $(document).ready(function() {

        $('.datatable-init').DataTable({
            "order": [],
            language: {
                searchPlaceholder: "Title , No Application"
            }
        });
    })

    $("input[name='acces_radio']").change(function() {
        var level = $(this).val();

        setExamSummary(level);

    });

    function setJobs(id, Name) {

       $('#OtherTable').show();

        $('#job_title').text(Name);
        $('#id_ViewJob').val(id);
        $('#jobs_emp_table_body').html("");
        $('#jobs_emp_table').DataTable().destroy();
        var html = "";
        var carthtml="";

        $.ajax({
            type: "GET",
            data: {
                id: id
            },
            dataType: 'json',
            url: base_url + 'employer/job_posts/ats_post_job_load',
            cache: true,
            beforeSend: function() {
                HoldOn.open(loader_options);
            },
            success: function(data) {
                HoldOn.close();

                $('#skills_div').show();
                $('#addskills').html('');
                var skills='';
                var questions='';
                $('#ratings').show();
                $('#questions').show();
                  $('#plus').show();

               $('.p1').attr('data-count',data['count']);
                for (var i = 0; i < data['applications'].length; i++) {
                    var application_no = data['applications'][i]['application_no'];
                    var jobseeker_first_name = data['applications'][i]['jobseeker_first_name'];
                    var jobseeker_last_name = data['applications'][i]['jobseeker_last_name'];
                    var applied_resume = data['applications'][i]['applied_resume'];
                    var job_post_employer_id = data['applications'][i]['jobseeker_user_id'];
                    var job_post_title=data['applications'][i]['job_post_title'];
                    var jobseeker_user_id=data['applications'][i]['jobseeker_user_id'];
                    var ratings_word_numaric= data['applications'][i]['ratings_word'];
                    var job_post_id=data['job_post']['job_post_id'];
                    var skillsn=data['applications'][i]['skills'];

if(ratings_word_numaric==1){
var ratings_word='<span class="badge badge-success">Good fit</span>';
}

else if(ratings_word_numaric==2){
    var ratings_word='<span class="badge badge-primary">Maybe</span>';
    
}
else if(ratings_word_numaric==3){
    
    var ratings_word='<span class="badge badge-danger">Not a fit</span>';
}
else{
    var ratings_word='<span class="badge badge-secondary">Unrated<span>';

}





                    // var quizrate=data['quizrate'];
                  
                    // carthtml +='<tr><td>'+jobseeker_first_name+' '+jobseeker_last_name+'</td><td>'+job_post_title+'</td><td><span class="status active application-count applied "><a  onclick="myFunction('+jobseeker_user_id+')">Send </a></span></td><td>X<td></tr>';

                    html += '<tr class="emply-resume-list_1" data-apl_id="' + application_no + '" role="row">';
                    html += '<td style="display: none;">' + job_post_employer_id + '</td>';
                     //html += '<td style="display: none;">' + skills + '</td>';
                    html += '<td><br><div class="level-1-layer">';
                    html += '   <div class="item-checkbox">';
                    html += '<input type="checkbox" name="access_func[]" class="filter-input route-parent rou-1" value="1" id="par-' + job_post_employer_id + '">';
                    html += '<label class="filter-label" for="par-' + job_post_employer_id + '">';
                    html += '</label>';
                    html += '</div>';
                    html += '</div></td>';

                    html += '<td>' + jobseeker_first_name + ' ' + jobseeker_last_name + '</td>';

                      html += '<td style="display: none;" id="skill_"'+application_no+'>' + skillsn+ '</td>';
                    html += '<td>';
                    html += '<a href="' + '<?php echo base_url() ?>employer/resume/view?r_id=' + applied_resume + '&jobid='+ job_post_id+'" target="_blank" title=""><span class="la la-id-card-alt"></span>View CV</a>';
                    html += '</td>';
                    html += '<td><span class="open-letter2" onclick="ViewCoverLatter(' + application_no + ',`'+skillsn+'`)"><a title=""><span class="la la-paperclip"></span>Cover Letter</a></span></td>';

                    html += '<td>'+ratings_word+'</td>';
                    // html += '<td>'+quizrate+'</td>';
                    html += '</tr>';
                }
 
   for (var j = 0; j < data['skills'].length; j++) {


console.log(j);
   skills+=  '<a class="dropdown-item" href="#"><input type="checkbox" name="skill" value="'+ data['skills'][j]['job_post_skill_tag']+'" style="position: initial;opacity: 1;" class="mr-2 skillbtn" onclick="filterSkills()">'+ data['skills'][j]['job_post_skill_tag']+'</a>';
}


console.log('v'+data['questions'].length);


  for (var k = 0; k < data['questions'].length;k++) {
    if(data['questions'][k]['question'] != ''){

   questions+=  '<a class="dropdown-item" href="#">'+ data['questions'][k]['question']+'</a>';
}
   // <a class="dropdown-item" href="#"><input type="checkbox" name="rate" value="'+ data['questions'][k]['question']+'" style="position: initial;opacity: 1;" class="mr-2">'+ data['questions'][k]['question']+'</a>';
}
    if(data['questions'].length > 0){
       $('#dropdown1v').html( data['questions'][0]['question']); 
    }
    else{
        $('#dropdown1v').html(''); 
    }

   $('#quz-questions').show();
   $('#filterby').show();
   $('#quz-items').html(questions);



if(data['questions'].length ==0){
    $('#questions').hide();
    $('#dropdown1v').hide();
    $('#plus').hide();
    $('#filterby').hide();
}








              $('#addskills').html(skills);

                $('#jobs_emp_table_body').html(html);
                $('#load_cart').html('');
                 $('#load_cart').html(carthtml);

                // $('.datatable-init').DataTable({
                //
                // });

                $('#jobs_emp_table').DataTable({
                    "aoColumnDefs": [
                        { "bSortable": false, "aTargets": [ 0, 1, 3 ] },
                    ],
                    language: {
                        searchPlaceholder: "Name"
                    }
                });

$a=localStorage.getItem("filter");

$('#jobs_emp_table').DataTable().search($a,true,false).draw();
localStorage.setItem("filter", "");






//=============================

var htmlbucket='';

 $('#jobs_emp_table_body2').html("");
        $('#jobs_emp_table2').DataTable().destroy();


 for (var i = 0; i < data['applications_candidates'].length; i++) {
                    var application_no = data['applications_candidates'][i]['id'];
                  
                    var jobseeker_last_name = data['applications_candidates'][i]['name'];
                    var applied_resume = data['applications_candidates'][i]['resume'];
                    var job_post_employer_id = data['applications_candidates'][i]['emp_id'];
                    // var job_post_title=data['applications_candidates'][i]['job_post_title'];
                    var jobseeker_user_id=data['applications_candidates'][i]['emp_id'];
                    var ratings_word= data['applications_candidates'][i]['ratings'];
                    var job_post_id=data['applications_candidates'][i]['job_id'];
                    var cover_letter= data['applications_candidates'][i]['cover_letter'];
                    // var quizrate=data['quizrate'];

                   

                    htmlbucket += '<tr class="emply-resume-list_1" data-apl_id="' + application_no + '" role="row">';
                    htmlbucket += '<td style="display: none;">' + job_post_employer_id + '</td>';
                    htmlbucket += '<td><div class="level-1-layer">';
                    htmlbucket += '   <div class="item-checkbox">';
                    htmlbucket += '<input type="checkbox" name="access_func[]" class="filter-input route-parent rou-1" value="1" id="par-' + job_post_employer_id + '" style="z-index:1 !important">';
                    htmlbucket += '<label class="filter-label" for="par-' + job_post_employer_id + '">';
                    htmlbucket += '</label>';
                    htmlbucket += '</div>';
                    htmlbucket += '</div></td>';

                    htmlbucket += '<td>' +  jobseeker_last_name + '</td>';
                    htmlbucket += '<td>';
                   htmlbucket +=  applied_resume ;
                    htmlbucket += '</td>';
                    htmlbucket += '<td>'+cover_letter+'</td>';

                    htmlbucket += '<td>'+ratings_word+'</td>';
                    // htmlbucket += '<td>'+quizrate+'</td>';
                    htmlbucket += '</tr>';
                }


 $('#jobs_emp_table_body2').html(htmlbucket);


 $('#jobs_emp_table2').DataTable({
                    "order": [],
                    language: {
                        searchPlaceholder: "Title"
                    }
                });














//==============================



            },
            error: function(jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
            }
        });
    }



$('.plus').click(function(){

 var quz=localStorage.getItem("quiz");

 var item=parseInt(quz)+1;
 localStorage.setItem("quiz", item);


})









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

    function ViewCoverLatter(id,skills) {
        let c_id = id;
        let js_name = $('#job_title').text();
       var skill =skills.split(',');

    var skillhtml='';

       skill.map((skill)=>{
       // console.log(skill)
        skillhtml +='<span class="badge badge-success" style="margin:2px;">'+skill+'</span>';

       })
       console.log(skill);

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
                $('<p>Skills</p>'+skillhtml).insertAfter('.cover-letter-content');
                $('.coverletter-popup').fadeIn();
                $('html').addClass('no-scroll');

            },
            error: function(jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
            }
        });
    }

    $('#sendExam').on('click', function() {
        save_assign_exam_papers();
    });

    function save_assign_exam_papers() {
        $('#jobs_emp_table_body tr').each(function() {
            var tr = $(this);
            var Array = [];
            var id = tr.find('td:nth-child(1)').text();
            var isNew = tr.find('td:nth-child(2)').text();
            var checkBox = tr.find('td:nth-child(2) > inputCheck');
            var inputCheck = $('.inputCheck2').prop('checked');
            var Job = tr.find('td:nth-child(3)').text();
            var Count = tr.find('td:nth-child(4)').text();

            var exam_id = $('#next_job_id').val();
            var html = '';
            if (inputCheck) {
                //assign_job

                $.ajax({
                    type: "GET",
                    data: {
                        jobid: id,
                        exam_id: exam_id
                    },
                    dataType: 'json',
                    url: base_url + 'employer/job_posts/ats_exam_assing_job',
                    cache: true,
                    beforeSend: function() {
                        HoldOn.open(loader_options);
                    },
                    success: function(data) {
                        HoldOn.close();
                        $('#id_exam').val(data.id);

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        HoldOn.close();
                        heads_up_error();
                    }
                });
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
                   var  level=1;

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
                                checkedExam_id: checkedExam_id,
                                level:1
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

    function openModal_bucket(){
        var booolflase=0;
        var Employers=[];
        var cartcount=$('#cartcount').attr('data-count');
        if(cartcount=='-'){
            cartcount=0;
        }
        else{
          cartcount=parseInt(cartcount);  
        }
  console.log(cartcount);
          var $i=1;
        $('#jobs_emp_table_body tr').each(function() {

            cartcount=cartcount+$i;
           // $('#cartcount').attr('data-count',cartcount);

            console.log(cartcount);

            var tr = $(this);
            var emp_id = tr.find('td:nth-child(1)').text();

              var name = tr.find('td:nth-child(3)').text();
               var resume = tr.find('td:nth-child(5)').html();
               var cover_letter= tr.find('td:nth-child(6)').html();
               var ratings= tr.find('td:nth-child(7)').html();






            // var arry_emp[]="";
            var inputCheck = $('#par-' + emp_id + '').prop('checked');
            var id_ViewJob=$('#id_ViewJob').val();

            if(inputCheck){
                // Employers.push(emp_id);
                booolflase=+1
                $.ajax({
                    type: "GET",
                    data: {
                        Employers: emp_id,
                        id_ViewJob: id_ViewJob,
                        name:name,
                        resume:resume,
                        cover_letter:cover_letter,
                        ratings:ratings


                    },
                    dataType: 'json',
                    url: base_url + 'employer/job_posts/ats_exam_setup_candidate',
                    cache: true,
                    beforeSend: function() {
                        HoldOn.open(loader_options);
                    },
                    success: function(data) {
                        HoldOn.close();


var html='';

 $('#jobs_emp_table_body2').html("");
        $('#jobs_emp_table2').DataTable().destroy();


 for (var i = 0; i < data['applications'].length; i++) {
                    var application_no = data['applications'][i]['id'];
                  
                    var jobseeker_last_name = data['applications'][i]['name'];
                    var applied_resume = data['applications'][i]['resume'];
                    var job_post_employer_id = data['applications'][i]['emp_id'];
                    // var job_post_title=data['applications'][i]['job_post_title'];
                    var jobseeker_user_id=data['applications'][i]['emp_id'];
                    var ratings_word= data['applications'][i]['ratings'];
                    var job_post_id=data['applications'][i]['job_id'];
                    var cover_letter= data['applications'][i]['cover_letter'];
                    // var quizrate=data['quizrate'];

                   

                    html += '<tr class="emply-resume-list_1" data-apl_id="' + application_no + '" role="row">';
                    html += '<td style="display: none;">' + job_post_employer_id + '</td>';
                    html += '<td><br><div class="level-1-layer">';
                    html += '   <div class="item-checkbox">';
                    html += '<input type="checkbox" name="access_func[]" class="filter-input route-parent rou-1" value="1" id="par-' + job_post_employer_id + '" style="z-index:1 !important">';
                    html += '<label class="filter-label" for="par-' + job_post_employer_id + '">';
                    html += '</label>';
                    html += '</div>';
                    html += '</div></td>';

                    html += '<td>' +  jobseeker_last_name + '</td>';
                    html += '<td>';
                    html +=  applied_resume ;
                    html += '</td>';
                    html += '<td>'+cover_letter+'</td>';

                    html += '<td>'+ratings_word+'</td>';
                    // html += '<td>'+quizrate+'</td>';
                    html += '</tr>';
                }


 //$('#jobs_emp_table_body2').html(html);


 $('#jobs_emp_table2').DataTable({
                    "order": [],
                    language: {
                        searchPlaceholder: "Title"
                    }
                });




                          

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        HoldOn.close();
                        heads_up_error();
                    }
                });
            }
           $i=$i+1;

        });

        if(booolflase>0) {

        }else{
            Swal.fire(
                    'Warning!',
                    'Please select applicant first',
                    'warning'
            )
        }
    }

    function openModal(){
        var booolflase=0;
        $('#jobs_emp_table_body tr').each(function() {
            var tr = $(this);
            var emp_id = tr.find('td:nth-child(1)').text();

            var inputCheck = $('#par-' + emp_id + '').prop('checked');
            if(inputCheck){
                booolflase=+1;
            }

        });
        if(booolflase>0) {
            $('#myModal').modal('toggle');
        }else{
            Swal.fire(
                    'Warning!',
                    'Please select applicant first',
                    'warning'
            )
        }
    }







  function filterSkills (){

console.log('working skills');

var val2 = [];


     $("input[name='skill']:checked").each(function (index, obj) {
         console.log($(this).val());
          val2.push($(this).val());
       
   });

     var mergedVal2 = val2.join(',');
 $('#jobs_emp_table').DataTable().search(mergedVal2,true,false).draw() ;


}














    function send_bucket_exam(){

        var booolflase=0;
        $('#jobs_emp_table_body2 tr').each(function() {
            var tr = $(this);
            var emp_id = tr.find('td:nth-child(1)').text();

           // var inputCheck = $('#par-' + emp_id + '').prop('checked');
            var inputCheck = $('input:checked').length;;
            if(inputCheck){
                booolflase=+1;
            }

        });
        if(booolflase>0) {

            $('#myModal').modal('toggle');
            $('#candidateModal').modal('toggle');
        }else{
            Swal.fire(
                    'Warning!',
                    'Please select applicant first',
                    'warning'
            )
        }
    }




function remove_bucket(){

    console.log('working'); 
 var booolflase2=0;
        $('#jobs_emp_table_body2 tr').each(function() {
            var tr = $(this);
            var emp_id = tr.find('td:nth-child(1)').text();

           // var inputCheck = $('#par-' + emp_id + '').prop('checked');
            var inputCheck2 = $('input:checked').length;

            console.log('input'+inputCheck2 );
            if(inputCheck2){
                booolflase2=+1;
                $('input:checked').closest('tr').hide();

               
            }

        });
        if(booolflase2>0) {

              var inputCheck2 = $('input:checked').length;

                var p3=parseInt($('.p1').attr('data-count'));
                p3=parseInt(p3)-inputCheck2;
                 $('.p1').attr('data-count',p3);



   $.ajax({
                    type: "GET",
                    data: {
                        //jobid: id,
                        'emp_id': 'emp_id'
                    },
                   // dataType: 'json',
                    url: base_url + 'employer/employer_post_job/remove_bucket',
                    cache: true,
                    beforeSend: function() {
                        HoldOn.open(loader_options);
                    },
                    success: function(data) {
                        HoldOn.close();
                        //$('#id_exam').val(data.id);

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        HoldOn.close();
                        heads_up_error();
                    }
                });











            //$('#myModal').modal('toggle');
            //$('#candidateModal').modal('toggle');
        }else{
            Swal.fire(
                    'Warning!',
                    'Please select applicant first',
                    'warning'
            )
        }


}







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
    $('#from').attr("min", today);
    $('#to').attr("min", today);

</script>

<script>
    /* ADD multiple dropdowns*/
    $(document).ready(function () {
        $('.multi-field-wrapper').each(function () {
            var $wrapper = $('.multi-fields', this);
            var x = 1;

            /*
            $(".add-field", $(this)).click(function (e) {
                x++;
                $($wrapper).append('<div class="multi-field row mt-3 float-left">' +
                        '<div class="col-12">' +

                        '<div name="filter[]" class="dropdown d-inline">' +
                        '<button class="btn btn-primary btn-sm dropdown-toggle mr-2" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter by</button>' +
                        '<div class="dropdown-menu filter-dropdowns" aria-labelledby="dropdownMenuButton1">' +
                        '<p class="text-secondary ml-3 mb-0">Show me only</p>' +
                        '<a class="dropdown-item" href="#"><input type="checkbox" name="rate" value="1" style="position: initial;opacity: 1;" class="mr-2">Yes</a>' +
                        '<a class="dropdown-item" href="#"><input type="checkbox" name="rate" value="2" style="position: initial;opacity: 1;" class="mr-2">No</a>' +
                        '<a class="dropdown-item" href="#"><input type="checkbox" name="rate" value="3" style="position: initial;opacity: 1;" class="mr-2">All</a>' +
                        '<hr><button class="btn primary-outline-btn btn-sm float-right mr-2 mb-2">Show Results</button>' +
                        '</div></div>' +

                        '<div name="Question[]" class="dropdown d-inline">' +
                        '<button class="btn primary-outline-btn btn-sm dropdown-toggle mr-2" type="button" id="dropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                        ' Do you have a bachelor\'s degree?</button>' +
                        '<div class="dropdown-menu filter-dropdowns" aria-labelledby="dropdown1">' +
                        '<a class="dropdown-item" href="#">Do you have 8 years of Experience?</a>' +
                        '<a class="dropdown-item" href="#">Do you have 2 Years experience in Angular?</a>' +
                        '<a class="dropdown-item" href="#">Do you have Do you have experience in PHP</a>' +
                        '</div></div>' +

                        '<button type="button" class="btn btn-primary btn-sm remove_field mr-2 ml-4"><i class="fas fa-minus"></i></button>' +

                        '</div></div>');
            });

            $($wrapper).on("click", ".remove_field", function (e) { //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })

            */
        });

$('.ratebtn').click(function(){



var val = [];

// val.push("ASIA");
// val.push("Africa");
// val.push("EU");
// val.push("USA");


// var mergedVal = val.join('|');

     $("input[name='rate']:checked").each(function (index, obj) {
         console.log($(this).val());
          val.push($(this).val());
       
   });

     var mergedVal = val.join('|');
 $('#jobs_emp_table').DataTable().search(mergedVal,true,false).draw() ;
})





//$('.skillbtn').bind("click", function(){

  









$('.multi-progress-bar').click(function(e){
    e.preventDefault();
var filerd=$(this).attr('filter');
if(filerd==''){
  var  $a='not_a_user';

}
else{
 var  $a=filerd;
}
 console.log($a);

localStorage.setItem("filter",$a);

// $('#jobs_emp_table').DataTable().search($a,true,false).draw();
 

});




    });
</script>
