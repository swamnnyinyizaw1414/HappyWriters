<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\NotificationsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[BlogController::class,'index']);

Route::get('/redirect', function () {
    return Inertia::render('Auth');
});

Route::post('/redirect',[AuthController::class,'logout'])->name('redirect');

Route::get('/signup',[AuthController::class,'getSignup']);
Route::post('/signup',[AuthController::class,'postSignup']);

Route::get('/login',[AuthController::class,'getLogin']);
Route::post('/login',[AuthController::class,'postLogin']);



Route::get('blogs/{id}',[BlogController::class,'show']);

Route::post("/follow/{user_id}", [FollowController::class, 'follow']);  
Route::post("/unfollow/{user_id}", [FollowController::class, 'unfollow']);

Route::post("/viewer", [BlogController::class, 'viewer']);  

Route::post('/profile',[AuthController::class,'updateProfile']);

Route::middleware('auth')->group(function() {
    Route::get('/blog/create',[BlogController::class,'create']);
    Route::post('/blog/store',[BlogController::class,'store']);

    Route::post('/comment',[CommentController::class,'store']);
    Route::get('/following',[BlogController::class,'following']);

});