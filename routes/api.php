<?php

use App\Http\Controllers\UserController;
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

Route::post('users',[UserController::class , 'store']);
Route::post('register',[UserController::class , 'register']);
Route::post('login',[UserController::class , 'login']);
Route::post('logout',[UserController::class , 'logout'])->middleware('auth:sanctum');
// Route::post('users/create/',[UserController::class , 'store'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function(){
  Route::get('users',[UserController::class , 'index'])->middleware('admin');
  Route::post('users/create/',[UserController::class , 'store'])->middleware('admin');
  Route::get('users/{id}',[UserController::class , 'show'])->middleware('admin');
  Route::put('users/{id}/edit',[UserController::class , 'update'])->middleware('admin');
  Route::delete('users/{id}',[UserController::class , 'destroy'])->middleware('admin');
});

