<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 3/21/2019
 * Time: 1:10 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Su_manage_post_model extends CI_Model
{
    function get_pending_posts(){
        $this->db->select('job_posts.*, job_type.job_type_name, employer.employer_name, employer.employer_logo_url');
//        $this->db->select('(SELECT COUNT( job_applications_received.application_no ) FROM job_applications_received WHERE job_applications_received.job_post_id = job_posts.job_post_id ) AS no_of_applications ');
        $this->db->where(array('post_approval'=>'0', 'post_status'=>'1'));
        $this->db->join('employer','job_posts.job_post_employer_id = employer.employer_id', 'left');
        $this->db->join('job_type','job_posts.job_post_job_type = job_type.id', 'left');
        $this->db->order_by('job_post_posted_date', 'DESC');
        $this->db->from('job_posts');

        $query = $this->db->get();
        return $query->result_array();
    }

    function get_approved_posts(){
        $this->db->select('job_posts.*, job_type.job_type_name, employer.employer_name, employer.employer_logo_url');
//        $this->db->select('(SELECT COUNT( job_applications_received.application_no ) FROM job_applications_received WHERE job_applications_received.job_post_id = job_posts.job_post_id ) AS no_of_applications ');
        $this->db->where(array('post_approval'=>'1', 'post_status'=>'1'));
        $this->db->join('employer','job_posts.job_post_employer_id = employer.employer_id', 'left');
        $this->db->join('job_type','job_posts.job_post_job_type = job_type.id', 'left');
        $this->db->order_by('job_post_posted_date', 'DESC');
        $this->db->from('job_posts');

        $query = $this->db->get();
        return $query->result_array();
    }

	function get_approved_posts_Featured(){
		$this->db->select('job_posts.*, job_type.job_type_name, employer.employer_name, employer.employer_logo_url,job_posts_featured.status');
   		$this->db->where(array('post_approval'=>'1', 'post_status'=>'1'));
		$this->db->join('employer','job_posts.job_post_employer_id = employer.employer_id', 'left');
		$this->db->join('job_type','job_posts.job_post_job_type = job_type.id', 'left');
		$this->db->join('job_posts_featured','job_posts_featured.job_post_id = job_posts.job_post_id', 'left outer');
		$this->db->order_by('job_post_posted_date', 'DESC');
		$this->db->from('job_posts');

		$query = $this->db->get();
		return $query->result_array();
	}

    function get_rejected_posts(){
        $this->db->select('job_posts.*, job_type.job_type_name, employer.employer_name, employer.employer_logo_url');
//        $this->db->select('(SELECT COUNT( job_applications_received.application_no ) FROM job_applications_received WHERE job_applications_received.job_post_id = job_posts.job_post_id ) AS no_of_applications ');
        $this->db->where(array('post_approval'=>'2', 'post_status'=>'1'));
        $this->db->join('employer','job_posts.job_post_employer_id = employer.employer_id', 'left');
        $this->db->join('job_type','job_posts.job_post_job_type = job_type.id', 'left');
        $this->db->order_by('job_post_posted_date', 'DESC');
        $this->db->from('job_posts');

        $query = $this->db->get();
        return $query->result_array();
    }

    function approve_post($id, $data){
        $this->db->where('job_post_id', $id);
        $result = $this->db->update('job_posts', $data);
        return $result;
    }

    function deduct_post_count_from_subscription($id){
		$this->db->set('no_of_posts', 'no_of_posts - 1', FALSE);

		$this->db->where('employer_id', $id);
		$result = $this->db->update('employer_job_plan_subscriptions');
		return $result;
	}

    public function save_rejection_log($data){
        $res = $this->db->insert('job_posts_rejected_log', $data);
        return $res;
    }


	function add_featured_data($data){
		$currentDateTime = date('Y-m-d H:i:s');

//------------------Check Row Count <3------------------------------
		$query = $this->db->query('SELECT * FROM job_posts_featured WHERE status="Active"');
		$ActiveJobsCount= $query->num_rows();
		if($ActiveJobsCount<3) {
//		-----Insert Featured Data---------------------------------------
			$query = $this->db->query('SELECT * FROM job_posts_featured WHERE job_post_id="'.$data.'"');
			$isAlredy= $query->num_rows();
			if($isAlredy==0) {
				$data = array(
					'job_post_id' => $data,
					'enabled_date' => $currentDateTime,
					'status' => 'Active'
				);
				return $this->db->insert('job_posts_featured', $data);
			}else{
				$this->db->set('status', 'Active');
				$this->db->where('job_post_id', $data);
				$result = $this->db->update('job_posts_featured');
				return $result;
			}
//		===============================================================
		}else{
			echo "Remove one";
		}

	}


	function remove_featured_data($data){
		$currentDateTime = date('Y-m-d H:i:s');


		$this->db->set('status', 'Deactive');
		$this->db->where('job_post_id', $data);
		$result = $this->db->update('job_posts_featured');
		return $result;

	}


}
