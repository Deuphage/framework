<?php

class Dashboard_model extends CI_Model
{
	public function list_tickets() #Voir list_topics dans forum_model
	{
		$query = $this->db->get('tickets');
		if ($query->num_rows > 0)
			return ($query->result());
		else
			return (FALSE);
	}
	public function info_ticket($data)
	{
		$this->db->where('id', $data['id']);
		$query = $this->db->get('tickets');
		if ($query->num_rows == 1)
			return ($query->result());
		else
			return (FALSE);
	}
	public function new_ticket($data)
	{
		$this->db->insert('tickets', $data);
	}
	public function new_message($data)
	{
		$this->db->insert('tickets_messages', $data);
	}
	public function messages_list($data)
	{
		$this->db->where('tid', $data['id']);
		$query = $this->db->get('tickets_messages');
		if ($query->num_rows() > 0)
			return ($query->result());
		else
			return (FALSE);
	}
	public function close_ticket($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('tickets', array('open'=>0));
	}
	public function open_ticket($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('tickets', array('open'=>1));
	}
	public function assign_ticket($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('tickets', $data);
	}
}

?>