<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Branches extends Controller
	{
	
		function __construct()
		{
			parent::Controller();
	    }
	
	    function admin_branches()
		{
			$branches = new Branch();
			$data['branches'] = $branches->get();
			$this->load->view('branches/form_admin',$data);
		}
		
		function edit_branch($id)
		{
			$data['branch'] = $branch = new Branch($id);
			$this->load->view('branches/form_edit',$data);
		}
		
		function delete_branch($id)
		{
			$tag = new Branch($id);
			$tag->delete();
			$this->session->set_flashdata('msg','<p class="success">La sucursal fué eliminada.</p>');
			redirect('branches/admin_branches');
		}
		
		function save_branch($id = FALSE)
		{
			if($id)
			{
				$branch = new Branch($id);
			}
			else $branch = new Branch();
			
			if($_POST['name'])
			{
				$t = strtoupper($_POST['name']);
				$check = new Branch();
				if($check->get_by_name($t)->exists())
				{
					$this->session->set_flashdata('msg','<p class="error">La sucursal ya existe.</p>');
					if($id) redirect('tags/edit_branch/'.$id);
				}
				else
				{
					$branch->name = $t;
					$branch->save();
					$this->session->set_flashdata('msg','<p class="success">La sucursal fué guardada.</p>');
				}
			}
			else
			{
				$this->session->set_flashdata('msg','<p class="error">Debe incluir el nombre de la sucursal.</p>');
				if($id) redirect('branches/edit_branch/'.$id);
			}
			
			redirect('branches/admin_branches');
		}
	
	}
