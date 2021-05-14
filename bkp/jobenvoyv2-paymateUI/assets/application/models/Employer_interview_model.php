<?php


class Employer_interview_model extends CI_Model
{

    function add_interview_calendar($data){
        $res = $this->db->insert('interview_calendar', $data);
        return $res;
    }

    function get_all_job_posts($company_id){
        $this->db->select('job_posts.job_post_id,
                            job_posts.job_post_employer_id,
                            job_posts.job_post_title');
        $this->db->from('job_posts');
        $this->db->where('job_post_employer_id', $company_id);

        $query = $this->db->get();
        return $query->result_array();
    }

    function get_all_interviews($company_id){
        $this->db->select('interview_calendar.*,
							job_posts.job_post_id,
							job_posts.job_post_employer_id,
							job_posts.job_post_title,
							job_posts.job_post_job_type,
							job_posts.job_post_job_category');
        $this->db->from('interview_calendar');
        $this->db->join('job_posts', 'interview_calendar.job_post_id = job_posts.job_post_id', 'inner');
        $this->db->where('job_post_employer_id', $company_id);

        $query = $this->db->get();
        return $query->result_array();
    }

    function get_all_schedules($company_id){
    	$this->db->select('*');
    	$this->db->from('interview_schedule');
		$this->db->join('job_posts', 'interview_schedule.calendar_id = job_posts.job_post_id', 'inner');
		$this->db->where('job_post_employer_id', $company_id);

		$query = $this->db->get();
		return $query->result_array();
	}

}
