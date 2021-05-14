<style type="text/css" xmlns="http://www.w3.org/1999/html">
	.inner-header {
		background-image: url('/assets/styles/images/resource/job_search_online.jpg');
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
                            <h3 class="tag_name">Blog</h3>
                            <span class="tag-other">Keep up to date with the latest news</span>
                        </div>
                        <div class="page-breacrumbs">
                            <ul class="breadcrumbs">
<!--                                <li><a href="--><?php //echo base_url() ?><!--" <span class="beta-tag"></span> title="">Home</a></li>-->
<!--                                <li><a title="" class="tag-other">Blog</a></li>-->

								<li ><a href="<?php echo base_url()?>" title="" class="tag-other">Home</a></li>
								<li ><a href="#" title="" class="tag-other">Blog</a></li>
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
                <div class="col-lg-9 column">
                    <div class="bloglist-sec">

                        <?php
                        if (isset($blogs) && !empty($blogs)){
                            foreach ($blogs as $blog){
                                ?>
                                <div class="blogpost style2">
                                    <div class="blog-posthumb">
                                        <a href="<?php echo !empty($blog['id']) ? base_url().'blog/view?post='. base64_encode($blog['id']) : '' ?>" title="">
                                            <img src="<?php echo !empty($blog['image_url']) ? BLOG_IMG_READ_DIR.$blog['image_url'] : '' ?>" alt="" />
                                        </a>
                                    </div>
                                    <div class="blog-postdetail">
                                        <ul class="post-metas">
                                            <li>
                                                <a href="#" title=""><i class="la la-calendar-o"></i>
                                                    <?php echo !empty($blog['date_posted']) ? date("F d, Y", strtotime($blog['date_posted'])) : '' ?>

                                                </a>
                                            </li>
<!--                                            <li><a class="metascomment" href="#" title=""><i class="la la-comments"></i>4 comments</a></li>-->
                                        </ul>
                                        <h3><a href="<?php echo !empty($blog['id']) ? base_url().'blog/view?post='. base64_encode($blog['id']) : '' ?>" title="">
                                                <?php echo !empty($blog['title']) ? $blog['title'] : '' ?>
                                            </a></h3>
                                        <p><?php echo !empty($blog['content']) ?  substr($blog['content'],0,300).'...'  : '' ?></p>
                                        <a class="bbutton" href="<?php echo !empty($blog['id']) ? base_url().'blog/view?post='. base64_encode($blog['id']) : '' ?>" title="">Read More <i class="la la-long-arrow-right"></i></a>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>

                        <!-- Blog Post -->

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
