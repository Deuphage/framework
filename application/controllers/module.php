<?php

class Module extends CI_controller
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
		$status = $this->session->userdata('status');
		$login = $this->session->userdata('login');
		$uid = ($status === 3) ? FALSE : $this->ldap->get_id($login);
		$modules = $this->module_model->list_modules($uid);
		$data = array('status' => $status, 'modules' => $modules, 'uid'=>$uid);
		$this->load->view('module_view', $data);
	}

	public function module_create()
	{
		$this->form_validation->set_rules('name', 'Module name', 'trim|required|xss_clean|min_length[5]');
		$this->form_validation->set_rules('credits', 'Credits', 'trim|required|xss_clean');
		$this->form_validation->set_rules('places_nb', 'Places', 'trim|required|xss_clean');
		$this->form_validation->set_rules('reg_start', 'Registration start', 'trim|required|xss_clean|min_length[10]');
		$this->form_validation->set_rules('reg_end', 'Registration end', 'trim|required|xss_clean|min_length[10]');
		$this->form_validation->set_rules('module_start', 'Module start', 'trim|required|xss_clean|min_length[10]');
		$this->form_validation->set_rules('module_end', 'Module end', 'trim|required|xss_clean|min_length[10]');
		if ($this->form_validation->run())
		{
			$this->load->model('module_model');
			$this->load->model('forum_model');
			$data = array(
				'name'=>$this->input->post('name'),
				'credits'=>$this->input->post('credits'),
				'places_nb'=>$this->input->post('places_nb'),
				'reg_start'=>$this->input->post('reg_start'),
				'reg_end'=>$this->input->post('reg_end'),
				'module_start'=>$this->input->post('module_start'),
				'module_end'=>$this->input->post('module_end')
				);
			$this->module_model->add_module($data);

			$data2 = array(
				'title'=>$this->input->post('name'),
				'description'=>'Discussion about ' . $this->input->post('name') . ' module',
				'login'=>'admin',
				'email'=>'admin@admin.com'
				);
			$this->forum_model->add_topic($data2);
			redirect('module/index');
		}
		else
			redirect('intra/admin');
	}

	public function module_subscribe()
	{
		$uid = $this->input->post('uid');
		$mid = $this->input->post('mid');
		if ($uid != FALSE && $mid != FALSE)
			$this->module_model->subscribe_to_module($uid, $mid);
		redirect('module/index');
	}

	public function module_unsubscribe()
	{
		$uid = $this->input->post('uid');
		$mid = $this->input->post('mid');
		if ($uid != FALSE && $mid != FALSE)
			$this->module_model->unsubscribe_from_module($uid, $mid);
		redirect('module/index');
	}

	public function activities()
	{
		$mid = $this->input->get('mid');
		if (isset($mid) && !empty($mid))
		{
			$status = $this->session->userdata('status');
			$login = $this->session->userdata('login');
			$uid = ($status === 3) ? FALSE : $this->ldap->get_id($login);
			$activities = $this->module_model->list_activities($mid, $uid);
			$data = array('status' => $status, 'activities' => $activities, 'uid'=>$uid);
			$this->load->view('activity_view', $data);
		}
		else
			redirect('module/index');
	}

	public function activity_create()
	{
		$this->form_validation->set_rules('name', 'Activity name', 'trim|required|xss_clean|min_length[5]');
		$this->form_validation->set_rules('mid', 'Module', 'trim|required|xss_clean');
		$this->form_validation->set_rules('places_nb', 'Places', 'trim|required|xss_clean');
		$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean|min_length[5]');
		$this->form_validation->set_rules('group_size', 'Taille des groupes', 'trim|required|xss_clean');
		$this->form_validation->set_rules('group_gen', 'Mode de génération des groupes', 'trim|required|xss_clean');
		$this->form_validation->set_rules('type', 'Type d\'activité', 'trim|required|xss_clean');
		$this->form_validation->set_rules('peer_correcting_nb', 'Nombre de peer correcting', 'trim|required|xss_clean');
		$this->form_validation->set_rules('reg_start', 'Registration start', 'trim|required|xss_clean|min_length[10]');
		$this->form_validation->set_rules('reg_end', 'Registration end', 'trim|required|xss_clean|min_length[10]');
		$this->form_validation->set_rules('activity_start', 'Module start', 'trim|required|xss_clean|min_length[10]');
		$this->form_validation->set_rules('activity_end', 'Module end', 'trim|required|xss_clean|min_length[10]');
		if ($this->form_validation->run())
		{
			$this->load->model('module_model');
			if ($_FILES['sub']['error'] > 0)
				$erreur = "Erreur lors du transfert";
			$extensions_valides = array('pdf');
			$extension_upload = strtolower(  substr(  strrchr($_FILES['sub']['name'], '.')  ,1)  ); #voir sujet_test
			if ( !in_array($extension_upload,$extensions_valides) )
				echo "erreur d'extension";
			$chemin = "/Volumes/Data/nfs/zfs-student-3/users/2013/kescalie/MAMP/apps/web/htdocs/assets/pdf/";
			$nom = time(). ".". $extension_upload;
			$resultat = move_uploaded_file($_FILES['sub']['tmp_name'],$chemin.$nom);
			if (!$resultat)
				redirect('intra/admin');
			$data = array(
				'name'=>$this->input->post('name'),
				'mid'=>$this->input->post('mid'),
				'places_nb'=>$this->input->post('places_nb'),
				'description'=>$this->input->post('description'),
				'group_size'=>$this->input->post('group_size'),
				'group_gen'=>$this->input->post('group_gen'),
				'type'=>$this->input->post('type'),
				'peer_correcting_nb'=>$this->input->post('peer_correction_nb'),
				'reg_start'=>$this->input->post('reg_start'),
				'reg_end'=>$this->input->post('reg_end'),
				'activity_start'=>$this->input->post('activity_start'),
				'activity_end'=>$this->input->post('activity_end'),
				'subject'=>$nom
				);
			$this->module_model->add_activity($data);
			redirect('module/index');
		}
		else
			redirect('intra/admin');
	}

	public function activity_subscribe()
	{
		$uid = $this->input->post('uid');
		$aid = $this->input->post('aid');
		$mid = $this->input->post('mid');
		if ($uid != FALSE && $aid != FALSE)
			$this->module_model->subscribe_to_activity($uid, $aid);	
		redirect('module/activities?mid=' . $mid);
	}

	public function activity_unsubscribe()
	{
		$uid = $this->input->post('uid');
		$aid = $this->input->post('aid');
		$mid = $this->input->post('mid');		
		if ($uid != FALSE && $aid != FALSE)
			$this->module_model->unsubscribe_from_activity($uid, $aid);
		redirect('module/activities?mid=' . $mid);
	}

	public function sujet_test()
	{
		//var_dump($_FILES);
		if ($_FILES['sub']['error'] > 0)
			$erreur = "Erreur lors du transfert";
		$extensions_valides = array('pdf');
		//1. strrchr renvoie l'extension avec le point (« . »).
		//2. substr(chaine,1) ignore le premier caractère de chaine.
		//3. strtolower met l'extension en minuscules.
		$extension_upload = strtolower(  substr(  strrchr($_FILES['sub']['name'], '.')  ,1)  );
		if ( !in_array($extension_upload,$extensions_valides) )
			redirect('intra/admin');
		$chemin = "/Volumes/Data/nfs/zfs-student-3/users/2013/kescalie/MAMP/apps/web/htdocs/assets/pdf/";
		$nom = time(). ".".$extension_upload;
		$resultat = move_uploaded_file($_FILES['sub']['tmp_name'],$chemin.$nom);
		if ($resultat)
			echo $nom;
	}
}

?>
