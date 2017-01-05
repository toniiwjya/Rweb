<?php 

namespace Promo;

class Model_Task extends \Orm\Model{
	protected static $_table_name = "task";

	protected static $_properties = array(
		'id',
		'promo_id',
		'name' => array(
			'validation' => array(
				'required',
				'max_length' => array(200)
			)
		),
		'description',
		'img',
		'type',
		'point',
	);

	protected static $_has_many = array(
		'activity_user' => array(
			'key_from'		 => 'id',
			'model_to'		 => 'Users\\Model_ActivityUser',
			'key_to' 		 => 'task_id',
			'cascade_save'	 => true,
			'cascade_delete' => false,
		),
		'user_task' => array(
            'key_from'  => 'id',
            'model_to'  => 'Users\\Model_userTask',
            'key_to'    => 'task_id',
            'cascade_save'  => true,
            'cascade_delete'=> false,
        ),
	);

	protected static $_belongs_to = array(
		'promo' => array(
			'key_from' 		 => 'promo_id',
			'model_to' 		 => 'Promo\\Model_Promo',
			'key_to'		 => 'id',
			'cascade_save'	 => true,
			'cascade_delete' => false,
		)
	);
}