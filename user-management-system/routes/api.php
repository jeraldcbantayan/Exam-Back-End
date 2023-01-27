<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

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
Route::get('/employees',[App\Http\Controllers\UserController::class, 'index']);

Route::post('/save',[\App\Http\Controllers\UserController::class, 'store']);

Route::put('/update/{id}',[\App\Http\Controllers\UserController::class, 'update']);

Route::get('/edit/{id}',[\App\Http\Controllers\UserController::class,'edit']);

Route::delete('/delete/{id}',[\App\Http\Controllers\UserController::class,'destroy']);

Route::post('/login',[\App\Http\Controllers\UserController::class, 'customLogin']);
Route::get('/logout',[\App\Http\Controllers\UserController::class, 'logout']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
