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
    {
			$sql = "SELECT * FROM calendar_events WHERE start >= ? AND end <= ? ORDER BY start ASC";
			return $this->db->query($sql, array($start, $end))->result();
			
    }

    public function add_event($data)
    {
        $this->db->insert("calendar_events", $data);
    }

    public function get_event($id)
    {
        return $this->db->where("ID", $id)->get("calendar_events");
    }

    public function update_event($id, $data)
    {
        $this->db->where("ID", $id)->update("calendar_events", $data);
    }

    public function delete_event($id)
    {
        $this->db->where("ID", $id)->delete("calendar_events");
    }



}
