<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\LikesController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\Postcontroller;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'],function(){
    // homepage
    Route::get('/',[HomeController::class,'index'])->name('index');
    // search
    Route::get('/people',[HomeController::class,'search'])->name('search');
    // suggest
    Route::get('/suggest',[HomeController::class,'suggest'])->name('suggest');




 Route::group(['prefix'=>'post','as'=>'post.'],function(){

    Route::get('/create',[Postcontroller::class,'create'])->name('create');

    Route::post('/store',[Postcontroller::class,'store'])->name('store');

    Route::get('/{id}/show',[Postcontroller::class,'show'])->name('show');

    Route::get('/show',[Postcontroller::class,'show'])->name('like.show');

    Route::get('/{id}/edit',[Postcontroller::class,'edit'])->name('edit');

    Route::patch('/{id}/update',[Postcontroller::class,'update'])->name('update');

    Route::delete('/{id}',[Postcontroller::class,'destroy'])->name('destroy');

 });
// comment
 Route::group(['prefix'=>'comment','as'=>'comment.'],function(){

    Route::post('/{post_id}/store',[CommentController::class,'store'])->name('store');

    Route::delete('/{id}',[CommentController::class,'destroy'])->name('destroy');

 });

 // profile
 Route::group(['prefix'=>'profile','as'=>'profile.'],function(){

    Route::get('/{id}/show',[ProfileController::class,'show'])->name('show');

    Route::get('/edit',[ProfileController::class,'edit'])->name('edit');

    Route::patch('/update',[ProfileController::class,'update'])->name('update');

    Route::get('/{id}/followers', [ProfileController::class, 'followers'])->name('followers');

    Route::get('/{id}/followings', [ProfileController::class, 'followings'])->name('followings');

 });

 // like
 Route::group(['prefix'=>'like','as'=>'like.'],function(){

    Route::post('/{post_id}/store',[LikeController::class,'store'])->name('store');

    Route::delete('/{post_id}/destroy',[LikeController::class,'destroy'])->name('destroy');
 });

  // follow
 Route::group(['prefix'=>'follow','as'=>'follow.'],function(){

    Route::post('/{user_id}/store',[FollowController::class,'store'])->name('store');

    Route::delete('/{user_id}/destroy',[FollowController::class,'destroy'])->name('destroy');

});

// admin routes
Route::group(['prefix'=>'admin','as'=>'admin.','middleware'=>'admin'],function(){

    // user
    Route::get('/users',[UsersController::class,'index'])->name('users');

    Route::delete('/users/{id}/deactivate',[UsersController::class,'deactivate'])->name('users.deactivate');

    Route::post('/users/{id}/activate',[UsersController::class,'activate'])->name('users.activate');

      // search
    Route::get('/search',[UsersController::class,'search'])->name('search');



    // post
    Route::get('/posts',[PostsController::class,'index'])->name('posts');

    Route::delete('/posts/{id}/hide',[PostsController::class,'hide'])->name('posts.hide');

    Route::post('/posts/{id}/unhide',[PostsController::class,'unhide'])->name('posts.unhide');

    Route::get('/post/search',[PostsController::class,'search'])->name('posts.search');

    // category
    Route::get('/categories',[CategoriesController::class,'index'])->name('categories');

    Route::post('/store',[CategoriesController::class,'store'])->name('store');

    Route::patch('/{id}/update',[CategoriesController::class,'update'])->name('update');

    Route::delete('/{id}',[CategoriesController::class,'destroy'])->name('destroy');

    // like
    Route::get('/likes',[LikesController::class,'index'])->name('likes');



});

});
