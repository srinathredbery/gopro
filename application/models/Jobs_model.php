<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 11/27/2018
 * Time: 4:59 PM
 */

class Jobs_model extends CI_Model
{
    protected $user_id;


    public function __construct()
    {
        parent::__construct();
        $this->user_id = ($this->session->user_type == 3) ? $this->session->user_id : 0;
    }

    function get_job_posts(
        $search_key = null,
        $country = null,
        $time_filter = null,
        $job_type_filter = null,
        $job_category_filter = null,
        $job_career_level_filter = null,
        $gender = null,
        $sal_min = null,
        $sal_max = null,
        $exp_min = null,
        $exp_max = null,
        $qlf_level = null,
        $from = null,
        $limit = null
    ) {

        $currentDate=date('Y-m-d').' 23:59:59';
        $OneyearAgoDate= date('Y-m-d', strtotime('-1 years')).' 00:00:00';

        $this->db->distinct();
        $this->db->select('job_posts.*,
                            employer.employer_name,
                            employer.employer_logo_url,
                            job_type.job_type_name, 
                            job_category.job_category_name,
                            country_master.CountryDes,
                            ');
    //      $this->db->join('employer', 'employer.employer_id = job_posts.job_post_employer_id','left');
        $this->db->from('job_posts');
        $this->db->where('post_status', '1');
        $this->db->where('job_post_posted_date <', 'CURRENT_DATE');
        $this->db->where('DATE_ADD(job_post_posted_date , INTERVAL 30 DAY) >', 'CURRENT_DATE', false);
        $this->db->where('job_post_country', 203);
        $this->db->where('post_approval', '1');

        if ($search_key != null) {
            $this->db->like('job_post_title', $search_key);
            $this->db->or_where('employer.employer_name', $search_key);
        }
        if ($country != null) {
            $this->db->where('country_master.countryShortCode', $country);
        }
        if ($time_filter != null) {
            $this->db->where('job_post_posted_date >= DATE_SUB(NOW(),'.$time_filter);
        }
        if ($job_type_filter != null) {
            $this->db->where_in('job_post_job_type', $job_type_filter);
        }
        if ($job_category_filter != null) {
            $this->db->where_in('job_post_job_category', $job_category_filter);
        }
        if ($job_career_level_filter != null) {
            $this->db->where_in('job_post_career_lvl', $job_career_level_filter);
        }
        if ($gender != null) {
            $this->db->where('job_post_salary_min >=', $gender);
        }
        if ($sal_min != null && $sal_max!=null) {
            $this->db->where('((`job_post_salary_min` BETWEEN '.$sal_min.' * job_post_salary_exchange_rate_vs_usd AND '.$sal_max.' * job_post_salary_exchange_rate_vs_usd) OR (`job_post_salary_max` BETWEEN  '.$sal_min.' * job_post_salary_exchange_rate_vs_usd AND '.$sal_max.' * job_post_salary_exchange_rate_vs_usd))');
        }
        if ($exp_min != null && $exp_max!=null) {
            $this->db->where('((`job_post_experience_min` BETWEEN '.$exp_min.' AND '.$exp_max.') OR (`job_post_experience_max` BETWEEN  '.$exp_min.' AND '.$exp_max.'))');
        }
        if ($qlf_level != null) {
            $this->db->where_in('job_post_qualification', $qlf_level);
        }
        $this->db->where('job_posts.job_post_posted_date <=', $currentDate);
        $this->db->where('job_posts.job_post_posted_date >=', $OneyearAgoDate);



        if ($limit != null) {
            $this->db->limit($limit, $from);
        }


        $this->db->join('employer', 'employer.employer_id = job_posts.job_post_employer_id');
        $this->db->join('job_type', 'job_type.id = job_posts.job_post_job_type', 'left');
        $this->db->join('job_category', 'job_category.id = job_posts.job_post_job_type', 'left');
        $this->db->join('country_master', 'country_master.countryID = job_posts.job_post_country', 'left');



        $this->db->order_by('job_posts.job_post_posted_date DESC');
    //      $this->db->where_in( 'employer.employer_name', 'UltimaSoft');
        $query = $this->db->get();



    //      $this->db->where('order_date >=', $first_date);
    //      $this->db->where('order_date <=', $second_date);
    //        echo $this->db->last_query();
        return $query->result_array();
    }

    function get_overseas_job_posts(
        $search_key = null,
        $country = null,
        $time_filter = null,
        $job_type_filter = null,
        $job_category_filter = null,
        $job_career_level_filter = null,
        $gender = null,
        $sal_min = null,
        $sal_max = null,
        $exp_min = null,
        $exp_max = null,
        $qlf_level = null,
        $from = null,
        $limit = null
    ) {

        $currentDate=date('Y-m-d').' 23:59:59';
        $OneyearAgoDate= date('Y-m-d', strtotime('-1 years')).' 00:00:00';

        $this->db->distinct();
        $this->db->select('job_posts.*,
                            employer.employer_name,
                            employer.employer_logo_url,
                            job_type.job_type_name, 
                            job_category.job_category_name,
                            country_master.CountryDes,
                            ');
    //      $this->db->join('employer', 'employer.employer_id = job_posts.job_post_employer_id','left');
        $this->db->from('job_posts');
        $this->db->where('post_status', '1');
        $this->db->where('job_post_country !=', 203);
        $this->db->where('post_approval', '1');

        if ($search_key != null) {
            $this->db->like('job_post_title', $search_key);
            $this->db->or_where('employer.employer_name', $search_key);
        }
        if ($country != null) {
            $this->db->where('country_master.countryShortCode', $country);
        }
        if ($time_filter != null) {
            $this->db->where('job_post_posted_date >= DATE_SUB(NOW(),'.$time_filter);
        }
        if ($job_type_filter != null) {
            $this->db->where_in('job_post_job_type', $job_type_filter);
        }
        if ($job_category_filter != null) {
            $this->db->where_in('job_post_job_category', $job_category_filter);
        }
        if ($job_career_level_filter != null) {
            $this->db->where_in('job_post_career_lvl', $job_career_level_filter);
        }
        if ($gender != null) {
            $this->db->where('job_post_salary_min >=', $gender);
        }
        if ($sal_min != null && $sal_max!=null) {
            $this->db->where('((`job_post_salary_min` BETWEEN '.$sal_min.' * job_post_salary_exchange_rate_vs_usd AND '.$sal_max.' * job_post_salary_exchange_rate_vs_usd) OR (`job_post_salary_max` BETWEEN  '.$sal_min.' * job_post_salary_exchange_rate_vs_usd AND '.$sal_max.' * job_post_salary_exchange_rate_vs_usd))');
        }
        if ($exp_min != null && $exp_max!=null) {
            $this->db->where('((`job_post_experience_min` BETWEEN '.$exp_min.' AND '.$exp_max.') OR (`job_post_experience_max` BETWEEN  '.$exp_min.' AND '.$exp_max.'))');
        }
        if ($qlf_level != null) {
            $this->db->where_in('job_post_qualification', $qlf_level);
        }
        $this->db->where('job_posts.job_post_posted_date <=', $currentDate);
        $this->db->where('job_posts.job_post_posted_date >=', $OneyearAgoDate);



        if ($limit != null) {
            $this->db->limit($limit, $from);
        }


        $this->db->join('employer', 'employer.employer_id = job_posts.job_post_employer_id');
        $this->db->join('job_type', 'job_type.id = job_posts.job_post_job_type', 'left');
        $this->db->join('job_category', 'job_category.id = job_posts.job_post_job_type', 'left');
        $this->db->join('country_master', 'country_master.countryID = job_posts.job_post_country', 'left');



        $this->db->order_by('job_posts.job_post_posted_date DESC');
    //      $this->db->where_in( 'employer.employer_name', 'UltimaSoft');
        $query = $this->db->get();



    //      $this->db->where('order_date >=', $first_date);
    //      $this->db->where('order_date <=', $second_date);
    //        echo $this->db->last_query();
        return $query->result_array();
    }


    function get_recent_jobs($limit = null, $from = null)
    {
        try {
            $this->db->select('job_posts.*,
                                employer.employer_name,
                                employer.employer_logo_url,
                                job_type.job_type_name, 
                                job_category.job_category_name, 
                                country_master.CountryDes');
            $this->db->from('job_posts');
            $this->db->where('post_status', '1');
            $this->db->where('job_post_country', 203);
            //CURRENT_DATE
            $this->db->where('job_post_posted_date <', 'CURRENT_DATE');
            $this->db->where('DATE_ADD(job_post_posted_date , INTERVAL 30 DAY) >', 'CURRENT_DATE', false);

            $this->db->where('post_approval', '1');
            $this->db->join('employer', 'employer.employer_id = job_posts.job_post_employer_id');
            $this->db->join('job_type', 'job_type.id = job_posts.job_post_job_type');
            $this->db->join('job_category', 'job_category.id = job_posts.job_post_job_type');
            $this->db->join('country_master', 'country_master.countryID = job_posts.job_post_country');
            $this->db->order_by('job_posts.job_post_posted_date DESC');
            $this->db->limit($limit, $from);
            $query = $this->db->get();//        echo $this->db->last_query();
            return $query->result_array();
        } catch (Exception $e) {
        }
    }

    function get_featured_job($limit = null, $from = null)
    {

    //Thaindu ;{
    //        $this->db->select('job_posts.*,
    //                            employer.employer_name,
    //                            employer.employer_logo_url,
    //                            job_type.job_type_name,
    //                            job_category.job_category_name,
    //                            country_master.CountryDes');
    //        $this->db->from('job_posts');
    //        $this->db->where('post_status', '1');
    //        $this->db->where('post_approval', '1');
    //        $this->db->join('employer', 'employer.employer_id = job_posts.job_post_employer_id');
    //        $this->db->join('job_type', 'job_type.id = job_posts.job_post_job_type');
    //        $this->db->join('job_category', 'job_category.id = job_posts.job_post_job_type');
    //        $this->db->join('country_master', 'country_master.countryID = job_posts.job_post_country');
    //      $this->db->join('job_posts_featured', 'job_posts_featured.job_post_id = job_posts.job_post_id');
    //        $this->db->order_by('job_posts.job_post_posted_date ASC');
    //        $this->db->limit($limit, $from);
    //        $query = $this->db->get();
    //        return $query->result_array();

        $this->db->select(
            'job_posts.*, 
			job_type.job_type_name,
		 	employer.employer_name, 
		 	employer.employer_logo_url,
		    job_type.job_type_name,
		    job_category.job_category_name,
		    country_master.CountryDes'
        );
        $this->db->where(array('post_approval'=>'1', 'post_status'=>'1','job_posts_featured.status'=>'Active'));
        $this->db->join('employer', 'job_posts.job_post_employer_id = employer.employer_id', 'left');
        $this->db->join('job_type', 'job_posts.job_post_job_type = job_type.id', 'left');
        $this->db->join('job_category', 'job_category.id = job_posts.job_post_job_type');
        $this->db->join('country_master', 'country_master.countryID = job_posts.job_post_country');
        $this->db->join('job_posts_featured', 'job_posts_featured.job_post_id = job_posts.job_post_id');
        $this->db->order_by('job_post_posted_date', 'DESC');
        $this->db->from('job_posts');
        $this->db->limit($limit, $from);

        $query = $this->db->get();
        return $query->result_array();
    }

    function get_liked_jobs($user_id)
    {
        $this->db->select('job_post_id');
        $this->db->from('jobseeker_saved_jobs');
        $this->db->where('jobseeker_id', $user_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_job_post($id)
    {

        $this->db->select('job_posts.*,
                            employer.employer_name,
                            employer.employer_logo_url,
                            employer.employer_cover_pic_url,
                            job_type.job_type_name,
                            country_master.CountryDes,     
                            career_level.career_level_name,
                            education_level_master.education_level_name,
                            job_category.job_category_name');
        if (!empty($this->user_id)) {
            $this->db->select('liked_job.job_post_id AS saved_job');
        }
        $this->db->from('job_posts');
    //        $this->db->where('post_status', '1');
        $this->db->join('employer', 'employer.employer_id = job_posts.job_post_employer_id');
        $this->db->join('job_type', 'job_type.id = job_posts.job_post_job_type');
        $this->db->join('career_level', 'career_level.id = job_posts.job_post_career_lvl');
        $this->db->join('job_category', 'job_category.id = job_posts.job_post_job_category');
        $this->db->join('education_level_master', 'education_level_master.edu_lvl_id = job_posts.job_post_qualification');
        $this->db->join('country_master', 'country_master.countryID = job_posts.job_post_country');
        if (!empty($this->user_id)) {
            $this->db->join('(SELECT * FROM jobseeker_saved_jobs WHERE jobseeker_id = '.$this->user_id.') AS liked_job', 'liked_job.job_post_id = job_posts.job_post_id', 'left');
        }
        $this->db->where('job_posts.job_post_id', $id);
        $query = $this->db->get();
    //        echo $this->db->last_query();
        return $query->row_array();
    }

    function get_job_skill_tags($id)
    {
        $this->db->select('*');
        $this->db->from('job_post_skill_tags');
        $this->db->where('job_post_id', $id);
        $query = $this->db->get();
    //        echo $this->db->last_query();
        return $query->result_array();
    }



//get questions related to post

    function get_quz($id)
    {

        $this->db->select('*');
        $this->db->from('job_questionnaire');
        $this->db->where('post_id', $id);
       // $this->db->where('question', $id);
        $this->db->where('question is NOT NULL', null, false);
          $this->db->where('question <> "" ', null, false);
        $query = $this->db->get();
  //        echo $this->db->last_query();
        return $query->result_array();
    }



    function get_myskill($id)
    {
       

        
        $query=$this->db->query("select a.skill from jobseeker_resume_skill a left outer join jobseeker_resume b 
 on a.resume_id=b.resume_id
 where b.jobseeker_user_id='$id'");



      
        return $query->result_array();
    }







    function get_job_post_by_type()
    {
        $this->db->select();
        $this->db->from('');
    }

    function get_max_salary()
    {
        $this->db->select('MAX(job_post_salary_max/job_post_salary_exchange_rate_vs_usd) as max_sal_usd');
        $this->db->where('post_approval', '1');
        $query = $this->db->get('job_posts');
        return $query->row_array();
    }

    function get_max_experience()
    {
        $this->db->select_max('job_post_experience_max', 'max_exp');
        $this->db->where('post_approval', '1');
        $query = $this->db->get('job_posts');
        return $query->row_array();
    }

    function get_job_category()
    {
        $this->db->select('*');
        $this->db->from('job_category');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_job_types()
    {
        $this->db->select('*');
        $this->db->from('job_type');
        $query = $this->db->get();
        return $query->result_array();
    }


    function get_job_qualification()
    {
        $this->db->select('*');
        $this->db->from('qualification_level_master');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_job_post_count_by_filters($cond)
    {
        $this->db->select('count(*)');
        $this->db->from('job_posts');
        $this->db->where('post_approval', '1');
        $this->db->where($cond);
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->row_array();
    }

    function get_job_post_city_country()
    {

        $this->db->select('job_posts.job_post_country,
                        job_posts.job_post_city,
                        country_master.countryShortCode,
                        country_master.CountryDes');
        $this->db->from('job_posts');
        $this->db->join('country_master', 'job_posts.job_post_country = country_master.countryID', 'inner');
        $this->db->where('post_status', '1');
        $this->db->where('post_approval', '1');
        $this->db->group_by('job_posts.job_post_country');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_job_list($search_key = null)
    {
        $this->db->select('job_post_title ');
        $this->db->distinct();
        $this->db->from('job_posts');
        if ($search_key != null) {
            $this->db->like('job_post_title', $search_key);
        }
        $this->db->where('post_status', '1');
        $this->db->where('post_approval', '1');
        $query = $this->db->get();
        return $query->result_array();
    }
}
