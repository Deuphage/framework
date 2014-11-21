<?php

class Forum_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function list_topics()
	{
		$query = $this->db->get('forum_topics');
		if ($query->num_rows > 0)
			return ($query->result());
			/*
			** $query->result() returns an array of objects containing each rows of the query
			** for example, access every id with foreach($query->result() as $row) {echo $row->id;}
			*/
		else
			return (FALSE);
	}

	public function add_topic($data)
	{
		if (is_array($data) === TRUE)
		{
			$this->db->insert('forum_topics', $data); // No verifications there, so be careful by checking html form return
			return ($this->db->insert_id());
		}
		else
			return (-1);
	}

	public function edit_topic($data)
	{
		if (is_array($data) === TRUE)
		{
			$this->db->where('id', $data['id']);
			$this->db->update('forum_topics', $data); //Still not checking data here
			return ($data['tid']);
		}
		else
			return (-1);
	}

	public function delete_topic($data)
	{
		if (is_array($data) === TRUE)
		{
			$this->db->where('tid', $data['id']);
			$this->db->delete('forum_messages');
			$this->db->where('id', $data['id']);
			$this->db->delete('forum_topics');
			return (TRUE);
		}
		else
			return (-1);
	}

	public function add_message($data)
	{
		if (is_array($data) === TRUE)
		{
			$this->db->insert('forum_messages', $data); // No verifications there, so be careful by checking html form return
			$this->db->where('id', $data['tid']);
			$update = array('messages' => 'messages + 1');
			$this->db->update('forum_topics', $update);
			return (TRUE);
		}
		else
			return (FALSE);
	}

	public function edit_message($data)
	{
		if (is_array($data) === TRUE)
		{
			$this->db->where('id', $data['mid']);
			$this->db->update('forum_messages', $data); // No verifications there, so be careful by checking html form return
			return (TRUE);
		}
		else
			return (FALSE);
	}

	public function delete_message($data)
	{
		if (is_array($data) === TRUE)
		{
			$this->db->where('id', $data['id']);
			$this->db->delete('forum_messages');
			return (TRUE);
		}
		else
			return (-1);
	}

	public function list_messages($tid)
	{
		$query = $this->db->get_where('forum_messages', array('tid' => $tid));
		if ($query->num_rows() > 0)
			return ($query->result());
		else
			return (FALSE);
	}
}
?>