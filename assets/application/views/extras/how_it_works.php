<style type="text/css" xmlns="http://www.w3.org/1999/html">
	.inner-header {
		background-image: url('/assets/styles/images/resource/mslider3.jpg');
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
                            <h3 class="tag_name">How It Works</h3>
                            <span class="tag-other">Find out how Jobevnoy works for you</span>
                        </div>
                        <div class="page-breacrumbs">
                            <ul class="breadcrumbs">
                                <li ><a href="<?php echo base_url()?>" title="" class="tag-other">Home</a></li>
                                <li ><a href="#" title="" class="tag-other">How it Works</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="how-works">
                        <div class="how-workimg"><img src="<?php echo base_url().'assets/styles/images/how_it_works_1.png'?>" alt="" /></div>
                        <div class="how-work-detail">
                            <div class="how-work-box">
                                <span>1</span>
                                <i class="la la-user"></i>
                                <h3>Register and Upload Your CV</h3>
                                <p>Sign up as a jobseeker to reach out to the greatest Employers, Attach your own CV or build your CV on our system.</p>
                            </div>
                        </div>
                    </div>
                    <div class="how-works flip">
                        <div class="how-workimg"><img src="<?php echo base_url().'assets/styles/images/how_it_works_2.png'?>" alt="" /></div>
                        <div class="how-work-detail">
                            <div class="how-work-box">
                                <span>2</span>
                                <i class="la la-file-text"></i>
                                <h3>Create Your Job Alert</h3>
                                <p>Your Search History will automatically be your Job Alert Agent, sending you the most relevant jobs to your inbox.</p>
                            </div>
                        </div>
                    </div>
                    <div class="how-works">
                        <div class="how-workimg"><img src="<?php echo base_url().'assets/styles/images/how_it_works_3.png'?>" alt="" /></div>
                        <div class="how-work-detail">
                            <div class="how-work-box">
                                <span>3</span>
                                <i class="la la-pencil"></i>
                                <h3>Apply For Jobs</h3>
                                <p>Click to apply on the Job you have been waiting for and your CV will directly be recommended to the Employer.</p>
                            </div>
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
