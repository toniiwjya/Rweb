<?php
namespace Promo;

class Controller_Promo extends \Controller
{
	public function action_index(){
		return \Response::forge(\View::forge('promo::frontend/promo.twig'));
	}

}