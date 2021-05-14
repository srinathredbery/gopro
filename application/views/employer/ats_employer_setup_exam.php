<style>
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
        border-color: #1eaae7 !important;
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
                        <a href="<?php echo base_url() ?>employer/job_posts/ats_setup_exam_maker" class="btn btn-orange btn-md"><span class="la la-plus"></span>&nbsp;Create New</a>
                    </div>
                    <div class="padding-left">
                        <div class="manage-jobs-sec">
                            <h3>Exam Papers</h3>
                            <table class="datatable-init">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Exam ID</td>
                                        <td>Description</td>
                                        <td>Level</td>
                                        <td>Status</td>
                                        <td>Create Date</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody id="jobs_emp_table_body">

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
                <h4>Job Category</h4>
                <input type="hidden" id="Exam_id" />
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="ctg_list">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-success btn-sm" onclick="setEditCick('<?php echo base_url() ?>');">Edit Category</button>
                <button type="button" class="btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--------------------------------------------------------------------------->
</div>


<script src="<?php echo base_url() ?>assets/plugins/datatables/datatables.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setExamSummary();
    });

    function setEditCick(base_url) {
        var Exam_id = $('#Exam_id').val();
        window.location.replace(base_url + "employer/job_posts/ats_setup_exam_maker_next?next_job_id=" + Exam_id);
    }

    function setExamSummary() {
        $('.datatable-init').DataTable().destroy();

        var html = "";
        $.ajax({
            type: "GET",
            data: {},
            dataType: 'json',
            url: base_url + 'employer/job_posts/ats_exam_summary',
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
                    html += '<td>' + (i + 1) + '</td>';
                    html += '<td>' + id + '</td>';
                    html += '<td>' + application_no + '</td>';
                    html += '<td>' + Level + '</td>';
                    if (status == 1) {
                        html += '<td><lable class="text-success">Active</lable></td>';
                    } else {
                        html += '<td><lable class="text-danger">Inactive</lable></td>';
                    }
                    html += '<td>' + create_date.split(' ')[0] + '</td>';
                    html += '<td><a href="<?php echo base_url() ?>employer/job_posts/ats_setup_exam_maker?id=' + id + '" class="la la-pencil text-info fa-2x"></a><a>&nbsp;</a><a class="la la-trash text-danger fa-2x" onclick="deleteExam(' + id + ')"></a><a>&nbsp;</a><a class="la la-book text-success fa-2x" data-toggle="modal" data-target="#myModal" onclick="viewExamCtg(' + id + ')"></a></td>';
                    html += '</tr>';
                }

                $('#jobs_emp_table_body').html(html);
                $('.datatable-init').DataTable({
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

    function deleteExam(id) {
        var id = id;
        var html = "";


Swal.fire({
  title: 'Are you sure you want to delete this paper?',
  showDenyButton: true,
  showCancelButton: true,
  confirmButtonText: `Delete`,
  denyButtonText: `Don't Delete`,
}).then((result) => {

  //  alert(result);
   // alert(result.isConfirmed);
   // console.log(result.value);

  /* Read more about isConfirmed, isDenied below */
  if (result.value) {
    

      $.ajax({
            type: "GET",
            data: {
                id: id
            },
            dataType: 'json',
            url: base_url + 'employer/job_posts/ats_exam_delete',
            cache: true,
            beforeSend: function() {
                HoldOn.open(loader_options);
            },
            success: function(data) {
                HoldOn.close();

                //alert("Delete it... ");
                 Swal.fire('Success!', '', 'success')
                setExamSummary();

            },
            error: function(jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
            }
        });


 






   
  } else if (result.isDenied) {
    Swal.fire('Exam Not Deleted', '', 'info')
  }
})


/*

 

*/








    }

    function viewExamCtg(id) {
        var id = id;

        $('#Exam_id').val(id);
        var html = "";
        $.ajax({
            type: "GET",
            data: {
                id: id
            },
            dataType: 'json',
            url: base_url + 'employer/job_posts/ats_exam_ctg',
            cache: true,
            beforeSend: function() {
                HoldOn.open(loader_options);
            },
            success: function(data) {
                HoldOn.close();

                var html = "";
                for (var i = 0; i < data['applications'].length; i++) {
                    var application_no = data['applications'][i]['job_post_title'];
                    var i2 = i + 1;
                    html += "<div class='row'>" + i2 + ').' + application_no + "</div>";

                }
                $('#ctg_list').html(html);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
            }
        });
    }
</script>
