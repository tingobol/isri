<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Tasks extends Controller
	{
	
		function __construct()
		{
			parent::Controller();
		//	$this->output->enable_profiler(TRUE);
			if(! $this->session->userdata('id')) redirect('auth/login');
	    }
		
		function sidebar()
		{
			$uid = $this->session->userdata('id');
			$tags = new Tag();
			$sidebar['etiquetas'] = $tags
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
	
	    function index($page = NULL, $m = FALSE)
		{
			$this->template->write_view('sidebar', 'sidebar/menu',$this->sidebar());
			if($this->session->userdata('mode')) $this->calendar_mode($page, $m);
			else $this->list_mode($page);
			
			$this->template->render();
		}
		
		function switch_mode($mode)
		{
			if($mode == "list")
			{
				$this->session->set_userdata('mode',0);
			}
			else $this->session->set_userdata('mode',1);
			redirect('tasks');
		}
		
		function list_mode($page = NULL)
		{
			$this->load->helper('date');
			$this->load->helper('text');
			
			$tasks = new Task();
			$data['tasks'] = $tasks
								->where('status_id !=',4)
								->where_related_user('id',$this->session->userdata('id'))
								->where_related_role('id <',4)
								->order_by('type_id ASC, end_date ASC')
								->get_paged_iterated($page,20);
			
			$tags = new Tag();
			$data['tags'] = $tags->select('id,tag')->get();
			
			$role = new Role();
			$data['roles'] = $role->select('id,role')->get();
			
			$user = new User();
			$data['users'] = $user->select('id,username')->get();
			
			$types = new Type();
			$data['types'] = $types->select('id,type')->get();
			
			$status = new Status();
			$data['status'] = $status->select('id,status')->get();
			
			$this->template->write_view('content', 'tasks/index',$data);
		}
		
		function filtrar()
		{
			$tasks = new Task();
			if($this->input->post('string') != '') {
				$tasks->like('subject',$this->input->post('string'));
			}
			if($this->session->userdata('admin') && ($this->input->post('user_id') != 0))
			{
				$tasks->where_related_user('id',$this->input->post('user_id'));
			}
			else
			{
				$tasks->where_related_user('id',$this->session->userdata('id'));
			}
			if($this->input->post('role_id') != 0) $tasks->where_related_role('id',$this->input->post('role_id'));
			if($this->input->post('status_id') != 0) $tasks->where_related_status('id',$this->input->post('status_id'));
			if($this->input->post('type_id') != 0) $tasks->where_related_type('id',$this->input->post('type_id'));
			if($this->input->post('tag_id') != 0) $tasks->where_related_tag('id',$this->input->post('tag_id'));
			
			$tasks->get();
			
			echo "<table>";
			echo "<tr>";
			echo '<th colspan="3">'.img('static/img/icon/info.png')." TAP</th>";
			echo "<th>".img('static/img/icon/fire.png')." Prio.</th>";
			echo "<th>".img('static/img/icon/clock.png')." Transcurrido</th>";
			echo "<th>".img('static/img/icon/clock.png')." Restante</th>";
			echo "<th>".img('static/img/icon/spechbubble_2.png')."</th>";
			echo "</tr>";
			foreach($tasks as $t) {
				echo "<tr>";
				echo '<td class="status">';
				echo anchor('tasks/tag/'.$t->tag->slug,$t->tag->tag,'class="tag"');
				echo "</td>";
				echo '<td class="subject">'.anchor('tasks/view/'.$t->slug,character_limiter($t->subject, 30),'title="'.$t->subject.'"').'</td>';
				echo '<td class="status">';
				echo '<span class="'.$t->status->status.'">'.$t->status->status.'</span> ';
				echo "</td>";
				echo "<td>".$t->type->type."</td>";
				echo "<td>".timespan($t->start_date)."</td>";
				echo "<td>";
				if($t->end_date < time())
				{
					echo "Vencida";
				}
				else
				{
					echo timespan(time(),$t->end_date);
				}
				echo "</td>";
				echo "<td>".$t->comment->count()."</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		
		function calendar_mode($y = FALSE, $m = FALSE)
		{
			if(($m AND $y) == FALSE)
			{
				$this->load->helper('date');
				$m = mdate('%m');
				$y = mdate('%Y');
			}
			
			$this->load->library('calendar');
			$t = new Task();
			$tasks = $t->select('DAY(tasks.end_date) AS day, tasks.slug, tasks.subject')
									->where('MONTH(tasks.end_date)',$m)
									->where('YEAR(tasks.end_date)', $y)
									->order_by('end_date','ASC')
									->get();
			
			$calendario = array();
			
			if($tasks->count() > 0)
			{
				$lista = array();
				
				foreach($tasks as $t)
				{
					$lista[$t->day][] = anchor('tasks/view/'.$t->slug, character_limiter($t->subject,20),'class="tipwe" title="'.$t->subject.'"');
				}
				
				
				foreach($lista as $day => $tasks)
				{
					$calendario[$day] = ul($tasks);
				}
			}
			
			
			$data['calendar'] = $this->calendar->generate($y,$m,$calendario);
			$this->template->write_view('content', 'tasks/index_calendar',$data);
		}
		
		function tag($tag,$page = NULL)
		{
			$tasks = new Task();
			$data['tasks'] = $tasks
							->where_related_user('id',$this->session->userdata('id'))
							->where_related_tag('slug',$tag)
							->get_paged_iterated($page,20);
			
			$tag_name = new Tag();
			$data['tag_name'] = $tag_name->select('tag')->where('slug',$tag)->get();
			
			$tags = new Tag();
			$data['tags'] = $tags->select('id,tag')->get();
			
			$role = new Role();
			$data['roles'] = $role->select('id,role')->get();
			
			$user = new User();
			$data['users'] = $user->select('id,username')->get();
			
			$types = new Type();
			$data['types'] = $types->select('id,type')->get();
			
			$status = new Status();
			$data['status'] = $status->select('id,status')->get();
			
			$this->template->write_view('sidebar', 'sidebar/menu',$this->sidebar());
			$this->template->write_view('content', 'tasks/index',$data);
			$this->template->render();
		}
		
		function view($slug = NULL)
		{
			$this->load->helper('date');
			$this->load->helper('text');
			$task = new Task();
			$data['task'] = $task->where('slug',$slug)->get();
			
			$this->db->where('user_id',$this->session->userdata('id'))->where('task_id',$task->id)->update('roles_tasks_users',array('update'=>0));
		
			$data['users'] = $this->db->select('users.name, roles.role, roles_tasks_users.read')
														->from('roles_tasks_users')
														->join('roles','roles.id = roles_tasks_users.role_id')
														->join('users','users.id = roles_tasks_users.user_id')
														->join('tasks','tasks.id = roles_tasks_users.task_id')
														->where('tasks.id',$task->id)
														->get();
			
			$data['tr'] = $this->db
				->select('read,update,role_id')
				->where('user_id',$this->session->userdata('id'))
				->where('task_id',$task->id)
				->get('roles_tasks_users')
				->row();
				
			$tags = new Tag();
			$sidebar['etiquetas'] = $tags->get();
			$data['task_sidebar'] = TRUE;
			$this->template->write_view('content', 'tasks/view',$data);
			$this->template->write_view('sidebar', 'sidebar/menu',$this->sidebar());
			$this->template->render();
		}
		
		function marcar($marca,$task)
		{
			$this->db->where('user_id',$this->session->userdata('id'))->where('task_id',$task)->update('roles_tasks_users',array('read'=>$marca));
			redirect($this->agent->referrer());
		}
		
		function notify($what,$page = NULL)
		{
			$u = new User($this->session->userdata('id'));
			switch($what)
			{
				case 'new':
					$data['tasks'] = $u->task->where_join_field('user','read',1)->get_paged_iterated($page,20);
					break;
				case 'updated':
					$data['tasks'] = $u->task->where_join_field('user','update',1)->get_paged_iterated($page,20);
					break;
				case 'due':
					$data['tasks'] = $u->task->where('end_date < NOW()')->get_paged_iterated($page,20);
					break;
				case 'complete':
					$data['tasks'] = $u->task->where('status_id',4)->get_paged_iterated($page,20);
					break;
				case 'postponed':
					$data['tasks'] = $u->task->where('status_id',3)->get_paged_iterated($page,20);
					break;
			}
			
			$tags = new Tag();
			$data['tags'] = $tags->select('id,tag')->get();
			
			$role = new Role();
			$data['roles'] = $role->select('id,role')->get();
			
			$user = new User();
			$data['users'] = $user->select('id,username')->get();
			
			$types = new Type();
			$data['types'] = $types->select('id,type')->get();
			
			$status = new Status();
			$data['status'] = $status->select('id,status')->get();
			
			$this->template->write_view('content', 'tasks/index',$data);
			$this->template->write_view('sidebar', 'sidebar/menu',$this->sidebar());
			$this->template->render();
		}
		
		function periodical()
		{
			$uid = $this->session->userdata('id');
			$update['new'] = $this->db->from('roles_tasks_users')
									->where('read',1)
									->where('user_id',$uid)
									->count_all_results();
			
			$update['updates'] = $this->db->from('roles_tasks_users')
									->where('update',1)
									->where('user_id',$uid)
									->count_all_results();
			
			$this->db->where('status_id !=',2)
					->where('completed IS NULL')
					->where('end_date < NOW()')
					->update('tasks', array('status_id' => 2, 'updated' => mdate('%Y-%m-%d %H:%i')));
			
			$update['vencidas'] = $this->db->from('roles_tasks_users')
									->join('tasks','tasks.id = roles_tasks_users.task_id')
									->where('roles_tasks_users.user_id',$uid)
									->where('tasks.status_id',2)
									->count_all_results();
									
			$update['postergadas'] = $this->db->from('roles_tasks_users')
									->join('tasks','tasks.id = roles_tasks_users.task_id')
									->where('roles_tasks_users.user_id',$uid)
									->where('tasks.status_id',3)
									->count_all_results();	
			
			$update['complete'] = $this->db->from('roles_tasks_users')
									->join('tasks','tasks.id = roles_tasks_users.task_id')
									->where('roles_tasks_users.user_id',$uid)
									->where('tasks.status_id',4)
									->count_all_results();	
										
			echo $update = json_encode($update);
		}
		
		function delete_task($task)
		{
			$this->db->where('tasks.id',$task)->delete('tasks');
			$this->db->where('tags_tasks.task_id',$task)->delete('tags_tasks');
			$this->db->where('roles_tasks_users.task_id',$task)->delete('roles_tasks_users');
			$this->session->set_flashdata('msg','<p class="success">La TAP fue eliminada con éxito.</p>');
			redirect('tasks');
		}
		
		function add_comment($task)
		{
			$task = new Task($task);
			$c = new Comment();
			$c->user_id = $this->session->userdata('id');
			$c->comment = $_POST['comment'];
			$c->save($task);
			$this->db->where('task_id',$task->id)
					->where('user_id !=', $this->session->userdata('id'))
					->update('roles_tasks_users',array('update' => 1));
			redirect($this->agent->referrer());
		}
		
		function add_edit($id = FALSE, $dependency = FALSE)
		{
			if($id)
			{
				$data['id'] = $id;
				$data['task'] = new Task($id);
			}
			else 
			{
				$data['task'] = array(
									'subject' => '',
									'start_date' => '',
									'end_date' => '',
									'start_hour' => mdate('%H:%i %a'),
									'end_hour' => mdate('%H:%i %a'),
									'body' => '',
									'type_id' => 1,
									'tag_id' => ''
								);
			}
			
			$tags = new Tag();
			
			if(!$this->session->userdata('admin'))
			{
				$tags->where_related('tasks/user','id',$this->session->userdata('id'));
			}
			$tags->group_by('tag');
			
			$data['tags'] = $tags->get_iterated();
			
			if($dependency !== FALSE)
			{
				$data['task_id'] = $dependency;
			}
			
			$typ = new Type();
			$typ->get();
			
			foreach($typ as $ty)
			{
				$tps[$ty->id] = $ty->type;
			}
			
			$data['types'] = $tps;
			
			if($this->session->flashdata('errors')) $data['task'] = $this->session->flashdata('task');
			if($this->input->isAjax())
			{
				$this->load->view('tasks/form_add_edit',$data);
			}
			else
			{
				$this->template->write_view('content', 'tasks/form_add_edit',$data);
				$this->template->render();
			}
		}
		
		function save_task($id = FALSE, $dependency = FALSE)
		{
			if($_POST['end_date']) {
				$end_date = explode('/', $_POST['end_date']);
				$end = $end_date[2]."-".$end_date[1]."-".$end_date[0]." ".$_POST['end_hour'];
			}
			if($_POST['start_date'])
			{
				$start_date = explode('/', $_POST['start_date']);
				$start = $start_date[2]."-".$start_date[1]."-".$start_date[0]." ".$_POST['start_hour'];
			}
			
			$tags = explode(', ',$_POST['tags']);
			
			if($id)
			{				
				$task = new Task($id);
				
				$_POST['end_date'] = $end;
				$_POST['start_date'] = $start;
				
				$task->from_array($_POST,array(
										'subject',
										'start_date',
										'end_date',
										'body',
										'type_id',
										'tag_id'
									)
								);
								
				$task->validate();
				if($task->valid)
				{
					$task->save();
					$this->session->set_flashdata('msg','<p class="success">Los detalles fueron actualizados correctamente.</p>');
					redirect($_POST['url']);
				}
				else
				{
					$this->session->set_flashdata('errors',$task->error->all);
					$this->session->set_flashdata('task',$_POST);
					redirect($_POST['url']);
				}
			}
			else
			{				
				$task = new Task();
				
				$_POST['end_date'] = $end;
				$_POST['start_date'] = $start;
				
				$_POST['slug'] = uniqid()."-".url_title(strtolower($_POST['subject']));
				$_POST['user_id'] = $this->session->userdata('id');
				
				$task->from_array($_POST,array(
										'subject',
										'slug',
										'user_id',
										'status_id',
										'start_date',
										'end_date',
										'body',
										'type_id',
										'tag_id'
									)
								);
				
				$task->validate();
				if($task->valid)
				{	
					if(isset($_POST['task_id']))
					{
						$rel = new Task($_POST['task_id']);
						$task->save();
						$query = $this->db->query('SELECT LAST_INSERT_ID()');
						$row = $query->row_array();
						$insert = $row['LAST_INSERT_ID()'];
						$task->save_task($rel);
					}
					else
					{
						$task->save();
						$query = $this->db->query('SELECT LAST_INSERT_ID()');
						$row = $query->row_array();
						$insert = $row['LAST_INSERT_ID()'];
					}
					
					$data = array(
							'role_id' => 1,
							'user_id' => $_POST['user_id'],
							'task_id' => $insert,
							'read' => 0,
							'update' => 0
						);
					$this->db->insert('roles_tasks_users',$data);
					redirect('tasks/add_roles/'.$insert);
				}
				else
				{
					$this->session->set_flashdata('errors',$task->error->all);
					$this->session->set_flashdata('task',$_POST);
					redirect($_POST['url']);
				}
			}
		}
		
		function postpone($task)
		{
			if($_POST)
			{
				if($_POST['amount'])
				{
					$this->db->query('
									UPDATE tasks 
									SET status_id = 3, end_date = end_date
									+ INTERVAL '.$_POST['amount'].' '.$_POST['interval'].'
									WHERE slug = "'.$task.'"'
								);
					$this->session->set_flashdata('msg','<p class="success">La tarea fué postergada correctamente.</p>');
					redirect('tasks/postpone/'.$task);	
				}
				else
				{
					$this->session->set_flashdata('msg','<p class="error">Debe ingresar una cantidad.</p>');
					redirect('tasks/postpone/'.$task);
				}
			}
			$data['task'] = $task;
			$this->load->view('tasks/form_postpone',$data);
		}
		
		function change_status($id)
		{
			if($_POST)
			{
				$t = new Task($id);
				$t->status_id = $_POST['status_id'];
				switch($_POST['status_id'])
				{
					case '4':
						$t->completed = mdate('%Y-%m-%d %H:%i');
						break;
					default:
						$t->completed = NULL;
				}
				if($_POST['status_id'] == '4')
				{
					
				}
				$t->save();
				$this->session->set_flashdata('msg','<p class="success">Se cambió el estado a <stron>'.$t->status->status.'</stron></p>');
				redirect('tasks/change_status/'.$t->id);
			}
			else
			{
				$data['task'] = new Task($id);
				$status = new Status();
				$data['statuses'] = $status->get();
				$this->load->view('tasks/form_status',$data);
			}
		}
		
		function add_roles($task)
		{
			if($_POST)
			{
				$data = array(
							'role_id' => $_POST['role_id'],
							'user_id' => $_POST['user_id'],
							'task_id' => $task,
							'read' => 1,
							'update' => 0,
						);
				$this->db->insert('roles_tasks_users',$data);
				$this->session->set_flashdata('post',TRUE);
				redirect('tasks/add_roles/'.$task);
			}
			else
			{
				$role = new Role();
				$data['roles'] = $role->select('id,role')->get();
				
				$user = new User();
				$data['users'] = $user->select('id,name')->get();
				
				$data['dt'] = new Task($task);
				
				$data['task'] = $this->db->select('roles_tasks_users.id AS rid, users.name, users.id AS uid, roles.role, roles_tasks_users.task_id AS id')
							->from('roles_tasks_users')
							->join('roles','roles.id = roles_tasks_users.role_id')
							->join('users','users.id = roles_tasks_users.user_id')
							->where('task_id',$task)
							->get();
				
				$this->load->view('tasks/form_roles', $data);
			}
		}
		
		function remove_role($id,$task)
		{
			$this->db->where('id',$id);
			$this->db->delete('roles_tasks_users');
			redirect('tasks/add_roles/'.$task);
		}
		
		function test($page = NULL)
		{
			$this->load->helper('date');
			$this->load->helper('text');
			
			$tasks = new Task();
			$data['tasks'] = $tasks->order_by('end_date ASC')->get_paged_iterated($page,5);
			
			$this->load->view('test',$data);
		}
				
		function formulario()
		{
			if($_POST)
			{
				$task = new Task();
				echo anchor('tasks/formulario','Volver','class="nyroModal"');
			}
			else
			{
				$this->load->helper('form');
				$this->load->view('form');
			}
		}
	
	}