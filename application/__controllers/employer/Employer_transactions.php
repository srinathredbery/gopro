<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 8/17/2018
 * Time: 3:31 PM
 */

class Employer_transactions extends Main_Controller
{

	private $company_id;
	private $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Package_plans_model', 'plans_model');
		$this->load->model('Orders_transaction_model', 'orders');
		$this->company_id = $this->session->company_id;
		$this->user_id = $this->session->user_id;
	}

	public function transaction_history()
	{
		$orders = $this->orders->get_all_orders($this->company_id);
		$data['ordered_item_list'] = $this->orders->get_all_order_item($this->company_id);

		foreach ($orders as $key => $order) {
			$orders[$key]->status = $orders[$key]->order_status;
			$orders[$key]->pay_type = $orders[$key]->payment_type;

			$orders[$key]->order_status = !empty($order->order_status) ? parse_status($order->order_status) : '';
			$orders[$key]->payment_type = !empty($order->payment_type) ? parse_payment_type($order->payment_type) : '';
			$orders[$key]->payment_mode = !empty($order->payment_mode) ? parse_payment_mode($order->payment_mode): '';
		}

		$data['orders'] = $orders;

		$data['page_title'] = 'Order History';
		$data['main_content'] = 'employer/employer_order_transactions';

		//load main content page
		$this->load->view('templates/template_employer', $data);
	}

	public function process_offline_transaction2()
	{
//		$validation = $this->validate_tnx_form_data(); //form validation
		try {
//			if ($validation === TRUE) {
				$form_data = $this->input->post();
				$tnx_no = $this->generate_tnx_number('offline', 'cash');

				$tnx_data = array();
				$tnx_data['tnx_no'] = $tnx_no;
				$tnx_data['order_no'] = $form_data['ono'];
				$tnx_data['payment_mode'] = "offline";
				$tnx_data['payment_type'] = 'cash';
				$tnx_data['tnx_status'] = 'pending';
				$tnx_data['amount'] = $form_data['amount'];
				if (!empty($form_data['cheque_no']))
					$tnx_data['cheque_no'] = $form_data['cheque_no'];
				if (!empty($form_data['reference_id']))
					$tnx_data['offline_reference_id'] = $form_data['reference_id'];

				$this->db->trans_begin();
				$this->orders->create_transaction($tnx_data);
				set_new_document_code('trans'); //set counter increment;

				if ($this->db->trans_status() === FALSE) {
					$res = $this->db->trans_rollback();
					echo json_encode(array('res' => $res, 'code' => 0, 'message' => 'Transaction Failed'));
				} else {
					$res = $this->db->trans_commit();
					echo json_encode(array('res' => $res, 'code' => 1, 'message' => 'Transaction Proof Submitted', 'tnx_no' => $tnx_no));
				}
//			} else {
//				header("HTTP/1.1 449 Retry With");
//				echo json_encode(array('code' => 449, 'message' => $validation));
//			}
		} catch (Exception $e) {
			$this->db->trans_rollback();
			echo json_encode(array('res' => FALSE, 'code' => 0, 'message' => 'Transaction Failed', 'error' => $e));
		}


	}


	public function process_offline_transaction()
	{
		$validation = $this->validate_tnx_form_data(); //form validation
		try {
			if ($validation === TRUE) {
				$form_data = $this->input->post();
				$tnx_no = $this->generate_tnx_number('offline', $form_data['payment_type']);

				$tnx_data = array();
				$tnx_data['tnx_no'] = $tnx_no;
				$tnx_data['order_no'] = $form_data['ono'];
				$tnx_data['payment_mode'] = "offline";
				$tnx_data['payment_type'] = $form_data['payment_type'];
				$tnx_data['tnx_status'] = 'pending';
				$tnx_data['amount'] = $form_data['amount'];
				if (!empty($form_data['cheque_no']))
					$tnx_data['cheque_no'] = $form_data['cheque_no'];
				if (!empty($form_data['reference_id']))
					$tnx_data['offline_reference_id'] = $form_data['reference_id'];

				$this->db->trans_begin();
				$this->orders->create_transaction($tnx_data);
				set_new_document_code('trans'); //set counter increment;

				if ($this->db->trans_status() === FALSE) {
					$res = $this->db->trans_rollback();
					echo json_encode(array('res' => $res, 'code' => 0, 'message' => 'Transaction Failed'));
				} else {
					$res = $this->db->trans_commit();
					echo json_encode(array('res' => $res, 'code' => 1, 'message' => 'Transaction Proof Submitted', 'tnx_no' => $tnx_no));
				}
			} else {
				header("HTTP/1.1 449 Retry With");
				echo json_encode(array('code' => 449, 'message' => $validation));
			}
		} catch (Exception $e) {
			$this->db->trans_rollback();
			echo json_encode(array('res' => FALSE, 'code' => 0, 'message' => 'Transaction Failed', 'error' => $e));
		}


	}

	public function submit_transaction_proof_uploads()
	{
		$tnx_no = $this->input->post('tnx_id');
		$order_no = $this->input->post('ono');
		$original_file_name = pathinfo($_FILES['tnx_proof_file']['name'], PATHINFO_FILENAME);
		$file_name = $tnx_no . '_' . $original_file_name;
		$upl_dir = TNX_PROOF_SAVE_DIR . '/' . $order_no . '/' . $tnx_no . '/';

		$config['upload_path'] = $upl_dir;
		$config['allowed_types'] = 'pdf|jpeg|jpg|png';
		$config['max_size'] = 5000;
		$config['remove_spaces'] = true;
		$config['file_name'] = $file_name;

		$this->load->library('upload', $config);

		if (!is_dir($upl_dir)) {
			mkdir($upl_dir, 0777, true);
		}

		if (!$this->upload->do_upload('tnx_proof_file')) {
			$error = array('error' => $this->upload->display_errors());
			echo json_encode(array('res' => FALSE, 'code' => 0, 'error' => $error));
		} else {

			$upload_status = ($this->upload->data());

			$proof = array();
			$proof['tnx_no'] = $tnx_no;
			$proof['file_dir'] = $order_no . '/' . $tnx_no . '/';
			$proof['file'] = $upload_status['file_name'];
			$proof['added_by'] = $this->user_id;
			$res = $this->orders->create_transaction_proofs($proof);

			echo json_encode(array('res' => $res, 'code' => 1, 'file' => $upload_status));
		}
	}

	public function revoke_pending_tnx(){
		$tnx_no = $this->input->post('id');

		if ($tnx_no) {
			$this->db->trans_begin();
			$this->orders->revoke($tnx_no, array('is_deleted' => 2));
			$this->orders->revoke_proofs($tnx_no, array('is_deleted' => 2));
			if ($this->db->trans_status() === FALSE) {
				$res = $this->db->trans_rollback();
				echo json_encode(array('res' => $res, 'code' => 0, 'message' => 'Revoke failed'));
			} else {
				$res = $this->db->trans_commit();
				echo json_encode(array('res' => $res, 'code' => 1, 'message' => 'Transaction Revoked Successfully'));
			}
		}
		else{
			echo json_encode(array('res' => false, 'code' => 0, 'message' => 'Revoke failed'));
		}
	}

	private function validate_tnx_form_data()
	{
		$trans_type = $this->input->post('payment_type');

		if ($trans_type == 'cheque' || $trans_type == 'Cheque') {
			$this->form_validation->set_rules('cheque_no', 'Cheque No', 'trim|required|xss_clean');
		}

		$config = array(
			array(
				'field' => 'reference_id',
				'label' => 'Transaction ID / Reference ID / Document ID',
				'rules' => 'trim|required|xss_clean',
				'errors' => array(
					'required' => '{field} is required',
				),
			),
			array(
				'field' => 'amount',
				'label' => 'Amount',
				'rules' => 'trim|required|xss_clean|greater_than[0]|numeric',
				'errors' => array(
					'required' => '{field} is required',
					'greater_than' => '{field} must be more than 0',
					'numeric' => '{field} must be numeric value',
				),
			),
		);

//		if (empty($_FILES['proof_file']['name'])){
//			$this->form_validation->set_rules('proof_file', 'Transaction Proof Attachment', 'required',
//				array(
//					'required' => 'Transaction Proof Attachment is required',
//				)
//			);
//		}

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE) {
			header("HTTP/1.1 449 Retry With");
			return array(validation_errors());
		} else {
			return TRUE;
		}
	}

	private function generate_tnx_number($pay_mode, $pay_type)
	{
		$last_counter = get_document_code('trans');

		$mode = 'OF';
		if ($pay_mode == 'offline' || $pay_mode == 'Offline')
			$mode = 'OF';
		elseif ($pay_mode == 'offline' || $pay_mode == 'Offline')
			$_mode = 'ON';
		else
			$mode = 'OR';

		$type = 'OTR';
		if ($pay_type == 'cheque' || $pay_type == 'Cheque') {
			$type = 'CHQ';
		} elseif ($pay_type == 'cash' || $pay_type == 'Cash') {
			$type = "CSH";
		} elseif ($pay_type == 'bank' || $pay_type == 'Bank') {
			$type = "TRF";
		} else {
			$type = "OTR";
		}


		if (empty($last_counter->counter)) {
			$res = set_new_document_code('trans', 1);
			return $mode . date('Ymd') . $type . str_pad($last_counter->counter + 1, 5, '0', STR_PAD_LEFT);
		} else {
			return $mode . date('Ymd') . $type . str_pad($last_counter->counter + 1, 5, '0', STR_PAD_LEFT);
		}
	}
}
