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

	
	

}