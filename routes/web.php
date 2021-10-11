<?php

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
Auth::routes();

Route::get('/', function () {
    return view('home');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('layouts.dashboard');
    })->name('dashboard');
    
    
    Route::resource('/articles', 'ArticleController');
    Route::get('/articles-list', 'ArticleController@list')->name('articles.list');
    
    Route::resource('/users', 'UserController');
    Route::get('/users-list', 'UserController@list')->name('users.list');
});


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');