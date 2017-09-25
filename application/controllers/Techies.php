<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Techies extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	 public function __construct()
	 	{
	 		parent::__construct();
			$this->load->helper('url');
			//$surgery = anchor ('index.php/techies', 'My Surgeries');
	 		$this->load->model('techies_model');
	 	}


	public function index()
	{

		//$data['techiess']=$this->techies_model->get_all_techiess();
		$this->load->view('techies_view');
	}
	public function techies_add()
		{
			$data = array(
					'techies_code' => $this->input->post('techies_code'),
					'techies_title' => $this->input->post('techies_title'),
					'techies_author' => $this->input->post('techies_author'),
					'techies_category' => $this->input->post('techies_category'),
				);
			$insert = $this->techies_model->techies_add($data);
			echo json_encode(array("status" => TRUE));
		}

		public function ajax_edit($id)
		{
			$data = $this->techies_model->get_by_id($id);
			echo json_encode($data);
		}

		public function techies_update()
	{
		$data = array(
				'techies_code' => $this->input->post('techies_code'),
				'techies_title' => $this->input->post('techies_title'),
				'techies_author' => $this->input->post('techies_author'),
				'techies_category' => $this->input->post('techies_category'),
			);
		$this->techies_model->techies_update(array('techies_id' => $this->input->post('techies_id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function techies_delete($id)
	{
		$this->techies_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


}
