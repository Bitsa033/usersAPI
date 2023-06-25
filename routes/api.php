<?php

use App\Http\Controllers\AnimalController;
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
// Routes protégées
Route::group(['middleware'=>'auth:sanctum'],function(){
    // User
    Route::put('users/update/{id}',[AuthController::class,'update']);
    Route::delete('users/delete/{id}',[AuthController::class,'delete']);
    Route::post('users/logout',[AuthController::class,'logout']);
    // Animal
    Route::post('animals/store', [AnimalController::class,'store']);
    Route::put('animals/update/{id}', [AnimalController::class,'update']);
    Route::delete('animals/delete/{id}', [AnimalController::class,'delete']);
    Route::put('animals/update/promotion/{id}', [AnimalController::class,'promotion']);
    Route::put('animals/update/qte/in/{id}', [AnimalController::class,'addQte']);
    Route::put('animals/update/qte/out/{id}', [AnimalController::class,'removeQte']);
    
});
// Routes publiques
// User
Route::post('users/store',[AuthController::class,'store']);
Route::post('users/login',[AuthController::class,'login']);
Route::get('users/get',[AuthController::class,'getAll']);
Route::get('users/get/{id}',[AuthController::class,'getOne']);
// Animal
Route::get('animals/get', [AnimalController::class,'getAll']);
Route::get('animals/get/{id}', [AnimalController::class,'getOne']);
Route::get('animals/get/byName/{name}', [AnimalController::class,'getByName']);
// API tache
Route::resource('tache', TacheController::class);