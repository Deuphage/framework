<?php

class Module_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function list_modules($id)	// $id is a user id, to retrieve this user's modules
	{									// If $id is FALSE, then all modules are required
		$return = array('subscribed' => FALSE, 'unsubscribed' => FALSE);
		if ($id != FALSE)
		{
			$this->db->join('module_subscriptions', 'module_subscriptions.mid=module.id');
			$this->db->where(array('module_subscriptions.uid'=>$id));
			$this->db->order_by('module.reg_start', 'asc');
			$query = $this->db->get('module');
			if ($query->num_rows() > 0)
				$return['subscribed'] = $query->result();
			$this->db->select('module.*');
			$this->db->join(
				'module_subscriptions',
				'module_subscriptions.mid=module.id AND module_subscriptions.uid=' .$id,
				'left outer');
			$this->db->where('module_subscriptions.uid IS NULL');
		}
		$this->db->order_by('module.reg_start', 'asc');
		$query = $this->db->get('module');
		if ($query->num_rows > 0)
			$return['unsubscribed'] = $query->result();
		return ($return);
	}

	public function add_module($data)
	{
		$this->db->insert('module', $data);
		return ($this->db->insert_id());
	}

	public function edit_module($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('module', $data);
		redirect('module');
		//maybe return something? See later if that'd be usefull
	}

	public function delete_module($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('module');
	}
	public function delete_module_subscription($mid)
	{
		$this->db->where('mid', $mid);
		$this->db->delete('module_subscriptions');
	}

	public function subscribe_to_module($uid, $mid)
	{
		$this->db->insert('module_subscriptions', array('uid'=>$uid, 'mid'=>$mid));
	}

	public function unsubscribe_from_module($uid, $mid)
	{
		$this->db->where(array('uid'=>$uid, 'mid'=>$mid));
		$this->db->delete('module_subscriptions');
	}

	public function list_all_activities()
	{
		$req = $this->db->get('activity');
		$activities = $req->result();
		return ($activities);
	}

	public function list_activities($mid, $uid)	// $id is a user id, to retrieve this user's activities
	{									// If $id is FALSE, then all activities are required
		$mid = intval($mid);
		$uid = intval($uid);
		$return = array('subscribed' => FALSE, 'unsubscribed' => FALSE);
		if ($uid != FALSE)
		{
			$this->db->join('activity_subscriptions', 'activity_subscriptions.aid=activity.id');
			$this->db->where(array('activity_subscriptions.uid'=>$uid, 'activity.mid'=>$mid));
			$query = $this->db->get('activity');
			if ($query->num_rows() > 0)
				$return['subscribed'] = $query->result();
			$this->db->select('activity.*');
			$this->db->join(
				'activity_subscriptions',
				'activity_subscriptions.aid=activity.id AND activity_subscriptions.uid=' .$uid,
				'left outer');
			$this->db->where('activity_subscriptions.uid IS NULL');
		}
		$this->db->where(array('activity.mid'=>$mid));
		$query = $this->db->get('activity');
		if ($query->num_rows > 0)
			$return['unsubscribed'] = $query->result();
		return ($return);
	}

	public function add_activity($data)
	{
		$this->db->insert('activity', $data);
		return ($this->db->insert_id());
	}

	public function edit_activity($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('activity', $data);
		//maybe return something? See later if that'd be usefull
	}

	public function delete_activity($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('activity');
	}

	public function delete_module_activity($mid)
	{
		$this->db->where('id', $mid);
		$this->db->delete('activity');
	}

	public function delete_activity_subscription($aid)
	{
		$this->db->where('aid', $aid);
		$this->db->delete('activity_subscriptions');
	}

	public function subscribe_to_activity($uid, $aid)
	{
		$this->db->insert('activity_subscriptions', array('uid'=>$uid, 'aid'=>$aid));
	}

	public function unsubscribe_from_activity($uid, $aid)
	{
		$this->db->where(array('uid'=>$uid, 'aid'=>$aid));
		$this->db->delete('activity_subscriptions');
	}
}

?>
