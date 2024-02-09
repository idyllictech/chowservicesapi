<?php

use Illuminate\Support\Facades\Route;

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


