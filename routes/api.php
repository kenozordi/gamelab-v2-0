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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//admin auth routes
Route::group(['prefix' => 'admin'], function () {
    // Route::get('/create', 'AdminLoginController@create');
    Route::post('/', 'AdminApi@authenticate')->name('admin.login');
    Route::get('/test', 'AdminApi@test');
});
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/logout', 'AdminApi@logout')->name('admin.logout');
});
