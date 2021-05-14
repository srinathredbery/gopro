<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
                 }

    public function index()
    {
   //     redirect('/');

$this->load->library('email');
$this->email->from('omrangroup@mail.com', 'Sender Name');
$this->email->to('srinath@redberylit.com','Recipient Name');
$this->email->subject('Your Subject');
$this->email->message('Your Message');
try{
$this->email->send();
echo 'Message has been sent.';
}catch(Exception $e){
echo $e->getMessage();
}
    }

    public function view_home()
    {
        $data['ads_below_banner_right'] = $this->ads_model->get_ads_front(1);
        $data['ads_below_banner_left'] = $this->ads_model->get_ads_front(4);
        $data['ads_mid_page'] = $this->ads_model->get_ads_front(3);
        $data['ads_footer'] = $this->ads_model->get_ads_front(2);

        $data['recent_jobs'] = $this->jobs->get_recent_jobs(12);
        $data['featured_jobs'] = $this->jobs->get_featured_job(3);
        $data['job_category'] = $this->jobs->get_job_category();

        $data['job_post_country'] = $this->jobs->get_job_post_city_country();

        $data['main_content'] = 'home';

        //load main content page
        $this->load->view('templates/template_main', $data);
    }

    /**
     * Get Download PDF File
     *
     * @return Response
     */
    public function convertpdf()
    {

        $this->load->view('generatepdf');

        // Get output html
        $html = $this->output->get_output();

        // Load pdf library
        $this->load->library('pdf');
        // Load HTML content
        $this->pdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $this->pdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $this->pdf->render();

        // Output the generated PDF (1 = download and 0 = preview)
        $this->pdf->stream("welcome.pdf", array("Attachment"=>0));
    }
}

