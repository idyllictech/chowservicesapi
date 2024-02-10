<?php

use Illuminate\Support\Facades\Route;
use App\Mail\MyTestEmail;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/testroute', function() {

    $name = "Idyllic Digitest";

    // The email sending is done using the to method on the Mail facade
    Mail::to('idigits.solutions@gmail.com’')->send(new MyTestEmail($name));
});

Route::get('/testemail', function () {
    //return view('welcome');

    //return redirect('/api/v1.0/chowhubs/services');

    return redirect()->away('https://chowsapi.idigits.com.ng/phpmailertest/');
});

Route::get('/api-docs', function () {
    return view('api-docs');
});

Route::get('/', function () {
    return view('api-docs');
});

Route::get('/api', function () {
    //return view('welcome');

    return redirect('/api/v1.0/chowhubs/services');

    //return redirect()->away('/api/v1.0/chowhubs/services');
});


Route::get('/{any}', function () {
    return redirect('/api');
})->where('any', '.*');

// Fallback route to catch any invalid URL and redirect to /api
Route::fallback(function () {
    return redirect('/api');
});


