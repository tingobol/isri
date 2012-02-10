<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Messages extends Controller
	{
	
		function __construct()
		{
			parent::Controller();
	    }
		
		function index()
		{
			$data['msg'] = $this->db
				->where('to',$this->session->userdata('username'))
				->order_by('sent','DESC')
				->limit(20)
				->get('chat')->result();
				
			$user = new User();
			$data['users'] = $user->select('username')->get();
			
			$this->template->write_view('sidebar', 'sidebar/menu',$this->sidebar());
			$this->template->write_view('content', 'messages/index',$data);
			$this->template->render();
		}
	
	    function compose()
	    {
	    	$users = new User();
			
			$users->select('username')->where('id !=',$this->session->userdata('id'))->get()->all_to_array();
			
			if($users->count() > 0)
			{
				foreach($users as $t)
				{
					$ta[] = '"'.$t->username.'"';
				}
				$data['users'] = $ta;
			}
			else
			{
				$data['users'] = array();
			}
				
			$this->load->view('messages/compose',$data);
	    }
		
		function send()
		{
			if(($this->input->post('rcpt') !== '') && ($this->input->post('message') !== ''))
			{
				$users = str_replace(' ','',$this->input->post('rcpt'));
				$users = explode(',',$users);
				$data = array(
					'message' => $this->input->post('message'),
					'from' => $this->session->userdata('username'),
					'sent' => date('Y-m-d h:i:s'),
					'recd' => 0
				);
				
				$users = array_unique($users);
				
				foreach($users as $u)
				{
					if($u !== '')
					{
						$data['to'] = $u;
						$this->db->insert('chat',$data);
					}
				}
				
				$this->session->set_flashdata('msg','<p class="succes">Mensaje enviado</p>');
				redirect('messages/compose');
			}
		}
		
		function delete($id)
		{
			$this->db->delete('chat',array('id'=>$id));
			$this->session->set_flashdata('msg','<p class="success">Mensaje borrado</p>');
			redirect($this->agent->referrer());
		}
		
		function filter()
		{
			if($this->input->post('string') !== '') {
				$this->db->like('message',$this->input->post('string'));
			}
			
			if($this->session->userdata('admin'))
			{
				if($this->input->post('from') !== '0') $this->db->where('from', $this->input->post('from'));
				if($this->input->post('to') !== '0') $this->db->where('to', $this->input->post('to'));
			}
			else
			{
				if($this->input->post('tipo') == 'from') 
				{
					$this->db->where('from',$this->session->userdata('username'));
					if($this->input->post('to') !== '0') $this->db->where('to',$this->input->post('to'));
				}
				if($this->input->post('tipo') == 'to') 
				{
					$this->db->where('to',$this->session->userdata('username'));
					if($this->input->post('to') !== '0') $this->db->where('from',$this->input->post('to'));
				}
			}
			
			$this->db->order_by('sent','DESC');
			
			$msg = $this->db->get('chat')->result();
			
			echo "<table>
					<tr>
						<th>De</th>
						<th>Para</th>
						<th>Mensaje</th>
						<th>Fecha</th>
						<th></th>
					</tr>";
					
			foreach($msg as $m)
			{
				echo "<tr>";
					echo "<td>";
						echo $m->from;
					echo "</td>";
					echo "<td>";
						echo $m->to;
					echo "</td>";
					echo "<td>";
						echo $m->message;
					echo "</td>";
					echo "<td>";
						echo date('d/m/Y h:i a',mysql_to_unix($m->sent));
					echo "</td>";
					echo "<td>";
						if($this->session->userdata('admin')) echo anchor('messages/delete/'.$m->id,img('static/img/icon/trash.png'));
					echo "</td>";
				echo "</tr>";
			}
			echo "<table>";
			
		}
		
		function sidebar()
		{
			$uid = $this->session->userdata('id');
			$tags = new Tag();
			$sidebar['etiquetas'] = $tags
				->where('deleted',0)
				->where_related('tasks/user','id',$this->session->userdata('id'))
				->where_related_task('status_id <', 4)
				->include_related_count('task')
				->group_by('tag')
				->get_iterated();
			
			$sidebar['nuevas'] = $this->db->from('roles_tasks_users')
									->where('read',1)
									->where('user_id',$uid)
									->count_all_results();
			
			$sidebar['updates'] = $this->db->from('roles_tasks_users')
									->where('update',1)
									->where('user_id',$uid)
									->count_all_results();
			
			$sidebar['vencidas'] = $this->db->from('roles_tasks_users')
									->join('tasks','tasks.id = roles_tasks_users.task_id')
									->where('roles_tasks_users.user_id',$uid)
									->where('roles_tasks_users.role_id <', 4)
									->where('tasks.status_id',2)
									->count_all_results();
									
			$sidebar['postergadas'] = $this->db->from('roles_tasks_users')
									->join('tasks','tasks.id = roles_tasks_users.task_id')
									->where('roles_tasks_users.user_id',$uid)
									->where('tasks.status_id',3)
									->count_all_results();
			
			$sidebar['complete'] = $this->db->from('roles_tasks_users')
									->join('tasks','tasks.id = roles_tasks_users.task_id')
									->where('roles_tasks_users.user_id',$uid)
									->where('tasks.status_id',4)
									->count_all_results();
									
			$active = $this->db->select('user_data')
											->from('ci_sessions')
											->where('user_data !=','')
											->where('last_activity > UNIX_TIMESTAMP((NOW() - INTERVAL 30 MINUTE))')
											->not_like('user_data',$this->session->userdata('username'))
											->get()->result();
			
			$sidebar['active'] = array();
			
			foreach($active as $a)
			{
				$u = $this->regexp($a->user_data);
				$sidebar['active'][] ='<a href="javascript:void(0)" onclick="javascript:chatWith(\''.$u.'\')">'.img('static/img/icon/spechbubble_2.png').$u.'</a>';
			}
			
			return $sidebar;
		}
		
		function regexp($txt)
		{

			  $re1='.*?';	# Non-greedy match on filler
			  $re2='(?:[a-z][a-z0-9_]*)';	# Uninteresting: var
			  $re3='.*?';	# Non-greedy match on filler
			  $re4='(?:[a-z][a-z0-9_]*)';	# Uninteresting: var
			  $re5='.*?';	# Non-greedy match on filler
			  $re6='(?:[a-z][a-z0-9_]*)';	# Uninteresting: var
			  $re7='.*?';	# Non-greedy match on filler
			  $re8='(?:[a-z][a-z0-9_]*)';	# Uninteresting: var
			  $re9='.*?';	# Non-greedy match on filler
			  $re10='(?:[a-z][a-z0-9_]*)';	# Uninteresting: var
			  $re11='.*?';	# Non-greedy match on filler
			  $re12='(?:[a-z][a-z0-9_]*)';	# Uninteresting: var
			  $re13='.*?';	# Non-greedy match on filler
			  $re14='(?:[a-z][a-z0-9_]*)';	# Uninteresting: var
			  $re15='.*?';	# Non-greedy match on filler
			  $re16='((?:[a-z][a-z0-9_]*))';	# Variable Name 1

			  if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5.$re6.$re7.$re8.$re9.$re10.$re11.$re12.$re13.$re14.$re15.$re16."/is", $txt, $matches))
			  {
				  $var1=$matches[1][0];
				  return $var1;
			  }
		}
	
	}