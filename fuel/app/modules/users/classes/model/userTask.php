<?php

namespace Users;

class Model_userTask extends \Orm\Model{
	
	protected static $_table_name = 'user_task';

	protected static $_properties = array(
		'id',
		'user_id',
		'task_id',
		'action',
		'date',
	);

	protected static $_belongs_to = array(
		'user' => array(
			'key_from' 		 => 'user_id',
			'model_to' 		 => 'Users\\Model_Members',
			'key_to'		 => 'id',
			'cascade_save'	 => true,
			'cascade_delete' => false,
		),
		'task' => array(
			'key_from' 		 => 'task_id',
			'model_to' 		 => 'Promo\\Model_Task',
			'key_to'		 => 'id',
			'cascade_save'	 => true,
			'cascade_delete' => false,
		),
	);
}