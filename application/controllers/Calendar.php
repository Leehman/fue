<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller
{

    public function __construct() {
        Parent::__construct();
				$this->load->helper('url');
				$this->load->helper('form');
				$this->load->helper('html');
        $this->load->model("calendar_model");
    }

    public function index()
    {  
        $this->load->view("calendar_view");
    }

    public function get_events()
    {
	    $start = $this->input->get("start");
        $end = $this->input->get("end");
        //

        //
        $events = $this->calendar_model->get_all_events($start, $end);
        //var_dump($events);
        //exit(0);
        $event = array();

       if(isset($events)){
          foreach($events as $row) {

              $event[] = array(
              
                  "eventid" => $row->eventid,
                  "title" => $row->title,
                  "end" => $row->end,
                  "start" => $row->start
          
              );
          }

        }else{
          $event[] = array(
              "eventid" => '0',
              "title" => 'EMPTY ',
              "end" => 'EMPTY ',
              "start" => 'EMPTY '
          );

        }

        echo json_encode(array("events" => $event));
        //var_dump($event);
        exit(0);

    }

    public function add_event()
    {
		  $title = $this->input->post("title");
        //$desc = $this->input->post("description");
        $start_date = $this->input->post("start_date");
        $end_date = $this->input->post("end_date");
        //
        $spos = strpos($start_date,"/");
        $epos = strpos($end_date,"/");
        If ($spos===true){
            $start_date = str_replace("/","-",$start_date);
        }
        If ($epos===true){
            $end_date = str_replace("/","-",$end_date);
        }
        //
        if(!empty($start_date)) {
          $sd = strtotime($start_date);
          $start_date = date("Y-m-d", $sd);
        } else {
            $start_date = date("Y-m-d", time());
        }

        if(!empty($end_date)) {
          $ed = strtotime($end_date);
          $end_date = date("Y-m-d", $ed);
        } else {
            $end_date = date("Y-m-d", time());
        }
				//"description" => $desc,
        $this->calendar_model->add_event(array(
            "title" => $title,
            "start" => $start_date,
            "end" => $end_date
            )
        );

        redirect(site_url("index.php/calendar/index"));
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
        $title = $this->input->post("title");
        $start_date = $this->input->post("start_date");
        $end_date = $this->input->post("end_date");
        $delete = intval($this->input->post("delete"));

        if(!$delete) {
            //
            $spos = strpos($start_date,"/");
            $epos = strpos($end_date,"/");
            If ($spos===true){
                $start_date = str_replace("/","-",$start_date);
            }
            If ($epos===true){
                $end_date = str_replace("/","-",$end_date);
            }
            //
            if(!empty($start_date)) {
              $sd = strtotime($start_date);
              $start_date = date("Y-m-d", $sd);
            } else {
              $start_date = date("Y-m-d", time());
            }

            if(!empty($end_date)) {
              $ed = strtotime($end_date);
              $end_date = date("Y-m-d", $ed);
            } else {
              $end_date = date("Y-m-d", time());
            }
						
            $this->calendar_model->update_event($eventid, array(
                "title" => $title,
                "start" => $start_date,
                "end" => $end_date,
                )
            );

        } else {
            $this->calendar_model->delete_event($eventid);
        }

        //redirect(site_url("calendar"));
        redirect(site_url("index.php/calendar/index"));
    }

}

?>
