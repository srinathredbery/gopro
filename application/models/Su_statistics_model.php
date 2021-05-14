<?php


class Su_statistics_model extends CI_Model
{
    function get_user_growth_data($user_type){
        $this->db->select('DATE(joined_date) as day_date, COUNT( joined_date ) AS count ');
        $this->db->from('user');
        $this->db->where('joined_date BETWEEN DATE_ADD(NOW(), INTERVAL -6 day) AND NOW()');
        $this->db->where('user_type', $user_type);
        $this->db->or_where('user_type IS NULL');
        $this->db->group_by('DATE(joined_date)');
        $this->db->order_by('DATE(joined_date)','ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_user_growth_data_by_year($user_type, $year){
        $this->db->select('COUNT(user_id) as user_count, MONTH(joined_date) as by_month');
        $this->db->from('user');
        $this->db->where('YEAR(joined_date)', $year);
        $this->db->where('user_type', $user_type);
        $this->db->group_by('by_month');
        $this->db->order_by('by_month','ASC');
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
    }

    function get_user_count_till_last_year($user_type, $year){
        $this->db->select('COUNT(user_id) as user_count');
        $this->db->from('user');
        $this->db->where('YEAR(joined_date) <', $year);
        $this->db->where('user_type', $user_type);
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
    }

    function get_job_post_growth_data_by_year($year){
        $this->db->select('COUNT( job_posts.job_post_id ) AS post_count, MONTH ( job_post_posted_date ) AS by_month ');
        $this->db->from('job_posts');
        $this->db->where('YEAR(job_post_posted_date)', $year);
        $this->db->group_by('by_month');
        $this->db->order_by('by_month','ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_job_post_count_till_year($year){
        $this->db->select('COUNT( job_posts.job_post_id ) AS post_count');
        $this->db->from('job_posts');
        $this->db->where('YEAR(job_post_posted_date) < ', $year);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_last_five_years(){
        $this->db->select('DISTINCT YEAR(joined_date) as years');
        $this->db->from('user');
        $this->db->order_by('years', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result_array();

    }

    function get_last_five_employers(){
        $this->db->distinct();
        $this->db->select('employer.employer_id,
                            employer.employer_name,
                            employer.employer_logo_url,
                            employer.joined_date,
                            user.verification_status');
        $this->db->from('employer');
        $this->db->join('user','employer.employer_id = user.company_id','inner');
        $this->db->where('user_group', '-1');
        $this->db->order_by('employer.joined_date', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result_array();

    }

    function get_last_five_job_seekers(){
        $this->db->distinct();
        $this->db->select('jobseeker.jobseeker_id,
                            jobseeker.jobseeker_first_name,
                            jobseeker.jobseeker_last_name,
                            user.joined_date,
                            user.verification_status,
                            jobseeker.jobseeker_user_id,
                            jobseeker.jobseeker_dp_url');
        $this->db->from('jobseeker');
        $this->db->join('user','jobseeker.jobseeker_user_id = user.user_id','inner');
        $this->db->order_by('user.joined_date', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result_array();

    }
}
