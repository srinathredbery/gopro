<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 8/17/2018
 * Time: 3:31 PM
 */

class Employer_payment_plans extends Main_Controller
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

	public function view_plans()
	{
		$data['plans'] = $this->plans_model->get_active_job_plans();

		$data['page_title'] = 'Payment Plans';
		$data['main_content'] = 'employer/employer_payment_plans';

		//load main content page
		$this->load->view('templates/template_employer', $data);
	}

	public function view_plan()
	{
		//View the plan for purchasing
		$plan_id = $this->input->get('pkg');

		if ($plan_id) {
			$data['plan'] = $this->plans_model->get_selected_package($plan_id);
			$fields = 'employer.employer_name, 
						employer.employer_email, 
						employer.employer_contact_person_name,
						employer.employer_contact_person_contact,
						employer.employer_contact_person_email,
						employer.employer_contact_person_contact_idd_code';
			$data['company_info'] = $this->master_dml_model->get_data('employer', $fields, array('employer_id' => $this->company_id));
			$data['plan']['validity_period'] = !empty($data['plan']['validity_period']) && !empty($data['plan']['validity_duration']) ?
				($data['plan']['validity_period'] == 'w' ? ($data['plan']['validity_duration'] > 1 ? $data['plan']['validity_duration'] . ' Weeks' : $data['plan']['validity_duration'] . ' Week') :
					($data['plan']['validity_period'] == 'm' ? ($data['plan']['validity_duration'] > 1 ? $data['plan']['validity_duration'] . ' Months' : $data['plan']['validity_duration'] . ' Month') :
						($data['plan']['validity_period'] == 'a' ? ($data['plan']['validity_duration'] > 1 ? $data['plan']['validity_duration'] . ' Years' : $data['plan']['validity_duration'] . ' Year') : '')
					)
				) : '';
			$data['page_title'] = 'Subscription Checkout';
			$data['main_content'] = 'employer/employer_buy_plans';//load main content page
			$this->load->view('templates/template_employer', $data);
		} else {
			redirect('employer/subscription/plans');
		}
	}

	//Customer places the order
	public function place_job_post_package_order()
	{
		$validation = $this->validate_purchase_form_data(); //form validation

		try {
			if ($validation === TRUE) {
				$form_data = $this->input->post();
				$order_no = $this->generate_order_number();
				$product_info = $this->plans_model->get_selected_package($form_data['product_id'], TRUE);

				$purchase_order = array();
				$purchase_order['order_no'] = $order_no;
				$purchase_order['currency'] = $product_info['price_currency'];
				$purchase_order['amount_value'] = $product_info['price_value'];
				$purchase_order['employer_id'] = $this->company_id;
				$purchase_order['user_id'] = $this->user_id;
				$purchase_order['billing_name'] = $form_data['billing_name'];
				$purchase_order['billing_email'] = $form_data['billing_email'];
				$purchase_order['billing_phone'] = $form_data['contact_phone_number'];
				$purchase_order['payment_mode'] = $form_data['payment_mode'];
				$purchase_order['payment_type'] = $form_data['payment_type'];

				$order_item = array();
				$order_item['order_no'] = $order_no;
				$order_item['item_code'] = $product_info['pkg_id'];
				$order_item['quantity'] = 1;
				$order_item['value'] = $product_info['price_value'];


				$this->db->trans_begin();
				$this->orders->create_order($purchase_order);
				$this->orders->create_order_item_list($order_item);
				set_new_document_code('order'); //set counter increment;

				if ($this->db->trans_status() === FALSE) {
					$res = $this->db->trans_rollback();
					echo json_encode(array('res' => $res, 'code' => 0, 'message' => 'Order Failed'));
				} else {
					$res = $this->db->trans_commit();
					$go_to = base_url('employer/orders/summary?ono=' . $order_no);
					echo json_encode(array('res' => $res, 'code' => 1, 'message' => 'Order Confirmed', 'go_to' => $go_to));
				}
			} else {
				header("HTTP/1.1 449 Retry With");
				echo json_encode(array('code' => 449, 'message' => $validation));
			}
		} catch (ErrorException $e) {
			$this->db->trans_rollback();
			echo json_encode(array('res' => FALSE, 'code' => 0, 'message' => 'Order Failed', 'error' => $e));
		}
	}

	public function place_job_post_package_order2()
	{
		$validation = $this->validate_purchase_form_data2(); //form validation

		try {
			if ($validation === TRUE) {
				$form_data = $this->input->post();
				$order_no = $this->generate_order_number();
				$product_info = $this->plans_model->get_selected_package($form_data['product_id'], TRUE);

				$purchase_order = array();
				$purchase_order['order_no'] = $order_no;
				$purchase_order['currency'] = $product_info['price_currency'];
				$purchase_order['amount_value'] = $product_info['price_value'];
				$purchase_order['employer_id'] = $this->company_id;
				$purchase_order['user_id'] = $this->user_id;
				$purchase_order['billing_name'] = $form_data['billing_name'];
				$purchase_order['billing_email'] = $form_data['billing_email'];
				$purchase_order['billing_phone'] = $form_data['contact_phone_number'];
				$purchase_order['payment_mode'] = 'Offline';
				$purchase_order['payment_type'] = 'cash';

				$order_item = array();
				$order_item['order_no'] = $order_no;
				$order_item['item_code'] = $product_info['pkg_id'];
				$order_item['quantity'] = 1;
				$order_item['value'] = $product_info['price_value'];


				$this->db->trans_begin();
				$this->orders->create_order($purchase_order);
				$this->orders->create_order_item_list($order_item);
				set_new_document_code('order'); //set counter increment;

				if ($this->db->trans_status() === FALSE) {
					$res = $this->db->trans_rollback();
					echo json_encode(array('res' => $res, 'code' => 0, 'message' => 'Order Failed'));
				} else {
					$res = $this->db->trans_commit();
					$go_to = base_url('employer/orders/summary?ono=' . $order_no);
					echo json_encode(array('res' => $res, 'code' => 1, 'message' => 'Order Confirmed', 'go_to' => $go_to));
				}
			} else {
				header("HTTP/1.1 449 Retry With");
				echo json_encode(array('code' => 449, 'message' => $validation));
			}
		} catch (ErrorException $e) {
			$this->db->trans_rollback();
			echo json_encode(array('res' => FALSE, 'code' => 0, 'message' => 'Order Failed', 'error' => $e));
		}
	}

	public function order_summary()
	{
		$order_id = $this->input->get('ono');

		if ($order_id) {
			$order = $this->orders->get_order_data($order_id);
			$ordered_items = $this->orders->get_order_item($order_id);
			$order_tnxs = $this->orders->get_order_transactions($order_id);

			if (!empty($order)) {
				$order->payment_mode_raw = $order->payment_mode;
				$order->payment_mode = !empty($order->payment_mode) ? parse_payment_mode($order->payment_mode) : '';

				$order->payment_type_raw = $order->payment_type;
				$order->payment_type = !empty($order->payment_type) ? parse_payment_type($order->payment_type) : '';

				$order->order_status_raw = $order->order_status;
				$order->order_status = !empty($order->order_status) ? parse_status($order->order_status) : '';

				$order->payment_status_raw = $order->payment_status;
				$order->payment_status = !empty($order->payment_status) ? parse_status($order->payment_status) : '';

				foreach ($ordered_items as $key => $item) {
					$ordered_items[$key]->validity_period = !empty($item->validity_period) && !empty($item->validity_duration) ?
						($item->validity_period == 'w' ? ($item->validity_duration > 1 ? $item->validity_duration . ' Weeks' : $item->validity_duration . ' Week') :
							($item->validity_period == 'm' ? ($item->validity_duration > 1 ? $item->validity_duration . ' Months' : $item->validity_duration . ' Month') :
								($item->validity_period == 'a' ? ($item->validity_duration > 1 ? $item->validity_duration . ' Years' : $item->validity_duration . ' Year') : '')
							)
						) : '';
				}

				$data['order'] = $order;
			}


			if (!empty($order_tnxs)) {
				foreach ($order_tnxs as $key => $tnx) {
					$order_tnxs[$key]->tnx_status_raw = $order_tnxs[$key]->tnx_status;
					$order_tnxs[$key]->payment_type_raw = $order_tnxs[$key]->payment_type;

					$order_tnxs[$key]->tnx_status = !empty($tnx->tnx_status) ? parse_status($tnx->tnx_status) : '';

					$order_tnxs[$key]->payment_mode = !empty($tnx->payment_mode) ?parse_status($tnx->payment_mode) : '';

					$order_tnxs[$key]->payment_type = !empty($tnx->payment_type) ? parse_payment_type($tnx->payment_type) : '';

					$order_tnxs[$key]->tnx_timestamp = date("M d, Y / H:m:i", strtotime($order_tnxs[$key]->tnx_timestamp));
					$order_tnxs[$key]->files = $this->orders->get_order_transaction_proof_files($order_tnxs[$key]->tnx_no);
					$order_tnxs[$key]->amount = number_format($order_tnxs[$key]->amount, 2);

				}
				$data['transactions'] = $order_tnxs;
			}

			$data['ordered_items'] = $ordered_items;


			$data['page_title'] = 'Order Summary';
			$data['main_content'] = 'templates/order_summary/purchase_summary_receipt';

			//load main content page
			$this->load->view('templates/template_employer', $data);

		} else {
			redirect('/employer/transactions');
		}

	}

	private function generate_order_number()
	{
		$last_counter = get_document_code('order');
		if (empty($last_counter->counter)) {
			$res = set_new_document_code('order', 1);
			return date('Ymd') . str_pad($last_counter->counter + 1, 4, '0', STR_PAD_LEFT);
		} else {
			return date('Ymd') . str_pad($last_counter->counter + 1, 4, '0', STR_PAD_LEFT);
		}
	}

	private function validate_purchase_form_data()
	{

		$config = array(
			array(
				'field' => 'employer_name',
				'label' => 'Employer Name',
				'rules' => 'trim|required|xss_clean',
				'errors' => array(
					'required' => 'Employer Name is required',
				),
			),
			array(
				'field' => 'billing_email',
				'label' => 'Email',
				'rules' => 'trim|required|xss_clean|valid_email',
				'errors' => array(
					'required' => 'You must provide a valid email',
					'valid_email' => 'Your email is not valid',
				),
			),
			array(
				'field' => 'billing_name',
				'label' => 'Name',
				'rules' => 'trim|required|xss_clean',
				'errors' => array(
					'required' => 'Name is required',
				),
			),
			array(
				'field' => 'contact_phone_number',
				'label' => 'Contact No',
				'rules' => 'trim|required|xss_clean',
				'errors' => array(
					'required' => 'Contact No is required',
//					'greater_than' => 'Contact No must be more than 0',
//					'numeric' => 'Contact No must be valid value',
				),
			),
			array(
				'field' => 'payment_mode',
				'label' => 'Payment Mode',
				'rules' => 'trim|required|xss_clean',
				'errors' => array(
					'required' => '{field} is required',
				),
			),
			array(
				'field' => 'payment_type',
				'label' => 'Payment Type',
				'rules' => 'trim|required|xss_clean',
				'errors' => array(
					'required' => '{field} is required',
				),
			),
		);

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE) {
			header("HTTP/1.1 449 Retry With");
			return array(validation_errors());
		} else {
			return TRUE;
		}
	}

	private function validate_purchase_form_data2()
	{

		$config = array(
			array(
				'field' => 'employer_name',
				'label' => 'Employer Name',
				'rules' => 'trim|required|xss_clean',
				'errors' => array(
					'required' => 'Employer Name is required',
				),
			),
			array(
				'field' => 'billing_email',
				'label' => 'Email',
				'rules' => 'trim|required|xss_clean|valid_email',
				'errors' => array(
					'required' => 'You must provide a valid email',
					'valid_email' => 'Your email is not valid',
				),
			),
			array(
				'field' => 'billing_name',
				'label' => 'Name',
				'rules' => 'trim|required|xss_clean',
				'errors' => array(
					'required' => 'Name is required',
				),
			),
			array(
				'field' => 'contact_phone_number',
				'label' => 'Contact No',
				'rules' => 'trim|required|xss_clean',
				'errors' => array(
					'required' => 'Contact No is required',
//					'greater_than' => 'Contact No must be more than 0',
//					'numeric' => 'Contact No must be valid value',
				),
			),

		);

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE) {
			header("HTTP/1.1 449 Retry With");
			return array(validation_errors());
		} else {
			return TRUE;
		}
	}
}
