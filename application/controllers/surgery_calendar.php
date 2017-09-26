<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surgery_calendar extends CI_Controller {

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
			$this->load->helper('form');
			//$surgery = anchor ('index.php/techies', 'My Surgeries');
	 		//$this->load->model('techies_model');
	 	}



		public function add_event()
		{
		    /* Our calendar data */
		    $name = $this->input->post("name", TRUE);
		    $desc = $this->input->post("description", TRUE);
		    $start_date = $this->input->post("start_date", TRUE);
		    $end_date = $this->input->post("end_date", TRUE);

		    if(!empty($start_date)) {
		       $sd = DateTime::createFromFormat("Y/m/d H:i", $start_date);
		       $start_date = $sd->format('Y-m-d H:i:s');
		       $start_date_timestamp = $sd->getTimestamp();
		    } else {
		       $start_date = date("Y-m-d H:i:s", time());
		       $start_date_timestamp = time();
		    }

		    if(!empty($end_date)) {
		       $ed = DateTime::createFromFormat("Y/m/d H:i", $end_date);
		       $end_date = $ed->format('Y-m-d H:i:s');
		       $end_date_timestamp = $ed->getTimestamp();
		    } else {
		       $end_date = date("Y-m-d H:i:s", time());
		       $end_date_timestamp = time();
		    }

		    $this->calendar_model->add_event(array(
		       "title" => $name,
		       "description" => $desc,
		       "start" => $start_date,
		       "end" => $end_date
		       )
		    );

		    redirect(site_url("calendar"));
		}


		public function edit_event()
		     {
		          $eventid = intval($this->input->post("eventid"));
		          $event = $this->calendar_model->get_event($eventid);
		          if($event->num_rows() == 0) {
		               echo"Invalid Event";
		               exit();
		          }

		          $event->row();

		          /* Our calendar data */
		          $name = $this->common->nohtml($this->input->post("name"));
		          $desc = $this->common->nohtml($this->input->post("description"));
		          $start_date = $this->common->nohtml($this->input->post("start_date"));
		          $end_date = $this->common->nohtml($this->input->post("end_date"));
		          $delete = intval($this->input->post("delete"));

		          if(!$delete) {

		               if(!empty($start_date)) {
		                    $sd = DateTime::createFromFormat("Y/m/d H:i", $start_date);
		                    $start_date = $sd->format('Y-m-d H:i:s');
		                    $start_date_timestamp = $sd->getTimestamp();
		               } else {
		                    $start_date = date("Y-m-d H:i:s", time());
		                    $start_date_timestamp = time();
		               }

		               if(!empty($end_date)) {
		                    $ed = DateTime::createFromFormat("Y/m/d H:i", $end_date);
		                    $end_date = $ed->format('Y-m-d H:i:s');
		                    $end_date_timestamp = $ed->getTimestamp();
		               } else {
		                    $end_date = date("Y-m-d H:i:s", time());
		                    $end_date_timestamp = time();
		               }

		               $this->calendar_model->update_event($eventid, array(
		                    "title" => $name,
		                    "description" => $desc,
		                    "start" => $start_date,
		                    "end" => $end_date,
		                    )
		               );

		          } else {
		               $this->calendar_model->delete_event($eventid);
		          }

		          redirect(site_url("calendar"));
		     }
}
