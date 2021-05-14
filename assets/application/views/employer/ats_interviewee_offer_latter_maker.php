<style type="text/css">


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
</style>

<section>
    <div class="block no-padding">
        <div class="container-fluid">
            <div class="row no-gape">

                <!--include side bar for employer-->
                <?php $this->load->view('include/side_bar_left_ats') ?>


                <div class="col-lg-6 column job-sec">
                    <div class="padding-left">
                        <a href="<?php echo base_url()?>employer/job_posts/ats_interviewee_offer_latter"><label><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                                                                             width="24" height="24"
                                                                                                             viewBox="0 0 172 172"
                                                                                                             style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none"  style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g><path d="M2.65391,86c0,-46.02344 37.32266,-83.34609 83.34609,-83.34609c46.02344,0 83.34609,37.32266 83.34609,83.34609c0,46.02344 -37.32266,83.34609 -83.34609,83.34609c-46.02344,0 -83.34609,-37.32266 -83.34609,-83.34609z" fill="#018e53"></path><path d="M77.73594,86.90703c10.31328,-10.31328 20.62656,-20.62656 30.93984,-30.93984c9.00312,-9.00313 -5.00547,-22.91094 -14.04219,-13.87422c-12.63125,12.63125 -25.2625,25.2625 -37.89375,37.89375c-3.82969,3.82969 -3.69531,10.17891 0.06719,13.94141c12.63125,12.63125 25.2625,25.2625 37.89375,37.89375c9.00313,9.00313 22.91094,-5.00547 13.87422,-14.04219c-10.27969,-10.31328 -20.55938,-20.59297 -30.83906,-30.87266z" fill="#ffffff"></path></g></g></svg></label> </a>
                    </div>

                    <div class="padding-left">
                        <div class="manage-jobs-sec">
                            <div class="col-md-12 row" style="margin: 2px;">
                                <h3>Setup Offer Letter</h3>
                            </div>
                            <div class="col-md-12 row" >
                                <input type="text" style="margin-left: 20px;" placeholder="title" id="title" class="form-control">
                                <input type="hidden" id="id_exam" value="<?php echo $this->input->get('id'); ?>"  id="title" class="form-control">
                            </div>
                            <div class="col-md-12 ml-auto" style="padding-right: 30px;">
                                <button type="button" class="btn-info btn-md" data-toggle="modal" data-target="#myModal" onclick="clear_id('1')">   <span class="fa fa-plus" ></span>&nbsp;Add Field</button>
                            </div>
                            <br>
                        </div>

                        <div class="col-md-12 row">
                            <div class="col-md-4">
                                <input id="date" type="date" class="form-control" </input>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12 row">
                            <div class="col-md-6">
                                <input id="subject" class="form-control" placeholder="Subject Line"></input>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12 row">
                            <div class="col-md-6">
                                <input id="salutation" class="form-control" placeholder="salutation ('ex: Mr.Name')"></input>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12 row">
                            <div class="col-md-10">
                            <textarea id="header" placeholder="Opening Paragraph"></textarea>
                            </div>
                        </div>
                        <div class="manage-jobs-sec" id="question_answer"></div>
                        <div class="col-md-12 row">
                            <div class="col-md-10">
                                <textarea id="footer" placeholder="Closing Paragraph"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12 row">
                            <div class="col-md-6">
                                <input id="signature"  class="form-control" placeholder="Person Name" />
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-2">
                                &nbsp;
                            </div>
                            <div class="col-md-6">
                                <input id="position"  class="form-control"  placeholder="Position Name"></input>
                            </div>
                            <div class="col-md-4"></div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4 column job-sec">

                    <div class="">
                        <div class="manage-jobs-sec">
                            <h3>Status</h3>
                        </div>

                        <div class="col-md-12 row card-right">
                            <!--                            <div class="col-md-4">-->
<!--                            <a onclick="exam_view()" class="btn-success btn-sm">Preview</a>-->
                            <!--                            </div>-->
                            <!--                            <div class="col-md-4">-->
                            &nbsp;
                            <button class="btn-primary btn-sm" id="update">Update</button>
                            <!--                            </div>-->
                            <!--                            <div class="col-md-4">-->
                            &nbsp;
                            <!--                            </div>-->
                            <button class="btn-primary btn-sm"  onclick="open_pdf()"  id="pdf_view"><span class="fa fa-file-pdf"></span>Save & View PDF</button>
                            <div class="toggle-group">
                                <input type="checkbox" name="on-off-switch" onchange="" id="isStatusExam" tabindex="1" checked="">
                                <label for="isStatusExam"></label>
                                <div class="onoffswitch" aria-hidden="true">
                                    <div class="onoffswitch-label">
                                        <div class="onoffswitch-inner">

                                        </div>
                                        <div class="onoffswitch-switch"></div>
                                    </div>
                                </div>
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
                            <option >Select</option>
<!--                            <option value="5">Header</option>-->
                            <option value="3">Field</option>
<!--                            <option value="6">Footer</option>-->
<!--                            <option value="7">Signature</option>-->
                        </select>
                    </div>
                </div>
                <br>
                <div  class="col-md-12" id="Field_area">
                    <div class="col-md-12 row">
                        <div class="col-md-12">
                        <input type="text" placeholder="Field Name" id="Question" class="form-control"/>
                        </div>
                        <div class="col-md-12">
                            <input type="text" placeholder="value" id="value" class="form-control" autocomplete="off"/>
                        </div>
                    </div>
                </div>
                <br>
                <div  class="col-md-12" id="header_area">
                    <div class="col-md-12 row">
                        <div class="col-md-12">
                            <textarea placeholder="header description" id="header">

                            </textarea>
                        </div>
                    </div>
                </div>
                <br>
                <div  class="col-md-12" id="Footer_area">
                    <div class="col-md-12 row">
                        <div class="col-md-12">
                            <textarea placeholder="footer description" id="footer">

                            </textarea>
                        </div>
                    </div>
                </div>
                <div  class="col-md-12" id="Person_area">
                    <div class="col-md-12 row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <input type="text" placeholder="Person Name" id="Person" class="form-control"/>
                            </div>
                            <div class="col-md-12">
                                <input type="text" placeholder="job title" id="Person_title" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>



                <div id="Answer" style="display: none;" class="col-md-12">

                    <div class="col-md-12 row">
                        <div class="col-md-12">
                            <input type="text" id="answer_001" placeholder="Answer 01" class="form-control col-md-12"/>
                        </div>
                        <div class="col-md-2" style="display: none;">
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
                        <div class="col-md-12">
                            <input type="text" id="answer_002" placeholder="Answer 02" class="form-control"/>
                        </div>
                        <div class="col-md-2" style="display: none;">
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
                        <div class="col-md-12">
                            <input type="text" id="answer_003" placeholder="Answer 03" class="form-control"/>
                        </div>
                        <div class="col-md-2" style="display: none;">
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
                        <div class="col-md-12">
                            <input type="text" id="answer_004" placeholder="Answer 04" class="form-control"/>
                        </div>
                        <div class="col-md-2" style="display: none;">
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



<script src="<?php echo base_url()?>assets/plugins/datatables/datatables.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('.datatable-init').DataTable({
            "order": []
        });

        Load_queqtion();


    });

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

        var date=$('#date').val();
        var subject=$('#subject').val();
        var salutation=$('#salutation').val();
        var header=$('#header').val();
        var footer=$('#footer').val();
        var signature=$('#signature').val();
        var position=$('#position').val();
        //Saved Master Data exam
        $.ajax({
            type: "GET",
            data:{title: title,status:status,isSave:isSave,
                date:date,
                subject:subject,
                salutation:salutation,
                header:header,
                footer:footer,
                signature:signature,
                position:position

            },
            dataType: 'json',
            url: base_url+'employer/job_posts/ats_offer_latter_save',
            cache: true,
            beforeSend: function(){
                HoldOn.open(loader_options);
            },
            success: function (data) {
                HoldOn.close();

                $('#id_exam').val(data.id);
                Load_queqtion();
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
    //
    $('#next').on('click',function () {
        $('#id_exam').val("");
    });
    //
    $('#question_type').on('change',function (){

        var question_type=$('#question_type').val();

        $('#answer_001').val("");
        $('#answer_002').val("");
        $('#answer_003').val("");
        $('#answer_004').val("");


        if((question_type==3) || (question_type==4)){

            $('#header_area').hide();
            $('#Field_area').show();
            $('#Footer_area').hide();
            $('#Person_area').hide();
            $('#Answer').hide();
        }else if(question_type==5){
            $('#Answer').hide();

            $('#header_area').show();
            $('#Field_area').hide();
            $('#Footer_area').hide();
            $('#Person_area').hide();
        }else if(question_type==6){
            $('#Answer').hide();

            $('#header_area').hide();
            $('#Field_area').hide();
            $('#Footer_area').show();
            $('#Person_area').hide();
        }else if(question_type==7){
            $('#Answer').hide();

            $('#header_area').hide();
            $('#Field_area').hide();
            $('#Footer_area').hide();
            $('#Person_area').show();
        }else{
                $('#Answer').hide();

                $('#header_area').hide();
                $('#Field_area').hide();
                $('#Footer_area').hide();
                $('#Person_area').hide();

        }


    });

    $('#Answer').hide();

    $('#header_area').hide();
    $('#Field_area').hide();
    $('#Footer_area').hide();
    $('#Person_area').hide();

    function save_question(){


         var QuestionEmpty=$('#Question').val();
         var markEmpty=$('#mark').val();

         if(QuestionEmpty!='' && markEmpty!=''){

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

            var value=$('#value').val();

            // Saved Master Data exam
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
                    answer_004_check:answer_004_check,
                    value:value


                },
                dataType: 'json',
                url: base_url + 'employer/job_posts/ats_question_save_offer_latter',
                cache: true,
                beforeSend: function () {
                    HoldOn.open(loader_options);
                    //update button same code
                    update_details();
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
    }

    function update_details(){
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

        var date=$('#date').val();
        var subject=$('#subject').val();
        var salutation=$('#salutation').val();
        var header=$('#header').val();
        var footer=$('#footer').val();
        var signature=$('#signature').val();
        var position=$('#position').val();
        //Saved Master Data exam
        $.ajax({
            type: "GET",
            data:{title: title,status:status,isSave:isSave,
                date:date,
                subject:subject,
                salutation:salutation,
                header:header,
                footer:footer,
                signature:signature,
                position:position

            },
            dataType: 'json',
            url: base_url+'employer/job_posts/ats_offer_latter_save',
            cache: true,
            beforeSend: function(){
                HoldOn.open(loader_options);
            },
            success: function (data) {
                HoldOn.close();

                $('#id_exam').val(data.id);
                // Load_queqtion();
                // Swal.fire(
                //      'Updated!',
                //      'Your file has been updated!.',
                //      'success'
                // )

            },
            error: function (jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
            }
        });
    }


    function Load_queqtion(){

        var id=$('#id_exam').val();
        $.ajax({
            type: "GET",
            data: {
                id:id
            },
            dataType: 'json',
            url: base_url + 'employer/job_posts/load_exam_offer_later',
            cache: true,
            beforeSend: function () {
                HoldOn.open(loader_options);
            },
            success: function (data) {
                HoldOn.close();

                var Question='';
                var html2='';
                var Qnumber=0;
                var sub_queqtion_number='*';
                var tabl_html='';
                $('#question_answer').html("");

                for(var i=0;i<data.output.length;i++){

                    // ----------------------------------------------------------------------
                    if(i==0){
                        $('#title').val(data.output[i]['description']);


                    }

                    var status=data.output[i]['status'];
                    if(status==1){
                        $('#isStatusExam').prop('checked', true);

                    }else{
                        $('#isStatusExam').prop('checked', false);

                    }

                    var type=data.output[i]['type'];
                    var typeModal='';
                    if(type==1){

                        typeModal='<div class="level-1-layer">';
                        typeModal+='<div class="item-checkbox">';
                        typeModal+='<input type="checkbox" name="access_func[]" class="filter-input route-parent rou-1" value="1" id="par-'+data.output[i]['id_ats_exam_answer']+'">';
                        typeModal+='<label  class="filter-label" for="par-'+data.output[i]['id_ats_exam_answer']+'">';
                        typeModal+= ''+data.output[i]['answer']+'</label>';
                        typeModal+='</div>';
                        typeModal+='</div>';
                    }else if(type==2){
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
                                html2 += '<div class="card" style="padding-left: 20px; padding-top: 10px; padding-bottom: 10px; margin: 10px 30px;">';
                                // html2+='<div class="col-md-12 row"><div class="col-md-2 offset-10"><button class="btn-warning" style="margin-left: 25px !important;" onclick="delete_question('+data.output[i]['id_ats_exam_question']+')"><i class="la la-trash text-danger fa-2x"> </i></button></div></div>'
                                html2+='<div class="col-md-12 row"><div class="col-md-2 offset-11"><button class="la la-trash text-danger fa-2x" onclick="delete_question('+data.output[i]['id_ats_exam_question']+')" style="background-color:transparent;padding:0 10px;"></button></div></div>';

                            }else{
                                html2+= '</div><div class="card" style="padding-left: 20px;  padding-top: 10px; padding-bottom: 10px; margin: 10px 30px;">';
                                // html2+='<div class="col-md-12 row"><div class="col-md-2 offset-10"><button class="btn-warning" style="margin-left: 25px !important;"  onclick="delete_question('+data.output[i]['id_ats_exam_question']+')"><i class="la la-trash text-danger fa-2x"> </i></button></div></div>'
                                html2+='<div class="col-md-12 row"><div class="col-md-2 offset-11"><button class="la la-trash text-danger fa-2x" onclick="delete_question('+data.output[i]['id_ats_exam_question']+')" style="background-color:transparent;padding:0 10px;"></button></div></div>';

                            }
                            Qnumber = Qnumber + 1;
                            Question = data.output[i]['id_ats_exam_question'];
                            html2 += '<label style="display: none;" id="qNo">'+Question+'</label>';
                            html2 += '<label style="display: none;" id="type">MCQ</label>';
                            html2 += '<div ><h4>' + Qnumber + ').' + data.output[i]['question'] + '</h4><br></div>';

                            if(Question==1) {
                                html2 += '</div>';
                            }

                        }

                        html2 += '<div>' + typeModal+'</div>';



                    }else if(type==3){


                        html2+='</div>';
                        Qnumber = Qnumber + 1;
                        Question = data.output[i]['id_ats_exam_question'];

                        html2 += '<div class="card" style="padding-left: 20px; padding-top: 10px; padding-bottom: 10px; margin: 10px 30px;">';
                        // html2+='<div class="col-md-12 row"><div class="col-md-2 offset-10"><button class="btn-warning" onclick="delete_question('+data.output[i]['q_id']+')"><i class="la la-trash text-danger fa-2x"> </i></button></div></div>'
                        html2+='<div class="col-md-12 row"><div class="col-md-2 offset-11"><button class="la la-trash text-danger fa-2x" onclick="delete_question('+data.output[i]['id_ats_offer_latter_question']+')" style="background-color:transparent;padding:0 10px;"></button></div></div>';

                        html2 += '<label style="display: none;" id="qNo">'+data.output[i]['id_ats_exam_question']+'</label>';
                        html2 += '<label style="display: none;" id="type">SHORT</label>';
                        html2+= '<div class="col-md-12 row"><div class="col-md-3">' + data.output[i]['question']+'</div>';
                        if(data.output[i]['value']!=null) {
                            html2 += '<div class="col-md-9">' + data.output[i]['value'] + '</div></div>';
                        }else{
                            html2 += '<div class="col-md-9"></div></div>';
                        }
                        html2 += '</div>';

                        $('#date').val(data.output[i]['date'].split(' ')[0]);
                        $('#subject').val(data.output[i]['subject']);
                        $('#salutation').val(data.output[i]['salutation']);
                        $('#footer').val(data.output[i]['footer']);
                        $('#header').val(data.output[i]['header']);
                        $('#signature').val(data.output[i]['signature']);
                        $('#position').val(data.output[i]['position']);

                    }else if(type==4){

                        $('#rate_tbl').show();
                        Qnumber = Qnumber + 1;
                        Question = data.output[i]['question'];

                        tabl_html+='<tr style="text-align: center;">';
                        tabl_html+='<td style="border:1px solid black; width: 10%;">';
                        tabl_html+=Question;
                        tabl_html+='</td>';
                        tabl_html+='<td style="border:1px solid black;  width: 20%;">';
                        tabl_html+='<div class="level-1-layer"><div class="item-radio"><input type="radio" id="par-'+Qnumber+'-001" name="acces-'+Qnumber+'" value="1" class=""><label class="filter-label" for="par-'+Qnumber+'-001"></label></div></div>';
                        tabl_html+='</td>';
                        tabl_html+='<td style="border:1px solid black;  width: 20%;">';
                        tabl_html+='<div class="level-1-layer"><div class="item-radio"><input type="radio" id="par-'+Qnumber+'-002" name="acces-'+Qnumber+'" value="1" class=""><label class="filter-label" for="par-'+Qnumber+'-002"></label></div></div>';
                        tabl_html+='</td>';
                        tabl_html+='<td style="border:1px solid black;  width: 20%;">';
                        tabl_html+='<div class="level-1-layer"><div class="item-radio"><input type="radio" id="par-'+Qnumber+'-003" name="acces-'+Qnumber+'" value="1" class=""><label class="filter-label" for="par-'+Qnumber+'-003"></label></div></div>';
                        tabl_html+='</td>';
                        tabl_html+='<td style="border:1px solid black;  width: 20%;">';
                        tabl_html+='<div class="level-1-layer"><div class="item-radio"><input type="radio" id="par-'+Qnumber+'-004" name="acces-'+Qnumber+'" value="1" class=""><label class="filter-label" for="par-'+Qnumber+'-004"></label></div></div>';
                        tabl_html+='</td>';
                        tabl_html+='<td style="border:1px solid black; width: 10%;">';
                        //this is table
                        tabl_html+='<div class="col-md-12 row"><div class="col-md-2 offset-11"><button class="btn-warning" style="background-color: transparent;" onclick="delete_question('+data.output[i]['q_id']+')"><i class="la la-trash text-danger fa-2x"> </i></button></div></div>';
                        tabl_html+='</td>';

                        tabl_html+='</tr>';


                    }


                }
                $('#rate_tbl_body').html(tabl_html);
                $('#question_answer').html(html2);

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
        // window.open('employer/job_posts/ats_setup_exam_view?id="'+id_exam', '_blank');
    }

    function open_pdf(){
        //http://localhost/jobenvoy/jobenvoy/generatepdf?id=69
        var id_exam=$('#id_exam').val();
        if((id_exam!=null) && (id_exam!="")) {
            update_details();

            window.open("<?php echo base_url() ?>generatepdf?id="+id_exam, '_newtab');
        }else{
            Swal.fire(
                    'warning!',
                    'update button Click!.',
                    'warning'
            );
        }
    }

    function exam_next(){
        var id_exam=$('#id_exam').val();
    window.location.replace("<?php echo base_url() ?>employer/job_posts/ats_setup_exam_maker_next?next_job_id=" + id_exam);

    }


    function clear_id(id){

        $('#Question').val("");
        $('#answer_001').val("");
        $('#answer_002').val("");
        $('#answer_003').val("");
        $('#answer_004').val("");
        $('#value').val("");

    }

    function delete_question(id){
        $.ajax({
            type: "GET",
            data: {
                id_q_master:id,
            },
            dataType: 'json',
            url: base_url + 'employer/job_posts/ats_question_offer_latter_delete',
            cache: true,
            beforeSend: function () {
                HoldOn.open(loader_options);
            },
            success: function (data) {
                HoldOn.close();
                Swal.fire(
                        'Successfully deleted interview form',
                        '',
                        'success'
                );
                Load_queqtion();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                HoldOn.close();
                heads_up_error();
            }
        });
    }
</script>

