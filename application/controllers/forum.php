<?php

class Intra extends CI_Controller
{
	public function __construct()
	{

	}

	public function index()
	{
		$this->topics();	
	}

	public function topics() 
	{
		$this->load->model('forum');
		$data['status'] = $this->users->check_permission($this->session->userdata('login'));
		$data2 = array (
			'topic_list'=>$this->list_topics($data)
			);
		$this->load->view('topics', $topic);
	}

	public function create_topic()
	{
		$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean|min_length[5]');
		$this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
		if ($this->form_validation->run())
		{
			$this->load->model('forum');
			$data = array(
				'title'=>$this->input->post('title'),
				'description'=>$this->input->post('description'),
				'login'=>$this->session->userdata('login'),
				'email'=>$this->users->get_email_users($this->session->userdata('login'))
				);
			$this->forum->add_topic($data);

			$this->topics();
		}
	}
	public function create_message()
	{
		$this->form_validation->set_rules('title', 'Title', 'trim|xss_clean');
		$this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');
		if ($this->form_validation->run())
		{
			$this->load->model('forum');
			$data = array(
				'title'=>$this->input->post('title'),
				'message'=>$this->input->post('message'),
				'login'=>$this->session->userdata('login'),
				'email'=>$this->users->get_email_users($this->session->userdata('login')),
				'tid'=> #definir ou on obtient le topic ID
				);
			$this->forum->add_topic($data);

			redirect("forum/view_topic" . $tid);
		}
	}
	public function view_topic()
	{
		$data = array(
			'tid'=>$this->input->post('tid', TRUE),
			'list_messages'=>$this->list_message($tid)
			);
		
		$this->load->view('messages', $data);
	}
}

?>