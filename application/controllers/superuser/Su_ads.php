<?php


class Su_ads extends Main_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('su_ads_model','ads_model');
    }

    function manage_ads(){
        $data['all_ads'] = $this->ads_model->get_all_ads_data();

        $data['page_title'] = 'Advertisements &bull; Super User';
        $data['main_content'] = 'superuser/su_ads_manage';

        //load main content page
        $this->load->view('templates/template_superuser', $data);
    }

    function view_new_ad_form(){
		$data['country_list'] = $this->master_dml_model->get_all_data('country_master');
        $data['banner_type'] = $this->master_dml_model->get_all_data('adv_banner_type');
        $data['banner_size'] = $this->master_dml_model->get_all_data('adv_banner_spot');

        $data['page_title'] = 'New / Advertisements &bull; Super User';
        $data['main_content'] = 'superuser/su_ads_new';

        //load main content page
        $this->load->view('templates/template_superuser', $data);
    }

    function create_new_add(){

        $data = $_POST["adv_image"];

        $form_data = $this->input->post();

        try{
        	if (!empty($data))
				$image_array_1 = explode(";", $data);
			if (!empty($image_array_1[1]))
        		$image_array_2 = explode(",", $image_array_1[1]);
			if (!empty($image_array_2[1]))
				$data = base64_decode($image_array_2[1]);
			else
				throw new ErrorException('Image not found');

			$image_name = 'ad_'.time() . '.png';
			$file_dir = ADV_IMG_SAVE_DIR.$image_name;
			file_put_contents($file_dir, $data);

			$form_data['adv_image_url']=$image_name;
			$form_data['created_by']=$_SESSION['user_id'];

			unset($form_data['adv_image'], $form_data['adv_company']);
            $this->db->trans_begin();

            $res = $this->ads_model->create_new_ad($form_data);

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                echo json_encode(array('code'=>0, 'message'=>'Something went wrong'));
            }
            else
            {
                $this->db->trans_commit();
                echo json_encode(array('code'=>1, 'message'=>'Your Ad Has been posted successfully'));
            }
        }
        catch (Exception $e){
            echo json_encode(array('code'=>0, 'message'=>$e->getMessage()));
        }
    }
    function edit_ad(){

        $data = $_POST["adv_image"];

        $form_data = $this->input->post();

        $image_array_1 = explode(";", $data);
        $image_array_2 = explode(",", $image_array_1[1]);
        $data = base64_decode($image_array_2[1]);
        $image_name = 'ad_'.time() . '.png';
        $file_dir = ADV_IMG_SAVE_DIR.$image_name;
        file_put_contents($file_dir, $data);

        $form_data['adv_image_url']=$image_name;
//        $form_data['created_by']=$_SESSION['user_id'];
		$id = $form_data['id'];
        unset($form_data['id'], $form_data['adv_image'], $form_data['adv_company']);
        $current_image = $this->ads_model->get_ad_info($id);

        try{
            $this->db->trans_begin();

            $res = $this->ads_model->edit_ad($id, $form_data);

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                echo json_encode(array('code'=>0, 'message'=>'Something went wrong'));
            }
            else
            {
				$this->delete_add_image($current_image['adv_image_url']);
                $this->db->trans_commit();
                echo json_encode(array('code'=>1, 'message'=>'Your Ad Has been modified successfully'));
            }
        }
        catch (Exception $e){
            echo json_encode(array('code'=>0, 'message'=>'Something went wrong. Please try again or contact support.'));
        }
    }

    function delete_an_ad(){
        $post_data = $this->input->post();
        try{
            $res = $this->ads_model->delete_ad($post_data['id']);
            echo json_encode($res);
        }
        catch (Exception $e){
            echo json_encode($e->getMessage());
        }
    }

    function post_status_switcher(){
        $post_data = $this->input->post();

        try{
            $res = $this->ads_model->ads_status_switch($post_data['id'],$post_data['is_active']);
            echo json_encode($res);
        }
        catch (Exception $e){
            echo json_encode($e->getMessage());
        }
    }

    function get_ad_preview(){

        $ad_id = $this->input->get();
        $ad_id = $ad_id['id'];

        $ad = $this->ads_model->get_ad_info($ad_id);

        $img_url = ADV_IMG_READ_DIR.$ad['adv_image_url'];

        $ad['adv_image_url'] = $img_url;

        echo json_encode($ad);
    }

	function get_company_list(){

		$phrase = $this->input->get('phrase');
		$data = $this->ads_model->get_company_list($phrase);
		$list = array();

		if(!empty($data)){
			foreach ($data as $value){
				array_push( $list, $value['id'], $value['company_name']);
			}
		}

		echo json_encode(array("company_list"=>$data, "inputPhrase"=>$phrase));
	}

	function add_new_company(){
    	$new_com = $this->input->post();

		$res = $this->ads_model->add_company($new_com);

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			echo json_encode(array('code'=>0, 'message'=>'Something went wrong. Please try again or contact support.'));
		}
		else
		{
			$this->db->trans_commit();
			echo json_encode(array('code'=>1, 'message'=>'Record has been added. Please search the company.'));
		}
	}

	/*Editing Posts*/
	function edit_job_post_view(){
		$data['country_list'] = $this->master_dml_model->get_all_data('country_master');
		$data['banner_type'] = $this->master_dml_model->get_all_data('adv_banner_type');
		$data['banner_size'] = $this->master_dml_model->get_all_data('adv_banner_spot');
		
		$ad_id	= $this->input->get('adv_id');

		$data['page_title'] = 'Advertisements &bull; Super User';

		if (!empty($ad_id)) {
			$data['adv'] = $this->ads_model->get_ad_info($ad_id);
			$data['page_title'] = 'Edit Ad / Advertisements &bull; Super User';
		}
		$data['main_content'] = 'superuser/su_ads_new';

		//load main content page
		$this->load->view('templates/template_superuser', $data);
	}

	function delete_add_image($id){
		$ad_image = $id;
		$name = ADV_IMG_SAVE_DIR . $ad_image;
		$del_res = unlink($name);
		if ($del_res == TRUE)
			return TRUE;
		else
			return false;
	}
}
