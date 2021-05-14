<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 12/14/2018
 * Time: 4:36 PM
 */

class Employer_application_model extends CI_Model
{
    function get_recieved_applications($emp_id, $post_id = null)
    {

        try {
            $this->db->select('job_applications_received.*,
                                job_posts.job_post_title,
                                job_posts.job_post_employer_id,
                                employer.employer_name,
                                jobseeker.jobseeker_user_id,
                                jobseeker.jobseeker_first_name,
                                jobseeker.jobseeker_last_name,
                                jobseeker.jobseeker_city,
	                            jobseeker.jobseeker_country_id,
                                jobseeker.jobseeker_dp_url,
                                jobseeker_resume.resume_attachment,
                                recent_work.job_title,
                                recent_work`.`company');
            $this->db->where('job_post_employer_id', $emp_id);
            if ($post_id != null) {
                $this->db->where('job_applications_received.job_post_id', $post_id);
            }
            $this->db->from('job_applications_received');
            $this->db->join('job_posts', 'job_applications_received.job_post_id = job_posts.job_post_id', 'inner');
            $this->db->join('employer', 'job_posts.job_post_employer_id = employer.employer_id', 'inner');
            $this->db->join('jobseeker', 'job_applications_received.jobseeker_id = jobseeker.jobseeker_user_id', 'inner');
            $this->db->join('jobseeker_resume', 'job_applications_received.applied_resume = jobseeker_resume.resume_id', 'left');
            $this->db->join('iso_codes_master', 'jobseeker.jobseeker_country_id = iso_codes_master.id', 'left');
            $this->db->join('(SELECT *, MAX(start_date) FROM jobseeker_resume_work_exp GROUP BY resume_id) as recent_work', 'job_applications_received.applied_resume = recent_work.resume_id', 'left');
            $this->db->order_by('application_date', 'DESC');
            $query = $this->db->get();
//            echo $this->db->last_query();
            return $query->result_array();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }



    //get_recieved_applications_emp_exam_done
    function get_recieved_applications_emp_exam_done($emp_id, $job_ctg_id = null)
    {

        try {
            //id_ats_exam_master
            $this->db->select('ats_emp_wise_answer.*,jobseeker.jobseeker_first_name as jobseeker_first_name,jobseeker.jobseeker_middle_name as jobseeker_middle_name,jobseeker.jobseeker_last_name as jobseeker_last_name,ats_emp_wise_answer.create_date as Date,ats_exam_master.id_ats_exam_master as exam_ids');
            $this->db->where('ats_assign_exam_emp.job_id', $job_ctg_id);
            $this->db->from('ats_emp_wise_answer');
            $this->db->group_by('exam_id');
            $this->db->join('jobseeker', 'jobseeker.jobseeker_user_id = ats_emp_wise_answer.emp_id', 'left');
            $this->db->join('ats_exam_master', 'ats_exam_master.id_ats_exam_master = ats_emp_wise_answer.exam_id', 'left');
            $this->db->join('ats_assign_exam_emp', 'ats_assign_exam_emp.exam_id = ats_exam_master.id_ats_exam_master', 'left');

            //ats_assign_exam_emp           $this->db->order_by('application_date', 'DESC');
            $query = $this->db->get();
//            echo $this->db->last_query();
            return $query->result_array();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function ats_overall_data($emp_id, $job_ctg_id = null, $ctg)
    {

        try {
            //id_ats_exam_master
            $this->db->select('ats_emp_wise_answer.*,jobseeker.jobseeker_first_name as jobseeker_first_name,jobseeker.jobseeker_middle_name as jobseeker_middle_name,jobseeker.jobseeker_last_name as jobseeker_last_name,ats_emp_wise_answer.create_date as Date,ats_exam_master.id_ats_exam_master as exam_ids,ats_overall_emp_wise.status as finalize_status');
            $this->db->where('ats_assign_exam_emp.job_id', $job_ctg_id);
            if ($ctg!='*') {
                $this->db->where('ats_overall_emp_wise.status', $ctg);
            }
            $this->db->from('ats_emp_wise_answer');
            $this->db->group_by('exam_id');
            $this->db->join('ats_overall_emp_wise', 'ats_overall_emp_wise.emp_id = ats_emp_wise_answer.emp_id', 'inner');
            $this->db->join('jobseeker', 'jobseeker.jobseeker_user_id = ats_emp_wise_answer.emp_id', 'left');
            $this->db->join('ats_exam_master', 'ats_exam_master.id_ats_exam_master = ats_emp_wise_answer.exam_id', 'left');
            $this->db->join('ats_assign_exam_emp', 'ats_assign_exam_emp.exam_id = ats_exam_master.id_ats_exam_master', 'left');

            //ats_assign_exam_emp           $this->db->order_by('application_date', 'DESC');
            $query = $this->db->get();
//            echo $this->db->last_query();
            return $query->result_array();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }



    //get_ats_exam_do_countlocation_detail
    function get_location_detail($emp_id, $job_ctg_id = null)
    {

        try {
            //id_ats_exam_master
            $this->db->select('ats_interviewer_details.*');
            $this->db->where('ats_interviewer_details.idinterviewer_details', $job_ctg_id);
            $this->db->from('ats_interviewer_details');

            //ats_assign_exam_emp           $this->db->order_by('application_date', 'DESC');
            $query = $this->db->get();
//            echo $this->db->last_query();
            return $query->result_array();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function get_contact_detail($emp_id, $job_ctg_id = null)
    {

        try {
            //id_ats_exam_master
            $this->db->select('ats_interviewer_list.*');
            $this->db->where('ats_interviewer_list.idinterviewer_list', $job_ctg_id);
            $this->db->from('ats_interviewer_list');

            //ats_assign_exam_emp           $this->db->order_by('application_date', 'DESC');
            $query = $this->db->get();
//            echo $this->db->last_query();
            return $query->result_array();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function get_recieved_applications_emp_exam_schedule($emp_id, $post_id = null)
    {

        try {
            //id_ats_exam_master
            $this->db->select('ats_schedule_interview.*,jobseeker.jobseeker_first_name as jobseeker_first_name,jobseeker.jobseeker_middle_name as jobseeker_middle_name,jobseeker.jobseeker_last_name as jobseeker_last_name,ats_schedule_interview.date as Date,ats_schedule_interview.strat_time_hr as strat_time_hr,ats_schedule_interview.strat_time_min as strat_time_min,jobseeker.jobseeker_user_id as emp_id,ats_interviewer_details.location as locat,ats_interviewer_details.room_no as room,ats_schedule_interview.user_id as UID');
            $this->db->from('ats_schedule_interview');
            $this->db->where('ats_schedule_interview.user_id', $_SESSION['user_id']);
            $this->db->join('jobseeker', 'jobseeker.jobseeker_user_id = ats_schedule_interview.emp_id', 'left');
            $this->db->join('ats_interviewer_details', 'ats_interviewer_details.idinterviewer_details = ats_schedule_interview.location', 'inner');
            $query = $this->db->get();
//            echo $this->db->last_query();
            return $query->result_array();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function drop_data($emp_id, $post_id = null)
    {

        try {
            //id_ats_exam_master
            $this->db->where('ats_interviewer_form.company_id', $_SESSION['company_id']);
            $this->db->select('ats_interviewer_form.*');
            $this->db->from('ats_interviewer_form');
            $query = $this->db->get();
//            echo $this->db->last_query();
            return $query->result_array();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function ats_set_doc_data($emp_id, $post_id = null)
    {

        try {
            $this->db->select('ats_interviewer_form.*');
            $this->db->where('id_ats_interviewer_form', $post_id);
            $this->db->from('ats_interviewer_form');
            $query = $this->db->get();
            return $query->result_array();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    function ats_exam_summary($emp_id)
    {

        try {
            $this->db->select('ats_exam_master.*');
            $this->db->where('company_id', $emp_id);
            $this->db->where('is_delete', 0);
            $this->db->from('ats_exam_master');

            $query = $this->db->get();
//            echo $this->db->last_query();
            return $query->result_array();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function ats_exam_summary_level($emp_id, $level, $job_ctg_id)
    {
        try {
            $this->db->select('ats_exam_master.*');
            $this->db->where('company_id', $emp_id);
            $this->db->where('Level', $level);
            $this->db->where('jobid', $job_ctg_id);
            $this->db->where('is_delete', 0);
            $this->db->from('ats_exam_master');
            $this->db->join('ats_assign_exam_jobs', 'ats_assign_exam_jobs.exam_id = ats_exam_master.id_ats_exam_master', 'inner');


            $query = $this->db->get();
            return $query->result_array();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function get_bucket_candidate_count($company_id, $id_ViewJob)
    {

        $this->db->select('ats_bucket_candidate.*');
        $this->db->where('company_id', $company_id);
        $this->db->where('id_job_post', $id_ViewJob);
        $this->db->where('status', 1);
        $this->db->from('ats_bucket_candidate');
        $query = $this->db->get();
        return $query->num_rows();
    }

    function ats_save_bucket_candidate($company_id, $emp_id, $id_ViewJob)
    {
        $data['id_job_post']=$id_ViewJob;
        $data['company_id']=$company_id;
        $data['id_job_seeker']=$emp_id;
        $data['status']=1;
        $res = $this->db->insert('ats_bucket_candidate', $data);
        return $data;
    }





    function get_bucket_candidate_listing($company_id, $id_ViewJob)
    {

        $this->db->select('ats_bucket_candidate.*');
        $this->db->where('company_id', $company_id);
        $this->db->where('id_job_post', $id_ViewJob);
        $this->db->where('status', 1);
        $this->db->from('ats_bucket_candidate');
        $query = $this->db->get();
        return $query->num_rows();
    }






    function ats_offer_latter_comapny($company_id)
    {
        try {
            $this->db->where('company_id', $company_id);
            $this->db->from('ats_interviewer_offer_latter');
            $query = $this->db->get();
            return $query->result_array();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function ats_exam_ctg($id)
    {
        try {
            $this->db->select('ats_assign_exam_jobs.*,job_posts.*');
            $this->db->where('exam_id', $id);
            $this->db->from('ats_assign_exam_jobs');
            $this->db->join('job_posts', 'job_posts.job_post_id = ats_assign_exam_jobs.jobid', 'inner');

            $query = $this->db->get();
//            echo $this->db->last_query();
            return $query->result_array();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function ats_exam_delete($id)
    {
        try {
            $this->db->set('is_delete', 1);
            $this->db->where('id_ats_exam_master', $id);
            $this->db->update('ats_exam_master');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    function get_cover_letter($ap_id)
    {
        try {
            $this->db->select('cover_letter_content');
            $this->db->where('application_no', $ap_id);
            $this->db->from('job_applications_received');
            $query = $this->db->get();
            return $query -> row_array();
        } catch (Exception $e) {
            return $e->getMessage();
        }
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

    function get_job_post($id)
    {
        $this->db->select('*');
        $this->db->from('job_posts');
        $this->db->where('job_post_id', $id);
        $this->db->where('post_status !=', '2');
        $query = $this->db->get();
        return $query -> row_array();
    }
}
