<section>
    <div class="block no-padding select2-custom-style">
        <div class="container-fluid">
            <div class="row no-gape">

                <!--include side bar for employer-->
                <?php $this->load->view('include/side_bar_left_employer') ?>

                <div class="col-lg-9 column">
                    <div class="padding-left">
                        <div class="profile-title">
                            <?php echo isset($current_post) && !empty($current_post) ? '<h3>Edit Ad</h3>' : '<h3>Post a New Ad</h3>'?>

                        </div>
                        <div class="profile-form-edit">
                            <form id="new_adv_form">
								<script>var edit_check = false;</script>
                                <?php
                                $edit_check = $this->input->get('adv_id');
                                if ($edit_check){
                                	?>
									<script>edit_check = true;</script>
									<input type="hidden" name="id" id value="<?php echo !empty($adv['id'])? $adv['id'] : '' ?>">
									<?php
								}
                                ?>
                                <div class="row">

                                    <div class="col-lg-6">
                                        <span class="pf-title">Ad Campaign Name<span style="color: red">*</span></span>
                                        <div class="pf-field">
                                            <input type="text" name="adv_name" placeholder="A Name to identify" value="<?php echo !empty($adv['adv_name'])? $adv['adv_name'] : '' ?>" />
                                        </div>
                                    </div>

                                    <div class="col-lg-5">
										<span class="pf-title">Company Name<span style="color: red">*</span></span>
                                        <div class="pf-field cus-dropdown auto-field-input">
                                            <input type="text" id="search_client" name="adv_company" placeholder="Ex: Google" value="<?php echo !empty($adv['company_name'])? $adv['company_name'] : '' ?>"/>
											<input type="hidden" id="adv_company_id" name="adv_client" value="<?php echo !empty($adv['adv_client'])? $adv['adv_client'] : '' ?>">
                                        </div>
                                    </div>

									<div class="col-lg-1">
										<a class="btn btn-success mt-5" id="add_new_company" title="Add a new company"> + </a>
									</div>

                                    <div class="col-lg-2">
                                        <span class="pf-title">Activates on <span style="color: red">*</span></span>
                                        <div class="pf-field">
                                            <input type="date" name="adv_activate" value="<?php echo !empty($adv['adv_activate'])? $adv['adv_activate'] : '' ?>" />
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <span class="pf-title">Expires on <span style="color: red">*</span></span>
                                        <div class="pf-field">
                                            <input type="date" name="adv_expiry" value="<?php echo !empty($adv['adv_expiry'])? $adv['adv_expiry'] : '' ?>"/>
                                        </div>
                                    </div>

									<div class="col-lg-4 mb-2">
										<span class="pf-title">Banner Type <span style="color: red">*</span></span>
										<div class="pf-field">
											<select name="adv_banner_type" id="adv_banner_type" class="select2-custom">
												<option value="" selected>Select adv location</option>
												<?php
												if (isset($banner_type) && !empty($banner_type)) {
													foreach ($banner_type as $value) {
														?>
														<option value="<?php echo !empty($value['id']) ? $value['id'] : '' ?>"
															<?php echo !empty($adv['adv_banner_type']) && ($value['id'] == $adv['adv_banner_type']) ? 'selected' : '' ?>>
															<?php echo !empty($value['banner_type']) ? $value['banner_type'] : '' ?>
														</option>
														<?php
													}
												}
												?>
											</select>
										</div>
									</div>

									<dciv class="col-lg-4 mb-2">
										<span class="pf-title">Banner Spot <span style="color: red">*</span></span>
										<div class="pf-field">
											<select name="adv_banner_location" id="ad-size-selector" class="select2-custom">
												<option value="" selected>Select adv location</option>
												<?php
												if (isset($banner_size) && !empty($banner_size)) {
													foreach ($banner_size as $value) {
														?>
														<option value="<?php echo !empty($value['id']) ? $value['id'] : '' ?>" data-adv_height="<?php echo !empty($value['height']) ? $value['height'] : '' ?>" data-adv_width="<?php echo !empty($value['width']) ? $value['width'] : '' ?>"
															<?php echo !empty($adv['adv_banner_location']) && ($value['id'] == $adv['adv_banner_location']) ? 'selected' : '' ?>>
															<?php echo !empty($value['adv_spot_name']) ? $value['adv_spot_name'] : '' ?>
														</option>
														<?php
													}
												}
												?>
											</select>
										</div>
										<h5 class="badge badge-primary" id="selected-size"></h5>
									</dciv>

                                    <div class="col-lg-12">
                                        <span class="pf-title">URL</span>
                                        <div class="pf-field">
                                            <input type="url" name="adv_url" placeholder="Ex: www.example.com" value="<?php echo !empty($adv['adv_url'])? $adv['adv_url'] : '' ?>"/>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-5 d-none-cus" id="adv-file-upload">
										<input type="hidden" id="file_path" value="<?php echo !empty($adv['adv_image_url'])? ADV_IMG_READ_DIR.$adv['adv_image_url'] : '' ?>">
                                        <input type="file" name="adv_poster" id="ad-image" placeholder="Upload Image"/>
                                        <label for="ad-image">Choose File</label>
                                        <label class="selected-file">No files chosen</label>
                                    </div>

                                    <div class="col-lg-12">
                                        <div id="ad-image-cropper" class="d-none-cus">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-5">
                                        <button type="submit" id="save_post" class="float-left mt-2" >Save</button>
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


<div class="account-popup-area modal-popup-area" id="new_company">
	<div class="account-popup modal-popup resume-modal">
		<span class="close-popup"><i class="la la-close"></i></span>

		<div class="profile-title">
			<h3>Add a New Company</h3>
		</div>
		<form id="add_new_company_form">
			<div class="resumeadd-form">
				<div class="row">
					<div class="col-lg-12">
						<span class="pf-title">Company Name <span style="color: red">*</span></span>
						<div class="pf-field">
							<input type="text" name="company_name" placeholder="Ex: Microsoft" value=""/>
						</div>
					</div>
					<div class="col-lg-12">
						<span class="pf-title">Contact person <span style="color: red">*</span></span>
						<div class="pf-field">
							<input type="text" name="company_contact_person" placeholder="Ex: Name of the contact person" value=""/>
						</div>
					</div>
					<div class="col-lg-6">
						<span class="pf-title">Country Code <span style="color: red">*</span></span>
						<div class="pf-field">
							<select name="company_contact_country_code" id="county-selector" class="chosen"  title="">
								<option value="">Please select country</option>
								<?php
								$country_code_list = get_country_list();

								if (isset($country_code_list)) {
									if (!empty($country_code_list)) {
										foreach ($country_code_list as $country) {
											if(!empty($country['idd_code'])) {
												?>
												<option value="<?php echo $country['idd_code'] ?>">
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
					<div class="col-lg-6">
						<span class="pf-title">Contact number <span style="color: red">*</span></span>
						<div class="pf-field">
							<input type="text" name="company_contact_no" placeholder="Ex: 0777672773" value=""/>
						</div>
					</div>
					<div class="col-lg-12">
						<span class="pf-title">Contact email <span style="color: red">*</span></span>
						<div class="pf-field">
							<input type="text" name="company_contact_email" placeholder="Ex: Name of the contact person" value=""/>
						</div>
					</div>
					<div class="col-lg-6">
						<span class="pf-title">Address Line 1 <span style="color: red">*</span></span>
						<div class="pf-field">
							<input type="text" name="company_address_1" value="" placeholder="No 1, Free Trade Zone" />
						</div>
					</div>
					<div class="col-lg-6">
						<span class="pf-title">Address Line 2 </span>
						<div class="pf-field">
							<input type="text" name="company_address_2" value="" placeholder="York Street" />
						</div>
					</div>
					<div class="col-lg-6">
						<span class="pf-title">City / Town </span>
						<div class="pf-field">
							<input type="text" name="company_city" value="" placeholder="Colombo" />
						</div>
					</div>

					<div class="col-lg-6">
						<span class="pf-title">Country </span>
						<div class="pf-field">
							<select name="company_country" id="county-selector" class="select2-custom"  title="">
								<option value="">Please select country</option>
								<?php
								if (isset($country_list)) {
									if (!empty($country_list)) {

										foreach ($country_list as $country) {
											?>
											<option value="<?php echo $country['countryID'] ?>" >
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
					<div class="col-lg-12">
						<button class="btn-orange col-lg-3 col-md-3 offset-md-9 mt-4" type="submit">Save</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>


<script src="<?php echo base_url()?>assets/custom/su_ads.js<?php echo '?build='.BUILD_NO?>" type="text/javascript"></script>
