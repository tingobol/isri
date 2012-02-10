<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Tags extends Controller
	{
	
		function __construct()
		{
			parent::Controller();
	    }
	
	    function admin_tags()
		{
			$tags = new Tag();
			$data['tags'] = $tags->get_where(array('deleted' => 0));
			$this->load->view('tags/form_admin',$data);
		}
		
		function edit_tag($id)
		{
			$data['tag'] = $tag = new Tag($id);
			$this->load->view('tags/form_edit',$data);
		}
		
		function delete_tag($id)
		{
			$tag = new Tag();
			$tag->where('id',$id)->update('deleted',1);
			$this->session->set_flashdata('msg','<p class="success">La categoría fué eliminada.</p>');
			redirect('tags/admin_tags');
		}
		
		function save_tag($id = FALSE)
		{
			if($id)
			{
				$tag = new Tag($id);
			}
			else $tag = new Tag();
			
			if($_POST['tag'])
			{
				$t = strtoupper($_POST['tag']);
				$check = new Tag();
				if($check->get_by_tag($t)->exists())
				{
					$check->update('deleted',0);
					$this->session->set_flashdata('msg','<p class="error">La categoría ya existe.</p>');
					if($id) redirect('tags/edit_tag/'.$id);
				}
				else
				{
					$tag->tag = $t;
					$tag->slug = url_title($t);
					$tag->save();
					$this->session->set_flashdata('msg','<p class="success">La categoría fué guardada.</p>');
				}
			}
			else
			{
				$this->session->set_flashdata('msg','<p class="error">Debe incluir el nombre de la categoría.</p>');
				if($id) redirect('tags/edit_tag/'.$id);
			}
			
			redirect('tags/admin_tags');
		}
	
	}
