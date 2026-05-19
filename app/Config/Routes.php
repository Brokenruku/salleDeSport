<?php

use CodeIgniter\Router\RouteCollection;

/**
 
@var RouteCollection $routes*/
$routes->setDefaultController('IndexController');
$routes->setDefaultMethod('index');

$routes->get('/', 'IndexController::index');
$routes->get('/index', 'IndexController::index');
$routes->get('/login',     'AuthController::login');
$routes->post('/login',    'AuthController::loginPost');
$routes->get('/register',  'AuthController::register');
$routes->post('/register', 'AuthController::registerPost');
$routes->get('/logout',    'AuthController::logout');

$routes->group('client', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'IndexController::dashboard');
    $routes->get('creneaux', 'CreneauxController::index');
    $routes->post('reserve', 'CreneauxController::reserve');
    $routes->get('reservations', 'CreneauxController::myReservations');
    $routes->post('cancel-reservation', 'CreneauxController::cancelReservation');
});

$routes->group('admin', ['filter' => 'auth:admin'], function($routes) {
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('clients', 'AdminController::clients');
    
    $routes->get('creneaux', 'AdminController::creneaux');
    $routes->get('creneaux/create', 'AdminController::createCreneau');
    $routes->post('creneaux/save', 'AdminController::saveCreneau');
    $routes->get('creneaux/edit/(:num)', 'AdminController::editCreneau/$1');
    $routes->post('creneaux/delete/(:num)', 'AdminController::deleteCreneau/$1');
    
    $routes->get('reservations', 'AdminController::reservations');
    $routes->post('reservations/update', 'AdminController::updateReservation');

    $routes->get('ressources', 'AdminController::ressources');
    $routes->get('ressources/create', 'AdminController::createRessource');
    $routes->post('ressources/save', 'AdminController::saveRessource');
    $routes->get('ressources/edit/(:num)', 'AdminController::editRessource/$1');
    $routes->post('ressources/delete/(:num)', 'AdminController::deleteRessource/$1');
});