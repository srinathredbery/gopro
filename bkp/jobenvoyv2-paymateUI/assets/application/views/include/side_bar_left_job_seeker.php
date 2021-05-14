<aside class="col-lg-3 column border-right">
    <div class="widget">
        <div class="tree_widget-sec">
            <ul>
                <?php
                $side_menu_user_uri = $this->uri->segment(1, 0);
                $side_menu_parent_uri = $this->uri->segment(2, 0);
                $side_menu_child_uri = $this->uri->segment(3, 0);
                $side_menu_uri = !empty($side_menu_parent_uri) && !empty($side_menu_child_uri) && !empty($side_menu_user_uri)? $side_menu_user_uri.'/'. $side_menu_parent_uri.'/'.$side_menu_child_uri : NULL ;

                $side_navigation = get_side_navigation($_SESSION['user_type']);
//                $side_nav_job_count = get_job_post_count();
                if ( isset($side_navigation) && !empty($side_navigation)) {
                    foreach ($side_navigation as $side_nav_element) {
                        if ($side_nav_element['parent_id'] == 0) {
                            $show_panel = false;
                            $navigation_parent = '';
                            $active = FALSE;

                            foreach ($side_navigation as $sub_menu) {
                                if ($sub_menu['parent_id'] == $side_nav_element['id']) {
                                    $show_panel = true;
                                    $navigation_parent = 'inner-child';
                                }
                            }
                            ?>
                            <li class="<?php echo $navigation_parent ?>
                                <?php
                            if($side_menu_parent_uri && $side_menu_parent_uri === $side_nav_element['item_name']){
                                echo  ' active-indicator';
                                $active = TRUE;
                            }
                            if ($show_panel===TRUE)
                                echo ' nav-status';
                            ?>
                                ">
                                <a class="nav-main" <?php echo isset($side_nav_element['url']) ? 'href="'. base_url() . $side_nav_element['url'].'"' : '' ?>>
                                    <i class="<?php echo $side_nav_element['page_icon'] ?>"></i><?php echo $side_nav_element['page_title'] ?>
                                </a>
                                <?php if ($show_panel) {
                                    ?>
                                    <ul style="<?php echo $active==TRUE ? 'display: block' : '' ?>">
                                        <?php
                                        foreach ($side_navigation as $sub_menu) {
                                            if ($sub_menu['parent_id'] == $side_nav_element['id']) {
                                                ?>
                                                <li class="<?php
                                                if($side_menu_uri && $side_menu_uri === $sub_menu['url']){
                                                    echo  'active-indicator-sub';
                                                }
                                                ?>">
                                                    <a class="nav-sub" <?php echo isset($sub_menu['url']) && !empty($sub_menu['url']) ? 'href="'.base_url().$sub_menu['url'].'"': ''?>>
                                                        <?php
                                                        if($sub_menu['counter']){
                                                            echo $sub_menu['page_title'];
                                                            ?>
                                                            <span style="color: #f76618">
                                                                    <?php
                                                                if (isset($side_nav_job_count)){
                                                                    foreach ($side_nav_job_count as $j_post_type_key => $j_count) {
                                                                        if ($sub_menu['item_name'] === $j_post_type_key)
                                                                            echo '('.$j_count.')';
                                                                    }
                                                                }
                                                                ?>
                                                            </span>
                                                            <?php
                                                        }
                                                        else{
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
</aside>
