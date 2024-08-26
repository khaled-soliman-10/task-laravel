<?php

use App\Http\Controllers\AuthController;
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

Route::post('login', [\App\Http\Controllers\AuthController::class,'login']);
Route::post('register', [\App\Http\Controllers\AuthController::class,'register']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    //posts
    Route::get('home', [\App\Http\Controllers\PostsController::class, 'index']);
    Route::get('post/user/{id}', [\App\Http\Controllers\PostsController::class, 'show']);
    Route::post('create/post', [\App\Http\Controllers\PostsController::class, 'store']);
    Route::put('edit/post/{id}', [\App\Http\Controllers\PostsController::class, 'update']);
    Route::delete('delete/post/{id}', [\App\Http\Controllers\PostsController::class, 'destroy']);
    //comments
    Route::post('create/comment/post/{id}', [\App\Http\Controllers\CommentsController::class, 'store']);
    Route::delete('delete/comment/{id}', [\App\Http\Controllers\CommentsController::class, 'destroy']);
});
