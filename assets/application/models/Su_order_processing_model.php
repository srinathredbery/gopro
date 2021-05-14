<?php


class Su_order_processing_model extends CI_Model
{
	public function get_all_orders($data){

		$this->db->distinct();
		$this->db->select('orders.*,
						employer.employer_name,
						orders_transactions.tnx_no');
		$this->db->from('orders');
		$this->db->join('employer', 'orders.employer_id = employer.employer_id', 'left');
		$this->db->join('orders_transactions', 'orders.order_no = orders_transactions.order_no', 'left');
		$this->db->group_by('orders.order_no');
		if ($data['sort'])
			$this->db->order_by(key($data['sort']), $data['sort'][key($data['sort'])]);

		if (!empty($data['filter'])){
			foreach ($data['filter'] as $column => $filter){
				if(!empty($filter))
					$this->db->where($column, $filter);
			}
		}

		if (!empty($data['search'])){
			$i = 0;
//			 loop searchable columns
			foreach($data['search'] as $col => $search){
//				 if datatable send POST for search
				if($search['value']){
//					 first loop
					if($i===0){
//						 open bracket
						$this->db->group_start();
						$this->db->like($col, $search['value']);
					}else{
						$this->db->or_like($col, $search['value']);
					}
//					 last loop
					if(count($data['search']) - 1 == $i){
//						 close bracket
						$this->db->group_end();
					}
				}
				$i++;
			}
		}

		$row_counter = clone $this->db;
		$total_records= $row_counter->count_all_results();

		if ($data['limit'] && $data['limit']['length'] != -1)
			$this->db->limit($data['limit']['length'], $data['limit']['start']);

		$this->db->order_by('order_timestamp', 'DESC');

		$results = $this->db->get()->result();
//		echo $this->db->last_query();
		return array('results'=>$results, 'total_rows'=>$total_records);
	}

	public function get_order($id){
		$this->db->select('orders.*,
							employer.employer_name,
							employer.employer_address_1,
							employer.employer_address_2,
							employer.employer_email,
							employer.employer_city,
							employer.employer_country,
							country_master.CountryDes');
		$this->db->from('orders');
		$this->db->join('employer', 'orders.employer_id = employer.employer_id', 'left');
		$this->db->join('country_master', 'employer.employer_country = country_master.countryID', 'left');
		$this->db->where('order_no', $id);

		return $this->db->get()->row();
	}
	public function get_ordered_items($id){
		$this->db->select('orders_purchased_item_list.*,
					package_plans.pkg_id,
					package_plans.plan_name,
					package_plans.no_of_allowed_post,
					package_plans.validity_period,
					package_plans.validity_duration');
		$this->db->from('orders_purchased_item_list');
		$this->db->join('package_plans', 'orders_purchased_item_list.item_code = package_plans.pkg_id', 'inner');
		$this->db->where('order_no', $id);

		return $this->db->get()->result();
	}

	public function get_order_tnxs($id){
		$this->db->select('*');
		$this->db->from('orders_transactions');
		$this->db->where('order_no', $id);
		$this->db->where('is_deleted', "1");

		return $this->db->get()->result();
	}

	public function get_order_tnx_proof($id){
		$this->db->select('*');
		$this->db->from('orders_transactions_proofs');
		$this->db->where('tnx_no', $id);

		return $this->db->get()->result();
	}

	public function update_txn_status($id, $data){
		$this->db->where("tnx_no", $id);
		$result = $this->db->update("orders_transactions", $data);
		return $result;
	}

	public function validate_txn_status($id){
		$this->db->select('*');
		$this->db->from('orders_transactions');
		$this->db->where('order_no', $id);
		$this->db->where('tnx_status <>', 'approved');
		$this->db->where('is_deleted <>', '2');

		return $this->db->get()->result();
	}

	public function update_order_status($order_id, $data){
		$this->db->where("order_no", $order_id);
		$result = $this->db->update("orders", $data);
		return $result;
	}

	public function check_subscription_exists($emp_id){
		$this->db->select('*');
		$this->db->from('employer_job_plan_subscriptions');
		$this->db->where('employer_id', $emp_id);

		return $this->db->get()->row();
	}

	public function create_subscription($data){
		$this->db->set('employer_id', $data['employer_id']);
		$this->db->set('no_of_posts', $data['no_of_posts']);
		$this->db->set('expiry_date', $data['expiry_date'], FALSE);
		$this->db->insert("employer_job_plan_subscriptions");
	}

	public function update_subscription($emp_id, $update){
		$this->db->set('no_of_posts', $update['no_of_posts'], FALSE);
		$this->db->set('expiry_date', $update['expiry_date'], FALSE);

		$this->db->where("employer_id", $emp_id);
		$this->db->update("employer_job_plan_subscriptions");
	}
}
