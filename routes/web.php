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

$router->get('/', 'HealthCheckController@index');

$router->group(['prefix' => 'api/v1/products'], function () use ($router) {
    $router->get('/', 'ProductController@list');
    $router->get('/{id}', 'ProductController@index');
});

$router->group(['prefix' => 'api/v1/user'], function () use ($router) {
    $router->post('/auth', 'UserController@auth');
    $router->post('/signup', 'UserController@signup');
    $router->get('/profile', 'UserController@profile');
});
