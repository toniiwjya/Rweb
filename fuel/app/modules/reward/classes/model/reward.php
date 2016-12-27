<?php

namespace Reward;

class Model_Reward extends \Orm\Model {

	protected static $_table_name = 'reward';

	protected static $_properties = array(
		'id',
		'brand_id',
		'name' => array(
			'validation' => array(
				'required',
			)
		),
		'img',
		'point' =>  array(
			'validation' => array(
				'required',
			)
		),
		'stock' => array(
			'validation' => array(
				'required',
			)
		),
		'status' => array(
			'validation' => array(
				'required',
			)
		),
	);

	protected static $_has_many = array(
		'order' => array(
			'key_from'		 => 'id',
			'model_to'		 => 'Model_Order',
			'key_to' 		 => 'reward_id',
			'cascade_save'	 => true,
			'cascade_delete' => false,
		),
	);

	protected static $_belongs_to = array(
	    'brand' => array(
	        'key_from' => 'brand_id',
	        'model_to' => 'Model_Brand',
	        'key_to' => 'id',
	        'cascade_save' => true,
	        'cascade_delete' => false,
	    )
	);

}