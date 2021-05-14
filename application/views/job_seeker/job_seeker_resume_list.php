<section>
    <div class="block remove-top">
        <div class="container">
            <div class="row no-gape">

                <!--include side bar for jobseeker-->
                <?php $this->load->view('include/side_bar_left_job_seeker')?>

                <div class="col-lg-9 column">
                    <div class="padding-left">
                        <div class="manage-jobs-sec">
                            <h3>My Resumes</h3>

                            <div class="col-lg-12 col-md-12 btn-extars button-wrapper">
                                <a class="post-job-btn cus add-new" id="add-new-resume" title=""><i class="la la-plus"></i> Add New</a>
                            </div>

                            <table class="resume-table-custom">
                                <thead>
                                    <tr>
                                        <td>Resume Name</td>
                                        <td>Applications</td>
                                        <td>Status</td>
                                        <td>Action</td>
                                        <td>Attachments</td>
                                    </tr>
                                </thead>

                                <tbody>

                                <?php
                                if (!empty($jobseeker_resume_list)){
                                    foreach ($jobseeker_resume_list as $resume){
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="table-list-title">
                                                    <h3><a href="<?php echo !empty($resume['resume_id']) ? base_url().'job_seeker/resume/new?cv_id='.$resume['resume_id']: '' ?>" title=""><?php echo isset($resume['resume_name']) ? $resume['resume_name'] : 'Not found' ?></a></h3>
                                                    <span><i class="la la-calendar-plus-o"></i> Created:  <?php echo isset($resume['inserted_date'])? date("Y/m/d, h:m a", strtotime($resume['inserted_date'])) :'' ?></span><br>
                                                    <span><i class="la la-calendar-check-o"></i> Updated:  <?php echo isset($resume['updated_date'])? date("Y/m/d, h:m a", strtotime($resume['updated_date'])):'' ?></span><br>
                                                    <span><a href="" class="btn-make-primary">Make this primary</a></span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="applied-field"><?php echo !empty($resume['no_of_application']) ? $resume['no_of_application'].' Applied' : 'No Applications' ?></span>
                                            </td>
                                            <td>
                                                <div class="toggle-group">
                                                    <input type="checkbox" name="on-off-switch" onchange="resume_status_switch(this)" id="<?php echo isset($resume['resume_id']) ? $resume['resume_id'] : ''?>" tabindex="1"
                                                        <?php
                                                        if(isset($resume['is_active']) && $resume['is_active'])
                                                            echo 'checked';
                                                        ?>
                                                    >
                                                    <label for="<?php echo isset($resume['resume_id']) ? $resume['resume_id'] : ''?>">

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
                                                <ul class="action_job">
<!--                                                    <li><span>View Resume</span><a href="" title=""><i class="la la-eye"></i></a></li>-->
                                                    <li><span>Edit</span><a href="<?php echo !empty($resume['resume_id']) ? base_url().'job_seeker/resume/new?cv_id='.$resume['resume_id']: '' ?>" title=""><i class="la la-pencil"></i></a></li>
                                                    <li><span>Delete</span><a class="btn-del del-res" data-r-id="<?php echo !empty($resume['resume_id']) ? $resume['resume_id']: '' ?>" title=""><i class="la la-trash-o" data-r-id="<?php echo !empty($resume['resume_id']) ? $resume['resume_id']: '' ?>"> </i></a></li>
                                                </ul>
                                            </td>
                                            <td><?php if(!empty($resume['resume_attachment']))
                                            {
                                                ?>
                                                    <a class="btn-apply-filter mt-0" href="<?php echo !empty($resume['resume_attachment']) ? JOB_SEEKER_RESUME_READ_DIR.$resume['resume_attachment'] : '' ?>" target="_blank"><i class="la la-file"></i> View/Download</a>
                                                    <?php
                                                }
                                                ?>

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

<div class="account-popup-area modal-popup-area" id="add-new-resume-popup-box">
    <div class="account-popup">
        <span class="close-popup"><i class="la la-close"></i></span>

        <div class="profile-title">
            <h3>Add New Resume</h3>
        </div>

        <div class="profile-form-edit">
            <form id="new_resume_form" >
                <div class="row">
                    <div class="col-md-12">
                        <span class="pf-title">Resume Name</span>
                        <div class="pf-field">
                            <input type="text" class="" name="resume_name" placeholder="Ex: My Resume" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn-orange" style="margin-top:10px" onclick="" type="submit">Next</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
