<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main_Controller extends CI_Controller
{
	protected $current_route;
	protected $user_type;
	protected $user_group;
	protected $logged;
	protected $control_access;

	function __construct()
	{
		parent::__construct();
		$this->load->model('access_control_model', 'access_model');

		$this->user_type =  $this->session->user_type;
		$this->user_group =  $this->session->user_group;
		$this->current_route = $this->uri->uri_string();
		$this->logged = $this->session->logged_in;

		if (!empty($this->logged)) {
			if ($this->user_type_access()){
				if ($this->user_group_policy_check())
					return true;
				else{
					show_not_authorised();
				}
			}
			else {
				if (!$this->input->is_ajax_request())
					redirect('404_override');
				else{
					header("HTTP/1.1 401 Authentication Failed");
					$url = redirec_login();
					echo json_encode(array('code' => '401', 'message' =>'Sorry! You do not have permission for this operation'));
					exit();
				}
			}
		}
		else {
			if (!$this->input->is_ajax_request()) {
				redirec_login();
			}
			else{
				header("HTTP/1.1 401 Authentication Failed");
				$url = redirec_login();
				echo json_encode(array('code' => '401', 'message' =>'Please login to continue', 're_url'=> $url));
				exit();
			}
		}
	}

	function user_type_access(){
		$user_segment = $this->uri->segment(1);

		if ($this->user_type == 1 && $user_segment=='superuser')
			return true;
		elseif ($this->user_type == 2 && $user_segment=='employer')
			return true;
		elseif ($this->user_type == 3 && $user_segment=='job_seeker')
			return true;
		elseif ($this->user_type == 4 && $user_segment=='superuser') //user_type 4 is temporary solution for search for user access
			return true;
		elseif ($user_segment=='api')
			return true;
		else
			return false;
	}

	function user_group_policy_check(){
		$control_access = false;
//		echo ($this->user_group);
		if ($this->user_type != 3 || $this->user_type != '3'){
			if ($this->user_group != '-1' || $this->user_group != -1){
				$routes = $this->access_model->get_control_routes();
				if($i = array_search($this->current_route, array_column($routes, 'route_url'))) {
					$route_access =  $this->access_model->get_controlled_route_access($routes[$i]['route_id'], $this->user_group);
					if (!empty($route_access)){
						return true;
					}
					else
						return false;
				}
				else
					return true;
			}
			else
				return true;
		}
		else
			return true;
	}
}
