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
    return 'DigitalCert API running on ' . $router->app->version();
});
$router->get('/ping', function () {
    return response('', 204);
});

$router->get('/node', 'Controller@readNode');

$router->get('/doc', function ()  {
    return view('doc');
});

$router->group(['prefix' => 'certificate/contract'], function () use ($router) {
    $router->get('/', 'CertificateController@readContract');
});

$router->group(['prefix' => 'certificate'], function () use ($router) {
    $router->get('/{hash}', 'CertificateController@read');
    $router->post('/', 'CertificateController@create');
    $router->delete('/{hash}', 'CertificateController@revoke');
});

$router->group(['prefix' => 'certifier/contract'], function () use ($router) {
    $router->get('/', 'CertifierController@readContract');
});

$router->group(['prefix' => 'certifier'], function () use ($router) {
    $router->get('/{address}', 'CertifierController@read');
    $router->get('/{address}/institution', 'CertifierController@getInstitution');
    $router->post('/', 'CertifierController@create');
    $router->delete('/{address}', 'CertifierController@remove');
});