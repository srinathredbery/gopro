<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 2/11/2019
 * Time: 2:25 PM
 */

class Navigation_control extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('employer_job_post_model', 'emp_job_model');
    }

    function render_employer_side_navigation(){
        $data['side_navigation'] = get_side_navigation(2);
//        print_r($data['side_navigation']);
        $data['side_nav_job_count'] = $this->emp_job_model->get_job_post_count($_SESSION['company_id']);

        $this->load->view('include/side_bar_left_employer.php', $data);
    }

    function render_jobseeker_side_navigation(){
        $data['side_navigation'] = get_side_navigation(2);
//        print_r($data['side_navigation']);
        $data['side_nav_job_count'] = $this->emp_job_model->get_job_post_count($_SESSION['company_id']);

        $this->load->view('include/side_bar_left_job_seeker.php', $data);
    }

    function redirect_dashboard(){
        if (isset($_SESSION['logged_in']) && $_SESSION['user_type']==3)
            redirect("job_seeker/dashboard");
        elseif (isset($_SESSION['logged_in']) && $_SESSION['user_type']==2)
            redirect("employer/dashboard");
        elseif (isset($_SESSION['logged_in']) && $_SESSION['user_type']==1)
            redirect("superuser/dashboard");
		elseif (isset($_SESSION['logged_in']) && $_SESSION['user_type']==4) //user_type 4 is temporary solution for search for user access
			redirect("superuser/candidate_search");
        else
            redirect('login');
    }
}
