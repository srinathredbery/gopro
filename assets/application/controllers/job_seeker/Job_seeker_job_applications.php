<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 12/13/2018
 * Time: 11:49 AM
 */

class Job_seeker_job_applications extends Main_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('jobseeker_job_application_model');

		if (isset($_SESSION['logged_in']) && $_SESSION['user_type'] == 3)
			return;
		else {
//            echo $_SESSION['redirect_url'];
			redirec_login();
		}
	}

	public function get_jobseeker_resume_letter()
	{

		if (isset($_SESSION['user_id'], $_SESSION['user_type']) && !empty($_SESSION['user_id']) && $_SESSION['user_type'] == 3) {
			$data['current_js_resume'] = $this->jobseeker_job_application_model->get_current_user_resume($_SESSION['user_id']);
			$data['current_js_cover_letter'] = $this->jobseeker_job_application_model->get_current_user_cover_letter($_SESSION['user_id']);
			echo json_encode($data);
		}
	}

	public function get_selected_cover_letter()
	{

		$cover_letter_id = $_GET['cl_uid'];
		JOB_SEEKER_COVER_LETTER_READ_DIR;
		$cover_letter = $this->jobseeker_job_application_model->get_selected_cover_letter($_SESSION['user_id'], $cover_letter_id);
		array_push($cover_letter,JOB_SEEKER_COVER_LETTER_READ_DIR);

		echo json_encode($cover_letter);
	}

	function get_selected_resume()
	{
		$resume_id = $_GET['r_id'];
		$resume['about'] = $this->get_about($resume_id);
		$resume['work_exp'] = $this->get_work_exp($resume_id);
		$resume['pro_skill'] = $this->get_pro_skill($resume_id);
		$resume['edu'] = $this->get_edu($resume_id);
		$resume['award'] = $this->get_award($resume_id);
		$resume['lang'] = $this->get_language($resume_id);
		$resume['resume_data']=$this->get_resume_data($resume_id);
//		$resume['resume_cover_latter_data']=$this->get_cover_latter_data($resume_id);




		echo json_encode($resume);
	}

	function receive_job_application()
	{
		//Jobseeker job application validation

		$vali_rules = array(
			array(
				'field' => 'job_post_id',
				'label' => 'Job post not found',
				'rules' => 'required'
			),
			array(
				'field' => 'applied_resume',
				'label' => 'You must select a resume',
				'rules' => 'required',
			)
		);

		$this->form_validation->set_rules($vali_rules);

		$is_applied_already = check_user_already_applied_for_job($_SESSION['user_id'], $_POST['job_post_id']);

		if (empty($is_applied_already)) {
			if ($this->form_validation->run() == FALSE) {
				header("HTTP/1.1 406 Not Acceptable");
				echo json_encode(array('code' => 406, 'message' => array(validation_errors())));
			} else {
				$response = $this->save_job_application();
				echo json_encode($response);
			}
		} else {
			header("HTTP/1.1 406 Not Acceptable");
			echo json_encode(array('code' => 406, 'message' => 'You have already applied for this job. Please check your dashboard for tracking'));
		}


	}

	function save_job_application()
	{
		try {
			$_POST['jobseeker_id'] = $_SESSION['user_id'];
			$job_application = $this->input->post();

			$this->db->trans_begin();
			$this->jobseeker_job_application_model->create_job_application($job_application);

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return false;
			} else {
				return $this->db->trans_commit();
			}
		} catch (Exception $ex) {
			$this->db->trans_rollback();
			return $ex->getMessage();
		}
	}

	public function view_application_history()
	{

		$data['application_list'] = $this->jobseeker_job_application_model->get_applications($_SESSION['user_id']);

		$data['main_content'] = 'job_seeker/job_seeker_application_history';

		//load main content page
		$data['page_title'] = 'My Application History';
		$this->load->view('templates/template_job_seeker', $data);
	}

	public function view_application_history_interview()
	{

		$data['application_list'] = $this->jobseeker_job_application_model->get_applications_interview($_SESSION['user_id']);

		$data['main_content'] = 'job_seeker/job_seeker_application_history_interview';

		//load main content page
		$data['page_title'] = 'My Application History';
		$this->load->view('templates/template_job_seeker', $data);
	}

	function withdraw_application()
	{
		$apl_id = $this->input->post();

		$res = $this->jobseeker_job_application_model->withdraw_application($_SESSION['user_id'], $apl_id['apl_id'], array('is_wd' => '1'));
		echo json_encode($res);

	}

	function reapply_application()
	{
		$apl_id = $this->input->post();

		$res = $this->jobseeker_job_application_model->reapply_application($_SESSION['user_id'], $apl_id['apl_id'], array('is_wd' => '2'));
		echo json_encode($res);

	}


//    retrieve selected resume details methods

	function get_about($resume_id)
	{
		$about = $this->jobseeker_job_application_model->get_selected_resume_about($resume_id);

		if (!empty($about['about_description'])) {
			return $about['about_description'];
		} else {
			return false;
		}
	}

	function get_work_exp($resume_id)
	{
		$work_exp = $this->jobseeker_job_application_model->get_selected_resume_work_exp($resume_id);

		if (!empty($work_exp)) {
			$new_record_to_front = '';
			foreach ($work_exp as $value) {

				if (!empty($value['start_date']) && $value['start_date'] != '0000-00-00')
					$start_date = date("M Y", strtotime($value['start_date']));
				else
					$start_date = "";

				if (!empty($value['end_date']) && $value['end_date'] != '0000-00-00')
					$end_date = date("M Y", strtotime($value['end_date']));
				elseif ($value['still_work'] == 'yes')
					$end_date = 'To date';
				else
					$end_date = "Not stated";

				if (!empty($start_date))
					$hyp = ' - ';
				else
					$hyp = ' ';

				$new_record_to_front .= '<div class="edu-history style2 work-exp">
                                    <i></i>
                                    <div class="edu-hisinfo">
                                        <h3>' . $value['job_title'] . '<span>' . $value['company'] . '</span></h3>
                                        <i>' . $start_date . $hyp . $end_date . '</i>
                                        <p>' . $value['description'] . '</p>
                                    </div>
                                </div>';
			}
			return $new_record_to_front;

		} else {
			return false;
		}
	}

	function get_pro_skill($resume_id)
	{

		$resume_pro_skills = $this->jobseeker_job_application_model->get_selected_resume_pro_skill($resume_id);
		$new_record_to_front = '';
		if (!empty($resume_pro_skills)) {
			foreach ($resume_pro_skills as $resume_pro_skill) {

				$new_record_to_front .=
					'<div class="progress-sec with-edit pro-skill">
                        <span>' . $resume_pro_skill['skill'] . '</span>
                        <div class="progressbar"> <div class="progress" style="width:' . $resume_pro_skill['skill_level'] . '%"><span>' . $resume_pro_skill['skill_level'] . '%' . '</span></div> </div>                        
                    </div>';
			}
			return $new_record_to_front;
		} else {
			return false;
		}

	}

	function get_edu($resume_id)
	{

		$resume_edus = $this->jobseeker_job_application_model->get_selected_resume_edu($resume_id);
		$new_record_to_front = '';
		if (!empty($resume_edus)) {
			foreach ($resume_edus as $resume_edu) {

				if (!empty($resume_edu['end_date']))
					$end_date = date("M Y", strtotime($resume_edu['end_date']));
				else
					$end_date = 'To date';

				$new_record_to_front .=
					'<div class="edu-history edu">
                        <i class="la la-graduation-cap"></i>
                        <div class="edu-hisinfo">
                            <h3>' . $resume_edu['education_level_name'] . '</h3>
                            <i>' . date("M Y", strtotime($resume_edu['start_date'])) . ' - ' . $end_date . '</i>
                            <span>' . $resume_edu['school'] . ' <i>' . $resume_edu['specialization'] . '</i></span>
                            <p>' . $resume_edu['related_info'] . '</p>
                        </div>
                    </div>';
			}
			return $new_record_to_front;
		} else {
			return false;
		}
	}


	function get_award($resume_id)
	{

		$resume_awards = $this->jobseeker_job_application_model->get_selected_resume_award($resume_id);
		$new_record_to_front = '';
		if (!empty($resume_awards)) {
			foreach ($resume_awards as $resume_award) {

				$new_record_to_front .=
					'<div class="edu-history style2 award">
                        <i></i>
                        <div class="edu-hisinfo">
                            <h3>' . $resume_award['award'] . '</h3>
                            <i>' . $resume_award['date_of_award'] . '</i>
                            <p>' . $resume_award['date_of_award'] . '</p>
                        </div>
                    </div>';
			}
			return $new_record_to_front;
		} else {
			return false;
		}

	}


	function get_language($resume_id)
	{

		$resume_langs = $this->jobseeker_job_application_model->get_selected_resume_lang($resume_id);
		$new_record_to_front = '';
		if (!empty($resume_langs)) {
			foreach ($resume_langs as $resume_lang) {
				$new_record_to_front = $new_record_to_front .
					'<div class="edu-history lang-skill language-cus col-md-6" id="lang-skill-' . $resume_lang['lang_res_id'] . '">
                        <div class="edu-hisinfo">
                            <h3>' . $resume_lang['js_language'] . '</h3>
                            <p>
                                <i class="fas fa-book-open"></i> &nbsp; Reading: ' . $resume_lang['reading'] . ' <br>
                                <i class="fas fa-pen-nib"></i> &nbsp; Writing: ' . $resume_lang['writing'] . ' <br>
                                <i class="fas fa-volume-up"></i> &nbsp; Speaking: ' . $resume_lang['speaking'] . ' <br> 
                            </p>
                        </div>
                    </div>';
			}
			return $new_record_to_front;
		} else {
			return false;
		}

	}


	function get_resume_data($resume_id){

		//		$resume_info = $this->resume_model->get_resume_info(array('resume_id' => $resume_id));
//		$data['resume_data']=$resume_info;
		$resume_info = $this->jobseeker_job_application_model->get_resume_info($resume_id);

		$new_record_to_front = '';
		$resume_attachment2='';
		if (!empty($resume_info)) {
			foreach ($resume_info as $resume_lang) {


				$resume_attachment='';
				$type='';
				$view='';
				if(!empty($resume_info['resume_attachment'])){
					$resume_attachment=$resume_info['resume_attachment'] ;
					$view=JOB_SEEKER_RESUME_READ_DIR.$resume_info['resume_attachment'];
					$file = pathinfo(JOB_SEEKER_RESUME_READ_DIR.$resume_info['resume_attachment'], PATHINFO_EXTENSION);
					$type=0;
					if($file === "pdf") {
						$type='<i class="far fa-file-pdf" style="font-size: 36px;"></i>';
					}else if($file === "doc" || $file === "docx"){
						$type='<i class="far fa-file-word" style="font-size: 36px;"></i>';
					}
				}
				if($resume_attachment2!=$resume_attachment) {
					$new_record_to_front = $new_record_to_front .
						'<div class="row">
						<div class="col-lg-6 mb-2">
														<div class="mb-3  h-100 p-3" style="border: 1px solid #26ae61;">
															<div class="row">
																<div class=" col-10">
																	<p class="mb-0" style=" font-size: 12px;">
																File Name : ' . $resume_attachment . '
																		</p>
																		</div>
																<div class="col-2">
                                                            <span class="col-2 float-left">
                                                            ' . $type . '
                                                              </span>
                                                            	</div>
															</div>
															<div class="row">
																<div class="mt-2 pr-2 w-100">
																	<a class="btn btn-success float-right m-2 col-3" href= "' . $view . '" target="_blank">View</a>
																	
																	</a>
																</div>
															</div>
														</div>
													</div>
				  </div>';
				}
				$resume_attachment2=$resume_attachment;
			}
			return $new_record_to_front;
		} else {
			$new_record_to_front=	'<div class="row">
						<div class="col-lg-6 mb-2">
														<div class="mb-3  h-100 p-3" style="border: 1px solid #26ae61;">
															<div class="row">
																<div class=" col-10">
																	<p class="mb-0" style=" font-size: 12px;">
																		File Name : '.$resume_id.'
																		</p>
																		</div>
																<div class="col-2">
                                                            <span class="col-2 float-left">
                                                              </span>
																</div>
															</div>
															<div class="row">
																<div class="mt-2 pr-2 w-100">
																	<a class="btn btn-success float-right m-2 col-3" href= "" target="_blank">View</a>
																	<a class="btn btn-danger float-right m-2 col-2 del-res-file" id="btn-del-res-file" data-r-id=""> 
																	<i class="la la-trash-o" data-r-id=""></i>
																	</a>
																</div>
															</div>
														</div>
													</div>
				  </div>';
			return $new_record_to_front;
		}


	}

	function  get_cover_latter_data($resume_id){
		$resume_cover_doc= $this->jobseeker_job_application_model->get_cover_latter_data($resume_id);
		$new_record_to_front = '';
		if (!empty($resume_langs)) {
			foreach ($resume_langs as $resume_lang) {
				$new_record_to_front = $new_record_to_front .
					'<div class="col-md-12 mb-2 cl-file d-none-cus" id="">
                                    <p class="mb-0" style=" font-size: 12px;">File Name : <span id="cl_file_name"></span></p>
                                    <a class="btn btn-success float-left m-2 col-1 cl_link" href= "'.JOB_SEEKER_COVER_LETTER_READ_DIR.'" target="_blank">View</a>
                                    <a class="btn btn-danger float-left m-2 col-1 del-cl-file" id="" >
                                        <i class="la la-trash-o"></i>
                                    </a>
 					</div>';
			}
			return $new_record_to_front;
		} else {
			return false;
		}
	}

}
