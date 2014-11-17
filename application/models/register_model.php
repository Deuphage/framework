<?php

class Register extends CI_Model
{
	protected $table = 'users';

	public function reg_user($data)
	{
		$this->db->insert('users', $data);
	}
}
?>