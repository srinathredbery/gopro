<section>
    <div class="block remove-top">
        <div class="container-fluid">
            <div class="row no-gape">

                <!--include side bar for employer-->
                <?php $this->load->view('include/side_bar_left_employer')?>

                <div class="col-lg-9 column">
                    <div class="padding-left">
                        <div class="manage-jobs-sec">
                            <h3>Manage Users</h3>

                            <div class="col-lg-12 col-md-12 btn-extars button-wrapper">
                                <a class="post-job-btn cus add-new" id="add-new-user" title=""><i class="la la-plus"></i> Add New User</a>
                            </div>

                            <table class="resume-table-custom">
                                <thead>
                                <tr>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Added Date</td>
                                    <td>Activation</td>
                                    <td>User Group</td>
                                    <td>Action</td>
                                </tr>
                                </thead>

                                <tbody>

                                <?php
                                if (!empty($emp_users)){
                                    foreach ($emp_users as $emp_user){
                                        ?>
                                        <tr data-r-id="<?php echo !empty($emp_user['user_id']) ? $emp_user['user_id']: '' ?>">
                                            <td>
                                                <div class="table-list-title">
                                                    <h3><a  title=""><?php echo isset($emp_user['emp_first_name']) || isset($emp_user['emp_last_name']) ? $emp_user['emp_first_name'].' '.$emp_user['emp_last_name'] : 'Not found' ?></a></h3>

                                                </div>
                                            </td>
                                            <td>
                                                <span class="applied-field"><?php echo isset($emp_user['email']) ? $emp_user['email'] : '' ?></span>
                                            </td>
                                            <td>
                                                <span class="applied-field"><?php echo isset($emp_user['joined_date'])? date("Y/m/d, h:m a", strtotime($emp_user['joined_date'])) :'' ?></span>
                                            </td>
                                            <td>
                                                <div class="toggle-group">
                                                    <input type="checkbox" name="on-off-switch" onchange="emp_user_status_switch(this)" id="<?php echo isset($emp_user['user_id']) ? $emp_user['user_id'] : ''?>" tabindex="1"
                                                        <?php
                                                        if(isset($emp_user['is_active']) && $emp_user['is_active'])
                                                            echo 'checked';
                                                        ?>
                                                    >
                                                    <label for="<?php echo isset($emp_user['user_id']) ? $emp_user['user_id'] : ''?>">

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
												<select name="" class="select2-custom-style select2-custom user_group_selector_in_form" data-placeholder="Choose group">
													<option></option>
													<?php
													if (isset($user_groups)) {
														if (!empty($user_groups)) {
															foreach ($user_groups as $user_group) {
																?>
																<option value="<?php echo $user_group['id'] ?>"
																	<?php
																	if ($user_group['id'] === $emp_user['user_group'])
																		echo 'selected';
//																	?>>
																	<?php echo !empty($user_group['user_group_name']) ? $user_group['user_group_name'] : $user_group['user_group_name'] ?>
																</option>
																<?php
															}
														}
													}
													?>
												</select>
											</td>
                                            <td>
                                                <ul class="action_job">
                                                    <li><span>Delete</span><a class="btn-del del-user" data-r-id="<?php echo !empty($emp_user['user_id']) ? $emp_user['user_id']: '' ?>" title=""><i class="la la-trash-o" data-r-id="<?php echo !empty($emp_user['user_id']) ? $emp_user['user_id']: '' ?>"> </i></a></li>
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

<div class="account-popup-area modal-popup-area" id="add-new-user-popup-box">
    <div class="account-popup">
        <span class="close-popup"><i class="la la-close"></i></span>

        <div class="profile-title">
            <h3>Add New User</h3>
        </div>

        <div class="profile-form-edit">
            <form id="new_user" >
                <div class="row">
                    <div class="col-md-12">
						<span class="pf-title">User Group</span>
						<div class="pf-field">
							<select name="new_user_group" class="select2-custom-style select2-custom user_group_selector" data-placeholder="Choose group">
								<?php
								if (isset($user_groups)) {
									if (!empty($user_groups)) {
										foreach ($user_groups as $user_group) {
											?>
											<option value="<?php echo $user_group['id'] ?>">
												<?php echo !empty($user_group['user_group_name']) ? $user_group['user_group_name'] : $user_group['user_group_name'] ?>
											</option>
											<?php
										}
									}
								}
								?>
							</select>
						</div>
                    </div>
                    <div class="col-md-12">
                        <span class="pf-title">First Name</span>
                        <div class="pf-field">
                            <input type="text" class="" name="emp_first_name" placeholder="" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <span class="pf-title">Last Name</span>
                        <div class="pf-field">
                            <input type="text" class="" name="emp_last_name" placeholder="" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <span class="pf-title">Email</span>
                        <div class="pf-field">
                            <input type="text" class="" name="email" placeholder="" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <span class="pf-title">Retype Email</span>
                        <div class="pf-field">
                            <input type="text" class="" name="confirm_email" placeholder="" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <span class="pf-title">Password</span>
                        <div class="pf-field">
                            <input type="password" class="" name="password" placeholder="" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <span class="pf-title">Retype Password</span>
                        <div class="pf-field">
                            <input type="password" class="" name="confirm_password" placeholder="" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn-orange add-new-user" style="margin-top:10px" onclick="" type="submit">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo base_url()?>assets/custom/emp_manage_user.js<?php echo '?build='.BUILD_NO?>" type="text/javascript">
