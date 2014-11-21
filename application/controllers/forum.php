<?php

class Forum extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('online') && $this->session->userdata('login'))
		{
			$this->lang->load('menu', $this->session->userdata('language'));
			$this->lang->load('title', $this->session->userdata('language'));
			$data = array(
				'title_welcome' => $this->lang->line('title_welcome'),
				'menu_home'=> $this->lang->line('menu_home'),
				'menu_profile'=> $this->lang->line('menu_profile'),
				'menu_newsletter' => $this->lang->line('menu_newsletter'),
				'menu_admin' => $this->lang->line('menu_admin'), // Ne pas afficher si non-administrateur!
				'menu_forum' => $this->lang->line('menu_forum'),
				"menu_annuaire" => $this->lang->line('menu_annuaire'),
				'menu_logout' => $this->lang->line('menu_logout')
						);
			#if ($this->session->userdata('bind') === false)
			#{
				#$ds = $this->ldap_bind("uid=kescalie,ou=2013,ou=people,dc=42,dc=fr", "666"); #On laisse pas son mdp ici
				#$this->ldap_db($ds);
				#$this->session->set_userdata('bind', 1);
			#}
			$this->load->view('perso', $data);
		}
		else
		{
			$this->lang->load('menu', $this->session->userdata('language'));
			$data['menu_home'] = $this->lang->line('menu_home');
			$data['menu_login'] = $this->lang->line('menu_login');
			$data['menu_newsletter'] = $this->lang->line('menu_newsletter');
			$data['menu_register'] = $this->lang->line('menu_register');
			$data['menu_forum'] = $this->lang->line('menu_forum');
			$this->load->view('acceuil', $data);
		}
		$this->load->model('forum_model');
		$this->load->model('users');
	}

	public function index()
	{
		$this->topics();	#Sur la premiere page du forum, on affiche toujours les topics
							#visibles par un utilisateur.
	}

	public function topics() #Afficher la liste des topics visibles par un utilisateur
	{
		$data['status'] = $this->users->check_permission($this->session->userdata('login'));
		$topics = array ('topic_list'=>$this->forum_model->list_topics($data));
		$this->load->view('topics', $topics);

	}

	public function create_topic() # On traite les informations du formulaire de la view creation de topic. Stockage des informations dans la BDD
	{
		$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean|min_length[5]');
		$this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
		if ($this->form_validation->run())
		{
			$data = array(
				'title'=>$this->input->post('title'),
				'description'=>$this->input->post('description'),
				'login'=>$this->session->userdata('login'),
				'email'=>$this->users->get_email_users($this->session->userdata('login'))
				);
			$tid = $this->forum_model->add_topic($data);
			if ($tid != -1)
				redirect("forum/view_topic?tid=" . $tid); // Redirect instead to the topic creation page.
			else
				redirect("forum/index"); // With an error message, how do you do that?
		}	
		redirect("forum/index"); // With an error message, how do you do that?	
	}

	public function edit_topic()
	{
		$get = $this->input->get(NULL, TRUE);
		$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean|min_length[5]');
		$this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
		if ($this->form_validation->run())
		{
			$data = array(
				'title'=>$this->input->post('title'),
				'description'=>$this->input->post('description'),
				'id'=>$get['tid']
				);
			$tid = $this->forum_model->edit_topic($data);
		
			redirect("forum/index");
		}
		else
			$this->load->view('topics_edit');
	}

	public function delete_topic()
	{
		$this->form_validation->set_rules('id', 'Topic ID', 'required');
		if ($this->form_validation->run())
		{
			$data['id'] = $this->input->post('id');
			$this->forum_model->delete_topic($data);
			redirect("forum/index");
		}
	}

	public function create_message() #idem que create topic
	{
		$this->form_validation->set_rules('title', 'Title', 'trim|xss_clean');
		$this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');
		if ($this->form_validation->run())
		{
			$data = array(
				'title'=>$this->input->post('title'),
				'message'=>$this->input->post('message'),
				'login'=>$this->session->userdata('login'),
				'email'=>$this->users->get_email_users($this->session->userdata('login')), #on recupere l'email de l'utilisateur s'il est dans la table 'users'
				'tid'=> $this->input->post('tid')
				);
			$this->forum_model->add_message($data);
			redirect("forum/view_topic?tid=" . $data['tid']); #on redirige vers la page du topic du message
		}
	}

	public function edit_message()
	{
		$get = $this->input->get(NULL, TRUE);
		$this->form_validation->set_rules('title', 'Title', 'trim|xss_clean');
		$this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');
		if ($this->form_validation->run())
		{
			$data = array(
				'id'=>$get['mid'],
				'title'=>$this->input->post('title'),
				'message'=>$this->input->post('message'),
				'tid'=> $get['tid']
				);
			if ($this->forum_model->edit_message($data))
				print_r($data);
			redirect("forum/view_topic?tid=" . $data['tid']); #on redirige vers la page du topic du message edite
		}
		else
			$this->load->view('message_edit');
	}

	public function delete_message()
	{
		$this->form_validation->set_rules('id', 'Message ID', 'required');
		$this->form_validation->set_rules('tid', 'Topic ID', 'required');
		if ($this->form_validation->run())
		{
			$data['id'] = $this->input->post('id');
			$data['tid'] = $this->input->post('tid');
			$this->forum_model->delete_message($data);
			redirect("forum/view_topic?tid=" . $data['tid']);
		}
	}

	public function view_topic() #on affiche la page d'un topic d'un certain tid
	{
		$get = $this->input->get(NULL, TRUE);
		$data = array(
			/*'tid'=>$this->input->get('tid', TRUE),*/
			'list_messages'=>$this->forum_model->list_messages($get['tid']),
			'tid' => $get['tid']
			);
		$this->load->view('messages', $data);
	}
}

?>
