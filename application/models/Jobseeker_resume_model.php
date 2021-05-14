<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 11/9/2018
 * Time: 5:55 PM
 */

class Jobseeker_resume_model extends CI_Model
{
    function create_new_resume($data)
    {
        $this->db->insert('jobseeker_resume', $data);
        return $this->db->insert_id();
    }

    function update_resume_info($cond, $data)
    {
        //$this->db->where('resume_id', $cond);
      //  $result = $this->db->update('jobseeker_resume', $data);
        //return $result;
    
        $this->db->insert('jobseeker_resume', $data);
        //print_r($this->db->last_query());
       // die();
        return $this->db->insert_id();
    }

    function get_resume_section_status()
    {
        $this->db->select('jobseeker_resume.resume_id,
                            jobseeker_resume_skill.skill_id,
                            jobseeker_resume_award.award_id,
                            jobseeker_resume_work_exp.work_exp_id,
                            jobseeker_resume_language.lang_res_id,
                            jobseeker_resume_education.edu_id');
        $this->db->from('jobseeker_resume');
        $this->db->join('jobseeker_resume_award', 'jobseeker_resume.resume_id = jobseeker_resume_award.resume_id', 'left');
        $this->db->join('jobseeker_resume_work_exp', 'jobseeker_resume.resume_id = jobseeker_resume_work_exp.resume_id', 'left');
        $this->db->join('jobseeker_resume_education', 'jobseeker_resume.resume_id = jobseeker_resume_education.resume_id', 'left');
        $this->db->join('jobseeker_resume_language', 'jobseeker_resume.resume_id = jobseeker_resume_language.resume_id', 'left');
        $this->db->join('jobseeker_resume_skill', 'jobseeker_resume.resume_id = jobseeker_resume_skill.resume_id', 'left');
        $this->db->where('jobseeker_resume.is_primary = "1" AND jobseeker_resume.hidden = "0"');
        $this->db->group_by('resume_id');
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_resume_list($cond)
    {
        $this->db->select('jobseeker_resume.*');
        $this->db->select('(SELECT COUNT(job_applications_received.applied_resume) FROM job_applications_received WHERE job_applications_received.applied_resume = jobseeker_resume.resume_id) AS no_of_application');
        $this->db->from('jobseeker_resume');
        $this->db->where($cond);
        $this->db->order_by('is_primary', 'desc');
        $this->db->order_by('inserted_date', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_jobseeker_info($js_id)
    {
        $this->db->select('*');
        $this->db->from('jobseeker');
        $this->db->where('jobseeker_user_id', $js_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_resume_info($resume_id)
    {
        $this->db->select('jobseeker_resume.*');
        $this->db->from('jobseeker_resume');
           $this->db->where_in('jobseeker_user_id', $resume_id);
       // $this->db->where($resume_id);
        $query = $this->db->get();
       // print_r($this->db->last_query());
        return $query->row_array();
    }


    function get_resume_info_byid($resume_id)
    {
        $this->db->select('jobseeker_resume.*');
        $this->db->from('jobseeker_resume');
         // $this->db->where_in('jobseeker_user_id', $resume_id);
        $this->db->where($resume_id);
        $query = $this->db->get();
       // print_r($this->db->last_query());
        return $query->row_array();
    }




    function addvideo($data)
    {

           $this->db->insert('jobseeker_video', $data);
        return $this->db->insert_id();
    }


    function get_job_seeker_last_job($id)
    {
        $this->db->select('jobseeker_resume_work_exp.company,
                            jobseeker_resume_work_exp.job_title,
                            jobseeker_resume_work_exp.start_date');
        $this->db->from('jobseeker_resume_work_exp');
        $this->db->where('jobseeker_resume.jobseeker_user_id', $id);
        $this->db->join('jobseeker_resume', 'jobseeker_resume.resume_id = jobseeker_resume_work_exp.resume_id', 'inner');
        $this->db->order_by('jobseeker_resume_work_exp.start_date', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_job_seeker_resume_language($id)
    {
        $this->db->select('jobseeker_resume_language.*, language_master.language_name');
        $this->db->select('(SELECT language_level_master.lang_level FROM language_level_master WHERE language_level_master.lang_lvl_id = jobseeker_resume_language.lang_reading) as reading,');
        $this->db->select('(SELECT language_level_master.lang_level FROM language_level_master WHERE language_level_master.lang_lvl_id = jobseeker_resume_language.lang_writing) as writing,');
        $this->db->select('(SELECT language_level_master.lang_level FROM language_level_master WHERE language_level_master.lang_lvl_id = jobseeker_resume_language.lang_speaking) as speaking,');
        $this->db->from('jobseeker_resume_language');
        $this->db->join('language_master', 'jobseeker_resume_language.js_language = language_master.language_id', 'left');
        $this->db->where(array('resume_id'=>$id, 'jobseeker_resume_language.hidden' => '0'));
//        $this->db->order_by(ASC);
        $query = $this->db->get();
        return $query->result_array();
    }

    function delete_resume_file($id)
    {
        $this->db->where('resume_id', $id);
        $result = $this->db->update('jobseeker_resume', array('resume_attachment' => null));
        return $result;
    }



    /*Resume merging functions. might be temporary*/

    function get_recently_inserted_resume($user_id)
    {
        $this->db->select('*');
        $this->db->from('jobseeker_resume');
        $this->db->join('(
						SELECT jobseeker_resume.*, MAX(jobseeker_resume.inserted_date) as MaxDate
						FROM jobseeker_resume 
						WHERE jobseeker_resume.hidden = \'0\'
						GROUP BY jobseeker_user_id
					) tm', 'tm.jobseeker_user_id = jobseeker_resume.jobseeker_user_id AND jobseeker_resume.inserted_date = MaxDate', 'inner');
        $this->db->where('jobseeker_resume.jobseeker_user_id', $user_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function set_default_resume($res_id, $user_id)
    {
        $this->db->where('jobseeker_user_id', $user_id);
        $this->db->update('jobseeker_resume', array('is_primary' => '0'));

        $this->db->where('resume_id', $res_id);
        $result = $this->db->update('jobseeker_resume', array('is_primary' => '1'));
        return $result;
    }
}
