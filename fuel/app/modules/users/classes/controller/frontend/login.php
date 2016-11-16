<?php
namespace Users;

class Controller_Frontend_Login extends \Controller
{
    public function action_index(){
    	$this->_do_login();
    	return \Response::forge(\View::forge('users::frontend/login.twig'));
    }

    public function _do_login(){

    }
 }