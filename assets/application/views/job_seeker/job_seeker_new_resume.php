<?php if ($_SESSION['user_type'] == 1 ):?>
	<section>
		<div class="job-applied-message-banner bg-info">
			<div class="container">
				<div class="row">
					<div class="col-12 d-flex justify-content-center">
						<span class="job-applied-message-icon"><i class="fas fa-info-circle"></i></span>
						<p>
							You're accessing this profile from the admin panel.
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif ?>

<section>
    <div class="block remove-top">
        <div class="container">
            <div class="row no-gape">

                <!--include side bar for jobseeker-->
                <?php $this->load->view('include/side_bar_left_job_seeker') ?>

                <div class="col-lg-9 column">
                    <div class="padding-left">
                        <div class="manage-jobs-sec">
                            <div class="border-title"><h3>My Resume<?php echo !empty($resume_data['resume_name']) ? ': '.$resume_data['resume_name'] : ''?></h3></div>

                            <div class="show-after-save">

                                <div class="border-title"><h6>About</h6><a id="add-work-exp-btn"
                                                                                     data-section="about"
                                                                                     onclick="show_modal(this)"
                                                                                     title=""><i class="la la-plus"></i>
                                        Add/Edit About</a></div>

                                <div class="cand-details" id="about-des">
                                    <p class="pl-5"><?php echo !empty($resume_data['about_description']) ? $resume_data['about_description'] : '' ?></p>
                                </div>

                                <div class="border-title"><h6>Work Experience</h6><a id="add-work-exp-btn"
                                                                                     data-section="work-exp"
                                                                                     onclick="show_modal(this)"
                                                                                     title=""><i class="la la-plus"></i>
                                        Add Experience</a></div>
                                <div class="edu-history-sec resume-section" id="work-exp-sec">

                                    <?php
                                    if (isset($resume_work_exp) && !empty($resume_work_exp)) {
                                        foreach ($resume_work_exp as $resume_exp_item) {

                                            if(!empty($resume_exp_item['start_date']) && $resume_exp_item['start_date'] != '0000-00-00')
                                                $start_date = date("M Y", strtotime($resume_exp_item['start_date']));
                                            else
                                                $start_date = "";

                                            if(!empty($resume_exp_item['end_date']) && $resume_exp_item['end_date'] != '0000-00-00')
                                                $end_date = date("M Y", strtotime($resume_exp_item['end_date']));
                                            elseif($resume_exp_item['still_work'] =='yes')
                                                $end_date = 'To date';
                                            else
                                                $end_date = "Not stated";

                                            if (!empty($start_date))
                                                $hyp = ' - ';
                                            else
                                                $hyp = ' ';


                                            ?>
                                            <div class="edu-history style2 work-exp"
                                                 id="<?php echo !empty($resume_exp_item['work_exp_id']) ? 'work-exp-' . $resume_exp_item['work_exp_id'] : '' ?>">
                                                <i></i>
                                                <div class="edu-hisinfo">
                                                    <h3><?php echo !empty($resume_exp_item['job_title']) ? $resume_exp_item['job_title'] : '' ?>
                                                        <span><?php echo !empty($resume_exp_item['company']) ? 'at ' . $resume_exp_item['company'] : '' ?></span>
                                                    </h3>
                                                    <i><?php echo !empty($resume_exp_item['start_date']) ? $start_date.$hyp.$end_date : '' ?></i>
                                                    <p><?php echo !empty($resume_exp_item['description']) ? $resume_exp_item['description'] : '' ?></p>
                                                </div>
                                                <ul class="action_job">
                                                    <li><span>Edit</span><a
                                                                data-id="<?php echo !empty($resume_exp_item['work_exp_id']) ? $resume_exp_item['work_exp_id'] : '' ?>"
                                                                data-section="work-exp"
                                                                onclick=" edit_resume_item(this)"><i
                                                                    class="la la-pencil"></i></a></li>
                                                    <li><span>Delete</span><a
                                                                data-id="<?php echo !empty($resume_exp_item['work_exp_id']) ? $resume_exp_item['work_exp_id'] : '' ?>"
                                                                data-section="work-exp"
                                                                onclick="delete_resume_item(this)" title=""><i
                                                                    class="la la-trash-o"></i></a></li>
                                                </ul>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <div class="border-title"><h6>Professional Skills</h6><a id="add-pro-skill-btn"
                                                                                         data-section="pro-skill"
                                                                                         onclick="show_modal(this)"
                                                                                         title=""><i
                                                class="la la-plus"></i> Add Skills</a></div>
                                <div class="progress-sec resume-sec" id="pro-skill-sec">

                                    <?php
                                    if (isset($resume_skills) && !empty($resume_skills)) {
                                        foreach ($resume_skills as $resume_skill) {
                                            ?>
                                            <div class="progress-sec with-edit pro-skill"
                                                 id="<?php echo !empty($resume_skill['skill_id']) ? 'pro-skill-' . $resume_skill['skill_id'] : '' ?>">
                                                <span><?php echo !empty($resume_skill['skill']) ? $resume_skill['skill'] : '' ?></span>
                                                <div class="progressbar">
                                                    <div class="progress"
                                                         style="width: <?php echo !empty($resume_skill['skill_level']) ? $resume_skill['skill_level'] . '%' : '0%' ?>">
                                                        <span><?php echo !empty($resume_skill['skill_level']) ? $resume_skill['skill_level'] . '%' : '' ?></span>
                                                    </div>
                                                </div>
                                                <ul class="action_job">
                                                    <li><span>Edit</span><a
                                                                data-id="<?php echo !empty($resume_skill['skill_id']) ? $resume_skill['skill_id'] : '' ?>"
                                                                data-section="pro-skill"
                                                                onclick=" edit_resume_item(this)"><i
                                                                    class="la la-pencil"></i></a></li>
                                                    <li><span>Delete</span><a
                                                                data-id="<?php echo !empty($resume_skill['skill_id']) ? $resume_skill['skill_id'] : '' ?>"
                                                                data-section="pro-skill"
                                                                onclick="delete_resume_item(this)" title=""><i
                                                                    class="la la-trash-o"></i></a></li>
                                                </ul>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <div class="border-title"><h6>Education</h6><a id="add-edu-btn" data-section="edu"
                                                                               onclick="show_modal(this)" title=""><i
                                                class="la la-plus"></i> Add Education</a></div>
                                <div class="edu-history-sec resume-sec" id="edu-sec">
                                    <?php
                                    if (isset($resume_edus) && !empty($resume_edus)) {
                                        foreach ($resume_edus as $resume_edu) {

                                            if(!empty($resume_edu['start_date']) && $resume_edu['start_date'] != '0000-00-00')
                                                $start_date = date("M Y", strtotime($resume_edu['start_date']));
                                            else
                                                $start_date = "";

                                            if(!empty($resume_edu['end_date']) && $resume_edu['end_date'] != '0000-00-00')
                                                $end_date = date("M Y", strtotime($resume_edu['end_date']));
                                            elseif($resume_edu['still_following'] =='yes')
                                                $end_date = 'Following';
                                            else
                                                $end_date = "Not stated";

                                            if (!empty($start_date))
                                                $hyp = ' - ';
                                            else
                                                $hyp = ' ';

                                            ?>
                                            <div class="edu-history edu"
                                                 id="<?php echo !empty($resume_edu['edu_id']) ? 'edu-' . $resume_edu['edu_id'] : '' ?>">
                                                <i class="la la-graduation-cap"></i>
                                                <div class="edu-hisinfo edu">
                                                    <h3><?php echo !empty($resume_edu['education_level_name']) ? $resume_edu['education_level_name'] : '' ?></h3>
                                                    <i><?php echo !empty($resume_edu['start_date']) ? $start_date.$hyp.$end_date : '' ?></i>
                                                    <span><?php echo !empty($resume_edu['school']) ? $resume_edu['school'] : '' ?><i><?php echo !empty($resume_edu['specialization']) ? $resume_edu['specialization'] : '' ?></i></span>
                                                    <p><?php echo !empty($resume_edu['related_info']) ? $resume_edu['related_info'] : '' ?></p>
                                                </div>
                                                <ul class="action_job">
                                                    <li><span>Edit</span><a
                                                                data-id="<?php echo !empty($resume_edu['edu_id']) ? $resume_edu['edu_id'] : '' ?>"
                                                                data-section="edu" onclick=" edit_resume_item(this)"><i
                                                                    class="la la-pencil"></i></a></li>
                                                    <li><span>Delete</span><a
                                                                data-id="<?php echo !empty($resume_edu['edu_id']) ? $resume_edu['edu_id'] : '' ?>"
                                                                data-section="edu" onclick="delete_resume_item(this)"
                                                                title=""><i class="la la-trash-o"></i></a></li>
                                                </ul>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <div class="border-title"><h6>Awards</h6><a id="add-award-btn" data-section="award"
                                                                            onclick="show_modal(this)" title=""><i
                                                class="la la-plus"></i> Add Awards</a></div>
                                <div class="edu-history-sec resume-sec" id="award-sec">
                                    <?php
                                    if (isset($resume_awards) && !empty($resume_awards)) {
                                        foreach ($resume_awards as $resume_award) {
                                            ?>

                                            <div class="edu-history style2 award"
                                                 id="<?php echo !empty($resume_award['award_id']) ? 'award-' . $resume_award['award_id'] : '' ?>">
                                                <i></i>
                                                <div class="edu-hisinfo">
                                                    <h3><?php echo !empty($resume_award['award']) ? $resume_award['award'] : '' ?></h3>
                                                    <i><?php echo !empty($resume_award['date_of_award']) ? $resume_award['date_of_award'] : '' ?></i>
                                                    <p><?php echo !empty($resume_award['issued_by']) ? $resume_award['issued_by'] : '' ?></p>
                                                </div>
                                                <ul class="action_job">
                                                    <li><span>Edit</span><a
                                                                data-id="<?php echo !empty($resume_award['award_id']) ? $resume_award['award_id'] : '' ?>"
                                                                data-section="award"
                                                                onclick=" edit_resume_item(this)"><i
                                                                    class="la la-pencil"></i></a></li>
                                                    <li><span>Delete</span><a
                                                                data-id="<?php echo !empty($resume_award['award_id']) ? $resume_award['award_id'] : '' ?>"
                                                                data-section="award" onclick="delete_resume_item(this)"
                                                                title=""><i class="la la-trash-o"></i></a></li>
                                                </ul>
                                            </div>

                                            <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <div class="border-title"><h6>Language</h6><a id="add-lang-skill-btn"
                                                                              data-section="lang-skill"
                                                                              onclick="show_modal(this)" title=""><i
                                                class="la la-plus"></i>Add Language</a></div>
                                <div class="edu-history-sec resume-sec" id="lang-skill-sec">

                                    <?php
                                    if (isset($resume_langs) && !empty($resume_langs)) {
                                        foreach ($resume_langs as $resume_lang) {
                                            ?>
                                            <div class="edu-history lang-skill language-cus col-md-6"
                                                 id="<?php echo !empty($resume_lang['lang_res_id']) ? 'lang-skill-' . $resume_lang['lang_res_id'] : '' ?>">
                                                <div class="edu-hisinfo">
                                                    <h3><?php echo !empty($resume_lang['language_name']) ? $resume_lang['language_name'] : '' ?></h3>
                                                    <p>
                                                        <?php echo !empty($resume_lang['lang_reading']) ? '<i class="fas fa-book-open"></i> &nbsp Reading: ' . $resume_lang['reading'] : '' ?>
                                                        <br>
                                                        <?php echo !empty($resume_lang['lang_writing']) ? '<i class="fas fa-pen-nib"></i> &nbsp Writing: ' . $resume_lang['writing'] : '' ?>
                                                        <br>
                                                        <?php echo !empty($resume_lang['lang_reading']) ? '<i class="fas fa-volume-up"></i> &nbsp Speaking: ' . $resume_lang['speaking'] : '' ?>
                                                        <br>
                                                    </p>
                                                </div>
                                                <ul class="action_job">
                                                    <li><span>Edit</span><a
                                                                data-id="<?php echo !empty($resume_lang['lang_res_id']) ? $resume_lang['lang_res_id'] : '' ?>"
                                                                data-section="lang-skill"
                                                                onclick="edit_resume_item(this)"><i
                                                                    class="la la-pencil"></i></a></li>
                                                    <li><span>Delete</span><a
                                                                data-id="<?php echo !empty($resume_lang['lang_res_id']) ? $resume_lang['lang_res_id'] : '' ?>"
                                                                data-section="lang-skill"
                                                                onclick="delete_resume_item(this)"><i
                                                                    class="la la-trash-o"></i></a></li>
                                                </ul>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <div class="border-title"><h6>Attach Resume</h6></div>
                                <div class="edu-history-sec resume-sec" id="lang-skill-sec">

                                    <div class="row">
                                        <?php if (isset($resume_data) && !empty($resume_data['resume_attachment'])){
                                            ?>

                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3  h-100 p-3" style="border: 1px solid #26ae61;">
                                                    <div class="row">
                                                        <div class=" col-10">
                                                            <p class="mb-0" style=" font-size: 12px;">
                                                                File Name : <?php echo !empty($resume_data['resume_attachment']) ? $resume_data['resume_attachment'] : ''  ?>
                                                            </p>
<!--                                                            <p class="mb-0" style="font-size: 12px;">-->
<!--                                                                Upload Date :-->
<!--                                                            </p>-->
                                                        </div>
                                                        <div class="col-2">
                                                            <span class="col-2 float-left">
                                                                <?php if(!empty($resume_data['resume_attachment'])){
                                                                    $file = pathinfo(JOB_SEEKER_RESUME_READ_DIR.$resume_data['resume_attachment'], PATHINFO_EXTENSION);
                                                                    if($file === "pdf") {
                                                                        ?>
                                                                        <i class="far fa-file-pdf" style="font-size: 36px;"></i>
                                                                        <?php
                                                                    }
                                                                    elseif($file === "doc" || $file === "docx"){
                                                                        ?>
                                                                        <i class="far fa-file-word" style="font-size: 36px;"></i>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="mt-2 pr-2 w-100">
                                                            <a class="btn btn-success float-right m-2 col-3" href= "<?php echo !empty($resume_data['resume_attachment']) ? JOB_SEEKER_RESUME_READ_DIR.$resume_data['resume_attachment'] : '' ?>" target="_blank">View</a>
                                                            <a class="btn btn-danger float-right m-2 col-2 del-res-file" id="btn-del-res-file" data-r-id="<?php echo !empty($resume_data['resume_id']) ? $resume_data['resume_id'] : ''?>">
                                                                <i class="la la-trash-o" data-r-id="<?php echo !empty($resume_data['resume_id']) ? $resume_data['resume_id'] : ''?>"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                        }
                                        ?>


                                        <div class="col-lg-6 col-sm-12">
                                            <div id="jobseeker_resume_file_upload"
                                                 class="dm-uploader drop-zone text-center p-3">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h6 class="text-muted">Drag &amp; drop Files here</h6>
                                                    </div>

                                                    <div class="col-md-12 align-items-center">
                                                        <div class="btn btn-orange-line border-0 mb-2 text-center border-0">
                                                            <input class="file-input" name="job_post_img"
                                                                   id="js_resume_upload" type="file"
                                                                   title="Click to add Files" accept=".doc,.docx,.pdf">
                                                            <label for="js_resume_upload" class="ml-0"> or Select a
                                                                file</label>
                                                        </div>
                                                        <ul class="list-unstyled" id="files">
                                                            <li class="text-muted text-center empty">No files
                                                                uploaded.
                                                            </li>
                                                        </ul>
                                                        <div class="col-md-12">
                                                            <a href="#" class="btn btn-success mt-1 mt d-none-cus"
                                                               id="btnApiStart">
                                                                <i class="fas fa-cloud-upload-alt"></i> Upload
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- File item template -->
                                    <script type="text/html" id="files-template">
                                        <li class="media">
                                            <div class="media-body">
                                                <p class="mb-2">
                                                    <strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
                                                    <a class="file-remove"><i class="fas fa-times" title="Remove file"
                                                                              onclick="clear_file_input(this)"></i></a>
                                                </p>
                                                <div class="file-progress mb-3  d-none-cus">
                                                    <div class="file-progress-bar progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                                         role="progressbar"
                                                         style="width: 0%"
                                                         aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </script>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!--MODALS-->

<!--About-->

<div class="account-popup-area modal-popup-area" id="about-modal">
    <div class="account-popup modal-popup resume-modal">
        <span class="close-popup"><i class="la la-close"></i></span>

        <div class="profile-title">
            <h3>About me</h3>
        </div>
        <form class="form-resume-add-item" id="about">
            <div class="resumeadd-form">
                <div class="row">
                    <div class="col-lg-12">
                        <span class="pf-title">About yourself</span>
                        <div class="pf-field">
                            <textarea name="about_description" id="abt_des"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button class="btn-orange col-lg-3 col-md-3 offset-md-9" onclick="save_resume_about(this)" type="submit">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<!--Work Experience-->

<div class="account-popup-area modal-popup-area" id="work-exp-modal">
    <div class="account-popup modal-popup resume-modal select2-custom-style">
        <span class="close-popup"><i class="la la-close"></i></span>

        <div class="profile-title">
            <h3>Add Work Experience</h3>
        </div>
        <form class="form-resume-add-item" id="work-exp">
            <div class="resumeadd-form">
            <div class="row">
                <div class="col-lg-12">
                    <span class="pf-title">Job Title <span class="required-label">*</span></span>
                    <div class="pf-field">
                        <input placeholder="Ex: General Manager" name="job_title" type="text">
                    </div>
                </div>
				<div class="col-lg-12">
					<span class="pf-title">Job Category</span>
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
                    <span class="pf-title">Company Name <span class="required-label">*</span></span>
                    <div class="pf-field">
                        <input placeholder="Ex: Recruitment Intl" name="company" type="text">
                    </div>
                </div>
				<div class="col-lg-12">
					<span class="pf-title">Company Industry</span>
					<div class="pf-field">
						<select name="company_industry" class="select2-custom" id="company_industry">
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
                <div class="col-lg-5">
                    <span class="pf-title">From Date <span class="required-label">*</span></span>
                    <div class="pf-field">
                        <input placeholder="Ex: Oct 2007" name="start_date" type="date" id="exp-from-date">
                    </div>
                </div>
                <div class="col-lg-2">
                    <p class="remember-label">
                        <input type="checkbox" name="still_work" class="filter-input" id="current_company" value="yes"
                               onchange="disable_to_date(this,'exp-to-date')">
                        <label class="filter-label" for="current_company">Current</label>
                    </p>
                </div>
                <div class="col-lg-5 exp-to-date" id="exp-to-date-box">
                    <span class="pf-title">To Date <span class="required-label">*</span></span>
                    <div class="pf-field">
                        <input class="exp-to-date" placeholder="Ex: Dec 2012" name="end_date" type="date"
                               id="exp-to-date">
                    </div>
                </div>
                <div class="col-lg-3">
                    <span class="pf-title">Salary/Wage</span>
                    <div class="pf-field">
                        <select name="currency" class="chosen" id="currency">
                            <option value="" selected>LKR</option>
                            <option value="1">LKR</option>
                            <option value="2">USD</option>
                            <option value="3">EUR</option>
                            <option value="4">INR</option>
                            <option value="5">SAR</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <span class="pf-title">&nbsp;</span>
                    <div class="pf-field">
                        <input name="salary" placeholder="Ex: Rs.10000" type="number" min="0">
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="pf-title">&nbsp;</span>
                    <div class="pf-field">
                        <span>Per:</span><br/>
                        <input type="radio" name="salary_per" value="m" id="m">
                        <label class="filter-label" for="m">Month</label>
                        <input type="radio" name="salary_per" value="y" id="y">
                        <label class="filter-label" for="y">Year</label>
                        <input type="radio" name="salary_per" value="h" id="h">
                        <label class="filter-label" for="h">Hour</label>
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="pf-title">Country</span>
                    <div class="pf-field">
                        <select name="country" class="select2-custom" id="county-selector">
                            <option value="">Select a country</option>
                            <?php
                            if (isset($country_list)) {
                                if (!empty($country_list)) {
                                    foreach ($country_list as $country) {
                                        ?>
                                        <option value="<?php echo $country['countryID'] ?>">
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
                <div class="col-lg-6" id="exp-to-date-box">
                    <span class="pf-title">City / Town</span>
                    <div class="pf-field">
                        <input name="city" placeholder="Ex:Colombo" type="text">
                    </div>
                </div>
                <div class="col-lg-12">
                    <span class="pf-title">Description</span>
                    <div class="pf-field">
                        <textarea name="description"></textarea>
                    </div>
                </div>
                <div class="col-lg-12">
                    <button class="btn-orange col-lg-3 col-md-3 offset-md-9" onclick="add_resume_item(this)"
                            type="submit">Save
                    </button>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>


<!--Professional Skill-->

<div class="account-popup-area modal-popup-area" id="pro-skill-modal">
    <div class="account-popup modal-popup resume-modal">
        <span class="close-popup"><i class="la la-close"></i></span>

        <div class="profile-title">
            <h3>Add Professional Skill</h3>
        </div>
        <form class="form-resume-add-item" id="pro-skill">
            <div class="resumeadd-form">
                <div class="row">
                    <div class="col-lg-12">
                        <span class="pf-title">Skill</span>
                        <div class="pf-field">
                            <input name="skill" placeholder="Ex: Illustrator" type="text">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <span class="pf-title">Skill Level</span>
                        <div class="pf-field">
                            <div class="range-slider">
                                <input name="skill_level" id="skill-range" class="range-slider__range" type="range"
                                       value="0" min="0" max="100">
                                <span class="range-slider__value">0</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <span class="pf-title">Last Used</span>
                        <div class="pf-field">
                            <select name="last_used" class="chosen" id="">
                                <option value="1">Currently Used</option>
                                <option value="2">Less than a 6 Months</option>
                                <option value="3">Less than a Year ago</option>
                                <option value="4">1 Year ago</option>
                                <option value="5">2 Years ago</option>
                                <option value="6">More than 2 Years ago</option>
                                <option value="0">Never</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <span class="pf-title">Years of Experience</span>
                        <div class="pf-field">
                            <input name="years_of_exp" placeholder="2" type="number" min="0">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <button id="btn-pro-skill-add" class="btn-orange col-lg-3 col-md-3 offset-md-9" type="submit"
                                onclick="add_resume_item(this)">Save
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<!--Education Skill-->

<div class="account-popup-area modal-popup-area" id="edu-modal">
    <div class="account-popup modal-popup resume-modal">
        <span class="close-popup"><i class="la la-close"></i></span>

        <div class="profile-title">
            <h3>Add Education</h3>
        </div>

        <form class="form-resume-add-item" id="edu">
            <div class="resumeadd-form">
                <div class="row">

                    <div class="col-lg-5">
                        <span class="pf-title">Qualification Level</span>
                        <div class="pf-field">
                            <select name="edu_level" class="chosen">
                                <option value="" selected>Select an option</option>
                                <?php
                                if (isset($education_level)) {
                                    if (!empty($education_level)) {
                                        foreach ($education_level as $value) {
                                            ?>
                                            <option value="<?php echo $value['edu_lvl_id'] ?>"><?php echo $value['education_level_name'] ?></option>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <span class="pf-title">Specialization</span>
                        <div class="pf-field">
                            <input name="specialization" placeholder="Ex: Bachelor of Science in Computer Science"
                                   type="text">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <span class="pf-title">Institution</span>
                        <div class="pf-field">
                            <input name="school" placeholder="Ex: University of Colombo" type="text">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <span class="pf-title">City / Town</span>
                        <div class="pf-field">
                            <input name="city" placeholder="Ex: Colombo" type="text">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <span class="pf-title">Country</span>
                        <div class="pf-field">
                            <select name="country" class="chosen" id="county-selector">
                                <option value="">Select a country</option>
                                <?php
                                if (isset($country_list)) {
                                    if (!empty($country_list)) {
                                        foreach ($country_list as $country) {
                                            ?>
                                            <option value="<?php echo $country['countryID'] ?>">
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

                    <div class="col-lg-5">
                        <span class="pf-title">From Date <span class="required-label">*</span></span>
                        <div class="pf-field">
                            <input placeholder="Ex: Oct 2007" name="start_date" type="date" id="exp-from-date">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <p class="remember-label">
                            <input type="checkbox" name="still_following" class="filter-input" id="current_course"
                                   value="yes" onchange="disable_to_date(this,'edu-to-date')">
                            <label class="filter-label" for="current_course">Following</label>
                        </p>
                    </div>
                    <div class="col-lg-5 edu-to-date" id="edu-to-date-box">
                        <span class="pf-title">To Date <span class="required-label">*</span></span>
                        <div class="pf-field">
                            <input class="edu-to-date" placeholder="Ex: Dec 2012" name="end_date" type="date"
                                   id="edu-to-date">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <span class="pf-title">Description</span>
                        <div class="pf-field">
                            <input name="related_info" placeholder="Ex: Recruitment Holdings" type="text">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <button class="btn-orange col-lg-3 col-md-3 offset-md-9" type="submit"
                                onclick="add_resume_item(this)">Save
                        </button>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>


<!--Award Skill-->

<div class="account-popup-area modal-popup-area" id="award-modal">
    <div class="account-popup modal-popup resume-modal">
        <span class="close-popup"><i class="la la-close"></i></span>

        <div class="profile-title">
            <h3>Add Awards</h3>
        </div>

        <form class="form-resume-add-item" id="award">
            <div class="resumeadd-form">
                <div class="row">
                    <div class="col-lg-12">
                        <span class="pf-title">Award</span>
                        <div class="pf-field">
                            <input name="award" placeholder="Ex: Batch Top or Employee of the year" type="text">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <span class="pf-title">Awarded By</span>
                        <div class="pf-field">
                            <input name="issued_by" placeholder="Ex: SLIIT " type="text">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <button class="btn-orange col-lg-3 col-md-3 offset-md-9" onclick="add_resume_item(this)"
                                type="submit">Save
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<!--Portfolio Skill-->

<div class="account-popup-area modal-popup-area" id="portfolio-modal">
    <div class="account-popup modal-popup resume-modal">
        <span class="close-popup"><i class="la la-close"></i></span>

        <div class="profile-title">
            <h3>Add Portfolio</h3>
        </div>

        <form class="form-resume-add-item" id="portfolio">

            <div class="resumeadd-form">
                <div class="row">
                    <div class="col-lg-12">
                        <span class="pf-title">Job Title</span>
                        <div class="pf-field">
                            <input placeholder="Ex: General Manager" type="text">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <span class="pf-title">Company Name</span>
                        <div class="pf-field">
                            <input placeholder="Ex: Recruitment Holdings" type="text">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <button class="btn-orange col-lg-3 col-md-3 offset-md-9" type="submit">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<!--Language Skill-->
<div class="account-popup-area modal-popup-area" id="lang-skill-modal">
    <div class="account-popup modal-popup resume-modal">
        <span class="close-popup"><i class="la la-close"></i></span>

        <div class="profile-title">
            <h3>Add Language Skill</h3>
        </div>
        <form class="form-resume-add-item" id="lang-skill">
            <div class="resumeadd-form select2-custom-style">
                <div class="row">
                    <div class="col-lg-12">
                        <span class="pf-title">Language</span>
                        <div class="pf-field">
							<select name="js_language" id="qualification_filter" data class="select2-custom" >
								<option value=""></option>
								<?php
								if (isset($languages)) {
									if (!empty($languages)) {
										foreach ($languages as $item) {
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

                    <div class="col-lg-12">
                        <span class="pf-title">Proficiency</span>
                    </div>

                    <div class="col-lg-12">

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="cus-checkbox">
                                    <input type="checkbox" name="" value="1" id="reading" class="cus-trigger lang_reading"
                                           onchange="lang_level(this)">
                                    <label for="reading" class="filter-label">Reading</label>
                                </div>
                            </div>

                            <div class="col-lg-9">
                                <div class="switch-field reading-section d-none-cus">
                                    <?php
                                    if (isset($language_level) && !empty($language_level)) {
                                        foreach ($language_level as $lang_level) {
                                            ?>
                                            <input type="radio" class="reading"
                                                   id="reading-lvl<?php echo !empty($lang_level['lang_lvl_id']) ? $lang_level['lang_lvl_id'] : '' ?>"
                                                   name="lang_reading"
                                                   value="<?php echo !empty($lang_level['lang_lvl_id']) ? $lang_level['lang_lvl_id'] : '' ?>"/>
                                            <label for="reading-lvl<?php echo !empty($lang_level['lang_lvl_id']) ? $lang_level['lang_lvl_id'] : '' ?>"><?php echo !empty($lang_level['lang_level']) ? $lang_level['lang_level'] : '' ?></label>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="cus-checkbox">
                                    <input type="checkbox" id="writing" name="" value="2" class="cus-trigger lang_writing"
                                           onchange="lang_level(this)">
                                    <label for="writing" class="filter-label">Writing</label>
                                </div>
                            </div>

                            <div class="col-lg-9">
                                <div class="switch-field writing-section d-none-cus">
                                    <?php
                                    if (isset($language_level) && !empty($language_level)) {
                                        foreach ($language_level as $lang_level) {
                                            ?>
                                            <input type="radio" class="writing"
                                                   id="writing-lvl<?php echo !empty($lang_level['lang_lvl_id']) ? $lang_level['lang_lvl_id'] : '' ?>"
                                                   name="lang_writing"
                                                   value="<?php echo !empty($lang_level['lang_lvl_id']) ? $lang_level['lang_lvl_id'] : '' ?>"/>
                                            <label for="writing-lvl<?php echo !empty($lang_level['lang_lvl_id']) ? $lang_level['lang_lvl_id'] : '' ?>"><?php echo !empty($lang_level['lang_level']) ? $lang_level['lang_level'] : '' ?></label>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="cus-checkbox">
                                    <input type="checkbox" name="" value="3" id="speaking" class="cus-trigger lang_speaking"
                                           onchange="lang_level(this)">
                                    <label for="speaking" class="filter-label">Speaking</label>
                                </div>
                            </div>

                            <div class="col-lg-9">
                                <div class="switch-field speaking-section d-none-cus">
                                    <?php
                                    if (isset($language_level) && !empty($language_level)) {
                                        foreach ($language_level as $lang_level) {
                                            ?>
                                            <input type="radio" class="speaking"
                                                   id="speaking-lvl<?php echo !empty($lang_level['lang_lvl_id']) ? $lang_level['lang_lvl_id'] : '' ?>"
                                                   name="lang_speaking"
                                                   value="<?php echo !empty($lang_level['lang_lvl_id']) ? $lang_level['lang_lvl_id'] : '' ?>"/>
                                            <label for="speaking-lvl<?php echo !empty($lang_level['lang_lvl_id']) ? $lang_level['lang_lvl_id'] : '' ?>"><?php echo !empty($lang_level['lang_level']) ? $lang_level['lang_level'] : '' ?></label>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <button class="btn-orange col-lg-3 col-md-3 offset-md-9" onclick="add_resume_item(this)"
                                type="submit">Save
                        </button>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>


<!--References-->

<div class="account-popup-area modal-popup-area" id="ref-modal">
    <div class="account-popup modal-popup resume-modal">
        <span class="close-popup-cus"><i class="la la-close"></i></span>

        <div class="profile-title">
            <h3>Add References</h3>
        </div>

        <form class="form-resume-add-item" id="ref">
            <div class="resumeadd-form">
                <div class="row">
                    <div class="col-lg-12">
                        <span class="pf-title">Name</span>
                        <div class="pf-field">
                            <input placeholder="Ex: John More" type="text">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <span class="pf-title">Position</span>
                        <div class="pf-field">
                            <input placeholder="Ex: Senior Consultant" type="text">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <span class="pf-title">Company Name</span>
                        <div class="pf-field">
                            <input placeholder="Ex: Recruitment Holdings" type="text">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <span class="pf-title">Country</span>
                        <div class="pf-field">
                            <input placeholder="Ex: Sri Lanka" type="text">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <span class="pf-title">Contact No</span>
                        <div class="pf-field">
                            <input placeholder="Ex: +94 77 123 4567" type="text">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <span class="pf-title">Email Address</span>
                        <div class="pf-field">
                            <input placeholder="Ex: john@gmail.com" type="text">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <span class="pf-title">Relationship</span>
                        <div class="pf-field">
                            <input placeholder="Ex: Boss" type="text">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button class="btn-orange col-lg-3 col-md-3 offset-md-9" type="submit">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
