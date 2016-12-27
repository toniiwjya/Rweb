<?php

namespace Promo;

class Model_Promo extends \Orm\Model{
	protected static $_table_name = "promo";

	protected static $_properties = array(
		'id',
		'name' => array(
			'label' => 'Promo Name',
			'validation' => array(
				'required',
				'max_length' => array(200)
			)
		),
		'brand_id',
		'description',
		'img',
		'slot',
		'end_date',
		'status'
	);

	protected static $_has_one = array(
	    'news' => array(
	        'key_from' => 'id',
	        'model_to' => 'Pages\\Model_News',
	        'key_to' => 'promo_id',
	        'cascade_save' => true,
	        'cascade_delete' => false,
	    )
	);

	protected static $_has_many = array(
		'activity_promo' => array(
			'key_from'		 => 'id',
			'model_to'		 => 'Promo\\Model_ActivityPromo',
			'key_to' 		 => 'promo_id',
			'cascade_save'	 => true,
			'cascade_delete' => false,
		),
		'task' => array(
			'key_from'		 => 'id',
			'model_to'		 => 'Promo\\Model_Task',
			'key_to' 		 => 'promo_id',
			'cascade_save'	 => true,
			'cascade_delete' => false,
		),
		
	);

	protected static $_belongs_to = array(
		'brand' => array(
			'key_from'		 => 'brand_id',
			'model_to'		 => 'Reward\\Model_Brand',
			'key_to' 		 => 'id',
			'cascade_save'	 => true,
			'cascade_delete' => false,
		)
	);
}