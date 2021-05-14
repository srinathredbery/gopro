<?php


class Su_cms_content_model extends CI_Model
{
	function get_cms_data($tbl_name, $field, $order = NULL)
	{
		$this->db->select($field);

		$this->db->where("is_hidden_deleted", "0");
		if ($order != NULL)
			$this->db->order_by($order);
		$this->db->from($tbl_name);

		$query = $this->db->get();
		return $query->result_array();
//        echo $this->db->last_query();
	}

	public function add_cms_data($tbl_name, $data)
	{
		return $this->db->insert($tbl_name, $data);
	}

	public function edit_cms_data($tbl_name, $cond, $data)
	{
		$this->db->where($cond);
		return $this->db->update($tbl_name, $data);
	}
}
