<style type="text/css" xmlns="http://www.w3.org/1999/html">
    .manage-jobs-sec{
        padding: 0px;
    }

    @media (min-width: 992px) {
        .col-lg-6.job-sec{
            -webkit-box-flex: 0;
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
            max-width: 50%;
        }
        .col-lg-4.job-sec{
            -webkit-box-flex: 0;
            -ms-flex: 0 0 30%;
            flex: 0 0 30%;
            max-width: 30%;
        }

        .col-lg-6.job-sec, .col-lg-4.job-sec {
            margin: 20px 10px;
            box-shadow: 0 4px 8px 0 rgb(0 0 0 / 5%), 0 6px 20px 0 rgb(0 0 0 / 7%);
        }
    }

    .card-right{
        padding: 20px 35px;
        margin: auto;
    }
    .card-right.top-padding{
        padding: 0px 35px;
        margin: auto;
    }


    .manage-jobs-sec table tbody td {
        padding: 5px 5px !important;
    }

    .manage-jobs-sec table tbody td label {
        margin-bottom: 0 !important;
    }

    input[type="text"], input[type="number"], input[type="tel"], input[type="password"], input[type="email"], textarea {
        background: #e4e4e4 none repeat scroll 0 0;
        border: medium none;
        float: left;
        font-size: 16px;
        font-weight: 400;
        margin: 5px 0;
        padding: 12px 20px;
        width: 80%;
    }

    .manage-jobs-sec table {
        float: left;
        width: 100%;
        margin-top: 10px;
        margin-bottom: 60px;
        margin-left: 0px;
        flex: 0 0 100%;
    }

    b {
        font-weight: 500;
    }
</style>

<section>
    <div class="block no-padding">
        <div class="container-fluid">
            <div class="row no-gape">

                <!--include side bar for employer-->
                <?php $this->load->view('include/side_bar_left_ats') ?>


                <div class="col-lg-6 column job-sec printHtml">
                    <div class="padding-left">
                        <a href="<?php echo base_url()?>employer/job_posts/ats_Interviewee" id="back_btn"><label><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                                                                                      width="24" height="24"
                                                                                                                      viewBox="0 0 172 172"
                                                                                                                      style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g><path d="M2.65391,86c0,-46.02344 37.32266,-83.34609 83.34609,-83.34609c46.02344,0 83.34609,37.32266 83.34609,83.34609c0,46.02344 -37.32266,83.34609 -83.34609,83.34609c-46.02344,0 -83.34609,-37.32266 -83.34609,-83.34609z" fill="#018e53"></path><path d="M77.73594,86.90703c10.31328,-10.31328 20.62656,-20.62656 30.93984,-30.93984c9.00312,-9.00313 -5.00547,-22.91094 -14.04219,-13.87422c-12.63125,12.63125 -25.2625,25.2625 -37.89375,37.89375c-3.82969,3.82969 -3.69531,10.17891 0.06719,13.94141c12.63125,12.63125 25.2625,25.2625 37.89375,37.89375c9.00313,9.00313 22.91094,-5.00547 13.87422,-14.04219c-10.27969,-10.31328 -20.55938,-20.59297 -30.83906,-30.87266z" fill="#ffffff"></path></g></g></svg></label> </a>
                    </div>

                    <div class="padding-left" id="DivIdToPrint">
                        <div class="manage-jobs-sec">
                            <div class="col-md-12 row" style="margin: 2px;">
                                <h3 id="title2" style="border-bottom: 1px solid #edeff7; padding-bottom: 20px; width: 100%;">

                                </h3>
                            </div>
                            <div class="col-md-12 row" style="margin-left:0">
                                <div class="col-md-6" style="padding: 0;"><b>Interview Location: </b><label id="job_post_city"></label></div>
                                <div class="col-md-6" style="text-align: right; padding-right: 0;"><b>Date Of Interview: </b><label id="date_i"></label></div>
                            </div>
                            <div class="col-md-12 row" style="margin-left:0">
                                <input type="hidden" id="jobseeker_id" value="<?php echo $this->input->get('emp_id'); ?>"/>
                                <input type="hidden" id="id_shadule" value="<?php echo $this->input->get('id_shadule'); ?>"/>
                                <table class="table table-sm " >
                                    <thead class="thead-light">
                                    <tr>
                                            <th colspan="8" style="text-align: center; padding-bottom: 0px;">Candidate Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                <td colspan="2"><b>Candidate Name</b></td>
                                                <td colspan="6"><label id="candidate_name"></label></td>

                                            </tr>
                                            <tr>
                                                <td colspan="2"><b>Position Title</b></td>
                                                <td colspan="3"><label id="position"></label></td>
                                                <td colspan="1"><b>Gender</b></td>
                                                <td colspan="1" id="Male">
                                                    <label>Male</label>
                                                </td>
                                                <td colspan="1" id="Female">
                                                    <label>Female</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><b> Start Date</b></td>
                                                <td colspan="2">
                                                    <input type="date" id="date" class="form-control"/>
                                                </td>
                                                <td colspan="2"><b>Expected Salary</b></td>
                                                <td colspan="2">
                                                    <input type="text" class="form-control"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><b>Preferred Work Shift</b></td>
                                                <td colspan="6">

                                                    <input type="text" class="form-control" />
                                                </td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12 row" style="margin-left:0" >
<!--                                <input type="text" style="margin-left: 20px;" placeholder="title" id="title" class="form-control">-->
                                <input type="hidden" id="id_exam" value="<?php echo $this->input->get('id'); ?>"  id="title" class="form-control">
                            </div>
                            <div class="col-md-12 ml-auto" style="padding-right: 30px;">
<!--                                <button type="button" class="btn-info btn-md" data-toggle="modal" data-target="#myModal" onclick="clear_id('1')">   <span class="fa fa-plus" ></span>&nbsp;Add Question</button>-->
                            </div>
                            <br>
                        </div>
                        <div class="manage-jobs-sec" id="tbl" >
                            <table id="rate_tbl" style="width: 90%; margin-left:32px; margin-right:32px;">
                                <thead>
                                <tr style="text-align: center;">
                                    <th style="text-align: left;" >&nbsp;</th>
                                    <th >Excellent</th>
                                    <th >Good</th>
                                    <th >Average</th>
                                    <th >Poor</th>
                                    <th ></th>
                                </tr>
                                </thead>
                                <tbody id="rate_tbl_body">

                                </tbody>
                            </table>
                        </div>

                        <div class="manage-jobs-sec" id="question_answer"></div>

<!--                        <img src="--><?php //echo base_url() ?><!--assets/styles/images/chart.JPG"/>-->
<!--                        <br>-->
                        <div class="manage-jobs-sec">
                        <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 column job-sec right_panel">

                    <div class="">
                        <div class="manage-jobs-sec">

                        </div>

                        <div class="col-md-12 row card-right">
<!--                            <div class="col-md-12">-->
                            <a type="button" onclick="view_profile(<?php echo $this->input->get('emp_id'); ?>)"  class="btn-warning col-md-5"><span class="la la-id-card"></span>&nbsp;Profile</a>&nbsp;
<!--                            </div>-->
<!--                            <div class="col-md-12">-->
                            &nbsp;
                            <a type="button" href="../../employer/resume/view?r_id=2024" target="_blank"  class="btn-warning col-md-5"><span class="la la-paperclip"></span>&nbsp;Resume</a>&nbsp;
<!--                            </div>-->

                        </div>
                        <div class="col-md-12 row card-right row">
<!--                            <div class="col-md-12 row">-->
<!--                                <div class="col-md-6">ATS</div>-->
<!--                                <div class="col-md-6"><input id="ats" type="text" id="ats_v" value="75%" class="form-control" disabled/></div>-->
<!--                            </div>-->
                            <div class="col-md-12 row">
                                <div class="col-md-6">Exam</div>
                                <div class="col-md-6"><input id="exam" type="text" id="exam_v" value="75%" class="form-control" disabled/></div>
                            </div>
                            <div class="col-md-12 row">
                                <div class="col-md-6">Add Overall Rate</div>
                                <div class="col-md-6"><input id="overall" type="text"  class="form-control" /></div>
                            </div>
                            <div class="col-md-12 row" style="margin-top: 80px;">
                                <select class="form-control dropdown_f" id="status">
                                    <option disabled>Select Status</option>
                                    <option>Finalized</option>
                                    <option>Pending</option>
                                    <option>Failed</option>
                                </select>
                            </div>
                            <div class="col-md-12 row">
                                &nbsp;<br>
                            </div>

                            <div class="col-md-12 row">

                                <div class="offset-md-2 col-md-8">
                                    <input type="hidden" id="form_id" value="<?php echo $this->input->get('id'); ?>"/>
                                    <input type="hidden" id="emp_id" value="<?php echo $this->input->get('emp_id'); ?>"/>
                                <button type="button" class="btn-success form-control" onclick="saved_data()"><span class="la la-save"></span>&nbsp;Save</button>
                                </div>

                            </div>
                            <div class="col-md-12 row">
                                &nbsp;<br>
                            </div>
                            <div class="col-md-12 row">
                                <div class="offset-md-2 col-md-8">
                                    <button type="button" class="btn-primary form-control" onclick="PrintDiv()"><span class="la la-print"></span>&nbsp;Print</button>
                                </div>

                            </div>

                            <div>
<!--                                <button onclick="print_html('printHtml')"></button>-->
                            </div>
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
                <h4 class="modal-title">Create New Question</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <select id="question_type" class="form-control">
                            <option value="1">Check Box</option>
                            <option value="2">Radio Button</option>
                            <option value="3">Short Answer</option>
                        </select>
                    </div>
                </div>
                <br>
                <div  class="col-md-12">
                    <div class="col-md-12">
                        <input type="text" placeholder="Question" id="Question" class="form-control"/>
                    </div>

                </div>

                <div id="Answer" class="col-md-12">

                    <div class="col-md-12 row">
                        <div class="col-md-10">
                            <input type="text" id="answer_001" placeholder="Answer 01" class="form-control col-md-12"/>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <div class="level-1-layer">
                                <div class="item-checkbox">
                                    <input type="checkbox" name="access_func" class="filter-input route-parent" value="" id="answer_001_check">
                                    <label class="filter-label" for="answer_001_check">
                                        Correct
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 row">
                        <div class="col-md-10">
                            <input type="text" id="answer_002" placeholder="Answer 02" class="form-control"/>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <div class="level-1-layer">
                                <div class="item-checkbox">
                                    <input type="checkbox" name="access_func" class="filter-input route-parent" value="" id="answer_002_check">
                                    <label class="filter-label" for="answer_002_check">
                                        Correct
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 row">
                        <div class="col-md-10">
                            <input type="text" id="answer_003" placeholder="Answer 03" class="form-control"/>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <div class="level-1-layer">
                                <div class="item-checkbox">
                                    <input type="checkbox" name="access_func[]" class="filter-input route-parent" value="" id="answer_003_check">
                                    <label class="filter-label" for="answer_003_check">
                                        Correct
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 row">
                        <div class="col-md-10">
                            <input type="text" id="answer_004" placeholder="Answer 04" class="form-control"/>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <div class="level-1-layer">
                                <div class="item-checkbox">
                                    <input type="checkbox" name="access_func[]" class="filter-input route-parent" value="" id="answer_004_check">
                                    <label class="filter-label" for="answer_004_check">
                                        Correct
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn-success btn-sm" data-dismiss="modal" onclick="save_question()">Save</button>
                <button type="button" class="btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<!-- Modal -->
<div id="myProfile" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Profile</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <center style="background-color: #8486121f" class="p-2">
                    <img id="uploaded_image_view" src=<?php echo base_url()?>/uploads/user_dp/24746_1605791557.png" alt="" width="140" height="140" border="0" class="img-circle"></a>
                    <h3  id="name" class="media-heading">TTTT  Name</h3>
                    <p id="name" style="font-weight: 400" id="dob"><label class="la la-phone pr-lg-2"></label>
                        <label id="ccode">+94</label>
                        <label id="mobile">702079678</label></p>
                </center>
                <hr>
                <div>
                    <div class="col-md-12 row pl-4 pr-4 ml-1 mr-1 mt-1" style="background-color: #F4F5FA;">
                        <div class="col-lg-5 font-weight-bold">
                            Date of birth
                        </div>
                        <div class="col-lg-7">
                            <label id="dob">xx-xx-xxxx</label>
                        </div>
                    </div>
                    <div class="col-md-12 row pl-4 pr-4 ml-1 mr-1 mt-1" style="background-color: #F4F5FA;">
                        <div class="col-lg-5 font-weight-bold">
                            Gender
                        </div>
                        <div class="col-lg-7">
                            <label id="gen">Male</label>
                        </div>
                    </div>
                    <!--                <div class="col-md-12 row">-->
                    <!--                    <div class="col-lg-4">-->
                    <!--                        Email-->
                    <!--                    </div>-->
                    <!--                    <div class="col-lg-8">-->
                    <!--                        <label id="email">abc@mail.com</label>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--                <div class="col-md-12 row">
                                        <div class="col-lg-4">
                                            Mobile
                                        </div>
                                        <div class="col-lg-8">
                                            <label id="ccode">+94</label>
                                            <label id="mobile">702079678</label>
                                        </div>
                                    </div> -->
                    <div class="col-md-12 row pl-4 pr-4 ml-1 mr-1 mt-1" style="background-color: #F4F5FA;">
                        <div class="col-lg-5 font-weight-bold">
                            Address
                        </div>
                        <div class="col-lg-7">
                            <label id="address1">Line 1</label>
                            <label id="address2">,Line 2</label>
                        </div>
                    </div>
                    <div class="col-md-12 row pl-4 pr-4 ml-1 mr-1 mt-1" style="background-color: #F4F5FA;">
                        <div class="col-lg-5 font-weight-bold">
                            City / Town
                        </div>
                        <div class="col-lg-7">
                            <label id="cty">cty</label>
                        </div>
                    </div>
                    <div class="col-md-12 row pl-4 pr-4 ml-1 mr-1 mt-1" style="background-color: #F4F5FA;">
                        <div class="col-lg-5 font-weight-bold">
                            Country
                        </div>
                        <div class="col-lg-7">
                            <label id="country">cty</label>
                        </div>
                    </div>
                    <div class="col-md-12 row pl-4 pr-4 ml-1 mr-1 mt-1" style="background-color: #F4F5FA;">
                        <div class="col-lg-5 font-weight-bold">
                            Allow In Search
                        </div>
                        <div class="col-lg-7">
                            <label id="search">yes/no</label>
                        </div>
                    </div>
                    <div class="col-md-12 row pl-4 pr-4 ml-1 mr-1 mt-1" style="background-color: #F4F5FA;">
                        <div class="col-lg-5 font-weight-bold">
                            Social Network Links
                        </div>
                        <div class="col-lg-7">
                            <label class="la la-facebook pr-lg-3"></label><a id="fb">facebook</a><br>
                            <label class="la la-twitter pr-lg-3"></label><a id="twitter">Twitter</a><br>
                            <label class="la la-linkedin pr-lg-3"></label><a id="linkedin">Linkedin</a><br>
                            <label class="la la-youtube pr-lg-3"></label><a id="youtube">youtube </a><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<script src="<?php echo base_url()?>assets/plugins/datatables/datatables.js" type="text/javascript"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<script type="text/javascript">
    // window.onload = function() {
    // var ats_v=75;//$('#ats_v').val();
    // var exam_v=75;//$('#exam_v').val();
    //
    //  ats_v=ats_v/2;
    //  exam_v=exam_v/2;
    // var  other=100-(ats_v+exam_v);
    //
    //  var options = {
    //      title: {
    //          text: "Marks Chart"
    //      },
    //      data: [{
    //          type: "pie",
    //          startAngle: 45,
    //          showInLegend: "true",
    //          legendText: "{label}",
    //          indexLabel: "{label} ({y})",
    //          yValueFormatString:"#,##0.#"%"",
    //          dataPoints: [
    //              { label: "ATS Marks", y: ats_v },
    //              { label: "Exam Marks", y: exam_v },
    //              { label: "Other", y: other },
    //          ]
    //      }]
    //  };
    //  $("#chartContainer").CanvasJSChart(options);
    //
    // }
    window.onload = function () {
        // var ats_v=75;//$('#ats_v').val();
        var exam_v=75//$('#exam_v').val();

            // ats_v=ats_v/2;
            exam_v=exam_v;
        // var  other=100-(exam_v);
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title:{
                text: "Marks Chart"
            },
            axisY: {
                title: "Marks"
            },
            data: [{
                type: "column",
                showInLegend: true,
                legendMarkerColor: "grey",
                legendText: "MMbbl = one million barrels",
                dataPoints: [
                    { y: exam_v,  label: "Exam Marks" },
                ]
            }]
        });
        chart.render();

    }
</script>
<script>
    $(document).ready(function () {




        $('#uploaded_image_view').text('');
        $('#name').text('');
        $('#dob').text('');
        $('#gen').text('');
        $('#email').text('');
        $('#ccode').text('');
        $('#mobile').text('');
        $('#address1').text('');
        $('#address2').text('');
        $('#cty').text('');
        $('#country').text('');
        $('#search').text('');
        $('#fb').text('');
        $('#twitter').text('');
        $('#linkedin').text('');
        $('#youtube').text("");
        $('.datatable-init').DataTable({
            "order": [],
            language: {
                searchPlaceholder: "Search records"
            }
        });

        Load_queqtion();

    });

    function view_profile(emp_id){


        $.ajax({
            type: "GET",
            data: {
                emp_id:emp_id,
            },
            dataType: 'json',
            url: base_url + 'employer/job_posts/load_profile',
            cache: true,
            beforeSend: function () {
                HoldOn.open(loader_options);
            },
            success: function (data) {
                HoldOn.close();
                for(var i=0;i<data.output.length;i++) {

                    // ---------------------------------------------------------------------


                    if (i == 0) {
                        $('#name').text(data.output[i]['jobseeker_first_name'] +' '+data.output[i]['jobseeker_middle_name']+' '+data.output[i]['jobseeker_last_name']  );
                        $('#dob').text(data.output[i]['jobseeker_dob']);
                        if(data.output[i]['jobseeker_gender']=='M') {
                            $('#gen').text('Male');
                        }else{
                            $('#gen').text('Female');
                        }
                        // $('#email').text(data.output[i]['jobseeker_country_code_idd']);
                        $("#uploaded_image_view").attr("src",data.output[i]['jobseeker_dp_url']);
                        $('#ccode').text(data.output[i]['jobseeker_country_code_idd']);
                        $('#mobile').text(data.output[i]['jobseeker_phone_no']);
                        $('#address1').text(data.output[i]['jobseeker_address1']);
                        $('#address2').text(data.output[i]['jobseeker_address2']);
                        $('#cty').text(data.output[i]['jobseeker_city']);
                        $('#country').text(data.output[i]['country']);
                        $('#search').text(data.output[i]['jobseeker_cv_searchable']);
                        $('#fb').text(data.output[i]['jobseeker_facebook_url']);
                        $('#fb').attr("href","https://"+data.output[i]['jobseeker_facebook_url']+"");
                        $('#twitter').text(data.output[i]['jobseeker_twitter_url']);
                         $('#twitter').attr("href","https://"+data.output[i]['jobseeker_twitter_url']+"");
                        $('#linkedin').text(data.output[i]['jobseeker_linked_in_url']);
                        $('#linkedin').attr("href","https://"+data.output[i]['jobseeker_linked_in_url']+"");
                        $('#youtube').text(data.output[i]['jobseeker_youtube_video_url']);
                         $('#youtube').attr("href","https://"+data.output[i]['jobseeker_youtube_video_url']+"");
                    }
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
            }
        });

        $('#myProfile').modal('toggle');

    }
    function PrintDiv(){

        // var html_content=$('#DivIdToPrint').html();
        $('#responsive-header').hide();
        $('aside').hide();
        $('footer').hide();
        $('header').hide();
        $('.right_panel').hide();
        $('.la-navicon').hide();
        $('#back_btn').hide();
        var hideElm = 'Menu',
                regex = new RegExp(hideElm, 'g');


        //$(this).parents('div').fadeOut();
        // $('#DivIdToPrint').parents('div').fadeOut();
        // var html_content=document.getElementById('#DivIdToPrint').innerHTML();
        // window.print(html_content);
        // var newWindow = window.open('about:blank', '_blank');
        // newWindow.document.write('<!doctype html><html><head><title>Test</title><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"></head><body>'+html_content+'</body></html>');
        // newWindow.focus();
        window.print();
        // newWindow.close();
        $('#responsive-header').show();
        $('aside').show();
        $('footer').show();
        $('header').show();
        $('.right_panel').show();
        $('.la-navicon').show();
        $('#back_btn').show();

}

    $('.check1').on('click',function () {
        var isCheck=$(".check1 :input").prop( "checked" );
        if(isCheck){

        }else {
            $(".check2 :input").attr("checked", false);
            $(".check3 :input").attr("checked", false);
            $(".check1 :input").attr("checked", true);
        }
    });

    $('.check2').on('click',function () {
        var isCheck=$(".check1 :input").prop( "checked" );
        if(isCheck){
            $(".check2 :input").removeAttr("checked");
        }else {
            $(".check1 :input").attr("checked", false);
            $(".check3 :input").attr("checked", false);
            $(".check2 :input").attr("checked", true);
        }
    });
    $('.check3').on('click',function () {
        var isCheck=$(".check3 :input").prop( "checked" );
        if(isCheck){
            $(".check3 :input").removeAttr("checked");
        }else {
            $(".check1 :input").attr("checked", false);
            $(".check2 :input").attr("checked", false);
            $(".check3 :input").attr("checked", true);
        }
    });

    $('#update').on('click',function (){
        var title=$('#title').val();
        var status=0;
        if($('#isStatusExam').prop('checked')){
            status=1;
        }else{
            status=0;
        }
        var isSave=0;
        if($('#id_exam').val()!=null){
            isSave=$('#id_exam').val();
        }else{
            isSave=0;
        }

        //Saved Master Data exam
        $.ajax({
            type: "GET",
            data:{title: title,status:status,isSave:isSave},
            dataType: 'json',
            url: base_url+'employer/job_posts/ats_form_save',
            cache: true,
            beforeSend: function(){
                HoldOn.open(loader_options);
            },
            success: function (data) {
                HoldOn.close();

                $('#id_exam').val(data.id);
                Swal.fire(
                        'Updated!',
                        'Your file has been updated!.',
                        'success'
                )

            },
            error: function (jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
            }
        });
    });

    $('#next').on('click',function () {
        $('#id_exam').val("");
    });

    $('#question_type').on('change',function (){

        var question_type=$('#question_type').val();

        $('#answer_001').val("");
        $('#answer_002').val("");
        $('#answer_003').val("");
        $('#answer_004').val("");


        if(question_type==3){
            $('#Answer').hide();
        }else{
            $('#Answer').show();
        }


    });


    function save_question(){

        var id_exam=$('#id_exam').val();
        if(id_exam!="") {
            var question_type = $('#question_type').val();
            var Question = $('#Question').val();
            var id_exam=$('#id_exam').val();

            var answer_001=$('#answer_001').val();
            var answer_002=$('#answer_002').val();
            var answer_003=$('#answer_003').val();
            var answer_004=$('#answer_004').val();


            var answer_001_check=false;
            var answer_002_check=false;
            var answer_003_check=false;
            var answer_004_check=false;

            // ----------------------------------------------
            if($('#answer_001_check').prop('checked')){
                answer_001_check=true;
            }
            // ----------------------------------------------
            if($('#answer_002_check').prop('checked')){
                answer_002_check=true;
            }
            // ----------------------------------------------
            if($('#answer_003_check').prop('checked')){
                answer_003_check=true;
            }
            // ----------------------------------------------
            if($('#answer_004_check').prop('checked')){
                answer_004_check=true;
            }


            //Saved Master Data exam
            $.ajax({
                type: "GET",
                data: {
                    id_exam:id_exam,
                    question_type: question_type,
                    Question: Question,
                    answer_001:answer_001,
                    answer_002:answer_002,
                    answer_003:answer_003,
                    answer_004:answer_004,
                    answer_001_check:answer_001_check,
                    answer_002_check:answer_002_check,
                    answer_003_check:answer_003_check,
                    answer_004_check:answer_004_check

                },
                dataType: 'json',
                url: base_url + 'employer/job_posts/ats_question_save_form',
                cache: true,
                beforeSend: function () {
                    HoldOn.open(loader_options);
                },
                success: function (data) {
                    HoldOn.close();
                    Load_queqtion();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    HoldOn.close();
                    heads_up_error();
                }
            });
        }else{

            Swal.fire(
                    'Update',
                    'Please create (update) exam setup details',
                    'warning'
            )
        }
    }



    function Load_queqtion(){

        var id=$('#id_exam').val();
        var jobseeker_id=$('#jobseeker_id').val();
        var id_shadule=$('#id_shadule').val();


        $.ajax({
            type: "GET",
            data: {
                id:id,
                jobseeker_id:jobseeker_id
            },
            dataType: 'json',
            url: base_url + 'employer/job_posts/load_exam_form',
            cache: true,
            beforeSend: function () {
                HoldOn.open(loader_options);
            },
            success: function (data) {
                HoldOn.close();

                var Question='';
                var html2='';
                var Qnumber=0;
                var tabl_html=''
                var type='';



                var sub_queqtion_number='*';


                for(var i=0;i<data.output.length;i++){
               var q_id=data.output[i]['q_id'];


                    // ---------------------------------------------------------------------

                    if(i==0){
                        $('#title').val(data.output[i]['description']);
                        $('#title2').text(data.output[i]['description']);

                        var status=data.output[i]['status'];
                        if(status==1){
                            $('#isStatusExam').prop('checked', true);
                        }else{
                            $('#isStatusExam').prop('checked', false);
                        }

                    }

                    type=data.output[i]['type'];

                    var typeModal='';
                    if(type==1){


                        typeModal='<div class="level-1-layer">';
                        typeModal+='<div class="item-checkbox">';
                        typeModal+='<input type="checkbox" name="access_func[]" class="filter-input route-parent rou-1" value="1" id="par-'+data.output[i]['id_ats_exam_answer']+'">';
                        typeModal+='<label  class="filter-label" for="par-'+data.output[i]['id_ats_exam_answer']+'">';
                        typeModal+= ''+data.output[i]['answer']+'</label>';
                        typeModal+='</div>';
                        typeModal+='</div>';
                    }
                    else if(type==2){
                        typeModal='<div class="level-1-layer">';
                        typeModal+='<div class="item-radio">';
                        typeModal+='<input type="radio" id="par-'+data.output[i]['id_ats_exam_answer']+'" name="acces-'+data.output[i]['id_ats_exam_question']+'" value="1" class="">';
                        typeModal+='<label class="filter-label" for="par-'+data.output[i]['id_ats_exam_answer']+'">';
                        typeModal+= data.output[i]['answer'];
                        typeModal+='</label>';
                        typeModal+='</div>';
                        typeModal+='</div>';
                    }

                    // -------------------------------------------------------------------
                    if((type==1) || (type==2)) {

                        if (Question != data.output[i]['id_ats_exam_question']) {

                            if(Question==0) {
                                html2 += '<div class="card" style="margin: 20px;">';
                                // html2+='<div class="col-md-12 row"><div class="col-md-2 offset-10"><button class="btn-warning" onclick="delete_question('+data.output[i]['id_ats_exam_question']+')">Delete</button></div></div>'

                            }else{
                                html2+= '</div><div class="card" style="margin: 20px;">';
                                // html2+='<div class="col-md-12 row"><div class="col-md-2 offset-10"><button class="btn-warning" onclick="delete_question('+data.output[i]['id_ats_exam_question']+')">Delete</button></div></div>'

                            }
                            Qnumber = Qnumber + 1;
                            Question = data.output[i]['id_ats_exam_question'];
                            html2 += '<label style="display: none;" id="qNo">'+Question+'</label>';
                            html2 += '<label style="display: none;" id="type">MCQ</label>';
                            html2 += '<div style="background-color: #f3f3f3; padding: 10px 20px;"><h5>' + Qnumber + ').' + data.output[i]['question'] + '</h5></div><br>';

                            if(Question==1) {
                                html2 += '</div>';
                            }

                        }

                        html2 += '<div style="padding: 5px 40px;">' + typeModal+'</div>';



                    }else if(type==3){


                        html2+='</div>';
                        Qnumber = Qnumber + 1;
                        Question = data.output[i]['id_ats_exam_question'];

                        html2 += '<div class="card" style="margin: 20px;">';
                        // html2+='<div class="col-md-12 row"><div class="col-md-2 offset-10"><button class="btn-warning" onclick="delete_question('+q_id+')">Delete</button></div></div>'

                        html2 += '<label style="display: none;" id="qNo">'+data.output[i]['id_ats_exam_question']+'</label>';
                        html2 += '<label style="display: none;" id="type">SHORT</label>';
                        html2+= '<div style="background-color: #f3f3f3; padding: 10px 20px;"><h5>' + Qnumber + ').' + data.output[i]['question']+'</h5></div><br>';
                        html2 += '<div class="col-md-12" style="padding: 20px 40px;"><textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea></div>';
                        html2 += '</div>';

                    }else if(type==4){

                         Qnumber = Qnumber + 1;
                        Question = data.output[i]['question'];
                        tabl_html+='<tr style="text-align: center;">';
                        tabl_html+='<td style="width: 25%; text-align: left;"><b>';
                        tabl_html+=Question;
                        tabl_html+='</b></td>';
                        tabl_html+='<td style="width: 25%;">';
                        tabl_html+='<div class="level-1-layer"><div class="item-radio"><input type="radio" id="par-'+Qnumber+'-001" name="acces-'+Qnumber+'" value="1" class=""><label class="filter-label" for="par-'+Qnumber+'-001"></label></div></div>';
                        tabl_html+='</td>';
                        tabl_html+='<td style="width: 25%;">';
                        tabl_html+='<div class="level-1-layer"><div class="item-radio"><input type="radio" id="par-'+Qnumber+'-002" name="acces-'+Qnumber+'" value="1" class=""><label class="filter-label" for="par-'+Qnumber+'-002"></label></div></div>';
                        tabl_html+='</td>';
                        tabl_html+='<td style="width: 25%;">';
                        tabl_html+='<div class="level-1-layer"><div class="item-radio"><input type="radio" id="par-'+Qnumber+'-003" name="acces-'+Qnumber+'" value="1" class=""><label class="filter-label" for="par-'+Qnumber+'-003"></label></div></div>';
                        tabl_html+='</td>';
                        tabl_html+='<td style="width: 25%;">';
                        tabl_html+='<div class="level-1-layer"><div class="item-radio"><input type="radio" id="par-'+Qnumber+'-004" name="acces-'+Qnumber+'" value="1" class=""><label class="filter-label" for="par-'+Qnumber+'-004"></label></div></div>';
                        tabl_html+='</td>';

                        tabl_html+='</tr>';
                        //



                    }

                }

                $('#rate_tbl_body').html(tabl_html);

                $('#question_answer').html("");
                $('#question_answer').html(html2);


            },
            error: function (jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
            }
        });

        $.ajax({
            type: "GET",
            data: {
                jobseeker_id:jobseeker_id,
                id_shadule:id_shadule
            },
            dataType: 'json',
            url: base_url + 'employer/job_posts/load_exam_form2',
            cache: true,
            beforeSend: function () {
                HoldOn.open(loader_options);
            },
            success: function (data) {
                HoldOn.close();



                for(var i=0;i<data.output.length;i++){
                    // ----------------------------------------------------------------------
                    if(i==0){
                        var Name="";
                        var jobseeker_first_name=data.output[i]['jobseeker_first_name'];
                        var jobseeker_middle_name=data.output[i]['jobseeker_middle_name'];
                        var jobseeker_last_name=data.output[i]['jobseeker_last_name'];

                        if(jobseeker_first_name!=""){
                            Name+=jobseeker_first_name;
                        }
                        if(jobseeker_middle_name!=""){
                            Name+=" "+jobseeker_middle_name;
                        }
                        if(jobseeker_last_name!=""){
                            Name+=" "+jobseeker_last_name;
                        }

                        $('#candidate_name').text(Name);
                        $('#position').text(data.output[i]['job_post_title']);
                        $('#job_post_city').text(data.output[i]['location']);
                        $('#date_i').text(data.output[i]['date_i']);


                        if(data.output[i]['jobseeker_gender']=='M'){
                            $('#Female').hide();
                            $('#Male').show();
                        }else{
                            $('#Female').show();
                            $('#Male').hide();
                        }

                    //job_post_title

                    }



                }

                $('#question_answer').append(html2);

            },
            error: function (jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
            }
        });
    }

    function exam_view(){
        var id_exam=$('#id_exam').val();
        window.location.replace("<?php echo base_url() ?>employer/job_posts/ats_setup_exam_view?id="+id_exam);
    }

    function exam_next(){
        var id_exam=$('#id_exam').val();
        window.location.replace("<?php echo base_url() ?>employer/job_posts/ats_setup_exam_maker_next?next_job_id="+id_exam);

    }

    function print_html(printHtml){
        var html=$('.printHtml').html();

         window.print(html);


    }

    function clear_id(id){

        $('#Question').val("");
        $('#answer_001').val("");
        $('#answer_002').val("");
        $('#answer_003').val("");
        $('#answer_004').val("");

    }

    function saved_data(){

     var emp_id=$('#emp_id').val();
     var form_id=$('#form_id').val();
     var status=$( "#status option:selected" ).text();
     var exam=$('#exam').val();
     var ats=$('#ats').val();
     var overall=$('#overall').val();


        $.ajax({
            type: "GET",
            data: {
                emp_id:emp_id,
                form_id:form_id,
                status:status,
                exam:exam,
                ats:ats,
                overall:overall

            },
            dataType: 'json',
            url: base_url + 'employer/job_posts/ats_overall_data_add',
            cache: true,
            beforeSend: function () {
                HoldOn.open(loader_options);
            },
            success: function (data) {
                HoldOn.close();
                Swal.fire(
                        'successfully saved interviewee assesment',
                        '',
                        'success'
                )
            },
            error: function (jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
            }
        });


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
    $('#date').attr("min", today);



</script>

