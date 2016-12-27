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
//Need to move to Model, use flash
    private function _do_registration(){
    	$_post_data = \Input::post();
    	if (count($_post_data) > 0) {
            $_err = Model_Register::form_validate();
            if(count($_err) > 0){
                $this->_data_template['error_message'] = $_err;
                return;
            }
            if(Model_Members::check_regis($_post_data['email'])){
                $this->_data_template['error_message'] = 'Email has been used to register';
                return;
            }
            try{
                Model_Register::fill($_post_data);
                \Session::set_flash('success_regis','Registrasi berhasil, silahkan login.');
                \Response::redirect(\Uri::base().'login');  
            }
            catch (\Exception $e){
               // $this->_data_template['error_message'] = $e -> getMessage();
                $this->_data_template['error_message'] = "Fail to register, please try again.";
            }
    	}
    }

 }