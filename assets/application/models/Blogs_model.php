<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 3/7/2019
 * Time: 3:52 PM
 */

class Blogs_model extends CI_Model
{
    function get_all_blogs(){

        $this->db->select('*');
        $this->db->from('blog_posts');

        $query = $this->db->get();
        return $query->result_array();

    }

    function get_blog_post($id){
        $this->db->select('*');
        $this->db->from('blog_posts');
        $this->db->where('id', $id);

        $query = $this->db->get();
        return $query->row_array();
    }

}