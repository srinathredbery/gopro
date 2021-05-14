<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 8/3/2018
 * Time: 4:37 PM
 */

class Employer_interview extends Main_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Employer_interview_model', 'interview_model');
        if (isset($_SESSION['logged_in']) && $_SESSION['user_type'] == 2)
            return;
        else
            redirect('login');
    }

    public function index()
    {
        $data['interview_schedules'] = $this->interview_model->get_all_interviews($_SESSION['company_id']);

        $data['page_title'] = 'Interviews &bull; Employer';
        $data['main_content'] = 'employer/employer_interview';

        //load main content page
        $this->load->view('templates/template_employer', $data);
    }

    function create_job_interview_calendar(){
        $jop_post_id = $this->input->post();
        $data['job_post_id'] = $jop_post_id['post_id'];
        $res = $this->interview_model->add_interview_calendar($data);
        echo $res;
    }

	function get_all_interview_calendar(){

        $jobs_list = $this->interview_model->get_all_interviews($_SESSION['company_id']);

        $calendar = array();
        $i = 0;

        foreach ($jobs_list as $item){

			$color = generate_random_color();
			$text = get_contrast_color_code($color);

			$calendar[$i]['id'] = $item['job_post_id'];
			$calendar[$i]['name'] = $item['job_post_title'];
			$calendar[$i]['color'] = $text;
			$calendar[$i]['bgColor'] = $color;
			$calendar[$i]['dragBgColor'] = $color;
			$calendar[$i]['borderColor'] = $color;
			$i++;
        }

        echo json_encode($calendar, JSON_FORCE_OBJECT);

    }

    function create_interview_schedule(){
    	$schedule_data = $this->input->post();

    	$data['application_id'] = $schedule_data['application_id'];
    	$data['interview_date'] = $schedule_data['application_id'];

    	echo json_encode($schedule_data);
	}

	function get_all_schedules(){
		$schedules = $this->interview_model->get_all_schedules($_SESSION['company_id']);

		$calendar = array();
		$i = 0;

		foreach ($schedules as $item){

			$color = generate_random_color();
			$text = get_contrast_color_code($color);

			$date = $item['interview_date'];
			$star_time = $item['start_time'];
			$end_time = $item['end_time'];

			$calendar[$i]['id'] = $item['id'];
			$calendar[$i]['calendarId'] = $item['calendar_id'];
			$calendar[$i]['title'] = $item['title'];
			$calendar[$i]['category'] = 'time';
			$calendar[$i]['dueDateClass'] = '';
			$calendar[$i]['start'] = date(DATE_ISO8601, strtotime($date.' '.$star_time));
			$calendar[$i]['end'] = date(DATE_ISO8601, strtotime($date.' '.$end_time));
			$i++;
		}
		echo json_encode($calendar, JSON_FORCE_OBJECT);
	}
}
