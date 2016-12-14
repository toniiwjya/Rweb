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
}