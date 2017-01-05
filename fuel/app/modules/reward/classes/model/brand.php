<?php

namespace Reward;

class Model_Brand extends \Orm\Model {

	protected static $_table_name = 'brand';

	protected static $_properties = array(
		'id',
		'name' => array(
			'validation' => array(
				'required',
			)
		)
	);

	protected static $_has_many = array(
		'promo' => array(
			'key_from'		 => 'id',
			'model_to'		 => 'Promo\\Model_Promo',
			'key_to' 		 => 'brand_id',
			'cascade_save'	 => true,
			'cascade_delete' => false,
		),
	    'reward' => array(
	        'key_from' => 'id',
	        'model_to' => 'Reward\\Model_Reward',
	        'key_to' => 'brand_id',
	        'cascade_save' => true,
	        'cascade_delete' => false,
	    )
	);
}