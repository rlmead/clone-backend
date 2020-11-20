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
use App\Http\Controllers\UsersController;

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->post('/register','UsersController@register');

$router->get('/users', 'UsersController@index');
$router->post('/users/get_id', 'UsersController@get_id');
$router->get('/users/{id}', 'UsersController@get');

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->post('/users/update', 'UsersController@update');
    $router->post('/users/delete', 'UsersController@delete');
});


