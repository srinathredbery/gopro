<?php


class Employer_profile extends Main_Controller
{
	private $company_id;
	private $user_id;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('employer_profile_model');

        $this->company_id = $this->session->company_id;
        $this->user_id = $this->session->user_id;

    }

    public function view_employer_profile()
    {

        $data['emp_profile'] = $this->employer_profile_model->get_employer($this->company_id);
        $data['emp_tags'] = $this->employer_profile_model->get_employer_tags($this->company_id);
        $data['job_industry'] = $this->master_dml_model->get_all_data('job_industry');
        $data['country_list'] = $this->master_dml_model->get_all_data('country_master');

        $data['page_title'] = 'Profile &bull; Employer';
        $data['main_content'] = 'employer/employer_profile';
        //load main content page
        $this->load->view('templates/template_employer', $data);
    }

    function save_employer_profile(){

        try{
            $form_data = $this->input->post();
            $emp_tags = isset($_POST['tags']) ? $_POST['tags'] : '';

            unset($form_data['tags']);
            $this->db->trans_begin();

            $res = $this->employer_profile_model->update_employer_profile($this->company_id, $form_data);
            $this->employer_profile_model->remove_tags($this->company_id);

			// tag represents employer industry. tags are populated from job_industry table

            if (!empty($emp_tags)) {
                foreach ($emp_tags as $tag) {
                    $emp_tag['employer_id'] = $this->company_id;
                    $emp_tag['employer_tag'] = $tag;

                    $this->employer_profile_model->add_employer_tags($emp_tag);

                }
            }

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
            }
            else
            {
                $this->db->trans_commit();
            }

            $this->db->trans_complete();

            echo json_encode($res);
            return $res;
        }
        catch (Exception $e){

        }

    }

    function upload_company_logo(){

        try{
            $data = $_POST["image"];

            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);

            $data = base64_decode($image_array_2[1]);

            $imageName = $this->company_id.'_EMP_'.time() . '.png';

            $file_dir = EMP_LOGO_SAVE_DIR.$imageName;

            $this->db->trans_begin();

            $res = $this->employer_profile_model->update_employer_logo(array('employer_id' => $this->company_id), array('employer_logo_url'=> $imageName));

            $r = $this->db->trans_commit();

            if($r){
                $this->session->set_userdata('employer_logo_url', $imageName);
            }

            file_put_contents($file_dir, $data);

            echo base_url().'uploads/employer_logo/'.$imageName;

            return $r;

        }catch (Exception $e ){
            $this->db->trans_rollback();
            return $e->getMessage();
        }

    }
    function upload_company_cover_photo(){
        try{
            $data = $_POST["image"];

            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);

            $data = base64_decode($image_array_2[1]);

            $imageName = $this->company_id.'_EMP_'.time() . '.png';

            $file_dir = EMP_COVER_PIC_SAVE_DIR.$imageName;

            $this->db->trans_begin();

            $res = $this->employer_profile_model->update_employer_cover_photo(array('employer_id' => $this->company_id), array('employer_cover_pic_url'=> $imageName));

			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
			}
			else
			{
				$res = $this->db->trans_commit();
			}

			$this->db->trans_complete();

            file_put_contents($file_dir, $data);
            echo base_url().'uploads/employer_cover_pic/'.$imageName;
            return $res;

        }catch (Exception $e ){
            $this->db->trans_rollback();
            return $e->getMessage();
        }
    }

	function delete_image(){
		$type = $this->input->post('image_type');
		$image_type = '';
		$file_path = '';
		try {
			$emp_info = $this->employer_profile_model->get_employer($this->company_id);

			if (!empty($emp_info)){
				$this->db->trans_begin();

				if ($type === 'logo' && !empty($emp_info['employer_logo_url'])){
					$this->employer_profile_model->delete_image(array('employer_id'=>$this->company_id), array('employer_logo_url'=>NULL));
					$image_type = "Logo";
					$file_path = EMP_LOGO_SAVE_DIR.$emp_info['employer_logo_url'];
				}
				elseif ($type === 'cover' && !empty($emp_info['employer_cover_pic_url'])){
					$this->employer_profile_model->delete_image(array('employer_id'=>$this->company_id), array('employer_cover_pic_url'=>NULL));
					$image_type = "Cover pic";
					$file_path = EMP_COVER_PIC_SAVE_DIR.$emp_info['employer_cover_pic_url'];
				}

				if ($this->db->trans_status() === FALSE)
				{
					$this->db->trans_rollback();
					echo json_encode(array('code'=>0, 'message' => 'Something went wrong'));
				}
				else
				{
					if (!empty($file_path))
						$del_res = unlink($file_path);
					else{
						echo json_encode(array('code'=>0, 'message' => "Please upload a image first")); exit();
					}
					if ($del_res == TRUE) {
						$res = $this->db->trans_commit();
						echo json_encode(array('code'=>1, 'message' => $image_type. ' removed successfully', 'status' => $res));
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
