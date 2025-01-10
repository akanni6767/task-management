<?php

use App\Controllers\Api\AuthController;
use App\Controllers\Api\TasksController;
use App\Controllers\Auth\LoginController;
use App\Controllers\DashboardController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group("", ["filter" => "auth"], function($routes) {
    $routes->get('/', [DashboardController::class, 'index']);
    $routes->post('/add_task', [DashboardController::class, 'addTask']);
});

$routes->get('/login', [LoginController::class, 'index']);
$routes->post('/auth', [LoginController::class, 'auth'], ["as" => "verify_login"]);
$routes->post('/api/auth', [AuthController::class, "index"]);

$routes->group("api", ["namespace" => "App\Controllers\Api"], function($routes) {
    // create Task POST
    $routes->post("create_task", [TasksController::class, "createTask"]);

    // Fetch all Tasks GET
    $routes->get("list_tasks", [TasksController::class, "listTasks"]);

    // Fetch all Group Tasks GET
    $routes->get("list_group_tasks", [TasksController::class, "getGroupTasks"]);

    // Fetch a Task GET
    $routes->get("get_task/(:num)", [TasksController::class, "listSingleTask"]);

    // update task PUT
    $routes->put("update_task/(:num)", [TasksController::class, "updateTask"]);

    // Delete task PUT
    $routes->delete("delete_task/(:num)", [TasksController::class, "deleteTask"]);
});
