<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

// Authenticate / Login

$router->post('login', 'UserController@authenticate');

// User CRUD

$router->get('user[/{id}]', 'UserController@show');
$router->put('user/{id}', 'UserController@update');
$router->post('user/store', 'UserController@store');
$router->delete('user/{id}', 'UserController@destroy');