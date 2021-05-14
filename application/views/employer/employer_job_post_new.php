<style type="text/css">
    .questionnaire-btn {
        padding: 4px 20px!important;
        line-height: 1.7;
        font-size: 13px;
    }
    .stepwizard-step p {
        margin-top: 10px;
    }
    .stepwizard-row {
        display: table-row;
    }
    .stepwizard {
        display: table;
        width: 100%;
        position: relative;
    }
    .stepwizard-step button[disabled] {
        opacity: 1 !important;
        filter: alpha(opacity=100) !important;
    }
    .stepwizard-row:before {
        top: 14px;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 100%;
        height: 1px;
        background-color: #ccc;
        z-order: 0;
    }
    .stepwizard-step {
        display: table-cell;
        text-align: center;
        position: relative;
    }
    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
        border: 1px solid #00bcd4;
        color: #00bcd4;
        background-color: white;
        /*pointer-events: none;*/
    }
    .btn-circle:hover {
        color: #00bcd4;
    }

    .btn-wizard {
        text-transform: uppercase;
        -webkit-font-smoothing: subpixel-antialiased;
        background-color: #00bcd4;
        color: #FFFFFF;
        cursor: pointer;
        font-weight: 500;
        box-shadow: 0 16px 26px -10px rgb(54 211 244 / 56%), 0 4px 25px 0px rgb(0 0 0 / 12%), 0 8px 10px -5px rgb(244 67 54 / 20%);
        /*pointer-events: auto;*/
    }
    .btn-wizard:hover {
        color: #FFFFFF;
        background-color: #00bcd4;
    }
    .btn-wizard:focus {
        color: white;
    }

    .block .container {
        padding: 43px;
        border: none;
    }
</style>

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

                        <div class="container">
                            <div class="stepwizard">
                                <div class="stepwizard-row setup-panel">
                                    <div class="stepwizard-step">
                                        <a href="#step-1" type="button" class="btn-wizard btn-circle step1cls" >1</a>
                                        <p class="text-info">Details</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a href="#step-2" type="button" class="btn-circle btn-light  step2cls" disabled>2</a>
                                        <p class="text-info">Questionnaire</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a href="#step-3" type="button" class="btn-circle btn-light step3cls" disabled>3</a>
                                        <p class="text-info">Levels</p>
                                    </div>
                                  </div>
                            </div>

                            <div class="row setup-content" id="step-1">
                                <div class="col-12">
                                    <h4> Details </h4>

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
                                                    <span class="pf-title">Oman Governorates</span>
                                                    <div class="pf-field">
                                                       <!--  <input type="text" name="job_post_city" value="<?php echo !empty($current_post['job_post_city']) ? $current_post['job_post_city'] : ''?>" placeholder="Ex: Muscat"/> -->

                                                        <select id="country_filter" class="chosen" data-placeholder="Oman Governorates" data-select2-id="country_filter"  name="job_post_city"
                                                        <?php echo !empty($current_post['job_post_city']) ?'selected' : ''?>
                                                            <option value="" data-select2-id=""></option>
                                                                                                      <!--  <option value=""> -->
                                                                                                                <!--  </option> -->
                                                                    <option value="Ad Dakhiliyah" data-select2-id="19"> Ad Dakhiliyah </option>
                                                                    <option value="Ad Dhahirah" data-select2-id="20">Ad Dhahirah  </option>
                                                                    <option value="Al Batinah North" data-select2-id="21"> Al Batinah North </option>
                                                                    <option value="Al Batinah South" data-select2-id="22">Al Batinah South  </option>
                                                                    <option value="Al Buraymi" data-select2-id="23"> Al Buraymi </option>
                                                                    <option value="Al Wusta" data-select2-id="24"> Al Wusta </option>
                                                                    <option value="Ash Sharqiyah North" data-select2-id="25"> Ash Sharqiyah North </option>
                                                                    <option value="Ash Sharqiyah South" data-select2-id="26"> Ash Sharqiyah South </option>
                                                                    <option value="Dhofar" data-select2-id="27"> Dhofar </option>
                                                                    <option value="Muscat" data-select2-id="28">  Muscat</option>
                                                                    <option value="Musandam" data-select2-id="29"> Musandam </option>
                                                        </select>
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
                                                                            if (!empty($current_post['job_post_country']) && ($current_post['job_post_country'] == $country['countryID'])) {
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
                                                            <?php if (isset($current_post['job_post_skill_tags']) && !empty($current_post['job_post_skill_tags'])) {
                                                                foreach ($current_post['job_post_skill_tags'] as $tag) {
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
                                                            <?php echo !empty($current_post['job_post_description']) ? $current_post['job_post_description'] : null ?>
                                                        </textarea>
                                                    </div>
                                                </div>
 </div>
  <div class="col-12">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <button class="btn btn-info float-right float-end " type="submit" id="step1next2" style="margin-top: 12px;"  >Next</button>
                                                    </div>
                                                    

                                                </div>
                                            </div>
  
                                               <!--  <div class="col-lg-12">
                                                    <div class="row" style="margin-top: 20px;">
                                                        <div class="col-lg-2 float-left">
                                                            <button class="btn btn-info" type="submit" id="save_post" class="">Post</button>
                                                        </div>
                                                        <div class="col-md-offset-8 col-lg-2 float-right">
                                                            <button type="submit" id="save_draft_post" class="btn btn-info">Save Draft</button>
                                                        </div>
                                                    </div>
                                                </div>
 -->
                                            </div>
                                        </form>


                                    <div class="contact-edit">
                                        <div class="col-lg-12 ml-md-3">
                                            <div class="row">
                                                <span class="pf-title ml-3 mb-3  d-none-cus">Job Description Image</span>

                                                <?php if (isset($current_post) && !empty($current_post['job_post_img_url'])) {
                                                    ?>

                                                    <div class="col-lg-6 mb-2">
                                                        <div class="mt-3 h-100 p-3" style="border: 1px solid #26ae61;">
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
                                                                <div class="btn btn-orange-line border-0 mb-2 text-center"
                                                                >
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

                            <div class="row setup-content" id="step-2" style="margin-right: 15px;margin-left: 15px;">
                        <div class="col-12">
                            <h3> Questionnaire </h3>

                           <!-- question start here -->
                            

                                    <?php
                                    if (isset($_GET['job_post'])) {
                                        // echo  var_dump($questionnaire);
                                        foreach ($questionnaire as $value) {
                                            $qid=$value['id'];
                                            ?>
                                        
<div class="">
                                <div class="">
                                    <div>
                                        <div class="field col-lg-12">
                                            <div class="">
                                                <input type="hidden" >
                                                   <span class="pf-title">Question <span style="color: red">*</span></span>
                                                   <div class="pf-field">
                                                      <input type="text" name="questionedit['<?php echo $qid; ?>']" placeholder="Ex: Question" value="<?php     echo  $value['question'];?>" data-bv-field="Question"  class="qzedit" qid="<?php     echo  $value['id'];?>" >
                                                   </div>
                                             </div>
                                        </div>
                                    </div>


</div>
</div>






                                            <?php
                                        }
                                    }

                                    ?>
                                    <div class="col-xs-12">
                                <div class="">

                                    <div id="field">
                                        <div id="field0 col-lg-12">
                                            <div class="col-lg-12">
                                                <input type="hidden" id="qpostid">
                                                   <span class="pf-title">Question <span style="color: red">*</span></span>
                                                   <div class="pf-field">
                                                      <input type="text" name="question[]" placeholder="Ex: Question" value="" data-bv-field="Question" class="quz">
                                                   </div>
                                             </div>
                                        </div>
                                    </div>

                                    <div id="quzlist"></div>
                                    <div id="addmorelist0"></div>

                                    <!-- Button -->
                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <button id="add-more" name="add-more" class="btn btn-primary questionnaire-btn mt-4 ml-3 mb-4">Add More</button>
                                        </div>
                                    </div>
                                    <br><br>
                                </div>
                            </div>
                            <!-- quedtion end here -->
                        </div>
 <div class="col-lg-12">
        <!--   <button class="btn btn-info " type="button" id="save_post_question">Add Question</button> -->
                        <button class="btn btn-info" type="button" id="step2next">Next</button>

 </div>
                        
                    </div>

                            <div class="row setup-content" id="step-3" style="margin-right: 15px; margin-left: 15px;">
                                <div class="col-12">
                                    <h3> Levels</h3>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Number of Exams</label>
                                                <input maxlength="200" type="number" class="form-control" placeholder="Enter Number of Levels" required id="no_of_exam"  value="<?php echo !empty($current_post['no_of_exam']) ? $current_post['no_of_exam'] : ''?>" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Number of Interviews</label>
                                                <input maxlength="200" type="number" class="form-control" placeholder="Enter Number of Exams" required id="no_of_levels"  value="<?php echo !empty($current_post['no_of_levels']) ? $current_post['no_of_levels'] : ''?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-primary addlevels"  id="step3next" is_publish="1">Submit</button>
                                             <button class="btn btn-primary addlevels"  id="step3next" is_publish="0">Save Draft</button>
                                        </div>
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

<style>
    .d-none-cus{
        /*display: block !important;*/
    }
</style>

<script>
    $(document).ready(function () {
        var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

        allWells.hide();
        $('#step-1').show();

        // navListItems.click(function (e) {
        //     e.preventDefault();
        //     var $target = $($(this).attr('href')),
        //         $item = $(this);

        //     if (!$item.hasClass('disabled')) {
        //         navListItems.removeClass('btn-wizard').addClass('btn-default');
        //         $item.addClass('btn-wizard');
        //         allWells.hide();
        //         $target.show();
        //         $target.find('input:eq(0)').focus();
        //     }
        // });

        allNextBtn.click(function(){
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='url']"),
                isValid = true;

                $(".form-group").removeClass("has-error");
                for(var i=0; i<curInputs.length; i++){
                    if (!curInputs[i].validity.valid){
                        isValid = false;
                        $(curInputs[i]).closest(".form-group").addClass("has-error");
                    }
                }

            if (isValid)
                nextStepWizard.removeAttr('disabled').trigger('click');
            });

            $('div.setup-panel div a.btn-wizard').trigger('click');

            $('.addlevels').click(function(){
              //console.log('clicked');
    var is_publish=$(this).attr('is_publish');         
var no_of_levels=$('#no_of_levels').val();
var no_of_exam=$('#no_of_exam').val();
var id= $('#job_post_id').val();


  get_white_rice().then(function (rice) {
               // var formData = $("#job_post").serialize();
                $.ajax({
                    type: 'POST',
                  
                    url: base_url + "employer/employer_post_job/ats_post_level_update",
                    data:{ 'white_rice_token':rice,no_of_exam:no_of_exam,no_of_levels:no_of_levels,id:id,is_publish:is_publish},
                    cache: false,
                    beforeSend: function () {
                        HoldOn.open(loader_options);
                    },
                    success: function (data) {
                        HoldOn.close();
                        if( is_publish==0){
                           var msg='Post saved as draft' ;
                        }
                        else{
                           var msg='Post successful'  ;
                        }
                       heads_up_success(msg);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        HoldOn.close();
                        heads_up_error()
                       
                    }
                });
            }).catch(function () {
                HoldOn.close();
                heads_up_warning('Failed to connect server. Please try again or contact support');
                $('#save_post, #save_draft_post').attr('disabled', false);
            })







            });
        });
    </script>

<script>
    $(document).ready(function () {


$('#step1next2').click(function(){

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
                 save_job_post()
               // enablestep1next();
                $('.step2cls').removeClass('btn-wizard');
      $('.step2cls').removeClass('btn-light');
      $('.step2cls').addClass('btn-wizard');
                /*
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
                */
            });




});



$('#step3next').click(function(){
    var no_of_exam=$('#no_of_exam').val();
     var  no_of_levels=$('#no_of_levels').val();
     var post_id= $('#job_post_id').val();

     $('.btn-circle').removeClass('btn-wizard');
     $('.btn-circle').removeClass('btn-wizard');

$('.step3cls').removeClass('btn-wizard');
      $('.step3cls').removeClass('btn-light');
      $('.step3cls').addClass('btn-wizard');

  get_white_rice().then(function (rice) {
                var formData = $("#job_post").serialize();
                $.ajax({
                    type: 'POST',
                  
                    url: base_url + "employer/job_posts/post_edit_levels/post",
                    data:{ 'white_rice_token':rice,no_of_exam:no_of_exam,no_of_levels:no_of_levels,post_id:post_id},
                    cache: false,
                    beforeSend: function () {
                        HoldOn.open(loader_options);
                    },
                    success: function (data) {
                        HoldOn.close();
                       heads_up_success('Post successful');
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        HoldOn.close();
                        heads_up_error()
                       
                    }
                });
            }).catch(function () {
                HoldOn.close();
                heads_up_warning('Failed to connect server. Please try again or contact support');
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
                           // heads_up_success('Post successful');
                            $('#job_post_id').val(data.id);
                            $('#job_post_image_container').fadeIn();

                            $('#qpostid').val(data.id);

                            $('.nav li.active').next('li').removeClass('disabled');
                            $('.nav li.active').next('li').addClass('active');
                            $('#menu1').addClass('active');
                            $('#home').addClass('fade in');
                            $('.nav li.active').next('li').find('a').attr("data-toggle","tab");



      var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

        allWells.hide();
        $('#step-2').show();
      $('.step1cls').removeClass('btn-wizard');
      $('.step2cls').removeClass('btn-light');
      $('.step2cls').addClass('btn-wizard');
      
      //$('.step3cls').removeClass();


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

// question start here
// @naresh action dynamic childs
    var next = 0;
    $("#add-more").click(function(e){
      //  console.log('added');
        //e.preventDefault();
        var addto = "#field" + next;


       // console.log(addto);
        
        var addRemove = "#field" + (next);
       
        var newIn = ' <div id="field'+ next +'" name="field'+ next +'"><div class="col-lg-12"><span class="pf-title">Question  <span style="color: red">*</span></span><div class="pf-field"><input type="text" name="question[]" placeholder="Ex: Question" value="" data-bv-field="Question" class="quz"></div></div>'
         next = next + 1;

        var newInput = $(newIn);
        var removeBtn = '<div class="col-lg-12 removequzdiv'+ (next-1)+'"><button id="remove' + (next - 1) + '" class="btn-danger remove-me questionnaire-btn mt-2 mr-3" >Remove</button></div><div id="addmorelist'+(next)+'"></div>';




        //var quizdiv=$('#quzlist')
     // $('.removequzdiv'+ (next-1)).after('<div id="addmorelist'+(next)+'"></div>');

        var removeButton = $(removeBtn);
        $(addto).after(newInput);

       // $('#quzlist').after(newInput);
         $('#addmorelist'+(next-1)).after(newInput);

         $(addRemove).after(removeButton);
       


         //console.log(newInput);
         
        
        $("#field" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);

            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#field" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
    });


//question end
 $('.nav li').not('.active').addClass('disabled');
 $('.nav li').not('.active').find('a').removeAttr("data-toggle");
//menu1

$('#step2next').click(function(){
var post_id=$('#qpostid').val();
// var que[]=$('.quz').val();
var quz=[];
var editquz=[];

$('.quz').each(function() { quz.push($(this).val()); });


$('.qzedit').each(function() { 
  //  editquz.push($(this).val()); 
   var editquz=$(this).val();
   var qid=$(this).attr('qid');

 get_white_rice().then(function (rice) {



 $.ajax({
        url: "/employer/job_posts/edit_questionnaire",
        type: "post",
        data: {'post_id':post_id,'editquz':editquz,'white_rice_token':rice,qid:qid},
        success: function (response) {

           // You will get response from your PHP page (what you echo or print)
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });

    })




});


  get_white_rice().then(function (rice) {

 $.ajax({
        url: "/employer/job_posts/add_questionnaire",
        type: "post",
        data: {'post_id':post_id,'quz':quz,'white_rice_token':rice},
        success: function (response) {
  //              Swal.fire(
  // 'success',
  //             );
  //             
 
//step2next
 var allWells = $('.setup-content'),
    allNextBtn = $('.nextBtn');

        allWells.hide();

     $('#step-3').show();
     $('.step2cls').removeClass('btn-wizard');
      $('.step3cls').removeClass('btn-light');
      $('.step3cls').addClass('btn-wizard');


           // You will get response from your PHP page (what you echo or print)
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });

    }).catch(function () {
                HoldOn.close();
                heads_up_warning('Failed to connect server. Please try again or contact support');
                $('#save_post, #save_draft_post').attr('disabled', false);
            })
        });
    })
</script>
