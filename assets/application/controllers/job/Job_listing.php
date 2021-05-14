<?php
/**
 * Created by PhpStorm.
 * User: simfyz
 * Date: 7/30/2018
 * Time: 4:52 PM
 */

class Job_listing extends CI_Controller
{
	protected $user_id;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('jobs_model');
        $this->load->model('ads_model','ads');


        $this->user_id = ($this->session->user_type == 3) ? $this->session->user_id : 0;
    }

    public function view_job_ads()
    {
        $filter_uri_params = $this->input->get();

        $search_key = NULL;
        $country = NULL;
        $time_filter = NULL;
        $type_filter = NULL;
        $category_filter = NULL;
        $career_level_filter = NULL;
        $gender_filter = NULL;
        $min_salary = NULL;
        $max_salary = NULL;
        $min_exp = NULL;
        $max_exp = NULL;
        $qlf_filter = NULL;

        if (isset($filter_uri_params['q']))
            $search_key =$filter_uri_params['q'];
        if (isset($filter_uri_params['country']))
            $country =$filter_uri_params['country'];
        if (isset($filter_uri_params['time']))
            $time_filter = $this->prepare_time_filter($filter_uri_params['time']);
        if (isset($filter_uri_params['type']))
            $type_filter = $this->prepare_job_type_filter(explode(',', $filter_uri_params['type']));
        if (isset($filter_uri_params['cat']))
            $category_filter = (explode(',', $filter_uri_params['cat']));
        if (isset($filter_uri_params['cr_lvl']))
            $career_level_filter = (explode(',', $filter_uri_params['cr_lvl']));
        if (isset($filter_uri_params['mi_sal']) && isset($filter_uri_params['cur']))
            $min_salary = "'".round($filter_uri_params['mi_sal'] * get_exchange_rate($filter_uri_params['cur'],'USD'), -1)."'";
        if (isset($filter_uri_params['mx_sal']) && isset($filter_uri_params['cur']))
            $max_salary = "'".round($filter_uri_params['mx_sal'] * get_exchange_rate($filter_uri_params['cur'],'USD'), -1)."'";
        if (isset($filter_uri_params['mi_exp']))
            $min_exp = "'".$filter_uri_params['mi_exp']."'";
        if (isset($filter_uri_params['mx_exp']))
            $max_exp = "'".$filter_uri_params['mx_exp']."'";
        if (isset($filter_uri_params['q_lvl']))
            $qlf_filter = (explode(',', $filter_uri_params['q_lvl']));

        $page = isset($filter_uri_params['per_page']) ? $filter_uri_params['per_page'] : 1 ;
        $limit_rows = isset($filter_uri_params['lmt_per']) ? $filter_uri_params['lmt_per'] : 10 ;
        $from = ((!empty($page) ? $page : 1) * $limit_rows)-$limit_rows;

        $url = substr($_SERVER['REQUEST_URI'], strpos($_SERVER["REQUEST_URI"], 'j'));

        if(isset($filter_uri_params['per_page']))
            $url = str_replace('&per_page='.$filter_uri_params['per_page'], '',$url);
        if(isset($filter_uri_params['per_page']))
            $url = str_replace('?per_page='.$filter_uri_params['per_page'], '',$url);
		$page_url = $url;

        $data['job_count'] = $this->jobs_model->get_job_posts($search_key, $country, $time_filter, $type_filter, $category_filter, $career_level_filter, $gender_filter, $min_salary, $max_salary, $min_exp, $max_exp, $qlf_filter);


        //Filters
        $data['job_categories'] = $this->jobs_model->get_job_category();
        $data['job_types'] = $this->jobs_model->get_job_types();
		$data['job_industry'] = $this->master_dml_model->get_all_data('job_industry');
        $data['currencies'] = get_currency_list();
        $data['career_levels'] = get_career_level_list();
        $data['max_salary'] = $this->jobs_model->get_max_salary();
        $data['qualification_levels'] = $this->jobs_model->get_job_qualification();
        $data['max_experience'] = $this->jobs_model->get_max_experience();
        $data['job_post_country'] = $this->jobs_model->get_job_post_city_country();



        //Job Posting
        $data['job_list'] = $this->jobs_model->get_job_posts($search_key,$country, $time_filter, $type_filter, $category_filter, $career_level_filter, $gender_filter, $min_salary, $max_salary, $min_exp, $max_exp, $qlf_filter, $from, $limit_rows);

		if (!empty($this->user_id))
        	$data['saved_jobs'] = $this->jobs_model->get_liked_jobs($this->user_id);

        //ads
		$data['top_banner_ads'] = $this->ads->get_ads_front(5);
		$data['side_banner_ads'] = $this->ads->get_ads_front(6);


        $data['pagination'] = set_pagination(count( $data['job_count']), $page_url, $limit_rows);

        $data['page_title'] = 'Jobs';
        $data['main_content'] = 'job/job_listing_view';

        //load main content page
        $this->load->view('templates/template_main', $data);
    }

	public function view_overseas_job_ads()
	{
		$filter_uri_params = $this->input->get();

		$search_key = NULL;
		$country = NULL;
		$time_filter = NULL;
		$type_filter = NULL;
		$category_filter = NULL;
		$career_level_filter = NULL;
		$gender_filter = NULL;
		$min_salary = NULL;
		$max_salary = NULL;
		$min_exp = NULL;
		$max_exp = NULL;
		$qlf_filter = NULL;

		if (isset($filter_uri_params['q']))
			$search_key =$filter_uri_params['q'];
		if (isset($filter_uri_params['country']))
			$country =$filter_uri_params['country'];
		if (isset($filter_uri_params['time']))
			$time_filter = $this->prepare_time_filter($filter_uri_params['time']);
		if (isset($filter_uri_params['type']))
			$type_filter = $this->prepare_job_type_filter(explode(',', $filter_uri_params['type']));
		if (isset($filter_uri_params['cat']))
			$category_filter = (explode(',', $filter_uri_params['cat']));
		if (isset($filter_uri_params['cr_lvl']))
			$career_level_filter = (explode(',', $filter_uri_params['cr_lvl']));
		if (isset($filter_uri_params['mi_sal']) && isset($filter_uri_params['cur']))
			$min_salary = "'".round($filter_uri_params['mi_sal'] * get_exchange_rate($filter_uri_params['cur'],'USD'), -1)."'";
		if (isset($filter_uri_params['mx_sal']) && isset($filter_uri_params['cur']))
			$max_salary = "'".round($filter_uri_params['mx_sal'] * get_exchange_rate($filter_uri_params['cur'],'USD'), -1)."'";
		if (isset($filter_uri_params['mi_exp']))
			$min_exp = "'".$filter_uri_params['mi_exp']."'";
		if (isset($filter_uri_params['mx_exp']))
			$max_exp = "'".$filter_uri_params['mx_exp']."'";
		if (isset($filter_uri_params['q_lvl']))
			$qlf_filter = (explode(',', $filter_uri_params['q_lvl']));

		$page = isset($filter_uri_params['per_page']) ? $filter_uri_params['per_page'] : 1 ;
		$limit_rows = isset($filter_uri_params['lmt_per']) ? $filter_uri_params['lmt_per'] : 10 ;
		$from = ((!empty($page) ? $page : 1) * $limit_rows)-$limit_rows;

		$url = substr($_SERVER['REQUEST_URI'], strpos($_SERVER["REQUEST_URI"], 'j'));

		if(isset($filter_uri_params['per_page']))
			$url = str_replace('&per_page='.$filter_uri_params['per_page'], '',$url);
		if(isset($filter_uri_params['per_page']))
			$url = str_replace('?per_page='.$filter_uri_params['per_page'], '',$url);
		$page_url = $url;

		$data['job_count'] = $this->jobs_model->get_overseas_job_posts($search_key, $country, $time_filter, $type_filter, $category_filter, $career_level_filter, $gender_filter, $min_salary, $max_salary, $min_exp, $max_exp, $qlf_filter);


		//Filters
		$data['job_categories'] = $this->jobs_model->get_job_category();
		$data['job_types'] = $this->jobs_model->get_job_types();
		$data['job_industry'] = $this->master_dml_model->get_all_data('job_industry');
		$data['currencies'] = get_currency_list();
		$data['career_levels'] = get_career_level_list();
		$data['max_salary'] = $this->jobs_model->get_max_salary();
		$data['qualification_levels'] = $this->jobs_model->get_job_qualification();
		$data['max_experience'] = $this->jobs_model->get_max_experience();
		$data['job_post_country'] = $this->jobs_model->get_job_post_city_country();



		//Job Posting
		$data['job_list'] = $this->jobs_model->get_overseas_job_posts($search_key,$country, $time_filter, $type_filter, $category_filter, $career_level_filter, $gender_filter, $min_salary, $max_salary, $min_exp, $max_exp, $qlf_filter, $from, $limit_rows);

		if (!empty($this->user_id))
			$data['saved_jobs'] = $this->jobs_model->get_liked_jobs($this->user_id);

		//ads
		$data['top_banner_ads'] = $this->ads->get_ads_front(5);
		$data['side_banner_ads'] = $this->ads->get_ads_front(6);


		$data['pagination'] = set_pagination(count( $data['job_count']), $page_url, $limit_rows);

		$data['page_title'] = 'Jobs';
		$data['main_content'] = 'job/job_listing_view';

		//load main content page
		$this->load->view('templates/template_main', $data);
	}

    function prepare_time_filter($filter_received)
    {
        switch ($filter_received) {
            case "last-hour":
                return 'interval 1 hour)';
                break;
            case "24-hour":
                return 'interval 1 day)';
                break;
            case "last-7days":
                return 'interval 7 day)';
                break;
            case "last-14days":
                return 'interval 14 day)';
                break;
            case "last-30days":
                return 'interval 30 day)';
                break;
        }
        return false;
    }

    function prepare_job_type_filter($filter_received)
    {
        $job_type_filter = array();

        foreach ($filter_received as $filter) {

            if ($filter == 'contract')
                $job_type_filter[] = 1;
            elseif ($filter == 'freelance')
                $job_type_filter[] = 2;
            elseif ($filter == 'fulltime')
                $job_type_filter[] = 3;
            elseif ($filter == 'intern')
                $job_type_filter[] = 4;
            elseif ($filter == 'parttime')
                $job_type_filter[] = 5;

        }
        return $job_type_filter;
    }

    function prepare_job_category_filter($filter_received)
    {
        $job_type_filter = array();

        $job_type_filter = explode(',', $filter_received);

        return $job_type_filter;
    }

    function show_current_salary_filter_to_front_view(){
        $filter_uri_params = $this->input->get();
        if(isset($filter_uri_params['mx_sal']) && isset($filter_uri_params['cur']))
            return $filter_uri_params['mx_sal'] * currency_converter('USD', $filter_uri_params['cur']);
        elseif (!empty($max_salary['max_sal_usd']))
            return round($max_salary['max_sal_usd']);
        else
            return "20000";
    }

    function get_country_list(){
        $data = get_country_list();
        echo json_encode($data);
    }

    function get_job_list(){

        $phrase = $this->input->get('phrase');
        $data = $this->jobs_model->get_job_list($phrase);
        $list = array();

        if(!empty($data)){
            foreach ($data as $value){
                array_push( $list, $value['job_post_title']);
            }
        }

        echo json_encode(array("job_post_title"=>$list, "inputPhrase"=>$phrase));
    }

}
