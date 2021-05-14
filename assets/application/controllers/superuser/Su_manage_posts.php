<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 3/21/2019
 * Time: 10:57 AM
 */

class Su_manage_posts extends Main_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Su_manage_post_model', 'manage_post');
		$this->load->model('Employer_job_post_model', 'job_post_model');
	}

	public function view_pending_posts()
	{

		$data['pending_posts'] = $this->manage_post->get_pending_posts();

		$data['page_title'] = 'Pending Posts &bull; Super User';
		$data['main_content'] = 'superuser/su_post_pending';

		//load main content page
		$this->load->view('templates/template_superuser', $data);
	}

	public function ats(){

		$data['pending_posts'] = $this->manage_post->get_pending_posts();

		$data['page_title'] = 'Pending Posts &bull; Super User';
		$data['main_content'] = 'employer/ats_job_and_appication';
		//load main content page
		$this->load->view('templates/template_superuser', $data);

	}

	function get_pending()
	{
		$dt_data = $this->input->get();

		echo json_encode($dt_data);

		$data['pending_posts'] = $this->manage_post->get_pending_posts();
	}

	public function view_approved_posts()
	{

		$data['approved_posts'] = $this->manage_post->get_approved_posts();

		$data['page_title'] = 'Pending Posts &bull; Super User';
		$data['main_content'] = 'superuser/su_post_approved';

		//load main content page
		$this->load->view('templates/template_superuser', $data);
	}


	 public function  view_approved_posts_Featured(){

		 $data['approved_posts'] = $this->manage_post->get_approved_posts_Featured();

		 $data['page_title'] = 'Pending Posts &bull; Super User';
		 $data['main_content'] = 'superuser/su_post_approved_ featured_jobs';

		 //load main content page
		 $this->load->view('templates/template_superuser', $data);



	 }

	 public function addFeatured(){
		 $jop_post_id = $this->input->post();
		 $post_id= $jop_post_id['post_id'];
		 $res = $this->manage_post->add_featured_data($post_id);


	 }


	 public function removeFeatured(){

		 $jop_post_id = $this->input->post();
		 $post_id= $jop_post_id['post_id'];
		 $res = $this->manage_post->remove_featured_data($post_id);


	 }


	public function view_rejected_posts()
	{

		$data['rejected_posts'] = $this->manage_post->get_rejected_posts();

		$data['page_title'] = 'Pending Posts &bull; Super User';
		$data['main_content'] = 'superuser/su_post_rejected';

		//load main content page
		$this->load->view('templates/template_superuser', $data);
	}

	function approve_post()
	{
		$post_id = $this->input->post('post');

		try {
			$this->db->trans_begin();

			$job_post = $this->job_post_model->get_selected_post($post_id);
			$subscription = get_employer_subscription_data($job_post['job_post_employer_id']);

			if (!empty($subscription)) {
				if ($subscription->no_of_posts <= 0) {
					echo json_encode(
						array(
							'code' => 0,
							'message' => 'This employer has no active subscription or expired or Quota exceeded'
						)
					);
					exit;
				}
			} else {
				echo json_encode(array(
						'code' => 0,
						'message' => 'This employer has no active subscription or expired or Quota exceeded'
					)
				);
				exit;
			}

			$this->manage_post->approve_post($post_id, array('post_approval' => '1'));
			$this->manage_post->deduct_post_count_from_subscription($job_post['job_post_employer_id']);

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				echo json_encode(array('code' => 0, 'message' => 'Something went wrong'));
			} else {
				$this->db->trans_commit();
				echo json_encode(array('code' => 1, 'message' => 'Approved successfully. The post is now live to public'));
			}
		} catch (Exception $e) {
			echo json_encode(array('code' => 0, 'message' => 'Something went wrong. Please try again or contact support.'));
			echo ' <script> console.log(' . $e . ') </script>';
		}
	}

	function reject_post()
	{
		$rejected_post = $this->input->post();

		$log_data['job_post_id'] = $rejected_post['post_id'];
		$log_data['rejection_reason'] = $rejected_post['rejection_comment'];
		$log_data['rejected_by'] = $_SESSION['user_id'];

		try {
			$this->db->trans_begin();

			$res = $this->manage_post->approve_post($rejected_post['post_id'], array('post_approval' => '2'));

			if ($res) {
				$res = $this->manage_post->save_rejection_log($log_data);
			}

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				echo json_encode(array('code' => 0, 'message' => 'Something went wrong'));
			} else {
				$this->db->trans_commit();
				echo json_encode(array('code' => 1, 'message' => 'Post rejected successfully'));
			}
		} catch (Exception $e) {
			echo json_encode(array('code' => 0, 'message' => 'Something went wrong. Please try again or contact support.'));
			echo ' <script> console.log(' . $e . ') </script>';
		}
	}

	function enable_featurted_post()
	{

	}
}
