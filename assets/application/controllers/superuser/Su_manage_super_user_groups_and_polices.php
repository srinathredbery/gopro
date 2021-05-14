<?php


class Su_manage_super_user_groups_and_polices extends Main_Controller
{
	private $company_id;
	private $user_id;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Su_manage_user_model', 'manage_user');
		$this->company_id = $this->session->company_id;
		$this->user_id = $this->session->user_id;
	}

	public function view_user_group_manager(){
		$data['page_title'] = 'User Group Management &bull; Super User';
		$data['user_groups'] = $this->manage_user->get_user_groups_list($this->company_id);
		$data['function_routes'] = $this->manage_user->get_all_routes();

		$data['main_content'] = 'superuser/su_manage_super_user_group.php';
		//load main content page
		$this->load->view('templates/template_employer', $data);
	}

	function add_new_user_group(){

		$valid_config = array(
			array(
				'field' => 'user_group_name',
				'label' => 'User Group Name',
				'rules' => 'trim|required|xss_clean|callback_unique_group_name_check',
				'errors' => array(
					'required' => 'Please Enter a User Group Name'
				),
			),
		);

		$this->form_validation->set_rules($valid_config);

		if ($this->form_validation->run() == FALSE) {
			header("HTTP/1.1 449 Retry With");
			echo json_encode(array('code' => 449, 'message' => array(validation_errors())));
		}
		else {
			$user_group_name = $this->input->post('user_group_name');

			$data['company_id'] = $this->company_id;
			$data['user_group_name'] = $user_group_name;
			$data['created_by'] = $this->user_id;

			try {
				$this->db->trans_begin();
				$this->master_dml_model->add_data('user_groups', $data);

				if ($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
					echo json_encode(array('res'=>$res, 'code'=>0, 'message'=>'Something went wrong'));
				}
				else {
					$this->db->trans_commit();
					echo json_encode(array('code'=>1, 'message'=>'Added Successfully'));
				}
			}
			catch (Exception $e) {
				echo json_encode($e->getMessage());
			}
		}
	}

	function save_user_group_access(){
		$access_data = $this->input->post();
		$user_group_id = $access_data['user_group_id'];
		$access_data = $access_data['access_func'];

		try {
			$this->db->trans_begin();

			$this->manage_user->remove_exiting_user_group_permissions($user_group_id);

			foreach ($access_data as $access ){
				$data = array('user_group_id'=>$user_group_id, 'route_id' =>$access);
				$this->manage_user->set_user_group_permissions($data);
			}
			if ($this->db->trans_status() === FALSE) {
				$res = $this->db->trans_rollback();
				echo json_encode(array('res'=>$res, 'code'=>0, 'message'=>'Something went wrong, Adding Failed'));
			} else {
				$res = $this->db->trans_commit();
				echo json_encode(array('res'=>$res, 'code'=>1, 'message'=>'Assigned successfully'));
			}
		} catch (Exception $e) {
			echo json_encode($e);
		}
	}

	function get_existing_permissions(){
		$group_id = $this->input->get('user_gid');

		$permission = $this->manage_user->get_permissions($group_id);

		echo json_encode($permission);
	}

	function unique_group_name_check($ug_name){
		$company_id = $this->session->company_id;
		$is_exist =  $this->manage_user->check_user_group_exists($company_id, $ug_name);

		if ($is_exist)
		{
			$this->form_validation->set_message('unique_group_name_check', 'This user group name already exist, Please enter a different name to differentiate');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	function delete_user_group() {
		$rid = $this->input->post('rec_id');
		if (!empty($rid)){
			try{
				$res = $this->manage_user->user_group_usage($rid);

				if (empty($res)){
					$this->db->trans_begin();

					$this->manage_user->delete_user_group($rid);
					audit_delete_log('user group '.$rid);

					if ($this->db->trans_status() === FALSE) {
						$res = $this->db->trans_rollback();
						echo json_encode(array('res'=>$res, 'code'=>0, 'message'=>'Something went wrong, Deleteing Failed'));
					} else {
						$res = $this->db->trans_commit();

						echo json_encode(array('res'=>$res, 'code'=>1, 'message'=>'Group has been Deleted successfully'));
					}
				}else{
					echo json_encode(array('res'=>$res, 'code'=>2, 'message'=>'Failed! You cannot delete this Group, because this user group has assigned users'));
				}


			}catch (Exception $e){
				echo json_encode(array('res'=>$res, 'code'=>0, 'message'=>$e));
			}
		}
	}
}
