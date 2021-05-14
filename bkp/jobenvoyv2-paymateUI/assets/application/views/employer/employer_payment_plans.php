<section>
	<div class="block no-padding">
		<div class="container-fluid">
			<div class="row no-gape">

				<!--include side bar for employer-->
				<?php $this->load->view('include/side_bar_left_employer') ?>

				<div class="col-lg-10 column">
					<div class="padding-left mt-5">

						<div class="row">
							<div class="col-lg-12">
								<div class="heading">
									<h2>Buy Our Plans And Packages</h2>
									<span>One of our jobs has some kind of flexibility option - such as telecommuting, a part-time schedule or a flexible or flextime schedule.</span>
								</div><!-- Heading -->
								<div class="plans-sec pLR35">
									<div class="row">

										<?php
										if (isset($plans) && !empty($plans)){
											foreach ($plans as $plan) {
												$plan['validity_period'] = !empty($plan['validity_period']) && !empty($plan['validity_duration']) ?
													($plan['validity_period'] == 'w' ? ($plan['validity_duration'] > 1 ? $plan['validity_duration'].' Weeks' : $plan['validity_duration'].' Week') :
														($plan['validity_period'] == 'm' ? ($plan['validity_duration'] > 1 ? $plan['validity_duration'].' Months' : $plan['validity_duration'].' Month') :
															($plan['validity_period'] == 'a' ? ($plan['validity_duration'] > 1 ? $plan['validity_duration'].' Years' : $plan['validity_duration'].' Year') : '')
														)
													) : '';
												?>
												<div class="col-lg-3" data-wow-duration="1s">
													<div class="pricetable">
														<div class="pricetable-head">
															<h3><?php echo !empty($plan['plan_name']) ? $plan['plan_name'] : '' ?></h3>
															<h2>
																<i><?php echo !empty($plan['price_currency']) ? $plan['price_currency'] : '' ?></i>
																<?php echo !empty($plan['price_value']) ? number_format($plan['price_value'], 2) : '' ?>
															</h2>
															<span>
																<?php echo !empty($plan['no_of_allowed_post']) ? $plan['no_of_allowed_post'] . ' Job Posts' : '' ?>
															</span>
															<span>
																<?php echo !empty($plan['validity_period']) && !empty($plan['validity_period']) ? $plan['validity_period'] : '' ?>
															</span>
														</div><!-- Price Table -->
														<ul>
															<li>Maximum no of posts
																: <?php echo !empty($plan['no_of_allowed_post']) ? $plan['no_of_allowed_post'] : '' ?></li>
															<li>Period : 3</li>
															<li>Currency : LKR</li>
														</ul>
														<a class="btn-buy"
														   href="<?php echo !empty($plan['id']) ? base_url('employer/subscription/plans/view_plan?pkg=' . $plan['id']) : '' ?>"
														   title="">SUBSCRIBE</a>
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
				</div>
			</div>
		</div>
	</div>
</section>



