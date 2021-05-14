<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 8/17/2018
 * Time: 4:40 PM
 */

class Change_password extends Main_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (isset($_SESSION['logged_in']))
            return;
        else
            redirec_login();
    }

    public function view_change_account_password(){
        $data['page_title'] = 'Change Password';
        $data['main_content'] = 'general/change_password';

        //load main content page
        if(!empty($_SESSION['user_type']) && $_SESSION['user_type'] == 3)
            $this->load->view('templates/template_job_seeker', $data);
        elseif(!empty($_SESSION['user_type']) && $_SESSION['user_type'] == 2)
            $this->load->view('templates/template_employer', $data);
        elseif (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 1)
            $this->load->view('templates/template_superuser', $data);
    }
}
