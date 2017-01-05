<?php
class Model_Admins extends \Orm\Model {
	private $status_name = array('InActive', 'Active');
	
	protected static $_table_name = 'admins';

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
		'email' => array(
			'label' => 'Email',
			'validation' => array(
				'required',
				'valid_email',
				'max_length' => array(50),
				'unique_email' => array(),
			)
		),
		'password' => array(
			'label' => 'Password',
			'validation' => array(
				'required',
				'min_length' => array(6),
			)
		),
		'fullname' => array(
			'label' => 'Fullname',
			'validation' => array(
				'required',
				'max_length' => array(105),
			)
		),
		'phone' => array(
			'label' => 'Phone',
			'validation' => array(
				'max_length' => array(20),
			)
		),
		'status' => array(
			'label' => 'Status',
			'validation' => array(
				'required',
				'numeric_min' => array(0),
			)
		),
		'photo',
		'superadmin',
		'lock_count',
		'locked_at',
		'current_signin_ip',
		'last_signin_ip',
		'last_signin_at',
		'created_at',
		'updated_at'
	);
	
	protected static $_has_one = array(
		'role' => array(
			'key_from' => 'id',
			'model_to' => 'Model_AdminsRole',
			'key_to' => 'admin_id',
			'cascade_save' => true,
			'cascade_delete' => true,
		)
	);
	
	public static function _validation_unique_email($email) {
		$exists = DB::select(DB::expr('COUNT(id) as total_count'))->from(self::$_table_name)->where('email', '=', $email)
			->execute()->get('total_count');

		return (bool) !$exists;
	}
	
	public static function exclude_superadmin() {
		return self::query()->where('superadmin', 0);
	}
	
	public function get_status_name() {
		$flag = $this->status;
		return isset($this->status_name[$flag]) ? $this->status_name[$flag] : '-';
	}
	
	public function get_form_data_basic() {
		return array(
			'attributes' => array(
				'name' => 'frm_admins',
				'class' => 'form-horizontal',
				'role' => 'form',
				'action' => '',
				'method' => 'post',
			),
			'hidden' => array(),
			'fieldset' => array(
				array(
					'label' => array(
						'label' => 'Email',
						'id' => 'email',
						'attributes' => array(
							'class' => 'col-sm-2 control-label'
						)
					),
					'input' => array(
						'name' => 'email',
						'value' => $this->email,
						'attributes' => array(
							'class' => 'form-control',
							'placeholder' => 'example@email.com',
							'required' => '',
							'type' => 'email'
						),
						'container_class' => 'col-sm-10'
					)
				),
				array(
					'label' => array(
						'label' => 'Fullname',
						'id' => 'fullname',
						'attributes' => array(
							'class' => 'col-sm-2 control-label'
						)
					),
					'input' => array(
						'name' => 'fullname',
						'value' => $this->fullname,
						'attributes' => array(
							'class' => 'form-control',
							'placeholder' => 'Fullname',
							'required' => ''
						),
						'container_class' => 'col-sm-10'
					)
				),
				array(
					'label' => array(
						'label' => 'Phone',
						'id' => 'phone',
						'attributes' => array(
							'class' => 'col-sm-2 control-label'
						)
					),
					'input' => array(
						'name' => 'phone',
						'value' => $this->phone,
						'attributes' => array(
							'class' => 'form-control',
							'placeholder' => 'Phone'
						),
						'container_class' => 'col-sm-10'
					)
				),
				array(
					'label' => array(
						'label' => 'Status',
						'id' => 'status',
						'attributes' => array(
							'class' => 'col-sm-2 control-label'
						)
					),
					'select' => array(
						'name' => 'status',
						'value' => $this->status,
						'options' => $this->status_name,
						'attributes' => array(
							'class' => 'form-control',
							'placeholder' => 'Status',
							'required' => ''
						),
						'container_class' => 'col-sm-10'
					)
				)
			)
		);
	}
}
