<?php
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded  within a group which
| is assigned the "api"  group. Enjoy building your API!
|
*/


$route->addGroup('/api', function ($route) {
    $route->addRoute('GET', '/users/index', [\App\Http\Controllers\ApiController::class, 'index']);
});


