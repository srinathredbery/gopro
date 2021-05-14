<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 11/26/2018
 * Time: 12:02 PM
 */

class Employer_manage_user extends Main_Controller
{
	private $company_id;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('employer_manage_user_model');
        $this->company_id = $this->session->company_id;
    }

    public function index(){

        $data['page_title'] = 'User Management';
        $data['emp_users'] = $this->employer_manage_user_model->get_users($this->company_id);
		$data['user_groups'] = $this->employer_manage_user_model->get_user_groups_list($this->company_id);

        $data['main_content'] = 'employer/employer_manage_user';
        //load main content page
        $this->load->view('templates/template_employer', $data);
    }

    function validate_new_user()
    {
        $config = array(

            array(
                'field' => 'emp_first_name',
                'label' => 'First Name',
                'rules' => 'trim|required|xss_clean'
            ),
            array(
                'field' => 'emp_last_name',
                'label' => 'Last Name',
                'rules' => 'trim|required|xss_clean'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|xss_clean|is_unique[user.email]',
                'errors' => array(
                    'required' => 'You must provide a valid email',
                    'is_unique' => 'Your email already exists in our system. If you forgot your password you can reset or Login',
                ),
            ),
            array(
                'field' => 'confirm_email',
                'label' => 'Retype Email',
                'rules' => 'trim|required|xss_clean|matches[email]',
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

		$_POST['company_id'] = $_SESSION['company_id'];

		unset($_POST['confirm_email'], $_POST['confirm_password']);
		$data = $this->input->post();

		try{
			$new_user_data['user_type'] = 2;
			$new_user_data['email'] = $data['email'];
			$new_user_data['company_id'] = $data['company_id'];
			$new_user_data['user_group'] = $data['new_user_group'];
            $new_user_data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

			$emp_user_data['emp_first_name'] = $data['emp_first_name'];
			$emp_user_data['emp_last_name'] = $data['emp_last_name'];

			$this->db->trans_begin();
			$emp_user_data['emp_user_id'] = $this->employer_manage_user_model->add_new_user($new_user_data);

			$this->employer_manage_user_model->add_new_user_info($emp_user_data);



			if ($this->db->trans_status() === FALSE)
			{
				$res = $this->db->trans_rollback();
				return $res;
			}
			else
			{
				$res = $this->db->trans_commit();
				return $res;
			}
		}
		catch (Exception $e){
			return $e->getMessage();
		}
	}

    function enable_disable_user(){
        try {
            $form_data = $this->input->post();

            $this->db->trans_start();

            $res = $this->employer_manage_user_model->update_user_access($form_data['user_id'], $form_data);

            $this->db->trans_complete();
            echo json_encode($res);

        } catch (Exception $e) {
            $this->db->trans_rollback();
            return $e->getMessage();
        }
    }

    function assign_user_to_group(){
    	$form_data = $this->input->post();

    	$user_group = $form_data['group_id'];
    	$user_id = $form_data['rec_id'];
    	$user_group = !empty($user_group) ? $user_group : -1;

		try {
			$this->employer_manage_user_model->set_user_group($user_id, $user_group);
			$this->db->trans_begin();
			if ($this->db->trans_status() === FALSE) {
				$res = $this->db->trans_rollback();
				echo json_encode(array('res'=>$res, 'code'=>0, 'message'=>'something went wrong'));
			} else {
				$res = $this->db->trans_commit();
				echo json_encode(array('res'=>$res, 'code'=>1, 'message'=>'Assigned successfully'));
			}
		} catch (Exception $e) {
			echo json_encode($e);
		}
	}
}
