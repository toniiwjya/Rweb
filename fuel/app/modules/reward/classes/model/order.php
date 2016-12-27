<?php

namespace Reward;

class Model_Order extends \Orm\Model{
	
	protected static $_table_name = 'order';

	protected static $_properties = array(
		'id',
		'user_id',
		'reward_id',
		'date'
	);

	protected static $_belongs_to = array(
		'user' => array(
			'key_from' 		 => 'user_id',
			'model_to' 		 => 'Users\\Model_Members',
			'key_to'		 => 'id',
			'cascade_save'	 => true,
			'cascade_delete' => false,
		),
		'reward' => array(
			'key_from' 		 => 'reward_id',
			'model_to' 		 => 'Model_Reward',
			'key_to'		 => 'id',
			'cascade_save'	 => true,
			'cascade_delete' => false,
		)
	);
}