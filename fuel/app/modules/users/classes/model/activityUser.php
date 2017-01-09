<?php

namespace Users;

class Model_activityUser extends \Orm\Model{
	
	protected static $_table_name = 'activity_user';

	protected static $_properties = array(
		'id',
		'user_id',
		'task_id',
		'brand_id',
		'date'
	);

	

	protected static $_belongs_to = array(
		'brand' => array(
			'key_from' 		 => 'brand_id',
			'model_to' 		 => 'Reward\\Model_Brand',
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
		'user' => array(
			'key_from' 		 => 'user_id',
			'model_to' 		 => 'Users\\Model_Members',
			'key_to'		 => 'id',
			'cascade_save'	 => true,
			'cascade_delete' => false,
		)
	);
}