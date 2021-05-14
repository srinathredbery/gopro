<div class="account-popup-area modal-popup-area" id="payment_proof_modal">
	<div class="account-popup resume-modal">
		<span class="close-popup"><i class="la la-close"></i></span>

		<div id="submit_tbx_proof_form">
			<div class="profile-title">
				<h3>Submit Payment Proof / Receipt</h3>
			</div>

			<div class="profile-form-edit">
				<form id="pay_proof_form">
					<div class="row">

						<!--					<div class="col-md-12">-->
						<!--						<div class="mb-2">-->
						<!--							<span>Payment Mode :</span>-->
						<!--						</div>-->
						<!--						<div class="pb-2 pl-4">-->
						<!--							<input type="radio" name="payment_mode" value="online"-->
						<!--								   id="online">-->
						<!--							<label class="filter-label radio-label" for="online">Online</label>-->
						<!--							<br>-->
						<!--							<input type="radio" name="payment_mode" value="offline"-->
						<!--								   id="offline">-->
						<!--							<label class="filter-label radio-label"-->
						<!--								   for="offline">Offline</label>-->
						<!--						</div>-->
						<!--					</div>-->

						<div id="pay-offline" class="">
							<div class="col-md-12">
								<div class="mb-2"><span>Pay by :</span></div>
								<div class="pb-2 pl-4">
									<input type="radio" name="payment_type" value="cash" id="cash">
									<label class="filter-label radio-label" for="cash">Cash</label>

									<input type="radio" name="payment_type" value="cheque" id="cheque">
									<label class="filter-label radio-label" for="cheque">Cheque</label>

									<input type="radio" name="payment_type" value="bank" id="bank">
									<label class="filter-label radio-label" for="bank">Bank Transfer</label><br>
								</div>
							</div>
						</div>

						<div class="" id="payment_info">
							<div class="col-md-12 d-none-cus pay_proof_form bank-pay-proof">
								<div class="row">
									<div class="col-md-12">
										<div class="card">
											<div class="card-header">
												Account Details
											</div>
											<div class="card-body">
												<div class="row">
													<div class="col-md-6">
														<span class="pf-title m-0">Holders name:</span>
														<span class="pf-title m-0">Account No:</span>
														<span class="pf-title m-0">Bank:</span>
														<span class="pf-title m-0">Branch:</span>
														<span class="pf-title m-0">Branch Code:</span>
													</div>
													<div class="col-md-6">
														<span class="pf-title m-0">RbJobs PVT Ltd</span>
														<span class="pf-title m-0">12258563</span>
														<span class="pf-title m-0">Sampath Bank</span>
														<span class="pf-title m-0">WTC</span>
														<span class="pf-title m-0">123</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12 d-none-cus pay_proof_form cheque-pay-proof">
								<div class="row">
									<div class="col-md-12">
										<div class="card">
											<div class="card-header">
												Account Details
											</div>
											<div class="card-body">
												<div class="row">
													<div class="col-md-12">
														<p>All cheques should be drawn in favour of Job Envoy (Pvt)
															Ltd</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<hr>
							<div class="row">
								<div class="col-md-12">
									<span class="pf-title">Reference ID / Document ID / Receipt No:</span>
									<div class="pf-field">
										<input type="text" class="" name="reference_id" placeholder="Transaction ID of transfer or Document No or Receipt No"/>
									</div>
								</div>
								<div class="col-md-12 d-none-cus pay_proof_form cheque-pay-proof">
									<span class="pf-title">Cheque No:</span>
									<div class="pf-field">
										<input type="text" class="" name="cheque_no" placeholder="Cheque Number"/>
									</div>
								</div>
								<div class="col-md-12">
									<span class="pf-title">Amount:</span>
									<div class="pf-field">
										<input type="number" min="1" step=".01" name="amount" placeholder="Amount"/>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-12 col-sm-12">
							<span class="pf-title">Attach Payment Proof:</span>
							<div class="row">
								<div class="col-md-12">
									<div id="payment_proof_attachment"
										 class="dm-uploader drop-zone text-center p-1">
										<div class="row">
											<div class="col-md-12">
												<h6 class="text-muted">Drag &amp; drop Files here</h6>
											</div>
											<div class="col-md-12 align-items-center">
												<div class="btn btn-orange-line border-0 mb-2 text-center border-0">
													<input class="file-input" name="proof_file"
														   id="payment_proof_file_input" type="file"
														   title="Click to add Files" accept=".jpg,.jpeg,.pdf,.png"
														   multiple>
													<label for="payment_proof_file_input" class="ml-0"> or Select a
														file</label>
												</div>
												<ul class="list-unstyled" id="files">
													<li class="text-muted text-center empty">No files
														uploaded.
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<button class="btn-orange add-new-user" id="submit_pay_proof" style="margin-top:10px"
									onclick="" type="submit">Submit
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- File item template -->
<script type="text/html" id="files-template">
	<li class="media">
		<div class="media-body">
			<p class="mb-2">
				<strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
				<a class="file-remove"><i class="fas fa-times" title="Remove file"
										  onclick="clear_file_input(this)"></i></a>
			</p>
			<div class="file-progress mb-3  d-none-cus">
				<div class="file-progress-bar progress-bar progress-bar-striped progress-bar-animated bg-primary"
					 role="progressbar"
					 style="width: 0%"
					 aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
				</div>
			</div>
		</div>
	</li>
</script>
