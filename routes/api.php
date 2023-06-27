<?php

use App\Http\Controllers\ProduitController;
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

// Route::group(['middleware'=>'auth:sanctum'],function(){
//     // User
    
//     // Animal
    
// });

// Routes publiques

// User
Route::post('user/store',[AuthController::class,'store']);
Route::post('user/login',[AuthController::class,'login']);
Route::post('user/logout',[AuthController::class,'logout']);
Route::get('users',[AuthController::class,'index']);
Route::get('user/{id}',[AuthController::class,'show']);
Route::put('user/update/{id}',[AuthController::class,'update']);
Route::delete('user/delete/{id}',[AuthController::class,'delete']);

// Produit
Route::post('produit/store', [ProduitController::class,'store']);
Route::put('produit/update/{id}', [ProduitController::class,'update']);
Route::delete('produit/delete/{id}', [ProduitController::class,'delete']);
Route::put('produit/update/promotion/{id}', [ProduitController::class,'setPromotion']);
Route::put('produit/qty/add/{id}', [ProduitController::class,'addQte']);
Route::put('produit/qty/withdrap/{id}', [ProduitController::class,'removeQte']);
Route::get('produits', [ProduitController::class,'index']);
Route::get('produit/{id}', [ProduitController::class,'show']);
Route::get('produit/showbyname/{name}', [ProduitController::class,'showByName']);

// API tache
Route::resource('tache', TacheController::class);