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
$router->get('/ping', function () {
    return response('', 204);
});


$router->group(['prefix' => 'certificate'], function () use ($router) {
    $router->get('/{hash}', 'CertificateController@read');
    $router->post('/', 'CertificateController@create');
    $router->delete('/{hash}', 'CertificateController@revoke');
});


$router->group(['prefix' => 'certifier'], function () use ($router) {
    $router->get('/{hash}', 'CertifierController@read');
    $router->get('/{hash}/institution', 'CertifierController@readInstitution');
    $router->post('/', 'CertifierController@create');
    $router->delete('/{hash}', 'CertifierController@remove');
});
