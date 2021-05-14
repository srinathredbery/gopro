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

                <input type="hidden" id="next_job_id" value="<?php echo $this->input->get('next_job_id');  ?>"/>
                <div class="col-lg-5 column job-sec">
                    <div class="padding-left">
                        <div class="manage-jobs-sec">
                            <h3>Job Posts</h3>
                            <table class="datatable-init">
                                <thead>
                                <tr>
                                    <td style="display: none;">#</td>
                                    <td>#</td>
                                    <td>Title</td>
                                    <td>No of Applicants</td>


                                </tr>
                                </thead>
                                <tbody id="job_body">
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
                                        <tr>
                                            <td style="display: none;"><?php echo $active_post['job_post_id']; ?></td>
                                            <td>
                                                <div class="item-checkbox">
                                                    <input onclick="setJobs(<?php echo $active_post['job_post_id']; ?> ,'<?php echo $active_post['job_post_title']; ?>') " type="checkbox" name="access_func[]" class="filter-input route-parent inputCheck"
v                                                   alue=""
                                                    id="par-<?php echo $active_post['job_post_id']; ?>">
                                                    <label class="filter-label" for="par-<?php echo $active_post['job_post_id']; ?>">

                                                    </label>
                                                </div>

                                            </td>

                                            <td>
                                                <div class="table-list-title">
                                                    <h3 style="font-weight:600; font-size: 14px;"><a href="<?php echo !empty($active_post['job_post_id']) ? base_url().'jobs/view_job_post?jp_token='. base64_encode($active_post['job_post_id']): '' ?>" target="_blank" title=""><?php echo !empty($active_post['job_post_title']) ?  substr($active_post['job_post_title'], 0, 30) :''?></a></h3>
                                                    <span><i class="la la-map-marker"></i> <?php  if (!empty($active_post['job_post_city'])) {
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
                        <div>
                            <button onclick="set_othe_table()" class="btn-primary" style="margin: 0 30px 20px 0;">Assign</button>
                        </div>

                    </div>
                </div>
                <div class="col-lg-5 column job-sec">
                    <div class="padding-left" style="display: none;" id="divTable">
                        <div class="manage-jobs-sec">
                            <h3>Assign Job</h3>
                            <table class="datatable-init" id="assign_table">
                                <thead>
                                <tr>
                                    <td  style="display: none;">#</td>
                                    <td>#</td>
                                    <td>Title</td>
                                    <td>No of Applicants</td>


                                </tr>
                                </thead>
                                <tbody id="assign_job">

                                </tbody>
                            </table>

                        </div>
                        <div class="col-md-12 row justify-content-end">
                            <div class="col-md-5"></div>
                            <div class="col-md-3">
                            <button onclick="deleted_row()" class="btn-danger">remove</button>
                            </div>
                            <div class="col-md-3">
                            <button onclick="save_assign_job_to_papers()" class="btn-success">save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 column">
                    <br>
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
<script src="<?php echo base_url()?>assets/plugins/datatables/datatables.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('.datatable-init').DataTable({
            "order": []
        });
    })

    function setJobs(id,Name){
        $('#job_title').text(Name);
        $('#id_ViewJob').val(id);
        $('#jobs_emp_table_body').html("");
        //var html="";
        //$.ajax({
        //  type: "GET",
        //  data:{id: id},
        //  dataType: 'json',
        //  url: base_url+'employer/job_posts/ats_post_job_load',
        //  cache: true,
        //  beforeSend: function(){
        //      HoldOn.open(loader_options);
        //  },
        //  success: function (data) {
        //      HoldOn.close();
        //
        //
        //      for(var i=0;i<data['applications'].length;i++){
        //          var application_no=data['applications'][i]['application_no'];
        //          var jobseeker_first_name=data['applications'][i]['jobseeker_first_name'];
        //          var jobseeker_last_name=data['applications'][i]['jobseeker_last_name'];
        //          var applied_resume=data['applications'][i]['applied_resume'];
        //
        //          html+='<tr class="emply-resume-list_1" data-apl_id="'+application_no+'" role="row">';
        //          html+='<td>';
        //          html+='<div class="toggle-group">';
        //          html+='<input type="checkbox" name="on-off-switch" onchange="" id="11000" tabindex="1" checked="">';
        //          html+='<label for="11000">';
        //          html+='</label>';
        //          html+='<div class="onoffswitch" aria-hidden="true">';
        //          html+='                     <div class="onoffswitch-label">';
        //          html+='             <div class="onoffswitch-inner"></div>';
        //          html+='             <div class="onoffswitch-switch"></div>';
        //          html+='         </div>';
        //          html+='     </div>';
        //          html+='</div>';
        //          html+='</td>';
        //          html+='<td></td>';
        //          html+='<td>'+jobseeker_first_name+' '+jobseeker_last_name+'</td>';
        //          html+='<td>';
        //          html+='<a href='+'<?php //echo base_url() ?>//employer/resume/view?r_id='+applied_resume+' target="_blank" title=""><span class="la la-id-card"></span>View CV</a>';
        //          html+='</td>';
        //          html+='<td><li class="open-letter2" onclick="ViewCoverLatter('+application_no+')"><a title=""><span class="la la-paperclip"></span>Cover Letter</a></li></td>';
        //          html+='</tr>';
        //      }
        //
        //
        //      $('#jobs_emp_table_body').html(html);
        //
        //
        //  },
        //  error: function (jqXHR, textStatus, errorThrown) {
        //      HoldOn.close();
        //      heads_up_error();
        //  }
        //});


    }

    $('.open-letter2').click(function (e) {
        let c_id = $(this).closest('.emply-resume-list_1').data("apl_id");
        let js_name =$('#job_title').text();
        // $.ajax({
        //  type: "GET",
        //  data:{cl_uid: c_id},
        //  dataType: 'json',
        //  url: base_url+'employer/applications_received/view_candidate/cover_letter',
        //  cache: true,
        //  beforeSend: function(){
        //      HoldOn.open(loader_options);
        //  },
        //  success: function (data) {
        //      HoldOn.close();
        //
        //      $('.cover-letter h3').text(js_name);
        //      $('.cover-letter-content').empty().html(data.cover_letter_content);
        //      $('.coverletter-popup').fadeIn();
        //      $('html').addClass('no-scroll');
        //
        //  },
        //  error: function (jqXHR, textStatus, errorThrown) {
        //      HoldOn.close();
        //      heads_up_error();
        //  }
        // });
    });

    function set_othe_table() {
        $('#divTable').show();
        $('.datatable-init').DataTable().destroy();
        var html='';
        $('#job_body tr').each(function () {
            var tr = $(this);
            var Array = [];
            var id = tr.find('td:nth-child(1)').text();
            var isNew = tr.find('td:nth-child(2)').text();
            var checkBox = tr.find('td:nth-child(2) > inputCheck:checked');
            var inputCheck=$('#par-'+id+'').prop('checked');
            var Job = tr.find('td:nth-child(3)').text();
            var Count = tr.find('td:nth-child(4)').text();

            $('#assign_job').html("");
            if (inputCheck) {

                    //assign_job
                    html += '<tr><td style="display: none;">' + id + '</td>';
                    html += '<td><div class="item-checkbox">';
                    html += '<input type="checkbox"  name="c-' + id + '" class="filter-input route-parent inputCheck2" value="" id="c-' + id + '" >';
                    html += '<label class="filter-label" for="c-' + id + '">';
                    html += '</label>';
                    html += '</div>';
                    html += '</td>';
                    html += '<td>' + Job + '</td>';
                    html += '<td>' + Count + '</td></tr>';


            }





        });
        $('#assign_job').html(html);
        $('.datatable-init').DataTable({
            "order": []
        });
    }

    function ViewCoverLatter(id){
        let c_id = id;
        let js_name =$('#job_title').text();

        // $.ajax({
        //  type: "GET",
        //  data:{cl_uid: c_id},
        //  dataType: 'json',
        //  url: base_url+'employer/applications_received/view_candidate/cover_letter',
        //  cache: true,
        //  beforeSend: function(){
        //      HoldOn.open(loader_options);
        //  },
        //  success: function (data) {
        //      HoldOn.close();
        //
        //      $('.cover-letter h3').text(js_name);
        //      $('.cover-letter-content').empty().html(data.cover_letter_content);
        //      $('.coverletter-popup').fadeIn();
        //      $('html').addClass('no-scroll');
        //
        //  },
        //  error: function (jqXHR, textStatus, errorThrown) {
        //      HoldOn.close();
        //      heads_up_error();
        //  }
        // });
    }

    function save_assign_job_to_papers(){


        $('#assign_job tr').each(function () {
            var tr = $(this);
            var Array = [];
            var id = tr.find('td:nth-child(1)').text();
            var isNew = tr.find('td:nth-child(2)').text();
            var checkBox = tr.find('td:nth-child(2) > inputCheck');
            var inputCheck=$('#c-'+id+'').prop('checked');
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

        setTimeout(function(){
        Swal.fire(
                'Successfully assigned exam to job',
                '',
                'success'
        )
        window.location.replace('http://rbjobs.rbdemo.live/employer/job_posts/ats_setup_exam');

        }, 2000);

    }

    function deleted_row(){
        $('#assign_job tr').each(function () {
            var tr = $(this);
            var Array = [];
            var id = tr.find('td:nth-child(1)').text();
            var isNew = tr.find('td:nth-child(2)').text();
            var checkBox = tr.find('td:nth-child(2) > inputCheck');
            var inputCheck=$('#c-'+id+'').prop('checked');
            var Job = tr.find('td:nth-child(3)').text();
            var Count = tr.find('td:nth-child(4)').text();

            var exam_id=$('#next_job_id').val();
            var html='';
            if (inputCheck) {
                $(this).remove();
            }

        });
    }




</script>
