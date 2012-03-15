<?php

/**
 * User DataMapper Model
 *
 * Use this basic model as a user for creating new models.
 * It is not recommended that you include this file with your application,
 * especially if you use a User library (as the classes may collide).
 *
 * To use:
 * 1) Copy this file to the lowercase name of your new model.
 * 2) Find-and-replace (case-sensitive) 'User' with 'Your_model'
 * 3) Find-and-replace (case-sensitive) 'user' with 'your_model'
 * 4) Find-and-replace (case-sensitive) 'users' with 'your_models'
 * 5) Edit the file as desired.
 *
 * @license		MIT License
 * @category	Models
 * @author		Phil DeJarnett
 * @link		http://www.overzealous.com
 */
class User extends DataMapper {

	var $has_one = array('branch');

	var $has_many = array(
			'comment' => array(
				'class' => 'comment',
				'join_table' => 'comments'
			),
			'task' => array(
				'join_table' => 'roles_tasks_users'
			),
			'role' => array(
				'join_table' => 'roles_tasks_users'
			),
			'created_task' => array(
				'class' => 'task',
				'other_field' => 'user',
				'join_table' => 'tasks'
			),
			'recurso' => array(
				'join_table' => 'roles_tasks_users'
			)
		);

	var $validation = array(
		'name' => array(
			'rules' => array('required', 'max_length' => 120, 'min_length' => 5),
			'label' => 'Nombre'
		),
		'username' => array(
			'rules' => array('required', 'max_length' => 25, 'min_length' => 5),
			'label' => 'Nombre de usuario'
		),
		'password' => array(
			'rules' => array('min_length' => 6, 'encrypt'),
			'label' => 'Contraseña'
		),
		'confirm' => array(
			'rules' => array('encrypt', 'required', 'matches' => 'password'),
			'label' => 'Confirmar contraseña'
		),
		'email' => array(
			'rules' => array('required', 'max_length' => 120, 'min_length' => 5, 'valid_email'),
			'label' => 'Email'
		)
	);
	
	var $default_order_by = array('name' => 'asc');

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
	function get_open_users()
	{
		return $this->where('status <>', 'closed')->get();
	}
	*/
	
	function _encrypt($field)
	{
		if (!empty($this->{$field}))
        {
            $this->{$field} = sha1($this->{$field});
        }
	}

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

/* End of file user.php */
/* Location: ./application/models/user.php */
