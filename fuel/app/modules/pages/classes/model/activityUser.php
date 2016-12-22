<?php

namespace Pages;

class Model_activityUser extends \Orm\Model{
	
	protected static $_table_name = 'activity_user';

	protected static $_properties = array(
		'id',
		'user_id',
		'brand_id',
		'category',
		'date'
	);

	public static function add_point($brand_id,$user_id){
		$data = self::forge(array(
			'user_id'	=> $user_id,
			'brand_id'	=> $brand_id,
			'category'	=> '1',
			'date'		=> date("Y-m-d H:i:s"),

		));

		$data->save();
	}
}