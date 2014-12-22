<?php

class Intra extends CI_Controller
{
	

	public function __construct()
	{
		parent::__construct();
		#Si on a les bonnes variables, on test l'autologin. Ne marche que sur la page main (en theorie)
		if ($_GET['token'] && $_GET['timeout'] > time()) #check la validité du lien
		{
			$this->load->model('users');
			$privateKey = "801*)!d7vw9w5clp12l;0smva90a@@<ksvoa"; #security key
			$hash = hash('sha256', $privateKey . site_url('intra/main') . $_GET['name'] . $_GET['timeout']);
			if (strcmp($_GET['token'], $hash) === 0)
			{
				$info = $this->users->user_info($_GET['name']);
				$data = array(
					'login'=>$info->login,
					'online'=>true,
					'status'=> $info->status,
					'language'=>$info->language
							);
				$this->session->set_userdata($data);
			}
			else
			{
				echo "Compare error";
			}
		}
		else
		{	
			if ($_GET['token'])
				echo "Link timeout";
		}
		if ($this->session->userdata('online') && $this->session->userdata('login'))
		{
			$this->lang->load('menu', $this->session->userdata('language'));
			$this->lang->load('title', $this->session->userdata('language'));
			$data = array(
				'title_welcome' => $this->lang->line('title_welcome'),
				'menu_home'=> $this->lang->line('menu_home'),
				'menu_profile'=> $this->lang->line('menu_profile'),
				'menu_newsletter' => $this->lang->line('menu_newsletter'),
				'menu_forum' => $this->lang->line('menu_forum'),
				"menu_annuaire" => $this->lang->line('menu_annuaire'),
				"menu_module"		=> $this->lang->line('menu_module'),
				'menu_logout' => $this->lang->line('menu_logout')
						);
			if ($this->session->userdata('status') > 0)
				$data['menu_admin'] = $this->lang->line('menu_admin');
			if ($this->session->userdata('bind') === false)
			{
				$this->ldap_bind('pouet', ''); #On laisse pas son mdp ici
				$this->session->set_userdata('bind', TRUE);
			}
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
	public function index()
	{
		$this->lang->load('title', $this->session->userdata('language'));
		$data = array(
			'title_home'=>$this->lang->line('title_home'),
			'title_news'=>$this->lang->line('title_news')
			);
		if ($this->session->userdata('login'))
		{
			$log = array(
			'login'=>$this->session->userdata('login'),
			'action'=>"visite",
			'other'=>"index"
			);
			$this->logs->add_log($log);
		}
		$this->load->view('middle', $data);
		$this->load->view('foot');
	}
	public function main()
	{
		if ($this->session->userdata('login'))
		{
			$log = array(
			'login'=>$this->session->userdata('login'),
			'action'=>"visite",
			'other'=>"main"
			);
			$this->logs->add_log($log);
		}
		$this->load->view('main');
		$this->load->view('foot');
	}
	public function admin()
	{
		$this->load->model('dashboard_model');
		$this->load->model('module_model');
		$this->lang->load('form', $this->session->userdata('language'));
		$this->lang->load('title', $this->session->userdata('language'));
		$this->load->model('users');
		if ($this->users->check_permission($this->session->userdata('login')) > 0)
		{
			$data = array(
			'title_admin'=>$this->lang->line('title_admin'),
			'title_panel'=>$this->lang->line('title_panel'),
			'form_username'=>$this->lang->line('form_username'),
			'form_status'=>$this->lang->line('form_status'),
			'form_mere_mortal'=>$this->lang->line('form_mere_mortal'),
			'form_all_powerful'=>$this->lang->line('form_all_powerful'),
			'form_action'=>$this->lang->line('form_action'),
			'form_action_read'=>$this->lang->line('form_action_read'),
			'form_action_modify'=>$this->lang->line('form_action_modify'),
			'form_action_delete'=>$this->lang->line('form_action_delete'),
			'form_control'=>$this->lang->line('form_control'),
			'user_list'=>$this->users->user_list(),
			'admin_list'=>$this->users->admin_list(),
			'list_ticket'=>$this->dashboard_model->list_tickets(),
			'modules'=>$this->module_model->list_modules(FALSE)
					);
			if ($this->session->userdata('login'))
			{
				$log = array(
					'login'=>$this->session->userdata('login'),
					'action'=>"visite",
					'other'=>"admin"
				);
				$this->logs->add_log($log);
			}
			$this->load->view('admin', $data);
		}
		else
			echo "You don't have rights !";
	}
	public function test()
	{
		$this->load->view('middle');
	}
	public function register()
	{
		$this->load->model('register');
		$this->load->model('users');
		$this->lang->load('title', $this->session->userdata('language'));
		$this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean|min_length[5]');
		$this->form_validation->set_rules('pass', 'Password', 'trim|required|matches[passconf]|xss_clean');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|xss_clean|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');

		if ($this->form_validation->run() && $this->users->check_login($this->input->post('login')))
		{
			$data = array(
				'login'=>$this->input->post('login'),
				'email'=>$this->input->post('email'),
				'pass'=>sha1($this->input->post('pass')),
				'first_name'=>$this->input->post('first_name'),
				'surname'=>$this->input->post('surname'),
				'gender'=>$this->input->post('gender'),
				'avatar'=>$this->input->post('avatar'));
			
			$data3['title_success_register'] = $this->lang->line('title_success_register');
			$this->register->reg_user($data);
			
			$log = array(
				'login'=>$this->input->post('login'),
				'action'=>"new account"
						);
			$this->logs->add_log($log);
		
			$this->load->view('reg_success', $data3);
		}
		else
		{
			$this->lang->load('form', $this->session->userdata('language'));
			$data2 = array(
				'title_register'=>$this->lang->line('title_register'),
				'form_username'=>$this->lang->line('form_username'),
				'form_password'=>$this->lang->line('form_password'),
				'form_confirmation'=>$this->lang->line('form_confirmation'),
				'form_first_name'=>$this->lang->line('form_first_name'),
				'form_surname'=>$this->lang->line('form_surname'),
				'form_gender'=>$this->lang->line('form_gender'),
				'form_email'=>$this->lang->line('form_email'),
				'form_avatar'=>$this->lang->line('form_avatar')
							);
			$this->load->view('register', $data2);
		}
	}

	public function login()
	{
		$this->load->model('users');
		$this->lang->load('form', $this->session->userdata('language'));
		$this->lang->load('menu', $this->session->userdata('language'));
		$this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
		$this->form_validation->set_rules('pass', 'Password', 'trim|required|xss_clean');

		if ($this->form_validation->run())
		{
			if ($this->users->aut_login($this->input->post('login'), $this->input->post('pass')))
			{
				$info = $this->users->user_info($this->input->post('login'));
				$data = array(
						'login'=>$info->login,
						'online'=>true,
						'status'=> $info->status,
						'language'=>$info->language
							);
				$this->session->set_userdata($data);
				$log = array(
					'login'=>$info->login,
					'action'=>"login"
							);
				$this->logs->add_log($log);
				redirect('intra/main');
			}
			else
			{
				$ds=ldap_connect('ldap://ldap.42.fr', '636');
				$user = ldap_search($ds, 'ou=people,dc=42,dc=fr', 'uid='. $this->input->post('login'));
				$user = ldap_get_entries($ds, $user);
				if ($this->ldap_bind($user[0]['uid'][0], $this->input->post('pass')) === FALSE)
				{
					$data2 = array(
					'form_username'=>$this->lang->line('form_username'),
					'form_password'=>$this->lang->line('form_password'),
					'menu_login'=>$this->lang->line('menu_login')
					);
					$this->load->view('login', $data2);
				}
		    	else
		    	{
		    		$data = array(
						'login'=>$this->input->post('login'),
						'online'=>true,
						'status'=> 0
							);
					$this->session->set_userdata($data);
					$log = array(
						'login'=>$this->input->post('login'),
						'action'=>"login"
							);
					$this->logs->add_log($log);
					redirect('intra/main');
		    	}
			
			}
		}
		else
		{
			$data2 = array(
				'form_username'=>$this->lang->line('form_username'),
				'form_password'=>$this->lang->line('form_password'),
				'menu_login'=>$this->lang->line('menu_login')
						);
			$this->load->view('login', $data2);
		}
	}
	public function logout()
	{
		$this->load->model('users');
		$data = array(
			'login'=>$this->session->userdata('login'),
			'language'=>$this->session->userdata('language')
					);
		$log = array(
				'login'=>$this->session->userdata('login'),
				'action'=>"logout"
						);
		$this->logs->add_log($log);
		$this->users->language_preference($data);
		$this->session->unset_userdata('language');
		$this->session->unset_userdata('status');
		$this->session->unset_userdata('online');
		$this->session->unset_userdata('login');
		$this->session->sess_destroy();
		redirect('/intra/main', 'refresh');
	}
	public function profile()
	{
		$this->load->model('users');
		$this->load->model('dashboard_model');
		$this->lang->load('form', $this->session->userdata('language'));
		$data = array(
			'form_username'=>$this->lang->line('form_username'),
			'form_old_password'=>$this->lang->line('form_old_password'),
			'form_password'=>$this->lang->line('form_password'),
			'form_email'=>$this->lang->line('form_email'),
			'form_action_modify'=>$this->lang->line('form_action_modify'),
			'form_perso_info'=>$this->lang->line('form_perso_info'),
			'list_ticket'=>$this->dashboard_model->list_tickets()
			);
		$this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
    	$this->form_validation->set_rules('submit', 'Submit', 'trim|required|xss_clean');
    	if ($this->form_validation->run())
    	{
    		$data['autolog'] = $this->create_url();
    	}
    	else
    		$data['autolog'] = '';
		if ($this->session->userdata('login'))
		{
			$log = array(
				'login'=>$this->session->userdata('login'),
				'action'=>"visite",
				'other'=>"profile"
			);
			$this->logs->add_log($log);
		}
		if ($this->session->userdata('login') && $this->session->userdata('online'))
			$this->load->view('profile', $data);
		else
			redirect('intra/login');
	}
	public function change_profile()
	{
		$this->load->model('register');
		$this->load->model('users');
		$this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
		$this->form_validation->set_rules('pass', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('old_pass', 'Old Password', 'trim|xss_clean|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|xss_clean');

		if ($this->form_validation->run() && $this->users->check_login($this->input->post('login'), $this->input->post('old_pass')))
		{
			$data = array(
				'email'=>$this->input->post('email'),
				'pass'=>sha1($this->input->post('pass')));
				$this->register->reg_user($data);
				$this->load->view('profile');
		}
		else
		{
			$this->load->view('profile');
		}
	}
	public function admin_form()
	{
		$this->load->model('users');
		$this->load->model('admin');
		$this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
		$this->form_validation->set_rules('action', 'Action', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|xss_clean');
		if ($this->form_validation->run())
		{
			$data = array(
				'login'=>$this->input->post('login'),
				'login2'=>$this->input->post('login2'),
				'first_name'=>$this->input->post('first_name'),
				'email'=>$this->input->post('email'),
				'gender'=>$this->input->post('gender'),
				'status'=>$this->input->post('status'),
				'status_target'=>$this->users->check_permission($this->input->post('login')),
				'status_admin'=>$this->users->check_permission($this->session->userdata('login'))
						);
			if ($this->input->post('pass'))
				$data['pass'] = sha1($this->input->post('pass'));
			if ($this->input->post('action') === 'delete')
				$this->admin->delete_user($data);
			else if ($this->input->post('action') === 'modify')
				$this->admin->update_info($data);
			else if ($this->input->post('action') === 'create')
				{
					if (!($this->admin->create_user($data)))
						redirect('intra/admin');
				}	
			else
			{
				$profile = $this->users->user_info($data['login']);
				$this->load->view('view_profile', $profile);
			}
			$this->lang->load('title', $this->session->userdata('language'));
			$data2['title_success_control'] = $this->lang->line('title_success_control');
			$this->load->view('control_success', $data2);
		}
		else
			redirect('intra/admin');
	}
	public function email()
	{		
		$this->load->library('email');
		$config['protocol'] = 'sendmail';
		$config['mailpath'] = 'env -i /usr/sbin/sendmail -t -i';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;

		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		$this->email->initialize($config);
		$this->load->model('users');
		$email = $this->users->get_email_users($this->session->userdata('login'));
		$this->email->from('arx@hotmail.fr', 'Super Admin of the Death');
		$this->email->to($email); 

		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');	

		$this->email->send();
		echo "Email envoyé !";
		#echo $this->email->print_debugger();
	}
	
	public function set_language()
	{
		$this->form_validation->set_rules('language', 'Language', 'trim|required|xss_clean');
		if ($this->form_validation->run())
		{
			$this->session->set_userdata('language', $this->input->post('language'));
			redirect('intra');
		}
		else
			print("error");
	}

	public function logger()
	{
		$this->lang->load('form', $this->session->userdata('language'));
		$config = array();
        $config["base_url"] = base_url() . "/index.php/" . "intra/logger";
        $config["total_rows"] = $this->logs->count_log();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
 
        $this->pagination->initialize($config);
 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data['results'] = $this->logs->read_log($config['per_page'], $page);
		$data['links'] = $this->pagination->create_links();
		$data['title_logger'] = $this->lang->line('title_lang');
		$this->load->view('logger', $data);
	}

	public function ldap_bind($uid, $pswd)
	{
		$server = "ldap://ldap.42.fr";
		$port = "636";
		$ds=ldap_connect($server, $port);

		if ($ds)
		{
			if (($user = ldap_search($ds, 'ou=people,dc=42,dc=fr', 'uid=' . $uid)) != FALSE)
			{
				$user = ldap_get_entries($ds, $user);
				if ($user['count'] > 0)
				{
		    		ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
		    		if (ldap_bind($ds, $user[0]['dn'], $pswd) === TRUE)
		    			return ($ds);
		    		else
		    			$this->load->view('ldap_error');
		    	}
		    }
		}
		else 
		    $this->load->view('ldap_error');
		return (FALSE);
	}
	
	public function ldap_db($ds)
	{
		$this->load->model("ldap");
		for ($first_char = 'a';$first_char <= 'z';$first_char++)
		{
			$sr=ldap_search($ds, "ou=people,dc=42,dc=fr", "uid=$first_char*");  
	    	$info = ldap_get_entries($ds, $sr);
	    	if ($info == FALSE)
	    	{
	    		echo "NOPE\n";die;//debug
	    	}
	    	var_dump($info); die;
	    	for ($i=0; $i<$info["count"]; $i++)
	    	{
	    		$data = array(
			    	"dn"=>$info[$i]["dn"],
			    	"cn"=>$info[$i]["cn"][0],
			    	"uid"=>$info[$i]["uid"][0],
			    	"mobilephone"=>0
			    	);
			   	if (isset($info[$i]["mobile"][0]))
			    	$data["mobilephone"]=$info[$i]["mobile"][0];
			    if (isset($info[$i]["birth-date"][0]))
			    	$data["birthdate"]=$info[$i]["birth-date"][0];
			    if (isset($info[$i]["jpegPhoto"][0]))
			    	$data["photo"]=$info[$i]["jpegPhoto"][0];
			    if ($this->ldap->check_data($info[$i]["dn"]))
			    	$this->ldap->add_data($data);
			}
		}
		#echo "Closing connection";
		ldap_close($ds);
	}

	public function ldap_reset()
	{
		$this->session->unset_userdata('bind');
		redirect('intra/admin');
	}
	public function load_ldap()
	{
		$ds = $this->ldap_bind('pouet', ''); #On laisse pas son mdp ici
		$this->ldap_db($ds);
		redirect('intra/admin');
	}
	public function annuaire()
	{
		$this->load->model('ldap');
		$data['ldap_list'] = $this->ldap->ldap_list();
#		print_r($data);
		$this->load->view('annuaire', $data);
	}

	public function sort_by_key($array, $on, $order=SORT_ASC)
	{
	    $new_array = array();
	    $sortable_array = array();

	    if (count($array) > 0) {
	        foreach ($array as $k => $v) {
	            if (is_array($v)) {
	                foreach ($v as $k2 => $v2) {
	                    if ($k2 == $on) {
	                        $sortable_array[$k] = $v2;
	                    }
	                }
	            } else {
	                $sortable_array[$k] = $v;
	            }
	        }

	        switch ($order) {
	            case SORT_ASC:
	                asort($sortable_array);
	            break;
	            case SORT_DESC:
	                arsort($sortable_array);
	            break;
	        }

	        foreach ($sortable_array as $k => $v) {
	            $new_array[$k] = $array[$k];
	        }
	    }

	    return $new_array;
	}
	
	public function create_url()
	{
    		$privateKey = "801*)!d7vw9w5clp12l;0smva90a@@<ksvoa"; #security key
			$timeout = time() + (24 * 60 * 60); #Url validiy / Tomorrow is easy
			$url = site_url('intra/main'); #url target
			$hash = hash('sha256', $privateKey . $url . $this->session->userdata('login') . $timeout);
        	$autoLoginUrl = http_build_query(array(
        		'name' => $this->session->userdata('login'),
        		'timeout' => $timeout,
        		'token' => $hash
        		));
        		return ($url.'?'.$autoLoginUrl);
	}

}

?>