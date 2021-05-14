<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 11/27/2018
 * Time: 4:59 PM
 */

class Job_alerts_model extends CI_Model
{
    function create_job_alert($data){
        $this->db->insert('job_alert_subscription', $data);
        return $this->db->insert_id();    }

    function add_alert_keywords($data)
    {
        $res = $this->db->insert('job_alert_subscription_match_words', $data);
        return $res;
    }

    function get_job_alert_subscriptions($user_id){
        $this->db->select('job_alert_subscription.*,
							job_industry.job_industry_name,
							job_category.job_category_name,
							job_type.job_type_name');
        $this->db->where('jobseeker_user_id', $user_id);
        $this->db->from('job_alert_subscription');
        $this->db->join('job_industry', 'job_alert_subscription.job_industry = job_industry.id', 'inner');
        $this->db->join('job_category', 'job_alert_subscription.job_category = job_category.id', 'inner');
        $this->db->join('job_type', 'job_alert_subscription.job_type = job_type.id', 'inner');
		$this->db->order_by('created_date', "DESC");
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_job_alert_keywords($alert_id){
        $this->db->select('*');
        $this->db->where('job_alert_subscription_match_words.job_alert_id', $alert_id);
        $this->db->from('job_alert_subscription_match_words');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_job_type_key($search_area, $join){
        $this->db->select('*');
        $this->db->from('job_alert_subscription_match_words');
        $this->db->where('job_alert_subscription_match_words.alert_keyword_search_area', $search_area);
        $this->db->join($search_area, $join, 'inner');
        $this->db->order_by('job_alert_id', 'ASC');

        $query = $this->db->get();
        return $query->result_array();
    }

    function get_job_category_name($id){
        $this->db->select('job_category_name AS search_by_keys');
        $this->db->from('job_category');
        $this->db->where('id', $id);
        $this->db->where('is_hidden_deleted', '0');
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_job_type($id){
        $this->db->select('job_type_name AS search_by_keys');
        $this->db->from('job_type');
        $this->db->where('id', $id);
		$this->db->where('is_hidden_deleted', '0');

        $query = $this->db->get();
        return $query->row_array();
    }

    function update_alert_frequency($id, $data){
        $this->db->where('job_alert_id', $id);
        $result = $this->db->update('job_alert_subscription', $data);
        return $result;
    }

    function ats_interview_confirm($id, $data){
		$this->db->where('idats_schedule_interview', $id);
		$result = $this->db->update('ats_schedule_interview', $data);
		return $result;
	}

    function delete_data($id)
    {
        $tables = array('job_alert_subscription', 'job_alert_subscription_match_words');
        $this->db->where('job_alert_id', $id);
        $result =  $this->db->delete($tables);
        return $result;
    }


}
