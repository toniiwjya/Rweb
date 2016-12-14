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
		'point',
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