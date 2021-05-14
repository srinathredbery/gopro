<?php


class Su_manage_site_content extends Main_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Su_cms_content_model", "cms_model");
	}

	public function view_job_industry(){

		$data['job_cms_content'] = $this->cms_model->get_cms_data('job_industry', 'id, job_industry_name AS job_cms_name', 'job_industry_name');
		$data['container_title'] = "Manage Job Industries";

		$data['page_title'] = 'Industries List &bull; Super User';
		$data['main_content'] = 'superuser/su_cms_job_industry';

		//load main content page
		$this->load->view('templates/template_superuser', $data);
	}

	public function view_job_category(){

		$data['job_cms_content'] = $this->cms_model->get_cms_data('job_category', 'id, job_category_name AS job_cms_name', 'job_category_name');
		$data['container_title'] = "Manage Job Category";

		$data['page_title'] = 'Job Categories List &bull; Super User';
		$data['main_content'] = 'superuser/su_cms_job_industry';

		//load main content page
		$this->load->view('templates/template_superuser', $data);
	}

	public function view_job_type(){

		$data['job_cms_content'] = $this->cms_model->get_cms_data('job_type', 'id, job_type_name AS job_cms_name', 'job_type_name');
		$data['container_title'] = "Manage Job Type";

		$data['page_title'] = 'Job Type List &bull; Super User';
		$data['main_content'] = 'superuser/su_cms_job_industry';

		//load main content page
		$this->load->view('templates/template_superuser', $data);
	}

	function add_edit_job_cms(){
		$form = $this->input->post();
		try {
			$this->db->trans_begin();

			$table = $form['content_type'];
			if($table == "job_industry")
				$data_set['job_industry_name'] = $form['job_cms_name'];
			elseif($table == "job_category")
				$data_set['job_category_name'] = $form['job_cms_name'];
			elseif($table == "job_type")
				$data_set['job_type_name'] = $form['job_cms_name'];

			if (!empty($form['job_cms_id']))
				$this->cms_model->edit_cms_data($table, array('id'=> $form['job_cms_id']), $data_set);
			else
				$this->cms_model->add_cms_data($table, $data_set);

			if ($this->db->trans_status() === FALSE)
				$this->db->trans_rollback();
			else
				$this->db->trans_commit();

			$this->db->trans_complete();

			echo json_encode($this->db->trans_status());
		}
		catch (Exception $e) {
			echo json_encode($e->getMessage());
		}
	}

	function delete_cms_content(){
		$form = $this->input->post();

		try {
			$this->db->trans_begin();

			$table = $form['content_type'];
			$data_set['is_hidden_deleted'] = "1";

			$this->cms_model->edit_cms_data($table, array('id'=> $form['rec_id']), $data_set);

			if ($this->db->trans_status() === FALSE)
				$this->db->trans_rollback();
			else
				$this->db->trans_commit();

			$this->db->trans_complete();

			echo json_encode($this->db->trans_status());
		}
		catch (Exception $e) {
			echo json_encode($e->getMessage());
		}
	}
}
