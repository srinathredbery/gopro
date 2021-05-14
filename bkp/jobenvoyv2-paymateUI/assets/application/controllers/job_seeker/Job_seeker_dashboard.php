<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 7/30/2018
 * Time: 6:15 PM
 */

class Job_seeker_dashboard extends Main_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('jobseeker_job_application_model', 'application_model');
        $this->load->model('jobseeker_resume_model', 'resume_model');

        if (isset($_SESSION['logged_in']) && $_SESSION['user_type']==3)
            return;
        else
            redirect('login');
        
    }

    public function index()
    {
        if (get_user_type()==3) {

            $js = $this->master_dml_model->get_data('jobseeker', '*', array('jobseeker_user_id' => $_SESSION['user_id']));
            $current_user = $this->master_dml_model->get_data('user', '*', array('user_id' => $_SESSION['user_id']));
            $data['total_no_application'] = $this->application_model->get_total_applications($_SESSION['user_id']);
            $data['current_job'] = $this->resume_model->get_job_seeker_last_job($_SESSION['user_id']);
            unset($current_user['password']);
            $data['js_profile'] = array_merge($current_user, $js);



            $data['main_content'] = 'job_seeker/job_seeker_dashboard';

//        //load main content page
            $data['page_title'] = 'Dashboard &bull; Job Seeker';
            $this->load->view('templates/template_job_seeker', $data);
        }
        else
            redirect(base_url() . 'login');
    }



}
