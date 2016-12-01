<?php

namespace Pages;

class Model_News extends \Orm\Model{
	
	protected static $_table_name = 'news';

	protected static $_properties = array(
		'id',
		'brand_id',
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
		'created_at'
	);
}