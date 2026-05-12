<?php

use CodeIgniter\Router\RouteCollection;

/**
 
@var RouteCollection $routes*/
$routes->setDefaultController('IndexController');
$routes->setDefaultMethod('index');

$routes->get('/', 'IndexController::index');
$routes->get('/index', 'IndexController::index');
$routes->get('/creneaux', 'CreneauxController::index');