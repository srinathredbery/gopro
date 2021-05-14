<section>
    <div class="block no-padding">
        <div class="container">
            <div class="row no-gape">

<!--                include side bar for jobseeker-->
                <?php $this->load->view('include/side_bar_left_job_seeker')?>



                <div class="col-lg-9 column">
                    <div class="padding-left">
                        <div class="manage-jobs-sec">
                            <h3>Dashboard</h3>
                            <div class="job-single-head3 emplye employee-head-cus">
                                <div class="cst-cus"><img src="<?php echo isset($js_profile['jobseeker_dp_url']) || !empty($js_profile['jobseeker_dp_url'])? USER_PRO_PIC_READ_DIR.$js_profile['jobseeker_dp_url'] : DEFAULT_PRO_PIC ?>" alt=""></div>
                                <div class="job-single-info3">
                                    <h3>
                                        <?php
                                        if(isset($js_profile['jobseeker_first_name']) && !empty($js_profile['jobseeker_first_name']))
                                            echo $js_profile['jobseeker_first_name'].' ';

                                        if(isset($js_profile['jobseeker_middle_name']) && !empty($js_profile['jobseeker_middle_name']))
                                            echo $js_profile['jobseeker_middle_name'].' ';

                                        if(isset($js_profile['jobseeker_last_name']) && !empty($js_profile['jobseeker_last_name']))
                                            echo $js_profile['jobseeker_last_name'];
                                        ?>
                                    </h3>
                                    <ul class="tags-jobs fx">
                                        <li class=""><i class="la la-profile"></i>
                                            <span><?php echo !empty($current_job['job_title']) ? $current_job['job_title'] : '';?></span>
                                            <?php echo !empty($current_job['company']) ? 'at '.$current_job['company'] : '';?>
                                        </li>
                                    </ul>

                                    <ul class="tags-jobs set-cus-li">
                                        <li><i class="la la-envelope"></i><?php echo !empty($js_profile['email'])? $js_profile['email'] : '' ?></li>
                                        <li><i class="la la-calendar-o"></i> Member Since: <?php echo !empty($js_profile['joined_date'])? date("F d, Y", strtotime($js_profile['joined_date'])) : ''?></li>
                                        <li><i class="la la-map-marker"></i>
                                            <?php
                                                echo !empty($js_profile['jobseeker_city']) ? $js_profile['jobseeker_city'] : '';
                                                echo !empty($js_profile['jobseeker_city'] && $js_profile['jobseeker_country_id']) ? ', ' : '';
                                                echo !empty($js_profile['jobseeker_country_id']) ? get_country($js_profile['jobseeker_country_id']) : '';
                                            ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="cat-sec">
                                <div class="row no-gape">
                                    <div class="col-lg-4 col-md-4 col-sm-12 profile-progress">
                                        <div class="p-category-progress">
                                            <a href="<?php echo base_url().'job_seeker/profile/my_profile'?>" title="">
												<div id="pro-progress"></div>
												<span id="remaining-progress">Complete rest of the %</span>
                                                <p>Improve my profile</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="p-category">
                                            <a href="<?php echo base_url().'job_seeker/job_alerts'?>" title="">
                                                <i class="la la-bullhorn"></i>
                                                <span>Create/Modify Job Alert</span>
                                                <p>View Alerts</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="p-category">
                                            <a href="<?php echo base_url().'job_seeker/applied_jobs'?>" title="">
                                                <i class="la la-history"></i>
                                                <span>My Apply History</span>
                                                <p><?php echo !empty($total_no_application['tot']) ? $total_no_application['tot'] = 1 ? $total_no_application['tot'].' Applications' : $total_no_application['tot'].' Application' : 'No Applications' ?></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

<!--                    <div class="padding-left">-->
<!--                        <div class="rec-jobs-sec">-->
<!--                            <h3>Recomended Jobs</h3>-->
<!--                            <div class="cat-sec">-->
<!--                                <div class="row no-gape">-->
<!---->
<!--                                    <div class="col-md-12 ">-->
<!--                                        <div class="job-list-modern">-->
<!--                                            <div class="job-listings-sec">-->
<!--                                                <div class="job-listing wtabs">-->
<!--                                                    <div class="job-title-sec">-->
<!--                                                        <div class="c-logo"> <img src="http://placehold.it/98x51" alt=""> </div>-->
<!--                                                        <h3><a href="#" title="">Web Designer / Developer</a></h3>-->
<!--                                                        <span>Massimo Artemisis</span>-->
<!--                                                        <div class="job-lhoctn"><i class="la la-map-marker"></i>Sacramento, California</div>-->
<!--                                                    </div>-->
<!--                                                    <div class="job-style-bx">-->
<!--                                                        <span class="job-is ft">Full time</span>-->
<!--                                                        <span class="fav-job"><i class="la la-heart-o"></i></span>-->
<!--                                                        <i>5 months ago</i>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                                <div class="job-listing wtabs">-->
<!--                                                    <div class="job-title-sec">-->
<!--                                                        <div class="c-logo"> <img src="http://placehold.it/98x51" alt=""> </div>-->
<!--                                                        <h3><a href="#" title="">C Developer (Senior) C .Net</a></h3>-->
<!--                                                        <span>Massimo Artemisis</span>-->
<!--                                                        <div class="job-lctn"><i class="la la-map-marker"></i>Sacramento, California</div>-->
<!--                                                    </div>-->
<!--                                                    <div class="job-style-bx">-->
<!--                                                        <span class="job-is pt ">Part time</span>-->
<!--                                                        <span class="fav-job"><i class="la la-heart-o"></i></span>-->
<!--                                                        <i>5 months ago</i>-->
<!--                                                    </div>-->
<!--                                                </div>-->
                                                <!-- Job -->
<!--                                                <div class="job-listing wtabs">-->
<!--                                                    <div class="job-title-sec">-->
<!--                                                        <div class="c-logo"> <img src="http://placehold.it/98x51" alt=""> </div>-->
<!--                                                        <h3><a href="#" title="">Regional Sales Manager South</a></h3>-->
<!--                                                        <span>Massimo Artemisis</span>-->
<!--                                                        <div class="job-lctn"><i class="la la-map-marker"></i>Sacramento, California</div>-->
<!--                                                    </div>-->
<!--                                                    <div class="job-style-bx">-->
<!--                                                        <span class="job-is ft ">Full time</span>-->
<!--                                                        <span class="fav-job"><i class="la la-heart-o"></i></span>-->
<!--                                                        <i>5 months ago</i>-->
<!--                                                    </div>-->
<!--                                                </div> -->
<!-- Job -->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!---->
<!--                            <div class="browse-all-cat mB-40">-->
<!--                                <a href="#" title="">View More</a>-->
<!--                            </div>-->
<!---->
<!--                        </div>-->
<!--                    </div>-->
                </div>

            </div>
        </div>
    </div>
</section>
<style>
	#container {
		margin: 0 auto;
		max-width: 300px;
		min-width: 200px;
		max-height: 300px;
		min-height: 200px;
	}
</style>

<script src="<?php echo base_url()?>assets/plugins/Highcharts-7.1.0/code/highcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/Highcharts-7.1.0/code/highcharts-more.js"></script>
<script src="<?php echo base_url()?>assets/plugins/Highcharts-7.1.0/code/modules/solid-gauge.js"></script>
<script src="<?php echo base_url()?>assets/custom/js_dashboard.js<?php echo '?build='.BUILD_NO?>"></script>
