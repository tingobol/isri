<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Auth extends Controller
	{
	
		function __construct()
		{
			parent::Controller();
	    }
	
	    function login()
	    {
	    	$this->load->view('auth/login');
	    }
		
		function do_login()
		{
			$u = new User();
			$u->where('username',$_POST['usuario'])->or_where('email',$_POST['usuario'])->get();
			if($u->exists())
			{
				if($u->active)
				{
					if(sha1($_POST['password']) == $u->password)
					{
						$data = array(
								'id' => $u->id,
								'username' => $u->username,
								'name' => $u->name,
								'branch_id' => $u->branch_id,
								'admin' => $u->admin
							);
						$this->session->set_userdata($data);
						session_start();
						$_SESSION['username'] = $u->username;
						redirect('tasks');
					}
					else
					{
						$this->session->set_flashdata('error','<p class="error">El nombre de usuario o contraseña son incorrectos.</p>');
						redirect('auth/login');
					}
				}
				else
				{
					$this->session->set_flashdata('error','<p class="error">Su cuenta ha sido desactivada.</p>');
					redirect('auth/login');
				}
			}
			else
			{
				$this->session->set_flashdata('error','<p class="error">El nombre de usuario o contraseña son incorrectos.</p>');
				redirect('auth/login');
			}
		}
		
		function logout()
		{
			$this->session->sess_destroy();
			// BORRA LAS COOKIES DEL CHAT
			if (isset($_SERVER['HTTP_COOKIE'])) {
				$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
				foreach($cookies as $cookie) {
					$parts = explode('=', $cookie);
					$name = trim($parts[0]);
					setcookie($name, '', time()-1000);
					setcookie($name, '', time()-1000, '/');
				}
			}
			redirect('auth/login');
		}
	
	}