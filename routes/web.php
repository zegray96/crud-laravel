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
Auth::routes(['register'=>false]);

Route::get('migrate', function () {
    Artisan::call('migrate');
    return "Las migraciones se ejecutaron con exito.";
});

Route::get('migrate-fresh', function () {
    Artisan::call('migrate:fresh');
    return "Las migraciones se volvieron a cargar con exito.";
});

Route::get('db-seed', function () {
    Artisan::call('db:seed');
    return "Los seeders se ejecutaron con exito.";
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('layouts.dashboard');
    })->name('dashboard');
    
    
    Route::resource('/articles', 'ArticleController');
    Route::get('/articles-list', 'ArticleController@list')->name('articles.list');
    
    Route::resource('/users', 'UserController');
    Route::get('/users-list', 'UserController@list')->name('users.list');
});