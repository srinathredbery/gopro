<section>
    <div class="block no-padding">
        <div class="container-fluid">
            <div class="row no-gape">

                <!--include side bar for employer-->
                <?php $this->load->view('include/side_bar_left_employer') ?>

                <div class="col-lg-9 column  mb-5">
                    <div class="padding-left">
                        <div class="manage-jobs-sec pending-approval">
                            <h3>All Ads</h3>

                            <table id="pending_post_approval" class="table" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Ad Name</th>
                                    <th>Client</th>
                                    <th>Expiry Date</th>
                                    <th>Clicks</th>
									<th></th>
									<th></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                if(isset($all_ads) && !empty($all_ads)){

                                    foreach ($all_ads as $post){
                                        ?>
                                        <tr data-ad_id = <?php echo !empty($post['id']) ?  $post['id'] :''?>>
                                            <td>
                                                <div class="table-list-title">
                                                    <h3 class="font-weight-bold">
                                                        <?php echo !empty($post['adv_name']) ?  substr($post['adv_name'], 0, 30) :''?>
                                                    </h3>
                                                </div>
                                            </td>
                                            <td>
                                                <span><?php echo !empty($post['company_name']) ?  $post['company_name'] :''?></span>
                                            </td>
                                            <td>
                                                <span><?php echo !empty($post['adv_expiry']) ? '<i class="la la-calendar"></i>'.date('dS M Y', strtotime($post['adv_expiry'])) : ''?></span>
                                            </td>
											<td>
												<span><?php echo !empty($post['ad_click_count']) ?  $post['ad_click_count'] :''?></span>
											</td>
                                            <td>
                                                <div class="toggle-group">
                                                    <input type="checkbox" name="on-off-switch" onchange="switch_ads(this)" id="<?php echo isset($post['id']) ? $post['id'] : ''?>" tabindex="1"
                                                        <?php
                                                        if(isset($post['is_active']) && $post['is_active'])
                                                            echo 'checked';
                                                        ?>
                                                    >
                                                    <label for="<?php echo isset($post['id']) ? $post['id'] : ''?>">

                                                    </label>
                                                    <div class="onoffswitch" aria-hidden="true">
                                                        <div class="onoffswitch-label">
                                                            <div class="onoffswitch-inner"></div>
                                                            <div class="onoffswitch-switch"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="action-resume">
                                                    <div class="action-center">
                                                        <span>More <i class="la la-angle-down"></i></span>
                                                        <ul>
                                                            <li onclick="view_ad(this)">
                                                                <a  title="">
                                                                    <i class="la la-eye"></i> &nbsp; View Ad
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a title="" href="<?php echo !empty($post['id']) ? base_url().'superuser/ads/manage/edit?adv_id='.$post['id'] : ''?>">
                                                                    <i class="la la-edit"></i> &nbsp; Edit
                                                                </a>
                                                            </li>
                                                            <li onclick="delete_ads(this)">
                                                                <a title="">
                                                                    <i class="la la-trash-o"></i> &nbsp; Delete
                                                                </a>
                                                            </li>
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

<div class="account-popup-area modal-popup-area" id="ad_preview">
    <div class="account-popup modal-popup resume-modal">
        <span class="close-popup"><i class="la la-close"></i></span>

        <div class="profile-title">
            <h3>Ad Info</h3>
        </div>

        <div class="profile-form-edit">
			<div class="col-md-12">
				<ul class="list-group list-group-flush" style="font-size: 13px">
					<li class="list-group-item">
						<span>Company Name: </span>
						<span id="company_name"> </span>
					</li>
					<li class="list-group-item">
						<span>Contact Person: </span>
						<span id="company_contact_person"></span>
					</li>
					<li class="list-group-item">
						<span>Contact Number: </span>
						<span id="company_contact_country_code"></span>
						<span id="company_contact_no"></span>
					</li>
					<li class="list-group-item">
						<span>Contact Email: </span>
						<span id="company_contact_email"></span>
					</li>
					<li class="list-group-item">
						<span>Ad Campaign: </span>
						<span id="adv_name"></span>
					</li>
					<li class="list-group-item">
						<span>Activates on: </span>
						<span id="adv_activate"></span>
					</li>
					<li class="list-group-item">
						<span>Expires on: </span>
						<span id="adv_expiry"></span>
					</li>
					<li class="list-group-item">
						<span>Banner Type: </span>
						<span id="banner_type"></span>
					</li>
					<li class="list-group-item">
						<span>Banner Location Spot: </span>
						<span id="adv_spot_name"></span>
					</li>
				</ul>
			</div>
        </div>
		<div class="profile-form-edit banner-img-set mt-3">
			<h6>Ad Preview</h6>
			<img id="ad_preview_img" src="" alt="">
		</div>
    </div>
</div>

<script src="<?php echo base_url()?>assets/custom/su_approve.js<?php echo '?build='.BUILD_NO?>" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/datatables.js" type="text/javascript"></script>
