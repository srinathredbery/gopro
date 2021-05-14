<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 8/21/2018
 * Time: 11:55 AM
 */

class Job_seeker_find_jobs extends Main_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('Jobseeker_find_jobs_model', 'find_jobs');
    }

    function view_shortlisted_jobs()
    {

    	$user_id = $this->session->user_id;
    	$page_no = $this->input->get('per_page');
    	$page_no = isset($page_no) ? $page_no : 1 ;
		$limit_rows = $this->input->get('lmt_per');
		$limit_rows = isset($limit_rows) ? $limit_rows : 10;
		$from = ($page_no * $limit_rows)-$limit_rows;
		$url = substr($_SERVER['REQUEST_URI'], strpos($_SERVER["REQUEST_URI"], 'j'));

		if(isset($page_no))
			$url = str_replace('&per_page='.$page_no, '',$url);
		if(isset($page_no))
			$url = str_replace('?per_page='.$page_no, '',$url);
		$page_url = $url;

		$data['count_saved_jobs'] = $this->find_jobs->get_saved_jobs($user_id);
		$data['saved_jobs'] = $this->find_jobs->get_saved_jobs($user_id, $from, $limit_rows);

		$data['pagination'] = set_pagination(count($data['count_saved_jobs']), $page_url, $limit_rows);

        $data['main_content'] = 'job_seeker/job_seeker_shortlisted_jobs';
        //load main content page
        $data['page_title'] = 'My Saved Jobs';
        $this->load->view('templates/template_job_seeker', $data);

    }

    function save_this_job(){
    	$jp_id = $this->input->post('jp_token');

    	$saved_job['jobseeker_id'] = $this->session->user_id;
    	$saved_job['job_post_id'] = $jp_id;

		$already_saved = $this->find_jobs->check_liked($saved_job);

		try {
			$this->db->trans_begin();

			if ($already_saved)
				$this->find_jobs->remove_liked($saved_job);
			else
				$this->find_jobs->save_this_job($saved_job);

			if ($this->db->trans_status() === FALSE) {
				$res = $this->db->trans_rollback();
				echo json_encode(array('res'=>$res, 'code'=>0, 'message'=>'Something went wrong'));
			}
			else {
				$res = $this->db->trans_commit();
				echo json_encode(array('res'=>$res, 'code'=>1, 'message'=>'Saved'));
			}

		} catch (Exception $e) {
			$this->db->trans_rollback();
			return $e->getMessage();
		}
	}
}
