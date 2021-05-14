<aside class="<?php echo $_SESSION['user_type']==1 || $_SESSION['user_type']==2 ? 'col-lg-2' : 'col-lg-3' ?> column border-right">
    <div class="widget">
        <div class="tree_widget-sec">

            <ul>

                <?php

                $side_menu_user_uri = $this->uri->segment(1, 0);
                $side_menu_parent_uri = $this->uri->segment(2, 0);
                $side_menu_child_uri = $this->uri->segment(3, 0);
                $side_menu_uri = !empty($side_menu_parent_uri) && !empty($side_menu_child_uri) && !empty($side_menu_user_uri)? $side_menu_user_uri.'/'. $side_menu_parent_uri.'/'.$side_menu_child_uri : null ;

                $side_navigation = get_side_navigation($_SESSION['user_type']);

                if ($_SESSION['user_type']==1) {
                    $side_nav_job_count_su = get_post_count_su();
                }
                if ($_SESSION['user_type']==2) {
                    $side_nav_job_count = get_job_post_count();
                }

                if (isset($side_navigation) && !empty($side_navigation)) {
                    foreach ($side_navigation as $side_nav_element) {
                        if ($side_nav_element['parent_id'] == 0) {
                            $show_panel = false;
                            $navigation_parent = '';
                            $active = false;

                            foreach ($side_navigation as $sub_menu) {
                                if ($sub_menu['parent_id'] == $side_nav_element['id']) {
                                    $show_panel = true;
                                    $navigation_parent = 'inner-child';
                                }
                            }


                            ?>

                            <li class="<?php echo $navigation_parent ?>
                                <?php
                                if ($side_menu_parent_uri && $side_menu_parent_uri === $side_nav_element['item_name']) {
                                    echo  ' active-indicator';
                                    $active = true;
                                }
                                if ($show_panel===true) {
                                    echo ' nav-status';
                                }
                                ?>
                                ">
                                <a class="nav-main" <?php echo isset($side_nav_element['url']) ? 'href="'. base_url() . $side_nav_element['url'].'"' : '' ?>>
                                    <i class="<?php echo $side_nav_element['page_icon'] ?>"></i><?php echo $side_nav_element['page_title'] ?>
                                </a>
                                <?php if ($show_panel) {
                                    ?>
                                    <ul style="<?php echo $active==true ? 'display: block' : '' ?>" >
                                        <?php
                                        foreach ($side_navigation as $sub_menu) {
                                            if ($sub_menu['parent_id'] == $side_nav_element['id']) {
                                                ?>
                                                <li class="<?php
                                                if ($side_menu_uri && $side_menu_uri === $sub_menu['url']) {
                                                    echo  'active-indicator-sub';
                                                }
                                                ?>">
                                                    <a class="nav-sub" <?php echo isset($sub_menu['url']) && !empty($sub_menu['url']) ? 'href="'.base_url().$sub_menu['url'].'"': ''?>>
                                                        <?php
                                                        if ($sub_menu['counter']) {
                                                            echo $sub_menu['page_title'];
                                                            ?>
                                                                <span style="color: #f76618">
                                                                <?php
                                                                if (isset($side_nav_job_count)) {
                                                                    foreach ($side_nav_job_count as $j_post_type_key => $j_count) {
                                                                        if ($sub_menu['item_name'] === $j_post_type_key) {
                                                                            echo '(' . $j_count . ')';
                                                                        }
                                                                    }
                                                                } elseif (isset($side_nav_job_count_su)) {
                                                                    foreach ($side_nav_job_count_su as $j_post_type_key => $j_count) {
                                                                        if ($sub_menu['item_name'] === $j_post_type_key) {
                                                                            echo '('.$j_count.')';
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                                </span>
                                                                <?php
                                                        } else {
                                                            echo $sub_menu['page_title'];
                                                        }
                                                        ?>
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
                ?>
            </ul>
        </div>
    </div>


    <?php if ($_SESSION['user_type'] == 2) {
        $subscription = get_employer_subscription_data($this->session->company_id);
        ?>
        <div class="widget">
            <div class="row">
                <div class="extra-job-info col-md-12 cus-border">
                    <div class="">
                        <h6>Your Subscription</h6>
                        <p style="font-size: 14px;"><span><i class="la la-clock-o"></i> Expires on: <?php echo !empty($subscription->expiry_date) ? date('D dS M, Y ', strtotime($subscription->expiry_date)): '-'?></span>
                        </p>
                        <ul>
                            <li><i class="la la-caret-right"></i>
                                Available Job Posts : <span class="badge font-12 status bcg-completed"><?php echo ($subscription->no_of_posts) ?? '0' ?></span>
                            </li>
                            <li><i class="la la-caret-right"></i>
                                Total no. of jobs posted : <span class="badge font-12 status bcg-refer_back"><?php echo isset($side_nav_job_count) && !empty($side_nav_job_count['total_posts']) ? $side_nav_job_count['total_posts'] : '0' ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="extra-job-info col-md-12 cus-border">
                    <h6 class="mb-3 pt-0">Quick Stats</h6>
                    <span class="mb-0 pt-0 border-0"><i
                                class="la la-clipboard"></i><strong><?php echo isset($side_nav_job_count) && !empty($side_nav_job_count['total_posts']) ? $side_nav_job_count['total_posts'] : '0' ?></strong> Job Posted</span>
                    <span class="mb-0 pt-0 border-0"><i
                                class="la la-file-text"></i><strong><?php echo(get_no_of_application_count()) ?></strong> Application</span>
                    <span class="mb-0 pt-0 border-0"><i
                                class="la la-newspaper-o"></i><strong><?php echo isset($side_nav_job_count) && !empty($side_nav_job_count['active_post']) ? $side_nav_job_count['active_post'] : '0' ?></strong> Active Jobs</span>
                </div>
            </div>
        </div>
        <?php
    }
    ?>

</aside>
