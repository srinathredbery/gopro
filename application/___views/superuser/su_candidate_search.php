<section>
	<div class="block no-padding">
		<div class="container-fluid">
			<div class="row no-gape">

				<!--include side bar for employer-->
				<?php $this->load->view('include/side_bar_left_employer') ?>

				<div class="col-lg-9 column">
					<div class="padding-left">
						<div class="manage-jobs-sec pending-approval candidate-search-sec">
							<h3>Candidate Search</h3>

							<div class="search">
								<div class="search-filters row">
									<div class="col-md-12" style="width: 100%">

										<div class="col-md-7 col-12 float-left">
											<span class="pf-title">Search keyword</span>
											<input type="text" id="search_box" class="float-left" style="border-radius: 5px;" placeholder="Job title, Company, Skill, etc... ">
										</div>

										<div class="col-md-5 col-12 float-left">
											<button class="btn-orange float-left" id="candidate-search" style="margin-top: 43px;"><i class="fas fa-search"></i> Search</button>
											<button class="btn-orange advance-search-btn float-left" data-toggle="collapse" data-target="#advance_search" id="candidate-search"><i class="fas fa-search"></i> Advance Search</button>
										</div>

										<div id="advance_search" class="col-md-12 select2-custom-style collapse">
											<div class="col-md-4 pf-field">
												<span class="pf-title">Country or Region</span>
												<div class="pf-field">
													<select name="" id="candidate_country" class="select2-custom" >
														<option value=""></option>
														<?php
														if (isset($country_list)) {
															if (!empty($country_list)) {
																foreach ($country_list as $country) {
																	?>
																	<option value="<?php echo !empty($country['id']) ? $country['id'] : '' ?>">
																		<?php echo !empty($country['country_name']) ? $country['country_name'] : '' ?>
																	</option>
																	<?php
																}
															}
														}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-2 pf-field">
												<span class="pf-title">Gender</span>
												<div class="pf-field">
													<select name="" id="candidate_gender" class="select2-custom">
														<option value=""></option>
														<option value="M" >Male</option>
														<option value="F" >Female</option>
													</select>
												</div>
											</div>
											<div class="col-md-2 pf-field">
												<span class="pf-title">Last Update</span>
												<div class="pf-field">
													<select name="" id="" class="select2-custom">
														<option value=""></option>
														<option value="30" >Last 30 days</option>
														<option value="90" >Last 90 days</option>
														<option value="180" >Last 180 days</option>
														<option value="365" >Last 365 days</option>
													</select>
												</div>
											</div>
											<div class="col-md-4 pf-field">
												<span class="pf-title">Industry</span>
												<div class="pf-field">
													<select name="" id="candidate_industry" class="select2-custom" >
														<option value=""></option>
														<?php
														if (isset($industry)) {
															if (!empty($industry)) {
																foreach ($industry as $item) {
																	?>
																	<option value="<?php echo $item['id'] ?>">
																		<?php echo $item['job_industry_name'] ?>
																	</option>
																	<?php
																}
															}
														}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-4 pf-field mt-4">
												<span class="pf-title">Category</span>
												<div class="pf-field">
													<select name="" id="candidate_category" class="select2-custom" >
														<option value=""></option>
														<?php
														if (isset($job_category)) {
															if (!empty($job_category)) {
																foreach ($job_category as $item) {
																	?>
																	<option value="<?php echo $item['id'] ?>">
																		<?php echo $item['job_category_name'] ?>
																	</option>
																	<?php
																}
															}
														}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-4 pf-field mt-4">
												<span class="pf-title">Qualifications</span>
												<div class="pf-field">
													<select name="" id="qualification_filter" class="select2-custom">
														<option value=""></option>
														<?php
														if (isset($qualification)) {
															if (!empty($qualification)) {
																foreach ($qualification as $item) {
																	?>
																	<option value="<?php echo $item['edu_lvl_id'] ?>">
																		<?php echo $item['education_level_name'] ?>
																	</option>
																	<?php
																}
															}
														}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-4 pf-field mt-4">
												<span class="pf-title">Language</span>
												<div class="pf-field">
													<select name="" id="language_filter" class="select2-custom" >
														<option value=""></option>
														<?php
														if (isset($language)) {
															if (!empty($language)) {
																foreach ($language as $item) {
																	?>
																	<option value="<?php echo $item['language_id'] ?>">
																		<?php echo $item['language_name'] ?>
																	</option>
																	<?php
																}
															}
														}
														?>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="search-results">
									<table id="candidate_search_results" class="" style="width:100%">
										<thead>
										<tr>
											<th></th>
											<th></th>
											<th></th>
										</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</section>

<div class="account-popup-area modal-popup-area" id="su-js-backend-access-menu">
	<div class="account-popup modal-popup">
		<span class="close-popup"><i class="la la-close"></i></span>
		<form id="login_form">
			<div class="cfield">

			</div>
		</form>
	</div>
</div>

<script src="<?php echo base_url()?>assets/custom/su_candidate_search.js<?php echo '?build='.BUILD_NO?>" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/datatables.js" type="text/javascript"></script>
