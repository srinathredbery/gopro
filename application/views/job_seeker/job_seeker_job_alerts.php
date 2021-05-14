<?php
?>
<section>
    <div class="block no-padding">
        <div class="container">
            <div class="row no-gape">

                <!--include side bar for jobseeker-->
                <?php $this->load->view('include/side_bar_left_job_seeker')?>

                <div class="col-lg-9 column">
                    <div class="padding-left">
                        <div class="manage-jobs-sec">
                            <h3>Job Alerts</h3>

							<div class="col-lg-12 col-md-12 btn-extars button-wrapper">
								<a class="post-job-btn cus add-new" id="add-new-job-alert" title=""><i class="la la-plus"></i> Add New</a>
							</div>

                            <table class="alrt-table">
                                <thead>
                                <tr>
                                    <td width="60%">Alert Details</td>
                                    <td width="20%">Email Frequency</td>
                                    <td width="">&nbsp;</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                if (isset($job_alerts_list)){
                                    foreach ($job_alerts_list as $ja_list){
                                        ?>
                                        <tr>
                                            <td width="60%">
                                                <div class="table-list-title">
                                                    <h3><a href="#" title=""><?php echo !empty($ja_list['search_job_title']) ? $ja_list['search_job_title'] : ''?></a></h3>
                                                    <span>Search Title: <?php echo !empty($ja_list['search_job_title']) ? $ja_list['search_job_title'] : ''?></span><br>
                                                    <span>Job Type: <?php echo !empty($ja_list['job_type_name']) ? $ja_list['job_type_name'] : ''?></span><br>
                                                    <span>Job Category: <?php echo !empty($ja_list['job_category_name']) ? $ja_list['job_category_name'] : ''?></span><br>
                                                    <span>Job Industry: <?php echo !empty($ja_list['job_industry_name']) ? $ja_list['job_industry_name'] : ''?></span>
                                                </div>
                                            </td>
                                            <td width="20%">
                                                <span>
                                                    <?php
                                                    if(!empty($ja_list['frequency'])){
                                                        if ($ja_list['frequency'] == 1){
                                                            echo 'Daily';
                                                        }
                                                        elseif ($ja_list['frequency'] == 2){
                                                            echo 'Weekly';
                                                        }
                                                        elseif ($ja_list['frequency'] == 3){
                                                            echo 'Monthly';
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                            </td>
                                            <td width="">
                                                <ul class="action_job"
													data-alert-id="<?php echo !empty($ja_list['job_alert_id']) ? $ja_list['job_alert_id'] : '' ?>"
													data-job-type="<?php echo !empty($ja_list['job_type']) ? $ja_list['job_type'] : '' ?>"
													data-job-category="<?php echo !empty($ja_list['job_category']) ? $ja_list['job_category'] : '' ?>"
													data-job-industry="<?php echo !empty($ja_list['job_industry']) ? $ja_list['job_industry'] : '' ?>"
													data-search-key="<?php echo !empty($ja_list['search_job_title']) ? $ja_list['search_job_title'] : '' ?>"
													data-frequency="<?php echo !empty($ja_list['frequency']) ? $ja_list['frequency'] : ''?>">
                                                    <li class="subs_job_alert"><span>Edit Frequency</span><a title=""><i class="la la-edit"></i></a></li>
                                                    <li class="un_sub_job_alert"><span>Delete</span><a title=""><i class="la la-trash-o"></i></a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="account-popup-area modal-popup-area" id="job-alert-subs-box">
    <div class="account-popup">
        <span class="close-popup"><i class="la la-close"></i></span>

        <div class="profile-title mb-0">
            <h3>Subscribe to Job Alerts</h3>
        </div>

        <div class="profile-form-edit">
            <form id="job_alert_subs_form" class="select2-custom-style" >
                <div class="row">
                    <div class="col-md-12">
                        <span class="pf-title">Search Key (Job Title)</span>
                        <div class="pf-field">
							<input type="text" name="job_title" id="job_title">
                        </div>
                    </div>
                    <input type="hidden" id="job_alert_id" name="job_alert_id" value="">
                    <div class="col-lg-5">
                        <span class="pf-title">Frequency</span>
                        <div class="pf-field">
                            <select name="subs_frequency" class="select2-custom" id="edit_subscription_frequency"  title="">
                                <option value="1">Daily</option>
                                <option value="2">Weekly</option>
                                <option value="3">Monthly</option>
                            </select>
                        </div>
                    </div>
					<div class="col-lg-7">
						<span class="pf-title">Preferred Job Type</span>
						<div class="pf-field">
							<select name="job_type" class="select2-custom" id="job_type">
								<option value=""></option>
								<?php
								if (isset($job_type)) {
									if (!empty($job_type)) {
										foreach ($job_type as $value) {
											?>
											<option value="<?php echo $value['id'] ?>"><?php echo $value['job_type_name'] ?></option>
											<?php
										}
									}
								}
								?>
							</select>
						</div>
					</div>
                    <div class="col-lg-12">
                        <span class="pf-title">Preferred Job Category</span>
                        <div class="pf-field">
							<select name="job_category" class="select2-custom" id="job_category">
								<option value=""></option>
								<?php
								if (isset($job_category)) {
									if (!empty($job_category)) {
										foreach ($job_category as $value) {
											?>
											<option value="<?php echo $value['id'] ?>"><?php echo $value['job_category_name'] ?></option>
											<?php
										}
									}
								}
								?>
							</select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <span class="pf-title">Preferred Industry</span>
                        <div class="pf-field">
							<select name="job_industry" class="select2-custom" id="company_industry">
								<option value=""></option>
								<?php
								if (isset($job_industry)) {
									if (!empty($job_industry)) {
										foreach ($job_industry as $value) {
											?>
											<option value="<?php echo $value['id'] ?>"><?php echo $value['job_industry_name'] ?></option>
											<?php
										}
									}
								}
								?>
							</select>
                        </div>
                    </div>
					<div class="col-md-12">
						<button class="btn-orange" id="subscribe-job-alert-btn"  type="submit">Subscribe</button>
					</div>
                </div>
            </form>
        </div>
    </div>
</div>
