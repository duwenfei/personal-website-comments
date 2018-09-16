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

$router->group(['middleware' => 'access_control'], function () use ($router) {
    $router->get('getlist', [
		'as' => 'getList', 'uses' => 'IndexController@getList'
	]);
    $router->post('addComment', [
		'as' => 'addComment', 'uses' => 'IndexController@addComment'
	]);
});

// $router->get('getlist', [
// 		'as' => 'getList', 'uses' => 'IndexController@getList'
// ]);

// $router->get('posts/{postId}/comments/{commentId}', function ($postId, $commentId) {
// 	'as' => 'getlist', 'uses' => 'IndexController@getList'
// });
