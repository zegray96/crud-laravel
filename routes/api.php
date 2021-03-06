<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', 'Api\AuthController@login');

Route::post('/logout', 'Api\AuthController@logout')->middleware('auth:sanctum');

Route::get('/users', 'Api\AuthController@users')->middleware('auth:sanctum', 'can:users.list');

Route::get('/articles', 'ArticleController@list')->middleware('auth:sanctum', 'can:articles.list');
