<body>

<div class="page-loading">
    <img src="<?php echo base_url() ?>assets/styles/images/loader.gif" alt=""/>
</div>

<div class="theme-layout" id="scrollup">

    <div class="responsive-header">
        <div class="responsive-menubar">
            <div class="res-logo"><a href="<?php echo base_url() ?>" title="">
<img class="cus-logo img-fluid" src="<?php echo base_url() ?>assets/styles/images/OMRAN_logo.png" alt=""/></a>
                    <!-- <img class="cus-logo img-fluid" src="<?php echo base_url() ?>assets/styles/images/rb_jobs/logo-white2.png" alt=""/> --></a>
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
                <a href="<?php echo base_url().'employer/job_posts/post_new'?>" title="" class="post-job-btn"><i class="la la-plus"></i>Post Jobs</a>

                <div class="btns-profiles-sec responsive-user-control">
                    <span><?php
                        echo isset($_SESSION['first_name'])? $_SESSION['first_name']: $_SESSION['email'];
                    ?>
                        <img class="avatar-img" src="<?php echo isset($_SESSION['jobseeker_dp_url']) || !empty($_SESSION['jobseeker_dp_url'])? base_url().'uploads/user_dp/'.$_SESSION['jobseeker_dp_url'] : base_url().'assets/styles/images/defaults/pro_pic.png'?>" alt="">
                     
                    <i class="la la-angle-down"></i></span>
                    <ul>
                        <li><a href="<?php echo base_url().'dashboard'?>" title=""><i class="la la-user"></i>Dashboard</a></li>
                        <li><a href="<?php echo base_url() . 'logout' ?>" title=""><i class="la la-sign-out"></i> Logout</a>
                        </li>
                    </ul>
                </div>

            </div><!-- Btn Extras -->
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
                                        <a href=""<?php echo isset($element['url']) ? base_url() . $element['url'] : '' ?>
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
                    <a href="<?php echo base_url() ?>" title="">
                        <img class="cus-logo img-fluid" src="<?php echo base_url() ?>assets/styles/images/OMRAN_logo.png" alt=""/></a>
                    <!--    <img class="cus-logo img-fluid" src="<?php echo base_url() ?>assets/styles/images/rb_jobs/logo-white2.png" alt=""/></a> -->
                    <span class="beta-tag"></span>
                </div><!-- Logo -->
                <div class="btns-profiles-sec">
                    <span><img class="avatar-img" src="<?php echo isset($_SESSION['jobseeker_dp_url']) || !empty($_SESSION['jobseeker_dp_url'])? base_url().'uploads/user_dp/'.$_SESSION['jobseeker_dp_url'] : base_url().'assets/styles/images/defaults/pro_pic.png'?>" alt="">
                        <?php echo isset($_SESSION['employer_name'])? $_SESSION['employer_name']: $_SESSION['email']; ?>
                        <i class="la la-navicon"></i></span>
                    <ul>
                        <li><a href="<?php echo base_url().'dashboard'?>" title=""><i class="la la-tachometer"></i>Dashboard</a></li>
                        <li><a href="<?php echo base_url() . 'logout' ?>" title=""><i class="la la-sign-out"></i> Logout</a>
                        </li>
                    </ul>
                </div>
                <?php if (get_user_type() == 2) : ?>
                    <div class="btn-extars">
                        <a href="<?php echo base_url() . 'employer/job_posts/post_new' ?>" title=""
                           class="post-job-btn"><i class="la la-plus"></i>Post Jobs</a>
                    </div>
                <?php endif ?>
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
