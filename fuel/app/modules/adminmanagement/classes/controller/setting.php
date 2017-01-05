<?php
namespace AdminManagement;

class Controller_Setting extends \Controller_Backend
{
	private $_setting_type = 'basic';
	private $_menu_key = 'admin_setting';
	
	public function before() {
		parent::before();
		$this->authenticate();
		// Check menu permission
		if (!$this->check_menu_permission($this->_menu_key, 'read')) {
			// if not have an access then redirect to error page
			\Response::redirect(\Uri::base().'backend/no-permission');
		}
	}
	
	public function action_index() {
		$this->_save_setting_data();
		$this->_data_template['meta_title'] = 'Setting';
		$this->_data_template['menu_parent_key'] = 'admin_management';
		$this->_data_template['menu_current_key'] = 'admin_setting';
		$this->_data_template['setting_data'] = $this->_init_setting_data();
		$this->_data_template['success_message'] = \Session::get_flash('success_message');
		return \Response::forge(\View::forge('adminmanagement::setting.twig', $this->_data_template, FALSE));
	}
	
	private function _init_setting_data() {
		$config_basic = \Config::get('config_basic');
		foreach($config_basic as $setting_name => $setting_value) {
			$input_value = \Input::post($setting_name);
			$setting_value = (empty($input_value)) ? $setting_value : $input_value; // use value from input post if exists
			$setting_data[] = array(
				'name' => $setting_name,
				'value' => $setting_value,
				'label' => \Inflector::humanize(\Inflector::words_to_upper($setting_name)), // Capitalize each word which separated by underscore and then humanize all words
			);
		}
		return $setting_data;
	}
	
	private function _save_setting_data() {
		$all_post_input = \Input::post();
		if (count($all_post_input)) {
			// Check update permission
			if (!$this->check_menu_permission($this->_menu_key, 'update')) {
				// Check create permission
				if (!$this->check_menu_permission($this->_menu_key, 'create')) {
					// if not have an access then redirect to error page
					\Response::redirect(\Uri::base().'backend/no-permission');
				}
			}
			$err_msg = '';
			foreach($all_post_input as $setting_name => $setting_value) {
				// Get one by setting name and setting type
				$model_settings = \Model_Settings::query()
					->where('setting_name', $setting_name)
					->where('setting_type', $this->_setting_type)
					->get_one();
				// Check if empty then define empty settings model
				if (empty($model_settings)) {
					$model_settings = \Model_Settings::forge();
					$model_settings->setting_name = $setting_name;
					$model_settings->setting_type = $this->_setting_type;
					$model_settings->created_by = $this->admin_auth->getCurrentAdmin()->id;
				} else {
					$model_settings->updated_by = $this->admin_auth->getCurrentAdmin()->id;
				}
				// Set setting value from input
				$model_settings->setting_value = $setting_value;
				// Save with validation, if error then throw the error
				try {
					$model_settings->save();
				} catch (\Orm\ValidationFailed $e) {
					$err_msg .= $e->getMessage();
				}
			}
			
			if (strlen($err_msg) == 0) {
				// Set flash data for success message
				\Session::set_flash('success_message', 'Successfully Saved');
				\Response::redirect(\Uri::current());
			} else {
				$this->_data_template['error_message'] = $err_msg;
			}
		}
	}
}

