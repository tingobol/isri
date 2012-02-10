<?php

class Branch extends DataMapper {

	var $model = 'branch';
	var $table = 'branches';

	var $has_many = array('user','task');
}