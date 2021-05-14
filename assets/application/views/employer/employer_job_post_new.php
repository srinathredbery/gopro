<section>
    <div class="block no-padding">
        <div class="container-fluid">
            <div class="row no-gape">

                <!--include side bar for employer-->
                <?php $this->load->view('include/side_bar_left_employer') ?>

                <div class="col-lg-9 column">
                    <div class="padding-left">
                        <div class="profile-title">
                            <?php echo isset($current_post) && !empty($current_post) ? '<h3>Edit Job Post</h3>' : '<h3>Post a New Job</h3>'?>

                        </div>
                        <div class="profile-form-edit">
                            <form id="job_post">
                                <?php
                                $edit_check = $this->input->get('job_post');
                                ?>
                                <input type="hidden" name="job_post_id" id="job_post_id" value="<?php echo isset($edit_check) && !empty($edit_check) ? $edit_check : '' ?>">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <span class="pf-title">Job Title <span style="color: red">*</span></span>
                                        <div class="pf-field">
                                            <input type="text" name="job_post_title" placeholder="Ex: Designer" value="<?php echo !empty($current_post['job_post_title']) ? $current_post['job_post_title'] : ''?>"/>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <span class="pf-title">City / Town</span>
                                        <div class="pf-field">
                                            <input type="text" name="job_post_city" value="<?php echo !empty($current_post['job_post_city']) ? $current_post['job_post_city'] : ''?>" placeholder="Ex: London"/>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <span class="pf-title">Country <span style="color: red">*</span></span>
                                        <div class="pf-field">
                                            <select name="job_post_country" class="chosen" id="county-selector">
                                                <option value="" selected>Select a country.</option>
                                                <?php
                                                if (isset($country_list)) {
                                                    if (!empty($country_list)) {
                                                        foreach ($country_list as $country) {
                                                            ?>
                                                            <option value="<?php echo $country['countryID'] ?>"
                                                                <?php
                                                                if( !empty($current_post['job_post_country']) && ($current_post['job_post_country'] == $country['countryID'])) {
                                                                    echo "selected";
                                                                }
//                                                                ?>>
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
                                        <span class="pf-title">Job Type <span style="color: red">*</span></span>
                                        <select name="job_post_job_type" class="chosen">
                                            <option value="" selected>Select an option</option>
                                            <?php
                                            if (isset($job_type)) {
                                                if (!empty($job_type)) {
                                                    foreach ($job_type as $value) {
                                                        ?>
                                                        <option value="<?php echo $value['id'] ?>"
															<?php echo !empty($current_post['job_post_job_type']) && ($current_post['job_post_job_type'] == $value['id']) ? 'selected' : ''?>
														>
                                                            <?php echo $value['job_type_name'] ?>
                                                        </option>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-lg-6">
                                        <span class="pf-title">Job Category</span>
                                        <select name="job_post_job_category" class="chosen">
                                            <option value="" selected>Select an option.</option>
                                            <?php
                                            if (isset($job_category)) {
                                                if (!empty($job_category)) {
                                                    foreach ($job_category as $value) {
                                                        ?>
                                                        <option value="<?php echo $value['id'] ?>"
															<?php
															echo empty($current_post['job_post_job_category']) && $value['id']==3 ? "selected" :
																(!empty($current_post['job_post_job_category']) && $current_post['job_post_job_category'] == $value['id'] ? "selected" : '');
															?>
														>
                                                            <?php echo $value['job_category_name'] ?>
                                                        </option>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-lg-12">
                                        <span class="pf-title">Skill Requirments</span>
                                        <div class="pf-field">
                                            <ul class="tags">
                                                <?php if (isset($current_post['job_post_skill_tags']) && !empty($current_post['job_post_skill_tags']))
                                                {
                                                    foreach ($current_post['job_post_skill_tags'] as $tag)
                                                    {
                                                    ?>
                                                    <li class="addedTag"><?php echo !empty($tag['job_post_skill_tag']) ? $tag['job_post_skill_tag'] :'' ?><span onclick="$(this).parent().remove();" class="tagRemove">x</span>
                                                        <input type="hidden" name="tags[]" value="<?php echo !empty($tag['job_post_skill_tag']) ? $tag['job_post_skill_tag'] :'' ?>" placeholder="Ex: Java, SQL, UI">
                                                    </li>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                                <li class="tagAdd taglist">
                                                    <input type="text" id="search-field" title="Skill Required">
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <span class="pf-title">Gender</span>
                                        <select name="job_post_gender" class="chosen">
                                            <option value="Any" <?php echo !empty($current_post['job_post_gender']) && ($current_post['job_post_gender'] == 'Any') ? 'selected' : '' ?> >Any</option>
                                            <option value="Male" <?php echo !empty($current_post['job_post_gender']) && ($current_post['job_post_gender'] == 'Male') ? 'selected' : '' ?> >Male</option>
                                            <option value="Female" <?php echo !empty($current_post['job_post_gender']) && ($current_post['job_post_gender'] == 'Female') ? 'selected' : '' ?> >Female</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-5">
                                        <span class="pf-title">Career Level</span>
                                        <select name="job_post_career_lvl" class="chosen">
                                            <?php
                                            if (isset($career_level)) {
                                                if (!empty($career_level)) {
                                                    foreach ($career_level as $value) {
                                                        ?>
                                                        <option value="<?php echo $value['id'] ?>"
															<?php echo empty($current_post['job_post_career_lvl']) && $value['id']==1 ? "selected" :
																(!empty($current_post['job_post_career_lvl']) && $current_post['job_post_career_lvl'] == $value['id'] ? "selected" : '' )?>>
                                                            <?php echo $value['career_level_name'] ?>
                                                        </option>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-lg-4">
                                        <span class="pf-title">Qualification</span>
                                        <select name="job_post_qualification" class="chosen">
                                            <?php
                                            if (isset($education_level)) {
                                                if (!empty($education_level)) {
                                                    foreach ($education_level as $value) {
                                                        ?>
                                                        <option value="<?php echo $value['edu_lvl_id'] ?>"
															<?php echo empty($current_post['job_post_qualification']) && $value['edu_lvl_id']==1 ? "selected" :
																(!empty($current_post['job_post_qualification']) && $current_post['job_post_qualification'] == $value['edu_lvl_id'] ? "selected" : '') ?>>
                                                            <?php echo $value['education_level_name'] ?>
                                                        </option>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-lg-6">
                                        <span class="pf-title">Minimum Experience</span>
                                        <div class="pf-field">
                                            <input type="number" name="job_post_experience_min" min="0" placeholder="1 year" value="<?php echo !empty($current_post['job_post_experience_min']) ? $current_post['job_post_experience_min'] : '' ?>"/>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <span class="pf-title">Maximum Experience</span>
                                        <div class="pf-field">
                                            <input type="number" name="job_post_experience_max" min="0" placeholder="3 year" value="<?php echo !empty($current_post['job_post_experience_max']) ? $current_post['job_post_experience_max'] : '' ?>"/>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <span class="pf-title">Currency</span>
                                        <select name="job_post_salary_currency" class="chosen">
                                            <option value="" selected>Select an option.</option>
                                            <?php
                                            if (isset($currency)) {
                                                if (!empty($currency)) {
                                                    foreach ($currency as $value) {
                                                        ?>
                                                        <option value="<?php echo $value['currencyID'] ?>" <?php echo !empty($current_post['job_post_salary_currency']) && $current_post['job_post_salary_currency'] == $value['currencyID'] ? "selected" : '' ?>>
                                                            <?php echo $value['CurrencyCode'] ?><?php echo ' - '.$value['CurrencyName']?>
                                                        </option>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-lg-4">
                                        <span class="pf-title">Minimum Salary</span>
                                        <div class="pf-field">
                                            <input type="number" name="job_post_salary_min" min="0" placeholder="Ex: 10000" value="<?php echo !empty($current_post['job_post_salary_min']) ? $current_post['job_post_salary_min'] : '' ?>"/>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <span class="pf-title">Maximum Salary</span>
                                        <div class="pf-field">
                                            <input type="number" name="job_post_salary_max" min="1" placeholder="Ex: 75000" value="<?php echo !empty($current_post['job_post_salary_max']) ? $current_post['job_post_salary_max'] : '' ?>"/>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <span class="pf-title">Job Description</span>
                                        <div class="pf-field">
                                            <textarea id="new_job_post_description" name="job_post_description" form="job_post" title="" >
                                                <?php echo !empty($current_post['job_post_description']) ? $current_post['job_post_description'] : NULL ?>
                                            </textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <button type="submit" id="save_post" class="float-left" >Post</button>
                                            </div>
                                            <div class="col-lg-3">
                                                <button type="submit" id="save_draft_post" class="float-left" >Save Draft</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="contact-edit">
                            <div class="col-lg-12 ml-md-3">
                                <div class="row">
                                    <span class="pf-title ml-3 mb-3">Job Description Image</span>

                                    <?php if (isset($current_post) && !empty($current_post['job_post_img_url'])){
                                        ?>

                                        <div class="col-lg-6 mb-2">
                                            <div class="mt-3  h-100 p-3" style="border: 1px solid #26ae61;">
                                                <div class="row">
                                                    <div class=" col-10">
                                                        <p class="mb-0" style=" font-size: 12px;">
                                                            File Name : <?php echo !empty($current_post['job_post_img_url']) ? $current_post['job_post_img_url'] : ''  ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="mt-2 pr-2 w-100">
                                                        <a class="btn btn-success float-right m-2 col-3" href= "<?php echo !empty($current_post['job_post_img_url']) ? JOB_POST_IMG_READ_DIR.$current_post['job_post_img_url'] : '' ?>" target="_blank">View</a>
                                                        <a class="btn btn-danger float-right m-2 col-2 del-post-file" id="btn-del-post-file" data-post-id="<?php echo !empty($current_post['job_post_id']) ? $current_post['job_post_id'] : ''?>">
                                                            <i class="la la-trash-o" data-r-id="<?php echo !empty($current_post['job_post_id']) ? $current_post['job_post_id'] : ''?>"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                    ?>

                                    <div class="
                                    <?php echo !empty($current_post['job_post_img_url']) ? 'col-lg-6' : 'col-lg-12'?>
                                    <?php echo empty($edit_check) ? 'd-none-cus' : ''?>
                                    col-sm-12"
										 id="job_post_image_container">
                                        <div id="jp_image_upload" class="dm-uploader drop-zone text-center p-3 mt-3">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h6 class="text-muted">Drag &amp; drop Files here</h6>
                                                </div>

                                                <div class="col-md-12 align-items-center">
                                                    <div class="btn btn-orange-line border-0 mb-2 text-center">
                                                        <input type="hidden" name="jp[_id" id="job_post_id" hidden>
                                                        <input class="file-input" name="job_post_img" id="job_post_image" type="file" title="Click to add Files" multiple="">
                                                        <label for="job_post_image" class="ml-0"> or Select a file</label>
                                                    </div>
                                                    <ul class="list-unstyled" id="files">
                                                        <li class="text-muted text-center empty">No files uploaded.</li>
                                                    </ul>

                                                    <div class="col-md-12">
                                                        <a class="btn btn-success mt-1 mt d-none-cus" id="btnApiStart">
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
                                                <a class="file-remove"><i class="fas fa-times" title="Remove file" onclick="clear_file_input(this)"></i></a>
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
</section>

<script>
    $(document).ready(function () {
        var fas = $("#job_post").bootstrapValidator({
            live: 'enabled',
            message: 'This value is not valid.',
            excluded: [':disabled'],
            fields: {
                job_post_title: {
                    validators: {
                        notEmpty: {message: '*Required'}}
                },
                job_post_job_type: {
                    validators: {
                        notEmpty: {message: '*Required'}}
                },
                job_post_job_category: {
                    validators: {
                        notEmpty: {message: '*Required'}}
                },
                job_post_country: {
                    validators: {
                        notEmpty: {message: '*Required'}}
                },
            },
        }).bootstrapValidator()
            .on('success.form.bv', function (e) {
                e.preventDefault();
                var form_bv_obj = fas.data('bootstrapValidator');
                var clicked_btn =  form_bv_obj.getSubmitButton().attr('id');


                swal(swal_confirm_send).then((result) => {
                    if (result.value) {
                        if (clicked_btn === 'save_post')
                            save_job_post();
                        else if(clicked_btn === 'save_draft_post')
                            save_draft_job_post()
                    }
                    else
                        $('#save_post, #save_draft_post').attr('disabled', false);
                })
            });

        function save_job_post() {
            get_white_rice().then(function (rice) {
                var formData = $("#job_post").serialize();
                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    url: base_url + "employer/job_posts/post_new/post",
                    data: formData + '&white_rice_token=' + rice,
                    cache: false,
                    beforeSend: function () {
                        HoldOn.open(loader_options);
                    },
                    success: function (data) {
                        HoldOn.close();
                        if (data.code === 1){
                            heads_up_success('Post successful');
                            $('#job_post_id').val(data.id);
                            $('#job_post_image_container').fadeIn();
                        }
                        else if(data.code === 0){
                            heads_up_error(data.message);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        HoldOn.close();
                        heads_up_error()
                        $('#save_post, #save_draft_post').attr('disabled', false);

                    }
                });
            }).catch(function () {
                HoldOn.close();
                heads_up_warning('Failed to connect server. Please try again or contact support');
                $('#save_post, #save_draft_post').attr('disabled', false);
            })
        }

        function save_draft_job_post() {
            get_white_rice().then(function (rice) {
                var formData = $("#job_post").serialize();
                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    url: base_url + "employer/job_posts/post_new/save_draft",
                    data: formData + '&white_rice_token=' + rice,
                    cache: false,
                    beforeSend: function () {
                        HoldOn.open(loader_options);
                    },
                    success: function (data) {
                        HoldOn.close();
                        if (data.code === 1){
                            heads_up_success(data.message);
                            $('#job_post_id').val(data.id);
							$('#job_post_image_container').fadeIn();
                        }
                        else if(data.code === 0){
                            heads_up_error(data.message);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        HoldOn.close();
                        heads_up_error();
                        $('#save_post, #save_draft_post').attr('disabled', false);
                    }
                });
            }).catch(function () {
                HoldOn.close();
                heads_up_warning('Failed to connect server. Please try again or contact support');
                $('#save_post, #save_draft_post').attr('disabled', false);
            })
        }
    })
</script>
