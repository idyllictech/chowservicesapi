<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServicesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// routes/api.php

// routes/api.php




// Add the custom endpoint
Route::group(['prefix' => 'v1.0/chowhubs'], function () {

    Route::get('services', [ServicesController::class, 'services']);

    // DELETE USER
    Route::delete('users/{uuid}', [UserController::class, 'deleteUser']);

    Route::post('register', [UserController::class, 'register']);
    
    // Users
    Route::get('users', [UserController::class, 'getAllUsers']);

    // LOgin
    Route::post('login', [UserController::class, 'login']);

    //RESET PASSWORD LInk
    Route::post('send-password-reset-link', [UserController::class, 'sendPasswordResetLink']);
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
