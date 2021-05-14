<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 11/26/2018
 * Time: 2:50 PM
 */

class Su_manage_user_model extends CI_Model
{
	function add_new_user($data){
		$this->db->insert('user', $data);
		return $this->db->insert_id();
	}
	function add_new_user_info($data){
		$res = $this->db->insert('super_user', $data);
		return $res;
	}

	function update_user($id, $data){
		$this->db->where('user_id', $id);
		$result = $this->db->update('user', $data);
		return $result;
	}
	function update_user_info($id, $data){
		$this->db->where('user_id', $id);
		$result = $this->db->update('super_user', $data);
		return $result;
	}

	function get_users(){
		$this->db->select('super_user.su_first_name,
						super_user.su_last_name,
						user.user_id,
						user.email,
						user.joined_date,
						user.is_active,
						user.user_group ');
		$this->db->where('user.user_type', '1');
		$this->db->where('user.is_deleted', '0');
		$this->db->from('user');
		$this->db->join('super_user', 'user.user_id = super_user.user_id ', 'left');
		$this->db->order_by('joined_date', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_user($id){
		$this->db->select('user.email,
							user.user_id,
							user.username,
							user.user_type,
							user.user_group,
							user.company_id,
							user.verification_status,
							user.joined_date,
							super_user.su_first_name,
							super_user.su_last_name,
							super_user.su_emp_id');
		$this->db->from('user');
		$this->db->join('super_user', 'user.user_id = super_user.user_id', 'left');
		$this->db->where('user.user_id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	function update_user_access($id, $data){
		$this->db->where('user_id', $id);
		$result = $this->db->update('user', $data);
		return $result;
	}

	function delete_an_user($user_id){
		$this->db->where('user_id', $user_id);
		$result = $this->db->update('user', array('is_deleted'=>'1'));
		return $result;
	}
	function save_user_delete_reason($data){
		$res = $this->db->insert('deleted_users', $data);
		return $res;
	}

	//User groups
	function get_user_groups_list($comp_id){
		$this->db->select('user_groups.*,
						user.email,
						user.user_id,
						(SELECT COUNT(user.user_group) FROM user WHERE user.user_group = user_groups.id AND user.is_deleted = "0") AS users_count
						');
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
		$this->db->where('user_type', '1');
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

	function check_user_exists($user_email){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('is_deleted', '0');
		$this->db->where('email', $user_email);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function check_user_group_exists($company_id, $ug_name){
		$this->db->select('*');
		$this->db->from('user_groups');
		$this->db->where('company_id', $company_id);
		$this->db->where('user_group_name', $ug_name);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function user_group_usage($rid){
		$this->db->select('user_group');
		$this->db->from('user');
		$this->db->where('is_deleted', '0');
		$this->db->where('user_group', $rid);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function delete_user_group($rid){
		$this->db->where('id', $rid);
		$result =  $this->db->delete('user_groups');
		return $result;
	}
}
