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

$router->group(['prefix' => 'payment', 'as' => 'payment.', 'namespace' => 'Payments'], function() use ($router) {

    $router->post('/paystack/pay', ['as' => 'paystack.pay', 'uses' => 'Paystack@gatewayRedirect']);

    $router->get('/paystack/callback', ['as' => 'paystack.callback', 'uses' => 'Paystack@handleCallback']);
});

$router->get('/designer/preview/{type?}/{switch?}', function ($type, $switch = '')
{
    if ($type === 'test-data') {
        return dd(json_decode(file_get_contents(storage_path('test.data.txt'))));
    }
});
