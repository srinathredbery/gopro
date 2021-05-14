<?php


class Su_job_posting_plan extends Main_Controller
{
	private $company_id;
	private $user_id;
	private $edit_mode;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Su_job_post_plan_model', 'job_plan');
		$this->company_id = $this->session->company_id;
		$this->user_id = $this->session->user_id;
	}

	public function view_plan_manager(){

		$data['posting_plans'] = $this->job_plan->get_all_plans();

		$data['page_title'] = 'Job Post Plans &bull; Super User';
		$data['main_content'] = 'superuser/su_job_post_plans_manger';

		//load main content page
		$this->load->view('templates/template_superuser', $data);
	}

	public function create_modify_plan(){
		$plan_data = $this->input->post();

		$validation = $this->validate_plan_data();
		if ($validation === TRUE){
			try {
				$plan['plan_name'] = $plan_data['plan_name'];
				$plan['validity_period'] = $plan_data['validity_period'];
				$plan['validity_duration'] = $plan_data['validity_duration'];
				$plan['effective_date'] = $plan_data['effective_date'];
				$plan['no_of_allowed_post'] = $plan_data['no_of_allowed_post'];
				$plan['price_currency'] = $plan_data['price_currency'];
				$plan['price_value'] = $plan_data['price_value'];
				$plan['created_by'] = $this->user_id;

				$this->db->trans_begin();
				if (empty($plan_data['rec_id'])){
					$this->edit_mode = FALSE;
					$rec_id = $this->job_plan->add_new_plan($plan);
					$pkcg_id = 'jp/'.$plan_data['validity_period'].$plan_data['validity_duration'].'/'.$rec_id;
					$this->job_plan->update_plan($rec_id, array('pkg_id'=>strtoupper($pkcg_id))); //Generate plan ID
					$message = "Created successfully";
				} else {
					$this->edit_mode = TRUE;
					$rec_id = $plan_data['rec_id'];
					$pkcg_id = 'jp/'.$plan_data['validity_period'].$plan_data['validity_duration'].'/'.$rec_id;
					if ($this->check_effective_date_not_crossed($rec_id)){

						$plan['pkg_id'] = $pkcg_id;
						$this->job_plan->update_plan($rec_id, $plan);
						$message = "Plan updated successfully";

						//Logging the event
						$log = "Modified, package data, Package ID ".$pkcg_id." plan id ".$plan_data['rec_id'];
						audit_edit_logger($log);
					}
					else{
						$message = "This plan cannot be edited since it has passed the effective date";
						echo json_encode(array('res'=>FALSE, 'code' => 0, 'message' => $message));
						exit();
					}
				}

				if ($this->db->trans_status() === FALSE){
					$res = $this->db->trans_rollback();
					echo json_encode(array('res'=>$res, 'code' => 0, 'message'=>'Error! Update failed'));
				} else {
					$res = $this->db->trans_commit();
					echo json_encode(array('res'=>$res, 'code' => 1, 'message' => $message));
				}

			} catch ( Exception $e){
				echo json_encode($e);
			}
		}
		else{
			header("HTTP/1.1 449 Retry With");
			echo json_encode(array('code' => 449, 'message' => $validation));
		}
	}

	public function get_plan_data(){
		$rec_id = $this->input->post('rec_id');
		try{
			$plan_date = $this->job_plan->get_plan($rec_id);
			$editable =  (date("Y-m-d", strtotime($plan_date['effective_date'])) > date("Y-m-d")) ? 1 : 0;
			$editable = array(
				'allowed'=> $editable,
				'message'=>'<div class="alert alert-warning" role="alert">This plan cannot be edited since it has passed the effective date</div>');
			$ret_data = array(
				'rec_id' => $plan_date['id'],
				'pkg_id' => $plan_date['pkg_id'],
				'plan_name' => $plan_date['plan_name'],
				'validity_period' => $plan_date['validity_period'],
				'validity_duration' => $plan_date['validity_duration'],
				'effective_date' => $plan_date['effective_date'],
				'no_of_allowed_post' => $plan_date['no_of_allowed_post'],
				'price_currency' => $plan_date['price_currency'],
				'price_value' => $plan_date['price_value'],
			);
			echo json_encode(array('code'=>1, 'editable'=>$editable, 'ret_data'=>$ret_data));
		}catch (Exception $e){
			echo $e->getMessage();
		}
	}

	private function validate_plan_data(){

		$config = array(
			array(
				'field' => 'plan_name',
				'label' => 'Plan Name',
				'rules' => 'trim|required|xss_clean|callback_is_package_exists',
				'errors' => array(
					'required' => 'Plan name is required',
				),
			),
			array(
				'field' => 'validity_period',
				'label' => 'Validity Period',
				'rules' => 'trim|required|xss_clean',
				'errors' => array(
					'required' => 'Select a Validity Period',
				),
			),
			array(
				'field' => 'validity_duration',
				'label' => 'Validity Duration',
				'rules' => 'trim|required|xss_clean',
				'errors' => array(
					'required' => 'Define Validity Duration',
				),
			),
			array(
				'field' => 'effective_date',
				'label' => 'Effective Date',
				'rules' => 'trim|required|xss_clean|callback_date_is_greater_than',
				'errors' => array(
					'required' => 'Effective Date is required',
				),
			),
			array(
				'field' => 'no_of_allowed_post',
				'label' => 'No of Allowed Posts',
				'rules' => 'trim|required|xss_clean|is_natural_no_zero',
				'errors' => array(
					'required' => 'No of Allowed Posts is required',
					'is_natural_no_zero' => 'No of posts must be more than 0 and whole number',
				),
			),
			array(
				'field' => 'price_currency',
				'label' => 'Currency',
				'rules' => 'trim|required|xss_clean',
				'errors' => array(
					'required' => 'Currency is required',
				),
			),
			array(
				'field' => 'price_value',
				'label' => 'Price Value',
				'rules' => 'trim|required|xss_clean|greater_than[-1]|numeric',
				'errors' => array(
					'required' => 'Price Value is required',
					'greater_than' => 'Price cannot in negative values',
					'numeric' => 'Price must be numeric value',
				),
			),
		);

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE) {
			header("HTTP/1.1 449 Retry With");
			return array(validation_errors());
		}
		else {
			return TRUE;
		}
	}

	public function delete_plan()
	{
		$plan = $this->input->post();
		$record_id = $plan['rec_id'];
		$reason = $plan['reason'];
		$pkg_id = $plan['pkg_id'];

		try {
			$resolve = $this->check_effective_date_not_crossed($record_id);
			if ($resolve) {
				$this->db->trans_begin();
				$this->job_plan->delete_plan($record_id);
				if ($this->db->trans_status() === FALSE) {
					$res = $this->db->trans_rollback();
					echo json_encode(array('res' => $res, 'code' => 0, 'message' => 'Error! Update failed'));
				}
				else {
					$res = $this->db->trans_commit();
					$log = "Deleted, package data, Package ID: " . $pkg_id . " record id: " . $record_id . ", reason: ".$reason; //Logging the event
					audit_edit_logger($log);
					echo json_encode(array('res' => $res, 'code' => 1, 'message' => 'Package Deleted Successfully'));
				}
			} else {
				echo json_encode(array(
					'res' => $resolve,
					'code' => 0,
					'message' => 'This package cannot be deleted since it has passed the effective date and live to the user'));
			}
		} catch (Exception $e) {
			echo json_encode(array('res' => $resolve, 'code' => 1, 'message' => 'Something Went Wrong'));
		}

	}

	public function is_package_exists($package_name){
		$id = $this->input->post('rec_id');
		if (!empty($id))
			$is_exist = $this->job_plan->check_package_exists($package_name, $id);
		else
			$is_exist = $this->job_plan->check_package_exists($package_name);

		if ($is_exist) {
			$this->form_validation->set_message('is_package_exists', 'There is a package with same name exists already, You cannot create with same name again while it is active');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function switch_plan(){
		try {
			$rec = $this->input->post();

			$record_id = $rec['rec_id'];
			$reason = $rec['reason'];
			$pkg_id = $rec['pkg_id'];

			$this->db->trans_begin();
			$this->job_plan->update_plan($record_id, array('status'=>$rec['is_active']));

			//Logging the event
			if ($rec['is_active'])
				audit_edit_logger('Activated, Package id '.$pkg_id.", reason: ".$reason);
			else
				audit_edit_logger('Deactivated, Package id '.$pkg_id.", reason: ".$reason);

			if ($this->db->trans_status() === FALSE) {
				$res = $this->db->trans_rollback();
				echo json_encode(array('res' => $res, 'code' => 0, 'message' => 'Error! Update failed'));
			}
			else {
				$res = $this->db->trans_commit();

				echo json_encode(array('res' => $res, 'code' => 1, 'message' => 'Changed Successfully'));
			}

			$this->db->trans_complete();

		} catch (Exception $e) {
			$this->db->trans_rollback();
			return $e->getMessage();
		}
	}

	public function date_is_greater_than($date){
		if (date("Y-m-d", strtotime($date)) >= date("Y-m-d")) {
			return TRUE;
		} else {
			$this->form_validation->set_message('date_is_greater_than', 'Effective date should be a future date from now');
			return FALSE;
		}
	}

	private function check_effective_date_not_crossed($plan_id){
		try {
			$plan = $this->job_plan->get_plan($plan_id);
			if (date("Y-m-d", strtotime($plan['effective_date'])) > date("Y-m-d"))
				return TRUE;
			else
				return FALSE;
		} catch (Exception $e) {
			return FALSE;
		}
	}
}
