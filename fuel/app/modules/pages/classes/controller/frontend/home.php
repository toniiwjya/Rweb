<?php
namespace Pages;

class Controller_Frontend_Home extends \Controller
{
    public function action_index() {
    	return \Response::forge(\View::forge('pages::frontend/home.twig'));
    }

}