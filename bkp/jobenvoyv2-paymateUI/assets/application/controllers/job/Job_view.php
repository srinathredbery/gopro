<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 8/16/2018
 * Time: 12:43 PM
 */

class Job_view extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('jobs_model');
    }

    function view_job_post(){

        $job_post_id = '';
        $js_id = '';
//        $data['job_already_applied_status'] = null;
        if ( isset($_GET['jp_token']) && !empty($_GET['jp_token'])){
            $job_post_id = base64_decode($_GET['jp_token']);
        }

        if (isset($_SESSION['logged_in'], $_SESSION['user_id']) && $_SESSION['user_type'] == 3){
            $js_id = $_SESSION['user_id'];
        }

        $data['job_post'] = $this->jobs_model->get_job_post($job_post_id);
        $data['job_skill_req'] = $this->jobs_model->get_job_skill_tags($job_post_id);




        if(!empty($data['job_post'])){

            $data['job_already_applied_status'] = check_user_already_applied_for_job($js_id, $job_post_id);

            $data['main_content'] = 'job/job_view';
            //load main content page
            $data['page_title'] = substr($data['job_post']['job_post_title'], 0, 75);
            $this->load->view('templates/template_main', $data);
        }
        else{
            redirect('jobs');
        }
    }
}