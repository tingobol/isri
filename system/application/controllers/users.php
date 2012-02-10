<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Users extends Controller
	{
	
		function __construct()
		{
			parent::Controller();
			if(!$this->session->userdata('id')) redirect('auth/login');
	    }
		
		function admin()
		{
			$users = new User();
			$data['users'] = $users->get();
			$this->load->view('users/admin',$data);
		}
		
		function agenda()
		{
			$users = new User();
			$data['users'] = $users->get();
			$this->load->view('users/agenda',$data);
		}
		
		function active($active,$id)
		{
			$user = new User($id);
			$user->active = $active;
			$user->save();
			if($active == 1)
			{
				$status = "activado";
			}
			else $status = "desactivado";
			$this->session->set_flashdata('msg','<p class="success">El usuario <strong>'.$user->username.'</strong> fué '.$status.'.</p>');
			redirect('users/admin');
		}
		
		function save_edit($id = FALSE)
		{
			if($id)
			{
				$user = new User($id);
				$url = 'users/add_edit/'.$id;
			}
			else
			{
				$user = new User();
				$url = 'users/add_edit';
			}
			
			if(empty($_POST['password']) AND empty($_POST['confirm']))
			{
				$user->from_array($_POST, array('name','username','email','active','admin','phone','cellphone','branch_id'));
			}
			else $user->from_array($_POST, array('name','username','email','active','admin','phone','cellphone', 'password', 'confirm','branch_id'));
			
			$user->save();
			
			if($user->valid)
			{
				$this->session->set_flashdata('msg','<p class="success">El usuario <strong>'.$user->username.'</strong> fué guardado con éxito.</p>');
				if(isset($_POST['profile'])) $url = 'users/add_edit/'.$id.'/1';
				else $url = 'users/admin';
				redirect($url);
			}
			else
			{
				$this->session->set_flashdata('errors',$user->error->all);
				$this->session->set_flashdata('user',$_POST);
				if($_POST['profile']) $url = 'users/add_edit/'.$id.'/1';
				redirect($url);
			}
			
		}	
		
		function delete_user($id)
		{
			$u = new User($id);
			$this->session->set_flashdata('msg','<p class="success">El usuario <strong>'.$u->username.'</strong> fué eliminado con éxito.</p>');
			$u->delete();
			redirect('users/admin');
		}
		
		function add_edit($id = FALSE, $profile = FALSE)
		{
			$branches = new Branch();
			if($id)
			{
				$user = new User($id);
				$data['id'] = $id;
				$data['branches'] = $branches->get();
				if($profile) $data['profile'] = $profile;
				else $data['profile'] = FALSE;
				$data['user'] = $user->to_array(array('name','username','email','active','admin','phone','cellphone','branch_id'));
			}
			else
			{	
				$data['profile'] = FALSE;
				$data['user'] = array(
									'active' => 1,
									'admin' => 0,
									'name' => '',
									'password' => '',
									'confirm' => '',
									'username' => '',
									'phone' => '',
									'cellphone' => '',
									'branch_id' => '',
									'email' => ''
								);
				$data['branches'] = $branches->get();
			}
			if($this->session->flashdata('errors'))
			{
				$data['user'] = $this->session->flashdata('user');
			}
			
			$this->load->view('users/form_add_edit',$data);
		}
	
	}