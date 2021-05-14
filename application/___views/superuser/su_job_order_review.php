<?php

//	echo '<pre>';
//	print_r($posting_plans);
//	echo '</pre>';
//?>
<section>
    <div class="block remove-top">
        <div class="container-fluid">
            <div class="row no-gape">

                <!--include side bar for employer-->
                <?php $this->load->view('include/side_bar_left_employer')?>

                <div class="col-lg-9 column">
                    <div class="padding-left select2-custom-style">
                        <div class="manage-jobs-sec manage-jobs-sec-custom pending-approval">
							<?php if (isset($order) && !empty($order)) { ?>
								<div class="profile-title">
									<h3>Order #<span id="order_no_title"><?php echo ($order->order_no) ?? ''?></span> <span id="order-status-badge" class="badge status bcg-<?php echo ($order->order_status) ?? ''?>"><?php echo ($order->status) ?? ''?></span></h3>
								</div>

								<div class="profile-form-edit select2-custom-style">
									<div class="row mb-3">
										<div class="col-md-12 mt-4">
											<div class="row">
												<div class="col-md-12">
													<div class="card ml-xs-4 mb-3">
														<div class="card-body">
															<div class="row">
																<div class="col-md-12">
																	<h6 class="card-title font-weight-bold float-left">
																		Customer Information
																	</h6>
																</div>
																<div class="col-md-12 font-13">
																	<div class="pl-3">
																		<table class="table table-sm m-1">
																			<tbody>
																			<tr>
																				<th scope="row">Name:</th>
																				<td id="billing_name"><?php echo ($order->billing_name) ?? ''?></td>
																			</tr>
																			<tr>
																				<th scope="row">Company:</th>
																				<td id="employer_name"><?php echo ($order->employer_name) ?? ''?></td>
																			</tr>
																			<tr>
																				<th scope="row">Address:</th>
																				<td id="billing_address"><?php echo ($order->billing_address) ?? ''?></td>
																			</tr>
																			<tr>
																				<th scope="row">Email:</th>
																				<td>
																					<a href="mailto:<?php echo ($order->billing_email) ?? ''?>"
																					   class="text-underline"
																					   id="billing_email"><?php echo ($order->billing_email) ?? ''?></a>
																				</td>
																			</tr>
																			<tr>
																				<th scope="row">Phone:</th>
																				<td id="billing_phone"><?php echo ($order->billing_phone) ?? ''?></td>
																			</tr>
																			</tbody>
																		</table>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-8">
													<div class="card ml-xs-4 mb-3">
														<div class="card-body">
															<div class="row font-13">
																<div class="col-md-12">
																	<h6 class="card-title font-weight-bold float-left">
																		Order Items
																	</h6>
																</div>
																<div class="col-md-12">
																	<div class="row pl-3">
																		<div class="col-md-12">
																			<table class="table table-sm table-cus m-1">
																				<thead class="font-weight-bold">
																				<tr class="text-center">
																					<th>#</th>
																					<th>Item</th>
																					<th>Qty</th>
																					<th>Price</th>
																				</tr>
																				</thead>
																				<tbody id="item_list">
																				<?php if (isset($order->order_item) && !empty($order->order_item)) {
																					$i = 1;
																					foreach ($order->order_item as $key => $item) {
																						?>
																						<tr>
																							<td><?php echo ($key+1) ?? ''?></td>
																							<td><?php echo ($item->item_name) ?? ''?></td>
																							<td><?php echo ($item->quantity) ?? ''?></td>
																							<td class="float-right"><?php echo ($item->value) ?? ''?></td>
																						</tr>
																						<?php
																						$i++;
																					}
																				}
																				?>

																				</tbody>
																			</table>
																		</div>
																	</div>
																	<hr>
																	<div class="row font-weight-bold">
																		<div class="col-md-12">
																			<div class="mx-2">
																				<span class="float-left">Total</span>
																				<span class="float-right pr-4"
																					  id="amount_value"><?php echo ($order->amount_value) ?? '' ?></span>
																			</div>
																		</div>
																	</div>
																	<hr>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="card ml-xs-4 mb-3">
														<div class="card-body">
															<div class="row font-13">
																<div class="col-md-12">
																	<h6 class="card-title font-weight-bold float-left">
																		Payment
																	</h6>
																</div>
																<div class="col-md-12">
																	<div class="row pl-3">
																		<div class="col-md-4">
																			<span class="float-left">Mode:</span><br>
																			<span class="float-left">Type:</span><br>
																			<span class="float-left">Status:</span>
																		</div>
																		<div class="col-md-8">
																			<span class="float-left" id="payment_mode"><?php echo ($order->payment_mode) ?? ''?></span><br>
																			<span class="float-left" id="payment_type"><?php echo ($order->payment_type) ?? ''?></span><br>
																			<span
																				class="float-left px-0 status badge <?php echo ($order->payment_status_raw) ?? ''?> font-13"
																				id="payment_status"><?php echo ($order->payment_status) ?? ''?>
																			</span>
																		</div>
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
														<div class="card-body">
															<div class="row font-13">
																<div class="col-md-12">
																	<h6 class="card-title font-weight-bold float-left">
																		Transactions
																	</h6>
																</div>
																<div class="col-md-12">
																	<div class="row pl-3">
																		<div class="col-md-12">
																			<table class="table table-sm table-cus m-1">
																				<thead class="font-weight-bold">
																				<tr class="text-center">
																					<th></th>
																					<th>Timestamp</th>
																					<th>Tnx No</th>
																					<th>Payment Mode</th>
																					<th>Payment Type</th>
																					<th>Amount</th>
																					<th>Status</th>
																					<th>Remarks</th>
																				</tr>
																				</thead>
																				<tbody id="tnx_list">
																				<?php if (isset($order->transactions) && !empty($order->transactions)) {
																					foreach ($order->transactions as $key => $tnx) {
																						?>
																						<tr data-toggle="collapse"
																							id="txn-row-<?php echo ($tnx->tnx_no)?? ''?>"
																							href="#tnxViewCollapse<?php echo ($tnx->id)?? ''?>"
																							role="button" aria-expanded="false"
																							aria-controls="tnxViewCollapse<?php echo ($tnx->id)?? ''?>"
																							class="collapsed hover-pointer">
																							<td>
																								<i class="la la-plus-circle"></i>
																							</td>
																							<td><?php echo ($tnx->tnx_timestamp)?? ''?></td>
																							<td><?php echo ($tnx->tnx_no)?? ''?></td>
																							<td><?php echo ($tnx->payment_mode)?? ''?></td>
																							<td><?php echo ($tnx->payment_type)?? ''?></td>
																							<td><?php echo ($tnx->amount)?? ''?></td>
																							<td class="badge status font-13 <?php echo ($tnx->tnx_status)?? ''?>">
																								<?php echo ($tnx->status)?? ''?>
																							</td>
																							<td class="remarks">
																								<?php echo !empty($tnx->remarks)? substr($tnx->remarks, 0, 15) : ''?>
																							</td>
																						</tr>
																						<tr id="approval-row<?php echo ($tnx->tnx_no)?? ''?>">
																							<td colspan="8">
																								<div class="collapse multi-collapse px-5 pb-5 pt-2 bg-light" id="tnxViewCollapse<?php echo ($tnx->id)?? ''?>">
																									<div class="row">
																										<div class="col-md-6 font-14">
																											<span>Reference No: <?php echo ($tnx->offline_reference_id) ?? ''?></span><br>
																											<?php if (!empty($tnx->cheque_no)): ?>
																												<span>Cheque No: <?php echo ($tnx->cheque_no) ?? '' ?></span>
																											<?php endif ?>
																										</div>
																										<?php if (!empty($tnx->remarks)): ?>

																											<div
																												class="col-md-6 remarks">
																												<span
																													class="font-14 pb-2">Remarks: </span>
																													<div
																														class="card">
																														<div
																															class="card-body px-3 py-0">
																															<p class="card-text font-12"><?php echo ($tnx->remarks) ?? '' ?></p>
																														</div>
																													</div>
																											</div>
																										<?php endif ?>
																									</div>
																									<div class="row">
																										<?php if (!($tnx->tnx_status == 'approved' || $tnx->tnx_status == 'Approved' )): ?>
																											<div class="col-md-6">
																												<hr>
																												<form
																													class="txn_approval"
																													id="txn-form-<?php echo ($tnx->tnx_no) ?? '' ?>">
																													<input
																														type="hidden"
																														name="tnx_no"
																														value="<?php echo ($tnx->tnx_no) ?? '' ?>">
																													<input
																														type="hidden"
																														name="order_no"
																														value="<?php echo ($order->order_no) ?? '' ?>">
																													<div class="row approval-selector">
																														<div
																															class="col-md-12">
																															<span class="font-14 pb-2">Approve Transaction: </span>
																														</div>
																														<div class="col-md-8">
																															<select
																																name="tnx_status"
																																class="select2-custom"
																																id="">
																																<option
																																	value="pending">
																																	Pending
																																</option>
																																<option
																																	value="refer_back">
																																	Refer
																																	Back
																																</option>
																																<option
																																	value="rejected">
																																	Reject
																																</option>
																																<option
																																	value="onhold">
																																	On
																																	Hold
																																</option>
																																<option
																																	value="other">
																																	Other
																																</option>
																																<option
																																	value="approved">
																																	Approve
																																</option>
																															</select>
																														</div>
																														<div class="col-md-4">
																															<button
																																class="btn-orange float-right"
																																type="submit">
																																Update
																															</button>
																														</div>
																													</div>
																												</form>
																											</div>
																										<?php endif ?>
																										<div class="col-md-6">
																											<hr>
																											<span class="font-14 pb-2">Payment Proof Attachments: </span>
																											<?php if (isset($tnx->payment_proofs) && !empty($tnx->payment_proofs)) {
																												foreach ($tnx->payment_proofs as $proof){
																													?>
																													<div
																														class="list-group list-group-flush font-italic font-11 text-underline ml-2">
																														<a href="<?php echo ($proof->file_dir)?? ''?>"
																														   class=" p-1"
																														   style="font-size: 12px"
																														   target="_blank">
																															<i class="la la-file-invoice-dollar"></i>
																															<?php echo ($proof->file)?? ''?>
																														</a>
																													</div>
																													<?php
																												}
																											}?>
																										</div>
																									</div>																								
																								</div>
																							</td>
																						</tr>
																						<?php
																					}
																				}?>
																				</tbody>
																			</table>
																		</div>
																	</div>
																</div>
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
								<div class="profile-title">
									<h3>Order No not found</h3>
								</div>
								<?php
							} ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!--Modal-->

<div class="account-popup-area modal-popup-area" id="order-view-popup-box">
    <div class="account-popup resume-modal"
		style="width: 1000px !important;
   		margin-left: -500px !important;"  >
        <span class="close-popup"><i class="la la-close"></i></span>

        <div class="profile-title">
            <h3>Order #<span id="order_no_title"></span></h3>
        </div>

        <div class="profile-form-edit select2-custom-style">
			<div class="row mb-3">
				<div class="col-md-12 mt-4">
					<div class="row">
						<div class="col-md-12">
							<div class="card ml-xs-4 mb-3">
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<h6 class="card-title font-weight-bold float-left">
												Customer Information
											</h6>
										</div>
										<div class="col-md-12 font-13">
											<div class="pl-3">
												<table class="table table-sm">
													<tbody>
													<tr>
														<th scope="row">Name: </th>
														<td id="billing_name"></td>
													</tr>
													<tr>
														<th scope="row">Company: </th>
														<td id="employer_name"></td>
													</tr>
													<tr>
														<th scope="row">Address: </th>
														<td id="billing_address"></td>
													</tr>
													<tr>
														<th scope="row">Email: </th>
														<td>
															<a href="mailto:symi@mailinator.com" class="text-underline" id="billing_email"></a>
														</td>
													</tr>
													<tr>
														<th scope="row">Phone: </th>
														<td id="billing_phone"></td>
													</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<div class="card ml-xs-4 mb-3">
								<div class="card-body">
									<div class="row font-13">
										<div class="col-md-12">
											<h6 class="card-title font-weight-bold float-left">
												Order Items
											</h6>
										</div>
										<div class="col-md-12">
											<div class="row pl-3">
												<div class="col-md-12">
													<table class="table table-sm table-cus">
														<thead class="font-weight-bold">
														<tr class="text-center">
															<th>#</th>
															<th>Item</th>
															<th>Qty</th>
															<th>Price</th>
														</tr>
														</thead>
														<tbody id="item_list">
														<tr>
														</tr>
														</tbody>
													</table>
												</div>
											</div>
											<hr>
											<div class="row font-weight-bold">
												<div class="col-md-12">
													<div class="mx-2">
														<span class="float-left">Total</span>
														<span class="float-right" id="amount_value">Total</span>
													</div>
												</div>
											</div>
											<hr>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card ml-xs-4 mb-3">
								<div class="card-body">
									<div class="row font-13">
										<div class="col-md-12">
											<h6 class="card-title font-weight-bold float-left">
												Payment
											</h6>
										</div>
										<div class="col-md-12">
											<div class="row pl-3">
												<div class="col-md-4">
													<span class="float-left">Mode:</span><br>
													<span class="float-left">Type:</span><br>
													<span class="float-left">Status:</span>
												</div>
												<div class="col-md-8">
													<span class="float-left" id="payment_mode">Offline</span><br>
													<span class="float-left" id="payment_type">Cheque</span><br>
													<span class="float-left status badge status font-13" id="payment_status">Pending</span>
												</div>
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
								<div class="card-body">
									<div class="row font-13">
										<div class="col-md-12">
											<h6 class="card-title font-weight-bold float-left">
												Transactions
											</h6>
										</div>
										<div class="col-md-12">
											<div class="row pl-3">
												<div class="col-md-12">
													<table class="table table-sm table-cus">
														<thead class="font-weight-bold">
														<tr class="text-center">
															<th></th>
															<th>Timestamp</th>
															<th>Tnx No</th>
															<th>Payment Mode</th>
															<th>Payment Type</th>
															<th>Amount</th>
															<th>Status</th>
															<th>Remarks</th>
														</tr>
														</thead>
														<tbody id="tnx_list">
														<tr data-toggle="collapse" href="#multiCollapseExample1"
															role="button" aria-expanded="false"
															aria-controls="multiCollapseExample1" class="collapsed hover-pointer">
															<td><i class="la la-plus-circle"></i></td>
															<td>2019-11-25 15:24:58</td>
															<td>OF20191125TRF00065</td>
															<td>Offline</td>
															<td>Bank Transfer</td>
															<td>1000.00</td>
															<td class="badge status font-13 pending">Pending</td>
															<td></td>
														</tr>
														<tr >
															<td colspan="6">
																<div class="collapse multi-collapse" id="multiCollapseExample1">
																	<div class="row">
																		<div class="col-md-6 mb-2">
																			<span class="font-14">Payment Proof Attachments</span>
																			<div class="list-group list-group-flush font-italic text-underline ml-2">
																				<a href="/recruitment/uploads/tnx_proofs/201911250043/OF20191125CHQ00066/OF20191125CHQ00066_logo-full-white.png" class=" p-1" style="font-size: 12px" target="_blank">
																					<i class="la la-file-invoice-dollar"></i>
																					OF20191125CHQ00066_logo-full-white.png																												</a>
																			</div>
																			<div class="list-group list-group-flush font-italic text-underline ml-2">
																				<a href="/recruitment/uploads/tnx_proofs/201911250043/OF20191125CHQ00066/OF20191125CHQ00066_logo-half-white.png" class=" p-1" style="font-size: 12px" target="_blank">
																					<i class="la la-file-invoice-dollar"></i>
																					OF20191125CHQ00066_logo-half-white.png																												</a>
																			</div>
																			<div class="list-group list-group-flush font-italic text-underline ml-2">
																				<a href="/recruitment/uploads/tnx_proofs/201911250043/OF20191125CHQ00066/OF20191125CHQ00066_logo-regular.png" class=" p-1" style="font-size: 12px" target="_blank">
																					<i class="la la-file-invoice-dollar"></i>
																					OF20191125CHQ00066_logo-regular.png																												</a>
																			</div>
																		</div>
																		<div class="col-md-6">
																			<span class="font-14">Approve Transaction</span>
																			<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
																			<select name="" class="select2-custom" id="">
																				<option value="1">Pending</option>
																				<option value="2">Approve</option>
																				<option value="3">Refer Back</option>
																				<option value="4">Complete</option>
																				<option value="4">Reject</option>
																			</select>
																			<div class="type_widget" style="">
																				<p class="contract-chek">
																					<input type="checkbox" class="filter-input job-type-filter" value="contract" name="choosetype" id="contract" data-filter-name="Contract" data-filter-id="1">
																					<label class="filter-label" for="contract">Proofs Matched</label>
																				</p>
																			</div>
																			<a href="#" class="btn btn-primary">Update</a>
																		</div>
																	</div>
																</div>
															</td>
														</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<!--            <form id="frm_create_new_plan" >-->
<!--                <div class="row">-->
<!--					<input type="hidden" name="rec_id" id="rec_id" data-plan-auto-id="">-->
<!--                    <div class="col-md-12">-->
<!--                        <span class="pf-title">Plan Name</span>-->
<!--                        <div class="pf-field">-->
<!--                            <input type="text" class="" name="plan_name" placeholder="Ex: Premium Plan" />-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-md-12">-->
<!--                        <span class="pf-title">Validity Period </span>-->
<!--						<div class="row">-->
<!--							<div class="col-md-6">-->
<!--								<div class="pf-field pb-lg-2 pb-md-2">-->
<!--									<select name="validity_period" class="select2-custom-style select2-custom" id="validity_period" data-placeholder="Select validity period">-->
<!--										<option value=""></option>-->
<!--										<option value="w">Week</option>-->
<!--										<option value="m">Month</option>-->
<!--										<option value="a">Annual</option>-->
<!--									</select>-->
<!--								</div>-->
<!--							</div>-->
<!--							<div class="col-md-6">-->
<!--								<div class="pf-field pb-4">-->
<!--									<select name="validity_duration" class="select2-custom-style select2-custom" id="validity_for" data-placeholder="Select validity period">-->
<!--										<option value=""></option>-->
<!--									</select>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--                    </div>-->
<!--					<div class="col-md-6">-->
<!--						<span class="pf-title">Effective Date</span>-->
<!--						<div class="pf-field">-->
<!--							<input type="text" name="effective_date" id="effective_date" class="datetimepicker-input date-picker-min-disabled" id="effective_date" data-toggle="datetimepicker" data-target="#effective_date"/>-->
<!--						</div>-->
<!--					</div>-->
<!--					<div class="col-md-6">-->
<!--						<span class="pf-title">Allowed Posts</span>-->
<!--						<div class="pf-field">-->
<!--							<input type="number" name="no_of_allowed_post" min="1" step="1" placeholder="" />-->
<!--						</div>-->
<!--					</div>-->
<!--                    <div class="col-md-12">-->
<!--                        <span class="pf-title">Price</span>-->
<!--						<div class="row">-->
<!--							<div class="col-md-6">-->
<!--								<div class="pf-field">-->
<!--									<select name="price_currency" class="select2-custom-style select2-custom" id="" data-placeholder="Select Currency">-->
<!--										<option value=""></option>-->
<!--										<option value="LKR">LKR</option>-->
<!--										<option value="USD">USD</option>-->
<!--									</select>-->
<!--								</div>-->
<!--							</div>-->
<!--							<div class="col-md-6">-->
<!--								<div class="pf-field pb-4">-->
<!--									<input type="number" min="1" step=".01" name="price_value" placeholder="Amount">-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--                    </div>-->
<!--                    <div class="col-md-12">-->
<!--                        <button class="btn-orange save-plan" style="margin-top:10px" onclick="" type="submit">Save</button>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </form>-->
        </div>
    </div>
</div>

<script src="<?php echo base_url()?>assets/custom/su_job_post_plan_orders.js<?php echo '?build='.BUILD_NO?>" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/datatables.js" type="text/javascript"></script>
