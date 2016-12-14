<?php
namespace Pages;

class Controller_Frontend_Home extends \Controller_Frontend
{
    public function action_index(){
        if(empty($this->_data_template)){
            $this->_data_template=[];
        }
    	return \Response::forge(\View::forge('pages::frontend/home.twig',$this->_data_template,FALSE));
    }
    public function action_news(){
        return \Response::forge(\View::forge('pages::frontend/news.twig',$this->_data_template,FALSE));
    }
    public function action_news_detail(){
        $id = $this->param('id');
        $news_detail = \Pages\Model_News::query()->where('id',$id)->get();;
        $this->_data_template['news_detail'] = $news_detail;

    	return \Response::forge(\View::forge('pages::frontend/news_detail.twig',$this->_data_template,FALSE));
    }
    public function action_profile(){
        return \Response::forge(\View::forge('pages::frontend/profile.twig',$this->_data_template,FALSE));
    }

    public function action_logout(){
        \Session::destroy();
        \Response::redirect(\Uri::base());
    }

}