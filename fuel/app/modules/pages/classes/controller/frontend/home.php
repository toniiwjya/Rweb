<?php
namespace Pages;

class Controller_Frontend_Home extends \Controller_Frontend
{
    public function action_index(){
    	return \Response::forge(\View::forge('pages::frontend/home.twig'));
    }
    public function action_news(){
    	
    }
    public function action_news_detail(){
    	return \Response::forge(\View::forge('pages::frontend/news_detail.twig'));
    }
}