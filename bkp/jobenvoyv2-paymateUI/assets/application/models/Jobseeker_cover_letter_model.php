<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 11/13/2018
 * Time: 11:06 AM
 */

class Jobseeker_cover_letter_model extends CI_Model
{
    function get_cover_letter_all($id){
        $this->db->select('jobseeker_cover_letter.*');
        $this->db->select('(SELECT COUNT(job_applications_received.applied_cover_letter) FROM job_applications_received WHERE job_applications_received.applied_cover_letter = jobseeker_cover_letter.cover_letter_id) AS no_of_application');
        $this->db->from('jobseeker_cover_letter');
        $this->db->where('jobseeker_id', $id);
		$this->db->order_by('inserted_date', "DESC");
		$this->db->order_by('updated_date', "DESC");
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
    }

    function get_cover_letter($id){
        $this->db->select('*');
        $this->db->from('jobseeker_cover_letter');
        $this->db->where('cover_letter_id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_resume_list($user_id){
        $this->db->select('jobseeker_cover_letter.*');
        $this->db->select('(SELECT COUNT(job_applications_received.applied_resume) FROM job_applications_received WHERE job_applications_received.applied_resume = jobseeker_resume.resume_id) AS no_of_application');
        $this->db->from('jobseeker_resume');
        $this->db->where($user_id);
        $query = $this->db->get();
        return $query->result_array();

    }

    function update_cover_letter($cond, $data){
        $this->db->where('cover_letter_id',$cond);
        $result = $this->db->update('jobseeker_cover_letter', $data);
        return $result;
    }

    function delete_cover_letter($id){
        $this->db->where('cover_letter_id', $id);
        $result =  $this->db->delete("jobseeker_cover_letter");
        return $result;
    }

    function delete_cover_file($id){
        $this->db->where('cover_letter_id', $id);
        $result = $this->db->update('jobseeker_cover_letter', array('attachment_url' => NULL));
        return $result;
    }
}
