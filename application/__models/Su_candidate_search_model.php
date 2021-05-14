<?php


class Su_candidate_search_model extends CI_Model
{
    function __construct()
    {
        // Set table name
        $this->employer_table = 'employer';
        // Set orderable column fields
        $this->column_order = array(null, 'employer_name','employer_email','employer_phone_no','joined_date');
        // Set searchable column fields
        $this->column_search = array('employer_name','employer_email');
        // Set default order
        $this->order = array('employer_name' => 'asc');
    }

    function get_no_records($table)
    {
        $this->db->select('COUNT(*)');
        $this->db->from($table);

        $query = $this->db->get();
        return $query->row_array();
    }

    /*
     * Fetch members data from the database
     * @param $_POST filter data based on the posted parameters
     */
//  public function search_records($postData){
//      $this->_get_datatables_query($postData);
//      if($postData['length'] != -1){
//          $this->db->limit($postData['length'], $postData['start']);
//      }
//      $query = $this->db->get();
//      return $query->result();
//  }


    function search_match($postData)
    {




        $this->db->select('
        jobseeker.jobseeker_id,
        jobseeker.jobseeker_first_name,
        jobseeker.jobseeker_middle_name,
        jobseeker.jobseeker_last_name,
        jobseeker.jobseeker_gender,
        jobseeker.jobseeker_dob,
        jobseeker.jobseeker_phone_no,
        jobseeker.jobseeker_user_id,
        jobseeker.jobseeker_dp_url,
        jobseeker.joined_date,
        jobseeker_resume.resume_id,
        jobseeker_resume.resume_name,
        jobseeker_resume.about_description as content,
        jobseeker_resume.inserted_date,
        jobseeker_resume.updated_date,
        jobseeker_resume_work_exp.company,
        jobseeker_resume_work_exp.job_title,
        jobseeker_resume_work_exp.description,
        recent_work.job_title AS recent_job,
        recent_work.company AS recent_work_place,
        jobseeker_resume_skill.skill,
        jobseeker_resume_education.specialization,
        jobseeker_resume_education.school,
        jobseeker_resume_education.related_info,
        user.email,
        (SELECT GROUP_CONCAT(jobseeker_resume_skill.skill SEPARATOR ", ") AS skill_set
FROM jobseeker_resume_skill WHERE jobseeker_resume_skill.resume_id = jobseeker_resume.resume_id) AS skill_set');

        if (isset($postData['search_q']) && !empty($postData['search_q']) && !ctype_space($postData['search_q'])) {
            $search_key = "'".$postData['search_q']."*'";

          
          
            $this->db->select('
            MATCH ( jobseeker_resume.about_description ) AGAINST ('.$search_key.' IN BOOLEAN MODE ) AS about_match,
            MATCH ( jobseeker_resume_work_exp.job_title) AGAINST ( '.$search_key.' IN BOOLEAN MODE ) AS job_match,
            MATCH ( jobseeker_resume_education.specialization, jobseeker_resume_education.school, jobseeker_resume_education.related_info ) AGAINST ( '.$search_key.' IN BOOLEAN MODE ) AS edu_match,
            MATCH ( jobseeker_resume_skill.skill ) AGAINST ( '.$search_key.' IN BOOLEAN MODE ) AS skill_match');
        }

        $this->db->from('jobseeker');
        $this->db->join('jobseeker_resume', 'jobseeker.jobseeker_user_id = jobseeker_resume.jobseeker_user_id', 'inner');
        $this->db->join('user', 'jobseeker.jobseeker_user_id = user.user_id', 'inner');
        $this->db->join('jobseeker_resume_about', 'jobseeker_resume.resume_id = jobseeker_resume_about.resume_id', 'left');
        $this->db->join('jobseeker_resume_work_exp', 'jobseeker_resume.resume_id = jobseeker_resume_work_exp.resume_id', 'left');
        $this->db->join('jobseeker_resume_skill', 'jobseeker_resume.resume_id = jobseeker_resume_skill.resume_id', 'left');
        $this->db->join('jobseeker_resume_education', 'jobseeker_resume.resume_id = jobseeker_resume_education.resume_id', 'left');
        if (isset($postData['language']) && !empty($postData['language'])) {
            $this->db->join('jobseeker_resume_language', 'jobseeker_resume.resume_id = jobseeker_resume_language.resume_id', 'left');
        }
        $this->db->join('( SELECT * FROM jobseeker_resume_work_exp GROUP BY work_exp_id ORDER BY start_date DESC) AS recent_work', 'jobseeker_resume.resume_id = recent_work.resume_id', 'left');


        if (isset($postData['search_q']) && !empty($postData['search_q']) && !ctype_space($postData['search_q'])) {
            $search_key = "'".$postData['search_q']."*'";
            $this->db->group_start();
            $this->db->where('MATCH ( jobseeker_resume.about_description ) AGAINST ( '.$search_key.' IN BOOLEAN MODE)');
            $this->db->or_where('MATCH ( jobseeker_resume_work_exp.company, jobseeker_resume_work_exp.job_title, jobseeker_resume_work_exp.description ) AGAINST ( '.$search_key.' IN BOOLEAN MODE)');
            $this->db->or_where('MATCH ( jobseeker_resume_education.specialization, jobseeker_resume_education.school, jobseeker_resume_education.related_info ) AGAINST ( '.$search_key.' IN BOOLEAN MODE)');
            $this->db->or_where('MATCH ( jobseeker_resume_skill.skill ) AGAINST ( '.$search_key.' IN BOOLEAN MODE)');
            $this->db->group_end();
        }
        if (isset($postData['country']) && !empty($postData['country'])) {
            $filter = $postData['country'];
            $this->db->where('jobseeker.jobseeker_country_id', $filter);
        }
        if (isset($postData['gender']) && !empty($postData['gender'])) {
            $filter = $postData['gender'];
            $this->db->where('jobseeker.jobseeker_gender', $filter);
        }
        if (isset($postData['industry']) && !empty($postData['industry'])) {
            $filter = $postData['industry'];
            $this->db->where('jobseeker_resume_work_exp.company_industry', $filter);
        }
        if (isset($postData['category']) && !empty($postData['category'])) {
            $filter = $postData['category'];
            $this->db->where('jobseeker_resume_work_exp.job_category', $filter);
        }
        if (isset($postData['language']) && !empty($postData['language'])) {
            $filter = $postData['language'];
            $this->db->where('jobseeker_resume_language.js_language', $filter);
        }
        $this->db->where('jobseeker_resume.hidden', '0');

        $this->db->group_by('jobseeker.jobseeker_id');

        if (isset($postData['search_q']) && !empty($postData['search_q']) && !ctype_space($postData['search_q'])) {
            $this->db->order_by('job_match', 'DESC');
//          $this->db->order_by('skill_match', 'DESC');
//          $this->db->order_by('edu_match', 'DESC');
//          $this->db->order_by('about_match', 'DESC');
        }

        $tempdb = clone $this->db;
        $num_results= $tempdb->count_all_results();

        if (isset($postData['length']) && $postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        }

        $query = $this->db->get();
        $this->db->last_query();

       
        $results =  $query->result();
        return(array('results'=> $results, 'count'=>$num_results));
    }


    function get_candidate_skills($id)
    {
        $this->db->select('GROUP_CONCAT(jobseeker_resume_skill.skill SEPARATOR ", ") AS skill_set');
        $this->db->from('jobseeker_resume_skill');
        $this->db->where('jobseeker_resume_skill.resume_id', $id);

        $query = $this->db->get();
        echo $this->db->last_query();
        exit();
        $results =  $query->row();
        return($results);
    }

    /*
     * Count all records
     */
    public function countAll()
    {
        $this->db->from($this->employer_table);
        return $this->db->count_all_results();
    }

    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */
    public function countFiltered($postData)
    {
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */
    private function _get_datatables_query($postData)
    {

        $this->db->from($this->employer_table);

        $i = 0;
        // loop searchable columns
        foreach ($this->column_search as $item) {
            // if datatable send POST for search
            if ($postData['search']['value']) {
                // first loop
                if ($i===0) {
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                } else {
                    $this->db->or_like($item, $postData['search']['value']);
                }

                // last loop
                if (count($this->column_search) - 1 == $i) {
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }

        if (isset($postData['order'])) {
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        } elseif (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
}
