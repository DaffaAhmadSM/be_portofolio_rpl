<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AccountController;

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

    Route::group(['middleware' => ['auth:sanctum', 'role:admin|siswa']], function(){
        Route::delete('/logout', [AuthController::class, 'destroy']);
        Route::post('/post', [PostController::class, 'store']);
        Route::delete('/post/{id}', [PostController::class, 'destroy']);
        Route::delete('delete/account/{id}', [AccountController::class, 'destroy']);
    });

    Route::post('/register', [AuthController::class, 'create']);
    Route::post('/login', [AuthController::class, 'store']);
    Route::get('/index', [AuthController::class, 'index']);