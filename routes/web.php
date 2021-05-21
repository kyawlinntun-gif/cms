<?php

use App\Http\Controllers\WelcomeController;
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

Route::get('/', 'WelcomeController@index');
Route::get('/blog/posts/{post}', [WelcomeController::class, 'show']);
Route::get('/blog/categories/{category}', [WelcomeController::class, 'category']);
Route::get('/blog/tags/{tag}', [WelcomeController::class, 'tag']);

Auth::routes();

/* ---------- Start of Middlewares ---------- */
Route::group(['middleware' => 'auth'], function () {
    /* ---------- End of Middlewares ---------- */
    
    Route::get('/home', 'HomeController@index')->name('home');
    
    /* ---------- Start of Categories routes ---------- */
    Route::resource('categories', 'CategoriesController');
    /* ---------- End of Categories routes ---------- */

    /* ---------- Start of Tags routes ---------- */
    Route::resource('tags', 'TagsController');
    /* ---------- End of Tags routes ---------- */
    
    /* ---------- Start of Posts routes ---------- */
    Route::resource('posts', 'PostsController');
    Route::put('/posts/{post}/restore', 'PostsController@restore');
    /* ---------- End of Posts routes ---------- */
    
    /* ---------- Start of Trashed ---------- */
    Route::get('/posts/trashed', 'PostsController@trashed');
    /* ---------- End of Trashed ---------- */
});

/* ---------- Start of Admin User ---------- */
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/users', 'UsersController@index');
    Route::get('/users/{user}/make-admin', 'UsersController@makeAdmin');
    Route::get('/users/profile', 'UsersController@edit');
    Route::put('/users/profile', 'UsersController@update');
});
/* ---------- End of Admin User ---------- */
