<?php
return array(
	'_404_'   => 'welcome/404',    // The main 404 route

//Frontend
	'_root_'  		=> 'pages/frontend/home',  // The default route
	'home'  		=> 'pages/frontend/home',
	'news'			=> 'pages/frontend/home/news',
	'news_detail'	=> 'pages/frontend/home/news_detail',
    'profile'       => 'pages/frontend/home/profile',
	'logout'		=> 'pages/frontend/home/logout',
	'login'			=> 'users/frontend/login',
	'fb/login'		=> 'users/frontend/login/fb',
	'register' 		=> 'users/frontend/register',
	'promo'			=> 'promo',
    'task'          => 'promo/task',
	'reward'		=> 'reward',
    'thankyou'        => 'reward/thankyou'
);
