<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 8/10/2018
 * Time: 3:25 PM
 */

class Ats_exam extends Main_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('employer_job_post_model');
		$this->load->model('employer_application_model');
    }

















//    -----------------------------Delete After-------------------------
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


	function ats_setup_exam(){

		$data['page_title'] = 'Active Job Posts';
		$data['active_job_posts'] = $this->employer_job_post_model->get_active_jobs($_SESSION['company_id']);

		$data['main_content'] = 'employer/ats_employer_setup_exam';
		//load main content page
		$this->load->view('templates/template_employer', $data);
	}

	function ats_setup_exam_maker(){

		$data['page_title'] = 'Active Job Posts';
		$data['active_job_posts'] = $this->employer_job_post_model->get_active_jobs($_SESSION['company_id']);

		$data['main_content'] = 'employer/ats_employer_setup_exam_maker';
		//load main content page
		$this->load->view('templates/template_employer', $data);
	}

	function ats_post_job(){

		$data['page_title'] = 'Setup Exam';
		$data['active_job_posts'] = $this->employer_job_post_model->get_active_jobs($_SESSION['company_id']);

		$data['main_content'] = 'employer/ats_employer_job_post';
		//load main content page
		$this->load->view('templates/template_employer', $data);
	}

	function ats_post_job_load(){

		$id=$this->input->get('id');
//---------------------------------------------------------------------------------------

		$data['job_post'] = $this->employer_application_model->get_job_post($id);
		$data['applications'] = $this-> employer_application_model-> get_recieved_applications($_SESSION['company_id'], $id);
////		----------------------------------------------------------------------------
		echo json_encode($data);


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
