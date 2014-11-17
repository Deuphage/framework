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
				'status'=>$data['status']
								);
				$this->db->update('users', $update);
			}
		else
			echo "You can't even modify this user !";
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