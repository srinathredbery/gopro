<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 3/19/2019
 * Time: 1:29 PM
 */

class Su_dashboard extends Main_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Su_statistics_model', 'stats_model');
        $this->load->model('Jobs_model', 'jobs_model');
//        if (isset($_SESSION['logged_in']) && $_SESSION['user_type'] == 1)
//            return;
//        else
//            redirec_login();
    }

    public function index()
    {

        $data['year_filter'] = $this->stats_model->get_last_five_years();

        $data['page_title'] = 'Dashboard &bull; Super User';
        $data['main_content'] = 'superuser/su_dashboard';

        //load main content page
        $this->load->view('templates/template_superuser', $data);
    }

    function js_user_growth_yearly(){
        $selected_year = $this->input->get('sel_year');
        $selected_year = !empty($selected_year) ? $selected_year : date('Y');

        $job_seekers = $this->stats_model->get_user_growth_data_by_year('3', $selected_year);

        $js_aggregate_count = 0;

        $current_year=date("Y");;
        $CurentMonth=date('m')+1;

		if($selected_year==$current_year) {
			for ($month = 1; $month < $CurentMonth; $month++) {
				$output['month'][] = date("M", mktime(0, 0, 0, $month, 1));
				$js_match = false;

				foreach ($job_seekers as $job_seeker) {

					if ($job_seeker['by_month'] == $month) {
						$output['count_js'][] = (int)$job_seeker['user_count'];
						$js_aggregate_count += (int)$job_seeker['user_count'];
						$output['aggregate_js'][] = $js_aggregate_count;
						$js_match = true;
					}
				}
				if (!$js_match) {
					$output['count_js'][] = 0;
					$output['aggregate_js'][] = $js_aggregate_count;
				}
			}
		}else{
			for ($month = 1; $month < 13; $month++) {
				$output['month'][] = date("M", mktime(0, 0, 0, $month, 1));
				$js_match = false;

				foreach ($job_seekers as $job_seeker) {

					if ($job_seeker['by_month'] == $month) {
						$output['count_js'][] = (int)$job_seeker['user_count'];
						$js_aggregate_count += (int)$job_seeker['user_count'];
						$output['aggregate_js'][] = $js_aggregate_count;
						$js_match = true;
					}
				}
				if (!$js_match) {
					$output['count_js'][] = 0;
					$output['aggregate_js'][] = $js_aggregate_count;
				}
			}
		}
        echo json_encode($output, JSON_PRETTY_PRINT);
    }

    function js_user_growth_overall()
    {
        $selected_year = $this->input->get('sel_year');
        $selected_year = !empty($selected_year) ? $selected_year : date('Y');

        $js_last_year_count = $this->stats_model->get_user_count_till_last_year('3', $selected_year);

        $job_seekers = $this->stats_model->get_user_growth_data_by_year('3', $selected_year);

        $job_seeker_agg_count = 0;

        foreach ($js_last_year_count as $item) {
            $job_seeker_agg_count += $item['user_count'];
        }
		$current_year=date("Y");;
		$CurentMonth=date('m')+1;

		if($selected_year==$current_year) {

			for ($month = 1; $month < $CurentMonth; $month++) {
				$output['month'][] = date("M", mktime(0, 0, 0, $month, 1));
				$js_match = false;

				foreach ($job_seekers as $job_seeker) {

					if ($job_seeker['by_month'] == $month) {
						$output['count_js'][] = (int)$job_seeker['user_count'];
						$job_seeker_agg_count += (int)$job_seeker['user_count'];
						$output['aggregate_js'][] = $job_seeker_agg_count;
						$js_match = true;
					}
				}
				if (!$js_match) {
					$output['count_js'][] = 0;
					$output['aggregate_js'][] = $job_seeker_agg_count;
				}

			}
		}else{
			for ($month = 1; $month < 13; $month++) {
				$output['month'][] = date("M", mktime(0, 0, 0, $month, 1));
				$js_match = false;

				foreach ($job_seekers as $job_seeker) {

					if ($job_seeker['by_month'] == $month) {
						$output['count_js'][] = (int)$job_seeker['user_count'];
						$job_seeker_agg_count += (int)$job_seeker['user_count'];
						$output['aggregate_js'][] = $job_seeker_agg_count;
						$js_match = true;
					}
				}
				if (!$js_match) {
					$output['count_js'][] = 0;
					$output['aggregate_js'][] = $job_seeker_agg_count;
				}

			}
		}
        echo json_encode($output, JSON_PRETTY_PRINT);
    }

    function emp_user_growth_yearly(){
        $selected_year = $this->input->get('sel_year');
        $selected_year = !empty($selected_year) ? $selected_year : date('Y');

        $employers = $this->stats_model->get_user_growth_data_by_year('2', $selected_year);

        $emp_aggregate_count = 0;


		$current_year=date("Y");;
		$CurentMonth=date('m')+1;

		if($selected_year==$current_year) {
			for ($month = 1; $month < $CurentMonth; $month++) {
				$output['month'][] = date("M", mktime(0, 0, 0, $month, 1));
				$emp_match = false;


				foreach ($employers as $employer) {
					if ($employer['by_month'] == $month) {
						$output['count_emp'][] = (int)$employer['user_count'];
						$emp_aggregate_count += (int)$employer['user_count'];
						$output['aggregate_emp'][] = $emp_aggregate_count;
						$emp_match = true;
					}
				}

				if (!$emp_match) {
					$output['count_emp'][] = 0;
					$output['aggregate_emp'][] = $emp_aggregate_count;
				}
			}
		}else{
			for ($month = 1; $month < 13; $month++) {
				$output['month'][] = date("M", mktime(0, 0, 0, $month, 1));
				$emp_match = false;


				foreach ($employers as $employer) {
					if ($employer['by_month'] == $month) {
						$output['count_emp'][] = (int)$employer['user_count'];
						$emp_aggregate_count += (int)$employer['user_count'];
						$output['aggregate_emp'][] = $emp_aggregate_count;
						$emp_match = true;
					}
				}

				if (!$emp_match) {
					$output['count_emp'][] = 0;
					$output['aggregate_emp'][] = $emp_aggregate_count;
				}
			}
		}
        echo json_encode($output, JSON_PRETTY_PRINT);
    }

    function emp_user_growth_overall()
    {
        $selected_year = $this->input->get('sel_year');
        $selected_year = !empty($selected_year) ? $selected_year : date('Y');

        $emp_last_year_count = $this->stats_model->get_user_count_till_last_year('2', $selected_year);

        $employers = $this->stats_model->get_user_growth_data_by_year('2', $selected_year);

        $emp_aggregate_count = 0;

        foreach ($emp_last_year_count as $item) {
            $emp_aggregate_count += $item['user_count'];
        }
		$current_year=date("Y");;
		$CurentMonth=date('m')+1;

		if($selected_year==$current_year) {
			for ($month = 1; $month < $CurentMonth; $month++) {
				$output['month'][] = date("M", mktime(0, 0, 0, $month, 1));
//            $js_match = false;
				$emp_match = false;


				foreach ($employers as $employer) {
					if ($employer['by_month'] == $month) {
						$output['count_emp'][] = (int)$employer['user_count'];
						$emp_aggregate_count += (int)$employer['user_count'];
						$output['aggregate_emp'][] = $emp_aggregate_count;
						$emp_match = true;
					}
				}

				if (!$emp_match) {
					$output['count_emp'][] = 0;
					$output['aggregate_emp'][] = $emp_aggregate_count;
				}
			}
		}else{
			for ($month = 1; $month < 13; $month++) {
				$output['month'][] = date("M", mktime(0, 0, 0, $month, 1));
//            $js_match = false;
				$emp_match = false;


				foreach ($employers as $employer) {
					if ($employer['by_month'] == $month) {
						$output['count_emp'][] = (int)$employer['user_count'];
						$emp_aggregate_count += (int)$employer['user_count'];
						$output['aggregate_emp'][] = $emp_aggregate_count;
						$emp_match = true;
					}
				}

				if (!$emp_match) {
					$output['count_emp'][] = 0;
					$output['aggregate_emp'][] = $emp_aggregate_count;
				}
			}
		}
        echo json_encode($output, JSON_PRETTY_PRINT);
    }

    function job_post_growth_yearly(){
        $selected_year = $this->input->get('sel_year');
        $selected_year = !empty($selected_year) ? $selected_year : date('Y');

        $job_posts = $this->stats_model->get_job_post_growth_data_by_year($selected_year);

        $job_post_aggregate = 0;

		$current_year=date("Y");;
		$CurentMonth=date('m')+1;

		if($selected_year==$current_year) {
			for ($month = 1; $month < $CurentMonth; $month++) {
				$output['month'][] = date("M", mktime(0, 0, 0, $month, 1));
				$emp_match = false;


				foreach ($job_posts as $job_post_count) {
					if ($job_post_count['by_month'] == $month) {
						$output['count_post'][] = (int)$job_post_count['post_count'];
						$job_post_aggregate += (int)$job_post_count['post_count'];
						$output['aggregate_post_count'][] = $job_post_aggregate;
						$emp_match = true;
					}
				}

				if (!$emp_match) {
					$output['count_post'][] = 0;
					$output['aggregate_post_count'][] = $job_post_aggregate;
				}
			}
		}else{
			for ($month = 1; $month < 13; $month++) {
				$output['month'][] = date("M", mktime(0, 0, 0, $month, 1));
				$emp_match = false;


				foreach ($job_posts as $job_post_count) {
					if ($job_post_count['by_month'] == $month) {
						$output['count_post'][] = (int)$job_post_count['post_count'];
						$job_post_aggregate += (int)$job_post_count['post_count'];
						$output['aggregate_post_count'][] = $job_post_aggregate;
						$emp_match = true;
					}
				}

				if (!$emp_match) {
					$output['count_post'][] = 0;
					$output['aggregate_post_count'][] = $job_post_aggregate;
				}
			}
		}
        echo json_encode($output, JSON_PRETTY_PRINT);
    }

    function job_post_growth_overall(){
        $selected_year = $this->input->get('sel_year');
        $selected_year = !empty($selected_year) ? $selected_year : date('Y');

        $emp_last_year_count = $this->stats_model->get_job_post_count_till_year($selected_year);

        $job_posts = $this->stats_model->get_job_post_growth_data_by_year($selected_year);

        $job_post_aggregate = 0;

        foreach ($emp_last_year_count as $item) {
            $job_post_aggregate += $item['post_count'];
        }

		$current_year=date("Y");;
		$CurentMonth=date('m')+1;

		if($selected_year==$current_year) {
			for ($month = 1; $month < $CurentMonth; $month++) {
				$output['month'][] = date("M", mktime(0, 0, 0, $month, 1));
//            $js_match = false;
				$emp_match = false;


				foreach ($job_posts as $job_post_count) {
					if ($job_post_count['by_month'] == $month) {
						$output['count_post'][] = (int)$job_post_count['post_count'];
						$job_post_aggregate += (int)$job_post_count['post_count'];
						$output['aggregate_post_count'][] = $job_post_aggregate;
						$emp_match = true;
					}
				}

				if (!$emp_match) {
					$output['count_post'][] = 0;
					$output['aggregate_post_count'][] = $job_post_aggregate;
				}
			}
		}else{
			for ($month = 1; $month < 13; $month++) {
				$output['month'][] = date("M", mktime(0, 0, 0, $month, 1));
//            $js_match = false;
				$emp_match = false;


				foreach ($job_posts as $job_post_count) {
					if ($job_post_count['by_month'] == $month) {
						$output['count_post'][] = (int)$job_post_count['post_count'];
						$job_post_aggregate += (int)$job_post_count['post_count'];
						$output['aggregate_post_count'][] = $job_post_aggregate;
						$emp_match = true;
					}
				}

				if (!$emp_match) {
					$output['count_post'][] = 0;
					$output['aggregate_post_count'][] = $job_post_aggregate;
				}
			}
		}
        echo json_encode($output, JSON_PRETTY_PRINT);
    }

    function last_five_jobs(){
        $last_five_jobs = $this->jobs_model->get_recent_jobs(5);

        $posts = '';

        foreach ($last_five_jobs as $job){

            $job_type_class='';

            if( !empty($job['job_post_job_type'])){
                if($job['job_post_job_type']==1)
                    $job_type_class = 'tp';
                elseif($job['job_post_job_type']==2)
                    $job_type_class = 'fl';
                elseif($job['job_post_job_type']==3)
                    $job_type_class = 'ft';
                elseif($job['job_post_job_type']==4)
                    $job_type_class = 'it';
                elseif($job['job_post_job_type']==5)
                    $job_type_class = 'pt';
            }

            $post_id = !empty($job['job_post_id']) ? $job['job_post_id'] : '';
            $job_post_title = !empty($job['job_post_title']) ? $job['job_post_title'] : '';
            $employer_name = !empty($job['employer_name']) ? $job['employer_name'] : 'Name not given';
            $logo = !empty($job['employer_logo_url']) ? EMP_LOGO_READ_DIR.$job['employer_logo_url'] : DEFAULT_EMP_LOGO;
            $job_type_name = !empty($job['job_type_name']) ? $job['job_type_name'] : '';
            $job_post_posted_date = !empty($job['job_post_posted_date']) ? date('dS M Y @ H:m:i', strtotime($job['job_post_posted_date'])) : '';
            $post_approval = !empty($job['post_approval']) ? '<span class="badge badge-success">Approved</span>' : '<span class="badge badge-danger">Pending</span>';

            $posts .= '<tr>
                            <td>
                                <div class="table-list-title">
                                '.$post_id.'
                                </div>                                                            
                            </td>
                            <td>
                                <div class="c-logo-cus mr-2">
                                    <img src="'.$logo.'" alt="">
                                </div>
                                <div class="table-list-title">
                                    <h3 class="font-weight-bold">
                                        <a href="" target="_blank" title="">
                                            '.$job_post_title.'                                            
                                        </a>
                                    </h3>                  
                                    <span class="employer-name">'.$employer_name.'</span>                  
                                    
                                </div>
                            </td>
                            <td>
                                <div class="table-list-title">
                                    <span><i class="la la-calendar"></i>'.$job_post_posted_date.'</span>
                                </div>
                            </td>
                            <td><span class="job-is '.$job_type_class.'">'.$job_type_name.'</span></td>
                            <td>'.$post_approval.'</td>
                       </tr>';
        }
        echo $posts;
    }

    function last_five_job_seekers(){
        $last_five_users = $this->stats_model->get_last_five_job_seekers();

        $users = '';

        foreach ($last_five_users as $user){

            $emp_id = !empty($user['jobseeker_id']) ? $user['jobseeker_id'] : '';
            $name = !empty($user['jobseeker_first_name']) ? $user['jobseeker_first_name'] : '';
            $name .= !empty($user['jobseeker_last_name']) ? ' '.$user['jobseeker_last_name'] : '';
            $dpic = !empty($user['jobseeker_dp_url']) ? USER_PRO_PIC_READ_DIR.$user['jobseeker_dp_url'] : DEFAULT_PRO_PIC;
            $joined_date = !empty($user['joined_date']) ? date('dS M Y @ H:m:i', strtotime($user['joined_date'])) : '';
            $ver_status = !empty($user['verification_status']) ? '<span class="badge badge-success">Verified</span>' : '<span class="badge badge-danger">Not Verified</span>';

            $users .= '<tr>
                            <td>
                                <div class="table-list-title">
                                '.$emp_id.'
                                </div>                                                            
                            </td>
                            <td>
                                <div class="c-logo-cus mr-2">
                                    <img class="rounded-circle" src="'.$dpic.'" alt="">
                                </div>
                                <div class="table-list-title">
                                    <h3 class="font-weight-bold">
                                        <a title="">
                                            '.$name.'                                            
                                        </a>
                                    </h3>                                    
                                    <span><i class="la la-calendar"></i>'.$joined_date.'</span>
                                </div>
                            </td>
                            <td>'.$ver_status.'</td>
                       </tr>';
        }

        echo $users;
    }

    function last_five_employers(){
        $last_five_users = $this->stats_model->get_last_five_employers();

        $users = '';

        foreach ($last_five_users as $user){

            $emp_id = !empty($user['employer_id']) ? $user['employer_id'] : '';
            $name = !empty($user['employer_name']) ? $user['employer_name'] : 'Name not given';
            $logo = !empty($user['employer_logo_url']) ? EMP_LOGO_READ_DIR.$user['employer_logo_url'] : DEFAULT_EMP_LOGO;
            $joined_date = !empty($user['joined_date']) ? date('dS M Y @ H:m:i', strtotime($user['joined_date'])) : '';
            $ver_status = !empty($user['verification_status']) ? '<span class="badge badge-success">Verified</span>' : '<span class="badge badge-danger">Not Verified</span>';

            $users .= '<tr>
                            <td>
                                <div class="table-list-title">
                                '.$emp_id.'
                                </div>                                                            
                            </td>
                            <td>
                                <div class="c-logo-cus mr-2">
                                    <img src="'.$logo.'" alt="">
                                </div>
                                <div class="table-list-title">
                                    <h3 class="font-weight-bold">
                                        <a title="">
                                            '.$name.'                                            
                                        </a>
                                    </h3>                                    
                                    <span><i class="la la-calendar"></i>'.$joined_date.'</span>
                                </div>
                            </td>
                            <td>'.$ver_status.'</td>
                       </tr>';
        }

        echo $users;
    }
}
