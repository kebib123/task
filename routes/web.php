<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// API route group
$router->group(['prefix' => 'api'], function () use ($router) {
    // Matches "/api/register
    $router->post('register', 'AuthController@register');
    // Matches "/api/login
    $router->post('login', 'AuthController@login');

    $router->post('roles', 'UserController@roles');
    $router->group(['middleware' => 'auth:api'], function () use ($router) {
        $router->post('setting', 'UserController@time_setting');
        $router->post('task', 'UserController@task');
        $router->get('task', 'UserController@task');
    });
});
