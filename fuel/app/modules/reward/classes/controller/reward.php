<?php
namespace Reward;

class Controller_Reward extends \Controller_Frontend
{
	public function action_index(){
		$user_id = \Session::get('user_id');
		$this->_data_template['brand_reward'] = Model_Brand::query()->get();
		$this->_data_template['reward_list'] = Model_Reward::query()->get();
		$this->_data_template['sum_point'] = \Users\Model_ActivityUser::query()->where('user_id',$user_id)->get();
		return \Response::forge(\View::forge('reward::frontend/reward.twig',$this->_data_template,FALSE));
	}

	public function action_thankyou(){
        return \Response::forge(\View::forge('reward::frontend/thankyou.twig'));
    }
	
}