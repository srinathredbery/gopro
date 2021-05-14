<style type="text/css" >
    .inner-header {
        background-image: url('/assets/styles/images/resource/job.png');
        background-repeat: no-repeat;
        background-size: cover;
    }
    .badge {
   
    margin-left: 2px !important;
}
.badge-info {
    color: #1EAAE7;
   
}
.bootstrap-tagsinput .badge {
    margin: 2px 0;
    padding: 5px 8px;
    border-radius: 5px;
   
    border: dashed #1EAAE7 1px;
    padding: 2px 3px;
    margin: 2px;
    font-size: 12px;
}
.badge-info {
  
    background-color: #fff !important;
}
.help-block{
    display: none !important;
}
</style>


<script src="/assets/tagsinput.js"></script>
<link rel="stylesheet" href="/assets/tagsinput.css">







<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0"></script>
<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url(<?php echo !empty($job_post['employer_cover_pic_url'])? EMP_COVER_PIC_READ_DIR.$job_post['employer_cover_pic_url']: '' ?>) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div><!-- PARALLAX BACKGROUND IMAGE -->
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
<?php $page_url =  (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>

<?php
if (!empty($job_post['job_post_job_type'])) {
    if ($job_post['job_post_job_type']==1) {
        $job_type_class = 'tp';
    } elseif ($job_post['job_post_job_type']==2) {
        $job_type_class = 'fl';
    } elseif ($job_post['job_post_job_type']==3) {
        $job_type_class = 'ft';
    } elseif ($job_post['job_post_job_type']==4) {
        $job_type_class = 'it';
    } elseif ($job_post['job_post_job_type']==5) {
        $job_type_class = 'pt';
    }
}
?>
<?php
if (isset($job_already_applied_status) && !empty($job_already_applied_status)) {
    ?>
    <section>
        <div class="job-applied-message-banner">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <span class="job-applied-message-icon"><i class="fas fa-info-circle"></i></span>
                        <p>
                            You have already applied for this job <b><span class="applied-days"> </span></b> on <b><?php echo !empty($job_already_applied_status['application_date']) ? date('d M Y', strtotime($job_already_applied_status['application_date'])) : ''?></b>
                        </p>
                        <script>
                            var applied_since = "<?php echo !empty($job_already_applied_status['application_date']) ? $job_already_applied_status['application_date'] : '' ?>";
                            $('.applied-days').text(moment(applied_since, "YYYY-MM-DD hh:mm:ss").fromNow());
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}
?>

<section>
    <div class="block">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 column">
                    <div class="job-single-sec">
                        <div class="job-single-head2">
                            <div class="job-title2"
                                 data-jp-token="<?php echo !empty($job_post['job_post_id']) ? ($job_post['job_post_id']): '' ?>"
                                 data-liked="<?php echo !empty($job_post['job_post_id']) ? ($job_post['job_post_id']): '' ?>">
                                <h3><?php echo isset($job_post) && !empty($job_post['job_post_title']) ? $job_post['job_post_title']: ''?></h3>
                                <span class="job-is <?php echo $job_type_class?>"><?php echo !empty($job_post['job_type_name']) ? $job_post['job_type_name']: ''?></span>
                                <span class="fav-job save-fav-job pl-3 pt-1 <?php echo !empty($job_post['saved_job'])? 'active' : ''; ?>" title="Save Favorite">
                                    <i class="<?php echo !empty($job_post['saved_job'])? "fas" : 'far'; ?> fa-heart"></i>
                                </span>
                            </div>
                            <ul class="tags-jobs">
                                <li><i class="la la-map-marker"></i><?php echo !empty($job_post['job_post_city']) ? $job_post['job_post_city'].', '.$job_post['CountryDes']: ''?></li>
<!--                                <li><i class="la la-money"></i> Monthly Salary : <span>--><?php //echo !empty($job_post['salary_range']) ? $job_post['salary_range']. date_default_timezone_get() : ''?><!--</span></li>-->
                                <li><i class="la la-calendar-o"></i> Post Date: <?php echo !empty($job_post['job_post_posted_date']) ? date('D, d-M-Y  H:i', strtotime($job_post['job_post_posted_date'])): ''?></li>
                            </ul>
                            <?php if (isset($job_skill_req) && !empty($job_skill_req)) {
                                ?>
                                <span>
                                <strong>Key Skills</strong> :
                                <?php if (isset($job_skill_req) && !empty($job_skill_req)) {
                                    foreach ($job_skill_req as $skill) {
                                        ?>
                                        <span class="job-skill-tag">
                                            <?php echo $skill['job_post_skill_tag'];?>
                                        </span>
                                        <?php
                                    }
                                }
                                ?>
                                </span>
                                <?php
                            }
                            ?>
                        </div><!-- Job Head -->

                        <div class="sec-job-des">
                            <div class="job-details">
                                 <h3>Job Description</h3>                            
                                 <?php echo !empty($job_post['job_post_description']) ? $job_post['job_post_description']: ''?>
                            </div>

                            <?php if (!empty($job_post['job_post_img_url'])) { ?>
                            <div class="relevent-job-banner">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="view-banner-img">
                                            <a id="job-view-image" >

                                                <?php if (!empty($job_post['job_post_img_url'])) {
                                                    $f = JOB_POST_IMG_SAVE_DIR.urlencode($job_post['job_post_img_url']);
                                                    $type =  mime_content_type($f);
                                                    if ($type == "application/pdf") {
                                                        ?>
                                                        <!--                    <img src="--><?php //echo !empty($job_post['job_post_img_url']) ? JOB_POST_IMG_READ_DIR . $job_post['job_post_img_url'] : '' ?><!--">-->
                                                        <embed src="<?php echo !empty($job_post['job_post_img_url']) ? JOB_POST_IMG_READ_DIR . $job_post['job_post_img_url'] : '' ?>" type="application/pdf"   height="150" width="100">
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <img width="150" height="100" src="<?php echo JOB_POST_IMG_READ_DIR.$job_post['job_post_img_url'] ?>" alt="" >
                                                        <?php
                                                    }
                                                }
                                                ?>

<!--                                                <img width="150" height="100" src="--><?php //echo JOB_POST_IMG_READ_DIR.$job_post['job_post_img_url'] ?><!--" alt="" >-->
                                            </a>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                                <?php
                            }
                            ?>
                        </div>

                        <div class="job-overview">
                            <h3>Job Overview</h3>
                            <ul>
                                <li><i class="la la-money"></i><h3>Offerd Salary</h3>
                                    <span>
                                        <?php echo isset($job_post) && !empty($job_post['job_post_salary_currency']) ? get_currency_iso_code($job_post['job_post_salary_currency']).' ': ''?>
                                        <?php echo isset($job_post) && !empty($job_post['job_post_salary_min']) ? number_format($job_post['job_post_salary_min']): ''?>
                                        <?php echo isset($job_post) && !empty($job_post['job_post_salary_min']) ? ' - '.number_format($job_post['job_post_salary_max']): ''?>
                                    </span>
                                </li>
                                <li><i class="la la-genderless"></i><h3>Gender</h3><span><?php echo !empty($job_post['job_post_gender']) ? $job_post['job_post_gender']: ''?></span></li>
                                <li><i class="la la-thumb-tack"></i><h3>Career Level</h3><span><?php echo !empty($job_post['career_level_name']) ? $job_post['career_level_name']: ''?></span></li>
                                <li><i class="la la-puzzle-piece"></i><h3>Industry</h3><span><?php echo !empty($job_post['job_category_name']) ? $job_post['job_category_name']: ''?></span></li>
                                <li><i class="la la-shield"></i><h3>Experience</h3>
                                    <span>
                                        <?php echo !empty($job_post['job_post_experience_min']) && $job_post['job_post_experience_min'] > 1  ? $job_post['job_post_experience_min'].' years' : ''?>
                                        <?php echo !empty($job_post['job_post_experience_min']) && $job_post['job_post_experience_min'] <= 1  ? $job_post['job_post_experience_min'].' year' : ''?>
                                        <?php echo !empty($job_post['job_post_experience_max']) ? ' - '.$job_post['job_post_experience_max']. ' years' : ''?>
                                    </span>
                                </li>
                                <li><i class="la la-line-chart "></i><h3>Qualification</h3><span><?php echo !empty($job_post['education_level_name']) ? $job_post['education_level_name']: ''?></span></li>
                            </ul>
                        </div><!-- Job Overview -->
                        <div class="share-bar">
                            <span class="">Share </span>
                            <!--Facebook-->
                            <div class="row">
                                <div class="mr-0">
                                    <div class="fb-share-button"
                                         data-href="<?php echo $page_url; ?>"
                                         data-layout="button" data-size="small">
                                        <a target="_blank"
                                           href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
                                           class="fb-xfbml-parse-ignore">Share</a></div>
                                </div>
                                <!--Twitter-->
                                <div class="mr-3">
                                    <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button"
                                       data-text="" data-via="RbJobs" data-hashtags="jobs" data-related=""
                                       data-show-count="false">Tweet</a>
                                    <script async src="https://platform.twitter.com/widgets.js"
                                            charset="utf-8"></script>
                                </div>
                                <!--LinkedIn-->
                                <div class="mr-2">
                                    <script src="https://platform.linkedin.com/in.js"
                                            type="text/javascript">lang: en_US</script>
                                    <script type="IN/Share"
                                            data-url="<?php echo $page_url; ?>"></script>
                                </div>
                                <div class="mr-2">
                                    <a class="share-whatsapp " target="_blank"
                                       href='https://api.whatsapp.com/send?text=Here is a job that might be interesting for you from RbJobs: %0D%0A*<?php echo isset($page_title)? $page_title : " ";?>* %0D%0A <?php echo $page_url; ?>' data-action="share/whatsapp/share"><i class="fab fa-whatsapp"></i> Send</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 column">
                    <div class="job-single-head style2">
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12 column">
                                <a href="<?php echo base_url() . 'employer/company/view?org='.base64_encode($job_post['job_post_employer_id']) ?>">
                                    <img class="job-post-employer-logo"
                                         src="<?php echo isset($job_post['employer_logo_url']) || !empty($job_post['employer_logo_url']) ? EMP_LOGO_READ_DIR . $job_post['employer_logo_url'] : DEFAULT_EMP_LOGO ?>">
                                </a>
                            </div>
                        </div>


                        <div class="job-head-info">
                            <h4>
                                <a href="<?php echo base_url() . 'employer/company/view?org='.base64_encode($job_post['job_post_employer_id']) ?>"><?php echo !empty($job_post['employer_name']) ? $job_post['employer_name'] : '' ?>
                            </h4>
                        </div>

                        <?php
                        if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 2) {
                        } else {
                            ?>
                            <a title="" class="apply-job-btn" id="apply-job-btn"><i class="la la-paper-plane"></i>Apply for this job</a>
<!--                            <a title="" class="apply-job-linkedin"><i class="la la-linkedin"></i>Apply with Linkedin</a>-->
                            <?php
                        }
                        ?>

                        <a href="<?php echo base_url() . 'employer/company/view?org='.base64_encode($job_post['job_post_employer_id']) ?>" title="" class="viewall-jobs">View all Jobs</a>

                    </div><!-- Job Head -->
                </div>
            </div>
        </div>
    </div>
</section>

<!--Login pop up-->
<?php $this->load->view('general/login_popup')?>

<!--Sign up pop up-->
<?php $this->load->view('general/signup_popup')?>

<!--Modal-->

<!-- Job post banner -->
<div class="account-popup-area modal-popup-area" id="job-post-banner">
    <div class="account-popup full-modal">
        <span class="close-popup"><i class="la la-close"></i></span>

        <div class="profile-form-edit text-center banner-img-set">
            <?php if (!empty($job_post['job_post_img_url'])) {
                $type =  mime_content_type(JOB_POST_IMG_SAVE_DIR.urlencode($job_post['job_post_img_url']));
                if ($type == "application/pdf") {
                    ?>
<!--                    <img src="--><?php //echo !empty($job_post['job_post_img_url']) ? JOB_POST_IMG_READ_DIR . $job_post['job_post_img_url'] : '' ?><!--">-->
                    <embed src="<?php echo !empty($job_post['job_post_img_url']) ? JOB_POST_IMG_READ_DIR . $job_post['job_post_img_url'] : '' ?>" type="application/pdf"   height="600px" width="100%" class="responsive">
                    <?php
                } else {
                    ?>
                    <img src="<?php echo !empty($job_post['job_post_img_url']) ? JOB_POST_IMG_READ_DIR . $job_post['job_post_img_url'] : '' ?>">
                    <?php
                }
            }
            ?>
        </div>

    </div>
</div>
<!--  Job post banner -->

<div class="account-popup-area modal-popup-area apply-job-modal" id="job-application-form">
    <div class="account-popup apply-job-popup">
        <span class="close-popup"><i class="la la-close"></i></span>

        <div class="profile-title">
            <h3 >Apply for Job : <?php echo isset($job_post) && !empty($job_post['job_post_title']) ? $job_post['job_post_title']: ''?></h3>
            <p>at <?php echo !empty($job_post['employer_name']) ? $job_post['employer_name'] : ''?> </p>
        </div>

        <div class="profile-form-edit">
            <form id="job_apply_form" data-bv-onerror="onFormError">
                <input type="text" id="" class="d-none-cus" name="job_post_id" value="<?php echo isset($job_post) && !empty($job_post['job_post_id']) ? $job_post['job_post_id']: ''?>">
                <div class="row">
                    <div class="col-lg-6">
                        <span class="pf-title">Select Your Resume <span class="required-label">*</span></span>
                        <div class="pf-field">
                            <select name="applied_resume" id="resume_to_apply" data-placeholder="Select your resume to attach..." class="chosen">
                            </select>
                        </div>
                        <div class="application-date-info d-none-cus" id="resume-date-info">
                            <p><i class="far fa-calendar-plus"></i> Added: <span id="rs-add-date"></span></p>
                            <p><i class="far fa-calendar-check"></i> Updated: <span  id="rs-upd-date"></span> </p>
                            <a class="float-left modify-resume-cover-button" id="preview-resume-button" style="margin-top:10px"><span><i class="la la-eye"></i></span> View selected resume</a>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <span class="pf-title">Select Your Cover letter</span>
                        <div class="pf-field">
                            <select name="applied_cover_letter" id="cover_letter_to_apply" data-placeholder="Select your cover letter to attach..." class="chosen">
                            </select>
                        </div>
                        <div class="application-date-info d-none-cus" id="cover-letter-date-info">
                            <p><i class="far fa-calendar-plus"></i> Added: <span id="cl-add-date"></span></p>
                            <p><i class="far fa-calendar-check"></i> Updated: <span  id="cl-upd-date"></span> </p>
                            <a class="float-left modify-resume-cover-button" id="preview-cover-letter-button" style="margin-top:10px"><span><i class="la la-edit"></i></span> View/modify selected cover letter</a>
                        </div>
                    </div>

                    <div class="col-lg-12 d-none-cus" id="cover-letter-application-editor">
                        <span class="pf-title">Cover Letter</span>
                        <div class="pf-field">
                            <textarea name="cover_letter_content" id="apply-cover_letter_content"></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-12 mb-2" class="col-md-12 mb-2 cl-file d-none-cus" id="cover_data"  style="display: none;" >

                    </div>


  <div class="col-lg-12 " id="quz">
    <?php    if (count($job_questionnaire) >0) { ?>
        <span class="pf-title"><h5>Job Questionnaire</h5></span>
    <?php } ?>
  </div>

  <div class="col-lg-12 ">
    <ul>
        <?php
          //  echo var_dump($job_questionnaire);
        if (count($job_questionnaire) >0) {
            $i=1;
            foreach ($job_questionnaire as $key => $value) {
                echo '<div><li style="font-size: 13px;"> <span class="pf-title">('.$i.') '.ucwords($value['question']).'</span>
					<input type="radio" value="1" name="quz['.$key.']" style="position: inherit;opacity: 1;z-index: 1;" required> Yes <br/>
					<input type="radio" value="0" name="quz['.$key.']" style="position: inherit;opacity: 1;z-index: 1; font-size: 13px;" > No <br/>
					<span></span>
				</li></div>';

                $i=$i+1;
            }
        }
        ?>
    </ul>

<!-- <strong>My Skills</strong> :<br/><small>(Please remove unrelated skills.and add new adding comma after new skill)</small>-->

    <?php
    // $sk='';

    // if (isset($job_skill_req) && !empty($job_skill_req)) {
    //     foreach ($job_skill_req as $skill) {
    //         $sk.= $skill['job_post_skill_tag'].',';
    //     }
    // }

    // $sk=rtrim($sk, ',');
    ?>
<!-- <input type="text" data-role="tagsinput" value="<?php echo $sk; ?>"> -->
    <?php
/*

if (count($my_skills) >0) {
    foreach ($my_skills as $key => $value) {
        echo '<span class="job-skill-tag"><span> '.$value['skill'].' </span></span>';
        ?>


<input type="hidden" value="<?php echo $value['skill']; ?>" name="skill[]">
        <?php
    }
} else {
    echo '<span class="job-skill-tag"><span> N/A </span></span>';
    ?>
    <input type="hidden" value="" name="skill[]">
    <?php
}

*/
    ?>

  </div>

  <div class="col-lg-12">
      <strong>My Skills</strong> :<br/><small>(Please remove unrelated skills.)</small>

  <?php
    $sk='';
    $sk2='';
    $freetags=array();
    if (isset($job_skill_req) && !empty($job_skill_req)) {
        foreach ($job_skill_req as $skill) {
            $sk.= $skill['job_post_skill_tag'].',';

            $sk2.='"'.$skill['job_post_skill_tag'].'",';
            array_push($freetags, $skill['job_post_skill_tag']);
        }
    }

    $sk=rtrim($sk, ',');
        $sk2=rtrim($sk2, ',');
    ?>

<input type="text"  value="<?php echo $sk; ?>" id="removeonlyinput" name="skills" data-role="tagsinput">

<script>
// $('#removeonlyinput').on('beforeItemAdd', function(event) {
//   event.cancel = true;
// });
// 
$(document).ready(function(){
//   $('#removeonlyinput').tagsinput({
//   typeahead: {
//     source: [<?php echo $sk2; ?>]
//   },
//   freeInput: false
// });


$('#removeonlyinput').on('beforeItemAdd', function(event) {
  event.cancel = true;
});



//$( "#removeonlyinput" ).prop( "disabled", true );





});
</script>


<?php
/*

if (count($my_skills) >0) {
    foreach ($my_skills as $key => $value) {
        echo '<span class="job-skill-tag"><span> '.$value['skill'].' </span></span>';
        ?>


<input type="hidden" value="<?php echo $value['skill']; ?>" name="skill[]">
        <?php
    }
} else {
    echo '<span class="job-skill-tag"><span> N/A </span></span>';
    ?>
    <input type="hidden" value="" name="skill[]">
    <?php
}

*/
?>

  </div>
                    <div class="col-md-12">
                        <button class="btn-orange" id="apply_for_this_job" style="margin-top:10px">Apply</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="account-popup-area modal-popup-area resume-preview-modal" id="resume-review-modal">
    <div class="account-popup resume-preview-popup">
        <span class="close-popup"><i class="la la-close"></i></span>

            <div class="block remove-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cand-details-sec">
                                <div class="row">
                                    <div class="col-lg-12 column">
                                        <div class="cand-details about" id="about">
                                            <h2>Candidates About</h2>
                                            <p id="abount_content"></p>
                                        </div>

                                        <div class="border-title work-exp"><h6>Work Experience</h6></div>
                                        <div class="edu-history-sec resume-section work-exp" id="work-exp-sec">
                                            <!--Content goes here-->
                                        </div>

                                        <div class="border-title pro-skill"><h6>Professional Skills</h6></div>
                                        <div class="progress-sec resume-sec pro-skill" id="pro-skill-sec">
                                            <!--Content goes here-->
                                        </div>

                                        <div class="border-title edu"><h6>Education</h6></div>
                                        <div class="edu-history-sec resume-sec edu" id="edu-sec">
                                            <!--Content goes here-->
                                        </div>

                                        <div class="border-title award"><h6>Awards</h6></div>
                                        <div class="edu-history-sec resume-sec award" id="award-sec">
                                            <!--Content goes here-->
                                        </div>

                                        <div class="border-title lang"><h6>Language</h6></div>
                                        <div class="edu-history-sec resume-sec lang" id="lang-sec">
                                            <!--Content goes here-->
                                        </div>
                                        <div class="border-title"><h6>Attach Resume</h6></div>
                                        <div class="edu-history-sec resume-sec attc" id="lang-skill-sec">

                                            <div class="row">
                                                <?php if (isset($resume_data) && !empty($resume_data['resume_attachment'])) {
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
                                                                <?php if (!empty($resume_data['resume_attachment'])) {
                                                                    $file = pathinfo(JOB_SEEKER_RESUME_READ_DIR.$resume_data['resume_attachment'], PATHINFO_EXTENSION);
                                                                    if ($file === "pdf") {
                                                                        ?>
                                                                        <i class="far fa-file-pdf" style="font-size: 36px;"></i>
                                                                        <?php
                                                                    } elseif ($file === "doc" || $file === "docx") {
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
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        // $('.help-block').attr('style',"disply:none !important"); 

        $('#apply-job-btn').click(function(){
         //   $('.help-block').attr('style',"disply:none !important"); 
        })
    })
</script>
