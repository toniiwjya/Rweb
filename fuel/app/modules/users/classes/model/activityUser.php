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

	public static function add_point($user_id,$task_id,$brand_id){
		$data = self::forge(array(
			'user_id'	=> $user_id,
			'task_id'	=> $task_id,
			'brand_id'	=> $brand_id,
			'date'		=> date("Y-m-d H:i:s"),
		));
		$data->save();

		$get_point = \Promo\Model_Task::query()->where('id',$task_id)->get_one();
		$update_point = Model_userPoint::query()->where('user_id',$user_id)->where('brand_id',$brand_id)->get_one();
		$update_point->point += $get_point['point'];
		$update_point->save(); 
	}

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