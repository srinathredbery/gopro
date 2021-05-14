<!--Home Page content-->
<section>
    <div class="block no-padding">
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-featured-sec">
                        <ul class="main-slider-sec text-arrows">
                            <li class="slideHome"><img
                                        src="<?php echo base_url() ?>assets/styles/images/resource/bg3.jpg" alt=""/>
                            </li>
                            <li class="slideHome"><img
                                        src="<?php echo base_url() ?>assets/styles/images/resource/mslider1.jpg"
                                        alt=""/></li>
                            <li class="slideHome"><img
                                        src="<?php echo base_url() ?>assets/styles/images/resource/mslider2.jpg"
                                        alt=""/></li>

                        </ul>
                        <div class="job-search-sec">
                            <div class="job-search">
                                <h3>Find a job that suits you</h3>
                                <span>A world-class Job Search experience</span>
                                <form>
                                    <div class="row">
                                        <div class="col-lg-7 col-md-5 col-sm-5 col-xs-12">
                                            <div class="job-field">
                                                <input type="text" id="job_kw_search_home" name="search_key"
                                                       placeholder="Job title, keywords or company name" >
                                                <i class="la la-keyboard-o"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
                                            <div class="job-field fcountry">
                                                <select id="search_by_country" class="country-search">
                                                    <?php
                                                    if (isset($job_post_country) && !empty($job_post_country)) {
                                                        foreach ($job_post_country as $country) {
                                                            if ($country['countryShortCode']=="LK") {
                                                                ?>

                                                                <option
                                                                    value="<?php echo !empty($country['countryShortCode']) ? $country['countryShortCode'] : '' ?>">
                                                                    <?php echo !empty($country['CountryDes']) ? $country['CountryDes'] : '' ?>
                                                                </option>
                                                                <?php
                                                            }
                                                        }
                                                        foreach ($job_post_country as $country) {
                                                            if ($country['countryShortCode']!="LK") {
                                                                ?>

                                                                <option
                                                                    value="<?php echo !empty($country['countryShortCode']) ? $country['countryShortCode'] : '' ?>">
                                                                    <?php echo !empty($country['CountryDes']) ? $country['CountryDes'] : '' ?>
                                                                </option>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <i class="la la-map-marker"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
                                            <button id="job_kw_search_btn" type="submit"><i class="la la-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <!--                                    <div class="or-browser">-->
                                <!--                                        <span>Or browse job offers by </span>-->
                                <!--                                        <a href="#" title="">category</a>-->
                                <!--                                    </div>-->
                            </div>
                        </div>
                        <div class="scroll-to">
                            <a href="#scroll-here" title=""><i class="la la-arrow-down"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section  id="scroll-here">
    <div class="block block-cus">
        <div class="container">
            <!--Dashboard top ad start-->
            <div class="ad-section">
                <div class="row">
                    <?php if (isset($ads_below_banner_left) && !empty($ads_below_banner_left)) {
                        ?>
                        <div class="col-md-6">
                            <div class="ad-sec-1">
                                <?php if (isset($ads_below_banner_left) && !empty($ads_below_banner_left)) {
                                    foreach ($ads_below_banner_left as $ad) {
                                        ?>
                                        <div>
                                            <div class="image">
                                                <a <?php echo !empty($ad['adv_url']) && !empty($ad['id']) ? 'href="'.ADS_REDIRECT.'?ad_id='.$ad['id'].'&redirect='.$ad['adv_url'].'" target="_blank"' : '' ?>>
                                                    <img src="<?php echo !empty($ad['adv_image_url']) ? ADV_IMG_READ_DIR.$ad['adv_image_url']: '' ?>" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    }?>
                    <?php if (isset($ads_below_banner_right) && !empty($ads_below_banner_right)) {
                        ?>
                        <div class="col-md-6">
                            <div class="ad-sec-1">
                                <?php if (isset($ads_below_banner_right) && !empty($ads_below_banner_right)) {
                                    foreach ($ads_below_banner_right as $ad) {
                                        ?>
                                        <div>
                                            <div class="image">
                                                <a <?php echo !empty($ad['adv_url']) && !empty($ad['id']) ? 'href="'.ADS_REDIRECT.'?ad_id='.$ad['id'].'&redirect='.$ad['adv_url'].'" target="_blank"' : '' ?>>
                                                    <img src="<?php echo !empty($ad['adv_image_url']) ? ADV_IMG_READ_DIR.$ad['adv_image_url']: '' ?>" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    }?>
                </div>
            </div><!--Dashboard top ad end-->

            <div class="row">
                <!--Featured Jobs-->
                <div class="col-lg-9 column">
                    <div class="heading left">
                        <h2>Recent Jobs</h2>
                    </div><!-- Heading -->
                    <div class="job-listings-sec style2">

                        <?php
                        if (!empty($recent_jobs)) {
                            $i=0;
                            foreach ($recent_jobs as $job_post) {
                                $create_date=$job_post['job_post_posted_date'];
                                $end_date=date('Y-m-d', strtotime("+1 months", strtotime($job_post['job_post_posted_date'])));
                                $today=strtotime('today UTC');
                                if (($end_date<$today)) {
                                    if (!empty($job_post['job_post_job_type'])) {
                                        if ($job_post['job_post_job_type'] == 1) {
                                            $job_type_class = 'tp';
                                        } elseif ($job_post['job_post_job_type'] == 2) {
                                            $job_type_class = 'fl';
                                        } elseif ($job_post['job_post_job_type'] == 3) {
                                            $job_type_class = 'ft';
                                        } elseif ($job_post['job_post_job_type'] == 4) {
                                            $job_type_class = 'it';
                                        } elseif ($job_post['job_post_job_type'] == 5) {
                                            $job_type_class = 'pt';
                                        }
                                    }




                                    ?>

<!--                                <a href="#">-->
                                    <div class="job-listing"     <?php
                                                                     echo "style='width: 47%;'";
                                    ?>>
                                        <div class="job-title-sec">
                                            <div class="c-logo"><img
                                                        src="<?php echo isset($job_post['employer_logo_url']) || !empty($job_post['employer_logo_url']) ? EMP_LOGO_READ_DIR . $job_post['employer_logo_url'] : DEFAULT_EMP_LOGO ?>"
                                                        alt=""/></div>
                                            <h3>
                                                <a href="<?php echo !empty($job_post['job_post_id']) ? base_url() . 'jobs/view_job_post?jp_token=' . base64_encode($job_post['job_post_id']) : '' ?>" title="">
                                                    <?php echo !empty($job_post['job_post_title']) ? $job_post['job_post_title'] : '' ?>
                                                </a>
                                            </h3>
                                            <span><?php echo !empty($job_post['employer_name']) ? $job_post['employer_name'] : '' ?></span><br/>
                                            <span class="location-map" style="display: block;padding-top: 8px;"><i class="fa fa-map-marker-alt"></i> <?php echo !empty($job_post['job_post_city']) ? $job_post['job_post_city'] . ', ' . $job_post['CountryDes'] : '' ?></span>
                                        </div>
                                        <?php if (!empty($_SESSION['user_type']) && $_SESSION['user_type'] != 2) {
                                            ?>
                                            <a href="<?php echo !empty($job_post['job_post_id']) ? base_url() . 'jobs/view_job_post?jp_token=' . base64_encode($job_post['job_post_id']) : '' ?>"
                                               title="" class="aply-btn" style="
    margin-top: 10px;
    margin-bottom: 10px;
">
                                                View and Apply
                                            </a>
                                            <?php
                                        } elseif (!isset($_SESSION['user_type'])) {
                                            ?>
                                            <a href="<?php echo !empty($job_post['job_post_id']) ? base_url() . 'jobs/view_job_post?jp_token=' . base64_encode($job_post['job_post_id']) : '' ?>"
                                               title="" class="aply-btn"  style="
    margin-top: 10px;
    margin-bottom: 10px;
">
                                                View and Apply
                                            </a>
                                            <?php
                                        }
                                        ?>

                                        <span class="btn-align-1 job-is <?php echo $job_type_class ?>"  style="
    margin-top: 0 !important;
    margin-right: 0 !important;
"><?php echo !empty($job_post['job_type_name']) ? $job_post['job_type_name'] : '' ?> </span>
                                        <!--                                    <span class="fav-job"><i class="la la-heart-o"></i></span>-->
                                    </div>
<!--                                </a>-->
                                    <?php
                                }

                                $i=$i+1;
                            }
                        }

                        ?>


                    </div>

                    <div class="text-right">
                        <a href="<?php echo base_url().'jobs'?>" class="all-jobs-btn" title="">VIEW ALL JOBS</a>
                    </div>
                </div>
                <?php
/*
                <div class="col-lg-3 column">
                    <div class="heading left">
                        <h2>Featured Jobs</h2>
                    </div><!-- Heading -->
                    <div class="job-grid-sec">
                        <div class="row">

                            <?php
                            if (!empty($featured_jobs)) {
                                foreach ($featured_jobs as $job_post) {
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

                                    <!--                                    <a href="--><?php //echo !empty($job_post['job_post_id']) ? base_url() . 'jobs/view_job_post?jp_token=' . base64_encode($job_post['job_post_id']) : '' ?><!--">-->
                                    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
                                        <div class="job-grid style2">
                                            <div class="job-title-sec">
                                                <div class="c-logo"><img
                                                            src="<?php echo isset($job_post['employer_logo_url']) || !empty($job_post['employer_logo_url']) ? EMP_LOGO_READ_DIR . $job_post['employer_logo_url'] : DEFAULT_EMP_LOGO ?>"
                                                            alt=""/></div>
                                                <h3>
                                                    <a href="<?php echo !empty($job_post['job_post_id']) ? base_url() . 'jobs/view_job_post?jp_token=' . base64_encode($job_post['job_post_id']) : '' ?>"
                                                       title=""><?php echo !empty($job_post['job_post_title']) ? $job_post['job_post_title'] : '' ?></a>
                                                </h3>
                                                <span><?php echo !empty($job_post['employer_name']) ? $job_post['employer_name'] : '' ?></span>
                                            </div>
                                            <span class="job-lctn"><?php echo !empty($job_post['job_post_city']) ? $job_post['job_post_city'] . ', ' . $job_post['CountryDes'] : '' ?></span>
                                            <!--                                    <p>Offer strategic and technical health and nutrition advice to headquarters and field staff, as well as training</p>-->
                                            <div class="grid-info-box feature-info-box">
                                                <span class="job-is <?php echo $job_type_class ?>"><?php echo !empty($job_post['job_type_name']) ? $job_post['job_type_name'] : '' ?></span>
                                                <?php if (!empty($_SESSION['user_type']) && $_SESSION['user_type'] != 2) {
                                                    ?>
                                                    <a href="<?php echo !empty($job_post['job_post_id']) ? base_url() . 'jobs/view_job_post?jp_token=' . base64_encode($job_post['job_post_id']) : '' ?>"
                                                       title="" class="aply-btn">View and Apply</a>
                                                    <?php
                                                } elseif (!isset($_SESSION['user_type'])) {
                                                    ?>
                                                    <a href="<?php echo !empty($job_post['job_post_id']) ? base_url() . 'jobs/view_job_post?jp_token=' . base64_encode($job_post['job_post_id']) : '' ?>"
                                                       title="" class="aply-btn">View and Apply</a>
                                                    <?php
                                                }
                                                ?>
                                                <!--                                                <span class="fav-job"><i class="la la-heart-o"></i></span>-->
                                            </div>
                                        </div><!-- JOB Grid -->
                                    </div>
                                    <!--                                    </a>-->

                                    <?php
                                }
                            }

                            ?>

                            <?php if(isset($ads_mid_page) && !empty($ads_mid_page)) {

                                ?>

                                <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
                                    <!-- ad section -->
                                    <div class="ad-section">
                                        <div class="row">
                                            <div class="col-lg-12 col-12">
                                                <div class="single-ad-place">
                                                    <div class="ad-sec-1 padT25">
                                                        <?php if (isset($ads_mid_page) && !empty($ads_mid_page)) {
                                                            foreach ($ads_mid_page as $ad) {
                                                                ?>
                                                                <div>
                                                                    <div class="image d-flex justify-content-center">
                                                                        <a <?php echo !empty($ad['adv_url']) && !empty($ad['id']) ? 'href="'.ADS_REDIRECT.'?ad_id='.$ad['id'].'&redirect='.$ad['adv_url'].'" target="_blank"' : '' ?>>
                                                                            <img src="<?php echo !empty($ad['adv_image_url']) ? ADV_IMG_READ_DIR . $ad['adv_image_url'] : '' ?>">
                                                                        </a>
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
                                    <!-- ad section -->
                                </div>
                                <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>
                */ ?>
                <div class="col-lg-3 column">
                    <div class="heading left">
                        <h2>Featured Jobs</h2>
                    </div><!-- Heading -->
                    <div class="job-grid-sec">
                        <div class="row">

                            <!--                            / --------------------------Oversiese------------------ */-->

                            <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
                                <div class="job-grid style2">
                                    <div class="job-title-sec">

                                        <div class="row text-center offset-3 col-md-9" ></div>
                                        <div><img style="width: 100%; height: 150px;" src="<?php echo base_url() ?>assets/styles/images/overseas.png" alt=""></div>

                                    </div>
                                    <!--                                    <p>Offer strategic and technical health and nutrition advice to headquarters and field staff, as well as training</p>-->
                                    <div class="grid-info-box feature-info-box">
                                        <a href="overseas_jobs" target="_blank" title="" class="aply-btn">View Jobs</a>
                                    </div>
                                </div><!-- JOB Grid -->
                            </div>

                            <!--                            ------------------------END------------------------------>

                            <?php
                            if (!empty($featured_jobs)) {
                                foreach ($featured_jobs as $job_post) {
                                    if (!empty($job_post['job_post_job_type'])) {
                                        if ($job_post['job_post_job_type'] == 1) {
                                            $job_type_class = 'tp';
                                        } elseif ($job_post['job_post_job_type'] == 2) {
                                            $job_type_class = 'fl';
                                        } elseif ($job_post['job_post_job_type'] == 3) {
                                            $job_type_class = 'ft';
                                        } elseif ($job_post['job_post_job_type'] == 4) {
                                            $job_type_class = 'it';
                                        } elseif ($job_post['job_post_job_type'] == 5) {
                                            $job_type_class = 'pt';
                                        }
                                    }
                                    ?>

                                    <!--                                    <a href="--><?php //echo !empty($job_post['job_post_id']) ? base_url() . 'jobs/view_job_post?jp_token=' . base64_encode($job_post['job_post_id']) : '' ?><!--">-->
                                    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
                                        <div class="job-grid style2">
                                            <div class="job-title-sec">
                                                <div class="c-logo"><img
                                                        src="<?php echo isset($job_post['employer_logo_url']) || !empty($job_post['employer_logo_url']) ? EMP_LOGO_READ_DIR . $job_post['employer_logo_url'] : DEFAULT_EMP_LOGO ?>"
                                                        alt=""/></div>
                                                <h3>
                                                    <a href="<?php echo !empty($job_post['job_post_id']) ? base_url() . 'jobs/view_job_post?jp_token=' . base64_encode($job_post['job_post_id']) : '' ?>"
                                                       title=""><?php echo !empty($job_post['job_post_title']) ? $job_post['job_post_title'] : '' ?></a>
                                                </h3>
                                                <span><?php echo !empty($job_post['employer_name']) ? $job_post['employer_name'] : '' ?></span>
                                            </div>
                                            <span class="job-lctn"><?php echo !empty($job_post['job_post_city']) ? $job_post['job_post_city'] . ', ' . $job_post['CountryDes'] : '' ?></span>
                                            <!--                                    <p>Offer strategic and technical health and nutrition advice to headquarters and field staff, as well as training</p>-->
                                            <div class="grid-info-box feature-info-box">
                                                <span class="job-is <?php echo $job_type_class ?>"><?php echo !empty($job_post['job_type_name']) ? $job_post['job_type_name'] : '' ?></span>
                                                <?php if (!empty($_SESSION['user_type']) && $_SESSION['user_type'] != 2) {
                                                    ?>

                                                    <a href="<?php echo !empty($job_post['job_post_id']) ? base_url() . 'jobs/view_job_post?jp_token=' . base64_encode($job_post['job_post_id']) : '' ?>"
                                                       title="" class="aply-btn">View and Apply</a>
                                                    <?php
                                                } elseif (!isset($_SESSION['user_type'])) {
                                                    ?>

                                                    <a href="<?php echo !empty($job_post['job_post_id']) ? base_url() . 'jobs/view_job_post?jp_token=' . base64_encode($job_post['job_post_id']) : '' ?>"
                                                       title="" class="aply-btn">View and Apply</a>
                                                    <?php
                                                }
                                                ?>
                                                <!--                                                <span class="fav-job"><i class="la la-heart-o"></i></span>-->
                                            </div>
                                        </div><!-- JOB Grid -->
                                    </div>
                                    <!--                                    </a>-->

                                    <?php
                                }
                            }

                            ?>

                            <?php if (isset($ads_mid_page) && !empty($ads_mid_page)) {
                                ?>

                                <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
                                    <!-- ad section -->
                                    <div class="ad-section">
                                        <div class="row">
                                            <div class="col-lg-12 col-12">
                                                <div class="single-ad-place">
                                                    <div class="ad-sec-1 padT25">
                                                        <?php if (isset($ads_mid_page) && !empty($ads_mid_page)) {
                                                            foreach ($ads_mid_page as $ad) {
                                                                ?>
                                                                <div>
                                                                    <div class="image d-flex justify-content-center">
                                                                        <a <?php echo !empty($ad['adv_url']) && !empty($ad['id']) ? 'href="'.ADS_REDIRECT.'?ad_id='.$ad['id'].'&redirect='.$ad['adv_url'].'" target="_blank"' : '' ?>>
                                                                            <img src="<?php echo !empty($ad['adv_image_url']) ? ADV_IMG_READ_DIR . $ad['adv_image_url'] : '' ?>">
                                                                        </a>
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
                                    <!-- ad section -->
                                </div>
                                <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>

<!--                ///////////////////////////////////////-->
            </div>
        </div>
    </div>
</section>

<section id="scroll-here mtu50">
    <div class="block remove-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading">
                        <h2>Categories</h2>
                    </div><!-- Heading -->

                    <!---Popular Categories---->
                    <div class="reviews-sec" id="reviews-carousel2">
                        <?php if (isset($job_category) && !empty($job_category)) {
                            foreach ($job_category as $job_cat) {
                                $tot = get_job_post_count_by_filters(array('job_post_job_category' => $job_cat['id']));
                                if (!empty($tot)) {
                                    if ($job_cat['id'] == 3 || $job_cat['id'] == 21) {
                                        continue;
                                    } else {
                                        ?>
                                        <div class="col-lg-3 col-md-4 col-sm-4  col-12">
                                            <div class="p-category style2 gray">
                                                <a href="<?php echo !empty($job_cat['id']) ? base_url() . 'jobs?cat=' . $job_cat['id'] : '' ?>"
                                                   title="">
                                                    <i class="<?php echo !empty($job_cat['icon']) ? $job_cat['icon'] : 'la la-search' ?>"></i>
                                                    <span><?php echo !empty($job_cat['job_category_name']) ? $job_cat['job_category_name'] : '' ?></span>
                                                    <p style="color: #ff4900">
                                                        <?php echo $tot == 1 ? '(' . $tot . ' open position)' : '(' . $tot . ' open positions)' ?>
                                                    </p>
                                                </a>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                        }
                        ?>
                    </div>
                    <!---Popular Categories---->
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block no-padding">
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div data-velocity="-.1"
                         style="background: url(<?php echo base_url() . 'assets/styles/images/resource/parallax1.jpg' ?>) repeat scroll 50% 422.28px transparent;"
                         class="parallax scrolly-invisible layer blackish"></div><!-- PARALLAX BACKGROUND IMAGE -->
                    <div class="who-am">
                        <h3>I AM RECRUITER!</h3>
                        <p>Are you looking to efficiently and objectively identify top talent?
                            Selection, onboarding and more…
                        </p>
                        <a class="signup-popup emp-tell-us" title="">TELL US</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div data-velocity="-.1"
                         style="background: url(<?php echo base_url() . 'assets/styles/images/resource/parallax2.jpg' ?>) repeat scroll 50% 422.28px transparent;"
                         class="parallax scrolly-invisible layer color green2"></div><!-- PARALLAX BACKGROUND IMAGE -->
                    <div class="who-am flip">
                        <h3>I AM JOBSEEKER!</h3>
                        <p>Connecting great candidates with great jobs has been our passion.
                            Find the world’s Best Jobs with us</p>
                        <a class="signup-popup js-sign-up" title="">SIGN UP</a>
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
                <div class="col-lg-12">
                    <div class="heading">
                        <h2>How It Works</h2>
                        <!--                        <span>Each month, more than 7 million Jobhunt turn to website in their search for work, making over <br />160,000 applications every day.-->
                        <!--                            </span>-->
                    </div><!-- Heading -->
                    <div class="how-to-sec style2 lines">
                        <div class="how-to">
                            <span class="how-icon"><i class="la la-user-plus"></i></span>
                            <h3>Register and Upload Your CV</h3>
                            <p>Sign up as a jobseeker to reach out to the greatest Employers, Attach your own CV or
                                build your CV on our system.</p>
                        </div>
                        <div class="how-to">
                            <span class="how-icon"><i class="la la-bell"></i></span>
                            <h3>Create Your Job Alert</h3>
                            <p>Your Search History will automatically be your Job Alert Agent, sending you the most
                                relevant jobs to your inbox.</p>
                        </div>
                        <div class="how-to">
                            <span class="how-icon"><i class="la la-paper-plane"></i></span>
                            <h3>Apply For Jobs</h3>
                            <p>Click to apply on the Job you have been waiting for and your CV will directly be
                                recommended to the Employer.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block gray" style="min-height: 382px;padding-bottom: 0">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                    <div class="float-right ml-3 ml-md-5">
                        <div class="heading text-left">
                            <h2>Jobs on the go (Coming soon)</h2>
                            <span style="font-size: 17px">Let relevant jobs find you anytime anywhere!</span>
                        </div><!-- Heading -->
                        <div class="stats-sec style2  text-left">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <p style="font-size: 15px">
                                        - Apply for jobs instantly <br>
                                        - Receive feedback immediately<br>
                                        - Chat directly with potential employers<br>
                                    </p>
                                </div>
                            </div>
                            <div class="widget mb-4">
                                <a href="#" title=""><img class="app-badge-mid-section"
                                                          src="<?php echo base_url() . 'assets/styles/images/google-play-badge.png' ?>"
                                                          alt=""/></a>
                                <a href="#" title=""><img class="app-badge-mid-section"
                                                          src="<?php echo base_url() . 'assets/styles/images/app-store-badge.png' ?>"
                                                          alt=""/></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                    <div class="home-mobile-banner">
                        <img src="<?php echo base_url()?>assets/styles/images/mobile_banner.png" alt="" width="300"/>
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
                <div class="col-md-12">
                    <div class="heading left">
                        <h2>Frequently Asked Questions?</h2>
                    </div><!-- Heading -->
                </div>
                <div class="col-lg-6 pr-lg-0 pl-lg-0">

                    <div id="toggle-widget" class="experties">
                        <h2>Login to My Jobseeker Account</h2>
                        <div class="content">
                            <p>
                                1. Press the ‘Sign Up’ button, which is located in the top-right of the page <br>
                                2. A Pop up form will appear <br>
                                3. On top of the form, click on the ‘Jobseeker’ button <br>
                                4. The ‘Jobseeker sign in’ page will now load <br>
                                5. Fill all requested details <br>
                                6. Press the ‘Sign in’ button beneath the password box to complete sign in <br>
                                7. The page you were on before step 1 will now load, and you have successfully logged in
                                to your jobseeker account and take you to complete rest of your profile. <br>
                            </p>
                        </div>
                        <h2>Reset password for my job seeker account because I’ve forgotten it</h2>
                        <div class="content">
                            <p>
                                1. If you’ve forgotten your password for your account, follow the below steps to reset
                                it <br>
                                2. Press the ‘Sign in’ button located at the top of the page <br>
                                3. Press the ‘Forgotten password?’ link, which is located beneath the ‘Password’ box
                                <br>
                                4. The ‘Jobseeker forgotten password’ section of your account will now load <br>
                                5. Select the ‘Email address’ box, then type the email address you used when creating
                                your jobseeker account <br>
                                6. Press the ‘Reset Password’ button <br>
                                7. The confirmation page will now load, and you have successfully requested a password
                                reset <br>
                                8. Go to the inbox for the email address you used when creating your jobseeker account
                                <br>
                                9. Find and open the email with the subject line ‘Details for resetting your password’
                                <br>
                                10. Press the ‘Reset password now’ button inside the email <br>
                                11. The ‘Reset your jobseeker password’ page will now load <br>
                                12. Select the ‘New password’ box, then type your new password <br>
                                13. Select the ‘Confirm new password’ box, then retype your new password <br>
                                14. Press the ‘Reset password’ button <br>
                                15. The confirmation page will now load, and you have successfully reset your password
                                <br>
                            </p>
                        </div>
                        <h2>Upload my new CV</h2>
                        <div class="content">
                            <p>
                                1. You need to be logged into your jobseeker account then follow the below steps to
                                upload a new CV. <br>
                                2. Find your first name located in the top-right of the page, then press it <br>
                                3. A dropdown menu will now appear <br>
                                4. In the dropdown menu, press the ‘My Resume’ button <br>
                                5. The ‘Resume’ section of your jobseeker account will now load <br>
                                6. Press ‘Add New’<br>
                                7. Key in a Resume Name for your CV <br>
                                8. Choose the Option to Build or Upload CV <br>
                                9. Find your MS Word, PDF or Rich Text document from your device, Google Drive,
                                OneDrive, Dropbox or Box <br>
                                10. Follow the instructions on your device, Google Drive, OneDrive, Dropbox or Box to
                                select and upload your chosen MS Word, PDF or Rich Text document <br>
                                11. If you have successfully uploaded your new CV, you will see the message “Uploaded
                                today” in the green box containing your CV file name. <br>
                            </p>
                        </div>
                        <h2>How do I make my profile 100% complete?</h2>
                        <div class="content">
                            <p>
                                1. Having a profile that's 100% complete helps improve your chances of getting a job. If
                                your profile is marked as incomplete, that's most likely because some details are
                                missing from your preferences, work history or education sections. To get your profile
                                to 100%, follow the simple steps below: <br>
                                2. You need to be logged into your jobseeker account then follow the below steps to
                                upload a new CV. <br>
                                3. Click the Profile tab. <br>
                                4. On the overview page of your profile, make sure that your Work
                                Experience/Professional skills/ Education/Awards/Language sections are complete. Click
                                ‘Add’ to add information or make changes. <br>
                            </p>
                        </div>
                        <h2>Create a Job Alert</h2>
                        <div class="content">
                            <p>
                                1. You need to be logged into your jobseeker account then follow the below steps to
                                create a Job Alert <br>
                                2. Find your first name located in the top-right of the page, then press it <br>
                                3. A dropdown menu will now appear <br>
                                4. In the dropdown menu, press the ‘My job alerts’ button <br>
                                5. Your jobseeker account will now load <br>
                                6. Find the ‘Jobs by email’ section of your jobseeker account <br>
                                7. Press ‘Create email alert’ <br>
                                8. The ‘Create Jobs by email’ page will now load <br>
                                9. Select the ‘Keywords’ box, then type a job title, skill or company you’re interested
                                in <br>
                                10. Select the ‘miles of’ box, then type the location you’re interested in (leave blank
                                for all locations) <br>
                                11. Press the ‘Industry/Sector’ dropdown menu, then select the industry or sector you’re
                                interested in (leave on ‘All’ to include all industries and sectors) <br>
                                12. Press ‘Email me jobs like these’ <br>

                            </p>
                        </div>
                    </div>
                </div>

                <?php if (isset($ads_footer) && !empty($ads_footer)) {
                    ?>


                    <!--ad section-->
                    <div class="col-lg-6 padR0 padL0 column bg-1">
                        <div class="single-ad-place">
                            <div class="ad-sec-1">
                                <?php if (isset($ads_footer) && !empty($ads_footer)) {
                                    foreach ($ads_footer as $ad) {
                                        ?>
                                        <div>
                                            <div class="image">
                                                <a <?php echo !empty($ad['adv_url']) && !empty($ad['id']) ? 'href="'.ADS_REDIRECT.'?ad_id='.$ad['id'].'&redirect='.$ad['adv_url'].'" target="_blank"' : '' ?>>
                                                    <img src="<?php echo !empty($ad['adv_image_url']) ? ADV_IMG_READ_DIR . $ad['adv_image_url'] : '' ?>">
                                                </a>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="col-lg-6 padR0 padL0 column bg-1">
                        <div class="pbs-intl">
                            <h3>GoPro Jobs</h3>
                            <p>GoPro Jobs is powered by a team of recruiting industry experts, outstanding engineers,
                                and forward thinking entrepreneurs all unified by a devoted passion: to create an extraordinary talent match experience.</p>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <!--ad section-->
            </div>
        </div>
    </div>
</section>
<div id="scroll-here"></div>

<!--Login pop up-->
<?php $this->load->view('general/login_popup') ?>

<!--Sign up pop up-->
<?php $this->load->view('general/signup_popup') ?>


<!-- Job post banner -->
<div class="account-popup-area modal-popup-area" id="front-page-popup">
    <div class="account-popup full-modal">
        <span class="close-popup one-time-popup"><i class="la la-close"></i></span>
        <div class="profile-form-edit text-center banner-img-set">
<!--            <img src="--><?php //echo IMAGES_READ_DIR.'other/pray_for_sri_lanka.jpg' ?><!--" alt="">-->
        </div>
    </div>
</div>

<style type="text/css">
    .select2-dropdown {
        background-color: rgba(255, 255, 255, 0.71) !important;
    }
</style>
