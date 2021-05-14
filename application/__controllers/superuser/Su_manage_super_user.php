<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 11/26/2018
 * Time: 12:02 PM
 */

class Su_manage_super_user extends Main_Controller
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

    public function index(){

        $data['page_title'] = 'User Management &bull; Super User';
        $data['su_users'] = $this->manage_user->get_users();
		$data['user_groups'] = $this->manage_user->get_user_groups_list($this->company_id);

        $data['main_content'] = 'superuser/su_manage_super_user.php';
        //load main content page
        $this->load->view('templates/template_superuser', $data);
    }

    function validate_new_user(){

    	$is_edit = $this->input->post("user_id");

		$this->form_validation->set_rules('su_first_name', 'First Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('su_last_name', 'Last Name', 'trim|required|xss_clean');

    	if (empty($is_edit)){
			$config = array(
				array(
					'field' => 'su_email',
					'label' => 'Email',
					'rules' => 'trim|required|xss_clean|valid_email|callback_is_user_exists',
					'errors' => array(
						'required' => 'You must provide a valid email',
					),
				),
				array(
					'field' => 'confirm_email',
					'label' => 'Retype Email',
					'rules' => 'trim|required|xss_clean|matches[su_email]',
					'errors' => array(
						'required' => 'You must provide a valid email',
					),
				),
				array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'trim|required|xss_clean',
					'errors' => array(
						'required' => 'You must provide a %s.',
					),
				),
				array(
					'field' => 'confirm_password',
					'label' => 'Retype Password',
					'rules' => 'trim|required|xss_clean|matches[password]',
					'errors' => array(
						'required' => 'Please enter a password',
						'matches' => 'Your passwords does not match.',
					),
				)
			);

			$this->form_validation->set_rules($config);
		}

        if ($this->form_validation->run() == FALSE) {
            header("HTTP/1.1 449 Retry With");
            echo json_encode(array('code' => 449, 'message' => array(validation_errors())));
        }
        else {
            $response = $this->add_new_user();
            echo json_encode($response);
        }
    }

	function add_new_user(){
		$data = $this->input->post();

		try{
			$super_user_data['su_first_name'] = $data['su_first_name'];
			$super_user_data['su_last_name'] = $data['su_last_name'];
			$super_user_data['su_emp_id'] = $data['su_emp_id'];

			//if user id is empty, then it's a new user else editing existing

			$this->db->trans_begin();
			if (empty($data['user_id'])){

				$new_user_data['user_type'] = 1;
				$new_user_data['email'] = $data['su_email'];
				$new_user_data['company_id'] = '-1';
				$new_user_data['user_group'] = $data['new_user_group'];
				$new_user_data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

				$super_user_data['user_id'] = $this->manage_user->add_new_user($new_user_data);
				$this->manage_user->add_new_user_info($super_user_data);
				$message = "User added successfully";
			}
			else{
				$user_id = $this->input->post('user_id');
				$this->manage_user->update_user_info($user_id, $super_user_data);
				$message = "User updated successfully";
			}

			if ($this->db->trans_status() === FALSE){
				$res = $this->db->trans_rollback();
				return (array('res'=>$res, 'code' => 0, 'message'=>'Error! Update failed'));
			} else {
				$res = $this->db->trans_commit();
				//Logging the event
				$log = "Modified, user data, user id ".$data['user_id'];
				if (!empty($data['user_id'])){
					audit_edit_logger($log);
				}
				return (array('res'=>$res, 'code' => 1, 'message' => $message));
			}
		}catch (Exception $e)
		{
			return json_encode($e);
		}
	}

    function enable_disable_user(){
        try {
            $form_data = $this->input->post();

            $this->db->trans_start();

            $res = $this->manage_user->update_user_access($form_data['user_id'], $form_data);

			if ($form_data['is_active'])
				audit_edit_logger('Activated, user id '.$form_data['user_id']);
			else
				audit_edit_logger('Deactivated, user id '.$form_data['user_id']);

            $this->db->trans_complete();

            echo json_encode($res);

        } catch (Exception $e) {
            $this->db->trans_rollback();
            echo $e->getMessage();
        }
    }

    function get_user_data(){

    	$user_id = $this->input->post('user_id');

    	try{
    		$user_data = $this->manage_user->get_user($user_id);
    		$ret_data = array(
    			'new_user_group' => $user_data['user_group'],
    			'user_id' => $user_data['user_id'],
    			'su_emp_id' => $user_data['su_emp_id'],
    			'su_first_name' => $user_data['su_first_name'],
    			'su_last_name' => $user_data['su_last_name'],
    			'su_email' => $user_data['email'],
    			'confirm_email' => $user_data['email'],
			);
    		echo json_encode(array('code'=>1, 'ret_data'=>$ret_data));
		}catch (Exception $e){
			echo $e->getMessage();
		}

	}

    function assign_user_to_group(){
    	$form_data = $this->input->post();

    	$user_group = $form_data['group_id'];
    	$user_id = $form_data['rec_id'];
    	$user_group = !empty($user_group) ? $user_group : -1;

		try {
			$this->db->trans_begin();
			$this->manage_user->set_user_group($user_id, $user_group);
			audit_edit_logger('Assigned, user id '.$user_id.', user group '.$user_group);

			if ($this->db->trans_status() === FALSE) {
				$res = $this->db->trans_rollback();
				echo json_encode(array('res'=>$res, 'code'=>0, 'message'=>'Something went wrong'));
			} else {
				$res = $this->db->trans_commit();
				echo json_encode(array('res'=>$res, 'code'=>1, 'message'=>'Assigned successfully'));
			}
		} catch (Exception $e) {
			echo json_encode($e);
		}
	}

	function delete_user(){
    	$r_id = $this->input->post('user_id');
    	$reason = $this->input->post('reason');

		try {
			$user_data = $this->manage_user->get_user($r_id);
			$user_data['deleted_by'] = $this->user_id;
			$user_data['reason_to_delete'] = $reason;
			unset($user_data['su_first_name'], $user_data['su_last_name'], $user_data['su_emp_id']);

			$this->db->trans_begin();

			$this->manage_user->delete_an_user($r_id);
			save_user_delete_reason($user_data);
			audit_delete_log('Deleted, user id '.$r_id.' reason '.$reason);

			if ($this->db->trans_status() === FALSE) {
				$res = $this->db->trans_rollback();
				echo json_encode(array('res' => $res, 'code' => 0, 'message' => 'Something went wrong'));
			} else {
				$res = $this->db->trans_commit();
				echo json_encode(array('res' => $res, 'code' => 1, 'message' => 'account <strong>Deleted</strong> successfully'));
			}
		} catch (Exception $e) {
			echo json_encode($e);
		}
	}

	function is_user_exists($user_email){
		$is_exist = $this->manage_user->check_user_exists($user_email);
		if ($is_exist) {
			$this->form_validation->set_message('is_user_exists', 'Email already exists in the system. If you forgot your password, you can reset or use a different email');
			return FALSE;
		} else {
			return TRUE;
		}
	}
}
