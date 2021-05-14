<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 11/29/2018
 * Time: 5:23 PM
 */

class Employer_job_post_model extends CI_Model
{
    function save_job_post($data)
    {
        
//jp__id
       // unset($array['jp__id']);


        //echo ver_dump($data);
       // die();

        $res = $this->db->insert('job_posts', $data);
        return $this->db->insert_id();
    }

    function ats_exam_save($data)
    {
        $res = $this->db->insert('ats_exam_master', $data);
        return $this->db->insert_id();
    }

    function ats_overall_data_add($data)
    {
        $res = $this->db->insert('ats_overall_emp_wise', $data);
        return $this->db->insert_id();
    }




    function ats_overall_data_update_level($data, $id)
    {
       


        $this->db->where('idats_schedule_interview', $id);
        $this->db->update('ats_schedule_interview', $data);
          //echo $sql = $this->db->last_query();
    }










    function ats_form_save($data)
    {
        $res = $this->db->insert('ats_interviewer_form', $data);
        return $this->db->insert_id();
    }

    function ats_offer_latter_save($data)
    {
        $res = $this->db->insert('ats_interviewer_offer_latter', $data);
        return $this->db->insert_id();
    }

    function ats_emp_schedule_exam($data)
    {
        $res = $this->db->insert('ats_schedule_interview', $data);
        return $this->db->insert_id();
    }

    function ats_save_interviewer($data)
    {
        $res = $this->db->insert('ats_interviewer_list', $data);
        return $this->db->insert_id();
    }










    function ats_save_interviewer_details($data)
    {
        $res = $this->db->insert('ats_interviewer_details', $data);
        return $this->db->insert_id();
    }

    function ats_delete_interviewer($id)
    {
        $id_list=$this->input->get('id_list');
        $this->db->where('idinterviewer_list', $id_list);
        $result =  $this->db->delete('ats_interviewer_list');
        return $result;
    }
    function ats_delete_interviewer_form($id)
    {

        $id_list=$this->input->get('id_list');
        echo $id_list;
        $this->db->where('id_ats_interviewer_form', $id_list);
        $result =  $this->db->delete('ats_interviewer_form');
        return $result;
    }

    function ats_delete_interviewer_offer_latter($id)
    {

        $id_list=$this->input->get('id_list');
        echo $id_list;
        $this->db->where('id_offer_latter', $id_list);
        $result =  $this->db->delete('ats_interviewer_offer_latter');
        return $result;
    }


    function ats_delete_interviewer_details($id)
    {

        $id_list=$this->input->get('id_list');
        $this->db->where('idinterviewer_details', $id_list);
        $result =  $this->db->delete('ats_interviewer_details');
        return $result;
    }

    function ats_save_interviewer_update($id, $data)
    {
        $this->db->where('idinterviewer_list', $id);
        $result = $this->db->update('ats_interviewer_list', $data);
        return $id;
    }
    function ats_save_interviewer_update_details($id, $data)
    {
        $this->db->where('idinterviewer_details', $id);
        $result = $this->db->update('ats_interviewer_details', $data);
        return $id;
    }

    function ats_interviewer_form($data)
    {
        $res = $this->db->insert('ats_interviewer_form', $data);
        return $this->db->insert_id();
    }

    function ats_exam_assing_job($data)
    {
        $res = $this->db->insert('ats_assign_exam_jobs', $data);
        return $this->db->insert_id();
    }
    function ats_exam_assing_emp($data)
    {
        $res = $this->db->insert('ats_assign_exam_emp', $data);
        return $this->db->insert_id();
    }
    function ats_update($id, $data)
    {
        $this->db->where('id_ats_exam_master', $id);
        $result = $this->db->update('ats_exam_master', $data);
        return $id;
    }

    function ats_update_form($id, $data)
    {
        $this->db->where('id_ats_interviewer_form', $id);
        $result = $this->db->update('ats_interviewer_form', $data);
        return $id;
    }

    function ats_offer_latter_update($id, $data)
    {
        $this->db->where('id_offer_latter', $id);
        $result = $this->db->update('ats_interviewer_offer_latter', $data);
        return $id;
    }


    function ats_answer_save($data)
    {
        $res = $this->db->insert('ats_exam_answer', $data);
        return $this->db->insert_id();
    }




    function ats_post_level_update()
    {
        $job_id=$_POST['id'];
        $no_of_levels=$_POST['no_of_levels'];
        $no_of_exam=$_POST['no_of_exam'];
        $is_publish=$_POST['is_publish'];

        $post_status= ($is_publish==0)?'3':'1';


       // post_status
      
           $data = array(
        'no_of_exam' =>  $no_of_exam,
        'no_of_levels' => $no_of_levels,
        'post_status'=> $post_status

           );
           $this->db->where('job_post_id', $job_id);
           $this->db->update('job_posts', $data);
    }











//get questionaire
    function get_questionnaire($id)
    {
        $this->db->select('id,post_id,question ');
        $this->db->where(array('post_id'=> $id,'question!=' => null,'question<>' =>''));
      
        $this->db->from('job_questionnaire');

        $query = $this->db->get();
        // $query = $this->db->get();
        //echo $sql = $this->db->last_query();

         return $query->result_array();
        ;
    }





//


    function ats_answer_save_form($data)
    {
        $res = $this->db->insert('ats_exam_answer_form', $data);
        return $this->db->insert_id();
    }

    function ats_answer_save_offer_latter($data)
    {
        $res = $this->db->insert('ats_exam_answer_offer_latter', $data);
        return $this->db->insert_id();
    }

    function ats_question_save($data)
    {
        $res = $this->db->insert('ats_exam_question', $data);
        return $this->db->insert_id();
    }
    function ats_question_update($data, $id)
    {
        $this->db->where('id_ats_exam_question', $id);
        $result = $this->db->update('ats_exam_question', $data);
        return $result;
    }
    function ats_answer_delete($id)
    {
        $this->db->where('id_ats_exam_question', $id);
        $result =  $this->db->delete('ats_exam_answer');
        return $result;
    }

    function ats_question_delete($id)
    {
        $this->db->where('id_ats_exam_question', $id);
        $result =  $this->db->delete('ats_exam_question');
        return $result;
    }

    function ats_question_load($id)
    {
//      $this->db->where('id_ats_exam_question', $id);
//      $result =  $this->db->delete('ats_exam_question');
        $this->db->select('ats_exam_master.*, ats_exam_question.*, ats_exam_answer.*,ats_exam_master.status as exam_status,ats_exam_question.id_ats_exam_question as q_id');
//      $this->db->where(array('ats_exam_master.id_ats_exam_master'=> $id));
        $this->db->where(array('ats_exam_question.id_ats_exam_question'=> $id));
        $this->db->join('ats_exam_question', 'ats_exam_master.id_ats_exam_master = ats_exam_question.id_ats_exam_master', 'left');
        $this->db->join('ats_exam_answer', 'ats_exam_question.id_ats_exam_question = ats_exam_answer.id_ats_exam_question', 'left');
        $this->db->from('ats_exam_master');

        $query = $this->db->get();
        return $query->result_array();
    }

    function ats_question_form_delete($id)
    {
        $this->db->where('id_ats_exam_question', $id);
        $result =  $this->db->delete('ats_exam_question_form');
        return $result;
    }

    function ats_question_offer_latter_delete($id)
    {
        $this->db->where('id_ats_offer_latter_question', $id);
        $result =  $this->db->delete('ats_exam_question_offer_latter');
        return $result;
    }

    function ats_question_save_form($data)
    {
        $res = $this->db->insert('ats_exam_question_form', $data);
        return $this->db->insert_id();
    }

    function ats_question_save_offer_latter($data)
    {
        $res = $this->db->insert('ats_exam_question_offer_latter', $data);
        return $this->db->insert_id();
    }

    function ats_paper_view($id)
    {
        $this->db->select('ats_exam_master.*, ats_exam_question.*,ats_exam_answer.id_ats_exam_answer, 
 ats_exam_answer.id_ats_exam_answer, ats_exam_answer.answer,
 ats_exam_answer.status,ats_exam_answer.isCorrect,ats_exam_master.status as exam_status,ats_exam_question.id_ats_exam_question as q_id');
        $this->db->where(array('ats_exam_master.id_ats_exam_master'=> $id));
        $this->db->join('ats_exam_question', 'ats_exam_master.id_ats_exam_master = ats_exam_question.id_ats_exam_master', 'left');
        $this->db->join('ats_exam_answer', 'ats_exam_question.id_ats_exam_question = ats_exam_answer.id_ats_exam_question', 'left');
        $this->db->from('ats_exam_master');
        $this->db->order_by("id_ats_exam_question", "asc");
        //order by id_ats_exam_question asc

        $query = $this->db->get();
     //   print_r($this->db->last_query());
        return $query->result_array();
    }

    function ats_paper_view_form($id)
    {
        $this->db->select('ats_interviewer_form.*, ats_exam_question_form.*, ats_exam_answer_form.*,ats_interviewer_form.status as exam_status,ats_exam_question_form.id_ats_exam_question as q_id');
        $this->db->where(array('ats_interviewer_form.id_ats_interviewer_form'=> $id));
        $this->db->join('ats_exam_question_form', 'ats_interviewer_form.id_ats_interviewer_form = ats_exam_question_form.id_ats_exam_master', 'left');
        $this->db->join('ats_exam_answer_form', 'ats_exam_question_form.id_ats_exam_question = ats_exam_answer_form.id_ats_exam_question', 'left');
        $this->db->from('ats_interviewer_form');

        $query = $this->db->get();
       // echo $this->db->last_query();
        return $query->result_array();
    }

    function ats_paper_view_offer_later($id)
    {

        $this->db->select('ats_interviewer_offer_latter.*, ats_exam_question_offer_latter.*, ats_exam_answer_offer_latter.*,ats_interviewer_offer_latter.status as exam_status,ats_exam_question_offer_latter.id_ats_offer_latter_question as q_id,ats_interviewer_offer_latter.status as status');
        $this->db->where(array('ats_interviewer_offer_latter.id_offer_latter'=> $id));
        $this->db->join('ats_exam_question_offer_latter', 'ats_interviewer_offer_latter.id_offer_latter = ats_exam_question_offer_latter.id_ats_exam_master', 'left');
        $this->db->join('ats_exam_answer_offer_latter', 'ats_exam_question_offer_latter.id_ats_offer_latter_question = ats_exam_answer_offer_latter.id_ats_exam_question', 'left');
        $this->db->from('ats_interviewer_offer_latter');

        $query = $this->db->get();
        return $query->result_array();
    }

    function ats_load_profile($id)
    {
        //jobseeker_first_name
        $this->db->select('jobseeker.*,country_master.CountryDes as country');
        $this->db->where(array('jobseeker.jobseeker_user_id'=> $id));
        $this->db->join('country_master', 'country_master.countryID=jobseeker.jobseeker_country_id', 'left');
//      $this->db->join('ats_exam_answer_form','ats_exam_question_form.id_ats_exam_question = ats_exam_answer_form.id_ats_exam_question', 'left');
        $this->db->from('jobseeker');
        $query = $this->db->get();
        return $query->result_array();
    }

    function ats_paper_view_form2($emp_id, $id_shadule)
    {

        $this->db->select('jobseeker.*,job_posts.job_post_title as job_post_title,jobseeker.jobseeker_gender as jobseeker_gender,job_posts.job_post_city as job_post_city,ats_schedule_interview.date as date_i,ats_interviewer_details.location as location');
        $this->db->where(array('jobseeker.jobseeker_user_id'=> $emp_id,'ats_schedule_interview.idats_schedule_interview'=>$id_shadule));

        $this->db->join('ats_schedule_interview', 'ats_schedule_interview.emp_id = jobseeker.jobseeker_user_id', 'left');
        $this->db->join('ats_interviewer_details', 'ats_interviewer_details.idinterviewer_details = ats_schedule_interview.location', 'left');
        $this->db->join('job_posts', 'job_posts.job_post_id = ats_schedule_interview.job_post_id', 'left');
        $this->db->from('jobseeker');

        $query = $this->db->get();
        return $query->result_array();
    }

    function ats_paper_view_write_answer($id, $emp_id)
    {
//      $emp_id= 24746;$this->input->get('emp_id');
        $emp_id= $emp_id;
        $this->db->select('ats_exam_master.*, ats_exam_question.*, ats_exam_answer.*,ats_emp_wise_answer.*,ats_exam_master.status as exam_status,ats_emp_wise_answer.short_answer');
        $this->db->where(array('ats_exam_master.id_ats_exam_master'=> $id,'ats_emp_wise_answer.emp_id'=>$emp_id,'ats_emp_wise_answer.answer_id'=>0));
        $this->db->join('ats_exam_question', 'ats_exam_master.id_ats_exam_master = ats_exam_question.id_ats_exam_master', 'left');
        $this->db->join('ats_exam_answer', 'ats_exam_question.id_ats_exam_question = ats_exam_answer.id_ats_exam_question', 'left');
        $this->db->join('ats_emp_wise_answer', 'ats_emp_wise_answer.queqtion_id = ats_exam_question.id_ats_exam_question', 'left');
        $this->db->from('ats_exam_master');
        $this->db->distinct();  //added short answer avoid  duplicate results
        $this->db->group_by('ats_exam_question.id_ats_exam_question');
        $query = $this->db->get();

        //print_r($this->db->last_query());
        
        return $query->result_array();
    }

    function ats_update_short_answer($value, $id)
    {

        $data['isCorrect']=$value;
        $this->db->where('idats_emp_wise_answer', $id);
        $this->db->update('ats_emp_wise_answer', $data);
    }

    function ats_paper_view_offer_later_update_pdf_path($id, $path)
    {
        $data['file_path']=$path;
        $this->db->where('id_offer_latter', $id);
        $this->db->update('ats_interviewer_offer_latter', $data);
    }

    function ats_paper_view_offer_later_get_pdf_path($id)
    {
        $this->db->select('ats_interviewer_offer_latter.file_path as file_path');
        $this->db->where(array('id_offer_latter'=> $id));
        $this->db->from('ats_interviewer_offer_latter');
        $file_path = $this->db->get();
    }



    function add_job_post_tags($data)
    {
        $res = $this->db->insert('job_post_skill_tags', $data);
        return $res;
    }




    function add_job_quz($data)
    {
        $res = $this->db->insert('job_questionnaire', $data);
        return $res;
    }



    

    function get_active_jobs($id)
    {
        $this->db->select('job_posts.*, employer_users.emp_first_name, employer_users.emp_last_name, job_type.job_type_name');
        $this->db->select('(SELECT COUNT( job_applications_received.application_no ) FROM job_applications_received WHERE job_applications_received.job_post_id = job_posts.job_post_id ) AS no_of_applications ');



        $this->db->where(array('job_post_employer_id'=> $id, 'post_status'=>'1'));
        $this->db->where('job_post_posted_date <', 'CURRENT_DATE');
          $this->db->where('post_approval', '1');
        
        $this->db->where('DATE_ADD(job_post_posted_date , INTERVAL 30 DAY) >', 'CURRENT_DATE', false);
        $this->db->join('employer_users', 'job_posts.job_post_made_by = employer_users.emp_user_id', 'left');
        $this->db->join('job_type', 'job_posts.job_post_job_type = job_type.id', 'left');
        $this->db->from('job_posts');
        $this->db->order_by('job_post_posted_date', 'DESC');

        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
    }









    function get_active_jobs_onlyschdule($id)
    {

      
        $this->db->select('job_posts.*, employer_users.emp_first_name, employer_users.emp_last_name, job_type.job_type_name');
        $this->db->select('(SELECT COUNT( ats_schedule_interview.job_post_id ) FROM ats_schedule_interview WHERE ats_schedule_interview.job_post_id = job_posts.job_post_id  ) AS no_of_applications ');



        $this->db->where(array('job_post_employer_id'=> $id, 'post_status'=>'1'));
        $this->db->where('job_post_posted_date <', 'CURRENT_DATE');
        $this->db->where('DATE_ADD(job_post_posted_date , INTERVAL 30 DAY) >', 'CURRENT_DATE', false);
          //$this->db->where('DATE_ADD(job_post_posted_date , INTERVAL 30 DAY) >', 'CURRENT_DATE', false);
        $this->db->join('employer_users', 'job_posts.job_post_made_by = employer_users.emp_user_id', 'left');
        $this->db->join('job_type', 'job_posts.job_post_job_type = job_type.id', 'left');
        $this->db->from('job_posts');
        $this->db->order_by('job_post_posted_date', 'DESC');

        $query = $this->db->get();
       // echo $this->db->last_query();

  
       
/*
        $sql="SELECT
    `job_posts`.*,
    `employer_users`.`emp_first_name`,
    `employer_users`.`emp_last_name`,
    `job_type`.`job_type_name`,
    (
    SELECT COUNT( ats_schedule_interview.job_post_id ) FROM ats_schedule_interview WHERE ats_schedule_interview.job_post_id = job_posts.job_post_id

    ) AS no_of_applications
FROM
    `job_posts`
    LEFT JOIN `employer_users` ON `job_posts`.`job_post_made_by` = `employer_users`.`emp_user_id`
    LEFT JOIN `job_type` ON `job_posts`.`job_post_job_type` = `job_type`.`id`
WHERE
    `job_post_employer_id` = '$id'
    AND `post_status` = '1'
    AND `job_post_posted_date` < 'CURRENT_DATE' AND DATE_ADD( job_post_posted_date, INTERVAL 30 DAY ) > CURRENT_DATE
ORDER BY
    `job_post_posted_date` DESC";

*/





       
        return $query->result_array();
    }













    function get_active_jobs_exame_list($id)
    {
        $this->db->select('job_posts.*, employer_users.emp_first_name, employer_users.emp_last_name, job_type.job_type_name');

        
        $this->db->select('(SELECT  COUNT(  DISTINCT ats_assign_exam_emp.emp_id ) FROM ats_assign_exam_emp WHERE ats_assign_exam_emp.job_id = job_posts.job_post_id  ) AS no_of_applications  ');


        
        $this->db->where(array('job_post_employer_id'=> $id, 'post_status'=>'1'));
        $this->db->where('job_post_posted_date <', 'CURRENT_DATE');
        $this->db->where('DATE_ADD(job_post_posted_date , INTERVAL 30 DAY) >', 'CURRENT_DATE', false);
        $this->db->join('employer_users', 'job_posts.job_post_made_by = employer_users.emp_user_id', 'left');
        $this->db->join('job_type', 'job_posts.job_post_job_type = job_type.id', 'left');
        $this->db->from('job_posts');
        $this->db->order_by('job_post_posted_date', 'DESC');

        $query = $this->db->get();
   //        echo $this->db->last_query();
        return $query->result_array();
    }





    function get_active_jobs_examme($id)
    {
        $this->db->select('job_posts.*, employer_users.emp_first_name, employer_users.emp_last_name, job_type.job_type_name');
        $this->db->select('(SELECT COUNT( job_applications_received.application_no ) FROM job_applications_received WHERE job_applications_received.job_post_id = job_posts.job_post_id ) AS no_of_applications ');
        $this->db->where(array('job_post_employer_id'=> $id, 'post_status'=>'1'));
        $this->db->where('job_post_posted_date <', 'CURRENT_DATE');
        $this->db->where('DATE_ADD(job_post_posted_date , INTERVAL 30 DAY) >', 'CURRENT_DATE', false);
        $this->db->join('employer_users', 'job_posts.job_post_made_by = employer_users.emp_user_id', 'left');
        $this->db->join('job_type', 'job_posts.job_post_job_type = job_type.id', 'left');
        $this->db->from('job_posts');
        $this->db->order_by('job_post_posted_date', 'DESC');

        $query = $this->db->get();
  //        echo $this->db->last_query();
        return $query->result_array();
    }











    function get_expired_jobs($id)
    {
        $this->db->select('job_posts.*, employer_users.emp_first_name, employer_users.emp_last_name, job_type.job_type_name');
        $this->db->select('(SELECT COUNT( job_applications_received.application_no ) FROM job_applications_received WHERE job_applications_received.job_post_id = job_posts.job_post_id ) AS no_of_applications ');
        $this->db->where(array('job_post_employer_id'=> $id));
        $this->db->where('DATE_ADD(job_post_posted_date , INTERVAL 30 DAY) <', 'CURRENT_DATE', false);
        $this->db->join('employer_users', 'job_posts.job_post_made_by = employer_users.emp_user_id', 'left');
        $this->db->join('job_type', 'job_posts.job_post_job_type = job_type.id', 'left');
        $this->db->from('job_posts');
        $this->db->order_by('job_post_posted_date', 'DESC');

        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
    }

    function get_active_jobs_schedule($id, $jobid)
    {

        //echo var_dump($jobid);
       // die();










        $this->db->select('job_posts.*, employer_users.emp_first_name, employer_users.emp_last_name, job_type.job_type_name');
        $this->db->select('(SELECT COUNT( ats_schedule_interview.emp_id ) FROM ats_schedule_interview WHERE ats_schedule_interview.job_post_id = job_posts.job_post_id ) AS no_of_applications ');
        $this->db->where(array('job_post_employer_id'=> $id, 'post_status'=>'1'));


        $this->db->join('employer_users', 'job_posts.job_post_made_by = employer_users.emp_user_id', 'left');
        $this->db->join('job_type', 'job_posts.job_post_job_type = job_type.id', 'left');
        $this->db->join('ats_schedule_interview', 'ats_schedule_interview.job_post_id = job_posts.job_post_id', 'inner');
//      $this->db->join('ats_interviewer_details','ats_interviewer_details.idinterviewer_details = ats_schedule_interview.location', 'inner');

        $this->db->from('job_posts');
        $this->db->order_by('job_post_posted_date', 'DESC');
        $this->db->group_by('ats_schedule_interview.job_post_id');
        $query = $this->db->get();
        $str = $this->db->last_query();

        //echo "<pre>";
       // print_r($str);


        return $query->result_array();
    }

    function ats_interviewee_list($id)
    {
        $this->db->where('user_id', $id);
        $this->db->select('ats_interviewer_list.*');
        $this->db->from('ats_interviewer_list');


        $query = $this->db->get();
        return $query->result_array();
    }

    function ats_interviewee_form($id)
    {
        $this->db->where('company_id', $id);
        $this->db->select('ats_interviewer_form.*');
        $this->db->from('ats_interviewer_form');

        $query = $this->db->get();
        return $query->result_array();
    }

    function ats_interviewee_offer_latter($id)
    {
        $this->db->where('company_id', $id);
        $this->db->select('ats_interviewer_offer_latter.*');
        $this->db->from('ats_interviewer_offer_latter');

        $query = $this->db->get();
        return $query->result_array();
    }

    function ats_interviewee_form_detail($id)
    {
        $this->db->where('user_id', $id);
        $this->db->select('ats_interviewer_details.*');
        $this->db->from('ats_interviewer_details');
        $query = $this->db->get();
        return $query->result_array();
    }

    function ats_interviewee_form_view($id)
    {
        $this->db->select('ats_interviewer_form.*');
        $this->db->from('ats_interviewer_form');

        $query = $this->db->get();
        return $query->result_array();
    }


    function ats_interviewee_form_view_marks($id)
    {
      
         $this->db->where('emp_id', $id);
        $this->db->select('sum(usermarks)/noogattemt as avg');
        $this->db->from('marksheet');

        $query = $this->db->get();
        return $query->result_array();
    }


    function ats_interviewer_form_update($id, $data)
    {
        $this->db->where('id_ats_interviewer_form', $id);
        $result = $this->db->update('ats_interviewer_form', $data);
        return $id;
    }







    function ats_resume_info($id)
    {
        

        // $this->db->select('resume_id');
        // $this->db->from('jobseeker_resume');
        // $this->db->where('jobseeker_user_id', $id);
        // $query=$this->db->limit(1);



        $this->db->select('resume_id');
        $this->db->from('jobseeker_resume');
        $this->db->where('jobseeker_user_id', $id);

     
        return $this->db->get()->row()->resume_id;
        // die();
        //  return $query->result_array();
       // return '1';
    }

















    function get_inactive_jobs($id)
    {
        $this->db->select('job_posts.*, employer_users.emp_first_name, employer_users.emp_last_name, job_type.job_type_name');
        $this->db->select('(SELECT COUNT( job_applications_received.application_no ) FROM job_applications_received WHERE job_applications_received.job_post_id = job_posts.job_post_id ) AS no_of_applications ');
        $this->db->where(array('job_post_employer_id'=> $id, 'post_status'=>'0'));
        $this->db->where('job_post_posted_date <', 'CURRENT_DATE');
        $this->db->where('DATE_ADD(job_post_posted_date , INTERVAL 30 DAY) >', 'CURRENT_DATE', false);
        $this->db->join('employer_users', 'job_posts.job_post_made_by = employer_users.emp_user_id', 'left');
        $this->db->join('job_type', 'job_posts.job_post_job_type = job_type.id', 'left');
        $this->db->order_by('job_post_posted_date', 'DESC');
        $this->db->from('job_posts');

        $query = $this->db->get();
        return $query->result_array();
    }


    function get_all_jobs($id, $limit = null)
    {
        $this->db->select('job_posts.*, employer_users.emp_first_name, employer_users.emp_last_name, job_type.job_type_name, country_master.CountryDes');
        $this->db->select('(SELECT COUNT( job_applications_received.application_no ) FROM job_applications_received WHERE job_applications_received.job_post_id = job_posts.job_post_id ) AS no_of_applications ');
        $this->db->where(array('job_post_employer_id'=> $id));
        $this->db->join('employer_users', 'job_posts.job_post_made_by = employer_users.emp_user_id', 'left');
        $this->db->join('job_type', 'job_posts.job_post_job_type = job_type.id', 'left');
        $this->db->join('country_master', 'job_posts.job_post_country = country_master.countryID', 'left');
        $this->db->order_by('job_post_posted_date', 'DESC');
        $this->db->from('job_posts');
        $this->db->limit($limit);

        $query = $this->db->get();
        return $query->result_array();
    }

    function get_all_published_job($id, $limit = null)
    {
        $this->db->select('job_posts.*, employer_users.emp_first_name, employer_users.emp_last_name, job_type.job_type_name, country_master.CountryDes');
        $this->db->select('(SELECT COUNT( job_applications_received.application_no ) FROM job_applications_received WHERE job_applications_received.job_post_id = job_posts.job_post_id ) AS no_of_applications ');
        $this->db->where(array('job_post_employer_id'=> $id));
        $this->db->join('employer_users', 'job_posts.job_post_made_by = employer_users.emp_user_id', 'left');
        $this->db->join('job_type', 'job_posts.job_post_job_type = job_type.id', 'left');
        $this->db->join('country_master', 'job_posts.job_post_country = country_master.countryID', 'left');
        $this->db->order_by('job_post_posted_date', 'DESC');
        $this->db->from('job_posts');
        $this->db->limit($limit);

        $query = $this->db->get();
        return $query->result_array();
    }

    function get_number_of_active_jobs($id)
    {
        $this->db->select('*');
        $this->db->where(array('job_post_employer_id'=> $id, 'post_status'=>'1'));
        $this->db->order_by('job_post_posted_date', 'DESC');
        $this->db->from('job_posts');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_draft_jobs($id)
    {
        $this->db->select('*');
        $this->db->where(array('job_post_employer_id'=> $id, 'post_status'=>'3'));
        $this->db->order_by('job_post_posted_date', 'DESC');
        $this->db->from('job_posts');
        $query = $this->db->get();
        return $query->result_array();
    }

    function delete_draft_job($id)
    {
        $this->db->where('job_post_id', $id);
        $result =  $this->db->delete('job_posts');
        return $result;
    }

    function delete_post_file($id)
    {
        $this->db->where('job_post_id', $id);
        $result = $this->db->update('job_posts', array('job_post_img_url' => null));
        return $result;
    }

    function get_selected_post($id)
    {
        $this->db->select('*');
        $this->db->where(array('job_post_id'=> $id));
        $this->db->from('job_posts');
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_selected_post_skill_tags($id)
    {
        $this->db->select('*');
        $this->db->where(array('job_post_id'=> $id));
        $this->db->from('job_post_skill_tags');
        $query = $this->db->get();
        return $query->result_array();
    }

    function update_post($id, $data)
    {
        $this->db->where('job_post_id', $id);
        $result = $this->db->update('job_posts', $data);
//        echo $this->db->last_query();
        return $result;
    }

    function update_tags($id)
    {
        $this->db->where('job_post_id', $id);
        $result =  $this->db->delete('job_post_skill_tags');
        return $result;
    }

    function set_job_post_status($id, $status)
    {
        $this->db->where('job_post_id', $id);
        $result = $this->db->update('job_posts', array("post_status"=>$status));
        return $result;
    }

    function get_job_post_count($emp_id)
    {
        $this->db->select("count(*) total_posts,
                           sum(case when post_status = '0' then 1 else 0 end) inactive_post,
                           sum(case when post_status = '1' then 1 else 0 end) active_post,
                           sum(case when post_status = '2' then 1 else 0 end) expired_post,
                           sum(case when post_status = '3' then 1 else 0 end) draft_post");
        $this->db->from("job_posts");
        $this->db->where('job_post_employer_id', $emp_id);

        $query = $this->db->get();
        return $query->row_array();
    }

    function get_subscriptions_available($id)
    {
        $this->db->select('*');
        $this->db->from('employer_job_plan_subscriptions');
        $this->db->where('employer_id', $id);
        $this->db->where('expiry_date >', 'CURRENT_DATE', false);
        $query = $this->db->get();
//      echo $this->db->last_query();
        return $query->row_array();
    }

    function ats_interview_confirm($id, $data)
    {
        $this->db->where('idats_schedule_interview', $id);
        $result = $this->db->update('ats_schedule_interview', $data);
        return $result;
    }


    function getmcqmarks($emp_id, $examIDD)
    {

           $sql="SELECT a.*,b.mark ,
sum(if(a.isCorrect='true',b.mark,0))/sum(b.mark) as result

FROM ats_emp_wise_answer a
left outer join ats_exam_question b
on 
a.queqtion_id=b.id_ats_exam_question


where a.emp_id='$emp_id' and a.exam_id='$examIDD'  and b.id_ats_exam_master='$examIDD'
and b.type in(1,2)";

        $query = $this->db->query($sql);

        foreach ($query->result() as $row) {
                 $count =$row->result;
        }


        return $count * 100;
    }




    function getshortmarks($emp_id, $examIDD)
    {
          $sql="SELECT a.*,b.mark ,
sum(a.isCorrect)/   sum(b.mark) as result

FROM ats_emp_wise_answer a
left outer join ats_exam_question b
on 
a.queqtion_id=b.id_ats_exam_question


where a.emp_id='$emp_id' and a.exam_id='$examIDD'  and b.id_ats_exam_master='$examIDD'
and b.type in(3) 
and isCorrect is not null and isCorrect<> 0 ";

        $query = $this->db->query($sql);

        foreach ($query->result() as $row) {
                 $count =$row->result;
        }


        return $count * 100;
    }





    function getpercentage($emp_id, $examIDD)
    {

          $sql="SELECT a.*,b.mark ,
sum(a.isCorrect)/   sum(b.mark) as result

FROM ats_emp_wise_answer a
left outer join ats_exam_question b
on 
a.queqtion_id=b.id_ats_exam_question


where a.emp_id='$emp_id' and a.exam_id='$examIDD'  and b.id_ats_exam_master='$examIDD'
and b.type in(3) 
and isCorrect is not null and isCorrect<> 0";

        $query = $this->db->query($sql);

        foreach ($query->result() as $row) {
                 $count1 =$row->result;
        }


           $count1=$count1 * 100;



        $sql2="SELECT a.*,b.mark ,
sum(if(a.isCorrect='true',b.mark,0))/sum(b.mark) as result

FROM ats_emp_wise_answer a
left outer join ats_exam_question b
on 
a.queqtion_id=b.id_ats_exam_question


where a.emp_id='$emp_id' and a.exam_id='$examIDD'  and b.id_ats_exam_master='$examIDD'
and b.type in(1,2)";

        $query2 = $this->db->query($sql2);

        foreach ($query2->result() as $row) {
                 $count2 =$row->result;
        }


           $count2= $count2 * 100;



        return ($count1+$count2 )/2;
    }






    function getpercentageavg($id)
    {

        $sql="SELECT a.*,b.mark ,
sum(a.isCorrect)/   sum(b.mark) as result

FROM ats_emp_wise_answer a
left outer join ats_exam_question b
on 
a.queqtion_id=b.id_ats_exam_question


where a.emp_id='$emp_id'
and b.type in(3) 
and isCorrect is not null and isCorrect<> 0";

        $query = $this->db->query($sql);

        foreach ($query->result() as $row) {
                 $count1 =$row->result;
        }


           $count1=$count1 * 100;



        $sql2="SELECT a.*,b.mark ,
sum(if(a.isCorrect='true',b.mark,0))/sum(b.mark) as result

FROM ats_emp_wise_answer a
left outer join ats_exam_question b
on 
a.queqtion_id=b.id_ats_exam_question


where a.emp_id='$emp_id'  b.type in(1,2)";

        $query2 = $this->db->query($sql2);

        foreach ($query2->result() as $row) {
                 $count2 =$row->result;
        }


           $count2= $count2 * 100;



        return ($count1+$count2 )/2;
    }


    function add_rate($data)
    {
        $ratings=$data['rating'];
        $job_post_id=$data['job_id'];
        $jobseeker_id=$data['jobseeker_id'];

        $this->db->set('ratings', $ratings);
        $this->db->where('job_post_id', $job_post_id);
        $this->db->where('jobseeker_id', $jobseeker_id);
        $this->db->update('job_applications_received');

         echo  '{"success":1}';

       // echo  $this->db->last_query();
    }


    function change_status($emp_id, $id, $status)
    {

        $this->db->set('status', $status);
        $this->db->where('idats_overall_emp_wise', $id);
        $this->db->update('ats_overall_emp_wise');
    }
}
