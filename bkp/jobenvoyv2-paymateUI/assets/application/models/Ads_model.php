<?php


class Ads_model extends CI_Model
{
    function get_home_under_banner_ads(){
        $this->db->select('adv_posts.id,
                            adv_posts.adv_expiry,
                            adv_posts.adv_url,
                            adv_posts.adv_image_url,
                            adv_posts.adv_banner_location');
        $this->db->from('adv_posts');
        $this->db->where('adv_posts.adv_banner_location = 1
							AND adv_posts.is_active = "1" 
							AND is_deleted <> "1"
							AND adv_posts.adv_activate <= CURRENT_DATE ()
							AND adv_posts.adv_expiry >= CURRENT_DATE()');

        $query = $this->db->get();
        return $query->result_array();
    }

    function get_home_above_footer_ads(){
        $this->db->select('adv_posts.id,
                            adv_posts.adv_expiry,
                            adv_posts.adv_url,
                            adv_posts.adv_image_url,
                            adv_posts.adv_banner_location');
        $this->db->from('adv_posts');
        $this->db->where('adv_posts.adv_banner_location = 2 
							AND adv_posts.is_active = "1"
							AND is_deleted <> "1"
							AND adv_posts.adv_activate <= CURRENT_DATE ()
                            AND adv_posts.adv_expiry >= CURRENT_DATE()');

        $query = $this->db->get();
        return $query->result_array();
    }

    function get_home_mid_page_ads(){
        $this->db->select('adv_posts.id,
                            adv_posts.adv_expiry,
                            adv_posts.adv_url,
                            adv_posts.adv_image_url,
                            adv_posts.adv_banner_location');
        $this->db->from('adv_posts');
        $this->db->where('adv_posts.adv_banner_location = 3
                            AND adv_posts.is_active = "1"
                            AND is_deleted <> "1"
                            AND adv_posts.adv_activate <= CURRENT_DATE ()
                            AND adv_posts.adv_expiry >= CURRENT_DATE()');

        $query = $this->db->get();
        return $query->result_array();
    }

    function get_ads_front($location){
        $this->db->select('adv_posts.id,
                            adv_posts.adv_expiry,
                            adv_posts.adv_url,
                            adv_posts.adv_image_url,
                            adv_posts.adv_banner_location');
        $this->db->from('adv_posts');
        $this->db->where('adv_posts.adv_banner_location = '.$location.'
                            AND adv_posts.is_active = "1"
                            AND is_deleted <> "1"
                            AND adv_posts.adv_activate <= CURRENT_DATE ()
                            AND adv_posts.adv_expiry >= CURRENT_DATE()');

        $query = $this->db->get();
        return $query->result_array();
    }

    function record_ad_click($data){
		$res = $this->db->insert('adv_clicks_records', $data);
		return $res;
	}
}
