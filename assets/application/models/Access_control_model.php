<?php


class Access_control_model extends CI_Model
{
	function get_control_routes(){
		$this->db->select('*');
		$this->db->from('routes_master');
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_controlled_route_access($route_id, $user_group_id){
		$this->db->select('user_group_route_access.id,
							user_group_route_access.user_group_id,
							user_group_route_access.route_id,
							user_groups.user_group_code,
							user_groups.user_group_name,
							user_groups.created_by,
							user_groups.created_time');
		$this->db->from('user_group_route_access');
		$this->db->join('user_groups', 'user_groups.id = user_group_route_access.user_group_id', 'inner');
		$this->db->where('user_group_route_access.route_id', $route_id);
		$this->db->where('user_groups.id', $user_group_id);
		$query = $this->db->get();
//		echo $this->db->last_query();
		return $query->num_rows();
	}
}
