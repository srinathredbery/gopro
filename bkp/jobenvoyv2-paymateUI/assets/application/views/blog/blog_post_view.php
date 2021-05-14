

<section>
    <div class="block no-padding  gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner2">
                        <div class="inner-title2">
                            <h3>Blog</h3>
                            <span>Keep up to date with the latest news</span>
                        </div>
                        <div class="page-breacrumbs">
                            <ul class="breadcrumbs">
                                <li><a href="<?php echo base_url() ?>" title="">Home</a></li>
                                <li><a title="">Blog</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if (isset($blog_post) && !empty($blog_post)){
    ?>
    <section>
        <div class="block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 column">
                        <div class="blog-single">
                            <div class="bs-thumb"><img src="<?php echo !empty($blog_post['image_url']) ? BLOG_IMG_READ_DIR.$blog_post['image_url'] : '' ?>" alt="" /></div>
                            <ul class="post-metas">
                                <li><a href="#" title=""><img src="<?php echo DEFAULT_PRO_PIC?>" alt="" /><?php echo !empty($blog_post['author']) ? $blog_post['author'] : ''?></a></li>
                                <li><a href="#" title=""><i class="la la-calendar-o"></i><?php echo !empty($blog_post['date_posted']) ? date("F d, Y", strtotime($blog_post['date_posted'])) : ''?></a></li>
<!--                                <li><a class="metascomment" href="#" title=""><i class="la la-comments"></i>4 comments</a></li>-->
                                <li><a href="#" title=""><i class="la la-file-text"></i><?php echo !empty($blog_post['tags']) ? $blog_post['tags'] : ''?></a></li></ul>
                            <h2><?php echo !empty($blog_post['title']) ? $blog_post['title'] : ''?></h2>

                            <?php echo !empty($blog_post['content']) ? $blog_post['content'] : ''?>

                            <div class="tags-share">
                                <div class="tags_widget">
                                    <span>Tags</span>
                                    <a href="#" title=""><?php echo !empty($blog_post['tags']) ? $blog_post['tags'] : ''?></a>
                                </div>
                                <div class="share-bar">
                                    <a href="#" title="" class="share-fb"><i class="fab fa-facebook"></i></a>
                                    <a href="#" title="" class="share-twitter"><i class="fab fa-twitter"></i></a>
                                    <span>Share</span>
                                </div>
                            </div>
                            <div class="post-navigation ">
                                <div class="post-hist prev">
                                    <a href="#" title=""><i class="la la-arrow-left"></i><span class="post-histext">Prev Post<i>Hey Job Seeker, It’s Time</i></span></a>
                                </div>
                                <div class="post-hist next">
                                    <a href="#" title=""><span class="post-histext">Next Post<i>11 Tips to Help You Get New</i></span><i class="la la-arrow-right"></i></a>
                                </div>
                            </div>

                            <!--                        <div class="comment-sec">-->
                            <!--                            <h3>4 Comments</h3>-->
                            <!--                            <ul>-->
                            <!--                                <li>-->
                            <!--                                    <div class="comment">-->
                            <!--                                        <div class="comment-avatar"> <img src="http://placehold.it/90x90" alt="" /> </div>-->
                            <!--                                        <div class="comment-detail">-->
                            <!--                                            <h3>Ali TUFAN</h3>-->
                            <!--                                            <div class="date-comment"><a href="#" title=""><i class="la la-calendar-o"></i>Jan 16, 2016 07:48 am</a></div>-->
                            <!--                                            <p>Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement tantaneously eel valiantly petted this along across highhandedly much. </p>-->
                            <!--                                            <a href="#" title=""><i class="la la-reply"></i>Reply</a>-->
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!--                                    <ul class="comment-child">-->
                            <!--                                        <li>-->
                            <!--                                            <div class="comment">-->
                            <!--                                                <div class="comment-avatar"> <img src="http://placehold.it/90x90" alt="" /> </div>-->
                            <!--                                                <div class="comment-detail">-->
                            <!--                                                    <h3>Rachel LOIS</h3>-->
                            <!--                                                    <div class="date-comment"><a href="#" title=""><i class="la la-calendar-o"></i>Jan 16, 2016 07:48 am</a></div>-->
                            <!--                                                    <p>Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement tantaneously eel valiantly petted this along across highhandedly much. </p>-->
                            <!--                                                    <a href="#" title=""><i class="la la-reply"></i>Reply</a>-->
                            <!--                                                </div>-->
                            <!--                                            </div>-->
                            <!--                                        </li>-->
                            <!--                                    </ul>-->
                            <!--                                </li>-->
                            <!--                                <li>-->
                            <!--                                    <div class="comment">-->
                            <!--                                        <div class="comment-avatar"> <img src="http://placehold.it/90x90" alt="" /> </div>-->
                            <!--                                        <div class="comment-detail">-->
                            <!--                                            <h3>Kate ROSELINE</h3>-->
                            <!--                                            <div class="date-comment"><a href="#" title=""><i class="la la-calendar-o"></i>Jan 16, 2016 07:48 am</a></div>-->
                            <!--                                            <p>Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement tantaneously eel valiantly petted this along across highhandedly much. </p>-->
                            <!--                                            <a href="#" title=""><i class="la la-reply"></i>Reply</a>-->
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!--                                </li>-->
                            <!--                                <li>-->
                            <!--                                    <div class="comment">-->
                            <!--                                        <div class="comment-avatar"> <img src="http://placehold.it/90x90" alt="" /> </div>-->
                            <!--                                        <div class="comment-detail">-->
                            <!--                                            <h3>Luis DANIEL</h3>-->
                            <!--                                            <div class="date-comment"><a href="#" title=""><i class="la la-calendar-o"></i>Jan 16, 2016 07:48 am</a></div>-->
                            <!--                                            <p>Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement tantaneously eel valiantly petted this along across highhandedly much. </p>-->
                            <!--                                            <a href="#" title=""><i class="la la-reply"></i>Reply</a>-->
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!--                                </li>-->
                            <!--                            </ul>-->
                            <!--                        </div>-->
                            <!--                        <div class="commentform-sec">-->
                            <!--                            <h3>Leave a Reply</h3>-->
                            <!--                            <form>-->
                            <!--                                <div class="row">-->
                            <!--                                    <div class="col-lg-12">-->
                            <!--                                        <span class="pf-title">Description</span>-->
                            <!--                                        <div class="pf-field">-->
                            <!--                                            <textarea></textarea>-->
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!--                                    <div class="col-lg-8">-->
                            <!--                                        <span class="pf-title">Full Name</span>-->
                            <!--                                        <div class="pf-field">-->
                            <!--                                            <input type="text" placeholder="ALi TUFAN" />-->
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!--                                    <div class="col-lg-8">-->
                            <!--                                        <span class="pf-title">Email</span>-->
                            <!--                                        <div class="pf-field">-->
                            <!--                                            <input type="text" placeholder="" />-->
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!--                                    <div class="col-lg-8">-->
                            <!--                                        <span class="pf-title">Phone</span>-->
                            <!--                                        <div class="pf-field">-->
                            <!--                                            <input type="text" placeholder="" />-->
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!--                                    <div class="col-lg-12">-->
                            <!--                                        <button type="submit">Post Comment</button>-->
                            <!--                                    </div>-->
                            <!--                                </div>-->
                            <!--                            </form>-->
                            <!--                        </div>-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}
?>



<!--Login pop up-->
<?php $this->load->view('general/login_popup')?>

<!--Sign up pop up-->
<?php $this->load->view('general/signup_popup')?>
