<?php

namespace Users;

class Model_Register extends \Orm\Model {

	private $status_name = array('InActive', 'Active');
	protected static $_table_name = 'user';

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events'=>array('before_insert'),
			'mysql_timestamp' => true
		),
		'Orm\Observer_UpdatedAt' => array(
			'events'=>array('before_update'),
			'mysql_timestamp' => true
		),
		'Orm\Observer_Validation' => array(
			'events'=>array('before_save')
		)
	);

	private static $_label = [
        'fName' => 'Full Name',
		'email' => 'Email',
		'password' => 'Password'
    ];

	protected static $_properties = array(
		'id',
		'fName' => array(
			'label' => 'Full Name',
			'validation' => array(
				'required',
				'max_length' => array(100)
			)
		),
		'email' => array(
			'label' => 'Email',
			'validation' => array(
				'required',
				'max_length' => array(100),
			)
		),
		'password' => array(
			'label' => 'Password',
			'validation' => array(
				'max_length' => array(100),
			)
		),
	);

	

	public static function fill($post_data) {
		$member = Model_Register::forge(array(
			'fName' => $post_data['fName'],
			'email' => $post_data['email'],
			'password' => $post_data['password'],
		));

		$member->save();
	}

	public static function form_validate(){
		$val = \Validation::forge('form_registration');
		$val->add_field('fName','Full Name','required');
		$val->add_field('email','Email','required');
		$val->add_field('password','Password','required|min_length[6]');
		$val->set_message('required','Field :label is required!');
		$val->set_message('min_length','Field :label require minimum character!');
		if($val->run()){
			return[];
		} else {
			return $val->error();
		}
	}	

}