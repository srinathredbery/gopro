<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 12/14/2018
 * Time: 4:36 PM
 */

class Jobseeker_job_application_model extends CI_Model
{
    function get_current_user_resume($js_id)
    {
        $this->db->select('resume_id, resume_name,inserted_date,updated_date');
        $this->db->where(array('jobseeker_user_id' => $js_id, 'is_active' => '1', 'hidden' => '0'));
        $this->db->from('jobseeker_resume');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_current_user_cover_letter($js_id)
    {
        $this->db->select('cover_letter_id, cover_letter_name, inserted_date,updated_date');
        $this->db->where('jobseeker_id', $js_id);
        $this->db->from('jobseeker_cover_letter');
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
    }

    function get_selected_cover_letter($js_id, $cl_id)
    {
        $this->db->select('cover_letter_content,attachment_url');
        $this->db->where('jobseeker_id', $js_id);
        $this->db->where('cover_letter_id', $cl_id);
        $this->db->from('jobseeker_cover_letter');
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
    }

    function get_selected_resume_about($resume_id)
    {
        $this->db->select('jobseeker_resume.about_description');
        $this->db->where('resume_id', $resume_id);
        $this->db->from('jobseeker_resume');
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->row_array();
    }

    function get_selected_resume_work_exp($resume_id)
    {
        $this->db->select('jobseeker_resume_work_exp.work_exp_id,
                            jobseeker_resume_work_exp.company,
                            jobseeker_resume_work_exp.city,
                            jobseeker_resume_work_exp.country,
                            jobseeker_resume_work_exp.job_title,
                            jobseeker_resume_work_exp.start_date,
                            jobseeker_resume_work_exp.end_date,
                            jobseeker_resume_work_exp.still_work,
                            jobseeker_resume_work_exp.description');
        $this->db->where('resume_id', $resume_id);
        $this->db->from('jobseeker_resume_work_exp');
        $this->db->order_by('start_date', 'DESC');
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
    }

    function get_selected_resume_pro_skill($resume_id)
    {
        $this->db->select('jobseeker_resume_skill.skill_id,
                            jobseeker_resume_skill.skill,
                            jobseeker_resume_skill.skill_level');
        $this->db->where('resume_id', $resume_id);
        $this->db->from('jobseeker_resume_skill');
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
    }

    function get_selected_resume_edu($resume_id)
    {
        $this->db->select('jobseeker_resume_education.resume_id,
                            jobseeker_resume_education.edu_level,
                            jobseeker_resume_education.specialization,
                            jobseeker_resume_education.school,
                            jobseeker_resume_education.city,
                            jobseeker_resume_education.country,
                            jobseeker_resume_education.start_date,
                            jobseeker_resume_education.end_date,
                            jobseeker_resume_education.still_following,
                            jobseeker_resume_education.related_info,
                            education_level_master.education_level_name');
        $this->db->where('resume_id', $resume_id);
        $this->db->from('jobseeker_resume_education');
        $this->db->join('education_level_master', 'jobseeker_resume_education.edu_level = education_level_master.edu_lvl_id', 'left');
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
    }

    function get_selected_resume_award($resume_id)
    {
        $this->db->select('jobseeker_resume_award.award, jobseeker_resume_award.issued_by,jobseeker_resume_award.date_of_award');
        $this->db->where('resume_id', $resume_id);
        $this->db->from('jobseeker_resume_award');
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
    }

    function get_selected_resume_lang($resume_id)
    {
        $this->db->select('jobseeker_resume_language.*');
        $this->db->select('(SELECT language_level_master.lang_level FROM language_level_master WHERE language_level_master.lang_lvl_id = jobseeker_resume_language.lang_reading) as reading,');
        $this->db->select('(SELECT language_level_master.lang_level FROM language_level_master WHERE language_level_master.lang_lvl_id = jobseeker_resume_language.lang_writing) as writing,');
        $this->db->select('(SELECT language_level_master.lang_level FROM language_level_master WHERE language_level_master.lang_lvl_id = jobseeker_resume_language.lang_speaking) as speaking,');
        $this->db->from('jobseeker_resume_language');
        $this->db->where(array('resume_id'=>$resume_id, 'jobseeker_resume_language.hidden' => '0'));
//        $this->db->order_by(ASC);
        $query = $this->db->get();
        return $query->result_array();
    }

    function create_job_application($application)
    {
        $res = $this->db->insert('job_applications_received', $application);
        return $res;
    }

    function get_applications($js_id)
    {
        try {
            $this->db->select('job_applications_received.*, job_posts.job_post_title, employer.employer_name, job_posts.job_post_city, country_master.CountryDes');
            $this->db->where('jobseeker_id', $js_id);
            $this->db->from('job_applications_received');
            $this->db->join('job_posts', 'job_posts.job_post_id = job_applications_received.job_post_id', 'inner');
            $this->db->join('employer', 'job_posts.job_post_employer_id = employer.employer_id', 'inner');
            $this->db->join('country_master', 'job_posts.job_post_country = country_master.countryID', 'inner');
            $this->db->order_by('application_date', "DESC");
            $query = $this->db->get();
            return $query->result_array();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function get_applications_interview($js_id)
    {
        try {
            $this->db->select('job_applications_received.*, job_posts.job_post_title, employer.employer_name, job_posts.job_post_city, country_master.CountryDes,ats_overall_emp_wise.status as finalized_status');
            $this->db->where('ats_overall_emp_wise.emp_id', $js_id);
            $this->db->from('job_applications_received');
            $this->db->join('ats_overall_emp_wise', 'job_applications_received.jobseeker_id  =  ats_overall_emp_wise.emp_id', 'inner');
            $this->db->join('job_posts', 'job_posts.job_post_id = job_applications_received.job_post_id', 'inner');
            $this->db->join('employer', 'job_posts.job_post_employer_id = employer.employer_id', 'inner');
            $this->db->join('country_master', 'job_posts.job_post_country = country_master.countryID', 'inner');
            $this->db->order_by('application_date', "DESC");
            $this->db->group_by('ats_overall_emp_wise.idats_overall_emp_wise');

            $query = $this->db->get();


            return $query->result_array();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function get_resume_info($resume_id)
    {
        $this->db->select('jobseeker_resume.*');
        $this->db->from('jobseeker_resume');
        $this->db->where('resume_id', $resume_id);
        $this->db->distinct('jobseeker_resume.resume_id');
        $query = $this->db->get();
        return $query->row_array();
    }

    function withdraw_application($js_id, $apl_id, $data)
    {
        $this->db->where('application_no', $apl_id);
        $this->db->where('jobseeker_id', $js_id);
        $result = $this->db->update('job_applications_received', $data);
        return $result;
    }

    function reapply_application($js_id, $apl_id, $data)
    {
        $this->db->where('application_no', $apl_id);
        $this->db->where('jobseeker_id', $js_id);
        $result = $this->db->update('job_applications_received', $data);
        return $result;
    }

    function get_total_applications($id)
    {
        $this->db->select('count(*) as tot');
        $this->db->from('job_applications_received');
        $this->db->where('jobseeker_id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

//    function get_cover_latter_data($id){
//      $this->db->select('jobseeker_cover_letter.*');
//      $this->db->select('(SELECT COUNT(job_applications_received.applied_cover_letter) FROM job_applications_received WHERE job_applications_received.applied_cover_letter = jobseeker_cover_letter.cover_letter_id) AS no_of_application');
//      $this->db->from('jobseeker_cover_letter');
//      $this->db->where('jobseeker_id', $id);
//      $this->db->order_by('inserted_date', "DESC");
//      $this->db->order_by('updated_date', "DESC");
//      $query = $this->db->get();
//      return $query->result_array();
//  }
}
