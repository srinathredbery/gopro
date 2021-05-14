<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 8/17/2018
 * Time: 5:37 PM
 */

class Employer_received_application extends Main_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('employer_application_model');
        if (isset($_SESSION['logged_in']) && $_SESSION['user_type'] == 2) {
            return;
        } else {
            if (!$this->input->is_ajax_request()) {
                redirect('login');
            } else {
                header("HTTP/1.1 401 Authentication Failed");
                $url = redirec_login();
                echo json_encode(array('code' => '401', 'message' =>'Session Expired, Please login again to continue', 're_url'=> $url));
                exit();
            }
        }
    }

    public function view_all_applications()
    {

        $jp_id = $this->input->get();

        $id = !empty($jp_id['jp_id']) ? $jp_id['jp_id'] : null;

        $data['page_title'] = 'Applications';

        if (!empty($id)) {
            $data['job_post'] = $this->employer_application_model->get_job_post($id);
        }

//        $data['venue_list'] = $this->master_dml_model->get_job_post($id);

        $data['applications'] = $this-> employer_application_model-> get_recieved_applications($_SESSION['company_id'], $id);
        $data['main_content'] = 'employer/employer_applications_received';

        //load main content page
        $this->load->view('templates/template_employer', $data);
    }

    public function view_all_applications2()
    {

        $jp_id = $this->input->get();

        $id = !empty($jp_id['jp_id']) ? $jp_id['jp_id'] : null;

        $data['page_title'] = 'Applications';

        if (!empty($id)) {
            $data['job_post'] = $this->employer_application_model->get_job_post($id);
        }

//        $data['venue_list'] = $this->master_dml_model->get_job_post($id);

        $data['applications'] = $this-> employer_application_model-> get_recieved_applications($_SESSION['company_id'], $id);
        $data['main_content'] = 'employer/employer_applications_received';

        //load main content page
        $this->load->view('templates/template_employer', $data);
    }

    public function view_an_application()
    {

        $data['page_title'] = 'Name of Jobseeker';
        $data['main_content'] = 'job_seeker/job_seeker_public_profile.php';

        //load main content page
        $this->load->view('templates/template_employer', $data);
    }

    function view_cover_letter()
    {
        $cover_letter_id = $this -> input -> get();
        if (isset($cover_letter_id['cl_uid'])) {
             $res = $this-> employer_application_model-> get_cover_letter($cover_letter_id['cl_uid']);
            echo json_encode($res);
        }
    }
}
