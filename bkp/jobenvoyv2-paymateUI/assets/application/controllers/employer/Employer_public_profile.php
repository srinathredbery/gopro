<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 3/5/2019
 * Time: 10:40 AM
 */

class Employer_public_profile extends CI_Controller
{
    public function __construct()
    {
    	parent::__construct();
    	$this->load->model('employer_profile_model', 'emp_model');
    }

    public function view_employer_public_profile()
    {
        $company_id = $this->input->get('org');

        $company_id = base64_decode($company_id);
        $data['company'] = $this->emp_model->get_employer_with_country($company_id);
        $data['job_list'] = $this->emp_model->get_recent_jobs_by_employer($company_id);

        $data['page_title'] = !empty($data['company']['employer_name']) ? $data['company']['employer_name'] : '';
        $data['main_content'] = 'employer/employer_public_profile';

        //load main content page
        $this->load->view('templates/template_main', $data);
    }

}