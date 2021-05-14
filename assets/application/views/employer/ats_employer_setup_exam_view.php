<style type="text/css">

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

    #countdown li {
        display: inline-block;
        font-size: 12px;
        list-style-type: none;
        padding: 1em;
        text-transform: uppercase;
    }

    #countdown li span {
        display: block;
        font-size: 42px;
        font-weight: bold;
        color: red;
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
                        <a href="<?php echo base_url()?>employer/job_posts/ats_setup_exam"><label><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                                                                       width="24" height="24"
                                                                                                       viewBox="0 0 172 172"
                                                                                                       style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g><path d="M2.65391,86c0,-46.02344 37.32266,-83.34609 83.34609,-83.34609c46.02344,0 83.34609,37.32266 83.34609,83.34609c0,46.02344 -37.32266,83.34609 -83.34609,83.34609c-46.02344,0 -83.34609,-37.32266 -83.34609,-83.34609z" fill="#018e53"></path><path d="M77.73594,86.90703c10.31328,-10.31328 20.62656,-20.62656 30.93984,-30.93984c9.00312,-9.00313 -5.00547,-22.91094 -14.04219,-13.87422c-12.63125,12.63125 -25.2625,25.2625 -37.89375,37.89375c-3.82969,3.82969 -3.69531,10.17891 0.06719,13.94141c12.63125,12.63125 25.2625,25.2625 37.89375,37.89375c9.00313,9.00313 22.91094,-5.00547 13.87422,-14.04219c-10.27969,-10.31328 -20.55938,-20.59297 -30.83906,-30.87266z" fill="#ffffff"></path></g></g></svg></label> </a>
                    </div>

                    <div class="padding-left">
                        <div class="manage-jobs-sec">
                            <h3 id="title_h_tag">Exam</h3>
                            <div class="col-md-12 row">
<!--                                <input style="margin-left: 20px; margin-top:20px;" type="text" placeholder="title" id="title" class="form-control disabled" disabled>-->
                                <input type="hidden" id="id_exam" value="<?php echo $this->input->get('id'); ?>"  id="title" class="form-control">

                            </div>

                        </div>
                        <div class="manage-jobs-sec" id="question_answer"></div>

                    </div>
                </div>
                <div class="col-lg-4 column job-sec">
                        <div class="padding-left ">
                        <div class="manage-jobs-sec">
                            <h3>Time</h3>
                        </div>
                        <div class="col-md-12 row d-flex justify-content-center card-right py-0">
                            <div id="countdown">
                                <ul class="text-center">
                                    <li><span id="hrs"></span>Hours</li>
                                    <li><span id="min"></span>Minutes</li>
                                    <li><span id="sec"></span>Seconds</li>
                                </ul>
                            </div>

                        </div>
                        <div class="manage-jobs-sec">
                            <h3>Date</h3>
                        </div>

                        <div class="col-md-12 row card-right">
                            <div class="col-md-4">
                                From
                            </div>
                            <div class="col-md-8">
                                <input type="date"  class="form-control" id="from" disabled>
                            </div>
                        </div>
                        <div class="col-md-12 row card-right top-padding">
                            <div class="col-md-4">
                                To
                            </div>
                            <div class="col-md-8 mt-2">
                                <input type="date"  class="form-control" id="to" disabled>
                            </div>
                        </div>
                        <div class="manage-jobs-sec">
                            <h3>Level</h3>
                        </div>
                        <div class="col-md-12 row" style="margin-left: 20px; padding: 20px 20px 0 20px;">
                            <div class="item-checkbox">
                                <input type="checkbox" name="access_func[]" class="filter-input route-parent" value="" id="defaultUnchecked" disabled>
                                <label class="filter-label" for="defaultUnchecked">
                                    Basic
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 row" style="margin-left: 20px; padding: 0px 20px 0 20px;" >
                            <div class="item-checkbox">
                                <input type="checkbox" name="access_func[]" class="filter-input route-parent" value="" id="defaultUnchecked2" disabled>
                                <label class="filter-label" for="defaultUnchecked2">
                                    Intermediate
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 row" style="margin-left: 20px; padding: 0px 20px 20px 20px;">
                            <div class="item-checkbox">
                                <input type="checkbox" name="access_func[]" class="filter-input route-parent" value="" id="defaultUnchecked3" disabled>
                                <label class="filter-label" for="defaultUnchecked3" disabled>
                                    Advanced
                                </label>
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
                    <hr>
                    <div class="col-md-12">
                    <input type="text" id="answer_001" placeholder="Answer 01" class="form-control"/>
                    <input type="text" id="answer_002" placeholder="Answer 02" class="form-control"/>
                    <input type="text" id="answer_003" placeholder="Answer 03" class="form-control"/>
                    <input type="text" id="answer_004" placeholder="Answer 04" class="form-control"/>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal" onclick="save_question()">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
        var Hrs=$('#Hrs').val();
        var Min=$('#Min').val();
        var from=$('#from').val();
        var to=$('#to').val();
        var level='';
        var isCheck=$(".check1 :input").prop( "checked" );
        if(isCheck){
            level='Basic'
        }
        var isCheck=$(".check2 :input").prop( "checked" );
        if(isCheck){
            level='Intermediate'
        }
        var isCheck=$(".check3 :input").prop( "checked" );
        if(isCheck){
            level='Advanced'
        }

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
            data:{title: title,Hrs:Hrs,Min:Min,from:from,to:to,level:level,status:status,isSave:isSave},
            dataType: 'json',
            url: base_url+'employer/job_posts/ats_exam_save',
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
                    answer_004:answer_004

                },
                dataType: 'json',
                url: base_url + 'employer/job_posts/ats_question_save',
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
            alert("Please Create New Question");
        }
        }



        function Load_queqtion(){
            var id=$('#id_exam').val();

            $.ajax({
                type: "GET",
                data: {
                    id:id
                },
                dataType: 'json',
                url: base_url + 'employer/job_posts/load_exam',
                cache: true,
                beforeSend: function () {
                    HoldOn.open(loader_options);
                },
                success: function (data) {
                    HoldOn.close();

                    var Question='';
                    var html='';
                    var Qnumber=0;
                    var sub_queqtion_number='*';
                    $('#question_answer').html("");
                    for(var i=0;i<data.output.length;i++){

                        if(i==0){
                            // $('#title').val(data.output[i]['Title']);
                            $('#title_h_tag').text(data.output[i]['Title']);
                            $('#Hrs').val(data.output[i]['Hrs']);
                            $('#Min').val(data.output[i]['Min']);
                            $('#from').val(data.output[i]['From']);
                            $('#to').val(data.output[i]['To']);
                            var Level=data.output[i]['Level'];

                            $('#hrs').text(data.output[i]['Hrs']);
                            $('#min').text(data.output[i]['Min']);
                            // defaultUnchecked //Intermediate//Basic//Advanced
                            if(Level=="Basic"){
                                $('#defaultUnchecked').prop('checked', true);
                            }else if(Level=="Intermediate"){
                                $('#defaultUnchecked2').prop('checked', true);
                            }else if(Level=="Advanced"){
                                $('#defaultUnchecked3').prop('checked', true);
                            }

                            var status=data.output[i]['exam_status'];
                            if(status==1){
                                $('#isStatusExam').prop('checked', true);
                            }else{
                                $('#isStatusExam').prop('checked', false);
                            }

                        }
                        var type=data.output[i]['type'];
                        var typeModal='';
                        if(type==1){

                            typeModal='<div class="level-1-layer">';
                            typeModal+='<div class="item-checkbox">';
                            typeModal+='<input type="checkbox" name="access_func[]" class="filter-input route-parent rou-1" value="1" id="par-'+i+'">';
                            typeModal+='<label class="filter-label" for="par-'+i+'">';
                            typeModal+= ''+data.output[i]['answer']+'</label>';
                            typeModal+='</div>';
                            typeModal+='</div>';
                        }else if(type==2){


                            typeModal='<div class="level-1-layer">';
                            typeModal+='<div class="item-radio">';
                            typeModal+='<input type="radio" name="access_func[]" class="filter-input route-parent rou-1" value="1" id="par-1">';
                            typeModal+='<label class="filter-label" for="par-1">';
                            typeModal+= ''+data.output[i]['answer']+'</label>';
                            typeModal+='</div>';
                            typeModal+='</div>';
                        }

                        if(type!=3) {

                            console.log(Question);
                                console.log('y'+data.output[i]['id_ats_exam_question']);

                            if (Question != data.output[i]['id_ats_exam_question']) {

                                Qnumber = Qnumber + 1;
                                Question = data.output[i]['id_ats_exam_question'];
                                html += '</div><div class="card" style="padding-left: 20px; padding-top: 10px; padding-bottom: 10px; margin: 10px 30px;">';
                                html += '<div ><h4>' + Qnumber + ').' + data.output[i]['question'] +'</h4><br></div>';
                                html += '<div>'+ typeModal +'</div>';

                            } else {
                                html += '<div>' + typeModal+'</div>';
                               //html += '</div>';

                            }

                            if (Question != data.output[i]['id_ats_exam_question']) {

                                html += '</div>';

                            }
                        }
                        else if(type==3){
                            Qnumber = Qnumber + 1;
                            Question = data.output[i]['id_ats_exam_question'];
                            html += '<div class="card" style="padding-left: 20px; padding-top: 10px; padding-bottom: 10px; margin: 10px 30px;">';
                            html += '<div ><h4>' + Qnumber + ').' + data.output[i]['question']+'</h4><br></div>';
                            html += '<div class="col-md-12"><textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea></div>';
                            html += '</div>';
                        }



                    }
                    // html += '<div class="text-right"><span class="la la-fa">Edit</span></div>';
                    $('#question_answer').append(html);

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    HoldOn.close();
                    heads_up_error();
                }
            });
        }

</script>

