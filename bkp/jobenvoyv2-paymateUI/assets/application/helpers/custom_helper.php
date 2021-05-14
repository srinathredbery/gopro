<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: simfyz
 * Date: 9/26/2018
 * Time: 2:21 PM
 */

if (!function_exists('get_current_url')) {
	function get_current_url()
	{
		$pageURL = 'http';
		if(isset($_SERVER["HTTPS"]))
			if ($_SERVER["HTTPS"] == "on") {
				$pageURL .= "s";
			}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
}

if (!function_exists('redirec_login')) {
    function redirec_login()
    {
		$CI =& get_instance();
    	if(!$CI->input->is_ajax_request()) {
			redirect('login?redir=' . urlencode(get_current_url()));
		}
    	else {
			if ($CI->agent->is_referral()){
				return 'login?redir='.urlencode($CI->agent->referrer());
			}
			else{
				return 'login';
			}
		}
    }
}

if (!function_exists('redirect_after_login')) {
    function redirect_after_login()
    {
		$CI =& get_instance();
    	if(!$CI->input->is_ajax_request()) {
			redirect(urlencode(current_url()));
		}
    	else {
			if ($CI->agent->is_referral())
    			return urlencode($CI->agent->referrer());
			else
				return '/';
		}
    }
}

if (!function_exists('show_not_authorised')) {
    function show_not_authorised()
    {
		$CI =& get_instance();

		if (!$CI->input->is_ajax_request())
			redirect('error_not_authorized');
		else{
			header("HTTP/1.1 401 Authentication Failed");
			$url = redirec_login();
			echo json_encode(array('code' => '401', 'message' =>'Sorry! You do not have permission for this operation'));
			exit();
		}
    }
}

if (!function_exists('get_country')) {
    function get_country($countryID)
    {
        $CI =& get_instance();
        $CI->db->select('country_name');
        $CI->db->from('iso_codes_master');
        $CI->db->where( 'id', $countryID);
        return $CI->db->get()->row()->country_name;
    }
}

if (!function_exists('get_country_list')) {
    function get_country_list()
    {
        $CI =& get_instance();
        $CI->db->select('*');
        $CI->db->from('iso_codes_master');
        return $CI->db->get()->result_array();
    }
}
if (!function_exists('get_currency_iso_code')) {
    function get_currency_iso_code($currencyID)
    {
        $CI =& get_instance();
        $CI->db->select('CurrencyCode');
        $CI->db->from('currency_master');
        $CI->db->where( 'currencyID',$currencyID);
        return $CI->db->get()->row()->CurrencyCode;
    }
}

if (!function_exists('get_exchange_rate')) {
    function get_exchange_rate($from_Currency, $to_Currency)
    {
        $from_Currency = urlencode(strtoupper($from_Currency));
        $to_Currency = urlencode(strtoupper($to_Currency));

        $CI =& get_instance();
        $CI->db->select('srp_erp_currencyconversion.conversion');
        $CI->db->from('srp_erp_currencyconversion');
        $CI->db->where( 'srp_erp_currencyconversion.subCurrencyCode', $to_Currency);
        $val = $CI->db->get()->row('conversion');
        return round(floatval(1/$val),6);
    }
}

if (!function_exists('currency_converter')) {
    function currency_converter($from_Currency, $to_Currency)
    {
        $CI =& get_instance();
        $CI->db->select('srp_erp_currencyconversion.conversion');
        $CI->db->from('srp_erp_currencyconversion');
        $CI->db->where( 'srp_erp_currencyconversion.subCurrencyCode', $to_Currency);
        $val = $CI->db->get()->row('conversion');
        $s = array($from_Currency.'_'.$to_Currency => round(floatval(1/$val),6));
        return json_encode($s, JSON_FORCE_OBJECT);
    }
}

if (!function_exists('get_number_of_jobs_by_type')) {
    function get_number_of_jobs_by_type($job_type)
    {
        $CI =& get_instance();
        $CI->db->select();
        $CI->db->from('job_posts');
        $CI->db->where( 'job_post_job_type', $job_type);
        $CI->db->where( 'post_status', '1');
        return $CI->db->count_all_results();
    }
}

if (!function_exists('get_number_of_jobs_by_category')) {
    function get_number_of_jobs_by_category($job_cat)
    {
        $JP =& get_instance();
        $JP->db->select();
        $JP->db->from('job_posts');
        $JP->db->where( array('job_post_job_category' => $job_cat, 'post_status'=>'1'));
        return $JP->db->count_all_results();

    }
}

// checks user already applied for this job or not
if (!function_exists('check_user_already_applied_for_job')) {
    function check_user_already_applied_for_job($js_id, $job_id)
    {
        $Applied_check =& get_instance();
        $Applied_check->db->select('job_post_id,application_date');
        $Applied_check->db->from('job_applications_received');
        $Applied_check->db->where( 'jobseeker_id', $js_id);
        $Applied_check->db->where( 'job_post_id', $job_id);
        return $Applied_check->db->get()->row_array();
    }
}

//// checks user already applied for this job or not
//if (!function_exists('get_emp_number_of_jobs')) {
//    function get_emp_number_of_jobs($js_id, $job_id)
//    {
//        $C =& get_instance();
//        $C->db->select('*');
//        $C->db->where(array('job_post_employer_id'=> $id, 'is_live'=>'1'));
//        $C->db->order_by('job_post_posted_date', 'DESC');
//        $C->db->from('job_posts');
//        $query = $C->db->get();
//        echo $this->db->last_query();
//        return $query->result_array();
//    }
//}

if (!function_exists('set_pagination')) {
    function set_pagination($total_rows, $page_url, $limit)
    {
        $CI  =& get_instance();
        $CI->load->library('pagination');

        $config['base_url'] = base_url().$page_url;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $limit;
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = TRUE;

        $config['full_tag_open'] = '<div class="pagination viewmore pagination-cus"><ul>';
        $config['full_tag_close'] = '</ul></div>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['num_tag_open'] = '<div>';
        $config['num_tag_close'] = '</div>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['prev_link'] = '<i class="la la-long-arrow-left"></i> Prev ';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';

        $config['next_link'] = 'Next <i class="la la-long-arrow-right"></i>';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"> <a>';
        $config['cur_tag_close'] = '</a></li>';

        $CI->pagination->initialize($config);
        $pages = $CI->pagination->create_links();
        return $pages;
    }
}


//(('job_post_posted_date')  < 'CURRENT_DATE'), (('job_post_posted_date + INTERVAL 30 DAY')  > 'CURRENT_DATE')
if (!function_exists('get_job_post_count')){
	function get_job_post_count(){
		$CI =& get_instance();
		$CI->db->select("count(*) total_posts,
                           sum(case when DATE_ADD(job_post_posted_date , INTERVAL 30 DAY) > CURRENT_DATE  and  job_post_posted_date < 'CURRENT_DATE' and post_status = '0' then 1 else 0 end) inactive_post,
                           sum(case when DATE_ADD(job_post_posted_date , INTERVAL 30 DAY) > CURRENT_DATE  and  job_post_posted_date < 'CURRENT_DATE' and post_status = '1' then 1 else 0 end) active_post,
                           sum(case when DATE_ADD(job_post_posted_date , INTERVAL 30 DAY) < CURRENT_DATE and  (post_status = '0' || post_status = '1' || post_status = '2') then 1 else 0 end) expired_post,
                           sum(case when post_status = '3' then 1 else 0 end) draft_post");
		$CI->db->from("job_posts");
		$CI->db->where('job_post_employer_id', $_SESSION['company_id']);
		return $CI->db->get()->row_array();
	}
}

if (!function_exists('get_post_count_su')){
    function get_post_count_su(){
        $CI =& get_instance();
        $CI->db->select("count(*) total_posts,
                           sum(case when post_approval = '0' then 1 else 0 end) pending_post,
                           sum(case when post_approval = '1' then 1 else 0 end) approved_post,
                           sum(case when post_approval = '2' then 1 else 0 end) rejected_post");
        $CI->db->from("job_posts");
        $CI->db->where('post_status', '1');
        return $CI->db->get()->row_array();
    }
}

if (!function_exists('get_no_of_application_count')){
    function get_no_of_application_count(){
        $CI =& get_instance();
//        $CI->db->select("");

        $CI->db->from("job_applications_received");
        $CI->db->join('job_posts', 'job_applications_received.job_post_id = job_posts.job_post_id', 'inner');
        $CI->db->where('job_posts.job_post_employer_id', $_SESSION['company_id']);
        return $CI->db->count_all_results();
    }
}

if (!function_exists('get_job_post_count_by_filters')){
    function get_job_post_count_by_filters($cond){
        $CI =& get_instance();
        $CI->db->select('count(*) tot');
        $CI->db->from('job_posts');
        $CI->db->where($cond);
        $CI->db->where('post_status', '1');
        $CI->db->where('post_approval', '1');


        $query = $CI->db->get();
        return $query->row()->tot;
    }
}

if (!function_exists('generate_random_color')){
	function generate_random_color() {
		return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
	}
}

if (!function_exists('get_contrast_color_code')){
	function get_contrast_color_code($hexColor) {

		// hexColor RGB
		$R1 = hexdec(substr($hexColor, 1, 2));
		$G1 = hexdec(substr($hexColor, 3, 2));
		$B1 = hexdec(substr($hexColor, 5, 2));

		// Black RGB
		$blackColor = "#000000";
		$R2BlackColor = hexdec(substr($blackColor, 1, 2));
		$G2BlackColor = hexdec(substr($blackColor, 3, 2));
		$B2BlackColor = hexdec(substr($blackColor, 5, 2));

		// Calc contrast ratio
		$L1 = 0.2126 * pow($R1 / 255, 2.2) +
			0.7152 * pow($G1 / 255, 2.2) +
			0.0722 * pow($B1 / 255, 2.2);

		$L2 = 0.2126 * pow($R2BlackColor / 255, 2.2) +
			0.7152 * pow($G2BlackColor / 255, 2.2) +
			0.0722 * pow($B2BlackColor / 255, 2.2);

		$contrastRatio = 0;
		if ($L1 > $L2) {
			$contrastRatio = (int)(($L1 + 0.05) / ($L2 + 0.05));
		} else {
			$contrastRatio = (int)(($L2 + 0.05) / ($L1 + 0.05));
		}

		// If contrast is more than 5, return black color
		if ($contrastRatio > 5) {
			return '#000000';
		} else {
			// if not, return white color.
			return '#FFFFFF';
		}
	}
}

if (!function_exists('get_system_version')) {
	function get_system_version(){
		if(file_exists('version.txt'))
			if(file_get_contents('version.txt'))
				return file_get_contents('version.txt');
			else
				return 'un-versioned';
		else
			return "stable";

	}
}

if (!function_exists('get_system_build')) {
	function get_system_build(){
		if(file_exists('version.txt'))
			return date("YmdHis", filemtime('version.txt'));
		else
			return date("YW");
	}
}

if (!function_exists('save_user_delete_reason')) {
	function save_user_delete_reason($data)
	{
		$CI =& get_instance();
		$res = $CI->db->insert('deleted_users', $data);
		return $res;
	}
}

//Audit Logs
if (!function_exists('audit_edit_logger')) {
	function audit_edit_logger($log_message = null)
	{
		$log_code = 1; //Editing
		$CI =& get_instance();
		$CI->rat->log($log_message, $log_code);
	}
}

if (!function_exists('audit_delete_log')) {
	function audit_delete_log($log_message = null)
	{
		$log_code = 2; //Editing
		$CI =& get_instance();
		$CI->rat->log('Deleted, '.$log_message, $log_code);
	}
}



if (!function_exists('set_new_document_code')) {
	function set_new_document_code($doc_name, $set_count=NULL)
	{
		$CI =& get_instance();
		$CI->db->where('doc_name', $doc_name);
		if (empty($set_count))
			$CI->db->set('counter', 'counter + 1', FALSE);
		else
			$CI->db->set('counter', $set_count);

		return $CI->db->update('documents_code_references');
	}
}

if (!function_exists('get_document_code')) {
	function get_document_code($doc_name)
	{
		$CI =& get_instance();
		$CI->db->select('*');
		$CI->db->from('documents_code_references');
		$CI->db->where('doc_name', $doc_name);

		$query = $CI->db->get();
		return $query->row();
	}
}

if (!function_exists('parse_status')) {
	function parse_status($status)
	{
		switch ($status) {
			case "pending":
				return "Pending";
				break;
			case "success":
				return "Success";
				break;
			case "approved":
				return "Approved";
				break;
			case "failed":
				return "Failed";
				break;
			case "onhold":
				return "On Hold";
				break;
			case "completed":
				return "Completed";
				break;
			case "reject":
			case "rejected":
				return "Rejected";
				break;
			case "refer_back" :
				return "Refer Back";
				break;
			default:
				return "Other";
		}
	}
}

if (!function_exists('parse_payment_type')) {
	function parse_payment_type($status)
	{
		switch ($status) {
			case "cheque":
				return "Cheque";
				break;
			case "cash":
				return "Cash";
				break;
			case "bank":
				return "Bank Transfer";
				break;
			default:
				return "Not Defined";
		}
	}
}

if (!function_exists('parse_payment_mode')) {
	function parse_payment_mode($status)
	{
		switch ($status) {
			case "offline":
				return "Offline";
				break;
			case "cash":
				return "Online";
				break;
			default:
				return "Not Defined";
		}
	}
}

if (!function_exists('get_employer_subscription_data')) {
	function get_employer_subscription_data($emp_id)
	{
		$CI =& get_instance();
		$CI->db->select('*');
		$CI->db->from('employer_job_plan_subscriptions');
		$CI->db->where('employer_id', $emp_id);
		$CI->db->where('expiry_date >', 'CURRENT_DATE', FALSE);

		return $CI->db->get()->row();
	}
}

if (!function_exists('get_data_emp_mcq')) {
	function get_data_emp_mcq($emp_id,$exm_id)
	{

		$emp_id2= $emp_id;
		$exm_id= $exm_id;

		$CI =& get_instance();
		$CI->db->select('mark');
		$CI->db->from('ats_emp_wise_answer');
		$CI->db->join('ats_exam_question', 'ats_exam_question.id_ats_exam_question = ats_emp_wise_answer.queqtion_id', 'left');
		$CI->db->where('exam_id', $exm_id);
		$CI->db->where('emp_id',$emp_id2);
		$CI->db->where('isCorrect','true');
		$query=$CI->db->get();

		$count_true=0;
		foreach ($query->result() as $row)
		{
			$count_true+= $row->mark;
		}

//		$this->db->select_sum('amount');
//		$result = $this->db->get('tbl_product')->row();
//		return $result->amount;
//		$CI =& get_instance();
//		$CI->db->select('*');
//		$CI->db->from('ats_emp_wise_answer');
//		$CI->db->where('exam_id', $exm_id);
//		$CI->db->where('emp_id',$emp_id2);
//		$CI->db->where('isCorrect','true');
//		$count1=$CI->db->get()->num_rows();
//
//		$CI =& get_instance();
//		$CI->db->select('*');
//		$CI->db->from('ats_emp_wise_answer');
//		$CI->db->where('exam_id', $exm_id);
//		$CI->db->where('emp_id',$emp_id2);
//		$CI->db->where('isCorrect','false');
//		$count2=$CI->db->get()->num_rows();
//
//		$count=$count1+$count2;
		$presentage=($count_true);
		return $presentage;

//		$presentage=(($count_true/$count)*100);

	}
}

//get_data_emp_short_answer

if (!function_exists('get_data_emp_short_answer')) {
	function get_data_emp_short_answer($emp_id,$exm_id)
	{

		$emp_id2= $emp_id;
		$exm_id= $exm_id;

//		$CI =& get_instance();
//		$CI->db->select('*');
//		$CI->db->from('ats_emp_wise_answer');
//		$CI->db->where('exam_id', $exm_id);
//		$CI->db->where('emp_id',$emp_id2);
//		$CI->db->where('answer_id',0);
//		$CI->db->where('isCorrect !=',true);
//		$CI->db->where('isCorrect !=',false);
//		$CI->db->where('isCorrect !=',null);
//		$CI->db->where('isCorrect !=','');
//		$count=$CI->db->get()->num_rows();

		$CI =& get_instance();
		$CI->db->select('*');
		$CI->db->from('ats_emp_wise_answer');
		$CI->db->where('exam_id', $exm_id);
		$CI->db->where('emp_id',$emp_id2);
		$CI->db->where('answer_id',0);
		$CI->db->where('isCorrect !=',true);
		$CI->db->where('isCorrect !=',false);
		$CI->db->where('isCorrect !=',null);
		$CI->db->where('isCorrect !=','');

		$query=$CI->db->get();

		$tot=0;
		foreach ($query->result() as $row)
		{
			$tot+=$row->isCorrect;
		}

//		$p=(($tot/($count*10))*100);
//		return $p;
		$p=($tot);
		return $p;

	}
}

//ats_exam_do_count
if (!function_exists('ats_exam_do_count')) {
	function ats_exam_do_count($emp_id,$exm_id)
	{

		$emp_id2= $emp_id;
		$exm_id= $exm_id;

		$CI =& get_instance();
		$CI->db->select('*');
		$CI->db->from('ats_emp_wise_answer');
		$CI->db->where('exam_id', $exm_id);
		$CI->db->where('emp_id',$emp_id2);
		$count=$CI->db->get()->num_rows();

		return $count;
	}
}

if (!function_exists('get_tot_percentage')) {
	function get_tot_percentage($emp_id,$exm_id)
	{

		$emp_id2= $emp_id;
		$exm_id= $exm_id;


//		$CI =& get_instance();
//		$CI->db->select('*');
//		$CI->db->from('ats_emp_wise_answer');
//		$CI->db->where('exam_id', $exm_id);
//		$CI->db->where('emp_id',$emp_id2);
//		$CI->db->where('isCorrect','true');
//		$count_true=$CI->db->get()->num_rows();
//
//		$CI =& get_instance();
//		$CI->db->select('*');
//		$CI->db->from('ats_emp_wise_answer');
//		$CI->db->where('exam_id', $exm_id);
//		$CI->db->where('emp_id',$emp_id2);
//		$CI->db->where('isCorrect','true');
//
//		$count1=$CI->db->get()->num_rows();
//
//		$CI =& get_instance();
//		$CI->db->select('*');
//		$CI->db->from('ats_emp_wise_answer');
//		$CI->db->where('exam_id', $exm_id);
//		$CI->db->where('emp_id',$emp_id2);
//		$CI->db->where('isCorrect','false');
//
//		$count2=$CI->db->get()->num_rows();
//
//		$count3=$count1+$count2;
//		$p=(($count_true/$count3)*100);
		$emp_id2= $emp_id;
		$exm_id= $exm_id;

		$CI =& get_instance();
		$CI->db->select('mark');
		$CI->db->from('ats_emp_wise_answer');
		$CI->db->join('ats_exam_question', 'ats_exam_question.id_ats_exam_question = ats_emp_wise_answer.queqtion_id', 'left');
		$CI->db->where('exam_id', $exm_id);
		$CI->db->where('emp_id',$emp_id2);
		$CI->db->where('isCorrect','true');
		$query=$CI->db->get();

		$count_true=0;
		foreach ($query->result() as $row)
		{
			$count_true+= $row->mark;
		}


//		-------------------------------------



//		$CI =& get_instance();
//		$CI->db->select('*');
//		$CI->db->from('ats_emp_wise_answer');
//		$CI->db->where('exam_id', $exm_id);
//		$CI->db->where('emp_id',$emp_id2);
//		$CI->db->where('answer_id',0);
//		$CI->db->where('isCorrect !=',true);
//		$CI->db->where('isCorrect !=',false);
//		$CI->db->where('isCorrect !=',null);
//		$CI->db->where('isCorrect !=','');
//		$count1=$CI->db->get()->num_rows();

		$CI =& get_instance();
		$CI->db->select('*');
		$CI->db->from('ats_emp_wise_answer');
		$CI->db->where('exam_id', $exm_id);
		$CI->db->where('emp_id',$emp_id2);
		$CI->db->where('answer_id',0);
		$CI->db->where('isCorrect !=',true);
		$CI->db->where('isCorrect !=',false);
		$CI->db->where('isCorrect !=',null);
		$CI->db->where('isCorrect !=','');
		$query=$CI->db->get();

		$tot=0;
		foreach ($query->result() as $row)
		{
			$tot+=$row->isCorrect;
		}

		$presentage2=($tot);

		$p3=($count_true+$presentage2);
		return $p3;
	}
}


