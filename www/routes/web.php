<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


$route->addRoute("GET", "/login", [\App\Http\Controllers\Auth\LoginController::class, "login"]);
$route->addRoute("POST", "/login", [\App\Http\Controllers\Auth\LoginController::class, "login"]);
$route->addRoute("GET", "/dashboard", [\App\Http\Controllers\PollenPlus\DashboardController::class, "dashboard"]);
$route->addRoute("GET", "/", [\App\Http\Controllers\PollenPlus\DashboardController::class, "dashboard"]);

// Utilisateurs
$route->addGroup('/users', function ($route) {
    $route->addRoute('GET', '', [\App\Http\Controllers\PollenPlus\UsersController::class, 'index']);
    $route->addRoute("GET", "/create", [\App\Http\Controllers\PollenPlus\UsersController::class, "create"]);
    $route->addRoute("GET", "/edit/{id}", [\App\Http\Controllers\PollenPlus\UsersController::class, "edit"]);
    $route->addRoute("GET", "/profile/{id}", [\App\Http\Controllers\PollenPlus\UsersController::class, "show"]);
    $route->addRoute("POST", "/create", [\App\Http\Controllers\PollenPlus\UsersController::class, "create"]);
    $route->addRoute("POST", "/profile/edit/{id}", [\App\Http\Controllers\PollenPlus\UsersController::class, "editProfile"]);
    $route->addRoute("POST", "/profile/second/edit/{id}", [\App\Http\Controllers\PollenPlus\UsersController::class, "editCompletProfile"]);
    $route->addRoute("DELETE", "/delete/{id}", [\App\Http\Controllers\PollenPlus\UsersController::class, "delete"]);
    $route->addRoute("GET", "/confirm/{id}_{slug}", [\App\Http\Controllers\Auth\ComfirmedController::class, "confirm"]);
    $route->addRoute("GET", "/logout", [\App\Http\Controllers\Auth\LoginController::class, "logout"]);
});

// Projet
$route->addGroup('/projects', function ($route) {
    $route->addRoute("GET", "", [\App\Http\Controllers\PollenPlus\ProjectsController::class, "index"]);
    $route->addRoute("GET", "/create", [\App\Http\Controllers\PollenPlus\ProjectsController::class, "create"]);
    $route->addRoute("POST", "/create", [\App\Http\Controllers\PollenPlus\ProjectsController::class, "create"]);
    $route->addRoute("GET", "/{id}", [\App\Http\Controllers\PollenPlus\ProjectsController::class, "show"]);
    $route->addRoute("DELETE", "/delete/{id}", [\App\Http\Controllers\PollenPlus\ProjectsController::class, "delete"]);
    $route->addRoute("GET", "/update/{slug}-{id}", [\App\Http\Controllers\PollenPlus\ProjectsController::class, "update"]);
});

// Client
$route->addGroup('/customers', function ($route) {
    $route->addRoute("GET", "", [\App\Http\Controllers\PollenPlus\CustomersControllers::class, "index"]);
    $route->addRoute("GET", "/create", [\App\Http\Controllers\PollenPlus\CustomersControllers::class, "create"]);
    $route->addRoute("POST", "/create", [\App\Http\Controllers\PollenPlus\CustomersControllers::class, "create"]);
    $route->addRoute("DELETE", "/delete/{id}", [\App\Http\Controllers\PollenPlus\CustomersControllers::class, "delete"]);
});

// Invoice
$route->addGroup('/invoices', function ($route) {
    $route->addRoute("GET", "", [\App\Http\Controllers\PollenPlus\InvoiceController::class, "index"]);
    $route->addRoute("GET", "/create", [\App\Http\Controllers\PollenPlus\InvoiceController::class, "create"]);
    $route->addRoute("POST", "/create", [\App\Http\Controllers\PollenPlus\InvoiceController::class, "create"]);
    $route->addRoute("GET", "/{id}", [\App\Http\Controllers\PollenPlus\InvoiceController::class, "show"]);
    $route->addRoute("GET", "/template/list-{id}", [\App\Http\Controllers\PollenPlus\InvoiceController::class, "templatepage"]);

    $route->addRoute("GET", "/template/make/opengellar-{id}", [\App\Http\Controllers\PollenPlus\InvoiceController::class, "opengellar"]);

    $route->addRoute("GET", "/template/make/dentellar-{id}", [\App\Http\Controllers\PollenPlus\InvoiceController::class, "dentellar"]);

    $route->addRoute("GET", "/template/make/amenellar-{id}", [\App\Http\Controllers\PollenPlus\InvoiceController::class, "amenellar"]);
});

$route->addGroup('/products', function ($route) {
    $route->addRoute("POST", "/create/{id}", [\App\Http\Controllers\PollenPlus\ProductsController::class, "create"]);
});

// Database

$route->addGroup('/database', function ($route) {
    $route->addRoute("GET", "/dump/list", [\App\Http\Controllers\PollenPlus\DatabaseController::class, "index"]);
    $route->addRoute("GET", "/dump/make", [\App\Http\Controllers\PollenPlus\DatabaseController::class, "make"]);
    $route->addRoute("GET", "/dump/delete", [\App\Http\Controllers\PollenPlus\DatabaseController::class, "delete"]);
    $route->addRoute("GET", "/dump/download/file/{id}", [\App\Http\Controllers\PollenPlus\DatabaseController::class, "download"]);

    $route->addRoute("GET", "/database/sync", [\App\Http\Controllers\PollenPlus\DatabaseController::class, "synchroniser"]);

});

$route->addGroup('/recovery', function ($route) {
$route->addRoute("GET", "/data", [\App\Http\Controllers\PollenPlus\AnotherController::class, "recovery"]);
    $route->addRoute("GET", "/user/recover/{id}", [\App\Http\Controllers\PollenPlus\AnotherController::class, "userrecover"]);
    $route->addRoute("GET", "/customer/recover/{id}", [\App\Http\Controllers\PollenPlus\AnotherController::class, "customerrecover"]);
    $route->addRoute("GET", "/projet/recover/{id}", [\App\Http\Controllers\PollenPlus\AnotherController::class, "projetrecover"]);


    $route->addRoute("GET", "/user/delete/{id}", [\App\Http\Controllers\PollenPlus\AnotherController::class, "userdelete"]);
    $route->addRoute("GET", "/customer/delete/{id}", [\App\Http\Controllers\PollenPlus\AnotherController::class, "customerdelete"]);
    $route->addRoute("GET", "/projet/delete/{id}", [\App\Http\Controllers\PollenPlus\AnotherController::class, "projetdelete"]);
});




$route->addRoute("GET", "/notification/push", [\App\Http\Controllers\PollenPlus\AnotherController::class, "notification"]);
$route->addRoute("POST", "/notification/send", [\App\Http\Controllers\PollenPlus\AnotherController::class, "notificationsend"]);



$route->addRoute("GET", "/domain/whois", [\App\Http\Controllers\PollenPlus\AnotherController::class, "domain"]);

$route->addRoute("GET", "/domain/whois/ask", [\App\Http\Controllers\PollenPlus\AnotherController::class, "domainask"]);



$route->addRoute("GET", "/admin/database/sync", [\App\Http\Controllers\PollenPlus\DatabaseController::class, "databaseSync"]);



