<?php

class Logs extends CI_Model
{
	protected $table = 'logs';


	public function add_log($data)
	{
		$this->db->insert('logs', $data);
	}

	public function count_log()
	{
		return $this->db->count_all('logs');
	}

	public function read_log($limit, $start)
	{
		$this->db->limit($limit, $start);
		$query = $this->db->get('logs');
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$data[] = $row;
			}
			return $data;
		}
		return (false);
	}
}
?>