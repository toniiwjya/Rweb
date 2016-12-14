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
		'slot',
		'end_date',
		'status'
	);

	protected static $_has_many = array(
		'task' => array(
			'key_from'		 => 'id',
			'model_to'		 => 'Promo\\Model_Task',
			'key_to' 		 => 'promo_id',
			'cascade_save'	 => true,
			'cascade_delete' => false,
		),
		'activity' => array(
			'key_from'		 => 'id',
			'model_to'		 => 'Promo\\Model_ActivityPromo',
			'key_to' 		 => 'promo_id',
			'cascade_save'	 => true,
			'cascade_delete' => false,
		)
	);
}