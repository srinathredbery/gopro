<div class="page-loading">
    <img src="<?php echo base_url() ?>assets/styles/images/loader.gif" alt=""/>
</div>

<div class="theme-layout" id="scrollup">

    <div class="responsive-header">
        <div class="responsive-menubar">
            <div class="res-logo"><a href="<?php echo base_url() ?>" title=""><img class="cus-logo"
                                                                                   src="<?php echo base_url() ?>assets/styles/images/logo-half-white.png"
                                                                                   alt=""/></a>
                <span class="beta-tag"></span>
            </div>
            <div class="menu-resaction">
                <div class="res-openmenu">
                    <img src="<?php echo base_url() ?>assets/styles/images/icon.png" alt=""/> Menu
                </div>
                <div class="res-closemenu">
                    <img src="<?php echo base_url() ?>assets/styles/images/icon2.png" alt=""/> Close
                </div>
            </div>
        </div>
        <div class="responsive-opensec">
            <div class="btn-extars">
                <div class="btns-profiles-sec responsive-user-control">
                    <span><?php
                        echo isset($_SESSION['jobseeker_first_name'])? $_SESSION['jobseeker_first_name']:$_SESSION['email'] ?>
                        <img src="<?php echo isset($_SESSION['jobseeker_dp_url']) || !empty($_SESSION['jobseeker_dp_url'])? base_url().'uploads/user_dp/'.$_SESSION['jobseeker_dp_url'] : base_url().'assets/styles/images/defaults/pro_pic.png'?>" alt=""><i class="la la-angle-down"></i>
                    </span>
                    <ul>
                        <li><a href="<?php echo base_url().'dashboard'?>" title=""><i class="la la-dashboard"></i> My Dashboard</a></li>
                        <li><a href="<?php echo base_url().'logout'?>" title=""><i class="la la-sign-out"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
            <!-- Btn Extras -->

            <form class="res-search">
                <input type="text" placeholder="Job title, keywords or company name"/>
                <button type="submit"><i class="la la-search"></i></button>
            </form>

            <div class="responsivemenu">
                <ul>

                    <?php
                    $navigation_top_menu_main = get_top_navigation();

                    if (!empty($navigation_top_menu_main)) {

                        foreach ($navigation_top_menu_main as $element) {

                            if (isset($element['parent_id'])) {
                                if ($element['parent_id'] == 0) {

                                    $show_panel = false;
                                    $show_navigation_sub_menu_icon = 'menu-item';

                                    foreach ($navigation_top_menu_main as $sub_menu) {
                                        if ($sub_menu['parent_id'] == $element['id']) {
                                            $show_panel = true;
                                            $show_navigation_sub_menu_icon = 'menu-item-has-children';
                                        }
                                    }
                                    ?>

                                    <li class="<?php echo $show_navigation_sub_menu_icon ?>">
                                        <a href="<?php echo isset($element['url']) ? base_url() . $element['url'] : '' ?>"
                                           title="">
                                            <?php echo $element['page_title'] ?>
                                        </a>
                                        <?php
                                        if ($show_panel) {
                                            ?>
                                            <ul>
                                                <?php
                                                foreach ($navigation_top_menu_main as $sub_menu) {
                                                    if ($sub_menu['parent_id'] == $element['id']) {
                                                        ?>
                                                        <li>
                                                            <a href="<?php echo isset($sub_menu['url']) ? base_url() . $sub_menu['url'] : '' ?>"
                                                               title="">
                                                                <?php echo $sub_menu['page_title'] ?>
                                                            </a>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                            <?php
                                        }
                                        ?>
                                    </li>
                                    <?php
                                }
                            }
                        }
                    }
                    ?>

                </ul>
            </div>
        </div>
    </div>

    <header class="gradient">
        <div class="menu-sec">
            <div class="container">
                <div class="logo">
                    <a href="<?php echo base_url() ?>" title=""><img class="cus-logo" src="<?php echo base_url()?>assets/styles/images/logo-half-white.png" alt=""/></a>
                    <span class="beta-tag"></span>
                </div><!-- Logo -->
                <div class="btns-profiles-sec">
                    <span><img src="<?php echo isset($_SESSION['jobseeker_dp_url']) || !empty($_SESSION['jobseeker_dp_url'])? base_url().'uploads/user_dp/'.$_SESSION['jobseeker_dp_url'] : base_url().'assets/styles/images/defaults/pro_pic.png'?>" alt=""/>
						<?php echo isset($_SESSION['jobseeker_first_name'])? $_SESSION['jobseeker_first_name']:$_SESSION['email'] ?><i class="la la-bars"></i></span>
                    <ul>
                        <li><a href="<?php echo base_url().'dashboard'?>" title=""><i class="la la-tachometer"></i> My Dashboard</a></li>
                        <li><a href="<?php echo base_url().'logout'?>" title=""><i class="la la-sign-out"></i> Logout</a></li>
                    </ul>
                </div>
                <div class="wishlist-dropsec">
                    <span>
						<i class="la la-bell">

						</i>
						<strong><?php echo get_top_navigation2_count(); ?></strong>
					</span>
                    <div class="wishlist-dropdown">
                        <ul class="scrollbar">
							<?php


							$navigation_top_menu_main2 = get_top_navigation2();
							foreach ($navigation_top_menu_main2 as $sub_menu) {
								?>
								<li>
									<div class="job-listing" onclick="getNotyfy1(<?php echo $sub_menu['idats_schedule_interview']; ?>)">
										<div class="job-title-sec">
											<div class="c-logo"><img src="http://placehold.it/98x51" alt=""/></div>
											<h3><a href="#" title="">Interview Details</a></h3>
											<span id="location_<?php echo $sub_menu['idats_schedule_interview']; ?>"><?php echo 'Location :'.$sub_menu['location']; ?></span> <br>
											<span id="address_<?php echo $sub_menu['idats_schedule_interview']; ?>"><?php echo 'Address :'.$sub_menu['address_l1'].',<br>'.$sub_menu['address_l2'].','.$sub_menu['city']; ?></span>
											<span id="room_<?php echo $sub_menu['idats_schedule_interview']; ?>"><?php echo 'Room No :'.$sub_menu['room_no']; ?></span> <br>
											<span id="date_<?php echo $sub_menu['idats_schedule_interview']; ?>"><?php echo 'Date :'.$sub_menu['date']; ?></span>
											<span id="job_<?php echo $sub_menu['idats_schedule_interview']; ?>"><?php echo 'Job Title :'.$sub_menu['job_post_title']; ?></span>
											<span style="display: none;" id="jobs_<?php echo $sub_menu['idats_schedule_interview']; ?>"><?php echo 'Start Time :'.$sub_menu['strat_time_hr'].':'.$sub_menu['strat_time_min']; ?></span>
											<span style="display: none;" id="jobd_<?php echo $sub_menu['idats_schedule_interview']; ?>"><?php echo 'Duration Time :'.$sub_menu['duration_hr'].':'.$sub_menu['duration_min']; ?></span>
											<span style="display: none;" id="jobname_<?php echo $sub_menu['idats_schedule_interview']; ?>"><?php echo 'Interviewer:' . $sub_menu['i_name']; ?></span>
											<span style="display: none;" id="contact_<?php echo $sub_menu['idats_schedule_interview']; ?>"><?php echo 'Contact Number:' . $sub_menu['contact_number']; ?></span>


										</div>
									</div>
								</li>

								<?php
							}
							?>

<!--                            <li>-->
<!--                                <div class="job-listing">-->
<!--                                    <div class="job-title-sec">-->
<!--                                        <div class="c-logo"><img src="http://placehold.it/98x51" alt=""/></div>-->
<!--                                        <h3><a href="#" title="">Web Designer / Developer</a></h3>-->
<!--                                        <span>Massimo Artemisis</span>-->
<!--                                    </div>-->
<!--                                </div>  -->
<!--                            </li>-->
                        </ul>
                    </div>
                </div>
                <nav>

                    <ul>
                        <?php
                        $navigation_top_menu_main = get_top_navigation();

                        if (!empty($navigation_top_menu_main)) {

                            foreach ($navigation_top_menu_main as $element) {

                                if (isset($element['parent_id'])) {
                                    if ($element['parent_id'] == 0) {

                                        $show_panel = false;
                                        $show_navigation_sub_menu_icon = 'menu-item';

                                        foreach ($navigation_top_menu_main as $sub_menu) {
                                            if ($sub_menu['parent_id'] == $element['id']) {
                                                $show_panel = true;
                                                $show_navigation_sub_menu_icon = 'menu-item-has-children';
                                            }
                                        }
                                        ?>

                                        <li class="<?php echo $show_navigation_sub_menu_icon ?>">
                                            <a href="<?php echo isset($element['url']) ? base_url() . $element['url'] : '' ?>"
                                               title="">
                                                <?php echo $element['page_title'] ?>
                                            </a>
                                            <?php
                                            if ($show_panel) {
                                                ?>
                                                <ul>
                                                    <?php
                                                    foreach ($navigation_top_menu_main as $sub_menu) {
                                                        if ($sub_menu['parent_id'] == $element['id']) {
                                                            ?>
                                                            <li>
                                                                <a href="<?php echo isset($sub_menu['url']) ? base_url() . $sub_menu['url'] : '' ?>"
                                                                   title="">
                                                                    <?php echo $sub_menu['page_title'] ?>
                                                                </a>
                                                            </li>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                                <?php

                                            }

                                            ?>

                                        </li>
                                        <?php
                                    }
                                }
                            }
                        }
                        ?>
                    </ul>
                </nav><!-- Menus -->
            </div>
        </div>
    </header>

	<script>
		function getNotyfy1(id){

			var html='htmjshaidiuadha8u';
			var location=$('#location_'+id).text();
			var address=$('#address_'+id).text();
			var room=$('#room_'+id).text();
			var date=$('#date_'+id).text();
			var job=$('#job_'+id).text();
			var jobs=$('#jobs_'+id).text();
			var jobd=$('#jobd_'+id).text();
			var jobname=$('#jobname_'+id).text();
			var contact=$('#contact_'+id).text();
			swal.fire({
				title: 'Are you sure?',
				html: '<b>'+job+'</b><br>You have done great in your ATS Exam! You are invited for an interview. Please find the interview details below and select confirm if you will be attending the interview, ' +
						'<div class="text-left"><br>'+location+
						'<br>'+address+
						'<br>'+room+
						'<br>'+date+
						'<br>'+jobs+
						'<br>'+jobd+
						'<br>'+jobname+
						'<br>'+contact+'</div>',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, confirm it!'
			}).then((result) => {
				if (result.value) {
					//
					$.ajax({
						type: 'GET',
						dataType: 'JSON',
						url: base_url + 'job_seeker/job_posts_view/ats_interview_confirm',
						data: {id: id},
						cache: false,
						beforeSend: function () {
							HoldOn.open(loader_options);
						},
						success: function (data) {
							HoldOn.close();

						},
						error: function (jqXHR, textStatus, errorThrown) {
							HoldOn.close();
							// heads_up_error();
						}
					});

					swal.fire(
							'confirm!',
							'Your interview has been confirm.',
							'success'
					)

				}
			})
		}
	</script>


