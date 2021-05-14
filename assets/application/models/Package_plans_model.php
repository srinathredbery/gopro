<?php


class Package_plans_model extends CI_Model
{
    public function get_active_job_plans(){
        $this->db->select('id,plan_name,no_of_allowed_post,validity_period,validity_duration,price_currency,price_value');
        $this->db->from('package_plans');
        $this->db->where('is_deleted','0');
        $this->db->where('status','1');
        $this->db->where('effective_date <= CURDATE()');
		$this->db->order_by('created_date', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_selected_package($id, $all = NULL){
    	if (!empty($all))
    		$this->db->select('*');
    	else
			$this->db->select('id,plan_name,no_of_allowed_post,validity_period,validity_duration,price_currency,price_value');
    	$this->db->select('id,plan_name,no_of_allowed_post,validity_period,validity_duration,price_currency,price_value');
		$this->db->from('package_plans');
		$this->db->where('id',$id);
		$this->db->where('is_deleted','0');
		$this->db->where('status','1');

		$query = $this->db->get();
		return $query->row_array();
	}
}
