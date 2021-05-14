<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 7/30/2018
 * Time: 2:47 PM
 */

$user_type = $this->session->user_type;

$this->load->view('include/header');
if ($user_type == 1)
	$this->load->view('include/nav_employer');
if ($user_type == 2)
	$this->load->view('include/nav_employer');
if ($user_type == 3)
	$this->load->view('include/nav_job_seeker');

$this->load->view($main_content);
$this->load->view('include/footer');
