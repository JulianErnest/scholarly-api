<?php

use Illuminate\Http\Request;
use App\http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TestController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Private routes
Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::get('/token', [AuthController::class, 'getUserDetails']);
  Route::post('/logout', [AuthController::class, 'logout']);
  Route::get('/getAllUsers', [AuthController::class, 'getAllUsers']);
  Route::get('/searchUser/{keyword}', [AuthController::class, 'search']);

  // Subject
  Route::get('/subject', [SubjectController::class, 'index']);
  Route::post('/subject', [SubjectController::class, 'store']);

  // Test
  Route::get('/test', [TestController::class, 'index']);
  Route::post('/test/{id}', [TestController::class, 'store']);
  Route::get('/test/byId/{id}', [TestController::class, 'showById']);
  Route::get('/test/{id}', [TestController::class, 'show']);
  Route::put('/test/{id}', [TestController::class, 'update']);

  // Item
  Route::get('/item', [ItemController::class, 'index']);
  Route::post('/item/{id}', [ItemController::class, 'store']);
  Route::get('/item/{id}', [ItemController::class, 'showByTest']);
  Route::delete('/item/{id}', [ItemController::class, 'destroy']);
  Route::post('/item/{keyword}', [ItemController::class, 'search']);

});
