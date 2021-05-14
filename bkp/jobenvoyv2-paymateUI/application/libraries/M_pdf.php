<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class M_pdf
{

 
    function __construct()
    {
        include_once APPPATH.'libraries\vendor\autoload.php';
    }
    function pdf()
    {
        $CI = & get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }
    function load($param = [])
    {
        // ini_set('display_errors', 1);
        // ini_set('display_startup_errors', 1);
        // error_reporting(E_ALL);

       // echo  APPPATH.'libraries/vendor/autoload.php';
        //return new Mpdf($param);
        return  $mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/var/www/jobencoyv2/uploads']);
    }
}
