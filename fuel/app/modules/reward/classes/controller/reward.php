<?php
namespace Reward;

class Controller_Reward extends \Controller_Frontend
{
	public function action_index(){
		return \Response::forge(\View::forge('reward::frontend/reward.twig'));
	}
    public function action_reedem(){
        return \Response::forge(\View::forge('reward::frontend/reedem.twig'));
    }
}