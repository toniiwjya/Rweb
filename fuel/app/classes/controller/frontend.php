<?php

class Controller_Frontend extends Controller
{
	protected $_is_login = FALSE;
	
	private function _check_login_session() {
        $_member_id = \Session::get('member_id');
        if (!empty($_member_id)) {
            $member = Userregistration\Model_Members::query()->where('id', $_member_id)->where('status', 1)->get_one();
            if (!empty($member)) {
                $this->_is_login = TRUE;
                $this->_member = $member;
            }
        }
    }
       
}