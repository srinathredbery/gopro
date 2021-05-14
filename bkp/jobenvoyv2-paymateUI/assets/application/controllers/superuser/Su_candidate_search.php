<?php


class Su_candidate_search extends Main_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('su_candidate_search_model', 'search');
	}

	public function view_page(){

		$data['country_list'] = $this->master_dml_model->get_all_data('iso_codes_master', 'country_name IS NOT NULL', 'country_name ASC');
		$data['job_category'] = $this->master_dml_model->get_all_data('job_category');
		$data['industry'] = $this->master_dml_model->get_all_data('job_industry');
		$data['job_type'] = $this->master_dml_model->get_all_data('job_type');
		$data['qualification'] = $this->master_dml_model->get_all_data('qualification_level_master');
		$data['language'] = $this->master_dml_model->get_all_data('language_master', NULL, 'language_name');

		$data['page_title'] = 'Candidate Seach &bull; Super User';
		$data['main_content'] = 'superuser/su_candidate_search';


		//load main content page
		$this->load->view('templates/template_superuser', $data);
	}


	function do_search(){
		$dt_data = $this->input->get();

		$data = $row = array();

		if (!empty($dt_data)) {
			$search_results = $this->search->search_match($dt_data);
			if (!empty($dt_data['search_q']) || !empty($dt_data['country']) || !empty($dt_data['industry']) || !empty($dt_data['qualification'])) {
				$i = $dt_data['start']= 0;
				foreach ($search_results['results'] as $result) {
					$i++;
					$fill_rate = $this->calculate_resume_fill_status($result);
					$resume_id = $result->resume_id;

					$dp_pic = !empty($result->jobseeker_dp_url) ? USER_PRO_PIC_READ_DIR . $result->jobseeker_dp_url : DEFAULT_PRO_PIC;
					$name = !empty($result->jobseeker_first_name) ? $result->jobseeker_first_name : '';
					$name .= !empty($result->jobseeker_last_name) ? " " . $result->jobseeker_last_name : '';
					$current_job = !empty($result->recent_job) ? $result->recent_job : '';
					$current_company = !empty($result->recent_work_place) ? $result->recent_work_place : '';
					$date = !empty($result->joined_date) ? date('jS M Y', strtotime($result->joined_date)) : '';
//					$skill = $this->search->get_candidate_skills($result->resume_id);
//					$skill = $skill->skill_set;
					$skill = !empty($result->skill_set) ? $result->skill_set : '';;

					$candidate = '<td class="candidate-card">
									<div class="c-logo-cus mr-4 mt-1" style="width: 80px;">
										<img class="rounded-circle xx" src="' . $dp_pic . '" style="width: 80px;" alt="">
									</div>
									<div class="table-list-title">
										<h3 class="font-weight-bold name-emp">
											<a title="" href="' . base_url() . 'superuser/candidate_search/view_resume?r_id=' . base64_encode($resume_id) . '" target="_blank">
												' . $name .'
											</a>
										</h3>	
										<div class="set-description" style="display: -webkit-box;">																				
											<span><i class="la la-suitcase"></i><span class="text-success">' . $current_job . '</span> at <span class="text-primary">' . $current_company . '</span></span><br>
											<span class="text-secondary"><i class="la la-calendar-o"></i>' . $date . '</span><br>
											<span class="skill-clr"><i class="la la-bookmark"></i>' . $skill . '</span>
										</div>
									</div>
								</td>';
					$fill_colour =
						(($fill_rate < 25) ? 'bg-danger' :
							(($fill_rate < 50)  ? 'bg-warning' :
								(($fill_rate < 75)  ? 'bg-info' :
									(($fill_rate >= 75) ? 'bg-success' : '' ))));

					$action = '<td>
									<div class="action-resume">
										<div class="action-center">
											<span>More <i class="la la-angle-down"></i></span>
											<ul>
												<li>
													<a  title="" href="' . base_url() . 'superuser/candidate_search/view_resume?r_id=' . base64_encode($resume_id) . '" target="_blank">
														<i class="la la-eye"></i> &nbsp; View Profile
													</a>
												</li>
												<li >
													<a title="" onclick="show_access_menu()">
														<i class="la la-edit"></i> &nbsp; Access Dashboard
													</a>
												</li>                                                            
											</ul>
										</div>
									</div>
								</td>';

					$progress_bar = '<td>
										<div class="progressbar" title="Resume Completeness '.$fill_rate.'% ">
											<div class="progress '.$fill_colour.'" style="width: '.$fill_rate.'%">
												<span>'.$fill_rate.'%</span>
											</div>
										</div>
									</td>';

					$data[] = array($candidate, $progress_bar, $action);
				}
				$output = array(
//					"draw" => $dt_data['draw'],
					"recordsTotal" => $search_results['count'],
					"recordsFiltered" => $search_results['count'],
					"data" => $data,
				);
				echo json_encode($output);
			}
			else{
				header('HTTP/1.1 406 No Input Received');
				echo json_encode(array('message' => 'No Search Keyword receieved', 'code' => 0));
			}
		}
	}


	function calculate_resume_fill_status($resume_data){
		if (isset($resume_data)){

			$rate = 0;

			if (!empty($resume_data->content)){
				$rate += 1;
			}
			if (!empty($resume_data->company)){
				$rate += 1;
			}
			if (!empty($resume_data->job_title)){
				$rate += 1;
			}
			if (!empty($resume_data->description)){
				$rate += 1;
			}
			if (!empty($resume_data->skill)){
				$rate += 1;
			}
			if (!empty($resume_data->specialization)){
				$rate += 1;
			}
			return round(($rate/6)*100);
		}
	}

}

