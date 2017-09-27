<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

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
			//$surgery = anchor ('index.php/client', 'My Surgeries');
	 		$this->load->model('client_model');
	 	}


	public function index()
	{

		$data['clients']=$this->client_model->get_all_clients();
		$this->load->view('client_view',$data);
	}
	public function client_add()
		{
			$data = array(
					'client_code' => $this->input->post('client_code'),
					'client_title' => $this->input->post('client_title'),
					'client_author' => $this->input->post('client_author'),
					'client_category' => $this->input->post('client_category'),
				);
			$insert = $this->client_model->client_add($data);
			echo json_encode(array("status" => TRUE));
		}

		public function ajax_edit($id)
		{
			$data = $this->client_model->get_by_id($id);
			echo json_encode($data);
		}

		public function client_update()
	{
		$data = array(
				'client_code' => $this->input->post('client_code'),
				'client_title' => $this->input->post('client_title'),
				'client_author' => $this->input->post('client_author'),
				'client_category' => $this->input->post('client_category'),
			);
		$this->client_model->client_update(array('client_id' => $this->input->post('client_id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function client_delete($id)
	{
		$this->client_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	

}
