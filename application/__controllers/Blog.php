<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 8/15/2018
 * Time: 1:13 PM
 */

class Blog extends CI_Controller
{
    public function __construct()
    {
    	parent::__construct();
    	$this->load->model('blogs_model');

    	//Do your magic here
    }

    public function index()
    {
        $data['blogs'] = $this->blogs_model->get_all_blogs();

        $data['page_title'] = 'Blogs';
        $data['main_content'] = 'blog/blogs';

        //load main content page
        $this->load->view('templates/template_extras', $data);
    }

    function view_blog_post()
    {
        $blog_id = $this->input->get('post');
        $blog_id = base64_decode($blog_id);
        $data['blog_post'] = $this->blogs_model->get_blog_post($blog_id);
//        exit();

        $data['page_title'] = 'Blog Post';
        $data['main_content'] = 'blog/blog_post_view';

        //load main content page
        $this->load->view('templates/template_extras', $data);
    }
}