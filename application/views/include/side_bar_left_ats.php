<aside class="<?php echo $_SESSION['user_type']==1 || $_SESSION['user_type']==2 ? 'col-lg-2' : 'col-lg-3' ?> column border-right">
    <div class="widget">
        <div class="tree_widget-sec">

            <div class="text-center" style="border-bottom: 1px solid #edeff7;">
                <h1>ATS</h1>
            </div>
            <ul class="inner-child nav-status" style=" padding-top: 20px;">
                <li class="">
                    <a class="nav-main" href="<?php echo base_url()?>employer/job_posts/ats_post_job">
                        <i class="la la-briefcase"></i>Job and Application</a>
                </li>
            <li class="inner-child nav-status">
                <a class="nav-main">
                    <i class="la la-file-text-o "></i>Exam</a>
                <ul style="display: none;">
                    <li class="">
                        <a class="nav-sub" href="<?php echo base_url()?>employer/job_posts/ats_setup_exam">
                            Set up Exam                                                 </a>
                    </li>

                    <li class="">
                        <a class="nav-sub" href="<?php echo base_url()?>employer/job_posts/ats_setup_exam_maker_result">
                            Result                                           </a>
                    </li>

                </ul>
            </li>
                <li class="inner-child nav-status">
                    <a class="nav-main">
                        <i class="la la-slideshare"></i>Interviews</a>
                    <ul style="display: none;">
                        <li class="">

                            <a class="nav-sub" href="<?php echo base_url()?>employer/job_posts/ats_Interviewee">
                                Interviewee                                            </a>
                        </li>

                        <li class="">
                            <a class="nav-sub" href="<?php echo base_url()?>employer/job_posts/ats_interviewee_list">
                                Interviewer List                                          </a>
                        </li>
                        <li class="">
                            <a class="nav-sub" href="<?php echo base_url()?>employer/job_posts/ats_interviewee_form">
                                Interview Form                                   </a>
                        </li>
                        <li class="">
                            <a class="nav-sub" href="<?php echo base_url()?>employer/job_posts/ats_interviewee_form_details">
                                Interview Details                                 </a>
                        </li>
                        <li class="">
                            <a class="nav-sub" href="<?php echo base_url()?>employer/job_posts/ats_interviewee_offer_latter">
                                Create Offer Letter                         </a>
                        </li>
                        <li class="">
                            <a class="nav-sub" href="<?php echo base_url()?>employer/job_posts/ats_result">
                                Result                               </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>


</aside>
