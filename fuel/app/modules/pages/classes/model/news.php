<?php

namespace Pages;

class Model_News extends \Orm\Model{
	
	protected static $_table_name = 'news';

	protected static $_properties = array(
		'id',
		'brand_id',
		'promo_id',
		'title' => array(
			'validation' => array(
				'required',
			)
		),
		'description' => array(
			'validation' => array(
				'required',
			)
		),
		'img',
		'created_at'
	);

	protected static $_belongs_to = array(
		'brand' => array(
			'key_from' 		 => 'brand_id',
			'model_to' 		 => 'Reward\\Model_Brand',
			'key_to'		 => 'id',
			'cascade_save'	 => true,
			'cascade_delete' => false,
		),
		'promo' => array(
			'key_from' 		 => 'promo_id',
			'model_to' 		 => 'Promo\\Model_Promo',
			'key_to'		 => 'id',
			'cascade_save'	 => true,
			'cascade_delete' => false,
		),
	);
}