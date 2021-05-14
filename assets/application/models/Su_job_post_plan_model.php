<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 11/26/2018
 * Time: 2:50 PM
 */

class Su_job_post_plan_model extends CI_Model
{
    function add_new_plan($data){
        $this->db->insert('package_plans', $data);
        return $this->db->insert_id();
    }

    function update_plan($id, $data){
		$this->db->where('id', $id);
		$result = $this->db->update('package_plans', $data);
		return $result;
    }

    //gets
	function get_all_plans(){
    	$this->db->select('*');
    	$this->db->from('package_plans');
    	$this->db->order_by('created_date','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}
	function get_plan($id){
    	$this->db->select('*');
    	$this->db->from('package_plans');
    	$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	//delete
	function delete_plan($id){
		$this->db->where('id', $id);
		$result =  $this->db->delete('package_plans');
		return $result;
	}

    //validations
    function check_package_exists($package_name, $id=NULL){
		$this->db->select('*');
		$this->db->from('package_plans');
		if (!empty($id))
			$this->db->where('id !=', $id);
		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		$this->db->where('plan_name', $package_name);
		$query = $this->db->get();
//		echo $this->db->last_query();
		return $query->num_rows();
	}
}
