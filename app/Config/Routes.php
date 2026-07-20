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
$routes->get('/admin/fee_brackets/edit/(:num)', 'AdminController::edit_fee_bracket/$1');
$routes->post('/admin/fee_brackets/update/(:num)', 'AdminController::update_fee_bracket/$1');
$routes->get('/admin/gains', 'AdminController::gains');
$routes->get('/admin/clients', 'AdminController::clients');

// Version 2 routes
$routes->get('/admin/other_operators', 'AdminController::other_operators');
$routes->post('/admin/other_operators', 'AdminController::other_operators');
$routes->get('/admin/other_operators/edit/(:num)', 'AdminController::edit_other_operator/$1');
$routes->post('/admin/other_operators/update/(:num)', 'AdminController::update_other_operator/$1');
$routes->get('/admin/other_operators/delete/(:num)', 'AdminController::delete_other_operator/$1');
$routes->get('/admin/commission', 'AdminController::commission');
$routes->post('/admin/commission', 'AdminController::commission');
$routes->get('/admin/amounts_to_send', 'AdminController::amounts_to_send');

// Client routes
$routes->get('/client/login', 'ClientController::login');
$routes->post('/client/login', 'ClientController::login');
$routes->get('/client/home', 'ClientController::home');
$routes->get('/client/dashboard', 'ClientController::dashboard');
$routes->get('/client/depot', 'ClientController::depot');
$routes->post('/client/depot', 'ClientController::depot');
$routes->get('/client/retrait', 'ClientController::retrait');
$routes->post('/client/retrait', 'ClientController::retrait');
$routes->get('/client/transfert', 'ClientController::transfert');
$routes->post('/client/transfert', 'ClientController::transfert');
$routes->get('/client/historique', 'ClientController::historique');
$routes->get('/client/logout', 'ClientController::logout');
