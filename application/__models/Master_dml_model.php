<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 9/14/2018
 * Time: 4:18 PM
 */

class Master_dml_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add_data($tbl_name, $data)
    {
        $res = $this->db->insert($tbl_name, $data);
        return $res;
    }

    public function add_data_return_id($tbl_name, $data)
    {
        $res = $this->db->insert($tbl_name, $data);
        return $this->db->insert_id();
    }

    function get_data($tbl_name, $field, $param = NULL, $order = NULL, $limit = NULL, $group = NULL)
    {
        $this->db->select($field);
        if ($param != NULL)
            $this->db->where($param);
        if ($order != NULL)
            $this->db->order_by($order);
        if ($group != NULL)
            $this->db->group_by($group);
        if ($limit != NULL)
            $this->db->limit($limit);
        $this->db->from($tbl_name);
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_data_join($tbl_name, $field, $param = NULL, $order = NULL, $limit = NULL, $group = NULL, $join_tbl=NULL, $join_cond=NULL)
    {
        $this->db->select($field);
        if ($param != NULL)
            $this->db->where($param);
        if ($order != NULL)
            $this->db->order_by($order);
        if ($group != NULL)
            $this->db->group_by($group);
        if ($limit != NULL)
            $this->db->limit($limit);
        $this->db->from($tbl_name);
        $this->db->join($join_tbl, $join_cond);
        $query = $this->db->get();
        return $query->row_array();
//        echo $this->db->last_query();
    }

    function get_all_data_join($tbl_name, $field, $param = NULL, $order = NULL, $limit = NULL, $group = NULL, $join_tbl=NULL, $join_cond=NULL, $join_type=NULL)
    {
        $this->db->select($field);
        if ($param != NULL)
            $this->db->where($param);
        if ($order != NULL)
            $this->db->order_by($order);
        if ($group != NULL)
            $this->db->group_by($group);
        if ($limit != NULL)
            $this->db->limit($limit);
        $this->db->from($tbl_name);
		if ($join_tbl != NULL)
        	$this->db->join($join_tbl, $join_cond, $join_type);
        $query = $this->db->get();
        return $query->result_array();
//        echo $this->db->last_query();
    }

    function get_all_data($tbl_name, $param = NULL, $order = NULL, $limit = NULL, $group = NULL)
    { //$pram means where
        $this->db->select('*');

        if ($param != NULL)
            $this->db->where($param);
        if ($order != NULL)
            $this->db->order_by($order);
        if ($group != NULL)
            $this->db->group_by($group);
        if ($limit != NULL)
            $this->db->limit($limit);

        $this->db->from($tbl_name);
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();

    }

    function get_all_data_by_coloumn($tbl_name, $field,$param = NULL, $order = NULL, $limit = NULL, $group = NULL)
    { //$pram means where
        $this->db->select($field);

        if ($param != NULL)
            $this->db->where($param);
        if ($order != NULL)
            $this->db->order_by($order);
        if ($group != NULL)
            $this->db->group_by($group);
        if ($limit != NULL)
            $this->db->limit($limit);

        $this->db->from($tbl_name);
        $query = $this->db->get();
        echo $this->db->last_query();
        return $query->result_array();

    }

    function update_data($tbl_name, $cond, $data)
    {
        $this->db->where($cond);
        $result = $this->db->update($tbl_name, $data);
        return $result;
    }

    function update_data_columns($tbl_name, $field, $field_value, $data)
    {
        $this->db->where($field, $field_value);
        $result = $this->db->update($tbl_name, $data);
        return $result;
    }

    function delete_data($tbl_name, $field, $field_value)
    {
        $this->db->where($field, $field_value);
        $result =  $this->db->delete($tbl_name);
        return $result;
    }


}
