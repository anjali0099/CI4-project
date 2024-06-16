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
$routes->post('/loginuser', [UsersController::class, 'loginuser']);

$routes->get('/register', [UsersController::class, 'register']);
$routes->post('/store-users', [UsersController::class, 'store']);

//User Dashboard.
$routes->get('/dashboard', [DashboardController::class, 'index']);
$routes->post('/add-task', [DashboardController::class, 'add']);