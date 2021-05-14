<section>
	<div class="block no-padding">
		<div class="container-fluid">
			<div class="row no-gape">

				<!--include side bar for employer-->
				<?php $this->load->view('include/side_bar_left_employer') ?>

				<div class="col-lg-9 column">
					<div class="padding-left">
						<div class="manage-jobs-sec">
							<?php
							if (!empty($order))
							{
								?>
								<h3>Thank you for your purchase</h3>
								<div class="row mb-3">
									<div class="col-md-6 mt-4">
										<div class="card ml-md-4 mb-3">
											<div class="card-body">
												<div class="row">
													<div class="col-md-12">
														<h5 class="card-title font-weight-bold float-left">
															Your Order
														</h5>
													</div>
												</div>
												<div class="row pl-3">
													<div class="col-md-12" id="order_no" data-ono="<?php echo $order->order_no ?? ''?>">
														Order No: <?php echo $order->order_no ?? ''?>
													</div>
													<div class="col-md-12">
														<span><?php echo $order->order_timestamp ?? ''?></span>
														<span class="float-right">
														Status:
														<span class="badge status font-14 bcg-<?php echo $order->order_status_raw ?? '' ?>">
															<?php echo $order->order_status ?? '' ?>
														</span>
													</span>
													</div>
												</div>
												<hr>
												<div class="row">
													<div class="col-md-12 mb-2">
														<h6 class="font-weight-bold">Ordered Items</h6>
													</div>
													<div class="col-md-12">
														<?php if (isset($ordered_items) && !empty($ordered_items)) {
															foreach ($ordered_items as $item) {
																?>
																<div class="pl-3">
																	<div class="card bg-light package-card mb-2">
																		<div class="card-body">
																			<div class="row">
																				<div class="col-md-7">
																					<h5 class="card-title"><?php echo $item->plan_name ?? '' ?></h5>
																					<p class="card-subtitle mb-2 text-muted">
																						<?php echo $item->no_of_allowed_post . ' Posts' ?? '' ?>
																						|
																						<?php echo $item->validity_period ?? '' ?>
																					</p>
																				</div>
																				<div class="col-md-5">
																					<div class="card-text">
																			<span class="position-relative float-right">

																			</span>
																						<h4 class="float-right">
																							<sup
																								style="font-size: 15px">
																								<?php echo $item->price_currency ?? '' ?>
																							</sup>
																							<span
																								class="font-weight-bold" id="isPrice">
																						<?php echo number_format($item->price_value, 2) ?? '' ?>
																					</span>
																						</h4>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<?php
															}
														}?>
													</div>
													<div class="col-md-12 mt-2">
														<div class="pl-3">
															<div>
																<span class="float-left">Sub total</span>
																<span class="float-right">
															<?php echo $order->currency ?? '' ?>
															<?php echo number_format($order->amount_value, 2) ?? '' ?>
														</span>
															</div>
															<br>
															<div>
																<span class="float-left">Tax</span>
																<span class="float-right">
															<?php echo number_format($order->tax, 2) ?? '' ?>
														</span>
															</div>
															<br>
															<div>
																<span class="float-left font-weight-bold">Total</span>
																<span class="float-right font-weight-bold">
															<?php echo $order->currency ?? '' ?>
															<?php echo number_format($order->amount_value + $order->tax, 2) ?? '' ?>
														</span>
															</div>
														</div>
													</div>
												</div>
												<hr>
											</div>
										</div>
									</div>
									<div class="col-md-6 mt-4">
										<div class="row">
											<div class="col-md-12">
												<div class="card ml-xs-4 mb-3">
													<div class="card-body">
														<div class="row">
															<div class="col-md-12">
																<h5 class="card-title font-weight-bold float-left">
																	Billing Information
																</h5>
															</div>
															<div class="col-md-12">
																<div class="pl-3 font-13">
																	<span class="font-14"><?php echo $order->billing_name . ', ' ?? '' ?></span><br>
																	<span class="font-14"><?php echo $order->employer_name . ', ' ?? '' ?></span><br>
																	<span><?php echo $order->employer_address_1 ?? '' ?></span><br>
																	<span><?php echo $order->employer_address_2 ?? '' ?></span><br>
																	<span><?php echo $order->employer_city . ', ' ?? '' ?></span><br>
																	<span><?php echo $order->CountryDes . '. ' ?? '' ?></span><br><br>
																	<span>Email: </span>
																	<span><?php echo $order->billing_email ?? '' ?></span>
																	<span><?php echo '(' . $order->employer_email . ')' ?? '' ?></span>
																	<br>
																	<span>Phone: </span>
																	<span><?php echo $order->billing_phone ?? '' ?></span><br>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="card ml-xs-4 mb-3">
													<div class="card-body font-13">
														<div class="row">
															<div class="col-md-12">
																<h5 class="card-title font-weight-bold float-left">
																	Payment
																</h5>
															</div>
															<div class="col-md-12">
																<div class="row pl-3">
																	<div class="col-md-3">
																		<span class="float-left">Mode:</span><br>
																		<span class="float-left">Type:</span><br>
																		<span class="float-left">Status:</span>
																	</div>
																	<div class="col-md-6">
																		<span class="float-left"><?php echo $order->payment_mode ?? '' ?></span><br>
																		<span class="float-left"><?php echo $order->payment_type ?? '' ?></span><br>
																		<span class="float-left status badge font-12 status bcg-<?php echo $order->payment_status_raw ?? '' ?>"><?php echo $order->payment_status?? '' ?></span>
																	</div>
																</div>
															</div>
															<div class="col-md-12">

															<?php if (!($order->payment_status_raw == 'completed'|| $order->payment_status_raw == 'approved'|| $order->order_status_raw == 'success')){
																if(number_format($item->price_value, 2)==0.00){  ?>

																	<button class="btn btn-orange border-0" id="submithFreebtn"
																			data-pay-type="<?php echo $order->payment_type_raw ?? '' ?>" >
																		Submit
																	</button>


															<?php	}else{ ?>
															<button class="btn btn-orange border-0" id="attach_submit_button"
																			data-pay-type="<?php echo $order->payment_type_raw ?? '' ?>"
																			onclick="show_payment_proof_form(this)">
																		Submit Payment Proof /Receipt
																	</button>


															<?php }} ?>
															</div>
														</div>
														<hr>
														<div class="row">
															<div class="col-md-12">
																<h5 class="card-title font-weight-bold float-left">
																	Transactions
																</h5>
															</div>
															<div class="col-md-12">
																<?php if (isset($transactions) && !empty($transactions)): ?>
																	<div id="submit_tbx_proof_form">
																		<div class="profile-form-edit">
																			<?php
																			if (isset($transactions) && !empty($transactions)) {
																				foreach ($transactions as $tnx) {
																					?>
																					<div class="card mb-3">
																						<div class="card-header">
																							<h6 class="card-title float-left">
																								<strong>Tnx no: #<?php echo $tnx->tnx_no ?? '' ?></strong>
																							</h6>
																							<span
																								class="float-right badge font-12 status bcg-<?php echo $tnx->tnx_status_raw ?? '' ?>">
																								<?php echo $tnx->tnx_status ?? '' ?>
																							</span>
																						</div>
																						<div class="card-body">
																							<span><?php echo $tnx->tnx_timestamp ?? '' ?></span>
																							<div class="row" style="font-size: 13px">
																								<div class="col-md-6">
																									<ul class="list-group list-group-flush">
																										<li class="list-group-item">Payment
																											Mode: <?php echo $tnx->payment_mode ?? '' ?></li>
																										<li class="list-group-item">
																											Amount: <?php echo $tnx->amount ?? '' ?></li>
																									</ul>
																								</div>
																								<div class="col-md-6">
																									<ul class="list-group list-group-flush">
																										<li class="list-group-item">Payment
																											Mode: <?php echo $tnx->payment_type ?? '' ?></li>
																										<?php if ($tnx->cheque_no): ?>
																											<li class="list-group-item">Cheque
																												No: <?php echo $tnx->cheque_no ?? '' ?></li>
																										<?php endif ?>
																									</ul>
																								</div>
																							</div>
																							<div class="row">
																								<div class="col-md-12 mb-2">
																									<span>Attachments</span>
																									<?php if (!empty($tnx->files)){
																										foreach ($tnx->files as $file){
																											?>
																											<div class="list-group list-group-flush font-italic text-underline ml-2">
																												<a href="<?php echo !empty($file->file_dir) && !empty($file->file) ? TNX_PROOF_READ_DIR.$file->file_dir.$file->file : ''?>"
																												   class=" p-1" style="font-size: 12px" target="_blank">
																													<i class="la la-file-invoice-dollar"></i>
																													<?php echo $file->file ?? ''?>
																												</a>
																											</div>

																											<?php
																										}
																									}?>
																								</div>
																							</div>
																							<?php if ($tnx->tnx_status_raw == 'pending' || $tnx->tnx_status_raw == 'Pending'): ?>
																								<div class="row">
																									<div class="col-md-12">
																										<a class="btn btn-danger float-right" style="font-size: 12px"
																										   data-t_id = "<?php echo $tnx->tnx_no ??''?>"
																										   onclick="revoke_transaction(this)">Delete</a>
																									</div>
																								</div>
																							<?php endif ?>
																						</div>

																					</div>
																					<?php
																				}
																			}
																			?>
																		</div>
																	</div>
																<?php endif ?>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php
							} else {
								?>
								<h3>Order not found. Please check the order number</h3>
								<div class="manage-jobs-sec">
									<a class="btn btn-orange" href="<?php echo base_url()?>employer/transactions">Go Back</a>
								</div>
								<?php
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
	$this->load->view('templates/modals/payment_proof_submit_form.php');
?>

<script src="<?php echo base_url() ?>assets/custom/emp_purchase_plans.js<?php echo '?build=' . BUILD_NO ?>" type="text/javascript"></script>

