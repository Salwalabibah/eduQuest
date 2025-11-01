<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Spatie\Permission\Middlewares\RoleMiddleware;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->middleware('auth:sanctum');
});

// group route dengan middleware
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return response()->json(['message' => 'Welcome, Admin!']);
    });
    
    Route::resource('users', UserController::class);
});
