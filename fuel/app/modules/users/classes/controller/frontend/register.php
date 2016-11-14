<?php
namespace Users;

class Controller_Frontend_Register extends \Controller_Frontend
{
    public function action_index(){
        if(empty($this->_data_template)){
            $this->_data_template=[];
        }
    	$this->_do_registration();
        return \Response::forge(\View::forge('users::frontend/register.twig',$this->_data_template,FALSE));
    }

    private function _do_registration(){
    	$_post_data = \Input::post();
    	if (count($_post_data) > 0) {
    		$this->_data_template['post_data'] = $_post_data;
            $_err = Model_Register::form_validate();
            if(count($_err) > 0){
                $this->_data_template['error_message'] = $_err;
                return;
            }
            try{
                $member = Model_Register::fill($_post_data);
                \Response::redirect(\Uri::base().'login');  
            }
            catch (\Exception $e){
                $this->_data_template['error_message'] = $e -> getMessage();
            }
    	}
    }

 }