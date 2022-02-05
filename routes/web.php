<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::name('payment.')->prefix('payment')->group(function() {

    Route::post('/paystack/pay', [App\Http\Controllers\Payments\Paystack::class, 'gatewayRedirect'])->name('paystack.pay');

    Route::get('/paystack/callback', [App\Http\Controllers\Payments\Paystack::class, 'handleCallback'])->name('paystack.callback');
});

if (config('app.env') === 'local')
{
    Route::get('/designer/preview/{type?}/{switch?}', function ($type, $switch = '')
    {
        if ($type === 'test-data') {
            if ($switch === 'download') {
                return response()->download(storage_path('test.data.txt'), 'test.data.txt');
            }
            return dd(@json_decode(file_get_contents(storage_path('test.data.txt'))));
        }
    });
}
