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

$router->post('/register', 'UsersController@register');

$router->get('/ideas', 'IdeasController@index');

$router->group(['middleware' => 'auth'], function () use ($router) {

  $router->get('/users', 'UsersController@index');
  $router->post('/users/get_by_email', 'UsersController@get_by_email');
  $router->post('/users/get_creations', 'UsersController@get_creations');
  $router->post('/users/get_collaborations', 'UsersController@get_collaborations');
  $router->post('/users/update', 'UsersController@update');
  $router->post('/users/delete', 'UsersController@delete');
  $router->get('/users/{id}', 'UsersController@get');

  $router->post('/ideas/index_by_user', 'IdeasController@index_by_user');
  $router->post('/ideas/create', 'IdeasController@generate');
  $router->post('/ideas/update', 'IdeasController@update');
  $router->post('/ideas/delete', 'IdeasController@delete');
  $router->post('/ideas/get_users', 'IdeasController@get_users');
  $router->get('/ideas/{id}', 'IdeasController@get');

  $router->post('/request_collab', 'IdeaUsersController@generate');
});
