<?php


class Orders_transaction_model extends CI_Model
{
	public function create_order($data){
		$res =  $this->db->insert('orders', $data);
//		echo $this->db->last_query();
		return $res;
	}

	public function create_order_item_list($data){
		return $this->db->insert('orders_purchased_item_list', $data);
//		return $this->db->insert_id();
	}

	public function get_all_orders($id){
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('employer_id', $id);
		$this->db->order_by('order_timestamp', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_all_order_item($id){
		$this->db->select('orders_purchased_item_list.id,
							orders_purchased_item_list.`timestamp`,
							orders_purchased_item_list.order_no,
							orders_purchased_item_list.item_code,
							orders_purchased_item_list.quantity,
							orders_purchased_item_list.`value`,
							orders_purchased_item_list.discount,
							orders_purchased_item_list.discount_type,
							orders_purchased_item_list.tax,
							orders.order_no,
							orders.employer_id,
							package_plans.pkg_id,
							package_plans.id,
							package_plans.plan_name,
							package_plans.no_of_allowed_post,
							package_plans.validity_period,
							package_plans.validity_duration,
							package_plans.effective_date,
							package_plans.price_currency,
							package_plans.price_value,
							package_plans.created_date,
							package_plans.updated_date,
							package_plans.created_by,
							package_plans.`status`,
							package_plans.is_deleted');
		$this->db->from('orders_purchased_item_list');
		$this->db->where('orders.employer_id', $id);
		$this->db->join('orders', 'orders_purchased_item_list.order_no = orders.order_no', 'inner');
		$this->db->join('package_plans', 'package_plans.pkg_id = orders_purchased_item_list.item_code', 'inner');

		$query = $this->db->get();
		return $query->result();
	}

	public function get_order_data($id){
		$this->db->select('orders.*,
							employer.employer_name,
							employer.employer_email,
							employer.employer_address_1,
							employer.employer_address_2,
							employer.employer_city,
							employer.employer_country,
							country_master.CountryDes');
		$this->db->from('orders');
		$this->db->where('order_no', $id);
		$this->db->join('employer', 'orders.employer_id = employer.employer_id', 'left');
		$this->db->join('country_master', 'employer.employer_country = country_master.countryID', 'left');
		$query = $this->db->get();
		return $query->row();
	}

	public function get_order_item($id){
		$this->db->select('orders_purchased_item_list.*,
							package_plans.pkg_id,
							package_plans.plan_name,
							package_plans.no_of_allowed_post,
							package_plans.validity_period,
							package_plans.validity_duration,
							package_plans.effective_date,
							package_plans.price_currency,
							package_plans.price_value,
							package_plans.created_date,
							package_plans.updated_date,');
		$this->db->from('orders_purchased_item_list');
		$this->db->where('order_no', $id);
		$this->db->join('package_plans', 'orders_purchased_item_list.item_code = package_plans.pkg_id', 'left');
		$query = $this->db->get();
		return $query->result();
	}

	public function create_transaction($data){
		return $this->db->insert('orders_transactions', $data);
	}

	public function create_transaction_proofs($data){
		return $this->db->insert('orders_transactions_proofs', $data);
	}

	public function get_order_transactions($id){
		$this->db->select('*');
		$this->db->from('orders_transactions');
		$this->db->where('order_no', $id);
		$this->db->where('is_deleted', '1');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_order_transaction_proof_files($id){
		$this->db->select('*');
		$this->db->from('orders_transactions_proofs');
		$this->db->where('tnx_no', $id);
		$this->db->where('is_deleted', '1');
		$query = $this->db->get();
		return $query->result();
	}

	public function revoke($id, $data){
		$this->db->where('tnx_no', $id);
		$result = $this->db->update('orders_transactions', $data);
		return $result;
	}
	public function revoke_proofs($id, $data){
		$this->db->where('tnx_no', $id);
		$result = $this->db->update('orders_transactions_proofs', $data);
		return $result;
	}
}
