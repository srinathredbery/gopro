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
        color: #fff !important;
        background-color: #2dc565;
        border-radius: 30px;
        padding: 4px 6px;
    }

    table.jobpost-table tbody tr {
        height: 60px;
    }

    table.jobpost-table tbody tr:hover {
        background-color: #f7661833;
        cursor: pointer;
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
        .col-lg-7.job-sec {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 55%;
            flex: 0 0 55%;
            max-width: 55%;
        }
        .col-lg-5.job-sec, .col-lg-7.job-sec {
            margin: 20px 10px;
            box-shadow: 0 4px 8px 0 rgb(0 0 0 / 5%), 0 6px 20px 0 rgb(0 0 0 / 7%);
        }
    }
    .fa-1x {
        font-size: 1em !important;
    }
    .fa-1x:hover {
        cursor: pointer !important;
    }
</style>
<section>
    <div class="block no-padding">
        <div class="container-fluid">
            <div class="row no-gape">

                <!--include side bar for employer-->
<!--                --><?php //$this->load->view('include/side_bar_left_ats') ?>

                <div class="col-lg-5 column job-sec">
                    <div class="padding-left">
                        <div class="manage-jobs-sec">
                            <h3>Job Posts</h3>
                            <input type="hidden" value="<?php echo $_SESSION['user_id']; ?>" id="user_id"/>
                            <table id="table1" class="datatable-init jobpost-table">
                                <thead>
                                <tr>
                                    <td>Title</td>

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
                <div class="col-lg-7 column job-sec">
                    <div class="padding-right">
                        <div class="manage-jobs-sec" style="display: none;" id="divTable">
                            <h3 id="job_title">Exam</h3>
                            <table id="table2" class="datatable-init">
                                <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Description</td>
<!--                                    <td>Level</td>-->
<!--                                    <td>Status</td>-->
                                    <td>Exam Date</td>
                                    <td>Action</td>


                                </tr>
                                </thead>
                                <tbody id="jobs_emp_table_body" >

                                </tbody>
                            </table>


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

<!-----------------------------ctg modal--------------------------->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Send Exam</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="ctg_list">

                <div class="col-md-12 row">
                    From
                <input type="date" class="form-control" id="from" >
                </div>
                <div class="col-md-12 row">
                    To
                    <input type="date" class="form-control" id="to" >
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-success btn-sm" onclick="save_assing_exam_emp()" data-dismiss="modal"><span class="la la-send"></span>Send</button>
                <button type="button" class="btn-default btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--------------------------------------------------------------------------->
<script src="<?php echo base_url()?>assets/plugins/datatables/datatables.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('.datatable-init').DataTable({
            "order": [],
            language: {
                searchPlaceholder: "Search Title"
            }
        });

    })

    function setJobs(id,Name){


        $('#divTable').show();
        $('#job_title').text(Name);
        $('#id_ViewJob').val(id);
        $('#jobs_emp_table_body').html("");
        $('.datatable-init').DataTable().destroy();

        var html="";
        $.ajax({
            type: "GET",
            data:{
                job_id:id
            },
            dataType: 'json',
            url: base_url+'job_seeker/job_posts_view/ats_exam_summary',
            cache: true,
            beforeSend: function(){
                HoldOn.open(loader_options);
            },
            success: function (data) {
                HoldOn.close();

;

                for(var i=0;i<data['applications'].length;i++){
                    var application_no=data['applications'][i]['Title'];
                    // var Level=data['applications'][i]['Level'];
                    // var status=data['applications'][i]['status'];
                    var create_date=data['applications'][i]['from'];

                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = today.getFullYear();
                    today = yyyy + '-' + mm + '-' + dd;



                    var id=data['applications'][i]['id_ats_exam_master'];



                    html+='<tr class="emply-resume-list_1" data-apl_id="'+application_no+'" role="row">';
                    html+='<td>'+ (i+1) +'</td>';
                    html+='<td>'+application_no+'</td>';
                    // html+='<td>'+Level+'</td>';
                    // if(status==1) {
                    //  html += '<td><lable>Active</lable></td>';
                    // }else{
                    //  html += '<td><lable>Inactive</lable></td>';
                    // }
                    html+='<td>'+create_date.split(' ')[0]+'</td>';
                    //base_url() ?>job_seeker/job_posts/ats_setup_exam_maker?id='+id+'"
                    if(create_date==today) {
                        html += '<td><span href="" class="la la-edit text-info fa-1x" onclick="comifrm_msg(' + id + ')">Enrol Exam</span></td>';
                    }else{
                        html += '<td><span href="" class="la la-edit text-danger fa-1x" onclick="comifrm_msg_error(' + id + ')">Expired Exam</span></td>';
                    }
                    html+='</tr>';
                }


                $('#jobs_emp_table_body').html(html);
                //table1
                $('#table1').DataTable({
                    "order": [],
                    language: {
                        searchPlaceholder: "Title "
                    }
                });
                //table2
                $('#table2').DataTable({
                    "order": [],
                    language: {
                        searchPlaceholder: "ID, Description, Exam Date, Action "
                    }
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

    $('#sendExam').on('click',function () {
        save_assign_exam_papers();
    });
    function save_assign_exam_papers(){
        $('#jobs_emp_table_body tr').each(function () {
            var tr = $(this);
            var Array = [];
            var id = tr.find('td:nth-child(1)').text();
            var isNew = tr.find('td:nth-child(2)').text();
            var checkBox = tr.find('td:nth-child(2) > inputCheck');
            var inputCheck=$('.inputCheck2').prop('checked');
            var Job = tr.find('td:nth-child(3)').text();
            var Count = tr.find('td:nth-child(4)').text();

            var exam_id=$('#next_job_id').val();
            var html='';
            if (inputCheck) {
                //assign_job

                $.ajax({
                    type: "GET",
                    data:{jobid: id,exam_id:exam_id},
                    dataType: 'json',
                    url: base_url+'employer/job_posts/ats_exam_assing_job',
                    cache: true,
                    beforeSend: function(){
                        HoldOn.open(loader_options);
                    },
                    success: function (data) {
                        HoldOn.close();
                        $('#id_exam').val(data.id);

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        HoldOn.close();
                        heads_up_error();
                    }
                });
            }

        });
    }

    function save_assing_exam_emp(){


        $('#jobs_emp_table_body tr').each(function () {
            var tr = $(this);
            var Array = [];
            var emp_id = tr.find('td:nth-child(1)').text();
            var job_id = $('#id_ViewJob').val();
            var checkBox = tr.find('td:nth-child(2) > inputCheck');
            var inputCheck=$('.inputCheck2').prop('checked');
            var Job = tr.find('td:nth-child(3)').text();
            var Count = tr.find('td:nth-child(4)').text();
            var from=$('#from').val();
            var to=$('#to').val();
            var status=1;


            var exam_id=$('#next_job_id').val();


            var html='';
            // if (inputCheck) {
            //  //assign_job
            //
                $.ajax({
                    type: "GET",
                    data:{emp_id: emp_id,job_id:job_id,from:from,to:to,status:status},
                    dataType: 'json',
                    url: base_url+'employer/job_posts/ats_exam_assing_emp',
                    cache: true,
                    beforeSend: function(){
                        HoldOn.open(loader_options);
                    },
                    success: function (data) {
                        HoldOn.close();
                        $('#id_ViewJob').val(emp_id);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        HoldOn.close();
                        heads_up_error();
                    }
                });
            // }

        });


    }

    function comifrm_msg_error(id){
        var user_id=$('#user_id').val();
        var exam_id=id;
        swal.fire(
                'Oops!',
                'You can not enroll for this exam until the exam date',
                'warning'
        )
    }
    function comifrm_msg(id){

        var user_id=$('#user_id').val();
        var exam_id=id;

        var isDo_count='';
        $.ajax({
            type: "GET",
            data:{emp_id: user_id,exam_id:exam_id},
            dataType: 'json',
            url: base_url+'job_seeker/job_posts_view/ats_exam_do',
            cache: true,
            beforeSend: function(){
                HoldOn.open(loader_options);
            },
            success: function (data) {
                HoldOn.close();
                isDo_count=data.id;

                if(isDo_count==0) {
                    Swal.fire({
                        title: 'Are you sure you want to start the paper? ',
                        text: "Your time will start running now!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, confirm it!'
                    }).then((result) => {
                        if (result.value) {
                            window.location.replace('../job_posts/ats_setup_exam_maker?id=' + id + '');
                        }
                    })
                }else{
                    swal.fire(
                            'Already exists!',
                            'Your exam has already exists.',
                            'warning'
                    )
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {

                HoldOn.close();
                alert(errorThrown);
                // heads_up_error();
            }
        });


    }

    // function getNotyfy(id){
    //
    //  var html='htmjshaidiuadha8u';
    //  var location=$('#location_'+id).text();
    //  var room=$('#room_'+id).text();
    //  var date=$('#date_'+id).text();
    //  var job=$('#job_'+id).text();
    //  swal.fire({
    //      title: 'Are you sure?',
    //      html: '<b>'+job+'</b><br>You have done great in your ATS Exam! You are invited for an interview. Please find the interview details below and select conform if you will be attending the interview, ' +
    //              '<br>'+location+
    //              '<br>'+room+
    //              '<br>'+date,
    //      icon: 'warning',
    //      showCancelButton: true,
    //      confirmButtonColor: '#3085d6',
    //      cancelButtonColor: '#d33',
    //      confirmButtonText: 'Yes, confirm it!'
    //  }).then((result) => {
    //      if (result.value) {
    //          //
    //          $.ajax({
    //              type: 'GET',
    //              dataType: 'JSON',
    //              url: base_url + 'job_seeker/job_posts_view/ats_interview_confirm',
    //              data: {id: id},
    //              cache: false,
    //              beforeSend: function () {
    //                  HoldOn.open(loader_options);
    //              },
    //              success: function (data) {
    //                  HoldOn.close();
    //
    //              },
    //              error: function (jqXHR, textStatus, errorThrown) {
    //                  HoldOn.close();
    //                  // heads_up_error();
    //              }
    //          });
    //
    //          swal.fire(
    //                  'confirm!',
    //                  'Your interview has been confirm.',
    //                  'success'
    //          )
    //
    //      }
    //  })
    // }

</script>
