<?php


class Su_job_posting_orders extends Main_Controller
{
	private $company_id;
	private $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Su_order_processing_model', 'order_process');
		$this->company_id = $this->session->company_id;
		$this->user_id = $this->session->user_id;
	}

	public function view_orders(){

		$data['page_title'] = 'Orders &bull; Super User';
		$data['main_content'] = 'superuser/su_job_post_plans_orders';

		//load main content page
		$this->load->view('templates/template_superuser', $data);
	}

	public function get_orders_data(){
		$dt_data = $this->input->get();

		$draw = $dt_data['draw'];
		$search_key = array(
			'employer.employer_name' => $dt_data['search'],
			'orders.amount_value' => $dt_data['search'],
			'orders.order_no' => $dt_data['search'],
			);

		$filter = array(
			'order_status'=>$dt_data['order_status_filter'],
			'payment_status'=>$dt_data['pay_status_filter']
		);
		$limit = array(
			'start'=>$dt_data['start'],
			'length'=>$dt_data['length']
		);
		$order_by = array($dt_data['columns'][$dt_data['order'][0]['column']]['name'] => $dt_data['order'][0]['dir']);

		$query_params = array(
			'search'=>$search_key,
			'limit'=>$limit, 'sort'=>$order_by,
			'filter'=>$filter
		);

		$response = $this->order_process->get_all_orders($query_params);

		$data = array();
		foreach ($response['results'] as $order){
			$order_no = '<span class="applied-field">'.$order->order_no ??''.'</span>';
			$order_time = date("Y/m/d H:i:s", strtotime($order->order_timestamp));
			$order_time = '<span class="applied-field flo">'.$order_time ??''.'</span>';
			$employer_name = '<span class="applied-field">'.$order->employer_name ??''.'</span>';
			$amount_value = number_format($order->amount_value, 2);
			$currency = $order->currency;
			$amount_value = '<span class="applied-field float-right">'.$currency.' '.$amount_value ??''.'</span>';
			$order_status = !empty($order->order_status) ? parse_status($order->order_status) : '';
			$order_status = '<span class="applied-field status '.$order->order_status.'">'. $order_status .'</span>';
			$pay_status = !empty($order->order_status) ? parse_status($order->payment_status) : '';
			$pay_status = '<span class="applied-field status '.$order->payment_status.'">'. $pay_status.'</span>';
			$pay_status .= !empty($order->tnx_no) ? '<span class=" float-right badge status bcg-other"><i class="la la-file-invoice-dollar"></i></span>': '';
			$url = base_url('superuser/job_posting_plans/orders/view_order');
			$url = !empty($order->order_no) ? $url.'?ono='.$order->order_no: '';

			$action_column = '<a href="'.$url.'" target="_blank">
								<div class="action-resume" data-ono="'.$order->order_no.'" >
									<div class="action-center">
										<span class="px-3">View ...</span>
									</div>
								</div>
							</a>';

			$data[]=array($order_no, $order_time, $employer_name, $amount_value, $order_status, $pay_status, $action_column);
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $response['total_rows'],
			"recordsFiltered" => $response['total_rows'],
			"data" => $data,
		);

		echo json_encode($output);
	}

	public function view_order_approval(){
		$order_no = $this->input->get('ono');

		if (!empty($order_no)){
			$order = $this->order_process->get_order($order_no);

			if (!empty($order)) {
				$order->status = parse_status($order->order_status);
				$order->payment_status_raw = ($order->payment_status);
				$order->payment_status = parse_status($order->payment_status);
				$order->payment_type = parse_payment_type($order->payment_type);
				$order->payment_mode = parse_payment_mode($order->payment_mode);
				$order->amount_value = number_format($order->amount_value, 2);
				$address = '';
				$address .= !empty($order->employer_address_1) ? $order->employer_address_1 . ',' : '';
				$address .= !empty($order->employer_address_2) ? $order->employer_address_2 . ',' : '';
				$address .= !empty($order->employer_city) ? $order->employer_city . ',' : '';
				$address .= !empty($order->CountryDes) ? $order->CountryDes . ',' : '';
				$order->billing_address = $address;
				$order_items = $this->order_process->get_ordered_items($order_no);
				foreach ($order_items as $key => $item) {
					$order_items[$key]->pkg_id = strtoupper($order_items[$key]->pkg_id);
					$order_items[$key]->quantity = number_format($order_items[$key]->quantity, 1);
					$order_items[$key]->value = number_format($order_items[$key]->value, 2);
					$order_items[$key]->item_name = $order_items[$key]->plan_name . ' (' . $order_items[$key]->pkg_id . ')';
				}
				$order_txns = $this->order_process->get_order_tnxs($order_no);
				foreach ($order_txns as $i => $txn) {
					$txn_proofs = $this->order_process->get_order_tnx_proof($txn->tnx_no);
					foreach ($txn_proofs as $key => $proof) {
						$proof->file_dir = TNX_PROOF_READ_DIR . $proof->file_dir . $proof->file;
					}
					$order_txns[$i]->payment_proofs = $txn_proofs;
					$txn->amount = number_format($txn->amount, 2);
					$txn->status = parse_status($txn->tnx_status);
					$txn->payment_type = parse_payment_type($txn->payment_type);
					$txn->payment_mode = parse_payment_mode($txn->payment_mode);
					$txn->remarks = !empty($txn->remarks) ? ($txn->remarks == "true") ? "Proofs Matched" :  $txn->remarks : "" ;
				}
				$order->order_item = $order_items;
				$order->transactions = $order_txns;
				$data['order'] = $order;
			}

			$data['page_title'] = 'Order #'.$order_no.' &bull; Super User';
			$data['main_content'] = 'superuser/su_job_order_review';

			//load main content page
			$this->load->view('templates/template_superuser', $data);
		} else {
			$data['page_title'] = 'Orders &bull; Super User';
			$data['main_content'] = 'superuser/su_job_order_review';

			//load main content page
			$this->load->view('templates/template_superuser', $data);
		}
	}

	public function get_order_data(){
		try{
			$message='';

			$order_no = $this->input->get('ono');

			$order = $this->order_process->get_order($order_no);

			$order->status = parse_status($order->order_status);
			$order->payment_status_raw = ($order->payment_status);
			$order->payment_status = parse_status($order->payment_status);
			$order->payment_type = parse_payment_type($order->payment_type);
			$order->payment_mode = parse_payment_mode($order->payment_mode);
			$order->amount_value = number_format($order->amount_value, 2);

			$address = '';
			$address .= !empty($order->employer_address_1) ? $order->employer_address_1. ',': '';
			$address .= !empty($order->employer_address_2) ? $order->employer_address_2. ',': '';
			$address .= !empty($order->employer_city) ? $order->employer_city. ',': '';
			$address .= !empty($order->CountryDes) ? $order->CountryDes. ',': '';

			$order->billing_address = $address;

			$order_items = $this->order_process->get_ordered_items($order_no);

			foreach ($order_items as $key => $item){
				$order_items[$key]->pkg_id = strtoupper($order_items[$key]->pkg_id);
				$order_items[$key]->quantity = number_format($order_items[$key]->quantity, 1);
				$order_items[$key]->value = number_format($order_items[$key]->value, 2);
				$order_items[$key]->item_name = $order_items[$key]->plan_name.' ('.$order_items[$key]->pkg_id.')';
			}

			$order_txns = $this->order_process->get_order_tnxs($order_no);

			foreach ($order_txns as $i => $txn){
				$txn_proofs = $this->order_process->get_order_tnx_proof($txn->tnx_no);
				foreach ($txn_proofs as $key=> $proof){
					$proof->file_dir = TNX_PROOF_READ_DIR.$proof->file_dir.$proof->file;
				}
				$order_txns[$i]->payment_proofs = $txn_proofs;
				$txn->amount = number_format($txn->amount, 2);
				$txn->status = parse_status($txn->tnx_status);
				$txn->payment_type = parse_payment_type($txn->payment_type);
				$txn->payment_mode = parse_payment_mode($txn->payment_mode);

			}

			$order->order_item = $order_items;
			$order->transactions = $order_txns;


			$order_res = array(
				'res'=>TRUE,
				'code' => 1,
				'message' => $message,
				"order" => $order
			);
			echo json_encode($order_res);
		}catch (Exception $e){
			$message= "An Error Has Occurred";
			$order_res = array(
				'res'=>FALSE,
				'code' => 0,
				'message' => $message,
				'error'=>$e
			);
			echo json_encode($order_res);
		}


	}

	public function transaction_approval(){
		$form_data = $this->input->post();

		$txn_no = $form_data['tnx_no'];
		$txn_status = $form_data['tnx_status'];
		$txn_remarks = $form_data['reason'];
		$order_no = $form_data['order_no'];
		$employer_id = "";

		try {

			$this->db->trans_begin();

			$order = $this->order_process->get_order($order_no);
			$employer_id = $order->employer_id;

			$res = $this->order_process->update_txn_status($txn_no, array("tnx_status"=>$txn_status, "remarks" =>$txn_remarks));
			$pending_payments = $this->order_process->validate_txn_status($order_no);
			$pending_payments_count = count($pending_payments);
			$order_status = null;
			$order_status_raw = null;
			$payment_status = null;
			$payment_status_raw = null;


			if ($pending_payments_count < 1 ){
				$order_status_raw = "success";
				$order_status = parse_status("success");
				$payment_status_raw = "completed";
				$payment_status= parse_status("completed");
				$res = $this->order_process->update_order_status($order_no, array("payment_status"=>$payment_status_raw,"order_status"=>$order_status_raw));

				//***add subscription to profile
				$ordered_items = $this->order_process->get_ordered_items($order->order_no);


				foreach ($ordered_items as $pkg) {
					$subs_exists = $this->order_process->check_subscription_exists($employer_id); //check subscription exists

					$no_of_posts = $pkg->no_of_allowed_post;
					$validity = $pkg->validity_period;
					$duration = $pkg->validity_duration;

					switch ($validity) {
						case "w" :
							$validity =  "WEEK";
							break;
						case "m" :
							$validity = "MONTH";
							break;
						case "a" :
							$validity = "YEAR";
							break;
						default:
							$validity = "WEEK";
							break;
					}

					if (!empty($subs_exists)) { 			//exists then update
						//check if the existing is expired or not
						$current_exp_date = strtotime($subs_exists->expiry_date);
						$current_date = strtotime('today');

						$new_expiry = "(DATE_ADD(expiry_date, INTERVAL ".$duration." ".$validity."))";

						if ($current_exp_date > $current_date){
							//if existing subs expired then reset to zeo else add with existing
							$subs = array("no_of_posts"=>"no_of_posts+".$no_of_posts, "expiry_date"=>$new_expiry);

						}
						else
						{
							$new_expiry = "(DATE_ADD(CURRENT_DATE() , INTERVAL ".$duration." ".$validity."))";
							$subs = array("no_of_posts"=>$no_of_posts, "expiry_date"=>$new_expiry);
						}

						$this->order_process->update_subscription($employer_id, $subs);

					} else { 							//not exists then create
						$new_expiry = "(DATE_ADD(CURRENT_DATE,INTERVAL ".$duration." ".$validity."))";
						$subs = array("employer_id" => $employer_id, "no_of_posts"=>$no_of_posts, "expiry_date"=>$new_expiry);
						$res = $this->order_process->create_subscription($subs);
					}
				}
			}

			if ($this->db->trans_status() === FALSE) {
				$res = $this->db->trans_rollback();
				echo json_encode(array('res' => $res, 'code' => 0, 'message' => 'Process failed'));
			} else {
				$res = $this->db->trans_commit();
				$t_status = parse_status($txn_status);

				$response = array(
					'res' => $res,
					'code' => 1);

				$response["tnx"] = array(
					'pending' => $pending_payments_count,
					'order_no'=> $order_no,
					'txn_no'=> $txn_no,
					'txn_status'=> $t_status,
					'txn_status_raw'=> $txn_status,
					'message' => 'Transaction '.$txn_no.' updated to '.$t_status,
					'remarks' => !empty($txn_remarks) ? ($txn_remarks == "true") ? "Proofs Matched" :  $txn_remarks : ""
				);

				$response["order"] = array(
					"order_status"=>$order_status,
					"order_status_raw"=>$order_status_raw,
					"payment_status"=>$payment_status,
					"payment_status_raw"=>$payment_status_raw,
					'message' => !empty($order_status) ? 'Order #'.$order_no.' updated to '.$order_status : null
				);

				echo json_encode($response);
			}
		} catch (Exception $e) {
			$this->db->trans_rollback();
			echo json_encode(array('res' => FALSE, 'code' => 0, 'message' => 'Process failed', 'error' => $e));
		}

//		echo json_encode($form_data);
	}
}
