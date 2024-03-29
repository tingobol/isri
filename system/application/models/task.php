<?php

/**
 * Task DataMapper Model
 *
 * Use this basic model as a task for creating new models.
 * It is not recommended that you include this file with your application,
 * especially if you use a Task library (as the classes may collide).
 *
 * To use:
 * 1) Copy this file to the lowercase name of your new model.
 * 2) Find-and-replace (case-sensitive) 'Task' with 'Your_model'
 * 3) Find-and-replace (case-sensitive) 'task' with 'your_model'
 * 4) Find-and-replace (case-sensitive) 'tasks' with 'your_models'
 * 5) Edit the file as desired.
 *
 * @license		MIT License
 * @category	Models
 * @author		Phil DeJarnett
 * @link		http://www.overzealous.com
 */
class Task extends DataMapper {

	// Uncomment and edit these two if the class has a model name that
	//   doesn't convert properly using the inflector_helper.
	// var $model = 'task';
	// var $table = 'tasks';

	// You can override the database connections with this option
	// var $db_params = 'db_config_name';

	// --------------------------------------------------------------------
	// Relationships
	//   Configure your relationships below
	// --------------------------------------------------------------------

	// Insert related models that Task can have just one of.
	var $has_one = array(
			'type',
			'tag',
			'status',
			'branch',
			'creator' => array(
				'class' => 'user',
				'other_field' => 'created_task'
			)
		);

	// Insert related models that Task can have more than one of.
	var $has_many = array(
			'comment',
			'role' => array(
				'join_table' => 'roles_tasks_users'
			),
			'user' => array(
				'join_table' => 'roles_tasks_users'
			),
			'relatedtask' => array(
				'class' => 'task',
				'other_field' => 'task'
			),
			'task' => array(
				'other_field' => 'relatedtask'
			),
			'recurso'
		);

	/* Relationship Examples
	 * For normal relationships, simply add the model name to the array:
	 *   $has_one = array('user'); // Task has one User
	 *
	 * For complex relationships, such as having a Creator and Editor for
	 * Task, use this form:
	 *   $has_one = array(
	 *   	'creator' => array(
	 *   		'class' => 'user',
	 *   		'other_field' => 'created_task'
	 *   	)
	 *   );
	 *
	 * Don't forget to add 'created_task' to User, with class set to
	 * 'task', and the other_field set to 'creator'!
	 *
	 */

	// --------------------------------------------------------------------
	// Validation
	//   Add validation requirements, such as 'required', for your fields.
	// --------------------------------------------------------------------
	
	var $validation = array(
		'subject' => array(
			'label' => 'asunto',
			'rules' => array('required')
		),
		'start_date' => array(
			'label' => 'fecha de inicio',
			'rules' => array('required'),
			'get_rules' => array('strtotime')
		),
		'end_date' => array(
			'label' => 'fecha de vencimiento',
			'rules' => array('required'),
			'get_rules' => array('strtotime')
		),
		'body' => array(
			'label' => 'descripcion',
			'rules' => array('required')
		),
		'completed' => array(
			'get_rules' => array('strtotime')
		),
		'created' => array(
			'get_rules' => array('strtotime')
		),
		'updated' => array(
			'get_rules' => array('strtotime')
		)
	);

	// --------------------------------------------------------------------
	// Default Ordering
	//   Uncomment this to always sort by 'name', then by
	//   id descending (unless overridden)
	// --------------------------------------------------------------------

	// var $default_order_by = array('name', 'id' => 'desc');

	// --------------------------------------------------------------------

	/**
	 * Constructor: calls parent constructor
	 */
    function __construct($id = NULL)
	{
		parent::__construct($id);
    }

	// --------------------------------------------------------------------
	// Post Model Initialisation
	//   Add your own custom initialisation code to the Model
	// The parameter indicates if the current config was loaded from cache or not
	// --------------------------------------------------------------------
	function post_model_init($from_cache = FALSE)
	{
	}

	// --------------------------------------------------------------------
	// Custom Methods
	//   Add your own custom methods here to enhance the model.
	// --------------------------------------------------------------------

	/* Example Custom Method
	function get_open_tasks()
	{
		return $this->where('status <>', 'closed')->get();
	}
	*/

	// --------------------------------------------------------------------
	// Custom Validation Rules
	//   Add custom validation rules for this model here.
	// --------------------------------------------------------------------

	/* Example Rule
	function _convert_written_numbers($field, $parameter)
	{
	 	$nums = array('one' => 1, 'two' => 2, 'three' => 3);
	 	if(in_array($this->{$field}, $nums))
		{
			$this->{$field} = $nums[$this->{$field}];
	 	}
	}
	*/
}

/* End of file task.php */
/* Location: ./application/models/task.php */
