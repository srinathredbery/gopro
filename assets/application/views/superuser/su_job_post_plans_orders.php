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
                            <h3>Orders</h3>
							<div class="row d-flex flex-row">
								<div class="col-md-12 align-middle ">

									<div class="mt-2">
										<div class="dataTables_length float-left ml-3" id="orders_filter">
										<span>
											<span class=" float-left font-15 badge status bcg-other"><i class="la la-file-invoice-dollar"></i></span>
											<span class="ml-2 font-13">Transactions Available</span>
										</span>
										</div>
										<div class="dataTables_length float-right mr-3" id="">
											<button class="btn-apply-filter mt-0 px-3 py-1" id="orders_refresh">
												<span class="font-weight-bold" style="font-size: 17px"><i class="fas fa-sync"></i></i></span>
											</button>
										</div>
										<div class="dataTables_length float-right mr-3" id="orders_filter">
											<label>Order Status:
												<select id="order_status_filter" aria-controls="orders" class="">
													<option value="">All</option>
													<option value="success">Success</option>
													<option value="pending">Pending</option>
<!--													<option value="refer_back">Refer Back</option>-->
<!--													<option value="rejected">Rejected</option>-->
<!--													<option value="onhold">On Hold</option>-->
<!--													<option value="other">Other</option>-->
												</select>
											</label>
										</div>
										<div class="dataTables_length float-right mr-3" id="payment_filter">
											<label>Payment Status:
												<select id="pay_status_filter" aria-controls="orders" class="">
													<option value="">All</option>
													<option value="completed">Completed</option>
													<option value="pending">Pending</option>
<!--													<option value="refer_back">Refer Back</option>-->
<!--													<option value="rejected">Rejected</option>-->
<!--													<option value="onhold">On Hold</option>-->
<!--													<option value="other">Other</option>-->
												</select>
											</label>
										</div>
									</div>
								</div>
							</div>
                            <table class="resume-table-custom" id="orders" style="width: 100%">
                                <thead class="text-center">
                                <tr>
                                    <td>Order No</td>
									<td>Order Date</td>
									<td>Employer</td>
                                    <td>Amount</td>
                                    <td>Order Status</td>
                                    <td>Payment Status</td>
                                    <td></td>
                                </tr>
                                </thead>

                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo base_url()?>assets/custom/su_job_post_plan_orders.js<?php echo '?build='.BUILD_NO?>" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/datatables.js" type="text/javascript"></script>
