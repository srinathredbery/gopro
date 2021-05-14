<?php


class Su_ads_model extends CI_Model
{
    function create_new_ad($data){
        $res = $this->db->insert('adv_posts', $data);
        return $res;
    }
    function edit_ad($id, $data){
		$this->db->where('id', $id);
		$result = $this->db->update('adv_posts', $data);
		return $result;
    }

    function ads_status_switch($id, $status){
        $this->db->where('id', $id);
        $result = $this->db->update('adv_posts', array("is_active"=>$status));
        return $result;
    }

    function get_ad_info($id){
    	$this->db->select('adv_posts.*,
							adv_clients.company_name,
							adv_clients.company_contact_person,
							adv_clients.company_contact_country_code,
							adv_clients.company_contact_no,
							adv_clients.company_contact_email,
							adv_clients.company_address_1,
							adv_clients.company_address_2,
							adv_clients.company_city,
							adv_clients.company_country,
							adv_banner_type.banner_type,
							adv_banner_spot.adv_spot_name,
							adv_banner_spot.height,
							adv_banner_spot.width');
    	$this->db->from('adv_posts');
    	$this->db->where('adv_posts.id', $id);
		$this->db->join('adv_clients', 'adv_posts.adv_client = adv_clients.id', 'left');
		$this->db->join('adv_banner_type', 'adv_posts.adv_banner_type = adv_banner_type.id');
		$this->db->join('adv_banner_spot', 'adv_posts.adv_banner_location = adv_banner_spot.id');
		$query = $this->db->get();
//		echo $this->db->last_query();
		return $query->row_array();
	}

    function delete_ad($id){
        $this->db->where('id', $id);
        $result = $this->db->update('adv_posts', array("is_deleted"=>"1"));
        return $result;
    }


	function get_all_ads_data(){
		$this->db->select('adv_posts.*, clicks.ad_click_count, adv_clients.company_name');
		$this->db->from('adv_posts');
		$this->db->join('(SELECT ad_id, COUNT(ad_id) as ad_click_count FROM adv_clicks_records GROUP BY ad_id) as clicks', 'adv_posts.id = clicks.ad_id', 'left');
		$this->db->join('adv_clients', 'adv_posts.adv_client = adv_clients.id', 'left');
		$this->db->where('is_deleted <> "1"');
		$this->db->order_by('created_date', 'DESC');

		$query = $this->db->get();
		return $query->result_array();
	}

	function get_company_list($search_key = NULL){
		$this->db->select('id, company_name ');
		$this->db->from('adv_clients');
		if ($search_key != NULL)
			$this->db->like( 'company_name', $search_key);
		$query = $this->db->get();
		return $query->result_array();
	}


	function add_company($data){
		$res = $this->db->insert('adv_clients', $data);
		return $res;
	}
}
