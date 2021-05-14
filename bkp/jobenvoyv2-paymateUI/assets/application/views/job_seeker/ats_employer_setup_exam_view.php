<style type="text/css">
	.manage-jobs-sec{
		padding: 0px;
	}

	/*----------Timer-------------------------*/

	.timer, .timer-done, .timer-loop {
		font-size: 30px;
		color: black;
		font-weight: bold;
		padding: 10px;
	}

	// These are the default CSS classes
	// used by this plugin. Use these values
	// for a basic style to get started.
	   .jst-hours {
		   float: left;
	   }
	.jst-minutes {
		float: left;
	}
	.jst-seconds {
		float: left;
	}
	.jst-clearDiv {
		clear: both;
	}
	.jst-timeout {
		color: red;
	}
	/*----------------------------------*/


	@import url(https://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,900,700italic,700,600italic,600,400italic);

	#timer{
		font-family: 'Titillium Web', cursive;
		width: 800px;
		margin: 0 auto;
		text-align: center;
		color: white;
		/*background: #222;*/
		/*font-weight: 100;*/
	}



	/*#days {*/
	/*	font-size: 100px;*/
	/*	color: #db4844;*/
	/*}*/
	#hours {
		font-size: 20px;
		color: #f07c22;
	}
	#minutes {
		font-size: 20px;
		color: #f6da74;
	}
	#seconds {
		font-size: 10px;
		color: #abcd58;
		margin-top: 10px;
	}

    .manage-jobs-sec{
        padding: 0px;
    }


    @media (min-width: 992px) {
        .col-lg-9.job-sec{
            -webkit-box-flex: 0;
            -ms-flex: 0 0 70%;
            flex: 0 0 70%;
            max-width: 70%;
        }
        .col-lg-3.job-sec{
            -webkit-box-flex: 0;
            -ms-flex: 0 0 25%;
            flex: 0 0 25%;
            max-width: 25%;
        }

        .col-lg-9.job-sec, .col-lg-3.job-sec {
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
    .item-checkbox.level-hover:hover{
        cursor:context-menu !important;
    }

</style>

<section>
    <div class="block no-padding">
        <div class="container-fluid">
            <div class="row no-gape">

                <!--include side bar for employer-->
<!--                --><?php //$this->load->view('include/side_bar_left_ats') ?>


                <div class="col-lg-9 column job-sec">
					<div class="padding-left">
						<a href="<?php echo base_url()?>job_seeker/job_posts_view/ats_post_job_view"><label> <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
																												  width="24" height="24"
																												  viewBox="0 0 172 172"
																												  style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none"  style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g><path d="M2.65391,86c0,-46.02344 37.32266,-83.34609 83.34609,-83.34609c46.02344,0 83.34609,37.32266 83.34609,83.34609c0,46.02344 -37.32266,83.34609 -83.34609,83.34609c-46.02344,0 -83.34609,-37.32266 -83.34609,-83.34609z" fill="#018e53"></path><path d="M77.73594,86.90703c10.31328,-10.31328 20.62656,-20.62656 30.93984,-30.93984c9.00312,-9.00313 -5.00547,-22.91094 -14.04219,-13.87422c-12.63125,12.63125 -25.2625,25.2625 -37.89375,37.89375c-3.82969,3.82969 -3.69531,10.17891 0.06719,13.94141c12.63125,12.63125 25.2625,25.2625 37.89375,37.89375c9.00313,9.00313 22.91094,-5.00547 13.87422,-14.04219c-10.27969,-10.31328 -20.55938,-20.59297 -30.83906,-30.87266z" fill="#ffffff"></path></g></g></svg> </label> </a>
					</div>

                    <div class="padding-left ">
                        <div class="manage-jobs-sec">
                            <h3>Exam</h3>
							<div class="col-md-12 row">
								<input style="margin-left: 20px; margin-top:20px; font-size: 16px; font-weight: 500;" type="text" placeholder="title" id="title" class="form-control disabled" disabled>
								<input type="hidden" id="id_exam" value="<?php echo $this->input->get('id'); ?>"  id="title" class="form-control">
								<input type="hidden" id="id_user" value="<?php echo $_SESSION['user_id'];; ?>"  id="title" class="form-control">

							</div>

                        </div>
						<div class="manage-jobs-sec" id="question_answer"></div>

						<div>
							<button class="btn-success bt-sm" style="margin: 0 20px 20px 0;" onclick="finish()">Finish</button>
						</div>

                    </div>
                </div>
				<div class="col-lg-3 column job-sec">
					<div class="padding-left ">
						<div class="manage-jobs-sec">
							<h3>Time</h3>
						</div>
						<div class="col-md-12 row d-flex justify-content-center card-right>
						<input type="text" id="time_lable001" hidden >
<!--							<h1 style=" color: red;" id="time_lable" class="countdown"></h1>-->

						</div>
						<div class="col-md-12 row" style="padding-left: 100px;">
							<div class="timer" ></div>
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
							<div class="item-checkbox level-hover">
								<input type="checkbox" name="access_func[]" class="filter-input route-parent" value="" id="defaultUnchecked" disabled>
								<label class="filter-label" for="defaultUnchecked">
									Basic
								</label>
							</div>
						</div>
						<div class="col-md-12 row" style="margin-left: 20px; padding: 0px 20px 0 20px;">
							<div class="item-checkbox level-hover">
								<input type="checkbox" name="access_func[]" class="filter-input route-parent" value="" id="defaultUnchecked2" disabled>
								<label class="filter-label" for="defaultUnchecked2">
									Intermediate
								</label>
							</div>
						</div>
						<div class="col-md-12 row" style="margin-left: 20px; padding: 0px 20px 20px 20px;">
							<div class="item-checkbox level-hover">
								<input type="checkbox" name="access_func[]" class="filter-input route-parent" value="" id="defaultUnchecked3" disabled>
								<label class="filter-label" for="defaultUnchecked3" disabled>
									Advanced
								</label>
							</div>
						</div>
						<div class="col-md-12 row">

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
					<input type="text" id="answer_001" placeholder="Answer 001" class="form-control"/>
					<input type="text" id="answer_002" placeholder="Answer 002" class="form-control"/>
					<input type="text" id="answer_003" placeholder="Answer 003" class="form-control"/>
					<input type="text" id="answer_004" placeholder="Answer 004" class="form-control"/>
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


<script>
	$(function(){
		$('.timer').attr('class',"timer row jst-timeout");
		$('.timer').attr('data-seconds-left',0);

		// $('.timer').startTimer();
	});
</script>
<script src="<?php echo base_url()?>assets/plugins/timer/jquery.simple.timer.js" type="text/javascript"></script>

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


		// $('#time_lable001').val("06:30");

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
				url: base_url + 'job_seeker/job_posts/load_exam',
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

					var html2='';

					for(var i=0;i<data.output.length;i++){

						// ----------------------------------------------------------------------
						if(i==0){
							$('#title').val(data.output[i]['Title']);
							$('#Hrs').val(data.output[i]['Hrs']);
							$('#Min').val(data.output[i]['Min']);
							$('#from').val(data.output[i]['From']);
							$('#to').val(data.output[i]['To']);
							var Level=data.output[i]['Level'];
							// defaultUnchecked //Intermediate//Basic//Advanced
						    var H=data.output[i]['Hrs'];
							var M=data.output[i]['Min'];
							if(H.length==1){
								H='0'+H;
							}
							if(M.length==1){
								M='0'+M;
							}
							$('#time_lable001').val(H+':'+M+':00');

							// ----------------------------
							var hour_secound=(H*3600);
							var min_secound=(M*60);
							var all_secound=(hour_secound+min_secound);
							$('.timer').attr('data-seconds-left',all_secound);

							$('.timer').startTimer({
								onComplete: function(element){
									$(".manage-jobs-sec :input").prop("disabled", true);
									finish_auto();
								}
							});
							timer_strat();
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
						if(type!=3) {

							if (Question != data.output[i]['id_ats_exam_question']) {

								if(Question==0) {
									html2 += '<div class="card" style="margin: 20px;">';
								}else{
									html2 += '</div><div class="card" style="margin: 20px;">';
								}
									Qnumber = Qnumber + 1;
									Question = data.output[i]['id_ats_exam_question'];
									html2 += '<label style="display: none;" id="qNo">'+Question+'</label>';
								    html2 += '<label style="display: none;" id="type">MCQ</label>';
									html2 += '<div style="background-color: #f3f3f3; padding: 20px;"><h4>' + Qnumber + ').' + data.output[i]['question'] + '</h4></div> <br>';
								    html2 += '<div class="col-md-4"><label class="text-danger">Mark : '+data.output[i]['mark']+'</label></div>';

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

							html2 += '<label style="display: none;" id="qNo">'+data.output[i]['id_ats_exam_question']+'</label>';
							html2 += '<label style="display: none;" id="type">SHORT</label>';
							html2+= '<div style="background-color: #f3f3f3; padding: 20px;"><h4>' + Qnumber + ').' + data.output[i]['question']+'</h4></div>';
							html2 += '<div class="col-md-4"><label class="text-danger">Marks : '+data.output[i]['mark']+'</label></div>';
							html2 += '<div class="col-md-12" style="padding: 20px 40px;"><textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea></div>';

							html2 += '</div>';
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

		function finish_auto(){
			var ItemArray1 = [];
			$('#question_answer .card').each(function () {
				var card = $(this);
				// alert('B');
				var qNo=card.children("#qNo").text();
				var type=card.children("#type").text();



				if(type==1){
					//Checkbox
					var type=card.children("checkbox").val();

				}else if(type==2) {
					//Radio
				}else if(type==3){
					//Short Answer
				}

				var ItemArray = [];
				ItemArray.push({
					id_exam:$('#id_exam').val(),
					id_user:$('#id_user').val(),
					Type : type,
					Key : qNo,
					Item : []
				});
				card.find( ":checkbox" ).each(function(){
					if($(this).prop('checked')) {
						var checkbox = $(this).attr('id').split('par-')[1];
						ItemArray[0].Item.push(checkbox);
					}
				});

				card.find( ":radio" ).each(function(){
					if($(this).prop('checked')) {
						var checkbox = $(this).attr('id').split('par-')[1];
						ItemArray[0].Item.push(checkbox);
					}
				});
				//type
				if(type=='SHORT') {
					card.find(":input").each(function () {
						var textarea = $(this).val();
						ItemArray[0].Item.push(textarea);
					});
				}
				ItemArray1.push(ItemArray);


			});
			// console.log(ItemArray);
			$.ajax({
				type: "GET",
				data:{ItemArray: ItemArray1},
				dataType: 'json',
				url: base_url+'job_seeker/job_posts/ats_exam_assing_emp',
				cache: true,
				beforeSend: function(){
					HoldOn.open(loader_options);
				},
				success: function (data) {
					HoldOn.close();
					// $('#id_exam').val(data.id);



				},
				error: function (jqXHR, textStatus, errorThrown) {
					HoldOn.close();
					// heads_up_error();
					Swal.fire(
							'Finished!',
							'Thank you for enrolling this exam. Your results will be observed and you will called for an interview. ',
							'success'
					)


				}
			});

			setTimeout(function(){ window.location.replace('../job_posts_view/ats_post_job_view');}, 2000);

		}
		function finish(){
			Swal.fire({
				title: 'Are you sure you want to finish the exam?',
				text: "You won't be able to access / correct the paper again.",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, finish!'
			}).then((result) => {
				if (result.value) {


	 	 //question_answer
			var ItemArray1 = [];
			$('#question_answer .card').each(function () {
				var card = $(this);
				// alert('B');
				var qNo=card.children("#qNo").text();
				var type=card.children("#type").text();



				if(type==1){
					//Checkbox
					var type=card.children("checkbox").val();

				}else if(type==2) {
					//Radio
				}else if(type==3){
					//Short Answer
				}

				var ItemArray = [];
				ItemArray.push({
					id_exam:$('#id_exam').val(),
					id_user:$('#id_user').val(),
					Type : type,
					Key : qNo,
					Item : []
				});
				card.find( ":checkbox" ).each(function(){
					if($(this).prop('checked')) {
						var checkbox = $(this).attr('id').split('par-')[1];
						ItemArray[0].Item.push(checkbox);
					}
				});

				card.find( ":radio" ).each(function(){
					if($(this).prop('checked')) {
						var checkbox = $(this).attr('id').split('par-')[1];
						ItemArray[0].Item.push(checkbox);
					}
				});
				//type
				if(type=='SHORT') {
					card.find(":input").each(function () {
						var textarea = $(this).val();
						ItemArray[0].Item.push(textarea);
					});
				}
				ItemArray1.push(ItemArray);


			});
			 // console.log(ItemArray);
			$.ajax({
				type: "GET",
				data:{ItemArray: ItemArray1},
				dataType: 'json',
				url: base_url+'job_seeker/job_posts/ats_exam_assing_emp',
				cache: true,
				beforeSend: function(){
					HoldOn.open(loader_options);
				},
				success: function (data) {
					HoldOn.close();
					// $('#id_exam').val(data.id);



				},
				error: function (jqXHR, textStatus, errorThrown) {
					HoldOn.close();
					// heads_up_error();
					Swal.fire(
							'Finished!',
							'Thank you for enrolling this exam. Your results will be observed and you will called for an interview. ',
							'success'
					)


				}
			});

			setTimeout(function(){ window.location.replace('../job_posts_view/ats_post_job_view');}, 2000);


				}
			})
		}

</script>
<script type="text/javascript">

	function timer_strat() {
		var timer2 = $('#time_lable001').val();
		// var timer2 ='10:01:59';
		var interval = setInterval(function () {


			var timer = timer2.split(':');
			//by parsing integer, I avoid all extra string processing
			var hour = parseInt(timer[0], 10);
			var minutes = parseInt(timer[1], 10);
			var seconds = parseInt(timer[2], 10);
			--seconds;
			hour = (minutes < 0) ? --hour : hour;
			minutes = (minutes < 0) ? 59 : minutes;
			minutes = (minutes < 10) ? '0' + minutes : minutes;
			seconds = (seconds < 0) ? 59 : seconds;
			seconds = (seconds < 10) ? '0' + seconds : seconds;
			//minutes = (minutes < 10) ?  minutes : minutes;
			$('.countdown').html(hour+':'+minutes + ':' + seconds);
			if (minutes < 0) clearInterval(interval);
			//check if both minutes and seconds are 0
			if ((seconds <= 0) && (minutes <= 0)) clearInterval(interval);
			timer2 = hour+':'+minutes + ':' + seconds;
		}, 1000);
	}


	/* https://stackoverflow.com/questions/41035992/jquery-countdown-timer-for-minutes-and-seconds */
</script>

<script type="text/javascript">
	function makeTimer() {

		//		var endTime = new Date("29 April 2018 9:56:00 GMT+01:00");
		var endTime = new Date("29 April 2020 9:56:00 GMT+01:00");
		endTime = (Date.parse(endTime) / 1000);

		var now = new Date();
		now = (Date.parse(now) / 1000);

		var timeLeft = endTime - now;

		var days = Math.floor(timeLeft / 86400);
		var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
		var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
		var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

		// hours='1';
		// minutes='1';
		// seconds='05';

		if (hours < "10") { hours = "0" + hours; }
		if (minutes < "10") { minutes = "0" + minutes; }
		if (seconds < "10") { seconds = "0" + seconds; }

		$("#days").html(days + "<span>Days</span>");
		$("#hours").html(hours + "<span>Hours</span>");
		$("#minutes").html(minutes + "<span>Minutes</span>");
		$("#seconds").html(seconds + "<span>Seconds</span>");

	}

	setInterval(function() { makeTimer(); }, 1000);

	window.onbeforeunload = function () {

		finish_auto();
		return true;




	};



</script>

