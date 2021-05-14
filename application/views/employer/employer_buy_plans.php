<section>
	<div class="block no-padding">
		<div class="container-fluid">
			<div class="row no-gape">

				<!--include side bar for employer-->
				<?php $this->load->view('include/side_bar_left_employer') ?>

				<div class="col-lg-9 column">
					<div class="padding-left">
						<div class="manage-jobs-sec">

							<div class="row mb-3">
								<div class="col-md-12">
									<div class="card ml-md-4 mb-3">
										<div class="card-body">
											<h3>Subscribe to Plans</h3>
											<hr>
											<h6 class="card-title border-bottom font-weight-bold">
												Package Information
											</h6>
											<hr>
											<div class="row">
												<div class="col-md-6">
													<p>Maximum Allowed Posts: <?php echo !empty($plan['no_of_allowed_post']) ? $plan['no_of_allowed_post'] : '' ?></p>
													<p>
														Plan: <?php echo !empty($plan['plan_name']) ? $plan['plan_name'] : '' ?></p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<form id="billing-info">
								<div class="row">
									<div class="col-md-6">
										<div class="card ml-md-4 mb-4">
											<div class="card-body">
												<h6 class="card-title border-bottom font-weight-bold">
													Billing Information
												</h6>
												<hr>
												<div class="profile-form-edit">
													<div class="row">
														<input type="hidden" name="product_id" value="<?php echo !empty($plan['id']) ? $plan['id'] : '' ?>">
														<div class="col-md-12">
															<span class="pf-title">Company Name</span>
															<div class="pf-field">
																<input type="text" class="" name="employer_name"
																	   placeholder=""
																	   value="<?php echo !empty($company_info['employer_name']) ? $company_info['employer_name'] : '' ?>"
																	   readonly title="This cannot be edited"
																/>
															</div>
														</div>
														<div class="col-md-12">
															<span class="pf-title">Email </span>
															<div class="pf-field">
																<input type="text" class="" name="billing_email"
																	   placeholder="Email of the bill receiver"/>
															</div>
														</div>
														<div class="col-md-12">
															<span class="pf-title">Name</span>
															<div class="pf-field">
																<input type="text" class="" name="billing_name"
																	   placeholder="Name of the bill attendant" title="This is relevant for the person who is getting the bill. Sometimes it could be the finance manager of your company"/>
															</div>
														</div>
														<div class="col-md-12">
															<span class="pf-title">Contact No</span>
															<div class="pf-field">
																<input type="text" class="" name="contact_phone_number"
																	   placeholder="077 712 3456"/>
															</div>
														</div>
													</div>
													<hr>
													<div class="row mt-3">
														<div class="col-md-12">
															<div class="alert alert-primary border-primary radio-label" role="alert">
																<strong>Info:</strong><br> An email will be sent to the company registration email beside the given email above.
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="card ml-xs-4">
											<div class="card-body">
												<h6 class="card-title border-bottom font-weight-bold">
													Payment Information
												</h6>
												<hr>
												<div class="row">
													<div class="col-md-12">
														<div class="card bg-light package-card">
															<div class="card-body">
																<div class="row">
																	<div class="col-md-7">
																		<h5 class="card-title"><?php echo !empty($plan['plan_name']) ? $plan['plan_name'] : '' ?></h5>
																		<p class="card-subtitle mb-2 text-muted">
																			<?php echo !empty($plan['no_of_allowed_post']) ? $plan['no_of_allowed_post'].' Posts' : '' ?> |
																			<?php echo !empty($plan['validity_period']) && !empty($plan['validity_period']) ? 'Valid for '.$plan['validity_period'] : '' ?>
																		</p>
																	</div>
																	<div class="col-md-5">
																		<div class="card-text">
																			<span class="position-relative float-right">

																			</span>
																			<h4 class="float-right">
																				<sup style="font-size: 15px"><?php echo !empty($plan['price_currency']) ? $plan['price_currency'] : '' ?></sup>
																				<span class="font-weight-bold" id="prices"><?php echo !empty($plan['price_value']) ? number_format($plan['price_value'], 2) : '' ?></span>
																			</h4>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-12 mt-4">
														<div>
															<span class="float-left">Sub total</span>
															<span class="float-right">
																<?php echo !empty($plan['price_currency']) ? $plan['price_currency'] : '' ?>
																<?php echo !empty($plan['price_value']) ? number_format($plan['price_value'], 2) : '' ?>
															</span>
														</div>
														<br>
														<div>
															<span class="float-left">Tax</span>
															<span class="float-right">
																<?php echo !empty($plan['price_value']) ? number_format(0, 2) : number_format(0, 2) ?>
															</span>
														</div>
														<br>
														<div>
															<span class="float-left font-weight-bold">Total</span>
															<span class="float-right font-weight-bold">
																<?php echo !empty($plan['price_currency']) ? $plan['price_currency'] : '' ?>
																<?php echo !empty($plan['price_value']) ? number_format($plan['price_value'], 2) : '' ?>
															</span>
														</div>
													</div>
												</div>
												<hr>


												<?php  if($plan['price_value']==0.00){ ?>
													<div class="profile-form-edit">
														<div class="col-md-12">
															<button class="btn-orange pay-btn" id="pay-btn2" style="margin-top:10px" onclick="" type="button">
																Buy Now
															</button>
															<input type="hidden" id="hidden" value="0.00">
														</div>
													</div>

											<?php	}else{ ?>
													<input type="hidden" id="hidden" value="NOT">
												<div class="profile-form-edit">
													<div class="row">
														<div class="col-md-12">
															<div class="mb-2">
																<span>Payment Mode :</span>
															</div>
															<div class="pb-2 pl-4">
																<input type="radio" name="payment_mode" value="online"
																	   id="online">
																<label class="filter-label radio-label" for="online">Online</label>
																<br>
																<input type="radio" name="payment_mode" value="offline"
																	   id="offline">
																<label class="filter-label radio-label"
																	   for="offline">Offline</label>
															</div>
														</div>
													</div>
													<div class="payment-window"></div>
													<div class="col-md-12">
														<button class="btn-orange pay-btn" id="pay-btn" style="margin-top:10px" onclick="" type="submit">
															Buy Now
														</button>
													</div>
												</div>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script src="<?php echo base_url() ?>assets/custom/emp_purchase_plans.js<?php echo '?build=' . BUILD_NO ?>" type="text/javascript">
