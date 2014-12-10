<?php

class Dashboard extends CI_Controller
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
	}

	public function new_ticket()
	{
		$this->load->model('dashboard_model');
		$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean|min_length[5]');
		$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean|min_length[10]');
		if ($this->form_validation->run())
		{
			$data= array(
				'title'=>$this->input->post('title'),
				'description'=>$this->input->post('description'),
				'priority'=>$this->input->post('priority'),
				'login'=>$this->session->userdata('login')
				);
			$this->dashboard_model->new_ticket($data);
			redirect("intra/profile");
		}
		$this->load->view('new_ticket');
	}
	public function view_ticket()
	{
		$this->form_validation->set_rules('id', 'Ticket ID', 'trim|required|xss_clean');
		if ($this->form_validation->run())
		{
			$this->load->model('dashboard_model');
			$data['id'] = $this->input->post('id');
			$data['info_ticket'] = $this->dashboard_model->info_ticket($data);
			$data['messages_list'] = $this->dashboard_model->messages_list($data);
			$data['status'] = $this->session->userdata('status');
			//var_dump($data);
			$this->load->view('view_ticket', $data);
		}
	}
	public function new_message()
	{
		$this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean|min_length[4]');
		$this->form_validation->set_rules('tid', 'Ticket ID', 'trim|required|xss_clean');
		$this->form_validation->set_rules('new_message', 'New message submit', 'trim|required|xss_clean');
		if ($this->form_validation->run())
		{
			$this->load->model('dashboard_model');
			$data = array(
				'tid'=>$this->input->post('tid'),
				'login'=>$this->session->userdata('login'),
				'message'=>$this->input->post('message')
				);
			$this->dashboard_model->new_message($data);
			$data2['id'] = $this->input->post('tid');
			$data2['info_ticket'] = $this->dashboard_model->info_ticket($data2);
			$data2['messages_list'] = $this->dashboard_model->messages_list($data2);
			$this->load->view('view_ticket', $data2);
		}
		else
		{
			$this->load->view('main');
		}
	}
	public function close_ticket()
	{
		$this->form_validation->set_rules('tid', 'Ticket ID', 'trim|required|xss_clean');
		if ($this->form_validation->run())
		{
			$this->load->model('dashboard_model');
			$this->load->model('users');
			$this->lang->load('form', $this->session->userdata('language')); // fichiers de languages
			$this->lang->load('title', $this->session->userdata('language'));

			$data['id'] = $this->input->post('tid');
			$this->dashboard_model->close_ticket($data); //On close le ticket ici.

			redirect('intra/admin');
		}
	}
	public function open_ticket()
	{
		$this->form_validation->set_rules('id', 'Ticket ID', 'trim|required|xss_clean');
		if ($this->form_validation->run())
		{
			$this->load->model('dashboard_model');
			$this->load->model('users');
			$this->lang->load('form', $this->session->userdata('language')); // fichiers de languages
			$this->lang->load('title', $this->session->userdata('language'));

			$data['id'] = $this->input->post('id');
			$this->dashboard_model->open_ticket($data);

			if ($this->session->userdata('status') > 0)
				redirect('intra/admin');
			else
				redirect('intra/profile');
		}
	}
	public function assign_ticket()
	{
		$this->load->model('dashboard_model');
		$this->form_validation->set_rules('admin', 'Admin', 'trim|required|xss_clean');
		$this->form_validation->set_rules('id', 'Ticket ID', 'trim|required|xss_clean');
		if ($this->form_validation->run())
		{
			$data = array(
				'admin'=>$this->input->post('admin'),
				'id'=>$this->input->post('id')
				);
			$this->dashboard_model->assign_ticket($data);
			redirect('intra/admin');
		}
	}
}
?>