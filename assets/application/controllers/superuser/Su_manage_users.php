<?php


class Su_manage_users extends Main_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Su_user_manager_model', 'member');
		$this->load->model('Su_user_manager_employer_model', 'employers');
	}

	function view_job_seekers_list(){

		$data['page_title'] = 'All Job Seekers &bull; Super User';
		$data['main_content'] = 'superuser/su_manage_users_job_seekers';

		//load main content pager
		$this->load->view('templates/template_superuser', $data);
	}

	function view_job_employer_list(){

		$data['page_title'] = 'All Employers &bull; Super User';
		$data['main_content'] = 'superuser/su_manage_users_employers';

		//load main content pager
		$this->load->view('templates/template_superuser', $data);
	}

	function get_job_seekers_list(){
		$dt_data = $this->input->get();

		$data = $row = array();

		// Fetch member's records
		$memData = $this->member->getRows($dt_data);

		$i = $dt_data['start'];
		foreach($memData as $member){
			$i++;
			$created = date( 'jS M Y', strtotime($member->joined_date));

			$action = '<div class="action-resume">
							<div class="action-center p-0">
								<span>More <i class="la la-angle-down"></i></span>
								<ul>
									<li>
										<a title="" href="' . base_url() . 'superuser/manage_users/jobseekers/edit_resume?cv_id=' . '' . '" target="_blank">
											<i class="la la-edit"></i> &nbsp; Access Dashboard
										</a>
									</li>                                                              
								</ul>
							</div>
						</div>';
			$data[] = array($i, $member->jobseeker_first_name, $member->jobseeker_last_name, $created, $action);
		}

		$output = array(
			"draw" => $dt_data['draw'],
			"recordsTotal" => $this->member->countAll(),
			"recordsFiltered" => $this->member->countFiltered($dt_data),
			"data" => $data,
		);

		// Output to JSON format
		echo json_encode($output);

	}

	function get_employers_list(){
		$dt_data = $this->input->get();

//		$no_rec = $this->mng_user->get_no_records('jobseeker');

//		print_r($dt_data);

		$data = $row = array();

		// Fetch member's records
		$memData = $this->employers->getRows($dt_data);

		$i = $dt_data['start'];
		foreach($memData as $member){
			$i++;
			$created = date( 'jS M Y', strtotime($member->joined_date));
			$logo = !empty($member->employer_logo_url) ? EMP_LOGO_READ_DIR.$member->employer_logo_url : DEFAULT_EMP_LOGO;
			$logo = '<div class="c-logo-cus mr-2">
						<img src="'.$logo.'" alt="">
					</div>';
//			$action = '<div class="action-resume">
//                                                    <div class="action-center">
//                                                        <span>More <i class="la la-angle-down"></i></span>
//                                                        <ul>
//                                                            <li onclick="view_company(this)">
//                                                                <a  title="">
//                                                                    <i class="la la-eye"></i> &nbsp; View
//                                                                </a>
//                                                            </li>
//                                                            <li>
//                                                                <a title="" href="">
//                                                                    <i class="la la-edit"></i> &nbsp; Edit
//                                                                </a>
//                                                            </li>
//                                                            <li onclick="delete_company(this)">
//                                                                <a title="">
//                                                                    <i class="la la-trash-o"></i> &nbsp; Delete
//                                                                </a>
//                                                            </li>
//                                                        </ul>
//                                                    </div>';
			$action = '';
//			$status = ($member->status == 1)?'Active':'Inactive';
			$data[] = array($i, $logo, $member->employer_name, $member->employer_email, '+'.$member->employer_country_code_idd.' '.$member->employer_phone_no, $created, $action);
		}

		$output = array(
			"draw" => $dt_data['draw'],
			"recordsTotal" => $this->employers->countAll(),
			"recordsFiltered" => $this->employers->countFiltered($dt_data),
			"data" => $data,
		);

		// Output to JSON format
		echo json_encode($output);

	}

}
