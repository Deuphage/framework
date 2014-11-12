<?php

class Forum extends CI_Controller
{
	public function __construct()
	{

	}

	public function index()
	{
		$this->topics();	#Sur la premiere page du forum, on affiche toujours les topics
							#visibles par un utilisateur.
	}

	public function topics() #Afficher la liste des topics visibles par un utilisateur
	{
		$this->load->model('forum');
		$data['status'] = $this->users->check_permission($this->session->userdata('login'));
		$data2 = array (
			'topic_list'=>$this->list_topics($data)
			);
		$this->load->view('topics', $topic);
	}

	public function create_topic() # On traite les informations du formulaire de la view creation de topic. Stockage des informations dans la BDD
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
	public function create_message() #idem que create topic
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
				'email'=>$this->users->get_email_users($this->session->userdata('login')), #on recupere l'email de l'utilisateur s'il est dans la table 'users'
				'tid'=> #definir où on obtient le topic ID
				);
			$this->forum->add_topic($data);

			redirect("forum/view_topic" . $tid); #on redirige vers la page du topic du message
		}
	}
	public function view_topic() #on affiche la page d'un topic d'un certain tid
	{
		$data = array(
			'tid'=>$this->input->post('tid', TRUE),
			'list_messages'=>$this->list_message($tid)
			);
		
		$this->load->view('messages', $data);
	}
}

?>