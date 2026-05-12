<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setDefaultController('IndexController');
$routes->setDefaultMethod('index');

$routes->get('/', 'AuthController::login');

$routes->get('/login',     'AuthController::login');
$routes->post('/login',    'AuthController::loginPost');
$routes->get('/register',  'AuthController::register');
$routes->post('/register', 'AuthController::registerPost');
$routes->get('/logout',    'AuthController::logout');