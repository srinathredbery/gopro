<section>
    <div class="block no-padding">
        <div class="container-fluid">
            <div class="row no-gape">

                <!--include side bar for employer-->
                <?php $this->load->view('include/side_bar_left_employer') ?>

                <div class="col-lg-9 column">
                    <div class="padding-left">
                        <div class="manage-jobs-sec pending-approval">
                            <h3>Approved Job Posts - (Choose 3 post for Featured Jobs)</h3>

                            <table id="pending_post_approval" class="table" style="width:100%">
                                <thead>
                                <tr>
<!--                                    <th></th>-->
                                    <th>Title</th>
                                    <th>Job Type</th>
<!--                                    <th>Posted By</th>-->
                                    <th></th>
									<th></th>
									<th></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                if(isset($approved_posts) && !empty($approved_posts)){

                                    foreach ($approved_posts as $post){
                                        if( !empty($post['job_post_job_type'])){
                                            if($post['job_post_job_type']==1)
                                                $job_type_class = 'tp';
                                            elseif($post['job_post_job_type']==2)
                                                $job_type_class = 'fl';
                                            elseif($post['job_post_job_type']==3)
                                                $job_type_class = 'ft';
                                            elseif($post['job_post_job_type']==4)
                                                $job_type_class = 'it';
                                            elseif($post['job_post_job_type']==5)
                                                $job_type_class = 'pt';
                                        }
                                        ?>
                                        <tr data-p_id = <?php echo !empty($post['job_post_id']) ?  $post['job_post_id'] :''?>>
                                            <td>
                                                <div class="c-logo-cus mr-2">
                                                    <img src="<?php echo !empty($post['employer_logo_url']) ? EMP_LOGO_READ_DIR.$post['employer_logo_url'] : DEFAULT_EMP_LOGO ?>" alt="">
                                                </div>
                                                <div class="table-list-title">
                                                    <h3 class="font-weight-bold">
                                                        <a href="<?php echo !empty($post['job_post_id']) ? base_url().'jobs/view_job_post?jp_token='. base64_encode($post['job_post_id']): '' ?>" target="_blank" title="">
                                                            <?php echo !empty($post['job_post_title']) ?  substr($post['job_post_title'], 0, 30) :''?>
                                                        </a>
                                                    </h3>
                                                    <span class="employer-name"><?php echo !empty($post['employer_name']) ? $post['employer_name'] : ''?></span><br/>
                                                    <span><?php echo !empty($post['job_post_posted_date']) ? '<i class="la la-calendar"></i>'.date('dS M Y @ H:m:i', strtotime($post['job_post_posted_date'])) : ''?></span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="job-is <?php echo $job_type_class?>"><?php echo !empty($post['job_type_name']) ?  $post['job_type_name'] :''?></span>
                                            </td>


                                            <td>
													<button class="btn-success  btn-sm apply" style="border-radius: 8px;" value="<?php echo $post['job_post_id'] ?>" ><i class="la la-certificate"></i>  Set as </button>
											</td>
											<td>

<!----------------------------------------------------------------------------View Button--------------------------------------->

												<div class="grid-info-box feature-info-box">
													<span class="job-is <?php echo $job_type_class ?>"><?php echo !empty($job_post['job_type_name']) ? $job_post['job_type_name'] : '' ?></span>
													<?php if (!empty($_SESSION['user_type']) && $_SESSION['user_type'] != 2) {
														?>

														<a href="<?php echo !empty($post['job_post_id']) ? base_url() . 'jobs/view_job_post?jp_token=' . base64_encode($post['job_post_id']) : '' ?>"
														   title="" class="btn-info btn-sm la la-eye">  View</a>
														<?php
													} elseif (!isset($_SESSION['user_type'])) {
														?>

														<a href="<?php echo !empty($post['job_post_id']) ? base_url() . 'jobs/view_job_post?jp_token=' . base64_encode($post['job_post_id']) : '' ?>"
														   title="" class="btn-info btn-sm">View</a>
														<?php
													}
													?>

												</div>
<!---------------------------------------------------End View Button------------------------------------------------------------------>
											</td>
											<td>
												<?php if($post['status']=="Active") { ?>
												   <button class="btn-danger  btn-sm remove"  value="<?php echo $post['job_post_id']?>" style="border-radius: 8px;"><i class="la la-trash"></i>  Remove </button>

												<?php } ?>
                                            </td>

                                        </tr>
                                        <?php
                                    }
                                }
                                ?>

                                </tbody>
                                <tfoot>
                                <tr>
<!--                                    <th></th>-->
                                    <th>Title</th>
                                    <th>Job Type</th>
<!--                                    <th>Posted By</th>-->
<!--                                    <th>Status</th>-->
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="account-popup-area modal-popup-area" id="rejection-comment">
	<div class="account-popup modal-popup resume-modal">
		<span class="close-popup"><i class="la la-close"></i></span>

		<div class="profile-title">
			<h3>Rejection Reasons / Comments</h3>
		</div>
		<form class="" id="post_rejection_form">
			<input type="hidden" name="post_id" id="post_id" value="">
			<div class="resumeadd-form">
				<div class="row">
					<div class="col-lg-12">
						<span class="pf-title">Reason to reject</span>
						<div class="pf-field">
							<textarea name="rejection_comment" id="" cols="30" rows="10"></textarea>
						</div>
					</div>
					<div class="col-lg-12">
						<button id="send_rejection" class="btn-orange col-lg-3 col-md-3 offset-md-9" type="submit">
							Reject
						</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script src="<?php echo base_url()?>assets/custom/su_approvedFeatured.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/custom/su_approve.js<?php echo '?build='.BUILD_NO?>" type="text/javascript"></script>

<script src="<?php echo base_url()?>assets/plugins/datatables/datatables.js" type="text/javascript"></script>

