<?php
class Model_RolesPermission extends \Orm\Model {
	protected static $_table_name = 'roles_permission';

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
        
	protected static $_properties = array(
		'id',
		'role_id' => array(
			'label' => 'Role ID',
			'validation' => array(
				'required',
			)
		),
		'menu_key' => array(
			'label' => 'Menu Key',
			'validation' => array(
				'required',
			)
		),
		'access_create',
		'access_read',
		'access_update',
		'access_delete',
		'created_by',
		'created_at',
		'updated_by',
		'updated_at'
	);
	
	protected static $_belongs_to = array(
		'roles' => array(
			'key_from' => 'role_id',
			'model_to' => 'Model_Roles',
			'key_to' => 'id',
			'cascade_save' => true,
			'cascade_delete' => false,
		)
	);
}
