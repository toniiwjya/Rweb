<?php
namespace Users;

class Controller_Frontend_Login extends \Controller_Frontend
{
    public function action_index(){
        $this->_data_template['fb_login'] = Model_Login::get_fb_url();
        $this->_data_template['success_regis'] = \Session::get_flash('success_regis');
    	if(empty($this->_data_template)){
            $this->_data_template=[];
        }
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
            return \Response::forge(\View::forge('users::frontend/login.twig'));
        }
    }

 }