<?php

$router = new Router();

$router->post('admin/users/edit', 'AdminController@edit');
$router->get('admin/users/delete/{id}', 'AdminController@delete');
$router->get('admin/users', 'AdminController@users');

$router->get('admin/dashboard', 'AdminController@dashboard');
$router->post('admin/users/add', 'AdminController@store');



$router->get('admin/products', 'ProductController@index');
$router->get('admin/products/create', 'ProductController@create');
$router->post('admin/products/store', 'ProductController@store');
$router->get('admin/products/edit/{id}', 'ProductController@edit');
$router->post('admin/products/update/{id}', 'ProductController@update');
$router->get('admin/products/delete/{id}', 'ProductController@delete');
$router->get('products/detail/{id}', 'ProductController@detail');

$router->get('', 'HomeController@index');
$router->get('about', 'HomeController@about');

$router->get('auth/login', 'AuthController@login');
$router->post('auth/login', 'AuthController@login');
$router->get('auth/logout', 'AuthController@logout');

$router->get('auth/register', 'AuthController@register');
$router->post('auth/register', 'AuthController@register');
$router->get('auth/forgot-password', 'AuthController@forgotPassword');
$router->post('auth/forgot-password', 'AuthController@sendResetLink');

$router->get('reset-password/{token}', 'AuthController@resetPassword');
$router->post('reset-password', 'AuthController@updatePassword');

return $router; // 🔥 WAJIB
