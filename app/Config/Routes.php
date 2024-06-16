<?php

use App\Controllers\DashboardController;
use App\Controllers\UsersController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->get('/', [UsersController::class, 'index']);

$routes->get('/login', [UsersController::class, 'login']);
$routes->post('/login', [UsersController::class, 'loginuser']);

$routes->get('/register', [UsersController::class, 'register']);
$routes->post('/register', [UsersController::class, 'store']);

$routes->get('/logout', [UsersController::class, 'logout']);

//User Dashboard.
$routes->get('/dashboard', [DashboardController::class, 'index']);

$routes->get('/task/create', [DashboardController::class, 'create_task']);
$routes->post('/task/create', [DashboardController::class, 'add']);

$routes->get('/task/edit/(:num)', [DashboardController::class, 'edit/$1']);
$routes->post('/task/update/(:num)', [DashboardController::class, 'update/$1']);

$routes->get('/task/delete/(:num)', [DashboardController::class, 'delete/$1']);