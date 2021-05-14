<?php
/**
 * Created by PhpStorm.
 * User: mjy
 * Date: 8/21/2018
 * Time: 12:16 PM
 */

class Job_seeker_cover_letter extends Main_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('jobseeker_cover_letter_model');

        if (isset($_SESSION['logged_in']) && $_SESSION['user_type'] == 3)
            return;
        else
            redirect('login');
    }

    function view_cover_letter()
    {
        $data['jobseeker_resume_list'] = $this->master_dml_model->get_all_data('jobseeker_resume', array('jobseeker_user_id' => $_SESSION['user_id']));
        $data['jobseeker_cover_letter_list'] = $this->jobseeker_cover_letter_model->get_cover_letter_all( $_SESSION['user_id']);

        $data['main_content'] = 'job_seeker/job_seeker_cover_letter';

        //load main content page
        $data['page_title'] = 'Cover Letters';
        $this->load->view('templates/template_job_seeker', $data);
    }

    function add_cover_letter()
    {
        $_POST['jobseeker_id'] = $_SESSION['user_id'];
        $rec_data_received = $this->input->post();

        try {
            $this->db->trans_begin();

            if (!empty($rec_data_received['operation']) && $rec_data_received['operation']==1){ //adding record
                unset($rec_data_received['operation']);
                $cl_id = $this->master_dml_model->add_data_return_id('jobseeker_cover_letter', $rec_data_received);
                $_POST['cl_id'] = $cl_id;
            }
            elseif (!empty($rec_data_received['operation']) && $rec_data_received['operation']==2){
                $cl_id = $rec_data_received['cl_id'];
                unset($rec_data_received['operation'], $rec_data_received['cl_id'] );
                $res = $this->master_dml_model->update_data('jobseeker_cover_letter',array('cover_letter_id'=>$cl_id), $rec_data_received);
            }



            if (isset($_FILES['user_cover']['name']) && !empty($_FILES['user_cover']['name'])){
                $upload_status = $this->upload_cover_letter();
                echo '</pre>';
                if (!empty($upload_status)) {
                    $this->jobseeker_cover_letter_model->update_cover_letter($cl_id, array('attachment_url' => $upload_status['file_name']));
                }
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                echo json_encode(false);
            }
            else {
                $this->db->trans_commit();
                echo json_encode(true);
            }
        } catch (Exception $e) {
            $this->db->trans_rollback();
            return $e->getMessage();
        }
    }

    function get_cover_letter(){

        $cl_edit_request = $this->input->post();

        $cover_letter_to_edit = $this->jobseeker_cover_letter_model->get_cover_letter($cl_edit_request['cl_id']);
        $cover_letter_to_edit['dir']= JOB_SEEKER_COVER_LETTER_READ_DIR;

        echo json_encode($cover_letter_to_edit);
    }

    function delete_cover_letter()
    {
        $rec_data_received = $this->input->post();
        try {

            $this->db->trans_begin();


            $this->jobseeker_cover_letter_model->delete_cover_letter($rec_data_received['cl_id']);


            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }

            $this->db->trans_complete();


            echo json_encode($this->db->trans_status());

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
        }

    }

    function upload_cover_letter(){

        $c_l_id = $this->input->post('cl_id');

        $config['upload_path']          = JOB_SEEKER_COVER_LETTER_SAVE_DIR;
        $config['allowed_types']        = 'doc|docx|pdf';
        $config['max_size']             = 5000;
        $config['file_name']            = $_SESSION['user_id'].'_'.$c_l_id.'_'.time();

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('user_cover'))
        {
            return FALSE;
        }
        else
        {
            $upload_status = ($this->upload->data());
//            print_r($upload_status);
            return $upload_status;

        }
    }

    function delete_cover_file_attachment(){
        $cl_id = $this->input->post('cl_id');
        try {
            $cl_info = $this->jobseeker_cover_letter_model->get_cover_letter($cl_id);

            if (!empty($cl_info)){
                $this->db->trans_begin();
                $res = $this->jobseeker_cover_letter_model->delete_cover_file($cl_id);
                if ($this->db->trans_status() === FALSE)
                {
                    $this->db->trans_rollback();
                    echo json_encode(array('code'=>0, 'message' => 'Something went wrong'));
                }
                else
                {
                    $name = JOB_SEEKER_COVER_LETTER_SAVE_DIR.$cl_info['attachment_url'];
                    $del_res = unlink($name);
                    if ($del_res == TRUE) {
                        $res = $this->db->trans_commit();
                        echo json_encode(array('code'=>1, 'message' => 'File deleted successfully', 'status' => $res));
                    }
                }
            }
            else{
                echo json_encode(array("code" => 0, "message" => "Couldn't delete the file, Failed to retrieve data, please try again"));
            }

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
        }
    }
}
