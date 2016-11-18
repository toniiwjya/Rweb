<?php

namespace Users;

class Model_Login extends \Model {

	private static $_label = [
		'email' => 'Email',
		'password' => 'Password'
    ];

    private static $_err_message = [
        'email_password' => 'Email/Password is not correct!',
        'fb_connect_success' => 'Success to connect FB Account!',
        'fb_connect_fail' => 'Fail to connect FB Account!',
    ];

	public static function validate_login($post_data){
		$member = Model_Members::query()->where('email', $post_data['email'])->get_one();
		if(!empty($member)){
			if(hash_equals($member->password,crypt($post_data['password'],$member->password)))
			{
				\Session::set('user_id',$member->id);
				return TRUE;
			}
		}
		return FALSE;
	}

	public static function get_err_message($key){
		return self::$_err_message[$key];
	}

}