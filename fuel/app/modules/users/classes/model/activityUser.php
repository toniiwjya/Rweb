<?php

namespace Pages;

class Model_activityUser extends \Orm\Model{
	
	protected static $_table_name = 'activity_user';

	protected static $_properties = array(
		'id',
		'user_id',
		'source_id',
		'brand_id',
		'category',
		'date'
	);

	public static function add_point($brand_id,$user_id){
		$data = self::forge(array(
			'user_id'	=> $user_id,
			'source_id'	=> $brand_id,
			'category'	=> '1',
			'date'		=> date("Y-m-d H:i:s"),

		));

		$data->save();
	}

	public static function calc_add_point($user_id){
		// self::query()->where('user_id',$user_id);
	}

	protected static $_belongs_to = array(
		'brand' => array(
			'key_from' 		 => 'brand_id',
			'model_to' 		 => 'Reward\\Model_Brand',
			'key_to'		 => 'id',
			'cascade_save'	 => true,
			'cascade_delete' => false,
		),
		'order' => array(
			'key_from' 		 => 'source_id',
			'model_to' 		 => 'Reward\\Model_Order',
			'key_to'		 => 'id',
			'cascade_save'	 => true,
			'cascade_delete' => false,
		),
		'task' => array(
			'key_from' 		 => 'source_id',
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