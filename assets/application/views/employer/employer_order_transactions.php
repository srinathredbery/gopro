<section>
	<div class="block no-padding">
		<div class="container-fluid">
			<div class="row no-gape">

				<!--include side bar for employer-->
				<?php $this->load->view('include/side_bar_left_employer') ?>

				<div class="col-lg-9 column">
					<div class="padding-left">
						<div class="manage-jobs-sec">
							<h3>Order History</h3>
							<table>
								<thead>
									<tr>
										<td>Order No</td>
										<td>Package</td>
										<td>Date</td>
										<td>Payment Mode</td>
										<td>Payment Type</td>
										<td>Amount</td>
										<td>Status</td>
										<td></td>
									</tr>
								</thead>
								<tbody>
								<?php
								if (isset($orders) && !empty($orders)){
									foreach ($orders as $order) {
									?>
										<tr id="order_no" data-ono="<?php echo $order->order_no ?? ''?>">
											<td>
												<span><?php	echo $order->order_no ?? ''?></span>
											</td>
											<td>
												<div class="table-list-title">
													<?php
													if (isset($ordered_item_list) && !empty($ordered_item_list)){
														foreach ($ordered_item_list as $item){
															if ($order->order_no === $item->order_no){
																?>
																<h3>
																	<?php echo $item->plan_name ?? ''?>(
																	<?php echo $item->pkg_id ?? ''?>)

																</h3>
																<?php
															}
														}
													}
													?>
												</div>
											</td>
											<td>
												<span><?php	echo $order->order_timestamp ?? ''?></span>
											</td>
											<td>
												<span><?php	echo $order->payment_mode ?? ''?></span>
											</td>
											<td>
												<span><?php	echo $order->payment_type ?? ''?></span>
											</td>
											<td>
												<span>
													<?php echo $order->currency ?? ''?>
													<?php echo number_format($order->amount_value, 2) ?? ''?>
												</span>
											</td>
											<td>
												<span><span class="status <?php	echo $order->status ?? ''?>"><?php	echo $order->order_status ?? ''?></span></span>
											</td>
											<td class="active">
												<div class="action-resume">
													<div class="action-center pr-0">
														<span>Action <i class="la la-angle-down"></i></span>
														<ul style="display: none;" >
															<li>
																<a href="<?php echo base_url().'employer/orders/summary'?><?php echo !empty($order->order_no)? '?ono='.$order->order_no : ''?>" target="_blank" title="">
<!--																	<i class="la la-paperclip"></i>-->
																	View Order Summary
																</a>
															</li>
															<?php
															if (($order->payment_mode == 'Offline' || $order->payment_mode == 'offline') && !($order->payment_status == 'completed')) {
																?>
																<li>
																	<a href="<?php echo base_url().'employer/orders/summary'?><?php echo !empty($order->order_no)? '?ono='.$order->order_no.'&submit=yes' : ''?>" target="_blank" title="">
																		Attach Transaction Proof
																	</a>
																</li>
																<?php
															}
															?>
														</ul>
													</div>
												</div>
											</td>
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

<?php
if (isset($transactions) && !empty($transactions))
	$this->load->view('templates/modals/payment_proof_submit_form.php', $transactions);
else
	$this->load->view('templates/modals/payment_proof_submit_form.php')
?>

<script src="<?php echo base_url() ?>assets/custom/emp_purchase_plans.js<?php echo '?build=' . BUILD_NO ?>" type="text/javascript"></script>
