<?php

/**
 * Comment DataMapper Model
 *
 * Use this basic model as a comment for creating new models.
 * It is not recommended that you include this file with your application,
 * especially if you use a Comment library (as the classes may collide).
 *
 * To use:
 * 1) Copy this file to the lowercase name of your new model.
 * 2) Find-and-replace (case-sensitive) 'Comment' with 'Your_model'
 * 3) Find-and-replace (case-sensitive) 'comment' with 'your_model'
 * 4) Find-and-replace (case-sensitive) 'comments' with 'your_models'
 * 5) Edit the file as desired.
 *
 * @license		MIT License
 * @category	Models
 * @author		Phil DeJarnett
 * @link		http://www.overzealous.com
 */
class Comment extends DataMapper {

	// Uncomment and edit these two if the class has a model name that
	//   doesn't convert properly using the inflector_helper.
	// var $model = 'comment';
	// var $table = 'comments';

	// You can override the database connections with this option
	// var $db_params = 'db_config_name';

	// --------------------------------------------------------------------
	// Relationships
	//   Configure your relationships below
	// --------------------------------------------------------------------

	// Insert related models that Comment can have just one of.
	var $has_one = array('user','task');

	// Insert related models that Comment can have more than one of.
	var $has_many = array();
	
	var $default_order_by = array('created' => 'desc');

	/* Relationship Examples
	 * For normal relationships, simply add the model name to the array:
	 *   $has_one = array('user'); // Comment has one User
	 *
	 * For complex relationships, such as having a Creator and Editor for
	 * Comment, use this form:
	 *   $has_one = array(
	 *   	'creator' => array(
	 *   		'class' => 'user',
	 *   		'other_field' => 'created_comment'
	 *   	)
	 *   );
	 *
	 * Don't forget to add 'created_comment' to User, with class set to
	 * 'comment', and the other_field set to 'creator'!
	 *
	 */

	// --------------------------------------------------------------------
	// Validation
	//   Add validation requirements, such as 'required', for your fields.
	// --------------------------------------------------------------------
	
	var $validation = array(
		'created' => array(
			// example is required, and cannot be more than 120 characters long.
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
	function get_open_comments()
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

/* End of file comment.php */
/* Location: ./application/models/comment.php */