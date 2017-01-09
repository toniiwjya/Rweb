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
			if(strcasecmp(\Crypt::decode($member->password), $post_data['password'])==0)
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

	public static function get_fb_url(){
//		\FacebookSession::setDefaultApplication(\Config::get('facebook.app_id'), \Config::get('facebook.app_secret'));
//		$fb_redirect_login = new \FacebookRedirectLoginHelper(\Config::get('facebook.redirect_url'));
//		//Ask for permission to obtain data
//		$permission_to_access = ['public_profile','email','user_posts'];
//		return $fb_redirect_login->getLoginUrl($permission_to_access);

		$fb = new \Facebook(\Config::get('facebook'));
		$helper = $fb->getRedirectLoginHelper();
		//Redirect link FB after login
		$callback = 'http://localhost:8088/Rweb/fb/login';
		$permission_to_access = ['public_profile','email','user_posts'];
		return $loginUrl = $helper->getLoginUrl($callback,$permission_to_access);
	}

	public static function login_fb(){
//		\FacebookSession::setDefaultApplication(\Config::get('facebook.app_id'), \Config::get('facebook.app_secret'));
//        $fb_canvas_login_helper = new \FacebookCanvasLoginHelper();
//        $temp_session = $fb_canvas_login_helper->getSession();
//
//        if (empty($temp_session)) {
//            $fb_redirect_login = new \FacebookRedirectLoginHelper(\Config::get('facebook.redirect_url'));
//            $temp_session = $fb_redirect_login->getSessionFromRedirect();
//        }
//        $fb_request = new \FacebookRequest($temp_session->getLongLivedSession(), 'GET', '/me?fields=name,email');
//		$user_graph = $fb_request->execute()->getGraphObject(\GraphUser::className());

		$fb = new \Facebook(\Config::get('facebook'));
		$helper = $fb->getRedirectLoginHelper();
		$accessToken = $helper->getAccessToken();
		$oAuth2Client = $fb->getOAuth2Client();

		if (! $accessToken->isLongLived()){
			$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
		}

		$response = $fb->Get('/me?fields=name,email',$accessToken);
		$user = $response->getGraphUser();

		$check_fb_id = Model_Members::query()->where('fb_id',$user->getId())->get_one();
		if(empty($check_fb_id)){
			$check_email = Model_Members::query()->where('email',$user->getEmail())->get_one();
			if(empty($check_email)){
				$pass=Model_Members::generate_password();
				$member = Model_Members::forge(array(
					'fb_id' => $user->getId(),
					'fName' => $user->getName(),
					'email' => $user->getEmail(),
					'gender' => '-',
					'password' => $pass,
				));

				try{
					$member->save();
					\Session::set('user_id', $member->id);
					return TRUE;
				}catch(\Exception $ex){
					\Log::info('Fail to connect FB : '.$ex->getMessage());
					return FALSE;
				}

			}else{
				$check_email->fb_id = $user->getId();
				$check_email->save();
			}
			\Session::set('user_id', $check_email->id);
			return TRUE;
		}else{
			\Session::set('user_id', $check_fb_id->id);
			return TRUE;
		}
	}
}