<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 8/3/2018
 * Time: 3:18 PM
 */

class Job_seeker_resume extends Main_Controller
{
    private $resume_id_global;
    private $user_id;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('jobseeker_resume_model', 'resume_model');
        $this->user_id = $this->session->user_id;
    }

//    public function job_seeker_view_resumes()
//    {
//
//        $data['jobseeker_resume_list']=$this->resume_model->get_resume_list(array('jobseeker_user_id' => $this->user_id, 'hidden' =>'0'));
//        $data['resume_progress']=$this->resume_model->get_resume_section_status();
//        $data['main_content'] = 'job_seeker/job_seeker_resume_list';
//
//        //load main content page
//        $data['page_title'] = 'My Resumes';
//        $this->load->view('templates/template_job_seeker', $data);
//    }

    function job_seeker_save_new_resume()
    {

        $_POST['jobseeker_user_id']=$this->user_id;
        $resume_data = $this->input->post();

        try {
            $res = $this->master_dml_model->add_data_return_id('jobseeker_resume', $resume_data);
            echo json_encode('cv_id='.$res);
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
        }
    }

    function job_seeker_set_resume_status()
    {
        try {
//            $_POST['user_id'] = $this->user_id;

            $form_data = $this->input->post();

            $this->db->trans_begin();

            $res = $this->master_dml_model->update_data('jobseeker_resume', array('resume_id'=>$_POST['resume_id']), $form_data);

            $r = $this->db->trans_commit();
            echo json_encode($r, $res);
            return $r;
        } catch (Exception $e) {
            $this->db->trans_rollback();
            return $e->getMessage();
        }
    }

    function job_seeker_delete_resume()
    {

        $rec_data_received = $this->input->post();

        if ($this->check_resume_id_with_user_id_owner($rec_data_received['r_id'])) {
            try {
                $this->db->trans_begin();

                $this->master_dml_model->update_data('jobseeker_resume', array('resume_id' => $rec_data_received['r_id']), array('hidden'=>'1'));
                $this->master_dml_model->update_data('jobseeker_resume_award', array('resume_id' => $rec_data_received['r_id']), array('hidden'=>'1'));
                $this->master_dml_model->update_data('jobseeker_resume_education', array('resume_id' => $rec_data_received['r_id']), array('hidden'=>'1'));
                $this->master_dml_model->update_data('jobseeker_resume_language', array('resume_id' => $rec_data_received['r_id']), array('hidden'=>'1'));
                $this->master_dml_model->update_data('jobseeker_resume_skill', array('resume_id' => $rec_data_received['r_id']), array('hidden'=>'1'));
                $this->master_dml_model->update_data('jobseeker_resume_work_exp', array('resume_id' => $rec_data_received['r_id']), array('hidden'=>'1'));


                if ($this->db->trans_status() === false) {
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                }

                $this->db->trans_complete();


                echo json_encode($this->db->trans_status());
            } catch (Exception $e) {
                echo json_encode($e->getMessage());
            }
        } else {
            echo json_encode("You're not allowed to delete this Resume, Resume is not matching with your profile");
        }
    }

    public function job_seeker_new_resume()
    {
        $res_id = $this->input->get();
        $this->resume_id_global = $res_id['cv_id'];
        $resume_id = $this->resume_id_global;


        if (isset($resume_id) && !empty($resume_id)) {
            //form data
            $data['country_list'] = $this->master_dml_model->get_all_data('country_master');
            $data['job_type'] = $this->master_dml_model->get_all_data('job_type', array('is_hidden_deleted'=>'0'));
            $data['job_category'] = $this->master_dml_model->get_all_data('job_category', array('is_hidden_deleted'=>'0'));
            $data['job_industry'] = $this->master_dml_model->get_all_data('job_industry', array('is_hidden_deleted'=>'0'));
            $data['career_level'] = $this->master_dml_model->get_all_data('career_level');
            $data['salary_range'] = $this->master_dml_model->get_all_data('salary_range');
            $data['education_level'] = $this->master_dml_model->get_all_data('education_level_master');
            $data['experience_level'] = $this->master_dml_model->get_all_data('experience_level');
            $data['language_level'] = $this->master_dml_model->get_all_data('language_level_master', null, 'order ASC');
            $data['languages'] = $this->master_dml_model->get_all_data('language_master', null, 'language_name ASC');

            //Resume Info
            $resume_info = $this->resume_model->get_resume_info(array('resume_id' => $resume_id));
            $data['resume_data']=$resume_info;

            //Resume data
            $data['resume_work_exp']=$this->master_dml_model->get_all_data('jobseeker_resume_work_exp', array('resume_id'=>$resume_id, 'hidden'=>'0'), 'start_date DESC');
            $data['resume_skills']=$this->master_dml_model->get_all_data('jobseeker_resume_skill', array('resume_id'=>$resume_id, 'hidden'=>'0'), 'skill_id ASC');
            $data['resume_edus']=$this->master_dml_model->get_all_data_join('jobseeker_resume_education', '*', array('resume_id'=>$resume_id, 'hidden'=>'0'), 'start_date DESC', null, null, 'education_level_master', 'jobseeker_resume_education.edu_level=education_level_master.edu_lvl_id', 'left');
            $data['resume_awards']=$this->master_dml_model->get_all_data('jobseeker_resume_award', array('resume_id'=>$resume_id, 'hidden'=>'0'), 'date_of_award DESC');
            $data['resume_langs'] =$this->resume_model->get_job_seeker_resume_language($resume_id);

            //load main content page
            $data['main_content'] = 'job_seeker/job_seeker_new_resume';

            $data['page_title'] = $resume_info['resume_name'].' &bull; Resumes';
            $this->load->view('templates/template_job_seeker', $data);
        } else {
            redirect('job_seeker/resume');
        }
    }

    function check_resume_id_with_user_id_owner($resume_id)
    {
        // Check the the resume id and user id to ensure that resume is owned by the current user
        // In case of conflict, an error will be triggered.

        try {
            $resume_id_in_table = $this->master_dml_model->get_data('jobseeker_resume', 'resume_id', 'jobseeker_user_id ='. $this->user_id .' AND resume_id ='.$resume_id);

            if ($resume_id_in_table['resume_id'] == $resume_id) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function add_resume_item()
    {
        $rec_data_received = $this->input->post();

//        print_r($rec_data_received);
//        exit();

        $table=$this->set_table_and_column($rec_data_received['form_id']);
        $rec_id = $rec_data_received['rec_id'];
        unset($rec_data_received['form_id']);

        if ($this->check_resume_id_with_user_id_owner($rec_data_received['resume_id'])) {
            try {
                if ($rec_data_received['operation']==1) { // check if it's new record
                    unset($rec_data_received['rec_id'], $rec_data_received['operation']);

                    $this->db->trans_begin();

                    $res = $this->master_dml_model->add_data_return_id($table['tab_name'], $rec_data_received);

                    if ($this->db->trans_status() === false) {
                        $this->db->trans_rollback();
                        echo json_encode(array('code'=>0, 'message'=>'Something went wrong'));
                    } else {
                        $this->db->trans_commit();
                        $new_record_to_user_view = $this->load_last_added_data_to_view($rec_data_received['resume_id'], $table['tab_name']);
                        echo json_encode($new_record_to_user_view, $res);
                    }
                } elseif ($rec_data_received['operation']==2) { // check if it's edit request
//                    $rec_id = $rec_data_received['rec_id'];
                    unset($rec_data_received['rec_id'], $rec_data_received['operation']);
                    $this->db->trans_begin();

                    $res = $this->master_dml_model->update_data($table['tab_name'], array($table['column'] => $rec_id), $rec_data_received);

                    if ($this->db->trans_status() === false) {
                        $this->db->trans_rollback();
                        echo json_encode(array('code'=>0, 'message'=>'Something went wrong'));
                    } else {
                        $this->db->trans_commit();
                        $new_record_to_user_view = $this->load_last_added_data_to_view($rec_data_received['resume_id'], $table['tab_name']);
                        echo json_encode($new_record_to_user_view, $res);
                    }
                }
            } catch (Exception $e) {
                echo json_encode($e->getMessage());
            }
        } else {
            echo json_encode("Resume ID is wrong");
        }
    }

    function add_resume_about()
    {

        $resume_about = $this->input->post();

        $res = $this->master_dml_model->update_data('jobseeker_resume', array('resume_id'=>$resume_about['resume_id']), array('about_description'=>$resume_about['about_description']));

        echo json_encode($res);
    }


    function add_resume_video()
    {
        $status = "";
        $msg = "";
        $file_element_name = 'file';
       // die('ok');
        $config['upload_path'] = './uploads/resume/';
        $config['allowed_types'] = 'mp4';
        $config['max_size'] = 1024 * 1024* 25;
        $config['encrypt_name'] = true;
 
        $this->load->library('upload', $config);
 
        if (!$this->upload->do_upload($file_element_name)) {
            $status = 'error';
            $msg = $this->upload->display_errors('', '');
        } else {
            $data = $this->upload->data();
            //$file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
            $datan['video_name']=$data['file_name'];
            $datan['jobseeker_id']=$this->user_id;
            $datan['date_created']=date("Y-m-d H:i:s");
            
            $file_id  = $this->resume_model->addvideo($datan);

            if ($file_id) {
                $status = "success";
                $msg = "File successfully uploaded";
            } else {
                unlink($data['full_path']);
                $status = "error";
                $msg = "Something went wrong when saving the file, please try again.";
            }
        }
        @unlink($_FILES[$file_element_name]);

        echo $msg ;
    }










    function load_last_added_data_to_view($record_id, $table)
    {

        switch ($table) {
            case 'jobseeker_resume_work_exp':
                return $this->load_work_exp($record_id, $table);
                break;
            case 'jobseeker_resume_skill':
                return $this->load_pro_skill($record_id, $table);
                break;
            case 'jobseeker_resume_education':
                return $this->load_edu($record_id, $table);
                break;
            case 'jobseeker_resume_award':
                return $this->load_award($record_id, $table);
                break;
            case 'jobseeker_resume_language':
                return $this->load_language($record_id, $table);
                break;
            default:
                return false;
        }
    }

    function get_resume_data()
    {
        //Get resume data to the modal form to edit.
        //Return data will be fetched by the calling JS to the user.

        $rec_data_received = $this->input->post();

        $table=$this->set_table_and_column($rec_data_received['section']);

        $record_to_edit = $this->master_dml_model->get_data($table['tab_name'], '*', array($table['column'] => $rec_data_received['rec_id']));

        if (empty($record_to_edit['end_date'])) {
            unset($record_to_edit['end_date']);
        }
        echo json_encode($record_to_edit);
    }

    function delete_resume_item()
    {
        //Delete records

        $rec_data_received = $this->input->post();

        $table=$this->set_table_and_column($rec_data_received['section']);

        $res = $this->master_dml_model->delete_data($table['tab_name'], $table['column'], $rec_data_received['rec_id']);

        echo json_encode($res);
    }






    function upload_file()
    {
        $status = "";
        $msg = "";
        $file_element_name = 'userfile';
     
    
     
        if ($status != "error") {
            $config['upload_path'] = './files/';
            $config['allowed_types'] = 'mp4';
            $config['max_size'] = 1024 * 25;
            $config['encrypt_name'] = true;
 
            $this->load->library('upload', $config);
 
            if (!$this->upload->do_upload($file_element_name)) {
                 $status = 'error';
                 $msg = $this->upload->display_errors('', '');
            } else {
                 $data = $this->upload->data();
                 $file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
                if ($file_id) {
                    $status = "success";
                    $msg = "File successfully uploaded";
                } else {
                    unlink($data['full_path']);
                    $status = "error";
                    $msg = "Something went wrong when saving the file, please try again.";
                }
            }
            @unlink($_FILES[$file_element_name]);
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }













    function set_table_and_column($form_id)
    {
        //Set table names based on form

        switch ($form_id) {
            case "work-exp":
                return array('tab_name' =>'jobseeker_resume_work_exp', 'column' => 'work_exp_id');
                break;
            case "pro-skill":
                return array('tab_name' =>'jobseeker_resume_skill', 'column' => 'skill_id');
                break;
            case "edu":
                return array('tab_name' =>'jobseeker_resume_education', 'column' => 'edu_id');
                break;
            case "award":
                return array('tab_name' =>'jobseeker_resume_award', 'column' => 'award_id');
                break;
            case "lang-skill":
                return array('tab_name' =>'jobseeker_resume_language', 'column' => 'lang_res_id');
                break;
            default:
                echo "Your favorite color is neither red, blue, nor green!";
                return false;
        }
    }

    function upload_resume()
    {
        $resume_id = $this->input->post('r_id');

        $config['upload_path']          = JOB_SEEKER_RESUME_SAVE_DIR;
        $config['allowed_types']        = 'doc|docx|pdf';
        $config['max_size']             = 5000;
        $config['file_name']            = $this->user_id.'_'.$resume_id.'_'.time();
        $today = date("Y-m-d H:i:s");

        $this->load->library('upload', $config);

        if (! $this->upload->do_upload('file')) {
            echo json_encode(false);
        } else {
            $upload_status = ($this->upload->data());
            $res = $this->resume_model->update_resume_info($resume_id, array('resume_attachment' => $upload_status['file_name'],'jobseeker_user_id'=>$this->user_id,'resume_name'=>'My resume '.$today,'about_description'=>'My resume '.$today,'is_primary'=>1));

            echo json_encode($res);
        }
    }














    function delete_resume_file_attachment()
    {
        $resume_id = $this->input->post('r_id');
        try {
            $res_info = $this->resume_model->get_resume_info_byid(array('resume_id'=>$resume_id));

            if (!empty($res_info)) {
                $this->db->trans_begin();
                $res = $this->resume_model->delete_resume_file($resume_id);
                if ($this->db->trans_status() === false) {
                    $this->db->trans_rollback();
                    echo json_encode(array('code'=>0, 'message' => 'Something went wrong'));
                } else {
                    $name = JOB_SEEKER_RESUME_SAVE_DIR.$res_info['resume_attachment'];
                    $del_res = unlink($name);
                    if ($del_res == true) {
                        $res = $this->db->trans_commit();
                        echo json_encode(array('code'=>1, 'message' => 'File deleted successfully', 'status' => $res));
                    }
                }
                $this->db->trans_complete();
            } else {
                echo json_encode(array("code" => 0, "message" => "Couldn't delete the file, Failed to retrieve data, please try again"));
            }
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
        }
    }

    /*
    *********************
    Functions to load added data to the front view for the users
    Pushed to the front via AJAX call over JS.
    *********************
     */

    function load_work_exp($resume_id, $table)
    {

        $resume_work_exps=$this->master_dml_model->get_all_data($table, array('resume_id'=>$resume_id), 'start_date DESC');
        $new_record_to_front='';
        if (!empty($resume_work_exps)) {
            foreach ($resume_work_exps as $resume_work_exp) {
                if (!empty($resume_work_exp['start_date']) && $resume_work_exp['start_date'] != '0000-00-00') {
                    $start_date = date("M Y", strtotime($resume_work_exp['start_date']));
                } else {
                    $start_date = "";
                }

                if (!empty($resume_work_exp['end_date']) && $resume_work_exp['end_date'] != '0000-00-00') {
                    $end_date = date("M Y", strtotime($resume_work_exp['end_date']));
                } elseif ($resume_work_exp['still_work'] =='yes') {
                    $end_date = 'To date';
                } else {
                    $end_date = "Not stated";
                }

                if (!empty($start_date)) {
                    $hyp = ' - ';
                } else {
                    $hyp = ' ';
                }

                $new_record_to_front = $new_record_to_front . '<div class="edu-history style2 work-exp" id="work-exp-'.$resume_work_exp['work_exp_id'].'">
                                    <i></i>
                                    <div class="edu-hisinfo">
                                        <h3>'.$resume_work_exp['job_title'].'<span>'.$resume_work_exp['company'].'</span></h3>
                                        <i>'.$start_date.$hyp.$end_date.'</i>
                                        <p>'.$resume_work_exp['description'].'</p>
                                    </div>
                                    <ul class="action_job">
                                        <li><span>Edit</span><a data-id="'.$resume_work_exp['work_exp_id'].'" data-section="work-exp" onclick="edit_resume_item(this)" title=""><i class="la la-pencil"></i></a></li>
                                        <li><span>Delete</span><a data-id="'.$resume_work_exp['work_exp_id'].'" data-section="work-exp" onclick="delete_resume_item(this)" title=""><i class="la la-trash-o"></i></a></li>
                                    </ul>
                                </div>';
            }
            return $new_record_to_front;
        } else {
            return false;
        }
    }

    function load_pro_skill($resume_id, $table)
    {
        $resume_pro_skills=$this->master_dml_model->get_all_data($table, array('resume_id'=>$resume_id, 'skill ASC'));
        $new_record_to_front='';
        if (!empty($resume_pro_skills)) {
            foreach ($resume_pro_skills as $resume_pro_skill) {
                $new_record_to_front = $new_record_to_front .
                    '<div class="progress-sec with-edit pro-skill" id="pro-skill-'.$resume_pro_skill['skill_id'].'">
                        <span>'.$resume_pro_skill['skill'].'</span>
                        <div class="progressbar"> <div class="progress" style="width:'.$resume_pro_skill['skill_level'].'%"><span>'.$resume_pro_skill['skill_level'].'%'.'</span></div> </div>
                        <ul class="action_job">
                            <li><span>Edit</span><a data-id="'.$resume_pro_skill['skill_id'].'" data-section="pro-skill" onclick="edit_resume_item(this)" ><i class="la la-pencil"></i></a></li>
                            <li><span>Delete</span><a data-id="'.$resume_pro_skill['skill_id'].'" data-section="pro-skill" onclick="delete_resume_item(this)" title=""><i class="la la-trash-o"></i></a></li>
                        </ul>
                    </div>';
            }
            return $new_record_to_front;
        } else {
            return false;
        }
    }

    function load_edu($resume_id, $table)
    {

        $resume_edus = $this->master_dml_model->get_all_data_join($table, '*', array('resume_id' => $resume_id), 'start_date DESC', null, null, 'education_level_master', 'jobseeker_resume_education.edu_level=education_level_master.edu_lvl_id', 'left');
        $new_record_to_front = '';
        if (!empty($resume_edus)) {
            foreach ($resume_edus as $resume_edu) {
                if (!empty($resume_edu['start_date']) && $resume_edu['start_date'] != '0000-00-00') {
                    $start_date = date("M Y", strtotime($resume_edu['start_date']));
                } else {
                    $start_date = "";
                }

                if (!empty($resume_edu['end_date']) && $resume_edu['end_date'] != '0000-00-00') {
                    $end_date = date("M Y", strtotime($resume_edu['end_date']));
                } elseif ($resume_edu['still_following'] =='yes') {
                    $end_date = 'Following';
                } else {
                    $end_date = "Not stated";
                }

                if (!empty($start_date)) {
                    $hyp = ' - ';
                } else {
                    $hyp = ' ';
                }

                $new_record_to_front = $new_record_to_front .
                    '<div class="edu-history edu" id="edu-' . $resume_edu['edu_id'] . '">
                        <i class="la la-graduation-cap"></i>
                        <div class="edu-hisinfo">
                            <h3>' . $resume_edu['education_level_name'] . '</h3>
                            <i>'.$start_date.$hyp.$end_date.'</i>
                            <span>' . $resume_edu['school'] . ' <i>' . $resume_edu['specialization'] . '</i></span>
                            <p>' . $resume_edu['related_info'] . '</p>
                        </div>
                        <ul class="action_job">
                            <li><span>Edit</span><a data-id="' . $resume_edu['edu_id'] . '" data-section="edu" onclick=" edit_resume_item(this)" ><i class="la la-pencil"></i></a></li>
                            <li><span>Delete</span><a data-id="' . $resume_edu['edu_id'] . '" data-section="edu" onclick="delete_resume_item(this)" title=""><i class="la la-trash-o"></i></a></li>
                        </ul>
                    </div>';
            }
            return $new_record_to_front;
        } else {
            return false;
        }
    }


    function load_award($resume_id, $table)
    {

        $resume_awards=$this->master_dml_model->get_all_data($table, array('resume_id'=>$resume_id), 'date_of_award DESC');
        $new_record_to_front='';
        if (!empty($resume_awards)) {
            foreach ($resume_awards as $resume_award) {
                $new_record_to_front = $new_record_to_front .
                    '<div class="edu-history style2 award" id="award-' . $resume_award['award_id'] . '">
                        <i></i>
                        <div class="edu-hisinfo">
                            <h3>'.$resume_award['award'].'</h3>
                            <i>'.$resume_award['date_of_award'].'</i>
                            <p>'.$resume_award['date_of_award'].'</p>
                        </div>
                        <ul class="action_job">
                            <li><span>Edit</span><a data-id="'.$resume_award['award_id'] .'" data-section="award" onclick=" edit_resume_item(this)" ><i class="la la-pencil"></i></a></li>
                            <li><span>Delete</span><a data-id="'.$resume_award['award_id'] .'" data-section="award" onclick="delete_resume_item(this)" title=""><i class="la la-trash-o"></i></a></li>
                        </ul>
                    </div>';
            }
            return $new_record_to_front;
        } else {
            return false;
        }
    }


    function load_language($resume_id, $table)
    {
        $resume_langs=$data['resume_langs'] =$this->resume_model->get_job_seeker_resume_language($resume_id);
        $new_record_to_front='';
        if (!empty($resume_langs)) {
            foreach ($resume_langs as $resume_lang) {
                $new_record_to_front = $new_record_to_front .
                    '<div class="edu-history lang-skill language-cus col-md-6" id="lang-skill-'.$resume_lang['lang_res_id'].'">
                        <div class="edu-hisinfo">
                            <h3>'.$resume_lang['language_name'].'</h3>
                            <p>
                                <i class="fas fa-book-open"></i> &nbsp; Reading: '.$resume_lang['reading'].' <br>
                                <i class="fas fa-pen-nib"></i> &nbsp; Writing: '.$resume_lang['writing'].' <br>
                                <i class="fas fa-volume-up"></i> &nbsp; Speaking: '.$resume_lang['speaking'].' <br> 
                            </p>
                        </div>
                        <ul class="action_job">
                            <li><span>Edit</span><a data-id="'.$resume_lang['lang_res_id'].'" data-section="lang-skill" onclick="edit_resume_item(this)"><i class="la la-pencil"></i></a></li>
                            <li><span>Delete</span><a data-id="'.$resume_lang['lang_res_id'].'" data-section="lang-skill" onclick="delete_resume_item(this)"><i class="la la-trash-o"></i></a></li>
                        </ul>
                    </div>';
            }
            return $new_record_to_front;
        } else {
            return false;
        }
    }

    function set_default_resume()
    {
        $resume_id = $this->input->post('res_id');
        try {
            $this->db->trans_begin();

            $this->resume_model->set_default_resume($resume_id, $this->user_id);


            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                echo json_encode(array('code'=>1, 'message'=>'Deafult Resume Set Successfully'));
            }
        } catch (Exception $e) {
            echo json_encode(array('code'=>0, 'message'=>'Action Failed', 'error'=>$e->getMessage()));
        }
    }
}
