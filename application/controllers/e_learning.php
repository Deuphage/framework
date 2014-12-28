<?php

class E_learning extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('module_model');
		$this->load->model('ldap');
		if ($this->session->userdata('online') && $this->session->userdata('login'))
		{
			$this->lang->load('menu', $this->session->userdata('language'));
			$this->lang->load('title', $this->session->userdata('language'));
			$data = array(
				"title_welcome"		=> $this->lang->line('title_welcome'),
				"menu_home"			=> $this->lang->line('menu_home'),
				"menu_profile"		=> $this->lang->line('menu_profile'),
				"menu_newsletter"	=> $this->lang->line('menu_newsletter'),
				"menu_forum"		=> $this->lang->line('menu_forum'),
				"menu_annuaire"		=> $this->lang->line('menu_annuaire'),
				"menu_module"		=> $this->lang->line('menu_module'),
				"menu_logout"		=> $this->lang->line('menu_logout')
						);
			if ($this->session->userdata('status') > 0)
				$data['menu_admin'] = $this->lang->line('menu_admin');
			$this->load->view('perso', $data);
		}
		else
			redirect('intra'); // If user is not logged in, redirect him to intra
	}

	public function index()
	{
		$this->load->model('module_model');
		$this->load->model('elearning_model');

		$data = array(
			'modules'=>$this->module_model->list_modules(FALSE),
			'activities'=>$this->module_model->list_all_activities(),
			'e_learning'=>$this->elearning_model->list_e_learning()
			);
		$this->load->view('e_learning', $data);
	}

	public function add_file()
	{
		$this->form_validation->set_rules('name', 'Nom du cours', 'trim|required|xss_clean|min_length[5]');
		if ($this->form_validation->run())
		{
			$this->load->model('elearning_model');
			if ($_FILES['file']['error'] > 0)
				redirect('forum');
			$extensions_valides = array('pdf, mp3, webmhd.webm, oggtheora.ogv, webm, ogv, ogg');
			$extension_upload = strtolower(  substr(  strrchr($_FILES['file']['name'], '.')  ,1)  ); #voir sujet_test
			if ( !in_array($extension_upload,$extensions_valides) )
				echo "erreur d'extension";
			$chemin = "/Volumes/Data/nfs/zfs-student-3/users/2013/kescalie/MAMP/apps/web/htdocs/assets/e-learning/";
			$nom = time(). ".". $extension_upload;
			$resultat = move_uploaded_file($_FILES['file']['tmp_name'],$chemin.$nom);
			if (!$resultat)
				redirect('intra/admin');
			$data = array(
				'file'=>$nom,
				'name'=>$this->input->post('name'),
				'extension'=>$extension_upload
				);
			if ($this->input->post('aid'))
				$data['aid'] = $this->input->post('aid');
			if ($this->input->post('mid'))
				$data['mid'] = $this->input->post('mid');
			$this->elearning_model->add_e_learning($data);
			redirect('e_learning');
		}
		else
			redirect('intra');
	}

	public function view_file()
	{
		$this->load->view('e_learning_view');
	}
	public function delete_file()
	{
		$this->load->model('elearning_model');
		$data['id'] = $this->input->post('id');
		$this->elearning_model->delete_file($data);
		redirect('e_learning');
	}
}

?>