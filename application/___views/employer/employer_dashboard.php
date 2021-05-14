<style>
	input[type=checkbox]
	{
		-webkit-appearance:checkbox;
		margin: 4px 0 0;
		margin-top: 1px\9;
		line-height: normal;
	}
	table thead tr td,
	table thead tr th {
		font-size: 12px !important;
	}
	table tbody tr td {
		font-size: 14px !important;
	}
	.dataTables_wrapper .dataTables_info,
	.dataTables_wrapper .dataTables_paginate {
		padding-top: 1.755em !important;
	}
	.dataTables_wrapper .dataTables_paginate .paginate_button {
		padding: 3px 9px !important;
	}
	.DataTables_Table_0_wrapper lable select {
		text-transform: none;
		border: 1px solid #0000002b !important;
		border-radius: 4px !important;
	}

	table.jobpost-table tbody tr {
		height: 60px;
	}

	.application-count.applied {
		color: #fff;
		background-color: #1EAAE7;
		border-radius: 30px;
		padding: 4px 6px;
		display: flow-root;
	}
	.application-count.applied:hover {
		background-color: #3d5a80;
	}
	.application-count.applied a {
		padding: 12px;
	}
	table.jobpost-table tbody tr:hover {
		background-color: #f7661833;
		cursor: pointer;
	}
	table.jobpost-table tbody tr.active {
		background-color: #efefef;
	}

	table.jobpost-table tbody td {
		padding: 8px 16px !important;
	}

	table.jobpost-table tbody td:hover {
		border-bottom: none;
	}

	.application-count.applied {
		padding: 4px 12px!important;
	}
	.application-count.applied a {
		padding: 0!important;
	}

	/*status color code*/
	.active {
		color: green;
	}
	.in-active {
		color: orange;
	}
	.expired {
		color: red;
	}
	.draft {
		color: #008ce0;
	}
</style>

<section>
    <div class="block no-padding">
        <div class="container-fluid">
            <div class="row no-gape">
                <!--include side bar for employer-->
                <?php $this->load->view('include/side_bar_left_employer') ?>
                <div class="col-lg-9 column">
                    <div class="padding-left">
                        <div class="manage-jobs-sec">
                            <h3>Dashboard</h3>
                            <div class="job-single-head3 emplye employee-head-cus cover-bg"
							style="background: linear-gradient(0deg,#1f1f1f,rgba(119, 119, 119, 0.36)),
								url(<?php echo !empty($emp_profile['employer_cover_pic_url'])? EMP_COVER_PIC_READ_DIR.$emp_profile['employer_cover_pic_url']: '' ?>);
">
                                <div class="job-thumb cover-profile-img"><img src="<?php echo isset($_SESSION['employer_logo_url']) || !empty($_SESSION['employer_logo_url']) ? EMP_LOGO_READ_DIR . $_SESSION['employer_logo_url'] : DEFAULT_EMP_LOGO ?>" alt=""></div>
                                <div class="job-single-info3 pt-3 cover-txt-content">
                                    <h3 class="company-txt-color"><?php echo !empty($emp_profile['employer_name'])? $emp_profile['employer_name']:'' ?></h3>
                                    <ul class="tags-jobs tags-color fx">
                                        <li class=""><i class="la la-phone"></i><?php echo !empty($emp_profile['employer_phone_no'])? $emp_profile['employer_phone_no']:'' ?></li>
                                        <li class=""><i class="la la-envelope"></i><?php echo !empty($emp_profile['employer_email'])? $emp_profile['employer_email']:'' ?></li>
                                        <li class=""><i class="la la-map-marker"></i>
                                            <?php
                                            $city = !empty($emp_profile['employer_city']) ? $emp_profile['employer_city'] : 'City not stated';
                                            $country = !empty($emp_profile['CountryDes']) ? $emp_profile['CountryDes'] : 'Country not stated';

                                            echo $city.', '.$country

                                            ?>
                                        </li>
                                    </ul>
                                    <ul class="tags-jobs"></ul>
                                </div>
								<div class="">
									<a href="<?php echo base_url().'employer/account/profile'?>" class="edit-btn-dash">Edit</a>
								</div>
                            </div>

                            <table class="datatable-init jobpost-table">
                                <thead>
                                <tr>
                                    <td  style="text-align: center;">Title</td>
									<td  style="text-align: center;">Action</td>
                                    <td  style="text-align: center;">Applications</td>
                                    <td  style="text-align: center;">Created</td>
									<td  style="text-align: center;">Expired</td>
                                    <td  style="text-align: center;">Status</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (!empty($recent_job_posts)) {
                                    foreach ($recent_job_posts as $job_post) {

                                        ?>
                                        <tr>
                                            <td width="25%">
                                                <div class="table-list-title">
                                                    <h3 style="font-weight:600; font-size: 14px;"><a href="<?php echo !empty($job_post['job_post_id']) ? base_url().'jobs/view_job_post?jp_token='. base64_encode($job_post['job_post_id']): '' ?>" target="_blank" title=""><?php echo !empty($job_post['job_post_title']) ?  substr($job_post['job_post_title'], 0, 30) :''?></a></h3>
                                                    <span><i class="la la-map-marker"></i><?php echo !empty($job_post['job_post_city']) && !empty($job_post['CountryDes']) ? $job_post['job_post_city'].', '.$job_post['CountryDes']: ''?></span>
                                                </div>
                                            </td>
											<td>
												<ul class="action_job">
													<?php
													if ($job_post['post_status'] != '3' || $job_post['post_status'] != 3 ){
														?>
														<li>
															<span>View Job</span><a href="<?php echo !empty($job_post['job_post_id']) ? base_url().'jobs/view_job_post?jp_token='. base64_encode($job_post['job_post_id']): '' ?>" target="_blank" title=""><i class="la la-eye text-success fa-x" ></i></a>
														</li>
														<?php
													}
													?>
													<?php
													if ($job_post['post_status'] != '2' || $job_post['post_status'] != 2 ){
														?>
														<li><span>Edit</span>
															<a href="<?php
															$sub_uri = isset($job_post['post_status']) && $job_post['post_status']===3 || $job_post['post_status']==='3' ? 'drafts' : 'active';
															echo  base_url().'employer/job_posts/'.$sub_uri.'/edit?job_post='.$job_post['job_post_id'] ?>" target="_blank" title="">
																<i class="la la-pencil text-info fa-x"></i>
															</a>
														</li>
														<?php
													}
													?>

													<!--                                                    <li><span>Delete</span><a href="#" title=""><i class="la la-trash-o"></i></a></li>-->
												</ul>

											</td>
                                            <td>
                                                <span class="applied-field status active application-count applied ">
<!--													-->
													<?php if(!empty($job_post['no_of_applications']) ){ if($job_post['no_of_applications']==1){ ?>
                                                     <a class="p-2" <?php echo !empty($job_post['no_of_applications']) && $job_post['no_of_applications'] > 0 ? 'href="'.base_url().'employer/applications_received?jp_id='.$job_post['job_post_id'].'" title="View Applications Received"' : 'title="No Applications Received "' ?> ><?php echo !empty($job_post['no_of_applications']) ? $job_post['no_of_applications'] : 'No' ?> Application</a>
                                              		<?php }else{ ?>
														<a <?php echo !empty($job_post['no_of_applications']) && $job_post['no_of_applications'] > 0 ? 'href="'.base_url().'employer/applications_received?jp_id='.$job_post['job_post_id'].'" title="View Applications Received"' : 'title="No Applications Received "' ?> ><?php echo !empty($job_post['no_of_applications']) ? $job_post['no_of_applications'] : 'No' ?> Applications</a>

													<?php } }else{ echo 'No Applications'; } ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span><?php echo !empty($job_post['job_post_posted_date']) ? date('dS M Y @ H:m:i', strtotime($job_post['job_post_posted_date'])) : ''?></span><br/>
                                            </td>
											<td>
												<span><?php echo !empty($job_post['job_post_posted_date']) ? date('dS M Y @ H:m:i', strtotime("+1 months",  strtotime($job_post['job_post_posted_date']))) : ''?></span><br/>
											</td>
                                            <td>
                                                <?php
                                                if($job_post['post_status']===0 || $job_post['post_status']==='0')
                                                    echo '<span class="status in-active">Inactive</span>';
                                                elseif($job_post['post_status']===1 || $job_post['post_status']==='1')
                                                    echo '<span class="status active">Active</span>';
                                                elseif($job_post['post_status']===2 || $job_post['post_status']==='2')
                                                    echo '<span class="status expired">Expired</span>';
                                                elseif($job_post['post_status']===3 || $job_post['post_status']==='3')
                                                    echo '<span class="status draft">Draft</span>';
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
							<div class="col-md-3 offset-md-9 text-right">
								<a href="<?php echo base_url() . 'employer/job_posts/active' ?>"
								  class="all-jobs-btn border-0" title="">View All Active Jobs</a>
							</div>

                            <div class="set-diagram extra-job-info col-md-12 mb-5">
                                <div class="row">
                                    <div class="col-md-6 chart-container">
                                        <canvas id="myChart" height="200"></canvas>
                                    </div>
                                    <div class="col-md-6 chart-container">
<!--                                        <canvas id="myChart2" height="200"></canvas>-->
                                    </div>
                                </div>
                            </div>

                            <?php $dat =  get_job_post_count()?>

                            <script>
                                var total_posts= "<?php echo $dat['total_posts']?>";
                                var actve_count = "<?php echo $dat['active_post']?>";
                                var applicants = "<?php echo get_no_of_application_count()?>";

                                Chart.defaults.global.defaultFontFamily = 'Open Sans';
                                var ctx = document.getElementById("myChart");
                                var myChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: ["Jobs", "Active Jobs", "Total Applicants"],
                                        datasets: [{
                                            label: 'Total',
                                            data: [total_posts, actve_count, applicants],
                                            backgroundColor: '#3d5a80',
                                            // borderColor: 'rgba(34, 25, 92, 1)',
                                            // borderWidth: 0.5,
                                            hoverBackgroundColor: '#1EAAE7'
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        title: {
                                            display: true,
                                            fontSize: 15,
                                            fontStyle: 'normal',
                                            text: 'Jobs Status',
                                            position: 'top'
                                        },


                                        legend: {
                                            display: false
                                        },
                                        scales: {
                                            yAxes: [{
                                                ticks: {
                                                    beginAtZero: true
                                                }
                                            }]
                                        }
                                    }
                                });

                                let total_js = 0;
                                let screening_js = 0;
                                let interview_js = 0;
                                let telephone_js = 0;
                                let skill_check_js = 0;
                                let selected_js = 0;
                                let joined_js = 0;
                                let declined_js = 0;

                                ctx = document.getElementById("myChart2");
                                var myChart = new Chart(ctx, {
                                    type: 'horizontalBar',
                                    data: {
                                        labels: ["Total", "Screening", "Interview", "Telephone", "Skill Check", "Selected", "Joined", "Declined"],
                                        datasets: [{
                                            label: '',
                                            data: [total_js, screening_js, interview_js, telephone_js, skill_check_js, selected_js, joined_js, declined_js],
                                            backgroundColor: '#3d5a80',
                                            // borderColor: 'rgba(34, 25, 92, 1)',
                                            // borderWidth: 0.5,
                                            radius: 5,
                                            hoverRadius: 10,
                                            hoverBackgroundColor: '#1EAAE7',
                                            fill: false
                                        }]
                                    },
                                    options: {
                                        responsive: true,

                                        title: {
                                            display: true,
                                            fontSize: 15,
                                            fontStyle: 'normal',
                                            text: 'Applicant Pipeline'
                                        },


                                        legend: {
                                            display: false
                                        },

                                        scales: {
                                            yAxes: [{
                                                ticks: {
                                                    beginAtZero: true
                                                }
                                            }]
                                        }
                                    }
                                });
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--<section>-->
<!--	<div class="container">-->
<!--		<div class="row">-->
<!--			<div class="col-md-6">-->
<!--				<div class="multi-level-layer">-->
<!--					<div class="level-1-layer">-->
<!--						<div class="item-checkbox">-->
<!--							<input type="checkbox" name="sample1" value="1" class="filter-input job-cat" id="cat-1" data-filter-name="cat-1">-->
<!--							<label class="filter-label" for="cat-1">Java</label>-->
<!--						</div>-->
<!--						<div class="item-checkbox">-->
<!--							<input type="checkbox" name="sample2" value="2" class="filter-input job-cat" id="cat-2" data-filter-name="cat-2">-->
<!--							<label class="filter-label" for="cat-2">PHP</label>-->
<!--						</div>-->
<!--					</div>-->
<!--					<div class="level-2-layer">-->
<!--						<div class="item-checkbox">-->
<!--							<input type="checkbox" name="sample3" value="3" class="filter-input job-cat" id="cat-3" data-filter-name="cat-3">-->
<!--							<label class="filter-label" for="cat-3">Laravel</label>-->
<!--						</div>-->
<!--						<div class="item-checkbox">-->
<!--							<input type="checkbox" name="sample4" value="4" class="filter-input job-cat" id="cat-4" data-filter-name="cat-4">-->
<!--							<label class="filter-label" for="cat-4">Codeignitor</label>-->
<!--						</div>-->
<!--					</div>-->
<!--					<div class="level-3-layer">-->
<!--						<div class="item-checkbox">-->
<!--							<input type="checkbox" name="sample5" value="5" class="filter-input job-cat" id="cat-5" data-filter-name="cat-5">-->
<!--							<label class="filter-label" for="cat-5">Laravel</label>-->
<!--						</div>-->
<!--						<div class="item-checkbox">-->
<!--							<input type="checkbox" name="sample6" value="6" class="filter-input job-cat" id="cat-6" data-filter-name="cat-6">-->
<!--							<label class="filter-label" for="cat-6">Codeignitor</label>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</section>-->

