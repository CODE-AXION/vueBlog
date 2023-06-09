<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
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

Route::get('/categories',[CategoryController::class,'index']);
Route::get('/posts',[PostController::class,'index']);

Route::post('/store-post',[PostController::class,'store']);
Route::get('/get/categories',[CategoryController::class,'getCategories'])->name('all.categories');

Route::get('/get/posts',[PostController::class,'getPosts'])->name('all.posts');

Route::delete('/delete/posts/{id}',[PostController::class,'deletePosts'])->name('delete.post');


