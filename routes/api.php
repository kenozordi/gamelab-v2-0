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
    Route::post('/login', 'AdminApi@authenticate')->name('admin.login');
    Route::get('/admins', 'AdminApi@all');
    Route::get('/test', 'AdminApi@test');
    Route::get('/{id}', 'AdminApi@get');
    Route::post('/store', 'AdminApi@store');
    Route::delete('/{id}', 'AdminApi@delete');
});

// Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
Route::group(['prefix' => 'admin'], function () {

    //gamers routes
    Route::get('/gamer/gamers', 'GamerApi@all');
    Route::get('/gamer/{id}', 'GamerApi@get');
    Route::post('/gamer/store', 'GamerApi@store');
    Route::put('/gamer/update', 'GamerApi@update');
    Route::post('/gamer/toggle/{id}', 'GamerApi@toggle');

    //games routes
    Route::get('/game/games', 'GameApi@all');
    Route::get('/game/{id}', 'GameApi@get');
    Route::post('/game/store', 'GameApi@store');
    Route::post('/game/add-to-client', 'GameApi@addGameToClient');
    Route::put('/game/update', 'GameApi@update');
    Route::delete('/game/{id}', 'GameApi@delete');

    //genre routes
    Route::get('/genre/genres', 'GenreApi@all');
    Route::get('/genre/{id}', 'GenreApi@get');
    Route::post('/genre/store', 'GenreApi@store');
    Route::delete('/genre/{id}', 'GenreApi@delete');

    //client routes
    Route::get('/client/clients', 'ClientApi@all');
    Route::get('/client/{id}', 'ClientApi@get');
    Route::post('/client/store', 'ClientApi@store');
    Route::put('/client/update', 'ClientApi@update');
    Route::delete('/client/{id}', 'ClientApi@delete');

    //game mode routes
    Route::get('/game-mode/modes', 'GameModeApi@all');
    Route::get('/game-mode/{id}', 'GameModeApi@get');
    Route::post('/game-mode/store', 'GameModeApi@store');
    Route::delete('/game-mode/{id}', 'GameModeApi@delete');

    //player perspective routes
    Route::get('/play-perspect/perspectives', 'PlayerPerspectiveApi@all');
    Route::get('/play-perspect/{id}', 'PlayerPerspectiveApi@get');
    Route::post('/play-perspect/store', 'PlayerPerspectiveApi@store');
    Route::delete('/play-perspect/{id}', 'PlayerPerspectiveApi@delete');

    //booking routes
    Route::get('/booking/bookings', 'BookingApi@all');
    Route::get('/booking/{id}', 'BookingApi@get');
    Route::post('/booking/store', 'BookingApi@store');
    Route::delete('/booking/{id}', 'BookingApi@delete');

    //order routes
    Route::get('/order/orders', 'OrderApi@all');
    Route::get('/order/{id}', 'OrderApi@get');
    Route::post('/order/store', 'OrderApi@store');
    Route::delete('/order/{id}', 'OrderApi@delete');
    Route::post('/order/pay/{order_id}', 'PaymentApi@pay');

    //ticket routes
    Route::get('/ticket/tickets', 'TicketApi@all');
    Route::get('/ticket/types', 'TicketApi@allTicketType');
    Route::get('/ticket/byOrderNo/{orderNo}', 'TicketApi@getTicketByOrderNo');
    Route::get('/ticket/{id}', 'TicketApi@get');
    Route::post('/ticket/type/store', 'TicketApi@storeTicketType');
    Route::post('/ticket/type/{id}', 'TicketApi@toggleTicketType');
    Route::post('/ticket/store', 'TicketApi@store');
    Route::post('/ticket/history', 'TicketApi@history');
    Route::delete('/ticket/{id}', 'TicketApi@delete');
});
