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

$router->post('/admin/variants/store', 'ProductVariantController@store');
$router->post('/admin/variants/update/{id}', 'ProductVariantController@update');
$router->get('/admin/variants/delete/{id}', 'ProductVariantController@delete');

$router->get('/admin/products/{id}/variants', 'ProductController@variants');
$router->post('admin/products/variants/delete/{id}', 'ProductController@deleteVariant');

$router->get('/admin/variant-wholesale', 'ProductWholesaleController@index');
$router->post('/admin/wholesale-prices', 'ProductWholesaleController@store');
$router->get('/product_wholesale/delete/{variant_id}', 'ProductWholesaleController@delete');
$router->post('/product_wholesale/update', 'ProductWholesaleController@update');

$router->post('admin/categories/store', 'CategoryController@store');
$router->get('admin/categories/all', 'CategoryController@all'); // untuk fetch JSON
$router->post('admin/categories/delete/(\d+)', 'CategoryController@delete');







return $router; // 🔥 WAJIB
