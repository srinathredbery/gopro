<section>
    <div class="block remove-top">
        <div class="container">
            <div class="row no-gape">

                <!--include side bar for jobseeker-->
                <?php $this->load->view('include/side_bar_left_job_seeker')?>

                <div class="col-lg-9 column">
                    <div class="padding-left">
                        <div class="manage-jobs-sec">
                            <div class="border-title"><h3>Shortlisted jobs</h3></div>
							<?php
							if (isset($saved_jobs) && !empty($saved_jobs)){
								foreach ($saved_jobs as $saved_job) {
									?>
									<div class="job-listing wtabs">
										<div class="job-title-sec">
											<div class="c-logo">
												<img src="<?php echo !empty($saved_job['employer_logo_url']) ?  EMP_LOGO_READ_DIR . $saved_job['employer_logo_url'] : DEFAULT_EMP_LOGO ?>"
													 alt="<?php echo !empty($saved_job['employer_name']) ?  $saved_job['employer_name']: ''?>" />
											</div>
											<h3><a target="_blank" href="<?php echo !empty($saved_job['job_post_id']) ? base_url().'jobs/view_job_post?jp_token='. base64_encode($saved_job['job_post_id']): '' ?>" title="">
													<?php echo !empty($saved_job['job_post_title'])?  $saved_job['job_post_title']: ''?>
												</a></h3>
											<span><?php echo !empty($saved_job['employer_name'])?  $saved_job['employer_name']: ''?></span>
											<div class="job-lctn"><?php echo !empty($saved_job['saved_date'])? date("F d, Y", strtotime( $saved_job['saved_date'])): ''?></div>
										</div>
										<div class="job-list-del"
											 data-jp-token="<?php echo !empty($saved_job['job_post_id']) ? ($saved_job['job_post_id']): '' ?>">
											<a href="#" title="" class="saved-job"><i class="la la-trash-o"></i></a>
										</div>
									</div>
									<?php
								}
							}
							?>
                            <div class="pagination">
								<?php echo isset($pagination) && !empty($pagination) ? $pagination : ''; ?>
                            </div><!-- Pagination -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
