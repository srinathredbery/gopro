<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 8/21/2018
 * Time: 12:04 PM
 */

class Job_seeker_job_alerts extends Main_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('job_alerts_model', 'job_alert');
		$this->load->model('Jobseeker_find_jobs_model', 'find_jobs');
    }

    function manage_job_alerts(){

		$data['job_type'] = $this->master_dml_model->get_all_data('job_type', array('is_hidden_deleted'=>'0'));
		$data['job_category'] = $this->master_dml_model->get_all_data('job_category', array('is_hidden_deleted'=>'0'));
		$data['job_industry'] = $this->master_dml_model->get_all_data('job_industry', array('is_hidden_deleted'=>'0'));

        $data['job_alerts_list'] = $this->job_alert->get_job_alert_subscriptions($_SESSION['user_id']);
//        $data['alert_key'] = $this->get_job_alerts($data['job_alerts_list']);

        $data['main_content'] = 'job_seeker/job_seeker_job_alerts';

//        load page contents
        $data['page_title'] = 'Mange Job Alerts';
        $this->load->view('templates/template_job_seeker', $data);
    }

    function subscribe_job_alerts(){

		$subs_data = $this->input->post();
        try{
            $data['jobseeker_user_id'] = $_SESSION['user_id'];
            $data['search_job_title'] = $subs_data['job_title'];
            $data['job_industry'] = $subs_data['job_industry'];
            $data['job_category'] = $subs_data['job_category'];
            $data['job_type'] = $subs_data['job_type'];
            $data['frequency'] = $subs_data['subs_frequency'];

            $this->db->trans_begin();

            if (!empty($subs_data['job_alert_id']))
				$subs_id = $this->job_alert->update_alert_frequency($subs_data['job_alert_id'], $data);
            else
				$subs_id = $this->job_alert->create_job_alert($data);

            if ($this->db->trans_status() === FALSE)
            {
                $err = $this->db->trans_rollback();
                echo json_encode(array('code' => 0, 'message' => 'Something went wrong, Alert creation failed.'));
            }
            else
            {
                $res = $this->db->trans_commit();
                echo json_encode(array('code' => 1, 'message' => 'Success.'));

            }
        }
        catch (Exception $e){
            echo json_encode(array('code' => 0, 'message' => 'Something went wrong, Alert creation failed.'));
        }
    }

    function get_job_alerts($alert_list){
        $finalOutput = array();

        foreach ($alert_list as $sub_value){
            $job_alerts_key = $this->job_alert->get_job_alert_keywords($sub_value['job_alert_id']);

            $i = 0;

            foreach ($job_alerts_key as $key){

                $search_area = $key['alert_keyword_search_area'];
                $key_id = $key['alert_keyword'];

                if ($search_area === 'search_key'){

                    $job_alerts_key[$i]['alert_keyword'] = $key['alert_keyword'];
                }
                else{
                    $filter_name = $this->get_name($search_area, $key_id);
                    $job_alerts_key[$i]['alert_keyword'] = $filter_name['search_by_keys'];

                }
                $i++;
            }

            if(!empty($job_alerts_key) || true){
                $finalOutput[] = $job_alerts_key;
            }
        }
        return $finalOutput;
    }



    function get_name($case_s, $id){
        switch ($case_s){
            case 'job_category':
                return $this->job_alert-> get_job_category_name($id);
                break;
            case 'job_type':
                return $this->job_alert-> get_job_type($id);
                break;
        }
    }

    function edit_alert_frequency(){

        $freq = $this->input->post();
        $id = $freq['job_alert_id'];
        $frequency = $freq['subs_frequency'];

        $res = $this->job_alert->update_alert_frequency($id, array('frequency'=>$frequency));

        echo json_encode($res);
    }

    function un_subscribe(){
        $ja_input = $this->input->post();
        $id = $ja_input['ja_i'];

        $res = $this->job_alert->delete_data($id);
        echo json_encode($res);

    }


    function ats_post_job_view(){
    	$data['page_title'] = 'View Exam';
		$data['active_job_posts'] = $this->find_jobs->get_active_jobs_view($_SESSION['user_id']);
		$data['main_content'] = 'job_seeker/ats_seeker_job_post_view';
		//load main content page
		$this->load->view('templates/template_employer', $data);
	}

	function ats_post_job_load(){
		$id=$this->input->get('id');

//---------------------------------------------------------------------------------------
//		$data['job_post'] = $this->find_jobs->get_job_post($id);
		$data['applications'] = $this-> find_jobs-> get_recieved_applications($_SESSION['company_id'], $id);
//----------------------------------------------------------------------------
		echo json_encode($data);
	}

	function ats_exam_summary(){


//---------------------------------------------------------------------------------------
		$job_id=$this->input->get('job_id');
		$data['applications'] = $this-> find_jobs->ats_exam_summary($_SESSION['company_id'],$job_id);
////		----------------------------------------------------------------------------
		echo json_encode($data);


	}

	function ats_exam_do(){
	    	//emp_id: user_id,exam_id:exam_id
			$emp_id=$this->input->get('emp_id');
			$exam_id=$this->input->get('exam_id');
			$count=ats_exam_do_count($emp_id,$exam_id);

			echo json_encode(array('id' => $count, 'code' => 0, 'message' => 'Saved successfully'));


		}

	function ats_setup_exam_maker(){

		$data['page_title'] = 'Active Job Posts';
		$data['active_job_posts'] = $this->find_jobs->get_active_jobs($_SESSION['company_id']);

		$data['main_content'] = 'job_seeker/ats_employer_setup_exam_view';
		//load main content page
		$this->load->view('templates/template_employer', $data);
	}

	function load_exam(){
		$id=$this->input->get('id');
		$result = $this->find_jobs->ats_paper_view($id);



		echo json_encode(array('error' => 0, 'message' => 'record not found', 'output' => $result));
//		$data['main_content'] = 'employer/employer_job_post_inactive';
//
//		//load main content page
//		$this->load->view('templates/template_employer', $data);

	}

	function ats_exam_assing_emp(){
		$job_post_form['ItemArray']=$this->input->get('ItemArray');

        $this->find_jobs->ats_exam_assing_emp($job_post_form);

		echo json_encode(array('id' => 1, 'code' => 1, 'message' => 'Saved successfully'));
    }

    function ats_interview_confirm(){
		$subs_data['id']=$this->input->get('id');
		$data['status_confirm']=1;
		$data['notyfy_status']=1;//notyfy_status
		$this->find_jobs->ats_interview_confirm($subs_data['id'], $data);
	}

}
