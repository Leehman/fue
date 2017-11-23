<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar_Model extends CI_Model
{

	var $table = 'calendar_events';


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    public function get_all_events($start, $end)
    {   //$query = $this->db->select('*')->from('calendar_events')->where("start >=", $start)->where('end <=', $end)->order_by("start", "asc")->get();
        //return $query->result();
        
        $query = $this->db
                ->select('*')
                ->from('calendar_events')
                ->where("start >=", $start)
                ->where('end <=', $end)
                ->order_by("start", "asc")->get();
        return $query->result();
        
    }

    public function add_event($data)
    {
        $this->db->insert("calendar_events", $data);
    }

    public function get_event($id)
    {
        return $this->db->where("eventID", $id)->get("calendar_events");
    }

    public function update_event($where, $data)
    {
        //var_dump($data);
        //exit(0);
        $this->db->where("eventid", $where );
        $this->db->update("calendar_events", $data);
		return $this->db->affected_rows();
        
    }

    public function delete_event($id)
    {
        $this->db->where("eventID", $id)->delete("calendar_events");
    }



}
