<?php

class Ldap extends CI_Model
{
	protected $table = 'ldap';

	public function add_data($data)
	{
		$this->db->insert('ldap', $data);
	}

	public function check_data($dn)
	{
		$this->db->where('dn', $dn);
		$req = $this->db->get('ldap');
		if ($req->num_rows() == 0)
		{
			return (true);
		}
	}

	public function ldap_list()
	{
		$tab = array();
		$req = $this->db->get('ldap');
		foreach ($req->result() as $row)
			$tab[] = $row;
		return ($tab);
	}

	public function get_id($uid)
	{
		$this->db->select('id');
		$query = $this->db->get_where('ldap', array('uid' => $uid));
		if ($query->num_rows() > 0)
		{
			$result = $query->row();
			return ($result->id);
		}
		else
			return (FALSE);
	}
}
?>