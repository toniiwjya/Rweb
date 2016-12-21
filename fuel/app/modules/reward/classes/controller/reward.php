<?php
namespace Reward;

class Controller_Reward extends \Controller_Frontend
{
	public function action_index(){

		$this->_data_template['brand_reward'] = Model_Brand::query()->get(); 
		$this->_data_template['reward_list'] = Model_Reward::query()->get();
		return \Response::forge(\View::forge('reward::frontend/reward.twig',$this->_data_template,FALSE));
	}

	public function action_thankyou(){
        return \Response::forge(\View::forge('reward::frontend/thankyou.twig'));
    }

	public function get_all_reward(){
		
	}
	
}