<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 7/31/2018
 * Time: 11:17 AM
 */

class Job_seeker_profile extends Main_Controller
{
	protected $user_id;
    public function __construct()
    {
        parent::__construct();
		$this->load->model('jobseeker_resume_model', 'resume_model');
		$this->user_id = $this->session->user_id;
    }

    public function job_seeker_view_profile()
    {
		$resume_id = null;
		$resumes = $this->get_all_resumes();
		$cv_id = $this->input->get('cv_id');

		if (empty($resumes)){
			$resume_data['jobseeker_user_id'] = $this->user_id;
			$resume_data['resume_name'] = "My Resume";
			try {

				$this->db->trans_begin();

				$cv_id = $this->master_dml_model->add_data_return_id('jobseeker_resume', $resume_data);

				if ($this->db->trans_status() === FALSE)
				{
					$this->db->trans_rollback();
				}
				else
				{
					$this->db->trans_commit();
				}

				$this->db->trans_complete();

			} catch (Exception $e) {
				$this->db->trans_rollback();
				return $e->getMessage();
			}
		}

		if (empty($cv_id)){
			$resume_id = $resumes[0]['resume_id'];

			if (!empty($resume_id))
				redirect('job_seeker/profile/my_profile?cv_id='.$resume_id);
			else
				redirect('job_seeker');
		}
		else{
			//Protect deleted data access via GET URL parameters
			$key = array_search($cv_id, array_column($resumes, 'resume_id'));

			if ($key > -1 && $resumes[$key]['hidden'] == "0")
				$resume_id = $cv_id;
			else{
				redirect('job_seeker');
			}
		}
    	/*Profile data*/
        $data['js_profile'] = $this->master_dml_model->get_data('jobseeker', '*', array('jobseeker_user_id' => $this->user_id));
        $data['current_user'] = $this->master_dml_model->get_data('user', '*', array('user_id' => $this->user_id));
        unset($data['current_user']['password']);

        /*Resume Data*/
        $data['resume_list'] = $resumes;



		if( isset($resume_id) && !empty($resume_id)){

			//form data
			$data['country_list'] = $this->master_dml_model->get_all_data('country_master');
			$data['job_type'] = $this->master_dml_model->get_all_data('job_type', array('is_hidden_deleted'=>'0'));
			$data['job_category'] = $this->master_dml_model->get_all_data('job_category', array('is_hidden_deleted'=>'0'));
			$data['job_industry'] = $this->master_dml_model->get_all_data('job_industry', array('is_hidden_deleted'=>'0'));
			$data['career_level'] = $this->master_dml_model->get_all_data('career_level');
			$data['salary_range'] = $this->master_dml_model->get_all_data('salary_range');
			$data['education_level'] = $this->master_dml_model->get_all_data('education_level_master');
			$data['experience_level'] = $this->master_dml_model->get_all_data('experience_level');
			$data['language_level'] = $this->master_dml_model->get_all_data('language_level_master', null, 'order ASC');
			$data['languages'] = $this->master_dml_model->get_all_data('language_master', null, 'language_name ASC');

			//Resume Info
			$resume_info = $this->resume_model->get_resume_info(array('resume_id' => $resume_id));
			$data['resume_data']=$resume_info;

			//Resume data
			$data['resume_work_exp']=$this->master_dml_model->get_all_data('jobseeker_resume_work_exp', array('resume_id'=>$resume_id, 'hidden'=>'0'), 'start_date DESC');
			$data['resume_skills']=$this->master_dml_model->get_all_data('jobseeker_resume_skill', array('resume_id'=>$resume_id, 'hidden'=>'0'), 'skill_id ASC');
			$data['resume_edus']=$this->master_dml_model->get_all_data_join('jobseeker_resume_education', '*', array('resume_id'=>$resume_id, 'hidden'=>'0'), 'start_date DESC', null, null, 'education_level_master', 'jobseeker_resume_education.edu_level=education_level_master.edu_lvl_id', 'left');
			$data['resume_awards']=$this->master_dml_model->get_all_data('jobseeker_resume_award', array('resume_id'=>$resume_id, 'hidden'=>'0'),'date_of_award DESC' );
			$data['resume_langs'] =$this->resume_model->get_job_seeker_resume_language($resume_id);

			//load main content page
//			$data['main_content'] = 'job_seeker/job_seeker_new_resume';
//
//			$data['page_title'] = $resume_info['resume_name'].' &bull; Resumes';
//			$this->load->view('templates/template_job_seeker', $data);
		}


        $data['country_list_iso'] = $this->master_dml_model->get_all_data('iso_codes_master');


        $data['main_content'] = 'job_seeker/job_seeker_view_profile'; //set main content page

        //load main content page
        $data['page_title'] = 'Profile &bull; Job Seeker';
        $this->load->view('templates/template_job_seeker', $data);
    }

    function job_seeker_edit_profile()
    {
        try {

            $form_data = $this->input->post();

            $this->db->trans_begin();

            $res = $this->master_dml_model->update_data('jobseeker', array('jobseeker_user_id' => $this->user_id), $form_data);

            $r = $this->db->trans_commit();
            echo json_encode($r, $res);
            return $r;
        } catch (Exception $e) {
            $this->db->trans_rollback();
            return $e->getMessage();
        }
    }

    function upload_profile_pic(){
        try{
            $data = $_POST["image"];

            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);

            $data = base64_decode($image_array_2[1]);

            $imageName = $this->user_id . '_'.time() . '.png';

            $file_dir = USER_PRO_PIC_SAVE_DIR.$imageName;

            $this->db->trans_begin();

            $res = $this->master_dml_model->update_data('jobseeker', array('jobseeker_user_id' => $this->user_id), array('jobseeker_dp_url'=> $imageName));

            $r = $this->db->trans_commit();

            if($r){
                $this->session->set_userdata('jobseeker_dp_url', $imageName);
            }

            file_put_contents($file_dir, $data);

            echo base_url().'uploads/user_dp/'.$imageName;

            return $r;

        }catch (Exception $e ){
            $this->db->trans_rollback();
            return $e->getMessage();
        }
    }

    function get_all_resumes(){
		return $this->resume_model->get_resume_list(array('jobseeker_user_id' => $this->user_id, 'hidden' =>'0'));
	}

	function calculate_resume_fill_status(){
    	$resume = $this->get_all_resumes();
    	$resume_id = !empty($resume[0]['resume_id']) ? $resume[0]['resume_id'] : false ;

		$resume_rate = 0;
		$profile_rate = 0;
		$overall = 0;

    	if ($resume_id){
			$resume_content['resume_about']=$resume_about = $resume[0]['about_description'];
			$resume_content['resume_work_exp']=$this->master_dml_model->get_all_data('jobseeker_resume_work_exp', array('resume_id'=>$resume_id, 'hidden'=>'0'), 'start_date DESC');
			$resume_content['resume_skills']=$this->master_dml_model->get_all_data('jobseeker_resume_skill', array('resume_id'=>$resume_id, 'hidden'=>'0'), 'skill_id ASC');
			$resume_content['resume_edus']=$this->master_dml_model->get_all_data_join('jobseeker_resume_education', '*', array('resume_id'=>$resume_id, 'hidden'=>'0'), 'start_date DESC', null, null, 'education_level_master', 'jobseeker_resume_education.edu_level=education_level_master.edu_lvl_id', 'left');
			$resume_content['resume_awards']=$this->master_dml_model->get_all_data('jobseeker_resume_award', array('resume_id'=>$resume_id, 'hidden'=>'0'),'date_of_award DESC' );
			$resume_content['resume_langs'] =$this->resume_model->get_job_seeker_resume_language($resume_id);

			$c = 0;

			foreach ($resume_content as $content){
				if (!empty($content)){
					$resume_rate++; $c++;
				}
				else
					$c++;
			}
			$resume_rate = round(($resume_rate/$c)*100);
		}
		$profile = $data['js_profile'] = $this->master_dml_model->get_data('jobseeker', '*', array('jobseeker_user_id' => $this->user_id));
		unset(
			$profile['jobseeker_id'],
			$profile['jobseeker_user_id'],
			$profile['jobseeker_privacy'],
			$profile['jobseeker_cv_searchable'],
			$profile['jobseeker_url'],
			$profile['jobseeker_image'],
			$profile['jobseeker_salutation'],
			$profile['jobseeker_country_code_work'],
			$profile['jobseeker_country_code_work_phone_idd'],
			$profile['jobseeker_work_phone'],
			$profile['jobseeker_featured'],
			$profile['jobseeker_newsletter'],
			$profile['joined_date']
		);

		$c = 0;

		foreach ($profile as $item){
			if (!empty($item)){
				$profile_rate++; $c++;
			}
			else
				$c++;
		}

		$profile_rate = round(($profile_rate/$c)*100);

		$overall = round(($profile_rate + $resume_rate) / 2);
		echo json_encode(array('profile'=>$profile_rate, 'resume'=>$resume_rate, 'overall' => $overall), JSON_PRETTY_PRINT);

	}

}
