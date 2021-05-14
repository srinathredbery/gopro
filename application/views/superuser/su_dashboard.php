<section>
    <div class="block no-padding">
        <div class="container-fluid">
            <div class="row no-gape">


                <!--include side bar for employer-->
                <?php $this->load->view('include/side_bar_left_employer') ?>

                <div class="col-lg-10 column">
                    <div class="padding-left">
                        <div class="manage-jobs-sec">
                            <h3>Dashboard</h3>

<!--                        Quick Widgets charts-->
                            <div class="extra-job-info col-md-12 mt-0">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="widget-container">
                                            <h6 class="jobseeker chart-title">Widget 1</h6>
                                            <p class="chart-sub-title">Content</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="widget-container">
                                            <h6 class="jobseeker chart-title">Widget 2</h6>
                                            <p class="chart-sub-title">Content</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="widget-container">
                                            <h6 class="jobseeker chart-title">Widget 3</h6>
                                            <p class="chart-sub-title">Content</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="widget-container">
                                            <h6 class="jobseeker chart-title">Widget 4</h6>
                                            <p class="chart-sub-title">Content</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

<!--                        Jobseeker charts-->
                            <!--Jobseeker yearly-->
                            <div class="extra-job-info col-md-6 mt-0">
                                <div class="graph-container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="jobseeker chart-title">Job Seeker Growth</h6>
                                            <p class="chart-sub-title">Yearly</p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="sortby-sec">
                                                <span>Year</span>
                                                <select id="js_grow_chart_year_yearly" data-chart-name="js_grow_chart_year_annual" class="chosen chart_change_year">
                                                    <?php if (isset($year_filter) && !empty($year_filter)) {
                                                        foreach ($year_filter as $value) {
                                                            ?>
                                                            <option id="limit-10" value="<?php echo !empty($value['years']) ? $value['years'] : ''?>"
                                                                <?php echo ($value['years'] == date("Y")) ? 'selected' : ''?>>
                                                                <?php echo !empty($value['years']) ? $value['years'] : ''?>
                                                            </option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 su-chart-container js_grow_chart_year_annual">
                                            <div id="js-user-growth-yearly"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Jobseeker Overall-->
                            <div class="extra-job-info col-md-6 mt-0">
                                <div class="graph-container">
                                    <div class="row">
                                         <div class="col-md-6">
                                            <h6 class="jobseeker chart-title">Job Seeker Growth</h6>
                                             <p class="chart-sub-title">Overall</p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="sortby-sec">
                                                <span>Year</span>
                                                <select id="js_grow_chart_year_overall" data-chart-name="js_grow_chart_year_overall" class="chosen chart_change_year">
                                                    <?php if (isset($year_filter) && !empty($year_filter)) {
                                                        foreach ($year_filter as $value) {
                                                            ?>
                                                            <option id="limit-10" value="<?php echo !empty($value['years']) ? $value['years'] : ''?>"
                                                                <?php echo ($value['years'] == date("Y")) ? 'selected' : ''?>>
                                                                <?php echo !empty($value['years']) ? $value['years'] : ''?>
                                                            </option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 su-chart-container js_grow_chart_year_overall">
                                            <div id="js-user-growth-overall" ></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

<!--                        Employer charts-->
                            <!--Employer yearly-->
                            <div class="extra-job-info col-md-6 mt-0">
                                <div class="graph-container">
                                    <div class="row">
                                         <div class="col-md-6">
                                            <h6 class="employer chart-title">Employer Growth</h6>
                                             <p class="chart-sub-title">Yearly</p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="sortby-sec">
                                                <span>Year</span>
                                                <select id="emp_grow_chart_year_yearly" data-chart-name="emp_grow_chart_year_yearly" class="chosen chart_change_year">
                                                    <?php if (isset($year_filter) && !empty($year_filter)) {
                                                        foreach ($year_filter as $value) {
                                                            ?>
                                                            <option id="limit-10" value="<?php echo !empty($value['years']) ? $value['years'] : ''?>"
                                                                <?php echo ($value['years'] == date("Y")) ? 'selected' : ''?>>
                                                                <?php echo !empty($value['years']) ? $value['years'] : ''?>
                                                            </option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 su-chart-container emp_grow_chart_year_yearly">
                                            <div id="emp-user-growth-yearly"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Employer Overall-->
                            <div class="extra-job-info col-md-6 mt-0">
                                <div class="graph-container">
                                    <div class="row">
                                         <div class="col-md-6">
                                            <h6 class="employer chart-title">Employer Growth</h6>
                                             <p class="chart-sub-title">Overall</p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="sortby-sec">
                                                <span>Year</span>
                                                <select id="emp_grow_chart_year_overall" data-chart-name="emp_grow_chart_year_overall" class="chosen chart_change_year">
                                                    <?php if (isset($year_filter) && !empty($year_filter)) {
                                                        foreach ($year_filter as $value) {
                                                            ?>
                                                            <option id="limit-10" value="<?php echo !empty($value['years']) ? $value['years'] : ''?>"
                                                                <?php echo ($value['years'] == date("Y")) ? 'selected' : ''?>>
                                                                <?php echo !empty($value['years']) ? $value['years'] : ''?>
                                                            </option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 su-chart-container emp_grow_chart_year_overall">
                                            <div id="emp-user-growth-overall"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="extra-job-info col-md-6 mt-0">
                                <div class="graph-container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="job-post chart-title">Job Posts</h6>
                                            <p class="chart-sub-title">Yearly</p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="sortby-sec">
                                                <span>Year</span>
                                                <select id="job_grow_chart_year_yearly" data-chart-name="job_grow_chart_year_yearly" class="chosen chart_change_year">
                                                    <?php if (isset($year_filter) && !empty($year_filter)) {
                                                        foreach ($year_filter as $value) {
                                                            ?>
                                                            <option id="limit-10" value="<?php echo !empty($value['years']) ? $value['years'] : ''?>"
                                                                <?php echo ($value['years'] == date("Y")) ? 'selected' : ''?>>
                                                                <?php echo !empty($value['years']) ? $value['years'] : ''?>
                                                            </option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 su-chart-container job_grow_chart_year_yearly">
                                            <div id="jobs-growth-yearly"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="extra-job-info col-md-6 mt-0">
                                <div class="graph-container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="job-post chart-title">Job Posts</h6>
                                            <p class="chart-sub-title">Overall</p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="sortby-sec">
                                                <span>Year</span>
                                                <select id="job_grow_chart_year_overall" data-chart-name="job_grow_chart_year_overall" class="chosen chart_change_year">
                                                    <?php if (isset($year_filter) && !empty($year_filter)) {
                                                        foreach ($year_filter as $value) {
                                                            ?>
                                                            <option id="limit-10" value="<?php echo !empty($value['years']) ? $value['years'] : ''?>"
                                                                <?php echo ($value['years'] == date("Y")) ? 'selected' : ''?>>
                                                                <?php echo !empty($value['years']) ? $value['years'] : ''?>
                                                            </option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 su-chart-container job_grow_chart_year_overall">
                                            <div id="jobs-growth-overall"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Recent Jobs-->
                            <div class="extra-job-info col-md-12 mt-0">
                                <div class="graph-container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="employer chart-title">New Jobs</h6>
                                             <p class="chart-sub-title">Recently posted jobs</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 info-widget last-5-jobs">
                                            <table class="table table-cus mt-0 ml-0 mb-0" id="last-five-jobs">
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Recent Job Seekers-->
                            <div class="extra-job-info col-md-6 mt-0">
                                <div class="graph-container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="employer chart-title">New Job Seekers</h6>
                                             <p class="chart-sub-title">Recently joined Job Seekers</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 info-widget last-5-jobseekers">
                                            <table class="table table-cus mt-0 ml-0 mb-0" id="last-five-js">
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Recent Employers-->
                            <div class="extra-job-info col-md-6 mt-0">
                                <div class="graph-container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="employer chart-title">New Employers</h6>
                                             <p class="chart-sub-title">Recently joined Employers</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 info-widget last-5-employers">
                                            <table class="table table-cus mt-0 ml-0 mb-0" id="last-five-emp">
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script src="<?php echo base_url()?>assets/plugins/Highcharts-7.1.0/code/highcharts.js" type="text/javascript"></script>
                            <script src="<?php echo base_url()?>assets/plugins/Highcharts-7.1.0/code/modules/series-label.js"></script>
                            <script src="<?php echo base_url()?>assets/plugins/Highcharts-7.1.0/code/modules/exporting.js"></script>
                            <script src="<?php echo base_url()?>assets/plugins/Highcharts-7.1.0/code/modules/offline-exporting.js"></script>
                            <script type="text/javascript" src="<?php echo base_url()?>assets/custom/su_dashboard.js<?php echo '?build='.BUILD_NO?>"></script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
