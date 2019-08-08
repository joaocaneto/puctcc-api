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

$router->post('produtos', 'ProdutosController@store');
$router->get('produtos', 'ProdutosController@index');
$router->get('series/{id}', 'SeriesController@show');
$router->put('series/{id}', 'SeriesController@update');
$router->delete('series/{id}', 'SeriesController@destroy');
