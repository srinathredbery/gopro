<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('get_current_user_type')) {
    function get_current_user_type()
    {
        if (isset($_SESSION['logged_in'])){
            $user_type = $_SESSION['user_type'];
            return $user_type;
        }
    }
}

if (!function_exists('check_login_status')) {
    function check_login_status()
    {
        $logged_in_status=FALSE;
        if (isset($_SESSION['logged_in'])) {
            $logged_in_status = $_SESSION['logged_in'];
        }
        return $logged_in_status;
    }
}