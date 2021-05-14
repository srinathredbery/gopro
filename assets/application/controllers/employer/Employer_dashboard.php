<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 8/3/2018
 * Time: 4:37 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Employer_dashboard extends Main_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('employer_profile_model');
        $this->load->model('employer_job_post_model', 'job_post_model');

    }

    public function index()
    {

        $data['recent_job_posts'] = $this->job_post_model->get_all_published_job($_SESSION['company_id'], $limit = 5);
        $data['emp_profile'] = $this->employer_profile_model->get_employer_with_country($_SESSION['company_id']);

        $data['page_title'] = 'Dashboard &bull; Employer';
        $data['main_content'] = 'employer/employer_dashboard';

        //load main content page
        $this->load->view('templates/template_employer', $data);
    }
}
