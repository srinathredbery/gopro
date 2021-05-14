<?php
defined('BASEPATH') or exit('No direct script access allowed');
use \Mpdf\Mpdf;

class Welcome extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('employer_job_post_model');
    }
    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index()
    {
        $this->load->view('welcome_message');
    }


    /**
     * Get Download PDF File
     *
     * @return Response
     */
    

    function convertpdfold()
    {

        $id=$this->input->get('id');
        $data['page_title'] = 'Offer Latter';
        $data['active_job_posts'] = $this->employer_job_post_model->ats_paper_view_offer_later($id);
        $this->load->view('generatepdf', $data);
        // Get output html
        $html = $this->output->get_output();
        // Load pdf library
        $this->load->library('pdf');

        // Load HTML content
        $this->dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation//portrait/landscape
        $this->dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $this->dompdf->render();

        $path['file_path']=$this->employer_job_post_model->ats_paper_view_offer_later_get_pdf_path($id);
//      $path=explode('file_',$path['file_path'])[1];
//      delete_files('assets\offer_latters\file_'.$path."");
        // Output the generated PDF (1 = download and 0 = preview)
        $this->dompdf->stream("welcome.pdf", array("Attachment"=>0));

        $file_name_set_rand_no=rand();
        //update_file_name
        $this->employer_job_post_model->ats_paper_view_offer_later_update_pdf_path($id, 'file_'.$file_name_set_rand_no);
        //Saved tharindu
        $output =$this->dompdf->output();
        //http://localhost/jobenvoy/jobenvoy/
        file_put_contents('assets\offer_latters\file_'.$file_name_set_rand_no.'.pdf', $output);
    }



    function convertpdf()
    {

        
        $this->load->library('M_pdf');
        $mpdf = $this->m_pdf->load([
        'mode' => 'utf-8',
        'format' => 'A4'
        ]);




        $mpdf->autoScriptToLang  = true;







         $id=$this->input->get('id');
        $data['page_title'] = 'Offer Latter';
        $data['active_job_posts'] = $this->employer_job_post_model->ats_paper_view_offer_later($id);



        //echo var_dump($data);




        $header='<img class="img-fluid float-right" src="http://rbjobs.rbdemo.live/assets/header.png"  style="width:100%;">';
      
        
        $footer='<img class="img-fluid footer-icon" src="http://rbjobs.rbdemo.live/assets/footer.png" style="width:100%;">'  ;
    


        $stylesheet = file_get_contents('http://rbjobs.rbdemo.live/assets/styles/css/pdf.css'); // external css
        $mpdf->SetTitle('Offer Latter');


         $mpdf->SetHTMLHeader($header);
             $mpdf->SetHTMLFooter($footer);

        $html = $this->load->view('html_to_pdf', $data, true);



         $mpdf->WriteHTML($stylesheet, 1);
         $mpdf->WriteHTML($html, 2);
         $mpdf->Output();
         exit();
    }
}
