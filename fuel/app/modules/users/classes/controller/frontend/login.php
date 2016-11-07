<?php
namespace Users;

class Controller_Frontend_Login extends \Controller
{
    public function action_index(){
        return \Response::forge(\View::forge('users::frontend/login.twig'));
    }
 }