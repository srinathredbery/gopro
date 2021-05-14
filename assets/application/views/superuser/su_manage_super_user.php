<section>
    <div class="block remove-top">
        <div class="container-fluid">
            <div class="row no-gape">

                <!--include side bar for employer-->
                <?php $this->load->view('include/side_bar_left_employer')?>

                <div class="col-lg-9 column">
                    <div class="padding-left select2-custom-style">
                        <div class="manage-jobs-sec manage-jobs-sec-custom">
                            <h3>Manage Users</h3>

                            <div class="col-lg-12 col-md-12 btn-extars button-wrapper">
                                <a class="post-job-btn cus add-new" id="add-new-user_btn2" title=""><i class="la la-plus"></i> Add New User</a>
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
                                if (!empty($su_users)){
                                    foreach ($su_users as $su_user){
                                        ?>
                                        <tr data-r-id="<?php echo !empty($su_user['user_id']) ? $su_user['user_id']: '' ?>">
                                            <td>
                                                <div class="table-list-title">
                                                    <h3>
														<a  title="">
															<?php
															$name = "";
															if (!empty($su_user['su_first_name']))
																$name .= $su_user['su_first_name'];
															if (!empty($su_user['su_last_name']))
																$name .= " ".$su_user['su_last_name'];
															echo !empty($name) ? $name : 'Name Not Defined';
															?>
														</a>
													</h3>

                                                </div>
                                            </td>
                                            <td>
                                                <span class="applied-field"><?php echo isset($su_user['email']) ? $su_user['email'] : '' ?></span>
                                            </td>
                                            <td>
                                                <span class="applied-field"><?php echo isset($su_user['joined_date'])? date("Y/m/d, h:m a", strtotime($su_user['joined_date'])) :'' ?></span>
                                            </td>
                                            <td>
                                                <div class="toggle-group">
                                                    <input type="checkbox" name="on-off-switch" onchange="su_user_status_switch(this)" id="<?php echo isset($su_user['user_id']) ? $su_user['user_id'] : ''?>" tabindex="1"
                                                        <?php
                                                        if(isset($su_user['is_active']) && $su_user['is_active'])
                                                            echo 'checked';
                                                        ?>
                                                    >
                                                    <label for="<?php echo isset($su_user['user_id']) ? $su_user['user_id'] : ''?>">

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
													<option value="-1">Administrator</option>
													<?php
													if (isset($user_groups)) {
														if (!empty($user_groups)) {
															foreach ($user_groups as $user_group) {
																?>
																<option value="<?php echo $user_group['id'] ?>"
																	<?php
																	if ($user_group['id'] === $su_user['user_group'])
																		echo 'selected';
																	?>>
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
                                                <ul class="action_job" data-r-id="<?php echo !empty($su_user['user_id']) ? $su_user['user_id']: '' ?>">
                                                    <li onclick="edit_user_modal(this)">
														<span>Edit / Change</span>
														<a class="btn-del del-user" data-r-id="<?php echo !empty($su_user['user_id']) ? $su_user['user_id']: '' ?>" title="">
															<i class="la la-wrench" data-r-id="<?php echo !empty($su_user['user_id']) ? $su_user['user_id']: '' ?>"> </i>
														</a>
													</li>
                                                    <li onclick="delete_user(this)">
														<span>Delete</span>
														<a class="btn-del del-user" data-r-id="<?php echo !empty($su_user['user_id']) ? $su_user['user_id']: '' ?>" title="">
															<i class="la la-trash-o" data-r-id="<?php echo !empty($su_user['user_id']) ? $su_user['user_id']: '' ?>"> </i>
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

<div class="account-popup-area modal-popup-area" id="add-new-user-popup-box">
    <div class="account-popup">
        <span class="close-popup"><i class="la la-close"></i></span>

        <div class="profile-title">
            <h3><span id="form_title">Add New</span> User</h3>
        </div>

        <div class="profile-form-edit select2-custom-style">
            <form id="new_su_user" >
                <div class="row">
                    <div class="col-md-12">
						<span class="pf-title">User Group</span>
						<div class="pf-field">
							<select name="new_user_group" class="select2-custom-style select2-custom user_group_selector" data-placeholder="Choose group">
								<option value="-1">Administrator</option>
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
					<input type="hidden" name="user_id">
                    <div class="col-md-12">
                        <span class="pf-title">Employment No</span>
                        <div class="pf-field">
                            <input type="text" class="" name="su_emp_id" placeholder="Eg: ENV/0001" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <span class="pf-title">First Name</span>
                        <div class="pf-field">
                            <input type="text" class="" name="su_first_name" placeholder="" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <span class="pf-title">Last Name</span>
                        <div class="pf-field">
                            <input type="text" class="" name="su_last_name" placeholder="" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <span class="pf-title">Email</span>
                        <div class="pf-field">
                            <input type="text" class="" name="su_email" placeholder="" />
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
                        <button class="btn-orange add-new-user" style="margin-top:10px" onclick="" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
	$('#add-new-user_btn2').on('click',function (){
		$('#add-new-user-popup-box').fadeIn('fast');
	});

	function edit_user_modal(that){
		let r_id = that.parentElement.dataset.rId;

		// $("#new_su_user")[0].reset();
		$("#form_title").html("Edit");
		$('input[name="su_email"], input[name="confirm_email"], input[name="password"], input[name="confirm_password"]').prop('disabled', true);

		get_white_rice().then(function (rice) {
			$.ajax({
				type: 'POST',
				dataType: 'JSON',
				url: base_url + 'superuser/account/manage_users/edit_user',
				data: {user_id: r_id, white_rice_token: rice},
				cache: false,
				beforeSend: ()=>{
					HoldOn.open(loader_options);
				},
				success: function (data) {
					if (data.code === 1) {
						$.each(data.ret_data, function( index, value ) {
							$('input[name="'+index+'"]').val(value).trigger('change');
							$('select[name="'+index+'"]').val(value).trigger('change');
						});
						$('#add-new-user-popup-box').fadeIn('fast');
						HoldOn.close();
					} else {
						HoldOn.close();
						heads_up_error();
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					HoldOn.close();
					heads_up_error();
				}
			});
		}).catch(function () {
			HoldOn.close();
			heads_up_warning('Failed to connect server. Please try again or contact support');
		});
		HoldOn.close();
	}
</script>
<script src="<?php echo base_url()?>assets/custom/su_manage_super_user.js<?php echo '?build='.BUILD_NO?>" type="text/javascript">
