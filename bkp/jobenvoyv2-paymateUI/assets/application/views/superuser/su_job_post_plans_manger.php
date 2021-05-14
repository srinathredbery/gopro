<?php
//	echo '<pre>';
//	print_r($posting_plans);
//	echo '</pre>';
//?>
<section>
    <div class="block remove-top">
        <div class="container-fluid">
            <div class="row no-gape">

                <!--include side bar for employer-->
                <?php $this->load->view('include/side_bar_left_employer')?>

                <div class="col-lg-9 column">
                    <div class="padding-left select2-custom-style">
                        <div class="manage-jobs-sec manage-jobs-sec-custom">
                            <h3>Job Post Plans</h3>

                            <div class="col-lg-12 col-md-12 btn-extars button-wrapper">
                                <a class="post-job-btn cus add-new" id="add-new-btn" title=""><i class="la la-plus"></i>Create New Plan</a>
                            </div>

                            <table class="resume-table-custom">
                                <thead>
                                <tr>
                                    <td>Plan ID</td>
                                    <td>Created Date</td>
                                    <td>Plan</td>
                                    <td>Max No of Posts</td>
                                    <td>Validity</td>
									<td>Effective Date</td>
                                    <td>Price</td>
                                    <td>Status</td>
                                    <td>Action</td>
                                </tr>
                                </thead>

                                <tbody>

                                <?php
                                if (!empty($posting_plans)){
                                    foreach ($posting_plans as $plan){
										$plan['validity_period'] = !empty($plan['validity_period']) && !empty($plan['validity_duration']) ?
											($plan['validity_period'] == 'w' ? ($plan['validity_duration'] > 1 ? $plan['validity_duration'].' Weeks' : $plan['validity_duration'].' Week') :
												($plan['validity_period'] == 'm' ? ($plan['validity_duration'] > 1 ? $plan['validity_duration'].' Months' : $plan['validity_duration'].' Month') :
													($plan['validity_period'] == 'a' ? ($plan['validity_duration'] > 1 ? $plan['validity_duration'].' Years' : $plan['validity_duration'].' Year') : '')
												)
											) : '';
                                        ?>
                                        <tr data-r-id="<?php echo !empty($plan['id']) ? $plan['id']: '' ?>"
											data-pkg-id="<?php echo !empty($plan['pkg_id']) ? $plan['pkg_id']: '' ?>">
											<td>
												<span class="applied-field"><?php echo !empty($plan['pkg_id']) ? strtoupper($plan['pkg_id']) : '' ?></span>
											</td>
											<td>
												<span class="applied-field"><?php echo !empty($plan['created_date'])? date("Y/m/d", strtotime($plan['created_date'])) :'' ?></span>
											</td>
                                            <td>
                                                <div class="table-list-title">
                                                    <h3>
														<a  title="">
															<?php echo !empty($plan['plan_name']) ? $plan['plan_name'] : 'Name Not Found';
															?>
														</a>
													</h3>

                                                </div>
                                            </td>
                                            <td>
                                                <span class="applied-field"><?php echo !empty($plan['no_of_allowed_post']) ? $plan['no_of_allowed_post'] : '' ?></span>
                                            </td>
                                            <td>
                                                <span class="applied-field"><?php echo !empty($plan['validity_period']) && !empty($plan['validity_period']) ? $plan['validity_period'] : '' ?></span>
                                            </td>
                                            <td>
                                                <span class="applied-field"><?php echo !empty($plan['effective_date'])? date("Y/m/d", strtotime($plan['effective_date'])) :'' ?></span>
                                            </td>
											<td>
												<span class="applied-field float-right pr-2">
													<?php echo !empty($plan['price_currency']) && !empty($plan['price_value']) ? $plan['price_currency'].' '.number_format($plan['price_value'],2) : '' ?>
												</span>
											</td>
                                            <td>
                                                <div class="toggle-group">
                                                    <input type="checkbox" name="on-off-switch" onchange="plan_status_switch(this)" id="<?php echo isset($plan['id']) ? $plan['id'] : ''?>" tabindex="1"
                                                        <?php
                                                        if(isset($plan['status']) && $plan['status'])
                                                            echo 'checked';
                                                        ?>
                                                    >
                                                    <label for="<?php echo isset($plan['id']) ? $plan['id'] : ''?>">

                                                    </label>
                                                    <div class="onoffswitch" aria-hidden="true">
                                                        <div class="onoffswitch-label">
                                                            <div class="onoffswitch-inner"></div>
                                                            <div class="onoffswitch-switch"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <ul class="action_job" data-r-id="<?php echo !empty($plan['id']) ? $plan['id']: '' ?>">
                                                    <li onclick="edit_plan(this)">
														<span>Edit / Change</span>
														<a class="" data-r-id="<?php echo !empty($plan['id']) ? $plan['id']: '' ?>" title="">
															<i class="la la-wrench" data-r-id="<?php echo !empty($plan['id']) ? $plan['id']: '' ?>"> </i>
														</a>
													</li>
                                                    <li onclick="delete_plan(this)">
														<span>Delete</span>
														<a class="" title="">
															<i class="la la-trash-o" data-r-id="<?php echo !empty($plan['id']) ? $plan['id']: '' ?>"> </i>
														</a>
													</li>
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


<!--Modal-->

<div class="account-popup-area modal-popup-area" id="add-new-popup-box">
    <div class="account-popup resume-modal" >
        <span class="close-popup"><i class="la la-close"></i></span>

        <div class="profile-title">
            <h3><span id="form_title">Create New</span> Plan</h3>
        </div>

        <div class="profile-form-edit select2-custom-style">
            <form id="frm_create_new_plan" >
				<div id="editable-alert"></div>
                <div class="row">
					<input type="hidden" name="rec_id" id="rec_id" data-plan-auto-id="">
					<input type="hidden" name="pkg_id" id="pkg_id" data-plan-auto-id="">
                    <div class="col-md-12">
                        <span class="pf-title">Plan Name</span>
                        <div class="pf-field">
                            <input type="text" class="" name="plan_name" placeholder="Ex: Premium Plan" />
                        </div>
                    </div>
                    <div class="col-md-12">
						<div class="row">
                        <span class="pf-title">Validity Period </span>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="pf-field pb-lg-2 pb-md-2">
									<select name="validity_period" class="select2-custom-style select2-custom" id="validity_period" data-placeholder="Select validity period">
										<option value=""></option>
										<option value="w">Week</option>
										<option value="m">Month</option>
										<option value="a">Annual</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="pf-field pb-4">
									<select name="validity_duration" class="select2-custom-style select2-custom" id="validity_for" data-placeholder="Select validity period">
										<option value=""></option>
									</select>
								</div>
							</div>
						</div>
                    </div>
					<div class="col-md-6">
						<div class="row">
						<span class="pf-title">Effective Date</span>
						</div>
						<div class="pf-field">
							<input type="text" name="effective_date" id="effective_date" class="datetimepicker-input date-picker-min-disabled"
								   data-toggle="datetimepicker" data-target="#effective_date" autocomplete="off"/>
						</div>
					</div>
					<div class="col-md-6">
						<div class="row">
						<span class="pf-title">Allowed Posts</span>
						</div>
						<div class="pf-field">
							<input type="number" name="no_of_allowed_post" min="1" step="1" placeholder="" />
						</div>
					</div>
                    <div class="col-md-12">
						<div class="row">
                        <span class="pf-title">Price</span>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="pf-field">
									<select name="price_currency" class="select2-custom-style select2-custom" id="" data-placeholder="Select Currency">
										<option value=""></option>
										<option value="LKR">LKR</option>
										<option value="USD">USD</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="pf-field pb-4">
									<input type="number" min="0" step=".01" name="price_value" placeholder="Amount">
								</div>
							</div>
						</div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn-orange save-plan" style="margin-top:10px" onclick="" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo base_url()?>assets/custom/su_job_post_plan_manager.js<?php echo '?build='.BUILD_NO?>" type="text/javascript">
