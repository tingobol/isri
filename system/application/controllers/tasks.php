<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Tasks extends Controller
	{
	
		function __construct()
		{
			parent::Controller();
		//	$this->output->enable_profiler(TRUE);
			if(! $this->session->userdata('id')) redirect('auth/login');
	    }
	    
	    function mensajes()
	    {
	    	$mensajes['mensajes'] = $this->db->from('chat')
								->where('to',$this->session->userdata('username'))
								->where('recd',0)
								->count_all_results();
			return $mensajes;
	    }
		
		function sidebar()
		{
			$uid = $this->session->userdata('id');
			$tags = new Tag();

			$sidebar['etiquetas'] = $tags->where('deleted',0)
										->where_related('task/recurso','user_id',$uid)
										->where_related('task/recurso','role_id <',4)
										->where_related('task','status_id <',4)
										->group_by('tag')
										->get_iterated();
				
			$t = new Task();
			
			$sidebar['nuevas'] = $t->where_related_recurso('read',1)
										->where_related_recurso('user_id',$uid)
										->where_related_recurso('role_id <',4)
										->count();

			$t = new Task();
			$sidebar['updates'] = $t->where_related_recurso('update',1)
											->where_related_recurso('user_id',$uid)
											->where_related_recurso('role_id <',4)
											->count();
			
			$t = new Task();
			$sidebar['vencidas'] = $t->where('status_id',2)
											->where_related_recurso('user_id',$uid)
											->where_related_recurso('role_id <',4)
											->count();
			
			$t = new Task();				
			$sidebar['postergadas'] = $t->where('status_id',3)
											->where_related_recurso('user_id',$uid)
											->where_related_recurso('role_id <',4)
											->count();
			
			$t = new Task();
			$sidebar['complete'] = $t->where('status_id',4)
											->where_related_recurso('user_id',$uid)
											->where_related_recurso('role_id <',4)
											->count();
			$t = new Task();
			$sidebar['notificaciones'] = $t->where_related_recurso('user_id',$uid)
											->where_related_recurso('role_id',4)
											->count();
											
			$t = new Task();
			$sidebar['all'] = $t->where_related_recurso('user_id',$uid)
											->count();
											
			$t = new Task();
			$sidebar['activas'] = $t->where('status_id',1)
										->where_related_recurso('user_id',$uid)
										->where_related_recurso('role_id <',4)
										->count();	
										
			$t = new Task();
			$sidebar['otros'] = $t->query('SELECT * FROM tasks WHERE id NOT IN (SELECT task_id FROM roles_tasks_users WHERE user_id = ?)',$uid)->count();
									
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
		
		function notify($what,$page = NULL)
		{
			$uid = $this->session->userdata('id');
			$t = new Task();
			switch($what)
			{
				case 'new':
					$data['tasks'] = $t->where_related_recurso('read',1)
											->where_related_recurso('user_id',$uid)
											->where_related_recurso('role_id <',4)
											->get_paged_iterated($page,20);
					break;
				case 'activas':
					$data['tasks'] = $t->where('status_id',1)
											->where_related_recurso('user_id',$uid)
											->where_related_recurso('role_id <',4)
											->get_paged_iterated($page,20);
					break;
				case 'updated':
					$data['tasks'] = $t->where_related_recurso('update',1)
											->where_related_recurso('user_id',$uid)
											->where_related_recurso('role_id <',4)
											->get_paged_iterated($page,20);
					break;
				case 'due':
					$data['tasks'] = $t->where('status_id',2)
											->where_related_recurso('user_id',$uid)
											->where_related_recurso('role_id <',4)
											->get_paged_iterated($page,20);
					break;
				case 'complete':
					$data['tasks'] = $t->where('status_id',4)
											->where_related_recurso('user_id',$uid)
											->where_related_recurso('role_id <',4)
											->get_paged_iterated($page,20);
					break;
				case 'postponed':
					$data['tasks'] = $t->where('status_id',3)
											->where_related_recurso('user_id',$uid)
											->where_related_recurso('role_id <',4)
											->get_paged_iterated($page,20);
					break;
				case 'notificado':
					$data['tasks'] = $t->where_related_recurso('user_id',$uid)
											->where_related_recurso('role_id',4)
											->get_paged_iterated($page,20);	
					break;
				case 'all':
					$data['tasks'] = $t->where('status_id',1)
											->where_related_recurso('user_id',$uid)
											->get_paged_iterated($page,20);	
					break;
				case 'otros':
					$data['tasks'] = $t->query('SELECT * FROM tasks WHERE user_id != '.$uid.' AND id NOT IN (SELECT task_id FROM roles_tasks_users WHERE user_id = '.$uid.')')->get_paged_iterated($page,20);
					break;
			}
			$tags = new Tag();
			$data['tags'] = $tags->select('id,tag')->order_by('tag')->get_iterated();
			
			$role = new Role();
			$data['roles'] = $role->select('id,role')->order_by('role')->get_iterated();
			
			$user = new User();
			$data['users'] = $user->select('id,name')->order_by('name')->get_iterated();
			
			$types = new Type();
			$data['types'] = $types->select('id,type')->order_by('type')->get_iterated();
			
			$status = new Status();
			$data['status'] = $status->select('id,status')->order_by('status')->get_iterated();
			
			$branches = new Branch();
			$data['branches'] = $branches->select('id,name')->order_by('name')->get_iterated();
			
			$this->template->write_view('content', 'tasks/index',$data);
			$this->template->write_view('menu', 'template',$this->mensajes());
			$this->template->write_view('sidebar', 'sidebar/menu',$this->sidebar());
			$this->template->render();
		}
		
		function periodical()
		{
			$uid = $this->session->userdata('id');
			
			$t = new Task();
			$update['activas'] = $t->where('status_id',1)
										->where_related_recurso('user_id',$uid)
										->where_related_recurso('role_id <',4)
										->count();
			
			$t = new Task();
			$update['new'] = $t->where_related_recurso('read',1)
										->where_related_recurso('user_id',$uid)
										->where_related_recurso('role_id <',4)
										->count();
			$t = new Task();
			$update['updates'] = $t->where_related_recurso('update',1)
											->where_related_recurso('user_id',$uid)
											->where_related_recurso('role_id <',4)
											->count();
			
			$this->db->where('status_id !=',2)
					->where('completed IS NULL')
					->where('end_date < NOW()')
					->update('tasks', array('status_id' => 2, 'updated' => mdate('%Y-%m-%d %H:%i')));
			
			$t = new Task();
			$update['vencidas'] = $t->where('status_id',2)
											->where_related_recurso('user_id',$uid)
											->where_related_recurso('role_id <',4)
											->count();
			$t = new Task();					
			$update['postergadas'] = $t->where('status_id',3)
											->where_related_recurso('user_id',$uid)
											->where_related_recurso('role_id <',4)
											->count();
			$t = new Task();
			$update['complete'] = $t->where('status_id',4)
											->where_related_recurso('user_id',$uid)
											->where_related_recurso('role_id <',4)
											->count();
											
			$t = new Task();
			$update['notificaciones'] = $t->where_related_recurso('role_id',4)
											->where_related_recurso('user_id',$uid)
											->count();
											
			$t = new Task();
			$update['all'] = $t->where_related_recurso('user_id',$uid)
											->count();
											
			$t = new Task();
			$update['otros'] = $t->query('SELECT * FROM tasks WHERE id NOT IN (SELECT task_id FROM roles_tasks_users WHERE user_id = ?)',$uid)->count();
										
			echo $update = json_encode($update);
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
			
			$this->template->write_view('menu', 'template',$this->mensajes());
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
			$data['tags'] = $tags->select('id,tag')->order_by('tag')->get_iterated();
			
			$role = new Role();
			$data['roles'] = $role->select('id,role')->order_by('role')->get_iterated();
			
			$user = new User();
			$data['users'] = $user->select('id,name')->order_by('name')->get_iterated();
			
			$types = new Type();
			$data['types'] = $types->select('id,type')->order_by('type')->get_iterated();
			
			$status = new Status();
			$data['status'] = $status->select('id,status')->order_by('status')->get_iterated();
			
			$branches = new Branch();
			$data['branches'] = $branches->select('id,name')->order_by('name')->get_iterated();
			
			$this->template->write_view('menu', 'template',$this->mensajes());
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
			if($this->input->post('role_id') != 0) $tasks->where_related_recurso('role_id',$this->input->post('role_id'));
			if($this->input->post('status_id') != 0) $tasks->where('status_id',$this->input->post('status_id'));
			if($this->input->post('type_id') != 0) $tasks->where('type_id',$this->input->post('type_id'));
			if($this->input->post('tag_id') != 0) $tasks->where('tag_id',$this->input->post('tag_id'));
			if($this->input->post('branch_id') != 0) $tasks->where('branch_id',$this->input->post('branch_id'));
			
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
				if($t->end_date < time()) {
					echo "Vencida";
				}
				else
				{
					$diff = round(($t->end_date - time()) / (60*60*24),1);
					if(strstr($diff,'.'))
					{
						list($days,$hours) = explode('.',$diff);
					}
					else {
						$hours = 0;
						$days = $diff;
					}
					if($days > 7)
					{
						$p = 100;
					}
					else
					{
						$p = ($days/7*100);
					}
					switch ($p) {
						case $p < 30:
							$c = 'rojo';
							break;
						case $p < 60:
							$c = 'amarillo';
							break;
						default:
							$c = 'verde';
						
					}
					echo '<div class="progress">
						<div class="meter '.$c.'" style="width:'.$p.'%"></div>
					</div>
					<span class="days">'.$days.'d ';
					if($hours) echo $hours*0.24.'hs';
					echo '</span>';
				}
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
									->where_related_user('id',$this->session->userdata('id'))
									->where_related_role('id <',4)
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
			
			
			$this->template->write_view('menu', 'template',$this->mensajes());
			$data['calendar'] = $this->calendar->generate($y,$m,$calendario);
			$this->template->write_view('content', 'tasks/index_calendar',$data);
		}
		
		function tag($tag,$page = NULL)
		{
			$tasks = new Task();
			$data['tasks'] = $tasks
							->where_related_recurso('user_id',$this->session->userdata('id'))
							->where_related_tag('slug',$tag)
							->get_paged_iterated($page,20);
			
			$tag_name = new Tag();
			$data['tag_name'] = $tag_name->select('tag')->where('slug',$tag)->get();
			
			$tags = new Tag();
			$data['tags'] = $tags->select('id,tag')->order_by('tag')->get_iterated();
			
			$role = new Role();
			$data['roles'] = $role->select('id,role')->order_by('role')->get_iterated();
			
			$user = new User();
			$data['users'] = $user->select('id,name')->order_by('name')->get_iterated();
			
			$types = new Type();
			$data['types'] = $types->select('id,type')->order_by('type')->get_iterated();
			
			$status = new Status();
			$data['status'] = $status->select('id,status')->order_by('status')->get_iterated();
			
			$branches = new Branch();
			$data['branches'] = $branches->select('id,name')->order_by('name')->get_iterated();
			
			$this->template->write_view('sidebar', 'sidebar/menu',$this->sidebar());
			$this->template->write_view('menu', 'template',$this->mensajes());
			$this->template->write_view('content', 'tasks/index',$data);
			$this->template->render();
		}
		
		function view($slug = NULL)
		{
			$this->load->helper('date');
			$this->load->helper('text');
			$task = new Task();
			$t = $data['task'] = $task->where('slug',$slug)->get();
			
			$this->db->where('user_id',$this->session->userdata('id'))->where('task_id',$task->id)->update('roles_tasks_users',array('update'=>0));
			
			$r = new Recurso();
			$data['recursos'] = $r->where('task_id',$t->id)->get();
			
			$data['tr'] = $this->db
				->select('read,update,role_id')
				->where('user_id',$this->session->userdata('id'))
				->where('task_id',$task->id)
				->get('roles_tasks_users')
				->row();
				
			$tags = new Tag();
			$sidebar['etiquetas'] = $tags->get();
			$data['task_sidebar'] = TRUE;
			
			$prev = new Task();
			$data['prev'] = $prev->where('id >',$task->id)
							->where('status_id !=',4)
							->where_related_recurso('user_id',$this->session->userdata('id'))
							->where_related_recurso('role_id <',4)
							->where_related_recurso('read',1)
							->order_by('type_id ASC, end_date ASC')
							->limit(1)->get();
			
			$next = new Task();
			$data['next'] = $next->where('id <',$task->id)
							->where('status_id !=',4)
							->where_related_recurso('user_id',$this->session->userdata('id'))
							->where_related_recurso('role_id <',4)
							->where_related_recurso('read',1)
							->order_by('type_id ASC, end_date ASC')
							->limit(1)->get();
			
			$this->template->write_view('content', 'tasks/view',$data);
			$this->template->write_view('menu', 'template',$this->mensajes());
			$this->template->write_view('sidebar', 'sidebar/menu',$this->sidebar());
			$this->template->render();
		}
		
		function marcar($marca,$task)
		{
			$this->db->where('user_id',$this->session->userdata('id'))->where('task_id',$task)->update('roles_tasks_users',array('read'=>$marca));
			redirect($this->agent->referrer());
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
									'branch_id' => '',
									'tag_id' => ''
								);
			}
			
			$tags = new Tag();

/* 			Si se descomenta esta línea, muestra únicamente las categorías donde el usuario
			estuvo involucrado en una TAP. Ese no es el comportamiento requerido, por eso
			esta línea está comentada.
			
			if(!$this->session->userdata('admin'))
			{
				$tags->where_related('tasks/user','id',$this->session->userdata('id'));
			}
			$tags->group_by('tag');
*/			
			
			$data['tags'] = $tags->where('deleted',0)->get_iterated();
			
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
			
			if($id)
			{				
				$task = new Task($id);
				
				$_POST['end_date'] = $end;
				$_POST['start_date'] = $start;
				$_POST['subject'] = strtoupper($_POST['subject']);
				
				$task->from_array($_POST,array(
										'subject',
										'start_date',
										'end_date',
										'body',
										'type_id',
										'branch_id',
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
										'branch_id',
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
				foreach ($_POST['user_id'] as $uid)
				{
					$data = array(
							'role_id' => $_POST['role_id'],
							'user_id' => $uid,
							'task_id' => $task,
							'read' => 1,
							'update' => 0,
						);
					$this->db->insert('roles_tasks_users',$data);
				}
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
		
	}
