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

// User

$router->get('user[/{id}]', 'UserController@show');
$router->post('user/store', 'UserController@store');

// Room

$router->get('room[/{id}]', 'RoomController@show');
$router->get('room/created-by/{id}', 'RoomController@showByUserId');

// Playlist

$router->get('playlist[/{id}]', 'PlaylistController@show');
$router->get('playlist/created-by/{id}', 'PlaylistController@showByUserId');

// Track

$router->get('track/{id}', 'TrackController@show');

/**
 * Protected Routes
 *
 * Using Bearer token / API key authentication
 */
$router->group(['middleware' => 'auth'], function () use ($router) {

    // User

    $router->put('user/{id}', 'UserController@update');
    $router->delete('user/{id}', 'UserController@destroy');
    $router->post('user/password-reset', 'UserController@passwordReset');

    // Room

    $router->put('room/{id}', 'RoomController@update');
    $router->post('room/store', 'RoomController@store');
    $router->delete('room/{id}', 'RoomController@destroy');

    // Playlist

    $router->delete('playlist/{id}', 'PlaylistController@destroy');

    // Track

    $router->put('track/{id}', 'TrackController@update');
    $router->post('track/store', 'TrackController@store');
    $router->delete('track/{id}', 'TrackController@destroy');
    
});