<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 8/17/2018
 * Time: 2:56 PM
 */

class Employers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (isset($_SESSION['logged_in']) && $_SESSION['user_type'] == 2)
            return;
        else
            redirect('login');
    }

    public function index(){
        $data['page_title'] = 'Our Partners';
        $data['main_content'] = 'employer/employers_list';

        //load main content page
        $this->load->view('templates/template_main', $data);
    }

}