<section>
    <div class="block no-padding">
        <div class="container-fluid">
            <div class="row no-gape">
                <!--include side bar for employer-->
                <?php $this->load->view('include/side_bar_left_employer')?>
                <div class="col-lg-9 column">
                    <div class="padding-left">
                        <div class="profile-title" id="mp">
                            <h3>Organisation Profile</h3>
                            <div class="panel panel-default">
                                <div class="panel-body" align="center">
									<div id="cover_image_view" class="upload-img-bar cover-bg mb25" style="background: linear-gradient(0deg,#1f1f1f,rgba(119, 119, 119, 0.36)),
									 url(<?php echo !empty($emp_profile['employer_cover_pic_url'])? EMP_COVER_PIC_READ_DIR.$emp_profile['employer_cover_pic_url']: '' ?>);">
										<div class="job-thumb cover-profile-img">
											<img id="uploaded_image_view" src="<?php echo isset($_SESSION['employer_logo_url']) || !empty($_SESSION['employer_logo_url']) ? EMP_LOGO_READ_DIR . $_SESSION['employer_logo_url'] : DEFAULT_EMP_LOGO ?>" alt="">
										</div>
										<div class="upload-info cover-txt-content-2">
											<input form="employer-profile" class="input-file cropit-image-input dp-image-upload" id="emp_logo" name="profile_picture"  type="file">
											<input form="employer-profile" class="input-file cropit-image-input cover-image-upload" id="emp_cover" name="cover_picture"  type="file">

											<div class="dropdown show">
												<a class="btn btn-secondary dropdown-toggle bg-dropdown border-white mb-3" style="font-size: 12px" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<i class="la la-pencil"></i>
												</a>

												<div class="dropdown-menu hover-effect-1" aria-labelledby="dropdownMenuLink">
													<a class="dropdown-item" id="change-dp" style="font-size: 12px">Change Profile Image</a>
													<a class="dropdown-item remove-image" id="remove-dp" data-img-type="logo" style="font-size: 12px">Remove Profile Image</a>
												</div>
											</div>
										</div>
										<div class="upload-info cover-txt-content-3">
											<div class="dropdown show">
												<a class="btn btn-secondary dropdown-toggle bg-dropdown border-white mb-3" style="font-size: 12px" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<i class="la la-pencil"></i>
												</a>

												<div class="dropdown-menu hover-effect-1" aria-labelledby="dropdownMenuLink">
													<a class="dropdown-item" id="change-cover" style="font-size: 12px">Change Cover Image</a>
													<a class="dropdown-item remove-image" id="remove-cover" data-img-type="cover" style="font-size: 12px">Remove Cover Image</a>
												</div>
											</div>
										</div>
									</div>
                                </div>
                            </div>
                        </div>

                        <div class="profile-form-edit employer-profile-edit">
                            <form id="employer-profile">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <span class="pf-title">Organisation Name</span>
                                        <div class="pf-field">
                                            <input type="text" name="employer_name" value="<?php echo !empty($emp_profile['employer_name']) ? $emp_profile['employer_name'] : '' ?>" placeholder="Name of the organization. Ex: Recruitment Intl " />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <span class="pf-title">Industries / Sectors / Categories</span>
                                        <div class="di-field no-margin">
											<select class="select2-custom" name="tags[]" multiple="multiple" data-placeholder="Add industries you work on" title="">
												<?php
												if (isset($job_industry) && !empty($job_industry)){
													foreach ($job_industry as $industry) {
														?>
														<option value="<?php echo !empty($industry['id']) ? $industry['id'] : '' ?>"
																<?php
																if (isset($emp_tags) && !empty($emp_tags)){
																	foreach($emp_tags as $selectec_tag){
																		if($industry['id'] == $selectec_tag['employer_tag'])
																			echo 'selected';
																	}
																}
																?>>
															<?php echo !empty($industry['job_industry_name']) ? $industry['job_industry_name'] : '' ?>
														</option>
														<?php
													}
												}
												?>
											</select>
                                        </div>
                                    </div>
                                </div>

                                <h6>Contact Information</h6>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <span class="pf-title">Country Code</span>
                                        <div class="pf-field">
											<select name="employer_country_code_idd" class="chosen" id="county-code-idd-selector">
												<option value="" selected>Select your country code</option>
												<?php
												$country_code_list = get_country_list();

												if (isset($country_code_list)) {
													if (!empty($country_code_list)) {
														foreach ($country_code_list as $country) {
															if(!empty($country['idd_code'])) {
																?>
																<option value="<?php echo $country['idd_code'] ?>"
																		<?php echo ($emp_profile['employer_country_code_idd'] == $country['idd_code'])? 'selected':''?>
																>
																	<?php echo '(+' . $country['idd_code'] . ') ' . $country['country_name'] ?>
																</option>
																<?php
															}
														}
													}
												}
												?>
											</select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <span class="pf-title">Phone Number</span>
                                        <div class="pf-field">
                                            <input type="tel" name="employer_phone_no" value="<?php echo !empty($emp_profile['employer_phone_no']) ? $emp_profile['employer_phone_no'] : '' ?>"  placeholder="+90 538 963 58 96" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="pf-title">Email</span>
                                        <div class="pf-field">
                                            <input type="text" name="employer_email" value="<?php echo !empty($emp_profile['employer_email']) ? $emp_profile['employer_email'] : '' ?>" placeholder="demo@jobhunt.com" />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <span class="pf-title">Website</span>
                                        <div class="pf-field">
                                            <input type="text" name="employer_web" value="<?php echo !empty($emp_profile['employer_web']) ? $emp_profile['employer_web'] : '' ?>" placeholder="www.jobhun.com" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="pf-title">Address Line 1</span>
                                        <div class="pf-field">
                                            <input type="text" name="employer_address_1" value="<?php echo !empty($emp_profile['employer_address_1']) ? $emp_profile['employer_address_1'] : '' ?>" placeholder="No 1, Free Trade Zone" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="pf-title">Address Line 2</span>
                                        <div class="pf-field">
                                            <input type="text" name="employer_address_2" value="<?php echo !empty($emp_profile['employer_address_2']) ? $emp_profile['employer_address_2'] : '' ?>" placeholder="York Street" />
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <span class="pf-title">City / Town</span>
                                        <div class="pf-field">
                                            <input type="text" name="employer_city" value="<?php echo !empty($emp_profile['employer_city']) ? $emp_profile['employer_city'] : '' ?>" placeholder="Colombo" />
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <span class="pf-title">Country</span>
                                        <div class="pf-field">
                                            <select name="employer_country" id="county-selector" class="chosen"  title="">
                                                <option value="">Please select country</option>
                                                <?php
                                                if (isset($country_list)) {
                                                    if (!empty($country_list)) {
                                                        foreach ($country_list as $country) {
                                                            ?>
                                                            <option value="<?php echo $country['countryID'] ?>"
                                                                <?php
                                                                if($country['countryID']==$emp_profile['employer_country'])
                                                                    echo 'selected';
                                                                ?>>
                                                                <?php echo $country['CountryDes'] ?>
                                                            </option>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
									<div class="col-lg-6">
										<span class="pf-title">Contact Person Name</span>
										<div class="di-field">
											<div class="row">
												<div class="col-md-3">
													<select name="employer_contact_person_title" class="select2-custom" data-placeholder="Tittle" id="title_of_contact">
														<?php $title = !empty($emp_profile['employer_contact_person_title']) ? $emp_profile['employer_contact_person_title'] : '' ?>
														<option <?php echo empty($title) ? 'selected' : ''?>></option>
														<option value="1" <?php echo !empty($title) && ($title == '1') ? 'selected' : ''?>>Mr.</option>
														<option value="2" <?php echo !empty($title) && ($title == '2') ? 'selected' : ''?>>Mrs.</option>
														<option value="3" <?php echo !empty($title) && ($title == '3') ? 'selected' : ''?>>Ms.</option>
													</select>
												</div>
												<div class="col-md-9">
													<input type="text" class="pl-0" name="employer_contact_person_name" value="<?php echo !empty($emp_profile['employer_contact_person_name']) ? $emp_profile['employer_contact_person_name'] : '' ?>" placeholder="Name of contact person">
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<span class="pf-title">Contact Person Job Title</span>
										<div class="pf-field">
											<input type="text" name="employer_contact_person_job_title" value="<?php echo !empty($emp_profile['employer_contact_person_job_title']) ? $emp_profile['employer_contact_person_job_title'] : '' ?>"  placeholder="HR Manager" />
										</div>
									</div>
									<div class="col-lg-3">
										<span class="pf-title">Contact Country Code</span>
										<div class="pf-field">
											<select name="employer_contact_person_contact_idd_code" class="chosen" id="county-code-idd-selector">
												<option value="" selected>Select your country code</option>
												<?php
//												$country_code_list = get_country_list();

												if (isset($country_code_list)) {
													if (!empty($country_code_list)) {
														foreach ($country_code_list as $country) {
															if(!empty($country['idd_code'])) {
																?>
																<option value="<?php echo $country['idd_code'] ?>"
																	<?php echo ($emp_profile['employer_contact_person_contact_idd_code'] == $country['idd_code'])? 'selected':''?>
																>
																	<?php echo '(+' . $country['idd_code'] . ') ' . $country['country_name'] ?>
																</option>
																<?php
															}
														}
													}
												}
												?>
											</select>
										</div>
									</div>
									<div class="col-lg-3">
										<span class="pf-title">Contact Person Contact Number </span>
										<div class="pf-field">
											<input type="tel" name="employer_contact_person_contact" value="<?php echo !empty($emp_profile['employer_contact_person_contact']) ? $emp_profile['employer_contact_person_contact'] : '' ?>"  placeholder="011 2 100 100" />
										</div>
									</div>
                                </div>

                                <h6>About Organisation</h6>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <span class="pf-title">About us</span>
                                        <div class="pf-field">
                                            <textarea name="employer_about_us" title=""><?php echo !empty($emp_profile['employer_about_us']) ? $emp_profile['employer_about_us'] : '' ?></textarea>
                                        </div>
                                    </div>
									<div class="col-lg-3">
										<span class="pf-title">Established in</span>
										<div class="pf-field">
											<input type="text" name="employer_est_date" value="<?php echo !empty($emp_profile['employer_est_date']) ? $emp_profile['employer_est_date'] : '' ?>" placeholder="Ex: 1991" />
										</div>
									</div>
									<div class="col-lg-3">
										<span class="pf-title">Allow In Search</span>
										<div class="pf-field">
											<select name="is_searchable" data-placeholder="Choose privacy" class="chosen" title="">
												<option value="y">Yes</option>
												<option value="n">No</option>
											</select>
										</div>
									</div>
                                </div>

                                <h6>Social Media Links</h6>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <span class="pf-title">Facebook</span>
                                        <div class="pf-field">
                                            <input type="text" name="employer_social_facebook" value="<?php echo !empty($emp_profile['employer_social_facebook']) ? $emp_profile['employer_social_facebook'] : '' ?>" placeholder="www.facebook.com/TeraPlaner" />
                                            <i class="fab fa-facebook-square"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="pf-title">Twitter</span>
                                        <div class="pf-field">
                                            <input type="text" name="employer_social_twitter" value="<?php echo !empty($emp_profile['employer_social_twitter']) ? $emp_profile['employer_social_twitter'] : '' ?>" placeholder="www.twitter.com/TeraPlaner" />
                                            <i class="fab fa-twitter"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="pf-title">Linkedin</span>
                                        <div class="pf-field">
                                            <input type="text" name="employer_social_linkedin" value="<?php echo !empty($emp_profile['employer_social_linkedin']) ? $emp_profile['employer_social_linkedin'] : '' ?>" placeholder="www.Linkedin.com/TeraPlaner" />
                                            <i class="fab fa-linkedin"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="emp-profile-save">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('general/image_crop_modal')?>
