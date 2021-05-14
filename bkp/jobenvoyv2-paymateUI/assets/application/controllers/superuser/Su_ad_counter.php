<?php


class Su_ad_counter extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("ads_model");
	}

	function redirect_ad(){
		$ad_data = $this->input->get();

		$ad_id = !empty($ad_data['ad_id']) ? $ad_data['ad_id'] : '';

		$cookie_name = "ad_c_".$ad_id;
		$click_cookie = $this->input->cookie($cookie_name);


		if ($click_cookie){
			redirect($ad_data['redirect']);
		}
		else{
			$cookie = array(
				'name'   => $cookie_name,
				'value'  => '1',
				'expire' => 3600
			);
			$this->input->set_cookie($cookie);
			$this->ads_model->record_ad_click(array('ad_id'=>$ad_id));
			redirect($ad_data['redirect']);
		}
	}
}
