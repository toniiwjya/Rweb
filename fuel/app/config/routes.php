<?php
return array(
    '_404_'   => 'welcome/404',    // The main 404 route

//Frontend
    '_root_'  			=> 'pages/frontend/home',  // The default route
    'home'  			=> 'pages/frontend/home',
    'news'				=> 'pages/frontend/home/news',
    'news_detail/(:id)'	=> 'pages/frontend/home/news_detail',
    'profile'       	=> 'pages/frontend/home/profile',
    'logout'			=> 'pages/frontend/home/logout',
    'done'				=> 'pages/frontend/home/add_point',
    'login'				=> 'users/frontend/login',
    'fb/login'			=> 'users/frontend/login/fb',
    'register' 			=> 'users/frontend/register',
    'promo'				=> 'promo',
    'task'          	=> 'promo/task',
    'join'				=> 'promo/join',
    'reward'			=> 'reward',
    'thankyou'      	=> 'reward/thankyou',

    // Backend //

    // Installation
    'backend/installation' => 'backend/install/setup',

    // Backend routes
    'backend' => 'backend/dashboard', // The default route for backend
    'backend/sign-in' => 'backend/dashboard/sign_in',
    'backend/sign-out' => 'backend/dashboard/sign_out',
    'backend/change-password' => 'backend/dashboard/change_current_password',
    'backend/my-profile' => 'backend/dashboard/my_profile_form',
    'backend/no-permission' => 'error/no_permission/backend',

// Admin Management //

    // Admin User
    'backend/admin-user' => 'adminmanagement/adminuser',
    'backend/admin-user/add' => 'adminmanagement/adminuser/form/0',
    'backend/admin-user/edit/(:num)' => 'adminmanagement/adminuser/form/$1',
    'backend/admin-user/delete/(:num)' => 'adminmanagement/adminuser/delete/$1',
    'backend/admin-user/reset-password/(:num)' => 'adminmanagement/adminuser/reset_password/$1',

    // Admin Role Permission
    'backend/admin-role-permission' => 'adminmanagement/adminrolepermission',
    'backend/admin-role-permission/add' => 'adminmanagement/adminrolepermission/form/0',
    'backend/admin-role-permission/edit/(:num)' => 'adminmanagement/adminrolepermission/form/$1',
    'backend/admin-role-permission/delete/(:num)' => 'adminmanagement/adminrolepermission/delete/$1',
    'backend/admin-role-permission/assign-admin/(:num)' => 'adminmanagement/adminrolepermission/assign_admin/$1',
    'backend/admin-role-permission/do-assign-admin/(:num)/(:num)' => 'adminmanagement/adminrolepermission/do_assign_admin/$1/$2/1',
    'backend/admin-role-permission/do-unassign-admin/(:num)/(:num)' => 'adminmanagement/adminrolepermission/do_assign_admin/$1/$2/0',
    'backend/admin-role-permission/set-permission/(:num)' => 'adminmanagement/adminrolepermission/set_permission/$1',

    // Basic Setting
    'backend/setting' => 'adminmanagement/setting',

    // Home Banner
    'backend/homebanner' => 'pages/backend/',
    'backend/homebanner/add' => 'pages/backend/form/0',
    'backend/homebanner/edit/(:num)' => 'pages/backend/form/$1',
    'backend/homebanner/delete/(:num)' => 'pages/backend/delete/$1',

    // Brand  //
    'backend/brand' => 'reward/backend',
    'backend/brand/add' => 'reward/backend/form/0',
    'backend/brand/edit/(:num)' => 'reward/backend/form/$1',
    'backend/brand/delete/(:num)' => 'reward/backend/delete/$1',

    // Promo //
    'backend/promo' => 'promo/backend',
    'backend/promo/add' => 'promo/backend/form/0',
    'backend/promo/edit/(:num)' => 'promo/backend/form/$1',
    'backend/promo/delete/(:num)' => 'promo/backend/delete/$1',

    // Task //
    'backend/task' => 'promo/backend/task',
    'backend/task/add' => 'promo/backend/task/form/0',
    'backend/task/edit/(:num)' => 'promo/backend/task/form/$1',
    'backend/task/delete/(:num)' => 'promo/backend/task/delete/$1',

    // Reward //
    'backend/reward' => 'reward/backend/reward',
    'backend/reward/add' => 'reward/backend/reward/form/0',
    'backend/reward/edit/(:num)' => 'reward/backend/reward/form/$1',
    'backend/reward/delete/(:num)' => 'reward/backend/reward/delete/$1',

    // News //
    'backend/news' => 'pages/backend/news',
    'backend/news/add' => 'pages/backend/news/form/0',
    'backend/news/edit/(:num)' => 'pages/backend/news/form/$1',
    'backend/news/delete/(:num)' => 'pages/backend/news/delete/$1',

//Media Uploader
    // Home Banner
    'backend/media-uploader/homebanner' => 'mediauploader/homebanner',
    'backend/media-uploader/homebanner/upload' => 'mediauploader/homebanner/upload',

    // Promo Image
    'backend/media-uploader/promo' => 'mediauploader/promo',
    'backend/media-uploader/promo/upload' => 'mediauploader/promo/upload',

    // Reward Image
    'backend/media-uploader/reward' => 'mediauploader/reward',
    'backend/media-uploader/reward/upload' => 'mediauploader/reward/upload',

    // News Image
    'backend/media-uploader/news' => 'mediauploader/news',
    'backend/media-uploader/news/upload' => 'mediauploader/news/upload',

    // Task Image
    'backend/media-uploader/task' => 'mediauploader/task',
    'backend/media-uploader/task/upload' => 'mediauploader/task/upload',

);
