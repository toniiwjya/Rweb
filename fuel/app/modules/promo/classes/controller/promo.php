<?php
namespace Promo;

class Controller_Promo extends \Controller_Frontend
{
	public function action_index(){
		return \Response::forge(\View::forge('promo::frontend/promo.twig'));
	}
    public function action_task(){
        return \Response::forge(\View::forge('promo::frontend/task.twig'));
    }
}