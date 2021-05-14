<section>
    <div class="block no-padding">
        <div class="container-fluid">
            <div class="row no-gape">

                <!--include side bar for employer-->
                <?php $this->load->view('include/side_bar_left_employer') ?>

                <div class="col-lg-9 column">
                    <div class="padding-left">
                        <div class="manage-jobs-sec pending-approval">
                            <h3>All Employers</h3>

							<table id="manage_employers" class="table" style="width:100%">
								<thead>
								<tr>
									<th>#</th>
									<th></th>
									<th>Company Name</th>
									<th>Email</th>
									<th>Contact No</th>
									<th>Joined Date</th>
									<th>Action</th>
								</tr>
								</thead>
							</table>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo base_url()?>assets/custom/su_manage_users.js<?php echo '?build='.BUILD_NO?>" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/datatables.js" type="text/javascript"></script>
