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

$router->post('login', 'TokenController@login');

$router->get('produtos', ['middleware' => 'auth', 'uses' => 'ProdutosController@index']); 

$router->get('produtos/{idProduto}', ['middleware' => 'auth', 'uses' => 'ProdutosController@show']);   

$router->post('produtos', ['middleware' => 'auth', 'uses' => 'ProdutosController@store']);

$router->put('produtos/{idProduto}', ['middleware' => 'auth', 'uses' => 'ProdutosController@update']);

$router->put('produtos/{idProduto}/atualizarEstoque/{valor}', ['middleware' => 'auth', 'uses' => 'ProdutosController@update']);