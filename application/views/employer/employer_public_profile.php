<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url(<?php echo !empty($company['employer_cover_pic_url'])? EMP_COVER_PIC_READ_DIR.$company['employer_cover_pic_url']: '' ?>) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div><!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3><?php echo !empty($company['employer_name']) ? $company['employer_name'] : ''?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 column">
                    <div class="job-single-sec style3">
                        <div class="job-head-wide">
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="job-single-head3 emplye">
                                        <div class="job-thumb"> <img src="<?php echo isset($company['employer_logo_url']) || !empty($company['employer_logo_url']) ? EMP_LOGO_READ_DIR . $company['employer_logo_url'] : DEFAULT_EMP_LOGO ?>" alt="" /></div>
                                        <div class="job-single-info3">
                                            <h3><?php echo !empty($company['employer_name']) ? $company['employer_name'] : ''?></h3>
                                            <span>
                                                <i class="la la-map-marker"></i>
                                                <?php
                                                echo !empty($company['employer_city']) ? $company['employer_city'] : '';
                                                echo !empty($company['employer_city'] && $company['CountryDes']) ? ', ' : '';
                                                echo !empty($company['CountryDes']) ? $company['CountryDes'] : '';
                                                ?>
                                            </span>
                                            <ul class="tags-jobs">
                                                <?php if (!empty($company['employer_est_date'])){?>
                                                <li><i class="la la-file-text"></i> Established: <?php echo !empty($company['employer_est_date'])? $company['employer_est_date'] : ''?></li>
                                                <?php }?>
<!--                                                <li><i class="la la-calendar-o"></i> Post Date: July 29, 2017</li>-->
<!--                                                <li><i class="la la-eye"></i> Views 5683</li>-->
                                            </ul>
                                        </div>
                                    </div><!-- Job Head -->
                                </div>
                            </div>
                        </div>


                        <div class="job-wide-devider">
                            <div class="row">
                                <div class="col-lg-8 column">
                                    <div class="job-details">
                                        <h3>About <?php echo !empty($company['employer_name']) ? $company['employer_name'] : ''?></h3>
                                        <p><?php echo !empty($company['employer_about_us']) ? $company['employer_about_us'] : 'Not available'?></p>
                                    </div>
                                    <div class="recent-jobs recent-jobs-section">
                                        <h3>Recent Jobs from <?php echo !empty($company['employer_name']) ? $company['employer_name'] : ''?></h3>
                                        <div class="job-list-modern">
                                            <div class="job-listings-sec no-border">

                                                <?php
                                                    if (!empty($job_list)) {
                                                        foreach ($job_list as $job_post) {
                                                            if (!empty($job_post['job_post_job_type'])) {
                                                                if ($job_post['job_post_job_type'] == 1)
                                                                    $job_type_class = 'tp';
                                                                elseif ($job_post['job_post_job_type'] == 2)
                                                                    $job_type_class = 'fl';
                                                                elseif ($job_post['job_post_job_type'] == 3)
                                                                    $job_type_class = 'ft';
                                                                elseif ($job_post['job_post_job_type'] == 4)
                                                                    $job_type_class = 'it';
                                                                elseif ($job_post['job_post_job_type'] == 5)
                                                                    $job_type_class = 'pt';
                                                            }
                                                            ?>

                                                            <a href="<?php echo !empty($job_post['job_post_id']) ? base_url().'jobs/view_job_post?jp_token='. base64_encode($job_post['job_post_id']): '' ?>" title="">
                                                                <div class="job-listing wtabs noimg">
                                                                    <div class="job-title-sec">
                                                                        <h3><?php echo !empty($job_post['job_post_title']) ? $job_post['job_post_title']: ''?></h3>
                                                                        <span><?php echo !empty($job_post['employer_name']) ? $job_post['employer_name']: ''?></span>
                                                                        <div class="">
                                                                            <span class="location-map">
                                                                                <i class="fa fa-map-marker-alt"></i>
                                                                                <?php
                                                                                echo !empty($job_post['job_post_city']) ? $job_post['job_post_city'] : '';
                                                                                echo !empty($job_post['job_post_city'] && $job_post['CountryDes']) ? ', ' : '';
                                                                                echo !empty($job_post['CountryDes']) ? $job_post['CountryDes'] : '';
                                                                                ?>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="job-style-bx">
                                                                        <span class="job-is <?php echo $job_type_class?>"><?php echo !empty($job_post['job_type_name']) ? $job_post['job_type_name']: ''?></span>
                                                                        <span class="fav-job" title="Save Favorite"><i class="far fa-heart"></i></span>
                                                                        <i>
                                                                            <span id="post-time-<?php echo !empty($job_post['job_post_id']) ? $job_post['job_post_id']: '' ?>" title="<?php echo !empty($job_post['job_post_posted_date']) ? date( "d M Y, H:i" , strtotime($job_post['job_post_posted_date'])): '' ?>"></span>
                                                                        </i>
                                                                    </div>
                                                                </div>
                                                            </a>

                                                            <?php
                                                        }
                                                    }
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

<!--                                <div class="col-lg-4 column">-->
<!--                                    <div class="job-overview">-->
<!--                                        <h3>Company Information</h3>-->
<!--                                        <ul>-->
<!--                                            <li><i class="la la-eye"></i><h3>Viewed </h3><span>164</span></li>-->
<!--                                            <li><i class="la la-file-text"></i><h3>Posted Jobs</h3><span>4</span></li>-->
<!--                                            <li><i class="la la-map"></i><h3>Locations</h3><span>United States, San Diego</span></li>-->
<!--                                            <li><i class="la la-bars"></i><h3>Categories</h3><span>Arts, Design, Media</span></li>-->
<!--                                            <li><i class="la la-clock-o"></i><h3>Since</h3><span>2002</span></li>-->
<!--                                            <li><i class="la la-users"></i><h3>Team Size</h3><span>15</span></li>-->
<!--                                            <li><i class="la la-user"></i><h3>Followers</h3><span>15</span></li>-->
<!--                                        </ul>-->
<!--                                    </div>-->
<!--                                </div>-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Login pop up-->
<?php $this->load->view('general/login_popup')?>

<!--Sign up pop up-->
<?php $this->load->view('general/signup_popup')?>
