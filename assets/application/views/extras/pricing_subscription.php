<style type="text/css" xmlns="http://www.w3.org/1999/html">
	.inner-header {
		background-image: url('/assets/styles/images/resource/plan.png');
		background-repeat: no-repeat;
		background-size: cover;
		padding-top: 108px;

	}
	.tag_name {
		color: #ddd !important;
	}
	.tag-other {
		color: #ddd !important;
	}

</style>


<section>
    <div class="inner-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner2">
                        <div class="inner-title2">
                            <h3 class="tag_name">Pricing</h3>
                            <span class="tag-other">Keep up to date with the latest news</span>
                        </div>
                        <div class="page-breacrumbs">
                            <ul class="breadcrumbs"  >
                                <li><a class="tag-other" href="#" title="" >Home</a></li>
                                <li><a class="tag-other" href="#" title="">Pages</a></li>
                                <li><a class="tag-other" href="#" title="" >Pricing</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block">
        <div class="container">
            <div class="row">
				<div class="col-lg-12">
					<div class="heading">
						<h2>Buy Our Plans And Packages</h2>
						<span>One of our jobs has some kind of flexibility option - such as telecommuting, a part-time schedule or a flexible or flextime schedule.</span>
					</div><!-- Heading -->
					<div class="plans-sec pLR35">
						<div class="row justify-content-md-center">

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
									<div class="col-lg-3 wow slideInUp" data-wow-duration="1s">
										<div class="pricetable">
											<div class="pricetable-head">
												<h3><?php echo !empty($plan['plan_name'])? $plan['plan_name'] : ''?></h3>
												<h2>
													<i><?php echo !empty($plan['price_currency'])? $plan['price_currency'] : ''?></i>
													<?php echo !empty($plan['price_value'])? number_format($plan['price_value'],2) : ''?>
												</h2>
												<span>
													<?php echo !empty($plan['no_of_allowed_post'])? $plan['no_of_allowed_post']. ' Job Posts' : ''?>
												</span>
												<span>
													<?php echo !empty($plan['validity_period']) && !empty($plan['validity_period']) ? $plan['validity_period'] : '' ?>
												</span>
											</div><!-- Price Table -->
											<ul>
												<li>Maximum no of posts : <?php echo !empty($plan['no_of_allowed_post'])? $plan['no_of_allowed_post'] : ''?></li>
												<li>Period : 	<span>
													<?php echo !empty($plan['validity_period']) && !empty($plan['validity_period']) ? $plan['validity_period'] : '' ?>
												</span></li>
												<li>Currency : LKR</li>
											</ul>
											<a class="btn-buy" href="<?php echo !empty($plan['id']) ?  base_url('employer/subscription/plans/view_plan?pkg='.$plan['id']) : '' ?>" title="">SUBSCRIBE</a>
										</div>
									</div>
									<?php
								}
							}
							?>
<!--							<div class="col-lg-3 wow slideInUp" data-wow-duration="2s">-->
<!--								<div class="pricetable active">-->
<!--									<div class="pricetable-head">-->
<!--										<h3>Recommended</h3>-->
<!--										<h2><i>LKR</i>20,000</h2>-->
<!--										<span>20 Days</span>-->
<!--									</div>-->
<!--									<ul>-->
<!--										<li>Maximum no of posts : 5</li>-->
<!--										<li>Period : 3</li>-->
<!--										<li>Currency : LKR</li>-->
<!--									</ul>-->
<!--									<a class="btn-buy" href="#" title="">BUY NOW</a>-->
<!--								</div>-->
<!--							</div>							-->
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
</section>

<!--//modifi Heder screen-->
<!--<script type="text/javascript">-->
<!--	$(".gradient").attr("class","stick-top forsticky");-->
<!--</script>-->
<!--Login pop up-->
<?php $this->load->view('general/login_popup')?>

<!--Sign up pop up-->
<?php $this->load->view('general/signup_popup')?>
