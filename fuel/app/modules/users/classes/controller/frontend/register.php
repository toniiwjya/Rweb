<?php
namespace Users;

class Controller_Frontend_Register extends \Controller_Frontend
{
    public function action_index(){
    	$this->_do_registration();
        return \Response::forge(\View::forge('users::frontend/register.twig'));
    }

    private function _do_registration(){
    	$_post_data = \Input::post();

    	if (count($_post_data) > 0) {
    		$this->_data_template['post_data'] = $_post_data;

    		$member = Model_Register::fill($_post_data);
    		\Response::redirect(\Uri::base().'login');
    	}

    }
 }