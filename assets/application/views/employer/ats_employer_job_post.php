<style>
    #ex3 .fa-stack[data-count]:after{
        position:absolute;
        right:-1%;
        top:1%;
        content: attr(data-count);
        font-size:30%;
        padding:.6em;
        border-radius:50%;
        line-height:.8em;
        color: white;
        background:rgba(255,0,0,.85);
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
                                            <tr class="in-active" onclick="setJobs(<?php echo $active_post['job_post_id']; ?> ,'<?php echo $active_post['job_post_title']; ?>') ">
                                                <td>
                                                    <div class="table-list-title">
                                                        <h3 style="font-weight:600; font-size: 14px;"><a href="<?php echo !empty($active_post['job_post_id']) ? base_url() . 'jobs/view_job_post?jp_token=' . base64_encode($active_post['job_post_id']) : '' ?>" target="_blank" title=""><?php echo !empty($active_post['job_post_title']) ?  substr($active_post['job_post_title'], 0, 30) : '' ?></a></h3>
                                                        <span><i class="la la-map-marker"></i><?php if (!empty($active_post['job_post_city'])) {
                                                                                                    echo $active_post['job_post_city'];
                                                                                              }; ?></span>
                                                    </div>
                                                </td>

                                                <td>
                                                    <span class="status active application-count applied ">
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

                <div class="col-lg-5 row job-sec">
                    <div class="offset-10 col-md-2">

                        <div id="ex3">
                                <span class="p1 fa-stack fa-2x has-badge" data-count="-" id="cartcount">
                                <i class="p2 fa fa-circle fa-stack-2x" style="margin-left: -10px;"></i>
                                <i class="p3 fa fa-shopping-cart fa-stack-1x fa-inverse" data-count="5"></i>
                                </span>
                        </div>



<!-- cart mini cart -->

<div class="container">
  <div class="shopping-cart" style="display:none">
  

   <table class="table">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Position</th>
      <th scope="col">Send exam</th>
      <th scope="col">Remove</th>
    </tr>
  </thead>
  <tbody id="load_cart">
   <!--  <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr> -->
  </tbody>
</table>

 
  </div> 
</div> <!--end container -->

<script type="text/javascript">
    (function(){
 
  $("#ex3").on("click", function() {
    $(".shopping-cart").fadeToggle( "fast");
  });
  
})();


</script>
<style>
    .shopping-cart {
  margin: 20px 0;
  float: right;
  background: white;
  width: 320px;
  position: relative;
  border-radius: 3px;
  padding: 20px;
  
  
  
  }
  
  .shopping-cart {
    margin: 20px 0;
    float: right;
    background: white;
    width: 320px;
    position: absolute;
    border-radius: 3px;
    padding: 20px;
    right: 100px;
    z-index: 999;

}
  .shopping-cart-items {
    
    padding-top: 20px;

    
    
    
  }
   


.shopping-cart:after {
    bottom: 100%;
    left: 89%;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
    border-bottom-color: white;
    border-width: 8px;
    margin-left: -8px;
}







</style>





<!-- end cart mini cart -->





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
                                        <td style="text-align: left;">Resume</td>
                                        <td style="text-align: left;">Cover Letter</td>

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
                        <h6><b>Assign Exam Paper </b></h6>

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
                $('.p1').attr('data-count',data['count']);
                for (var i = 0; i < data['applications'].length; i++) {
                    var application_no = data['applications'][i]['application_no'];
                    var jobseeker_first_name = data['applications'][i]['jobseeker_first_name'];
                    var jobseeker_last_name = data['applications'][i]['jobseeker_last_name'];
                    var applied_resume = data['applications'][i]['applied_resume'];
                    var job_post_employer_id = data['applications'][i]['jobseeker_user_id'];
                    var job_post_title=data['applications'][i]['job_post_title'];
                    var jobseeker_user_id=data['applications'][i]['jobseeker_user_id'];
                    var skills=data['applications'][i]['skills'];



                    carthtml +='<tr><td>'+jobseeker_first_name+' '+jobseeker_last_name+'</td><td>'+job_post_title+'</td><td><span class="status active application-count applied "><a  onclick="myFunction('+jobseeker_user_id+')">Send </a></span></td><td>X<td></tr>';












                    html += '<tr class="emply-resume-list_1" data-apl_id="' + application_no + '" role="row">';
                    html += '<td style="display: none;">' + job_post_employer_id + '</td>';
                   
                    html += '<td><br><div class="level-1-layer">';
                    html += '   <div class="item-checkbox">';
                    html += '<input type="checkbox" name="access_func[]" class="filter-input route-parent rou-1" value="1" id="par-' + job_post_employer_id + '">';
                    html += '<label class="filter-label" for="par-' + job_post_employer_id + '">';
                    html += '</label>';
                    html += '</div>';
                    html += '</div></td>';

                    html += '<td>' + jobseeker_first_name + ' ' + jobseeker_last_name + '</td>';
                       // html += '<td>' + skills + '</td>';
                    html += '<td>';
                    html += '<a href=' + '<?php echo base_url() ?>employer/resume/view?r_id=' + applied_resume + ' target="_blank" title=""><span class="la la-id-card-alt"></span>View CV</a>';
                    html += '</td>';
                    html += '<td><span class="open-letter2" onclick="ViewCoverLatter(' + application_no + ')"><a title=""><span class="la la-paperclip"></span>Cover Letter</a></span></td>';

                    html += '</tr>';
                }


                $('#jobs_emp_table_body').html(html);

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

        if(fromCal!="" && toCal!=""){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to send exam to this candidate?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, sure!'
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
                    'Please Check from & to days',
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
                    html += '<td>' + (i + 1) + '</td>';
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
            $('#cartcount').attr('data-count',cartcount);

            console.log(cartcount);

            var tr = $(this);
            var emp_id = tr.find('td:nth-child(1)').text();
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
                        id_ViewJob: id_ViewJob
                    },
                    dataType: 'json',
                    url: base_url + 'employer/job_posts/ats_exam_setup_candidate',
                    cache: true,
                    beforeSend: function() {
                        HoldOn.open(loader_options);
                    },
                    success: function(data) {
                        HoldOn.close();


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
