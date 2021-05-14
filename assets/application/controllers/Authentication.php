<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 8/30/2018
 * Time: 4:03 PM
 */

class Authentication extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->helper(array('form', 'email'));
        $this->load->library('form_validation');
        $this->load->model('login_model');
        $this->load->model('jobseeker_resume_model');
    }

    function show_login()
    {
    	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'])
    		redirect('dashboard');
    	else{
			$data['page_title'] = 'Login';
			$data['main_content'] = 'general/login_page';

			//load main content page
			$this->load->view('templates/template_extras', $data);
		}
    }

    function show_sign_up()
    {
        $data['page_title'] = 'Sign Up';
        $data['main_content'] = 'general/sign_up_page';

        //load main content page
        $this->load->view('templates/template_extras', $data);
    }

    function authenticate_login()
    {
        $login_form = $this->input->post();
        $login_form = $this->security->xss_clean($login_form);
        try {
            $auth_response = $this->login_model->verify_login_credentials($login_form['username']);
            if (!empty($auth_response) && $auth_response['is_active'] && !$auth_response['is_deleted']) {
                if(password_verify($login_form['password'], $auth_response['password'])){
                    if ($auth_response['user_type'] == 3) {
                        $profile_data = $this->master_dml_model->get_data('jobseeker', '*', array('jobseeker_user_id' => $auth_response['user_id']));
                    } elseif ($auth_response['user_type'] == 2) {
                        $profile_data = $this->master_dml_model->get_data('employer', '*', array('employer_id' => $auth_response['company_id']));
                    } elseif ($auth_response['user_type'] == 1) {
                        $profile_data = $this-> master_dml_model->get_data('super_user', '*', array('su_email' => $auth_response['email']));
                    }

                    $this->set_login_session($auth_response);

					if (!empty($profile_data))
                    	$this->session->set_userdata($profile_data);

                    $redir = $this->input->post('redir');

                    if(!empty($redir) && $redir != NULL && $redir != 'null')
                        $red_res = array('url'=>$redir);
                    else
                        $red_res = array('url'=>base_url().'dashboard');

                    echo json_encode($red_res);
                }
                else{
                    header("HTTP/1.1 401 Bad Request");
                    echo json_encode(array('code' => 401, 'message' => 'Your password is wrong'));
                }
            }
            else {
                if ($auth_response['is_deleted'] == true || $auth_response['is_deleted'] == 1) {
                    header("HTTP/1.1 401 Bad Request");
                    echo json_encode(array('code' => 401, 'message' => 'Account not found, Please Sign Up to create an new account to enjoy the services'));
                }
                elseif (empty($auth_response['email'])) {
                    header("HTTP/1.1 401 Bad Request");
                    echo json_encode(array('code' => 401, 'message' => 'There is no account associated with this email. Please singup to create an new account to enjoy the services'));
                }
                elseif ($auth_response['is_active'] == false && $auth_response['user_type'] !== 3) {
                    header("HTTP/1.1 401 Bad Request");
                    echo json_encode(array('code' => 401, 'message' => 'Your account is disabled, Please contact your organization administrator'));
                }
                elseif ($auth_response['is_active'] == false && $auth_response['user_type'] == 3) {
                    header("HTTP/1.1 401 Bad Request");
                    echo json_encode(array('code' => 401, 'message' => 'Your account is disabled, Please contact our support'));
                }
                elseif (empty($auth_response)) {
                    header("HTTP/1.1 401 Bad Request");
                    echo json_encode(array('code' => 401, 'message' => 'There is no account associated with this email. Please Sign Up to create an new account to enjoy the services'));
                }
                else {
                    header("HTTP/1.1 401 Bad Request");
                    echo json_encode(array('code' => 401, 'message' => 'Something went wrong. Please contact our support'));
                }
            }
        } catch (Exception $e) {
            echo json_encode($e);
        }
    }

    function set_login_session($login_session_data)
    {

        $user = array(
            'user_id' => $login_session_data['user_id'],
            'email' => $login_session_data['email'],
            'user_name' => $login_session_data['username'],
            'user_type' => $login_session_data['user_type'],
            'user_group' => $login_session_data['user_group'],
            'company_id' => $login_session_data['company_id'],
            'logged_in' => TRUE
        );

        $this->session->set_userdata($user);
    }


    /* *********** Sign up methods *************/
    function validate_sign_up()
    {
        $sign_up_form = $this->input->post();

        if ($sign_up_form['user_type'] == 2) {
            $config = array(

                array(
                    'field' => 'employer_name',
                    'label' => 'Company Name',
                    'rules' => 'trim|required|xss_clean'
                ),
                array(
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'trim|required|xss_clean|valid_email|is_unique[user.email]',
                    'errors' => array(
                        'required' => 'You must provide a valid email',
                        'is_unique' => 'Your email already exists in our system. If you forgot your password you can reset or Login',
                        'valid_email' => 'Your email is not valid',
                    ),
                ),
                array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'trim|required|min_length[8]|xss_clean',
                    'errors' => array(
                        'required' => 'You must provide a %s.',
                    ),
                ),
                array(
                    'field' => 'password_confirm',
                    'label' => 'Password recheck',
                    'rules' => 'trim|required|xss_clean|matches[password]',
                    'errors' => array(
                        'required' => 'Please enter a password',
                        'matches' => 'Your passwords does not match.',
                    ),
                ),
                array(
                    'field' => 'phone_no',
                    'label' => 'Phone No',
                    'rules' => 'trim|required|xss_clean'
                ),
                array(
                    'field' => 'country_code_idd',
                    'label' => 'Country Code',
                    'rules' => 'trim|required|xss_clean'
                ),
                array(
                    'field' => 'contact_person_title',
                    'label' => 'Name of a Contact Person',
                    'rules' => 'trim|required|xss_clean'
                ),
                array(
                    'field' => 'contact_person',
                    'label' => 'Name of a Contact Person',
                    'rules' => 'trim|required|xss_clean'
                )
            );
        } elseif ($sign_up_form['user_type'] == 3) {
            $config = array(
                array(
                    'field' => 'jobseeker_first_name',
                    'label' => 'First Name',
                    'rules' => 'trim|required|xss_clean'
                ),
                array(
                    'field' => 'jobseeker_last_name',
                    'label' => 'Last Name',
                    'rules' => 'trim|required|xss_clean'
                ),
                array(
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'trim|required|xss_clean|valid_email|is_unique[user.email]',
                    'errors' => array(
                        'required' => 'You must provide a valid email',
                        'is_unique' => 'Your email already exists in our system. If you forgot your password you can reset or Login',
                        'valid_email' => 'Your email is not valid',
                    )
                ),
                array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'trim|required|min_length[8]|xss_clean',
                    'errors' => array(
                        'required' => 'You must provide a %s.',
                    ),
                ),
                array(
                    'field' => 'password_confirm',
                    'label' => 'Password recheck',
                    'rules' => 'trim|required|xss_clean|matches[password]',
                    'errors' => array(
                        'required' => 'Please enter a password',
                        'matches' => 'Your passwords does not match.',
                    ),
                ),
                array(
                    'field' => 'phone_no',
                    'label' => 'Phone No',
                    'rules' => 'trim|required|xss_clean'
                ),
                array(
                    'field' => 'country_code_idd',
                    'label' => 'Country Code',
                    'rules' => 'trim|required|xss_clean'
                )
            );
        }

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            header("HTTP/1.1 449 Retry With");
            echo json_encode(array('code' => 449, 'message' => array(validation_errors())));
        } else {
            $response = $this->add_sign_up();
            echo json_encode($response);
        }

    }

    private function add_sign_up()
    {
        unset($_POST['password_confirm']);
        $password = $this->input->post('password');
        $_POST['password'] = password_hash($password, PASSWORD_DEFAULT);
        $ver_code = bin2hex(random_bytes(3));
        if ( $this->input->post('user_type') == 2) { //adding a employer type user
            try {
                $sign_up_data = $this->input->post();

                //user data
                $register['email'] = $sign_up_data['email'];
                $register['password'] = $sign_up_data['password'];
                $register['user_type'] = $sign_up_data['user_type'];
                $register['verification_code'] = $ver_code;

                //profile data
				$emp_profile['employer_name'] = $sign_up_data['employer_name'];
				$emp_profile['employer_country_code_idd'] = $sign_up_data['country_code_idd'];
				$emp_profile['employer_phone_no'] = $sign_up_data['phone_no'];
				$emp_profile['employer_email'] = $sign_up_data['email'];
				$emp_profile['employer_contact_person_title'] = $sign_up_data['contact_person_title'];
				$emp_profile['employer_contact_person_name'] = $sign_up_data['contact_person'];
				$emp_profile['employer_contact_person_job_title'] = $sign_up_data['contact_person_job_title'];


                $this->db->trans_begin();
                $new_user_id = $this->login_model->register_employer($register);
                $company_id = $this->login_model->add_new_employer_info($emp_profile);
                $this->login_model->add_employer_id_to_user($new_user_id, $company_id);
				$this->set_default_user_group($company_id, $new_user_id);

                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                    $this->send_mail($_POST['email'], $ver_code);
					 $auth_response = $this->login_model->verify_login_credentials($_POST['email'], $_POST['password']);
//QA akeel said remove this session login.. tharindu
					$this->set_login_session($auth_response);
                    $this->session->set_userdata($emp_profile);
                    return array('url' => 'employer/dashboard');
//Session Configration Eka athule seeion case kiyaa ekak thei
//					return array('url' => '/');

                }
                $this->db->trans_complete();
            } catch (Exception $e) {
                $this->db->trans_rollback();
                return $e->getMessage();
            }
        }

        else if ($this->input->post('user_type') == 3) { //adding jobseeker user
            try {
                $sign_up_data = $this->input->post();

                //user data
				$register['email'] = $sign_up_data['email'];
				$register['password'] = $sign_up_data['password'];
				$register['user_type'] = $sign_up_data['user_type'];
				$register['verification_code'] = $ver_code;

				//profile data
				$profile['jobseeker_first_name'] = $sign_up_data['jobseeker_first_name'];
				$profile['jobseeker_last_name'] = $sign_up_data['jobseeker_last_name'];
				$profile['jobseeker_last_name'] = $sign_up_data['jobseeker_last_name'];
				$profile['jobseeker_country_code_idd'] = $sign_up_data['country_code_idd'];
				$profile['jobseeker_phone_no'] = $sign_up_data['phone_no'];

				$this->db->trans_begin();
				$profile['jobseeker_user_id'] = $this->login_model->register_jobseeker($register);
                $res = $this->login_model->add_new_jobseeker_info($profile);
				$new_resume['jobseeker_user_id'] = $profile['jobseeker_user_id'];
				$new_resume['resume_name'] = 'My Resume';
				$resume_id  = $this->jobseeker_resume_model->create_new_resume($new_resume);
                if (isset($_FILES['user_resume']['name']) && !empty($_FILES['user_resume']['name'])){
//                    $new_resume['jobseeker_user_id'] = $profile['jobseeker_user_id'];
//                    $new_resume['resume_name'] = 'My Resume';
//                    $resume_id  = $this->jobseeker_resume_model->create_new_resume($new_resume);
                    $upload_status = $this->upload_resume($profile['jobseeker_user_id'], $resume_id);
                    $this->jobseeker_resume_model->update_resume_info($resume_id, array('resume_attachment' => $upload_status['file_name']));
                }

                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                    send_welcome_mail_jobseeker($register['email']);
                    $this->send_mail($register['email'], $ver_code);

                    $auth_response = $this->login_model->verify_login_credentials($register['email'], $register['password']);
                    $this->set_login_session($auth_response);
                    $this->session->set_userdata($profile);
                    return array('url' => 'job_seeker/profile/my_profile');
                }

                $this->db->trans_complete();
            } catch (Exception $e) {
                $this->db->trans_rollback();
                return $e->getMessage();
            }
        }
    }

    private function set_default_user_group($company_id, $new_user_id){
    	$basic_user_routes = array(1,10,14);
    	$normal_user_routes = array(1,2,10,14);

    	$user_groups = array(
    		'basic_user' => array(
    			'ug_name'=>'Basic User',
				'routes'=>array(1,10,14)
			),
    		'post_user'=> array(
    			'ug_name'=>'Job Posting Users',
				'routes'=>array(1,2,3,10,14)
			),
		);

    	foreach ($user_groups as $key => $user_group){
			$u_g_id = $this->master_dml_model->add_data_return_id('user_groups', array('company_id'=>$company_id, 'user_group_name'=>$user_groups[$key]['ug_name'], 'created_by'=>$new_user_id));
    		foreach ($user_group['routes'] as $route_id){
				$this->master_dml_model->add_data('user_group_route_access', array('user_group_id'=>$u_g_id, 'route_id'=>$route_id));
			}
		}
	}

    function upload_resume($user_id, $resume_id){

        $config['upload_path']          = './uploads/resume/';
        $config['allowed_types']        = 'pdf|doc|docx';
        $config['max_size']             = 2000;
        $config['file_name']            = $user_id.'_'.$resume_id.'_'.time();

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('user_resume'))
        {
            return FALSE;
        }
        else
        {
            return ($this->upload->data());
        }
    }

    function logout()
    {
        $this->session->unset_userdata('user');
        session_destroy();
        redirect('home');
    }


    function send_mail($mail_id, $code)
    {
//        $this->load->library('email');

        $url = $_SERVER['SERVER_NAME'] . base_url() . 'confirm_email?veri_c=' . urlencode($code) . '&u=' . urlencode($mail_id);

        $subject = 'Verify your Job account';
        $message = '<p>Please this click the button or follow link to verify your account.</p> <br/> 
                    <a href="' . $url . '" target="_blank" style="display: block;
                        width: 115px;
                        height: 25px;
                        background: #F76618;
                        padding: 10px;
                        text-align: center;
                        text-decoration: none;
                        border-radius: 5px;
                        color: white;
                        font-weight: bold;">Confirm Email
                    </a><br/>
                    <p>If you can\'t see the confirm button above, please click the link below . <br > <a href = "' . $url . '" > ' . $url . '</a></p>';

        // Get full html:
        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
                    <title>' . html_escape($subject) . '</title>
                    <style type="text/css">
                        body {
                            font-family: Arial, Verdana, Helvetica, sans-serif;
                            font-size: 16px;
                        }
                    </style>
                </head>
                <body>
                ' . $message . '
                </body>
                </html>';

        // Also, for getting full html you may use the following internal method:
        //$body = $this->email->full_html($subject, $message);

        $result = $this->email
            ->from(NO_REPLY_EMAIL, SITE_NAME)
            ->reply_to(NO_REPLY_EMAIL)// Optional, an account where a human being reads.
            ->to($mail_id)
            ->subject($subject)
            ->message($body)
            ->send();
        return $result;
    }

    function TestEmail(){
		$result = $this->email
			->from(NO_REPLY_EMAIL, SITE_NAME)
			->reply_to(NO_REPLY_EMAIL)// Optional, an account where a human being reads.
			->to('tharinduanjanaabey@gmail.com')
			->subject('Test Ssubject')
			->message('Message Body sample text is tested data')
			->send();
		return $result;
	}

	private function sendTestEmail(){
    	$this->TestEmail();
	}

    function verify_email()
    {

        $check_code = $this->login_model->check_verify_code($_GET['u']);

        if ($check_code['verification_code'] == $_GET['veri_c']) {
            $res = $this->login_model->confirm_email($_GET['u']);
            echo $res == true ? "Thank you, Your email is verified" : 'Something went wrong, please contact support';
        } else
            echo 'Something went wrong, Please contact support';
    }


    function generate_csrf_token()
    {
        echo json_encode($this->security->get_csrf_hash());
    }

    function check_user_login_status()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['user_type'] == 3)
            echo json_encode(true);
        else {
            echo json_encode(false);
        }

    }

    /* Password Reset */
    function view_password_reset()
    {
    	//Password reset page view
    	$data['page_title'] = 'Password Reset';
        $data['main_content'] = 'general/password_reset';

        //load main content page
        $this->load->view('templates/template_extras', $data);

    }

    public function reset_password()
    {
        $email = $this->input->post();

        if (isset($email['forgot_pass_email']) && !empty($email['forgot_pass_email'])) {
            $user_info = $this->login_model->check_user_exist_and_return_id($email['forgot_pass_email']);

            if ($user_info) {
                if ($user_info['email'] === $email['forgot_pass_email']) {
                    $random_pass = $user_info['email'] . bin2hex(random_bytes(3));
                    $random_pass = substr(md5($random_pass), 0, 8);
                    $data = array('user_id' => $user_info['user_id'], 'email' => $user_info['email'], 'random_password' => md5($random_pass));

              	      $this->db->trans_begin();
                     $this->login_model->reset_user_password($data);

                    if ($this->db->trans_status()===FALSE)
                        $this->db->trans_rollback();
                    else{
                        $res = $this->db->trans_commit();
                        if ($res==TRUE) {
                            $res = $this->send_reset_mail($user_info['email'], $random_pass);

                            if ($res)
                                echo json_encode(array('status_code' => 1, 'status_msg' => 'An email has been sent TO your email with the instructions. Please note that it might take few minutes to receive the email'));
                        }
                        else{
                            echo json_encode(array('status_code' => 0, 'status_msg' => 'An error occurred, Please try again or contact support'));
                        }
                    }
                }
            } else {
                echo json_encode(array('status_code' => 0, 'status_msg' => 'There is no account associated with the given email. Please check your email address. For any assistance, please contact our support'));
            }
        }
    }

    public function send_cont_details(){
		$con_details = $this->input->post();
		$full_name = $con_details['full_name'];
		$email = $con_details['email'];
		$subject = $con_details['subject'];
		$message = $con_details['message'];

		$res =$this-> send_contact_details($full_name,$email,$subject,$message);
		if ($res) {
			echo json_encode(array('status_code' => 1, 'status_msg' => 'An email has been sent successfully.'));
		}else{
			echo json_encode(array('status_code' => 0, 'status_msg' => 'An email has been not sent.'));
		}
	}

    function send_reset_mail($mail_id, $reset_code)
    {
//        $this->load->library('email');

        $url = $_SERVER['SERVER_NAME'] . base_url() . 'recover_account?fpc=' . urlencode(base64_encode($reset_code)) . '&u=' . urlencode(base64_encode($mail_id));

        $subject = 'Reset Job account password ';
        $message = '<p>Please this click the button or follow link to reset your password.</p> <br/> 
                    <a href="' . $url . '" target="_blank" style="display: block;
                        width: 115px;
                        height: 25px;
                        background: #F76618;
                        padding: 10px;
                        text-align: center;
                        text-decoration: none;
                        border-radius: 5px;
                        color: white;
                        font-weight: bold;">Reset Password
                    </a><br/>
                    <p>If you can\'t see the confirm button above, please click the link below . <br > <a href = "' . $url . '" > ' . $url . '</a></p>';

        // Get full html:
        $body = EMAIL_HEADER.$message.EMAIL_FOOTER;

        // Also, for getting full html you may use the following internal method:
        //$body = $this->email->full_html($subject, $message);

        $result = $this->email
            ->from(NO_REPLY_EMAIL, SITE_NAME)
            ->reply_to(NO_REPLY_EMAIL)// Optional, an account where a human being reads.
            ->to($mail_id)
            ->subject($subject)
            ->message($body)
            ->send();
        return $result;
    }

    function send_contact_details($full_name,$email,$sub,$msg_details){

    	$subject = 'Contact Details';
		$message = '<p>Contact Details</p> <br/> 
                    <p>
                    Full Name:'.$full_name.'<br> 
                    Email:'.$email.'<br> 
                    Subject:'.$sub.'<br> 
                    Message:'.$msg_details.'<br> 
                    </p>';
		$body = EMAIL_HEADER.$message.EMAIL_FOOTER;
		////////////////////////////////////////////////////////////////////////
		$result = $this->email
			->from(NO_REPLY_EMAIL, SITE_NAME)
			->reply_to(NO_REPLY_EMAIL)// Optional, an account where a human being reads.
			->to('imran@jobenvoy.com')
			->subject($subject)
			->message($body)
			->send();
		//////////////////////////////////////////////////////////////////////////////////
		$result = $this->email
			->from(NO_REPLY_EMAIL, SITE_NAME)
			->reply_to(NO_REPLY_EMAIL)// Optional, an account where a human being reads.
			->to('sumaiyah@envoyortus.com')
			->subject($subject)
			->message($body)
			->send();
		////////////////////////////////////////////////////////////////////////////////
		$result = $this->email
			->from(NO_REPLY_EMAIL, SITE_NAME)
			->reply_to(NO_REPLY_EMAIL)// Optional, an account where a human being reads.
			->to('tharinduanjanaabey@gmail.com')
			->subject($subject)
			->message($body)
			->send();

		return $result;
	}


    function show_new_password_form()
    {
        $reset_code = $this->input->get();
        if (!empty($reset_code['fpc']) && !empty($reset_code['u'])) {
            $vali_check = $this->validate_password_reset(urldecode($reset_code['u']), $reset_code['fpc']);

            if ($vali_check === TRUE) {
                $data['page_title'] = 'Recover Password';
                $data['main_content'] = 'general/new_password_reset_form';
                //load main content page
                $this->load->view('templates/template_extras', $data);
            } else if (strtolower(trim($vali_check)) === "expired") {
                redirect('forgot_password?err=link_expired');
            }
        } else {
            redirect('forgot_password?err=int_error');
        }
    }

    function validate_password_reset($u_email, $reset_code)
    {
        $email = base64_decode($u_email);
        $code = md5(base64_decode($reset_code));

        $user_id = $this->login_model->check_user_name($email);

        if (!empty($user_id['user_id'])) {
            $reset_confirm = $this->login_model->verify_reset_code($user_id['user_id'], $email, $code);

            if ($code === $reset_confirm['random_password'] && $email == $reset_confirm['email'] && !$reset_confirm['is_expired']) {
                return TRUE;
            } elseif ($reset_confirm['is_expired']) {
                return ('expired');
            } else {
                return('int_error');
            }
        } else {
            return('int_error');
        }
    }

    function perform_password_reset(){

        $new_password = $this->input->post();
        $email = $new_password['user'];
        $code = $new_password['check'];
        if($new_password['password']){
            $new_password['password'] = password_hash($new_password['password'], PASSWORD_DEFAULT);
            if (!empty($email) && !empty($code)) {
                $vali_check = $this->validate_password_reset($email, $code);

                if ($vali_check === TRUE) {

                    $this->db->trans_begin();

                    $this->login_model->set_new_password(base64_decode($email), $new_password['password']);
                    $this->login_model->disable_reset_code(base64_decode($email));

                    if ($this->db->trans_status()===FALSE)
                        $this->db->trans_rollback();
                    else {
                        $res = $this->db->trans_commit();
                        $message = 'Your password has been reset succesfully. Please use the new password to <b><a href="'.base_url().'login">login</a></b>';

                        if ($res)
                            echo json_encode(array('status_code' => 1, 'status_msg' => $message));
                    }
                } else {
                    $r_url=base_url().'forgot_password?err=link_expired';
                    echo json_encode(array('status_code' => 0, 'r_url' => $r_url, 'status_msg' => 'An error occured, Please try again or contact support'));
                }
            } else {
                $r_url=base_url().'forgot_password?err=int_error';
                echo json_encode(array('status_code' => 0, 'r_url' => $r_url, 'status_msg' => 'An error occured, Please try again or contact support'));
            }

        }
        else{
            $r_url=base_url().'forgot_password?err=int_error';
            echo json_encode(array('status_code' => 0, 'r_url' => $r_url, 'status_msg' => 'Password field is empty'));
        }
    }

    function view_change_account_password(){
        $data['page_title'] = 'Change Password';
        $data['main_content'] = 'general/change_password';

        //load main content page
        if($_SESSION['user_type'] == 3)
            $this->load->view('templates/template_job_seeker', $data);
        elseif($_SESSION['user_type'] == 2)
            $this->load->view('templates/template_employer', $data);
        elseif ($_SESSION['user_type'] == 1)
            $this->load->view('templates/template_superuser', $data);
    }

    function validate_password_change(){
        $config = array(
            array(
                'field' => 'old_password',
                'label' => 'Current Password',
                'rules' => 'trim|required|xss_clean',
                'errors' => array(
                    'required' => 'You must provide a %s.',
                ),
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|min_length[8]|xss_clean',
                'errors' => array(
                    'required' => 'You must provide a %s.',
                ),
            ),
            array(
                'field' => 'password_confirm',
                'label' => 'Password recheck',
                'rules' => 'trim|required|xss_clean|matches[password]',
                'errors' => array(
                    'required' => 'Please enter a password',
                    'matches' => 'Your passwords does not match.',
                ),
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('code' => 0, 'status_msg' => array(validation_errors())));
        } else {
            $response = $this->do_change_password();
            echo json_encode($response);
        }
    }

    function do_change_password(){
        $pass = $this->input->post();
        $auth_response = $this->login_model->verify_login_credentials($_SESSION['email']);
        if (!empty($auth_response) && $auth_response['is_active']) {
            if(password_verify($pass['old_password'], $auth_response['password'])){
                $new_password['password'] = password_hash($pass['password'], PASSWORD_DEFAULT);
                $res = $this->login_model->set_new_password($_SESSION['email'], $new_password['password']);

                if($res) {
                    $this->send_password_change_mail($_SESSION['email']);
                    return (array('status_code' => 1, 'status_msg' => 'Password changed. Please use new password to login hereafter'));
                }
            }
            else{
                return (array('status_code' => 0, 'status_msg' => 'Your old password does not matching, please check and try again'));
            }
        }
        else{
            return (array('status_code' => 0, 'status_msg' => 'An error occurred, Please try again or contact support'));
        }
    }

    function send_password_change_mail($email){
        $name = '';

        if(!empty($_SESSION['user_type']) && $_SESSION['user_type'] == 3)
            $name = $_SESSION['jobseeker_first_name'];
        elseif(!empty($_SESSION['user_type']) && $_SESSION['user_type'] == 2)
            $name = $_SESSION['email'];
        elseif (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 1)
            $name = $_SESSION['email'];

        $message = EMAIL_HEADER.'<p>Hi '. $name. '! </p><p> Your login password has been rest</p>'.EMAIL_FOOTER;

        $mail_sent = send_password_changed_email($email, $message);
    }
}
