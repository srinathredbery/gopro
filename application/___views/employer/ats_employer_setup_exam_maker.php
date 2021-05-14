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
                        <a href="<?php echo base_url()?>employer/job_posts/ats_setup_exam">
                            <label>
<!--                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"-->
<!--                                                                                                       width="24" height="24"-->
<!--                                                                                                       viewBox="0 0 172 172"-->
<!--                                                                                                       style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none"  style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g><path d="M2.65391,86c0,-46.02344 37.32266,-83.34609 83.34609,-83.34609c46.02344,0 83.34609,37.32266 83.34609,83.34609c0,46.02344 -37.32266,83.34609 -83.34609,83.34609c-46.02344,0 -83.34609,-37.32266 -83.34609,-83.34609z" fill="#018e53"></path><path d="M77.73594,86.90703c10.31328,-10.31328 20.62656,-20.62656 30.93984,-30.93984c9.00312,-9.00313 -5.00547,-22.91094 -14.04219,-13.87422c-12.63125,12.63125 -25.2625,25.2625 -37.89375,37.89375c-3.82969,3.82969 -3.69531,10.17891 0.06719,13.94141c12.63125,12.63125 25.2625,25.2625 37.89375,37.89375c9.00313,9.00313 22.91094,-5.00547 13.87422,-14.04219c-10.27969,-10.31328 -20.55938,-20.59297 -30.83906,-30.87266z" fill="#ffffff"></path></g></g></svg>-->
                                <button class="btn btn-back ml-3 mt-3"><i class="fas fa-arrow-left mr-2"></i>Back</button>
                            </label>
                        </a>
                    </div>

                    <div class="padding-left">
                        <div class="manage-jobs-sec">
                            <div class="col-md-12 row" style="margin: 2px;">
                            <h3>Set up Exam</h3>
                            </div>
                            <div class="col-md-12 row" >
                                <input type="text" style="margin-left: 20px;" placeholder="title" id="title" class="form-control">
                                <input type="hidden" id="id_exam" value="<?php echo $this->input->get('id'); ?>"  id="title" class="form-control">
                            </div>
                            <div class="col-md-12 ml-auto" style="padding-right: 30px;">
                              <button type="button" id="open_new_q" class="btn-info btn-md" data-toggle="modal" data-target="#myModal" onclick="clear_id('1')"> <span class="fa fa-plus" ></span>&nbsp;Add Question</button>
                            </div>
                            <br>
                        </div>
                        <div class="manage-jobs-sec" id="question_answer"></div>

                    </div>
                </div>
                
                <div class="col-lg-4 column job-sec">
                
                    <div class="">
                        <div class="manage-jobs-sec">
                            <h3>Status</h3>
                        </div>
                
                        <div class="col-md-12 row card-right">
<!--                            <div class="col-md-4">-->
                            <a onclick="exam_view()" class="btn-success btn-sm">Preview</a>
<!--                            </div>-->
<!--                            <div class="col-md-4">-->
                            &nbsp;
                            <button class="btn-primary btn-sm" id="update">Update</button>
<!--                            </div>-->
<!--                            <div class="col-md-4">-->
                            &nbsp;
                                <a onclick="exam_next()" class="btn-dark btn-sm" id="next" style="color: white;">Next</a>
<!--                            </div>-->
                            &nbsp;
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
                        <div class="manage-jobs-sec">
                            <div class="col-md-12 marks"><label class="text-danger">Marks :</label><label class="text-danger" id="total_mark"></label><label class="text-danger">/100</label></div>
                        </div>

                        <div class="manage-jobs-sec">
                            <h3>Set Duration</h3>
                        </div>
                        <div class="col-md-12 row card-right">
                            <div class="col-md-6">
                              Hrs:
                                <input type="number" min="0" max="24" id="Hrs">
                            </div>
                            <div class="col-md-6">
                                Min:
                                <input type="number" min="0" max="60" id="Min">
                            </div>
                        </div>
                        <div class="manage-jobs-sec">
                            <h3>Setup Date</h3>
                        </div>
                        <div class="col-md-12 row card-right">
                            <div class="col-md-4">
                                From
                            </div>
                            <div class="col-md-8">
                                <input type="date"  class="form-control" id="from">
                            </div>
                        </div>
                        <div class="col-md-12 row card-right top-padding">
                            <div class="col-md-4">
                                To
                            </div>
                            <div class="col-md-8 mt-2">
                                <input type="date"  class="form-control" id="to">
                            </div>
                        </div>
                        <div class="manage-jobs-sec">
                            <h3>Level</h3>
                        </div>

                        <div class="col-md-12 row " style="margin-left: 20px; padding: 20px 20px 0 20px;">
                            <div class="item-checkbox">
                                <input type="checkbox" name="access_func[]" class="filter-input route-parent" value="" id="defaultUnchecked">
                                <label class="filter-label" for="defaultUnchecked">
                                    Basic
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 row" style="margin-left: 20px; padding: 0px 20px 0 20px;" >
                            <div class="item-checkbox">
                                <input type="checkbox" name="access_func[]" class="filter-input route-parent" value="" id="defaultUnchecked2">
                                <label class="filter-label" for="defaultUnchecked2">
                                    Intermediate
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 row" style="margin-left: 20px;padding: 0px 20px 20px 20px;">
                            <div class="item-checkbox">
                                <input type="checkbox" name="access_func[]" class="filter-input route-parent" value="" id="defaultUnchecked3">
                                <label class="filter-label" for="defaultUnchecked3">
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
                    <div class="col-md-12 row">
                        <input type="hidden" id="q_idd"/>
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
                <div class="col-md-12 row">
                    <div class="col-md-2">
                        <label>Marks</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" id="mark" placeholder="Marks" class="form-control"/>
                        <input type="hidden" id="hidden_q"  class="form-control"/>
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

        // total_mark
        $("#mark").on('keyup',function(){
            var total_mark=$('#total_mark').text();
            var now=$('#mark').val();
            now=parseFloat(now);
            total_mark=parseFloat(total_mark);
            total_mark=parseFloat(now+total_mark).toFixed(2);
            var i=(100-(total_mark));
            if(i<0){
                $('#mark').val(0);
            }
        });

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
        var isCheck=$("#defaultUnchecked").prop( "checked" );
        if(isCheck){
            level='Basic';
        }
        var isCheck2=$("#defaultUnchecked2").prop( "checked" );
        if(isCheck2){
            level='Intermediate';
        }
        var isCheck3=$("#defaultUnchecked3").prop( "checked" );
        if(isCheck3){
            level='Advanced';
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






if(Hrs==0 && Min==0 ){

Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'please assign a time for the paper',
 
});
return;


}
else if(level==''){
  Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'please assign a level for the paper',
 
});
return;  
}

else if(from=='' || to==''){
     Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'please assign a date for the paper',
 
});
return;   

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

        var QuestionEmpty= $('#Question').val();
        var markEmpty= $('#mark').val();

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

            var mark=$('#mark').val();

            var hidden_q=$('#hidden_q').val();

            //is new or update_id
            var q_idd=$('#q_idd').val();

            //Saved Master Data exam
            $.ajax({
                type: "GET",
                data: {
                    id_exam:id_exam,
                    mark:mark,
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
                    hidden_q:hidden_q,
                    q_idd:q_idd

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
                    $('#answer_001_check').prop('checked', false);
                    $('#answer_002_check').prop('checked', false);
                    $('#answer_003_check').prop('checked', false);
                    $('#answer_004_check').prop('checked', false);
                    Swal.fire(
                            'Question updated successfully',
                            '',
                            'success'
                    )
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

        }else{
            Swal.fire(
                    'Oops!',
                    'Please assign a mark for the question',
                    'warning'
            )
        }

     }



        function Load_queqtion(){
            var id=$('#id_exam').val();
            var total_mark=0;
            $('#total_mark').text('0');
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
                    var html2='';
                    var Qnumber=0;
                    var sub_queqtion_number='*';
                    $('#question_answer').html("");
                    // for(var i=0;i<data.output.length;i++){
                    //
                    //  if(i==0){
                    //      $('#title').val(data.output[i]['Title']);
                    //      $('#Hrs').val(data.output[i]['Hrs']);
                    //      $('#Min').val(data.output[i]['Min']);
                    //      $('#from').val(data.output[i]['From']);
                    //      $('#to').val(data.output[i]['To']);
                    //      var Level=data.output[i]['Level'];
                    //      // defaultUnchecked //Intermediate//Basic//Advanced
                    //      if(Level=="Basic"){
                    //          $('#defaultUnchecked').prop('checked', true);
                    //      }else if(Level=="Intermediate"){
                    //          $('#defaultUnchecked2').prop('checked', true);
                    //      }else if(Level=="Advanced"){
                    //          $('#defaultUnchecked3').prop('checked', true);
                    //      }
                    //
                    //      var status=data.output[i]['exam_status'];
                    //      if(status==1){
                    //          $('#isStatusExam').prop('checked', true);
                    //      }else{
                    //          $('#isStatusExam').prop('checked', false);
                    //      }
                    //
                    //  }
                    //  var type=data.output[i]['type'];
                    //  var typeModal='';
                    //  if(type==1){
                    //
                    //      typeModal='<div class="level-1-layer">';
                    //      typeModal+='<div class="item-checkbox">';
                    //      typeModal+='<input type="checkbox" name="access_func[]" class="filter-input route-parent rou-1" value="1" id="par-'+i+'">';
                    //      typeModal+='<label class="filter-label" for="par-'+i+'">';
                    //      typeModal+= ''+data.output[i]['answer']+'</label>';
                    //      typeModal+='</div>';
                    //      typeModal+='</div>';
                    //  }else if(type==2){
                    //
                    //
                    //      typeModal='<div class="level-1-layer">';
                    //      typeModal+='<div class="item-radio">';
                    //      typeModal+='<input type="radio" name="access_func[]" class="filter-input route-parent rou-1" value="1" id="par-1">';
                    //      typeModal+='<label class="filter-label" for="par-1">';
                    //      typeModal+= ''+data.output[i]['answer']+'</label>';
                    //      typeModal+='</div>';
                    //      typeModal+='</div>';
                    //  }
                    //
                    //  if(type!=3) {
                    //      if (Question != data.output[i]['id_ats_exam_question']) {
                    //
                    //          html += '<div class="card">';
                    //          Qnumber = Qnumber + 1;
                    //          Question = data.output[i]['id_ats_exam_question'];
                    //          html += '<div ><h4>' + Qnumber + ').' + data.output[i]['question'] +'</h4><br></div>';
                    //          html += '<div>'+ typeModal +'<div>';
                    //
                    //
                    //
                    //      } else {
                    //
                    //          html += '<div>' + typeModal+'<div>';
                    //
                    //
                    //      }
                    //      if (Question != data.output[i]['id_ats_exam_question']) {
                    //          html += '</div>';
                    //      }
                    //  }else if(type==3){
                    //      Qnumber = Qnumber + 1;
                    //      Question = data.output[i]['id_ats_exam_question'];
                    //      html += '<div class="card">';
                    //      html += '<div ><h4>' + Qnumber + ').' + data.output[i]['question']+'</h4><br></div>';
                    //      html += '<div class="col-md-12"><textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea></div>';
                    //      html += '</div>';
                    //  }
                    //
                    //
                    //
                    // }
                    // // html += '<div class="text-right"><span class="la la-fa">Edit</span></div>';
                    // if(type!=null) {
                    //  $('#question_answer').append(html);
                    // }
                    for(var i=0;i<data.output.length;i++){

                        var q_id=data.output[i]['q_id'];
                        var mark=data.output[i]['mark'];



                        // ----------------------------------------------------------------------
                        if(i==0){
                            $('#title').val(data.output[i]['Title']);
                            $('#Hrs').val(data.output[i]['Hrs']);
                            $('#Min').val(data.output[i]['Min']);
                            $('#from').val(data.output[i]['From']);
                            $('#to').val(data.output[i]['To']);
                            var Level=data.output[i]['Level'];
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

if(data.output[i]['isCorrect'] !="false"){
    var checked='checked="checked"';
}
else{
    checked='';
}
                          

                            typeModal='<div class="level-1-layer">';
                            typeModal+='<div class="item-checkbox">';
                            typeModal+='<input type="checkbox" name="access_func[]" class="filter-input route-parent rou-1" value="1" id="par-'+data.output[i]['id_ats_exam_answer']+'" '+checked+'>';
                            typeModal+='<label  class="filter-label" for="par-'+data.output[i]['id_ats_exam_answer']+'">';
                            typeModal+= ''+data.output[i]['answer']+'</label>';
                            typeModal+='</div>';
                            typeModal+='</div>';

                        }else if(type==2){

if(data.output[i]['isCorrect'] !="false"){
    var checked='checked="checked"';
}
else{
    checked='';
}
                            
                            typeModal='<div class="level-1-layer">';
                            typeModal+='<div class="item-radio">';
                            typeModal+='<input type="radio" id="par-'+data.output[i]['id_ats_exam_answer']+'" name="acces-'+data.output[i]['id_ats_exam_question']+'" value="1" class="1" '+checked+'>';
                            typeModal+='<label class="filter-label" for="par-'+data.output[i]['id_ats_exam_answer']+'">';
                            typeModal+= data.output[i]['answer'];
                            typeModal+='</label>';
                            typeModal+='</div>';
                            typeModal+='</div>';
                        }

                        // -------------------------------------------------------------------
                        if((type==1) || (type==2) ) {

                            if (Question != data.output[i]['id_ats_exam_question']) {

                                 console.log('////////////////////////////////');
                                console.log(i);
                                console.log(data.output[i]);
                                 console.log('***************************');

                                if(Question==0) {
                                    total_mark=parseFloat(total_mark)+parseFloat(mark);
                                    html2 += '<div class="card" style="padding-left: 20px; padding-top: 10px; padding-bottom: 10px; margin: 10px 30px;">';
                                    // html2+='<div class="col-md-12 row"><div class="col-md-2 offset-10"><button class="btn-warning" style="background-color: transparent;" onclick="delete_question('+data.output[i]['id_ats_exam_question']+')"><i class="la la-trash text-danger fa-2x"> </i></button></div></div>'
                                    html2+='<div class="col-md-12 row"><div class="col-md-4"><label class="text-danger">Marks : '+mark+'</label></div><div class="col-md-4 offset-4">' +
                                            '<button class="la la-edit text-danger fa-2x" onclick="edit_question('+data.output[i]['q_id']+')" style="background-color:transparent;padding:0 10px;"></button>' +
                                            '<button class="la la-trash text-danger fa-2x" onclick="delete_question('+data.output[i]['q_id']+')" style="background-color:transparent;padding:0 10px;"></button>' +
                                            '</div></div>';

                                }else{
                                    total_mark=parseFloat(total_mark)+parseFloat(mark);
                                    html2+= '</div><div class="card" style="padding-left: 20px;  padding-top: 10px; padding-bottom: 10px; margin: 10px 30px;">';
                                    // html2+='<div class="col-md-12 row"><div class="col-md-2 offset-10"><button class="btn-warning" style="background-color: transparent;" onclick="delete_question('+data.output[i]['id_ats_exam_question']+')"><i class="la la-trash text-danger fa-2x"> </i></button></div></div>'
                                    html2+='<div class="col-md-12 row"><div class="col-md-4"><label class="text-danger">Marks : '+mark+'</label></div><div class="col-md-4 offset-4">' +
                                            '<button class="la la-edit text-danger fa-2x" onclick="edit_question('+data.output[i]['q_id']+')" style="background-color:transparent;padding:0 10px;"></button>' +
                                            '<button class="la la-trash text-danger fa-2x" onclick="delete_question('+data.output[i]['q_id']+')" style="background-color:transparent;padding:0 10px;"></button>' +
                                            '</div></div>';
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




                        }
                        else if(type==3){

                            total_mark=parseFloat(total_mark)+parseFloat(mark);
                            html2+='</div>';
                            Qnumber = Qnumber + 1;
                            Question = data.output[i]['id_ats_exam_question'];

                            html2 += '<div class="card" style="padding-left: 20px; padding-top: 10px; padding-bottom: 10px; margin: 10px 30px;">';
                            // html2+='<div class="col-md-12 row"><div class="col-md-2 offset-10"><button class="btn-warning" style="background-color: transparent;" onclick="delete_question('+q_id+')"><i class="la la-trash text-danger fa-2x"> </i></button></div></div>'
                            html2+='<div class="col-md-12 row"><div class="col-md-4"><label class="text-danger">Marks : '+mark+'</label></div><div class="col-md-4 offset-4">' +
                                    '<button class="la la-edit text-danger fa-2x" onclick="edit_question('+data.output[i]['q_id']+')" style="background-color:transparent;padding:0 10px;"></button>' +
                                    '<button class="la la-trash text-danger fa-2x" onclick="delete_question('+data.output[i]['q_id']+')" style="background-color:transparent;padding:0 10px;"></button>' +
                                    '</div></div>';
                            html2 += '<label style="display: none;" id="qNo">'+q_id+'</label>';
                            html2 += '<label style="display: none;" id="type">SHORT</label>';
                            html2+= '<div ><h4> ' + Qnumber + ').<label id="q_id_'+q_id+'">' + data.output[i]['question']+'</label></h4><br></div>';
                            html2 += '<div class="col-md-12"><textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea></div>';
                            html2 += '</div>';


                        }


                    }


                    $('#question_answer').append(html2);
                    $('#total_mark').text(total_mark);
                    if($('#total_mark').text()==100){
                        $('#open_new_q').hide();
                    }else{
                        $('#open_new_q').show();
                    }

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    HoldOn.close();
                    heads_up_error();
                }
            });
        }

        function exam_view(){
        var id_exam=$('#id_exam').val();
        //window.location.replace("<?php //echo base_url() ?>//employer/job_posts/ats_setup_exam_view?id="+id_exam);
        window.open("<?php echo base_url() ?>employer/job_posts/ats_setup_exam_view?id="+id_exam,'_blank');
        }

        function exam_next(){
            var id_exam=$('#id_exam').val();
            window.location.replace("<?php echo base_url() ?>employer/job_posts/ats_setup_exam_maker_next?next_job_id="+id_exam);

        }


        function clear_id(id){
            $('#hidden_q').val("");
            $('#mark').val("");
            $('#Question').val("");
            $('#answer_001').val("");
            $('#answer_002').val("");
            $('#answer_003').val("");
            $('#answer_004').val("");
            $('#answer_001_check').prop('checked', false);
            $('#answer_002_check').prop('checked', false);
            $('#answer_003_check').prop('checked', false);
            $('#answer_004_check').prop('checked', false);

        }

        function delete_question(id){
            $.ajax({
                type: "GET",
                data: {
                    id_q_master:id,
                },
                dataType: 'json',
                url: base_url + 'employer/job_posts/ats_question_delete',
                cache: true,
                beforeSend: function () {
                    HoldOn.open(loader_options);
                },
                success: function (data) {
                    HoldOn.close();
                    Swal.fire(
                            'Question deleted successfully',
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

        function edit_question(id){
            $('#myModal').modal('toggle');
            $('#hidden_q').val("");
            $('#hidden_q').val(id);
            $('#q_idd').val("");
            $('#q_idd').val(id);
            $.ajax({
                type: "GET",
                data: {
                    id_q_master:id,
                },
                dataType: 'json',
                url: base_url + 'employer/job_posts/ats_question_load',
                cache: true,
                beforeSend: function () {
                    HoldOn.open(loader_options);
                },
                success: function (data) {
                    HoldOn.close();
                    $('#Question').val("");
                    $('#answer_001').val("");
                    $('#answer_002').val("");
                    $('#answer_003').val("");
                    $('#answer_004').val("");
                    $('#mark').val("");

                    $('#Question').val(data.id[0]['question']);
                    $('#mark').val(data.id[0]['mark']);
                    $('#question_type').val(data.id[0]['type']).change();
                    $('#answer_001').val(data.id[0]['answer']);
                    $('#answer_002').val(data.id[1]['answer']);
                    $('#answer_003').val(data.id[2]['answer']);
                    $('#answer_004').val(data.id[3]['answer']);

                    if(data.id[0]['isCorrect'] !="false"){
                        $('#answer_001_check').attr('checked','checked');
                          $('#answer_001_check').prop('checked',true);

                    }

                     if(data.id[1]['isCorrect'] !="false"){
                        $('#answer_002_check').attr('checked','checked');
                         $('#answer_002_check').prop('checked',true);

                    }



 if(data.id[2]['isCorrect'] !="false"){
                        $('#answer_003_check').attr('checked','checked');
                         $('#answer_003_check').prop('checked',true);

                    }

                     if(data.id[3]['isCorrect'] !="false"){
                        $('#answer_004_check').attr('checked','checked');
                         $('#answer_004_check').prop('checked',true);

                    }

                   // answer_001_check




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
    $('#from').attr("min", today);
    $('#to').attr("min", today);


    $("#defaultUnchecked").on('click',function (){
        var isCheck=$("#defaultUnchecked").prop( "checked");
        if(isCheck){
            $("#defaultUnchecked2").prop( "checked",false);
            $("#defaultUnchecked3").prop( "checked",false);
        }
    });
    $("#defaultUnchecked2").on('click',function (){
        var isCheck=$("#defaultUnchecked2").prop( "checked");
        if(isCheck){
            $("#defaultUnchecked").prop( "checked",false);
            $("#defaultUnchecked3").prop( "checked",false);
        }
    });
    $("#defaultUnchecked3").on('click',function (){
        var isCheck=$("#defaultUnchecked3").prop( "checked");
        if(isCheck){
            $("#defaultUnchecked2").prop( "checked",false);
            $("#defaultUnchecked").prop( "checked",false);
        }
    });


    $('#Hrs').on('change',function (){
        var hrs=$('#Hrs').val();
        if((hrs<0) || (hrs > 23)){
            $('#Hrs').val("");
        }
    });

    $('#Min').on('change',function (){
        var Min=$('#Min').val();
        if((Min<0) || (Min >59)){
            $('#Min').val("");
        }
    });

</script>

