<?php
class Model_AdminsRole extends \Orm\Model {
	protected static $_table_name = 'admins_role';

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events'=>array('before_insert'),
			'mysql_timestamp' => true
		),
		'Orm\Observer_Validation' => array(
			'events'=>array('before_save')
		)
	);
        
	protected static $_properties = array(
		'id',
		'admin_id' => array(
			'label' => 'Admin ID',
			'validation' => array(
				'required',
			)
		),
		'role_id' => array(
			'label' => 'Role ID',
			'validation' => array(
				'required',
			)
		),
		'created_by',
		'created_at'
	);
	
	protected static $_belongs_to = array(
		'admins' => array(
			'key_from' => 'admin_id',
			'model_to' => 'Model_Admins',
			'key_to' => 'id',
			'cascade_save' => true,
			'cascade_delete' => false,
		),
		'roles' => array(
			'key_from' => 'role_id',
			'model_to' => 'Model_Roles',
			'key_to' => 'id',
			'cascade_save' => true,
			'cascade_delete' => false,
		)
	);
}
