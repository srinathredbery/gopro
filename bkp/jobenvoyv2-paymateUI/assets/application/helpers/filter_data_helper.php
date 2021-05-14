<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 12/7/2018
 * Time: 12:13 PM
 */

if (!function_exists('get_currency_list')) {
    function get_currency_list()
    {
        $CI =& get_instance();
        $CI->db->select('*');
        $CI->db->from('currency_master');
        return $CI->db->get()->result_array();
    }
}

if (!function_exists('get_career_level_list')) {
    function get_career_level_list()
    {
        $CI =& get_instance();
        $CI->db->select('*');
        $CI->db->from('career_level');
        return $CI->db->get()->result_array();
    }
}

if (!function_exists('get_career_level_list')) {
    function get_career_level_list()
    {
        $CI =& get_instance();
        $CI->db->select('*');
        $CI->db->from('career_level');
        return $CI->db->get()->result_array();
    }
}
if (!function_exists('get_country_list')) {
    function get_country_list()
    {
        $CI =& get_instance();
        $CI->db->select('*');
        $CI->db->from('country_master');
        return $CI->db->get()->result_array();
    }
}