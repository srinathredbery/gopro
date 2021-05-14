<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 11/26/2018
 * Time: 2:50 PM
 */

class Employer_manage_user_model extends CI_Model
{
    function add_new_user($data){
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }
    function add_new_user_info($data){
        $res = $this->db->insert('employer_users', $data);
        return $res;
    }

    function get_users($comapny_id){
        $this->db->select('employer_users.emp_first_name, employer_users.emp_last_name, user.user_id, user.email, user.joined_date, user.is_active, user.user_group');
        $this->db->where('company_id', $comapny_id);
        $this->db->from('user');
        $this->db->join('employer_users', 'user.user_id = employer_users.emp_user_id', 'inner');
		$this->db->order_by('joined_date', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function update_user_access($id, $data){
        $this->db->where('user_id', $id);
        $result = $this->db->update('user', $data);
        return $result;
    }

    function get_user_groups_list($comp_id){
    	$this->db->select('*');
    	$this->db->from('user_groups');
    	$this->db->join('user', 'user_groups.created_by = user.user_id', 'left');
    	$this->db->where('user_groups.company_id', $comp_id);
		$this->db->order_by('created_time', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	function set_user_group($id, $group){
		$this->db->where('user_id', $id);
		$result = $this->db->update('user', array('user_group'=>$group));
		return $result;
	}

	function get_all_routes(){
		$this->db->select('*');
		$this->db->from('routes_master');
		$this->db->where('is_active', '1');
		$this->db->where('user_type', '2');
		$query = $this->db->get();
		return $query->result_array();
	}

	function remove_exiting_user_group_permissions($group_id){
		$this->db->where('user_group_id', $group_id);
		$result =  $this->db->delete('user_group_route_access');
		return $result;
	}

	function set_user_group_permissions($data){
		$res = $this->db->insert('user_group_route_access', $data);
		return $res;
	}

	function get_permissions($group_id){
		$this->db->select('*');
		$this->db->from('user_group_route_access');
		$this->db->where('user_group_id', $group_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	function check_user_group_exists($company_id, $ug_name){
    	$this->db->select('*');
		$this->db->from('user_groups');
		$this->db->where('company_id', $company_id);
		$this->db->where('user_group_name', $ug_name);
		$query = $this->db->get();
		return $query->num_rows();
	}
}
