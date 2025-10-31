<?php

use App\Http\Controllers\CourController;
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

Route::post('new/users',[UserController::class , 'store']);
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
  Route::get('cours',[CourController::class ,'index']);
  Route::post('cours/create',[CourController::class ,'store'])->middleware('teacher');
  Route::get('cours/{id}/show',[CourController::class ,'show'])->middleware('teacher');
  Route::put('cours/{id}/edit',[CourController::class ,'update'])->middleware('teacher');
  Route::delete('cours/{id}',[CourController::class ,'destroy'])->middleware('teacher');
  Route::post('cours/enroll/{id}',[CourController::class ,'enroll'])->middleware('etudent');
  Route::get('my-cours',[CourController::class ,'mycours'])->middleware('etudent');
});

