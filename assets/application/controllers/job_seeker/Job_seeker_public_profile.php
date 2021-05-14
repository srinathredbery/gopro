<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 8/20/2018
 * Time: 4:22 PM
 */

class Job_seeker_public_profile extends Main_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('jobseeker_resume_model', 'resume_model');
//        if (isset($_SESSION['logged_in']) && $_SESSION['user_type'])
//            return;
//        else
//            redirect('login');
    }

    public function view_job_seeker_profile()
    {
        $resume_id = $this->input->get('r_id');
        $resume_id =  base64_decode($resume_id);



        //Resume Info
        $resume_info = $this->resume_model->get_resume_info(array('resume_id' => $resume_id));
        $data['resume_data']=$resume_info;

        if (!empty($resume_info['jobseeker_user_id']))
            $data['jobseeker_info'] = $this->resume_model->get_jobseeker_info($resume_info['jobseeker_user_id']);


        //Resume data
        $data['resume_work_exp']=$this->master_dml_model->get_all_data('jobseeker_resume_work_exp', array('resume_id'=>$resume_id, 'hidden'=>'0'), 'start_date DESC');
        $data['resume_skills']=$this->master_dml_model->get_all_data('jobseeker_resume_skill', array('resume_id'=>$resume_id, 'hidden'=>'0'), 'skill_id ASC');
        $data['resume_edus']=$this->master_dml_model->get_all_data_join('jobseeker_resume_education', '*', array('resume_id'=>$resume_id, 'hidden'=>'0'), 'start_date DESC', null, null, 'education_level_master', 'jobseeker_resume_education.edu_level=education_level_master.edu_lvl_id', 'left');
        $data['resume_awards']=$this->master_dml_model->get_all_data('jobseeker_resume_award', array('resume_id'=>$resume_id, 'hidden'=>'0'),'date_of_award DESC' );
        $data['resume_langs']=$this->resume_model->get_job_seeker_resume_language($resume_id);

        $data['main_content'] = 'job_seeker/job_seeker_public_profile.php';

        //load main content page
        $data['page_title'] = !empty($data['jobseeker_info']) ? $data['jobseeker_info']['jobseeker_first_name'].' '.$data['jobseeker_info']['jobseeker_last_name'] : 'Not Found';
        $this->load->view('templates/template_employer', $data);
    }
}
