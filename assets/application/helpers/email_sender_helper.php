<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: simfyz
 * Date: 9/26/2018
 * Time: 2:21 PM
 */

if (!function_exists('send_email')) {
	function send_email($user_mail)
	{
		$CI =& get_instance();
		$api_key = getenv('SENDGRID_API_KEY');
		$content = file_get_contents('assets/mail_template/index.html');
		$name = ($CI->session->employer_name) ? $CI->session->employer_name : 'Test Name';
		$content = str_replace("{name}", $name, $content);


		$email = new \SendGrid\Mail\Mail();
		$email->setFrom(NO_REPLY_EMAIL, SITE_NAME);
		$email->setSubject("Welcome to Job Hunt");
		$email->addTo($user_mail, "Fayas Ismail");
		$email->addContent("text/html", $content);

		$sendgrid = new \SendGrid($api_key);
		try {
			$response = $sendgrid->send($email);
			print $response->statusCode() . "\n";
			print_r($response->headers());
			print $response->body() . "\n";
		} catch (Exception $e) {
			echo 'Caught exception: ' . $e->getMessage() . "\n";

		}
	}
}

if (!function_exists('send_welcome_mail_jobseeker')) {
    function send_welcome_mail_jobseeker($user_mail)
    {
        $CI =& get_instance();
        $result = $CI->email
            ->from(NO_REPLY_EMAIL, SITE_NAME)
            ->reply_to(NO_REPLY_EMAIL)// Optional, an account where a human being reads.
            ->to($user_mail)
            ->subject('Get started with your career')
            ->message(WELCOME_MAIL)
            ->send();
        return $result;
	}
}

if (!function_exists('send_password_changed_email')) {
	function send_password_changed_email($user_mail, $message){
        $CI =& get_instance();
        $result = $CI->email
            ->from(NO_REPLY_EMAIL, SITE_NAME)
            ->reply_to(NO_REPLY_EMAIL)// Optional, an account where a human being reads.
            ->to($user_mail)
            ->subject('Your Jobenvoy account password has been changed')
            ->message($message)
            ->send();
        return $result;
    }
}
