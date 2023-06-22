<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TacheController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// API Users
Route::get('users/get',[AuthController::class,'getAll']);
Route::get('users/get/{id}',[AuthController::class,'getOne']);
Route::post('users/store',[AuthController::class,'store']);
Route::put('users/update/{id}',[AuthController::class,'update']);
Route::post('users/login',[AuthController::class,'login']);
Route::post('users/logout',[AuthController::class,'logout']);
// API Animals
Route::get('animals/get', [AnimalController::class,'getAll']);
Route::get('animals/get/{id}', [AnimalController::class,'getOne']);
Route::get('animals/get/byName/{name}', [AnimalController::class,'getByName']);
Route::post('animals/store', [AnimalController::class,'store']);
Route::put('animals/update', [AnimalController::class,'update']);
Route::delete('animals/delete', [AnimalController::class,'delete']);
// API tache
Route::resource('tache', TacheController::class);