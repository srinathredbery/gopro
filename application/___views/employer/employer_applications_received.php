<section>
    <div class="block no-padding">
        <div class="container-fluid">
            <div class="row no-gape">

                <!--include side bar for employer-->
                <?php $this->load->view('include/side_bar_left_employer') ?>

                <div class="col-lg-9 column">
                    <div class="padding-left">
                        <div class="emply-resume-sec">
                            <h3> <?php echo isset($job_post) && !empty($job_post['job_post_title']) && !empty($applications)  ? '('.count($applications).')' : ''?> Applications Recieved <?php echo isset($job_post) && !empty($job_post['job_post_title']) ? ' : '.$job_post['job_post_title'] : ''?></h3>

                            <?php
                            if (isset($applications) && !empty($applications)) {
                                foreach ($applications as $application) {
                                    ?>
                                    <div class="emply-resume-list" data-apl_id="<?php echo !empty($application['application_no']) ? $application['application_no'] : ''?>">
                                        <div class="emply-resume-thumb">
                                            <img src="<?php echo isset($application['jobseeker_dp_url']) || !empty($application['jobseeker_dp_url'])? USER_PRO_PIC_READ_DIR.$application['jobseeker_dp_url'] : DEFAULT_PRO_PIC ?>" alt="" />
                                        </div>
                                        <div class="emply-resume-info">
                                            <h3><a href="#" title="" id="js-name"><?php echo !empty($application['jobseeker_first_name']) && !empty($application['jobseeker_last_name']) ? $application['jobseeker_first_name'].' '.$application['jobseeker_last_name'] : ''?></a></h3>
                                            <span>
                                                <i><?php echo !empty($application['job_title']) ? $application['job_title'] : '' ?></i>
                                                <?php echo !empty($application['company']) ? ' at '.$application['company'] : '' ?></span>
                                            <p><i class="la la-map-marker"></i>
                                                <?php
                                                $city = !empty($application['jobseeker_city']) ? $application['jobseeker_city'] : 'City not stated';
                                                $country = !empty($application['country_name']) ? $application['country_name'] : 'Oman';

                                                echo $city.', '.$country

                                                ?>
                                            </p>
                                            <?php
                                            if (!empty($application['is_wd']) && $application['is_wd'] == '1') {
                                                ?>
                                                <span class="application-status withdrawn" id="<?php echo !empty($application['application_no']) ? 'apl-id-'.$application['application_no'] : '' ?>">
                                                        Withdrawn
                                                </span>
                                                <?php
                                            } elseif (!empty($application['is_wd']) && $application['is_wd'] == '2') {
                                                ?>
                                                <span class="application-status reapplied" id="<?php echo !empty($application['application_no']) ? 'apl-id-'.$application['application_no'] : '' ?>">
                                                        Re-Applied
                                                </span>
                                                <?php
                                            } else {
                                                ?>
                                                <span class="application-status applied" id="<?php echo !empty($application['application_no']) ? 'apl-id-'.$application['application_no'] : '' ?>">
                                                        Applied
                                                </span>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="action-resume">
                                            <div class="action-center">
                                                <span>Action <i class="la la-angle-down"></i></span>
                                                <ul>
                                                    <li class="section-head">Resume</li>
                                                    <li class="open-letter"><a title="">Cover Letter</a></li>
                                                    <li><a href="<?php echo base_url().'employer/resume/view?r_id='.base64_encode($application['applied_resume']);?>" target="_blank" title=""" title="">View CV</a></li>
                                                    <?php if (!empty($application['resume_attachment'])) : ?>
                                                        <li>
                                                            <a href="<?php echo JOB_SEEKER_RESUME_READ_DIR.$application['resume_attachment'] ?>"
                                                               target="_blank" title="">Download CV
                                                            </a>
                                                        </li>
                                                    <?php endif ?>
                                                    <li>
                                                        <hr>
                                                        <a class="schedule-an-interview" data-post-id="<?php echo !empty($application['application_no']) ? $application['application_no'] : ''?>" onclick="" title="">
                                                            Schedule Interview
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="del-resume">
<!--                                            <a href="#" title=""><i class="la la-trash-o"></i></a>-->
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
</section>

<div class="coverletter-popup">
    <div class="cover-letter">
        <i class="la la-close close-letter"></i>
        <h3>Ali TUFAN - UX / UI Designer</h3>
        <p class="cover-letter-content">
            Content goes here
        </p>
    </div>
</div>

<div class="contactus-popup">
    <div class="contact-popup">
        <i class="la la-close close-contact"></i>
        <h3>Send Message to “Ali TUFAN”</h3>
        <form>
            <div class="popup-field">
                <input type="text" placeholder="Tera Planer" />
                <i class="la la-user"></i>
            </div>
            <div class="popup-field">
                <input type="text" placeholder="demo@jobhunt.com" />
                <i class="la la-envelope-o"></i>
            </div>
            <div class="popup-field">
                <input type="text" placeholder="+90 538 845 09 85" />
                <i class="la la-phone"></i>
            </div>
            <div class="popup-field">
                <textarea placeholder="Message"></textarea>
            </div>
            <button type="submit">Send Message</button>
        </form>
    </div>
</div>

<div class="account-popup-area modal-popup-area" id="interview_popup">
    <div class="account-popup modal-popup resume-modal">
        <span class="close-popup"><i class="la la-close"></i></span>
        <div class="profile-title">
            <h3>Schedule an Interview</h3>
        </div>
        <div>
            <h6>Candidate: <span id="candidate_name"></span></h6>
        </div>
        <form class="form-resume-add-item" id="interview-schedule-form">
            <div class="resumeadd-form">
                <div class="row">
                    <input type="hidden" name="application_id" id="app_id">
                    <div class="col-lg-6">
                        <span class="pf-title">Interview Date <span class="required-label">*</span></span>
                        <div class="pf-field">
                            <input type="text" name="interview_date" class="datetimepicker-input date-picker" id="interview_date" data-toggle="datetimepicker" data-target="#interview_date" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <span class="pf-title">Start Time <span class="required-label">*</span></span>
                        <div class="pf-field">
                            <input type="text" name="start_time" class="datetimepicker-input time-picker" id="interview_start_time" data-toggle="datetimepicker" data-target="#interview_start_time" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <span class="pf-title">End Time <span class="required-label">*</span></span>
                        <div class="pf-field">
                            <input type="text" name="end_time" class="datetimepicker-input time-picker" id="interview_end_time" data-toggle="datetimepicker" data-target="#interview_end_time" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <span class="pf-title">Interview Venue<span class="required-label">*</span></span>
                        <div class="pf-field">
                            <select name="" id= "" class="chosen">
                                <?php
                                if (isset($interview_schedules) && !empty($interview_schedules)) {
                                    foreach ($interview_schedules as $schedule) {
                                        ?>
                                        <option value="<?php echo !empty($schedule['job_post_id']) ? $schedule['job_post_id'] : '' ?>">
                                            <?php echo !empty($schedule['job_post_title']) ? $schedule['job_post_title'] : ''?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn-orange col-lg-3 col-md-3 offset-md-9 text-center p-0" type="submit">Schedule</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
