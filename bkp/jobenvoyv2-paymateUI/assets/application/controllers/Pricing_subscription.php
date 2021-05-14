<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 8/16/2018
 * Time: 3:17 PM
 */

class Pricing_subscription extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Package_plans_model', 'plans_model');
	}
    public function index()
    {
		$data['plans'] = $this->plans_model->get_active_job_plans();

        $data['page_title'] = 'Pricing and Subscription';
        $data['main_content'] = 'extras/pricing_subscription';

        //load main content page
        $this->load->view('templates/template_extras', $data);
    }
}
