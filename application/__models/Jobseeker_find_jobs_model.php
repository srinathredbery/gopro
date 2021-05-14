<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 11/9/2018
 * Time: 5:55 PM
 */

class Jobseeker_find_jobs_model extends CI_Model
{
    function save_this_job($data)
    {
        $res = $this->db->insert('jobseeker_saved_jobs', $data);
        return $res;
    }

    function check_liked($data)
    {
        $this->db->select('*');
        $this->db->from('jobseeker_saved_jobs');
        $this->db->where('job_post_id', $data['job_post_id']);
        $this->db->where('jobseeker_id', $data['jobseeker_id']);

        $query = $this->db->get();
        return $query->num_rows();
    }

    function remove_liked($data)
    {
        $this->db->where('job_post_id', $data['job_post_id']);
        $this->db->where('jobseeker_id', $data['jobseeker_id']);
        $result =  $this->db->delete('jobseeker_saved_jobs');
        return $result;
    }

    function get_saved_jobs($user_id, $from = null, $limit = null)
    {
        $this->db->select('jobseeker_saved_jobs.*,
						job_posts.job_post_title,
						employer.employer_name,
						employer.employer_logo_url');
        $this->db->from('jobseeker_saved_jobs');
        $this->db->where('jobseeker_id', $user_id);
        $this->db->join('job_posts', 'jobseeker_saved_jobs.job_post_id = job_posts.job_post_id');
        $this->db->join('employer', 'job_posts.job_post_employer_id = employer.employer_id');
        if ($limit != null) {
            $this->db->limit($limit, $from);
        }
        $this->db->order_by('jobseeker_saved_jobs.saved_date', 'DESC');

        $query = $this->db->get();
//      echo $this->db->last_query();
        return $query->result_array();
    }

    function get_active_jobs_view($id)
    {
        $this->db->select('job_posts.*, employer_users.emp_first_name, employer_users.emp_last_name, job_type.job_type_name');
        $this->db->select('(SELECT COUNT( job_applications_received.application_no ) FROM job_applications_received WHERE job_applications_received.job_post_id = job_posts.job_post_id ) AS no_of_applications ');
        $this->db->where(array('post_status'=>'1','ats_assign_exam_emp.emp_id'=>$id));
        $this->db->join('employer_users', 'job_posts.job_post_made_by = employer_users.emp_user_id', 'left');
        $this->db->join('job_type', 'job_posts.job_post_job_type = job_type.id', 'left');
        $this->db->join('ats_assign_exam_emp', 'job_posts.job_post_id = ats_assign_exam_emp.job_id', 'inner');
        $this->db->from('job_posts');
        $this->db->order_by('job_post_posted_date', 'DESC');
        $this->db->group_by('job_post_title');
        $query = $this->db->get();
        return $query->result_array();
    }



//  function ats_exam_do_count($emp_id,$exam_id){
//      try{
//
//          //id_ats_exam_master
//          $this->db->select('COUNT(*) as count');
//          $this->db->where('ats_emp_wise_answer.emp_id', $emp_id);
//          $this->db->where('ats_emp_wise_answer.exam_id', $emp_id);
//          $this->db->from('ats_emp_wise_answer');
//          $query = $this->db->get();
//          $count=$query->num_rows();
//          return $count;
//      }catch (Exception $e){
//          return $e->getMessage();
//      }
//  }

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

    function ats_exam_summary($emp_id, $job_id)
    {
        try {
            $this->db->select('ats_exam_master.*,ats_assign_exam_emp.from as from');
            $this->db->where('ats_assign_exam_emp.job_id', $job_id);
            $this->db->where('ats_assign_exam_emp.emp_id', $_SESSION['user_id']);
            $this->db->where('is_delete', 0);
//          $this->db->join('job_posts','job_posts.job_post_id = ats_assign_exam_jobs.jobid', 'inner');
            $this->db->join('ats_assign_exam_jobs', 'ats_exam_master.id_ats_exam_master = ats_assign_exam_jobs.exam_id', 'inner');
            $this->db->join('ats_assign_exam_emp', 'ats_assign_exam_emp.exam_id = ats_exam_master.id_ats_exam_master', 'inner');

            $this->db->from('ats_exam_master');
            $this->db->group_by(array("ats_exam_master.Title", "ats_assign_exam_emp.from"));

            $query = $this->db->get();
//            echo $this->db->last_query();
            return $query->result_array();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function get_active_jobs($id)
    {
        $this->db->select('job_posts.*, employer_users.emp_first_name, employer_users.emp_last_name, job_type.job_type_name');
        $this->db->select('(SELECT COUNT( job_applications_received.application_no ) FROM job_applications_received WHERE job_applications_received.job_post_id = job_posts.job_post_id ) AS no_of_applications ');
        $this->db->where(array('post_status'=>'1'));
        $this->db->join('employer_users', 'job_posts.job_post_made_by = employer_users.emp_user_id', 'left');
        $this->db->join('job_type', 'job_posts.job_post_job_type = job_type.id', 'left');
        $this->db->from('job_posts');
        $this->db->order_by('job_post_posted_date', 'DESC');

        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
    }

    function ats_paper_view($id)
    {
        $this->db->select('ats_exam_master.*, ats_exam_question.*, ats_exam_answer.*,ats_exam_master.status as exam_status,ats_exam_question.id_ats_exam_question as id_ats_exam_question');
        $this->db->where(array('ats_exam_master.id_ats_exam_master'=> $id));
        $this->db->join('ats_exam_question', 'ats_exam_master.id_ats_exam_master = ats_exam_question.id_ats_exam_master', 'left');
        $this->db->join('ats_exam_answer', 'ats_exam_question.id_ats_exam_question = ats_exam_answer.id_ats_exam_question', 'left');
        $this->db->from('ats_exam_master');

        $query = $this->db->get();
        return $query->result_array();
    }

    function ats_exam_assing_emp($ItemArray)
    {
        $key = [];
        $value = [];
        $value2 = [];
        foreach ($ItemArray as $value) {
            foreach ($value as $value2) {
                foreach ($value2 as $value3) {
                    $id_exam=$value3['id_exam'];
                    $id_user=$value3['id_user'];
                    $Type=$value3['Type'];
                    $Key=$value3['Key'];
                    foreach ($value3['Item'] as $key) {
                         $answer=$key;
                        $data['emp_id']=$id_user;
                        $data['exam_id']=$id_exam;
                        $data['queqtion_id']=$Key;
                        $data['answer_id']=$answer;//short_answer

                        if (!is_numeric($answer)) {
                            $data['short_answer']=$answer;
                        } else {
                            $data['short_answer']='';
                        }
                        $data['create_date']=date('Y-m-d H:i:s');
//                      --Check MSQ Answer ID is true is false-------------------------
                        $this->db->select('isCorrect');
                        $this->db->from('ats_exam_answer');
                        $this->db->where('id_ats_exam_answer', $answer);
                        $data['isCorrect']= $this->db->get()->row()->isCorrect;
                        var_dump($data['isCorrect']);
//                      ------------------
                        $res = $this->db->insert('ats_emp_wise_answer', $data);
                    }
                }
            }
        }
        return true;
    }

    function ats_interview_confirm($id, $data)
    {
        $this->db->where('idats_schedule_interview', $id);
        $result = $this->db->update('ats_schedule_interview', $data);
        return $result;
    }
}
