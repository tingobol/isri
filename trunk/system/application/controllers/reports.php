<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Reports extends Controller
	{
	
		function __construct()
		{
			parent::Controller();
			$this->load->plugin('charts');
	    }
		
		function index()
		{
			if($this->input->post('date_to') || $this->input->post('date_from'))
			{
				if($this->input->post('date_to') != '')
				{
					$to = explode('/', $_POST['date_to']);
					$date_to = $to[2]."-".$to[1]."-".$to[0];
				}
				else $date_to = date('Y-m-d');
				if($this->input->post('date_from') != '')
				{
					$from = explode('/', $_POST['date_from']);
					$date_from = $from[2]."-".$from[1]."-".$from[0];
				}
				else $date_from = date('Y-m-d');
			}
			else
			{
				$date_to = date('Y-m-d');
				$date_from = date('Y-m-d');
			}
			$data['prioridad'] = $this->prioridad($date_from,$date_to);
			$data['status'] = $this->status($date_from,$date_to);
			$data['users_status'] = $this->users_status($date_from,$date_to);
			$data['branches_status'] = $this->branches_status($date_from,$date_to);
			$data['branches_priority'] = $this->branches_priority($date_from,$date_to);
			$data['users_priority'] = $this->users_priority($date_from,$date_to);
			$this->template->write_view('sidebar', 'sidebar/menu',$this->sidebar());
			$this->template->write_view('content', 'reports/index',$data);
			$this->template->render();
		}
		
		function sidebar()
		{
			$uid = $this->session->userdata('id');
			$tags = new Tag();
			$sidebar['etiquetas'] = $tags
				->where('deleted',0)
				->where_related('tasks/user','id',$this->session->userdata('id'))
				->where_related_task('status_id <',4)
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
		
		function prioridad($date_from,$date_to)
		{
			$sql = "SELECT count(tasks.type_id) AS tasks, types.type FROM tasks
					JOIN types ON types.id = tasks.type_id
					WHERE DATE(created) BETWEEN '$date_from' AND '$date_to'
					GROUP BY types.type";
					
			$tasks = $this->db->query($sql);
			
			$FC =  FusionCharts("Column2D","350","200");
			
			foreach($tasks->result() as $t)
			{
				$FC->addChartData($t->tasks,"name=".$t->type);
			}
			
			$strParam='canvasBorderThickness=1; showPercentageValues=1; decimalPrecision=1; showNames=1; formatNumberScale=1; canvasBorderColor=CCCCCC; formatNumber=0; animation=1';
			$FC->setChartParams($strParam);
			$FC->setChartMessage("ChartNoDataText=No hay datos, intente cambiando el filtro por fechas; PBarLoadingText=Cargando datos...");
			return $FC->renderChart(false,false);
		}
		
		function status($date_from,$date_to)
		{
			$sql = "SELECT count(tasks.status_id) AS tasks, statuses.status FROM tasks
					JOIN statuses ON statuses.id = tasks.status_id
					WHERE DATE(created) BETWEEN '$date_from' AND '$date_to'
					GROUP BY statuses.status ";
					
			$tasks = $this->db->query($sql);
			
			$FC =  FusionCharts("Column2D","350","200");
			
			foreach($tasks->result() as $t)
			{
				$FC->addChartData($t->tasks,"name=".$t->status);
			}
			
			$strParam='canvasBorderThickness=1; showPercentageValues=1; decimalPrecision=1; showNames=1; formatNumberScale=1; canvasBorderColor=CCCCCC; formatNumber=0; animation=1';
			$FC->setChartParams($strParam);
			$FC->setChartMessage("ChartNoDataText=No hay datos, intente cambiando el filtro por fechas; PBarLoadingText=Cargando datos...");
			return $FC->renderChart(false,false);
		}
		
		function users_status($date_from,$date_to)
		{
			$sql = "SELECT
						users.username,
						SUM(IF(status_id = 1,1,0)) AS activas,
						SUM(IF(status_id = 2,1,0)) AS vencidas,
						SUM(IF(status_id = 3,1,0)) AS postergadas,
						SUM(IF(status_id = 4,1,0)) AS finalizadas,
						COUNT(1) AS total
					FROM roles_tasks_users
					JOIN tasks ON tasks.id = roles_tasks_users.task_id
					JOIN users ON users.id = roles_tasks_users.user_id
					WHERE roles_tasks_users.role_id != 4
					AND date(tasks.created) BETWEEN '$date_from' AND '$date_to'
					GROUP BY roles_tasks_users.user_id";
					
			$data = $this->db->query($sql);
			
			$FC =  FusionCharts("MSColumn2D","2000","200");
			
			$cat = array();
			foreach($data->result() as $c)
			{
				if(!in_array($c->username,$cat))
				{
					$cat[] = $c->username;
				}
			}
			
			foreach($cat as $c)
			{
				$FC->addCategory($c);
			}
			
			$FC->addDataset('Activas');
			foreach($data->result() as $e)
			{
				$FC->addChartData($e->activas);
			}
			
			$FC->addDataset('Vencidas');
			foreach($data->result() as $i)
			{
				$FC->addChartData($i->vencidas);
			}
			
			$FC->addDataset('Postergadas');
			foreach($data->result() as $i)
			{
				$FC->addChartData($i->postergadas);
			}
			
			$FC->addDataset('Finalizadas');
			foreach($data->result() as $i)
			{
				$FC->addChartData($i->finalizadas);
			}
			
			$FC->addDataset('Total');
			foreach($data->result() as $i)
			{
				$FC->addChartData($i->total);
			}
			
			$strParam='canvasBorderThickness=1; showPercentageValues=1; decimalPrecision=1; showNames=1; formatNumberScale=1; canvasBorderColor=CCCCCC; formatNumber=0; animation=1';
			$FC->setChartParams($strParam);
			$FC->setChartMessage("ChartNoDataText=No hay datos, intente cambiando el filtro por fechas; PBarLoadingText=Cargando datos...");
			return $FC->renderChart(false,false);
		}
		
		function branches_status($date_from,$date_to)
		{
			$sql = "SELECT
						branches.name,
						SUM(IF(status_id = 1,1,0)) AS activas,
						SUM(IF(status_id = 2,1,0)) AS vencidas,
						SUM(IF(status_id = 3,1,0)) AS postergadas,
						SUM(IF(status_id = 4,1,0)) AS finalizadas,
						COUNT(1) AS total
					FROM roles_tasks_users
					JOIN tasks ON tasks.id = roles_tasks_users.task_id
					JOIN branches ON branches.id = tasks.branch_id
					WHERE roles_tasks_users.role_id != 4
					AND date(tasks.created) BETWEEN '$date_from' AND '$date_to'
					GROUP BY roles_tasks_users.user_id";
					
			$data = $this->db->query($sql);
			
			$FC =  FusionCharts("MSColumn2D","2000","200");
			
			$cat = array();
			foreach($data->result() as $c)
			{
				if(!in_array($c->name,$cat))
				{
					$cat[] = $c->name;
				}
			}
			
			foreach($cat as $c)
			{
				$FC->addCategory($c);
			}
			
			$FC->addDataset('Activas');
			foreach($data->result() as $e)
			{
				$FC->addChartData($e->activas);
			}
			
			$FC->addDataset('Vencidas');
			foreach($data->result() as $i)
			{
				$FC->addChartData($i->vencidas);
			}
			
			$FC->addDataset('Postergadas');
			foreach($data->result() as $i)
			{
				$FC->addChartData($i->postergadas);
			}
			
			$FC->addDataset('Finalizadas');
			foreach($data->result() as $i)
			{
				$FC->addChartData($i->finalizadas);
			}
			
			$FC->addDataset('Total');
			foreach($data->result() as $i)
			{
				$FC->addChartData($i->total);
			}
			
			$strParam='canvasBorderThickness=1; showPercentageValues=1; decimalPrecision=1; showNames=1; formatNumberScale=1; canvasBorderColor=CCCCCC; formatNumber=0; animation=1';
			$FC->setChartParams($strParam);
			$FC->setChartMessage("ChartNoDataText=No hay datos, intente cambiando el filtro por fechas; PBarLoadingText=Cargando datos...");
			return $FC->renderChart(false,false);
		}
		
		function users_priority($date_from,$date_to)
		{
			$sql = "SELECT
						users.username,
						SUM(IF(type_id = 1,1,0)) AS urgente,
						SUM(IF(type_id = 2,1,0)) AS muy_alta,
						SUM(IF(type_id = 3,1,0)) AS alta,
						SUM(IF(type_id = 4,1,0)) AS media,
						SUM(IF(type_id = 5,1,0)) AS baja,
						COUNT(1) AS total
					FROM roles_tasks_users
					JOIN tasks ON tasks.id = roles_tasks_users.task_id
					JOIN users ON users.id = roles_tasks_users.user_id
					WHERE roles_tasks_users.role_id != 4
					AND date(tasks.created) BETWEEN '$date_from' AND '$date_to'
					GROUP BY roles_tasks_users.user_id";
					
			$data = $this->db->query($sql);
			
			$FC =  FusionCharts("MSColumn2D","2000","200");
			
			$cat = array();
			foreach($data->result() as $c)
			{
				if(!in_array($c->username,$cat))
				{
					$cat[] = $c->username;
				}
			}
			
			foreach($cat as $c)
			{
				$FC->addCategory($c);
			}
			
			$FC->addDataset('Urgente');
			foreach($data->result() as $e)
			{
				$FC->addChartData($e->urgente);
			}
			
			$FC->addDataset('Muy alta');
			foreach($data->result() as $i)
			{
				$FC->addChartData($i->muy_alta);
			}
			
			$FC->addDataset('Alta');
			foreach($data->result() as $i)
			{
				$FC->addChartData($i->alta);
			}
			
			$FC->addDataset('Media');
			foreach($data->result() as $i)
			{
				$FC->addChartData($i->media);
			}
			
			$FC->addDataset('Baja');
			foreach($data->result() as $i)
			{
				$FC->addChartData($i->baja);
			}
			
			$FC->addDataset('Total');
			foreach($data->result() as $i)
			{
				$FC->addChartData($i->total);
			}
			
			$strParam='canvasBorderThickness=1; showPercentageValues=1; decimalPrecision=1; showNames=1; formatNumberScale=1; canvasBorderColor=CCCCCC; formatNumber=0; animation=1';
			$FC->setChartParams($strParam);
			$FC->setChartMessage("ChartNoDataText=No hay datos, intente cambiando el filtro por fechas; PBarLoadingText=Cargando datos...");
			return $FC->renderChart(false,false);
		}
		
		function branches_priority($date_from,$date_to)
		{
			$sql = "SELECT
						branches.name,
						SUM(IF(type_id = 1,1,0)) AS urgente,
						SUM(IF(type_id = 2,1,0)) AS muy_alta,
						SUM(IF(type_id = 3,1,0)) AS alta,
						SUM(IF(type_id = 4,1,0)) AS media,
						SUM(IF(type_id = 5,1,0)) AS baja,
						COUNT(1) AS total
					FROM roles_tasks_users
					JOIN tasks ON tasks.id = roles_tasks_users.task_id
					JOIN branches ON branches.id = tasks.branch_id
					WHERE roles_tasks_users.role_id != 4
					AND date(tasks.created) BETWEEN '$date_from' AND '$date_to'
					GROUP BY roles_tasks_users.user_id";
					
			$data = $this->db->query($sql);
			
			$FC =  FusionCharts("MSColumn2D","2000","200");
			
			$cat = array();
			foreach($data->result() as $c)
			{
				if(!in_array($c->name,$cat))
				{
					$cat[] = $c->name;
				}
			}
			
			foreach($cat as $c)
			{
				$FC->addCategory($c);
			}
			
			$FC->addDataset('Urgente');
			foreach($data->result() as $e)
			{
				$FC->addChartData($e->urgente);
			}
			
			$FC->addDataset('Muy alta');
			foreach($data->result() as $i)
			{
				$FC->addChartData($i->muy_alta);
			}
			
			$FC->addDataset('Alta');
			foreach($data->result() as $i)
			{
				$FC->addChartData($i->alta);
			}
			
			$FC->addDataset('Media');
			foreach($data->result() as $i)
			{
				$FC->addChartData($i->media);
			}
			
			$FC->addDataset('Baja');
			foreach($data->result() as $i)
			{
				$FC->addChartData($i->baja);
			}
			
			$FC->addDataset('Total');
			foreach($data->result() as $i)
			{
				$FC->addChartData($i->total);
			}
			
			$strParam='canvasBorderThickness=1; showPercentageValues=1; decimalPrecision=1; showNames=1; formatNumberScale=1; canvasBorderColor=CCCCCC; formatNumber=0; animation=1';
			$FC->setChartParams($strParam);
			$FC->setChartMessage("ChartNoDataText=No hay datos, intente cambiando el filtro por fechas; PBarLoadingText=Cargando datos...");
			return $FC->renderChart(false,false);
		}
	
	}