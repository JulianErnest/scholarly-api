<?php

use Illuminate\Http\Request;
use App\http\Controllers\AuthController;
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

  // Subject
  Route::get('/subject', [SubjectController::class, 'index']);
  Route::post('/subject', [SubjectController::class, 'store']);

  // Test
  Route::get('/test', [TestController::class, 'index']);
  Route::post('/test/{id}', [TestController::class, 'store']);
  Route::get('/test/{id}', [TestController::class, 'show']);
});
