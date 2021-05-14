<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 8/16/2018
 * Time: 5:59 PM
 */

class Extras extends CI_Controller
{
    function view_about_us(){
        $data['blogs'] = $this->master_dml_model->get_all_data('blog_posts');
        $data['page_title'] = 'About Us';
        $data['main_content'] = 'extras/about';

        //load main content page
        $this->load->view('templates/template_extras', $data);
    }

    function view_contact_us(){
        $data['page_title'] = 'Contact Us';
        $data['main_content'] = 'extras/contact';

        //load main content page
        $this->load->view('templates/template_extras', $data);
    }

    function view_how_it_works(){
        $data['page_title'] = 'How It Works';
        $data['main_content'] = 'extras/how_it_works';

        //load main content page
        $this->load->view('templates/template_extras', $data);
    }

    function view_faq_page(){
        $data['page_title'] = 'Frequently Asked Questions';
        $data['main_content'] = 'extras/faq_page';

        //load main content page
        $this->load->view('templates/template_extras', $data);
    }

    function view_tos_page(){
        $data['page_title'] = 'Terms & Conditions';
        $data['main_content'] = 'extras/terms_of_services';

        //load main content page
        $this->load->view('templates/template_extras', $data);
    }

    function view_privacy_page(){
        $data['page_title'] = 'Privacy Policy';
        $data['main_content'] = 'extras/privacy_policy';

        //load main content page
        $this->load->view('templates/template_extras', $data);
    }

    function error_404(){
        //load main content page
        $this->load->view('errors/custom/error_404');
    }

    function error_not_authorized(){
        //load main content page
		if (!empty($this->session->logged_in)) {
			$data['main_content'] = 'errors/custom/error_not_authorized';
			$this->load->view('templates/template_employer', $data);
		}
		else{
			redirec_login();
		}
    }

    function currency_converter_api(){
        $curr = $this->input->get();
        echo currency_converter($curr['f'], $curr['t']);
    }

    function send_grid(){
		send_notification_email('fayas.gears@gmail.com');
	}
}
