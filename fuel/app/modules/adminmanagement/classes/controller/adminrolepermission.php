<?php
namespace AdminManagement;

class Controller_AdminRolePermission extends \Controller_Backend
{
	private $_module_url = 'backend/admin-role-permission';
	private $_menu_key = 'admin_role_permission';
	
	public function before() {
		parent::before();
		$this->authenticate();
		// Check menu permission
		if (!$this->check_menu_permission($this->_menu_key, 'read')) {
			// if not have an access then redirect to error page
			\Response::redirect(\Uri::base().'backend/no-permission');
		}
		$this->_data_template['meta_title'] = 'Admin Role Permission';
		$this->_data_template['menu_parent_key'] = 'admin_management';
		$this->_data_template['menu_current_key'] = 'admin_role_permission';
	}
	
	public function action_index() {
		$this->_data_template['role_list'] = \Model_Roles::find('all');
		$this->_data_template['success_message'] = \Session::get_flash('success_message');
		$this->_data_template['error_message'] = \Session::get_flash('error_message');
		return \Response::forge(\View::forge('adminmanagement::list/admin_roles.twig', $this->_data_template, FALSE));
	}
	
	public function action_form($role_id) {
		// find role model by role id
		$role_model = \Model_Roles::find($role_id);
		// if empty then define empty role model
		if (empty($role_model)) {
			// Role ID "0" is only for add new role, if greater than 0 then its mean edit role
			if ($role_id > 0) {
				\Session::set_flash('error_message', 'The Role with ID "'.$role_id.'" is not found here');
				\Response::redirect(\Uri::base().$this->_module_url);
			}
			$role_model = \Model_Roles::forge();
		}
		$this->_save_setting_data($role_model);
		$this->_data_template['content_header'] = 'Admin Role';
		$this->_data_template['content_subheader'] = 'Form';
		$this->_data_template['breadcrumbs'] = array(
			array(
				'label' => 'Admin Management'
			),
			array(
				'label' => 'Admin Role',
				'link' => \Uri::base().$this->_module_url
			),
			array(
				'label' => 'Form'
			)
		);
		$this->_data_template['form_data'] = $role_model->get_form_data_basic();
		$this->_data_template['cancel_button_link'] = \Uri::base().$this->_module_url;
		$this->_data_template['success_message'] = \Session::get_flash('success_message');
		return \Response::forge(\View::forge('backend/form/basic.twig', $this->_data_template, FALSE));
	}
	
	private function _save_setting_data($role_model) {
		$all_post_input = \Input::post();
		if (count($all_post_input)) {
			// Check menu permission
			$access_name = ($role_model->id > 0) ? 'update' : 'create';
			if (!$this->check_menu_permission($this->_menu_key, $access_name)) {
				// if not have an access then redirect to error page
				\Response::redirect(\Uri::base().'backend/no-permission');
			}
			$role_model->name = $all_post_input['role_name'];
			$role_model->description = $all_post_input['role_desc'];
			if ($role_model->id > 0) {
				$role_model->updated_by = $this->admin_auth->getCurrentAdmin()->id;
			} else {
				$role_model->created_by = $this->admin_auth->getCurrentAdmin()->id;
			}
			// Save with validation, if error then throw the error
			try {
				$role_model->save();
				\Session::set_flash('success_message', 'Successfully Saved');
				\Response::redirect(\Uri::current());
			} catch (\Orm\ValidationFailed $e) {
				$this->_data_template['error_message'] = $e->getMessage();
			}
		}
	}
	
	public function action_delete($role_id) {
		// Check menu permission
		if (!$this->check_menu_permission($this->_menu_key, 'delete')) {
			// if not have an access then redirect to error page
			\Response::redirect(\Uri::base().'backend/no-permission');
		}
		// find admin model by admin id
		$role_model = \Model_Roles::find($role_id);
		// if empty then redirect back with error message
		if (empty($role_model)) {
			\Session::set_flash('error_message', 'The Role with ID "'.$role_id.'" is not found here');
			\Response::redirect(\Uri::base().$this->_module_url);
		}
		// Delete the role
		try {
			$role_model->delete();
			\Session::set_flash('success_message', 'Delete Role "'.$role_model->name.'" is successfully');
		} catch (Orm\ValidationFailed $e) {
			\Session::set_flash('error_message', $e->getMessage());
		}
		\Response::redirect(\Uri::base().$this->_module_url);
	}
	
	public function action_assign_admin($role_id) {
		$this->_data_template['admin_list'] = $this->_get_related_admin_by_role($role_id);
		$this->_data_template['current_role_id'] = $role_id;
		$this->_data_template['success_message'] = \Session::get_flash('success_message');
		$this->_data_template['error_message'] = \Session::get_flash('error_message');
		return \Response::forge(\View::forge('adminmanagement::form/assign_admin.twig', $this->_data_template, FALSE));
	}
	
	public function action_do_assign_admin($admin_id, $role_id, $is_assign) {
		// Check menu permission
		if (!$this->check_menu_permission($this->_menu_key, 'update')) {
			// if not have an access then redirect to error page
			\Response::redirect(\Uri::base().'backend/no-permission');
		}
		$admins_role = \Model_AdminsRole::query()
			->where('admin_id', $admin_id)
			->where('role_id', $role_id)
			->get_one();
		if ($is_assign) {
			// if not empty then its already assigned so cannot do it anymore
			if (!empty($admins_role)) {
				\Session::set_flash('error_message', 'Admin ID '.$admin_id.' is already assigned');
			} else {
				$admins_role = \Model_AdminsRole::forge();
				$admins_role->admin_id = $admin_id;
				$admins_role->role_id = $role_id;
				$admins_role->created_by = $this->admin_auth->getCurrentAdmin()->id;
				$admins_role->save();
				\Session::set_flash('success_message', 'Success to assign Admin ID '.$admin_id.' to Role ID '.$role_id);
			}
		} else {
			// if empty then its already unassigned so cannot do it anymore
			if (empty($admins_role)) {
				\Session::set_flash('error_message', 'Admin ID '.$admin_id.' is already unassigned');
			} else {
				$admins_role->delete();
				\Session::set_flash('success_message', 'Success to unassign Admin ID '.$admin_id.' from Role ID '.$role_id);
			}
		}
		\Response::redirect(\Uri::base().$this->_module_url.'/assign-admin/'.$role_id);
	}
	
	private function _get_related_admin_by_role($role_id) {
		$data = array();
		$admin_list = \Model_Admins::query()->get();
		foreach ($admin_list as $admin_item) {
			if (empty($admin_item->role) || $admin_item->role['role_id'] == $role_id) {
				$data[] = $admin_item;
			}
		}
		return $data;
	}
	
	public function action_set_permission($role_id) {
		$this->_save_permission_admin($role_id);
		$this->_data_template['menu_list'] = $this->_get_menu_by_permission($role_id);
		$this->_data_template['success_message'] = \Session::get_flash('success_message');
		$this->_data_template['error_message'] = \Session::get_flash('error_message');
		return \Response::forge(\View::forge('adminmanagement::form/set_permission_admin.twig', $this->_data_template, FALSE));
	}
	
	private function _get_menu_by_permission($role_id) {
		$menus = \Config::get('config_cms.menus');
		foreach ($menus as $key => $menu) {
			$menus[$key]['role_permission'] = \Model_RolesPermission::query()
				->where('role_id', $role_id)
				->where('menu_key', $key)
				->get_one();
			if (isset($menu['submenus'])) {
				foreach ($menu['submenus'] as $key_submenu => $submenu) {
					$menus[$key]['submenus'][$key_submenu]['role_permission'] = \Model_RolesPermission::query()
						->where('role_id', $role_id)
						->where('menu_key', $key_submenu)
						->get_one();
				}
			}
		}
		return $menus;
	}
	
	private function _check_menu_key ($menu_key) {
		$menus = \Config::get('config_cms.menus');
		$key_exists = false;
		foreach ($menus as $key => $menu) {
			if (isset($menus[$key])) {
				$key_exists = true;
				break;
			}
			if (isset($menu['submenus'])) {
				foreach ($menu['submenus'] as $key_sub => $submenu) {
					if (isset($menu['submenus'][$key_sub])) {
						$key_exists = true;
						break;
					}
				}
			}
		}
		return $key_exists;
	}
	
	private function _save_permission_admin($role_id) {
		// Check menu permission
		if (!$this->check_menu_permission($this->_menu_key, 'update')) {
			// if not have an access then redirect to error page
			\Response::redirect(\Uri::base().'backend/no-permission');
		}
		$all_input_post = \Input::post();
		if (!empty($all_input_post['set_permission'])) {
			$current_roles_permission = \Model_RolesPermission::query()->where('role_id', $role_id)->get();
			foreach ($current_roles_permission as $curr_permission) {
				// Check current roles permssion
				if (!$this->_check_menu_key($curr_permission->menu_key)) {
					// Check menu key if not exists / not used anymore, so it needs to be deleted
					$curr_permission->delete();
				} else {
					// Check if menu key if not exists in input post then, set all access to 0
					if (!isset($all_input_post['chk_permission'][$curr_permission->menu_key])) {
						$curr_permission->access_create = 0;
						$curr_permission->access_read = 0;
						$curr_permission->access_update = 0;
						$curr_permission->access_delete = 0;
						$curr_permission->updated_by = $this->admin_auth->getCurrentAdmin()->id;
						$curr_permission->save();
					}
				}
			}
			
			if (!empty($all_input_post['chk_permission'])) {
				foreach ($all_input_post['chk_permission'] as $menu_key => $permission_value) {
					$roles_permission_model = \Model_RolesPermission::find(intval($permission_value['id']));
					if (empty($roles_permission_model)) {
						$roles_permission_model = \Model_RolesPermission::forge();
						$roles_permission_model->created_by = $this->admin_auth->getCurrentAdmin()->id;
					} else {
						$roles_permission_model->updated_by = $this->admin_auth->getCurrentAdmin()->id;
					}
					$roles_permission_model->role_id = $role_id;
					$roles_permission_model->menu_key = $menu_key;
					$roles_permission_model->access_create = isset($permission_value['create']) ? 1 : 0;
					$roles_permission_model->access_read = isset($permission_value['read']) ? 1 : 0;
					$roles_permission_model->access_update = isset($permission_value['update']) ? 1 : 0;
					$roles_permission_model->access_delete = isset($permission_value['delete']) ? 1 : 0;
					$roles_permission_model->save();
				}
			}
		}
	}
}

