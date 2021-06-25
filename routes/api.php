<?php

use App\Http\Controllers\penggunasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/pengguna', [penggunasController::class, 'index']);
// Route::post('/pengguna', [penggunasController::class, 'store']);
// Route::get('/pengguna/{id}', [penggunasController::class, 'show']);
// Route::put('/pengguna/{id}', [penggunasController::class, 'update']);
// Route::delete('/pengguna/{id}', [penggunasController::class, 'destroy']);

route::resource('/pengguna', penggunasController::class)->except(['create', 'edit']);