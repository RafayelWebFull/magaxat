<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppealsController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\InstagramController;
use App\Http\Controllers\InterestingTypesController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UserAppealsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPostsController;
use App\Models\InterestingType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// $lang = LaravelLocalization::setLocale();
// Route::group([
//     'prefix' => $lang,
//     'middleware' => ['localizationRedirect', 'localeViewPath']
// ], function () {
// //our routes
// });


Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    Route::get('/', [FrontController::class, 'home'])->name('welcome');
    Route::get('/all-users',[FrontController::class, 'all_users'])->name('all-users');
    Route::get('/all-benefactors',[FrontController::class, 'all_benefactors'])->name('all-benefactors');
    Route::get('/all-appeals',[FrontController::class, 'all_appeals'])->name('all-appeals');
    Route::get('/all-appeals/{appeal}',[FrontController::class, 'show_appeal'])->name('show-appeal');
    Route::get('/all-users/{user}',[FrontController::class, 'show_user_page'])->name('user.page');
    Route::get('/all-videos/',[FrontController::class, 'show_videos_page'])->name('all-videos');
    Route::get('/all-videos/{id}',[FrontController::class, 'show_video_page'])->name('show-video');
    Route::post('/subscribe/{id}',[FrontController::class, 'subscribe'])->name('subscribe');
    Route::post('/unsubscribe/{id}',[FrontController::class, 'unsubscribe'])->name('unsubscribe');
    Route::get('interesting-types', [InterestingTypesController::class, 'all_types']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/loadposts', [FrontController::class, 'load_more_posts']);
    Route::get('payment', [FrontController::class, 'payment'])->name('payment');
    Route::post('posts/{post}/share', [UserPostsController::class, 'share_post'])->name('post.share');


    Route::group(['middleware' => 'auth', 'as' => 'user.'], function() {

        // profile routes
        Route::get('profile', [UserController::class, 'profile'])->name('profile');
        Route::put('update-profile-image', [UserController::class, 'update_profile_image'])->name('user.update-profile-image');

        /** user posts routes */
        Route::get('my-posts', [UserPostsController::class, 'my_posts'])->name('my_posts');
        Route::get('my-posts/create', [UserPostsController::class, 'create'])->name('posts.create');
        Route::post('my-posts/create', [UserPostsController::class, 'store'])->name('posts.store');
        Route::get('my-posts/{post}/edit', [UserPostsController::class, 'edit'])->name('posts.edit');
        Route::put('my-posts/{post}/edit', [UserPostsController::class, 'update'])->name('posts.update');
        Route::delete('my-posts/{post}/delete', [UserPostsController::class, 'delete'])->name('posts.delete');

        /** user appeals routes */
        Route::get('my-appeals', [UserAppealsController::class, 'my_appeals'])->name('my_appeals');
        Route::get('my-appeals/create', [UserAppealsController::class, 'create'])->name('appeals.create');
        Route::post('my-appeals/create', [UserAppealsController::class, 'store'])->name('appeals.store');
        Route::get('my-appeals/{appeal}/edit', [UserAppealsController::class, 'edit'])->name('appeals.edit');
        Route::put('my-appeals/{appeal}/edit', [UserAppealsController::class, 'update'])->name('appeals.update');
        Route::delete('my-appeals/{appeal}/delete', [UserAppealsController::class, 'delete'])->name('appeals.delete');
        Route::get('my-appeals/{appeal}/images', [UserAppealsController::class, 'appeal_images'])->name('appeal.images');
        Route::get('my-appeals/{appeal}/images/create', [UserAppealsController::class, 'add_appeal_image'])->name('appeal-images.create');
        Route::post('my-appeals/{appeal}/images/create', [UserAppealsController::class, 'store_appeal_image'])->name('appeal-images.store');
        Route::get('my-appeals/{appeal}/images/{image}/edit', [UserAppealsController::class, 'edit_appeal_image'])->name('appeal-images.edit');
        Route::put('my-appeals/{appeal}/images/{image}/update', [UserAppealsController::class, 'update_appeal_image'])->name('appeal-images.update');
        Route::delete('my-appeals/{appeal}/images/{image}', [UserAppealsController::class, 'delete_appeal_image'])->name('appeal-images.delete');

        // post comments

        Route::get('posts/{post}/get-last-comment', [UserPostsController::class, 'get_last_comment']);
        Route::post('posts/{post}/add-comment', [UserPostsController::class, 'add_comment'])->name('post.add-comment');
        Route::post('posts/{post}/add-like', [UserPostsController::class, 'add_like'])->name('post.add_like');
        Route::delete('posts/{post}/delete-like', [UserPostsController::class, 'delete_like'])->name('post.delete_like');

        /** profile routes */
        Route::put('profile', [UserController::class,'update_profile'])->name('update-profile');
        Route::get('chat', [FrontController::class, 'chat'])->name('chat');

    });

    /** Users */
    Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'as' => 'admin.'], function() {
        Route::get('/home', [AdminController::class, 'home']);
        Route::get('users', [AdminController::class, 'users'])->name('users');
        Route::delete('users/{user}', [AdminController::class, 'delete_user'])->name('users.delete');
        Route::put('users/{user}/block', [AdminController::class, 'block_user'])->name('users.block');
        Route::put('users/{user}/unblock', [AdminController::class, 'unblock_user'])->name('users.unblock');
        Route::get('/users/create', [AdminController::class, 'create_user'])->name('users.create');
        Route::post('/users', [AdminController::class, 'store_user'])->name('users.store');
        Route::resource('interesting-types', InterestingTypesController::class);
        Route::resource('countries', CountriesController::class);
        Route::post('countries/add-countries', [CountriesController::class, 'add_all']);
    });

    Auth::routes();

});






/* Facebook Login Routes**/
Route::get('/auth/facebook/', [FacebookController::class, 'FacebookLogin'])->name('facebook.login');
Route::get('/auth/facebook/redirect', [FacebookController::class, 'callback']);

/* Instagram Login Routes**/
Route::get('/auth/instagram/', [InstagramController::class, 'InstagramLogin'])->name('instagram.login');
Route::get('/auth/instagram/redirect', [InstagramController::class, 'callback']);


Route::get('posts/{post}/all-comments', [UserPostsController::class, 'all_comments'])->name('post.all-comments');




