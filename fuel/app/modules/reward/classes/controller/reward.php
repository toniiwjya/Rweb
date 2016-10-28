<?php
namespace Reward;

class Controller_Reward extends \Controller
{
	public function action_index(){
		return \Response::forge(\View::forge('reward::frontend/reward.twig'));
	}

}