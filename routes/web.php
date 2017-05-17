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

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->get('/index', 'IndexController@index');

$app->get('/list/{id}', 'IndexController@getList');

$app->get('/{gid}/info', 'IndexController@info');

$app->get('/sort', 'IndexController@sort');

$app->get('/tag', 'IndexController@tag');

$app->get('/{tid}/{tag}', 'IndexController@tagList');

$app->post('/login', 'IndexController@login');

$app->get('/login', 'IndexController@login');

$app->get('/user', 'IndexController@user');