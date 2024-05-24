<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'UserController::sign_in');


// Routes for admin
$routes->get('sign_in', 'UserController::sign_in');
$routes->get('sign_up', 'UserController::sign_up');
$routes->get('admin', 'UserController::sign_in');
$routes->get('book', 'BookController::index');
$routes->get('book_create', 'BookController::create');
$routes->post('book_store', 'BookController::store');
$routes->get('book_edit/(:segment)', 'BookController::edit/$1');
$routes->post('book_update', 'BookController::update_book');
$routes->post('book_delete', 'BookController::delete');
$routes->post('check_register', 'UserController::check_reg');
$routes->post('check_login_f', 'UserController::check_login');


$routes->group('/admin',['filter' => 'Auth'],function($routes){
    $routes->get('book', 'BookController::index');
    $routes->get('user', 'UserController::sign_in');
});




