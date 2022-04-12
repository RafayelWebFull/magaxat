<?php

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\LogoutController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Country\CountryController;
use App\Http\Controllers\Api\V1\Post\PostController;
use App\Http\Controllers\Api\V1\Profile\ProfileController;
use App\Http\Controllers\Api\V1\Users\UsersController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth:api'], function() {
    Route::get('chat-users', [MessagesController::class, 'all_users']);
    Route::get('/top-chat-user', [MessagesController::class, 'top_chat_user']);
    Route::get('/messages', [MessagesController::class, 'index']);
    Route::post('/messages', [MessagesController::class, 'storeMessage']);
    Route::get('/chat-users', [MessagesController::class, 'all_users']);
    Route::get('/top-chat-user', [MessagesController::class, 'top_chat_user']);
    Route::post('/block-user', [MessagesController::class, 'block_user']);
    Route::post('/unblock-user', [MessagesController::class, 'unblock_user']);

     /** notifications */
     Route::get('my_notifications', [UserController::class, 'my_notifications']);
     Route::post('check-notification', [UserController::class, 'check_notification']);

     Route::get('notification-user', [UserController::class, 'get_notification_user']);
});

// Application API routes
Route::prefix("v1")->middleware('json.response')->group(function () {
    Route::post("/login",[LoginController::class,'login']);
    Route::post("/register",[RegisterController::class,'register']);


    // Getter routes
    Route::apiResource('/countries',CountryController::class)->only(['index']);
    Route::get('/users/list', [UsersController::class, 'getUsersList']);

    // Authenticated routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout',[LogoutController::class,'logout']);

        // Profile routes
        Route::prefix('profile')->group(function () {
            Route::get('/me',[ProfileController::class,'me']);
            Route::patch('/update',[ProfileController::class,'update']);
        });

        // Post routes
        Route::prefix('posts')->group(function () {
            Route::get('/',[PostController::class,'index']);
            Route::post('/',[PostController::class,'store']);
            Route::get('/{post}',[PostController::class,'find']);
            Route::patch('/{post}',[PostController::class,'update']);
            Route::delete('/{post}',[PostController::class,'remove']);
        });

        // Users routes
        Route::apiResource('users', UsersController::class)->except(['store','update']);
        Route::post('users/changeStatus/{user}', [UsersController::class,'changeStatus']);
    });
});
