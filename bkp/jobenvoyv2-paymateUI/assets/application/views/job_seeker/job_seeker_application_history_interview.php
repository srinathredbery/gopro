<section>
    <div class="block no-padding">
        <div class="container">
            <div class="row no-gape">

                <!-- include side bar for jobseeker-->
                <?php $this->load->view('include/side_bar_left_job_seeker')?>

                <div class="col-lg-9 column">
                    <div class="padding-left">
                        <div class="manage-jobs-sec">
                            <h3>Application Interview History</h3>
                            <table>
                                <thead>
                                <tr>
                                    <td width="10%">App. Ref. No</td>
                                    <td width="30%">Applied Job</td>
                                    <td width="25%">Company</td>
                                    <td width="">Date of Apply</td>
                                    <td width="">Status</td>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                if (isset($application_list) && !empty($application_list)){
                                    foreach ($application_list as $application){
                                        ?>
                                        <div href=""></div>
                                        <tr id="<?php echo !empty($application['application_no']) ? 'ap-id-'.$application['application_no'] : '' ?>">
                                            <td>
                                                <div class="table-list-title">
                                                    <h3><a title=""><?php echo !empty($application['application_no']) ? $application['application_no'] : '' ?></a></h3>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="table-list-title">
                                                    <h3><a href="<?php echo !empty($application['job_post_id']) ? base_url().'jobs/view_job_post?jp_token='. base64_encode($application['job_post_id']): '' ?>"  onclick="window.open(this.href,'newwindow', 'width=1300, height=700'); return false;" title=""><?php echo !empty($application['job_post_title']) ? $application['job_post_title'] : '' ?></a></h3>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="table-list-title">
                                                    <i><?php echo !empty($application['employer_name']) ? $application['employer_name'] : '' ?></i><br />
                                                    <span>
                                                        <i class="la la-map-marker"></i>
                                                        <?php echo !empty($application['job_post_city']) ? $application['job_post_city'].'' : '' ?>
                                                        <?php echo !empty($application['CountryDes']) ? ', '.$application['CountryDes'] : '' ?>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <span><?php echo !empty($application['application_date']) ? date( 'M d, Y', strtotime($application['application_date'])) : '' ?></span><br />
                                            </td>

                                            <td class="application-status-tag">
                                                    <span class="application-status applied">

                                                        <?php echo !empty($application['finalized_status']) ? ''.$application['finalized_status'] : '' ?>

                                                    </span>

                                            </td>
<!--                                            <td>-->
<!--                                                --><?php
//                                                if (!empty(!empty($application['is_wd']) && $application['is_wd'] == '1')){
//                                                    ?>
<!--                                                    <ul class="action_job" id="--><?php //echo !empty($application['application_no']) ? 'apl-id-act-'.$application['application_no'] : '' ?><!--">-->
<!--                                                        <li><span>Re-Apply</span><a class="reapply-application" data-apl_id="--><?php //echo !empty($application['application_no']) ? $application['application_no'] : '' ?><!--" title=""><i class="fas fa-share-square" data-apl_id="--><?php //echo !empty($application['application_no']) ? $application['application_no'] : '' ?><!--"></i></a></li>-->
<!--                                                    </ul>-->
<!--                                                    --><?php
//                                                }
//                                                else{
//                                                    ?>
<!--                                                    <ul class="action_job" id="--><?php //echo !empty($application['application_no']) ? 'apl-id-act-'.$application['application_no'] : '' ?><!--">-->
<!--                                                        <li><span>Withdraw Application</span><a class="withdraw-application" data-apl_id="--><?php //echo !empty($application['application_no']) ? $application['application_no'] : '' ?><!--" title=""><i class="fas fa-undo" data-apl_id="--><?php //echo !empty($application['application_no']) ? $application['application_no'] : '' ?><!--"></i></a></li>-->
<!--                                                    </ul>-->
<!--                                                    --><?php
//                                                }
//
//                                                ?>
<!---->
<!--                                            </td>-->
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
