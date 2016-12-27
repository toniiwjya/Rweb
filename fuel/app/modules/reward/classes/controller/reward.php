<?php
namespace Reward;

class Controller_Reward extends \Controller_Frontend
{
	public function action_index(){
		$user_id = \Session::get('user_id');
		$this->_data_template['brand_reward'] = Model_Brand::query()->get();
		$this->_data_template['reward_list'] = Model_Reward::query()->get();
		$this->_data_template['point_user'] = \Users\Model_userPoint::query()->where('user_id',$user_id)->get();
		$this->_data_template['err_msg'] = \Session::get_flash('no_point');
		return \Response::forge(\View::forge('reward::frontend/reward.twig',$this->_data_template,FALSE));
	}

	public function action_thankyou(){
		$data = \Input::post();
		if(Model_Order::check_valid($data))
		{
	        return \Response::forge(\View::forge('reward::frontend/thankyou.twig',$this->_data_template,FALSE));			
		}else{
			\Session::set_flash('no_point','Point Anda tidak cukup');
			\Response::redirect(\Uri::base().'reward');
		}	

    }
	
}