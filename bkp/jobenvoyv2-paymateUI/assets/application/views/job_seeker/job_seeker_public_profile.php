<?php
if (isset($jobseeker_info, $resume_data) && !empty($jobseeker_info) && !empty($resume_data)){
?>
<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url(http://placehold.it/1600x800) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div><!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header sm-width">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="skills-btn">
<!--                                        <a href="#" title="">Photoshop</a>-->
<!--                                        <a href="#" title="">Designers</a>-->
<!--                                        <a href="#" title="">Illustrator</a>-->
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="action-inner">
<!--                                        <a href="#" title=""><i class="la la-download"></i>Download Resume</a>-->
<!--                                        <a href="#" title=""><i class="la la-envelope-o"></i>Contact David</a>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="overlape">
    <div class="block remove-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cand-single-user">
                        <div class="share-bar circle">
                        </div>
                        <div class="can-detail-s">
                            <div class="cst"><img src="<?php echo isset($jobseeker_info['jobseeker_dp_url']) || !empty($jobseeker_info['jobseeker_dp_url'])? USER_PRO_PIC_READ_DIR.$jobseeker_info['jobseeker_dp_url'] : DEFAULT_PRO_PIC ?>" alt="" /></div>
                            <h3>
                                <?php
                                if(isset($jobseeker_info))
                                    echo !empty($jobseeker_info['jobseeker_first_name']) ? $jobseeker_info['jobseeker_first_name'].' ' : '';
                                    echo !empty($jobseeker_info['jobseeker_middle_name']) ? $jobseeker_info['jobseeker_middle_name'].' ' : '';
                                    echo !empty($jobseeker_info['jobseeker_last_name']) ? $jobseeker_info['jobseeker_last_name'].' ' : '';
                                ?>
                            </h3>
<!--                            <span><i>UX / UI Designer</i> at Atract Solutions</span>-->
                            <p></p>
                            <p><i class="la la-map-marker"></i>
                                <?php
                                echo !empty($jobseeker_info['jobseeker_city']) ? $jobseeker_info['jobseeker_city'] : '';
                                echo !empty($jobseeker_info['jobseeker_country_id']) && !empty($jobseeker_info['jobseeker_city']) ? ', ' : '';
                                echo !empty($jobseeker_info['jobseeker_country_id']) ? get_country($jobseeker_info['jobseeker_country_id']) : '';
                                ?>
                            </p>
                        </div>
						<?php if(isset($_SESSION['logged_in']) && $_SESSION['user_type']==1 || $_SESSION['user_type']==2 || $_SESSION['user_type']==4){
							//user_type 4 is temporary solution for search for user access
							?>
							<div class="download-cv">
								<?php if (!empty($resume_data['resume_attachment'])){
									?>
									<a href="<?php echo JOB_SEEKER_RESUME_READ_DIR.$resume_data['resume_attachment'] ?>" title="" target="_blank">Download CV <i class="la la-download"></i></a>
									<?php
								}?>
							</div>
							<?php

						}
						?>
                    </div>
                    <ul class="cand-extralink">
                        <?php if (isset($resume_data['about_description']) && !empty($resume_data['about_description'])) { ?>
                            <li><a href="#about" title="">About</a></li>
                        <?php }

                        if (isset($resume_work_exp) && !empty($resume_work_exp)) {
                            ?>
                            <li><a href="#experience" title="">Work Experience</a></li>
                        <?php }

                        if (isset($resume_skills) && !empty($resume_skills)) { ?>
                            <li><a href="#skills" title="">Professional Qualifications</a></li>
                        <?php }

                        if (isset($resume_edus) && !empty($resume_edus)) { ?>
                            <li><a href="#education" title="">Education</a></li>
                        <?php }

                        if (isset($resume_awards) && !empty($resume_awards)) { ?>
                            <li><a href="#awards" title="">Awards</a></li>
                        <?php }

                        if (isset($resume_langs) && !empty($resume_lang)) { ?>
                            <li><a href="#lang" title="">Language</a></li>
                            <?php
                        }
                        ?>
                    </ul>
                    <div class="cand-details-sec">
                        <div class="row">
                            <div class="col-lg-8 column">
                                <div class="cand-details" id="about">
                                    <?php if (isset($resume_data['about_description']) && !empty($resume_data['about_description'])) {

                                        ?>
                                        <h2>Candidates About</h2>
                                        <p class="">
                                            <?php echo !empty($resume_data['about_description']) ? $resume_data['about_description'] : '' ?>
                                        </p>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                    if (isset($resume_work_exp) && !empty($resume_work_exp)) {
                                        ?>
                                        <div class="edu-history-sec" id="experience">
                                            <h2>Work & Experience</h2>
                                            <?php
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
                                                </div>
                                                <?php
                                            }
                                            ?>

                                        </div>

                                        <?php
                                    }

                                    if (isset($resume_skills) && !empty($resume_skills)) {
                                        ?>
                                        <div class="progress-sec" id="skills">
                                            <h2>Professional Skills</h2>
                                            <?php
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
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>

                                        <?php
                                    }

                                    if (isset($resume_edus) && !empty($resume_edus)) {
                                        ?>
                                        <div class="edu-history-sec" id="education">
                                            <h2>Education</h2>
                                            <?php
                                            foreach ($resume_edus as $resume_edu) {

												if(!empty($resume_edu['start_date']) && $resume_edu['start_date'] != '0000-00-00')
													$start_date = date("M Y", strtotime($resume_edu['start_date']));
												else
													$start_date = "";

												if(!empty($resume_edu['end_date']) && $resume_edu['end_date'] != '0000-00-00')
													$end_date = date("M Y", strtotime($resume_edu['end_date']));
												elseif($resume_edu['still_following'] =='yes')
													$end_date = 'To date';
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
                                                        <i><?php echo !empty($resume_edu['start_date']) ? date("Y", strtotime($resume_edu['start_date'])) . ' -' : '' ?><?php echo !empty($resume_edu['end_date']) ? date("Y", strtotime($resume_edu['end_date'])) : 'Following' ?></i>
                                                        <span><?php echo !empty($resume_edu['school']) ? $resume_edu['school'] : '' ?><i><?php echo !empty($resume_edu['specialization']) ? $resume_edu['specialization'] : '' ?></i></span>
                                                        <p><?php echo !empty($resume_edu['related_info']) ? $resume_edu['related_info'] : '' ?></p>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                    }

                                    if (isset($resume_awards) && !empty($resume_awards)) {
                                        ?>
                                        <div class="edu-history-sec" id="awards">
                                            <h2>Awards</h2>
                                            <?php
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
                                                </div>

                                                <?php
                                            }
                                            ?>
                                        </div>

                                        <?php
                                    }
                                    if (isset($resume_langs) && !empty($resume_langs)) {
                                    ?>

                                    <div class="edu-history-sec" id="awards">
                                        <h2>Language</h2>
                                            <?php
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
                </div>
            </div>
        </div>
    </div>
</section>

<?php
}
else{
    ?>
    <section>
        <div class="job-applied-message-banner">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <span class="job-applied-message-icon"><i class="fas fa-info-circle"></i></span>
                        <p>
                            <b>Error!</b> There is no Resume found.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}
?>
