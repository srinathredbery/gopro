<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 11/15/2018
 * Time: 10:02 AM
 */

class Employer_profile_model extends CI_Model
{
    function get_employer($id){
        $this->db->select('*');
        $this->db->from('employer');
        $this->db->where('employer_id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_employer_with_country($id){
        $this->db->select('employer.*, country_master.CountryDes ');
        $this->db->from('employer');
        $this->db->where('employer_id', $id);
        $this->db->join('country_master', 'employer.employer_country = country_master.countryID', 'left');
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->row_array();
    }

    function get_employer_tags($id){
        $this->db->select('*');
        $this->db->from('employer_tag');
        $this->db->where('employer_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function update_employer_logo($cond, $data)
    {
        $this->db->where($cond);
        $result = $this->db->update('employer', $data);
        return $result;
    }

    function update_employer_cover_photo($cond, $data)
    {
        $this->db->where($cond);
        $result = $this->db->update('employer', $data);
        return $result;
    }

    function update_employer_profile($cond, $data){
        $this->db->where('employer_id',$cond);
        $result = $this->db->update('employer', $data);
        return $result;
    }

    function add_employer_tags($data){
        $res = $this->db->insert('employer_tag', $data);
        return $res;
    }

    function remove_tags($id){
        $this->db->where('employer_id', $id);
        $result =  $this->db->delete('employer_tag');
        return $result;
    }

    function get_recent_jobs_by_employer($id){
        $this->db->select('job_posts.*,
                        country_master.CountryDes,
                        job_type.job_type_name');
        $this->db->from('job_posts');
        $this->db->join('country_master', 'job_posts.job_post_country = country_master.countryID', 'left');
        $this->db->join('job_type', 'job_posts.job_post_job_type = job_type.id', 'left');
        $this->db->where('job_post_employer_id', $id);
        $this->db->where('post_status', '1');
        $this->db->order_by('job_post_posted_date', 'ASC');
        $this->db->limit(8);
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
    }

    function get_total_number_of_jobs_by_employer($id){
        $this->db->select('*');
        $this->db->from('employer_tag');
        $this->db->where('employer_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function delete_image($cond, $data){
		$this->db->where($cond);
		$result = $this->db->update('employer', $data);
		return $result;
	}

}
