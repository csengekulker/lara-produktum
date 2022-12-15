<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/signup', [ AuthController::class, "signUp"]);
Route::post('/signin', [ AuthController::class, "signIn"]);

Route::get('/products', [ ProductController::class, "index"]);
Route::get('product/{id}', [ ProductController::class, "show"]);

Route::post('/newproduct', [ ProductController::class, "store"]);

Route::put('/update/{id}', [ ProductController::class, "update"]);
