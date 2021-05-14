<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

//Get user tyoe
if (!function_exists('get_user_type')) {
    function get_user_type()
    {
        if (isset($_SESSION['logged_in'])) {
            $user_type = $_SESSION['user_type'];
        }

        return $user_type;
    }
}

//Get top navigation meu per user
if (!function_exists('get_top_navigation')) {
    function get_top_navigation()
    {
        if (isset($_SESSION['logged_in'])) {
            if ($_SESSION['logged_in']) {
                $CI =& get_instance();
                $CI->db->select('*');
                $CI->db->from('navigation_top');
                $CI->db->join('navigation_top_user_access', 'navigation_top.id = navigation_top_user_access.menu_id');
                $CI->db->where('is_active', '1');
                $CI->db->where('user_type_id', get_user_type());
                $CI->db->order_by('sort_order', 'asc');
                return $CI->db->get()->result_array();
            }
        } else {
            $CI =& get_instance();
            $CI->db->select('*');
            $CI->db->from('navigation_top');
//            $CI->db->join('navigation_top_user_access','navigation_top.id = navigation_top_user_access.menu_id');
            $CI->db->where('is_active', '1');
//            $CI->db->where('user_type_id', get_user());
            $CI->db->order_by('sort_order', 'asc');
            return $CI->db->get()->result_array();
        }
    }
}


//Get top navigation meu per user
if (!function_exists('get_interviewer')) {
    function get_interviewer()
    {
        if (isset($_SESSION['logged_in'])) {
            if ($_SESSION['logged_in']) {
                $CI =& get_instance();
                $CI->db->select('*');
                $CI->db->where('user_id', $_SESSION['user_id']);
                $CI->db->from('ats_interviewer_list');

                return $CI->db->get()->result_array();
            }
        }
    }
}
//get_interviewer_location
if (!function_exists('get_interviewer_location')) {
    function get_interviewer_location()
    {
        if (isset($_SESSION['logged_in'])) {
            if ($_SESSION['logged_in']) {
                $CI =& get_instance();
                $CI->db->select('*');
                $CI->db->where('user_id', $_SESSION['user_id']);
                $CI->db->from('ats_interviewer_details');

                return $CI->db->get()->result_array();
            }
        }
    }
}



if (!function_exists('get_contact_details')) {
    function get_contact_details()
    {
        if (isset($_SESSION['logged_in'])) {
            if ($_SESSION['logged_in']) {
                $CI =& get_instance();
                $CI->db->select('*');
                $CI->db->where('employer_id', $_SESSION['employer_id']);
                $CI->db->from('employer');

                return $CI->db->get()->result_array();
            }
        }
    }
}







//Get top navigation meu per user
if (!function_exists('get_top_navigation2')) {
    function get_top_navigation2()
    {
        if (isset($_SESSION['logged_in'])) {
            if ($_SESSION['logged_in']) {
                $user_id=$_SESSION['user_id'];
                $CI =& get_instance();
                $CI->db->select('ats_schedule_interview.emp_id as emp_id,ats_schedule_interview.*,job_posts.job_post_title as job_post_title,ats_interviewer_list.name as i_name,ats_interviewer_list.contact_number as contact_number,ats_schedule_interview.strat_time_min as strat_time_min,ats_schedule_interview.duration_hr as duration_hr,ats_schedule_interview.duration_min as duration_min,ats_interviewer_details.location as location,ats_interviewer_details.room_no as room_no,ats_interviewer_details.address_l1 as address_l1,ats_interviewer_details.address_l2 as address_l2,ats_interviewer_details.city as city');
                $CI->db->from('ats_schedule_interview');
                $CI->db->join('job_posts', 'job_posts.job_post_id = ats_schedule_interview.job_post_id', 'inner');
                $CI->db->join('ats_interviewer_list', 'ats_interviewer_list.idinterviewer_list = ats_schedule_interview.interviewer', 'inner');
                $CI->db->join('ats_interviewer_details', 'ats_interviewer_details.idinterviewer_details = ats_schedule_interview.location', 'inner');

                $CI->db->where('ats_schedule_interview.emp_id', $user_id);
                return $CI->db->get()->result_array();
            }
        }
    }
}

//get_top_navigation2_count
if (!function_exists('get_top_navigation2_count')) {
    function get_top_navigation2_count()
    {
        if (isset($_SESSION['logged_in'])) {
            if ($_SESSION['logged_in']) {
                $user_id=$_SESSION['user_id'];
                $CI =& get_instance();
                $CI->db->select('*');
                $CI->db->from('ats_schedule_interview');
                $CI->db->join('job_posts', 'job_posts.job_post_id = ats_schedule_interview.job_post_id', 'inner');
                $CI->db->where('ats_schedule_interview.emp_id', $user_id);
                $CI->db->where('ats_schedule_interview.status_confirm', 0);
                $CI->db->where('ats_schedule_interview.notyfy_status', 0);//notyfy_status


                return $CI->db->get()->num_rows();
                ;
            }
        }
    }
}

//Get side navigation
if (!function_exists('get_side_navigation')) {
    function get_side_navigation($user_type)
    {
        $CI =& get_instance();
        $CI->db->select('*');
        $CI->db->from('navigation_sidebar');
        $CI->db->where('is_active', '1');
        $CI->db->where('user_type', $user_type);
        $CI->db->order_by('sort_order', 'asc');
        return $CI->db->get()->result_array();
    }
}

//Get side navigation
if (!function_exists('get_side_navigation_test')) {
    function get_side_navigation_test($user_type)
    {
        $CI =& get_instance();

//      echo '<pre>';
//      var_dump($_SESSION);
//      exit();
        if ($user_type !== 3) {
            if ($_SESSION['user_group'] !== "-1") {
                $CI->db->select('user_group_menu_access.*, user_group_menu_access.*, navigation_sidebar.*');
                $CI->db->from('user_group_menu_access');
                $CI->db->join('navigation_sidebar', 'user_group_menu_access.menu_id = navigation_sidebar.id', 'inner');
                $CI->db->join('user_groups', 'user_groups.id = user_group_menu_access.user_group_id', 'inner');
                $CI->db->where('is_active', '1');
                $CI->db->where('user_type', $user_type);
                $CI->db->order_by('sort_order', 'asc');
                return $CI->db->get()->result_array();
            } else {
                return get_side_navigation($user_type);
            }
        } else {
            $CI->db->select('*');
            $CI->db->from('navigation_sidebar');
            $CI->db->where('is_active', '1');
            $CI->db->where('user_type', $user_type);
            $CI->db->order_by('sort_order', 'asc');
            return $CI->db->get()->result_array();
        }
    }
}

////Get counts
//if (!function_exists('get_side_navigation')) {
//    function get_side_navigation($user_type)
//    {
//        $CI =& get_instance();
//        $CI->db->select('*');
//        $CI->db->from('navigation_sidebar');
//        $CI->db->where('is_active', '1');
//        $CI->db->where('user_type', $user_type);
//        $CI->db->order_by('sort_order', 'asc');
//        return $CI->db->get()->result_array();
//    }
//}
