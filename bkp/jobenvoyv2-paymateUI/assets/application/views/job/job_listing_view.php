<style type="text/css" >
	.inner-header {
		background-image: url('/assets/styles/images/resource/job.png');
		background-repeat: no-repeat;
		background-size: cover;
	}
</style>


<?php
if (isset($top_banner_ads) && !empty($top_banner_ads)){
	?>
	<section class="header-job">
		<div class="block no-padding  gray">
			<div class="container-fluid" style="padding: 0;">
				<div class="row">
					<div class="col-lg-12">
						<div class="ad-sec-1">
							<?php
							if (isset($top_banner_ads) && !empty($top_banner_ads)) {
								foreach ($top_banner_ads as $ad) {
									?>
									<div>
										<div class="image">
											<a <?php echo !empty($ad['adv_url']) && !empty($ad['id']) ? 'href="' . ADS_REDIRECT . '?ad_id=' . $ad['id'] . '&redirect=' . $ad['adv_url'] . '" target="_blank"' : '' ?>>
												<img
													src="<?php echo !empty($ad['adv_image_url']) ? ADV_IMG_READ_DIR . $ad['adv_image_url'] : '' ?>"
													alt="">
											</a>
										</div>
									</div>
									<?php
								}
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
}
else{
	?>
	<section class="overlape">
		<div class="block no-padding">
			<div data-velocity="-.1" style="background: url(https://placehold.it/1600x800) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div><!-- PARALLAX BACKGROUND IMAGE -->
			<div class="container fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="inner-header">
							<h3><?php echo !empty($job_post['employer_name']) ? $job_post['employer_name'] : ''?></h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
}
?>

<section>
	<div class="block no-padding">
		<div class="container">
			<div class="row no-gape select2-custom-style">
				<aside class="col-lg-4 column border-right pt-3">
					<div class="widget">
						<div class="search_widget_job">
							<div class="field_w_search">
								<input type="text" id="job_kw_search" name="search_key" placeholder="Search Keywords" />
								<i class="la la-search"></i>
							</div>
							<!-- Search Widget -->
							<div class="">
								<select id="country_filter" class="select2-custom" data-placeholder="Country or region">
									<option value=""></option>
									<?php
									if (isset($job_post_country) && !empty($job_post_country)){
										foreach ($job_post_country as $country){
											?>
											<option value="<?php echo !empty($country['countryShortCode'])? $country['countryShortCode'] : '' ?>">
												<?php echo !empty($country['CountryDes'])? $country['CountryDes'] : '' ?>
											</option>
											<?php
										}
									}
									?>
								</select>
							</div><!-- Search Widget -->
							<button class="btn-apply-filter" id="" onclick="location.reload()">Apply Filter</button>
							<button class="btn-clear-filter" id="clear-time-filter" data-action-tag="q">Clear Filter</button>
						</div>
					</div>
					<div class="widget">
						<h3 class="sb-title open">Date Posted</h3>
						<div class="posted_widget">
							<fieldset id="time-filter">
								<input type="radio" name="choose" class="job-search-time-filter" value="last-hour" id="last-hour"><label class="filter-label" for="last-hour">Last Hour</label><br />
								<input type="radio" name="choose" class="job-search-time-filter" value="24-hour" id="24-hour"><label class="filter-label" for="24-hour">Last 24 hours</label><br />
								<input type="radio" name="choose" class="job-search-time-filter" value="last-7days" id="last-7days"><label class="filter-label" for="last-7days">Last 7 days</label><br />
								<input type="radio" name="choose" class="job-search-time-filter" value="last-14days" id="last-14days"><label class="filter-label" for="last-14days">Last 14 days</label><br />
								<input type="radio" name="choose" class="job-search-time-filter" value="last-30days" id="last-30days"><label class="filter-label" for="last-30days">Last 30 days</label><br />
							</fieldset>
							<button class="btn-clear-filter" id="clear-time-filter" data-action-tag="time">Clear Filter</button>

						</div>
					</div>
					<div class="widget">
						<h3 class="sb-title open">Job Type</h3>
						<div class="type_widget">
							<?php
							if(isset($job_types) && !empty($job_types)){
								foreach ($job_types as $job_ty){
									?>
									<p class="<?php echo !empty( $job_ty['job_type_value']) ? $job_ty['job_type_value'].'-chek':''?>">
										<input type="checkbox" class="filter-input job-type-filter"
											   value="<?php echo !empty( $job_ty['job_type_value']) ? $job_ty['job_type_value']:''?>" name="choosetype"
											   id="<?php echo !empty( $job_ty['job_type_value']) ? $job_ty['job_type_value']:''?>"
											   data-filter-name="<?php echo !empty( $job_ty['job_type_name']) ? $job_ty['job_type_name']:''?>"
											   data-filter-id="<?php echo !empty( $job_ty['id']) ? $job_ty['id']:''?>">
										<label class="filter-label" for="<?php echo !empty( $job_ty['job_type_value']) ? $job_ty['job_type_value']:''?>">
											<?php echo !empty( $job_ty['job_type_name']) ? $job_ty['job_type_name']:''?> <?php echo !empty( $count= get_number_of_jobs_by_type( $job_ty['id'])) ? '('.$count.')':''?>
										</label>
									</p>
									<?php

								}
							}
							?>
							<button class="btn-apply-filter" id="" onclick="location.reload()">Apply Filter</button>
							<button class="btn-clear-filter" id="clear-job-type-filter" data-action-tag="type" >Clear Filter</button>

						</div>
					</div>
					<div class="widget">
						<h3 class="sb-title open">Industry/Category</h3>
						<div class="specialism_widget">
							<div class="field_w_search">
								<input type="text" id="cat-filter-search" placeholder="Find Industry" />
							</div><!-- Search Widget -->
							<div class="simple-checkbox scrollbar cat-filter-list">
								<?php
								if(isset($job_categories) && !empty($job_categories)){
									foreach ($job_categories as $job_cat){
										?>
										<p>
											<input type="checkbox" name="spealism" value="<?php echo !empty($job_cat['id']) ? $job_cat['id'] : ''?>" class="filter-input job-cat" id="cat-<?php echo !empty($job_cat['id']) ? $job_cat['id'] : ''?>" data-filter-name="<?php echo !empty($job_cat['job_category_name']) ? $job_cat['job_category_name'] : ''?>">
											<label class="filter-label" for="cat-<?php echo !empty($job_cat['id']) ? $job_cat['id'] : ''?>">
												<?php echo !empty($job_cat['job_category_name']) ? $job_cat['job_category_name'] : ''?> <?php echo !empty($jp_count = get_number_of_jobs_by_category($job_cat['id'])) ? '('.$jp_count.')' : ''?>
											</label>
										</p>
										<?php
									}
								}
								?>

								<script>
									(function($) {
										$("#cat-filter-search").on("keyup", function(e) {
											let $this = $(this);
											let exp = new RegExp($this.val(), "i");
											$(".cat-filter-list p label").each(function() {
												let $self = $(this);
												if (!exp.test($self.text())) {
													$self.parent().hide();
												} else {
													$self.parent().show();
												}
											});
										});
									})(jQuery);
								</script>

							</div>
							<button class="btn-apply-filter" id="" onclick="location.reload()">Apply Filter</button>
							<button class="btn-clear-filter" data-action-tag="cat" >Clear Filter</button>
						</div>


					</div>

					<div class="widget">
						<h3 class="sb-title open">Offerd Salary</h3>

						<div class="range_slider" style="display: block;">
							<div class="salary-filter-currency-list">
								<select name="" id="currency_list" class="chosen">
									<?php
									if (isset($currencies)) {
										if (!empty($currencies)) {
											foreach ($currencies as $value) {
												?>
												<option value="<?php echo $value['CurrencyCode'] ?>"  data-currency_code="<?php echo $value['CurrencyCode'] ?>"  <?php echo $value['CurrencyCode'] =='USD' ? 'selected':'' ?> ><?php echo $value['CurrencyCode'] ?><?php echo ' - '.$value['CurrencyName'] ?></option>
												<?php
											}
										}
									}
									?>
								</select>
							</div>
							<div class="salary-filter-currency-range-slider">
								<div class="nstSlider salary-Filter" data-range_min="0"
									 data-range_max="<?php
									 if (!empty($max_salary['max_sal_usd']) && isset($_GET['cur'])){ echo round(($max_salary['max_sal_usd'] * get_exchange_rate('USD', $_GET['cur']))/500)*500;}
									 else{echo round($max_salary['max_sal_usd'], -1);}
									 //                                     echo !empty($max_salary['max_sal_usd']) ? round($max_salary['max_sal_usd'], -1) : ''
									 ?>"
									 data-range_max_usd="<?php echo !empty($max_salary['max_sal_usd']) ? round($max_salary['max_sal_usd'], -1) : ''?>"
									 data-cur_min="0"
									 data-cur_max="<?php
									 if(isset($_GET['mx_sal']) && !empty(($_GET['mx_sal']))){ echo $_GET['mx_sal'];}
									 elseif(!empty($max_salary['max_sal_usd'])) echo round($max_salary['max_sal_usd'], -3);
									 ?>">
									<div class="bar nst-animating" style="left: 0px; width: 226px;"></div>
									<div class="leftGrip leftGripSalaryFilter nst-animating" tabindex="0" style="left: 0px;"></div>
									<div class="rightGrip rightGripSalaryFilter nst-animating" tabindex="0" style="left: 208px;"></div>
								</div>
								<div class="leftLabel min-salary-label"></div>
								<div class="rightLabel max-salary-label"></div>
							</div>
							<button class="btn-apply-filter" id="salary-filter">Apply Filter</button>
							<button class="btn-clear-filter" id="clear-salary-filter" data-action-tag="sal" >Clear Filter</button>
						</div>
					</div>

					<div class="widget">
						<h3 class="sb-title closed">Career Level</h3>
						<div class="specialism_widget">
							<div class="simple-checkbox">
								<?php
								if (isset($career_levels)) {
									if (!empty($career_levels)) {
										foreach ($career_levels as $career_level) {
											?>
											<p>
												<input type="checkbox" class="filter-input car-lvl" name="smplechk" id="<?php echo !empty($career_level['id']) ? 'cr_lvl-'.$career_level['id'] : '' ?>" value="<?php echo !empty($career_level['id']) ? $career_level['id'] : '' ?>" data-filter-name="<?php echo !empty($career_level['career_level_name']) ? $career_level['career_level_name'] : '' ?>">
												<label class="filter-label" for="<?php echo !empty($career_level['id']) ? 'cr_lvl-'.$career_level['id'] : '' ?>">
													<?php echo !empty($career_level['career_level_name']) ? $career_level['career_level_name'] : '' ?>
												</label>
											</p>
											<?php
										}
									}
								}
								?>
							</div>
							<a class="btn-apply-filter" id="" onclick="location.reload()">Apply Filter</a>
							<a class="btn-clear-filter" data-action-tag="cr_lvl" >Clear Filter</a>
						</div>
					</div>
					<div class="widget">
						<h3 class="sb-title closed">Experience</h3>
						<div class="range_slider" style="display: block;">
							<div class="salary-filter-currency-range-slider">
								<div class="nstSlider exp-Filter"
									 data-range_min="0"
									 data-range_max="<?php
									 if (!empty($max_experience['max_exp'])){ echo $max_experience['max_exp'];}
									 else{echo $max_experience['max_exp'];}
									 ?>"
									 data-cur_min="<?php
									 if(isset($_GET['mi_exp'])){ echo $_GET['mi_exp'];}
									 else{echo "0";};
									 ?>"
									 data-cur_max="<?php
									 if(isset($_GET['mx_exp'])){ echo $_GET['mx_exp'];}
									 elseif(!empty($max_experience['max_exp'])) echo $max_experience['max_exp'];
									 ?>">
									<div class="bar nst-animating" style="left: 0px; width: 226px;"></div>
									<div class="leftGrip leftGripSalaryFilter nst-animating" tabindex="0" style="left: 0px;"></div>
									<div class="rightGrip rightGripSalaryFilter nst-animating" tabindex="0" style="left: 208px;"></div>
								</div>
								<div class="leftLabel min-exp-label">1990</div>
								<div class="rightLabel max-exp-label">2018</div>
							</div>
							<button class="btn-apply-filter" id="exp-filter">Apply Filter</button>
							<button class="btn-clear-filter" id="clear-exp-filter" data-action-tag="exp" >Clear Filter</button>
						</div>
					</div>
					<div class="widget">
						<h3 class="sb-title closed">Gender</h3>
						<div class="specialism_widget">
							<div class="simple-checkbox">
								<p><input type="radio" class="filter-input gender-filter" value="Male" name="smplechk" id="Male"><label class="filter-label" for="Male">Male</label></p>
								<p><input type="radio" class="filter-input gender-filter" value="Female" name="smplechk" id="Female"><label class="filter-label" for="Female">Female</label></p>
								<p><input type="radio" class="filter-input gender-filter" value="Any" name="smplechk" id="Any"><label class="filter-label" for="Any">Any</label></p>
							</div>
							<button class="btn-clear-filter" id="clear-job-type-filter" data-action-tag="gen" >Clear Filter</button>
						</div>
					</div>
					<div class="widget">
						<h3 class="sb-title closed">Qualification</h3>
						<div class="specialism_widget">
							<div class="simple-checkbox">
								<?php
								if (isset($qualification_levels)) {
									if (!empty($qualification_levels)) {
										foreach ($qualification_levels as $qualification_level) {
											?>
											<p>
												<input type="checkbox" class="filter-input q-lvl" name="smplechk" id="<?php echo !empty($qualification_level['edu_lvl_id']) ? 'q_lvl-'.$qualification_level['edu_lvl_id'] : '' ?>" value="<?php echo !empty($qualification_level['edu_lvl_id']) ? $qualification_level['edu_lvl_id'] : '' ?>">
												<label class="filter-label" for="<?php echo !empty($qualification_level['edu_lvl_id']) ? 'q_lvl-'.$qualification_level['edu_lvl_id'] : '' ?>">
													<?php echo !empty($qualification_level['education_level_name']) ? $qualification_level['education_level_name'] : '' ?>
												</label>
											</p>
											<?php
										}
									}
								}
								?>
							</div>
							<button class="btn-apply-filter" id="" onclick="location.reload()">Apply Filter</button>
							<button class="btn-clear-filter" id="clear-job-type-filter" data-action-tag="q_lvl" >Clear Filter</button>
						</div>
					</div>

					<div class="widget">
						<div class="subscribe_widget">
							<h3>Still Need Help ?</h3>
							<p>Let us now about your issue and a Professional will reach you out.</p>
							<form id="contact_details_form">

								<div class="row">
									<div class="col-lg-12 credentials-label sign-up-success mb-2" id="reset_success_message">
										<i class="fas fa-check-circle d-no"></i>
										<div class=""><p></p></div>
									</div>
									<div class="col-lg-12 credentials-label mb-2" id="reset_error_message">
										<i class="fas fa-times-circle d-no"></i>
										<div class=""><p></p></div>
									</div>
									<div class="col-lg-12">
										<span class="pf-title">Full Name</span>
										<div class="pf-field">
											<input type="text" id="full_name" placeholder="" name="full_name"  data-bv-field="full_name"/>
										</div>
									</div>
									<div class="col-lg-12">
										<span class="pf-title">Email</span>
										<div class="pf-field">
											<input type="text" id="email" placeholder="" name="email"  data-bv-field="email"/>
										</div>
									</div>
									<div class="col-lg-12">
										<span class="pf-title">Subject</span>
										<div class="pf-field">
											<input type="text" id="subject" placeholder="" name="subject"  data-bv-field="subject"/>
										</div>
									</div>
									<div class="col-lg-12">
										<span class="pf-title">Message</span>
										<div class="pf-field">
											<textarea  id="message" name="message"  data-bv-field="message"></textarea>
										</div>
									</div>
									<div class="col-lg-12 row " style="margin: 12px">
										<div class="g-recaptcha"  data-sitekey="6LerJLEZAAAAANSWuQCrAp1-GLyZPcYZt1HtCHmy"></div>

									</div>
									<div class="col-lg-12">
										<div class="pf-field">
											<input type="submit" id="btnSubmit" value="Send" class="btn btn-orange text-white">
										</div>
									</div>

								</div>
							</form>
						</div>
					</div>

				</aside>
				<div class="col-lg-8 column">
					<div class="job-heading-sec">
						<div class="modrn-joblist">
							<!--                        <div class="tags-bar">-->
							<!--                            <span>Full Time<i class="close-tag">x</i></span>-->
							<!--                            <span>UX/UI Design<i class="close-tag">x</i></span>-->
							<!--                            <span>Istanbul<i class="close-tag">x</i></span>-->
							<!--                            <div class="action-tags">-->
							<!--                                <a href="#" title=""><i class="la la-cloud-download"></i> Save</a>-->
							<!--                                <a href="#" title=""><i class="la la-trash-o"></i> Clean</a>-->
							<!--                            </div>-->
							<!--                        </div>-->
							<!-- Tags Bar -->
							<div class="filterbar">
								<?php
								if (isset($_SESSION['user_type']) && $_SESSION['user_type']==2){
									echo '';
								}

								else if(isset($_SESSION['logged_in']))
								{
									?>
									<span class="emlthis" id="subs_job_alert">
                                    <a title=""><i class="la la-envelope-o"></i> Email me Jobs Like These</a>
                                </span>
									<?php
								}
								?>

								<div class="sortby-sec">
									<span>Show</span>
									<select id="job_post_per_page" data-placeholder="20 Per Page" class="chosen">
										<option id="limit-10" value="10">10 Per Page</option>
										<option id="limit-20" value="20">20 Per Page</option>
										<option id="limit-30" value="30">30 Per Page</option>
									</select>
								</div>
								<h5><?php echo !empty($job_count) ? count($job_count).' Jobs & Vacancies' : 'No Jobs & Vacancies found'?></h5>
							</div>
						</div>
					</div>

					<!-- MOdern Job LIst -->
					<div class="row job-content-sec">
						<div class="col-lg-10">
							<div class="job-list-modern">
								<?php
								if (!empty($job_list)){
									foreach ($job_list as $job_post)
									{
										$fav_job = FALSE;

										$create_date=$job_post['job_post_posted_date'];
										$end_date=date('Y-m-d', strtotime("+1 months", strtotime($job_post['job_post_posted_date'])));
										$today=strtotime('today UTC');
										if(($end_date<$today)){

											if( !empty($job_post['job_post_job_type'])){
											if($job_post['job_post_job_type']==1)
												$job_type_class = 'tp';
											elseif($job_post['job_post_job_type']==2)
												$job_type_class = 'fl';
											elseif($job_post['job_post_job_type']==3)
												$job_type_class = 'ft';
											elseif($job_post['job_post_job_type']==4)
												$job_type_class = 'it';
											elseif($job_post['job_post_job_type']==5)
												$job_type_class = 'pt';
										}

										if (isset($saved_jobs) && !empty($saved_jobs)){
											foreach ($saved_jobs as $saved_job){
												if (!empty($saved_job['job_post_id']) && ($saved_job['job_post_id'] === $job_post['job_post_id'])){
													$fav_job = TRUE;
												}
											}

										}
										?>

										<a href="<?php echo !empty($job_post['job_post_id']) ? base_url().'jobs/view_job_post?jp_token='. base64_encode($job_post['job_post_id']): '' ?>" title="">
											<div class="job-listings-sec">
												<div class="job-listing wtabs">
													<div class="job-title-sec">
														<div class="c-logo"> <img src="<?php echo isset($job_post['employer_logo_url']) || !empty($job_post['employer_logo_url']) ? EMP_LOGO_READ_DIR . $job_post['employer_logo_url'] : DEFAULT_EMP_LOGO ?>" alt="" /> </div>
														<h3><?php echo !empty($job_post['job_post_title']) ? $job_post['job_post_title']: ''?></h3>
														<span><?php echo !empty($job_post['employer_name']) ? $job_post['employer_name']: ''?></span>
														<div class="job-lctn"><i class="la la-map-marker"></i>
															<?php echo !empty($job_post['job_post_city']) ? $job_post['job_post_city'].', '.$job_post['CountryDes']: ''?>
														</div>
													</div>
													<div class="job-style-bx"
														 data-jp-token="<?php echo !empty($job_post['job_post_id']) ? ($job_post['job_post_id']): '' ?>"
														 data-liked="<?php echo !empty($job_post['job_post_id']) ? ($job_post['job_post_id']): '' ?>">
														<span class="job-is <?php echo $job_type_class?>"><?php echo !empty($job_post['job_type_name']) ? $job_post['job_type_name']: ''?></span>
														<span class="fav-job save-fav-job <?php echo !empty($fav_job)? 'active' : ''; ?>" title="Save Favorite">
															<i class="<?php echo !empty($fav_job)? "fas" : 'far'; ?> fa-heart"></i>
														</span>
														<i>
															<span id="post-time-<?php echo !empty($job_post['job_post_id']) ? $job_post['job_post_id']: '' ?>" title="<?php echo !empty($job_post['job_post_posted_date']) ? date( "d M Y, H:i" , strtotime($job_post['job_post_posted_date'])): '' ?>"></span>
														</i>
													</div>
												</div>
											</div>
											<script>
												var post_id = "<?php echo !empty($job_post['job_post_id']) ? $job_post['job_post_id']: '' ?>";
												var post_time = "<?php echo !empty($job_post['job_post_posted_date']) ? $job_post['job_post_posted_date']: '' ?>";
												$('#post-time-'+post_id+'').text(moment(post_time, "YYYY-MM-DD hh:mm:ss").fromNow());
											</script>
										</a>

										<?php
									}
									}
								}
								echo isset($pagination) && !empty($pagination) ? $pagination : '';
								?>
							</div>
						</div>

						<!-- ad section -->
						<div class="col-lg-2 padL0 padR0">
							<div class="ad-sec-1">
								<?php
								if (isset($side_banner_ads) && !empty($side_banner_ads)) {
									foreach ($side_banner_ads as $ad) {
										?>
										<div>
											<div class="image">
												<a <?php echo !empty($ad['adv_url']) && !empty($ad['id']) ? 'href="' . ADS_REDIRECT . '?ad_id=' . $ad['id'] . '&redirect=' . $ad['adv_url'] . '" target="_blank"' : '' ?>>
													<img
														src="<?php echo !empty($ad['adv_image_url']) ? ADV_IMG_READ_DIR . $ad['adv_image_url'] : '' ?>"
														alt="">
												</a>
											</div>
										</div>
										<?php
									}
								}
								?>
							</div>
						</div>
						<!-- ad section -->

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
								<option value="2" selected >Weekly</option>
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
								if (isset($job_types)) {
									if (!empty($job_types)) {
										foreach ($job_types as $value) {
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
								if (isset($job_categories)) {
									if (!empty($job_categories)) {
										foreach ($job_categories as $value) {
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

<!--Login pop up-->
<?php $this->load->view('general/login_popup')?>

<!--Sign up pop up-->
<?php $this->load->view('general/signup_popup')?>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
