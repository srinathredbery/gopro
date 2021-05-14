<section>
    <div class="block remove-top">
        <div class="container-fluid">
            <div class="row no-gape">

                <!--include side bar for employer-->
                <?php $this->load->view('include/side_bar_left_employer')?>

                <div class="col-lg-9 column">
                    <div class="padding-left select2-custom-style">
                        <div class="manage-jobs-sec">
                            <h3>Manage User Groups</h3>

                            <div class="col-lg-12 col-md-12 btn-extars button-wrapper">
                                <a class="post-job-btn cus add-new" id="add-new-user" title=""><i class="la la-plus"></i> Add New User Group</a>
                            </div>

                            <table class="resume-table-custom">
                                <thead>
                                <tr>
                                    <td>User Group Name</td>
                                    <td>Added Date</td>
									<td>Added By</td>
                                    <td>Action</td>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                if (isset($user_groups) && !empty($user_groups)){
                                    foreach ($user_groups as $user_group){
                                        ?>
                                        <tr data-r-id="<?php echo !empty($user_group['id']) ? $user_group['id']: '' ?>">
                                            <td>
                                                <div class="table-list-title">
                                                    <h3><a  title=""><?php echo !empty($user_group['user_group_name']) ? $user_group['user_group_name'] : 'Name not Defined' ?></a></h3>
                                                </div>
                                            </td>
											<td>
												<span class="applied-field"><?php echo !empty($user_group['created_time'])? date("Y/m/d, h:m a", strtotime($user_group['created_time'])) :'' ?></span>
											</td>
                                            <td>
                                                <span class="applied-field"><?php echo !empty($user_group['email']) ? $user_group['email'] : '' ?></span>
                                            </td>
											<td>
                                                <ul class="action_job">
                                                    <li><span>Privileges</span><a class="btn-edit-user-access" title=""><i class="la la-sliders"></i></a></li>
                                                    <li><span>Delete</span><a class="btn-del del-user" data-r-id="<?php echo !empty($user_group['id']) ? $user_group['id']: '' ?>" title=""><i class="la la-trash-o" data-r-id="<?php echo !empty($user_group['id']) ? $user_group['id']: '' ?>"> </i></a></li>
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
            <form id="new_user_group_form" >
				<div class="row">
					<div class="col-md-12">
						<span class="pf-title">Name</span>
						<div class="pf-field">
							<input type="text" class="" name="user_group_name" placeholder="Enter user group's name" />
						</div>
					</div>

					<div class="col-md-12">
						<button class="btn-orange" id="btn-create-new-user-group" style="margin-top:10px" onclick="" type="submit">Save</button>
					</div>
				</div>
            </form>
        </div>

    </div>
</div>

<div class="account-popup-area modal-popup-area" id="edit_user_access">
	<div class="account-popup">
		<span class="close-popup"><i class="la la-close"></i></span>

		<div class="profile-title">
			<h3>Set User Access and Privileges</h3>
		</div>

		<div class="profile-form-edit select2-custom-style">
			<form id="set_permissions_form" >
				<input type="hidden" name="user_group_id" id="user_group_id_input">
				<div class="row">
					<div class="col-md-12">
						<div class="multi-level-layer">
							<?php
							if (isset($function_routes) && !empty($function_routes)){
								$parent_id = 0;
								$level = '';
								foreach ($function_routes as $main_func){ //loop the parent
									if (!empty($main_func['is_parent'])){
										$parent_id = $main_func['route_id'];
										$level = 'level-1-layer';
										?>
										<hr>
										<div class="<?php echo $level ?>">
											<div class="item-checkbox">
												<input type="checkbox" name="access_func[]" class="filter-input route-parent <?php echo !empty($main_func['route_id']) ? 'rou-'.$main_func['route_id'] : ''?>"
													   value="<?php echo !empty($main_func['route_id']) ? $main_func['route_id'] : ''?>"
													   id="par-<?php echo !empty($main_func['route_id']) ? $main_func['route_id'] : ''?>">
												<label class="filter-label" for="par-<?php echo !empty($main_func['route_id']) ? $main_func['route_id'] : ''?>">
													<?php echo !empty($main_func['route_name']) ? $main_func['route_name'] : '' ?>
												</label>
											</div>
										</div>
										<?php
										foreach ($function_routes as $func){ // loop the child
											if ($func['parent_id'] == $parent_id) {
												$level = 'level-2-layer';
												?>
												<div class="<?php echo $level ?>">
													<div class="item-checkbox">
														<input type="checkbox" name="access_func[]"
															   class="filter-input route-child <?php echo !empty($func['id']) ? 'rou-'.$func['id'] : ''?>"
															   value="<?php echo !empty($func['id']) ? $func['id'] : ''?>"
															   id="child-<?php echo !empty($func['id']) ? $func['id'] : ''?>"
															   data-parent-id = "<?php echo !empty($main_func['route_id']) ? $main_func['route_id'] : ''?>"
														>
														<label class="filter-label" for="child-<?php echo !empty($func['id']) ? $func['id'] : ''?>">
															<?php echo !empty($func['route_name']) ? $func['route_name'] : '' ?>
														</label>
													</div>
												</div>
												<?php
											}

										}
									}

									?>

									<?php
								}
							}
							?>
						</div>
					</div>

					<div class="col-md-12">
						<button class="btn-orange change-user-prev" id="change-access-perm" style="margin-top:10px" onclick="" type="submit">Save</button>
					</div>
				</div>
			</form>
		</div>

	</div>
</div>

<script src="<?php echo base_url()?>assets/custom/emp_manage_user.js<?php echo '?build='.BUILD_NO?>" type="text/javascript">
