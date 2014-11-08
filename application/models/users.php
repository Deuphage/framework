<?php

class Users extends CI_Model
{
	public function aut_login($login, $pass)
	{
		$this->db->where('login', $login);
		$this->db->where('pass', sha1($pass));
		$req = $this->db->get('users');
		if ($req->num_rows() > 0)
		{
			return (true);
		}
	}
	public function check_login($login)
	{
		$this->db->where('login', $login);
		$req = $this->db->get('users');
		if ($req->num_rows() == 0)
		{
			return (true);
		}
		else
			echo 'Login already used';
	}
	public function check_permission($login)
	{
		$this->db->where('login', $login);
		$req = $this->db->get('users');
		if ($req->num_rows() > 0)
		{
			foreach ($req->result() as $row)
			{
				if ($login === $row->login)
					return ($row->status);
			}
		}
		else
			echo 'Error in universe uniqueness !';
	}
	public function user_list()
	{
		$tab = array();
		$req = $this->db->get('users');
		foreach ($req->result() as $row)
			$tab[] = $row->login;
		natsort($tab);
		return ($tab);
	}
	public function user_info($login)
	{
		$this->db->where('login', $login);
		$req = $this->db->get('users');
		if ($req->num_rows() == 1)
		{
			foreach ($req->result() as $row)
				$tab[] = $row;
		}
		else
			$tab = null;
		return ($tab[0]);
	}
	public function get_email_users($login)
	{
		$this->db->where('login', $login);
		$req = $this->db->get('users');
		if ($req->num_rows() > 0)
		{
			foreach ($req->result() as $row)
  			{
      			if ($login === $row->login)
      				return ($row->email);
   			}
		}
	}
	public function language_preference($data)
	{
		$this->db->where('login', $data['login']);
		$update = array(
				'login'=>$data['login'],
				'language'=>$data['language']
						);
		$this->db->update('users', $update);
	}
}

?>