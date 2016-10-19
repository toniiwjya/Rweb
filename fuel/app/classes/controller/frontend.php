<?php

class Controller_Frontend extends Controller
{
    public function action_index() {
    	return \Response::forge(\View::forge('pages::template_frontend.twig'));
    }
}