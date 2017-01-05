<?php
/**
 * Authentication Class for Backend
 * 
 *
 * @category  Classes
 * @package   Classes
 * @author    Peter
 * @copyright 2014 Microad Indonesia
 */
class Authentication_Backend {
	private $current_admin;
	const USER_SALT = '9627364872349';
	
	public function __construct($user) {
		if (empty($user)) {
			$user = Model_Admins::forge();
		}
		$this->current_admin = $user;
	}
	
	/**
	* set current admin
	* @return
	* void
	*/
	public function setCurrentAdmin($user) {
		$this->current_admin = $user;
	}
	
	/**
	* get current admin
	* @return
	* Model_Admins value
	*/
	public function getCurrentAdmin() {
		return $this->current_admin;
	}
	
	/**
	* check current admin if exists
	* @return
	* boolean value
	*/
	public function is_exists() {
		$result = false;
		if ($this->current_admin['id'] > 0) {
			// inactive admin will be regarded as not exists
			if ($this->current_admin['status'] == 1) {
				$result = true;
				// each admin must have role, except superadmin
				if ($this->current_admin['superadmin'] != 1) {
					if (empty($this->current_admin['role'])) {
						$result = false;
					}
				}
			}
		}
		return $result;
	}
	
	/**
	* check the given password
	* @return
	* boolean value
	*/
	public function check_password($pswd) {
		$result = false;
		if (strcmp(self::make_password($this->current_admin['id'], $pswd), $this->current_admin['password']) == 0) {
			$result = true;
		}
		return $result;
	}
	
	/**
	* add lock counter and lock admin when lock count greater than max_lock_count
	* @return
	* void
	*/
	public function lock_admin() {
		if ($this->is_exists()) {
			$lock_count = $this->current_admin['lock_count'] + 1;
			$this->current_admin['lock_count'] = $lock_count;
			if ($this->current_admin['lock_count'] >= Config::get('config_cms.max_lock_count')) {
				$this->current_admin['locked_at'] = date('Y-m-d H:i:s');
			}
			$this->current_admin->save();
		}
	}
	
	/**
	* check the locked count of admin
	* @return
	* boolean value
	*/
	public function is_locked() {
		$result = false;
		if ($this->current_admin['lock_count'] >= Config::get('config_cms.max_lock_count')) {
			$result = true;
		}
		return $result;
	}
	
	public function after_success_sign_in() {
		$this->current_admin['lock_count'] = 0;
		$this->current_admin['current_signin_ip'] = Input::server('REMOTE_ADDR');
		$this->current_admin['last_signin_at'] = date('Y-m-d H:i:s');
		$this->current_admin->save();
	}
	
	/**
	* Make Password Hash
	* @param
	*  $db_id: Table id
	*  $pswd: Password(no Hash)
	* @return
	*  Password(Hash)
	**/
	public static function make_password($db_id, $pswd) {
		// Make Salt from user table id
		$salt = self::USER_SALT.$db_id;
		$hashed = '';
		for ($i = 0; $i < 987; $i++) {
			$hashed = hash('sha256', $hashed.$pswd.$salt, TRUE);
		}
		$digest = base64_encode($hashed);
		return $digest;
	}
}