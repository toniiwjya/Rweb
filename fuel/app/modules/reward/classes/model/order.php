<?php

namespace Reward;

class Model_Order extends \Orm\Model{
	
	protected static $_table_name = 'reward_order';

	protected static $_properties = array(
		'id',
		'user_id',
		'reward_id',
		'date'
	);

	public static function check_valid($data){
		$user_id = \Session::get('user_id');

		//Check if user have point for the reward
		$reward_to_be_redeem = Model_Reward::query()->where('id',$data)->get_one();
		$user_point = \Users\Model_userPoint::query()->where('user_id',$user_id)->where('brand_id',$reward_to_be_redeem->brand_id)->get_one();
		if(!empty($user_point)){
			if($user_point->point >= $reward_to_be_redeem->point)
			{
				$user_point->point -= $reward_to_be_redeem->point;
				$user_point->save();
			}
			else{
				return FALSE;
			}
		}

	}

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
			'model_to' 		 => 'Reward\\Model_Reward',
			'key_to'		 => 'id',
			'cascade_save'	 => true,
			'cascade_delete' => false,
		)
	);
}