<?php

class Admin extends CI_Model
{
	protected $table = 'users';

	public function update_info($data)
	{
		$this->db->where('login', $data['login']);
		if ($data['status_target'] < $data['status_admin'])
			{
				$update = array(
						'login'=>$data['login'],
						'status'=>$data['status'],
					);
				if ($data['pass'])
					$update['pass'] = $data['pass'];
				if ($data['first_name'])
					$update['first_name'] = $data['first_name'];
				if ($data['email'])
					$update['email'] = $data['email'];
				if ($data['gender'])
					$update['gender'] = $data['gender'];
				$this->db->update('users', $update);
			}
		else
			echo "You can't even modify this user !";
	}

	public function create_user($data)
	{
		$creation = array(
				'status'=>$data['status'],
				'first_name'=>$data['first_name'],
				'email'=>$data['email'],
				'gender'=>$data['gender'],
				'pass'=>$data['pass']
			);
		if (!($creation['pass']))
			{
				echo "This user need a password !";
				return (false) ;
			}
		if ($data['login2'])
			$creation['login'] = $data['login2'];
		else
			$creation['login'] = $data['login'];
		$this->db->insert('users', $creation);
		return (true);
	}

	public function delete_user($data)
	{
		$this->db->where('login', $data['login']);
		if ($data['status_target'] < $data['status_admin'])
			$this->db->delete('users');
		else
			echo "Not the power to destroy this user !";
	}
}
?>