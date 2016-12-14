<?php
namespace Users;

class Controller_Frontend_Login extends \Controller_Frontend
{
    public function action_index(){
        $this->_data_template['fb_login'] = Model_Login::get_fb_url();
        $this->_data_template['success_regis'] = \Session::get_flash('success_regis');
        $this->_data_template['fail_fb'] = \Session::get_flash('fail_fb');
        $this->_data_template['please_login'] =\Session::get_flash('ask_login');
        $this->_do_login();
    	return \Response::forge(\View::forge('users::frontend/login.twig',$this->_data_template,FALSE));
    }

    public function _do_login(){
    	$post_data = \Input::post();
    	if(count($post_data)>0){
    		if(Model_Login::validate_login($post_data)){
                \Response::redirect(\Uri::base());
    		}else{
    		 	$this->_data_template['login_message'] = Model_login::get_err_message('email_password');
    		}
    	}
    }

    public static function action_fb(){
        if(Model_login::login_fb()){
            \Response::redirect(\Uri::base());
        }
        else{
            \Session::set_flash('fail_fb','Fail to connect to FB account');
            \Response::redirect(\Uri::base().'login');
        }
    }
 }