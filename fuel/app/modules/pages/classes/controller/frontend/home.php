<?php
namespace Pages;

class Controller_Frontend_Home extends \Controller
{
    public function action_index(){
    	return \Response::forge(\View::forge('pages::frontend/home.twig'));
    }

    public function action_login(){
        return \Response::forge(\View::forge('pages::frontend/login.twig'));
    }

    public function action_register(){
        return \Response::forge(\View::forge('pages::frontend/register.twig'));
    }
}