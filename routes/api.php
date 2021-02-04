<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AntrianController;
use App\Http\Controllers\Api\DaftarController;
use App\Http\Middleware\VerifyJson;

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

Route::middleware(VerifyJson::class)->group(function () {

    Route::prefix('/user')->group(function () {
        $controller = UserController::class;
        
        Route::post('/login', [$controller, 'loginUser']);
        Route::post('/register', [$controller, 'registerUser']);
        Route::get('/', [$controller, 'dataUser']);

    });

    Route::prefix('/antrian')->group(function () {
        $controller = AntrianController::class;

        Route::get('/', [$controller, 'getAll']);
        Route::post('/create', [$controller, 'addAntrian']);
    });

    Route::prefix('/daftar')->group(function () {
        $controller = DaftarController::class;

        Route::get('/', [$controller, 'getAll']);
        Route::get('/last', [$controller, 'lastQueue']);
        Route::get('/current', [$controller, 'currentQueue']);
        Route::post('/create', [$controller, 'addDaftar']);
        Route::get('/{id}', [$controller, 'show']);
        Route::get('/rest/{id}', [$controller, 'restQueue']);
        
    });

});
