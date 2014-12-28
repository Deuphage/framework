<?php

class elearning_model extends CI_Model
{
	public function add_e_learning($data)
	{
		$this->db->insert('e_learning', $data);
	}

	public function delete_file($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->delete('e_learning');
	}
	public function list_e_learning()
	{
		$req = $this->db->get('e_learning');
		$e_learning = $req->result();
		return ($e_learning);
	}
}

?>