<?php
class Controller_Error extends Controller_Mama
{
	public function action_404() {
		$data = array(
			'meta_title' => Config::get('config_basic.app_name').' | Error 404',
			'body_tag_class' => 'skin-blue',
		);
		return Response::forge(View::forge('404.twig', $data));
	}
	
	public function action_no_permission($redirect_route) {
		$data = array(
			'meta_title' => Config::get('config_basic.app_name').' | No Permission',
			'body_tag_class' => 'skin-blue',
			'redirect_to' => \Uri::base().$redirect_route,
		);
		return Response::forge(View::forge('no_permission.twig', $data));
	}
}
