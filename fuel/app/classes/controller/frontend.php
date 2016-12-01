<?php

class Controller_Frontend extends Controller
{
	protected $_is_login = FALSE;

    public function before(){
        session_start();
        $this->_check_login_session();
        $this->_data_template['is_login'] = $this->_is_login;
        $this->_data_template['member'] = $this->_member;
    }

	private function _check_login_session() {
        $user_id = \Session::get('user_id');
        if (!empty($user_id)) {
            $member = Users\Model_Members::query()->where('id', $user_id)->get_one();

            if (!empty($member)) {
                $this->_is_login = TRUE;
                $this->_member = $member;
            }
        }else{
            $this->_member='';
        }
    }
       
}