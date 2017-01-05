<?php
class Model_Roles extends \Orm\Model {
	protected static $_table_name = 'roles';

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
		'name' => array(
			'label' => 'Name',
			'validation' => array(
				'required',
				'max_length' => array(100),
			)
		),
		'description' => array(
			'label' => 'Description',
			'validation' => array(
				'max_length' => array(255),
			)
		),
		'created_by',
		'created_at',
		'updated_by',
		'updated_at'
	);
	
	public function get_form_data_basic() {
		return array(
			'attributes' => array(
				'name' => 'frm_roles',
				'class' => 'form-horizontal',
				'role' => 'form',
				'action' => '',
				'method' => 'post',
			),
			'hidden' => array(),
			'fieldset' => array(
				array(
					'label' => array(
						'label' => 'Role Name',
						'id' => 'role_name',
						'attributes' => array(
							'class' => 'col-sm-2 control-label'
						)
					),
					'input' => array(
						'name' => 'role_name',
						'value' => $this->name,
						'attributes' => array(
							'class' => 'form-control',
							'placeholder' => 'Role Name',
							'required' => '',
						),
						'container_class' => 'col-sm-10'
					)
				),
				array(
					'label' => array(
						'label' => 'Role Description',
						'id' => 'role_desc',
						'attributes' => array(
							'class' => 'col-sm-2 control-label'
						)
					),
					'textarea' => array(
						'name' => 'role_desc',
						'value' => $this->description,
						'attributes' => array(
							'class' => 'form-control',
							'placeholder' => 'Role Description',
							'required' => ''
						),
						'container_class' => 'col-sm-10'
					)
				)
			)
		);
	}
}
