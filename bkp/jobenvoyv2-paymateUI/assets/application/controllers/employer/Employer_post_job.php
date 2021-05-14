<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 8/10/2018
 * Time: 3:25 PM
 */

class Employer_post_job extends Main_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('employer_job_post_model');
		$this->load->model('employer_application_model');
//        if (isset($_SESSION['logged_in']) && $_SESSION['user_type'] == 2)
//            return;
//        else
//            redirect('login');
    }

    public function view_post_editor()
    {
        //get form drop downs
        $data['country_list'] = $this->master_dml_model->get_all_data('country_master');
        $data['job_type'] = $this->master_dml_model->get_all_data('job_type', array('is_hidden_deleted'=>'0'));
        $data['job_category'] = $this->master_dml_model->get_all_data('job_category', array('is_hidden_deleted'=>'0'));
        $data['career_level'] = $this->master_dml_model->get_all_data('career_level');
        $data['salary_range'] = $this->master_dml_model->get_all_data('salary_range');
        $data['currency'] = $this->master_dml_model->get_all_data('currency_master');
        $data['education_level'] = $this->master_dml_model->get_all_data('education_level_master');
        $data['experience_level'] = $this->master_dml_model->get_all_data('experience_level');


        $data['page_title'] = 'Post A New Job';

        $selected_post = $this->input->get();
        $post_id = isset($selected_post) && !empty($selected_post['job_post']) ? $selected_post['job_post'] : NULL ;

        if(!empty($selected_post['job_post'])){

            $data['current_post'] = $this-> employer_job_post_model ->get_selected_post($post_id);
            $data['current_post']['job_post_skill_tags'] = $this-> employer_job_post_model ->get_selected_post_skill_tags($post_id);

            $data['page_title'] = 'Edit Job Post';
        }



        $data['main_content'] = 'employer/employer_job_post_new';

        //load main content page
        $this->load->view('templates/template_employer', $data);
    }

    function make_new_post(){

		$subscription = $this->employer_job_post_model->get_subscriptions_available($this->session->company_id);
		if (!empty($subscription)) {
			if ($subscription['no_of_posts'] <= 0) {
				echo json_encode(array('code' => 0, 'message' => 'You have no active subscription, please purchase to post jobs'));
				exit;
			}
		}
		else {
			echo json_encode(array('code' => 0, 'message' => 'You have no active subscription, please purchase to post jobs'));
			exit;
		}

        if ($this->validate_job_post()) {
            $job_post_form = $this->input->post();
            try {
                if (isset($job_post_form['tags'])) {
                    $skill_tags = $job_post_form['tags'];
                    unset($job_post_form['tags']);
                }

                $job_post_form['job_post_employer_id'] = $_SESSION['company_id'];
                $job_post_form['job_post_made_by'] = $_SESSION['user_id'];
                $job_post_form['job_post_salary_exchange_rate_vs_usd'] = !empty($job_post_form['job_post_salary_currency']) ? get_exchange_rate('USD', get_currency_iso_code($job_post_form['job_post_salary_currency'])) : NULL;
                $job_post_form['post_status'] = '1';

                $this->db->trans_begin();

                if (isset($job_post_form['job_post_id']) && !empty($job_post_form['job_post_id'])){
                    $this->employer_job_post_model->update_post($job_post_form['job_post_id'], $job_post_form);
                    $this->employer_job_post_model->update_tags($job_post_form['job_post_id']);
                    $job_tag['job_post_id'] = $job_post_form['job_post_id'];
                }
                else{
                    $job_tag['job_post_id'] = $this->employer_job_post_model->save_job_post($job_post_form);
                }



                if (isset($skill_tags)) {
                    foreach ($skill_tags as $tag) {
                        $job_tag['job_post_skill_tag'] = $tag;
                        $this->employer_job_post_model->add_job_post_tags($job_tag);
                    }
                }

                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    echo json_encode(array('code' => 0, 'message' => 'Process error, Please try again!'));
                } else {
                    $this->db->trans_commit();
                    echo json_encode(array('id'=>$job_tag['job_post_id'], 'code' => 1, 'message' => 'Posted successfully'));

                }
            } catch (Exception $e) {

                header("HTTP/1.1 401 Bad Request");
                echo json_encode(array('code' => 401, 'message' => $e));
            }
        }
        else {
            header("HTTP/1.1 449 Retry With");
            echo json_encode(array('code' => 449, 'message' => array(validation_errors())));
        }
    }

    function save_draft_post(){
        if ($this->validate_job_post()){
            $job_post_form = $this->input->post();

            try {
                if (isset($job_post_form['tags'])) {
                    $skill_tags = $job_post_form['tags'];
                    unset($job_post_form['tags']);
                }

                $job_post_form['job_post_employer_id'] = $_SESSION['company_id'];
                $job_post_form['job_post_made_by'] = $_SESSION['user_id'];
                $job_post_form['job_post_salary_exchange_rate_vs_usd'] = !empty($job_post_form['job_post_salary_currency']) ? get_exchange_rate('USD', get_currency_iso_code($job_post_form['job_post_salary_currency'])) : NULL;
                $job_post_form['post_status'] = '3';


                $this->db->trans_begin();

                if (isset($job_post_form['job_post_id']) && !empty($job_post_form['job_post_id'])){
                    $this->employer_job_post_model->update_post($job_post_form['job_post_id'], $job_post_form);
                    $this->employer_job_post_model->update_tags($job_post_form['job_post_id']);
                    $job_tag['job_post_id'] = $job_post_form['job_post_id'];
                }
                else{
                    $job_tag['job_post_id'] = $this->employer_job_post_model->save_job_post($job_post_form);
                }

//                $job_tag['job_post_id'] = $this->employer_job_post_model->save_job_post($job_post_form);

                if (isset($skill_tags)) {
                    foreach ($skill_tags as $tag) {
                        $job_tag['job_post_skill_tag'] = $tag;
                        $this->employer_job_post_model->add_job_post_tags($job_tag);
                    }
                }

                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    echo json_encode(array('code' => 0, 'message' => 'Process error, Please try again!'));
                } else {
                    $this->db->trans_commit();
                    echo json_encode(array('id' => $job_tag['job_post_id'], 'code' => 1, 'message' => 'Draft saved successfully'));

                }
            } catch (Exception $e) {

                header("HTTP/1.1 401 Bad Request");
                echo json_encode(array('code' => 401, 'message' => $e));
            }
        }
        else{
            header("HTTP/1.1 449 Retry With");
            echo json_encode(array('code' => 449, 'message' => array(validation_errors())));
        }
    }

    function validate_job_post(){
        $config = array(
            array(
                'field' => 'job_post_title',
                'label' => 'Title',
                'rules' => 'trim|required|xss_clean',
                'errors' => array(
                    'required' => 'Required',
                ),
            ),
            array(
                'field' => 'job_post_job_type',
                'label' => 'Job Type',
                'rules' => 'trim|required|xss_clean',
                'errors' => array(
                    'required' => 'Required',
                ),
            ),
            array(
                'field' => 'job_post_job_category',
                'label' => 'Category',
                'rules' => 'trim|required|xss_clean',
                'errors' => array(
                    'required' => 'Required',
                ),
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            return FALSE;
//            header("HTTP/1.1 449 Retry With");
//            echo json_encode(array('code' => 449, 'message' => array(validation_errors())));
        }
        else {
            return TRUE;
        }
    }

    function view_active_job_posts(){

        $data['page_title'] = 'Active Job Posts';
        $data['active_job_posts'] = $this->employer_job_post_model->get_active_jobs($_SESSION['company_id']);
        $data['main_content'] = 'employer/employer_job_post_live';
        //load main content page
        $this->load->view('templates/template_employer', $data);

    }

	function view_expired_job_posts(){

		$data['page_title'] = 'Active Job Posts';
		$data['active_job_posts'] = $this->employer_job_post_model->get_expired_jobs($_SESSION['company_id']);
		$data['main_content'] = 'employer/employer_job_post_expired';
		//load main content page
		$this->load->view('templates/template_employer', $data);

	}


	function ats_setup_exam(){

		$data['page_title'] = 'Set up Exam';
		$data['active_job_posts'] = $this->employer_job_post_model->get_active_jobs($_SESSION['company_id']);

		$data['main_content'] = 'employer/ats_employer_setup_exam';
		//load main content page
		$this->load->view('templates/template_employer', $data);
	}

	function ats_overall_data_add(){
		$data['ats_rate']=$this->input->get('ats');
		$data['exam_rate']=$this->input->get('exam');
		$data['overall_rate']=$this->input->get('overall');
		$data['status']=$this->input->get('status');
		$data['emp_id']=$this->input->get('emp_id');
		$data['form_id']=$this->input->get('form_id');
		$data['create_date']=date('Y-m-d');

		$job_tag['id_ats_exam_master'] = $this->employer_job_post_model->ats_overall_data_add($data);
		echo json_encode(array('id' => $job_tag['id_ats_exam_master'], 'code' => 1, 'message' => 'Saved successfully'));
	}

	function ats_exam_ctg(){
		$data['applications'] = $this-> employer_application_model->ats_exam_ctg($this->input->get('id'));
////		----------------------------------------------------------------------------
		echo json_encode($data);
	}

	function ats_exam_delete(){
		$data['applications'] =$this-> employer_application_model->ats_exam_delete($this->input->get('id'));
		echo json_encode($data);
	}

	function ats_setup_exam_maker(){

		$data['page_title'] = 'Active Job Posts';
		$data['active_job_posts'] = $this->employer_job_post_model->get_active_jobs($_SESSION['company_id']);

		$data['main_content'] = 'employer/ats_employer_setup_exam_maker';
		//load main content page
		$this->load->view('templates/template_employer', $data);

	}

	function ats_setup_exam_maker_mark(){

    	$data['page_title'] = 'Active Job Posts';
		$data['active_job_posts'] = $this->employer_job_post_model->get_active_jobs($_SESSION['company_id']);
		$data['main_content'] = 'employer/ats_employer_setup_exam_maker_mark';
		//load main content page
		$this->load->view('templates/template_employer', $data);
	}


	function ats_setup_exam_view(){

		$data['page_title'] = 'Active Job Posts';
		$data['active_job_posts'] = $this->employer_job_post_model->get_active_jobs($_SESSION['company_id']);

		$data['main_content'] = 'employer/ats_employer_setup_exam_view';
		//load main content page
		$this->load->view('templates/template_employer', $data);
	}

	function ats_setup_exam_maker_next(){

		$data['page_title'] = 'Set up Exam';
		$data['active_job_posts'] = $this->employer_job_post_model->get_active_jobs($_SESSION['company_id']);
		$data['main_content'] = 'employer/ats_employer_setup_exam_maker_next';
		//load main content page
		$this->load->view('templates/template_employer', $data);

	}

	function ats_setup_exam_maker_result(){

		$data['page_title'] = 'ATS Result';
		$data['active_job_posts'] = $this->employer_job_post_model->get_active_jobs($_SESSION['company_id']);
		$data['main_content'] = 'employer/ats_employer_setup_exam_maker_result';
		//load main content page
		$this->load->view('templates/template_employer', $data);

	}

	function ats_result(){
		$data['page_title'] = 'ATS Result';
		$data['active_job_posts'] = $this->employer_job_post_model->get_active_jobs($_SESSION['company_id']);
		$data['main_content'] = 'employer/ats_result';
		//load main content page
		$this->load->view('templates/template_employer', $data);
	}




	function ats_ats_Interviewee(){
		$data['page_title'] = 'ATS Interviewee';
//		$data['active_job_posts'] = $this->employer_job_post_model->get_active_jobs($_SESSION['company_id']);
		$data['active_job_posts'] = $this->employer_job_post_model->get_active_jobs_schedule($_SESSION['company_id']);
		$data['main_content'] = 'employer/ats_employer_setup_exam_interviewee';
		//load main content page
		$this->load->view('templates/template_employer', $data);
	}

	function ats_interviewee_list(){
		$data['page_title'] = 'ATS interviewee list';

		$data['active_job_posts'] = $this->employer_job_post_model->ats_interviewee_list($_SESSION['user_id']);
		$data['main_content'] = 'employer/ats_interviewee_list';
		//load main content page
		$this->load->view('templates/template_employer', $data);
	}

	function ats_interviewee_form(){
		$data['page_title'] = 'ATS interviewee form';
		$data['active_job_posts'] = $this->employer_job_post_model->ats_interviewee_form($_SESSION['company_id']);
		$data['main_content'] = 'employer/ats_interviewee_form';
		//load main content page
		$this->load->view('templates/template_employer', $data);
	}

	function ats_interviewee_offer_latter(){
		$data['page_title'] = 'ATS Offer Letter';
		$data['active_job_posts'] = $this->employer_job_post_model->ats_interviewee_offer_latter($_SESSION['company_id']);
		$data['main_content'] = 'employer/ats_interviewee_offer_latter';
		//load main content page
		$this->load->view('templates/template_employer', $data);
	}

	function ats_interviewee_form_details(){
		$data['page_title'] = 'ATS interviewee form Details';
		$data['active_job_posts'] = $this->employer_job_post_model->ats_interviewee_form_detail($_SESSION['user_id']);
		$data['main_content'] = 'employer/ats_interviewee_form_details';
		//load main content page
		$this->load->view('templates/template_employer', $data);


	}

	function ats_interviewee_form_maker(){
		$data['page_title'] = 'ATS interviewee form maker';
		$data['active_job_posts'] = $this->employer_job_post_model->ats_interviewee_form($_SESSION['company_id']);
		$data['main_content'] = 'employer/ats_interviewee_form_maker';
		//load main content page
		$this->load->view('templates/template_employer', $data);
	}

	function ats_interviewee_offer_latter_maker(){
		$data['page_title'] = 'ATS Setup Offer Letter';
		$data['active_job_posts'] = $this->employer_job_post_model->ats_interviewee_form($_SESSION['company_id']);
		$data['main_content'] = 'employer/ats_interviewee_offer_latter_maker';
		//load main content page
		$this->load->view('templates/template_employer', $data);
	}

	function ats_interviewee_form_maker_view(){
		$data['page_title'] = 'ATS interviewee form maker view';
		$data['active_job_posts'] = $this->employer_job_post_model->ats_interviewee_form_view($_SESSION['company_id']);
		$data['main_content'] = 'employer/ats_interviewee_form_maker_view';
		//load main content page
		$this->load->view('templates/template_employer', $data);
	}


	function ats_post_job(){
		$data['page_title'] = 'Post Jobs';
		$data['active_job_posts'] = $this->employer_job_post_model->get_active_jobs($_SESSION['company_id']);

		$data['main_content'] = 'employer/ats_employer_job_post';
		//load main content page
		$this->load->view('templates/template_employer', $data);
	}

	function ats_post_job_ats_filter(){

		$data['page_title'] = 'Ats Filter';
		$data['active_job_posts'] = $this->employer_job_post_model->get_active_jobs($_SESSION['company_id']);

		$data['main_content'] = 'employer/ats_employer_job_post_ats_filter';
		//load main content page
		$this->load->view('templates/template_employer', $data);
	}

	function ats_exam_save(){
    	//title:title,Hrs:Hrs,Min:Min,from:from,to:to,level:level
		$job_post_form['title']=$this->input->get('title');
		$job_post_form['Hrs']=$this->input->get('Hrs');
		$job_post_form['Min']=$this->input->get('Min');
		$job_post_form['from']=$this->input->get('from');
		$job_post_form['to']=$this->input->get('to');
		$job_post_form['level']=$this->input->get('level');
		$job_post_form['status']=$this->input->get('status');
		$job_post_form['company_id']=$_SESSION['company_id'];
		$job_post_form['create_date']=date('Y-m-d H:i:s');


		$isSavedId=$this->input->get('isSave');
		if($isSavedId==0) {
			//Saved Master Data
			$job_post_form['is_delete']=0;
			$job_tag['id_ats_exam_master'] = $this->employer_job_post_model->ats_exam_save($job_post_form);
			echo json_encode(array('id' => $job_tag['id_ats_exam_master'], 'code' => 1, 'message' => 'Saved successfully'));
		}else{
			//update Master Data
			$job_tag['id_ats_exam_master']=$isSavedId;
			$job_tag['id_ats_exam_master'] = $this->employer_job_post_model->ats_update($job_tag['id_ats_exam_master'], $job_post_form);
			echo json_encode(array('id' => $job_tag['id_ats_exam_master'], 'code' => 1, 'message' => 'Saved successfully'));
		}
	}

	function ats_form_save(){
		//title:title,Hrs:Hrs,Min:Min,from:from,to:to,level:level
		$job_post_form['description']=$this->input->get('title');
		$job_post_form['status']=$this->input->get('status');
		$job_post_form['company_id']=$_SESSION['company_id'];
		$job_post_form['create_date']=date('Y-m-d H:i:s');


		$isSavedId=$this->input->get('isSave');
		if($isSavedId==0) {
			//Saved Master Data
			$job_post_form['is_delete']=0;
			$job_tag['id_ats_exam_master'] = $this->employer_job_post_model->ats_form_save($job_post_form);
			echo json_encode(array('id' => $job_tag['id_ats_exam_master'], 'code' => 1, 'message' => 'Saved successfully'));
		}else{
			//update Master Data
			$job_tag['id_ats_exam_master']=$isSavedId;
			$job_tag['id_ats_exam_master'] = $this->employer_job_post_model->ats_update_form($job_tag['id_ats_exam_master'], $job_post_form);
			echo json_encode(array('id' => $job_tag['id_ats_exam_master'], 'code' => 1, 'message' => 'Saved successfully'));
		}
	}

	function ats_offer_latter_save(){
		//title:title,Hrs:Hrs,Min:Min,from:from,to:to,level:level
		$job_post_form['description']=$this->input->get('title');
		$job_post_form['status']=$this->input->get('status');
		$job_post_form['company_id']=$_SESSION['company_id'];
		$job_post_form['create_date']=date('Y-m-d H:i:s');

		$job_post_form['date']=$this->input->get('date');
		$job_post_form['subject']=$this->input->get('subject');
		$job_post_form['salutation']=$this->input->get('salutation');
		$job_post_form['header']=$this->input->get('header');
		$job_post_form['footer']=$this->input->get('footer');
		$job_post_form['signature']=$this->input->get('signature');
		$job_post_form['position']=$this->input->get('position');


		$isSavedId=$this->input->get('isSave');
		if($isSavedId==0) {
			//Saved Master Data
			$job_post_form['is_delete']=0;
			$job_tag['id_ats_exam_master'] = $this->employer_job_post_model->ats_offer_latter_save($job_post_form);
			echo json_encode(array('id' => $job_tag['id_ats_exam_master'], 'code' => 1, 'message' => 'Saved successfully'));
		}else{
			//update Master Data
			$job_tag['id_ats_exam_master']=$isSavedId;
			$job_tag['id_ats_exam_master'] = $this->employer_job_post_model->ats_offer_latter_update($job_tag['id_ats_exam_master'], $job_post_form);
			echo json_encode(array('id' => $job_tag['id_ats_exam_master'], 'code' => 1, 'message' => 'Saved successfully'));
		}


	}

	function ats_emp_schedule_exam(){

		$job_post_form['strat_time_hr']=$this->input->get('st_time');
		$job_post_form['strat_time_min']=$this->input->get('st_time_end');
		$job_post_form['duration_hr']=$this->input->get('du_time');
		$job_post_form['duration_min']=$this->input->get('du_time_end');
		$job_post_form['date']=$this->input->get('date');
		$job_post_form['location']=$this->input->get('location');
		$job_post_form['room_no']=$this->input->get('room_no');
		$job_post_form['interviewer']=$this->input->get('interviewer');
		$job_post_form['confirmation_link']=$this->input->get('interviewer');
		$job_post_form['status_confirm']=0;
		$job_post_form['create_date']=date('Y-m-d H:i:s');
		$job_post_form['emp_id']=$this->input->get('emp_id');
		$job_post_form['user_id']=$_SESSION['user_id'];
		$job_post_form['job_post_id']=$this->input->get('job_post_id');

//ats_exam_save
//		$job_post_form['is_delete']=0;
		$job_tag['id_ats_exam_master'] = $this->employer_job_post_model->ats_emp_schedule_exam($job_post_form);
		echo json_encode(array('id' => $job_tag['id_ats_exam_master'], 'code' => 1, 'message' => 'Saved successfully'));
	}


	function ats_save_interviewer(){


//		if($this->input->get('isSave')=='')
//		{

			//ats_interviewer_list//id_list
	    	$id_list = $this->input->get('id_list');
			if($id_list==null || $id_list=="") {
				$job_post_form['name'] = $this->input->get('name_interviewer');
				$job_post_form['position'] = $this->input->get('position_interviewer');
				$job_post_form['user_id'] = $_SESSION['user_id'];
				$job_post_form['contact_number'] = $this->input->get('contact_interviewer');
				$job_tag['idinterviewer_list'] = $this->employer_job_post_model->ats_save_interviewer($job_post_form);
				echo json_encode(array('id' => $job_tag['idinterviewer_list'], 'code' => 1, 'message' => 'Saved successfully'));
			}else{
				$job_post_form['name'] = $this->input->get('name_interviewer');
				$job_post_form['position'] = $this->input->get('position_interviewer');
				$job_post_form['user_id'] = $_SESSION['user_id'];
				$job_post_form['contact_number'] = $this->input->get('contact_interviewer');
				$job_tag['idinterviewer_list'] = $this->employer_job_post_model->ats_save_interviewer_update($id_list,$job_post_form);
//				$job_tag['id_ats_interviewee_form_maker'] = $this->employer_job_post_model->ats_interviewer_form_update($job_tag['id_ats_interviewee_form_maker'], $job_post_form);
				echo json_encode(array('id' => $job_tag['idinterviewer_list'], 'code' => 1, 'message' => 'Saved successfully'));

			}
//		}

	}

	function ats_save_interviewer_details(){

		$id_list = $this->input->get('id_list');
		if($id_list==null || $id_list=="") {
			$job_post_form['location'] = $this->input->get('location');
			$job_post_form['room_no'] = $this->input->get('room_no');
			$job_post_form['address_l1'] = $this->input->get('address_l1');
			$job_post_form['address_l2'] = $this->input->get('address_l2');
			$job_post_form['city'] = $this->input->get('city');
			$job_post_form['user_id'] = $_SESSION['user_id'];

			$job_post_form['idinterviewer_details'] = $this->input->get('id_list');
			$job_tag['idinterviewer_details'] = $this->employer_job_post_model->ats_save_interviewer_details($job_post_form);
			echo json_encode(array('id' => $job_tag['idinterviewer_details'], 'code' => 1, 'message' => 'Saved successfully'));
		}else{
			$job_post_form['location'] = $this->input->get('location');
			$job_post_form['room_no'] = $this->input->get('room_no');
			$job_post_form['address_l1'] = $this->input->get('address_l1');
			$job_post_form['address_l2'] = $this->input->get('address_l2');
			$job_post_form['city'] = $this->input->get('city');
			$job_post_form['user_id'] = $_SESSION['user_id'];
			$job_tag['idinterviewer_details'] = $this->employer_job_post_model->ats_save_interviewer_update_details($id_list,$job_post_form);
//				$job_tag['id_ats_interviewee_form_maker'] = $this->employer_job_post_model->ats_interviewer_form_update($job_tag['id_ats_interviewee_form_maker'], $job_post_form);
			echo json_encode(array('id' => $job_tag['idinterviewer_details'], 'code' => 1, 'message' => 'Saved successfully'));

		}

	}


	function ats_delete_interviewer(){

		$id_list = $this->input->get('id_list');
		$job_tag['idinterviewer_details'] = $this->employer_job_post_model->ats_delete_interviewer($id_list);
		echo json_encode(array('id' => $job_tag['idinterviewer_details'], 'code' => 1, 'message' => 'Saved successfully'));

	}

	function ats_delete_interviewer_form(){

		$id_list = $this->input->get('id_list');
		$job_tag['idinterviewer_details'] = $this->employer_job_post_model->ats_delete_interviewer_form($id_list);
		echo json_encode(array('id' => $job_tag['idinterviewer_details'], 'code' => 1, 'message' => 'Saved successfully'));

	}

	function ats_delete_interviewer_offer_latter(){

		$id_list = $this->input->get('id_list');
		$job_tag['idinterviewer_details'] = $this->employer_job_post_model->ats_delete_interviewer_offer_latter($id_list);
		echo json_encode(array('id' => $job_tag['idinterviewer_details'], 'code' => 1, 'message' => 'Saved successfully'));

	}

	function ats_delete_interviewer_details(){
		$id_list = $this->input->get('id_list');
		$job_tag['idinterviewer_details'] = $this->employer_job_post_model->ats_delete_interviewer_details($id_list);
		echo json_encode(array('id' => $job_tag['idinterviewer_details'], 'code' => 1, 'message' => 'Saved successfully'));

	}

	function get_data_emp_mcq(){
    	$emp_id=$this->input->get('emp_id');
		$examIDD=$this->input->get('examIDD');
		$count=get_data_emp_mcq($emp_id,$examIDD);
		echo json_encode(array('id' => $count, 'code' => 1, 'message' => 'Saved successfully'));
	}

	function get_data_emp_short_answer(){
		$emp_id=$this->input->get('emp_id');
		$examIDD=$this->input->get('examIDD');
		$count=get_data_emp_short_answer($emp_id,$examIDD);
		echo json_encode(array('id' => $count, 'code' => 1, 'message' => 'Saved successfully'));
	}

	function get_tot_percentage(){
		$emp_id=$this->input->get('emp_id');
		$examIDD=$this->input->get('examIDD');
		$count=get_tot_percentage($emp_id,$examIDD);
		echo json_encode(array('id' => $count, 'code' => 1, 'message' => 'Saved successfully'));
	}

	function ats_interviewee_form_maker_save(){
		$id_ats_interviewee_form_maker=$this->input->get('id_ats_interviewee_form_maker');
		if($id_ats_interviewee_form_maker=='' || $id_ats_interviewee_form_maker==null) {
			//save
			$job_post_form['description'] = $this->input->get('title_form');
			$job_post_form['text'] = $this->input->get('title_content');
			$job_post_form['create_date'] = date('Y-m-d H:i:s');
			$job_post_form['status'] = "Active";
			//ats_interviewer_form ats_save_interviewer create_date status
			$job_tag['id_ats_interviewer_form'] = $this->employer_job_post_model->ats_interviewer_form($job_post_form);
			echo json_encode(array('id' => $job_tag['id_ats_interviewer_form'], 'code' => 1, 'message' => 'Saved successfully'));
		}else{
			//update query
			$job_tag['id_ats_interviewee_form_maker']=$id_ats_interviewee_form_maker;
			$job_post_form['description'] = $this->input->get('title_form');
			$job_post_form['text'] = $this->input->get('title_content');
			$job_post_form['create_date'] = date('Y-m-d H:i:s');
			$job_post_form['status'] = "Active";
			$job_tag['id_ats_interviewee_form_maker'] = $this->employer_job_post_model->ats_interviewer_form_update($job_tag['id_ats_interviewee_form_maker'], $job_post_form);
			echo json_encode(array('id' => $job_tag['id_ats_exam_master'], 'code' => 1, 'message' => 'Saved successfully'));
		}
	}

	function ats_exam_assing_job(){
		//title:title,Hrs:Hrs,Min:Min,from:from,to:to,level:level
		$job_post_form['jobid']=$this->input->get('jobid');
		$job_post_form['exam_id']=$this->input->get('exam_id');


//		$isSavedId=$this->input->get('isSave');
//		if($isSavedId==0) {
			//Saved Master Data
			$job_tag['id_ats_exam_master'] = $this->employer_job_post_model->ats_exam_assing_job($job_post_form);

			echo json_encode(array('id' => $job_tag['id_ats_exam_master'], 'code' => 1, 'message' => 'Saved successfully'));
//		}else{
//			//update Master Data
//			$job_tag['id_ats_exam_master']=$isSavedId;
//			$job_tag['id_ats_exam_master'] = $this->employer_job_post_model->ats_update($job_tag['id_ats_exam_master'], $job_post_form);
//			echo json_encode(array('id' => $job_tag['id_ats_exam_master'], 'code' => 1, 'message' => 'Saved successfully'));
//		}
	}
	function ats_exam_assing_emp(){
		//emp_id: emp_id,job_id:job_id,from:from,to:to,status:status
		$job_post_form['emp_id']=$this->input->get('emp_id');
		$job_post_form['job_id']=$this->input->get('job_id');
		$job_post_form['from']=$this->input->get('from');
		$job_post_form['to']=$this->input->get('to');
		$job_post_form['status']=$this->input->get('status');
		$job_post_form['create_date']=date('Y-m-d H:i:s');
		$job_post_form['exam_id']=$this->input->get('checkedExam_id');
		$job_tag['id_ats_exam_master'] = $this->employer_job_post_model->ats_exam_assing_emp($job_post_form);
		echo json_encode(array('id' => $job_tag['id_ats_exam_master'], 'code' => 1, 'message' => 'Saved successfully'));
	}

	function ats_interview_confirm(){
		$subs_data['id']=$this->input->get('id');
		$data['status_confirm']=1;
		$subs_id = $this->employer_job_post_model->ats_interview_confirm($subs_data['job_alert_id'], $data);
	}






	function ats_question_save(){

		$job_post_form['type']=$this->input->get('question_type');
		$job_post_form['question']=$this->input->get('Question');
		$job_post_form['id_ats_exam_master']=$this->input->get('id_exam');
		$job_post_form['mark']=$this->input->get('mark');
		$job_post_form['status']=1;
		$q_idd=$this->input->get('q_idd');

		if($q_idd==null ||  $q_idd=="") {
			//		ats_question_save
			$job_tag['id_ats_exam_question'] = $this->employer_job_post_model->ats_question_save($job_post_form);
			$job_post_answer['id_ats_exam_question']=$job_tag['id_ats_exam_question'];
		}else{
			$job_tag['id_ats_exam_question'] = $this->employer_job_post_model->ats_question_update($job_post_form,$q_idd);
			//delete all answers..
			$this->employer_job_post_model->ats_answer_delete($q_idd);
			$job_post_answer['id_ats_exam_question']=$q_idd;
		}

		$job_post_answer['status']=1;
		if($this->input->get('answer_001')!=""){
			$job_post_answer['answer']=$this->input->get('answer_001');
			$job_post_answer['isCorrect']=$this->input->get('answer_001_check');
			$this->employer_job_post_model->ats_answer_save($job_post_answer);
		}
		if($this->input->get('answer_002')!="") {
			$job_post_answer['answer'] = $this->input->get('answer_002');
			$job_post_answer['isCorrect']=$this->input->get('answer_002_check');
			$this->employer_job_post_model->ats_answer_save($job_post_answer);
		}
		if($this->input->get('answer_003')!="") {
			$job_post_answer['answer'] = $this->input->get('answer_003');
			$job_post_answer['isCorrect']=$this->input->get('answer_003_check');
			$this->employer_job_post_model->ats_answer_save($job_post_answer);
		}
		if($this->input->get('answer_004')!="") {
			$job_post_answer['answer'] = $this->input->get('answer_004');
			$job_post_answer['isCorrect']=$this->input->get('answer_004_check');
			$this->employer_job_post_model->ats_answer_save($job_post_answer);
		}

		echo json_encode(array('id' => $job_tag['id_ats_exam_question'], 'code' => 1, 'message' => 'Saved successfully'));

	}


	//  $this->employer_job_post_model->delete_draft_job($req_id['jp_id']);
	function ats_question_delete(){
		$job_post_form['id_ats_exam_question']=$this->input->get('id_q_master');
		$this->employer_job_post_model->ats_question_delete($job_post_form['id_ats_exam_question']);
		echo json_encode(array('id' => $job_post_form['id_ats_exam_question'], 'code' => 1, 'message' => 'Saved successfully'));
	}

	function ats_question_load(){
		$job_post_form['id_ats_exam_question']=$this->input->get('id_q_master');
		$job_post_form['q_id']=$this->employer_job_post_model->ats_question_load($job_post_form['id_ats_exam_question']);
		echo json_encode(array('id' => $job_post_form['q_id'], 'code' => 1, 'message' => 'Saved successfully'));
	}

	function ats_question_form_delete(){
		$job_post_form['id_ats_exam_question']=$this->input->get('id_q_master');
		$this->employer_job_post_model->ats_question_form_delete($job_post_form['id_ats_exam_question']);
		echo json_encode(array('id' => $job_post_form['id_ats_exam_question'], 'code' => 1, 'message' => 'Saved successfully'));

	}

	function ats_question_offer_latter_delete(){
		$job_post_form['id_ats_exam_question']=$this->input->get('id_q_master');
		$this->employer_job_post_model->ats_question_offer_latter_delete($job_post_form['id_ats_exam_question']);
		echo json_encode(array('id' => $job_post_form['id_ats_exam_question'], 'code' => 1, 'message' => 'Saved successfully'));

	}

	function load_profile(){
		$id=$this->input->get('emp_id');
		$result = $this->employer_job_post_model->ats_load_profile($id);

		echo json_encode(array('error' => 0, 'message' => 'record not found', 'output' => $result));

	}



	function ats_question_save_form(){

		$job_post_form['type']=$this->input->get('question_type');
		$job_post_form['question']=$this->input->get('Question');
		$job_post_form['id_ats_exam_master']=$this->input->get('id_exam');
		$job_post_form['status']=1;
		$hidden_q=$this->input->get('hidden_q');
		if($this->input->get('hidden_q')=='') {
			//		ats_question_save
			$job_tag['id_ats_exam_question'] = $this->employer_job_post_model->ats_question_save_form($job_post_form);

			$job_post_answer['id_ats_exam_question'] = $job_tag['id_ats_exam_question'];
			$job_post_answer['status'] = 1;
			if ($this->input->get('answer_001') != "") {
				$job_post_answer['answer'] = $this->input->get('answer_001');
				$job_post_answer['isCorrect'] = $this->input->get('answer_001_check');
				$this->employer_job_post_model->ats_answer_save_form($job_post_answer);
			}
			if ($this->input->get('answer_002') != "") {
				$job_post_answer['answer'] = $this->input->get('answer_002');
				$job_post_answer['isCorrect'] = $this->input->get('answer_002_check');
				$this->employer_job_post_model->ats_answer_save_form($job_post_answer);
			}
			if ($this->input->get('answer_003') != "") {
				$job_post_answer['answer'] = $this->input->get('answer_003');
				$job_post_answer['isCorrect'] = $this->input->get('answer_003_check');
				$this->employer_job_post_model->ats_answer_save_form($job_post_answer);
			}
			if ($this->input->get('answer_004') != "") {
				$job_post_answer['answer'] = $this->input->get('answer_004');
				$job_post_answer['isCorrect'] = $this->input->get('answer_004_check');
				$this->employer_job_post_model->ats_answer_save_form($job_post_answer);
			}
		}else{
			$job_post_form['id_ats_exam_question2']=$this->input->get('hidden_q');
			$this->employer_job_post_model->ats_question_delete($job_post_form['id_ats_exam_question2']);
			//		ats_question_save
//			$job_tag['id_ats_exam_question'] = $this->employer_job_post_model->ats_question_save_form($job_post_form);
//
//			$job_post_answer['id_ats_exam_question'] = $job_tag['id_ats_exam_question'];
//			$job_post_answer['status'] = 1;
//			if ($this->input->get('answer_001') != "") {
//				$job_post_answer['answer'] = $this->input->get('answer_001');
//				$job_post_answer['isCorrect'] = $this->input->get('answer_001_check');
//				$this->employer_job_post_model->ats_answer_save_form($job_post_answer);
//			}
//			if ($this->input->get('answer_002') != "") {
//				$job_post_answer['answer'] = $this->input->get('answer_002');
//				$job_post_answer['isCorrect'] = $this->input->get('answer_002_check');
//				$this->employer_job_post_model->ats_answer_save_form($job_post_answer);
//			}
//			if ($this->input->get('answer_003') != "") {
//				$job_post_answer['answer'] = $this->input->get('answer_003');
//				$job_post_answer['isCorrect'] = $this->input->get('answer_003_check');
//				$this->employer_job_post_model->ats_answer_save_form($job_post_answer);
//			}
//			if ($this->input->get('answer_004') != "") {
//				$job_post_answer['answer'] = $this->input->get('answer_004');
//				$job_post_answer['isCorrect'] = $this->input->get('answer_004_check');
//				$this->employer_job_post_model->ats_answer_save_form($job_post_answer);
//			}

		}

		echo json_encode(array('id' => $job_tag['id_ats_exam_question'], 'code' => 1, 'message' => 'Saved successfully'));

	}

	function ats_question_save_offer_latter(){

		$job_post_form['type']=$this->input->get('question_type');
		$job_post_form['question']=$this->input->get('Question');
		$job_post_form['id_ats_exam_master']=$this->input->get('id_exam');
		$job_post_form['value']=$this->input->get('value');
		$job_post_form['status']=1;
		$hidden_q=$this->input->get('hidden_q');
		if($this->input->get('hidden_q')=='') {
			//		ats_question_save
			$job_tag['id_ats_exam_question'] = $this->employer_job_post_model->ats_question_save_offer_latter($job_post_form);

			$job_post_answer['id_ats_exam_question'] = $job_tag['id_ats_exam_question'];
			$job_post_answer['status'] = 1;
			if ($this->input->get('answer_001') != "") {
				$job_post_answer['answer'] = $this->input->get('answer_001');
				$job_post_answer['isCorrect'] = $this->input->get('answer_001_check');
				$this->employer_job_post_model->ats_answer_save_offer_latter($job_post_answer);
			}
			if ($this->input->get('answer_002') != "") {
				$job_post_answer['answer'] = $this->input->get('answer_002');
				$job_post_answer['isCorrect'] = $this->input->get('answer_002_check');
				$this->employer_job_post_model->ats_answer_save_offer_latter($job_post_answer);
			}
			if ($this->input->get('answer_003') != "") {
				$job_post_answer['answer'] = $this->input->get('answer_003');
				$job_post_answer['isCorrect'] = $this->input->get('answer_003_check');
				$this->employer_job_post_model->ats_answer_save_offer_latter($job_post_answer);
			}
			if ($this->input->get('answer_004') != "") {
				$job_post_answer['answer'] = $this->input->get('answer_004');
				$job_post_answer['isCorrect'] = $this->input->get('answer_004_check');
				$this->employer_job_post_model->ats_answer_save_offer_latter($job_post_answer);
			}
		}else{
//			$job_post_form['id_ats_exam_question2']=$this->input->get('hidden_q');
//			$this->employer_job_post_model->ats_question_delete($job_post_form['id_ats_exam_question2']);


		}

		echo json_encode(array('id' => $job_tag['id_ats_exam_question'], 'code' => 1, 'message' => 'Saved successfully'));

	}

	function ats_post_job_load(){

		$id=$this->input->get('id');
//---------------------------------------------------------------------------------------
		$data['job_post'] = $this->employer_application_model->get_job_post($id);
		$data['count'] = $this->employer_application_model->get_bucket_candidate_count($_SESSION['company_id'],$id);
		$data['applications'] = $this-> employer_application_model-> get_recieved_applications($_SESSION['company_id'], $id);
////		----------------------------------------------------------------------------
		echo json_encode($data);

	}

	function ats_exam_assing_emp_view(){

		$id=$this->input->get('id');


   		$data['applications'] = $this-> employer_application_model-> get_recieved_applications_emp_exam_done($_SESSION['company_id'], $id);
		echo json_encode($data);

	}

	function ats_overall_data(){
		$id=$this->input->get('id');
		$ctg=$this->input->get('ctg');

		$data['applications'] = $this-> employer_application_model-> ats_overall_data($_SESSION['company_id'], $id,$ctg);
		echo json_encode($data);
	}



	function ats_get_location(){
		$id=$this->input->get('id');
		$data['applications'] = $this-> employer_application_model-> get_location_detail($_SESSION['company_id'], $id);
		echo json_encode($data);
	}

	function ats_get_contact(){
		$id=$this->input->get('id');
		$data['applications'] = $this-> employer_application_model-> get_contact_detail($_SESSION['company_id'], $id);
		echo json_encode($data);
	}

	function ats_exam_schedule_emp_view(){

		$id=$this->input->get('id');
		$data['applications'] = $this-> employer_application_model-> get_recieved_applications_emp_exam_schedule($_SESSION['user_id'], $id);
		$data['drop_data'] = $this-> employer_application_model-> drop_data($_SESSION['company_id'], $id);
		echo json_encode($data);

	}

	function ats_set_doc_data(){

    	$id=$this->input->get('id');
		$data['applications'] = $this-> employer_application_model-> ats_set_doc_data($_SESSION['company_id'], $id);
		echo json_encode($data);

    }


	function ats_exam_summary(){


//---------------------------------------------------------------------------------------

//		var_dump($_SESSION['company_id']);
		$data['applications'] = $this-> employer_application_model->ats_exam_summary($_SESSION['company_id']);
////		----------------------------------------------------------------------------
		echo json_encode($data);


	}

	function ats_exam_summary_level(){
		$level=$this->input->get('level');
		$id_ViewJob=$this->input->get('id_ViewJob');
		$data['applications'] = $this-> employer_application_model->ats_exam_summary_level($_SESSION['company_id'],$level,$id_ViewJob);
		echo json_encode($data);
	}

	function ats_offer_latter_comapny(){
		$data['applications'] = $this-> employer_application_model->ats_offer_latter_comapny($_SESSION['company_id']);
		echo json_encode($data);
	}


	function ats_exam_setup_candidate(){
    	$emp_array=$this->input->get('Employers');
    	$id_ViewJob=$this->input->get('id_ViewJob');
//    	for($i=0;$i<count($emp_array);$i++){
		$data['applications'] = $this-> employer_application_model->ats_save_bucket_candidate($_SESSION['company_id'],$emp_array[0],$id_ViewJob);
//		}
		echo json_encode($data);

	}

	function load_exam(){
		$id=$this->input->get('id');
		$result = $this->employer_job_post_model->ats_paper_view($id);

		echo json_encode(array('error' => 0, 'message' => 'record not found', 'output' => $result));
	}

	function load_exam_form(){
		$id=$this->input->get('id');

		$result = $this->employer_job_post_model->ats_paper_view_form($id);

		echo json_encode(array('error' => 0, 'message' => 'record not found', 'output' => $result));
	}
	function load_exam_offer_later(){
		$id=$this->input->get('id');

		$result = $this->employer_job_post_model->ats_paper_view_offer_later($id);

		echo json_encode(array('error' => 0, 'message' => 'record not found', 'output' => $result));
	}

	function load_exam_form2(){
		$id_shadule=$this->input->get('id_shadule');
		$jobseeker_id=$this->input->get('jobseeker_id');

		$result = $this->employer_job_post_model->ats_paper_view_form2($jobseeker_id,$id_shadule);

		echo json_encode(array('error' => 0, 'message' => 'record not found', 'output' => $result));
	}

	function load_exam_write_answer(){
		$id=$this->input->get('id');
		$emp_id=$this->input->get('emp_id');
		$result = $this->employer_job_post_model->ats_paper_view_write_answer($id,$emp_id);
		echo json_encode(array('error' => 0, 'message' => 'record not found', 'output' => $result));

	}

	function ats_update_short_answer(){
		$input_value=$this->input->get('input_value');
		$attr_ip=$this->input->get('attr_ip');
		$result = $this->employer_job_post_model->ats_update_short_answer($input_value,$attr_ip);
		echo json_encode(array('error' => 0, 'message' => 'record not found', 'output' => $result));

	}

    function view_inactive_job_posts(){

        $data['page_title'] = 'Inactive Job Posts';
        $data['active_job_posts'] = $this->employer_job_post_model->get_inactive_jobs($_SESSION['company_id']);
        $data['main_content'] = 'employer/employer_job_post_inactive';

        //load main content page
        $this->load->view('templates/template_employer', $data);
    }

    function view_drafts_job_posts(){

        $data['page_title'] = 'Draft Job Posts';
        $data['draft_job_posts'] = $this->employer_job_post_model->get_draft_jobs($_SESSION['company_id']);
        $data['main_content'] = 'employer/employer_job_post_draft';

        //load main content page
        $this->load->view('templates/template_employer', $data);
    }

    function post_status_switcher(){
        $post_data = $this->input->post();


        try{
            $res = $this->employer_job_post_model->set_job_post_status($post_data['post_id'],$post_data['is_active']);
            echo json_encode('cv_id='.$res);
        }
        catch (Exception $e){
            echo json_encode($e->getMessage());
        }
    }

    function delete_drafts_job_post(){
        $req_id = $this->input->post();

//        print_r($red_id);
//        exit();

        try {
            $this->db->trans_begin();

            $this->employer_job_post_model->delete_draft_job($req_id['jp_id']);


            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                echo json_encode(array('code'=>1, 'message'=>'Deleted Successfully'));
            }

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
        }

    }

    function upload_job_post_image(){

        $post_id = $this->input->post('job_post_id');
        $emp_id = $_SESSION['company_id'];

        $config['upload_path']          = JOB_POST_IMG_SAVE_DIR;
        $config['allowed_types']        = 'jpg|jpeg|png';
        $config['max_size']             = 5000;
        $config['file_name']            = $emp_id.'_'.$post_id.'_'.time();

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file'))
        {
            return FALSE;
        }
        else
        {
            $file = $this->upload->data();
            $res = $this->employer_job_post_model->update_post($post_id, array('job_post_img_url'=>$file['file_name']));
            echo json_encode($res);
        }
    }

    function delete_post_file_attachment(){
        $resume_id = $this->input->post('p_id');
        try {
            $post_info = $this->employer_job_post_model->get_selected_post($resume_id);

            if (!empty($post_info)){
                $this->db->trans_begin();
                $res = $this->employer_job_post_model->delete_post_file($resume_id);
                if ($this->db->trans_status() === FALSE)
                {
                    $this->db->trans_rollback();
                    echo json_encode(array('code'=>0, 'message' => 'Something went wrong'));
                }
                else
                {
                    $name = JOB_POST_IMG_SAVE_DIR.$post_info['job_post_img_url'];
                    $del_post = unlink($name);
                    if ($del_post == TRUE) {
                        $res = $this->db->trans_commit();
                        echo json_encode(array('code'=>1, 'message' => 'File deleted successfully', 'status' => $res));
                    }
                    else{
                        $this->db->trans_rollback();
                        echo json_encode(array('code'=>0, 'message' => 'Something went wrong'));
                    }
                }
                $this->db->trans_complete();
            }
            else{
                echo json_encode(array("code" => 0, "message" => "Couldn't delete the file, Failed to retrieve data, please try again"));
            }

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
        }
    }

}
