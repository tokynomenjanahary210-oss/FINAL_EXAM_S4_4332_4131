<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->setAutoRoute(false);
$routes->get('/', 'Home::index');

// Admin routes
$routes->get('/admin', 'AdminController::index');
$routes->get('/admin/prefixes', 'AdminController::prefixes');
$routes->post('/admin/prefixes', 'AdminController::prefixes');
$routes->get('/admin/operation_types', 'AdminController::operation_types');
$routes->post('/admin/operation_types', 'AdminController::operation_types');
$routes->get('/admin/operation_types/delete/(:num)', 'AdminController::delete_operation_type/$1');
$routes->get('/admin/fee_brackets', 'AdminController::fee_brackets');
$routes->post('/admin/fee_brackets', 'AdminController::fee_brackets');
$routes->get('/admin/fee_brackets/delete/(:num)', 'AdminController::delete_fee_bracket/$1');
$routes->get('/admin/gains', 'AdminController::gains');
$routes->get('/admin/clients', 'AdminController::clients');

// Client routes
$routes->get('/client/login', 'ClientController::login');
$routes->post('/client/login', 'ClientController::login');
$routes->get('/client/dashboard', 'ClientController::dashboard');
$routes->get('/client/depot', 'ClientController::depot');
$routes->post('/client/depot', 'ClientController::depot');
$routes->get('/client/retrait', 'ClientController::retrait');
$routes->post('/client/retrait', 'ClientController::retrait');
$routes->get('/client/transfert', 'ClientController::transfert');
$routes->post('/client/transfert', 'ClientController::transfert');
$routes->get('/client/historique', 'ClientController::historique');
$routes->get('/client/logout', 'ClientController::logout');
