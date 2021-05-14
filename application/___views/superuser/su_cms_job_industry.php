<section>
    <div class="block no-padding">
        <div class="container-fluid">
            <div class="row no-gape">

                <!--include side bar for employer-->
                <?php $this->load->view('include/side_bar_left_employer') ?>

                <div class="col-lg-9 column">
                    <div class="padding-left">
                        <div class="manage-jobs-sec pending-approval">
                            <h3><?php echo isset($container_title) && !empty($container_title)? $container_title : '' ?></h3>

							<div class="col-lg-12 col-md-12 btn-extars button-wrapper">
								<a class="post-job-btn cus add-new" id="add-new-content" title=""><i class="la la-plus"></i> Add New</a>
							</div>

							<table class="single-list-table">
								<thead>
								<tr>
									<td>Item</td>
									<td>Action</td>
								</tr>
								</thead>

								<tbody>
								<?php
								if (!empty($job_cms_content)){
									foreach ($job_cms_content as $list){
										?>
										<tr data-rec-id="<?php echo !empty($list['id']) ? $list['id'] : '' ?>"
											data-rec-value="<?php echo !empty($list["job_cms_name"]) ? $list["job_cms_name"] : "" ?>"
											data-rec-content="<?php echo ($this->uri->segment(3))? $this->uri->segment(3) : '' ?>">
											<td>
												<div class="table-list-title">
													<h3><?php echo !empty($list["job_cms_name"]) ? $list["job_cms_name"] : "" ?></h3>
												</div>
											</td>
											<td>
												<ul class="action_job">
													<li class="edit_record" id="edit_record">
														<span>Edit</span>
														<a title="">
															<i class="la la-pencil"></i>
														</a>
													</li>
													<li class="delete_record" id="delete_record">
														<span>Delete</span>
														<a class="" title="">
															<i class="la la-trash-o"></i>
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

<div class="account-popup-area modal-popup-area" id="add-new-content-popup-box">
	<div class="account-popup">
		<span class="close-popup"><i class="la la-close"></i></span>
		<div class="profile-title">
			<h3>Add New Industry</h3>
		</div>
		<div class="profile-form-edit">
			<form id="new_industry_form" >
				<div class="row">
					<div class="col-md-12">
						<span class="pf-title">Item Name</span>
						<div class="pf-field">
							<input type="hidden" name="job_cms_id" id="job_cms_id" />
							<input type="hidden" id="content_type" data-content="<?php echo ($this->uri->segment(3))? $this->uri->segment(3) : '' ?>" />
							<input type="text" name="job_cms_name" id="job_cms_name" placeholder="Ex: Industry Name" />
						</div>
					</div>
					<div class="col-md-12">
						<button class="btn-orange submit-btn" style="margin-top:10px" type="submit">Save</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="<?php echo base_url()?>assets/custom/su_cms_manager.js<?php echo '?build='.BUILD_NO?>" type="text/javascript"></script>
