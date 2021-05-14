<section>
    <div class="block no-padding">
        <div class="container">
            <div class="row no-gape">

                <!--include side bar for jobseeker-->
                <?php $this->load->view('include/side_bar_left_job_seeker')?>

                <div class="col-lg-9 column">
                    <div class="padding-left">
                        <div class="manage-jobs-sec">
                            <h3>Cover Letter</h3>
                            <div class="col-lg-12 col-md-12 btn-extars button-wrapper">
                                <a class="post-job-btn cus add-new" id="add-new-cover-letter" title=""><i class="la la-plus"></i> Add New</a>
                            </div>

                            <table class="resume-table-custom">
                                <thead>
                                <tr>
                                    <td>Name</td>
                                    <td>Applications</td>
<!--                                    <td>Status</td>-->
                                    <td>Action</td>
                                </tr>
                                </thead>

                                <tbody>

                                <?php
                                if (!empty($jobseeker_cover_letter_list)){
                                    foreach ($jobseeker_cover_letter_list as $cover_letter){
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="table-list-title">
                                                    <h3><a title="" class="cl-edit" data-cl-id="<?php echo !empty($cover_letter['cover_letter_id']) ? $cover_letter['cover_letter_id'] : '' ?>" ><?php echo isset($cover_letter['cover_letter_name']) ? $cover_letter['cover_letter_name'] : '' ?></a></h3>
                                                    <span><i class="la la-calendar-plus-o"></i> Created:  <?php echo isset($cover_letter['inserted_date'])? date("Y/m/d, h:m a", strtotime($cover_letter['inserted_date'])) :'' ?></span><br>
                                                    <span><i class="la la-calendar-check-o"></i> Updated:  <?php echo isset($cover_letter['updated_date'])? date("Y/m/d, h:m a", strtotime($cover_letter['updated_date'])):'' ?></span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="applied-field"><?php echo !empty($cover_letter['no_of_application']) ? $cover_letter['no_of_application'].' Applied' : 'No Applications' ?></span>
                                            </td>
<!--                                            <td>-->
<!--                                                <div class="toggle-group">-->
<!--                                                    <input type="checkbox" name="on-off-switch" onchange="resume_status_switch(this)" id="--><?php //echo isset($cover_letter['cover_letter_id']) ? $cover_letter['cover_letter_id'] : ''?><!--" tabindex="1"-->
<!--                                                        --><?php
//                                                        if(isset($cover_letter['is_active']) && $cover_letter['is_active'])
//                                                            echo 'checked';
//                                                        ?>
<!--                                                    >-->
<!--                                                    <label for="--><?php //echo isset($cover_letter['cover_letter_id']) ? $cover_letter['cover_letter_id'] : ''?><!--">-->
<!---->
<!--                                                    </label>-->
<!--                                                    <div class="onoffswitch" aria-hidden="true">-->
<!--                                                        <div class="onoffswitch-label">-->
<!--                                                            <div class="onoffswitch-inner"></div>-->
<!--                                                            <div class="onoffswitch-switch"></div>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </td>-->
                                            <td>
                                                <ul class="action_job">
<!--                                                    <li><span>View Resume</span><a href="" title=""><i class="la la-eye"></i></a></li>-->
                                                    <li><span>Edit</span><a class="cl-edit" data-cl-id="<?php echo !empty($cover_letter['cover_letter_id']) ? $cover_letter['cover_letter_id'] : '' ?>" title=""><i class="la la-pencil" data-cl-id="<?php echo !empty($cover_letter['cover_letter_id']) ? $cover_letter['cover_letter_id'] : '' ?>"></i></a></li>
                                                    <li><span>Delete</span><a class="btn-del del-cl" data-cl-id="<?php echo !empty($cover_letter['cover_letter_id']) ? $cover_letter['cover_letter_id'] : '' ?>" title=""><i class="la la-trash-o" data-cl-id="<?php echo !empty($cover_letter['cover_letter_id']) ? $cover_letter['cover_letter_id']: '' ?>"> </i></a></li>
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

<div class="account-popup-area modal-popup-area" id="add-new-cover-letter-popup-box">
    <div class="account-popup">
        <span class="close-popup"><i class="la la-close"></i></span>

        <div class="profile-title">
            <h3>Add New Cover Letter</h3>
        </div>

        <div class="profile-form-edit">
            <form id="add-cover-letter">
                <input type="hidden" id="" name="action" disabled>
                <div class="row">

                    <div class="col-lg-6">
                        <span class="pf-title">Cover Letter Name <span class="required-label">*</span></span>
                        <div class="pf-field">
                            <input placeholder="" name="cover_letter_name" type="text">
                        </div>
                    </div>

<!--                    <div class="col-lg-6">-->
<!--                        <span class="pf-title">Select Your CV</span>-->
<!--                        <div class="pf-field">-->
<!--                            <select name="resume_id" data-placeholder="Select Your CV" class="chosen">-->
<!--                                <option selected value="">Please select a resume...</option>-->
<!--                                --><?php
//                                if (isset($jobseeker_resume_list) && !empty($jobseeker_resume_list)){
//                                    foreach ($jobseeker_resume_list as $js_resume){
//                                        ?>
<!--                                        <option value="--><?php //echo !empty($js_resume['resume_id']) ? $js_resume['resume_id']: ''?><!--">--><?php //echo !empty($js_resume['resume_name']) ? $js_resume['resume_name']: ''?><!--</option>-->
<!--                                        --><?php
//                                    }
//                                }
//                                ?>
<!--                            </select>-->
<!--                        </div>-->
<!--                    </div>-->

                    <div class="col-lg-12">
                        <span class="pf-title">Cover Letter</span>
                        <div class="pf-field">
                            <div id="cover_letter_content"></div>
                        </div>
                    </div>

                    <div class="col-lg-12" id="attch">

                        <span class="pf-title">Attachments</span>
                        <div class="pf-field">
                            <div class="row">
                                <div class="col-md-12 mb-2 cl-file d-none-cus" id="">
                                    <p class="mb-0" style="font-size: 12px;">File Name : <span id="cl_file_name"></span></p>
                                    <a class="btn btn-success float-left m-2 col-1 cl_link" href= "<?php echo JOB_SEEKER_COVER_LETTER_READ_DIR?>" target="_blank">View</a>
                                    <a class="btn btn-danger float-left m-2 col-1 del-cl-file" id="" >
                                        <i class="la la-trash-o"></i>
                                    </a>
                                </div>
                                <div class="col-md-12 mb-2" data-cl-id="">
                                    <input type="file" name="user_cover" id="upload-resume" placeholder="Choose your CV"/>
                                    <label for="upload-resume">Choose File</label>
                                    <label class="selected-file">No files chosen</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button class="btn-orange btn-save-cl" data-cl-id="" style="margin-top:10px" onclick="" type="submit">Save</button>
                    </div>

                </div>
            </form>
        </div>

    </div>
</div>


